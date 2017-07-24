-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lip 2017, 14:59
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
-- RELATIONSHIPS FOR TABLE `attachment`:
--   `task_ID`
--       `task` -> `task_ID`
--

--
-- Zrzut danych tabeli `attachment`
--

INSERT INTO `attachment` (`att_ID`, `name`, `type`, `size`, `task_ID`) VALUES
(1, 'test.txt', '', 0, 17);

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
(9, 17, '2017-07-24 14:31:30', 16, 'działa!!!1\r\n');

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
(13, 16, 'podzadanie', '2017-07-21', '2017-07-23', 'podzadanie do wykonania', 17, 0),
(14, 16, 'asdfghfdsadfg', '2017-07-03', '2017-07-28', 'dfdewqwedfgbfdwqwsdfvbfdfswasdfvb', 5, 0),
(15, 16, 'asdfghfdsadfg', '2017-07-03', '2017-07-28', 'dfdewqwedfgbfdwqwsdfvbfdfswasdfvb', 5, 0);

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
(17, 'załącznik jakiś bez pr', 'stare z załącznikiem', '2017-07-12', '2017-07-20', 17, 0, 0);

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
(18, 'Pracownik', 'Aaaa', 'kkk@kkk', 'zxc', '202cb962ac59075b964b07152d234b70', 3);

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
  MODIFY `att_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `functions`
--
ALTER TABLE `functions`
  MODIFY `function_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtask_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
