<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function generateTransactionID($length = 8) {
    return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}

/* =========================
   DATABASE CONNECTION
========================= */
$link = new mysqli(
    "localhost",
    "chiplug_nvidia",
    "chiplug_nvidia",
    "chiplug_nvidia"
);

$logFile = __DIR__ . "/webhook_log.txt";
$dateTime = date("Y-m-d H:i:s");

/* =========================
   LOG FUNCTION
========================= */
function writeLog($message)
{
    global $logFile, $time;

    file_put_contents(
        $logFile,
        "[$time] $message\n",
        FILE_APPEND
    );
}

/* =========================
   DATABASE ERROR
========================= */
if ($link->connect_error) {
    writeLog("DB CONNECTION ERROR: " . $link->connect_error);
    http_response_code(500);
    exit("Database connection failed");
}

/* =========================
   READ RAW INPUT
========================= */
$raw = file_get_contents("php://input");

writeLog("=================================");
writeLog("RAW INPUT:");
writeLog($raw);

/* =========================
   PARSE INPUT
========================= */
$data = json_decode($raw, true);

if (json_last_error() !== JSON_ERROR_NONE || empty($data)) {
    $data = $_POST;
}

if (empty($data) && !empty($raw)) {
    parse_str($raw, $data);
}

writeLog("PARSED DATA:");
writeLog(print_r($data, true));

/* =========================
   VALIDATE DATA
========================= */
if (empty($data) || !is_array($data)) {
    writeLog("ERROR: No valid data received");
    http_response_code(400);
    exit("No valid data received");
}

/* =========================
   VALIDATE EVENT
========================= */
$event = trim($data['event'] ?? '');

if ($event !== "payment_received") {
    writeLog("ERROR: Invalid event -> $event");
    http_response_code(400);
    exit("Invalid event");
}

/* =========================
   EXTRACT PAYLOAD
========================= */
$payload  = $data['data'] ?? [];
$customer = $payload['customer'] ?? [];

/* =========================
   PAYMENT DETAILS
========================= */
$transaction_id = trim($payload['transaction_id'] ?? '');
$amount         = (float)($payload['amount'] ?? 0);
$fee            = (float)($payload['fee'] ?? 0);
$settlement     = (float)($payload['settlement'] ?? 0);
$currency       = trim($payload['currency'] ?? 'NGN');

/* =========================
   CUSTOMER DETAILS
========================= */
$customer_name  = trim($customer['name'] ?? '');
$customer_email = trim($customer['email'] ?? '');
$account_number = trim($customer['account_number'] ?? '');

if ($settlement <= 0) {
    $settlement = $amount;
}

if (empty($transaction_id) || empty($customer_email) || $amount <= 0) {
    writeLog("ERROR: Missing required fields");
    http_response_code(400);
    exit("Missing required fields");
}

/* =========================
   START TRANSACTION
========================= */
$link->begin_transaction();

try {

    /* =========================
       CHECK DUPLICATE
    ========================= */
    $check = $link->prepare("SELECT id FROM fundwallet WHERE trxid = ? LIMIT 1");
    $check->bind_param("s", $transaction_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        writeLog("DUPLICATE TRANSACTION: $transaction_id");
        $link->rollback();
        exit("Duplicate transaction ignored");
    }
    $check->close();

    /* =========================
       GET USER (FIXED funds field)
    ========================= */
    $userStmt = $link->prepare("
        SELECT username, funds
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

    $userStmt->bind_param("s", $customer_email);
    $userStmt->execute();

    $userResult = $userStmt->get_result();
    $user = $userResult->fetch_assoc();

    if (!$user) {
        writeLog("USER NOT FOUND: $customer_email");
        $link->rollback();
        http_response_code(404);
        exit("User not found");
    }

    $username = $user['username'];
    $balanceBefore = (float)$user['funds'];
    $balanceAfter = $balanceBefore + $settlement;

    $userStmt->close();

    /* =========================
       UPDATE USER BALANCE
    ========================= */
    $wallet = $link->prepare("
        UPDATE users
        SET funds = funds + ?
        WHERE username = ?
    ");

    $wallet->bind_param("ds", $settlement, $username);
    $wallet->execute();
    $wallet->close();

    /* =========================
       INSERT TRANSACTION
    ========================= */
    $reference = generateTransactionID(8);
    $gateway   = "Dsociopay";
    $status    = "successful";
    $dateTime  = date("Y-m-d H:i:s");

    $insertSQL = "
        INSERT INTO fundwallet
        (
            code, username, email, amount, fee, settlement,
            initiatedfrom, currency, status, trxid, responseCode,
            message, balancebefore, balanceafter, date
        )
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $insert = $link->prepare($insertSQL);

    $insert->bind_param(
        "sssdddssssssdds",
        $reference,
        $username,
        $customer_email,
        $amount,
        $fee,
        $settlement,
        $gateway,
        $currency,
        $status,
        $transaction_id,
        $customer_name,
        $account_number,
        $balanceBefore,
        $balanceAfter,
        $dateTime
    );

    $insert->execute();
    $insert->close();

    $link->commit();

    writeLog("SUCCESS TRXID: $transaction_id");

    echo json_encode([
        "status" => "success",
        "message" => "Webhook processed successfully"
    ]);

} catch (Exception $e) {

    $link->rollback();
    writeLog("FATAL ERROR: " . $e->getMessage());

    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

$link->close();
?>