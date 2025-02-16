<?php
// Połącz z bazą danych
include 'config.php';

// Rozpocznij sesję, aby przekazać komunikat
session_start();

// Sprawdź, czy ID użytkownika zostało przekazane w URL
if (isset($_GET['id'])) {
    // Pobierz ID użytkownika z URL
    $userId = $_GET['id'];

    // Przygotuj zapytanie SQL do usunięcia użytkownika
    $sql = "DELETE FROM users WHERE id = ?";

    // Przygotowanie zapytania
    if ($stmt = $conn->prepare($sql)) {
        // Zwiąż parametr ID użytkownika z zapytaniem
        $stmt->bind_param("i", $userId);

        // Wykonaj zapytanie
        if ($stmt->execute()) {
            // Ustaw komunikat o sukcesie usunięcia w sesji
            $_SESSION['message'] = "Użytkownik został usunięty.";
            $_SESSION['message_type'] = 'success'; // Można dodać różne typy powiadomień, np. 'success', 'error'
        } else {
            // W przypadku błędu, ustaw komunikat o błędzie
            $_SESSION['message'] = "Błąd podczas usuwania użytkownika.";
            $_SESSION['message_type'] = 'error';
        }
    } else {
        $_SESSION['message'] = "Błąd zapytania.";
        $_SESSION['message_type'] = 'error';
    }

    // Zamknij połączenie z bazą danych
    $stmt->close();
    $conn->close();
}

// Przekierowanie z powrotem do users.php
header("Location: users.php");
exit;
?>
