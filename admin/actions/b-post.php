<?php
$title=$desc=$titleErr=$descErr=$postMsg=$imageErr==$isSelectedFb=$isSelectedYt=$isSelectedTw=$isSelectedIg=$bpostMsg="";

if(isset($_POST['uploadoPost'])){

    $sql=$link->prepare("SELECT * FROM blog WHERE SUBSTRING(date, 1, 10) = ?");
    $sql->bind_param("s", $date);
    $sql->execute();
    $result=$sql->get_result();
    $numrow=$result->num_rows;

    if(!empty($_POST['title'])){
        $title=$_POST['title'];
    }
    if(!empty($_POST['desc'])){
        $desc=$_POST['desc'];
    }
    
   

    if(empty($_POST['title'])){
        $status="error";
        $message="Enter post title"; 
        $titleErr=sendResponse($status, $message);
    }
    else if(empty($_FILES['image']['name'])){
        $status="error";
        $message="Select an image";
        $imageErr=sendResponse($status, $message);
    }
    else if($_FILES['image']['error'] != 0){
        $status="error";
        $message="There is a problem with image";
        $imageErr=sendResponse($status, $message);
    }
    
    else if(empty($_POST['desc'])){
        $status="error";
        $message="Enter post desctiption";
        $descErr=sendResponse($status, $message);
    }
    
    else{
        $imageName=$_FILES['image']['name'];
        $imageType=$_FILES['image']['type'];
        $imageTmpName=$_FILES['image']['tmp_name'];
        $imageSize=$_FILES['image']['size'];
        $imgExtArr=explode(".", $imageName);
        $newImgName=get_rand_alphanumeric(10).".".end($imgExtArr);
        $allowed=array("png" => "image/png", "jpeg" => "image/jpeg", "jpg" => "image/jpg", "heic" => "application/octet-stream");
        $maxSize=8 * 1024 * 1024;
        $extension=strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if(!array_key_exists($extension, $allowed)){
            $status="error";
            $message="File is not an image";
            $imageErr=sendResponse($status, $message);   
        }
        else if(!in_array($imageType, $allowed)){
            $status="error";
            $message="File is not an image";
            $imageErr=sendResponse($status, $message);   
        }
        else if($imageSize > $maxSize){
            $status="error";
            $message="Image is too big, max size: 8MB";
            $imageErr=sendResponse($status, $message);   
        }
        else{
            $title=filter_string($_POST['title']);
            $desc=filter_string($_POST['desc']);
            $sql=$link->prepare("INSERT INTO blog(title, image, description , date) VALUES(?,?,?,?,?)");
            $sql->bind_param("sssss", $title, $newImgName, $desc, $type, $dateTime);
            if($sql->execute()){
                $path=$_SERVER['DOCUMENT_ROOT']."$stream/dash/img/blogpost/$newImgName";
                move_uploaded_file($imageTmpName, $path);
                $status="success";
                $message="blog post added";
                $postMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Something went wrong";
                $postMsg=sendResponse($status, $message);
            }
        }
    }
}

if(isset($_POST['deletePost'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrongk"; 
        $bpostMsg=sendResponse($status, $message);
    } 
    if(empty($_POST['image'])){
        $status="error";
        $message="Something went wrong"; 
        $bpostMsg=sendResponse($status, $message);
    } 
    else{
        $id=filter_string($_POST['id']);
        $image=filter_string($_POST['image']);
        $sql=$link->prepare("DELETE FROM blog WHERE id=?");
        $sql->bind_param("i", $id);
        if($sql->execute()){
            $path=$_SERVER['DOCUMENT_ROOT']."$stream/dash/img/blogposts/$image";
            unlink($path);
            $status="success";
            $message="blog post deleted";
            $bpostMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong";
            $bpostMsg=sendResponse($status, $message);
        }    
    } 
}
?>