
Skrypt PHP (reakcja.php):

<?php
$conn = new mysqli("localhost", "root", "", "lektury");
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $reaction = $_POST["reaction"];
    
    $column = "";
    if ($reaction === "👍") {
        $column = "reakcje_likes";
    } elseif ($reaction === "❤️") {
        $column = "reakcje_hearts";
    } elseif ($reaction === "👏") {
        $column = "reakcje_claps";
    }
    
    if ($column) {
        // Użyj przygotowanych zapytań, aby uniknąć SQL Injection
        $stmt = $conn->prepare("UPDATE wydarzenia SET $column = $column + 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    
    // Pobierz zaktualizowane wartości reakcji
    $stmt = $conn->prepare("SELECT reakcje_likes, reakcje_hearts, reakcje_claps FROM wydarzenia WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    $stmt->close();
}
$conn->close();
?>