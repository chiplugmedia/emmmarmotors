<?php
$genMsg = $wallet = $amount = $isSelectedActivity = $isSelectedReferral = $isSelectedIndirectReferral = $isSelectedThirdIndirectReferral = "";


if (isset($_POST['withdraw'])) {

    $minActWithAmt = 3500;
    $chargeRateActivity = 0.10; // 15% charge rate
    $wallets = array("activity", "referral");

    // ✅ Validate inputs
    if (empty($_POST['amount'])) {
        $genMsg = sendResponse("error", "Enter an amount to withdraw");
    } elseif (!is_numeric($_POST['amount'])) {
        $genMsg = sendResponse("error", "Invalid amount");
    } elseif (empty($_POST['wallet'])) {
        $genMsg = sendResponse("error", "Select wallet to withdraw from");
    } elseif (!in_array($_POST['wallet'], $wallets)) {
        $genMsg = sendResponse("error", "Invalid wallet");
    } else {

        // ✅ Sanitize inputs
        $wallet = filter_string($_POST['wallet']);
        $amount = filter_string($_POST['amount']);
        $chargeRate = $chargeRateActivity;
        $charge = $amount * $chargeRate;
        $amountAfterCharge = $amount - $charge;

        // ✅ Get current user info
        $sql = $link->prepare("SELECT * FROM users WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows === 0) {
            $genMsg = sendResponse("error", "User not found");
        } else {
            $row = $result->fetch_assoc();
            $funds = filter_string($row['funds']);
            $level = $row['plantype'];

            // ✅ Check if user has any active investment
            $stmt = $link->prepare("SELECT COUNT(*) FROM user_investments WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($investmentCount);
            $stmt->fetch();
            $stmt->close();

            if ($investmentCount == 0) {
                $genMsg = sendResponse("error", "You have not made any investments");
            } else {
                // ✅ Basic wallet and balance validations
                if ($wallet == "activity" && $amount < $minActWithAmt) {
                    $genMsg = sendResponse("error", "Minimum withdrawal is ₦$minActWithAmt");
                } elseif ($wallet == "activity" && $amount > $funds) {
                    $genMsg = sendResponse("error", "Insufficient balance");
                } elseif ($wallet == "activity" && !$activityWithdraw) {
                    $genMsg = sendResponse("error", "Withdrawal is currently unavailable");
                } else {

                    // ✅ Check if user already has a pending withdrawal
                    $sql = $link->prepare("SELECT * FROM withdrawals WHERE username = ? AND status IN ('processing', 'pending')");
                    $sql->bind_param("s", $username);
                    $sql->execute();
                    $result = $sql->get_result();

                    if ($result->num_rows > 0) {
                        $genMsg = sendResponse("error", "You already have a pending withdrawal request");
                    } else {

                        // ✅ Check if user already withdrew today
                        $today = date('Y-m-d');
                        $sql = $link->prepare("SELECT * FROM withdrawals WHERE username = ? AND DATE(date) = ?");
                        $sql->bind_param("ss", $username, $today);
                        $sql->execute();
                        $result = $sql->get_result();

                        if ($result->num_rows > 0) {
                            $genMsg = sendResponse("error", "You can only make one withdrawal per day");
                        } else {

                            // ✅ Check if bank account is set up
                            $sql = $link->prepare("SELECT * FROM bankaccounts WHERE username = ?");
                            $sql->bind_param("s", $username);
                            $sql->execute();
                            $bankResult = $sql->get_result();

                            if ($bankResult->num_rows === 0) {
                                $genMsg = sendResponse("error", "You have not set up any bank account. Update your profile to withdraw");
                            } else {
                                $bank = $bankResult->fetch_assoc();
                                $acctName = $bank['acctname'];
                                $acctNum = $bank['acctnum'];

                                $reference = uniqid('ref_', true);
                                $dateTime = date("Y-m-d H:i:s");

                                // ✅ Insert withdrawal record
                                $sql = $link->prepare("INSERT INTO withdrawals (username, type, amount, description, countryname, reference, number, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
                                $sql->bind_param("ssdsssss", $username, $wallet, $amount, $acctName, $amountAfterCharge, $reference, $acctNum, $dateTime);

                                if ($sql->execute()) {
                                    // ✅ Deduct from user’s balance
                                    $update = $link->prepare("UPDATE users SET funds = funds - ? WHERE username = ?");
                                    $update->bind_param("ds", $amount, $username);
                                    $update->execute();

                                    $genMsg = sendResponse("success", "Successfully placed a withdrawal of ₦" . number_format($amount, 2));
                                } else {
                                    $genMsg = sendResponse("error", "Something went wrong, please try again later");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}






















if (isset($_POST['withdrawtodp'])) {
    if (empty($_POST['amount'])) {
        $status = "error";
        $message = "Enter an amount to transfer";
        $genMsg = sendResponse($status, $message);
    } else {
        $sql = $link->prepare("SELECT * FROM users WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        $totalrefearnings = $row['totalrefearnings'];

        if ($_POST['amount'] > $totalrefearnings) {
            $status = "error";
            $message = "Insufficient Withdraw balance";
            $genMsg = sendResponse($status, $message);
        } else {
            $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $sql = $link->prepare("UPDATE users SET totalrefearnings = totalrefearnings - ?, funds = funds + ? WHERE username = ?");
            $sql->bind_param("dds", $amount, $amount, $username);
            if ($sql->execute()) {
                $totalrefearnings -= $amount;
                $funds += $amount;

                $type = "Convert To Deposit";
                $time = date("H:i:s");
                $dateTime = date("Y-m-d");

                $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
                $sql->bind_param("ssdss", $username, $type, $amount, $time, $dateTime);
                $sql->execute();

                $status = "success";
                $message = "₦$amount Withdraw balance transferred to Deposit Balance";
                $genMsg = sendResponse($status, $message);
            } else {
                $status = "error";
                $message = "Something went wrong";
                $genMsg = sendResponse($status, $message);
            }
        }
    }
}


?>