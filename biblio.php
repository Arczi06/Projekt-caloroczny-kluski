<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    $profile_image = (!empty($user['profile_image']) && file_exists('ni/' . $user['profile_image']))
        ? 'ni/' . $user['profile_image']
        : 'default_avatar.png';
} else {
    $_SESSION['error'] = "Błąd: Nie znaleziono użytkownika.";
    header("Location: logout.php");
    exit;
}

$stmt->close();

$sql_users = "SELECT COUNT(*) AS count FROM users";
$sql_books = "SELECT COUNT(*) AS count FROM borrowed_books";

$users_count = $conn->query($sql_users)->fetch_assoc()['count'] ?? 0;
$books_count = $conn->query($sql_books)->fetch_assoc()['count'] ?? 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Bibliotekarza</title>
    <link rel="stylesheet" href="biblio.css">
</head>
<body>
    <div class="dashboard-container">
    <?php include 'biblio_sidebar.php'; ?>

        <main class="dashboard-content">
            <header class="dashboard-header">
                <div class="user-info">
                    <img src="<?= $profile_image; ?>" alt="Profilowe" class="user-avatar">
                    <span class="user-name">Witaj, <?= htmlspecialchars($user['username']); ?>!</span>
                </div>
            </header>

            <section class="dashboard-section">
                <h2>Statystyki</h2>
                <div class="stats">
                    <div class="card">
                        <h3>Użytkownicy</h3>
                        <p><?= $users_count; ?></p>
                    </div>
                    <div class="card">
                        <h3>Książki</h3>
                        <p><?= $books_count; ?></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
