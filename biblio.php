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
    $username = $user['username'];
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

$sql = "SELECT COUNT(*) AS total FROM wypozyczenia";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$books_count = $row['total'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Bibliotekarza</title>
    <link rel="stylesheet" href="biblio.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">Biblioteka</div>
            <div class="sidebar-nav">
                <a href="biblio.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio.php' ? 'active' : '' ?>">Dashboard</a>
                <a href="biblio_users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio_users.php' ? 'active' : '' ?>">Użytkownicy</a>
                <a href="biblio_books.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio_books.php' ? 'active' : '' ?>">Książki</a>
                <a href="./olekjan/do/zarzadzanie_ksiazkami.php" class="<?= basename($_SERVER['PHP_SELF']) == './olekjan/do/zarzadzanie_ksiazkami.php' ? 'active' : '' ?>">Zarządzanie książkami</a>
                <a href="./olekjan/do/zarzadzanie_wydarzeniami.php" class="<?= basename($_SERVER['PHP_SELF']) == './olekjan/do/zarzadzanie_wydarzeniami.php' ? 'active' : '' ?>">Zarządzanie wydarzeniami</a>
                <a href="recived_bmessages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio_mess.php' ? 'active' : '' ?>">Wiadomości</a>
                <a href="logout.php" id="Logout">Wyloguj</a>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="dashboard-header">
                <div class="hamburger" onclick="toggleSidebar()">☰</div>
                <div class="user-info">
                    <img src="<?= htmlspecialchars($profile_image) ?>" alt="Avatar" class="user-avatar">
                    <span class="user-name"><?= htmlspecialchars($username) ?></span>
                </div>
            </div>

            <div class="dashboard-section stats">
                <div class="card">
                    <h3>Użytkownicy</h3>
                    <p><?= $users_count ?></p>
                </div>
                <div class="card">
                    <h3>Wypożyczenia</h3>
                    <p><?= $books_count ?></p>
                </div>
            </div>

            <!-- Można tu dodać więcej sekcji jak tabele itd. -->
        </div>
    </div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

// Zamykaj sidebar po kliknięciu poza nim
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.querySelector('.hamburger');

    // Jeśli kliknięto poza sidebar i poza hamburger, zamknij
    if (sidebar.classList.contains('open') &&
        !sidebar.contains(event.target) &&
        !hamburger.contains(event.target)) {
        sidebar.classList.remove('open');
    }
});
</script>

</body>
</html>
