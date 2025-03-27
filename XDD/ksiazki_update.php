<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "lektury"; 

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $okładka = mysqli_real_escape_string($conn, $_POST['okładka'] . $_POST['nazwa_pliku']);
        $tytul = mysqli_real_escape_string($conn, $_POST['tytul']);
        $autor = mysqli_real_escape_string($conn, $_POST['autor']);
        $krotki_opis = mysqli_real_escape_string($conn, $_POST['krotki_opis']);
        $streszczenie = mysqli_real_escape_string($conn, $_POST['streszczenie']);

        $update_query = "UPDATE biblioteczka SET okładka = '$okładka', tytuł = '$tytul', autor = '$autor', krótki_opis = '$krotki_opis', streszczenie = '$streszczenie' WHERE id = $id";

        if (mysqli_query($conn, $update_query)) {
            echo "Książka została zaktualizowana. <a href='zarzadzanie_ksiazkami.php'>Powrót do strony głównej</a>";
        } else {
            echo "Błąd aktualizacji książki: " . mysqli_error($conn);
        }
    } else {
        $query = "SELECT * FROM biblioteczka WHERE id = ?";
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
                <title>Zarządzanie Książkami</title>
                <link rel="stylesheet" href="zarzadzanie_wydarzeniami.css">
            </head>
            <body>
                <div>
                <h2>Edytuj Książkę</h2>
                <form action="ksiazki_update.php?id=<?= $id ?>" method="post">
                    <label>Ścieżka do zdjęcia:</label>
                    <input type="text" id="path" name="okładka" required value="./biblioteka/" readonly>
                    <input type="file" id="nazwa_pliku" name="nazwa_pliku" value="<?= htmlspecialchars(basename($row['okładka'])) ?>" required><br><br>

                    <label>Tytuł: <input type="text" name="tytul" value="<?= htmlspecialchars($row['tytuł']) ?>" required></label><br>
                    <label>Autor: <input type="text" name="autor" value="<?= htmlspecialchars($row['autor']) ?>" required></label><br>
                    <label>Krótki Opis: <textarea name="krotki_opis" required><?= htmlspecialchars($row['krótki_opis']) ?></textarea></label><br>
                    <label>Streszczenie: <textarea name="streszczenie" required><?= htmlspecialchars($row['streszczenie']) ?></textarea></label><br>
                    <button type="submit"><a href="zarzadzanie_ksiazkami.php"></a>Zapisz zmiany</button>
                </form>
                </div>

            </body>

            <?php
        } else {
            echo "Nie znaleziono książki o podanym ID.";
        }
    }
} else {
    echo "Brak ID książki do edycji.";
}

mysqli_close($conn);
?>
