<?php
include 'config.php';


session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$sql_books = "SELECT title, author, borrow_date, due_date, status FROM borrowed_books WHERE user_id = ?";
$stmt_books = $conn->prepare($sql_books);
$stmt_books->bind_param("i", $user_id);
$stmt_books->execute();
$books_result = $stmt_books->get_result();

$stmt->close();
$stmt_books->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Użytkownika</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <img src="profile_images/default_profile.jpg" alt="User Profile Image" class="profile-img">
        <button class ="btn">
            <a href="dashboard.php">Powrót</a>
        </button>
        <h1><?php echo htmlspecialchars($user['username']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    </div>

    <div class="library-details">
        <h2>Porzyczone Książki</h2>
        <table>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Data Wyporzyczenia</th>
                    <th>Termin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($book = $books_result->fetch_assoc()): ?>
                    <tr class="<?php echo ($book['status'] == 'Not Returned') ? 'overdue' : ''; ?>">
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['borrow_date']); ?></td>
                        <td class="due-date"><?php echo htmlspecialchars($book['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="profil.js"></script>
</body>
</html>
