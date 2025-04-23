<?php
include 'config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <header>
        <h1>Twoja Biblioteka</h1>
            <h3>Szkoła średnia 1 - 5</h3>
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
                            <li><a href="lekturyObowiązkowe15.php" class="active">Klasy 1 - 5 szkoła średnia</a></li>
                        </ul>
                    </li>
                    <li><a href="moje.php">Moje Książki</a></li>
                    <li><a href="eventy.php">Wydarzenia</a></li>
                    <li><a href="../profil.php">Profil</a></li>
                </ul>
            </nav>
        </div>
    <main>
        <section>
            <div class="carousel-container">
                <span class="arrow left-arrow" onclick="scrollCarousel('left')">&#8592;</span>
                <div class="carousel">
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA I</h4>
                        </header>
                        <?php
                            if ($result9->num_rows > 0) {
                                while($row9 = $result9->fetch_assoc()) {
                                    echo "Book: " . $row9["tytul"]. " - Author: " . " " . $row9["autor_imie"] . " " . $row9["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item"> 
                        <header>
                            <h4>KLASA II</h4>
                        </header>                       
                        <?php
                            if ($result10->num_rows > 0) {
                                while($row10 = $result10->fetch_assoc()) {
                                    echo "Book: " . $row10["tytul"]. " - Author: " . " " . $row10["autor_imie"] . " " . $row10["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA III</h4>
                        </header>
                        <?php
                            if ($result11->num_rows > 0) {
                                while($row11 = $result11->fetch_assoc()) {
                                    echo "Book: " . $row11["tytul"]. " - Author: " . " " . $row11["autor_imie"] . " " . $row11["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>   
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA IV</h4>
                        </header>
                        <?php
                            if ($result12->num_rows > 0) {
                                while($row12 = $result12->fetch_assoc()) {
                                    echo "Book: " . $row12["tytul"]. " - Author: " . " " . $row12["autor_imie"] . " " . $row12["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item"> 
                        <header>
                            <h4>KLASA V</h4>
                        </header>                       
                        <?php
                            if ($result13->num_rows > 0) {
                                while($row13 = $result13->fetch_assoc()) {
                                    echo "Book: " . $row13["tytul"]. " - Author: " . " " . $row13["autor_imie"] . " " . $row13["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>   
                </div>
                <span class="arrow right-arrow" onclick="scrollCarousel('right')">&#8594;</span>
            </div>
         
            <script>
                const carousel = document.querySelector('.carousel');
                const items = document.querySelectorAll('.carousel-item');
                const leftArrow = document.querySelector('.left-arrow');
                const rightArrow = document.querySelector('.right-arrow');

                let currentIndex = 0;

                
                function updateCarousel() {
                    const containerWidth = document.querySelector('.carousel-container').offsetWidth;
                    carousel.style.transform = `translateX(-${currentIndex * containerWidth}px)`;
                    items.forEach(item => {
                        item.style.width = `${containerWidth}px`;
                    });
                }

                //-><-
                leftArrow.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateCarousel();
                    }
                });

                rightArrow.addEventListener('click', () => {
                    if (currentIndex < items.length - 1) {
                        currentIndex++;
                        updateCarousel();
                    }
                });

                    // 00
                    window.addEventListener('resize', updateCarousel);
                    updateCarousel();
                

                    function toggleMenu() {
    const menu = document.querySelector('.menu-content ul');
    const hamburger = document.querySelector('.hamburger-menu');
    menu.classList.toggle('show');
    hamburger.classList.toggle('open');
}
            </script>
        </section>
    </main>
</body>
</html>