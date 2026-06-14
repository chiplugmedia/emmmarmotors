<?php
$genMsg="";

function generateTransactionID($length = 6) {
    return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}


if (isset($_POST['paying'])) {

    if (!empty($_POST['email']) && !empty($_POST['phone'])) {

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars($_POST['phone']);
        $username = $_SESSION['username'];

        // API CALL
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://dsociopay.com/api/create/account/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'email' => $email,
                'username' => $username,
                'phone_number' => $phone
            ]),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "content-type: application/json",
                "private-Key: p7a9p9piiai9744a7apa799a9"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $status = "error";
            $message = "cURL Error: " . $err;
            $genMsg = sendResponse($status, $message);
            exit;
        }

        $data = json_decode($response, true);

        if (!$data) {
            $status = "error";
            $message = "Invalid API response";
            $genMsg = sendResponse($status, $message);
            exit;
        }

        // CHECK SUCCESS RESPONSE
        if (!empty($data['status']) && $data['status'] === "success") {

            $account_number = $data['account_number'] ?? '';
            $account_name = $data['account_name'] ?? '';
            $bank_name = $data['bank_name'] ?? '';

            // INSERT INTO WEBHOOKS TABLE
            $reference = generateTransactionID(10);
            $stmt = $link->prepare("
                INSERT INTO virtualaccounts 
                (email, username, accountnumber, accountname, bankname,accountreference, date)
                VALUES (?, ?, ?, ?,  ?, ?, ?)
            ");

            $jsonResponse = json_encode($data);

            $stmt->bind_param(
                "sssssss",
                $email,
                $username,
                $account_number,
                $account_name,
                $bank_name,
                $jsonResponse,
                $dateTime
            );

            $stmt->execute();

            $status = "success";
            $message = "Success! Account created and stored";
            $genMsg = sendResponse($status, $message);

        } else {

            $status = "error";
            $message = $data['message'] ?? "API failed or returned error";
            $genMsg = sendResponse($status, $message);
        }

    } else {
        $status = "error";
        $message = "Email and phone are required";
        $genMsg = sendResponse($status, $message);
    }
}
?>
    