<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chat.css">
    <title>Live Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #chat-box {
            width: 500px;
            height: 400px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: scroll;
            margin-bottom: 10px;
        }
        #chat-form input, #chat-form button {
            padding: 10px;
            margin: 5px;
        }
    </style>
</head>
<body>
     <div class="navigation">
        <a href="dashboard.php" class="back-button">Powrót do Dashboarda</a>
    </div>
    <h1>Live Chat</h1>
    <div id="chat-box"></div>
    <form id="chat-form">
        <input type="text" id="message" placeholder="Type a message..." required>
        <button type="submit">Send</button>
    </form>

    <script>
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message');

        setInterval(() => {
            fetch('fetch_messages.php')
                .then(response => response.text())
                .then(data => {
                    chatBox.innerHTML = data;
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }, 1000);

        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const message = messageInput.value;

            fetch('save_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `message=${encodeURIComponent(message)}`
            }).then(() => {
                messageInput.value = '';
            });
        });
    </script>
</body>
</html>
