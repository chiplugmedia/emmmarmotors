<?php
$genMsg="";
if (isset($_POST['addTask'])) {
    if (empty($_POST['reference'])) {
        $status = "error";
        $message = "Something went wrong 001";
        $genMsg = sendResponse($status, $message);
    } elseif (empty($_POST['url'])) {
        $status = "error";
        $message = "Something went wrong 002";
        $genMsg = sendResponse($status, $message);
    } else {
        $reference = filter_string($_POST['reference']);
        $url = filter_string($_POST['url']);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); // Assume username is passed via POST
        $dateTime = date("Y-m-d H:i:s");
        
        // Check if user has already purchased the package and if it's still active
        $sql = $link->prepare("SELECT * FROM user_investments WHERE username=? AND reference=? AND status='active'");
        $sql->bind_param("ss", $username, $reference);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $genMsg = sendResponse("error", "You have not invested");
       
       
        } else {
            // Check if task exists
            $sql = $link->prepare("SELECT * FROM dailytasks WHERE reference = ?");
            $sql->bind_param("s", $reference);
            $sql->execute();
            $result = $sql->get_result();
            $numrow_task = $result->num_rows;
            $row = $result->fetch_assoc();

            if ($numrow_task == 0) {
                $status = "error";
                $message = "Invalid task";
                $genMsg = sendResponse($status, $message);
            } else {
                // Check if user has performed this task
                $sql = $link->prepare("SELECT * FROM usertasks WHERE username = ? AND reference = ?");
                $sql->bind_param("ss", $username, $reference);
                $sql->execute();
                $result = $sql->get_result();
                $numrow_userTask = $result->num_rows;

                if ($numrow_userTask > 0) {
                    $status = "error";
                    $message = "You have performed this task";
                    $genMsg = sendResponse($status, $message);
                } else {
                    $amount = $row['amount'];
                    $postTitle = $row['title'];
                    $postUrl = $row['url'];
                    $newStatus = "completed";

                    $sql = $link->prepare("INSERT INTO usertasks (username, title, url, amount, status, reference, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $sql->bind_param("sssssss", $username, $postTitle, $postUrl, $amount, $newStatus, $reference, $dateTime);
                    if ($sql->execute()) {
                        $type = "Click to earn";
                        $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
                        $sql->bind_param("sssss", $username, $type, $amount, $time, $dateTime);
                        $sql->execute();

                        $sql = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
                        $sql->bind_param("ss", $amount, $username);
                        $sql->execute();

                        $status = "success";
                        $message = "Click to earn completed successfully (+ NP$amount 👍)";
                        $genMsg = sendResponse($status, $message);
                        header("Location: $postUrl");
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

?>