-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2015 at 08:23 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zupdatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `created_at`, `updated_at`, `message`, `status`) VALUES
(57, 5, 6, '2015-05-14 01:01:49', '2015-05-14 23:26:30', 'asdfasdf', 1),
(58, 5, 6, '2015-05-14 16:31:00', '2015-05-14 16:31:00', 'hello message!', 0),
(59, 5, 5, '2015-05-14 18:56:11', '2015-05-14 18:56:11', '123', 0),
(60, 5, 6, '2015-05-14 18:57:09', '2015-05-14 18:57:09', '123', 0),
(61, 5, 6, '2015-05-14 18:59:06', '2015-05-14 18:59:06', '123', 0),
(62, 6, 5, '2015-05-14 19:01:20', '2015-05-14 19:01:20', '1', 0),
(63, 5, 6, '2015-05-14 19:04:25', '2015-05-14 19:04:25', '1', 0),
(64, 5, 6, '2015-05-14 19:19:19', '2015-05-14 19:19:19', '123123', 0),
(65, 5, 6, '2015-05-14 19:23:05', '2015-05-14 19:23:05', 'awerf', 0),
(66, 6, 6, '2015-05-14 19:27:27', '2015-05-14 19:27:27', '123123123', 0),
(67, 7, 6, '2015-05-14 20:01:48', '2015-05-14 20:01:48', 'dsadfsdfsdf', 0),
(68, 7, 6, '2015-05-14 20:29:36', '2015-05-14 20:29:36', 'dsadfsdfsdf', 0),
(69, 7, 6, '2015-05-14 20:29:43', '2015-05-14 20:29:43', 'dsadfsdfsdf', 0),
(70, 7, 6, '2015-05-14 20:33:07', '2015-05-14 20:33:07', 'dsadfsdfsdf', 0),
(71, 7, 6, '2015-05-14 20:33:09', '2015-05-14 20:33:09', 'dsadfsdfsdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_05_07_010133_create_roles_table', 2),
('2015_05_07_013129_remove_timestamps_in_role_table', 3),
('2015_05_07_014032_add_role_id_column_in_user_table', 4),
('2015_05_07_014604_add_username_in_user_table', 5),
('2015_05_08_050042_create_message_table', 6),
('2015_05_08_063314_dropcolumn_in_message_table_message', 7),
('2015_05_08_063355_add_column_message_in_message_table', 8),
('2015_05_15_003359_add_message_status_in_message_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(9, 'admin'),
(10, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `username`) VALUES
(5, 'Charlie Macaraeg', 'charlie@saservices.com.ph', '$2y$10$TlQfRb91aDqJg3Rj6wjxUu8LxZUi7RU6wj/jL2e0urNnaO1zRqsMS', 'QlkySe2rIMdI14C3q6lEmSbz93IsS3487xMaWlEOOYp0MPkQrmDErWY3eZya', '2015-05-06 17:48:12', '2015-05-07 19:32:07', 10, 'charlie'),
(6, 'Michael Angelo Lacuata', 'michael.angelo@saservices.com.ph', '$2y$10$mm8a1FZhcg4Hn5ETrMiAte401GAolzB.rXzFtKvF6W8IsTQbshtTK', 'he9R4rBpx28FMhbg9xPj3IsEkYiQZbmzYbKaZACy1dNHEH4dpshQ3vbH7iik', '2015-05-06 17:48:12', '2015-05-07 19:38:22', 10, 'angelo'),
(7, 'Camille Ganaden', 'camille.ganaden@saservices.com.ph', '$2y$10$ZpciyBdE./NVyfXk9fp/vOEvTkbSni8b2lPVq9WClExPraVJ/p/iS', '6uG6SSdKXithIA59IDR1BbUhJoTKcImfO233s9Ccr66xUc2qeFxqL8dt3oST', '2015-05-06 17:48:12', '2015-05-07 19:38:05', 10, 'camille'),
(8, 'Joey Mallari', 'joey.mallari@saservices.com.ph', '$2y$10$RQBmIYxcBUcg75c5puXlReJjkSQuvQg4Jh2NCPdcJ52AcWoQRMtxm', 'YMKI8vSGKlUKMW7ASohPPPH3Qbyq0Jk3F7vOUtjetWwI2cz8uOuOlMpN2SZU', '2015-05-06 17:48:12', '2015-05-07 19:38:16', 9, 'joey');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
