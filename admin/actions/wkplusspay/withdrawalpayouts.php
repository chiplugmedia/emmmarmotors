<?php

function generateTransactionID($length = 8) {
    return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}

function generateSignatureds($params, $secretKey) {
    $filteredParams = array_filter($params, function($value, $key) {
        return $value !== '' && $key !== 'sign';
    }, ARRAY_FILTER_USE_BOTH);

    ksort($filteredParams);

    $queryString = '';
    foreach ($filteredParams as $key => $value) {
        $queryString .= $key . '=' . $value . '&';
    }
    $queryString = rtrim($queryString, '&');

    $stringToSign = $queryString . $secretKey;

    return strtolower(md5($stringToSign));
}



function withdrawMoney($data, $link = null, $withdrawal_id = null) {
    $logFile = __DIR__ . '/wkplus_withdraw_log.txt';

    if (!isset($data['amount'], $data['bank_code'], $data['bank_name'], $data['username'], $data['bank_number'])) {
        file_put_contents($logFile, date("Y-m-d H:i:s") . " Missing parameters: " . json_encode($data) . PHP_EOL, FILE_APPEND);
        return ['status' => 'error', 'message' => 'Missing required parameters'];
    }

    $secretKey  = '10b8890b3dba4cd99319b014bb22b099';
    $url        = 'https://wkpluss.com/gateway/';
    $merchantNo = '8892446';
    $trx        = 'WRX' . generateTransactionID(8);
    $returnUrl  = 'https://nviaicop.com/admin/actions/wkplusspay/withdrawal_callback';

$amount = $data['amount'];
$payload = [
    'mer_no'       => $merchantNo,
    'order_no'     => $trx,
    'method'       => 'fund.apply',
    'order_amount' => number_format($amount, 2, '.', ''),
    'currency'     => 'NGN',
    'acc_code'     => $data['bank_code'],
    'acc_name'     => $data['bank_name'],
    'acc_email'    => 'user@email.com',
    'acc_phone'    => $data['username'],
    'acc_no'       => $data['bank_number'],
    'returnurl'    => $returnUrl,
];

    $payload['sign'] = generateSignatureds($payload, $secretKey);

    file_put_contents($logFile, date("Y-m-d H:i:s") . " Sending Payload: " . json_encode($payload) . PHP_EOL, FILE_APPEND);

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_INTERFACE => '102.212.246.82',
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
$ip = gethostbyname(gethostname()); // Gets the server's local or public IP
file_put_contents("ip_log.txt", date("Y-m-d H:i:s") . " => " . $ip . PHP_EOL, FILE_APPEND);
echo "Your Server IP: " . $ip;

    file_put_contents($logFile, date("Y-m-d H:i:s") . " HTTP Code: $httpCode | Response: $response" . PHP_EOL, FILE_APPEND);

    if ($error) {
        file_put_contents($logFile, date("Y-m-d H:i:s") . " CURL Error: $error" . PHP_EOL, FILE_APPEND);
        return ['status' => 'error', 'message' => 'CURL Error: ' . $error];
    }

    $responseData = json_decode($response, true);

    if ($responseData && isset($responseData['status']) && $responseData['status'] === 'success') {
        if ($link && $withdrawal_id) {
            $update = $link->prepare("UPDATE withdrawals SET status='processing', oldreference=? WHERE id=?");
            $update->bind_param("si", $trx, $withdrawal_id);
            $update->execute();
        }

        file_put_contents($logFile, date("Y-m-d H:i:s") . " Success: Transaction $trx processing started." . PHP_EOL, FILE_APPEND);

        return [
            'status' => 'success',
            'reference' => $trx,
            'message' => 'Payout processing started.'
        ];
    } else {
        $errorMsg = $responseData['status_mes'] ?? ($responseData['message'] ?? 'Failed to process payout');
        file_put_contents($logFile, date("Y-m-d H:i:s") . " API Error: " . $errorMsg . PHP_EOL, FILE_APPEND);
        return ['status' => 'error', 'message' => $errorMsg];
    }
}

?>
