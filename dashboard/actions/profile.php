<?php
$genMsg="";
if(isset($_POST['activateAccountWallet'])){

    if($funds < $couponAmount){
        $status="error";
        $message="You do not have sufficient funds please fund your wallet and try again.";
        $genMsg=sendResponse($status, $message);
    }
    else if($acctType == "standard"){
        $status="error";
        $message="You're already an upgraded member";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $time=strtotime("+90000000000000000000 days", time());
        $sql=$link->prepare("UPDATE users SET funds=funds-?, acctype='standard', time=? WHERE username=?");
        $sql->bind_param("sss", $couponAmount, $time, $username);
        if($sql->execute()){
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
            
            if($numrowReferral == 1 && $numrowActivation == 0){
                $refUsername=$row['referral'];
                $sql=$link->prepare("SELECT * FROM users WHERE username=?");
                $sql->bind_param("s", $refUsername);
                $sql->execute();
                $result=$sql->get_result();
                $row=$result->fetch_assoc();
                $acctType=$row['acctype'];
                if($acctType == "standard"){
                    if(!empty($refBonus)){
                        $message="You earned cashback from referral <p class='text-success'> + ₦$refBonus Referral Wallet</p>";
                        $sql=$link->prepare("INSERT INTO messages(username, message, date) VALUES(?,?,?)");
                        $sql->bind_param("sss", $refUsername, $message, $dateTime);
                        $sql->execute();
                    }

                    $sql=$link->prepare("UPDATE users SET referralfunds=referralfunds + ?, datafunds=datafunds + ? WHERE username=?");
                    $sql->bind_param("sss", $refBonus, $refDataBonus, $refUsername);
                    $sql->execute();
                }
            }
            
            if(!empty($welcomeDataBonus)){
                $message="You earned cashback from welcome bonus data <p class='text-success'> + ₦$welcomeDataBonus MB</p>";
                $sql=$link->prepare("INSERT INTO messages(username, message, date) VALUES(?,?,?)");
                $sql->bind_param("sss", $username, $message, $dateTime);
                $sql->execute();
                
                $sql=$link->prepare("UPDATE users SET funds=funds + 0, datafunds=datafunds + ? WHERE username=?");
                $sql->bind_param("ss", $welcomeDataBonus, $username);
                $sql->execute();
            }
                    
            $sql=$link->prepare("INSERT INTO activations(username, amount, date) VALUES(?,?,?)");
            $sql->bind_param("sss", $username, $couponAmount, $dateTime);
            $sql->execute();

            $acctType="standard";
            $status="success";
            $message="You account has been upgraded, your are now a STANDARD MEMBER";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }
    }
}

?>