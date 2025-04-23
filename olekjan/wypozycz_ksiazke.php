<?php
include 'config.php'; // Upewnij się, że masz poprawny plik konfiguracyjny
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Nie jesteś zalogowany.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['biblioteczka_id'])) {
    $biblioteczka_id = intval($_POST['biblioteczka_id']);
    $user_id = $_SESSION['user_id'];

    // Sprawdzenie, czy książka jest już wypożyczona
    $alreadySql = "SELECT id FROM wypozyczenia WHERE biblioteczka_id = ?";
    $alreadyStmt = $conn->prepare($alreadySql);
    $alreadyStmt->bind_param("i", $biblioteczka_id);
    $alreadyStmt->execute();
    $alreadyStmt->store_result();

    if ($alreadyStmt->num_rows > 0) {
        echo "Ta książka jest już wypożyczona. Poczekaj, aż będzie dostępna.";
        $alreadyStmt->close();
        exit();
    }
    $alreadyStmt->close();

    // Sprawdzenie, ile książek użytkownik już wypożyczył
    $checkSql = "SELECT COUNT(*) AS total FROM wypozyczenia WHERE user_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $user_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkRow = $checkResult->fetch_assoc();
    
    // Ustal limit wypożyczeń
    $limit = 4;
    
    if ($checkRow['total'] >= $limit) {
        echo "Osiągnąłeś maksymalny limit wypożyczeń ($limit książek).";
        $checkStmt->close();
        exit();
    }
    $checkStmt->close();

    // Dodanie rekordu do wypożyczeń
    $sql = "INSERT INTO wypozyczenia (user_id, biblioteczka_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $biblioteczka_id);
    
    if ($stmt->execute()) {
        echo "Książka została wypożyczona.";
    } else {
        echo "Błąd: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Błędne żądanie.";
}

$conn->close();
?>
