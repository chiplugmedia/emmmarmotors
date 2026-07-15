<?php
function buyAirtime($data) {
    if (!isset($data['phone'], $data['serviceID'], $data['amount'], $data['reference'])) {
        return ['error' => 'Missing required parameters'];
    }
    
    $phone = $data['phone'];
    $serviceID = $data['serviceID'];
    $amount = $data['amount'];
    $reference = $data['reference'];

    $postFields = array(
        "serviceID" => $serviceID,
        "amount" => $amount,
        "mobileNumber" => $phone,
        "clientReference" => $reference
    );
    
    $url = "https://topupwizard.com/api/airtime";
    $type = "airtime";

    return api($url, $postFields, $type);
}

function buyData($data) {
    if (!isset($data['phone'], $data['serviceID'], $data['network'], $data['reference'])) {
        return ['error' => 'Missing required parameters'];
    }
    
    $phone = $data['phone'];
    $serviceID = $data['serviceID'];
    $network = $data['network'];
    $reference = $data['reference'];
    $type = "data";

    $postFields = array(
        "serviceID" => $serviceID,
        "mobileNumber" => $phone,
        "clientReference" => $reference
    );
    
    $url = "https://topupwizard.com/api/data";

    return api($url, $postFields, $type);
}

function api($url, $postFields, $type, $other = "") {
    global $apiKey;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postFields),
        CURLOPT_HTTPHEADER => array(
            "Authorization-Token: $apiKey",
            "cache-control: no-cache",
            "Content-Type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode !== 200) {
        return ['error' => 'HTTP request failed'];
    }

    $response = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Failed to decode JSON response'];
    }

    return $response;
}

?>