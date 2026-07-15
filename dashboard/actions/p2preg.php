<?php
$genMsg = $fullname = $username = $email = $phoneNumber = $password = "";

if (isset($_POST['p2pregfee'])) {
    // Initialize variables
    if (empty($_POST['fullname'])) {
        $status = "error";
        $message = "Enter your fullname";
        $genMsg = sendResponse($status, $message);
    } else {
        $fullname = $_POST['fullname'];
    }

    if (empty($_POST['username'])) {
        $status = "error";
        $message = "Enter a username";
        $genMsg = sendResponse($status, $message);
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['email'])) {
        $status = "error";
        $message = "Enter your email address";
        $genMsg = sendResponse($status, $message);
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['phoneNumber'])) {
        $status = "error";
        $message = "Enter your phone number";
        $genMsg = sendResponse($status, $message);
    } else {
        $phoneNumber = $_POST['phoneNumber'];
    }

    if (empty($_POST['countryname'])) {
        $status = "error";
        $message = "Select a country";
        $genMsg = sendResponse($status, $message);
    } else {
        $countryname = $_POST['countryname'];
    }
    
    if (empty($_POST['password'])) {
        $status = "error";
        $message = "Enter a password";
        $genMsg = sendResponse($status, $message);
    } else {
        $password = $_POST['password'];
    }

    $amount1 = "20";

    if (strlen($username) > 20) {
        $status = "error";
        $message = "Username should be less than 20 characters";
        $genMsg = sendResponse($status, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = "error";
        $message = "Enter a valid email address";
        $genMsg = sendResponse($status, $message);
    } elseif (strlen($phoneNumber) != 11) {
        $status = "error";
        $message = "Invalid phone number";
        $genMsg = sendResponse($status, $message);
    } elseif (strlen($password) < 8) {
        $status = "error";
        $message = "Password must be at least 8 characters";
        $genMsg = sendResponse($status, $message);
    } elseif ($amount1 > $funds) {
        $status = "error";
        $message = "Insufficient funds in your activity wallet";
        $genMsg = sendResponse($status, $message);
    } else {
    $hashedPassword = sha1($password);
    $hashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);

        // Check if username, email, and phone are already registered
        $sql = $link->prepare("SELECT * FROM users WHERE username=?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result = $sql->get_result();
        $numrow_user = $result->num_rows;

        $sql = $link->prepare("SELECT * FROM users WHERE email=?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        $numrow_email = $result->num_rows;

        $sql = $link->prepare("SELECT * FROM users WHERE phone=?");
        $sql->bind_param("s", $phoneNumber);
        $sql->execute();
        $result = $sql->get_result();
        $numrow_phone = $result->num_rows;

        if ($numrow_user > 0) {
            $status = "error";
            $message = "Username already exists";
            $genMsg = sendResponse($status, $message);
        } elseif ($numrow_email > 0) {
            $status = "error";
            $message = "Email already exists";
            $genMsg = sendResponse($status, $message);
        } elseif ($numrow_phone > 0) {
            $status = "error";
            $message = "Phone number already in use";
            $genMsg = sendResponse($status, $message);
        } else {
            // Assuming $link, $funds, $sitename, $dateTime, $time, $sendResponse() are properly defined
            $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_STRING);
            $userPlantype = "plan_a"; 
            $invitedby = $_SESSION['username'];
            
            $refBonusmy = "0";
             
                // Update user funds
            $sql = $link->prepare("UPDATE users SET funds = funds - ? WHERE username = ?");
            $sql->bind_param("ss", $amount1, $invitedby);
            $sql->execute();
            
            // Add referral
            $sql = $link->prepare("INSERT INTO referrals (username, referral, earnings, date) VALUES (?, ?, ?, ?)");
            $sql->bind_param("ssss", $username, $invitedby, $refBonusmy, $dateTime);
            $sql->execute();

                $type = "P2P Registration";
                $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES(?,?,?,?,?)");
                $sql->bind_param("sssss", $invitedby, $type, $amount1, $time, $dateTime);
                $sql->execute();
                
                // Insert user data into database
                $sql = $link->prepare("INSERT INTO users(fullname, username, email, phone, password, date, countryname, time, plantype) VALUES(?,?,?,?,?,?,?,?,?)");
                $sql->bind_param("sssssssss", $fullname, $username, $email, $phoneNumber, $hashedPassword, $dateTime, $countryname, $time, $userPlantype);
                if ($sql->execute()) {
                    // Send welcome email with cashback bonus
                    $welcomeBonus = "4000"; // Assuming you have $welcomeBonus defined
                    $subject = "Welcome to $sitename";
                    $message = "Welcome. You earned cashback from welcome bonus data <p class='text-success'> + $welcomeBonus </p>";
                    $type = "welcomeMail";
                    sendMail($email, $fullname, $message, $subject, $type); // Assuming you have sendMail() defined

                    // Update user funds with welcome bonus
                    $sql = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
                    $sql->bind_param("ss", $welcomeBonus, $username);
                    if ($sql->execute()) {
                        // Log the earning
                        $type = "Welcome Bonus";
                        $sql = $link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?,?,?,?,?)");
                        $sql->bind_param("ssiss", $username, $type, $welcomeBonus, $time, $dateTime);
                        if ($sql->execute()) {
                            // Registration successful
                            $status = "success";
                            $message = "Account Created successful";
                            $genMsg = sendResponse($status, $message); // Assuming you have sendResponse() defined
                        } else {
                            $status = "error";
                            $message = "Something went wrong creating account";
                            $genMsg = sendResponse($status, $message);
                        }
                    }
                }
            }
        }
    }










if (isset($_POST['loanplan'])) {
    // Extract and sanitize input
    $username  = $_SESSION['username'];
    $purpose   = isset($_POST['purpose']) ? trim($_POST['purpose']) : '';
    $amount    = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $duration  = isset($_POST['duration']) ? intval($_POST['duration']) : 0;

    // Validate inputs
    if (empty($purpose)) {
        $genMsg = sendResponse("error", "Select your purpose");
    } elseif ($amount <= 0) {
        $genMsg = sendResponse("error", "Enter a valid amount");
    } elseif ($duration < 1 || $duration > 13) {
        $genMsg = sendResponse("error", "Loan duration must be between 1-13 weeks");
    } else {
        // Sanitize and calculate loan details
        $purpose = filter_var($purpose, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $interest = $amount * 0.0075 * $duration;
        $totalRepayment = $amount + $interest;
        $loanStatus = "pending";

        $stmt = $link->prepare("INSERT INTO loans (username, purpose, amount, duration, interest, totalrepayment, status, date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        
        if ($stmt) {
            // ssiddds = string, string, integer, double, double, double, string
            $stmt->bind_param("ssiddds", $username, $purpose, $amount, $duration, $interest, $totalRepayment, $loanStatus);
            
            if ($stmt->execute()) {
                $genMsg = sendResponse("success", "Loan application submitted successfully and is now pending approval.");
            } else {
                $genMsg = sendResponse("error", "Database error: Could not submit application.");
            }
            $stmt->close();
        } else {
            $genMsg = sendResponse("error", "Database error: Could not prepare statement.");
        }
    }
}

?>
