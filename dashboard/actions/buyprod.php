<?php
$genMsg="";

if (isset($_POST['investin'])) {

    if (empty($_POST['reference'])) {

        $genMsg = sendResponse("error", "Reference is required");

    } else {

        $reference = filter_string($_POST['reference']);
        $username  = $_SESSION['username'];
        $planId    = (int)$_POST['id'];

        /* GET PLAN */
        $stmt = $link->prepare("SELECT * FROM investment_plans WHERE id=?");
        $stmt->bind_param("i", $planId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {

            $genMsg = sendResponse("error", "Invalid Product plan");

        } else {

            $plan = $result->fetch_assoc();

            $title    = $plan['title'];
            $price    = (float)$plan['price'];
            $daily    = (float)$plan['daily'];
            $level    = $plan['level'];
            $duration = (int)$plan['duration'];
            $image    = $plan['image'];

            $boughtAt = date('Y-m-d H:i:s');

            /* GET USER */
            $stmt = $link->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $userRes = $stmt->get_result();

            if ($userRes->num_rows === 0) {

                $genMsg = sendResponse("error", "User not found");

            } else {

                $user = $userRes->fetch_assoc();
                $funds = $user['funds'];
                $userCode = $user['code'];

                /* LEVEL CHECK */
                function userHasLevel($link,$username,$level){
                    $stmt = $link->prepare("SELECT id FROM user_investments 
                        WHERE username=? AND level=? AND status='active' LIMIT 1");
                    $stmt->bind_param("ss",$username,$level);
                    $stmt->execute();
                    return $stmt->get_result()->num_rows > 0;
                }

                if ($level === "quadro" && !userHasLevel($link,$username,"basic")) {

                    $genMsg = sendResponse("error","You must buy AIM plan before AIM-VIP");

                } elseif ($level === "plant" && !userHasLevel($link,$username,"quadro")) {

                    $genMsg = sendResponse("error","You must buy AIM-VIP before AIM-PRO");

                } else {

                    if ($price > $funds) {

                        $genMsg = sendResponse("error","Insufficient Deposit Balance");

                    } else {

                        $link->begin_transaction();

                        try {

                            /* Deduct funds */
                            $stmt = $link->prepare("UPDATE users SET funds=funds-? WHERE username=?");
                            $stmt->bind_param("ds",$price,$username);
                            $stmt->execute();

                            /* Insert investment */
                            $expirationDate = date('Y-m-d H:i:s', strtotime("+$duration days"));
                            $status = "active";

                            $stmt = $link->prepare("
                                INSERT INTO user_investments
                                (code,username,title,price,image,level,daily,duration,expiration_date,status,reference,date,last_credited)
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)
                            ");

                            $stmt->bind_param(
                                "sssdsisssssss",
                                $userCode,
                                $username,
                                $title,
                                $price,
                                $image,
                                $level,
                                $daily,
                                $duration,
                                $expirationDate,
                                $status,
                                $reference,
                                $boughtAt,
                                $boughtAt
                            );

                            $stmt->execute();

                            /* ================= REFERRAL SYSTEM ================= */

                            $stmt = $link->prepare("SELECT COUNT(*) as total FROM user_investments WHERE username = ?");
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $data = $res->fetch_assoc();

                            $isFirstInvestment = ($data['total'] == 1);

                            if ($isFirstInvestment) {

                                /* TEAM 1 */
                                $stmt = $link->prepare("SELECT refcode FROM referrals WHERE code = ?");
                                $stmt->bind_param("s", $userCode);
                                $stmt->execute();
                                $res = $stmt->get_result();

                                if ($res->num_rows > 0) {

                                    $team1_refcode = $res->fetch_assoc()['refcode'];

                                    if (!empty($team1_refcode)) {

                                        $team1_bonus = $price * 0.10;

                                        $stmt = $link->prepare("SELECT username FROM users WHERE code = ?");
                                        $stmt->bind_param("s", $team1_refcode);
                                        $stmt->execute();
                                        $res = $stmt->get_result();

                                        if ($res->num_rows > 0) {

                                            $team1_username = $res->fetch_assoc()['username'];

                                            $stmt = $link->prepare("
                                                UPDATE users 
                                                SET referralfunds = referralfunds + ?, score = score + ?, funds = funds + ? 
                                                WHERE username = ?
                                            ");
                                            $stmt->bind_param("ddds", $team1_bonus, $team1_bonus, $team1_bonus, $team1_username);
                                            $stmt->execute();

                                            $type = "Referral Bonus";
                                            $stmt = $link->prepare("
                                                INSERT INTO userearnings (username, type, amount, time, date)
                                                VALUES (?, ?, ?, ?, ?)
                                            ");
                                            $stmt->bind_param("ssdss",$team1_username,$type,$team1_bonus,$boughtAt,$boughtAt);
                                            $stmt->execute();

                                            /* TEAM 2 */
                                            $stmt = $link->prepare("SELECT refcode FROM referrals WHERE code = ?");
                                            $stmt->bind_param("s", $team1_refcode);
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            if ($res->num_rows > 0) {

                                                $team2_refcode = $res->fetch_assoc()['refcode'];
                                                $team2_bonus = $price * 0.01;

                                                if (!empty($team2_refcode)) {

                                                    $stmt = $link->prepare("SELECT username FROM users WHERE code = ?");
                                                    $stmt->bind_param("s", $team2_refcode);
                                                    $stmt->execute();
                                                    $res = $stmt->get_result();

                                                    if ($res->num_rows > 0) {

                                                        $team2_username = $res->fetch_assoc()['username'];

                                                        $stmt = $link->prepare("
                                                            UPDATE users 
                                                            SET referralfunds = referralfunds + ?, score = score + ?, funds = funds + ? 
                                                            WHERE username = ?
                                                        ");
                                                        $stmt->bind_param("ddds", $team2_bonus, $team2_bonus, $team2_bonus, $team2_username);
                                                        $stmt->execute();

                                                        $type = "Referral Commission 2nd Level";
                                                        $stmt = $link->prepare("
                                                            INSERT INTO userearnings (username, type, amount, time, date)
                                                            VALUES (?, ?, ?, ?, ?)
                                                        ");
                                                        $stmt->bind_param("ssdss",$team2_username,$type,$team2_bonus,$boughtAt,$boughtAt);
                                                        $stmt->execute();

                                                        /* TEAM 3 */
                                                        $stmt = $link->prepare("SELECT refcode FROM referrals WHERE code = ?");
                                                        $stmt->bind_param("s", $team2_refcode);
                                                        $stmt->execute();
                                                        $res = $stmt->get_result();

                                                        if ($res->num_rows > 0) {

                                                            $team3_refcode = $res->fetch_assoc()['refcode'];
                                                            $team3_bonus = $price * 0.00;

                                                            if (!empty($team3_refcode)) {

                                                                $stmt = $link->prepare("SELECT username FROM users WHERE code = ?");
                                                                $stmt->bind_param("s", $team3_refcode);
                                                                $stmt->execute();
                                                                $res = $stmt->get_result();

                                                                if ($res->num_rows > 0) {

                                                                    $team3_username = $res->fetch_assoc()['username'];

                                                                    $stmt = $link->prepare("
                                                                        UPDATE users 
                                                                        SET referralfunds = referralfunds + ?, score = score + ?, funds = funds + ? 
                                                                        WHERE username = ?
                                                                    ");
                                                                    $stmt->bind_param("ddds", $team3_bonus, $team3_bonus, $team3_bonus, $team3_username);
                                                                    $stmt->execute();

                                                                    $type = "Referral Commission 3rd Level";
                                                                    $stmt = $link->prepare("
                                                                        INSERT INTO userearnings (username, type, amount, time, date)
                                                                        VALUES (?, ?, ?, ?, ?)
                                                                    ");
                                                                    $stmt->bind_param("ssdss",$team3_username,$type,$team3_bonus,$boughtAt,$boughtAt);
                                                                    $stmt->execute();
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            /* COMMIT */
                            $link->commit();

                            $genMsg = sendResponse("success","Product successfully purchased");

                        } catch (Exception $e) {

                            $link->rollback();

                            $genMsg = sendResponse("error","Error processing Product");
                        }
                    }
                }
            }
        }
    }
}

/* ---------------- HELPER FUNCTIONS ---------------- */

// Skip weekends when adding credit time
function getNextWorkingCreditTime($lastCredited)
{
    $next = new DateTime($lastCredited);
    $next->modify('+24 hours');

    // 6 = Saturday, 0 = Sunday
    while (in_array($next->format('w'), [0, 6])) {
        $next->modify('+1 day');
    }

    return $next->format('Y-m-d H:i:s');
}

// Add only working days to duration
function addWorkingDays($startDate, $days)
{
    $date = new DateTime($startDate);
    $added = 0;

    while ($added < $days) {
        $date->modify('+1 day');

        // skip Saturday & Sunday
        if (!in_array($date->format('w'), [0,6])) {
            $added++;
        }
    }

    return $date->format('Y-m-d H:i:s');
}


/* ---------------- FETCH INVESTMENTS ---------------- */

$sql = "SELECT * FROM user_investments WHERE status='active'";
$result = $link->query($sql);

$creditedUsers = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $daily         = $row['daily'];
        $boughtAt      = $row['date'];
        $duration      = $row['duration'];
        $investorname  = $row['username'];
        $lastCredited  = $row['last_credited'];

        // prevent multiple credits per run
        if (in_array($investorname, $creditedUsers)) {
            continue;
        }

        /* -------- CHECK EXPIRATION (WORKING DAYS ONLY) -------- */

        $expirationDate = addWorkingDays($boughtAt, $duration);

        if (new DateTime() >= new DateTime($expirationDate)) {

            $link->begin_transaction();
            try {

                $sql = $link->prepare("UPDATE user_investments SET status='expired' WHERE username=? AND date=?");
                $sql->bind_param("ss", $investorname, $boughtAt);
                $sql->execute();

                $link->commit();

            } catch (Exception $e) {
                $link->rollback();
                throw $e;
            }

        } else {

            /* -------- CREDIT ONLY ON WORKING DAYS -------- */

            $nextCreditTime = getNextWorkingCreditTime($lastCredited);

            if (new DateTime() >= new DateTime($nextCreditTime)) {

                $link->begin_transaction();

                try {

                    // Add balance
                    $sql = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
                    $sql->bind_param("ds", $daily, $investorname);
                    $sql->execute();

                    // Update last credited
                    $currentDateTime = date('Y-m-d H:i:s');

                    $sql = $link->prepare("UPDATE user_investments SET last_credited=? WHERE username=? AND date=?");
                    $sql->bind_param("sss", $currentDateTime, $investorname, $boughtAt);
                    $sql->execute();

                    // Insert earning log
                    $type = "Daily Earning";
                    $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
                    $sql->bind_param("sssss", $investorname, $type, $daily, $currentDateTime, $currentDateTime);
                    $sql->execute();

                    $link->commit();

                    $creditedUsers[] = $investorname;

                } catch (Exception $e) {
                    $link->rollback();
                    throw $e;
                }
            }
        }
    }
}


?>