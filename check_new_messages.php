<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT COUNT(*) AS new_messages FROM messages WHERE user_id != $user_id AND created_at > (SELECT last_checked FROM users WHERE id = $user_id)";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row['new_messages'] > 0) {
    echo 'true';
} else {
    echo 'false';
}
?>
