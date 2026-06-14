<?php
$genMsg=$title=$location=$desc=$sellerName=$price=$contact=$image1="";

if(isset($_POST['addProduct'])){

    if(!empty($_POST['title'])){
        $title=filter_string($_POST['title']);
    }
    if(!empty($_POST['price'])){
        $price=filter_string($_POST['price']);
    }
    if(!empty($_POST['sellerName'])){
        $sellerName=filter_string($_POST['sellerName']);
    }
    if(!empty($_POST['location'])){
        $location=filter_string($_POST['location']);
    }
    if(!empty($_POST['contact'])){
        $contact=filter_string($_POST['contact']);
    }
    if(!empty($_POST['desc'])){
        $desc=filter_string($_POST['desc']);
    }
    
    if(empty($_POST['title'])){
        $status="error";
        $message="Enter product title";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['price'])){
        $status="error";
        $message="Enter product price";
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['price'])){
        $status="error";
        $message="Enter a valid product price";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['sellerName'])){
        $status="error";
        $message="Enter product seller's name";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['location'])){
        $status="error";
        $message="Enter product location";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['contact'])){
        $status="error";
        $message="Enter product contact";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['desc'])){
        $status="error";
        $message="Enter product description";
        $genMsg=sendResponse($status, $message);
    }
    else if(!isset($_FILES['img1']) || empty($_FILES['img1'])){
        $status="error";
        $message="Enter product image";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $title=filter_string($_POST['title']);
        $price=filter_string($_POST['price']);
        $sellerName=filter_string($_POST['sellerName']);
        $location=filter_string($_POST['location']);
        $contact=filter_string($_POST['contact']);
        $desc=filter_string($_POST['desc']);
        $showInHomePage=(isset($_POST['showInHomePage'])) ? 1 : 0;
        $showInDashboard=(isset($_POST['showInDashboard'])) ? 1 : 0;
        $reference=get_rand_alphanumeric(20);
        $imageName1=$imageName2=$imageName3=$imageName4="";
        $imgCount=-1;
        $imgSuccessCount=$imgCountAll=0;
        $imgArr=array();


        if(isset($_FILES['img1']['name']) && $_FILES['img1']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img1']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName1=$response['data']['imageName'];
            }
        }
        if(isset($_FILES['img2']['name']) && $_FILES['img2']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img2']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName2=$response['data']['imageName'];
            }
        }
        if(isset($_FILES['img3']['name']) && $_FILES['img3']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img3']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName3=$response['data']['imageName'];
            }
        }
        if(isset($_FILES['img4']['name']) && $_FILES['img4']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img4']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName4=$response['data']['imageName'];
            }
        }

        foreach($imgArr as $key => $value){
            if($imgArr[$key]['status'] == "success"){
                $imgSuccessCount++;
            }
            else{
                $status=$imgArr[$key]['status'];
                $message=$imgArr[$key]['message'];
                $delImages=array($imageName1, $imageName2, $imageName3, $imageName4);
                deleteAllUploadedImage($delImages);
                $genMsg=sendResponse($status, $message);
                break;
            }
        }

        if($imgCountAll == $imgSuccessCount){
            $sql=$link->prepare("INSERT INTO products(title, price, sellername, location, contact, image1, image2, image3, image4, description, showhome, showdash, reference, date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sql->bind_param("ssssssssssssss", $title, $price, $sellerName, $location, $contact, $imageName1, $imageName2, $imageName3, $imageName4, $desc, $showInHomePage, $showInDashboard, $reference, $dateTime);
            if($sql->execute()){
                $sql=$link->prepare("INSERT INTO productview(reference, date) VALUES(?,?)");
                $sql->bind_param("ss", $reference, $dateTime);
                $sql->execute();

                $status="success";
                $message="Product uploaded successfully";
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Failed to upload product";
                $genMsg=sendResponse($status, $message);
            }
        }
        
    }
}


