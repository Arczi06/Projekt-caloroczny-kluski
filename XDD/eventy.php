<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wydarzenia i Aktualności</title>
    <link rel="stylesheet" href="eventy.css">
</head>
<body>
<header>
        <h1>Wydarzenia</h1> 
    </header>
    <div class="menu-container">
        <button class="menu-button">☰</button>
        <nav class="menu-content">
            <ul>
                <li><a href="core.html">Strona Główna</a></li>
                <li><a href="katalog.php">Katalog Książek</a></li>
                <li><a href="#">Lektury Obowiązkowe</a>
                    <ul class="submenu">
                        <li><a href="lekturyObowiązkowe13.php">Klasy 1 - 3 szkoła podstawowa</a></li>
                        <li><a href="lekturyObowiązkowe45.php">Klasy 4 - 8 szkoła podstawowa</a></li>
                        <li><a href="lekturyObowiązkowe15.php">Klasy 1 - 5 szkoła średnia</a></li>
                    </ul>
                </li>
                <li><a href="moje.php">Moje Książki</a></li>
                <li><a href="eventy.php">Wydarzenia</a></li>
                <li><a href="profil.php">Profil</a></li>
            </ul>
        </nav>
    </div>
    <main>
        <?php
        $conn = new mysqli("localhost", "root", "", "lektury");
        if ($conn->connect_error) {
            die("Błąd połączenia: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM wydarzenia ORDER BY data ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="event-card">';
                echo '<div class="event-header" style="background-image: url(' . htmlspecialchars($row["zdjecie"]) . ');"></div>';
                echo '<div class="event-content">';
                echo '<h2>' . htmlspecialchars($row["tytul"]) . '</h2>';
                echo '<p class="event-date">📅 ' . htmlspecialchars($row["data"]) . '</p>';
                echo '<p>' . htmlspecialchars($row["opis"]) . '</p>';
                echo '<div class="reactions">';
                echo '<span class="reaction" data-id="' . $row["id"] . '" data-reaction="👍">👍</span>';
                echo '<span class="reaction" data-id="' . $row["id"] . '" data-reaction="❤️">❤️</span>';
                echo '<span class="reaction" data-id="' . $row["id"] . '" data-reaction="👏">👏</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Brak wydarzeń.</p>';
        }
        $conn->close();
        ?>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const reactions = document.querySelectorAll(".reaction");

    reactions.forEach(reaction => {
        reaction.addEventListener("click", function () {
            const eventId = this.getAttribute("data-id");
            const reactionType = this.getAttribute("data-reaction");

            fetch("reakcja.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${eventId}&reaction=${reactionType}`
            })
            .then(response => response.text())
            .then(data => {
                alert("Dziękujemy za reakcję!");
            })
            .catch(error => console.error("Błąd:", error));
        });
    });
});

    </script>
</body>
</html>
