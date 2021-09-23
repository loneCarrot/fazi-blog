-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 08:57 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fazekasb_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `thumbnail`) VALUES
(1, 'Lorem Ipsum dolor', 'Lorem ipsum1 dolor sit amet, consectetur adipiscing elit. Sed lacinia lacus3 vitae auctor sodales. Fusce sed dictum purus, in faucibus odio. Curabitur laoreet lacus lacus, sit amet porttitor ante viverra sed. Sed scelerisque lacus metus, vel lobortis arcu', '2021-09-21 12:26:16', ''),
(35, 'Fazi', 'Hello Fazi vagyok!', '2021-09-23 06:28:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Balázs Fazekas', 'fazibalazs', 'fazibalazs@gmail.com', '$2y$10$EgVXj0IKpbApLfvMlRTCdO05hYekOzFtfPeEQ/wyf8GzjURactfYu', '2021-09-20 11:16:20'),
(2, 'Fazekas BalÃ¡zs', 'fazi96', 'craneyone@gmail.com', '$2y$12$0s9uRyyHvolcjYBRv7xH2.KRqDpvY8oV8qWc1ExTWjgesJ9E1iMX6', '0000-00-00 00:00:00'),
(5, 'Fazekas BalÃ¡zs', 'fazi96', 'craneyone@gmail.com', '$2y$12$.gAXSKzMWIIa.tlgXxYd2ef6h.QLMQVxrr.W5VawhkU34iPHctvIK', '2021-09-21 11:57:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
