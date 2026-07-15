<?php
$genMsg="";


$username = $_SESSION['username'] ?? 'guest';
$message = $_POST['message'] ?? '';

if ($message != "") {

    $stmt = $link->prepare("INSERT INTO livechat (username, sender, message) VALUES (?, 'user', ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
}


$res = $link->query("SELECT * FROM livechat ORDER BY id ASC");

while ($row = $res->fetch_assoc()) {

    if ($row['sender'] == 'user') {
        echo "<div class='text-right'>
                <span class='bg-yellow-300 text-black px-2 py-1 rounded inline-block'>
                    {$row['message']}
                </span>
              </div>";
    } else {
        echo "<div class='text-left'>
                <span class='bg-white/20 px-2 py-1 rounded inline-block'>
                    {$row['message']}
                </span>
              </div>";
    }
}
?>