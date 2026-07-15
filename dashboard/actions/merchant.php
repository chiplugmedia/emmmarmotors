<?php
$genMsg="";

if(isset($_POST['generateCode'])){

    $wallets=array("main", "referral");
    if(empty($_POST['wallet'])){
        $status="error";
        $message="Select wallet";
        $genMsg=sendResponse($status, $message);
    }
    else if(!in_array($_POST['wallet'], $wallets)){
        $status="error";
        $message="Invalid wallet";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['code'])){
        $status="error";
        $message="Enter code quantity";
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['code'])){
        $status="error";
        $message="Invalid number";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $wallet=filter_string($_POST['wallet']);
        $codeQuantity=(int) filter_string($_POST['code']);
        $cost=$codeQuantity * $couponAmount;

        if($wallet == "main" && ($cost > $funds)){
            $status="error";
            $message="Insufficient balance on main wallet";
            $genMsg=sendResponse($status, $message);
        }
        else if($wallet == "referral" && ($cost > $referralFunds)){
            $status="error";
            $message="Insufficient balance on referral wallet";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $walletType=($wallet == "main") ? "funds" : "referralfunds";
            $sql=$link->prepare("UPDATE users SET $walletType=$walletType - ? WHERE username=?");
            $sql->bind_param("ss", $cost, $username);
            if($sql->execute()){
                $count=0;
                for($i=0; $i < $codeQuantity; $i++){
                    $coupon=strtoupper(get_rand_alphanumeric(10));
                    $sql=$link->prepare("INSERT INTO coupons(vendor, coupon, wallet, date) VALUES(?,?,?,?)");
                    $sql->bind_param("ssss", $username, $coupon, $wallet, $dateTime);
                    if($sql->execute()){
                        $count++;
                    }

                }
                if($count == $codeQuantity){
                    if($wallet == "main"){
                        $funds=$funds - $cost;
                    }
                    else{
                        $referralFunds=$referralFunds - $cost;
                    }
                    $status="success";
                    $message="$codeQuantity codes has been generated";
                    $genMsg=sendResponse($status, $message);
                }
                else{
                    $status="error";
                    $message="Failed to generate code";
                    $genMsg=sendResponse($status, $message);
                }
            }
            else{
                $status="error";
                $message="Failed to generate code";
                $genMsg=sendResponse($status, $message);
            }
        }
    }
}


if(isset($_POST['deleteCoupon'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $coupon=filter_string($_POST['id']);
        $sql=$link->prepare("DELETE FROM coupons WHERE coupon=?");
        $sql->bind_param("s", $coupon);
        if($sql->execute()){
            $status="success";
            $message="Coupon deleted";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong $coupon";
            $genMsg=sendResponse($status, $message);
        }
    }
}
?>