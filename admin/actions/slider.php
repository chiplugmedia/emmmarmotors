<?php
$genMsg="";

if(isset($_POST['deleteSlider'])){
    if(empty($_POST['id'])){
        $status="error";
        $message="Something went wrong"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $id=filter_string($_POST['id']);
        $sql=$link->prepare("DELETE FROM sliders WHERE id=?");
        $sql->bind_param("s", $id);
        if($sql->execute()){
            if($_POST['oldImg']){
                $oldImg=$_POST['oldImg'];
                $oldLink=$_SERVER['DOCUMENT_ROOT']."$stream/app/assets/img/sliders/$oldImg";
                unlink($oldLink);
            }

            $status="success";
            $message="Slider image deleted"; 
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Something went wrong"; 
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['uploadSlider'])){
    if(!empty($_POST['url'])){
        $url=$_POST['url'];
    }
    if(empty($_POST['url'])){
        $status="error";
        $message="Enter slider url"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
    if(isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0){
        $imageName=$_FILES['image']['name'];
        $imageType=$_FILES['image']['type'];
        $imageTmpName=$_FILES['image']['tmp_name'];
        $imageSize=$_FILES['image']['size'];
        $imgExtArr=explode(".", $imageName);
        $newImgName=get_rand_alphanumeric(10).".".end($imgExtArr);
        $allowed=array("png" => "image/png", "jpeg" => "image/jpeg", "jpg" => "image/jpg", "heic" => "application/octet-stream");
        $maxSize=10 * 1024 * 1024;
        $extension=strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if(!array_key_exists($extension, $allowed)){
            $status="error";
            $message="File is not an image";
            $genMsg=sendResponse($status, $message);   
        }
        else if(!in_array($imageType, $allowed)){
            $status="error";
            $message="File is not an image";
            $genMsg=sendResponse($status, $message);   
        }
        else if($imageSize > $maxSize){
            $status="error";
            $message="Image is too big, max size: 10MB";
            $genMsg=sendResponse($status, $message);   
        }
        else{
            $url=filter_string($_POST['url']);
            
            $sql=$link->prepare("INSERT INTO sliders(image, url, date) VALUES(?,?,?)");
            $sql->bind_param("sss", $newImgName, $url, $dateTime);
            $sql->execute();

            $path=$_SERVER['DOCUMENT_ROOT']."$stream/app/assets/img/sliders/$newImgName";
            move_uploaded_file($imageTmpName, $path);
           // $profilePhoto=$newImgName;

            $status="success";
            $message="Slider image has been added";
            $genMsg=sendResponse($status, $message);
            
        }
    }
    else{
        $status="error";
        $message="Please choose a valid photo";
        $genMsg=sendResponse($status, $message);
    }
    }
}
?>