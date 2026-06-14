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
        $sql=$link->prepare("SELECT * FROM bankdeposit WHERE id=?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result=$sql->get_result();
        $row=$result->fetch_assoc();
        $amount=$row['amount'];
        $username=$row['username'];
        $method=$row['method'];
        $status=$row['status'];
        $reference=$row['reference'];
        
        $sql=$link->prepare("SELECT * FROM users WHERE username=?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result=$sql->get_result();
        $row=$result->fetch_assoc();
        $email=$row['email'];
        $funds=$row['funds'];
        


        if($status == "successful"){
            $status="error";
            $message="Deposit is already successful"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $sql=$link->prepare("UPDATE bankdeposit SET status='successful' WHERE id=?");
            $sql->bind_param("i", $id);
            if($sql->execute()){
                $deductedAmt=$amount - $paymentTransferFee;
                $balanceBefore=$funds;
                $balanceAfter=$balanceBefore + $deductedAmt;

                $sql=$link->prepare("UPDATE users SET funds=funds + ? WHERE username=?");
                $sql->bind_param("ss", $deductedAmt, $username);
                $sql->execute();
                
                $sql=$link->prepare("UPDATE fundwallet SET status='successful', message='Transaction is approved', balancebefore=?, balanceafter=?, amount=? WHERE code=?");
                $sql->bind_param("ssss", $balanceBefore, $balanceAfter, $deductedAmt, $reference);
                $sql->execute();
                
                
                $status="success";
                $message="Deposit approved"; 
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

if(isset($_POST['decline'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $id=filter_string($_POST['id']);
        $sql=$link->prepare("UPDATE bankdeposit SET status='rejected' WHERE id=?");
        $sql->bind_param("i", $id);
        if($sql->execute()){
            $status="success";
            $message="Deposit rejected"; 
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