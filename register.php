<?php
include 'config.php';

// Funkcja generująca kolor na podstawie ID użytkownika
function generateColorForUser($userId) {
    // Użyj ID użytkownika jako podstawy do wygenerowania koloru
    $hashedId = hash('sha256', $userId); // Haszujemy ID
    return '#' . substr($hashedId, 0, 6); // Pierwsze 6 znaków jako kolor hex
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Sprawdzanie, czy nazwa użytkownika już istnieje
    $sql = "SELECT id FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    // Sprawdzanie, czy istnieje już użytkownik o podanej nazwie lub e-mailu
    if ($stmt->num_rows > 0) {
        echo "Nazwa użytkownika lub e-mail już zajęty!";
    } else {
        // Wstawianie nowego użytkownika
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            // Po zapisaniu użytkownika, generujemy kolor
            $userId = $stmt->insert_id;  // Pobieramy ID nowo wstawionego użytkownika
            $messageColor = generateColorForUser($userId);  // Generujemy kolor

            // Aktualizujemy kolor wiadomości w tabeli users
            $sql = "UPDATE users SET message_color = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $messageColor, $userId);
            $stmt->execute();

            echo "Rejestracja zakończona sukcesem!";
            header("Location: index.html"); // Zmieniamy na login.php po rejestracji
            exit(); // Zapobiega dalszemu wykonywaniu skryptu po przekierowaniu
        } else {
            echo "Błąd: " . $sql . "<br>" . $conn->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>
