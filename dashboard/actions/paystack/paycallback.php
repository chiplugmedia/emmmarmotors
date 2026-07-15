<?php

session_start();

/*
|--------------------------------------------------------------------------
| DATABASE CONNECTION
|--------------------------------------------------------------------------
*/
$link = new mysqli(
    "localhost",
    "chiplug_nvidia",
    "chiplug_nvidia",
    "chiplug_nvidia"
);

if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}

/*
|--------------------------------------------------------------------------
| PAYSTACK CONFIG
|--------------------------------------------------------------------------
*/
define(
    'PAYSTACK_SECRET_KEY',
    '*********'
);

$reference = $_GET['reference'] ?? '';

if (empty($reference)) {
    die("Invalid payment reference.");
}

/*
|--------------------------------------------------------------------------
| VERIFY PAYMENT
|--------------------------------------------------------------------------
*/
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . PAYSTACK_SECRET_KEY
    ]
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    die("Unable to connect to Paystack.");
}

curl_close($curl);

$result = json_decode($response, true);

if (
    isset($result['status']) &&
    $result['status'] === true &&
    isset($result['data']['status']) &&
    $result['data']['status'] === 'success'
) {

    $amount = $result['data']['amount'] / 100;

    /*
    |--------------------------------------------------------------------------
    | GET PAYMENT RECORD
    |--------------------------------------------------------------------------
    */
    $sql = $link->prepare("
        SELECT *
        FROM fundwallet
        WHERE code = ?
        LIMIT 1
    ");

    $sql->bind_param("s", $reference);
    $sql->execute();

    $payment = $sql->get_result()->fetch_assoc();
    $sql->close();

    if (!$payment) {
        die("Payment record not found.");
    }

    /*
    |--------------------------------------------------------------------------
    | PREVENT DOUBLE CREDITING
    |--------------------------------------------------------------------------
    */
    if ($payment['status'] !== "Successful") {

        $username = $payment['username'];

        /*
        |--------------------------------------------------------------------------
        | UPDATE PAYMENT STATUS
        |--------------------------------------------------------------------------
        */
        $sql = $link->prepare("
            UPDATE fundwallet
            SET status = 'Successful'
            WHERE code = ?
        ");

        $sql->bind_param("s", $reference);
        $sql->execute();
        $sql->close();

        /*
        |--------------------------------------------------------------------------
        | CREDIT USER WALLET
        |--------------------------------------------------------------------------
        */
        $sql = $link->prepare("
            UPDATE users
            SET funds = funds + ?
            WHERE username = ?
        ");

        $sql->bind_param(
            "ds",
            $amount,
            $username
        );

        $sql->execute();
        $sql->close();

        /*
        |--------------------------------------------------------------------------
        | RECORD USER EARNING
        |--------------------------------------------------------------------------
        */
        $type = "Deposit";
        $boughtAt = date("Y-m-d H:i:s");

        $stmt = $link->prepare("
            INSERT INTO userearnings
            (
                username,
                type,
                amount,
                time,
                date
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ");

        $stmt->bind_param(
            "ssdss",
            $username,
            $type,
            $amount,
            $boughtAt,
            $boughtAt
        );

        $stmt->execute();
        $stmt->close();
    }

    header("Location: https://localhost/emmmarmotors/dashboard");
    exit;

} else {

    die("Payment verification failed.");
}

$link->close();

?>