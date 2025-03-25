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

// Dodawanie książki
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'add' && !isset($_SESSION['form_submitted'])) {
    $_SESSION['form_submitted'] = true;
    
    $okladka = mysqli_real_escape_string($conn, $_POST['okladka'] . $_POST['nazwa_pliku']);
    $tytul = mysqli_real_escape_string($conn, $_POST['tytul']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $krotki_opis = mysqli_real_escape_string($conn, $_POST['krotki_opis']);
    $streszczenie = mysqli_real_escape_string($conn, $_POST['streszczenie']);

    $query = "INSERT INTO biblioteczka (okładka, tytuł, autor, krótki_opis, streszczenie) VALUES ('$okladka', '$tytul', '$autor', '$krotki_opis', '$streszczenie')";
    
    if (mysqli_query($conn, $query)) {
        // echo "Książka została dodana!";
    } else {
        // echo "Błąd dodawania książki: " . mysqli_error($conn);
    }
} else if (isset($_SESSION['form_submitted'])) {
    unset($_SESSION['form_submitted']);
}

// Usuwanie książki
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete_query = "DELETE FROM biblioteczka WHERE id = $id";
    
    if (mysqli_query($conn, $delete_query)) {
        // echo "Książka została usunięta.";
    } else {
        // echo "Błąd usuwania książki: " . mysqli_error($conn);
    }
}

// Wyświetlanie książek
$query = "SELECT * FROM biblioteczka";
$result = mysqli_query($conn, $query);

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

<div class='dodaj'>
    <h2>Dodaj nową książkę</h2>
    <form action="?action=add" method="post">
        <label for="okladka">Ścieżka do okładki:</label>
        <input type="text" id="path" name="okladka" value="./biblioteka/" readonly>
        <input type="text" id="nazwa_pliku" name="nazwa_pliku" required placeholder="nazwa_pliku.jpg"> <br><br>

        <label for="tytul">Tytuł:</label>
        <input type="text" id="tytul" name="tytul" required><br><br>

        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required><br><br>

        <label for="krotki_opis">Krótki opis:</label>
        <textarea id="krotki_opis" name="krotki_opis" required></textarea><br><br>

        <label for="streszczenie">Streszczenie:</label>
        <textarea id="streszczenie" name="streszczenie" required></textarea><br><br>

        <button type="submit">Dodaj książkę</button>
    </form>
</div>

<div class='usun'>
    <h2>Lista książek</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <strong><?php echo htmlspecialchars($row['tytuł']); ?></strong> - <?php echo htmlspecialchars($row['autor']); ?><br>
                <em><?php echo htmlspecialchars($row['krótki_opis']); ?></em><br>
                <a href="ksiazki_update.php?id=<?php echo $row['id']; ?>">Edytuj</a> |
                <a href="?action=delete&id=<?php echo $row['id']; ?>">Usuń</a>
            </li><br>
        <?php } ?>
    </ul>
</div>

<?php mysqli_close($conn); ?>
</body>
</html>
