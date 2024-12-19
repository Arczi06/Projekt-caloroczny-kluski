<?php
include 'config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lekturyObowiązkowe.css">
</head>
<body>
    <header>
        <h1>Twoja Biblioteka</h1>
            <h3>Klasy 4 - 8</h3>
    </header>
    <main>
        <nav>
            <ul>
                <li><a href="lekturyObowiązkowe13.php">Klasy 1 - 3</a></li>
                <li><a href="core.html">Strona Główna</a></li>
                <li><a href="lekturyObowiązkowe15.php">Kl. średnie 1 - 5</a></li>
            </ul>
        </nav>
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
                                    echo "Book: " . $row4["tittle"]. " - Author: " . " " . $row4["author_name"] . " " . $row4["author_lastname"] ."<br>";
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
                                    echo "Book: " . $row5["tittle"]. " - Author: " . " " . $row5["author_name"] . " " . $row5["author_lastname"] ."<br>";
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
                                    echo "Book: " . $row6["tittle"]. " - Author: " . " " . $row6["author_name"] . " " . $row6["author_lastname"] ."<br>";
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
                                    echo "Book: " . $row7["tittle"]. " - Author: " . " " . $row7["author_name"] . " " . $row7["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA VII</h4>
                        </header>
                        <?php
                            if ($result8->num_rows > 0) {
                                while($row8 = $result8->fetch_assoc()) {
                                    echo "Book: " . $row8["tittle"]. " - Author: " . " " . $row8["author_name"] . " " . $row8["author_lastname"] ."<br>";
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
                
            </script>
        </section>
    </main>
</body>
</html>