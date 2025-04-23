<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    exit("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['id']; // Pobierz ID książki

    // Zapytanie do bazy danych, aby zwrócić książkę
    $sql = "DELETE FROM wypozyczenia WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $book_id, $user_id);

    if ($stmt->execute()) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Nie udało się zwrócić książki."));
    }

    $stmt->close();
} else {
    http_response_code(405); // Method Not Allowed
}
$conn->close();
?>