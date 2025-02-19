<?php
include 'config.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT id FROM pending_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $sqlUpdate = "UPDATE pending_users SET status = 'rejected' WHERE id = ?";
        $updateStmt = $conn->prepare($sqlUpdate);
        $updateStmt->bind_param("i", $userId);
        $updateStmt->execute();

    }
    $stmt->close();
    $conn->close();

    header("Location: admin_panel.php");
    exit();
} else {
    echo "Brak ID użytkownika do odrzucenia.";
}
?>
