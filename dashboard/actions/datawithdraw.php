<?php
$genMsg="";

if (isset($_POST['investin'])) {
    if (empty($_POST['reference'])) {
        $genMsg = sendResponse("error", "Reference is required");
    } else {
        $reference = filter_string($_POST['reference']);
        $username = $_SESSION['username'];

        // Check if user has already purchased the package and if it's still active
        $sql = $link->prepare("SELECT * FROM user_investments WHERE username=? AND reference=? AND status='active'");
        $sql->bind_param("ss", $username, $reference);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $genMsg = sendResponse("error", "YOU ARE ALREADY ON THIS PLAN");
        } else {
            // Get investment plan details
            $planId = (int)$_POST['id'];
            $sql = $link->prepare("SELECT * FROM investment_plans WHERE id=?");
            $sql->bind_param("i", $planId);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $title = $row['title'];
                $price = $row['price'];
                $level = $row['level'];
                $daily = $row['daily'];
                $duration = $row['duration'];
                $image = $row['image'];
                $boughtAt = date('Y-m-d H:i:s');
                
                $proceedWithInvestment = false;
                $errorMsg = "";
                
                // Check package level requirements
                if ($level == "MOB5") {
                    // Count user's direct referrals
                    $sql = $link->prepare("SELECT COUNT(*) as referral_count FROM referrals WHERE referral = ?");
                    $sql->bind_param("s", $username);
                    $sql->execute();
                    $countResult = $sql->get_result();
                    $countData = $countResult->fetch_assoc();
                    
                    if ($countData['referral_count'] >= 3) {
                        $proceedWithInvestment = true;
                    } else {
                        $errorMsg = "Unlock with 3 referrals";
                    }
                } elseif ($level == "MOB6") {
                    // For MOB4, user must:
                    // 1. Have at least 4 direct referrals
                    // 2. Have at least 1 referral who has invested in MOB1
                    // 3. Be an active MOB2 member
                    
                    // Count user's direct referrals
                    $sql = $link->prepare("SELECT COUNT(*) as referral_count FROM referrals WHERE referral = ?");
                    $sql->bind_param("s", $username);
                    $sql->execute();
                    $countResult = $sql->get_result();
                    $countData = $countResult->fetch_assoc();
                    
                    if ($countData['referral_count'] < 4) {
                        $errorMsg = "Unlock as Mob 2 member with 3 fresh Mob 1 referra";
                    } else {
                        // Check if at least 1 referral has MOB1 investment
                        $sql = $link->prepare("SELECT COUNT(*) as mob1_referrals 
                                             FROM user_investments ui
                                             JOIN referrals r ON ui.username = r.username
                                             WHERE r.referral = ? AND ui.level = 'MOB1' AND ui.status = 'active'");
                        $sql->bind_param("s", $username);
                        $sql->execute();
                        $mob1Result = $sql->get_result();
                        $mob1Data = $mob1Result->fetch_assoc();
                        
                        if ($mob1Data['mob1_referrals'] < 1) {
                            $errorMsg = "You need at least 1 referral who has an active MOB1 investment to invest in MOB4 package";
                        } else {
                            // Check if user is MOB2 member
                            $sql = $link->prepare("SELECT COUNT(*) as mob2_member 
                                                 FROM user_investments 
                                                 WHERE username = ? AND level = 'MOB2' AND status = 'active'");
                            $sql->bind_param("s", $username);
                            $sql->execute();
                            $mob2Result = $sql->get_result();
                            $mob2Data = $mob2Result->fetch_assoc();
                            
                            if ($mob2Data['mob2_member'] < 1) {
                                $errorMsg = "You need to be an active MOB2 member to invest in MOB4 package";
                            } else {
                                $proceedWithInvestment = true;
                            }
                        }
                    }
                } else {
                    // For other levels (not MOB3 or MOB4), proceed normally
                    $proceedWithInvestment = true;
                }

                if (!$proceedWithInvestment) {
                    $genMsg = sendResponse("error", $errorMsg);
                } else {
                    // Fetch user details
                    $sql = $link->prepare("SELECT * FROM users WHERE username=?");
                    $sql->bind_param("s", $username);
                    $sql->execute();
                    $result = $sql->get_result();

                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        $funds = $user['funds'];

                        if ($price > $funds) {
                            $genMsg = sendResponse("error", "Insufficient Deposit Balance");
                        } else {
                            // Start transaction for atomicity
                            $link->begin_transaction();

                            try {
                                // Update user funds
                                $updateFundsSql = $link->prepare("UPDATE users SET funds = funds - ? WHERE username = ?");
                                $updateFundsSql->bind_param("ds", $price, $username);
                                $updateFundsSql->execute();

                                // Insert new investment
                                $newStatus = "active";
                                $expirationDate = date('Y-m-d H:i:s', strtotime("$boughtAt + $duration days"));
                                $insertInvestmentSql = $link->prepare("INSERT INTO user_investments (username, title, price, image, level, daily, duration, expiration_date, status, reference, date, last_credited) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $insertInvestmentSql->bind_param("ssssssssssss", $username, $title, $price, $image, $level, $daily, $duration, $expirationDate, $newStatus, $reference, $boughtAt, $boughtAt);
                                $insertInvestmentSql->execute();

                                // Direct Referral (Team 1)
                                $sql = $link->prepare("SELECT referral FROM referrals WHERE username = ?");
                                $sql->bind_param("s", $username);
                                $sql->execute();
                                $result = $sql->get_result();

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $team1_ref = $row['referral']; // Team 1 (Direct Upline)

                                    if ($price > 0) {
                                        $team1_bonus = $price * 0.10; // 10% of invested price

                                        // Credit Team 1
                                        $sql = $link->prepare("UPDATE users SET referralfunds = referralfunds + ?, score = score + ?, totalrefearnings = totalrefearnings + ? WHERE username = ?");
                                        $sql->bind_param("ddds", $team1_bonus, $team1_bonus, $team1_bonus, $team1_ref);
                                        $sql->execute();

                                        // Record earnings
                                        $type = "Referral Bonus - Level 1";
                                        $sql = $link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?,?,?,?,?)");
                                        $sql->bind_param("ssdss", $team1_ref, $type, $team1_bonus, $time, $dateTime);
                                        $sql->execute();
                                    }

                                    // Get Team 2 (Upline of Team 1)
                                    $sql = $link->prepare("SELECT referral FROM referrals WHERE username = ?");
                                    $sql->bind_param("s", $team1_ref);
                                    $sql->execute();
                                    $result = $sql->get_result();

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $team2_ref = $row['referral']; // Team 2

                                        if (!empty($team2_ref)) {
                                            $team2_bonus = $price * 0; // 0% of invested price

                                            // Credit Team 2
                                            $sql = $link->prepare("UPDATE users SET referralfunds = referralfunds + ?, score = score + ?, totalrefearnings = totalrefearnings + ? WHERE username = ?");
                                            $sql->bind_param("ddds", $team2_bonus, $team2_bonus, $team2_bonus, $team2_ref);
                                            $sql->execute();

                                            // Record earnings
                                            $type = "Referral Bonus - Level 2";
                                            $sql = $link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?,?,?,?,?)");
                                            $sql->bind_param("ssdss", $team2_ref, $type, $team2_bonus, $time, $dateTime);
                                            $sql->execute();
                                        }

                                        // Get Team 3 (Upline of Team 2)
                                        $sql = $link->prepare("SELECT referral FROM referrals WHERE username = ?");
                                        $sql->bind_param("s", $team2_ref);
                                        $sql->execute();
                                        $result = $sql->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $team3_ref = $row['referral']; // Team 3

                                            if (!empty($team3_ref)) {
                                                $team3_bonus = $price * 0; // 0% of invested price

                                                // Credit Team 3
                                                $sql = $link->prepare("UPDATE users SET referralfunds = referralfunds + ?, score = score + ?, totalrefearnings = totalrefearnings + ? WHERE username = ?");
                                                $sql->bind_param("ddds", $team3_bonus, $team3_bonus, $team3_bonus, $team3_ref);
                                                $sql->execute();

                                                // Record earnings
                                                $type = "Referral Bonus - Level 3";
                                                $sql = $link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?,?,?,?,?)");
                                                $sql->bind_param("ssdss", $team3_ref, $type, $team3_bonus, $time, $dateTime);
                                                $sql->execute();
                                            }
                                        }
                                    }
                                }

                                $genMsg = sendResponse("success", "Investment successfully purchased");
                                $link->commit(); // Commit transaction
                            } catch (Exception $e) {
                                $genMsg = sendResponse("error", "Error processing investment");
                                $link->rollback(); // Rollback changes
                            }
                        }
                    } else {
                        $genMsg = sendResponse("error", "User not found");
                    }
                }
            } else {
                $genMsg = sendResponse("error", "Invalid investment plan");
            }
        }
    }
}


