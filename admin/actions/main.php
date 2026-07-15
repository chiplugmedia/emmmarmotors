<?php
$genMsg=$postTitle=$postMessage="";
function replaceAllChar($string) {
    $replacement="<b>$0</b>";
    $pattern="#\*\*(.*?)\*\*#";
    $string=preg_replace($pattern, $replacement , $string);
    $replacedString=str_replace("**", "", $string);

    $replacement="<i>$0</i>";
    $pattern="#\*(.*?)\*#";
    $string=preg_replace($pattern, $replacement , $replacedString);
    $replacedString=str_replace("*", "", $string);

    return $replacedString;
}

function reformatAllChar($string) {
    $replacedString=str_replace("<b>", "**", $string);
    $replacedString=str_replace("</b>", "**", $replacedString);
    $replacedString=str_replace("<i>", "*", $replacedString);
    $replacedString=str_replace("</i>", "*", $replacedString);

    return $replacedString;
}



if(isset($_POST['postMsg'])){
    if(!empty($_POST['title'])){
        $postTitle=$_POST['title'];
    }
    if(!empty($_POST['message'])){
        $postMessage=$_POST['message'];
    }

    if(empty($_POST['title'])){
        $status="error";
        $message="Enter title"; 
        $genMsg=sendResponse($status, $message);
    } 
    else if(empty($_POST['message'])){
        $status="error";
        $message="Enter message"; 
        $genMsg=sendResponse($status, $message);
    } 
    else{
        $postTitle=filter_string($_POST['title']);
        $postMessage=filter_string($_POST['message']);
        $postMessage=replaceAllChar($postMessage);
        
        $sql=$link->prepare("INSERT INTO notifications (title, message, date) VALUES(?,?,?)");
        $sql->bind_param("sss", $postTitle, $postMessage, $dateTime);
        if($sql->execute()){
            $postMessage=reformatAllChar($postMessage);
            $status="success";
            $message="Message added";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }    
    } 
}


if(isset($_POST['deleteMsg'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    } 
    else{
        $id=filter_string($_POST['id']);
        $sql=$link->prepare("DELETE FROM notifications WHERE id=?");
        $sql->bind_param("i", $id);
        if($sql->execute()){
            $status="success";
            $message="Message deleted";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }    
    } 
}

if(isset($_POST['resolvePending'])){
    $date=date("d-m-Y");
    $sql=$link->prepare("SELECT * FROM transactions WHERE SUBSTRING(date, 1, 10) = ? AND status ='pending' ");
    $sql->bind_param("s", $date);
    $sql->execute();
    $result=$sql->get_result();
    $numrow=$result->num_rows;
    if($numrow > 0){
        while($row=$result->fetch_assoc()){
            $type=$row['type'];
            if($type == "airtime" || $type == "electricity"){
                $amount=$row['amountcharged'];
            }
            else{
                $amount=$row['amount'];
            }
            $username=$row['username'];
            $reference=$row['ownreference'];
            
            $sql_user=$link->prepare("UPDATE users SET funds=funds + ? WHERE username=?");
            $sql_user->bind_param("ss", $amount, $username);
            if($sql_user->execute()){
                $sql_trx=$link->prepare("UPDATE transactions SET status='failed', message='Transaction failed' WHERE ownreference=?");
                $sql_trx->bind_param("s", $reference);
                $sql_trx->execute();
                
                $status="success";
                $message="Pending Transactions Resolved";
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Failed to resolve transaction";
                $genMsg=sendResponse($status, $message);
            }
        }
    }
    else{
        $status="error";
        $message="No pending transaction was found";
        $genMsg=sendResponse($status, $message);
    }
}
?>