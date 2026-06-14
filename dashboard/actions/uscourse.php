<?php
$genMsg = "";

if (isset($_POST['purchase'])) {
    
    // Check if reference and URL are provided
    if (empty($_POST['reference'])) {
        $genMsg = sendResponse("error", "Reference is required");
    } elseif (empty($_POST['url'])) {
        $genMsg = sendResponse("error", "URL is required");
    } else {
        // Sanitize and validate input
        $reference = filter_var($_POST['reference'], FILTER_SANITIZE_STRING);
        $url = filter_var($_POST['url'], FILTER_VALIDATE_URL);

        if (!$url) {
            $genMsg = sendResponse("error", "Invalid URL");
        } else {
            // Check if user has already purchased the course
            $sql = $link->prepare("SELECT * FROM userpurchases WHERE username=? AND reference=?");
            $sql->bind_param("ss", $username, $reference);
            $sql->execute();
            $result = $sql->get_result();
            $numrow_userpurchases = $result->num_rows;

            if ($numrow_userpurchases > 0) {
                $genMsg = sendResponse("error", "You have already purchased this course");
            } else {
                // Fetch course details
                $sql = $link->prepare("SELECT * FROM subscription_products WHERE reference=?");
                $sql->bind_param("s", $reference);
                $sql->execute();
                $result = $sql->get_result();
                $numrow_subscription_products = $result->num_rows;

                if ($numrow_subscription_products == 0) {
                    $genMsg = sendResponse("error", "Invalid course");
                } else {
                    $row = $result->fetch_assoc();
                    // User purchases the course
                    $amount56 = $row['amount'];
                    $postTitle = $row['title'];
                    $postUrl = $row['url'];
                    $newStatus = "active"; // Assuming newStatus needs to be defined

                    if ($amount56 > $funds) {
                        $status = "error";
                        $message = "Insufficient funds in your activity wallet";
                        $genMsg = sendResponse($status, $message);
                    } else {
                        // Start transaction
                        $link->begin_transaction();

                        // Deduct funds from the user's account
                        $sql = $link->prepare("UPDATE users SET funds=funds - ? WHERE username=?");
                        $sql->bind_param("ds", $amount56, $username);
                        $deductFunds = $sql->execute();

                        // Insert purchase record
                        $dateTime = date('Y-m-d H:i:s');
                        $sql = $link->prepare("INSERT INTO userpurchases(username, title, url, amount, status, reference, date) VALUES(?,?,?,?,?,?,?)");
                        $sql->bind_param("sssdsss", $username, $postTitle, $postUrl, $amount56, $newStatus, $reference, $dateTime);
                        $insertPurchase = $sql->execute();

                        if ($deductFunds && $insertPurchase) {
                            // Commit transaction
                            $link->commit();

                            // Log the user's earnings attempt
                            $type = "Purchased Courses";
                            $time = time(); // Added missing time variable
                            $sql = $link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?,?,?,?,?)");
                            $sql->bind_param("sssss", $username, $type, $amount56, $time, $dateTime);
                            $sql->execute();
                            
                            $status = "success";
                            $message = "Courses Purchased successfully (- $amount56 TP 👍)";
                            $genMsg = sendResponse($status, $message);
                            header("location:$postUrl");
                        } else {
                            $status = "error";
                            $message = "Something went wrong 003";
                            $genMsg = sendResponse($status, $message);
                        }
                    }
                }
            }
        }
    }
}
?>
