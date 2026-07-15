<?php
$dashboardMsg="";

if(isset($_POST['deleteMsg'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong"; 
        $dashboardMsg=sendResponse($status, $message);
    }
    else{
        $id=filter_string($_POST['id']);
        $sql=$link->prepare("DELETE FROM messages WHERE id=?");
        $sql->bind_param("i", $id);
        if($sql->execute()){
            $status="success";
            $message="Announcement deleted"; 
            $dashboardMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $dashboardMsg=sendResponse($status, $message);
        }
    }
}


if(isset($_POST['addMsg'])){
    if(empty($_POST['message'])){
        $status="error";
        $message="Something went wrong"; 
        $dashboardMsg=sendResponse($status, $message);
    }
    else{
        $message=filter_string($_POST['message']);
        $sql=$link->prepare("INSERT INTO messages(message, date) VALUES(?,?)");
        $sql->bind_param("ss", $message, $dateTime);
        if($sql->execute()){
            $status="success";
            $message="Announcement added"; 
            $dashboardMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $dashboardMsg=sendResponse($status, $message);
        }
    }
}