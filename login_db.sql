-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 12:01 AM
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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `created_at`, `user_id`) VALUES
(1, 'hej', '2024-11-27 23:55:28', 3),
(2, 'co tam', '2024-11-27 23:55:45', 3),
(3, 'a nic a tam ?', '2024-11-27 23:56:09', 2),
(4, 'lubie jesc', '2024-11-28 00:02:18', 2),
(5, 'nic', '2024-11-28 00:07:19', 3),
(6, 'nigger', '2024-11-28 00:10:07', 3),
(7, 'hej', '2024-11-28 00:10:30', 3),
(8, 'halo', '2024-12-11 19:34:40', 3),
(9, '???', '2024-12-11 19:34:54', 3),
(10, 'nic', '2024-12-11 19:34:58', 3),
(11, 'halo', '2024-12-11 19:47:44', 3),
(12, 'halo', '2024-12-11 20:40:29', 3),
(13, '?', '2024-12-11 20:40:33', 3),
(14, 'ggg', '2024-12-11 20:44:17', 3),
(15, 'wdasf', '2024-12-11 20:46:25', 3),
(16, 'halo ?\\', '2024-12-11 20:57:02', 3),
(17, 'halooo', '2024-12-11 20:57:09', 3),
(18, 'hej ?', '2024-12-11 20:57:33', 3),
(19, '?', '2024-12-11 20:57:44', 3),
(20, 'halo', '2024-12-11 21:01:03', 3),
(21, 'za halo w morde wala', '2024-12-11 21:01:11', 3),
(22, 'o', '2024-12-11 21:02:41', 3),
(23, 'dziala', '2024-12-11 21:02:42', 3),
(24, 'zajebiscie ', '2024-12-11 21:02:45', 3),
(25, 'sigma sigma boi', '2024-12-11 21:02:49', 3),
(26, 'nigger', '2024-12-11 21:03:01', 3),
(27, 'nighguia', '2024-12-11 21:03:38', 6),
(28, 'nom', '2024-12-11 21:03:45', 3),
(29, 'ajaja', '2024-12-11 21:03:52', 6),
(30, 'aha', '2024-12-11 21:04:00', 3),
(31, 'ale jaja', '2024-12-11 21:07:12', 3),
(32, 'i co ?', '2024-12-11 21:07:19', 6),
(33, 'napewno ?', '2024-12-11 21:10:55', 3),
(34, 'nie', '2024-12-11 21:11:01', 6),
(35, 'to kys', '2024-12-11 21:11:10', 3),
(36, 'kys ?', '2024-12-11 21:12:07', 6),
(37, 'kys ?', '2024-12-11 21:12:31', 6),
(38, 'kys ?', '2024-12-11 21:13:01', 3),
(39, 'o kurwa', '2024-12-11 21:14:24', 6),
(40, 'co ?', '2024-12-11 21:14:29', 3),
(41, 'gówno', '2024-12-11 21:14:36', 6),
(42, 'ajajaj', '2024-12-11 21:21:08', 3),
(43, 'nih', '2024-12-11 21:44:59', 3),
(44, 'ez', '2024-12-11 22:01:44', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(1, 'pomocy@gmail.com', 'pomocy', '$2y$10$nYG8HcXCtphUS.5ksrtNte7RF5RcmU.OJ1Iq69pasmR'),
(2, 'iwaniecartur14@gmail.com', 'Arturo', '$2y$10$l/WFPz8QoAxVsJ0wGvdKvuEx.qu2oEI3oTil70/Wksudp.4diZ80.'),
(3, 'nowy@gmail.com', 'nowy', '$2y$10$px37pn4ZREPzqFgyYqV/u.sbP02yfFF2F4y9iu03h8owahdDeQO66'),
(4, 'julka@gmail.com', 'julka', '$2y$10$i0YFAQGRKw5MyoIxKVBQTOFKo0zC3VaEOFFffBFd3xTdF5Trec96i'),
(5, 'seba@gmail.coijm', 'seab', '$2y$10$BJwcZC4lQCebKbGWQJWopOunZE3BwVs6OEaYazUITfEvRzej6aS6m'),
(6, 'idiota@gmail.com', 'idiota', '$2y$10$ZrDP0JQsbZcIYFce0cb9DuxCuftcn23rjzDmUwI49lgbG4DM2VbIa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_date` date NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `activity_date`, `login_time`, `login_count`) VALUES
(1, 6, '2024-12-11', '2024-12-11 22:50:30', 1),
(2, 3, '2024-12-11', '2024-12-11 22:56:41', 1);

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
