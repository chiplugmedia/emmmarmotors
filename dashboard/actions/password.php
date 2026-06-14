<?php
$genMsg="";

if(isset($_POST['updatePsw'])){

    if(empty($_POST['currPsw'])){
        $status="error";
        $message="Enter your current password"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['newPsw'])){
        $status="error";
        $message="Enter your new password";
        $genMsg=sendResponse($status, $message);
    }
    else if(strlen($_POST['newPsw']) < 8){
        $status="error";
        $message="Password must be at least 8 characters";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['confirmPsw'])){
        $status="error";
        $message="Confirm your password";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['newPsw'] != $_POST['confirmPsw']){
        $status="error";
        $message="Passwords does not match";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $currPsw=filter_string($_POST['currPsw']);
        $password=sha1($currPsw);

    
        if(!password_verify($password, $hashedPassword)){
            $status="error";
            $message="Current password is incorrect";
            $genMsg=sendResponse($status, $message);   
        }
        else{
            $newPsw=filter_string($_POST['newPsw']);
            $password=sha1($newPsw);
            
            $password=password_hash($password, PASSWORD_DEFAULT);
            $sql=$link->prepare("UPDATE users SET password=? WHERE username=?");
            $sql->bind_param("ss", $password, $username);
            if($sql->execute()){
                $status="success";
                $message="Password has been updated";
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Failed to update password";
                $genMsg=sendResponse($status, $message);
            }        
        }
    }
}


?>