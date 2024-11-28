<?php
include 'config.php';

$result = $conn->query("
    SELECT users.username, messages.message, messages.created_at
    FROM messages
    JOIN users ON messages.user_id = users.id
    ORDER BY messages.created_at ASC
");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>" . htmlspecialchars($row['username']) . "</strong> (" . $row['created_at'] . "): " . htmlspecialchars($row['message']) . "</p>";
    }
} else {
    echo "Brak wiadomości w bazie danych.";
}

$conn->close();
?>
