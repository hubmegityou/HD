-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sie 2017, 13:18
-- Wersja serwera: 10.1.22-MariaDB
-- Wersja PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hd`
--
CREATE DATABASE IF NOT EXISTS `hd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hd`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `attachment`
--

CREATE TABLE `attachment` (
  `att_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `size` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `attachment`
--

INSERT INTO `attachment` (`att_ID`, `name`, `type`, `size`, `task_ID`) VALUES
(19, '17-08-09_11-23-37test.txt', 'text/plain', 53, 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `functions`
--

CREATE TABLE `functions` (
  `function_ID` int(11) NOT NULL,
  `function_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `functions`
--

INSERT INTO `functions` (`function_ID`, `function_description`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'grafik'),
(4, 'wykonawca'),
(5, 'montażysta');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `message_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `task_ID` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`message_ID`, `user_ID`, `date`, `task_ID`, `text`) VALUES
(23, 18, '2017-08-09 11:22:59', 22, 'dodaje komentarz heh'),
(29, 18, '2017-08-09 13:12:14', 22, 'zmieniam datę');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `notification_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `task_ID` int(11) NOT NULL,
  `subtask_ID` int(11) DEFAULT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `notifications`
--

INSERT INTO `notifications` (`notification_ID`, `date`, `task_ID`, `subtask_ID`, `text`) VALUES
(98, '2017-08-09 11:20:38', 22, 52, 'Masz przydzielone nowe zadanie'),
(99, '2017-08-09 11:21:00', 22, 53, 'Masz przydzielone nowe zadanie'),
(100, '2017-08-09 11:22:59', 22, NULL, 'Dodano komentarz do aktywnego zadania'),
(101, '2017-08-09 11:23:37', 22, NULL, 'Dodano załącznik do aktywnego zadania'),
(109, '2017-08-09 12:59:15', 22, 53, 'Zmieniono datę jednego z podzadań'),
(114, '2017-08-09 13:12:03', 22, 53, 'Zmieniono datę jednego z podzadań'),
(115, '2017-08-09 13:12:14', 22, NULL, 'Dodano komentarz do aktywnego zadania');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nots_user`
--

CREATE TABLE `nots_user` (
  `nots_ID` int(11) NOT NULL,
  `notification_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `read_nots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nots_user`
--

INSERT INTO `nots_user` (`nots_ID`, `notification_ID`, `user_ID`, `read_nots`) VALUES
(43, 99, 18, 1),
(55, 109, 17, 1),
(61, 114, 17, 0),
(62, 115, 17, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subtask`
--

CREATE TABLE `subtask` (
  `subtask_ID` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `user_ID` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `subtask`
--

INSERT INTO `subtask` (`subtask_ID`, `task_ID`, `name`, `start_date`, `end_date`, `description`, `user_ID`, `done`) VALUES
(52, 22, 'podzadanie 2.1', '2017-08-10', '2017-08-11', 'dasda', 17, 0),
(53, 22, 'podzadanie 2.2', '2017-12-10', '2017-12-14', ';ajipdml', 18, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `task_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_ID` int(11) NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`task_ID`, `name`, `description`, `start_date`, `end_date`, `user_ID`, `priority`, `done`) VALUES
(22, 'zadanie 2', 'ble ble test', '2017-08-09', '2017-12-14', 17, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `user_function` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_ID`, `first_name`, `last_name`, `email`, `login`, `password`, `user_function`) VALUES
(5, 'asdas', 'asdasd', 'asdasd', 'aaa', 'b2ca678b4c936f905fb82f2733f5297f', 1),
(17, 'Jan', 'Kowalski', 'ksda@dsd', 'qwe', '202cb962ac59075b964b07152d234b70', 2),
(18, 'Pracownik', 'Aaaa', 'kkk@kkk', 'zxc', '202cb962ac59075b964b07152d234b70', 3),
(20, 'Lol', 'Ll', 'lol@lol.lol', 'lol', '9cdfb439c7876e703e307864c9167a15', 1),
(21, 'Anna', 'Nowak', 'anowak@pl', 'asd', '202cb962ac59075b964b07152d234b70', 5);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`att_ID`),
  ADD KEY `task_ID` (`task_ID`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`function_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `task_ID` (`task_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_ID`),
  ADD KEY `task_ID` (`task_ID`),
  ADD KEY `subtask_ID` (`subtask_ID`);

--
-- Indexes for table `nots_user`
--
ALTER TABLE `nots_user`
  ADD PRIMARY KEY (`nots_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `notification_ID` (`notification_ID`);

--
-- Indexes for table `subtask`
--
ALTER TABLE `subtask`
  ADD PRIMARY KEY (`subtask_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `task_ID` (`task_ID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `user_function` (`user_function`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `attachment`
--
ALTER TABLE `attachment`
  MODIFY `att_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT dla tabeli `functions`
--
ALTER TABLE `functions`
  MODIFY `function_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT dla tabeli `nots_user`
--
ALTER TABLE `nots_user`
  MODIFY `nots_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT dla tabeli `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtask_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`subtask_ID`) REFERENCES `subtask` (`subtask_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nots_user`
--
ALTER TABLE `nots_user`
  ADD CONSTRAINT `nots_user_ibfk_1` FOREIGN KEY (`notification_ID`) REFERENCES `notifications` (`notification_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `subtask`
--
ALTER TABLE `subtask`
  ADD CONSTRAINT `subtask_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subtask_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_function`) REFERENCES `functions` (`function_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
