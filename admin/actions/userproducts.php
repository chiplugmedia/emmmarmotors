<?php
// SEND APPROVED POST TO APPROVEDADS DATABaSE
include '../config/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $ads_img = $_POST['ads_img'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $contact_link = $_POST['contact_link'];
    $approve = $_POST['approve'];
    
    $SQL = "INSERT INTO approvedads(username, ads_image, title, text, contact_link, approved)
    VALUES('$username', '$ads_img', '$title', '$text', '$contact_link', '$approve')";

    $RESULT = mysqli_query($conn, $SQL);

    if ($RESULT) {
        echo "Users post has been approved";
    }else {
        echo "Error: Something went wrong. " . $conn->connect_error() . "."; 
    }
}

