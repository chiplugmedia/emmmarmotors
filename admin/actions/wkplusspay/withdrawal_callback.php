<?php
session_start();

// ===============================
// Database Connection
// ===============================
date_default_timezone_set('Africa/Lagos');
$link = new mysqli("localhost", "jmxktkat_xon", "jmxktkat_xon", "jmxktkat_xon");
if ($link->connect_error) {
    file_put_contents("withdrawal_callback.txt", date("Y-m-d H:i:s") . " => DB Connection Failed: " . $link->connect_error . PHP_EOL, FILE_APPEND);
    http_response_code(500);
    exit('Database connection failed');
}

// ===============================
// Logging Function
// ===============================
function logMessage($message, $data = []) {
    $logEntry = date("Y-m-d H:i:s") . " => " . $message;
    if (!empty($data)) {
        $logEntry .= " | Data: " . json_encode($data);
    }
    $logEntry .= PHP_EOL;
    file_put_contents("withdrawal_callback_logs.txt", $logEntry, FILE_APPEND);
}

// ===============================
// Capture Input Data
// ===============================
$raw_input = file_get_contents("php://input");
$headers = getallheaders();

// Log the incoming request
file_put_contents("withdrawal_webhook_debug.txt", 
    date("Y-m-d H:i:s") . " RAW INPUT: " . $raw_input . PHP_EOL .
    "HEADERS: " . json_encode($headers) . PHP_EOL .
    "POST: " . json_encode($_POST) . PHP_EOL .
    "GET: " . json_encode($_GET) . PHP_EOL .
    "------------------------------------" . PHP_EOL,
    FILE_APPEND
);

// Parse the input data
$inputData = [];
if (!empty($raw_input)) {
    $inputData = json_decode($raw_input, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        parse_str($raw_input, $inputData);
    }
}

// Merge all possible data sources
$callbackData = array_merge($_POST, $_GET, $inputData);

// Capture essential fields
$orderNo = isset($callbackData['order_no']) ? trim($callbackData['order_no']) : '';
$result  = isset($callbackData['result']) ? trim($callbackData['result']) : '';
$status  = isset($callbackData['status']) ? trim($callbackData['status']) : '';

logMessage('Withdrawal Callback received', $callbackData);

// ===============================
// Validation
// ===============================
if (empty($orderNo)) {
    logMessage('Missing order_no in callback', $callbackData);
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing order_no']);
    exit;
}

// ===============================
// Find Withdrawal Record
// ===============================
$sql = $link->prepare("SELECT * FROM withdrawals WHERE oldreference = ?");
$sql->bind_param("s", $orderNo);
$sql->execute();
$resultSql = $sql->get_result();

if ($resultSql->num_rows === 0) {
    logMessage('Withdrawal not found for order_no', ['order_no' => $orderNo]);
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Withdrawal not found']);
    exit;
}

$withdrawal = $resultSql->fetch_assoc();
$username = $withdrawal['username'];
$amount = $withdrawal['amount'];
$currentStatus = strtolower($withdrawal['status']);
$type = strtolower($withdrawal['type']);
$withdrawalId = $withdrawal['id'];

logMessage('Found withdrawal record', [
    'order_no' => $orderNo,
    'username' => $username,
    'amount' => $amount,
    'current_status' => $currentStatus,
    'type' => $type
]);

// ===============================
// Prevent Duplicate Processing
// ===============================
if (in_array($currentStatus, ['successful', 'rejected', 'completed'])) {
    logMessage('Withdrawal already processed', [
        'order_no' => $orderNo, 
        'current_status' => $currentStatus
    ]);
    echo json_encode(['status' => 'success', 'message' => 'Already processed']);
    exit;
}

