<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $target_dir = "ni/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowed_extensions)) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $_FILES["profile_picture"]["name"], $user_id);
            $stmt->execute();
            $stmt->close();

            header("Location: profil.php?message=Zdjęcie zostało zaktualizowane.");
            exit();
        } else {
            echo "Wystąpił błąd podczas przesyłania zdjęcia.";
        }
    } else {
        echo "Tylko pliki JPG, JPEG, PNG i GIF są dozwolone.";
    }
} else {
    echo "Nie wybrano pliku.";
}
?>
