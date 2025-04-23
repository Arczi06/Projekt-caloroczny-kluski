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
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="active"><i class="ph ph-house-line"></i> Podgląd</a>
                <a href="profil.php"><i class="ph ph-user-circle"></i> Profil</a>
                <a href="recived_bmessages.php"><i class="ph ph-chat-circle-dots"></i> Wiadomości</a>
                <a href="#"><i class="ph ph-globe"></i> Strona</a>
                <a href="logout.php" id="Logout"><i class="ph ph-sign-out"></i> Logout</a>
                <div class="sidebar-bottom">
                    <div class="solitaire-card">
                        <h3 class="pasjanszagraj">Zagraj w Pasjansa</h3>
                        <a href="https://pasjans-online.pl/" class="solitaire-btn">Rozpocznij Grę</a>
                    </div>
                </div>
            </nav>
        </aside>

        <main class="dashboard-content">
        <div class="hamburger">&#9776;</div> <!-- Ikona burgera -->

            <header class="dashboard-header">
                <div class="user-info">
                    <img src="<?php echo $profile_image; ?>" alt="Profile Image" class="user-avatar" id="user-avatar">
                    <span class="user-name">Witaj <?php echo htmlspecialchars($user['username']); ?>!</span>
                </div>
            </header>
            <section class="dashboard-section">  
                <div class="window-card">
                    <a href="./olekjan/katalog.php">
                        <div class="window-content">
                            <img src="katalog-removebg-preview.png" alt="KATALOG KSIĄŻEK" class="icon"/>    
                        </div>
                    </a>
                    <div class="description">KATALOG KSIĄŻEK</div>
                </div>
                <div class="window-card">
                    <a href="./olekjan/lekturyObowiązkowe13.php">
                        <div class="window-content">
                            <img src="lektury-removebg-preview.png" alt="Biblioteka" class="icon" />
                        </div>
                    </a>
                    <div class="description">LEKTURY OBOWIĄZKOWE</div>
                </div>
                <div class="window-card">
                        <div class="window-content">
                            <img src="logo.png" alt="KATALOG KSIĄŻEK" class="icon"/>    
                        </div>
                    </a>
                </div>  
                <div class="window-card">
                    <a href="./olekjan/moje.php">
                        <div class="window-content">
                            <img src="moje-removebg-preview.png" alt="Wyszukiwanie" class="icon" />
                        </div>
                    </a>
                    <div class="description">MOJE KSIĄŻKI</div>
                </div>
                <div class="window-card">
                    <a href="./olekjan/eventy.php">
                        <div class="window-content">
                            <img src="event-removebg-preview.png" alt="Ulubione" class="icon" />
                        </div>
                    </a>
                    <div class="description">EVENTY</div>
                </div>
            </section>
        </main>
    </div>
    <script src="dashboard.js"></script>
</body>
<script>
    const burger = document.querySelector('.hamburger');
    const sidebar = document.querySelector('.sidebar');

    burger.addEventListener('click', () => {
        sidebar.classList.toggle('open');
    });
</script>


</html>
