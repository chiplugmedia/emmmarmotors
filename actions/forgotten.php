<?php
$genMsg = $email=$coupon="";


if (isset($_POST['forgotPsw'])) {
    if (empty($_POST['email'])) {
        $status = "error";
        $message = "Enter your email address";
        $genMsg = sendResponse($status, $message);
    } else {
        $email = filter_string($_POST['email']);

        $sql = $link->prepare("SELECT * FROM users WHERE email=?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        $numrow = $result->num_rows;
        $row = $result->fetch_assoc();
        if ($numrow == 1) {
            $fullname = $row['fullname'];
            $token = get_rand_alphanumeric(20);
            $sql = $link->prepare("DELETE FROM otp WHERE email=?");
            $sql->bind_param("s", $email);
            if ($sql->execute()) {
                $sql = $link->prepare("INSERT INTO otp(email, otp, date) VALUES(?,?,?)");
                $sql->bind_param("sss", $email, $token, $dateTime);
                $sql->execute();

                $subject = "Password Reset";
                $message = array("fullname" => $fullname, "pswToken" => $token);
                $type = "forgotPsw";

                $mail = sendMail($email, $fullname, $message, $subject, $type);
                $mailStatus = $mail['status'];
                $mailMessage = $mail['message'];
                if ($mailStatus == "success") {
                    $status = "success";
                    $message = "Password reset link sent successfully. Please check your email and follow the procedures";
                    $genMsg = sendResponse($status, $message);
                } else {
                    $status = "error";
                    $message = "Something went wrong resetting the password, please try again";
                    $genMsg = sendResponse($status, $message);
                }
            } else {
                $status = "error";
                $message = "Something went wrong";
                $genMsg = sendResponse($status, $message);
            }
        } else {
            $status = "error";
            $message = "Invalid email address";
            $genMsg = sendResponse($status, $message);
        }
    }
}


if (isset($_POST['resetPsw'])) {
    if (empty($_POST['password'])) {
        $status = "error";
        $message = "Enter your new password";
        $genMsg = sendResponse($status, $message);
    } else if (strlen($_POST['password']) < 8) {
        $status = "error";
        $message = "Password must be at least 8 characters";
        $genMsg = sendResponse($status, $message);
    } else if (empty($_POST['confirmPsw'])) {
        $status = "error";
        $message = "Retype your new password";
        $genMsg = sendResponse($status, $message);
    } else if ($_POST['password'] != $_POST['confirmPsw']) {
        $status = "error";
        $message = "Passwords do not match";
        $genMsg = sendResponse($status, $message);
    } else {
        $password = filter_string($_POST['password']);
        $password = sha1($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = filter_string($_SESSION['forgotEmail']);

        $sql = $link->prepare("UPDATE users SET password=? WHERE email=?");
        $sql->bind_param("ss", $password, $email);
        if ($sql->execute()) {
            $sql = $link->prepare("DELETE FROM otp WHERE email=?");
            $sql->bind_param("s", $email);
            $sql->execute();

            header("location:login.php");
        } else {
            $status = "error";
            $message = "Failed to update the password";
            $genMsg = sendResponse($status, $message);
        }
    }
}


?>

