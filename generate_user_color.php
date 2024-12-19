<?php
session_start();
include 'config.php'; // Połączenie z bazą danych

function generateUserColor($userId) {
    // Generujemy hash na podstawie user_id
    $hash = md5($userId);
    
    // Wybieramy pierwsze 6 znaków hasza jako kolor w formacie #RRGGBB
    return '#' . substr($hash, 0, 6);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Generujemy kolor na podstawie user_id
    $color = generateUserColor($user_id);

    // Zapisujemy kolor w bazie danych
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
