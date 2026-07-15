<?php
$genMsg="";

if(isset($_POST['saveProfile'])){

    if(empty($_POST['phone'])){

        $genMsg = sendResponse("error", "Enter phone number");

    } else {

        $phone = filter_string($_POST['phone']);

        if(isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0){

            $imageName    = $_FILES['image']['name'];
            $imageType    = $_FILES['image']['type'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageSize    = $_FILES['image']['size'];

            $imgExtArr = explode(".", $imageName);
            $newImgName = get_rand_alphanumeric(10).".".end($imgExtArr);

            $allowed = [
                "png"  => "image/png",
                "jpeg" => "image/jpeg",
                "jpg"  => "image/jpg",
                "heic" => "application/octet-stream"
            ];

            $maxSize = 5 * 1024 * 1024;
            $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            if(!array_key_exists($extension, $allowed)){

                $genMsg = sendResponse("error", "File is not an image");

            } elseif(!in_array($imageType, $allowed)){

                $genMsg = sendResponse("error", "File is not an image");

            } elseif($imageSize > $maxSize){

                $genMsg = sendResponse("error", "Image is too big, max size: 5MB");

            } else {

                $sql = $link->prepare("UPDATE users SET phone=? WHERE username=?");
                $sql->bind_param("ss", $phone, $username);

                if($sql->execute()){

                    $sql = $link->prepare("UPDATE users SET image=? WHERE username=?");
                    $sql->bind_param("ss", $newImgName, $username);
                    $sql->execute();

                    if($profileImg != "default.png"){

                        $oldPath = $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/assets/img/profilephotos/$profileImg";

                        if(file_exists($oldPath)){
                            unlink($oldPath);
                        }
                    }

                    $path = $_SERVER['DOCUMENT_ROOT']."$stream/dashboard/assets/img/profilephotos/$newImgName";
                    move_uploaded_file($imageTmpName, $path);

                    $_SESSION['success_msg'] = "Details has been saved";

                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();

                } else {

                    $genMsg = sendResponse("error", "Failed to save details");
                }
            }
        }
    }
}

if(isset($_SESSION['success_msg'])){

    echo sendResponse("success", $_SESSION['success_msg']);
    unset($_SESSION['success_msg']);
}




if(isset($_POST['deleteImg'])){
    $sql=$link->prepare("UPDATE users SET image='default.png' WHERE username=?");
    $sql->bind_param("s", $username);
    if($sql->execute()){
        if($profileImg != "default.png"){
            $oldPath=$_SERVER['DOCUMENT_ROOT']."$stream/dashboard/assets/img/profilephotos/$profileImg";
            unlink($oldPath);
        }
        $profileImg="default.png";
        $status="success";
        $message="Profile photo deleted";
        $genMsg=sendResponse($status, $message);
    }
    
}

if(isset($_POST['saveBank'])){
   
    if(!empty($_POST['bankName'])){
        $bankName=$_POST['bankName'];
    }
    if(!empty($_POST['acctName'])){
        $acctName=$_POST['acctName'];
    }
    if(!empty($_POST['acctNum'])){
        $acctNum=$_POST['acctNum'];
    }

    if(empty($_POST['bankName'])){
        $status="error";
            $message="Select your bank name"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['acctName'])){
        $status="error";
        $message="Enter your account name";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['acctNum'])){
        $status="error";
        $message="Enter your account number";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $bankAndCode=filter_string($_POST['bankName']);
        $bankAndCode=explode("_", $bankAndCode);
        $bankCode=$bankAndCode[0];
        $bankName=$bankAndCode[1];
        $acctName=filter_string($_POST['acctName']);
        $acctNum=filter_string($_POST['acctNum']);

        $sql=$link->prepare("SELECT * FROM bankaccounts WHERE username=?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        

        if($numrow == 0){
            $sql=$link->prepare("INSERT INTO bankaccounts(username, bankname, acctname, acctnum, bankcode, date) VALUES(?,?,?,?,?,?)");
            $sql->bind_param("ssssss", $username, $bankName, $acctName, $acctNum, $bankCode, $dateTime);
        }
        else{
            $sql=$link->prepare("UPDATE bankaccounts SET  bankname=?, acctname=?, acctnum=?, bankcode=? WHERE username=?");
            $sql->bind_param("sssss", $bankName, $acctName, $acctNum, $bankCode, $username);
        }
        if($sql->execute()){
            $status="success";
            $message="Bank Details has been saved";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Failed to save details";
            $genMsg=sendResponse($status, $message);
        }
    }
}





?>