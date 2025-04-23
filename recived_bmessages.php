<?php
include 'config.php';
include 'load_css.php';
session_start();
$cssFile = loadCSS($conn);
$user_id = $_SESSION['user_id'];

$query_received = "SELECT id, sender_id, subject, date_sent FROM messages WHERE recipient_id = ? ORDER BY date_sent DESC";
$stmt = $conn->prepare($query_received);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result_received = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odebrane wiadomości</title>
    <link rel="stylesheet" type="text/css" href="<?php echo loadCSS($conn); ?>">
</head>

<?php include 'header.php'; ?>

<!-- <div class="user-info">
    <img src="<?php echo $profile_image_path; ?>" alt="Avatar" class="user-avatar">
    <p class="greeting-message">Witaj, <?php echo $username; ?>!</p>
    <a href="<?php echo $_SESSION['previous_page']; ?>" class="back-button">Powrót</a>
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
        <a href="biblio.php" class="powrut-link">Powrót</a>
            <h3>Odebrane wiadomości</h3>
            <table>
                <tr>
                    <th>Od</th>
                    <th>Temat</th>
                    <th>Data wysłania</th>
                </tr>
                <?php while ($row = $result_received->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php 
                            $sender_id = $row['sender_id'];
                            $query_sender = "SELECT username FROM users WHERE id = ?";
                            $stmt_sender = $conn->prepare($query_sender);
                            $stmt_sender->bind_param('i', $sender_id);
                            $stmt_sender->execute();
                            $stmt_sender->bind_result($sender_username);
                            $stmt_sender->fetch();
                            echo $sender_username;
                            ?>
                        </td>
                        <td><a href="view_message.php?id=<?php echo $row['id']; ?>"><?php echo $row['subject']; ?></a></td>
                        <td><?php echo $row['date_sent']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
