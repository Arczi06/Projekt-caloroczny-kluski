<?php
session_start();
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Niepoprawny identyfikator użytkownika.");
}

$user_id = $_GET['id'];
$sql = "SELECT username, email, profile_image, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    $profile_image = (!empty($user['profile_image']) && file_exists("ni/{$user['profile_image']}")) 
        ? "ni/{$user['profile_image']}" 
        : "ni/default.jpg";

    $role_classes = [
        1 => "librarian", // Bibliotekarz
        2 => "admin",     // Administrator
        0 => "reader"     // Czytelnik
    ];
    $role_class = $role_classes[$user['role']] ?? "reader";
} else {
    die("Użytkownik nie istnieje.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="biblio_profile.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-card <?= $role_class ?>">
            <img src="<?= $profile_image; ?>" alt="Profilowe" class="profile-avatar">
            <h2><?= htmlspecialchars($user['username']); ?></h2>
            <p>Email: <?= htmlspecialchars($user['email']); ?></p>
            <p>Rola: 
                <?php
                switch ($user['role']) {
                    case 1: echo 'Bibliotekarz'; break;
                    case 2: echo 'Administrator'; break;
                    default: echo 'Czytelnik';
                }
                ?>
            </p>
            <a href="biblio_users.php" class="back-button">Powrót</a>
        </div>
    </div>
</body>
</html>
