-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2018 at 03:35 PM
-- Server version: 5.7.22
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `block_users_list`
--

CREATE TABLE `block_users_list` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `block_users_list`
--

INSERT INTO `block_users_list` (`id`, `user_id`, `blocked_user_id`, `created_at`, `updated_at`) VALUES
(3, 28, 19, '2018-10-30 09:42:50', '2018-10-30 09:42:50'),
(4, 28, 19, '2018-10-30 09:42:55', '2018-10-30 09:42:55'),
(5, 28, 7, '2018-10-30 10:08:56', '2018-10-30 10:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) UNSIGNED NOT NULL,
  `chat_id` int(11) NOT NULL,
  `author_user_id` int(11) NOT NULL,
  `dest_user_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `chat_id`, `author_user_id`, `dest_user_id`, `message`, `created_at`, `updated_at`) VALUES
(12, 1540891316, 1, 27, 'hi', '2018-10-30 09:22:10', '2018-10-30 09:22:10'),
(13, 1540891316, 27, 1, 'hello', '2018-10-30 09:22:20', '2018-10-30 09:22:20'),
(14, 1540891316, 27, 1, 'how are you?', '2018-10-30 09:22:39', '2018-10-30 09:22:39'),
(15, 1540891316, 1, 27, 'fine', '2018-10-30 09:22:52', '2018-10-30 09:22:52'),
(16, 1540891316, 27, 1, 'great', '2018-10-30 09:23:13', '2018-10-30 09:23:13'),
(17, 1540891316, 1, 27, ';)', '2018-10-30 09:23:21', '2018-10-30 09:23:21'),
(18, 1540891316, 1, 27, ';)', '2018-10-30 09:23:29', '2018-10-30 09:23:29'),
(19, 1540891316, 1, 27, 'fdgdf', '2018-10-30 09:23:40', '2018-10-30 09:23:40'),
(20, 1540891316, 1, 27, 'gdfg', '2018-10-30 09:23:41', '2018-10-30 09:23:41'),
(21, 1540891316, 1, 27, 'gdf', '2018-10-30 09:23:41', '2018-10-30 09:23:41'),
(22, 1540891316, 1, 27, 'gdf', '2018-10-30 09:23:41', '2018-10-30 09:23:41'),
(23, 1540891316, 1, 27, 'f', '2018-10-30 09:23:43', '2018-10-30 09:23:43'),
(24, 1540891316, 1, 27, 'gdfgf', '2018-10-30 09:24:01', '2018-10-30 09:24:01'),
(25, 1540891316, 1, 27, 'gdf', '2018-10-30 09:24:01', '2018-10-30 09:24:01'),
(26, 1540891316, 1, 27, 'gdf', '2018-10-30 09:24:02', '2018-10-30 09:24:02'),
(27, 1540891316, 1, 27, 'gfd', '2018-10-30 09:24:03', '2018-10-30 09:24:03'),
(28, 1540891316, 1, 27, 'sdfsd', '2018-10-30 09:26:36', '2018-10-30 09:26:36'),
(29, 1540891316, 1, 27, 'ghjgjfg', '2018-10-30 09:26:47', '2018-10-30 09:26:47'),
(30, 1540891316, 1, 27, 'dgdsfgsdfg', '2018-10-30 09:26:54', '2018-10-30 09:26:54'),
(31, 1540891316, 1, 27, 'dfg', '2018-10-30 09:26:55', '2018-10-30 09:26:55'),
(32, 1540891316, 1, 27, 'sdfg', '2018-10-30 09:26:55', '2018-10-30 09:26:55'),
(33, 1540891316, 1, 27, 'sdg', '2018-10-30 09:26:55', '2018-10-30 09:26:55'),
(34, 1540891316, 1, 27, 'sdf', '2018-10-30 09:26:55', '2018-10-30 09:26:55'),
(35, 1540894337, 1, 28, 'hi', '2018-10-30 10:14:12', '2018-10-30 10:14:12'),
(36, 1540894337, 28, 1, 'hi', '2018-10-30 10:14:20', '2018-10-30 10:14:20'),
(37, 1540894337, 28, 1, 'hi', '2018-10-30 10:14:28', '2018-10-30 10:14:28'),
(38, 1540894337, 1, 28, 'ghmhgm', '2018-10-30 10:15:17', '2018-10-30 10:15:17'),
(39, 1540891713, 1, 27, 'hi', '2018-10-30 11:24:19', '2018-10-30 11:24:19'),
(40, 1540900248, 28, 1, 'hi', '2018-10-30 11:50:59', '2018-10-30 11:50:59'),
(41, 1540900248, 28, 1, 'how are you?', '2018-10-30 11:51:48', '2018-10-30 11:51:48'),
(42, 1540900924, 2, 1, 'hi', '2018-10-30 12:02:14', '2018-10-30 12:02:14'),
(43, 1540900924, 2, 1, 'hi', '2018-10-30 12:02:28', '2018-10-30 12:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `check_email`
--

CREATE TABLE `check_email` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `uniq_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `check_email`
--

INSERT INTO `check_email` (`id`, `email`, `uniq_id`, `created_at`, `updated_at`) VALUES
(1, 'andrii.galavan@gmail.com', '6d1b51bcae8bc028ecb52b84d3280dec', '2018-10-29 16:41:49', '2018-10-29 16:41:49'),
(2, 'andrii.galavan@gmail.com', '1b46e451f58e8c55e3dca93caa433c72', '2018-10-29 17:17:07', '2018-10-29 17:17:07'),
(3, 'andrii.galavan@gmail.com', '7bad966001eff2de6122f3a4fcc82c8e', '2018-10-29 17:24:16', '2018-10-29 17:24:16'),
(4, 'mbortnic@student.unit.ua', 'a2c5778b4153df0a8e57acd4018c37ff', '2018-10-30 09:11:57', '2018-10-30 09:11:57'),
(5, 'mariana.botnichuk@gmail.com', '809af72e83c793fb5e6ca80d66c84f71', '2018-10-30 09:13:57', '2018-10-30 09:13:57'),
(7, 'kerdebirke@ezehe.com', '626d6e9e9d92b46c9d2d5eb4feff1247', '2018-10-30 09:35:51', '2018-10-30 09:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `check_profile_log`
--

CREATE TABLE `check_profile_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_profile_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discovery_settings`
--

CREATE TABLE `discovery_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `max_distanse` int(11) NOT NULL DEFAULT '20',
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL,
  `min_rating` int(11) DEFAULT NULL,
  `max_rating` int(11) DEFAULT NULL,
  `looking_for` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discovery_settings`
--

INSERT INTO `discovery_settings` (`id`, `user_id`, `max_distanse`, `min_age`, `max_age`, `min_rating`, `max_rating`, `looking_for`, `created_at`, `updated_at`) VALUES
(1, 1, 100, 20, 30, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-30 12:51:48'),
(2, 2, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-30 07:39:07'),
(3, 3, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-30 08:44:38'),
(4, 4, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:06:41'),
(5, 5, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:07:18'),
(6, 6, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:07:57'),
(7, 7, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:08:33'),
(8, 8, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:09:22'),
(9, 9, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:10:02'),
(10, 10, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:10:39'),
(11, 11, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:11:21'),
(12, 12, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:12:06'),
(13, 13, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:12:43'),
(14, 14, 100, 18, 49, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:13:18'),
(15, 15, 100, 27, 37, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:13:54'),
(16, 16, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:14:34'),
(17, 17, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:15:07'),
(18, 18, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:15:42'),
(19, 19, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:16:24'),
(20, 20, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:16:53'),
(21, 21, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:17:35'),
(22, 22, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:18:09'),
(23, 23, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:19:34'),
(24, 24, 100, 18, 55, 0, 100, 'both', '2018-10-09 23:03:42', '2018-10-29 16:20:11'),
(25, 25, 20, 18, 55, 0, 100, 'both', '2018-10-30 09:11:57', '2018-10-30 09:11:57'),
(26, 26, 20, 18, 55, 0, 100, 'both', '2018-10-30 09:13:57', '2018-10-30 09:13:57'),
(27, 27, 20, 22, 29, 0, 100, 'both', '2018-10-30 09:14:45', '2018-10-30 09:18:21'),
(28, 28, 25, 20, 37, 0, 100, 'woman', '2018-10-30 09:35:51', '2018-10-30 10:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `fake_account_report`
--

CREATE TABLE `fake_account_report` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `fake_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fake_account_report`
--

INSERT INTO `fake_account_report` (`id`, `user_id`, `fake_user_id`, `created_at`, `updated_at`) VALUES
(1, 29, 5, '2018-10-29 17:39:26', '2018-10-29 17:39:26'),
(2, 28, 19, '2018-10-30 09:42:55', '2018-10-30 09:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `interest_list`
--

CREATE TABLE `interest_list` (
  `id` int(11) UNSIGNED NOT NULL,
  `interest` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interest_list`
--

INSERT INTO `interest_list` (`id`, `interest`, `created_at`, `updated_at`) VALUES
(1, 'yoga', NULL, NULL),
(2, 'vegan', NULL, NULL),
(3, 'geek', NULL, NULL),
(4, 'piercing', NULL, NULL),
(5, 'photo', NULL, NULL),
(6, 'architecture', NULL, NULL),
(7, 'rock', NULL, NULL),
(8, 'pop', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `last_activity_status`
--

CREATE TABLE `last_activity_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `last_activity_status`
--

INSERT INTO `last_activity_status` (`id`, `user_id`, `last_activity`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-10-30 15:00:42', '2018-10-23 11:08:12', '2018-10-30 13:00:42'),
(2, 2, '2018-10-30 14:07:24', '2018-10-23 11:31:21', '2018-10-30 12:07:24'),
(3, 3, '2018-10-30 14:07:35', '2018-10-23 11:31:45', '2018-10-30 12:07:35'),
(4, 4, '2018-10-30 14:07:50', '2018-10-23 11:32:20', '2018-10-30 12:07:50'),
(5, 5, '2018-10-30 14:08:07', '2018-10-29 15:37:04', '2018-10-30 12:08:07'),
(6, 6, '2018-10-29 18:07:58', '2018-10-29 15:37:46', '2018-10-29 16:07:58'),
(7, 7, '2018-10-29 18:08:43', '2018-10-29 15:38:10', '2018-10-29 16:08:43'),
(8, 8, '2018-10-29 18:09:24', '2018-10-29 15:38:55', '2018-10-29 16:09:24'),
(9, 9, '2018-10-29 18:10:03', '2018-10-29 15:39:08', '2018-10-29 16:10:03'),
(10, 10, '2018-10-30 11:09:27', '2018-10-29 15:40:48', '2018-10-30 09:09:27'),
(11, 11, '2018-10-29 18:11:22', '2018-10-29 15:42:01', '2018-10-29 16:11:22'),
(12, 12, '2018-10-29 18:12:08', '2018-10-29 15:43:31', '2018-10-29 16:12:08'),
(13, 13, '2018-10-29 18:12:44', '2018-10-29 15:47:47', '2018-10-29 16:12:44'),
(14, 14, '2018-10-29 18:13:20', '2018-10-29 15:48:52', '2018-10-29 16:13:20'),
(15, 15, '2018-10-29 18:13:58', '2018-10-29 15:50:02', '2018-10-29 16:13:58'),
(16, 16, '2018-10-29 18:14:35', '2018-10-29 15:51:24', '2018-10-29 16:14:35'),
(17, 17, '2018-10-29 18:15:08', '2018-10-29 15:52:44', '2018-10-29 16:15:08'),
(18, 18, '2018-10-29 18:15:43', '2018-10-29 15:55:13', '2018-10-29 16:15:43'),
(19, 19, '2018-10-29 18:16:25', '2018-10-29 15:56:06', '2018-10-29 16:16:25'),
(20, 20, '2018-10-29 18:16:54', '2018-10-29 15:57:29', '2018-10-29 16:16:54'),
(21, 21, '2018-10-29 18:17:37', '2018-10-29 15:58:32', '2018-10-29 16:17:37'),
(22, 22, '2018-10-29 18:18:10', '2018-10-29 15:59:20', '2018-10-29 16:18:10'),
(23, 23, '2018-10-29 18:19:35', '2018-10-29 16:00:31', '2018-10-29 16:19:35'),
(24, 24, '2018-10-29 18:20:12', '2018-10-29 16:02:19', '2018-10-29 16:20:12'),
(25, 28, '2018-10-30 14:01:13', '2018-10-29 17:31:18', '2018-10-30 12:01:13'),
(26, 29, '2018-10-29 19:41:23', '2018-10-29 17:36:56', '2018-10-29 17:41:23'),
(27, 30, '2018-10-29 19:44:13', '2018-10-29 17:42:23', '2018-10-29 17:44:13'),
(28, 27, '2018-10-30 11:31:38', '2018-10-30 09:14:56', '2018-10-30 09:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `like_nope_check`
--

CREATE TABLE `like_nope_check` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_user_id` int(11) NOT NULL,
  `like_nope` int(1) NOT NULL DEFAULT '0',
  `check_profile` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `like_nope_check`
--

INSERT INTO `like_nope_check` (`id`, `user_id`, `action_user_id`, `like_nope`, `check_profile`, `created_at`, `updated_at`) VALUES
(441, 1, 10, 0, 0, '2018-10-30 11:50:07', '2018-10-30 11:50:07'),
(442, 1, 7, 0, 0, '2018-10-30 11:50:07', '2018-10-30 11:50:07'),
(444, 1, 4, 0, 0, '2018-10-30 11:50:09', '2018-10-30 11:50:09'),
(445, 1, 8, 0, 0, '2018-10-30 11:50:09', '2018-10-30 11:50:09'),
(446, 1, 9, 0, 0, '2018-10-30 11:50:10', '2018-10-30 11:50:10'),
(447, 1, 28, 1, 0, '2018-10-30 11:50:12', '2018-10-30 11:50:12'),
(448, 1, 13, 0, 0, '2018-10-30 11:50:13', '2018-10-30 11:50:13'),
(449, 1, 22, 0, 0, '2018-10-30 11:50:14', '2018-10-30 11:50:14'),
(450, 1, 23, 0, 0, '2018-10-30 11:50:14', '2018-10-30 11:50:14'),
(451, 1, 19, 0, 0, '2018-10-30 11:50:37', '2018-10-30 11:50:37'),
(452, 1, 20, 0, 0, '2018-10-30 11:50:38', '2018-10-30 11:50:38'),
(453, 1, 3, 0, 0, '2018-10-30 11:50:39', '2018-10-30 11:50:39'),
(454, 1, 5, 0, 0, '2018-10-30 11:50:40', '2018-10-30 11:50:40'),
(455, 1, 21, 1, 0, '2018-10-30 11:50:41', '2018-10-30 11:50:41'),
(456, 1, 27, 1, 0, '2018-10-30 11:50:41', '2018-10-30 11:50:41'),
(457, 28, 1, 1, 0, '2018-10-30 11:50:48', '2018-10-30 11:50:48'),
(458, 2, 19, 0, 0, '2018-10-30 12:01:30', '2018-10-30 12:01:30'),
(459, 2, 1, 1, 0, '2018-10-30 12:01:32', '2018-10-30 12:01:32'),
(460, 1, 6, 1, 0, '2018-10-30 12:01:38', '2018-10-30 12:01:38'),
(461, 1, 11, 1, 0, '2018-10-30 12:01:39', '2018-10-30 12:01:39'),
(462, 1, 2, 1, 0, '2018-10-30 12:02:04', '2018-10-30 12:02:04'),
(463, 4, 1, 1, 0, '2018-10-30 12:07:43', '2018-10-30 12:07:43'),
(464, 5, 1, 0, 1, '2018-10-30 12:08:05', '2018-10-30 12:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `matched_people`
--

CREATE TABLE `matched_people` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_id` int(11) NOT NULL,
  `second_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matched_people`
--

INSERT INTO `matched_people` (`id`, `first_id`, `second_id`, `chat_id`, `created_at`, `updated_at`) VALUES
(59, 28, 1, 1540900248, '2018-10-30 11:50:48', '2018-10-30 11:50:48'),
(60, 1, 2, 1540900924, '2018-10-30 12:02:04', '2018-10-30 12:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `action_user_id` int(11) NOT NULL,
  `dest_user_id` int(11) NOT NULL,
  `notif_type` varchar(10) NOT NULL,
  `seen` int(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `action_user_id`, `dest_user_id`, `notif_type`, `seen`, `created_at`, `updated_at`) VALUES
(32, 1, 28, 'like', 0, '2018-10-30 11:50:12', '2018-10-30 11:50:12'),
(33, 28, 1, 'match', 0, '2018-10-30 11:50:48', '2018-10-30 11:50:48'),
(35, 2, 1, 'like', 0, '2018-10-30 12:01:32', '2018-10-30 12:01:32'),
(39, 4, 1, 'like', 0, '2018-10-30 12:07:43', '2018-10-30 12:07:43'),
(40, 5, 1, 'check_prof', 0, '2018-10-30 12:08:05', '2018-10-30 12:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_src` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `user_id`, `photo_src`, `created_at`, `updated_at`) VALUES
(6, 1, '/img/1/2c9a2f97aa5eb882.jpg', '2018-10-18 21:20:39', '2018-10-18 21:20:39'),
(8, 1, '/img/1/1465051ba22e638c.png', '2018-10-18 21:21:08', '2018-10-18 21:21:08'),
(9, 2, '/img/2/588b630dce280fe1.jpg', '2018-10-20 00:35:51', '2018-10-20 00:35:51'),
(10, 3, '/img/3/e590405d56b2e10c.png', '2018-10-20 00:42:19', '2018-10-20 00:42:19'),
(11, 4, '/img/4/4d34361740a43a21.jpg', '2018-10-20 00:43:57', '2018-10-20 00:43:57'),
(13, 6, '/img/6/c831f14857f1760d.jpg', '2018-10-20 00:46:26', '2018-10-20 00:46:26'),
(14, 7, '/img/7/f0667ed642470348.jpg', '2018-10-20 00:47:49', '2018-10-20 00:47:49'),
(15, 8, '/img/8/03e1e79bfeab2052.jpg', '2018-10-20 00:48:35', '2018-10-20 00:48:35'),
(17, 3, '/img/3/c9110ddf1f3c005e.png', '2018-10-29 15:34:58', '2018-10-29 15:34:58'),
(18, 5, '/img/5/a34f2f6a45d47254.jpg', '2018-10-29 15:37:31', '2018-10-29 15:37:31'),
(19, 7, '/img/7/afa3f38a11b5009c.png', '2018-10-29 15:38:31', '2018-10-29 15:38:31'),
(21, 9, '/img/9/2751d33525e6de24.png', '2018-10-29 15:39:29', '2018-10-29 15:39:29'),
(22, 9, '/img/9/79b7449d725c035b.jpg', '2018-10-29 15:39:40', '2018-10-29 15:39:40'),
(23, 10, '/img/10/59274f598c0a2d22.jpg', '2018-10-29 15:41:05', '2018-10-29 15:41:05'),
(24, 10, '/img/10/dd9739cf9289b108.png', '2018-10-29 15:41:13', '2018-10-29 15:41:13'),
(25, 11, '/img/11/bc10c17c8c653396.jpg', '2018-10-29 15:42:14', '2018-10-29 15:42:14'),
(26, 11, '/img/11/3f2b0043fe099101.png', '2018-10-29 15:42:23', '2018-10-29 15:42:23'),
(27, 12, '/img/12/b738a03fb7d3b03b.png', '2018-10-29 15:43:50', '2018-10-29 15:43:50'),
(28, 13, '/img/13/8d8971174de34f06.png', '2018-10-29 15:47:56', '2018-10-29 15:47:56'),
(29, 13, '/img/13/286c14e453b178b1.png', '2018-10-29 15:48:06', '2018-10-29 15:48:06'),
(30, 14, '/img/14/faa5cdaf22c65ad5.png', '2018-10-29 15:49:03', '2018-10-29 15:49:03'),
(31, 14, '/img/14/7b73d60a9770e5b1.png', '2018-10-29 15:49:24', '2018-10-29 15:49:24'),
(32, 15, '/img/15/560bf6ca6836962c.png', '2018-10-29 15:50:29', '2018-10-29 15:50:29'),
(33, 16, '/img/16/2767190da1f4faed.png', '2018-10-29 15:51:38', '2018-10-29 15:51:38'),
(34, 17, '/img/17/56fe8ba014a41e71.png', '2018-10-29 15:52:55', '2018-10-29 15:52:55'),
(35, 18, '/img/18/5a5d0206a4639d9e.png', '2018-10-29 15:55:29', '2018-10-29 15:55:29'),
(36, 19, '/img/19/b6b3d3d91c4b0db2.png', '2018-10-29 15:56:16', '2018-10-29 15:56:16'),
(37, 20, '/img/20/06bd1fb66a40afe9.jpg', '2018-10-29 15:57:41', '2018-10-29 15:57:41'),
(38, 21, '/img/21/ddca98f352e13aaa.jpg', '2018-10-29 15:58:42', '2018-10-29 15:58:42'),
(39, 22, '/img/22/4c99baefb6963704.jpg', '2018-10-29 15:59:30', '2018-10-29 15:59:30'),
(40, 23, '/img/23/7b58d90523d6fd76.jpg', '2018-10-29 16:00:38', '2018-10-29 16:00:38'),
(41, 24, '/img/24/2aafc04a5447bf42.jpg', '2018-10-29 16:02:30', '2018-10-29 16:02:30'),
(42, 24, '/img/24/5a6b0b5fea3b9c02.jpg', '2018-10-29 16:02:38', '2018-10-29 16:02:38'),
(43, 24, '/img/24/505dd837db93c799.jpg', '2018-10-29 16:02:46', '2018-10-29 16:02:46'),
(44, 30, '/img/30/eefd5ac52b41bd73.png', '2018-10-29 17:42:49', '2018-10-29 17:42:49'),
(45, 27, '/img/27/3ca6550eae0110fb.png', '2018-10-30 09:15:17', '2018-10-30 09:15:17'),
(46, 28, '/img/28/7500688bbb29b30b.png', '2018-10-30 09:59:07', '2018-10-30 09:59:07'),
(47, 28, '/img/28/1d142502ed04caed.png', '2018-10-30 09:59:31', '2018-10-30 09:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_confirmed` int(1) DEFAULT '0' COMMENT 'after registration user must confirm account via email',
  `fake_account` int(1) DEFAULT '0' COMMENT 'if 5 users comlains that account is fake, active status become false',
  `active` int(1) DEFAULT '0' COMMENT 'set true when user has at least one photo and account is confirmed and not fake account',
  `online` int(1) NOT NULL DEFAULT '0',
  `about_me` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL DEFAULT '18',
  `fame_rating` int(11) DEFAULT '0',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `facebook_link` varchar(80) DEFAULT NULL,
  `instagram_link` varchar(80) DEFAULT NULL,
  `twittwer_link` varchar(80) DEFAULT NULL,
  `google_plus_link` varchar(80) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `email_confirmed`, `fake_account`, `active`, `online`, `about_me`, `gender`, `age`, `fame_rating`, `lat`, `lng`, `facebook_link`, `instagram_link`, `twittwer_link`, `google_plus_link`, `created_at`, `updated_at`) VALUES
(1, 'codeGuy', 'Ann', 'Vernadski', 'a.galavan@gmail.com', '$2y$10$YG6uRz4Qb4Fvv0jUa4Oeju0DPrYXgJQSNqEih1kg8jNOSL.nLF2Fy', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 25, 100, 50.468987, 30.454720, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 12:54:40'),
(2, 'codeGuy1', 'Petro', 'Lemishka', 'galavan@gmail.com', '$2y$10$YG6uRz4Qb4Fvv0jUa4Oeju0DPrYXgJQSNqEih1kg8jNOSL.nLF2Fy', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 35, 50, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 12:02:04'),
(3, 'codeGuy2', 'Leonid', 'Ivanov', 'andrii@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'other', 19, 50, 50.464211, 30.466490, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:18:43'),
(4, 'codeGuy3', 'Robert', 'Novitski', 'avan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 32, 25, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 10:09:54'),
(5, 'codeGuy4', 'Lesya', 'Novikova', 'andri@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 2, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 28, 37, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:18:51'),
(6, 'codeGuy5', 'Katya', 'Petrova', 'agalavan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 1, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 21, 39, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 12:01:38'),
(7, 'codeGuy6', 'Bazz', 'Guvard', 'angalavan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 23, 41, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 10:09:06'),
(8, 'codeGuy7', 'Oleksandr', 'Hitryi', 'andalavan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 31, 20, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 10:10:03'),
(9, 'codeGuy8', 'Ivan', 'Kureyko', 'andr@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 24, 20, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:18:58'),
(10, 'codeGuy9', 'Artur', 'Duminikian', 'avansss@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 1, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 27, 45, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 10:16:27'),
(11, 'codeGuy10', 'Nastya', 'Burmas', 'an@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 25, 26, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 12:01:39'),
(12, 'codeGuy12', 'Galya', 'Kureyko', 'andriisss.galavan@gmail.com', '$2y$10$YG6uRz4Qb4Fvv0jUa4Oeju0DPrYXgJQSNqEih1kg8jNOSL.nLF2Fy', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 38, 20, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:18:59'),
(13, 'codeGuy13', 'Artem', 'Blabla', 'sssgalavan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 40, 10, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:05'),
(14, 'codeGuy14', 'Robert', 'Gulanski', 'andrii.gggalavan@gmail.com', '$2y$10$YG6uRz4Qb4Fvv0jUa4Oeju0DPrYXgJQSNqEih1kg8jNOSL.nLF2Fy', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 39, 10, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:06'),
(15, 'codeGuy15', 'Viktor', 'Nanavich', 'galavannnn@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 32, 10, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:06'),
(16, 'codeGuy16', 'Lilya', 'Hrobak', 'andriiii@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 19, 11, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:02'),
(17, 'codeGuy17', 'David', 'Hrobak', 'aaaavan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 61, 34, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-29 16:15:07'),
(18, 'codeGuy18', 'Inna', 'Galovska', 'aaagalavan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 30, 12, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:02'),
(19, 'codeGuy19', 'Yulia', 'Vasiluk', 'andriioo@gmail.com', '$2y$10$YG6uRz4Qb4Fvv0jUa4Oeju0DPrYXgJQSNqEih1kg8jNOSL.nLF2Fy', 1, 1, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 41, 97, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:42:55'),
(20, 'codeGuy20', 'Nazar', 'Kucher', 'gavannnn@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 30, 70, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:18:43'),
(21, 'codeGuy21', 'Iruna', 'Gladush', 'andriiiiiii@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 19, 40, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 11:50:41'),
(22, 'codeGuy22', 'David', 'Novinsky', 'aaa@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 42, 10, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:05'),
(23, 'codeGuy23', 'Oleg', 'Kmit', 'anii@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'man', 33, 10, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:04'),
(24, 'codeGuy24', 'Olena', 'Kuchma', 'aaan@gmail.com', '$2y$10$mJzLp12WX1FOrf6QIKIPSOmct6gwntdPD6bBKHTnNoLyc5OuknIQO', 1, 0, 1, 0, 'Hi! I\'m junior software developer currently studying at Unit Factory. Looking for new friends to chat here in Matcha and maybe than meet in the city.', 'woman', 43, 10, 50.478725, 30.464924, NULL, NULL, NULL, NULL, '2018-10-09 02:01:36', '2018-10-30 09:19:03'),
(25, 'mariana', 'mariana', 'mariana', 'mbortnic@student.unit.ua', '$2y$10$wMDJua/foxYbgKCGGdOwJ.jfFDMxnNm93mo6wXD4CPbDC2P90Iqwy', 0, 0, 0, 0, NULL, NULL, 18, 0, 0.000000, 0.000000, NULL, NULL, NULL, NULL, '2018-10-30 09:11:57', '2018-10-30 09:11:57'),
(26, 'mbortnic', 'mbortnic', 'mbortnic', 'mariana.botnichuk@gmail.com', '$2y$10$Qloe3G8ZqCaaXJhqGHSnPewXRUJN8XSqYxMPuB4WG2q37mXtJNFpC', 0, 0, 0, 0, NULL, NULL, 18, 0, 0.000000, 0.000000, NULL, NULL, NULL, NULL, '2018-10-30 09:13:57', '2018-10-30 09:13:57'),
(27, 'mbortnicc', 'mbortnicc', 'mbortnicc', 'mariana.bortnichuk@gmail.com', '$2y$10$jZ/effv6vm4BE9Fh0BCh1engW6Cq2sO8C.tHeIZERYI1Rt/laC5FK', 1, 0, 1, 0, 'hello ;)', 'woman', 21, 40, 50.464211, 30.466490, NULL, NULL, NULL, NULL, '2018-10-30 09:14:45', '2018-10-30 11:50:41'),
(28, 'admin', 'John', 'Doe', 'kerdebirke@ezehe.com', '$2y$10$TzMbgORWTHgKEd5E9PC44etRAkoWX1bwoQQcSJ2d0eQu1alw7i/IW', 1, 0, 1, 0, '<h1>fuck</h1>\r\n', 'man', 32, 30, 50.464211, 30.466490, NULL, NULL, NULL, NULL, '2018-10-30 09:35:51', '2018-10-30 11:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_discovery_interests`
--

CREATE TABLE `user_discovery_interests` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_discovery_interests`
--

INSERT INTO `user_discovery_interests` (`id`, `user_id`, `interest_id`, `created_at`, `updated_at`) VALUES
(22, 2, 2, '2018-10-19 04:44:23', '2018-10-19 04:44:23'),
(23, 2, 3, '2018-10-19 04:44:24', '2018-10-19 04:44:24'),
(29, 2, 1, '2018-10-29 16:05:21', '2018-10-29 16:05:21'),
(30, 2, 4, '2018-10-29 16:05:22', '2018-10-29 16:05:22'),
(31, 2, 6, '2018-10-29 16:05:22', '2018-10-29 16:05:22'),
(32, 2, 7, '2018-10-29 16:05:22', '2018-10-29 16:05:22'),
(37, 1, 7, '2018-10-30 09:21:06', '2018-10-30 09:21:06'),
(38, 1, 6, '2018-10-30 10:11:07', '2018-10-30 10:11:07'),
(39, 1, 4, '2018-10-30 10:11:10', '2018-10-30 10:11:10'),
(40, 1, 3, '2018-10-30 11:50:25', '2018-10-30 11:50:25'),
(41, 1, 5, '2018-10-30 11:50:25', '2018-10-30 11:50:25'),
(42, 1, 2, '2018-10-30 11:50:27', '2018-10-30 11:50:27'),
(43, 1, 1, '2018-10-30 11:50:28', '2018-10-30 11:50:28'),
(44, 1, 8, '2018-10-30 11:50:29', '2018-10-30 11:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_interest`
--

CREATE TABLE `user_interest` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_interest`
--

INSERT INTO `user_interest` (`id`, `user_id`, `interest_id`, `created_at`, `updated_at`) VALUES
(5, 1, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(11, 1, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(16, 3, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(17, 3, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(18, 3, 3, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(19, 3, 4, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(20, 3, 5, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(21, 3, 6, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(22, 4, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(23, 4, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(24, 4, 3, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(25, 4, 4, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(26, 5, 5, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(27, 5, 6, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(28, 6, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(29, 6, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(30, 6, 3, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(34, 7, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(35, 7, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(36, 7, 3, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(37, 7, 4, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(40, 8, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(41, 8, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(42, 8, 3, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(43, 8, 4, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(44, 8, 5, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(45, 8, 6, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(46, 9, 2, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(47, 9, 1, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(48, 9, 3, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(49, 9, 4, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(50, 9, 5, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(51, 9, 6, '2018-10-09 02:08:19', '2018-10-09 02:08:19'),
(52, 10, 4, '2018-10-09 02:07:56', '2018-10-09 02:07:56'),
(53, 12, 1, '2018-10-29 15:47:07', '2018-10-29 15:47:07'),
(54, 12, 2, '2018-10-29 15:47:07', '2018-10-29 15:47:07'),
(55, 13, 7, '2018-10-29 15:48:14', '2018-10-29 15:48:14'),
(56, 13, 4, '2018-10-29 15:48:16', '2018-10-29 15:48:16'),
(57, 15, 2, '2018-10-29 15:50:48', '2018-10-29 15:50:48'),
(58, 15, 3, '2018-10-29 15:50:50', '2018-10-29 15:50:50'),
(59, 16, 5, '2018-10-29 15:51:51', '2018-10-29 15:51:51'),
(60, 16, 6, '2018-10-29 15:51:53', '2018-10-29 15:51:53'),
(61, 17, 7, '2018-10-29 15:53:11', '2018-10-29 15:53:11'),
(62, 18, 6, '2018-10-29 15:55:35', '2018-10-29 15:55:35'),
(63, 19, 6, '2018-10-29 15:56:25', '2018-10-29 15:56:25'),
(64, 19, 3, '2018-10-29 15:56:36', '2018-10-29 15:56:36'),
(65, 19, 4, '2018-10-29 15:56:37', '2018-10-29 15:56:37'),
(66, 20, 2, '2018-10-29 15:57:51', '2018-10-29 15:57:51'),
(67, 20, 1, '2018-10-29 15:57:52', '2018-10-29 15:57:52'),
(68, 21, 1, '2018-10-29 15:58:50', '2018-10-29 15:58:50'),
(69, 21, 2, '2018-10-29 15:58:50', '2018-10-29 15:58:50'),
(70, 21, 4, '2018-10-29 15:58:52', '2018-10-29 15:58:52'),
(71, 21, 8, '2018-10-29 15:58:54', '2018-10-29 15:58:54'),
(72, 22, 5, '2018-10-29 15:59:43', '2018-10-29 15:59:43'),
(73, 22, 6, '2018-10-29 15:59:44', '2018-10-29 15:59:44'),
(74, 22, 7, '2018-10-29 15:59:45', '2018-10-29 15:59:45'),
(75, 22, 8, '2018-10-29 15:59:45', '2018-10-29 15:59:45'),
(76, 23, 3, '2018-10-29 16:00:53', '2018-10-29 16:00:53'),
(77, 23, 4, '2018-10-29 16:00:53', '2018-10-29 16:00:53'),
(79, 24, 8, '2018-10-29 16:02:57', '2018-10-29 16:02:57'),
(80, 24, 6, '2018-10-29 16:02:59', '2018-10-29 16:02:59'),
(81, 24, 5, '2018-10-29 16:02:59', '2018-10-29 16:02:59'),
(82, 2, 8, '2018-10-29 16:05:09', '2018-10-29 16:05:09'),
(83, 2, 6, '2018-10-29 16:05:10', '2018-10-29 16:05:10'),
(84, 2, 5, '2018-10-29 16:05:11', '2018-10-29 16:05:11'),
(85, 10, 5, '2018-10-29 16:10:33', '2018-10-29 16:10:33'),
(86, 10, 6, '2018-10-29 16:10:33', '2018-10-29 16:10:33'),
(87, 11, 3, '2018-10-29 16:11:12', '2018-10-29 16:11:12'),
(88, 11, 4, '2018-10-29 16:11:13', '2018-10-29 16:11:13'),
(89, 11, 5, '2018-10-29 16:11:14', '2018-10-29 16:11:14'),
(90, 12, 3, '2018-10-29 16:12:00', '2018-10-29 16:12:00'),
(91, 12, 4, '2018-10-29 16:12:01', '2018-10-29 16:12:01'),
(92, 15, 8, '2018-10-29 16:13:52', '2018-10-29 16:13:52'),
(93, 23, 5, '2018-10-29 16:19:25', '2018-10-29 16:19:25'),
(94, 23, 6, '2018-10-29 16:19:28', '2018-10-29 16:19:28'),
(95, 27, 3, '2018-10-30 09:15:44', '2018-10-30 09:15:44'),
(96, 27, 7, '2018-10-30 09:15:48', '2018-10-30 09:15:48'),
(97, 28, 6, '2018-10-30 10:00:31', '2018-10-30 10:00:31'),
(98, 28, 7, '2018-10-30 10:00:34', '2018-10-30 10:00:34'),
(99, 28, 4, '2018-10-30 10:00:36', '2018-10-30 10:00:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block_users_list`
--
ALTER TABLE `block_users_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_email`
--
ALTER TABLE `check_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_profile_log`
--
ALTER TABLE `check_profile_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discovery_settings`
--
ALTER TABLE `discovery_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fake_account_report`
--
ALTER TABLE `fake_account_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest_list`
--
ALTER TABLE `interest_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_activity_status`
--
ALTER TABLE `last_activity_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_nope_check`
--
ALTER TABLE `like_nope_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matched_people`
--
ALTER TABLE `matched_people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_discovery_interests`
--
ALTER TABLE `user_discovery_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_interest`
--
ALTER TABLE `user_interest`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block_users_list`
--
ALTER TABLE `block_users_list`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `check_email`
--
ALTER TABLE `check_email`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `check_profile_log`
--
ALTER TABLE `check_profile_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discovery_settings`
--
ALTER TABLE `discovery_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `fake_account_report`
--
ALTER TABLE `fake_account_report`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interest_list`
--
ALTER TABLE `interest_list`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `last_activity_status`
--
ALTER TABLE `last_activity_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `like_nope_check`
--
ALTER TABLE `like_nope_check`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT for table `matched_people`
--
ALTER TABLE `matched_people`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_discovery_interests`
--
ALTER TABLE `user_discovery_interests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_interest`
--
ALTER TABLE `user_interest`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
