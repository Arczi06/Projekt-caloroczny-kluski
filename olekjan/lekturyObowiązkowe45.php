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
            <h3>Klasy 4 - 8</h3>
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
                            <li><a href="lekturyObowiązkowe45.php" class="active">Klasy 4 - 8 szkoła podstawowa</a></li>
                            <li><a href="lekturyObowiązkowe15.php">Klasy 1 - 5 szkoła średnia</a></li>
                        </ul>
                    </li>
                    <li><a href="moje.php">Moje Książki</a></li>
                    <li><a href="eventy.php">Wydarzenia</a></li>
                    <li><a href="../profil.php">Profil</a></li>
                </ul>
            </nav>
        </div>
    <main >
        <section>
            <div class="carousel-container">
                <span class="arrow left-arrow" onclick="scrollCarousel('left')">&#8592;</span>
                <div class="carousel">
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA IV</h4>
                        </header>
                        <?php
                            if ($result4->num_rows > 0) {
                                while($row4 = $result4->fetch_assoc()) {
                                    echo "Book: " . $row4["tytul"]. " - Author: " . " " . $row4["autor_imie"] . " " . $row4["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item"> 
                        <header>
                            <h4>KLASA V</h4>
                        </header>                       
                        <?php
                            if ($result5->num_rows > 0) {
                                while($row5 = $result5->fetch_assoc()) {
                                    echo "Book: " . $row5["tytul"]. " - Author: " . " " . $row5["autor_imie"] . " " . $row5["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA VI</h4>
                        </header>
                        <?php
                            if ($result6->num_rows > 0) {
                                while($row6 = $result6->fetch_assoc()) {
                                    echo "Book: " . $row6["tytul"]. " - Author: " . " " . $row6["autor_imie"] . " " . $row6["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>  
                    </div>
                    <div class="carousel-item"> 
                        <header>
                            <h4>KLASA VII</h4>
                        </header>                       
                        <?php
                            if ($result7->num_rows > 0) {
                                while($row7 = $result7->fetch_assoc()) {
                                    echo "Book: " . $row7["tytul"]. " - Author: " . " " . $row7["autor_imie"] . " " . $row7["autor_nazwisko"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA VIII</h4>
                        </header>
                        <?php
                            if ($result8->num_rows > 0) {
                                while($row8 = $result8->fetch_assoc()) {
                                    echo "Book: " . $row8["tytul"]. " - Author: " . " " . $row8["autor_imie"] . " " . $row8["autor_nazwisko"] ."<br>";
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