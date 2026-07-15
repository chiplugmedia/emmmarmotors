<?php
$genMsg=$plan=$coupon="";
if(isset($_POST['subscribe'])){
    
    
    $plans=array("plan_a", "plan_b", "plan_c");
    if(empty($_POST['plan'])){
        $status="error";
        $message="Something went wrong, contact admin/support";
        $genMsg=sendResponse($status, $message);
    }
    else if(!in_array($_POST['plan'], $plans)){
        $status="error";
        $message="Invalid plan";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['coupon'])){
        $status="error";
        $message="Enter coupon";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $plan=filter_string($_POST['plan']);
        $coupon=filter_string($_POST['coupon']);
        
        $sql=$link->prepare("SELECT * FROM coupons WHERE coupon=? AND type=?");
        $sql->bind_param("ss", $coupon, $plan);
        $sql->execute();
        $result=$sql->get_result();
        $numrow_coupon=$result->num_rows;

        $sql=$link->prepare("SELECT * FROM coupons WHERE coupon=? AND status='active' AND type=? ");
        $sql->bind_param("ss", $coupon, $plan);
        $sql->execute();
        $result=$sql->get_result();
        $numrow_couponUsed=$result->num_rows;
        
        if($plan == "plan_a" && $acctPlan == "plan_a"){
            $status="error";
            $message="You're already a basic user";
            $genMsg=sendResponse($status, $message);
        }
        else if($plan == "plan_b" && $acctPlan == "plan_b"){
            $status="error";
            $message="You're already a elite user";
            $genMsg=sendResponse($status, $message);
        }
        else if($plan == "plan_c" && $acctPlan == "plan_c"){
            $status="error";
            $message="You're already a pro user";
            $genMsg=sendResponse($status, $message);
        }
        else if($numrow_coupon == 0){
            $status="error";
            $message="Invalid coupon code";
            $genMsg=sendResponse($status, $message);
        }
        else if($numrow_couponUsed == 0){
            $status="error";
            $message="Coupon code has already been used";
            $genMsg=sendResponse($status, $message);
        }
        
        else{
            $addReferral=false;
            if(($acctPlan == "plan_a" && ($plan == "plan_b" || $plan == "plan_c")) || ($acctPlan == "plan_b" && $plan == "plan_c")){
                $addReferral=true;
            }
           // if($acctPlan == ""){
            //    $funds=$funds / 3;
           // }
            $time=strtotime("+20 days", time());
            $sql=$link->prepare("UPDATE users SET plantype=?, time=?, funds=?, status='active' WHERE username=?");
            $sql->bind_param("ssss", $plan, $time, $funds, $username);
            if($sql->execute()){
                $sql=$link->prepare("UPDATE coupons set status='used' WHERE coupon=?");
                $sql->bind_param("s", $coupon);
                $sql->execute();
            
                $sql=$link->prepare("SELECT * FROM referrals WHERE username=?");
                $sql->bind_param("s", $username);
                $sql->execute();
                $result=$sql->get_result();
                $numrowReferral=$result->num_rows;
                $row=$result->fetch_assoc();
            
                $sql=$link->prepare("SELECT * FROM activations WHERE username=?");
                $sql->bind_param("s", $username);
                $sql->execute();
                $result=$sql->get_result();
                $numrowActivation=$result->num_rows;
                if($numrowReferral == 1 && $numrowActivation == 0 && $addReferral){ 
                    $refUsername=$row['referral'];
                    $sql=$link->prepare("SELECT * FROM users WHERE username=?");
                    $sql->bind_param("s", $refUsername);
                    $sql->execute();
                    $result=$sql->get_result();
                    $row=$result->fetch_assoc();
                    // $acctType=$row['acctype'];
                    // if($acctType == "free"){
                        if($plan == "plan_a"){
                            $refBonus=$refBonusA;
                        }
                        else if($plan == "plan_b"){
                            $refBonus=$refBonusB;
                        }
                        else if($plan == "plan_c"){
                            $refBonus=$refBonusC;                             
                        }
                        if(!empty($refBonus)){
                            $message="You earned cashback from referral <p class='text-success'> + ₦$refBonus Referral Wallet</p>";
                            $sql=$link->prepare("INSERT INTO messages(username, message, date) VALUES(?,?,?)");
                            $sql->bind_param("sss", $refUsername, $message, $dateTime);
                            $sql->execute();
                        }
                        
                       // $type="referral_bonus_upgrade";
                      //  $sql=$link->prepare("INSERT INTO userearnings(username, type, amount, time, date) VALUES(?,?,?,?,?)");
                      //  $sql->bind_param("sssss", $refUsername, $type, $refBonus, $time, $dateTime);
                      //  $sql->execute();

                        //$sql=$link->prepare("UPDATE users SET referralfunds=referralfunds + ?, totalrefearnings=totalrefearnings + ? WHERE username=?");
                        //$sql->bind_param("sss", $refBonus, $refBonus, $refUsername);
                       // $sql->execute();
                    //}
                }
            
                // if(!empty($welcomeDataBonus)){
                //     $message="You earned cashback from welcome bonus data <p class='text-success'> + ₦$welcomeDataBonus MB</p>";
                //     $sql=$link->prepare("INSERT INTO messages(username, message, date) VALUES(?,?,?)");
                //     $sql->bind_param("sss", $username, $message, $dateTime);
                //     $sql->execute();
                
                //     $sql=$link->prepare("UPDATE users SET funds=funds + 0, datafunds=datafunds + ? WHERE username=?");
                //     $sql->bind_param("ss", $welcomeDataBonus, $username);
                //     $sql->execute();
                // }
                    
                $sql=$link->prepare("INSERT INTO activations(username, date) VALUES(?,?)");
                $sql->bind_param("ss", $username, $dateTime);
                $sql->execute();
                
                
            
                
                $acctPlan=$plan;
                if($plan == "plan_a"){
                    $planName="Basic User";
                }
                if($plan == "plan_b"){
                    $planName="Elite User";
                }
                if($plan == "plan_c"){
                    $planName="Pro User";
                }
                $status="success";
                $message="You account plan has been changed, your are now a $planName";
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Something went wrong";
                $genMsg=sendResponse($status, $message);
            }
        }
    }
}

?>