-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 02:01 PM
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
-- Struktura tabeli dla tabeli `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `user_id`, `title`, `author`, `borrow_date`, `due_date`, `status`) VALUES
(1, 3, 'nvm', 'sigma', '0000-00-00', '0000-00-00', 'returned');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(250) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'biblioo', 'biblioo@gmail.com', '$2y$10$EXHfhhBpbUIMRJxjdgSd.uCbIXzby3lJhqbs4iegF6OYWoqr5pof6', 1, 'rejected', '#d4735e', '2025-02-15 16:19:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `message_color` varchar(7) DEFAULT '#000000',
  `role` int(11) DEFAULT 0,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `message_color`, `role`, `date_registered`, `profile_image`) VALUES
(43, 'admin@admin.com', 'admin', '$2y$10$2HYivHXJWzQMRduo/wb93Ojz6ku9RMy8p2gGis/n8RMlo9KCW95qe', '#44cb73', 2, '2025-02-15 16:10:29', NULL),
(57, 'bilblio@gmail.com', 'biblio', '$2y$10$HurPhKNM4/OuOVD4JFHETOkGT9VnBpRL/gBIexwdtKw746TZn5R4q', '#000000', 1, '2025-02-15 16:17:50', NULL),
(58, 'czytelnik.czytelnik@gmail.com', 'czytelnik2', '$2y$10$I53BDAQ9U2tTABNrTV1SEOnaHhYVXqY1w9fDhrbEiXQBG9FwBpNYC', '#6208ef', 0, '2025-02-15 16:32:00', NULL),
(59, 'john123@example.com', 'John123', '$2y$10$wQw2AcVt5Y0MnP9GqEqREoTAgf6S18mFxPpRA3jLkIzgFip9MycU2', '#000000', 1, '2025-02-15 11:00:00', NULL),
(60, 'jane456@example.com', 'Jane456', '$2y$10$JtZ2WkLr1H9zQhZhAY3K6iJZ54hvsyLvVEZG/2Xa3v9CJyMG9t8pG', '#000000', 0, '2025-02-15 11:01:00', NULL),
(61, 'alice789@example.com', 'Alice789', '$2y$10$htnk8g4v9l6wwb5mA3NEnxDKF8K4k6Bd03zLl0gHs0JkYt.Kop8qg', '#000000', 2, '2025-02-15 11:02:00', NULL),
(62, 'bob321@example.com', 'Bob321', '$2y$10$FQwYxDrI8RMwYdtLfNi8fUwT28OkimLx5d8A7Hw.gQ2klwZyqblW3', '#000000', 1, '2025-02-15 11:03:00', NULL),
(63, 'charlie654@example.com', 'Charlie654', '$2y$10$8Gq0s8gPHiZc.VGhQyIWdxIA5f5vXO8TSfnJqFTYp0ioW5tZT8zXq', '#000000', 0, '2025-02-15 11:04:00', NULL),
(64, 'david987@example.com', 'David987', '$2y$10$Fh5qu4ZgEJ96jZw6jr8nNUj4TkhlMRm5cWL1ETeq9lzHbhFplEovO', '#000000', 2, '2025-02-15 11:05:00', NULL),
(65, 'eve543@example.com', 'Eve543', '$2y$10$0Ht55KOH7AqkSfFqF3lCVLOE5grWgF1HzgR3Op79Wy1QGm1YPf0nK', '#000000', 0, '2025-02-15 11:06:00', NULL),
(66, 'grace876@example.com', 'Grace876', '$2y$10$YjZbD4mldxFhdfISW8E.hoXtCOcf2VvAQt2BYE1B2VxjGRmFhmuua', '#000000', 1, '2025-02-15 11:07:00', NULL),
(67, 'heidi345@example.com', 'Heidi345', '$2y$10$uYk3TmKk8fIzwQxg.9H1PBVqTj99aRHtiBYyTW7l.RjeHvfpRgS1G', '#000000', 2, '2025-02-15 11:08:00', NULL),
(68, 'ivy210@example.com', 'Ivy210', '$2y$10$AKPBG89lrO4odXkw4BbeFkRaDe9nYreRATzZn5Mjgh5FkDZfpYrC9', '#000000', 0, '2025-02-15 11:09:00', NULL),
(69, 'jack543@example.com', 'Jack543', '$2y$10$ty7C0nFtXix47dTfG.Rkw1qewF5/0E.oFZSKPj8DAACuqvC0BXQ3C', '#000000', 1, '2025-02-15 11:10:00', NULL),
(71, 'louis432@example.com', 'Louis432', '$2y$10$y2YbqE7VuzhbIZ2E6jQj7X9mfjmVLz9u.ZsQSzE3XzE.60oz6CzYK', '#000000', 2, '2025-02-15 11:12:00', NULL),
(72, 'megan321@example.com', 'Megan321', '$2y$10$wsHmAUGYwMBi5LP6j1bCPVu8o5TQ0dTpZ8c3gIcGZCy5FScUN1vuO', '#000000', 1, '2025-02-15 11:13:00', NULL),
(74, 'nowy@gmail.com', 'nowynowy', '$2y$10$nFK/r.WgkMXTyTcUE11Oj.gJlNocWDM2tjV4.s8SvXcVHOupfT1p2', '#eb624d', 0, '2025-02-15 17:48:14', '937bfd6837e91cb0f8c542484bcc902f.jpg');

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
(25, 74, '2025-02-16', '2025-02-16 12:33:39', 1, 'Login');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
