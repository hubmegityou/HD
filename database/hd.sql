-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Sie 2017, 13:16
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
  `name` text NOT NULL,
  `type` text NOT NULL,
  `size` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL,
  `description` text NOT NULL
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
(4, 17, '2017-08-09 14:41:39', 41, 'vvv'),
(5, 18, '2017-08-09 14:46:50', 41, 'hhhhhh'),
(6, 18, '2017-08-09 14:46:58', 41, 'vvvvvvv'),
(7, 17, '2017-08-16 10:50:33', 41, 'bb'),
(8, 17, '2017-08-16 10:51:18', 41, 'hyehyehehehehe'),
(9, 17, '2017-08-16 11:13:47', 43, 'eee'),
(10, 17, '2017-08-16 11:13:52', 43, 'fff');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `notification_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `notifications`:
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nots_user`
--

CREATE TABLE `nots_user` (
  `nots_ID` int(11) NOT NULL,
  `notification_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL,
  `subtask_ID` int(11) NOT NULL,
  `read_nots` int(11) NOT NULL,
  `delete_n` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `nots_user`:
--   `notification_ID`
--       `notifications` -> `notification_ID`
--   `user_ID`
--       `users` -> `user_ID`
--   `subtask_ID`
--       `subtask` -> `subtask_ID`
--   `task_ID`
--       `task` -> `task_ID`
--

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
  `done` tinyint(1) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL
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

INSERT INTO `subtask` (`subtask_ID`, `task_ID`, `name`, `start_date`, `end_date`, `description`, `user_ID`, `done`, `confirmed`, `blocked`) VALUES
(44, 40, 'bbbbbb', '2017-08-10', '2017-08-18', 'bbbb', 17, 0, 1, 0),
(45, 41, 'gggggg', '2017-08-11', '2017-08-24', 'ghjjhjk', 17, 0, 0, 0),
(46, 41, 'gggggg', '2017-08-10', '2017-08-17', 'fffff', 18, 0, 0, 0),
(47, 40, 'dddddd', '2017-08-10', '2017-08-13', 'ggggg', 18, 1, 0, 0),
(48, 42, 'jjjjjj', '2017-08-10', '2017-08-13', 'vvvvvv', 17, 0, 0, 1),
(49, 43, 'vv', '2017-08-17', '2017-08-21', 'bb', 17, 0, 1, 0),
(50, 41, 'cccc', '0000-00-00', '0000-00-00', 'sddd', 17, 0, 1, 0),
(51, 43, 'cccccc', '2019-12-18', '2021-12-20', 'ddd', 17, 0, 0, 0);

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
(40, 'bbbb', 'mmm', '2017-08-10', '2017-08-18', 17, 0, 0),
(41, 'vvvvv', 'ssss', '2017-08-10', '2017-08-25', 17, 1, 0),
(42, 'zdanie', 'vvvv', '2017-08-10', '2017-08-18', 17, 0, 0),
(43, 'xx', 'xx', '2017-08-24', '2017-08-31', 17, 1, 0),
(44, 'ccccccc', 'cc', '2017-08-24', '2017-08-31', 17, 0, 0);

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
(5, 'asdas', 'asdasd', '', 'aaa', 'b2ca678b4c936f905fb82f2733f5297f', 1),
(17, 'Jan', 'Kowalski', 'email@lajs', 'qwe', '202cb962ac59075b964b07152d234b70', 2),
(18, 'Pracownik', 'Aaaa', '', 'zxc', '202cb962ac59075b964b07152d234b70', 3),
(19, '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(20, 'Lol', 'Ll', '', '', '9cdfb439c7876e703e307864c9167a15', 1);

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
  ADD PRIMARY KEY (`notification_ID`);

--
-- Indexes for table `nots_user`
--
ALTER TABLE `nots_user`
  ADD PRIMARY KEY (`nots_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `notification_ID` (`notification_ID`),
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
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT dla tabeli `nots_user`
--
ALTER TABLE `nots_user`
  MODIFY `nots_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT dla tabeli `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtask_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
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
-- Ograniczenia dla tabeli `nots_user`
--
ALTER TABLE `nots_user`
  ADD CONSTRAINT `nots_user_ibfk_1` FOREIGN KEY (`notification_ID`) REFERENCES `notifications` (`notification_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_3` FOREIGN KEY (`subtask_ID`) REFERENCES `subtask` (`subtask_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_4` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
