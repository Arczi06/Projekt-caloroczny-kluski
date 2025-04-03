<?php
include 'load_css.php';
session_start();
require_once 'config.php';
$cssFile = loadCSS($conn);

$query_users = "SELECT id, username, role, profile_image FROM users";
$result_users = $conn->query($query_users);
$users = ["Admini" => [], "Bibliotekarze" => [], "Czytelnicy" => []];

while ($row = $result_users->fetch_assoc()) {
    if ($row['role'] == 2) {
        $users["Admini"][] = $row;
    } elseif ($row['role'] == 1) {
        $users["Bibliotekarze"][] = $row;
    } else {
        $users["Czytelnicy"][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyślij wiadomość</title>
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <aside class="users-sidebar">
            <h2>Wiadomości</h2>
            <div class="sidebar-links">
                <a href="recived_bmessages.php" class="sidebar-link">Odebrane</a>
                <a href="sent_bmessages.php" class="sidebar-link">Wysłane</a>
                <a href="send_bmessages.php" class="sidebar-link">Wyślij wiadomość</a>
            </div>
        </aside>

        <div class="message-area">
            <h3>Nowa wiadomość</h3>
            <form action="send_message.php" method="POST">
                <label>Odbiorca:</label>
                <input type="text" id="recipient_name" placeholder="Wybierz odbiorcę" readonly required>
                <input type="hidden" id="recipient_id" name="recipient_id">
                <button type="button" id="chooseUserBtn">Wybierz użytkownika</button>

                <label>Temat:</label>
                <input type="text" name="subject" placeholder="Temat" required>

                <label>Treść:</label>
                <textarea name="message_body" placeholder="Treść wiadomości" required></textarea>

                <button type="submit">Wyślij</button>
            </form>
        </div>
    </div>

    <?php include 'user_popup.php'; ?>

    <script src="b_messages.js"></script>
</body>
</html>
