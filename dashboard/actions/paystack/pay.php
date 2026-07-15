<?php

session_start();

$genMsg = "";

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
define('PAYSTACK_SECRET_KEY', '***********');
define('PAYSTACK_CALLBACK_URL', 'https://localhost/emmmarmotors/dashboard/actions/paystack/paycallback');

$username = $_SESSION['username'] ?? '';

/*
|--------------------------------------------------------------------------
| GET USER EMAIL
|--------------------------------------------------------------------------
*/
$email = '';

$sql = $link->prepare("
    SELECT email
    FROM users
    WHERE username = ?
    LIMIT 1
");

if ($sql) {

    $sql->bind_param("s", $username);
    $sql->execute();

    $result = $sql->get_result();

    if ($row = $result->fetch_assoc()) {
        $email = $row['email'];
    }

    $sql->close();
}

/*
|--------------------------------------------------------------------------
| VALIDATE DATA
|--------------------------------------------------------------------------
*/
$amount = isset($_GET['amount']) ? (float) $_GET['amount'] : 0;

if (empty($username)) {

    $genMsg = "Invalid user.";

} elseif (empty($email)) {

    $genMsg = "Email address not found.";

} elseif ($amount < 100) {

    $genMsg = "Minimum funding amount is ₦100.";

} else {

    /*
    |--------------------------------------------------------------------------
    | GENERATE REFERENCE
    |--------------------------------------------------------------------------
    */
    $reference = "PAY_" . time() . rand(1000, 9999);

    /*
    |--------------------------------------------------------------------------
    | SAVE TRANSACTION
    |--------------------------------------------------------------------------
    */
    $sql = $link->prepare("
        INSERT INTO fundwallet
        (
            username,
            amount,
            code,
            status,
            date
        )
        VALUES
        (
            ?,
            ?,
            ?,
            'Pending',
            NOW()
        )
    ");

    if (!$sql) {

        $genMsg = "Database error: " . $link->error;

    } else {

        $sql->bind_param(
            "sds",
            $username,
            $amount,
            $reference
        );

        if (!$sql->execute()) {

            $genMsg = "Failed to save payment request.";

        } else {

            /*
            |--------------------------------------------------------------------------
            | INITIALIZE PAYSTACK
            |--------------------------------------------------------------------------
            */
            $payload = [
                "email"        => $email,
                "amount"       => $amount * 100, // Convert to Kobo
                "reference"    => $reference,
                "callback_url" => PAYSTACK_CALLBACK_URL
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL            => "https://api.paystack.co/transaction/initialize",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode($payload),
                CURLOPT_HTTPHEADER     => [
                    "Authorization: Bearer " . PAYSTACK_SECRET_KEY,
                    "Content-Type: application/json"
                ]
            ]);

            $response = curl_exec($curl);
            $curlError = curl_error($curl);

            curl_close($curl);

            if ($curlError) {

                $genMsg = "Unable to connect to Paystack.";

            } else {

                $result = json_decode($response, true);

                if (
                    isset($result['status']) &&
                    $result['status'] === true &&
                    !empty($result['data']['authorization_url'])
                ) {

                    header("Location: " . $result['data']['authorization_url']);
                    exit;

                } else {

                    $genMsg = $result['message'] ?? "Unable to initialize payment.";
                }
            }
        }

        $sql->close();
    }
}

if (!empty($genMsg)) {
    echo $genMsg;
}

$link->close();

?>