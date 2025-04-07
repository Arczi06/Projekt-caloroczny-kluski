<?php
session_start();
require_once 'config.php';

// Pobieramy dane z formularza
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $recipient_id = $_POST['recipient_id']; // ID odbiorcy
    $subject = $_POST['subject']; // Temat wiadomości
    $message_body = $_POST['message_body']; // Treść wiadomości (zmieniłem z message_content na message_body)

    // Sprawdzamy, czy treść wiadomości nie jest pusta
    if (empty($message_body)) {
        echo "Treść wiadomości nie może być pusta.";
        exit;
    }

    // Wstawiamy wiadomość do bazy danych
    $query = "INSERT INTO messages (sender_id, recipient_id, subject, message_body) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $user_id, $recipient_id, $subject, $message_body); // Używamy zmiennej $message_body
    $stmt->execute();
    $stmt->close();

    // Przekierowanie po wysłaniu
    header("Location: sent_bmessages.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="recipient_id" placeholder="ID odbiorcy" required><br>
    <input type="text" name="subject" placeholder="Temat" required><br>
    <textarea name="message_body" placeholder="Treść wiadomości" required></textarea><br>
    <button type="submit">Wyślij</button>
</form>