if(isset($_POST['updateProduct'])){

    if(!empty($_POST['title'])){
        $title=filter_string($_POST['title']);
    }
    if(!empty($_POST['price'])){
        $price=filter_string($_POST['price']);
    }
    if(!empty($_POST['sellerName'])){
        $sellerName=filter_string($_POST['sellerName']);
    }
    if(!empty($_POST['location'])){
        $location=filter_string($_POST['location']);
    }
    if(!empty($_POST['contact'])){
        $contact=filter_string($_POST['contact']);
    }
    if(!empty($_POST['desc'])){
        $desc=filter_string($_POST['desc']);
    }
    $showDash=(isset($_POST['showInDashboard'])) ? "checked" : "";
    $showHome=(isset($_POST['showInHomePage'])) ? "checked" : "";
    
    if(empty($_POST['reference'])){
        $status="error";
        $message="Something went wrong";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['title'])){
        $status="error";
        $message="Enter product title";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['price'])){
        $status="error";
        $message="Enter product price";
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['price'])){
        $status="error";
        $message="Enter a valid product price";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['sellerName'])){
        $status="error";
        $message="Enter product seller's name";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['location'])){
        $status="error";
        $message="Enter product location";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['contact'])){
        $status="error";
        $message="Enter product contact";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['desc'])){
        $status="error";
        $message="Enter product description";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $reference=filter_string($_POST['reference']);
        $title=filter_string($_POST['title']);
        $price=filter_string($_POST['price']);
        $sellerName=filter_string($_POST['sellerName']);
        $location=filter_string($_POST['location']);
        $contact=filter_string($_POST['contact']);
        $desc=filter_string($_POST['desc']);
        $showInHomePage=(isset($_POST['showInHomePage'])) ? 1 : 0;
        $showInDashboard=(isset($_POST['showInDashboard'])) ? 1 : 0;
        $oldImage1=$imageName1=filter_string($_POST['oldImage1']);
        $oldImage2=$imageName2=filter_string($_POST['oldImage2']);
        $oldImage3=$imageName3=filter_string($_POST['oldImage3']);
        $oldImage4=$imageName4=filter_string($_POST['oldImage4']);

        $imgCount=-1;
        $imgSuccessCount=$imgCountAll=0;
        $imgArr=array();


        if(isset($_FILES['img1']['name']) && $_FILES['img1']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img1']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName1=$image1=$response['data']['imageName'];
                $delImages=array($oldImage1);
                deleteAllUploadedImage($delImages);
            }
        }
        if(isset($_FILES['img2']['name']) && $_FILES['img2']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img2']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName2=$image2=$response['data']['imageName'];
                $delImages=array($oldImage2);
                deleteAllUploadedImage($delImages);
            }
        }
        if(isset($_FILES['img3']['name']) && $_FILES['img3']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img3']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName3=$image3=$response['data']['imageName'];
                $delImages=array($oldImage3);
                deleteAllUploadedImage($delImages);
            }
        }
        if(isset($_FILES['img4']['name']) && $_FILES['img4']['error'] == 0){
            $imgCount++;
            $imgCountAll++;
            $response=uploadImage($_FILES['img4']);
            $imgStatus=$response['status'];
            $imgMessage=$response['message'];
            $imgArr[$imgCount]['status']=$imgStatus;
            $imgArr[$imgCount]['message']=$imgMessage;

            if($imgStatus == "success"){
                $imageName4=$image4=$response['data']['imageName'];
                $delImages=array($oldImage4);
                deleteAllUploadedImage($delImages);
            }
        }

        foreach($imgArr as $key => $value){
            if($imgArr[$key]['status'] == "success"){
                $imgSuccessCount++;
            }
            else{
                $status=$imgArr[$key]['status'];
                $message=$imgArr[$key]['message'];
                $delImages=array($imageName1, $imageName2, $imageName3, $imageName4);
                deleteAllUploadedImage($delImages);
                $genMsg=sendResponse($status, $message);
                break;
            }
        }

        if($imgCountAll == $imgSuccessCount){
            $sql=$link->prepare("UPDATE products SET title=?, price=?, sellername=?, location=?, contact=?, image1=?, image2=?, image3=?, image4=?, description=?, showhome=?, showdash=? WHERE reference=?");
            $sql->bind_param("sssssssssssss", $title, $price, $sellerName, $location, $contact, $imageName1, $imageName2, $imageName3, $imageName4, $desc, $showInHomePage, $showInDashboard, $reference);
            if($sql->execute()){
                $status="success";
                $message="Product updated successfully";
                $genMsg=sendResponse($status, $message);
            }
            else{
                $status="error";
                $message="Failed to upload product";
                $genMsg=sendResponse($status, $message);
            }
        }
        
    }
}


