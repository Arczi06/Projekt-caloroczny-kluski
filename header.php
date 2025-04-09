<?php
// Sprawdzamy, czy sesja jest już uruchomiona
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Dołączamy plik konfiguracyjny z połączeniem do bazy danych
require_once 'config.php';

// Sprawdzamy, czy użytkownik jest zalogowany
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Pobieramy dane użytkownika (username i profile_image) z bazy danych
    $query = "SELECT username, profile_image FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($username, $profile_image);
        $stmt->fetch();
        $stmt->close();

        // Sprawdzamy, czy użytkownik ma przypisany obrazek, jeśli nie to ustawiamy domyślny
        if (empty($profile_image)) {
            $profile_image_path = "ni/ni/default.jpg"; // Domyślny obrazek
        } else {
            $profile_image_path = "ni/ni/" . $profile_image;
        }
    } else {
        // Jeśli zapytanie nie powiedzie się
        echo "Wystąpił błąd przy pobieraniu danych użytkownika.";
        exit();
    }
} else {
    $username = "Gość";
    $profile_image_path = "ni/ni/default.jpg"; // Domyślny obrazek
}

// Zapisywanie poprzedniej strony do sesji
if (!isset($_SESSION['previous_page'])) {
    $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // Domyślnie 'index.php' jeśli nie ma poprzedniej strony
}
?>
