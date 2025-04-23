<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Użytkownik niezalogowany."]);
    exit();
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Błąd połączenia: " . $conn->connect_error]));
}

$query = "
    SELECT COUNT(*) AS new_reactions 
    FROM user_reactions ur 
    WHERE ur.user_id != $user_id 
    AND ur.created_at > (SELECT last_checked_reactions FROM users WHERE id = $user_id)
";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($row['new_reactions'] > 0) {
    echo 'true';
} else {
    echo 'false';
}

$conn->close();
?>