if(isset($_POST['deleteProduct'])){
    if(empty($_POST['reference'])){
        $status="error";
        $message="Something went wrong";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $reference=filter_string($_POST['reference']);
        $sql=$link->prepare("SELECT * FROM products WHERE reference=?");
        $sql->bind_param("s", $reference);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $row=$result->fetch_assoc();
        if($numrow == 1){
            $image1=$row['image1'];
            $image2=$row['image2'];
            $image3=$row['image3'];
            $image4=$row['image4'];
            $delImages=array($image1, $image2, $image3, $image4);
            deleteAllUploadedImage($delImages);
        }


        $sql=$link->prepare("DELETE FROM products WHERE reference=?");
        $sql->bind_param("s", $reference);
        if($sql->execute()){
            $sql=$link->prepare("DELETE FROM productview WHERE reference=?");
            $sql->bind_param("s", $reference);
            $sql->execute();

            $status="success";
            $message="Product deleted";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Failed to delete";
            $genMsg=sendResponse($status, $message);
        }
    }
}


function deleteAllUploadedImage($delImages){
    global $stream;
    foreach($delImages as $image){
        $oldPath=$_SERVER['DOCUMENT_ROOT']."$stream/assets/images/products/$image";
        unlink($oldPath);
    }
}
        
function uploadImage($imageData){
    global $stream;
    if(isset($imageData['name']) && $imageData['error'] == 0){
        $imageName=$imageData['name'];
        $imageType=$imageData['type'];
        $imageTmpName=$imageData['tmp_name'];
        $imageSize=$imageData['size'];
        $imgExtArr=explode(".", $imageName);
        $newImgName=get_rand_alphanumeric(10).".".strtolower(end($imgExtArr));
        $allowed=array("png" => "image/png", "jpeg" => "image/jpeg", "jpg" => "image/jpg", "heic" => "application/octet-stream");
        $maxSize=5 * 1024 * 1024;
        $extension=strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if(!array_key_exists($extension, $allowed)){
            $status="error";
            $message="File is not an image";
            $response=array("status" => $status, "message" => $message);   
        }
        else if(!in_array($imageType, $allowed)){
            $status="error";
            $message="File is not an image";
            $response=array("status" => $status, "message" => $message);   
        }
        else if($imageSize > $maxSize){
            $status="error";
            $message="Image is too big, max size: 5MB";
            $response=array("status" => $status, "message" => $message);   
        }
        else{
            $path=$_SERVER['DOCUMENT_ROOT']."$stream/admin/assets/images/products/$newImgName";
            if(move_uploaded_file($imageTmpName, $path)){
                $status="success";
                $message="Image uploaded";
                $response=array("status" => $status, "message" => $message, "data" => array("imageName" => $newImgName)); 
            }
            else{
                $status="error";
                $message="Failed to upload image";
                $response=array("status" => $status, "message" => $message); 
            }
        }
    }
    else{
        $status="error";
        $message="Image is not valid";
        $response=array("status" => $status, "message" => $message); 
    }

    return $response;
}
?>