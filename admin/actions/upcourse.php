<?php
$title = $desc = $url = $amount = $genMsg = "";

if (isset($_POST['uploadcourse'])) {

    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
    }
    if (!empty($_POST['desc'])) {
        $desc = $_POST['desc'];
    }
    if (!empty($_POST['url'])) {
        $url = $_POST['url'];
    }
    if (!empty($_POST['amount'])) {
        $amount = $_POST['amount'];
    }

    if (empty($_POST['title'])) {
        $status = "error";
        $message = "Enter post title";
        $genMsg = sendResponse($status, $message);
    } else if (empty($_POST['url'])) {
        $status = "error";
        $message = "Enter post url";
        $genMsg = sendResponse($status, $message);
    } else if (empty($_FILES['image']['name'])) {
        $status = "error";
        $message = "Select an image";
        $genMsg = sendResponse($status, $message);
    } else if ($_FILES['image']['error'] != 0) {
        $status = "error";
        $message = "There is a problem with the image";
        $genMsg = sendResponse($status, $message);
    } else if (empty($_POST['desc'])) {
        $status = "error";
        $message = "Enter post description";
        $genMsg = sendResponse($status, $message);
    } else if ($_POST['amount'] == "") {
        $status = "error";
        $message = "Enter the amount";
        $genMsg = sendResponse($status, $message);
    } else if (!is_numeric($_POST['amount'])) {
        $status = "error";
        $message = "Enter a valid amount";
        $genMsg = sendResponse($status, $message);
    } else {
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imgExtArr = explode(".", $imageName);
        $newImgName = get_rand_alphanumeric(10) . "." . end($imgExtArr);
        $allowed = array(
            "png" => "image/png",
            "jpeg" => "image/jpeg",
            "jpg" => "image/jpg",
            "heic" => "application/octet-stream"
        );
        $maxSize = 8 * 1024 * 1024;
        $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!array_key_exists($extension, $allowed) || !in_array($imageType, $allowed) || $imageSize > $maxSize) {
            $status = "error";
            $message = "Invalid image file or size";
            $genMsg = sendResponse($status, $message);
        } else {
            $title = filter_string($_POST['title']);
            $desc = filter_string($_POST['desc']);
            $url = filter_string($_POST['url']);
            $amount = filter_string($_POST['amount']);
            $reference = get_rand_alphanumeric(10);
            $status = "active";
            $sql = $link->prepare("INSERT INTO subscription_products(title, description, url, image, status, reference, amount, date) VALUES(?,?,?,?,?,?,?,?)");
            $sql->bind_param("ssssssss", $title, $desc, $url, $newImgName, $status, $reference, $amount, $dateTime);

            if ($sql->execute()) {
                $path = $_SERVER['DOCUMENT_ROOT'] . "$stream/dash/img/course/$newImgName";
                move_uploaded_file($imageTmpName, $path);

                $status = "success";
                $message = "Course added";
                $genMsg = sendResponse($status, $message);
            } else {
                $status = "error";
                $message = "Something went wrong adding Course";
                $genMsg = sendResponse($status, $message);
            }
        }
    }
}

if (isset($_POST['deletePost'])) {
    if (empty($_POST['id'])) {
        $status = "error";
        $message = "Invalid request";
        $genMsg = sendResponse($status, $message);
    } else {
        $id = filter_string($_POST['id']);
        $sql = $link->prepare("SELECT * FROM subscription_products WHERE id=?");
        $sql->bind_param("s", $id);
        $sql->execute();
        $result = $sql->get_result();
        $numrow = $result->num_rows;
        $row = $result->fetch_assoc();
        
        if ($numrow == 1) {
            $image = $row['image'];
            $sql = $link->prepare("DELETE FROM subscription_products WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()) {
                $path = $_SERVER['DOCUMENT_ROOT'] . "$stream/dash/img/course/$image";
                unlink($path);
                $status = "success";
                $message = "Course deleted";
                $genMsg = sendResponse($status, $message);
            } else {
                $status = "error";
                $message = "Something went wrong";
                $genMsg = sendResponse($status, $message);
            }
        } else {
            $status = "error";
            $message = "Course not found";
            $genMsg = sendResponse($status, $message);
        }
    }
}
?>
