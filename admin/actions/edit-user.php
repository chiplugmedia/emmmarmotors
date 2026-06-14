<?php
$genMsg="";

if (isset($_POST['update'])) {
    // Validate inputs
    if (empty($_POST['username'])) {
        $status = "error";
        $message = "Username is required";
        $genMsg = sendResponse($status, $message);
    } elseif ($_POST['funds'] === "") {
        $status = "error";
        $message = "Balance is required";
        $genMsg = sendResponse($status, $message);
    // } elseif ($_POST['totalrefearnings'] === "") {
    //     $status = "error";
    //     $message = "Withdraw funds are required";
    //     $genMsg = sendResponse($status, $message);
    } else {
        // Sanitize inputs
        $username1 = filter_string($_POST['username']);
        $funds = filter_string($_POST['funds']);
        $totalrefearnings = filter_string($_POST['totalrefearnings']);

        // Fetch existing user data
        $sql = $link->prepare("SELECT funds, totalrefearnings FROM users WHERE username = ?");
        $sql->bind_param("s", $username1);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $fundsBefore = $row['funds'];
            $totalrefearningsBefore = $row['totalrefearnings'];

            // Update user details
            $sql = $link->prepare("UPDATE users SET funds = ?, totalrefearnings = ? WHERE username = ?");
            $sql->bind_param("sss", $funds, $totalrefearnings, $username1);

            if ($sql->execute()) {
                  if ($sql->execute()) {
                    $status = "success";
                    $message = "Details have been updated successfully";
                } else {
                    $status = "error";
                    $message = "Failed to log update";
                }
            } else {
                $status = "error";
                $message = "Failed to update user details";
            }
        } else {
            $status = "error";
            $message = "User not found";
        }

        $genMsg = sendResponse($status, $message);
    }
}
?>