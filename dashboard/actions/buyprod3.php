<?php
$genMsg = $title = $price = $daily_income099 = $duration = $imagePath = "";

// if (isset($_POST['investin'])) {
//     if (empty($_POST['reference'])) {
//         $genMsg = sendResponse("error", "Reference is required");
//     } else {
//         // Sanitize and validate input
//         $reference = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//         // Check if user has already purchased the package
//         $sql = $link->prepare("SELECT * FROM user_investments WHERE reference=?");
//         $sql->bind_param("s", $reference);
//         $sql->execute();
//         $result = $sql->get_result();
//         if ($result->num_rows > 0) {
//             $genMsg = sendResponse("error", "You have already purchased this package");
//         } else {
//             // Get investment plan details
// $sql = $link->prepare("SELECT * FROM investment_plans WHERE id=?");
// $sql->bind_param("s", $id);
// $sql->execute();
// $result = $sql->get_result();
// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $title = $row['title'];
//     $price = $row['price'];
//     $daily_income = $row['daily_income']; // Correctly fetching daily income from the database
//     $duration = $row['duration'];
//     $image = $row['image'];

//     $boughtAt = date('Y-m-d H:i:s');

//     // Fetch user funds
//     $sql = $link->prepare("SELECT funds FROM users WHERE username=?");
//     $username = $_SESSION['username']; // Assuming username is stored in session
//     $sql->bind_param("s", $username);
//     $sql->execute();
//     $result = $sql->get_result();
//     if ($result->num_rows == 1) {
//         $row = $result->fetch_assoc();
//         $funds = $row['funds'];

//         if ($price > $funds) {
//             $genMsg = sendResponse("error", "Insufficient funds in your activity wallet");
//         } else {
//             // Process investment
//             $expirationDate = date('Y-m-d H:i:s', strtotime("$boughtAt + $duration days"));

//             // Deduct funds from the user's account
//             $sql_deduct = $link->prepare("UPDATE users SET funds = funds - ? WHERE username = ?");
//             $sql_deduct->bind_param("ds", $price, $username);
//             $sql_deduct->execute();
//             if ($sql_deduct->affected_rows > 0) {
//                 // Insert investment into the database
//                 $newStatus = "active";
//                 $sql_insert = $link->prepare("INSERT INTO user_investments (username, title, price, image, daily_income, duration, expiration_date, status, reference, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//                 $sql_insert->bind_param("ssssssssss", $username, $title, $price, $image, $daily_income, $duration, $expirationDate, $newStatus, $reference, $boughtAt);

//                             if ($sql_insert->execute()) {
//                                 // Update user funds with daily income immediately
//                                 $sql_update_funds = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
//                                 $sql_update_funds->bind_param("ds", $daily_income, $username);
//                                 $sql_update_funds->execute();
//                                 if ($sql_update_funds->affected_rows > 0) {
//                                     // Log the user's immediate earnings
//                                     $type = "Daily Income";
//                                     $time = time();
//                                     $dateTime = date('Y-m-d H:i:s', $time);
//                                     $sql_log_earnings = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
//                                     $sql_log_earnings->bind_param("sssss", $username, $type, $daily_income, $time, $dateTime);
//                                     $sql_log_earnings->execute();

//                                     $genMsg = sendResponse("success", "Investment successfully purchased");
//                                 } else {
//                                     $genMsg = sendResponse("error", "Error updating funds with daily income");
//                                 }
//                             } else {
//                                 $genMsg = sendResponse("error", "Error processing investment");
//                             }
//                         } else {
//                             $genMsg = sendResponse("error", "Error deducting funds");
//                         }
//                     }
//                 } else {
//                     $genMsg = sendResponse("error", "User not found");
//                 }
//             } else {
//                 $genMsg = sendResponse("error", "Invalid investment plan");
//             }
//         }
//     }
// }

// // Update active investments
// $sql_select_investments = "SELECT * FROM user_investments WHERE status='active'";
// $result_investments = $link->query($sql_select_investments);

// if ($result_investments->num_rows > 0) {
//     while ($row_investment = $result_investments->fetch_assoc()) {
//         $username = $row_investment['username'];
//         $daily_income = $row_investment['daily_income'];
//         $expiration_date = $row_investment['expiration_date'];

//         // Check if the investment is still active
//         if (new DateTime() >= new DateTime($expiration_date)) {
//             // Set investment status to expired
//             $sql_expire = $link->prepare("UPDATE user_investments SET status='expired' WHERE username=? AND expiration_date=?");
//             $sql_expire->bind_param("ss", $username, $expiration_date);
//             $sql_expire->execute();
//         } else {
//             // Add daily income to the user's funds if the investment is still active
//             $sql_update_funds = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
//             $sql_update_funds->bind_param("ds", $daily_income, $username);
//             $sql_update_funds->execute();

//             // Log the user's earnings
//             $type = "Daily Income";
//             $time = time();
//             $dateTime = date('Y-m-d H:i:s', $time);
//             $sql_log_earnings = $link->prepare("INSERT INTO userearnings (username, type, amount, time, date) VALUES (?, ?, ?, ?, ?)");
//             $sql_log_earnings->bind_param("sssss", $username, $type, $daily_income, $time, $dateTime);
//             $sql_log_earnings->execute();
//         }
//     }
// }


?>
