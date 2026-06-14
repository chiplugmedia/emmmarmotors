<?php
$genMsg = $username = $fullname = $email = $phone = $password = $coupon = $country ="";

if (isset($_POST['login'])) {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Input validation
    if (empty($username)) {
        $genMsg = sendResponse("error", "Enter your Phone Number");
    } elseif (empty($password)) {
        $genMsg = sendResponse("error", "Enter your password");
    } else {
        $hashedInputPassword = sha1($password);

        // ✅ Fetch user by username or email
        $sql = $link->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $sql->bind_param("ss", $username, $username);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows == 0) {
            $genMsg = sendResponse("error", "Incorrect Phone Number or password");
        } else {
            $row = $result->fetch_assoc();

            $storedPassword = $row['password'];
            $username     = $row['username'];
            $role           = $row['role'];
            $accountStatus  = $row['status'];
            $time           = $row['time'];

            // ✅ Correct password verification
            if (!password_verify($hashedInputPassword, $storedPassword)) {
                $genMsg = sendResponse("error", "Incorrect Phone Number or password");
            } elseif ($accountStatus === "suspended") {
                $genMsg = sendResponse("error", "Your account has been suspended");
            } else {

                // ✅ Set session
                session_regenerate_id();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                session_write_close();

                $genMsg = sendResponse("success", "Login successful!");
                
            

                // ✅ Redirect based on role
                if (in_array($role, ['user', 'vendor'])) {
                    echo "<script>setTimeout(()=>location.href='$stream/dashboard',1500);</script>";
                } elseif ($role === 'admin') {
                    echo "<script>setTimeout(()=>location.href='$stream/admin/dashboard.php',1500);</script>";
                } elseif ($role === 'assistant') {
                    echo "<script>setTimeout(()=>location.href='$stream/assistant/account.php',1500);</script>";
                }
            }
        }
    }
}


