-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04.12.2025 klo 08:40
-- Palvelimen versio: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budjetti`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `tapahtumat`
--

CREATE TABLE `tapahtumat` (
  `tapahtumaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `kuvaus` varchar(255) DEFAULT NULL,
  `tulo` int(11) DEFAULT NULL,
  `Menot` int(11) DEFAULT NULL,
  `paivamaara` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tapahtumat`
--
ALTER TABLE `tapahtumat`
  ADD PRIMARY KEY (`tapahtumaid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tapahtumat`
--
ALTER TABLE `tapahtumat`
  MODIFY `tapahtumaid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `tapahtumat`
--
ALTER TABLE `tapahtumat`
  ADD CONSTRAINT `tapahtumat_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

INSERT INTO `users` (`name`, `email`, `passwordhash`, `status`) VALUES
('Topi Topi', 'topi@gmail.com', '$2y$10$tL6xJZphXPrTuZQgR4P5e.L.WX3hWW.2Q5hefbvAl8MhtKJpg63JW', 'active');

ALTER TABLE users MODIFY status VARCHAR(50) NOT NULL DEFAULT 'active';

ALTER TABLE tapahtumat
ADD COLUMN kategoria VARCHAR(50) DEFAULT 'Muu';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
