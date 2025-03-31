<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Flip Project</title>
    <link rel="stylesheet" href="user.css"> 
</head>
<body class='katalog'>
    <header>
        <h1>Twoja Biblioteka</h1>
        <form method="GET" id="szukaj">
            <input type="text" name="search" placeholder="Wyszukaj książkę...">
            <button type="submit">🔍</button>
        </form>
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
    <main class="katalog">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lektury";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
        $sql = "SELECT * FROM biblioteczka WHERE tytuł LIKE '%$search%' OR autor LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="wrapper">';
                echo '<div class="card">';
                echo '<div class="front-page" style="background-image: url(' . htmlspecialchars($row["okładka"]) . ');">';
                echo '<div class="card-info">';
                echo '<h2 class="card-title">' . htmlspecialchars($row["tytuł"]) . '</h2>';
                echo '<p class="card-subtitle">' . htmlspecialchars($row["autor"]) . '</p>';
                echo '</div>';
                echo '</div>';

                echo '<div class="back-page">';
                echo '<div class="card-content">';
                echo '<h5>' . htmlspecialchars($row["tytuł"]) . '</h5>';
                echo '<p class="card-description">' . htmlspecialchars($row["krótki_opis"]) . '</p>';
                echo '<button class="card-button open-popup" 
                        data-title="' . htmlspecialchars($row["tytuł"]) . '" 
                        data-description="' . htmlspecialchars($row["streszczenie"]) . '">
                        Odkryj Więcej
                      </button>';
                echo '</div>';
                echo '</div>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Brak wyników wyszukiwania.</p>';
        }

        $conn->close();
        ?>
    </main>

    <div id="popup-box" class="popup">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <h2 id="popup-title"></h2>
            <p id="popup-description"></p>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const popup = document.getElementById("popup-box");
        const popupTitle = document.getElementById("popup-title");
        const popupDescription = document.getElementById("popup-description");
        const closePopup = document.querySelector(".close-popup");

        document.querySelectorAll(".open-popup").forEach(button => {
            button.addEventListener("click", function () {
                popupTitle.textContent = this.getAttribute("data-title");
                popupDescription.textContent = this.getAttribute("data-description");
                popup.style.display = "flex";
            });
        });

        closePopup.addEventListener("click", function () {
            popup.style.display = "none";
        });

        window.addEventListener("click", function (event) {
            if (event.target === popup) {
                popup.style.display = "none";
            }
        });
    });
    </script>
    <footer>
        
    </footer>
</body>
</html>