// ===============================
// Process Callback Result
// ===============================
try {
    // Determine the actual result from callback data
    $actualResult = '';
    if (!empty($result)) {
        $actualResult = strtolower($result);
    } elseif (!empty($status)) {
        $actualResult = strtolower($status);
    } elseif (isset($callbackData['success']) && $callbackData['success'] === true) {
        $actualResult = 'success';
    }

    logMessage('Processing callback result', [
        'order_no' => $orderNo,
        'result' => $actualResult,
        'raw_result' => $result,
        'raw_status' => $status
    ]);

    if ($actualResult === 'success' || $actualResult === 'completed' || $actualResult === 'successful') {
        // ===============================
        // SUCCESSFUL WITHDRAWAL
        // ===============================
        $sql = $link->prepare("UPDATE withdrawals SET status = 'successful', date = NOW() WHERE oldreference = ?");
        $sql->bind_param("s", $orderNo);
        
        if ($sql->execute()) {
            logMessage('Withdrawal marked as successful', [
                'order_no' => $orderNo,
                'username' => $username,
                'amount' => $amount
            ]);
        } else {
            throw new Exception("Failed to update withdrawal status to successful");
        }
        
    } else {
        // ===============================
        // FAILED WITHDRAWAL - REFUND USER
        // ===============================
        logMessage('Withdrawal failed, processing refund', [
            'order_no' => $orderNo,
            'username' => $username,
            'amount' => $amount,
            'type' => $type
        ]);

        // Determine refund wallet based on withdrawal type
        $wallet = null;
        switch ($type) {
            case "activity": 
                $wallet = "totalrefearnings"; 
                break;
            case "referral": 
                $wallet = "referralfunds"; 
                break;
            case "indirectreferral": 
                $wallet = "indref"; 
                break;
            case "thirdindirectreferral": 
                $wallet = "thirdindref"; 
                break;
            default: 
                $wallet = null;
                logMessage('Unknown wallet type for refund', ['type' => $type]);
                break;
        }

        // Start transaction for refund process
        $link->begin_transaction();

        try {
            // Update withdrawal status to rejected
            $sql = $link->prepare("UPDATE withdrawals SET status = 'rejected', date = NOW() WHERE oldreference = ?");
            $sql->bind_param("s", $orderNo);
            
            if (!$sql->execute()) {
                throw new Exception("Failed to update withdrawal status to rejected");
            }

            // Refund amount to user's wallet
            if ($wallet) {
                $sql = $link->prepare("UPDATE users SET $wallet = $wallet + ? WHERE username = ?");
                $sql->bind_param("ds", $amount, $username);
                
                if ($sql->execute()) {
                    logMessage('Refund processed successfully', [
                        'username' => $username,
                        'amount' => $amount,
                        'wallet' => $wallet,
                        'order_no' => $orderNo
                    ]);
                } else {
                    throw new Exception("Failed to refund amount to user wallet");
                }
            } else {
                logMessage('No wallet specified for refund, skipping wallet update', [
                    'username' => $username,
                    'type' => $type
                ]);
            }

            $link->commit();
            logMessage('Refund transaction completed successfully', ['order_no' => $orderNo]);

        } catch (Exception $e) {
            $link->rollback();
            throw new Exception("Refund transaction failed: " . $e->getMessage());
        }
    }

    // ===============================
    // SUCCESS RESPONSE
    // ===============================
    logMessage('Callback processing completed successfully', ['order_no' => $orderNo]);
    http_response_code(200);
    echo json_encode([
        'status' => 'success', 
        'message' => 'Callback processed successfully',
        'order_no' => $orderNo
    ]);

} catch (Exception $e) {
    // ===============================
    // ERROR HANDLING
    // ===============================
    logMessage('Error processing callback: ' . $e->getMessage(), [
        'order_no' => $orderNo,
        'error' => $e->getMessage()
    ]);
    
    http_response_code(500);
    echo json_encode([
        'status' => 'error', 
        'message' => 'Internal server error',
        'order_no' => $orderNo
    ]);
}

// Close database connection
$link->close();
exit;
?>