if (isset($_POST['signup'])) {

    // =========================
    // VALIDATION
    // =========================
    if (empty($_POST['firstname'])) {

        $genMsg = sendResponse("error", "Enter First Name");

    } elseif (empty($_POST['lastname'])) {

        $genMsg = sendResponse("error", "Enter a Last Name");    

    } elseif (empty($_POST['username'])) {

        $genMsg = sendResponse("error", "Enter a Username");

    } elseif (preg_match('/\s/', $_POST['username'])) {

        $genMsg = sendResponse("error", "Username should not contain spaces");

    } elseif (empty($_POST['email'])) {

        $genMsg = sendResponse("error", "Enter an Email Address");

    } elseif (empty($_POST['phonenumber'])) {

        $genMsg = sendResponse("error", "Enter your Phone Number");

    } elseif (empty($_POST['gender'])) {

        $genMsg = sendResponse("error", "Select Gender");    

    } elseif (empty($_POST['password'])) {

        $genMsg = sendResponse("error", "Enter a password");

    } elseif (strlen($_POST['password']) < 8) {

        $genMsg = sendResponse("error", "Password must be at least 8 characters");

    } elseif ($_POST['password'] !== $_POST['confirm_password']) {

        $genMsg = sendResponse("error", "Passwords do not match");

    } else {

        // =========================
        // SANITIZE INPUT
        // =========================
        $firstname    = filter_string($_POST['firstname']);
        $lastname  = filter_string($_POST['lastname']);
        $username     = filter_string($_POST['username']);
        $email        = filter_string($_POST['email']);
        $phoneNumber  = filter_string($_POST['phonenumber']);
        $gender  = filter_string($_POST['gender']);
        $password     = $_POST['password'];
        $refcode      = !empty($_POST['refcode']) ? filter_string($_POST['refcode']) : null;

        $randomCode   = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        $userPlantype = "plan_a";

        $dateTime = date('Y-m-d H:i:s');
        $time     = date('H:i:s');

        // =========================
        // CHECK DUPLICATES
        // =========================
        $stmt = $link->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $numrow_user = $stmt->num_rows;
        $stmt->close();

        $stmt = $link->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $numrow_email = $stmt->num_rows;
        $stmt->close();

        $stmt = $link->prepare("SELECT * FROM users WHERE phone=?");
        $stmt->bind_param("s", $phoneNumber);
        $stmt->execute();
        $stmt->store_result();
        $numrow_phone = $stmt->num_rows;
        $stmt->close();

        if ($numrow_user > 0) {

            $genMsg = sendResponse("error", "Username already exists");

        } elseif ($numrow_email > 0) {

            $genMsg = sendResponse("error", "Email already exists");

        } elseif ($numrow_phone > 0) {

            $genMsg = sendResponse("error", "Phone number already in use");

        } else {
            $hashedPassword = sha1($password);
            $hashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);
            $refUsername = null;

              // =========================
            // HANDLE REFERRAL LOGIC
            // =========================

            // Check if refcode is provided and exists
            $validRefcode = false;

            if (!is_null($refcode) && !empty($refcode)) {
                $stmt = $link->prepare("SELECT * FROM users WHERE code = ?");
                $stmt->bind_param("s", $refcode);
                $stmt->execute();
                $stmt->store_result();
                
                if ($stmt->num_rows > 0) {
                    $validRefcode = true;
                }
                $stmt->close();
            }

            // Only process referrals if a valid refcode was provided
            if ($validRefcode) {
                
                // =========================
                // LEVEL 1: INSERT DIRECT REFERRAL FIRST
                // =========================
                $level = 1;
                
                $stmt = $link->prepare("
                    INSERT INTO referrals (code, username, refcode, reference, date)
                    VALUES (?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("sssss", $randomCode, $username, $refcode, $level, $dateTime);
                $stmt->execute();
                $stmt->close();
                
                // =========================
                // LEVEL 2: CHECK FOR INDIRECT REFERRAL (referrer's referrer)
                // =========================
                $sql = $link->prepare("SELECT refcode FROM referrals WHERE code = ?");
                $sql->bind_param("s", $refcode);
                $sql->execute();
                $result = $sql->get_result();

                if ($row = $result->fetch_assoc()) {
                    $level2Refcode = $row['refcode'];
                    
                    if (!is_null($level2Refcode) && !empty($level2Refcode) && $level2Refcode != 0) {
                        $level = 2;
                        
                        $stmt2 = $link->prepare("
                            INSERT INTO referrals (code, username, refcode, reference, date)
                            VALUES (?, ?, ?, ?, ?)
                        ");
                        $stmt2->bind_param("sssss", $randomCode, $username, $level2Refcode, $level, $dateTime);
                        $stmt2->execute();
                        $stmt2->close();
                        
                        // =========================
                        // LEVEL 3: CHECK FOR SECOND INDIRECT REFERRAL
                        // =========================
                        $sql2 = $link->prepare("SELECT refcode FROM referrals WHERE code = ?");
                        $sql2->bind_param("s", $level2Refcode);
                        $sql2->execute();
                        $result2 = $sql2->get_result();

                        if ($row2 = $result2->fetch_assoc()) {
                            $level3Refcode = $row2['refcode'];
                            
                            if (!is_null($level3Refcode) && !empty($level3Refcode) && $level3Refcode != 0) {
                                $level = 3;
                                
                                $stmt3 = $link->prepare("
                                    INSERT INTO referrals (code, username, refcode, reference, date)
                                    VALUES (?, ?, ?, ?, ?)
                                ");
                                $stmt3->bind_param("sssss", $randomCode, $username, $level3Refcode, $level, $dateTime);
                                $stmt3->execute();
                                $stmt3->close();
                            }
                        }
                        $sql2->close();
                    }
                }
                $sql->close();
                
            } else {
                // =========================
                // NO REFCODE OR INVALID REFCODE - INSERT NULL REFERRAL
                // =========================
                $level = 0;
                
                $stmt = $link->prepare("
                    INSERT INTO referrals (code, username, refcode, reference, date)
                    VALUES (?, ?, NULL, ?, ?)
                ");
                $stmt->bind_param("ssss", $randomCode, $username, $level, $dateTime);
                $stmt->execute();
                $stmt->close();
            }

            // =========================
            // INSERT USER (LAST STEP)
            // =========================
            $sql = $link->prepare("
                INSERT INTO users (
                    code, firstname, lastname ,username, email, phone, password, date, time
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $sql->bind_param(
                "sssssssss",
                $randomCode,
                $firstname,
                $lastname,
                $username,
                $email,
                $phoneNumber,
                $hashedPassword,
                $dateTime,
                $time
            );

            $execute = $sql->execute();
            $sql->close();

            if ($execute) {


                $genMsg = sendResponse("success", "Welcome! Your account is ready!");

                echo "<script>
                    setTimeout(function(){
                        window.location.href = '$stream/login';
                    }, 3000);
                </script>";

            } else {
                $genMsg = sendResponse("error", "Failed to create account: " . $link->error);
            }
        }
    }
}
?>