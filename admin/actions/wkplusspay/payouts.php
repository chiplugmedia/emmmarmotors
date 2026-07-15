<?php
// require $_SERVER['DOCUMENT_ROOT']."/stream.php";
// require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
// require $_SERVER['DOCUMENT_ROOT']."$stream/dash/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/admin/actions/wkplusspay/withdrawalpayouts.php";


$genMsg = "";

// =========================
// CHECK FOR SESSION MESSAGE
// =========================
if (isset($_SESSION['genMsg'])) {
    $genMsg = $_SESSION['genMsg'];
    unset($_SESSION['genMsg']);
}

// =========================
// PROCESS WITHDRAWAL APPROVAL
// =========================
if (isset($_POST['approve'])) {

    if (empty($_POST['id'])) {
        $genMsg = sendResponse("error", "Invalid request: Missing withdrawal ID.");
    } else {
        $id = filter_string($_POST['id']);

        // Check if withdrawal exists and is pending
        $sql = $link->prepare("SELECT * FROM withdrawals WHERE id = ? AND status = 'pending'");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $amount   = floatval($row['amount']);
            $type     = $row['type'];

            // Apply deduction
            $deductionPercentage = 15; // You mentioned 15%
            $deductionAmount = ($amount * $deductionPercentage) / 100;
            $finalAmount = max(0, $amount - $deductionAmount);

            // Fetch user's bank details
            $bankQ = $link->prepare("SELECT * FROM bankaccounts WHERE username = ?");
            $bankQ->bind_param("s", $username);
            $bankQ->execute();
            $bankRes = $bankQ->get_result();

            if ($bankRes && $bankRes->num_rows > 0) {
                $bankRow = $bankRes->fetch_assoc();

                $payload = [
                    'username'        => $username,
                    'amount'          => $finalAmount,
                    'original_amount' => $amount,
                    'bank_name'       => $bankRow['acctname'],
                    'bank_number'     => $bankRow['acctnum'],
                    'bank_code'       => $bankRow['bankcode'],
                    'withdrawal_id'   => $id
                ];

                // Make withdrawal request
                $resp = withdrawMoney($payload, $link, $id);

                if (!empty($resp['status']) && $resp['status'] === 'success') {
                    $status = "success";
                    $message = "Withdrawal initiated successfully. {$deductionPercentage}% fee applied. Original: ₦" . number_format($amount, 2) . " | Final: ₦" . number_format($finalAmount, 2);
                } else {
                    $status = "error";
                    $message = $resp['message'] ?? "Withdrawal API request failed.";
                }
            } else {
                $status = "error";
                $message = "Bank details not found for user.";
            }
        } else {
            $status = "error";
            $message = "Invalid withdrawal request or already processed.";
        }

        $genMsg = sendResponse($status, $message);
    }

    $_SESSION['genMsg'] = $genMsg;
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// =========================
// PROCESS DECLINE
// =========================
if (isset($_POST['decline'])) {
    if (empty($_POST['id'])) {
        $genMsg = sendResponse("error", "Something went wrong");
    } else {
        $id = filter_string($_POST['id']);

        $sql = $link->prepare("SELECT username, amount, type FROM withdrawals WHERE id=? AND status='pending'");
        $sql->bind_param("i", $id);
        $sql->execute();
        $res = $sql->get_result();

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $username = $row['username'];
            $amount   = $row['amount'];
            $type     = $row['type'];

            $wallets = [
                "activity" => "totalrefearnings",
                "referral" => "referralfunds",
                "indirectreferral" => "indref",
                "thirdindirectreferral" => "thirdindref"
            ];
            $wallet = $wallets[$type] ?? null;

            $link->begin_transaction();
            try {
                $up = $link->prepare("UPDATE withdrawals SET status='rejected' WHERE id=?");
                $up->bind_param("i", $id);
                $up->execute();

                if ($wallet) {
                    $refund = $link->prepare("UPDATE users SET $wallet = $wallet + ? WHERE username=?");
                    $refund->bind_param("ds", $amount, $username);
                    $refund->execute();
                }

                $link->commit();
                $status = "success";
                $message = "Withdrawal rejected and refunded successfully.";
            } catch (Exception $e) {
                $link->rollback();
                $status = "error";
                $message = "Failed to reject withdrawal: " . $e->getMessage();
            }
        } else {
            $status = "error";
            $message = "Withdrawal not found or already processed.";
        }

        $genMsg = sendResponse($status, $message);
    }

    $_SESSION['genMsg'] = $genMsg;
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

?>
