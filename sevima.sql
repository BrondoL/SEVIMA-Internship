-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2021 at 08:06 AM
-- Server version: 10.3.25-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sevima`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `komentar`, `id_post`, `id_user`) VALUES
(2, 'aku lelah', 1, 1),
(3, 'ayo semangat!', 2, 1),
(4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae saepe tempore dicta praesentium voluptates fugiat aliquam repudiandae laborum! Laborum aliquam asperiores aliquid expedita deleniti possimus numquam nostrum tempora repellat qui!', 3, 1),
(5, 'Jangan lupa istirahat kawan :)', 2, 2),
(6, 'wah keren ni, ajarin saya dong', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `id_liked` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`id_liked`, `id_post`, `id_user`) VALUES
(5, 1, 1),
(6, 2, 1),
(8, 4, 1),
(11, 1, 2),
(12, 2, 2),
(13, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `foto_post` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `foto_post`, `deskripsi`, `author`, `created_at`) VALUES
(1, 'flat-1920x1080-forest-deer-4k-5k-iphone-wallpaper-abstract-11925.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor illo accusantium a nesciunt nostrum veritatis? Autem molestias, recusandae magni quia ab eveniet necessitatibus quaerat assumenda voluptates, aliquam beatae cum eum!', '1', '2021-06-16 22:54:42'),
(2, 'xfce-blue.jpg', 'wallpaper gue', '1', '2021-06-16 23:04:24'),
(3, 'IMG-20200224-WA0006.jpg', 'Aulia Ahmad Nabil\r\n1817051074', '1', '2021-06-17 00:13:49'),
(4, 'no2.png', 'Write Up Soal Tes Sevima no 2.\r\nInsya Allah Benar :)', '2', '2021-06-17 03:45:11'),
(6, 'no1.png', 'No 1', '2', '2021-06-17 07:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `foto`, `username`, `email`, `password`, `role_id`, `last_login`) VALUES
(1, 'Aulia Ahmad Nabil', 'default.png', 'brondol', 'nabilunited2@gmail.com', '$2y$10$/86Eb/Yv5ld3WPRZwCUrue4dp8NnF1PeoV3tc4WXRwhcVhJsR3Rx6', 2, '2021-06-17 07:59:33'),
(2, 'Intania Rahmadila', 'default.png', 'intaniarr', 'admin@gmail.com', '$2y$10$dDV4yDDvJFcO2YmHONc2WeCzMJbJCzT8tpBNUhRcQGgu.zFYZmNLe', 2, '2021-06-17 07:57:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`id_liked`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `id_liked` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
