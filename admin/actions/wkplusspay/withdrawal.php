<?php

// Default values for demonstration
$amount = 5000;  // Default payout amount
$trx = 'WD123456789';  // Default transaction/order ID
$bankCode = '044';  // Default bank code (example: Access Bank)
$accountName = 'John Doe';
$accountNumber = '1234567890';
$returnUrl = 'https://yourdomain.com/wcallback';  // Your callback URL
$secretKey = '9f9f027b2cd073affa7e561f1badc2ea';  // Your WK Pluss secret key
$url = 'https://wkpluss.com/gateway/';  // WK Pluss API endpoint

// Step 1: Prepare payout data
$data = [
    'mer_no'        => '8891574',           // Your merchant number
    'order_no'      => $trx,                // Transaction ID
    'method'        => 'fund.apply',        // Method for payout
    'order_amount'  => number_format($amount, 2, '.', ''), // Amount (formatted)
    'currency'      => 'NGN',               // Currency
    'acc_code'      => $bankCode,           // Bank code
    'acc_name'      => $accountName,        // Account name
    'acc_email'     => 'john.doe@email.com',// Example email
    'acc_phone'     => '2349134203713',     // Example phone number
    'acc_no'        => $accountNumber,      // Account number
    'returnurl'     => $returnUrl,          // Callback URL
];

// Step 2: Generate signature
$data['sign'] = generateSignatureds($data, $secretKey);

// Step 3: Send POST request using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    die('Request Error: ' . curl_error($ch));
}

curl_close($ch);

// Step 4: Handle response
$responseData = json_decode($response, true);

if ($responseData && isset($responseData['status']) && $responseData['status'] === 'success') {
    // Your refund logic will be added here
    echo "Withdrawal approved successfully.\n";
} else {
    // Handle failure
    $errorMessage = $responseData['status_mes'] ?? 'Failed to process payout';
    echo "Error: " . $errorMessage . "\n";
}

// ===============================
// Signature Generator Function
// ===============================
function generateSignatureds($data, $secretKey) {
    ksort($data);
    $signStr = '';
    foreach ($data as $key => $val) {
        if ($val !== '' && $key !== 'sign') {
            $signStr .= $key . '=' . $val . '&';
        }
    }
    $signStr .= 'key=' . $secretKey;
    return md5($signStr);
}
