<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lektury";

// Połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Błąd połączenia: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $eventId = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    $reactionType = isset($_POST["reaction"]) ? $_POST["reaction"] : "";

    // Mapowanie reakcji na kolumny w bazie danych
    $columns = [
        "👍" => "likes",
        "❤️" => "hearts",
        "👏" => "claps"
    ];

    if ($eventId > 0 && isset($columns[$reactionType])) {
        $column = $columns[$reactionType];

        // Sprawdzenie, czy event istnieje
        $checkEventSql = "SELECT COUNT(*) AS count FROM rere WHERE id = ?";
        $stmt = $conn->prepare($checkEventSql);
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $stmt->bind_result($eventExists);
        $stmt->fetch();
        $stmt->close();

        if ($eventExists > 0) {
            // Aktualizacja liczby reakcji w bazie danych
            $sql = "UPDATE rere SET $column = $column + 1 WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $eventId);
            if ($stmt->execute()) {
                // Pobranie aktualnej wartości reakcji
                $result = $conn->query("SELECT $column FROM rere WHERE id = $eventId");
                $row = $result->fetch_assoc();
                echo json_encode(["success" => true, "count" => $row[$column]]);
            } else {
                echo json_encode(["success" => false, "error" => "Nie udało się zaktualizować reakcji."]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "error" => "Nie znaleziono zdarzenia o podanym identyfikatorze."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Niepoprawne dane wejściowe."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Nieprawidłowa metoda żądania."]);
}

$conn->close();
?>
