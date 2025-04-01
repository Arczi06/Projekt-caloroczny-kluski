<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch borrowed books for the logged-in user
$sql = "SELECT b.id, b.title, b.author FROM books b
        JOIN borrowed_books bb ON b.id = bb.book_id
        WHERE bb.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Książki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Moje Książki</h1>
    <ul>
        <?php foreach ($books as $book): ?>
            <li><?php echo htmlspecialchars($book['title']) . " by " . htmlspecialchars($book['author']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
