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
