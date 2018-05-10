-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2016 at 01:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cubebox`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `text`, `ip_address`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Authentication Info Updated', '103.231.218.166', 0, '2016-08-12 14:20:08', '2016-08-12 14:20:08'),
(2, 1, 'Authentication Info Updated', '103.231.218.166', 0, '2016-08-12 15:49:51', '2016-08-12 15:49:51'),
(3, 9, 'Profile Info Updated', '115.252.77.8', 0, '2016-08-12 16:05:32', '2016-08-12 16:05:32'),
(4, 9, 'Authentication Info Updated', '59.90.161.56', 0, '2016-08-12 16:05:55', '2016-08-12 16:05:55'),
(5, 9, 'Support ticket raised', '59.90.161.56', 0, '2016-08-12 16:16:20', '2016-08-12 16:16:20'),
(6, 1, 'Support ticket raised', '59.90.161.56', 0, '2016-08-13 11:23:15', '2016-08-13 11:23:15'),
(7, 3, 'Authentication Info Updated', '1.22.27.86', 0, '2016-08-13 14:14:59', '2016-08-13 14:14:59'),
(8, 1, 'Authentication Info Updated', '59.93.222.88', 0, '2016-08-29 16:05:23', '2016-08-29 16:05:23'),
(9, 10, 'Authentication Info Updated', '59.90.161.56', 0, '2016-08-29 16:07:43', '2016-08-29 16:07:43'),
(10, 10, 'Profile Info Updated', '59.90.161.56', 0, '2016-08-29 16:17:52', '2016-08-29 16:17:52'),
(11, 1, 'General / Email settings updated', '117.212.246.18', 1, '2016-08-29 21:29:37', '2016-08-29 21:29:37'),
(12, 10, 'Authentication Info Updated', '115.252.77.8', 1, '2016-08-30 11:50:17', '2016-08-30 11:50:17'),
(13, 4, 'General / Email settings updated', '115.252.77.8', 1, '2016-08-30 12:16:55', '2016-08-30 12:16:55'),
(14, 1, 'General / Email settings updated', '117.196.184.36', 1, '2016-08-30 20:56:19', '2016-08-30 20:56:19'),
(15, 1, 'General / Email settings updated', '117.196.184.36', 1, '2016-08-30 20:57:21', '2016-08-30 20:57:21'),
(16, 1, 'General / Email settings updated', '59.97.105.115', 1, '2016-08-31 17:56:55', '2016-08-31 17:56:55'),
(17, 1, 'Authentication Info Updated', '59.97.105.115', 0, '2016-08-31 18:01:25', '2016-08-31 18:01:25'),
(18, 3, 'Authentication Info Updated', '59.90.161.56', 1, '2016-09-01 11:51:40', '2016-09-01 11:51:40'),
(19, 3, 'Authentication Info Updated', '115.252.77.8', 1, '2016-09-01 11:56:09', '2016-09-01 11:56:09'),
(20, 10, 'Authentication Info Updated', '115.252.77.8', 0, '2016-09-01 11:59:41', '2016-09-01 11:59:41'),
(21, 10, 'Authentication Info Updated', '115.252.77.8', 0, '2016-09-01 12:02:21', '2016-09-01 12:02:21'),
(22, 1, 'General / Email settings updated', '117.196.192.45', 1, '2016-09-01 13:10:58', '2016-09-01 13:10:58'),
(23, 5, 'Profile settings updated', '117.248.222.138', 1, '2016-09-01 18:52:13', '2016-09-01 18:52:13'),
(24, 10, 'Authentication Info Updated', '59.90.161.56', 0, '2016-09-02 11:47:37', '2016-09-02 11:47:37'),
(25, 10, 'Authentication Info Updated', '59.90.161.56', 0, '2016-09-02 11:47:49', '2016-09-02 11:47:49'),
(26, 1, 'Authentication Info Updated', '59.97.105.37', 0, '2016-09-02 20:35:13', '2016-09-02 20:35:13'),
(27, 10, 'XCStPm5cWSP3NPrRpe44CBdMhqY9PJYNXOZjeCxZKgc', '115.252.77.8', 0, '2016-09-03 11:33:05', '2016-09-03 11:33:05'),
(28, 1, 'General / Email settings updated', '59.93.220.67', 1, '2016-09-03 18:15:44', '2016-09-03 18:15:44'),
(29, NULL, 'D6mc-ZgOyblZEl7jGmZe2gck4OuE9fVuoqXA31v7xU5sGiD7RY-Z6BzjQ36W5LX6UWymNbI6HTBDd1_5jkWbuQ', '103.231.218.166', 0, '2016-09-03 18:21:24', '2016-09-03 18:21:24'),
(30, 11, 'D6mc-ZgOyblZEl7jGmZe2gck4OuE9fVuoqXA31v7xU5sGiD7RY-Z6BzjQ36W5LX6UWymNbI6HTBDd1_5jkWbuQ', '103.231.218.166', 0, '2016-09-03 18:24:06', '2016-09-03 18:24:06'),
(31, NULL, 'evbu7zeDuvbEf6aw5g1zxhJJT_1WGQfOCLxGYLtMYz9eBqWRkWjP_qS2AmCEWRaSJgeOrcbK3ifQMV7RzpHAtw', '103.231.218.166', 0, '2016-09-03 18:51:59', '2016-09-03 18:51:59'),
(32, 12, 'evbu7zeDuvbEf6aw5g1zxhJJT_1WGQfOCLxGYLtMYz9eBqWRkWjP_qS2AmCEWRaSJgeOrcbK3ifQMV7RzpHAtw', '103.231.218.166', 0, '2016-09-03 19:12:36', '2016-09-03 19:12:36'),
(33, NULL, 'm_j3zSk-wKsQnjJTNxoWmnI6R5Te0CQ24v7Pq7bWmaNlubOsn4iMzEnbRgaKNIFq4fx9Q21GTz7ngCt-QDX1aw', '103.231.218.166', 0, '2016-09-03 19:16:52', '2016-09-03 19:16:52'),
(34, 13, 'm_j3zSk-wKsQnjJTNxoWmnI6R5Te0CQ24v7Pq7bWmaNlubOsn4iMzEnbRgaKNIFq4fx9Q21GTz7ngCt-QDX1aw', '103.231.218.166', 0, '2016-09-03 19:18:29', '2016-09-03 19:18:29'),
(35, 1, 'General / Email settings updated', '59.93.220.67', 1, '2016-09-03 21:19:30', '2016-09-03 21:19:30'),
(36, NULL, 'yLoIYZNz_b80bWBeLr5eI9mGKT08SqUD29L_Rox5dK1NQ4AUSmVFuPYZ4LCOIiF2O2mdtK_Jmuh0YGN3t2XymA', '59.93.220.67', 0, '2016-09-03 21:23:25', '2016-09-03 21:23:25'),
(37, NULL, 'uSXbtRrr_iL8LGs66kqWP2EUt8NFfbKgUMKudTUEfwj9EW0qV8aYsa0sxs5qVfRnG-gOhOEN2R8z2oavVUciNg', '59.93.220.67', 0, '2016-09-03 21:27:24', '2016-09-03 21:27:24'),
(38, NULL, 'MA3kbf4OXOjXDBUL0uvDENQG6Bsf6h97VgGbnkmEf-MiHTOZkgsPPM5ee-auvMKqsF_EDQMG_UDc_H34ecCPyg', '59.93.220.67', 0, '2016-09-03 21:29:27', '2016-09-03 21:29:27'),
(39, 1, 'General / Email settings updated', '115.252.77.8', 1, '2016-09-05 12:43:25', '2016-09-05 12:43:25'),
(40, 1, 'General / Email settings updated', '59.90.161.56', 1, '2016-09-05 12:43:46', '2016-09-05 12:43:46'),
(41, 10, 'Profile Info updated for following fields city', '115.252.77.8', 1, '2016-09-05 12:44:51', '2016-09-05 12:44:51'),
(42, 1, 'Social settings updated', '59.90.161.56', 1, '2016-09-05 12:51:42', '2016-09-05 12:51:42'),
(43, 1, 'General / Email settings updated', '59.97.104.21', 1, '2016-09-05 13:38:07', '2016-09-05 13:38:07'),
(44, NULL, 'https://coinsbest.xyz/password/reset/n6Viz4fL2MBtjQQt7a4QAzcRYsbhj4CUf-If4TxOJya-JIQur5E4XBoXECOeN_nWeBze3NB_Tvq5IduvdFRFYQ', '59.90.161.56', 0, '2016-09-05 13:58:07', '2016-09-05 13:58:07'),
(45, 1, 'Profile settings updated', '117.220.227.60', 1, '2016-09-05 14:05:34', '2016-09-05 14:05:34'),
(46, NULL, 'RqBn3-HhGCj2uukMpxOY-mBbNNMvp1nJtpx_ub-Vta0to8gS0eg55Ng_DGahy84kyNzJKyHje2cUv8lJvUoVzA', '59.90.161.56', 0, '2016-09-05 14:09:05', '2016-09-05 14:09:05'),
(47, 1, 'Payment processor updated', '117.220.227.60', 1, '2016-09-05 14:09:14', '2016-09-05 14:09:14'),
(48, NULL, 'GLWYlh-5FZi6ugHTKcyi9LPqltgHkk3R8XUPKeJfhEHTZ-UW8mixLwVbgUfKsMc9cngDqQQOOHEm5IVK1uGglQ', '59.90.161.56', 0, '2016-09-05 14:12:51', '2016-09-05 14:12:51'),
(49, 4, 'New payment processor added', '59.90.161.56', 1, '2016-09-05 14:44:43', '2016-09-05 14:44:43'),
(50, 4, 'Payment processor updated', '59.90.161.56', 1, '2016-09-05 14:47:50', '2016-09-05 14:47:50'),
(51, 4, 'Profile settings updated', '59.90.161.56', 1, '2016-09-05 15:35:34', '2016-09-05 15:35:34'),
(52, 4, 'Profile settings updated', '59.90.161.56', 1, '2016-09-05 15:36:58', '2016-09-05 15:36:58'),
(53, 4, 'Profile settings updated', '59.90.161.56', 1, '2016-09-05 15:41:07', '2016-09-05 15:41:07'),
(54, 4, 'Profile settings updated', '59.90.161.56', 1, '2016-09-05 15:41:59', '2016-09-05 15:41:59'),
(55, 1, 'Profile settings updated', '117.220.227.60', 1, '2016-09-05 18:17:57', '2016-09-05 18:17:57'),
(56, 1, 'Profile settings updated', '117.220.227.60', 1, '2016-09-05 18:18:18', '2016-09-05 18:18:18'),
(57, 1, 'New social settings added', '117.220.227.60', 1, '2016-09-05 21:15:28', '2016-09-05 21:15:28'),
(58, 1, 'General / Email settings updated', '59.88.12.149', 1, '2016-09-06 14:32:54', '2016-09-06 14:32:54'),
(59, 1, 'General / Email settings updated', '117.196.188.60', 1, '2016-09-08 15:46:20', '2016-09-08 15:46:20'),
(60, 10, 'Authentication Info Updated', '59.90.161.56', 0, '2016-09-09 11:24:55', '2016-09-09 11:24:55'),
(61, 1, 'General / Email settings updated', '115.252.77.8', 1, '2016-09-09 11:53:13', '2016-09-09 11:53:13'),
(62, 1, 'General / Email settings updated', '115.252.77.8', 1, '2016-09-09 11:53:33', '2016-09-09 11:53:33'),
(63, 1, 'Profile settings updated', '115.252.77.8', 1, '2016-09-09 11:54:11', '2016-09-09 11:54:11'),
(64, 20, 'lMvgnFdB7uK3QuDa_eerG7H5UUo2C20t6lxn--x57V4', '115.252.77.8', 0, '2016-09-09 12:43:50', '2016-09-09 12:43:50'),
(65, NULL, 'Password reset requested.', '59.90.161.56', 0, '2016-09-09 12:57:22', '2016-09-09 12:57:22'),
(66, 1, 'Payment method deleted', '59.90.161.56', 1, '2016-09-09 13:07:27', '2016-09-09 13:07:27'),
(67, 4, 'Profile settings updated', '59.90.161.56', 1, '2016-09-09 13:25:09', '2016-09-09 13:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(10) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_ip` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `ip_restricted` tinyint(1) NOT NULL DEFAULT '0',
  `google2fa` tinyint(1) NOT NULL DEFAULT '0',
  `emailotp` tinyint(1) NOT NULL DEFAULT '0',
  `google2fakey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `is_main`, `name`, `email`, `password`, `department_id`, `last_login`, `last_login_ip`, `verified`, `ip_restricted`, `google2fa`, `emailotp`, `google2fakey`, `otp`, `token`, `password_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', 'testmember@test.com', '$2y$10$UOX45CMePLbHtAh1bERfMejLPLw7hQgFJOhrn1oCpXo01R5JoaG0i', 0, '2016-08-29 14:28:59', '127.0.0.1', 1, 0, 0, 0, 'VMENE66IBLEJIAKD', 0, NULL, NULL, 'ZP7fVhAwTE3aD2VoLMJ4Wnm8qEIeC6FfgE4wW1gzWKsQMYRKHGWczOIxNODc', '2016-08-20 12:09:14', '2016-11-01 01:33:11'),
