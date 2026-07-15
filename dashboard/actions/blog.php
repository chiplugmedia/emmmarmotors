<?php
$genMsg="";
$postTypeCheck = 'lovevault';

// ─────────────────────────────────────────────
// GET USER PLAN + BONUS AMOUNT
// ─────────────────────────────────────────────
$sql = $link->prepare("SELECT plantype FROM users WHERE username = ?");
$sql->bind_param('s', $username);
$sql->execute();
$result = $sql->get_result();

$acctPlan = "";

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $acctPlan = $row['plantype'];
}

$bonuses = getPlanBonuses($acctPlan);
$audioPostAmt = $bonuses['lovevault'] ?? 0;


// ─────────────────────────────────────────────
// HANDLE FORM SUBMISSION
// ─────────────────────────────────────────────
if (isset($_POST['addTasks'])) {

    if (empty($_POST['reference'])) {

        $genMsg = sendResponse("error", "Something went wrong 001");

    } else {

        $reference = filter_string($_POST['reference']);

        // ─────────────────────────────────────────────
        // FETCH USER STATUS
        // ─────────────────────────────────────────────
        $sql = $link->prepare("SELECT unlocked FROM users WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $userStatusRow = $sql->get_result()->fetch_assoc();

        $isUnlocked = (int)($userStatusRow['unlocked'] ?? 0);

        // ── BLOCK: spinWheel restriction ──
        if ($spinWheel == "1" && $isUnlocked == 0) {

            $genMsg = sendResponse("error", "Unlock Package to access more limit");

        } else {

            // ─────────────────────────────────────────────
            // CHECK USER ALREADY DID TASK
            // ─────────────────────────────────────────────
            $stmt = $link->prepare("
                SELECT id 
                FROM usersponsored 
                WHERE username = ? AND reference = ? AND type = ?
            ");
            $stmt->bind_param("sss", $username, $reference, $postTypeCheck);
            $stmt->execute();
            $numUserTasks = $stmt->get_result()->num_rows;

            // ─────────────────────────────────────────────
            // CHECK TASK EXISTS
            // ─────────────────────────────────────────────
            $stmt = $link->prepare("
                SELECT id, title 
                FROM sponsoredpost 
                WHERE reference = ? AND type = ?
            ");
            $stmt->bind_param("ss", $reference, $postTypeCheck);
            $stmt->execute();
            $taskResult = $stmt->get_result();

            if ($numUserTasks > 0) {

                $genMsg = sendResponse("error", "You have already performed this Love Vault.");

            } elseif ($taskResult->num_rows == 0) {

                $genMsg = sendResponse("error", "Invalid Love Vault.");

            } else {

                // ── GET TASK DATA ──
                $taskRow = $taskResult->fetch_assoc();
                $title   = $taskRow['title'];

                // ─────────────────────────────────────────────
                // INSERT USER TASK
                // ─────────────────────────────────────────────
                $sql = $link->prepare("
                    INSERT INTO usersponsored 
                    (username, title, amount, date, type, reference)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $sql->bind_param(
                    "ssdsss",
                    $username,
                    $title,
                    $audioPostAmt,
                    $dateTime,
                    $postTypeCheck,
                    $reference
                );

                if ($sql->execute()) {

                    // ── ADD FUNDS ──
                    $sql = $link->prepare("
                        UPDATE users 
                        SET funds = funds + ? 
                        WHERE username = ?
                    ");
                    $sql->bind_param("ds", $audioPostAmt, $username);
                    $sql->execute();

                    // Click limit reduction code REMOVED

                    // ── LOG EARNINGS ──
                    $typenox = "Love Vault";
                    $sql = $link->prepare("
                        INSERT INTO userearnings 
                        (username, type, amount, time, date)
                        VALUES (?, ?, ?, ?, ?)
                    ");
                    $sql->bind_param("ssdss", $username, $typenox, $audioPostAmt, $time, $dateTime);
                    $sql->execute();

                    $genMsg = sendResponse("success", "Love Vault completed successfully.");

                } else {

                    $genMsg = sendResponse("error", "Something went wrong");
                }
            }
        }
    }
}
?>