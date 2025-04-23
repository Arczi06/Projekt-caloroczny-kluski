<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $profile_image);
$stmt->fetch();
$stmt->close();

$profile_image_path = isset($profile_image) && $profile_image ? "ni/$profile_image" : "ni/default.jpg";

// Pobieranie książek
$books_sql = "SELECT b.id, b.title, b.author, b.year, u.username, bb.borrow_date, bb.due_date, bb.status
              FROM books b
              LEFT JOIN borrowed_books bb ON b.id = bb.book_id
              LEFT JOIN users u ON bb.user_id = u.id
              ORDER BY bb.borrow_date DESC";
$books_result = $conn->query($books_sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista książek</title>
    <link rel="stylesheet" href="biblio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        

        <main class="dashboard-content">
            <header class="dashboard-header">
            <div class="hamburger" onclick="toggleSidebar()">☰</div>
                <div class="user-info">
                    <img src="<?php echo $profile_image_path; ?>" alt="Profile Image" class="user-avatar">
                    <span class="user-name">Witaj, <?php echo htmlspecialchars($username); ?>!</span>
                </div>
            </header>

            <!-- Tabela książek -->
            <section class="dashboard-section">
    <h2>Lista książek</h2>
    <table class="books-table">
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Wypożyczone przez</th>
                <th>Data wypożyczenia</th>
                <th>Termin zwrotu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "
                SELECT 
                    d.id AS ksiazka_id, d.tytul, d.autor_imie, d.autor_nazwisko,
                    w.data_wypozyczenia,
                    u.username,
                    IF(w.id IS NULL, 'dostępna', 'wypożyczona') AS status
                FROM dane_ksiazek d
                LEFT JOIN wypozyczenia w ON d.id = w.biblioteczka_id
                LEFT JOIN users u ON w.user_id = u.id
            ";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) :
                $termin_zwrotu = '-';
                if ($row['data_wypozyczenia']) {
                    $wyp_date = new DateTime($row['data_wypozyczenia']);
                    $wyp_date->modify('+7 days 4 hours');
                    $termin_zwrotu = $wyp_date->format('Y-m-d H:i');
                }
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['tytul']) ?></td>
                    <td><?= htmlspecialchars($row['autor_imie'] . ' ' . $row['autor_nazwisko']) ?></td>
                    <td><?= $row['username'] ? htmlspecialchars($row['username']) : 'Dostępna' ?></td>
                    <td><?= $row['data_wypozyczenia'] ? htmlspecialchars($row['data_wypozyczenia']) : '-' ?></td>
                    <td><?= $termin_zwrotu ?></td>
                    <td>
                        <?php
                        if ($row['status'] === 'dostępna') {
                            echo '<span class="status status-available"><i class="fas fa-book"></i> Dostępna</span>';
                        } else {
                            echo '<span class="status status-borrowed"><i class="fas fa-book-reader"></i> Wypożyczona</span>';
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>


        </main>
    </div>
</body>
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
</html>
