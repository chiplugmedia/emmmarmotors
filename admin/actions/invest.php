<?php

$title = $price = $daily = $duration = $imageooprr = $genMsg = $investmentMsg = "";

if (isset($_POST['addinvestment'])) {
    $title = !empty($_POST['title']) ? $_POST['title'] : '';
    $price = !empty($_POST['price']) ? $_POST['price'] : '';
    $daily = !empty($_POST['daily']) ? $_POST['daily'] : '';
    $duration = !empty($_POST['duration']) ? $_POST['duration'] : '';
    $level = !empty($_POST['level']) ? $_POST['level'] : '';

    if (empty($title)) {
        $status = "error";
        $message = "Enter product title"; 
        $genMsg=sendResponse($status, $message);
    } elseif (empty($price)) {
        $status = "error";
        $message = "Enter product price"; 
        $genMsg=sendResponse($status, $message);
    } elseif (empty($daily)) {
        $status = "error";
        $message = "Enter product daily income";
        $genMsg=sendResponse($status, $message);
    } elseif (empty($duration)) {
        $status = "error";
        $message = "Enter product duration";
        $genMsg=sendResponse($status, $message);
    } elseif (empty($level)) {
        $status = "error";
        $message = "Enter stage";
        $genMsg=sendResponse($status, $message);    
    } elseif (empty($_FILES['image']['name'])) {
        $status = "error";
        $message = "Select an image";
        $genMsg=sendResponse($status, $message);
    } elseif ($_FILES['image']['error'] != 0) {
        $status = "error";
        $message = "There is a problem with the image";
        $genMsg=sendResponse($status, $message);
    } else {
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imgExtArr = explode(".", $imageName);
        $newImgName = get_rand_alphanumeric(10) . "." . end($imgExtArr);
        $allowed = array("png" => "image/png", "jpeg" => "image/jpeg", "jpg" => "image/jpg", "heic" => "application/octet-stream");
        $maxSize = 8 * 1024 * 1024;
        $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (in_array($imageType, $allowed) && $imageSize <= $maxSize) {
            $title = filter_string($_POST['title']);
            $price = filter_string($_POST['price']);
            $daily = filter_string($_POST['daily']);
            $level = filter_string($_POST['level']);
            $duration = filter_string($_POST['duration']);
            $created_at = date('Y-m-d H:i:s');
            $reference = get_rand_alphanumeric(10);
            $status = "active";
            
            $sql = $link->prepare("INSERT INTO investment_plans (title, price, daily, image, level , duration, status, reference, date) VALUES (?, ?, ?, ?,?, ?, ?, ?, ?)");
            $sql->bind_param("sssssssss", $title, $price, $daily, $newImgName, $level, $duration, $status,$reference, $created_at);

            if ($sql->execute()) {
                $path = $_SERVER['DOCUMENT_ROOT'] . "$stream/dash/img/invest/$newImgName";
                move_uploaded_file($imageTmpName, $path);
                $status = "success";
                $message = "Investment product added";
                $genMsg=sendResponse($status, $message);
            } else {
                $status = "error";
                $message = "Something went wrong";
                $genMsg=sendResponse($status, $message);
            }
        } else {
            $status = "error";
            $message = "Invalid image type or size";
            $genMsg=sendResponse($status, $message);
        }
    }
}


if (isset($_POST['deleteinvestment'])) {
    if (empty($_POST['id'])) {
        $status = "error";
        $message = "Invalid request";
        $genMsg=sendResponse($status, $message);
    } else {
        $id = filter_string($_POST['id']);
        $sql = $link->prepare("SELECT * FROM investment_plans WHERE id=?");
        $sql->bind_param("s", $id);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $image = $row['image'];
            
            $sql = $link->prepare("DELETE FROM investment_plans WHERE id=?");
            $sql->bind_param("s", $id);
            if ($sql->execute()) {
                $path = $_SERVER['DOCUMENT_ROOT'] . "$stream/dash/img/invest/$image";
                unlink($path);
                $status = "success";
                $message = "Investment product deleted";
                $genMsg=sendResponse($status, $message);
            } else {
                $status = "error";
                $message = "Something went wrong";
                $genMsg=sendResponse($status, $message);
            }
        } else {
            $status = "error";
            $message = "Investment product not found";
            $genMsg=sendResponse($status, $message);
        }
    }
}



?>