<?php
include 'config.php';  // Wczytanie konfiguracji połączenia z bazą danych

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    
    // Pobranie danych książki
    $sql = "SELECT * FROM biblioteczka WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Książka nie została znaleziona.");
    }
} else {
    die("Nie przekazano ID książki.");
}
?>

<h2>Edytuj książkę</h2>
<form method="POST" action="update_book.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $book['id'] ?>">
    
    <label for="tytuł">Tytuł:</label>
    <input type="text" name="tytuł" value="<?= htmlspecialchars($book['tytuł']) ?>" required><br>
    
    <label for="autor">Autor:</label>
    <input type="text" name="autor" value="<?= htmlspecialchars($book['autor']) ?>" required><br>
    
    <label for="krótki_opis">Krótki opis:</label>
    <textarea name="krótki_opis" required><?= htmlspecialchars($book['krótki_opis']) ?></textarea><br>
    
    <label for="streszczenie">Streszczenie:</label>
    <textarea name="streszczenie" required><?= htmlspecialchars($book['streszczenie']) ?></textarea><br>
    
    <label for="okładka">Okładka (nowy plik):</label>
    <input type="file" name="okładka"><br>
    
    <button type="submit">Zaktualizuj</button>
</form>
