<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "login_db"; 

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $zdjecie = mysqli_real_escape_string($conn, $_POST['zdjecie'] . $_POST['nazwa_pliku']);
        $tytul = mysqli_real_escape_string($conn, $_POST['tytul']);
        $data = mysqli_real_escape_string($conn, $_POST['data']);
        $opis = mysqli_real_escape_string($conn, $_POST['opis']);

        $update_query = "UPDATE rere SET zdjecie = '$zdjecie', tytul = '$tytul', data = '$data', opis = '$opis' WHERE id = $id";

        if (mysqli_query($conn, $update_query)) {
            echo "Wydarzenie zostało zaktualizowane. <a href='zarzadzanie_wydarzeniami.php'>Powrót do strony głównej</a>";
        } else {
            echo "Błąd aktualizacji wydarzenia: " . mysqli_error($conn);
        }
    } else {
        $query = "SELECT * FROM rere WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <!DOCTYPE html>
            <html lang="pl">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edytuj Wydarzenie</title>
                <link rel="stylesheet" href="zarzadzanie_wydarzeniami.css">
            </head>
            <body>
                <div>
                <h2>Edytuj Wydarzenie</h2>
                <form action="wydarzenia_update.php?id=<?= $id ?>" method="post">
                    <label>Ścieżka do zdjęcia:</label>
                    <input type="text" id="zdjecie" name="zdjecie" required value="./eventy/" readonly>
                    <input type="text" id="nazwa_pliku" name="nazwa_pliku" value="<?= htmlspecialchars(basename($row['zdjecie'])) ?>" required><br><br>

                    <label>Tytuł: <input type="text" name="tytul" value="<?= htmlspecialchars($row['tytul']) ?>" required></label><br>
                    <label>Data: <input type="date" name="data" value="<?= htmlspecialchars($row['data']) ?>" required></label><br>
                    <label>Opis: <textarea name="opis" required><?= htmlspecialchars($row['opis']) ?></textarea></label><br>
                    <button type="submit">Zapisz zmiany</button>
                </form>
                </div>

            </body>

            <?php
        } else {
            echo "Nie znaleziono wydarzenia o podanym ID.";
        }
    }
} else {
    echo "Brak ID wydarzenia do edycji.";
}

mysqli_close($conn);
?>
