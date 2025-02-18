<?php
include 'config.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT username, email, password, role FROM pending_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $email, $password, $role);
        $stmt->fetch();

        $sqlInsert = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($sqlInsert);
        $insertStmt->bind_param("sssi", $username, $email, $password, $role);
        $insertStmt->execute();

        $sqlDelete = "DELETE FROM pending_users WHERE id = ?";
        $deleteStmt = $conn->prepare($sqlDelete);
        $deleteStmt->bind_param("i", $userId);
        $deleteStmt->execute();
    }
    $stmt->close();
    $conn->close();

    header("Location: admin_panel.php");
    exit();
} else {
    echo "Brak ID użytkownika do zaakceptowania.";
}
?>
