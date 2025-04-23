<?php
// Połączenie z bazą danych
require_once 'config.php'; // Połączenie z bazą danych

// Sprawdzamy, czy ID wiadomości zostało przesłane
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $message_id = $_POST['id'];

    // Przygotowanie zapytania do usunięcia wiadomości
    $sql = "DELETE FROM messages WHERE id = ?";

    // Przygotowanie zapytania
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $message_id); // Wiążemy parametr (i = integer)
        if ($stmt->execute()) {
            // Wiadomość została usunięta
            header("Location: sent_bmessages.php"); // Przekierowanie z komunikatem sukcesu
            exit;
        } else {
            // Błąd podczas usuwania
            echo "Błąd podczas usuwania wiadomości.";
        }
    } else {
        // Błąd przygotowania zapytania
        echo "Błąd zapytania do bazy danych.";
    }
} else {
    // Jeśli nie przesłano prawidłowego ID
    echo "Nieprawidłowe ID wiadomości.";
}
?>
