<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Książki</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="logo"></div>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="users.php">Użytkownicy</a></li>
            <li><a href="books.php" class="active">Książki</a></li>
            <li><a href="recived_bmessages.php">Wiadomości</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="card"> 
            <h3>Książki</h3>
            <p>Liczba: <span id="bookCount">
                <?php
                    include 'config.php';
                    $result = $conn->query("SELECT COUNT(*) AS count FROM biblioteczka");
                    $row = $result->fetch_assoc();
                    echo $row['count']; 
                ?>
            </span></p>
        </div>
    </div>

    <section id="books">
        <h2>Zarządzanie Książkami</h2>
        <p>Wyszukaj książki:</p>
        <form method="GET" action="bookss.php">
            <input type="text" name="search" placeholder="Szukaj książek..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Szukaj</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Krótki opis</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';

                // Pobierz tekst z formularza wyszukiwania, jeśli istnieje
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                // Przygotowanie zapytania SQL
                $sql = "SELECT id, okładka, tytuł, autor, krótki_opis FROM biblioteczka WHERE tytuł LIKE ? OR autor LIKE ? ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
                
                // Przygotowanie zmiennej do wyszukiwania
                $search_term = "%" . $search . "%";
                $stmt->bind_param("ss", $search_term, $search_term);

                // Wykonanie zapytania
                $stmt->execute();
                $result = $stmt->get_result();

                // Wyświetlanie wyników
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                    
                        
                        echo "<td>" . htmlspecialchars($row["tytuł"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["autor"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["krótki_opis"]) . "</td>";
                        
                        echo "<td>
                                <a href='edit_book.php?id=" . $row["id"] . "'>Edytuj</a> | 
                                <a href='delete_book.php?id=" . $row["id"] . "'>Usuń</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Brak książek.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </section>

</body>
</html>
