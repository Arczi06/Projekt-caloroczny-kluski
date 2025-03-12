<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Nie jesteś zalogowany.");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $profile_image);
$stmt->fetch();
$stmt->close();

$profile_image_path = !empty($profile_image) ? "ni/$profile_image" : "ni/default.jpg";
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
    <title>Książki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'biblio_sidebar.php'; ?>

        <main class="dashboard-content">
            <header class="dashboard-header">
                <div class="user-info">
                    <img src="<?= $profile_image_path; ?>" alt="Profile Image" class="user-avatar">
                    <span class="user-name">Witaj, <?= htmlspecialchars($username); ?>!</span>
                </div>
            </header>

            <section class="dashboard-section">
                <h2>Lista wypożyczonych książek</h2>
                <table class="books-table">
                    <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Autor</th>
                            <th>Rok</th>
                            <th>Wypożyczone przez</th>
                            <th>Data wypożyczenia</th>
                            <th>Termin zwrotu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $books_result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= htmlspecialchars($row['title']); ?></td>
                                <td><?= htmlspecialchars($row['author']); ?></td>
                                <td><?= htmlspecialchars($row['year']); ?></td>
                                <td><?= $row['username'] ? htmlspecialchars($row['username']) : 'Dostępna'; ?></td>
                                <td><?= $row['borrow_date'] ? htmlspecialchars($row['borrow_date']) : '-'; ?></td>
                                <td><?= $row['due_date'] ? htmlspecialchars($row['due_date']) : '-'; ?></td>
                                <td class="status-<?php echo isset($row['status']) ? $row['status'] : 'available'; ?>">
                                    <?php
                                    if ($row['status'] === null) {
                                        echo 'Dostępna';
                                    } else {
                                        switch ($row['status']) {
                                            case 0: echo 'Oddana'; break;
                                            case 1: echo 'Wypożyczona'; break;
                                            case 2: echo 'Zniszczona'; break;
                                            case 3: echo 'Zgubiona'; break;
                                            default: echo 'Nieznany';
                                        }
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
</html>
