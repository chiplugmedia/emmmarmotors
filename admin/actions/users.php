<?php
$genMsg="";

if(isset($_POST['makeVendor'])){
    if(empty($_POST['username'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $username=filter_string($_POST['username']);
        $sql=$link->prepare("UPDATE users SET role='vendor' WHERE username=?");
        $sql->bind_param("s", $username);
        if($sql->execute()){
            $status="success";
            $message="User changed to vendor $username"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['removeVendor'])){
    if(empty($_POST['username'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $username=filter_string($_POST['username']);
        $sql=$link->prepare("UPDATE users SET role='user' WHERE username=?");
        $sql->bind_param("s", $username);
        if($sql->execute()){
            $status="success";
            $message="Vendor removed"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['suspendUser'])){
    if(empty($_POST['username'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $username=filter_string($_POST['username']);
        $sql=$link->prepare("UPDATE users SET status='suspended' WHERE username=?");
        $sql->bind_param("s", $username);
        if($sql->execute()){
            $status="success";
            $message="User <b>$username</b> has been suspended"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}


if(isset($_POST['activate'])){
    if(empty($_POST['username'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $username=filter_string($_POST['username']);
        $sql=$link->prepare("UPDATE users SET status='active' WHERE username=?");
        $sql->bind_param("s", $username);
        if($sql->execute()){
            $status="success";
            $message="User activated"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['sendCoupon'])){
    if(empty($_POST['username'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $username=filter_string($_POST['username']);
        $coupon=strtoupper(get_rand_alphanumeric(12));
        $sql=$link->prepare("INSERT INTO coupons(coupon,vendor,date) VALUES(?,?,?)");
        $sql->bind_param("sss", $coupon, $username, $dateTime);
        if($sql->execute()){
            $status="success";
            $message="Coupon sent to $username coupon: <strong>$coupon</strong>"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}


if(isset($_POST['deleteCoupon'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Coupon ID empty"; 
        $genMsg=sendResponse($status, $message);
    }
    if(empty($_POST['username'])){
        $status="error";
        $message="User empty"; 
        $genMsg=sendResponse($status, $message);
    }
    if(empty($_POST['coupon'])){
        $status="error";
        $message="Coupon empty"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $id=filter_string($_POST['id']);
        $username=filter_string($_POST['username']);
        $coupon=filter_string($_POST['coupon']);
        $sql=$link->prepare("SELECT * FROM users WHERE username=? AND coupon=?");
        $sql->bind_param("ss", $username, $coupon);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        if($numrow == 1){
            $sql=$link->prepare("DELETE FROM users WHERE username=? AND coupon=?");
            $sql->bind_param("ss", $username, $coupon);
            if($sql->execute()){
                $sql=$link->prepare("DELETE FROM coupons WHERE id=?");
                $sql->bind_param("s", $id);
                if($sql->execute()){
                    $status="success";
                    $message="Code and user deleted"; 
                    $genMsg=sendResponse($status, $message);
                }
                else{
                    $status="error";
                    $message="Something went wrong 01"; 
                    $genMsg=sendResponse($status, $message);
                }
            }
            else{
                $status="error";
                $message="Something went wrong 02"; 
                $genMsg=sendResponse($status, $message);
            }
        }
        else{
            $sql=$link->prepare("DELETE FROM coupons WHERE id=?");
            $sql->bind_param("s", $id);
            if($sql->execute()){
                $status="success";
                $message="Code deleted"; 
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Something went wrong 03"; 
                $genMsg=sendResponse($status, $message);
            }
        }
    }
}


if (isset($_POST['deleteVendorCoupons'])) {
    if (empty($_POST['vendor'])) {
        $status = "error";
        $message = "Vendor name empty";
        $genMsg = sendResponse($status, $message);
    } else {
        $vendor = filter_string($_POST['vendor']);

        // select all coupons sold by the vendor
        $sql = $link->prepare("SELECT id, coupon FROM coupons WHERE vendor = ?");
        $sql->bind_param("s", $vendor);
        $sql->execute();
        $result = $sql->get_result();
        
        // loop through each coupon and delete the users that used it
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $coupon = $row['coupon'];
            
            // select users that used the coupon
            $sql2 = $link->prepare("SELECT * FROM users WHERE coupon = ?");
            $sql2->bind_param("s", $coupon);
            $sql2->execute();
            $result2 = $sql2->get_result();
            $numrow = $result2->num_rows;

            // delete the users that used the coupon
            if ($numrow > 0) {
                $sql3 = $link->prepare("DELETE FROM users WHERE coupon = ?");
                $sql3->bind_param("s", $coupon);
                if ($sql3->execute()) {
                    // delete the coupon
                    $sql4 = $link->prepare("DELETE FROM coupons WHERE id = ?");
                    $sql4->bind_param("i", $id);
                    if ($sql4->execute()) {
                        $status = "success";
                        $message = "Users and coupon deleted for $vendor coupons";
                        $genMsg = sendResponse($status, $message);
                    } else {
                        $status = "error";
                        $message = "Something went wrong 02";
                        $genMsg = sendResponse($status, $message);
                    }
                } else {
                    $status = "error";
                    $message = "Something went wrong 01";
                    $genMsg = sendResponse($status, $message);
                }
            }
        }
    }
}



if (isset($_POST['generateCoupon'])) {
    if (empty($_POST['vendor'])) {
        $status = "error";
        $message = "Select a vendor";
        $genMsg = sendResponse($status, $message);
    } elseif (empty($_POST['couponNum'])) {
        $status = "error";
        $message = "Enter coupon quantity";
        $genMsg = sendResponse($status, $message);
    } elseif (!is_numeric($_POST['couponNum']) || $_POST['couponNum'] <= 0) {
        $status = "error";
        $message = "Enter a valid coupon number greater than 0";
        $genMsg = sendResponse($status, $message);
    } elseif (empty($_POST['type'])) {
        $status = "error";
        $message = "Enter earning amount";
        $genMsg = sendResponse($status, $message);    
    } else {
        $vendor = filter_var($_POST['vendor'], FILTER_SANITIZE_STRING);
        $couponNum = filter_var($_POST['couponNum'], FILTER_SANITIZE_NUMBER_INT);
        $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
        $prefix = isset($_POST['prefix']) ? filter_var($_POST['prefix'], FILTER_SANITIZE_STRING) : '';

        $coupons = "";
        for ($i = 1; $i <= $couponNum; $i++) {
            $coupon = $prefix . strtoupper(substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 12)), 0, 12));
            $sql = $link->prepare("INSERT INTO coupons (coupon, vendor,type, date) VALUES (?, ?,?,  NOW())");
            $sql->bind_param("sss", $coupon, $vendor,$type);
            $sql->execute();
            $coupons .= "$coupon <br>";
        }
        $status = "success";
        $message = "Coupons generated: $couponNum";
        $genMsg = sendResponse($status, $message);
    }
}



if(isset($_POST['sendData'])){
    if(empty($_POST['username'])){
        $status="error";
        $message="Enter username"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['dataAmount'])){
        $status="error";
        $message="Enter amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $username=filter_string($_POST['username']);
        $sql=$link->prepare("SELECT * FROM users WHERE username=?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        if($numrow == 1){
            $dataAmount=filter_string($_POST['dataAmount']);
            $sql=$link->prepare("UPDATE users SET datafunds=datafunds + ? WHERE username=?");
            $sql->bind_param("ss", $dataAmount, $username);
            if($sql->execute()){
                $status="success";
                $message="$dataAmount MB worth of data sent to $username"; 
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Something went wrong"; 
                $genMsg=sendResponse($status, $message);
            }
        }
        else{
            $status="error";
            $message="User not found"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}


if(isset($_POST['deleteUser'])) {
    if(empty($_POST['username'])) {
        $status = "error";
        $message = "Username is required"; 
        $genMsg = sendResponse($status, $message);
    } else {
        $username = filter_string($_POST['username']);
        
        // Start transaction for atomic operations
        $link->begin_transaction();
        
        try {
            // Check if user exists
            $sql = $link->prepare("SELECT * FROM users WHERE username = ?");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();
            
            if($result->num_rows == 0) {
                throw new Exception("User not found");
            }
            
            // Delete from all related tables
            $tables = [
                'userearnings',
                'user_investments', 
                'referrals',
                'withdrawals',
                'users'  // Delete from users table last
            ];
            
            foreach($tables as $table) {
                $sql = $link->prepare("DELETE FROM $table WHERE username = ?");
                $sql->bind_param("s", $username);
                if(!$sql->execute()) {
                    throw new Exception("Failed to delete from $table");
                }
            }
            
            // Commit transaction if all deletions succeeded
            $link->commit();
            
            $status = "success";
            $message = "User and all associated records deleted successfully";
            $genMsg = sendResponse($status, $message);
            
        } catch (Exception $e) {
            // Rollback transaction if any error occurs
            $link->rollback();
            
            $status = "error";
            $message = $e->getMessage();
            $genMsg = sendResponse($status, $message);
        }
    }
}
?>