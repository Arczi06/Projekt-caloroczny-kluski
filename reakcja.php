<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Użytkownik niezalogowany."]);
    exit();
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Błąd połączenia: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $eventId = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    $reactionType = isset($_POST["reaction"]) ? $_POST["reaction"] : "";

    $columns = [
        "👍" => "likes",
        "❤️" => "hearts",
        "👏" => "claps"
    ];

    if ($eventId > 0 && isset($columns[$reactionType])) {
        $column = $columns[$reactionType];

        // Sprawdzenie, czy wydarzenie istnieje
        $checkEventSql = "SELECT COUNT(*) FROM rere WHERE id = ?";
        $stmt = $conn->prepare($checkEventSql);
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $stmt->bind_result($eventExists);
        $stmt->fetch();
        $stmt->close();

        if ($eventExists > 0) {
            // Sprawdzamy, czy użytkownik już dodał reakcję
            $checkReactionSql = "SELECT reaction FROM user_reactions WHERE user_id = ? AND event_id = ?";
            $stmt = $conn->prepare($checkReactionSql);
            $stmt->bind_param("ii", $user_id, $eventId);
            $stmt->execute();
            $stmt->bind_result($existingReaction);
            $reactionExists = $stmt->fetch();
            $stmt->close();

            if ($reactionExists) {
                echo json_encode(["success" => false, "error" => "Już oddałeś reakcję na to wydarzenie."]);
            } else {
                // Zapisujemy reakcję
                $insertReactionSql = "INSERT INTO user_reactions (user_id, event_id, reaction) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insertReactionSql);
                $stmt->bind_param("iis", $user_id, $eventId, $reactionType);

                if ($stmt->execute()) {
                    // Aktualizujemy licznik reakcji w tabeli rere
                    $updateCountSql = "UPDATE rere SET $column = $column + 1 WHERE id = ?";
                    $stmtUpdate = $conn->prepare($updateCountSql);
                    $stmtUpdate->bind_param("i", $eventId);
                    $stmtUpdate->execute();
                    $stmtUpdate->close();

                    // Pobieramy nowe liczniki reakcji
                    $stmt = $conn->prepare("SELECT likes, hearts, claps FROM rere WHERE id = ?");
                    $stmt->bind_param("i", $eventId);
                    $stmt->execute();
                    $stmt->bind_result($likes, $hearts, $claps);
                    $stmt->fetch();
                    $stmt->close();

                    // Zwracamy liczniki reakcji w odpowiedzi
                    echo json_encode([
                        "success" => true,
                        "counts" => [
                            "👍" => $likes,
                            "❤️" => $hearts,
                            "👏" => $claps
                        ]
                    ]);
                } else {
                    echo json_encode(["success" => false, "error" => "Nie udało się zapisać reakcji."]);
                }
                $stmt->close();
            }
        } else {
            echo json_encode(["success" => false, "error" => "Nie znaleziono wydarzenia."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Niepoprawne dane wejściowe."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Nieprawidłowa metoda żądania."]);
}

$conn->close();
?>
