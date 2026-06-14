<?php
$title=$desc=$titleErr=$descErr=$taskMsg=$urlErr=$url=$type=$typeErr=$isSelectedFb=$isSelectedYt=$isSelectedTw=$isSelectedIg=$isSelectedtg=$genMsg="";

if(isset($_POST['postTask'])){


    if(!empty($_POST['title'])){
        $title=$_POST['title'];
    }
    if(!empty($_POST['desc'])){
        $desc=$_POST['desc'];
    }
    if(!empty($_POST['url'])){
        $url=$_POST['url'];
    }
    if(!empty($_POST['amount'])){
        $amount=$_POST['amount'];
    }
    if(!empty($_POST['type'])){
        $type=$_POST['type'];
        if($type == "facebook"){
            $isSelectedFb="selected";
        }
        else if($type == "youtube"){
            $isSelectedYt="selected";
        }
        else if($type == "twitter"){
            $isSelectedTw="selected";
        }
        else if($type == "instagram"){
            $isSelectedIg="selected";
        }
        else if($type == "telegram"){
            $isSelectedtg="selected";
        }
        
    }

    if(empty($_POST['title'])){
        $status="error";
        $message="Enter post title"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['url'])){
        $status="error";
        $message="Enter post url"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['type'])){
        $status="error";
        $message="Enter social media type";
        $typeErr=sendResponse($status, $message);
    }
    else if(empty($_POST['desc'])){
        $status="error";
        $message="Enter post description"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['amount'] == ""){
        $status="error";
        $message="Enter amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['amount'])){
        $status="error";
        $message="Enter a valid amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $title=filter_string($_POST['title']);
        $desc=filter_string($_POST['desc']);
        $url=filter_string($_POST['url']);
        $amount=filter_string($_POST['amount']);
        $type=filter_string($_POST['type']);
        $reference=get_rand_alphanumeric(10);
        $status="active";
        $sql=$link->prepare("INSERT INTO dailytasks(title, description, url, type, status, reference, amount, date) VALUES(?,?,?,?,?,?,?,?)");
        $sql->bind_param("ssssssss", $title, $desc, $url, $type, $status, $reference, $amount, $dateTime);
        if($sql->execute()){
            
            $status="success";
            $message="Daily task added";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong adding task";
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['deletePost'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrongk"; 
        $genMsg=sendResponse($status, $message);
    } 
    else{
        $id=filter_string($_POST['id']);
        $sql=$link->prepare("SELECT * FROM dailytasks WHERE id=?");
        $sql->bind_param("s", $id);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $row=$result->fetch_assoc();
        if($numrow == 1){
            $image=$row['image'];
            $sql=$link->prepare("DELETE FROM dailytasks WHERE id=?");
            $sql->bind_param("i", $id);
            if($sql->execute()){
                $path=$_SERVER['DOCUMENT_ROOT']."$stream/assets/images/tasks/$image";
                unlink($path); 
                $status="success";
                $message="Sponsored post deleted";
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
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }
    } 
}


if(isset($_POST['completePost'])){
    if(empty($_POST['id'])){
        $status = "error";
        $message = "Something went wrong"; 
        $genMsg = sendResponse($status, $message);
    } 
    else{
        $id = filter_string($_POST['id']);
        $sql = $link->prepare("SELECT * FROM dailytasks WHERE reference=?");
        $sql->bind_param("s", $id);
        $sql->execute();
        $result = $sql->get_result();
        $numrow = $result->num_rows;

        if($numrow == 1){
            $amount = $result->fetch_assoc()['amount'];

            $sql_userTask = $link->prepare("SELECT * FROM usertasks WHERE reference=? AND status='pending'");
            $sql_userTask->bind_param("s", $id);
            $sql_userTask->execute();
            $result_userTask = $sql_userTask->get_result();
            $numrow_userTask = $result_userTask->num_rows;

            if($numrow_userTask > 0){
                $count = 0;

                while($row_userTask = $result_userTask->fetch_assoc()){
                    $username = $row_userTask['username'];

                    $sql_user = $link->prepare("UPDATE users SET funds = funds + ? WHERE username=?");
                    $sql_user->bind_param("ss", $amount, $username);

                    if($sql_user->execute()){
                        $count++;

                        $sql_user = $link->prepare("UPDATE usertasks SET status='completed' WHERE username=? AND reference=?");
                        $sql_user->bind_param("ss", $username, $id);
                        $sql_user->execute();
                    }
                }

                if($count == $numrow_userTask){
                    $status = "success";
                    $message = "Pending user tasks funds have been credited and completed"; 
                    $genMsg = sendResponse($status, $message);
                }
                else{
                    $status = "error";
                    $message = "Something went wrong marking tasks"; 
                    $genMsg = sendResponse($status, $message);
                }
            }
            else{
                $status = "error";
                $message = "No pending task was found"; 
                $genMsg = sendResponse($status, $message);
            }
        }
        else{
            $status = "error";
            $message = "Task was not found 001"; 
            $genMsg = sendResponse($status, $message);
        }
    }
}
?>
