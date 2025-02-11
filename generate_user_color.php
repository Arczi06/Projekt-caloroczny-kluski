<?php
session_start();
include 'config.php';

function generateUserColor($username) {
    $hash = md5($username);
    
    return '#' . substr($hash, 0, 6);
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $color = generateUserColor($username);

    $sql = "UPDATE users SET message_color = '$color' WHERE id = '$username'";

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
