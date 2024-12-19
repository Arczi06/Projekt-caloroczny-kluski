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
            <h3>Klasy 1 - 3</h3>
    </header>
    <main>
        <nav>
            <ul>
                <li><a href="lekturyObowiązkowe45.php">Klasy 4 - 8</a></li>
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
                            <h4>KLASA I</h4>
                        </header>
                        <?php
                            if ($result1->num_rows > 0) {
                                while($row1 = $result1->fetch_assoc()) {
                                    echo "Book: " . $row1["tittle"]. " - Author: " . " " . $row1["author_name"] . " " . $row1["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item"> 
                        <header>
                            <h4>KLASA II</h4>
                        </header>                       
                        <?php
                            if ($result2->num_rows > 0) {
                                while($row2 = $result2->fetch_assoc()) {
                                    echo "Book: " . $row2["tittle"]. " - Author: " . " " . $row2["author_name"] . " " . $row2["author_lastname"] ."<br>";
                                }
                            }
                        ?>
                    </div>
                    <div class="carousel-item">
                        <header>
                            <h4>KLASA III</h4>
                        </header>
                        <?php
                            if ($result3->num_rows > 0) {
                                while($row3 = $result3->fetch_assoc()) {
                                    echo "Book: " . $row3["tittle"]. " - Author: " . " " . $row3["author_name"] . " " . $row3["author_lastname"] ."<br>";
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
