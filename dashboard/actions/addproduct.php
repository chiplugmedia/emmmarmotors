<?php
session_start();

// ─────────────────────────────
// DATABASE CONNECTION (PROCEDURAL)
// ─────────────────────────────
$link = mysqli_connect("localhost", "jmxktkat_fivestar", "jmxktkat_fivestar", "jmxktkat_fivestar");

if (!$link) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed: ' . mysqli_connect_error()
    ]);
    exit;
}

// ─────────────────────────────
// TIME SETTINGS
// ─────────────────────────────
date_default_timezone_set("Africa/Lagos");
$dateTime = date('d-m-Y H:i:s');
$date = date('d-m-Y');
$time = time();

// ─────────────────────────────
// SITE SETTINGS
// ─────────────────────────────
$spinWheel = 0;

$sql = mysqli_prepare($link, "SELECT spinwheel FROM sitedetails LIMIT 1");
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $spinWheel = (int)$row['spinwheel'];
}

// ─────────────────────────────
// CONFIG
// ─────────────────────────────
define('MESSAGE_EARNING_RATE', 0.05);
define('MAX_MESSAGE_LENGTH', 1000);

// ─────────────────────────────
// AUTH CHECK
// ─────────────────────────────
if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login']);
    exit;
}

$currentUsername = $_SESSION['username'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ─────────────────────────────
// USER STATUS
// ─────────────────────────────
$stmt = mysqli_prepare($link, "SELECT unlocked FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $currentUsername);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$userStatusRow = mysqli_fetch_assoc($result);

$isUnlocked = (int)($userStatusRow['unlocked'] ?? 0);

// ─────────────────────────────
// ROUTER
// ─────────────────────────────
switch ($action) {

    case 'get_conversations':
        if ($spinWheel == 1 && $isUnlocked == 0) {
            echo json_encode(['status'=>'error','message'=>'Unlock Package to access more limit']);
            exit;
        }
        getConversations($link, $currentUsername);
        break;

    case 'get_messages':
        if ($spinWheel == 1 && $isUnlocked == 0) {
            echo json_encode(['status'=>'error','message'=>'Unlock Package to access more limit']);
            exit;
        }
        getMessages($link, $currentUsername, $_POST['conversation_id'] ?? 0);
        break;

    case 'send_message':
        if ($spinWheel == 1 && $isUnlocked == 0) {
            echo json_encode(['status'=>'error','message'=>'Unlock Package to send messages']);
            exit;
        }
        sendMessage($link, $currentUsername, $_POST['receiver_username'] ?? '', $_POST['message'] ?? '');
        break;

    case 'start_conversation':
        if ($spinWheel == 1 && $isUnlocked == 0) {
            echo json_encode(['status'=>'error','message'=>'Unlock Package to start conversations']);
            exit;
        }
        startConversation($link, $currentUsername, $_POST['receiver_username'] ?? '');
        break;

    case 'get_user_stats':
        getUserStats($link, $currentUsername, $spinWheel, $isUnlocked);
        break;

    case 'search_users':
        if ($spinWheel == 1 && $isUnlocked == 0) {
            echo json_encode(['status'=>'error','message'=>'Unlock Package to search users']);
            exit;
        }
        searchUsers($link, $currentUsername, $_GET['query'] ?? '');
        break;

    case 'check_unlock_status':
        echo json_encode([
            'status'=>'success',
            'spinWheel'=>$spinWheel,
            'isUnlocked'=>$isUnlocked,
            'message'=>($spinWheel == 1 && $isUnlocked == 0)
                ? 'Restricted mode - Please unlock package'
                : 'Full access granted'
        ]);
        exit;

    default:
        echo json_encode(['status'=>'error','message'=>'Invalid action']);
        exit;
}

// ─────────────────────────────
// FUNCTIONS
// ─────────────────────────────

function getConversations($link, $username) {

    $sql = "
        SELECT 
            c.id AS conversation_id,
            c.created_at,
            u.username AS other_username,
            u.image AS avatar_url,
            u.is_online,
            u.last_seen,
            (SELECT message FROM messages m WHERE m.conversation_id = c.id ORDER BY m.id DESC LIMIT 1) AS last_message,
            (SELECT created_at FROM messages m WHERE m.conversation_id = c.id ORDER BY m.id DESC LIMIT 1) AS last_message_time,
            (SELECT SUM(earned_amount) FROM messages m WHERE m.conversation_id = c.id AND m.sender_username = ?) AS earned_from_conversation,
            (SELECT COUNT(*) FROM messages m WHERE m.conversation_id = c.id AND m.receiver_username = ? AND m.is_read = 0) AS unread_count
        FROM conversations c
        JOIN users u ON u.username = CASE 
            WHEN c.user1_username = ? THEN c.user2_username
            ELSE c.user1_username
        END
        WHERE c.user1_username = ? OR c.user2_username = ?
        ORDER BY last_message_time DESC
    ";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $username, $username, $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode(['status'=>'success','conversations'=>$data]);
    exit;
}

function getMessages($link, $username, $conversationId) {

    $stmt = mysqli_prepare($link, "SELECT id FROM conversations WHERE id = ? AND (user1_username = ? OR user2_username = ?)");
    mysqli_stmt_bind_param($stmt, "iss", $conversationId, $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        echo json_encode(['status'=>'error','message'=>'Invalid conversation']);
        exit;
    }

    $update = mysqli_prepare($link, "UPDATE messages SET is_read = 1 WHERE conversation_id = ? AND receiver_username = ?");
    mysqli_stmt_bind_param($update, "is", $conversationId, $username);
    mysqli_stmt_execute($update);

    $stmt = mysqli_prepare($link, "
        SELECT m.*, u.image AS sender_avatar
        FROM messages m
        JOIN users u ON u.username = m.sender_username
        WHERE m.conversation_id = ?
        ORDER BY m.id ASC
        LIMIT 100
    ");

    mysqli_stmt_bind_param($stmt, "i", $conversationId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }

    echo json_encode(['status'=>'success','messages'=>$messages]);
    exit;
}

function sendMessage($link, $sender, $receiver, $message) {

    $message = trim($message);

    if ($message === '' || strlen($message) > MAX_MESSAGE_LENGTH) {
        echo json_encode(['status'=>'error','message'=>'Invalid message']);
        exit;
    }

    if ($sender === $receiver) {
        echo json_encode(['status'=>'error','message'=>'Cannot message yourself']);
        exit;
    }

    mysqli_begin_transaction($link);

    try {

        $stmt = mysqli_prepare($link, "SELECT username FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $receiver);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($res) == 0) {
            throw new Exception("User not found");
        }

        $stmt = mysqli_prepare($link, "
            SELECT id FROM conversations
            WHERE (user1_username = ? AND user2_username = ?)
               OR (user1_username = ? AND user2_username = ?)
        ");
        mysqli_stmt_bind_param($stmt, "ssss", $sender, $receiver, $receiver, $sender);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $conv = mysqli_fetch_assoc($res);

        if ($conv) {
            $conversationId = $conv['id'];
        } else {
            $stmt = mysqli_prepare($link, "INSERT INTO conversations (user1_username, user2_username) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $sender, $receiver);
            mysqli_stmt_execute($stmt);
            $conversationId = mysqli_insert_id($link);
        }

        $earned = MESSAGE_EARNING_RATE;

        $stmt = mysqli_prepare($link, "
            INSERT INTO messages (conversation_id, sender_username, receiver_username, message, earned_amount)
            VALUES (?, ?, ?, ?, ?)
        ");
        mysqli_stmt_bind_param($stmt, "isssd", $conversationId, $sender, $receiver, $message, $earned);
        mysqli_stmt_execute($stmt);

        mysqli_query($link, "
            UPDATE users SET 
            total_earned = COALESCE(total_earned,0) + $earned,
            available_balance = COALESCE(available_balance,0) + $earned,
            messages_sent = messages_sent + 1
            WHERE username = '$sender'
        ");

        mysqli_query($link, "
            UPDATE users SET 
            total_earned = COALESCE(total_earned,0) + $earned,
            available_balance = COALESCE(available_balance,0) + $earned,
            messages_received = messages_received + 1
            WHERE username = '$receiver'
        ");

        mysqli_commit($link);

        echo json_encode(['status'=>'success','earned'=>$earned,'conversation_id'=>$conversationId]);
        exit;

    } catch (Exception $e) {
        mysqli_rollback($link);
        echo json_encode(['status'=>'error','message'=>$e->getMessage()]);
        exit;
    }
}

function startConversation($link, $user, $other) {

    $stmt = mysqli_prepare($link, "
        SELECT id FROM conversations
        WHERE (user1_username = ? AND user2_username = ?)
           OR (user1_username = ? AND user2_username = ?)
    ");

    mysqli_stmt_bind_param($stmt, "ssss", $user, $other, $other, $user);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($res)) {
        echo json_encode(['status'=>'success','conversation_id'=>$row['id']]);
        exit;
    }

    $stmt = mysqli_prepare($link, "INSERT INTO conversations (user1_username, user2_username) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $user, $other);
    mysqli_stmt_execute($stmt);

    echo json_encode(['status'=>'success','conversation_id'=>mysqli_insert_id($link)]);
    exit;
}

function getUserStats($link, $username, $spinWheel, $isUnlocked) {

    $stmt = mysqli_prepare($link, "
        SELECT 
            username,
            total_earned,
            available_balance,
            messages_sent,
            messages_received,
            (SELECT COUNT(*) FROM conversations WHERE user1_username = ? OR user2_username = ?) AS active_conversations
        FROM users
        WHERE username = ?
    ");

    mysqli_stmt_bind_param($stmt, "sss", $username, $username, $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    $stats = mysqli_fetch_assoc($res);

    $stats['is_restricted'] = ($spinWheel == 1 && $isUnlocked == 0);
    $stats['spinWheel'] = $spinWheel;
    $stats['isUnlocked'] = $isUnlocked;

    echo json_encode(['status'=>'success','stats'=>$stats]);
    exit;
}

function searchUsers($link, $current, $query) {

    if (strlen($query) < 2) {
        echo json_encode(['status'=>'error','message'=>'Too short']);
        exit;
    }

    $like = "%$query%";

    $stmt = mysqli_prepare($link, "
    SELECT username, image AS avatar_url, is_online, last_seen,
    EXISTS (
        SELECT 1 FROM conversations 
        WHERE (user1_username = ? AND user2_username = users.username)
           OR (user1_username = users.username AND user2_username = ?)
    ) AS has_conversation
    FROM users
    WHERE username != ? 
    AND role = 'user'
    AND username LIKE ?
    LIMIT 20
");

// Then bind the parameters correctly (4 parameters)
mysqli_stmt_bind_param($stmt, "ssss", $current, $current, $current, $like);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    $users = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $users[] = $row;
    }

    echo json_encode(['status'=>'success','users'=>$users]);
    exit;
}
?>