<?php
include 'config.php';
include 'load_css.php';
session_start();
$cssFile = loadCSS($conn);
$user_id = $_SESSION['user_id'];

// Pobieranie wysłanych wiadomości
$query_sent = "SELECT messages.id, messages.recipient_id, messages.subject, messages.date_sent, users.username 
               FROM messages 
               JOIN users ON messages.recipient_id = users.id 
               WHERE messages.sender_id = ? 
               ORDER BY messages.date_sent DESC";
$stmt = $conn->prepare($query_sent);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result_sent = $stmt->get_result();

$powrot = "#"; // Domyślnie coś neutralnego

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($role);
}   
    if ($stmt->fetch()) {
        switch ($role) {
            case 0:
                $powrot = "dashboard.php";
                break;
            case 1:
                $powrot = "biblio.php";
                break;
            case 2:
                $powrot = "admin_panel.php";
                break;
            default:
                $powrot = "index.php";
        }
    } else {
        $powrot = "index.php"; // Na wypadek gdyby nie znaleziono użytkownika
    }
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wysłane wiadomości</title>
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
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
        <a href="<?= $powrot ?>" class="powrut-link">Powrót</a>
            <h3>Wysłane wiadomości</h3>
            <table>
                <tr>
                    <th>Do</th>
                    <th>Temat</th>
                    <th>Data wysłania</th>
                    <th>Wyświetl Wiadomość</th>
                    <th>Usuń Wiadomość</th>
                </tr>
                <?php while ($row = $result_sent->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_sent']); ?></td>
                        <td>
                            <form action="view_message.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="view-btn" title="Wyświetl wiadomość">
                                    🔍
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="delete_message.php" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wiadomość?');">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="delete-btn" title="Usuń wiadomość">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>


        </div>
    </div>
</body>
</html>
