<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('config.php');
include('assign_message_classes.php');

$query = "SELECT m.message, u.username, m.user_id FROM messages m
          JOIN users u ON m.user_id = u.id
          ORDER BY m.created_at DESC LIMIT 10";

$result = $conn->query($query);

$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'user_id' => $row['user_id'],
        'username' => $row['username'],
        'message' => $row['message']
    ];
}

$messagesWithClass = assignMessageClass($messages, $conn); 

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>Live Chat</title>
</head>
<body>
<div id="wrapper">
    <div id="left-aside">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php">Podgląd</a>
                <a href="profil.php">Profil</a>
                <a href="#">Ustawienia</a>
                <a href="chat.php" class="active">Wiadomości</a>
                <a href="#">Strona</a>
                <a href="logout.php" id="Logout">Logout</a>
                <div class="solitaire-card">
                    <h3 class="pasjanszagraj">Zagraj w Pasjansa</h3>
                    <a href="https://pasjans-online.pl/" class="solitaire-btn">Rozpocznij Grę</a>
                </div>
            </nav>
        </aside>
    </div>

    <div id="top-text">
        <h1>Live Chat</h1>
    </div>

    <div id="chat-box">
        <?php echo $messagesWithClass; ?> 
    </div>

    <form id="chat-form">
        <input type="text" id="message" placeholder="Type a message..." required>
        <button type="submit">Send</button>
    </form>

    <div id="right-aside">
        <h1>cos</h1>
    </div>
</div>

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
