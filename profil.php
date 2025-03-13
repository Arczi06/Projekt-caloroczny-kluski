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
if (!is_dir($image_directory)) {
    mkdir($image_directory, 0755, true);
}
$profile_images = is_dir($image_directory) ? array_diff(scandir($image_directory), array('.', '..')) : [];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
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
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Dashboard</h2>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php">Podgląd</a>
        <a href="profil.php" class="active">Profil</a>
        <a href="#">Ustawienia</a>
        <a href="chat.php">Wiadomości</a>
        <a href="#">Strona</a>
        <a href="logout.php" id="Logout">Logout</a>
        <div class="solitaire-card">
            <h3 class="pasjanszagraj">Zagraj w Pasjansa</h3>
            <a href="https://pasjans-online.pl/" class="solitaire-btn">Rozpocznij Grę</a>
        </div>
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

    document.getElementById('upload-new-image-btn').addEventListener('click', function() {
        window.location.href = "upload_profile_picture.php";
    });
</script>


<script src="profil.js"></script>
</body>
</html>

<?php $conn->close(); ?>
