<?php


$genMsg = "";

if (isset($_SESSION['genMsg'])) {
    $genMsg = $_SESSION['genMsg'];
    unset($_SESSION['genMsg']);
}

function redirectWithMessage($type, $message)
{
    $_SESSION['genMsg'] = sendResponse($type, $message);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

define(
    'PAYSTACK_SECRET_KEY',
    'sk_test_bcbef13ea701e365ea9fd23d9fea77c87dbb24f6'
);

$username = $_SESSION['username'] ?? '';

if (empty($username)) {
    redirectWithMessage(
        "error",
        "Please login first."
    );
}

/*
|--------------------------------------------------------------------------
| GET USER
|--------------------------------------------------------------------------
*/
$sql = $link->prepare("
    SELECT id, email
    FROM users
    WHERE username = ?
    LIMIT 1
");

$sql->bind_param("s", $username);
$sql->execute();

$user = $sql->get_result()->fetch_assoc();

$sql->close();

if (!$user) {
    redirectWithMessage(
        "error",
        "User not found."
    );
}

$email      = $user['email'];
$customerId = $user['id'];

if (isset($_POST['verifyAccount'])) {

    $nin = trim($_POST['nin'] ?? '');

    if (!preg_match('/^[0-9]{11}$/', $nin)) {

        redirectWithMessage(
            "error",
            "Invalid NIN. NIN must be exactly 11 digits."
        );

    } elseif (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] != 0
    ) {

        redirectWithMessage(
            "error",
            "Please upload your passport photo."
        );

    } else {

        /*
        |--------------------------------------------------------------------------
        | IMAGE VALIDATION
        |--------------------------------------------------------------------------
        */
        $imageName = $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];

        $extension = strtolower(
            pathinfo(
                $imageName,
                PATHINFO_EXTENSION
            )
        );

        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png'
        ];

        if (!in_array($extension, $allowedExtensions)) {

            redirectWithMessage(
                "error",
                "Only JPG, JPEG and PNG images are allowed."
            );

        } elseif ($imageSize > (5 * 1024 * 1024)) {

            redirectWithMessage(
                "error",
                "Image size must not exceed 5MB."
            );

        } else {

            /*
            |--------------------------------------------------------------------------
            | CHECK IF ACCOUNT EXISTS
            |--------------------------------------------------------------------------
            */
            $check = $link->prepare("
                SELECT id
                FROM virtualaccounts
                WHERE username = ?
                LIMIT 1
            ");

            $check->bind_param(
                "s",
                $username
            );

            $check->execute();

            if ($check->get_result()->num_rows > 0) {

                $check->close();

                redirectWithMessage(
                    "error",
                    "You already have a virtual account."
                );

            } else {

                $check->close();

                /*
                |--------------------------------------------------------------------------
                | UPLOAD IMAGE
                |--------------------------------------------------------------------------
                */
                $newImgName =
                    get_rand_alphanumeric(10) .
                    "." .
                    $extension;

                $uploadDir =
                    $_SERVER['DOCUMENT_ROOT'] .
                    "/dashboard/assets/img/profilephotos/";

                if (!is_dir($uploadDir)) {
                    mkdir(
                        $uploadDir,
                        0777,
                        true
                    );
                }

                if (!move_uploaded_file(
                    $imageTmp,
                    $uploadDir . $newImgName
                )) {

                    redirectWithMessage(
                        "error",
                        "Failed to upload image."
                    );

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | CREATE PAYSTACK DEDICATED ACCOUNT
                    |--------------------------------------------------------------------------
                    */
                    $payload = [
                        "customer"       => (int)$customerId,
                        "preferred_bank" => "titan-paystack"
                    ];

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://api.paystack.co/dedicated_account",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => json_encode($payload),
                        CURLOPT_HTTPHEADER => [
                            "Authorization: Bearer " . PAYSTACK_SECRET_KEY,
                            "Content-Type: application/json"
                        ]
                    ]);

                    $response = curl_exec($curl);

                    if (curl_errno($curl)) {

                        redirectWithMessage(
                            "error",
                            curl_error($curl)
                        );

                    } else {

                        $result = json_decode(
                            $response,
                            true
                        );

                        if (
                            isset($result['status']) &&
                            $result['status'] === true
                        ) {

                            $accountNumber =
                                $result['data']['account_number'];

                            $accountName =
                                $result['data']['account_name'];

                            $bankName =
                                $result['data']['bank']['name'];

                            $accountId =
                                $result['data']['id'];

                            /*
                            |--------------------------------------------------------------------------
                            | SAVE VIRTUAL ACCOUNT
                            |--------------------------------------------------------------------------
                            */
                            $sql = $link->prepare("
                                INSERT INTO virtualaccounts
                                (
                                    username,
                                    email,
                                    accountnumber,
                                    accountname,
                                    bankname,
                                    accountreference,
                                    nin,
                                    kycphoto
                                )
                                VALUES
                                (
                                    ?, ?, ?, ?, ?, ?, ?, ?
                                )
                            ");

                            $sql->bind_param(
                                "ssssssss",
                                $username,
                                $email,
                                $accountNumber,
                                $accountName,
                                $bankName,
                                $accountId,
                                $nin,
                                $newImgName
                            );

                            $sql->execute();
                            $sql->close();

                            /*
                            |--------------------------------------------------------------------------
                            | UPDATE USER
                            |--------------------------------------------------------------------------
                            */
                            $update = $link->prepare("
                                UPDATE users
                                SET
                                    nin = ?,
                                    image = ?,
                                    verified = '1'
                                WHERE username = ?
                            ");

                            $update->bind_param(
                                "sss",
                                $nin,
                                $newImgName,
                                $username
                            );

                            $update->execute();
                            $update->close();

                            redirectWithMessage(
                                "success",
                                "KYC submitted successfully."
                            );

                        } else {

                            redirectWithMessage(
                                "error",
                                $result['message']
                                ?? "Failed to create virtual account."
                            );
                        }
                    }

                    curl_close($curl);
                }
            }
        }
    }
}

?>