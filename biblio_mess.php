<?php
// Połączenie z bazą danych
include 'config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiadomości</title>
    <link rel="stylesheet" href="b_messages.css">
</head>
<body>

<div class="container">
    <!-- Aside z użytkownikami (przeciągany panel) -->
    <aside class="users-sidebar" id="users-sidebar">
        <div class="drag-bar"></div> <!-- Element do przeciągania -->
        <?php
            // Pobranie użytkowników z bazy danych
            $sql = "SELECT id, username, role, email, profile_image FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user_id = $row['id'];
                    $username = htmlspecialchars($row['username']);
                    $role = htmlspecialchars($row['role']);
                    $email = htmlspecialchars($row['email']);
                    $profile_image = $row['profile_image'] ? $row['profile_image'] : 'default.jpg';
                    echo "
                        <div class='user-tile' data-id='$user_id' data-username='$username' data-role='$role' data-email='$email' draggable='true'>
                            <img src='ni/ni' alt='Profile Image' class='user-avatar'>
                            <p class='user-name'>$username</p>
                            <p class='user-role'>Rola: $role</p>
                            <p class='user-email'>$email</p>
                        </div>
                    ";
                }
            } else {
                echo "Brak użytkowników.";
            }
        ?>
    </aside>

    <!-- Sekcja wiadomości -->
    <main class="message-area">
        <div class="message-recipient" id="message-recipient">
            <p>Wybierz odbiorcę</p>
        </div>
        <textarea class="message-input" placeholder="Napisz wiadomość..."></textarea>
        <button class="send-message">Wyślij</button>
    </main>
</div>

    <script src="b_js.js"></script>
</body>
</html>