// Outside the main purchase logic, check for active investments and credit daily income
$sql = "SELECT * FROM user_investments WHERE status='active'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $daily = $row['daily'];
        $boughtAt = $row['date'];
        $duration = $row['duration'];
        $investorname = $row['username'];
        $lastCredited = $row['last_credited']; // Assume we have a last_credited column

        // Check if the investment has expired based on duration
        $expirationDate = date('Y-m-d H:i:s', strtotime("$boughtAt + $duration days"));
        if (new DateTime() >= new DateTime($expirationDate)) {
            // Start transaction
            $link->begin_transaction();

            try {
                // Set investment status to expired
                $sql = $link->prepare("UPDATE user_investments SET status='expired' WHERE username=? AND date=?");
                $sql->bind_param("ss", $investorname, $boughtAt);
                $sql->execute();

                // Commit transaction
                $link->commit();
            } catch (Exception $e) {
                // Rollback transaction if something went wrong
                $link->rollback();
                throw $e;
            }
        } else {
            // Check if 24 hours have passed since the last credit
            $nextCreditTime = date('Y-m-d H:i:s', strtotime("$lastCredited + 24 hours"));
            if (new DateTime() >= new DateTime($nextCreditTime)) {
                // Start transaction
                $link->begin_transaction();

                try {
                    // Credit daily income to the user's funds
                    $sql = $link->prepare("UPDATE users SET totalrefearnings = totalrefearnings + ? WHERE username = ?");
                    $sql->bind_param("ds", $daily, $investorname);
                    $sql->execute();

                    // Update the last credited time
                    $currentDateTime = date('Y-m-d H:i:s');
                    $sql = $link->prepare("UPDATE user_investments SET last_credited=? WHERE username=? AND date=?");
                    $sql->bind_param("sss", $currentDateTime, $investorname, $boughtAt);
                    $sql->execute();

                    // Log the user's earnings
                    $type = "Daily Income";
                    $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
                    $sql->bind_param("sssss", $investorname, $type, $daily, $currentDateTime, $currentDateTime);
                    $sql->execute();

                    // Commit transaction
                    $link->commit();
                } catch (Exception $e) {
                    // Rollback transaction if something went wrong
                    $link->rollback();
                    throw $e;
                }
            }
        }
    }
}

