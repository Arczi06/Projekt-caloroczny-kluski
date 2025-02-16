<?php
include 'config.php';

// Sprawdzamy, czy mamy ID użytkownika, który ma zostać zaakceptowany
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Przenosimy użytkownika z pending_users do users
    $sql = "SELECT username, email, password, role FROM pending_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Pobieramy dane użytkownika z tabeli pending_users
        $stmt->bind_result($username, $email, $password, $role);
        $stmt->fetch();

        // Dodajemy użytkownika do tabeli users
        $sqlInsert = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($sqlInsert);
        $insertStmt->bind_param("sssi", $username, $email, $password, $role);
        $insertStmt->execute();

        // Usuwamy użytkownika z tabeli pending_users
        $sqlDelete = "DELETE FROM pending_users WHERE id = ?";
        $deleteStmt = $conn->prepare($sqlDelete);
        $deleteStmt->bind_param("i", $userId);
        $deleteStmt->execute();
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Brak ID użytkownika do zaakceptowania.";
}
?>