(2, 0, 'Shoaib', 'shoaib@test.com', '$2y$10$8FaWITSGXlX13ltz9wtX9u42VyNScA5IRR/jogzm5GnvOqLTXO2sq', 5, '2016-11-04 22:51:38', '', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2016-11-04 17:21:38', '2016-11-04 18:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'Attribute1', '2016-11-04 13:24:32', NULL, '2016-11-04 13:24:32'),
(2, 'Attribute2', '2016-11-04 13:24:36', NULL, '2016-11-04 13:24:36'),
(3, 'Attribute3', '2016-11-04 18:54:58', NULL, '2016-11-04 13:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Category1', 0, NULL, '2016-07-28 08:38:27', '2016-07-28 08:38:27'),
(6, ' TESTCAtegory SSS', 1, '2016-07-23 07:10:31', '2016-08-13 12:26:22', '2016-08-13 12:26:22'),
(8, 'New Category 1111', 0, '2016-07-28 08:20:50', '2016-07-28 08:48:06', NULL),
(9, ' TESTCAtegory', 0, '2016-07-28 08:54:48', '2016-08-06 05:34:47', '2016-08-06 05:34:47'),
(10, ' New Category', 0, '2016-07-28 08:55:43', '2016-11-04 11:13:19', '2016-07-28 09:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Albania', 'AL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Algeria', 'DZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'American Samoa', 'DS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Andorra', 'AD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Angola', 'AO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Anguilla', 'AI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Antarctica', 'AQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antigua and Barbuda', 'AG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Argentina', 'AR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Armenia', 'AM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Aruba', 'AW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Australia', 'AU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Austria', 'AT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Azerbaijan', 'AZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Bahamas', 'BS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahrain', 'BH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bangladesh', 'BD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Barbados', 'BB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Belarus', 'BY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belgium', 'BE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belize', 'BZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Benin', 'BJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Bermuda', 'BM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bhutan', 'BT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bolivia', 'BO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bosnia and Herzegovina', 'BA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Botswana', 'BW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bouvet Island', 'BV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Brazil', 'BR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'British Indian Ocean Territory', 'IO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brunei Darussalam', 'BN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Bulgaria', 'BG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Burkina Faso', 'BF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Burundi', 'BI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Cambodia', 'KH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Cameroon', 'CM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Canada', 'CA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cape Verde', 'CV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cayman Islands', 'KY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Central African Republic', 'CF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Chad', 'TD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Chile', 'CL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'China', 'CN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Christmas Island', 'CX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Cocos (Keeling) Islands', 'CC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Colombia', 'CO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Comoros', 'KM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Congo', 'CG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Cook Islands', 'CK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Costa Rica', 'CR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Croatia (Hrvatska)', 'HR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cuba', 'CU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Cyprus', 'CY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Czech Republic', 'CZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Denmark', 'DK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Djibouti', 'DJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Dominica', 'DM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Dominican Republic', 'DO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'East Timor', 'TP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Ecuador', 'EC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Egypt', 'EG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'El Salvador', 'SV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Equatorial Guinea', 'GQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Eritrea', 'ER', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Estonia', 'EE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Ethiopia', 'ET', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Falkland Islands (Malvinas)', 'FK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Faroe Islands', 'FO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Fiji', 'FJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Finland', 'FI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'France', 'FR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'France, Metropolitan', 'FX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'French Guiana', 'GF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'French Polynesia', 'PF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'French Southern Territories', 'TF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Gabon', 'GA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Gambia', 'GM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Georgia', 'GE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Germany', 'DE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Ghana', 'GH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Gibraltar', 'GI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Guernsey', 'GK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Greece', 'GR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Greenland', 'GL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Grenada', 'GD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Guadeloupe', 'GP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Guam', 'GU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guatemala', 'GT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guinea', 'GN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guinea-Bissau', 'GW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Guyana', 'GY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Haiti', 'HT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Heard and Mc Donald Islands', 'HM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Honduras', 'HN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Hong Kong', 'HK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Hungary', 'HU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Iceland', 'IS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'India', 'IN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Isle of Man', 'IM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Indonesia', 'ID', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Iran (Islamic Republic of)', 'IR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Iraq', 'IQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Ireland', 'IE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Israel', 'IL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Italy', 'IT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Ivory Coast', 'CI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Jersey', 'JE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Jamaica', 'JM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Japan', 'JP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Jordan', 'JO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Kazakhstan', 'KZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Kenya', 'KE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Kiribati', 'KI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Korea, Democratic People''s Republic of', 'KP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Korea, Republic of', 'KR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Kosovo', 'XK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Kuwait', 'KW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Kyrgyzstan', 'KG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Lao People''s Democratic Republic', 'LA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Latvia', 'LV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Lebanon', 'LB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Lesotho', 'LS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Liberia', 'LR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Libyan Arab Jamahiriya', 'LY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Liechtenstein', 'LI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Lithuania', 'LT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Luxembourg', 'LU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Macau', 'MO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Macedonia', 'MK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Madagascar', 'MG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Malawi', 'MW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Malaysia', 'MY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Maldives', 'MV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Mali', 'ML', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Malta', 'MT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Marshall Islands', 'MH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Martinique', 'MQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Mauritania', 'MR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Mauritius', 'MU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Mayotte', 'TY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Mexico', 'MX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Micronesia, Federated States of', 'FM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Moldova, Republic of', 'MD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Monaco', 'MC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Mongolia', 'MN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Montenegro', 'ME', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Montserrat', 'MS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Morocco', 'MA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Mozambique', 'MZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Myanmar', 'MM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Namibia', 'NA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Nauru', 'NR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Nepal', 'NP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Netherlands', 'NL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Netherlands Antilles', 'AN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'New Caledonia', 'NC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'New Zealand', 'NZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'Nicaragua', 'NI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Niger', 'NE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Nigeria', 'NG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Niue', 'NU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Norfolk Island', 'NF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Northern Mariana Islands', 'MP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Norway', 'NO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Oman', 'OM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Pakistan', 'PK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Palau', 'PW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Palestine', 'PS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Panama', 'PA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Papua New Guinea', 'PG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Paraguay', 'PY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Peru', 'PE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Philippines', 'PH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Pitcairn', 'PN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Poland', 'PL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Portugal', 'PT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Puerto Rico', 'PR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Qatar', 'QA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Reunion', 'RE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Romania', 'RO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Russian Federation', 'RU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Rwanda', 'RW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Saint Kitts and Nevis', 'KN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Saint Lucia', 'LC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Saint Vincent and the Grenadines', 'VC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Samoa', 'WS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'San Marino', 'SM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Sao Tome and Principe', 'ST', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Saudi Arabia', 'SA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Senegal', 'SN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Serbia', 'RS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Seychelles', 'SC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Sierra Leone', 'SL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Singapore', 'SG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Slovakia', 'SK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Slovenia', 'SI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Solomon Islands', 'SB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Somalia', 'SO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'South Africa', 'ZA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'South Georgia South Sandwich Islands', 'GS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Spain', 'ES', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Sri Lanka', 'LK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'St. Helena', 'SH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'St. Pierre and Miquelon', 'PM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Sudan', 'SD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Suriname', 'SR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Svalbard and Jan Mayen Islands', 'SJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Swaziland', 'SZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Sweden', 'SE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Switzerland', 'CH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Syrian Arab Republic', 'SY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Taiwan', 'TW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Tajikistan', 'TJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Tanzania, United Republic of', 'TZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Thailand', 'TH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Togo', 'TG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Tokelau', 'TK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Tonga', 'TO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Trinidad and Tobago', 'TT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Tunisia', 'TN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Turkey', 'TR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Turkmenistan', 'TM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'Turks and Caicos Islands', 'TC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'Tuvalu', 'TV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'Uganda', 'UG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'Ukraine', 'UA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'United Arab Emirates', 'AE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'United Kingdom', 'GB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'United States', 'US', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'United States minor outlying islands', 'UM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Uruguay', 'UY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Uzbekistan', 'UZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'Vanuatu', 'VU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'Vatican City State', 'VA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'Venezuela', 'VE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'Vietnam', 'VN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Virgin Islands (British)', 'VG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Virgin Islands (U.S.)', 'VI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'Wallis and Futuna Islands', 'WF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'Western Sahara', 'EH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'Yemen', 'YE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'Yugoslavia', 'YU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'Zaire', 'ZR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'Zambia', 'ZM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'Zimbabwe', 'ZW', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `type`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'department', '', '2016-11-04 17:48:10', NULL, '2016-11-04 17:48:10'),
(2, 'departmentfgfgf', '', '2016-11-04 17:48:25', NULL, '2016-11-04 17:48:25'),
(4, 'vxcbcvb', '', '2016-11-04 18:00:53', NULL, '2016-11-04 18:00:53'),
(5, 'cvbxcv', '', '2016-11-04 18:00:57', NULL, '2016-11-04 18:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(10) UNSIGNED DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emailsettings`
--

CREATE TABLE `emailsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `smtp_server` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emailsettings`
--

INSERT INTO `emailsettings` (`id`, `smtp_server`, `smtp_port`, `smtp_username`, `smtp_password`, `smtp_type`, `created_at`, `updated_at`) VALUES
(1, 'email-smtp.us-west-2.amazonaws.com', '587', '', '', 'TLS', '2016-08-25 11:26:17', '2016-08-27 17:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `title`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Welcome Email', 'Welcome to [SITE_TITLE]!', '<p>Dear [FIRST_NAME] [LAST_NAME],<br /><br />Thanks For Joining [SITE_URL] <br /><br />Your account has been successfully created. You are just one step away to get complete access of your account. <br /><br />Click Here to Verify Your Account: [ACTIVATION_LINK].</p>', '2016-08-31 14:33:58', '2016-08-31 14:33:58'),
(2, 'Sponsor Notification On New Referral Sign Up', 'You''ve Got A New Referral!', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Congratulations!</p>\r\n<p>You Just Got A New Referral to Your Affiliate Account.</p>\r\n<p>Login to Your [SITE_TITLE] Account For More Details.</p>\r\n<p>Good Job!!</p>', '2016-08-31 15:01:19', '2016-08-31 15:01:19'),
(3, 'Mail to Member On Registration/Login With Google or Facebook', 'Welcome to [SITE_TITLE]!', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Thanks For Joining [SITE_URL]&nbsp;</p>\r\n<p>You Have Successfully Logged Into Your Account Using [LOGIN_TYPE]. Without Any Hassles, Now You Can Login to Our Site Any Time With Your [LOGIN_TYPE] Account.</p>\r\n<p>Click Here To Login to Your Account : [LOGIN_URL]</p>', '2016-08-31 15:03:12', '2016-08-31 15:03:12'),
(4, 'Mail to Admin On New Member Registration', 'New User Account Created!', '<p>Hi Admin,&nbsp;</p>\r\n<p>New User Account Has Been Created With The Following Details:</p>\r\n<p>Full Name:- [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Email Address:- [MEMBER_EMAIL]</p>', '2016-08-31 15:04:34', '2016-08-31 15:04:34'),
(5, 'Mail to Member To Resend Account Activation Link', 'Your Activation Link', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>We Have Received a Request to Resend Activation Link For Your [SITE_URL] Account.</p>\r\n<p>Your Account Activation Link is: [ACTIVATION_LINK]</p>\r\n<p>In Case You Have Not Made This Request, Please Create a Support Ticket From Your Account Using This Link:&nbsp;</p>\r\n<p>[SUPPORT_URL]</p>', '2016-08-31 15:06:12', '2016-08-31 15:06:12'),
(6, 'Forgot Password Reset Link', 'Forgot Password Request', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>We Have Received a Forgot Password Request From The IP [MEMBER_IP] For Your [SITE_URL] Account. Your Login Details Are Mentioned Below.</p>\r\n<p>User Name &nbsp; &nbsp; : [MEMBER_EMAIL]</p>\r\n<p>Password Reset Link : [PASSWORD_LINK]</p>\r\n<p>In Case You Have Not Made This Request, Please Create a Support Ticket From Your Account</p>\r\n<p>Using This Link: [SUPPORT_URL]</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:07:40', '2016-08-31 15:07:40'),
(7, 'Password Changed For Member', 'Password Changed', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your password is updated For Your [SITE_URL] Account. Your Login Details Are Mentioned Below.</p>\r\n<p>User Name : [MEMBER_EMAIL]</p>\r\n<p>Login Link &nbsp;: [LOGIN_URL]</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:08:53', '2016-08-31 15:08:53'),
(8, 'Mail to Member While Member Set IP Restriction', 'IP Restriction!', '<p>Hello [FIRST_NAME] [LAST_NAME],</p>\r\n<p>You Have Just Enabled IP Restriction.</p>\r\n<p>Your Current IP Address - [MEMBER_IP] Has Been Verified.</p>\r\n<p>For Now, You Can Login With This IP Address Only. For Others, You Will Need To Confirm Them First To Login Using Them.</p>\r\n<p>Stay Secured.</p>', '2016-08-31 15:10:09', '2016-08-31 15:10:09'),
(9, 'Member IP Address Verification Mail', ' Verify Your IP Address', '<p>Hello [FIRST_NAME] [LAST_NAME],</p>\r\n<p>IP Restriction Has Been Enabled By You.</p>\r\n<p>You Have Tried To Login With This IP Address Recently - [MEMBER_IP]</p>\r\n<p>You Need To Verify This IP Address To Be Able To Login.</p>\r\n<p>Click Below Link To Verify This IP Address.</p>\r\n<p>[IP_ACTIVATION_LINK]</p>\r\n<p>Stay Secured.</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:11:32', '2016-08-31 15:11:32'),
(10, 'Member Login Email OTP', 'Email OTP for [SITE_URL]', '<p>Hello [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your Email OTP : [LOGIN_OTP]</p>', '2016-08-31 15:13:14', '2016-08-31 15:13:14'),
(11, 'Member Notification On New Support Ticket Creation', 'New Support Ticket Created', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Domain : [MEMBER_DOMAIN]</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject: [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>We Have Received a Support Ticket Created by You With The Above Subject.&nbsp;</p>\r\n<p>We Will Check Your Query/Issue And Get Back to You Soon.</p>', '2016-08-31 15:14:36', '2016-08-31 15:14:36'),
(12, 'Admin Notification On New Support Ticket Creation', 'New Support Ticket Created', '<p>Hi Admin,</p>\r\n<p>Below User Has Created a New Support Ticket With The Below Subject:</p>\r\n<p>User Name : [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Domain : [MEMBER_DOMAIN]</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject : [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Message : [SUPPORT_TICKET_MESSAGE]</p>\r\n<p>Please Login to Your Account to View The Details of The Ticket.</p>', '2016-08-31 15:15:57', '2016-08-31 15:15:57'),
(13, 'Mail to Member When Admin Creates a Ticket', '[SUPPORT_TICKET_SUBJECT]', '<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject : [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Message :</p>\r\n<p>[SUPPORT_TICKET_MESSAGE]</p>\r\n<p>Please do not reply to this mail. A support ticket has been created for you with this message. After logging into your [SITE_TITLE] Account, please visit below link to view the ticket.</p>\r\n<p>[SITE_URL]</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:17:18', '2016-08-31 15:17:18'),
(14, 'Member Notification When Support Ticket Is Updated', 'Support Ticket Updated', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject: [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>We Have Received Updates on The Support Ticket Created by You With The Above Subject.&nbsp;</p>\r\n<p>We Will Check Your Query/Issue And Get Back to You Soon.</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:18:27', '2016-08-31 15:18:27'),
(15, 'Admin Notification When Support Ticket Is Updated', 'Support Ticket Updated', '<p>Hi Admin,</p>\r\n<p>Below User Has Updated The Support Ticket With New Query. Please Login to Your Account to View The Details of The Ticket.</p>\r\n<p>User Name : [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Domain : [MEMBER_DOMAIN]</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject : [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Message : [SUPPORT_TICKET_MESSAGE]</p>\r\n<p>Please Login to Your Account to View The Details of The Ticket.</p>', '2016-08-31 15:20:35', '2016-08-31 15:20:35'),
(16, 'Admin Side - Mail to Member When Support Ticket Updated By Admin', 'Support Ticket Updated', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Subject: [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>You Have Received Updates On The Support Ticket Created By You With The Above Subject. Please Login To Your Account By Using The Link To See The Updates.</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:21:34', '2016-08-31 15:21:34'),
(17, 'Admin Side - Mail to Member When Support Ticket Is Closed By Admin', ' Support Ticket Closed', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Subject: [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Your Support Ticket With The Above Subject Has Been Closed By Admin. Hope We Have Resolved Your Query/Issue.</p>\r\n<p>Please Feel Free to Contact Us In Future For Any Kind of Support.</p>', '2016-08-31 15:23:13', '2016-08-31 15:23:13'),
(18, 'Member Notification When Support Ticket Is Closed', 'Support Ticket Closed', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject: [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Your Support Ticket With The Above Subject Has Been Closed. Hope We Have Resolved Your Issue.</p>\r\n<p>Please Feel Free to Contact Us in Future For Any Kind of Support.</p>\r\n<p>Thank You.</p>', '2016-08-31 15:24:53', '2016-08-31 15:24:53'),
(19, 'Admin Notification When Support Ticket Is Closed', 'Support Ticket Closed', '<p>Hi Admin,</p>\r\n<p>User Name : [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject : [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Above User Has Closed Support Ticket With The Above Subject.</p>', '2016-08-31 15:25:54', '2016-08-31 15:25:54'),
(20, 'Member Notification When Support Ticket Is Re-opened ', 'Support Ticket Re-opened', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject : [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Your Support Ticket With The Above Subject Has Been Re-opened.</p>\r\n<p>We Will Review Your Query And Get Back to You Soon.</p>', '2016-08-31 15:27:14', '2016-08-31 15:27:14'),
(21, 'Admin Notification When Support Ticket Is Re-opened', 'Support Ticket Re-opened', '<p>Hi Admin,</p>\r\n<p>User Name : [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>Subject : [SUPPORT_TICKET_SUBJECT]</p>\r\n<p>Above User Has Re-opened Support Ticket For The Above Subject. Please Login to View The Details of The Ticket.</p>', '2016-08-31 15:29:01', '2016-08-31 15:29:01'),
(22, 'Mail to Department Head For Ticket Transfer', 'Mail to Department Head For Ticket Transfer', '<p>Hello,</p>\r\n<p>New Ticket has been transferred to you.&nbsp;</p>\r\n<p>Login and Check The Ticket.</p>\r\n<p>Ticket ID: [SUPPORT_TICKET_ID]</p>', '2016-08-31 15:30:10', '2016-08-31 17:38:13'),
(23, 'Mail to Member For Ticket Transfer to Other Department', 'Ticket Transferred to Another Department', '<p>&nbsp;</p>\r\n<p>Hello [FIRSTNAME] [LASTNAME]</p>\r\n<p>Your Ticket has been transferred to [DEPARTMENT] department.</p>\r\n<p>Ticket ID : [SUPPORT_TICKET_ID]</p>\r\n<p>&nbsp;</p>', '2016-08-31 15:31:42', '2016-08-31 15:31:42'),
(24, 'Mail to Member After New order placed', 'Order has been placed by you', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Order Details &nbsp;: [ORDER_DETAILS]</p>\r\n<p>Processor : [PROCESSOR_NAME]</p>\r\n<p>Transaction No : [TRANSACTION_NUMBER]</p>\r\n<p>Order ID &nbsp;: [ORDER_ID]</p>\r\n<p>Amount &nbsp; &nbsp;: [AMOUNT]</p>\r\n<p>Currently, Your Order Is Pending With Us.</p>\r\n<p>Note: Once Your Order Is Approved, You Can Download Your Product Anytime From The Download Area by Logging Into Your Account</p>', '2016-08-31 15:33:47', '2016-08-31 15:33:47'),
(25, 'Mail to Admin After New Order placed', 'New Sale', '<p>Purchased By :-</p>\r\n<p>Full Name : [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Email ID &nbsp;: [MEMBER_EMAIL]</p>\r\n<p>Order Details &nbsp;: [ORDER_DETAILS]</p>\r\n<p>Processor : [PROCESSOR_NAME]</p>\r\n<p>Transaction No : [TRANSACTION_NUMBER]</p>\r\n<p>Order ID &nbsp;: [ORDER_ID]</p>\r\n<p>Amount &nbsp; &nbsp;: [AMOUNT]</p>\r\n<p>Sponsor : [SPONSER_F_NAME] [SPONSER_L_NAME]</p>', '2016-08-31 15:36:14', '2016-08-31 15:36:14'),
(26, 'Mail to Member When Member Enters Domain After Purchase', 'Order Status - Pending', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Thank You for Entering The Domain For Your [PRODUCT_NAME] Script License.</p>\r\n<p>Your Domain Name: [MEMBER_DOMAIN]</p>\r\n<p>Currently, Your Order Is Pending With Us.</p>\r\n<p>Please Wait For Approval By Our Verification Team. The Process May Take Up to 12 Working Hours(24 Working Hours For Paypal Users).</p>\r\n<p>Note: Sunday is a holiday and is not counted as a Working Day.&nbsp;</p>\r\n<p>You Will Be Notified Once Your Order Is Approved.</p>\r\n<p>Thank You.</p>', '2016-08-31 15:38:21', '2016-08-31 15:38:21'),
(27, 'Mail to Admin When Member Enters Domain After Purchase', 'Paid Member', '<p>Hi Admin,&nbsp;</p>\r\n<p>New Paid Member Details :&nbsp;</p>\r\n<p>Member Full Name:- [FIRST_NAME] [LAST_NAME]</p>\r\n<p>Member''s Email Address:- [MEMBER_EMAIL]</p>\r\n<p>Member''s Domain URL is:- [MEMBER_DOMAIN]</p>\r\n<p>Member''s Sponsor is:- [SPONSER_F_NAME] [SPONSER_L_NAME]</p>', '2016-08-31 15:39:37', '2016-08-31 15:39:37'),
(28, 'Mail to Member when Admin approves ORDER', 'Order Status - Approved', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your order has been approved by our admin. Thank you for your order [ORDER_DETAILS]. We really appreciate your business.&nbsp;</p>', '2016-08-31 15:40:59', '2016-08-31 15:40:59'),
(29, 'Mail to Member on Product/service notification before 15 days of expiration', 'Product/Service expiration notice', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your product is going to expire on [EXPIRY_DATE]</p>\r\n<p>Please Login To [LOGIN_URL]</p>', '2016-08-31 15:42:10', '2016-08-31 15:42:10'),
(30, 'Mail to Member on Account Upgrade', 'Account Upgrade', 'Dear [FIRST_NAME] [LAST_NAME],\r\nYour Account Has Been Upgraded Successfully.\r\nPlease Login To [LOGIN_URL]\r\n', '2016-08-31 15:43:26', '2016-08-31 15:43:26'),
(31, 'New sub admin created', 'Welcome to [SITE_TITLE]!', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your account has been successfully created.&nbsp;</p>\r\n<p>Email : [EMAIL]</p>\r\n<p>Password : [PASSWORD]</p>\r\n<p>Click Here To Login to Your Account : [LOGIN_URL]</p>', '2016-08-31 15:44:31', '2016-08-31 15:44:31'),
(32, 'Forgot Password Reset Link', 'Forgot Password Request', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>We Have Received a Forgot Password Request From The IP [ADMIN_IP] For Your [SITE_URL] Account. Your Login Details Are Mentioned Below.</p>\r\n<p>User Name &nbsp; &nbsp; : [EMAIL]</p>\r\n<p>Password Reset Link : [PASSWORD_LINK]</p>', '2016-08-31 15:53:55', '2016-08-31 15:53:55'),
(33, 'Password Changed For Member', 'Password Changed', '<p>Dear [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your password is updated For Your [SITE_URL] Account. Your Login Details Are Mentioned Below.</p>\r\n<p>User Name : [EMAIL]</p>\r\n<p>Login Link &nbsp;: [LOGIN_URL]</p>', '2016-08-31 15:56:04', '2016-08-31 15:56:04'),
(34, 'Mail to Admin While Admin Set IP Restriction', 'IP Restriction!', '<p>Hello [FIRST_NAME] [LAST_NAME],</p>\r\n<p>You Have Just Enabled IP Restriction.</p>\r\n<p>Your Current IP Address - [ADMIN_IP] Has Been Verified.</p>\r\n<p>For Now, You Can Login With This IP Address Only. For Others, You Will Need To Confirm Them First To Login Using Them.</p>\r\n<p>Stay Secured.</p>', '2016-08-31 15:57:31', '2016-08-31 15:57:31'),
(35, 'Admin IP Address Verification Mail', 'Verify Your IP Address', '<p>Hello [FIRST_NAME] [LAST_NAME],</p>\r\n<p>IP Restriction Has Been Enabled By You.</p>\r\n<p>You Have Tried To Login With This IP Address Recently - [ADMIN_IP]</p>\r\n<p>You Need To Verify This IP Address To Be Able To Login.</p>\r\n<p>&nbsp;</p>\r\n<p>Click Below Link To Verify This IP Address.</p>\r\n<p>&nbsp;</p>\r\n<p>[IP_ACTIVATION_LINK]</p>\r\n<p>&nbsp;</p>\r\n<p>Stay Secured.</p>', '2016-08-31 16:01:25', '2016-09-01 19:09:09'),
(36, 'Admin Login Email OTP', 'Email OTP for [SITE_URL]', '<p>&nbsp;</p>\r\n<p>Hello [FIRST_NAME] [LAST_NAME],</p>\r\n<p>Your Email OTP : [LOGIN_OTP]</p>', '2016-08-31 16:03:15', '2016-08-31 16:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` int(10) UNSIGNED DEFAULT NULL,
  `payment_method` int(10) UNSIGNED DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_07_13_113256_create_products_table', 1),
('2016_07_13_113320_create_categories_table', 1),
('2016_07_13_113341_create_product_images_table', 1),
('2016_07_13_113410_create_cart_table', 1),
('2016_07_13_113424_create_orders_table', 1),
('2016_07_13_113440_create_order_product_table', 1),
('2016_07_13_114513_create_userprofile_table', 1),
('2016_07_13_114547_create_invoice_table', 1),
('2016_07_13_115324_create_paymentmethod_table', 1),
('2016_07_13_115743_create_download_table', 1),
('2016_07_13_120027_create_productversion_table', 1),
('2016_07_26_062508_create_administartor_table', 2),
('2016_07_29_081213_alter_userprofiles_table', 3),
('2016_08_02_091948_create_countries_table', 4),
('2016_08_02_111236_alter_users_table', 5),
('2016_08_04_083504_create_settings_table', 6),
('2016_08_06_131852_create_shoppingcart_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `modpermissions`
--

CREATE TABLE `modpermissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modpermissions`
--

INSERT INTO `modpermissions` (`id`, `admin_id`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 3, 1, '2016-08-20 12:08:36', '2016-08-20 12:08:36'),
(10, 3, 2, '2016-08-20 12:08:36', '2016-08-20 12:08:36'),
(11, 4, 1, '2016-08-20 12:09:15', '2016-08-20 12:09:15'),
(12, 4, 2, '2016-08-20 12:09:15', '2016-08-20 12:09:15'),
(13, 4, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 4, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 4, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 4, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 4, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 5, 1, '2016-09-01 18:13:56', '2016-09-01 18:13:56'),
(20, 5, 2, '2016-09-01 18:13:56', '2016-09-01 18:13:56'),
(21, 5, 3, '2016-09-01 18:13:57', '2016-09-01 18:13:57'),
(22, 5, 4, '2016-09-01 18:13:57', '2016-09-01 18:13:57'),
(23, 5, 5, '2016-09-01 18:13:57', '2016-09-01 18:13:57'),
(24, 5, 6, '2016-09-01 18:13:57', '2016-09-01 18:13:57'),
(25, 5, 7, '2016-09-01 18:13:57', '2016-09-01 18:13:57'),
(26, 5, 8, '2016-09-01 18:13:57', '2016-09-01 18:13:57'),
(27, 2, 1, '2016-11-04 17:21:38', '2016-11-04 17:21:38'),
(28, 2, 3, '2016-11-04 17:21:38', '2016-11-04 17:21:38'),
(29, 2, 7, '2016-11-04 17:21:38', '2016-11-04 17:21:38'),
(30, 2, 8, '2016-11-04 17:21:38', '2016-11-04 17:21:38'),
(31, 2, 2, '2016-11-04 17:22:04', '2016-11-04 17:22:04'),
(32, 2, 4, '2016-11-04 17:54:06', '2016-11-04 17:54:06'),
(33, 2, 5, '2016-11-04 17:54:06', '2016-11-04 17:54:06'),
(34, 2, 6, '2016-11-04 17:54:06', '2016-11-04 17:54:06'),
(35, 4, 1, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(36, 4, 2, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(37, 4, 3, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(38, 4, 4, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(39, 4, 5, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(40, 4, 6, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(41, 4, 7, '2016-11-04 18:16:04', '2016-11-04 18:16:04'),
(42, 4, 8, '2016-11-04 18:16:04', '2016-11-04 18:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Categories', 'categories', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Product', 'products', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Order', 'orders', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Invoice', 'invoices', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Members', 'members', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Affiliate', 'affiliate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Support', 'support', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Settings', 'settings', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `moduleversions`
--

CREATE TABLE `moduleversions` (
  `id` int(10) UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_current` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `version_id` int(10) UNSIGNED DEFAULT NULL,
  `module_version_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(10,4) UNSIGNED NOT NULL,
  `reduced_price` decimal(10,4) UNSIGNED NOT NULL,
  `total` decimal(10,4) UNSIGNED NOT NULL,
  `total_reduced` decimal(10,4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_no` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_items` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_qty` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `total` decimal(10,4) NOT NULL,
  `fixed_charges` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `percentage_charges` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage_fee` float(7,2) NOT NULL,
  `fixed_fee` float(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`id`, `name`, `client_id`, `client_secret`, `percentage_fee`, `fixed_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Aa6JvTwB3YEtEfI6TxWYJaluJlsI2fSLPO3y7AvtssJebILNaSrWWdBXPOVqTstHrUpM9RnPxU9j_jQU', 'EE5sngSFuGE-MgjEscJqfncoaGAlDBh1rZTCRsMMLXSOqZFV6Jx3cpQnJCHGN00W7yUFVDSnj4bQpEuw', 7.00, 0.50, 1, '2016-08-22 01:30:00', '2016-08-22 01:30:00'),
(2, 'paypal2', 'Aa6JvTwB3YEtEfI6TxWYJaluJlsI2fSLPO3y7AvtssJebILNaSrWWdBXPOVqTstHrUpM9RnPxU9j_jQU', 'EE5sngSFuGE-MgjEscJqfncoaGAlDBh1rZTCRsMMLXSOqZFV6Jx3cpQnJCHGN00W7yUFVDSnj4bQpEuw', 8.00, 0.50, 1, '2016-08-22 01:30:00', '2016-09-05 14:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `productdomains`
--

CREATE TABLE `productdomains` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productmodules`
--

CREATE TABLE `productmodules` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `module_title` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `domain` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(10) UNSIGNED DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,4) UNSIGNED NOT NULL,
  `reduced_price` decimal(10,4) UNSIGNED DEFAULT NULL,
  `categories_id` int(10) UNSIGNED DEFAULT NULL,
  `version_id` int(10) UNSIGNED DEFAULT NULL,
  `expiry` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `commission` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_spec` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `qty`, `sku`, `price`, `reduced_price`, `categories_id`, `version_id`, `expiry`, `description`, `features`, `commission`, `image`, `product_spec`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Product A', 0, '', '120.0000', NULL, 1, 0, 2, 'Product A', 'Product A', '20', '1472478055-$_32.JPG', NULL, '2016-08-29 20:40:55', '2016-08-29 20:40:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productservices`
--

CREATE TABLE `productservices` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `service_title` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `domain` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productversions`
--

CREATE TABLE `productversions` (
  `id` int(10) UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `publish_date` timestamp NULL DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectimages`
--

CREATE TABLE `projectimages` (
  `id` int(11) NOT NULL,
  `project_id` int(10) NOT NULL,
  `image` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(155) NOT NULL,
  `company_name` varchar(155) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(20) NOT NULL,
  `website` varchar(155) NOT NULL,
  `email` varchar(155) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `category_id` int(10) NOT NULL,
  `featured_image` varchar(155) NOT NULL,
  `brochure_link` varchar(155) NOT NULL,
  `project_thumb` varchar(155) NOT NULL,
  `is_privacy_checked` tinyint(1) NOT NULL,
  `premium_service` varchar(75) NOT NULL,
  `no_of_layouts` varchar(10) NOT NULL,
  `layout_id` int(10) NOT NULL,
  `theme_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `company_name`, `description`, `location`, `website`, `email`, `phone`, `category_id`, `featured_image`, `brochure_link`, `project_thumb`, `is_privacy_checked`, `premium_service`, `no_of_layouts`, `layout_id`, `theme_id`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'bkjk', 'kjhkjhkjh', 'kjhkjhkljh', 'kjhkjh', 'kjhkjh', 'jkhkjhkj', 'kjhkjhkj', 2, 'kjhk', 'gdfgdf', 'dfgdfg', 1, 'dfgdfgd', 'jkghjhg', 4, 1, '2016-11-04 22:45:48', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projectthemes`
--

CREATE TABLE `projectthemes` (
  `id` int(11) NOT NULL,
  `theme_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_title` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_on` tinyint(1) NOT NULL DEFAULT '0',
  `use_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `g2fa` tinyint(1) NOT NULL DEFAULT '0',
  `google2fakey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mailsignature` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `smtp_on`, `use_ssl`, `g2fa`, `google2fakey`, `admin_email`, `from_name`, `from_email`, `mailsignature`, `created_at`, `updated_at`) VALUES
(1, 'Demo Website', 0, 0, 0, 'GO7OG2IO73WDHNUE', 'deepak2210@gmail.com', 'Support', 'no-reply@domainname.com', '<p>To Your Success,</p>\r\n<p> </p>\r\n<p>Team</p>\r\n<p>[SITE_TITLE]</p>\r\n<p>-------------------------------------------------------------------------------------------------------</p>\r\n<p>This Is NOT SPAM.</p>\r\n<p>This Message Was Sent by [SITE_URL]. </p>\r\n<p>You Received This Message Because You Are a Registered Member of [SITE_URL].</p>\r\n<p>To Stop Receiving Emails From [SITE_URL], Please Login to The Site And Delete Your Account.([SITE_URL])</p>\r\n<p>-------------------------------------------------------------------------------------------------------</p>', '0000-00-00 00:00:00', '2016-09-09 11:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `instance` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socialsettings`
--

CREATE TABLE `socialsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialsettings`
--

INSERT INTO `socialsettings` (`id`, `provider`, `client_id`, `client_secret`, `redirect`, `created_at`, `updated_at`) VALUES
(1, 'google', '352499832855-fm9vt1buivbl280p47bnlfc83fvn315g.apps.googleusercontent.com', 's5XuXBkSpQ9j7pwUEeVDUveq', 'http://coinsbest.xyz/account/google', '2016-08-21 15:58:11', '2016-08-21 15:58:11'),
(2, 'facebook', '1767128363500842', 'c777a61e2aca2b752643ad93cefe32e9', 'http://coinsbest.xyz/account/facebook', '2016-08-21 15:58:55', '2016-08-21 15:58:55'),
(3, 'dsddasd', 'asdasd', 'asdasd', 'asdasd', '2016-09-05 21:15:28', '2016-09-05 21:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `domain` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `attribute_id` int(10) NOT NULL,
  `name` varchar(155) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `attribute_id`, `name`, `image`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 1, 'Theme1', '', '2016-11-04 13:26:40', NULL, '2016-11-04 13:26:40'),
(2, 2, 'Theme2', '1478295951-Jellyfish.jpg', '2016-11-04 21:45:51', NULL, '2016-11-04 16:15:51'),
(3, 3, 'Theme3', '', '2016-11-04 22:23:12', NULL, '2016-11-04 16:53:12'),
(4, 3, 'Theme33', '1478295738-Hydrangeas.jpg', '2016-11-04 16:12:18', NULL, '2016-11-04 16:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `ticketresponses`
--

CREATE TABLE `ticketresponses` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(15) UNSIGNED DEFAULT NULL,
  `response_from` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `automated_response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file3` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file4` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(15) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `department` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpanel_url` text COLLATE utf8mb4_unicode_ci,
  `cpanel_username` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpanel_password` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_url` text COLLATE utf8mb4_unicode_ci,
  `admin_username` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_password` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ftp_host` text COLLATE utf8mb4_unicode_ci,
  `ftp_username` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ftp_password` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otherdetails` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_agreed` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remarks` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdownloads`
--

CREATE TABLE `userdownloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL,
  `expiry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_downloadable` tinyint(1) NOT NULL,
  `license_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userdownloads`
--

INSERT INTO `userdownloads` (`id`, `user_id`, `order_id`, `product_id`, `module_id`, `expiry_date`, `is_downloadable`, `license_key`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, '2016-08-29 14:13:57', 1, '1234567890', '2016-08-29 21:12:41', '2016-08-29 21:13:57'),
(2, 1, 1, 0, 1, '2016-08-29 14:25:56', 1, '12322132332', '2016-08-29 21:12:41', '2016-08-29 21:25:56'),
(3, 10, 2, 1, 0, '0000-00-00 00:00:00', 0, '', '2016-08-30 11:51:43', '2016-08-30 11:51:43'),
(4, 10, 2, 0, 1, '0000-00-00 00:00:00', 0, '', '2016-08-30 11:51:43', '2016-08-30 11:51:43'),
(5, 3, 3, 1, 0, '0000-00-00 00:00:00', 0, '', '2016-08-31 11:48:54', '2016-08-31 11:48:54'),
(6, 10, 4, 2, 0, '0000-00-00 00:00:00', 0, '', '2016-09-01 13:38:11', '2016-09-01 13:38:11'),
(7, 10, 5, 2, 0, '0000-00-00 00:00:00', 0, '', '2016-09-01 13:43:36', '2016-09-01 13:43:36'),
(8, 10, 6, 2, 0, '0000-00-00 00:00:00', 0, '', '2016-09-01 14:03:13', '2016-09-01 14:03:13'),
(9, 10, 7, 1, 0, '2016-09-01 11:13:29', 1, '14562321', '2016-09-01 17:11:20', '2016-09-01 18:13:29'),
(10, 10, 7, 0, 1, '0000-00-00 00:00:00', 0, '', '2016-09-01 17:11:20', '2016-09-01 17:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `userips`
--

CREATE TABLE `userips` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) UNSIGNED NOT NULL,
  `ip_address` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userips`
--

INSERT INTO `userips` (`id`, `user_id`, `is_admin`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '59.97.105.110', '2016-08-31 18:26:12', '2016-08-31 18:26:12'),
(2, 1, 0, '59.97.105.115\0\0\0\0\0\0\0', '2016-08-31 19:15:20', '2016-08-31 19:15:20'),
(6, 10, 0, '59.90.161.56', '2016-09-01 12:14:01', '2016-09-01 12:14:01'),
(7, 10, 0, '115.252.77.8\0\0\0\0\0\0\0\0', '2016-09-01 12:14:49', '2016-09-01 12:14:49'),
(8, 5, 1, '117.248.222.138', '2016-09-01 18:52:13', '2016-09-01 18:52:13'),
(9, 5, 1, '103.231.218.166\0\0\0\0\0', '2016-09-01 19:09:23', '2016-09-01 19:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `userpaymentprocessors`
--

CREATE TABLE `userpaymentprocessors` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_method` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `processor_id` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `country` int(10) UNSIGNED DEFAULT NULL,
  `affiliate_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(10,4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `user_id`, `country`, `affiliate_id`, `created_at`, `updated_at`, `phone`, `address`, `city`, `state`, `zip`, `balance`) VALUES
(1, 2, 99, 0, '2016-08-04 02:34:11', '2016-08-04 02:34:11', '9425050403', '461,Raja Ram Nagar', 'Dewas', 'MADHYA PRADESH', '455001', '0.0000'),
(2, 1, 99, 0, '2016-08-04 05:26:37', '2016-08-09 00:33:01', '9425050403', 'rajaram nagar', 'dewas', 'Madhya Pradesh', '455001', '0.0000'),
(3, 4, 99, 0, '2016-08-04 05:27:54', '2016-08-04 05:27:54', '1111111111', 'Dewas', 'Dewas', 'Madhya Pradesh', '455001', '0.0000'),
(7, 10, 99, 0, '2016-08-29 16:17:52', '2016-09-05 12:44:51', '', '', 'Rajkot', '', '', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_ip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `ip_restricted` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `googleid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebookid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_processor_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `google2fa` tinyint(1) NOT NULL,
  `emailotp` tinyint(1) NOT NULL,
  `google2fakey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `administartors_email_unique` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailsettings`
--
ALTER TABLE `emailsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modpermissions`
--
ALTER TABLE `modpermissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduleversions`
--
ALTER TABLE `moduleversions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`(191)),
  ADD KEY `password_resets_token_index` (`token`(191));

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productdomains`
--
ALTER TABLE `productdomains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productmodules`
--
ALTER TABLE `productmodules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`categories_id`);

--
-- Indexes for table `productservices`
--
ALTER TABLE `productservices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productversions`
--
ALTER TABLE `productversions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `projectimages`
--
ALTER TABLE `projectimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectthemes`
--
ALTER TABLE `projectthemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `socialsettings`
--
ALTER TABLE `socialsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketresponses`
--
ALTER TABLE `ticketresponses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdownloads`
--
ALTER TABLE `userdownloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userips`
--
ALTER TABLE `userips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpaymentprocessors`
--
ALTER TABLE `userpaymentprocessors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userprofile_user` (`user_id`),
  ADD KEY `profile_country` (`country`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emailsettings`
--
ALTER TABLE `emailsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `layouts`
--
ALTER TABLE `layouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modpermissions`
--
ALTER TABLE `modpermissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `moduleversions`
--
ALTER TABLE `moduleversions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `productdomains`
--
ALTER TABLE `productdomains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productmodules`
--
ALTER TABLE `productmodules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productservices`
--
ALTER TABLE `productservices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productversions`
--
ALTER TABLE `productversions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projectimages`
--
ALTER TABLE `projectimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projectthemes`
--
ALTER TABLE `projectthemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `socialsettings`
--
ALTER TABLE `socialsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ticketresponses`
--
ALTER TABLE `ticketresponses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userdownloads`
--
ALTER TABLE `userdownloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `userips`
--
ALTER TABLE `userips`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `userpaymentprocessors`
--
ALTER TABLE `userpaymentprocessors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
