<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Połączenie z bazą danych
include('config.php');
include('assign_message_classes.php'); // Dołączamy plik z funkcją

// Zapytanie do bazy danych, aby pobrać wiadomości
$query = "SELECT m.message, u.username, m.user_id FROM messages m
          JOIN users u ON m.user_id = u.id
          ORDER BY m.created_at DESC LIMIT 10";

$result = $conn->query($query);

$messages = [];

// Przeiteruj po wynikach i stwórz tablicę wiadomości
while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'user_id' => $row['user_id'],
        'username' => $row['username'],
        'message' => $row['message']
    ];
}

// Przypisz klasy CSS do wiadomości
$messagesWithClass = assignMessageClass($messages, $conn); // Przekazujemy $conn

// Zamknij połączenie z bazą danych
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chat.css">
    <title>Live Chat</title>
</head>
<body>
    <div class="navigation">
        <a href="dashboard.php" class="back-button">Powrót do Dashboarda</a>
    </div>
    <h1>Live Chat</h1>
    
    <!-- Wyświetlanie wiadomości -->
    <div id="chat-box">
        <?php
        // Wyświetlanie wiadomości z przypisanymi klasami CSS
        echo $messagesWithClass;
        ?>
    </div>

    <form id="chat-form">
        <input type="text" id="message" placeholder="Type a message..." required>
        <button type="submit">Send</button>
    </form>

    <script>
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message');

        if (window.Worker) {
            const worker = new Worker('chat_worker.js');

            worker.onmessage = function (e) {
                if (e.data.type === 'messages') {
                    const messages = e.data.data;
                    chatBox.innerHTML = messages;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
                if (e.data.type === 'done') {
                    console.log('Więcej wiadomości załadowanych.');
                }
            };

            worker.postMessage('FETCH_MESSAGES');

            setInterval(() => {
                worker.postMessage('FETCH_MESSAGES');
            }, 3000);

            chatForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const message = messageInput.value;

                fetch('save_message.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `message=${encodeURIComponent(message)}`
                }).then(() => {
                    messageInput.value = '';
                    worker.postMessage('FETCH_MESSAGES');
                });
            });

            window.addEventListener('beforeunload', () => {
                worker.postMessage('STOP');
            });
        } else {
            console.error("Web Workers are not supported in your browser.");
        }
    </script>
</body>
</html>
