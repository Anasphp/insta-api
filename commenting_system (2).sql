-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2019 at 02:13 AM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commenting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comments_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_posts_id` int(11) NOT NULL,
  `user_comments` varchar(255) NOT NULL,
  `comment_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comments_id`, `user_id`, `user_posts_id`, `user_comments`, `comment_status`, `created_at`, `updated_at`) VALUES
(1, 24, 6, 'Thor Is my fav', 1, '2019-05-14 12:53:45', '2019-05-14 12:53:45'),
(2, 2, 6, 'Cap is always good', 1, '2019-05-14 12:56:39', '2019-05-14 12:56:39'),
(3, 4, 11, 'demo', 1, '2019-05-14 15:27:52', '2019-05-14 15:27:52'),
(4, 4, 6, 'Iron Man is ultimate', 1, '2019-05-14 15:28:28', '2019-05-14 15:28:28'),
(5, 2, 11, 'Nice day', 1, '2019-05-14 15:44:10', '2019-05-14 15:44:29'),
(6, 1, 6, 'Thanks friends', 1, '2019-05-17 10:23:01', '2019-05-17 10:23:01'),
(7, 1, 11, 'demo', 1, '2019-05-20 11:03:20', '2019-05-20 11:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_url` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply_comments`
--

CREATE TABLE `reply_comments` (
  `reply_comments_id` int(11) NOT NULL,
  `reply_text` varchar(255) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_comments`
--

