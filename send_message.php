<?php
session_start();
require_once 'config.php';

// Sprawdzamy, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $recipient_ids = $_POST['recipient_id']; // ID odbiorców (mogą być oddzielone przecinkami)
    $subject = $_POST['subject']; // Temat wiadomości
    $message_body = $_POST['message_body']; // Treść wiadomości

    // Sprawdzamy, czy treść wiadomości nie jest pusta
    if (empty($message_body) || empty($subject) || empty($recipient_ids)) {
        echo "Wszystkie pola są wymagane.";
        exit;
    }

    // Zamieniamy recipient_ids na tablicę
    $recipient_ids_array = explode(',', $recipient_ids);

    // Przechodzimy przez każdego odbiorcę i zapisujemy wiadomość do bazy danych
    foreach ($recipient_ids_array as $recipient_id) {
        // Usuwamy zbędne białe znaki
        $recipient_id = trim($recipient_id);

        // Wstawiamy wiadomość do bazy danych
        $query = "INSERT INTO messages (sender_id, recipient_id, subject, message_body) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiss", $user_id, $recipient_id, $subject, $message_body);
        $stmt->execute();
        $stmt->close();
    }

    // Przekierowanie po wysłaniu wiadomości
    header("Location: sent_bmessages.php");
    exit;
}
?>
