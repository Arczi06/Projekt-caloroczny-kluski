<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka Online - Panel Użytkownika</title>
    <link rel="stylesheet" href="landing-styles.css">
</head>
<body>
<header>
    <div class="logo-container">
        <img src="logo.png" alt="Logo Biblioteki" id="logo">
        <h1>Biblioteka Online</h1>
    </div>
    
    <!-- Menu hamburgerowe -->
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">&#9776;</label>
    <nav>
        <ul>
            <li><a href="#features">Funkcje</a></li>
            <li><a href="#about">O nas</a></li>
            <li><a href="#contact">Kontakt</a></li>
            <li><a href="forum.html">Społeczność</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="logout.php">Wyloguj się</a></li>        </ul>
    </nav>
</header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Witaj, <?= isset($_SESSION['user_id']) ? 'agencie nr ' . htmlspecialchars($_SESSION['user_id']) : 'Użyszkodniku'; ?>!</h2>

                <p>Miło Cię widzieć w naszej bibliotece online</p>
                <div class="cta-buttons">
                    <a href="forum.html" class="btn-secondary">Dołącz do dyskusji</a>
                </div>
            </div>
            
        </section>

        <section id="features" class="features">
            <h2>Twoje Funkcje</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <img src="book_1.png" alt="Książki">
                    <h3>Twoja Kolekcja</h3>
                    <p>Przeglądaj i zarządzaj swoimi książkami</p>
                </div>
                <div class="feature-card">
                    <img src="book_2.png" alt="Czytanie">
                    <h3>Historia</h3>
                    <p>Zobacz swoje ostatnio czytane książki</p>
                </div>
                <div class="feature-card">
                    <img src="book_3.png" alt="Społeczność">
                    <h3>Rekomendacje</h3>
                    <p>Otrzymuj spersonalizowane propozycje</p>
                </div>
            </div>
        </section>

        <section id="about" class="about">
            <h2>O Nas</h2>
            <p>Jako zalogowany użytkownik masz dostęp do pełnej funkcjonalności naszej biblioteki. Korzystaj z naszych zasobów i dołącz do społeczności czytelników!</p>
        </section>

        <section id="contact" class="contact">
            <h2>Kontakt</h2>
            <p>Masz pytania? Skontaktuj się z nami:</p>
            <p>Email: kontakt@bibliotekaonline.pl</p>
            <p>Telefon: +48 123 456 789</p>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2023 Biblioteka Online. Wszystkie prawa zastrzeżone.</p>
            <ul>
                <li><a href="warunki.html">Warunki użytkowania</a></li>
                <li><a href="#">Polityka prywatności</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
