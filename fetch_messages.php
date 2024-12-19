<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$loggedInUserId = $_SESSION['user_id'];

$result = $conn->query("
    SELECT users.username, users.message_color, messages.message, messages.created_at, messages.user_id
    FROM messages
    JOIN users ON messages.user_id = users.id
    ORDER BY messages.created_at ASC
");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Kolor użytkownika
        $userColor = $row['message_color'];
        
        // Sprawdzamy, czy wiadomość należy do zalogowanego użytkownika
        if ($row['user_id'] == $loggedInUserId) {
            echo "<p class='my-message' style='border: 2px solid {$userColor};'><strong>" . htmlspecialchars($row['username']) . "</strong> (" . $row['created_at'] . "): " . htmlspecialchars($row['message']) . "</p>";
        } else {
            echo "<p class='other-message' style='border: 2px solid {$userColor};'><strong>" . htmlspecialchars($row['username']) . "</strong> (" . $row['created_at'] . "): " . htmlspecialchars($row['message']) . "</p>";
        }
    }
} else {
    echo "<p>Brak wiadomości w bazie danych.</p>";
}

$conn->close();
?>
