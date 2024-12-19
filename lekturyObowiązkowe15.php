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
            <h3>Szkoła średnia 1 - 5</h3>
    </header>
    <main>
        <nav>
            <ul>
                <li><a href="lekturyObowiązkowe13.php">Klasy 1 - 3</a></li>
                <li><a href="core.html">Strona Główna</a></li>
                <li><a href="lekturyObowiązkowe45.php">Kl. średnie 4 - 8</a></li>
            </ul>
        </nav>
        <section>
            <div class="carousel-container">
                <span class="arrow left-arrow" onclick="scrollCarousel('left')">&#8592;</span>
                <div class="carousel">
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA I</h4>
                        </header>
                        <?php
                            if ($resultS1->num_rows > 0) {
                                while($rowS1 = $resultS1->fetch_assoc()) {
                                    echo "Book: " . $rowS1["tittle"]. " - Author: " . " " . $rowS1["author_name"] . " " . $rowS1["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item"> 
                        <header>
                            <h4>KLASA II</h4>
                        </header>                       
                        <?php
                            if ($resultS2->num_rows > 0) {
                                while($rowS2 = $resultS2->fetch_assoc()) {
                                    echo "Book: " . $rowS2["tittle"]. " - Author: " . " " . $rowS2["author_name"] . " " . $rowS2["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA III</h4>
                        </header>
                        <?php
                            if ($resultS3->num_rows > 0) {
                                while($rowS3 = $resultS3->fetch_assoc()) {
                                    echo "Book: " . $rowS3["tittle"]. " - Author: " . " " . $rowS3["author_name"] . " " . $rowS3["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA IV</h4>
                        </header>
                        <?php
                            if ($resultS4->num_rows > 0) {
                                while($rowS4 = $resultS4->fetch_assoc()) {
                                    echo "Book: " . $rowS4["tittle"]. " - Author: " . " " . $rowS4["author_name"] . " " . $rowS4["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA V</h4>
                        </header>
                        <?php
                            if ($resultS5->num_rows > 0) {
                                while($rowS5 = $resultS5->fetch_assoc()) {
                                    echo "Book: " . $rowS5["tittle"]. " - Author: " . " " . $rowS5["author_name"] . " " . $rowS5["author_lastname"] ."<br>";
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