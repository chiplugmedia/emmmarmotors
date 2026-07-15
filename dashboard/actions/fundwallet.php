<?php
$genMsg = ""; // Initialize $genMsg before the conditionals

// $adminMail = "supaclick@gmail.com"; // Corrected variable name
// Handle session message (ONLY ONCE)
if (isset($_SESSION['genMsg'])) {
    $genMsg = $_SESSION['genMsg'];
    unset($_SESSION['genMsg']);
}

if (isset($_POST['bankTransferFunding'])) {

    $amount = trim($_POST['amount'] ?? '');
    $sendername = trim($_POST['sendername'] ?? '');
    $paymentMethod = trim($_POST['paymentMethod'] ?? '');

    if (empty($amount)) {
        $genMsg = sendResponse("error", "Enter the amount you transferred");

    } elseif (empty($sendername)) {
        $genMsg = sendResponse("error", "Enter the sender name");

    } elseif (empty($paymentMethod)) {
        $genMsg = sendResponse("error", "Enter payment method");

    } elseif (empty($_FILES['paymentProof']['name'])) {
        $genMsg = sendResponse("error", "Upload image proof");

    } elseif (!is_numeric($amount) || $amount <= 0) {
        $genMsg = sendResponse("error", "Please enter a valid amount");

    } else {

        $amount = floatval($amount);
        $sendername = htmlspecialchars($sendername, ENT_QUOTES, 'UTF-8');
        $paymentMethod = htmlspecialchars($paymentMethod, ENT_QUOTES, 'UTF-8');

         // Proceed with upload
            $allowedExtensions = ["png", "jpeg", "jpg"];
            $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            $maxSize = 5 * 1024 * 1024; // 5MB

            $file = $_FILES['paymentProof'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $status = "error";
                $message = "Error uploading file";
                $genMsg = sendResponse($status, $message);
            } else {
                $imageName = $file['name'];
                $imageTmpName = $file['tmp_name'];
                $imageSize = $file['size'];
                $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $imageTmpName);
                finfo_close($finfo);

                if (!in_array($extension, $allowedExtensions) || !in_array($mime, $allowedMimeTypes)) {
                    $status = "error";
                    $message = "Only PNG, JPEG, and JPG images are allowed";
                    $genMsg = sendResponse($status, $message);
                } elseif ($imageSize > $maxSize) {
                    $status = "error";
                    $message = "Image size too large (Max: 5MB)";
                    $genMsg = sendResponse($status, $message);
                } else {
                    $newImgName = get_rand_alphanumeric(10) . '.' . $extension;
                    $reference = get_rand_alphanumeric(20);
                    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "$stream/home/img/directory/$newImgName";

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {

                    $link->begin_transaction();

                    try {
                        // Insert bank deposit
                        $stmt = $link->prepare("INSERT INTO bankdeposit 
                        (username, image, amount, sendername, method, reference, date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

                        $stmt->bind_param("ssdssss",
                            $username, $newImgName, $amount, $sendername,
                            $paymentMethod, $reference, $dateTime
                        );
                        $stmt->execute();
                        $stmt->close();

                        // Wallet record
                        $deductedAmt = $amount - $paymentTransferFee;

                        $stmt2 = $link->prepare("INSERT INTO fundwallet 
                        (code, username, email, amount, channel, status, trxid, initiatedfrom, date, message, currency) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        $status = "pending";
                        $message = "Transaction is pending";
                        $gateway = "bankTransfer";
                        $trxid = "";
                        $currency = "XAF";

                        $stmt2->bind_param("sssssssssss",
                            $reference, $username, $email, $deductedAmt,
                            $paymentMethod, $status, $trxid, $gateway,
                            $dateTime, $message, $currency
                        );

                        $stmt2->execute();
                        $stmt2->close();

                        $link->commit();

                        $genMsg = sendResponse("success",
                            "Request submitted successfully. Processing within 24 hours.");

                    } catch (Exception $e) {

                        $link->rollback();

                        if (file_exists($uploadPath)) {
                            unlink($uploadPath);
                        }

                        $genMsg = sendResponse("error",
                            "Something went wrong. Try again.");
                    }

                } else {
                    $genMsg = sendResponse("error", "Failed to upload image");
                }
            }
        }
    }

    $_SESSION['genMsg'] = $genMsg;
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit(); // ✅ VERY IMPORTANT
}

?>