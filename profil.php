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

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Użytkownika</title>
    <link rel="stylesheet" href="profil.css?v=1.0">
<script src="profil.js?v=1.0"></script>
</head>
<body>

<div class="profile-container">
    <div class="header-buttons">
        <a href="dashboard.php" class="btn-back">⟵ Powrót</a>
    </div>

    <div class="profile-header">
        <img src="profile.jpg" alt="User Profile Image" class="profile-img">
        <h1><?php echo htmlspecialchars($user['username']); ?></h1>
        <p class="email"><?php echo htmlspecialchars($user['email']); ?></p>
    </div>

    <div>
        <h1>POMYSŁY</h1>
        <p>kalendarz aktywnosci taki jak na githubie i nv makies 3 ulubioen ksiażki ???</p>
    </div>
</div>
</body>
</html>
