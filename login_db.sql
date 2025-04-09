-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 01:30 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `biblioteczka`
--

CREATE TABLE `biblioteczka` (
  `id` int(11) NOT NULL,
  `okładka` varchar(50) DEFAULT NULL,
  `tytuł` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `krótki_opis` text DEFAULT NULL,
  `streszczenie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biblioteczka`
--

INSERT INTO `biblioteczka` (`id`, `okładka`, `tytuł`, `autor`, `krótki_opis`, `streszczenie`) VALUES
(1, './biblioteka/HP.jpg', 'Harry Potter i Kamień Filozoficzny', 'J.K. Rowling', 'Młody Harry Potter dowiaduje się, że jest czarodziejem i rozpoczyna naukę w Hogwarcie.', 'Pierwsza część sagi o Harrym Potterze, opowiadająca o jego odkryciu magicznych zdolności, przyjaźni z Ronem i Hermioną oraz walce z Lordem Voldemortem.'),
(2, './biblioteka/LOTR.jpg', 'Władca Pierścieni: Drużyna Pierścienia', 'J.R.R. Tolkien', 'Frodo Baggins dziedziczy Pierścień Władzy i musi go zniszczyć, aby zapobiec panowaniu Saurona.', 'Pierwsza część epickiej sagi fantasy o Władcy Pierścieni, opowiadająca o podróży Froda i jego towarzyszy, aby zniszczyć Pierścień Władzy.'),
(3, './biblioteka/1984.jpg', 'Rok 1984', 'George Orwell', 'W totalitarnym państwie Oceania Winston Smith buntuje się przeciwko systemowi.', 'Dystopijna powieść o totalitarnym państwie, w którym rząd kontroluje wszystkie aspekty życia.'),
(4, './biblioteka/PD.jpg', 'Przeminęło z wiatrem', 'Margaret Mitchell', 'Historia miłości Scarlett O\'Hary i Rhett Butlera w czasie wojny secesyjnej.', 'Epicka powieść historyczna o miłości, wojnie i życiu na Południu w czasie wojny secesyjnej.'),
(5, './biblioteka/AL.jpg', 'Alicja w Krainie Czarów', 'Lewis Carroll', 'Młoda Alicja wpada do dziury króliczej i trafia do fantastycznej krainy.', 'Klasyczna powieść dla dzieci o przygodach Alicji w magicznej krainie.'),
(6, './biblioteka/Z.jpg', 'Zwierzęta z farmy', 'George Orwell', 'Zwierzęta na farmie obalają człowieka i tworzą własne społeczeństwo.', 'Satyryczna powieść o rewolucji i władzy, przedstawiona w alegorycznej formie historii zwierząt.'),
(7, './biblioteka/D.jpg', 'Duma i uprzedzenie', 'Jane Austen', 'Historia miłości Elizabeth Bennet i pana Darcy.', 'Klasyczna powieść romantyczna o miłości, społeczeństwie i uprzedzeniach.'),
(8, './biblioteka/MS.jpg', 'Mistrz i Małgorzata', 'Michaił Bułhakow', 'Diabeł odwiedza Moskwę i wywraca miasto do góry nogami.', 'Powieść łącząca satyrę, realizm magiczny i filozofię, ukazująca walkę dobra ze złem.'),
(9, './biblioteka/BB.jpg', 'Bracia Karamazow', 'Fiodor Dostojewski', 'Historia trzech braci o różnych osobowościach i ich konfliktu z ojcem.', 'Głęboka powieść filozoficzna o wierze, moralności i rodzinnych relacjach.'),
(10, './biblioteka/SH.jpg', 'Sherlock Holmes: Studium w szkarłacie', 'Arthur Conan Doyle', 'Detektyw Sherlock Holmes rozwiązuje tajemniczą zbrodnię w Londynie.', 'Pierwsza powieść o Sherlocku Holmesie, w której poznajemy jego niezwykłe metody dedukcji.'),
(11, './biblioteka/PP.jpg', 'Proces', 'Franz Kafka', 'Josef K. zostaje aresztowany, ale nie wie, za co.', 'Powieść o absurdzie biurokracji i poczuciu winy w świecie bez wyjaśnień.'),
(12, './biblioteka/WT.jpg', 'Wojna i pokój', 'Lew Tołstoj', 'Epopeja historyczna o wojnach napoleońskich i losach rosyjskiej arystokracji.', 'Jedna z najważniejszych powieści wszech czasów, łącząca fikcję z historią.'),
(13, './biblioteka/HG.jpg', 'Igrzyska śmierci', 'Suzanne Collins', 'Katniss Everdeen bierze udział w brutalnej grze o przetrwanie.', 'Dystopijna powieść o totalitarnym państwie zmuszającym młodych ludzi do walki na śmierć i życie.'),
(14, './biblioteka/DC.jpg', 'Don Kichot', 'Miguel de Cervantes', 'Szlachcic z La Manchy postanawia zostać wędrownym rycerzem.', 'Satyrystyczna powieść o iluzji, marzeniach i starciu z rzeczywistością.'),
(15, './biblioteka/RJ.jpg', 'Romeo i Julia', 'William Shakespeare', 'Tragiczna miłość dwojga młodych kochanków z wrogich rodów.', 'Jedna z najsłynniejszych tragedii o miłości, nienawiści i przeznaczeniu.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `genre`, `quantity`, `created_at`) VALUES
(1, 'Wiedźmin: Ostatnie życzenie', 'Andrzej Sapkowski', 1993, 'Fantasy', 5, '2025-02-26 21:58:03'),
(2, 'Hobbit', 'J.R.R. Tolkien', 1937, 'Fantasy', 3, '2025-02-26 21:58:03'),
(3, 'Metro 2033', 'Dmitry Glukhovsky', 2005, 'Sci-Fi', 4, '2025-02-26 21:58:03'),
(4, 'Dziady', 'Adam Mickiewicz', 1823, 'Dramat', 2, '2025-02-26 21:58:03'),
(5, 'Pan Tadeusz', 'Adam Mickiewicz', 1834, 'Epopeja', 3, '2025-02-26 21:58:03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `user_id`, `book_id`, `borrow_date`, `due_date`, `status`) VALUES
(1, 57, 4, '2025-02-14', '2025-03-13', 1),
(2, 57, 3, '2025-02-10', '2025-03-14', 2),
(3, 71, 5, '2025-02-12', '2025-03-03', 3),
(4, 58, 2, '2025-01-31', '2025-03-28', 4),
(5, 59, 2, '2025-02-22', '2025-03-28', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_ksiazek`
--

CREATE TABLE `dane_ksiazek` (
  `id` int(11) NOT NULL,
  `autor_imie` char(50) NOT NULL,
  `autor_nazwisko` char(100) NOT NULL,
  `tytul` varchar(100) NOT NULL,
  `klasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dane_ksiazek`
--

INSERT INTO `dane_ksiazek` (`id`, `autor_imie`, `autor_nazwisko`, `tytul`, `klasa`) VALUES
(1, 'Julian', 'Tuwim', 'Lokomotywa', 1),
(2, 'Jan', 'Brzechwa', 'Kaczka Dziwaczka', 1),
(3, 'Czesław', 'Janczarski', 'Jak Wojtek został strażakiem', 1),
(4, 'Maria', 'Konopnicka', 'Stefek Burczymucha', 1),
(5, 'Jan', 'Brzechwa', 'Na straganie', 1),
(6, 'Jan', 'Brzechwa', 'Akademia Pana Kleksa', 2),
(7, 'Astrid', 'Lindgren', 'Dzieci z Bullerbyn', 2),
(8, 'Wanda', 'Chotomska', 'Dwa Michały', 2),
(9, 'Grzegorz', 'Kasdepke', 'Detektyw Pozytywka', 2),
(10, 'Maria', 'Konopnicka', 'O krasnoludkach i sierotce Marysi', 2),
(11, 'Hugh', 'Lofting', 'Doktor Dolittle i jego zwierzęta', 3),
(12, 'Renata', 'Piątkowska', 'Na wszystko jest sposób', 3),
(13, 'Julian', 'Tuwim', 'Ptasie radio', 3),
(14, 'Jan', 'Brzechwa', 'Samochwała', 3),
(15, 'Wanda', 'Chotomska', 'Kurczę blade', 3),
(16, 'Henryk', 'Sienkiewicz', 'W pustyni i w puszczy', 4),
(17, 'Adam', 'Mickiewicz', 'Pan Tadeusz (fragmenty)', 4),
(18, 'Lucy', 'Maud Montgomery', 'Ania z Zielonego Wzgórza', 4),
(19, 'Mark', 'Twain', 'Przygody Tomka Sawyera', 4),
(20, 'Kornel', 'Makuszyński', 'Szatan z siódmej klasy', 4),
(21, 'Bolesław', 'Prus', 'Katarynka', 5),
(22, 'Stefan', 'Żeromski', 'Syzyfowe prace', 5),
(23, 'Juliusz', 'Słowacki', 'Balladyna', 5),
(24, 'Ignacy', 'Krasicki', 'Żona modna', 5),
(25, 'Aleksander', 'Fredro', 'Zemsta', 5),
(26, 'Henryk', 'Sienkiewicz', 'Latarnik', 6),
(27, 'Lucy', 'Maud Montgomery', 'Ania z Avonlea', 6),
(28, 'Jules', 'Verne', 'W 80 dni dookoła świata', 6),
(29, 'John', 'Tolkien', 'Hobbit, czyli tam i z powrotem', 6),
(30, 'Edmund', 'Niziurski', 'Sposób na Alcybiadesa', 6),
(31, 'Adam', 'Mickiewicz', 'Reduta Ordona', 7),
(32, 'Aleksander', 'Fredro', 'Zemsta', 7),
(33, 'Juliusz', 'Verne', 'Podróż do wnętrza Ziemi', 7),
(34, 'Homer', '', 'Odyseja (fragmenty)', 7),
(35, 'Lucy', 'Maud Montgomery', 'Ania na uniwersytecie', 7),
(36, 'Henryk', 'Sienkiewicz', 'Krzyżacy', 8),
(37, 'Juliusz', 'Słowacki', 'Balladyna', 8),
(38, 'Stefan', 'Żeromski', 'Syzyfowe prace', 8),
(39, 'George', 'Orwell', 'Folwark zwierzęcy', 8),
(40, 'Fiodor', 'Dostojewski', 'Zbrodnia i kara (fragmenty)', 8),
(41, 'Adam', 'Mickiewicz', 'Dziady cz. II', 9),
(42, 'William', 'Shakespeare', 'Makbet', 9),
(43, 'Bolesław', 'Prus', 'Lalka', 9),
(44, 'Eliza', 'Orzeszkowa', 'Nad Niemnem', 9),
(45, 'Joseph', 'Conrad', 'Jądro ciemności', 9),
(46, 'Adam', 'Mickiewicz', 'Pan Tadeusz', 10),
(47, 'Juliusz', 'Słowacki', 'Kordian', 10),
(48, 'Henryk', 'Sienkiewicz', 'Quo Vadis', 10),
(49, 'Stanisław', 'Wyspiański', 'Wesele', 10),
(50, 'Franz', 'Kafka', 'Proces', 10),
(51, 'Fiodor', 'Dostojewski', 'Zbrodnia i kara', 11),
(52, 'Albert', 'Camus', 'Dżuma', 11),
(53, 'George', 'Orwell', 'Rok 1984', 11),
(54, 'Zofia', 'Nałkowska', 'Medaliony', 11),
(55, 'Gustaw', 'Herling-Grudziński', 'Inny świat', 11),
(56, 'Tadeusz', 'Borowski', 'Proszę państwa do gazu', 12),
(57, 'Hanna', 'Krall', 'Zdążyć przed Panem Bogiem', 12),
(58, 'Miron', 'Białoszewski', 'Pamiętnik z powstania warszawskiego', 12),
(59, 'Wisława', 'Szymborska', 'Wybór wierszy', 12),
(60, 'Czesław', 'Miłosz', 'Zniewolony umysł', 12),
(61, 'Gabriel', 'Garcia Marquez', 'Sto lat samotności', 13),
(62, 'Umberto', 'Eco', 'Imię róży', 13),
(63, 'Milan', 'Kundera', 'Nieznośna lekkość bytu', 13),
(64, 'Olga', 'Tokarczuk', 'Prawiek i inne czasy', 13),
(65, 'Ryszard', 'Kapuściński', 'Cesarz', 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message_body` text NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `message_body`, `date_sent`, `read_at`, `subject`) VALUES
(5, 57, 43, 'co gówno', '2025-04-02 19:59:25', NULL, 'ej'),
(6, 43, 57, 'nigger', '2025-04-02 20:01:25', NULL, 'ej '),
(7, 43, 82, 'no', '2025-04-02 21:28:01', NULL, 'ej'),
(8, 43, 74, 'wiem', '2025-04-02 21:28:21', NULL, 'wiesz co ?');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pending_users`
--

CREATE TABLE `pending_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `message_color` varchar(7) DEFAULT '#000000',
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_users`
--

INSERT INTO `pending_users` (`id`, `username`, `email`, `password`, `role`, `status`, `message_color`, `date_submitted`) VALUES
(2, 'biblioo', 'biblioo@gmail.com', '$2y$10$EXHfhhBpbUIMRJxjdgSd.uCbIXzby3lJhqbs4iegF6OYWoqr5pof6', 1, 'rejected', '#d4735e', '2025-02-15 16:19:18'),
(3, 'bibliotekarzrz', 'bibliotekarzrz@gmail.com', '$2y$10$SX7OevMQSv0h8GB0vKhkWuyEVq785lmN.Ss7QH232hnwE1I3OAqmK', 1, 'rejected', '#4e0740', '2025-02-16 16:24:54'),
(10, 'przykład44', 'przykład444@gmail.com', '$2y$10$RcsV5LqsWNFfThrjhAaxD.eYBRf7BC/lLDNbt4iHzXgaGRHvoohTi', 1, 'pending', '#4a44dc', '2025-02-18 16:32:32'),
(11, 'przykład55', 'przyukąłsd', '$2y$10$b0tta7c.VK3FSqUS6LQi6.8KzsSfOc3PbC.Ll0.r21hNie/dlPQma', 1, 'pending', '#4fc82b', '2025-02-18 16:51:17'),
(12, 'przykład66', 'wfwa', '$2y$10$iV7yTJ.fVkc.ytOE04E8TeWVcXtGQ9C6xTJO9oD8eV82c9XfOGop.', 1, 'pending', '#6b51d4', '2025-02-18 16:51:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rere`
--

CREATE TABLE `rere` (
  `id` int(11) NOT NULL,
  `zdjecie` varchar(255) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `opis` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `hearts` int(11) DEFAULT 0,
  `claps` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rere`
--

INSERT INTO `rere` (`id`, `zdjecie`, `tytul`, `data`, `opis`, `likes`, `hearts`, `claps`) VALUES
(1, './eventy/gielda_ksiazek.jpg', 'Spotkanie autorskie', '2025-04-10', 'Spotkanie z autorem bestsellerów.', 0, 0, 0),
(2, './eventy/spotkanie_autorskie.jpg', 'Warsztaty literackie', '2025-05-15', 'Praktyczne warsztaty dla młodych pisarzy.', 0, 0, 0),
(3, './eventy/gielda_ksiazek.jpg', 'Spotkanie autorskie', '2025-04-10', 'Spotkanie z autorem bestsellerów.', 0, 0, 0),
(4, './eventy/spotkanie_autorskie.jpg', 'Warsztaty literackie', '2025-05-15', 'Praktyczne warsztaty dla młodych pisarzy.', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `message_color` varchar(254) DEFAULT '#000000',
  `role` int(11) DEFAULT 0,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `message_color`, `role`, `date_registered`, `profile_image`) VALUES
(43, 'admin@admin.com', 'admin', '$2y$10$2HYivHXJWzQMRduo/wb93Ojz6ku9RMy8p2gGis/n8RMlo9KCW95qe', '#44cb73', 2, '2025-02-15 16:10:29', 'default.jpg'),
(57, 'bilblio@gmail.com', 'biblio', '$2y$10$HurPhKNM4/OuOVD4JFHETOkGT9VnBpRL/gBIexwdtKw746TZn5R4q', '#000000', 1, '2025-02-15 16:17:50', 'default.jpg'),
(58, 'czytelnik.czytelnik@gmail.com', 'czytelnik2', '$2y$10$I53BDAQ9U2tTABNrTV1SEOnaHhYVXqY1w9fDhrbEiXQBG9FwBpNYC', '#6208ef', 0, '2025-02-15 16:32:00', 'default.jpg'),
(59, 'john123@example.com', 'John123', '$2y$10$wQw2AcVt5Y0MnP9GqEqREoTAgf6S18mFxPpRA3jLkIzgFip9MycU2', '#000000', 1, '2025-02-15 11:00:00', 'default.jpg'),
(60, 'jane456@example.com', 'Jane456', '$2y$10$JtZ2WkLr1H9zQhZhAY3K6iJZ54hvsyLvVEZG/2Xa3v9CJyMG9t8pG', '#000000', 0, '2025-02-15 11:01:00', 'default.jpg'),
(61, 'alice789@example.com', 'Alice789', '$2y$10$htnk8g4v9l6wwb5mA3NEnxDKF8K4k6Bd03zLl0gHs0JkYt.Kop8qg', '#000000', 2, '2025-02-15 11:02:00', 'default.jpg'),
(62, 'bob321@example.com', 'Bob321', '$2y$10$FQwYxDrI8RMwYdtLfNi8fUwT28OkimLx5d8A7Hw.gQ2klwZyqblW3', '#000000', 1, '2025-02-15 11:03:00', 'default.jpg'),
(63, 'charlie654@example.com', 'Charlie654', '$2y$10$8Gq0s8gPHiZc.VGhQyIWdxIA5f5vXO8TSfnJqFTYp0ioW5tZT8zXq', '#000000', 0, '2025-02-15 11:04:00', 'default.jpg'),
(64, 'david987@example.com', 'David987', '$2y$10$Fh5qu4ZgEJ96jZw6jr8nNUj4TkhlMRm5cWL1ETeq9lzHbhFplEovO', '#000000', 2, '2025-02-15 11:05:00', 'default.jpg'),
(65, 'eve543@example.com', 'Eve543', '$2y$10$0Ht55KOH7AqkSfFqF3lCVLOE5grWgF1HzgR3Op79Wy1QGm1YPf0nK', '#000000', 0, '2025-02-15 11:06:00', 'default.jpg'),
(66, 'grace876@example.com', 'Grace876', '$2y$10$YjZbD4mldxFhdfISW8E.hoXtCOcf2VvAQt2BYE1B2VxjGRmFhmuua', '#000000', 1, '2025-02-15 11:07:00', 'default.jpg'),
(67, 'heidi345@example.com', 'Heidi345', '$2y$10$uYk3TmKk8fIzwQxg.9H1PBVqTj99aRHtiBYyTW7l.RjeHvfpRgS1G', '#000000', 2, '2025-02-15 11:08:00', 'default.jpg'),
(68, 'ivy210@example.com', 'Ivy210', '$2y$10$AKPBG89lrO4odXkw4BbeFkRaDe9nYreRATzZn5Mjgh5FkDZfpYrC9', '#000000', 0, '2025-02-15 11:09:00', 'default.jpg'),
(69, 'jack543@example.com', 'Jack543', '$2y$10$ty7C0nFtXix47dTfG.Rkw1qewF5/0E.oFZSKPj8DAACuqvC0BXQ3C', '#000000', 1, '2025-02-15 11:10:00', 'default.jpg'),
(71, 'louis432@example.com', 'Louis432', '$2y$10$y2YbqE7VuzhbIZ2E6jQj7X9mfjmVLz9u.ZsQSzE3XzE.60oz6CzYK', '#000000', 2, '2025-02-15 11:12:00', 'default.jpg'),
(72, 'megan321@example.com', 'Megan321', '$2y$10$wsHmAUGYwMBi5LP6j1bCPVu8o5TQ0dTpZ8c3gIcGZCy5FScUN1vuO', '#000000', 1, '2025-02-15 11:13:00', 'default.jpg'),
(74, 'nowy@gmail.com', 'nowynowy', '$2y$10$nFK/r.WgkMXTyTcUE11Oj.gJlNocWDM2tjV4.s8SvXcVHOupfT1p2', '#eb624d', 0, '2025-02-15 17:48:14', '6bdf09f8cba3c1e1ea3e68c6150bd713.jpg'),
(75, 'bibliotekarzrzz@gmail.com', 'bibliotekarzrzz', '$2y$10$AzrsmD22onSFkDdkOek94OfyIndV/..aUdJTJHqxsLZte5cIq6woi', '#000000', 1, '2025-02-16 16:25:50', 'default.jpg'),
(76, '1111111@gmail.com', '1111', '$2y$10$WOFc.qDWuuSXsC.pVZmGZedfMKdCj6Fy9EYJA8myRW5C/p5.r7r8i', '#000000', 1, '2025-02-17 17:31:16', 'default.jpg'),
(78, 'czytelnik12@gmail.com', 'czytelnik12', '$2y$10$cSIDa8Q3z/76/MagRQNOXuwNhTUJw103gCWEn.nW5gNCehfsdQme.', '#349c41', 0, '2025-02-17 17:53:15', 'default.jpg'),
(79, 'czytelnik88@gmail.com', 'czytelnik88', '$2y$10$rVh9WiN8AhfzQjWRJQ1IQ.UVC34./TmdP0TTn2uX7pj0hWNiDxHnO', '#98a3ab', 0, '2025-02-17 18:20:05', 'd3e3c9ab6dbf1b2d1b33a2bcdfa1062d.jpg'),
(80, 'oli@niigger.com', 'oli123', '$2y$10$7wXUVdakL95EYZ/D5xkk5.afBGi/1QuBeBogNYqSMCbuu1HQgHwaW', '#48449a', 0, '2025-02-17 18:49:37', '5295bae7718bb0ddfe8c1ba446a908e8.jpg'),
(81, '2222@gmail.com', '2222', '$2y$10$4MMIXHNG.aduJGVfVU8L2.KvhBoVu4iBFAoEXgb3LoIuBhk7SYUjm', '#5316ca', 0, '2025-02-17 18:53:24', 'default.jpg'),
(82, '1212@gmail.com', '121234', '$2y$10$3hm1.TOlw0eficFhybBRjeqxBr5O6/jHfiqTGwSsGdhN0ydV10I2a', '#a46e37', 1, '2025-02-17 18:54:20', 'c90e6945a097553cb4e5e1788266a0fe.jpg'),
(83, 'przykład333@gmial.com', 'przykład33', '$2y$10$pcXjsvYAjbwnhWKtzk1dMOC3OiL5Obb1MMpYarACiGoi5X3nBZAUm', '#000000', 1, '2025-02-18 16:48:06', 'default.jpg'),
(84, 'niger111@gmail.com', 'czarny', '$2y$10$EOdB.g7B7vgNy2xTvYtWxuN8IpfxX55ocCzmf/JoSLC.enkbRcSaa', '#000000', 1, '2025-02-18 16:49:05', 'default.jpg'),
(85, 'przyklad222@gmail.com', 'przykład22', '$2y$10$7XRQGVPZTQf2XKtVE2.JWOIka8kAtAY40paOsIeW9sU8VBQfVkSve', '#000000', 1, '2025-02-18 16:51:37', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_date` date NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_count` int(11) DEFAULT 0,
  `activity_description` text NOT NULL DEFAULT 'Login'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `activity_date`, `login_time`, `login_count`, `activity_description`) VALUES
(19, 43, '2025-02-11', '2025-02-11 21:46:42', 1, 'Login'),
(20, 43, '2025-02-15', '2025-02-15 16:10:51', 6, 'Login'),
(21, 57, '2025-02-15', '2025-02-15 16:18:47', 1, 'Login'),
(22, 58, '2025-02-15', '2025-02-15 16:39:22', 1, 'Login'),
(23, 74, '2025-02-15', '2025-02-15 17:48:32', 2, 'Login'),
(24, 43, '2025-02-16', '2025-02-16 12:32:57', 1, 'Login'),
(25, 74, '2025-02-16', '2025-02-16 12:33:39', 3, 'Login'),
(26, 75, '2025-02-16', '2025-02-16 16:26:01', 1, 'Login'),
(27, 43, '2025-02-17', '2025-02-17 17:27:33', 1, 'Login'),
(28, 77, '2025-02-17', '2025-02-17 17:33:34', 2, 'Login'),
(29, 78, '2025-02-17', '2025-02-17 17:53:20', 2, 'Login'),
(30, 74, '2025-02-17', '2025-02-17 18:04:36', 2, 'Login'),
(31, 79, '2025-02-17', '2025-02-17 18:20:23', 1, 'Login'),
(32, 80, '2025-02-17', '2025-02-17 18:49:43', 1, 'Login'),
(33, 81, '2025-02-17', '2025-02-17 18:53:31', 1, 'Login'),
(34, 82, '2025-02-17', '2025-02-17 18:54:25', 1, 'Login'),
(35, 43, '2025-02-18', '2025-02-18 15:54:12', 2, 'Login'),
(36, 80, '2025-02-18', '2025-02-18 15:54:39', 4, 'Login'),
(37, 84, '2025-02-18', '2025-02-18 16:58:55', 1, 'Login'),
(38, 43, '2025-02-26', '2025-02-26 22:01:05', 1, 'Login'),
(39, 85, '2025-02-26', '2025-02-26 22:01:37', 2, 'Login'),
(40, 43, '2025-03-12', '2025-03-12 18:32:12', 4, 'Login'),
(41, 81, '2025-03-12', '2025-03-12 18:35:06', 2, 'Login'),
(42, 84, '2025-03-12', '2025-03-12 18:49:22', 1, 'Login'),
(43, 57, '2025-03-12', '2025-03-12 19:04:50', 1, 'Login'),
(44, 57, '2025-03-19', '2025-03-19 21:44:46', 1, 'Login'),
(45, 57, '2025-03-25', '2025-03-25 11:47:37', 4, 'Login'),
(46, 43, '2025-03-25', '2025-03-25 12:04:08', 3, 'Login'),
(47, 74, '2025-03-25', '2025-03-25 14:19:57', 1, 'Login'),
(48, 43, '2025-04-02', '2025-04-02 18:56:42', 6, 'Login'),
(49, 57, '2025-04-02', '2025-04-02 19:55:25', 3, 'Login'),
(50, 74, '2025-04-02', '2025-04-02 21:28:55', 1, 'Login'),
(51, 74, '2025-04-03', '2025-04-02 22:09:43', 2, 'Login'),
(52, 74, '2025-04-09', '2025-04-09 14:30:28', 1, 'Login');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydarzenia`
--

CREATE TABLE `wydarzenia` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `data` date NOT NULL,
  `zdjecie` varchar(255) NOT NULL,
  `reakcje` text DEFAULT '{}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wydarzenia`
--

INSERT INTO `wydarzenia` (`id`, `tytul`, `opis`, `data`, `zdjecie`, `reakcje`) VALUES
(1, 'Spotkanie autorskie', 'Zapraszamy na spotkanie z popularnym autorem, który opowie o swojej najnowszej książce.', '2024-04-10', './eventy/spotkanie_autorskie.jpg', '{}'),
(2, 'Warsztaty dla dzieci', 'Zabawa i nauka w jednym! Zapraszamy wszystkie dzieci na kreatywne warsztaty.', '2024-04-15', './eventy/warsztaty_dzieci.jpg', '{}'),
(3, 'Klub czytelnika', 'Dyskusja na temat klasycznych dzieł literatury. Dołącz do naszej społeczności miłośników książek!', '2024-04-20', './eventy/klub_czytelnika.jpg', '{}'),
(4, 'Wieczór poezji', 'Romantyczna atmosfera i piękne wiersze czytane przez aktorów.', '2024-04-25', './eventy/wieczor_poezji.jpg', '{}'),
(5, 'Giełda książek', 'Masz książki, których już nie czytasz? Wymień je na inne w naszej bibliotece!', '2024-04-30', './eventy/gielda_ksiazek.jpg', '{}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `biblioteczka_id` int(11) DEFAULT NULL,
  `data_wypozyczenia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id`, `user_id`, `biblioteczka_id`, `data_wypozyczenia`) VALUES
(6, 74, 1, '2025-04-10 00:17:07'),
(11, 74, 11, '2025-04-10 00:26:25');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `biblioteczka`
--
ALTER TABLE `biblioteczka`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indeksy dla tabeli `dane_ksiazek`
--
ALTER TABLE `dane_ksiazek`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indeksy dla tabeli `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `rere`
--
ALTER TABLE `rere`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`activity_date`);

--
-- Indeksy dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biblioteczka_id` (`biblioteczka_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biblioteczka`
--
ALTER TABLE `biblioteczka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dane_ksiazek`
--
ALTER TABLE `dane_ksiazek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rere`
--
ALTER TABLE `rere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `wydarzenia`
--
ALTER TABLE `wydarzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`biblioteczka_id`) REFERENCES `biblioteczka` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
