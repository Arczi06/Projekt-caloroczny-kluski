CREATE DATABASE biblioteka;

USE biblioteka;

CREATE TABLE biblioteczka (
    id INT PRIMARY KEY AUTO_INCREMENT,
    okładka LONGBLOB,
    tytuł VARCHAR(255),
    autor VARCHAR(255),
    opis TEXT,
    opis2 TEXT,
    opis3 TEXT
);


INSERT INTO biblioteczka (okładka, tytuł, autor, opis, opis2, opis3) VALUES
    (
        -- Zastąp to rzeczywistym obrazem w postaci binarnej
        -- lub NULL, jeśli nie chcesz dodawać obrazu
        NULL, 
        'Hobbit', 
        'J.R.R. Tolkien', 
        'Przygoda Bilba Bagginsa, hobbita, który wyrusza na wyprawę z krasnoludami, aby odzyskać skradziony skarb.',
        'Książka jest pełna magii, przygody i pięknych opisów krajobrazów.',
        'Pierwsza część trylogii "Władca Pierścieni".'
    ),
    (
        -- Zastąp to rzeczywistym obrazem w postaci binarnej
        -- lub NULL, jeśli nie chcesz dodawać obrazu
        NULL,
        '1984', 
        'George Orwell', 
        'Dystopijna powieść o totalitarnym państwie, w którym rząd kontroluje wszystko.',
        'Książka porusza ważne tematy dotyczące wolności, kontroli i manipulacji.',
        'Powieść stała się klasyką literatury dystopijnej.'
    ),
    (
        -- Zastąp to rzeczywistym obrazem w postaci binarnej
        -- lub NULL, jeśli nie chcesz dodawać obrazu
        NULL,
        'Mały Książę', 
        'Antoine de Saint-Exupéry', 
        'Historia małego księcia, który podróżuje po różnych planetach i spotyka dziwnych mieszkańców.',
        'Książka pełna mądrych przemyśleń i pięknych ilustracji.',
        'Powieść dla dzieci i dorosłych, która porusza tematy miłości, przyjaźni i sensu życia.'
    );