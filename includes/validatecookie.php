<?php
if(isset($_COOKIE['username']) && !empty($_COOKIE['username']) && isset($_COOKIE['password']) && !empty($_COOKIE['password'])){
    $cookieUsername=filter_string($_COOKIE['username']);
    $cookiePassword=filter_string($_COOKIE['password']);
    
    $sql=$link->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $sql->bind_param("ss", $cookieUsername, $cookieUsername);
    $sql->execute();
    $result=$sql->get_result();
    $numrow=$result->num_rows;
    $row=$result->fetch_assoc();
    if($numrow == 1){
        $mainPassword=$row['password'];
        $role=$row['role'];
        if(password_verify($cookiePassword, $mainPassword)){
            session_regenerate_id();
            $_SESSION['username']=$cookieUsername;
            $_SESSION['role']=$role;
            session_write_close();
            
            if($role == "user" || $role == "vendor"){
                header("location:$stream/app/index");
            }
            else if($role == "admin"){
                header("location:$stream/admin/");
            }
        }
        else{
            header("location:$stream/");
        }
    }
    else{
        header("location:$stream/");
        exit;
    }
}


?>