CREATE TABLE biblioteczka (
  id INT AUTO_INCREMENT PRIMARY KEY,
  okładka VARCHAR(50),
  tytuł VARCHAR(50),
  autor VARCHAR(50),
  krótki_opis TEXT,
  streszczenie TEXT
);


INSERT INTO biblioteczka (okładka, tytuł, autor, krótki_opis, streszczenie) VALUES
('./biblioteka/HP.jpg', 'Harry Potter i Kamień Filozoficzny', 'J.K. Rowling', 'Młody Harry Potter dowiaduje się, że jest czarodziejem i rozpoczyna naukę w Hogwarcie.', 'Pierwsza część sagi o Harrym Potterze, opowiadająca o jego odkryciu magicznych zdolności, przyjaźni z Ronem i Hermioną oraz walce z Lordem Voldemortem.'),
('./biblioteka/LOTR.jpg', 'Władca Pierścieni: Drużyna Pierścienia', 'J.R.R. Tolkien', 'Frodo Baggins dziedziczy Pierścień Władzy i musi go zniszczyć, aby zapobiec panowaniu Saurona.', 'Pierwsza część epickiej sagi fantasy o Władcy Pierścieni, opowiadająca o podróży Froda i jego towarzyszy, aby zniszczyć Pierścień Władzy.'),
('./biblioteka/1984.jpg', 'Rok 1984', 'George Orwell', 'W totalitarnym państwie Oceania Winston Smith buntuje się przeciwko systemowi.', 'Dystopijna powieść o totalitarnym państwie, w którym rząd kontroluje wszystkie aspekty życia.'),
('./biblioteka/PD.jpg', 'Przeminęło z wiatrem', 'Margaret Mitchell', 'Historia miłości Scarlett O\'Hary i Rhett Butlera w czasie wojny secesyjnej.', 'Epicka powieść historyczna o miłości, wojnie i życiu na Południu w czasie wojny secesyjnej.'),
('./biblioteka/AL.jpg', 'Alicja w Krainie Czarów', 'Lewis Carroll', 'Młoda Alicja wpada do dziury króliczej i trafia do fantastycznej krainy.', 'Klasyczna powieść dla dzieci o przygodach Alicji w magicznej krainie.'),
('./biblioteka/Z.jpg', 'Zwierzęta z farmy', 'George Orwell', 'Zwierzęta na farmie obalają człowieka i tworzą własne społeczeństwo.', 'Satyryczna powieść o rewolucji i władzy, przedstawiona w alegorycznej formie historii zwierząt.'),
('./biblioteka/D.jpg', 'Duma i uprzedzenie', 'Jane Austen', 'Historia miłości Elizabeth Bennet i pana Darcy.', 'Klasyczna powieść romantyczna o miłości, społeczeństwie i uprzedzeniach.');


INSERT INTO biblioteczka (okładka, tytuł, autor, krótki_opis, streszczenie) VALUES
('./biblioteka/MS.jpg', 'Mistrz i Małgorzata', 'Michaił Bułhakow', 'Diabeł odwiedza Moskwę i wywraca miasto do góry nogami.', 'Powieść łącząca satyrę, realizm magiczny i filozofię, ukazująca walkę dobra ze złem.'),
('./biblioteka/BB.jpg', 'Bracia Karamazow', 'Fiodor Dostojewski', 'Historia trzech braci o różnych osobowościach i ich konfliktu z ojcem.', 'Głęboka powieść filozoficzna o wierze, moralności i rodzinnych relacjach.'),
('./biblioteka/SH.jpg', 'Sherlock Holmes: Studium w szkarłacie', 'Arthur Conan Doyle', 'Detektyw Sherlock Holmes rozwiązuje tajemniczą zbrodnię w Londynie.', 'Pierwsza powieść o Sherlocku Holmesie, w której poznajemy jego niezwykłe metody dedukcji.'),
('./biblioteka/PP.jpg', 'Proces', 'Franz Kafka', 'Josef K. zostaje aresztowany, ale nie wie, za co.', 'Powieść o absurdzie biurokracji i poczuciu winy w świecie bez wyjaśnień.'),
('./biblioteka/WT.jpg', 'Wojna i pokój', 'Lew Tołstoj', 'Epopeja historyczna o wojnach napoleońskich i losach rosyjskiej arystokracji.', 'Jedna z najważniejszych powieści wszech czasów, łącząca fikcję z historią.'),
('./biblioteka/HG.jpg', 'Igrzyska śmierci', 'Suzanne Collins', 'Katniss Everdeen bierze udział w brutalnej grze o przetrwanie.', 'Dystopijna powieść o totalitarnym państwie zmuszającym młodych ludzi do walki na śmierć i życie.'),
('./biblioteka/DC.jpg', 'Don Kichot', 'Miguel de Cervantes', 'Szlachcic z La Manchy postanawia zostać wędrownym rycerzem.', 'Satyrystyczna powieść o iluzji, marzeniach i starciu z rzeczywistością.'),
('./biblioteka/RJ.jpg', 'Romeo i Julia', 'William Shakespeare', 'Tragiczna miłość dwojga młodych kochanków z wrogich rodów.', 'Jedna z najsłynniejszych tragedii o miłości, nienawiści i przeznaczeniu.');



CREATE TABLE wydarzenia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tytul VARCHAR(255) NOT NULL,
    opis TEXT NOT NULL,
    data DATE NOT NULL,
    zdjecie VARCHAR(255) NOT NULL
);

ALTER TABLE wydarzenia ADD COLUMN reakcje TEXT DEFAULT '{}';

INSERT INTO wydarzenia (tytul, opis, data, zdjecie) VALUES
('Spotkanie autorskie', 'Zapraszamy na spotkanie z popularnym autorem, który opowie o swojej najnowszej książce.', '2024-04-10', './eventy/spotkanie_autorskie.jpg'),
('Warsztaty dla dzieci', 'Zabawa i nauka w jednym! Zapraszamy wszystkie dzieci na kreatywne warsztaty.', '2024-04-15', './eventy/warsztaty_dzieci.jpg'),
('Klub czytelnika', 'Dyskusja na temat klasycznych dzieł literatury. Dołącz do naszej społeczności miłośników książek!', '2024-04-20', './eventy/klub_czytelnika.jpg'),
('Wieczór poezji', 'Romantyczna atmosfera i piękne wiersze czytane przez aktorów.', '2024-04-25', './eventy/wieczor_poezji.jpg'),
('Giełda książek', 'Masz książki, których już nie czytasz? Wymień je na inne w naszej bibliotece!', '2024-04-30', './eventy/gielda_ksiazek.jpg');
























CREATE TABLE IF NOT EXISTS rere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    zdjecie VARCHAR(255) NOT NULL,
    tytul VARCHAR(255) NOT NULL,
    data DATE NOT NULL,
    opis TEXT NOT NULL,
    likes INT DEFAULT 0,
    hearts INT DEFAULT 0,
    claps INT DEFAULT 0
);



INSERT INTO rere (zdjecie, tytul, data, opis) VALUES
('./eventy/gielda_ksiazek.jpg', 'Spotkanie autorskie', '2025-04-10', 'Spotkanie z autorem bestsellerów.'),
('./eventy/spotkanie_autorskie.jpg', 'Warsztaty literackie', '2025-05-15', 'Praktyczne warsztaty dla młodych pisarzy.');



