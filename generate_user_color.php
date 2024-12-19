<?php
session_start();
include 'config.php';

function generateUserColor($userId) {
    $hash = md5($userId);
    
    return '#' . substr($hash, 0, 6);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $color = generateUserColor($user_id);

    $sql = "UPDATE users SET message_color = '$color' WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Kolor wiadomości został przypisany.";
    } else {
        echo "Błąd podczas zapisywania koloru: " . $conn->error;
    }
} else {
    echo "Użytkownik nie jest zalogowany.";
}

$conn->close();
?>