INSERT INTO `reply_comments` (`reply_comments_id`, `reply_text`, `comment_id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'demo', 3, 4, 11, '2019-05-14 15:27:57', '2019-05-14 15:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image_url`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Anas', 'anas@gmail.com', '$2y$10$mSKwTBx4dGkaSZVQhGcYtulxyJ.1SDgXYYwUNS3GOhmHG5/GiqkJa', 'image-1558330439.jpg', 0, 1, '2019-04-26 12:08:12', '2019-05-20 11:03:59'),
(2, 'Anas Bikes', 'anasbike@gmail.com', '$2y$10$bwSsuQm09InULPt3XfHvIu7dh8RCozJhQ2U7X42/NiXcVS4qZuNQG', 'image-1557828823.jpg', 0, 1, '2019-04-26 12:09:00', '2019-05-14 15:45:03'),
(3, 'Anas Cars', 'anascars@gmail.com', '$2y$10$cy6bT9C/W.QsZRrOUe6/luKtQc8nk4s3HMYiq8NMoDP9O1rE3EYP6', 'image-1557819260.jpg', 0, 1, '2019-04-26 12:09:20', '2019-05-14 13:04:20'),
(4, 'Anas Cartoons', 'anascartoons@gmail.com', '$2y$10$7VZQIG3TvXHOFtL1EbYtquP.zWyOcFFvfzl7wX4Ng8O46i2yH7.AS', 'image-1557819579.jpg', 0, 1, '2019-04-26 12:09:52', '2019-05-14 15:27:33'),
(8, 'Admin', 'admin@gmail.com', '$2y$10$mSKwTBx4dGkaSZVQhGcYtulxyJ.1SDgXYYwUNS3GOhmHG5/GiqkJa', '', 1, 1, '2019-04-29 08:26:58', '2019-04-29 08:26:58'),
(9, 'demo', 'demo@gmail.com', '$2y$10$806IrwpVfs7nMQe9kkIPOuOE/mmpq83o3XNrL9Eb6yujDZG.IiOjC', '', 0, 0, '2019-05-06 14:57:54', '2019-05-14 15:52:38'),
(10, 'demo', 'demso@gmail.com', '$2y$10$806IrwpVfs7nMQe9kkIPOuOE/mmpq83o3XNrL9Eb6yujDZG.IiOjC', '', 0, 0, '2019-05-06 14:59:58', '2019-05-14 15:51:55'),
(11, 'Jhon demo', 'jhon@gmail.com', '$2y$10$kCCWbPJfrD3s4o/2KsKtwOcLoDK/6AwiOcr6SHKH1FDr405XkdOs.', '', 0, 0, '2019-05-06 15:22:49', '2019-05-14 15:52:32'),
(12, 'dummy dummy', 'dummy@gmail.com', '$2y$10$HYoU1p350MrrfaelAv.Nze.frTSxCKLMkh4z2CZxVFBpB1y59M8CW', '', 0, 0, '2019-05-06 15:25:23', '2019-05-14 15:51:59'),
(13, 'asdasd asdasd', 'asdasd@gmail.com', '$2y$10$ExbD8UiF9ACS7hJ7zPSkh.zdOjVhkJUTS5mpx/GdUWxnOIGworo1m', '', 0, 0, '2019-05-06 15:26:22', '2019-05-14 15:52:03'),
(14, 'asdasd asdasdas', 'dasdasdasd@gmail.com', '$2y$10$xpul7twQ3G.tAVTpq.dbzuvgnIto35rN.cCkZKdJpS6OcutjiAD6m', '', 0, 0, '2019-05-06 15:27:46', '2019-05-14 15:52:18'),
(15, 'Anas sadasd', 'anasarafath8@gmail.com', '$2y$10$/.2KowDZHGPkSopAlf3o6uO4aODlevSgP11PaPdzpWhlIhgOBZj3i', '', 0, 0, '2019-05-07 07:39:38', '2019-05-14 15:52:07'),
(16, 'Sharomi Dev', 'sharom@contus.in', '$2y$10$/s/LsxY/qjKW5xSYBbQKmeDzxrh0lnZ2Pt2tNsmVgTcnIJNKazcXW', '', 0, 0, '2019-05-07 17:52:29', '2019-05-14 15:52:15'),
(17, '12345 12345', 'sharomi@contus.in', '$2y$10$t/BbGkPLbymvAWxJH.rqmumT2xRgM4FR/s7wvKXKtEaLAmA2VxoH6', '', 0, 0, '2019-05-07 18:11:35', '2019-05-14 15:52:20'),
(18, 'haii hello', 'hai@gmail.com', '$2y$10$2fQkDer.ZoOLEBIPkW5A3OAoqNW8AgWh1prERIY4iv5yav7IK/xB6', '', 0, 0, '2019-05-08 10:50:41', '2019-05-14 15:52:34'),
(19, 'Anas 1', 'anas1@gmail.com', '$2y$10$u2iHUHQ7RYXF6GuWXAlXkOEPziqCWrAIQ/RBApXLXJGjgoLQy5t06', '', 0, 1, '2019-05-08 14:34:35', '2019-05-14 15:52:47'),
(20, 'demo demo', 'demos@gmail.com', '$2y$10$lunbJRwFY.fDk9IFVky/YuuWXT0/XtBEZXbLkwVXRLhuX0hFTOju6', '', 0, 0, '2019-05-08 15:08:19', '2019-05-14 15:52:51'),
(21, 'Anas Arafath', 'anasarafath.a@contus.in', '$2y$10$vG65RJFedAbueotjfvWQ7.u3q3VEjD3SOEg0d7zWPzMHmh8LrOvqy', '', 0, 1, '2019-05-08 16:38:29', '2019-05-08 16:38:29'),
(22, 'Nayana Chandran', 'nayanachandran.g@contus.in', '$2y$10$iTXrHAJ1kEsv7g5ZnmSrRebtRA5kPd9REdWT79xgvCL5sGwLJYVke', '', 0, 1, '2019-05-08 16:45:21', '2019-05-08 16:45:21'),
(23, 'karthik s', 'karthikeyan.s@contus.in', '$2y$10$QAb5r2yvS9yRWGbDajkpxOBOfU1EDMucTmeSMJGeNoh8/kPHIH42e', '', 0, 1, '2019-05-08 16:47:58', '2019-05-08 16:47:58'),
(24, 'Anas 2', 'anas2@gmail.com', '$2y$10$UQeYx9X/ohlYDBkVHj9wXOnYjzCG/H4Cag1xm67M6J1X9Z0BdlLca', 'image-1557813169.jpg', 0, 1, '2019-05-13 14:51:47', '2019-05-14 11:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `user_posts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_post_title` varchar(255) NOT NULL,
  `user_post_description` varchar(255) NOT NULL,
  `user_post_image` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`user_posts_id`, `user_id`, `user_post_title`, `user_post_description`, `user_post_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bike', 'Duke is good', 'image-1557813897.jpg', 1, '2019-05-14 11:34:57', '2019-05-14 06:15:19'),
(2, 1, 'Car', 'Car Love', 'image-1557813996.jpg', 1, '2019-05-14 11:36:36', '2019-05-14 11:36:36'),
(3, 1, 'Car Love', 'Lamborghini ', 'image-1557814136.jpg', 1, '2019-05-14 11:38:56', '2019-05-14 11:38:56'),
(4, 1, 'Show Time', 'Fun with friends', 'image-1557814216.jpg', 1, '2019-05-14 11:40:16', '2019-05-14 11:40:16'),
(5, 1, 'Fantasy', 'Wonder Woman', 'image-1557814335.jpg', 1, '2019-05-14 11:42:15', '2019-05-14 11:42:15'),
(6, 1, 'Avengers', 'Top three heroes', 'image-1557818520.jpg', 1, '2019-05-14 12:52:00', '2019-05-14 12:52:00'),
(7, 2, 'My bike', 'Ducatti', 'image-1557818837.jpg', 1, '2019-05-14 12:57:17', '2019-05-14 12:57:17'),
(8, 2, 'Avenger Favourite', 'Captain america', 'image-1557818910.jpg', 1, '2019-05-14 12:58:30', '2019-05-14 12:58:30'),
(10, 3, 'car', 'Red', 'image-1557819292.jpg', 1, '2019-05-14 13:04:52', '2019-05-14 13:04:52'),
(11, 4, 'Thought', 'Day with freshness', 'image-1557819612.jpg', 1, '2019-05-14 13:10:12', '2019-05-14 13:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_images`
--

CREATE TABLE `user_profile_images` (
  `user_profile_images_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_image_url` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comments_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_comments`
--
ALTER TABLE `reply_comments`
  ADD PRIMARY KEY (`reply_comments_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`user_posts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reply_comments`
--
ALTER TABLE `reply_comments`
  MODIFY `reply_comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `user_posts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
