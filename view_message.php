<?php
include 'load_css.php';
include 'config.php';
session_start();
$cssFile = loadCSS($conn);
if (!isset($_GET['id'])) {
    header("Location: recived_bmessages.php");
    exit;
}

$message_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Pobieranie szczegółów wiadomości
$query = "SELECT sender_id, recipient_id, subject, message_body, date_sent FROM messages WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $message_id);
$stmt->execute();
$stmt->bind_result($sender_id, $recipient_id, $subject, $message_body, $date_sent);
$stmt->fetch();
$stmt->close();

// Sprawdzenie, czy wiadomość należy do użytkownika (czy wysłał, czy odebrał)
if ($user_id !== $sender_id && $user_id !== $recipient_id) {
    echo "Nie masz uprawnień do przeglądania tej wiadomości.";
    exit();
}

// Pobranie nazwy użytkownika nadawcy
$query_sender = "SELECT username FROM users WHERE id = ?";
$stmt_sender = $conn->prepare($query_sender);
$stmt_sender->bind_param('i', $sender_id);
$stmt_sender->execute();
$stmt_sender->bind_result($sender_username);
$stmt_sender->fetch();
$stmt_sender->close();

// Pobranie nazwy użytkownika odbiorcy
$query_recipient = "SELECT username FROM users WHERE id = ?";
$stmt_recipient = $conn->prepare($query_recipient);
$stmt_recipient->bind_param('i', $recipient_id);
$stmt_recipient->execute();
$stmt_recipient->bind_result($recipient_username);
$stmt_recipient->fetch();
$stmt_recipient->close();

// Ustalenie, do której strony ma prowadzić przycisk powrotu
$return_page = ($user_id === $sender_id) ? "sent_bmessages.php" : "recived_bmessages.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiadomość</title>
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
</head>
<?php include 'header.php'; ?>

<!-- <div class="user-info">
    <img src="<?php echo $profile_image_path; ?>" alt="Avatar" class="user-avatar">
    <p class="greeting-message">Witaj, <?php echo $username; ?>!</p>
</div> -->

<body>
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
        <a href="<?php echo $return_page; ?>" class="back-button">Powrót</a>
            <h3>Wiadomość <?php echo ($user_id === $sender_id) ? "do: $recipient_username" : "od: $sender_username"; ?></h3>
            <p><strong>Temat:</strong> <?php echo htmlspecialchars($subject); ?></p>
            <p><strong>Data wysłania:</strong> <?php echo htmlspecialchars($date_sent); ?></p>
            <p><strong>Treść:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($message_body)); ?></p>
        </div>
    </div>
</body>
</html>
