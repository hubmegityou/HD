-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Lip 2017, 08:18
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `attachment`
--

CREATE TABLE `attachment` (
  `att_ID` int(11) NOT NULL,
  `attachment` text NOT NULL,
  `task_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `functions`
--

CREATE TABLE `functions` (
  `function_ID` int(11) NOT NULL,
  `function_description` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `functions`
--

INSERT INTO `functions` (`function_ID`, `function_description`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'grafik'),
(4, 'pracownik'),
(5, 'sprzątaczka');

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
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `subtask`
--

INSERT INTO `subtask` (`subtask_ID`, `task_ID`, `name`, `start_date`, `end_date`, `description`, `user_ID`) VALUES
(1, 1, 'huehuehuehue', '2017-07-03', '2017-07-04', 'hdhdhdhdhdhdhdhdhdh jsjsjsjsj kkdekkeke ksjsjsssjsj kkekekwkwkwk kssdnxmxkxk xnxsjsjsjs AAALŁŁŁŁąąąąąććć', 3),
(2, 1, 'efghjkl', '2017-07-19', '2017-07-28', 'wefghjkjhnbvdswertyujhnbvfdew45tryhgfdwertghfdertgfdertgfdertgfdertf frerfderdffdew egngtrergre yt434rgr43rtg erght54tgtr54trg wrett4regbr ewrgtr4rtgbrttg ewrfgbgfre4rgbr4 wedfgbfregr wedfbgregr43 efdbgregfr43 edffgrgbfr4 wdfbfrefgr43 wsdvcfregbfre4efre4 wdfbgtrfvfgr4 wdfbgre4fre34 fdfgrefbfgr43 wedfgtr4 ', 4),
(3, 1, 'efghjkl', '2017-07-19', '2017-07-28', 'wefghjkjhnbvdswertyujhnbvfdew45tryhgfdwertghfdertgfdertgfdertgfdertf frerfderdffdew egngtrergre yt434rgr43rtg erght54tgtr54trg wrett4regbr ewrgtr4rtgbrttg ewrfgbgfre4rgbr4 wedfgbfregr wedfbgregr43 efdbgregfr43 edffgrgbfr4 wdfbfrefgr43 wsdvcfregbfre4efre4 wdfbgtrfvfgr4 wdfbgre4fre34 fdfgrefbfgr43 wedfgtr4 ', 4);

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
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`task_ID`, `name`, `description`, `start_date`, `end_date`, `user_ID`) VALUES
(1, 'hahaha', 'hehehe', '2017-07-02', '2017-07-13', 1);

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
(1, 'hgfds', 'hgfd', 'hgew', 'gf', 'ggrerwq', 1),
(3, 'imię', 'nazwisko', 'email', 'login', 'hasło', 4),
(4, 'kjhkj', 'hoopk', 'mni', 'lklk', 'lkklm', 5),
(5, 'asdas', 'asdasd', 'asdasd', 'aaa', 'qqq', 3);

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
-- AUTO_INCREMENT dla tabeli `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtask_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
