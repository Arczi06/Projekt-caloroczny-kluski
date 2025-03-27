<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "lektury"; 

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'add' && !isset($_SESSION['form_submitted'])) {
    $_SESSION['form_submitted'] = true; 
    $zdjecie = mysqli_real_escape_string($conn, $_POST['zdjecie'] . $_POST['nazwa_pliku']);
    $tytul = mysqli_real_escape_string($conn, $_POST['tytul']);
    $data = mysqli_real_escape_string($conn, $_POST['data']);
    $opis = mysqli_real_escape_string($conn, $_POST['opis']);

    $query = "INSERT INTO rere (zdjecie, tytul, data, opis) VALUES ('$zdjecie', '$tytul', '$data', '$opis')";
    if (mysqli_query($conn, $query)) {

    } else {
        echo "Błąd dodawania wydarzenia: " . mysqli_error($conn);
    }
} else if (isset($_SESSION['form_submitted'])) {
    unset($_SESSION['form_submitted']); 
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete_query = "DELETE FROM rere WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {

    } else {
        echo "Błąd usuwania wydarzenia: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM rere";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Wydarzeniami</title>
    <link rel="stylesheet" href="zarzadzanie_wydarzeniami.css">
</head>
<body>
<div class='dodaj'>
    <h2>Dodaj nowe wydarzenie</h2>
    <form action="?action=add" method="post">
        <label for="zdjecie">Ścieżka do zdjęcia:</label>
        <input id="path" type="text" id="zdjecie" name="zdjecie" required value="./eventy/" readonly> 
        <input type="file" id="nazwa_pliku" name="nazwa_pliku" required placeholder="nazwa_pliku.jpg"> <br><br>

        <label for="tytul">Tytuł:</label>
        <input type="text" id="tytul" name="tytul" required><br><br>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required><br><br>

        <label for="opis">Opis:</label>
        <textarea id="opis" name="opis" required></textarea><br><br>

        <button type="submit">Dodaj wydarzenie</button>
    </form>
</div>
    <div class='usun'>
        <h2>Lista wydarzeń</h2>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li>
                    <strong><?php echo $row['tytul']; ?></strong> - <?php echo $row['data']; ?><br>
                    <?php echo $row['opis']; ?><br>
                    <a href="wydarzenia_update.php?id=<?php echo $row['id']; ?>">Edytuj</a> |
                    <a href="?action=delete&id=<?php echo $row['id']; ?>">Usuń</a>
                </li><br>
            <?php } ?>
        </ul>
    </div>

    <?php mysqli_close($conn); ?>
</body>
</html>
