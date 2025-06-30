-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 04:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `message` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `userId`, `message`) VALUES
(1, 2, 'El Site 7elw Fash5'),
(2, 2, 'El Site 7elw Fash5');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(10) NOT NULL,
  `adminId` int(10) NOT NULL,
  `movieTitle` varchar(50) NOT NULL,
  `movieGenre` varchar(50) NOT NULL,
  `movieDuration` varchar(50) NOT NULL,
  `movieProdDate` varchar(50) NOT NULL,
  `movieDirector` varchar(50) NOT NULL,
  `movieActors` varchar(500) NOT NULL,
  `movieImg` varchar(500) NOT NULL,
  `movieTrailer` varchar(500) NOT NULL,
  `mainHall` int(10) NOT NULL DEFAULT 0,
  `privateHall` int(10) NOT NULL DEFAULT 0,
  `vipHall` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `adminId`, `movieTitle`, `movieGenre`, `movieDuration`, `movieProdDate`, `movieDirector`, `movieActors`, `movieImg`, `movieTrailer`, `mainHall`, `privateHall`, `vipHall`) VALUES
(26, 0, 'f', 'f', '134r', '222222-02-22', 'elfgendy', 'QQ', '00000PORTRAIT_00000_BURST20210618155837427.jpg', '00000PORTRAIT_00000_BURST20210618155837427.jpg', 2, 3, 4),
(27, 0, 'fffd', 'f', '134r', '275760-06-06', 'w', 'QQ', '00000PORTRAIT_00000_BURST20210618172949381.jpg', '00000PORTRAIT_00000_BURST20210618172951408.jpg', -1, 453, 234523),
(28, 25, 'la trago3', 'f', '134r', '275760-07-07', 'w', 'aa,bb,cc', '00000PORTRAIT_00000_BURST20210618155837427.jpg', '00000PORTRAIT_00000_BURST20210618155837427.jpg', 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `receptickets`
--

CREATE TABLE `receptickets` (
  `id` int(10) NOT NULL,
  `movieId` int(10) NOT NULL,
  `ticketTheatre` varchar(50) NOT NULL,
  `ticketTime` varchar(50) NOT NULL,
  `reserverName` varchar(50) NOT NULL,
  `reserverEmail` varchar(300) NOT NULL,
  `ticketQnt` int(10) NOT NULL,
  `orderId` varchar(50) NOT NULL,
  `amount` int(10) NOT NULL,
  `payMethod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleName` varchar(10) NOT NULL,
  `roleId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleName`, `roleId`) VALUES
('user', 0),
('admin', 1),
('receptioni', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `movieId` int(10) NOT NULL,
  `showTime` varchar(50) NOT NULL,
  `cinemaInShow` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`movieId`, `showTime`, `cinemaInShow`) VALUES
(27, '22/10/2024 1:30Am', 'cairo'),
(27, '22/10/2024 2:30 PM', 'alex'),
(28, '22/10/2024 1:30Am', 'lux'),
(28, '22/10/2024 2:30 PM', 'kafr'),
(26, '22/10/2024 1:30Am', 'lux'),
(26, '22/10/2024 2:30 PM', 'kafr');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketId` int(10) NOT NULL,
  `movieId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `ticketTheatre` varchar(50) NOT NULL,
  `ticketTime` varchar(50) NOT NULL,
  `item1` varchar(50) NOT NULL,
  `qnt1` int(10) NOT NULL,
  `item2` varchar(50) NOT NULL,
  `qnt2` int(10) NOT NULL,
  `item3` varchar(50) NOT NULL,
  `qnt3` int(10) NOT NULL,
  `ticketQnt` int(10) NOT NULL,
  `orderId` varchar(50) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketId`, `movieId`, `userId`, `ticketTheatre`, `ticketTime`, `item1`, `qnt1`, `item2`, `qnt2`, `item3`, `qnt3`, `ticketQnt`, `orderId`, `amount`) VALUES
(24, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ615654', 40),
(25, 26, 8, 'mainHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ854309', 20),
(26, 26, 8, 'privateHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ57725', 30),
(27, 26, 8, 'privateHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ22731', 30),
(28, 26, 8, 'privateHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ996434', 30),
(29, 26, 8, 'privateHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ941829', 30),
(30, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ620807', 40),
(31, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ564474', 40),
(32, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ276923', 40),
(33, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 10, 'ARZAQ536601', 40),
(34, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 45, 'ARZAQ121205', 180),
(35, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 45, 'ARZAQ769390', 180),
(36, 26, 8, 'vipHall', '214213', 'pepsi', 2, 'cola', 2, 'popcorn', 2, 45, 'ARZAQ10649', 180),
(37, 27, 8, 'vipHall', '214213', 'scvsv3', 3, '3', 3, '3', 3, 3, 'ARZAQ926317', 703569),
(38, 27, 8, 'vipHall', '214213', 'scvsv3', 3, '3', 3, '3', 3, 3, 'ARZAQ218237', 703569),
(39, 27, 8, 'vipHall', '214213', 'scvsv3', 3, '3', 3, '3', 3, 3, 'ARZAQ820463', 703569),
(40, 27, 8, 'vipHall', '214213', 'scvsv3', 3, '3', 3, '3', 3, 3, 'ARZAQ589293', 703569),
(41, 28, 8, 'vipHall', '214213', 'scvsv3', 3, '3', 3, '3', 3, 3, 'ARZAQ186185', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `roleId` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `roleId`) VALUES
(2, 'abdo', 'a@gmail.com', '$2y$10$YavpXsCHwetzls1Ro7ueueO441sTDqYAmi7B9x97GvbFDpBLIKDcK', 0),
(3, 'msamy', 'jana@gmail.com', '$2y$10$HUgEU/qvz2zY/Nk3LdXr9OLFDGcWhKnhRHGxnMLPwgeEjWcbDiRP.', 0),
(4, 'rawda', 'rawda@gmail.com', '$2y$10$gyrU6yDml441Ku6ZV0U77e8jyhH5m1aYHNfrZfX1qP1wNsFsETJJC', 1),
(5, 'shahda', 'shahda@gmail.com', '$2y$10$ldBRTJfjsjNYxwdYgX34teWXhZBuTxJCytKMf4LprCNw/UOdipTIq', 1),
(6, 'batol', 'batol@gmail.com', '$2y$10$3JRzBHjmI9LywcHsxUGzzeCEiD/x9u3f2GhHvm20vlLUpsLQ1Ix6W', 0),
(7, 'shrok', 'shrok@gmail.com', '$2y$10$3pWcbkXNF4avRZ5DQcWy4uiXalzhQegwkavArw4qklB//AJ5pEGDq', 1),
(8, 'basmla', 'basmla@gmail.com', '$2y$10$UltGxa7rCZOz3rHscPunAeb0U5w0CICl7g3utxey8LTTO14VpW6cS', 2),
(9, 'ahmed', 'ahmed@gmail.com', '$2y$10$CfYdvYmyNJeSZ7IKsp5v/eByDYgFI96dlARgbgEo6kM80H1uj6nOO', 0),
(10, '1', '1@gmail.com', '$2y$10$X/YtadrtaMEs/sCqwEVgn.Lr/K/QEA9mkhzx9rESRD6yNI662VbGq', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
