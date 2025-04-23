<?php
include 'config.php';

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    
    // Pobranie danych książki, aby usunąć okładkę z serwera
    $sql = "SELECT okładka FROM biblioteczka WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        $okładka = $book['okładka'];
        
        // Usunięcie okładki z serwera
        unlink("uploads/" . $okładka);
        
        // Usunięcie książki z bazy danych
        $deleteSql = "DELETE FROM biblioteczka WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $book_id);
        
        if ($deleteStmt->execute()) {
            echo "Książka została usunięta.";
            header("Location: books.php");
        } else {
            echo "Błąd: " . $deleteStmt->error;
        }
        
        $deleteStmt->close();
    } else {
        echo "Książka nie została znaleziona.";
    }

    $stmt->close();
}
$conn->close();
?>
