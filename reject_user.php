<?php
include 'config.php';

// Sprawdzamy, czy mamy ID użytkownika, który ma zostać odrzucony
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Sprawdzamy, czy użytkownik istnieje w pending_users
    $sql = "SELECT id FROM pending_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Zmiana statusu na "rejected" w tabeli pending_users
        $sqlUpdate = "UPDATE pending_users SET status = 'rejected' WHERE id = ?";
        $updateStmt = $conn->prepare($sqlUpdate);
        $updateStmt->bind_param("i", $userId);
        $updateStmt->execute();

    }
    $stmt->close();
    $conn->close();
} else {
    echo "Brak ID użytkownika do odrzucenia.";
}
?>
