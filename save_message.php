<?php
include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    die("Nie jesteś zalogowany.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Wiadomość została wysłana.";
    } else {
        echo "Błąd: " . $conn->error;
    }
} else {
    echo "Brak wiadomości do wysłania.";
}

$conn->close();
?>
