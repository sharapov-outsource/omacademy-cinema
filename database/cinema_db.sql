-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 10, 2024 at 07:26 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cinema2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingtable`
--

CREATE TABLE `bookingtable` (
                                `bookingID` int NOT NULL,
                                `movieID` int DEFAULT NULL,
                                `bookingDate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `bookingTime` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `bookingFName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `bookingLName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `bookingPNumber` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `status` enum('Новое','Подтверждено','Отменено') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookingtable`
--

INSERT INTO `bookingtable` (`bookingID`, `movieID`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `status`) VALUES
                                                                                                                                                  (73, 5, '2024-11-05', '15-00', 'Александр', 'Ш', '332432424', 'Подтверждено'),
                                                                                                                                                  (74, 5, '2024-11-05', '14:00', 'Евгений', 'Б', '23424234', 'Подтверждено'),
                                                                                                                                                  (75, 3, '2024-11-05', '14:00', 'Егор', 'Иванов', '23424234', 'Отменено'),
                                                                                                                                                  (76, 1, '2024-11-06', '15:00', 'Дмитрий', 'Тарасов', '234234234', 'Подтверждено'),
                                                                                                                                                  (78, 1, '2024-11-15', '14:00', 'Костя', 'Дзю', '23423424234', 'Подтверждено'),
                                                                                                                                                  (79, 3, '2024-11-14', '16:00', 'Константин', 'Николаевич', '7874635234', 'Новое'),
                                                                                                                                                  (80, 1, '2024-11-16', '19:00', 'Константин', 'Николаевич', '783765212', 'Новое');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
                          `genreID` int NOT NULL,
                          `genreName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genreID`, `genreName`) VALUES
                                                  (1, 'Боевик'),
                                                  (2, 'Комедия'),
                                                  (3, 'Мелодрама'),
                                                  (4, 'Ужасы');

-- --------------------------------------------------------

--
-- Table structure for table `movietable`
--

CREATE TABLE `movietable` (
                              `movieID` int NOT NULL,
                              `movieImg` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `movieTitle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `genreID` int NOT NULL,
                              `movieDuration` int NOT NULL,
                              `movieRelDate` date NOT NULL,
                              `movieDirector` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `movieActors` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movietable`
--

INSERT INTO `movietable` (`movieID`, `movieImg`, `movieTitle`, `genreID`, `movieDuration`, `movieRelDate`, `movieDirector`, `movieActors`) VALUES
                                                                                                                                               (1, 'img/movie-poster-1.jpg', 'Капитан Марвел', 1, 220, '2018-10-18', 'Anna Boden, Ryan Fleck', 'Brie Larson, Samuel L. Jackson, Ben Mendelsohn'),
                                                                                                                                               (2, 'img/movie-poster-2.jpg', 'Грустное кино', 2, 110, '2018-10-18', 'Assad Fouladkar', 'Ahmed Adam, Bayyumy Fouad, Salah Abdullah , Entsar, Dina Fouad '),
                                                                                                                                               (3, 'img/movie-poster-3.jpg', 'Лего в кино', 1, 110, '2014-02-07', 'Phil Lord, Christopher Miller', 'Chris Pratt, Will Ferrell, Elizabeth Banks'),
                                                                                                                                               (4, 'img/movie-poster-4.jpg', 'Смешное кино', 2, 105, '2019-01-23', ' Ayman Uttar', 'Karim Abdul Aziz, Ghada Adel, Maged El Kedwany, Nesreen Tafesh, Bayyumy Fouad, Moataz El Tony '),
                                                                                                                                               (5, 'img/movie-poster-5.jpg', 'Власть', 2, 132, '2018-12-25', 'Adam McKay', 'Christian Bale, Amy Adams, Steve Carell');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `username` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
    (1, '123', 'john', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookingtable`
--
ALTER TABLE `bookingtable`
    ADD PRIMARY KEY (`bookingID`),
  ADD UNIQUE KEY `bookingID` (`bookingID`),
  ADD KEY `foreign_key_movieID` (`movieID`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
    ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `movietable`
--
ALTER TABLE `movietable`
    ADD PRIMARY KEY (`movieID`),
  ADD UNIQUE KEY `movieID` (`movieID`),
  ADD KEY `genreID` (`genreID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingtable`
--
ALTER TABLE `bookingtable`
    MODIFY `bookingID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
    MODIFY `genreID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movietable`
--
ALTER TABLE `movietable`
    MODIFY `movieID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookingtable`
--
ALTER TABLE `bookingtable`
    ADD CONSTRAINT `foreign_key_movieID` FOREIGN KEY (`movieID`) REFERENCES `movietable` (`movieID`);

--
-- Constraints for table `movietable`
--
ALTER TABLE `movietable`
    ADD CONSTRAINT `movietable_ibfk_1` FOREIGN KEY (`genreID`) REFERENCES `genres` (`genreID`);
COMMIT;
