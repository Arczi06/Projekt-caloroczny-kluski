<?php
// Sprawdzenie, czy połączenie z bazą danych zostało przekazane
function assignMessageClass($messages, $conn) {
    foreach ($messages as $key => $message) {
        // Pobieranie koloru wiadomości dla użytkownika
        $userId = $message['user_id'];
        $sql = "SELECT message_color FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($messageColor);
        $stmt->fetch();

        // Dodawanie klasy CSS z kolorem do wiadomości
        $messages[$key]['class'] = "message" . $userId; // Przykład klasy, możesz ją dostosować
        $messages[$key]['messageColor'] = $messageColor; // Zapisujemy kolor wiadomości
        $stmt->close();
    }

    $messageHtml = '';

    // Generowanie HTML z wiadomościami z przypisaną klasą
    foreach ($messages as $message) {
        $messageHtml .= '<div class="message" style="border-color: ' . htmlspecialchars($message['messageColor']) . ';">
                            <span>' . htmlspecialchars($message['username']) . '</span>: ' . htmlspecialchars($message['message']) . '</div>';
    }

    return $messageHtml;
}
?>
