<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Pobieranie wypożyczonych książek dla aktualnie zalogowanego użytkownika
$sql = "SELECT b.okładka, b.tytuł, b.autor, w.id AS wypozyczenie_id 
        FROM wypozyczenia w 
        JOIN biblioteczka b ON w.biblioteczka_id = b.id 
        WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Książki</title>
    <link rel="stylesheet" href="moje.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<!-- <div class="menu-container"> -->

<!-- </div> -->

    <div class="container">
        <header class="header">
            <h1>Moje Książki</h1>
            <p>Oto lista wypożyczonych książek</p>
        </header>
        <div class="menu-container">
            <nav class="menu-content">
                <div class="hamburger-menu" onclick="toggleMenu()">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="menu-list">
                    <li><a href="../dashboard.php">Dashboard</a></li>
                    <li><a href="katalog.php">Katalog Książek</a></li>
                    <li><a href="#">Lektury Obowiązkowe</a>
                        <ul class="submenu">
                            <li><a href="lekturyObowiązkowe13.php">Klasy 1 - 3 szkoła podstawowa</a></li>
                            <li><a href="lekturyObowiązkowe45.php">Klasy 4 - 8 szkoła podstawowa</a></li>
                            <li><a href="lekturyObowiązkowe15.php">Klasy 1 - 5 szkoła średnia</a></li>
                        </ul>
                    </li>
                    <li><a href="moje.php" class="active">Moje Książki</a></li>
                    <li><a href="eventy.php">Wydarzenia</a></li>
                    <li><a href="../profil.php">Profil</a></li>
                </ul>
            </nav>
        </div>


        <div class="books-container" id="books-container">
            <?php if (empty($books)): ?>
                <p>Nie masz wypożyczonych książek.</p>
            <?php else: ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <img src="<?php echo htmlspecialchars($book['okładka']); ?>" alt="<?php echo htmlspecialchars($book['tytuł']); ?>">
                        <h2><?php echo htmlspecialchars($book['tytuł']); ?></h2>
                        <p><?php echo htmlspecialchars($book['autor']); ?></p>
                        <button class="return-button" onclick="returnBook(<?php echo $book['wypozyczenie_id']; ?>)">Zwróć książkę</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function returnBook(wypozyczenie_id) {
                // Inicjalizujemy zapytanie AJAX do PHP
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "return_book.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        window.location.reload(); // Przeładowanie strony
                    }
                };
                xhr.send("id=" + wypozyczenie_id);
            }
        // Pobieranie modali
const returnModal = document.getElementById('returnModal');
const successModal = document.getElementById('successModal');

// Przyciski do potwierdzenia zwrotu książki
const confirmReturnBtn = document.getElementById('confirmReturn');
const cancelReturnBtn = document.getElementById('cancelReturn');

// Elementy do zamknięcia modali
const closeReturnModal = document.getElementById('closeReturnModal');
const closeSuccessModal = document.getElementById('closeSuccessModal');

// Funkcja do otwierania modalu zwrotu
function openReturnModal() {
    returnModal.style.display = "block";
}

// Funkcja do zamykania modalu zwrotu
function closeReturnModalFunc() {
    returnModal.style.display = "none";
}

// Funkcja do otwierania modalu sukcesu
function openSuccessModal() {
    successModal.style.display = "block";
}

// Funkcja do zamykania modalu sukcesu
function closeSuccessModalFunc() {
    successModal.style.display = "none";
}

// Obsługa kliknięcia przycisku zwrotu
document.querySelectorAll('.return-button').forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault(); // Zapobiega domyślnej akcji
        openReturnModal(); // Otwiera modal zwrotu
    });
});

// Potwierdzenie zwrotu
confirmReturnBtn.onclick = function() {
    closeReturnModalFunc();
    openSuccessModal(); // Otwiera modal sukcesu
};

// Anulowanie zwrotu
cancelReturnBtn.onclick = closeReturnModalFunc;

// Zamknięcie modalu przy kliknięciu "X"
closeReturnModal.onclick = closeReturnModalFunc;
closeSuccessModal.onclick = closeSuccessModalFunc;

// Zamknięcie modalu przy kliknięciu gdziekolwiek poza modalem
window.onclick = function(event) {
    if (event.target == returnModal) {
        closeReturnModalFunc();
    }
    if (event.target == successModal) {
        closeSuccessModalFunc();
    }
}

function toggleMenu() {
    const menu = document.querySelector('.menu-content ul');
    const hamburger = document.querySelector('.hamburger-menu');
    menu.classList.toggle('show');
    hamburger.classList.toggle('open');
}


</script>
<!-- Modal zwrotu -->
<div id="returnModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeReturnModal">&times;</span>
        <h2>Czy na pewno chcesz zwrócić tę książkę?</h2>
        <button id="confirmReturn">Tak, zwróć książkę</button>
        <button id="cancelReturn">Anuluj</button>
    </div>
</div>

<!-- Modal informacji po zwrocie -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeSuccessModal">&times;</span>
        <h2>Książka została pomyślnie zwrócona!</h2>
    </div>
</div>
</body>
</html>

<?php $conn->close(); ?>