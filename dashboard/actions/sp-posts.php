<?php
$genMsg = "";

// ─────────────────────────────────────────────
// GET TODAY'S SPONSORED POST
// ─────────────────────────────────────────────
$postTypeCheck = 'sppost';

$sql = $link->prepare("SELECT * FROM sponsoredpost WHERE SUBSTRING(date, 1, 10) = ? AND type = ?");
$sql->bind_param("ss", $date, $postTypeCheck);
$sql->execute();
$result      = $sql->get_result();
$numrow_task = $result->num_rows;
$row         = $result->fetch_assoc();

// Initialize variables
$title = $image = $desc = $profileLink = $url = $desurl = "";
$amount = 0;

// ─────────────────────────────────────────────
// IF TASK EXISTS FOR TODAY
// ─────────────────────────────────────────────
if ($numrow_task > 0) {

    $title = $row['title'];
    $desc  = $row['description'];
    $image = $row['image'];

    // ── Fetch user plan (for reward calculation) ──
    $sql = $link->prepare("SELECT plantype FROM users WHERE username = ?");
    $sql->bind_param('s', $username);
    $sql->execute();
    $result = $sql->get_result();

    $acctPlan = "";
    if ($result->num_rows == 1) {
        $rowPlan  = $result->fetch_assoc();
        $acctPlan = $rowPlan['plantype'];
    }

    // ── Get sponsored post bonus based on plan ──
    $bonuses = getPlanBonuses($acctPlan);
    $amount  = $bonuses['spamt'];

    // ── Fetch user's profile link for sharing ──
    $sql = $link->prepare("SELECT url FROM profilelinks WHERE username = ? AND type = ?");
    $sql->bind_param("ss", $username, $postTypeCheck);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $profileLink = $result->fetch_assoc()['url'];
    }

} else {

    // ─────────────────────────────────────────────
    // NO TASK AVAILABLE TODAY
    // ─────────────────────────────────────────────
    $title  = "No daily task available yet";
    $amount = 0;
    $desc   = "There is no task available at the moment, check back later";
}

// ─────────────────────────────────────────────
// CHECK IF USER ALREADY COMPLETED TODAY'S TASK
// ─────────────────────────────────────────────
$sql = $link->prepare("SELECT * FROM usersponsored WHERE SUBSTRING(date,1,10)=? AND username=? AND type=?");
$sql->bind_param("sss", $date, $username, $postTypeCheck);
$sql->execute();
$numrow_userTask = $sql->get_result()->num_rows;

if ($numrow_userTask > 0) {
    $desc = "You have already performed today's Status Task. Try again tomorrow.";
}

// ─────────────────────────────────────────────
// HANDLE TASK SUBMISSION
// ─────────────────────────────────────────────
if (isset($_POST['addTasks'])) {

    // ── BLOCK: already completed today ──
    if ($numrow_userTask > 0) {

        $genMsg = sendResponse("error", "You have already performed this Status Task.");

    }
    // ── BLOCK: no task exists ──
    else if ($numrow_task == 0) {

        $genMsg = sendResponse("error", "Status Task not found.");

    } else {

        // ─────────────────────────────────────────────
        // FETCH USER STATUS (unlock only)
        // ─────────────────────────────────────────────
        $sql = $link->prepare("SELECT unlocked FROM users WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $userStatusRow = $sql->get_result()->fetch_assoc();

        $isUnlocked = (int)($userStatusRow['unlocked'] ?? 0);

        // ── BLOCK: restricted spinWheel users ──
        if ($spinWheel == "1" && $isUnlocked == 0) {

            $genMsg = sendResponse("error", "Unlock Package to access more limit");

        } else {

            // ─────────────────────────────────────────────
// FETCH LATEST POST CONTENT FOR SHARING
// ─────────────────────────────────────────────
$sql = $link->prepare("SELECT image, description FROM sponsoredpost WHERE type=? AND DATE(date)=?");
$sql->bind_param("ss", $postTypeCheck, $date);
$sql->execute();
$result  = $sql->get_result();
$postRow = $result->fetch_assoc();

// ✅ Raw values
$imageURL    = $postRow['image'];
$description = $postRow['description'];

// ✅ Referral link
$referralLink = "https://romixachat.com/register?code=$code";

// ─────────────────────────────────────────────
// BUILD WHATSAPP SHARE MESSAGE (IMAGE + TEXT)
// ─────────────────────────────────────────────
$shareMessage = 
    "🔥 " . $description . "\n\n" .
    "🚀 Join & Earn: " . $referralLink;

// ✅ Encode once (VERY IMPORTANT)
$whatsappShareURL = "https://wa.me/?text=" . urlencode($shareMessage);

            // ─────────────────────────────────────────────
            // INSERT USER COMPLETED TASK
            // ─────────────────────────────────────────────
            $sql = $link->prepare("
                INSERT INTO usersponsored(username, title, amount, date, type)
                VALUES(?,?,?,?,?)
            ");
            $sql->bind_param("sssss", $username, $title, $amount, $dateTime, $postTypeCheck);

            if ($sql->execute()) {

                // ── UPDATE USER FUNDS ──
                $sql = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
                $sql->bind_param("ds", $amount, $username);
                $sql->execute();

                // ── LOG USER EARNINGS ──
                $type = "Status Task";
                $sql = $link->prepare("
                    INSERT INTO userearnings(username, type, amount, time, date)
                    VALUES(?,?,?,?,?)
                ");
                $sql->bind_param("ssdss", $username, $type, $amount, $time, $dateTime);
                $sql->execute();

                // Click limit reduction code REMOVED

                $genMsg = sendResponse("success", "Status Task completed successfully!");

                // ── REDIRECT TO WHATSAPP SHARE ──
                header("Location: $whatsappShareURL");
                exit();

            } else {

                $genMsg = sendResponse("error", "Something went wrong.");
            }
        }
    }
}
?>
