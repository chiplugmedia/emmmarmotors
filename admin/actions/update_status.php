<?php
// Check if reference and new_status are set
if(isset($_POST['reference'], $_POST['new_status'])) {
    // Prepare and bind parameters
    // Assuming $conn is already defined elsewhere in your code
    $sql = $conn->prepare("UPDATE products SET status = ? WHERE reference = ?");
    $sql->bind_param("ss", $_POST['new_status'], $_POST['reference']);

    // Execute the update query
    if ($sql->execute()) {
        // If the update was successful, return success message
        echo json_encode(array("success" => true, "message" => "Status updated successfully"));
    } else {
        // If an error occurred, return error message
        echo json_encode(array("success" => false, "message" => "Error updating status"));
    }
} else {
    // If reference or new_status is not set, return error message
    echo json_encode(array("success" => false, "message" => "Missing parameters"));
}
?>
