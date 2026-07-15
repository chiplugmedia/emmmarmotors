<?php
// Initialize session if not already done in an auto-included file
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

$paystackSecretKey = "****************";

// ---- Basic request sanity checks ----------------------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'message' => 'Invalid request method']);
    exit;
}

// Check session configuration (Adjust key name matching your ecosystem)
if (empty($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'You must be logged in to verify a bank account']);
    exit;
}

// ---- Read + validate input ------------------------------------------------
function clean_input($v) {
    if (function_exists('filter_string')) {
        return filter_string($v);
    }
    return trim(strip_tags((string) $v));
}

$bankCode      = clean_input($_POST['bank_code'] ?? '');
$accountNumber = clean_input($_POST['account_number'] ?? '');

if (empty($bankCode)) {
    echo json_encode(['status' => false, 'message' => 'Please select a bank first']);
    exit;
}

if (empty($accountNumber) || !ctype_digit($accountNumber) || strlen($accountNumber) !== 10) {
    echo json_encode(['status' => false, 'message' => 'Account number must be exactly 10 digits']);
    exit;
}

if (empty($paystackSecretKey)) {
    echo json_encode(['status' => false, 'message' => 'Server misconfiguration: Paystack key missing']);
    exit;
}

// ---- Call Paystack's resolve-account endpoint -----------------------------
$url = "https://api.paystack.co/bank/resolve"
     . "?account_number=" . urlencode($accountNumber)
     . "&bank_code=" . urlencode($bankCode);

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer {$paystackSecretKey}",
        "Cache-Control: no-cache"
    ]
]);

$response = curl_exec($ch);
$curlErrNo = curl_errno($ch);
curl_close($ch);

if ($curlErrNo) {
    echo json_encode(['status' => false, 'message' => 'Could not reach Paystack right now. Please try again.']);
    exit;
}

$decoded = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => false, 'message' => 'Unexpected response from Paystack']);
    exit;
}

// ---- Respond -------------------------------------------------------------
if (!empty($decoded['status']) && !empty($decoded['data']['account_name'])) {
    echo json_encode([
        'status'         => true,
        'account_name'   => $decoded['data']['account_name'],
        'account_number' => $decoded['data']['account_number'] ?? $accountNumber
    ]);
} else {
    $msg = $decoded['message'] ?? 'Could not verify this account. Double-check the number and bank.';
    echo json_encode([
        'status'  => false,
        'message' => $msg
    ]);
}
exit;