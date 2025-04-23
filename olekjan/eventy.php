<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wydarzenia i Aktualności</title>
    <link rel="stylesheet" href="user.css">
    <script defer src="script.js"></script>
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
                <li><a href="../profil.php">Profil</a></li>
            </ul>
        </nav>
    </div>
<main class="eventy">
    <?php
    $conn = new mysqli("localhost", "root", "", "login_db");
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }
    
    $sql = "SELECT id, zdjecie, tytul, data, opis, COALESCE(likes, 0) AS likes, COALESCE(hearts, 0) AS hearts, COALESCE(claps, 0) AS claps FROM rere ORDER BY data ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="event-card" data-event-id="' . $row["id"] . '">';
            echo '<div class="event-header" style="background-image: url(' . htmlspecialchars($row["zdjecie"]) . ');"></div>';
            echo '<div class="event-content">';
            echo '<h2>' . htmlspecialchars($row["tytul"]) . '</h2>';
            echo '<p class="event-date">📅 ' . htmlspecialchars($row["data"]) . '</p>';
            echo '<p>' . htmlspecialchars($row["opis"]) . '</p>';
            echo '<div class="reactions">';
            echo '<span class="reaction" data-reaction="👍">👍 <span class="count">' . $row["likes"] . '</span></span>';
            echo '<span class="reaction" data-reaction="❤️">❤️ <span class="count">' . $row["hearts"] . '</span></span>';
            echo '<span class="reaction" data-reaction="👏">👏 <span class="count">' . $row["claps"] . '</span></span>';
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
// Funkcja kliknięcia reakcji
document.querySelectorAll(".reaction").forEach(button => {
    button.addEventListener("click", function () {
        const eventCard = this.closest(".event-card");
        const eventId = eventCard.getAttribute("data-event-id");
        const reaction = this.getAttribute("data-reaction");

        if (this.classList.contains("reacted")) {
            return; // Jeśli użytkownik już dodał reakcję, nie robimy nic
        }

        fetch("reakcja.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${encodeURIComponent(eventId)}&reaction=${encodeURIComponent(reaction)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.classList.add("reacted");
                this.style.pointerEvents = "none";
                this.style.color = "gray";
                refreshReactions();
            } else {
                alert(data.error);
            }
        })
        .catch(error => console.error("Błąd:", error));
    });
});

function refreshReactions() {
    document.querySelectorAll('.event-card').forEach(eventCard => {
        const eventId = eventCard.getAttribute('data-event-id');

        fetch("pobierz_reakcje.php?id=" + eventId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const reactionElements = eventCard.querySelectorAll('.reaction');
                    reactionElements.forEach(reactionElement => {
                        const reactionType = reactionElement.getAttribute('data-reaction');
                        const countElement = reactionElement.querySelector('.count');
                        if (data.counts[reactionType]) {
                            countElement.textContent = data.counts[reactionType];
                        }
                    });
                }
            })
            .catch(error => console.error("Błąd pobierania reakcji:", error));
    });
}

// Sprawdzanie nowych reakcji co minutę
function checkForNewReactions() {
    fetch("sprawdz_nowe_reakcje.php")
        .then(response => response.text())
        .then(data => {
            if (data === 'true') {
                refreshReactions();
            }
        })
        .catch(error => console.error("Błąd sprawdzania nowych reakcji:", error));
}

// Odświeżanie reakcji co minutę
setInterval(checkForNewReactions, 1000); 
</script>
</body>
</html>
