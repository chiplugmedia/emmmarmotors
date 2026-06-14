<?php
$genMsg = "";
if (isset($_POST['giftBonus'])) {
    if (empty($_POST['coupon'])) {
        $status = "error";
        $message = "Enter Bonus code";
        $genMsg = sendResponse($status, $message);
    } else {
        $coupon = filter_string($_POST['coupon']);

        // Check if coupon exists
        $sql = $link->prepare("SELECT * FROM coupons WHERE coupon=?");
        $sql->bind_param("s", $coupon);
        $sql->execute();
        $result = $sql->get_result();
        $numrow_coupon = $result->num_rows;

        if ($numrow_coupon == 0) {
            $status = "error";
            $message = "Invalid coupon";
            $genMsg = sendResponse($status, $message);
        } else {
            $row = $result->fetch_assoc();
            $amount = $row['type'];
            $couponStatus = $row['status'];
            $usageCount = $row['usage_count'];
            $maxUsage = $row['max_usage'];

            // Check if user has already used this coupon
            $sqlCheck = $link->prepare("SELECT coupon FROM users WHERE username=? AND coupon=?");
            $sqlCheck->bind_param("ss", $username, $coupon);
            $sqlCheck->execute();
            $userCouponResult = $sqlCheck->get_result();

            if ($userCouponResult->num_rows > 0) {
                $status = "error";
                $message = "You have already used this coupon.";
                $genMsg = sendResponse($status, $message);
            } 
            // Coupon status check
            elseif ($couponStatus !== 'active') {
                $status = "error";
                $message = "This coupon has expired or already used up.";
                $genMsg = sendResponse($status, $message);
            } 
            // Check usage limit
            elseif ($usageCount >= $maxUsage) {
                $sql = $link->prepare("UPDATE coupons SET status='expired' WHERE coupon=?");
                $sql->bind_param("s", $coupon);
                $sql->execute();

                $status = "error";
                $message = "This coupon has expired. Limit of " . $maxUsage . " users reached.";
                $genMsg = sendResponse($status, $message);
            } else {
                // Update user's earnings and coupon
                $sql = $link->prepare("UPDATE users SET funds = funds + ?, coupon = ? WHERE username=?");
                $sql->bind_param("dss", $amount, $coupon, $username);
                $sql->execute();

                // Insert earnings record
                $type = "Gift Bonus";
                $sql = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?,?,?,?,?)");
                $sql->bind_param("ssdss", $username, $type, $amount, $time, $dateTime);
                $sql->execute();

                // Increase coupon usage count
                $newUsage = $usageCount + 1;
                $sql = $link->prepare("UPDATE coupons SET usage_count=? WHERE coupon=?");
                $sql->bind_param("is", $newUsage, $coupon);
                $sql->execute();

                // Expire coupon if limit reached
                if ($newUsage >= $maxUsage) {
                    $sql = $link->prepare("UPDATE coupons SET status='expired' WHERE coupon=?");
                    $sql->bind_param("s", $coupon);
                    $sql->execute();
                }

                $status = "success";
                $message = "Your Gift Bonus is ₦" . number_format($amount, 2);
                $genMsg = sendResponse($status, $message);
            }
        }
    }
}


?>
