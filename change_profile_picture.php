<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Sprawdzenie, czy został przesłany plik
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $target_dir = "ni/";  // Katalog na zdjęcia
    $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Sprawdzenie, czy plik jest obrazem
    $check = getimagesize($_FILES['profile_picture']['tmp_name']);
    if ($check !== false) {
        // Przeniesienie pliku do katalogu
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            // Aktualizacja ścieżki do zdjęcia w bazie danych
            $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            if ($stmt->execute()) {
                // Przekierowanie do profilu z nowym zdjęciem
                header("Location: profil.php");
                exit();
            } else {
                echo "Błąd podczas aktualizacji zdjęcia profilowego.";
            }
        } else {
            echo "Przesyłanie pliku nie powiodło się.";
        }
    } else {
        echo "Plik nie jest obrazem.";
    }
} else {
    echo "Brak pliku.";
}

$conn->close();
?>
