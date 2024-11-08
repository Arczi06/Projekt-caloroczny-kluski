<?php
include 'config.php';

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
            echo "Rejestracja zakończona sukcesem!";
            header("Location: index.html");
            exit(); // Zapobiega dalszemu wykonywaniu skryptu po przekierowaniu
        } else {
            echo "Błąd: " . $sql . "<br>" . $conn->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>
