<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1><?php echo htmlspecialchars($username); ?></h1>
            
        </div>
        <img src="profile.jpg" alt="Profile Image" class="profile-img">
        <div class="email"><?php echo htmlspecialchars($email); ?></div>

        <div class="header-buttons">
            <a href="dashboard.php" class="btn-back">Powrót</a>
        </div>

        <div class="activity-calendar">
            <h2>Aktywność</h2>
            <div id="calendar-month-year"></div>
            <div class="calendar-navigation">
                <button id="prev-month" class="calendar-btn">Poprzedni miesiąc</button>
                <button id="next-month" class="calendar-btn">Następny miesiąc</button>
            </div>
            <div class="calendar-container"></div>
        </div>
    </div>

    <script src="profil.js"></script>
</body>
</html>

<?php $conn->close(); ?>
