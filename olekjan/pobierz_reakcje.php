<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Błąd połączenia: " . $conn->connect_error]));
}

if (isset($_GET["id"])) {
    $eventId = intval($_GET["id"]);

    $sql = "SELECT likes, hearts, claps FROM rere WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $stmt->bind_result($likes, $hearts, $claps);
    $stmt->fetch();
    $stmt->close();

    echo json_encode([
        "success" => true,
        "counts" => [
            "👍" => $likes,
            "❤️" => $hearts,
            "👏" => $claps
        ]
    ]);
} else {
    echo json_encode(["success" => false, "error" => "Brak ID wydarzenia."]);
}

$conn->close();
?>
