<?php
$genMsg="";

if(isset($_POST['approve'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $id=filter_string($_POST['id']);
        $sql=$link->prepare("UPDATE withdrawals SET status='successful' WHERE id=?");
        $sql->bind_param("i", $id);
        if($sql->execute()){
            $status="success";
            $message="Withdrawal approved"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['decline'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $id=filter_string($_POST['id']);
        
        $sql=$link->prepare("UPDATE withdrawals SET status='rejected' WHERE id=?");
        $sql->bind_param("i", $id);
        if($sql->execute()){
            $sql=$link->prepare("SELECT * FROM withdrawals WHERE id=?");
            $sql->bind_param("s", $id);
            $sql->execute();
            $result=$sql->get_result();
            $row=$result->fetch_assoc();
            $username=$row['username'];
            $amount=$row['amount'];
            $type=strtolower($row['type']);
            switch($type){
                case "activity" : $wallet="funds"; break;
                case "referral" : $wallet="referralfunds"; break;
                case "indirectreferral" : $wallet="indref"; break;
                case "thirdindirectreferral" : $wallet="thirdindref"; break;
            }
            $sql=$link->prepare("UPDATE users SET $wallet=$wallet + ? WHERE username=?");
            $sql->bind_param("ss", $amount, $username);
            $sql->execute();
        
            $status="success";
            $message="Withdrawal rejected"; 
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