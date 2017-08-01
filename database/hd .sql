-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Lip 2017, 13:32
-- Wersja serwera: 10.1.24-MariaDB
-- Wersja PHP: 7.1.6

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
  `attachment` text NOT NULL,
  `task_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `attachment`:
--   `task_ID`
--       `task` -> `task_ID`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `functions`
--

CREATE TABLE `functions` (
  `function_ID` int(11) NOT NULL,
  `function_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `functions`:
--

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
-- RELATIONSHIPS FOR TABLE `messages`:
--   `task_ID`
--       `task` -> `task_ID`
--   `user_ID`
--       `users` -> `user_ID`
--

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`message_ID`, `user_ID`, `date`, `task_ID`, `text`) VALUES
(1, 5, '2017-07-05 06:38:22', 16, 'sdfghgfdwsdfghgrew'),
(2, 5, '2017-07-05 06:38:22', 16, 'sdfghgfdwsdfghgrew'),
(3, 17, '2017-07-24 13:00:52', 16, 'sdfghrewert'),
(4, 17, '2017-07-24 13:09:01', 16, 'dupa dupa dupa'),
(5, 17, '2017-07-24 13:09:57', 16, 'wefgwwerfgfwerfgb'),
(6, 17, '2017-07-24 13:10:09', 16, 'dupa dupa dupa dupa dupa dupa\r\n'),
(7, 17, '2017-07-24 13:10:29', 16, 'qawertykjytrewq23etyuiouy5432q357uiuytr5w33r6u'),
(8, 5, '2017-07-24 13:12:28', 16, 'dudnbkwddjwqndskldwqkslv'),
(12, 5, '2017-07-24 14:18:50', 16, 'dd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `notification_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `task_ID` int(11) NOT NULL,
  `subtask_ID` int(11) NOT NULL,
  `text` text NOT NULL,
  `read_nots` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `notifications`:
--   `task_ID`
--       `task` -> `task_ID`
--   `subtask_ID`
--       `subtask` -> `subtask_ID`
--

--
-- Zrzut danych tabeli `notifications`
--

INSERT INTO `notifications` (`notification_ID`, `date`, `task_ID`, `subtask_ID`, `text`, `read_nots`) VALUES
(1, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(2, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(3, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(4, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(5, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(6, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(7, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(8, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(9, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(10, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(11, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(12, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(13, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(14, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(15, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(16, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(17, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(18, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(19, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(20, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(21, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(22, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(23, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(24, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(25, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(26, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(27, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(28, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(29, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(30, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', ''),
(31, '0000-00-00 00:00:00', 17, 19, 'dupa dupa dupa', ''),
(32, '0000-00-00 00:00:00', 17, 19, 'dupaaaaaaa dupaaaaaa dupa', '');

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
-- RELATIONSHIPS FOR TABLE `subtask`:
--   `task_ID`
--       `task` -> `task_ID`
--   `user_ID`
--       `users` -> `user_ID`
--

--
-- Zrzut danych tabeli `subtask`
--

INSERT INTO `subtask` (`subtask_ID`, `task_ID`, `name`, `start_date`, `end_date`, `description`, `user_ID`, `done`) VALUES
(13, 16, 'podzadanie', '2017-07-21', '2017-07-26', 'podzadanie do wykonania', 17, 0),
(14, 16, 'asdfghfdsadfg', '2017-08-04', '2017-09-29', 'dfdewqwedfgbfdwqwsdfvbfdfswasdfvb', 5, 0),
(15, 16, 'asdfghfdsadfg', '2017-09-03', '2017-10-28', 'dfdewqwedfgbfdwqwsdfvbfdfswasdfvb', 5, 0),
(16, 23, 'podzadanie', '2017-07-21', '2017-07-26', 'podzadanie do wykonania', 17, 0),
(17, 23, 'asdfghfdsadfg', '2017-08-04', '2017-09-29', 'dfdewqwedfgbfdwqwsdfvbfdfswasdfvb', 5, 0),
(18, 16, 'asdfghfdsadfg', '2017-09-03', '2017-10-28', 'dfdewqwedfgbfdwqwsdfvbfdfswasdfvb', 5, 0),
(19, 17, 'mmm', '2017-07-06', '2017-07-07', 'mmmm', 17, 1),
(20, 16, 'dupa', '2017-07-22', '2018-05-25', 'hehe', 17, 0),
(21, 19, 'ddd', '2017-07-06', '2018-11-24', 'ee', 17, 0),
(22, 20, 'ngerwe', '2017-07-14', '2017-07-30', 'ergherwq', 17, 0),
(23, 19, 'wertjhtrew3q3werr', '2017-07-15', '2017-07-22', 'erghrewerfg', 18, 0),
(24, 20, 'yhjkjhhjk', '2017-07-05', '2017-07-23', 'ioiuuk', 17, 0);

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
-- RELATIONSHIPS FOR TABLE `task`:
--   `user_ID`
--       `users` -> `user_ID`
--

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`task_ID`, `name`, `description`, `start_date`, `end_date`, `user_ID`, `priority`, `done`) VALUES
(16, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(17, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(18, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(19, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(20, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(21, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(22, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0),
(23, 'zadanie1', 'treść żłąłó', '2017-07-21', '2017-07-28', 17, 0, 0);

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
-- RELATIONSHIPS FOR TABLE `users`:
--   `user_function`
--       `functions` -> `function_ID`
--

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_ID`, `first_name`, `last_name`, `email`, `login`, `password`, `user_function`) VALUES
(5, 'asdas', 'asdasd', 'asdasd', 'aaa', 'b2ca678b4c936f905fb82f2733f5297f', 1),
(17, 'Jan', 'Kowalski', 'ksda@dsd', 'qwe', '202cb962ac59075b964b07152d234b70', 2),
(18, 'Pracownik', 'Aaaa', 'kkk@kkk', 'zxc', '202cb962ac59075b964b07152d234b70', 3),
(19, '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(20, 'Lol', 'Ll', 'lol@lol.lol', 'lol', '9cdfb439c7876e703e307864c9167a15', 1);

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
  MODIFY `att_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `functions`
--
ALTER TABLE `functions`
  MODIFY `function_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtask_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
