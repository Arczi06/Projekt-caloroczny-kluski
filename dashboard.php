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

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $profile_image = !empty($user['profile_image']) && file_exists('ni/' . $user['profile_image']) 
        ? 'ni/' . $user['profile_image'] 
        : 'profile.jpg';
} else {
    echo "User not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css?v=1.0">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="active">Podgląd</a>
                <a href="profil.php">Profil</a>
                <a href="admin/index.html">Ustawienia</a>
                <a href="chat.php">Wiadomości</a>
                <a href="user_home.php">Strona</a>
                <a href="logout.php" id="Logout">Logout</a>
                <div class="solitaire-card">
                    <h3 class="pasjanszagraj">Zagraj w Pasjansa</h3>
                    <a href="https://pasjans-online.pl/" class="solitaire-btn">Rozpocznij Grę</a>
                </div>
            </nav>
        </aside>

        <main class="dashboard-content">
            <header class="dashboard-header">
                <div class="user-info">
                    <img src="<?php echo $profile_image; ?>" alt="Profile Image" class="user-avatar" id="user-avatar">
                    <span class="user-name">Witaj <?php echo htmlspecialchars($user['username']); ?>!</span>
                </div>
            </header>
            <section class="dashboard-section">
            </section>
            <section class="dashboard-section">
                <div class="chart-container">
                </div>
            </section>
        </main>
    </div>
    <script src="dashboard.js"></script>
</body>
</html>
