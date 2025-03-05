create database lektury;
CREATE TABLE dane_ksiazek (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    autor_imie CHAR(50) NOT NULL,
    autor_nazwisko CHAR(100) NOT NULL,
    tytul VARCHAR(100) NOT NULL,
    klasa INT NOT NULL
);

-- Lektury dla klasy 1 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Julian', 'Tuwim', 'Lokomotywa', 1),
('Jan', 'Brzechwa', 'Kaczka Dziwaczka', 1),
('Czesław', 'Janczarski', 'Jak Wojtek został strażakiem', 1),
('Maria', 'Konopnicka', 'Stefek Burczymucha', 1),
('Jan', 'Brzechwa', 'Na straganie', 1);

-- Lektury dla klasy 2 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Jan', 'Brzechwa', 'Akademia Pana Kleksa', 2),
('Astrid', 'Lindgren', 'Dzieci z Bullerbyn', 2),
('Wanda', 'Chotomska', 'Dwa Michały', 2),
('Grzegorz', 'Kasdepke', 'Detektyw Pozytywka', 2),
('Maria', 'Konopnicka', 'O krasnoludkach i sierotce Marysi', 2);

-- Lektury dla klasy 3 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Hugh', 'Lofting', 'Doktor Dolittle i jego zwierzęta', 3),
('Renata', 'Piątkowska', 'Na wszystko jest sposób', 3),
('Julian', 'Tuwim', 'Ptasie radio', 3),
('Jan', 'Brzechwa', 'Samochwała', 3),
('Wanda', 'Chotomska', 'Kurczę blade', 3);

-- Lektury dla klasy 4 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Henryk', 'Sienkiewicz', 'W pustyni i w puszczy', 4),
('Adam', 'Mickiewicz', 'Pan Tadeusz (fragmenty)', 4),
('Lucy', 'Maud Montgomery', 'Ania z Zielonego Wzgórza', 4),
('Mark', 'Twain', 'Przygody Tomka Sawyera', 4),
('Kornel', 'Makuszyński', 'Szatan z siódmej klasy', 4);

-- Lektury dla klasy 5 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Bolesław', 'Prus', 'Katarynka', 5),
('Stefan', 'Żeromski', 'Syzyfowe prace', 5),
('Juliusz', 'Słowacki', 'Balladyna', 5),
('Ignacy', 'Krasicki', 'Żona modna', 5),
('Aleksander', 'Fredro', 'Zemsta', 5);

-- Lektury dla klasy 6 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Henryk', 'Sienkiewicz', 'Latarnik', 6),
('Lucy', 'Maud Montgomery', 'Ania z Avonlea', 6),
('Jules', 'Verne', 'W 80 dni dookoła świata', 6),
('John', 'Tolkien', 'Hobbit, czyli tam i z powrotem', 6),
('Edmund', 'Niziurski', 'Sposób na Alcybiadesa', 6);

-- Lektury dla klasy 7 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Adam', 'Mickiewicz', 'Reduta Ordona', 7),
('Aleksander', 'Fredro', 'Zemsta', 7),
('Juliusz', 'Verne', 'Podróż do wnętrza Ziemi', 7),
('Homer', '', 'Odyseja (fragmenty)', 7),
('Lucy', 'Maud Montgomery', 'Ania na uniwersytecie', 7);

-- Lektury dla klasy 8 szkoły podstawowej
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Henryk', 'Sienkiewicz', 'Krzyżacy', 8),
('Juliusz', 'Słowacki', 'Balladyna', 8),
('Stefan', 'Żeromski', 'Syzyfowe prace', 8),
('George', 'Orwell', 'Folwark zwierzęcy', 8),
('Fiodor', 'Dostojewski', 'Zbrodnia i kara (fragmenty)', 8);

-- Lektury dla klasy 9 (1 szkoły średniej)
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Adam', 'Mickiewicz', 'Dziady cz. II', 9),
('William', 'Shakespeare', 'Makbet', 9),
('Bolesław', 'Prus', 'Lalka', 9),
('Eliza', 'Orzeszkowa', 'Nad Niemnem', 9),
('Joseph', 'Conrad', 'Jądro ciemności', 9);

-- Lektury dla klasy 10 (2 szkoły średniej)
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Adam', 'Mickiewicz', 'Pan Tadeusz', 10),
('Juliusz', 'Słowacki', 'Kordian', 10),
('Henryk', 'Sienkiewicz', 'Quo Vadis', 10),
('Stanisław', 'Wyspiański', 'Wesele', 10),
('Franz', 'Kafka', 'Proces', 10);

-- Lektury dla klasy 11 (3 szkoły średniej)
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Fiodor', 'Dostojewski', 'Zbrodnia i kara', 11),
('Albert', 'Camus', 'Dżuma', 11),
('George', 'Orwell', 'Rok 1984', 11),
('Zofia', 'Nałkowska', 'Medaliony', 11),
('Gustaw', 'Herling-Grudziński', 'Inny świat', 11);

-- Lektury dla klasy 12 (4 szkoły średniej)
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Tadeusz', 'Borowski', 'Proszę państwa do gazu', 12),
('Hanna', 'Krall', 'Zdążyć przed Panem Bogiem', 12),
('Miron', 'Białoszewski', 'Pamiętnik z powstania warszawskiego', 12),
('Wisława', 'Szymborska', 'Wybór wierszy', 12),
('Czesław', 'Miłosz', 'Zniewolony umysł', 12);

-- Lektury dla klasy 13 (5 szkoły średniej)
INSERT INTO dane_ksiazek (autor_imie, autor_nazwisko, tytul, klasa) VALUES
('Gabriel', 'Garcia Marquez', 'Sto lat samotności', 13),
('Umberto', 'Eco', 'Imię róży', 13),
('Milan', 'Kundera', 'Nieznośna lekkość bytu', 13),
('Olga', 'Tokarczuk', 'Prawiek i inne czasy', 13),
('Ryszard', 'Kapuściński', 'Cesarz', 13);