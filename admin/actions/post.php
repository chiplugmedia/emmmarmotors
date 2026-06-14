<?php
$title = $content = $image = $author = $titleprr = $OpostMsg = $contentprr = $imageprr = $authorprr = $bppostMsg=$author_id="";

if (isset($_POST['bPostupload'])) {
    // Your existing code for handling post creation goes here
    if (empty($_POST['title'])) {
        $status = "error";
        $message = "Enter post title";
        $titleprr = sendResponse($status, $message);
    } elseif (empty($_POST['content'])) {
        $status = "error";
        $message = "Enter post content";
        $contentprr = sendResponse($status, $message);
    } elseif (empty($_FILES['image']['name'])) {
        $status = "error";
        $message = "Select an image";
        $imageprr = sendResponse($status, $message);
    } elseif ($_FILES['image']['error'] != 0) {
        $status = "error";
        $message = "There is a problem with the image";
        $imageprr = sendResponse($status, $message);
    } elseif (empty($_POST['author_id'])) {
        $status = "error";
        $message = "Enter post author";
        $authorprr = sendResponse($status, $message);
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

        // ... Your existing code for validating image properties

        // If image validation passes, proceed with database insertion
        $title = filter_string($_POST['title']);
        $content = filter_string($_POST['content']);
        $author_id = filter_string($_POST['author_id']);
        $sql = $link->prepare("INSERT INTO posts (title, content, image, author_id, created_at) VALUES(?,?,?,?,?)");
        $sql->bind_param("sssss", $title, $content, $newImgName, $author_id, $dateTime);

        if ($sql->execute()) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "$stream/dashboard/img/posts/$newImgName";
            move_uploaded_file($imageTmpName, $path);
            $status = "success";
            $message = "Popup post added";
            $OpostMsg = sendResponse($status, $message);
        } else {
            $status = "error";
            $message = "Something went wrong";
            $OpostMsg = sendResponse($status, $message);
        }
    }
}

if (isset($_POST['deletebPost'])) {
    // Your existing code for handling post deletion goes here
    if (empty($_POST['post_id']) || empty($_POST['image'])) {
        $status = "error";
        $message = "Something went wrong";
        $bppostMsg = sendResponse($status, $message);
    } else {
        $post_id = filter_string($_POST['post_id']);
        $image = filter_string($_POST['image']);
        $sql = $link->prepare("DELETE FROM posts WHERE post_id=?");
        $sql->bind_param("i", $post_id);

        if ($sql->execute()) {
            // Delete the associated image from the server
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "$stream/dashboard/img/posts/$image";
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $status = "success";
            $message = "News post deleted";
            $bppostMsg = sendResponse($status, $message);
        } else {
            $status = "error";
            $message = "Something went wrong";
            $bppostMsg = sendResponse($status, $message);
        }
    }
}
?>