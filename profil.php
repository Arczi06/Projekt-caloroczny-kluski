<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, profile_image FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $profile_image);
$stmt->fetch();
$stmt->close();

$image_directory = 'ni';
$profile_images = scandir($image_directory); 
$profile_images = array_diff($profile_images, array('.', '..'));
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        #image-options {
            max-height: 400px;
            width: 100%;
            overflow-y: 100000000;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
        }

        #image-options ul {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        #image-options li {
            list-style-type: none;
            max-width: 100px;
        }

        .thumbnail {
            width: 100%;
            height: auto;
            max-width: 100px;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .thumbnail:hover {
            transform: scale(1.1);
        }

        #upload-new-image-btn {
            margin-top: 15px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #upload-new-image-btn:hover {
            background-color: #45a049;
        }

        .dashboard-container {
            display: flex;
            position: fixed;
            min-height: 100vh;
            padding: 20px;
            gap: 20px;
        }

        /* .profile-container {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.8);
        } */
    </style>
</head>
<body>
<button id="burger" class="burger">☰</button>

<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <nav class="sidebar-nav">
            <a href="dashboard.php"><i class="ph ph-house-line"></i> Podgląd</a>
            <a href="profil.php" class="active"><i class="ph ph-user-circle"></i> Profil</a>
            <a href="recived_bmessages.php"><i class="ph ph-chat-circle-dots"></i> Wiadomości</a>
            <a href="#"><i class="ph ph-globe"></i> Strona</a>
            <a href="logout.php" id="Logout"><i class="ph ph-sign-out"></i> Logout</a>
            <!-- <div class="sidebar-bottom">
                <div class="solitaire-card">
                    <h3 class="pasjanszagraj">Zagraj w Pasjansa</h3>
                    <a href="https://pasjans-online.pl/" class="solitaire-btn">Rozpocznij Grę</a>
                </div>
            </div> -->
        </nav>
    </aside>

    <div class="profile-container">
        <div class="profile-header">
            <h1><?php echo htmlspecialchars($username); ?></h1>
        </div>
        <div>
            <div>
                <img src="ni/<?php echo isset($profile_image) && $profile_image ? $profile_image : 'default.jpg'; ?>" alt="Profile Image" class="profile-img" id="profile-img">
                <p class="email"><?php echo htmlspecialchars($email); ?></p>
            </div>
        </div>
        <button id="choose-image-btn">Wybierz nowe zdjęcie</button>
        <div id="image-options" style="display:none;">
            <h3>Dostępne zdjęcia:</h3>
            <form id="upload-form" action="upload_profile_picture.php" method="POST" enctype="multipart/form-data" style="display:none;">
                <input type="file" name="profile_picture" id="profile-picture-input" required>
                <button type="submit">Prześlij zdjęcie</button>
            </form>
            <ul>
                <?php foreach ($profile_images as $image): ?>
                    <li><img src="ni/<?php echo $image; ?>" alt="<?php echo $image; ?>" class="thumbnail" data-image="<?php echo $image; ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="activity-calendar">
            <!-- <h2>Aktywność</h2> -->
            <div id="calendar-month-year"></div>
            <div class="calendar-navigation">
                <button id="prev-month" class="calendar-btn">Poprzedni miesiąc</button>
                <button id="next-month" class="calendar-btn">Następny miesiąc</button>
            </div>
            <div class="calendar-container"></div>
        </div>
    </div>
</div>

<script>
    document.getElementById("choose-image-btn").addEventListener("click", function() {
        var imageOptions = document.getElementById("image-options");
        if (imageOptions.style.display === "block") {
            imageOptions.style.display = "none";
        } else {
            imageOptions.style.display = "block";
        }
    });
    document.querySelectorAll('.thumbnail').forEach(function(img) {
        img.addEventListener('click', function() {
            var selectedImage = img.getAttribute('data-image');
            document.getElementById("profile-img").src = "ni/" + selectedImage;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_profile_picture.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("image=" + selectedImage);

            document.getElementById("image-options").style.display = "none";
        });
    });
</script>

<script src="profil.js"></script>
<script>
    const burger = document.getElementById('burger');
    const sidebar = document.querySelector('.sidebar');

    burger.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    // Opcjonalnie: zamknij sidebar klikając poza nim
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !burger.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
</script>


</body>
</html>

<?php $conn->close(); ?>