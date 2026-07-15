<?php

$genMsg = "";

// Initialize session if not already done
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mock definitions for missing global system infrastructure variables. 
// Replace or remove these if they are already defined in your header dependencies.
if (!isset($link)) {
    // $link = new mysqli("localhost", "user", "pass", "database"); 
}
$username = $_SESSION['username'] ?? 'guest';
$dateTime = date("Y-m-d H:i:s");

// Fallback logic structure for custom UI messages
if (!function_exists('sendResponse')) {
    function sendResponse($type, $msg) {
        $color = $type === 'error' ? 'red' : 'green';
        return "<div class='p-4 mb-4 text-sm text-{$color}-700 bg-{$color}-100 rounded-xl'>{$msg}</div>";
    }
}
if (!function_exists('filter_string')) {
    function filter_string($v) {
        return trim(strip_tags((string) $v));
    }
}

$paystack = "*********";

// Display success notifications gracefully on safe redirects
if (isset($_GET['saved']) && $_GET['saved'] == 1) {
    $genMsg = sendResponse("success", "Bank details saved securely.");
}

/*
|--------------------------------------------------------------------------
| FETCH BANK LIST FROM PAYSTACK
|--------------------------------------------------------------------------
*/
$banks = [];
$bankCacheFile = sys_get_temp_dir() . '/paystack_banks_ng.json';
$cacheIsFresh  = file_exists($bankCacheFile) && (time() - filemtime($bankCacheFile) < 86400);

if ($cacheIsFresh) {
    $banks = json_decode(file_get_contents($bankCacheFile), true);
} else {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.paystack.co/bank?country=nigeria",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$paystack}"
        ]
    ]);

    $bankResponse = curl_exec($ch);
    $curlErr      = curl_errno($ch) ? curl_error($ch) : null;
    curl_close($ch);

    if (!$curlErr && $bankResponse) {
        $decoded = json_decode($bankResponse, true);
        if (!empty($decoded['status'])) {
            $banks = $decoded;
            file_put_contents($bankCacheFile, json_encode($banks));
        } elseif (file_exists($bankCacheFile)) {
            $banks = json_decode(file_get_contents($bankCacheFile), true);
        }
    } elseif (file_exists($bankCacheFile)) {
        $banks = json_decode(file_get_contents($bankCacheFile), true);
    }
}

/*
|--------------------------------------------------------------------------
| LOAD SAVED BANK
|--------------------------------------------------------------------------
*/
$savedBank = [];
if (isset($link) && !empty($username)) {
    $sql = $link->prepare("SELECT * FROM bankaccounts WHERE username=? LIMIT 1");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        $savedBank = $result->fetch_assoc();
    }
}

/*
|--------------------------------------------------------------------------
| SAVE BANK FORM PROCESSING
|--------------------------------------------------------------------------
*/
if (isset($_POST['saveBank'])) {
    $bankCode      = filter_string($_POST['bank_code'] ?? '');
    $bankName      = filter_string($_POST['bank_name'] ?? '');
    $acctName      = filter_string($_POST['account_name'] ?? '');
    $accountNumber = filter_string($_POST['account_number'] ?? '');

    if (empty($bankCode) || empty($bankName) || empty($acctName) || empty($accountNumber)) {
        $genMsg = sendResponse("error", "Please verify your account configuration details before trying to save.");
    } else if (isset($link)) {
        $sql = $link->prepare("SELECT id FROM bankaccounts WHERE username=? LIMIT 1");
        $sql->bind_param("s", $username);
        $sql->execute();
        $check = $sql->get_result();

        if ($check && $check->num_rows > 0) {
            $sql = $link->prepare("UPDATE bankaccounts SET bankname=?, acctname=?, acctnum=?, bankcode=? WHERE username=?");
            $sql->bind_param("sssss", $bankName, $acctName, $accountNumber, $bankCode, $username);
        } else {
            $sql = $link->prepare("INSERT INTO bankaccounts (username, bankname, acctname, acctnum, bankcode, date) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $username, $bankName, $acctName, $accountNumber, $bankCode, $dateTime);
        }

        if ($sql->execute()) {
            // Fixed: Removed "?saved=1" parameter, just redirect to the page itself
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $genMsg = sendResponse("error", "Failed to save bank details to the database.");
        }
    }
}

?>