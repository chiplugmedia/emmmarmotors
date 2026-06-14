<?php
function apiBalance() {
    global $apiKey;

    // Check if cURL is enabled
    if (!function_exists('curl_init')) {
        die('cURL is not enabled.');
    }

    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://topupwizard.com/api/balance",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Content-Type: application/json",
            "Authorization-Token: $apiKey",
        ),
    ));

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        die('cURL error: ' . curl_error($curl));
    }

    // Close cURL
    curl_close($curl);

    // Decode JSON response
    $response = json_decode($response, true);

    // Check API response status
    $status = $response['status'];
    $funds = 0;

    if ($status == "success") {
        $funds = $response['data']['funds'];
    }

    return $funds;
}



?>