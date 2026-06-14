<?php
$genMsg="";

// require $_SERVER['DOCUMENT_ROOT']."/stream.php";
// require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
// require $_SERVER['DOCUMENT_ROOT']."$stream/dash/includes/generalinclude.php";

// Handle session message
if (isset($_SESSION['genMsg'])) {
    $genMsg = $_SESSION['genMsg'];
    unset($_SESSION['genMsg'], $_SESSION['spin_submitted']);
}

if (isset($_POST["spin"])) {
    if (!isset($_SESSION['spin_submitted'])) {
        $_SESSION['spin_submitted'] = true;

        $username = $_SESSION['username'];
        $type = "WinCircle";
        $time = date("H:i:s");
        $dateTime = date("Y-m-d H:i:s");
        $today = date("Y-m-d");

        // Optional global check for wheel availability
        if (isset($spinWheel) && $spinWheel == "0") {
            $status = "error";
            $message = "WinCircle currently unavailable.";
            $genMsg = sendResponse($status, $message);

        } elseif (empty($_POST['score'])) {
            $status = "error";
            $message = "You didn't win. Good luck next time.";
            $genMsg = sendResponse($status, $message);

        } elseif (!is_numeric($_POST['score'])) {
            $status = "error";
            $message = "Something went wrong. Code 002.";
            $genMsg = sendResponse($status, $message);

        } else {
            $score = filter_string($_POST['score']);
            $amount = $score;

            // Check daily spin limit
            $checkSql = $link->prepare("SELECT COUNT(*) FROM userearnings WHERE username = ? AND type = ? AND DATE(date) = ?");
            $checkSql->bind_param("sss", $username, $type, $today);
            $checkSql->execute();
            $checkSql->bind_result($spinCount);
            $checkSql->fetch();
            $checkSql->close();

            if ($spinCount >= 2) {
                $status = "error";
                $message = "You've already used all your daily WinCircle. Please come back tomorrow.";
                $genMsg = sendResponse($status, $message);
            } else {
                // Record spin earnings
                $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
                $sql->bind_param("sssss", $username, $type, $amount, $time, $dateTime);

                if ($sql->execute()) {
                    // Credit user's funds (no deduction)
                    $updateSql = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
                    $updateSql->bind_param("ss", $amount, $username);
                    $updateSql->execute();

                    $status = "success";
                    $message = "You won $" . number_format($score) . "!";
                    $genMsg = sendResponse($status, $message);
                } else {
                    $status = "error";
                    $message = "Something went wrong while updating earnings.";
                    $genMsg = sendResponse($status, $message);
                }
            }
        }

        // Store message and reload page
        $_SESSION['genMsg'] = $genMsg;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}

?>