// // Outside the main purchase logic, check for active investments and credit daily income
// $sql = "SELECT * FROM user_investments WHERE status='active'";
// $result = $link->query($sql);

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $daily = $row['daily'];
//         $boughtAt = $row['date'];
//         $duration = $row['duration'];
//         $investorname = $row['username'];
//         $lastCredited = $row['last_credited']; // Assume we have a last_credited column
//         $claimable = $row['claimable']; // New column to check if income is claimable

//         // Check if the investment has expired based on duration
//         $expirationDate = date('Y-m-d H:i:s', strtotime("$boughtAt + $duration days"));
//         if (new DateTime() >= new DateTime($expirationDate)) {
//             // Start transaction
//             $link->begin_transaction();

//             try {
//                 // Set investment status to expired
//                 $sql = $link->prepare("UPDATE user_investments SET status='expired' WHERE username=? AND date=?");
//                 $sql->bind_param("ss", $investorname, $boughtAt);
//                 $sql->execute();

//                 // Commit transaction
//                 $link->commit();
//             } catch (Exception $e) {
//                 // Rollback transaction if something went wrong
//                 $link->rollback();
//                 throw $e;
//             }
//         } else {
//             // Check if 24 hours have passed since the last credit
//             $nextCreditTime = date('Y-m-d H:i:s', strtotime("$lastCredited + 24 hours"));
//             if (new DateTime() >= new DateTime($nextCreditTime)) {
//                 // Set income as claimable
//                 $currentDateTime = date('Y-m-d H:i:s');
//                 $sql = $link->prepare("UPDATE user_investments SET claimable=? WHERE username=? AND date=?");
//                 $sql->bind_param("sss", $currentDateTime, $investorname, $boughtAt);
//                 $sql->execute();
//             }
//         }
//     }
// }




// if (isset($_POST['claiming'])) {
//     if (empty($_POST['reference'])) {
//         $genMsg = sendResponse("error", "Reference is required");
//     } else {
//         $reference = filter_string($_POST['reference']);
//         $username = $_SESSION['username']; // Assuming username is stored in session

//         // Fetch the investment details
//         $sql = "SELECT * FROM user_investments WHERE reference=? AND username=? AND status='active'";
//         $stmt = $link->prepare($sql);
//         $stmt->bind_param("ss", $reference, $username);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $row = $result->fetch_assoc();

//         if ($row) {
//             $daily = $row['daily'];
//             $currentDateTime = date('Y-m-d H:i:s');

//             // Start transaction
//             $link->begin_transaction();

//             try {
//                 // Credit daily income to the user's funds
//                 $sql = $link->prepare("UPDATE users SET totalrefearnings = totalrefearnings + ? WHERE username = ?");
//                 $sql->bind_param("ds", $daily, $username);
//                 $sql->execute();

//                 // Update the last credited time and reset claimable
//                 $sql = $link->prepare("UPDATE user_investments SET last_credited=?, claimable=NULL WHERE reference=?");
//                 $sql->bind_param("ss", $currentDateTime, $reference);
//                 $sql->execute();

//                 // Log the user's earnings
//                 $type = "Daily Income";
//                 $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
//                 $sql->bind_param("ssdss", $username, $type, $daily, $currentDateTime, $currentDateTime);
//                 $sql->execute();

//                 // Commit transaction
//                 $link->commit();

//                 // Send success response
//                 $status = "success";
//                 $message = "Income claimed successfully!";
//                 $genMsg = sendResponse($status, $message);
//             } catch (Exception $e) {
//                 // Rollback transaction in case of error
//                 $link->rollback();

//                 $status = "error";
//                 $message = "Failed to claim income: " . $e->getMessage();
//                 $genMsg = sendResponse($status, $message);
//             }
//         } else {
//             // Send error response if investment is not found
//             $status = "error";
//             $message = "Invalid investment or investment not active.";
//             $genMsg = sendResponse($status, $message);
//         }
//     }
// }



?>
