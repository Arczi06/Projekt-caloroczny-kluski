<?php
include 'config.php';

function generateColorForUser($userId) {
    $hashedId = hash('sha256', $userId);
    return '#' . substr($hashedId, 0, 6); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = isset($_POST['role']) ? (int)$_POST['role'] : 0; 
    
    if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/", $_POST['password'])) {
        echo "Hasło nie spełnia wymagań!";
        exit();
    }

    $sql = "SELECT id FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Nazwa użytkownika lub e-mail już zajęty!";
    } else {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $password, $role);
        if ($stmt->execute()) {
            $userId = $stmt->insert_id; 
            $messageColor = generateColorForUser($userId); 
            
            $sql = "UPDATE users SET message_color = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $messageColor, $userId);
            $stmt->execute();

            echo "Rejestracja zakończona sukcesem!";
            header("Location: index.html");
            exit(); 
        } else {
            echo "Błąd: " . $sql . "<br>" . $conn->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>
