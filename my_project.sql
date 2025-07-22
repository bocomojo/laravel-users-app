-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2025 at 11:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonded_officials`
--

CREATE TABLE `bonded_officials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sdo_id` bigint(20) UNSIGNED NOT NULL,
  `bond_status` varchar(255) DEFAULT NULL,
  `approved_bond_amount` decimal(15,2) DEFAULT NULL,
  `max_cash` decimal(15,2) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `aging` int(11) DEFAULT NULL,
  `unliquidated_amount` decimal(15,2) DEFAULT NULL,
  `date_received_accounting` date DEFAULT NULL,
  `date_complied` date DEFAULT NULL,
  `compliance_date_returned` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bond_file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonded_officials`
--

INSERT INTO `bonded_officials` (`id`, `sdo_id`, `bond_status`, `approved_bond_amount`, `max_cash`, `effective_date`, `expiration_date`, `aging`, `unliquidated_amount`, `date_received_accounting`, `date_complied`, `compliance_date_returned`, `created_at`, `updated_at`, `bond_file_path`) VALUES
(1, 48, 'With SO', 300000.00, 25000000.00, '2025-07-20', '2026-04-20', NULL, 400000.00, '2025-07-20', '2025-07-20', '2025-07-20', '2025-07-20 05:15:22', '2025-07-20 09:06:06', NULL),
(2, 49, 'With SO', 200000.00, 30000000.00, '2025-07-20', '2025-07-20', NULL, 400000.00, '2025-07-20', '2025-07-20', '2025-07-20', '2025-07-20 05:15:22', '2025-07-20 09:07:08', NULL),
(3, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(4, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(5, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(6, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(7, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(8, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(9, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(10, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(11, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(12, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(13, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(14, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(15, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(16, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(17, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(18, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(19, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(20, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(21, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(22, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(23, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(24, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(25, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(26, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(27, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(28, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(29, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(30, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(31, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(32, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(33, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(34, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(35, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(36, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(37, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(38, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(39, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(40, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(41, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(42, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(43, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(44, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(45, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(46, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(47, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(48, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(49, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(50, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(51, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(52, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(53, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(54, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(55, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(56, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(57, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(58, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(59, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(60, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(61, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(62, 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:22', '2025-07-20 05:15:22', NULL),
(63, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(64, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(65, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(66, 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(67, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(68, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(69, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(70, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(71, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(72, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(73, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(74, 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(75, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(76, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(77, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(78, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(79, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(80, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(81, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(82, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(83, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(84, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(85, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(86, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(87, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(88, 135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(89, 136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(90, 137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(91, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(92, 139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(93, 140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(94, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(95, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(96, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(97, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(98, 145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(99, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(100, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(101, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(102, 149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(103, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(104, 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(105, 152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(106, 153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(107, 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(108, 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(109, 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(110, 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL),
(111, 158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-20 05:15:23', '2025-07-20 05:15:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_advance`
--

CREATE TABLE `cash_advance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sdo_id` bigint(20) UNSIGNED NOT NULL,
  `check_number` varchar(500) NOT NULL,
  `check_date` date DEFAULT NULL,
  `dv_number` varchar(255) DEFAULT NULL,
  `dv_date` date DEFAULT NULL,
  `ors_number` varchar(255) DEFAULT NULL,
  `ors_date` date DEFAULT NULL,
  `particulars` text DEFAULT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `pap` bigint(20) UNSIGNED NOT NULL,
  `granted_amount` decimal(15,2) NOT NULL,
  `payout_start` date DEFAULT NULL,
  `payout_end` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Ongoing',
  `demand_letter_sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payout_attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_advance`
--

INSERT INTO `cash_advance` (`id`, `sdo_id`, `check_number`, `check_date`, `dv_number`, `dv_date`, `ors_number`, `ors_date`, `particulars`, `transaction_type`, `pap`, `granted_amount`, `payout_start`, `payout_end`, `status`, `demand_letter_sent_at`, `created_at`, `updated_at`, `payout_attachment`) VALUES
(188, 156, '9925021307', '1970-01-01', '25-02-02666', '1970-01-01', '25-02-00597', '1970-01-01', 'To attend the PMB Year Starter Planning and Writeshop on February 18-21, 2025 at Savannah Resort Hotel, Angeles City, Pampanga', 'Cash Advance', 37, 11000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2025-07-18 02:51:34', '2025-07-18 02:51:34', NULL),
(189, 154, '2903001', '1970-01-01', '25-02-02906', '1970-01-01', '25-02-00784', '1970-01-01', 'Payment for Financial Assistance to AICS in Provinces of Region V (February 19-March 14, 2025) - Camarines Sur', 'Cash Advance', 37, 5000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2025-07-18 02:51:34', '2025-07-18 02:51:34', NULL),
(190, 157, '2900800', '1970-01-01', '25-02-02905', '1970-01-01', '25-02-00785', '1970-01-01', 'Payment for Financial Assistance to AICS in Provinces of Region V (February 20-March 20, 2025) - Camarines Sur', 'Cash Advance', 37, 15000000.00, '2025-07-16', '2025-07-22', 'Ongoing', NULL, '2025-07-18 02:51:34', '2025-07-18 04:41:20', 'payout_date_required_attachment/YrSYYCco7tlKMlgA4lKi8f2fu59uMmlvMPUGgZ6e.pdf'),
(191, 155, '2900799', '1970-01-01', '25-02-02904', '1970-01-01', '25-02-00786', '1970-01-01', 'Payment for Financial Assistance to AICS in Provinces of Region V (February 26-March 14, 2025) -Albay', 'Cash Advance', 37, 7000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2025-07-18 02:51:34', '2025-07-18 02:51:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compliance_files`
--

CREATE TABLE `compliance_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'email sent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compliance_status`
--

CREATE TABLE `compliance_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `create`
--

CREATE TABLE `create` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sdo_id` bigint(20) UNSIGNED NOT NULL,
  `check_number` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `granted_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liquidated_reports`
--

CREATE TABLE `liquidated_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `liquidation_id` bigint(20) UNSIGNED NOT NULL,
  `cash_advance_id` bigint(20) UNSIGNED NOT NULL,
  `sdo_name` varchar(255) NOT NULL,
  `check_number` varchar(255) NOT NULL,
  `granted_amount` decimal(15,2) NOT NULL,
  `for_liquidation_amount` decimal(15,2) NOT NULL,
  `liquidation_type` varchar(255) NOT NULL,
  `liq_date_received` date NOT NULL,
  `liq_number` varchar(255) DEFAULT NULL,
  `liq_date` date DEFAULT NULL,
  `or_number` varchar(255) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `for_compliance_amount` decimal(15,2) DEFAULT NULL,
  `pre_audited_amount` decimal(15,2) DEFAULT NULL,
  `pre_auditor` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'For Checking',
  `jev_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liquidated_reports`
--

INSERT INTO `liquidated_reports` (`id`, `liquidation_id`, `cash_advance_id`, `sdo_name`, `check_number`, `granted_amount`, `for_liquidation_amount`, `liquidation_type`, `liq_date_received`, `liq_number`, `liq_date`, `or_number`, `or_date`, `for_compliance_amount`, `pre_audited_amount`, `pre_auditor`, `status`, `jev_no`, `created_at`, `updated_at`) VALUES
(40, 3507, 190, 'Paulo Maranan', '2900800', 15000000.00, -712000.00, 'Liquidation', '2025-01-13', 'L-25-02-00025', '2025-07-18', NULL, NULL, 0.00, 712000.00, 'alexis', 'Approved', NULL, '2025-07-18 05:54:06', '2025-07-18 05:54:06'),
(41, 3504, 190, 'Paulo Maranan', '2900800', 15000000.00, -1029000.00, 'Liquidation', '2025-01-13', 'L-25-01-00003', '2025-07-18', NULL, NULL, 20000.00, 1009000.00, 'nicky', 'Approved', NULL, '2025-07-18 06:44:24', '2025-07-18 06:44:24'),
(42, 3505, 190, 'Paulo Maranan', '2900800', 15000000.00, -1913000.00, 'Liquidation', '2025-01-13', 'L-25-01-00004', '2025-07-18', NULL, NULL, 0.00, 1913000.00, 'nicky', 'Approved', NULL, '2025-07-18 06:44:32', '2025-07-18 06:44:32'),
(43, 3506, 190, 'Paulo Maranan', '2900800', 15000000.00, -1917500.00, 'Liquidation', '2025-01-13', 'L-25-01-00005', '2025-07-18', NULL, NULL, 10000.00, 1907500.00, 'bryan', 'Approved', NULL, '2025-07-18 06:44:39', '2025-07-18 06:44:39'),
(44, 3508, 190, 'Paulo Maranan', '2900800', 15000000.00, -1651000.00, 'Liquidation', '2025-01-13', 'L-25-02-00027', '2025-07-18', NULL, NULL, 0.00, 1651000.00, 'roseler', 'Approved', NULL, '2025-07-18 06:44:47', '2025-07-18 06:44:47'),
(45, 3509, 190, 'Paulo Maranan', '2900800', 15000000.00, -1448000.00, 'Liquidation', '2025-01-13', 'L-25-02-00034', '2025-07-19', NULL, NULL, 0.00, 1448000.00, 'nicky', 'Approved', NULL, '2025-07-19 15:55:21', '2025-07-19 15:55:21'),
(46, 3504, 190, 'Paulo Maranan', '2900800', 15000000.00, -1029000.00, 'Liquidation', '2025-01-13', 'L-25-01-00003', '2025-07-20', NULL, NULL, 20000.00, 1009000.00, 'nicky', 'Approved', NULL, '2025-07-19 16:17:02', '2025-07-19 16:17:02'),
(47, 3502, 188, 'Bryan Trinidad', '9925021307', 130745.00, -127354.00, 'Liquidation', '2025-01-13', 'L-OE-25-03-0021', '2025-07-20', NULL, NULL, 0.00, 127354.00, 'bryan', 'Approved', NULL, '2025-07-19 16:49:14', '2025-07-19 16:49:14'),
(48, 3502, 188, 'Bryan Trinidad', '9925021307', 130745.00, -127354.00, 'Liquidation', '2025-01-13', 'L-OE-25-03-0021', '2025-07-20', NULL, NULL, 0.00, 127354.00, 'bryan', 'Approved', NULL, '2025-07-19 18:14:12', '2025-07-19 18:14:12'),
(49, 3499, 191, 'Alexis Bien', '2900799', 21827.00, -9053.00, 'Refund', '2025-01-13', NULL, '2025-07-20', '25-01-00043', '2025-01-14', NULL, 9053.00, '', 'Approved', NULL, '2025-07-19 18:23:27', '2025-07-19 18:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `liquidation`
--

CREATE TABLE `liquidation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cash_advance_id` bigint(20) UNSIGNED NOT NULL,
  `sdo_name` varchar(255) NOT NULL,
  `check_number` varchar(255) NOT NULL,
  `granted_amount` decimal(15,2) NOT NULL,
  `for_liquidation_amount` decimal(15,2) NOT NULL,
  `liquidation_type` varchar(255) NOT NULL,
  `liq_date_received` date DEFAULT NULL,
  `liq_number` varchar(255) DEFAULT NULL,
  `liq_date` date DEFAULT NULL,
  `or_number` varchar(255) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `for_compliance_amount` decimal(15,2) DEFAULT NULL,
  `pre_audited_amount` decimal(15,2) DEFAULT NULL,
  `pre_auditor` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'For Checking',
  `manual_override` tinyint(1) NOT NULL DEFAULT 0,
  `jev_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liquidation`
--

INSERT INTO `liquidation` (`id`, `cash_advance_id`, `sdo_name`, `check_number`, `granted_amount`, `for_liquidation_amount`, `liquidation_type`, `liq_date_received`, `liq_number`, `liq_date`, `or_number`, `or_date`, `for_compliance_amount`, `pre_audited_amount`, `pre_auditor`, `status`, `manual_override`, `jev_no`, `created_at`, `updated_at`) VALUES
(3497, 189, 'Nicky Palero', '2903001', 21627.00, -8532.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00044', '2025-01-14', NULL, 8532.00, '', 'For Approval', 0, NULL, '2025-07-18 03:04:39', '2025-07-19 18:21:06'),
(3498, 189, 'Nicky Palero', '2903001', 21627.00, -13095.00, 'Liquidation', '2025-01-13', 'L-OE-25-02-0005', NULL, NULL, NULL, NULL, -13095.00, 'bryan', 'For Checking', 0, NULL, '2025-07-18 03:04:39', '2025-07-18 03:04:39'),
(3499, 191, 'Alexis Bien', '2900799', 21827.00, -9053.00, 'Refund', '2025-01-13', NULL, '2025-07-20', '25-01-00043', '2025-01-14', NULL, 9053.00, '', 'Draft', 0, NULL, '2025-07-18 03:04:39', '2025-07-19 18:23:35'),
(3500, 191, 'Alexis Bien', '2900799', 21827.00, -12774.00, 'Liquidation', '2025-01-13', 'L-OE-25-02-0007', NULL, NULL, NULL, NULL, -12774.00, 'paulo', 'For Checking', 0, NULL, '2025-07-18 03:04:39', '2025-07-18 03:04:39'),
(3501, 188, 'Bryan Trinidad', '9925021307', 130745.00, -3173.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00050', '2025-01-15', NULL, 3173.00, '', 'Approved', 0, NULL, '2025-07-18 03:04:39', '2025-07-18 03:04:39'),
(3502, 188, 'Bryan Trinidad', '9925021307', 130745.00, -127354.00, 'Liquidation', '2025-01-13', 'L-OE-25-03-0021', '2025-07-20', NULL, NULL, 0.00, 127354.00, 'bryan', 'Approved', 0, '1235', '2025-07-18 03:04:39', '2025-07-22 07:02:31'),
(3503, 188, 'Bryan Trinidad', '9925021307', 130745.00, -218.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00050', '2025-01-15', NULL, 218.00, '', 'Approved', 0, NULL, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(3504, 190, 'Paulo Maranan', '2900800', 15000000.00, -1029000.00, 'Liquidation', '2025-01-13', 'L-25-01-00003', '2025-07-20', NULL, NULL, 20000.00, 1009000.00, 'nicky', 'For Transmittal', 0, '1237', '2025-07-18 03:04:40', '2025-07-22 07:02:37'),
(3505, 190, 'Paulo Maranan', '2900800', 15000000.00, -1913000.00, 'Liquidation', '2025-01-13', 'L-25-01-00004', '2025-07-18', NULL, NULL, 0.00, 1913000.00, 'nicky', 'For Transmittal', 0, '1238', '2025-07-18 03:04:40', '2025-07-22 07:02:37'),
(3506, 190, 'Paulo Maranan', '2900800', 15000000.00, -1917500.00, 'Liquidation', '2025-01-13', 'L-25-01-00005', '2025-07-18', NULL, NULL, 10000.00, 1907500.00, 'bryan', 'For Transmittal', 0, '1239', '2025-07-18 03:04:40', '2025-07-22 07:02:37'),
(3507, 190, 'Paulo Maranan', '2900800', 15000000.00, -712000.00, 'Liquidation', '2025-01-13', 'L-25-02-00025', '2025-07-18', NULL, NULL, 0.00, 712000.00, 'alexis', 'For Transmittal', 0, '1240', '2025-07-18 03:04:40', '2025-07-22 07:02:37'),
(3508, 190, 'Paulo Maranan', '2900800', 15000000.00, -1651000.00, 'Liquidation', '2025-01-13', 'L-25-02-00027', '2025-07-18', NULL, NULL, 0.00, 1651000.00, 'roseler', 'For Transmittal', 0, '1241', '2025-07-18 03:04:40', '2025-07-22 07:02:37'),
(3509, 190, 'Paulo Maranan', '2900800', 15000000.00, -1448000.00, 'Liquidation', '2025-01-13', 'L-25-02-00034', '2025-07-19', NULL, NULL, 0.00, 1448000.00, 'nicky', 'For Approval', 0, NULL, '2025-07-18 03:04:40', '2025-07-19 18:13:21'),
(3510, 190, 'Paulo Maranan', '2900800', 15000000.00, -1182000.00, 'Liquidation', '2025-01-13', 'L-25-02-00035', NULL, NULL, NULL, 0.00, 1182000.00, 'bryan', 'For Approval', 0, NULL, '2025-07-18 03:04:40', '2025-07-18 06:43:56'),
(3511, 190, 'Paulo Maranan', '2900800', 15000000.00, -1141000.00, 'Liquidation', '2025-01-13', 'L-25-02-00068', NULL, NULL, NULL, 0.00, 1141000.00, 'alexis', 'For Approval', 0, NULL, '2025-07-18 03:04:40', '2025-07-18 06:44:16'),
(3512, 190, 'Paulo Maranan', '2900800', 15000000.00, -795500.00, 'Liquidation', '2025-01-13', 'L-25-02-00033', NULL, NULL, NULL, 0.00, 700000.00, 'roseler', 'Processing', 0, NULL, '2025-07-18 03:04:40', '2025-07-18 13:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_01_060310_create_sdo_table', 1),
(5, '2025_05_01_092618_create_compliance_status_table', 1),
(6, '2025_05_07_090206_add_role_to_users_table', 1),
(7, '2025_05_09_084941_create_compliance_files_table', 1),
(9, '2025_05_19_141550_create_cash_advance_table', 2),
(10, '2025_07_02_073459_create_liquidations_table', 3),
(11, '2025_07_02_072121_create_pap_table', 4),
(12, '2025_07_03_073708_create_permission_tables', 5),
(13, '2025_07_06_131027_create_permission_tables', 6),
(14, '2025_07_07_104223_add_payout_columns_to_cash_advance_table', 7),
(15, '2025_07_09_015622_add_demand_letter_sent_at_to_cash_advance_table', 8),
(16, '2025_07_09_073214_add_columns_to_sdo_table', 9),
(17, '2025_07_09_074133_create_bonded_officials_table', 10),
(18, '2025_07_09_0741333_create_bonded_officials_table', 11),
(19, '2025_07_12_060041_add_compliance_and_audit_fields_to_liquidations_table', 12),
(20, '2025_07_12_105206_create_pre_auditors_table', 13),
(21, '2025_07_13_031500_create_pre_auditor_liquidation_table', 14),
(22, '2025_07_13_160620_make_liq_number_and_date_nullable', 15),
(23, '2025_07_14_025455_create_liquidated_reports_table', 16),
(24, '2025_07_14_041835_add_status_to_liquidations_table', 17),
(25, '2025_07_14_061401_add_liquidation_id_to_liquidated_reports_table', 18),
(26, 'add_status_liquidated_reports', 19),
(27, '2025_07_15_014617_make_email_nullable_in_sdo_table', 20),
(28, '2025_07_15_045745_make_liq_date_received_nullable_in_liquidation_table', 21),
(29, '2025_07_15_124904_create_pre_auditor_liquidation_entries_table', 22),
(30, '2025_07_15_151651_add_for_compliance_to_pre_auditor_liquidation_entries_table', 23),
(31, '2025_07_16_024911_change_for_compliance_column_type_in_pre_auditor_liquidation_entries_table', 24),
(32, '2025_07_17_090743_add_manual_override_to_liquidations_table', 25),
(33, '2025_07_18_113049_add_payout_attachment_to_cash_advances_table', 26),
(34, '2025_07_18_114948_create_payout_date_histories_table', 27),
(35, '2025_07_19_225523_create_bonded_officials_table', 28),
(36, '2025_07_20_165705_add_bond_file_path_to_bonded_officials_table', 29),
(37, 'make_liq_number_unique', 30),
(38, '2025_07_22_161102_create_sack_assignment_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pap`
--

CREATE TABLE `pap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pap_name` varchar(255) NOT NULL,
  `pap_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pap`
--

INSERT INTO `pap` (`id`, `pap_name`, `pap_code`, `created_at`, `updated_at`) VALUES
(22, 'SLP', '101010', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(23, 'KALAHI', '101012', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(24, 'PANTAWID', '101016', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(25, 'REGULAR', '101017', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(26, 'ESA', '101022', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(27, 'SOCPEN', '101029', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(28, 'DISASTER', '101045', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(29, 'EAICS', '101066', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(30, 'NHTS', '101111', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(31, 'CENTERS', '101208', '2025-07-14 06:15:09', '2025-07-14 06:15:09'),
(32, 'VARIOUS', '101402', '2025-07-14 06:15:10', '2025-07-14 06:15:10'),
(33, 'SOCTECH', '101633', '2025-07-14 06:15:10', '2025-07-14 06:15:10'),
(34, 'UCT', '102043', '2025-07-14 06:15:10', '2025-07-14 06:15:10'),
(35, 'SFP', '102336', '2025-07-14 06:15:10', '2025-07-14 06:15:10'),
(36, 'ICTMS', '102359', '2025-07-14 06:15:10', '2025-07-14 06:15:10'),
(37, 'AICS', '102553', '2025-07-14 06:15:11', '2025-07-14 06:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payout_date_histories`
--

CREATE TABLE `payout_date_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cash_advance_id` bigint(20) UNSIGNED NOT NULL,
  `old_start` date DEFAULT NULL,
  `old_end` date DEFAULT NULL,
  `new_start` date NOT NULL,
  `new_end` date NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_date_histories`
--

INSERT INTO `payout_date_histories` (`id`, `cash_advance_id`, `old_start`, `old_end`, `new_start`, `new_end`, `changed_at`) VALUES
(1, 190, '2025-07-18', '2025-07-24', '2025-07-18', '2025-07-23', '2025-07-18 04:25:11'),
(2, 190, '2025-07-18', '2025-07-23', '2025-07-16', '2025-07-22', '2025-07-18 04:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_auditors`
--

CREATE TABLE `pre_auditors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_auditors`
--

INSERT INTO `pre_auditors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Joshua Masarate', '2025-07-12 06:40:28', '2025-07-12 06:40:28'),
(3, 'nicky', '2025-07-12 06:48:43', '2025-07-12 06:48:43'),
(4, 'alexis', '2025-07-12 06:48:43', '2025-07-12 06:48:43'),
(5, 'bryan', '2025-07-12 06:48:43', '2025-07-12 06:48:43'),
(6, 'paulo', '2025-07-12 06:48:43', '2025-07-12 06:48:43'),
(7, 'roseler', '2025-07-15 01:03:18', '2025-07-15 01:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `pre_auditor_liquidation`
--

CREATE TABLE `pre_auditor_liquidation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `liquidation_id` bigint(20) UNSIGNED NOT NULL,
  `pre_auditor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_auditor_liquidation`
--

INSERT INTO `pre_auditor_liquidation` (`id`, `liquidation_id`, `pre_auditor_id`, `created_at`, `updated_at`) VALUES
(32, 3498, 5, '2025-07-18 03:04:39', '2025-07-18 03:04:39'),
(33, 3500, 6, '2025-07-18 03:04:39', '2025-07-18 03:04:39'),
(34, 3502, 5, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(35, 3504, 3, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(36, 3505, 3, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(37, 3506, 5, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(38, 3507, 4, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(39, 3508, 7, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(40, 3509, 3, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(41, 3510, 5, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(42, 3511, 4, '2025-07-18 03:04:40', '2025-07-18 03:04:40'),
(43, 3512, 7, '2025-07-18 03:04:40', '2025-07-18 03:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `pre_auditor_liquidation_entries`
--

CREATE TABLE `pre_auditor_liquidation_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pre_auditor_id` bigint(20) UNSIGNED NOT NULL,
  `liquidation_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `for_compliance` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_auditor_liquidation_entries`
--

INSERT INTO `pre_auditor_liquidation_entries` (`id`, `pre_auditor_id`, `liquidation_id`, `amount`, `for_compliance`, `created_at`, `updated_at`) VALUES
(78, 3, 3504, 0.00, 20000.00, '2025-07-18 03:08:40', '2025-07-18 03:08:40'),
(80, 4, 3507, 712000.00, 0.00, '2025-07-18 05:53:58', '2025-07-18 05:53:58'),
(81, 5, 3506, 917500.00, 0.00, '2025-07-18 06:05:48', '2025-07-18 06:05:48'),
(82, 5, 3506, 0.00, 10000.00, '2025-07-18 06:08:38', '2025-07-18 06:08:38'),
(83, 5, 3506, 990000.00, 0.00, '2025-07-18 06:36:36', '2025-07-18 06:36:36'),
(84, 3, 3504, 900000.00, 0.00, '2025-07-18 06:38:45', '2025-07-18 06:38:45'),
(86, 3, 3504, 109000.00, 0.00, '2025-07-18 06:39:28', '2025-07-18 06:39:28'),
(87, 3, 3505, 1913000.00, 0.00, '2025-07-18 06:42:42', '2025-07-18 06:42:42'),
(88, 7, 3508, 1651000.00, 0.00, '2025-07-18 06:43:07', '2025-07-18 06:43:07'),
(89, 3, 3509, 1448000.00, 0.00, '2025-07-18 06:43:36', '2025-07-18 06:43:36'),
(90, 5, 3510, 1182000.00, 0.00, '2025-07-18 06:43:56', '2025-07-18 06:43:56'),
(91, 4, 3511, 1141000.00, 0.00, '2025-07-18 06:44:15', '2025-07-18 06:44:15'),
(92, 7, 3512, 700000.00, 0.00, '2025-07-18 13:18:03', '2025-07-18 13:18:03'),
(93, 5, 3502, 127354.00, 0.00, '2025-07-19 16:49:03', '2025-07-19 16:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-07-06 05:14:42', '2025-07-06 05:14:42'),
(2, 'staff', 'web', '2025-07-06 05:14:42', '2025-07-06 05:14:42'),
(3, 'user', 'web', '2025-07-06 05:14:42', '2025-07-06 05:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sack_assignment`
--

CREATE TABLE `sack_assignment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `liq_number` varchar(50) NOT NULL,
  `sack_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sdo`
--

CREATE TABLE `sdo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `corporate_email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `official_station` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sdo`
--

INSERT INTO `sdo` (`id`, `name`, `email`, `corporate_email`, `contact_number`, `position`, `official_station`, `employment_status`, `created_at`, `updated_at`) VALUES
(48, 'CIRIACO B. ABEJURO JR.', 'donabejuro@gmail.com', 'cbabejurojr.fo5@dswd.gov.ph', '912341234', 'PO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(49, 'RINA E. APUYAN', 'apuyanrina@yahoo.com', 'reapuyan.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'ALBAY', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(50, 'JOSIE JOY T. ARELLANO', 'josiejoytuberon@yahoo.com.ph', 'vmlim.fo5@dswd.gov.ph', '912341234', 'SWO II', 'CAMARINES NORTE', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(51, 'DOMINICA B. BIEN-ATIZADO', 'dbbien.fo5@gmail.com', 'dbbien.fo5@dswd.gov.ph', '912341234', 'AO III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(52, 'GERLIE L. AVILA', 'gerlieavila14@gmail.com', 'glavila.fo5@dswd.gov.ph', '912341234', 'SWO V', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(53, 'MARY MAY C. BAHOY', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(54, 'DARYL N. BALBASTRO', NULL, NULL, '912341234', 'SWO II', 'CATANDUANES- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(55, 'MAEVEL N. BALDO', 'nhelmaevz@gmail.com', NULL, '912341234', 'PDO II', 'SORSOGON', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(56, 'NICOLE MARIE M. BANDOJO', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(57, 'EVA D. BAÑARES', 'delumeneva@gmail.com', 'edbañares.fo5@dswd.gov.ph', '912341234', 'AO V', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(58, 'AILEEN MAE B. BARCELA', 'aileenmae.barcela@yahoo.com', 'abbarcela.fo5@dswd.gov.ph', '912341234', 'PDO II', 'SLP RPMO', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(59, 'KATHE GENEVIEVE S. BARCELON', 'keytgen@gmail.com', 'kssabdao.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(60, 'LLOYD DRAZEN B. BAS', 'lloyd.bas@gmail.com', 'lbbas.fo5@dswd.gov.ph', '912341234', 'SAO', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(61, 'MARK GREGORY A. BASILAN', 'basilanmg@yahoo.com', 'mabasilan.fo5@dswd.gov.ph', '912341234', 'AO V', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(62, 'JOY C. BELEN III', 'joyb_24@yahoo.com', 'jcbelen.fo5@dswd.gov.ph', '912341234', 'PDO IV', 'FO V', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(63, 'MA. CRISTINA S. BELLEN', 'tin_bellen@yahoo.com', 'msbellen.fo5@dswd.gov.ph', '912341234', 'SWO II', 'CAMARINES NORTE', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(64, 'MICHAEL GEROME B. BELLENA', 'mikobellena@gmail.com', 'mbbellena.fo5@dswd.gov.ph', '912341234', 'CAO', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(65, 'SUSAN M. BELLEZA', 'shawee_08@yahoo.com', 'smbelleza.fo5@dswd.gov.ph', '912341234', 'AO V', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(66, 'MARY ROSANNE P. BIEN', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(67, 'NERICHELLE R. BOBIS', 'nerichellerbobis@gmail.com', 'nrbobis.fo5@dswd.gov.ph', '912341234', 'AO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(68, 'JANET BONAOBRA', NULL, NULL, '912341234', 'PDO II', 'CAMARINES SUR- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(69, 'MELANIE B. BONGAT', NULL, NULL, '912341234', 'PDO II', 'CATANDUANES- SLP', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(70, 'ANJANETTE R. BRITANICO', NULL, NULL, '912341234', 'PDO II', 'CAMARINES SUR- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(71, 'RYAN C. BUENAOBRA', NULL, NULL, '912341234', 'PDO II', 'RPMO- SLP', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(72, 'CYRILL B. CABREDO', NULL, NULL, '912341234', 'SWO III', 'ALBAY- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(73, 'JEROME G. CAÑAVERAL', NULL, NULL, '912341234', 'ITO II', 'FOV- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(74, 'EARL MAXIMILLAN A. CECILIO', 'emacecilio.fo5@dswd.gov.ph', 'eacecilio.fo5@dswd.gov.ph', '912341234', 'PDO III', 'SLP RPMO', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(75, 'BREATHNEY RENEE B. CIELO', NULL, NULL, '912341234', 'PDO II', 'CAMARINES NORTE- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(76, 'SHIERAMAE L. DADO', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(77, 'CYNTHIA G. DE LA CRUZ', NULL, NULL, '912341234', 'SWO III', 'SORSOGON- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(78, 'ANDREA PATRICIA B. DE PANO', 'andrea05.adp@gmail.com', NULL, '912341234', 'SWO II', 'CATANDUANES', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(79, 'MONALIZA V. DIAZ', NULL, NULL, '912341234', 'PDO II', 'CAMARINES NORTE- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(80, 'WILSON A. ECAT', 'waecat.fo5@e-dswd.net', 'waecat.fo5@dswd.gov.ph', '912341234', 'ITO II', 'FO V', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(81, 'IRAH JEANNE B. EGO', 'irahjeanneb@gmail.com', 'ibego.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(82, 'ARLENE C. FABELLARE', 'fabellarearlene@yahoo.com', 'acfabellare.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'CAMARINES SUR', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(83, 'MA. CRISTINA M. FLORENDO', 'tinflorendo010102@gmail.com', 'mmflorendo.fo5@dswd.gov.ph', '912341234', 'ND III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(84, 'EDEN C. FLORES', 'eden_flores124@yahoo.com', 'ecflores.fo5@dswd.gov.ph', '912341234', 'PDO III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(85, 'KAREN B. GARCIA', NULL, NULL, '912341234', 'PDO II', 'CATANDUANES- SLP', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(86, 'VILMA R. GARCIA', 'vilmagarcia518@yahoo.com', 'vrgarcia.fo5@dswd.gov.ph', '912341234', 'SWO II', 'CAMARINES SUR', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(87, 'MELANIE B. GARRIDO', 'mhelgarrido05@gmail.com', 'mbgarrido.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(88, 'AISY B. GOYENA', 'aisybenitez@yahoo.com', 'abgoyena.fo5@dswd.gov.ph', '912341234', 'AA II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(89, 'CHRISTIAN A. JAQUILMO', 'jack31710@yahoo.com', 'cajaquilmo.fo5@dswd.gov.ph', '912341234', 'ITO II', 'FO V', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(90, 'NORMAN S. LAURIO', 'normanlaurio17@gmail.com', 'nslaurio@dswd.gov.ph', '912341234', 'RD', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(91, 'LLOYD S. LARA', 'lloyd.lara79@gmail.com', 'lslara.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(92, 'GLADYS O. LIBROJO', 'librojogladys2018@gmail.com', 'golibrojo.fo5@dswd.gov.ph', '912341234', 'AO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(93, 'AIMEE ROSE A. LOZANO', 'marcialozano0430@gmail.com', NULL, '912341234', 'SWO III', 'CAMARINES SUR', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(94, 'JOHN CLIFFORD E. MACASINAG', 'johncliffordmacasinag@gmail.com', 'jemacasinag.fo5@dswd.gov.ph', '912341234', 'PDO II', 'SORSOGON', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(95, 'MYLENE S. MAGALANG', 'sandigmylene24@gmail.com', 'msmagalang.fo5@dswd.gov.ph', '912341234', 'PDO II', 'MASBATE', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(96, 'BABYLYN L. MADRIDANO', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(97, 'KATRINA G. MANAYA', 'katrinamanaya@gmail.com', 'kgmanaya.fo5@dswd.gov.ph', '912341234', 'PDO II', 'SLP RPMO', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(98, 'ELLAINE M. MANCERA', 'ellainemaancera@gmail.com', NULL, '912341234', 'PDO II', 'SORSOGON', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(99, 'JINKY A. MANGAMPO', 'albaytar_jinky@yahoo.com', 'jamangampo.fo5@dswd.gov.ph', '912341234', 'AO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(100, 'CECILLE G. MAPA', 'cecille_gubot@yahoo.com', 'cgmapa.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'SORSOGON', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(101, 'MARILYN B. MARAÑO', NULL, NULL, '912341234', 'TS III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(102, 'HONEYLET M. MAROLLANO', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(103, 'RONNEL L. MARTILLANA', NULL, NULL, '912341234', 'PDO II', 'SLP RPMO', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(104, 'CHRISTIAN L. MARTINEZ', 'loqui_199@yahoo.com', 'clmartinez.fo5@dswd.gov.ph', '912341234', 'AO III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(105, 'JAYGEE J. MASANQUE', 'jagkidz_co@yahoo.com', 'jjmasanque.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(106, 'JOSIE L. MATOCIÑOS', NULL, NULL, '912341234', 'PDO II', 'CAMARINES NORTE- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(107, 'AGNES M. MAYOR', NULL, NULL, '912341234', 'PDO II', 'SLP RPMO\n', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(108, 'RHODA L. MENDAROS', 'rhodora.x2133@yahoo.com', 'rlmendaros.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(109, 'EMILY D. MENDOZA', 'emilymendozady@gmail.com', 'edmendoza.fo5@dswd.gov.ph', '912341234', 'SWO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(110, 'SAMANTHA MAE Q. MIGUEL', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(111, 'JANETH A. MIRANDA', 'mjaneth12@yahoo.com', 'jamiranda.fo5@dswd.gov.ph', '912341234', 'PDO II', 'CAMARINES NORTE', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(112, 'MARIAN T. MONSALVE', 'mariantmonsalve@gmail.com', 'mtmonsalve.fo5@dswd.gov.ph', '912341234', 'SWO II', 'CAMARINES SUR', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(113, 'LORENA T. MORADO', 'morado_lorena@yahoo.com', 'ltmorado.fo5@dswd.gov.ph', '912341234', 'PDO II', 'ALBAY', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(114, 'SHEREEN MAE R. MORASA', 'shereenmaem@gmail.com', 'srmorasa.fo5@dswd.gov.ph', '912341234', 'PDO II', 'ALBAY', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(115, 'CORA MARIE ANN D. NICOLAS', 'coramarieannnicolas@gmail.com', 'cdnicolas.fo5@dswd.gov.ph', '912341234', 'PDO II', 'CAMARINES SUR', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(116, 'LARAMIE M. OCHARAN', 'lara.ocharan@yahoo.com', 'lmocharan.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'MASBATE', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(117, 'SHIRLY J. OCHOA', 'shirlyjaca@gmail.com', 'sjochoa.fo5@dswd.gov.ph', '912341234', 'TS II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(118, 'MARY GRACE C. OJEDA', NULL, NULL, '912341234', 'SWO III', 'ALBAY- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(119, 'MARIA DIVINA GRACIA G. OLGINA', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(120, 'DONNA M. OSIAL', 'donnaosial2010@gmail.com', 'dmosial.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(121, 'MARISSA M. PAESTE', 'marissapaeste70@gmail.com', 'mmpaeste.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(122, 'JUVY E. PASANO', 'JEPasano.fo5@e-dswd.net', 'jepasano.fo5@dswd.gov.ph', '912341234', 'AO V', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(123, 'RANULFO C. PASANO', 'buboypasano@yahoo.com', 'rcpasano.fo5@dswd.gov.ph', '912341234', 'AA II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(124, 'MARVIE C. PEDRO', NULL, NULL, '912341234', 'SWO II', ' FO V ', ' PERMANENT ', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(125, 'MYRA JOY D. POBOCAN', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(126, 'JOCELYN A. PRELLIGERA', 'joyariolaprelligera@gmail.com', 'japrelligera.fo5@dswd.gov.ph', '912341234', 'SWO II', 'RSCC', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(127, 'DAN PAUL L. PUSE', 'danpaull@yahoo.com', 'dppuse.fo5@dswd.gov.ph', '912341234', 'PDO II', 'CAMARINES SUR', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(128, 'SHAINA B. QUINTANILLA', NULL, NULL, '912341234', 'PDO II', 'CAMARINES SUR- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(129, 'JESSA MAE C. QUIRAS', NULL, NULL, '912341234', 'PDO II', ' FOV- PANTAWID ', ' CONTRACTUAL ', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(130, 'MARITES L. QUISMORIO', 'maritesquis@yahoo.com', 'mlquismorio.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(131, 'JOANN M. RAMOS', 'joannmramos2021@gmail.com', NULL, '912341234', 'SWO III', 'RSCC', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(132, 'MA. JULIE MAY H. RAMOS', 'juliemayramos@gmail.com', 'mjmhramos.fo5@dswd.gov.ph', '912341234', 'PDO II', 'CAMARINES NORTE', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(133, 'JINDRA M. REFIL', 'jindramingoy@yahoo.com.ph', 'jmrefil.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(134, 'CHERIE ROSE E. REVILLA', NULL, NULL, '912341234', 'SWO III', 'ALBAY- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(135, 'JELLIE ANNE B. REYES', 'jellieannereyes@yahoo.com', 'jbreyes.fo5@dswd.gov.ph', '912341234', 'TS I', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(136, 'LIANE B. RICACHO', NULL, NULL, '912341234', 'PDO II', 'ALBAY- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(137, 'MA. SHIELA V. RICAFRANCA', 'mashie.ricafranca@gmail.com', 'mvricafranca.fo5@dswd.gov.ph', '912341234', 'AO II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(138, 'JESSICA O. RODRIGUEZ', 'jessica_rodriguez68@yahoo.com', 'jorodriguez.fo5@dswd.gov.ph', '912341234', 'SWO II', 'SORSOGON', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(139, 'LEAH P. RODRIGUEZ', NULL, NULL, '912341234', 'SWO III', 'SORSOGON- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(140, 'KATHERINE C. RODRIGUEZ', 'kath.rodriguez25@gmail.com', 'kcrodriguez.fo5@dswd.gov.ph', '912341234', 'SWO II', 'MASBATE', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(141, 'JAIME T. SABALLEGUE', 'jaimetsaballegue@yahoo.com', 'jtsaballegue.fo5@dswd.gov.ph', '912341234', 'PDO II', 'CAMARINES SUR', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(142, 'PRISCILLA C. SALADAGA', 'pcsaladaga@yahoo.com', 'pcsaladaga.fo5@dswd.gov.ph', '912341234', 'PDO V', 'PANTAWID RPMO', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(143, 'MARIA CRISTINA S. SAMSON', 'tin.so.samson27@gmail.com', 'mssamson.fo5@dswd.gov.ph', '912341234', 'SWO III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(144, 'MELCHOR L. SAÑANO', 'sananochoy@gmail.com', 'mlsanano.fo5@dswd.gov.ph', '912341234', 'DIRECTOR III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(145, 'LINNETH R. SEDUTAN', NULL, NULL, '912341234', 'PDO II', 'SORSOGON- AICS', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(146, 'ANALYN D. SIERRA', 'alynsierra@yahoo.com', 'adsierra.fo5@dswd.gov.ph', '912341234', 'AO V', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(147, 'SHEENA C. TAD-O', NULL, NULL, '912341234', 'SWO III', 'CAMARINES NORTE- PANTAWID', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(148, 'VICTORIA C. TAGUM', 'vickytagum50@gmail.com', 'vctagum.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(149, 'JOSEPH L. TESTON', 'joseph.teston@gmail.com', 'jlteston.fo5@dswd.gov.ph', '912341234', 'PO III', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(150, 'EDSEL A. TIANSAY JR.', 'edge_chansai@yahoo.com', 'eatiansayjr.fo5@dswd.gov.ph', '912341234', 'AA II', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(151, 'JOMAR B. VALENZUELA', 'catanduanesdatafocal@gmail.com', NULL, '912341234', 'PDO II', 'CATANDUANES', 'CONTRACTUAL', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(152, 'CLAUDIO A. VILLAREAL JR.', 'claudiovillareal@gmail.com', 'cavillarealjr.fo5@dswd.gov.ph', '912341234', 'SWO IV', 'FO V', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(153, 'LYNDRA A. VILLAREAL', NULL, 'lavillareal.fo5@dswd.gov.ph', '912341234', 'SWO III', 'RRCY', 'PERMANENT', '2025-07-14 18:56:19', '2025-07-14 18:56:19'),
(154, 'Nicky Palero', 'reportermagic@gmail.com', 'reportermagic@gmail.com', '912341234', 'PO IV', 'FO V', 'PERMANENT', '2025-07-18 02:48:12', '2025-07-18 02:48:12'),
(155, 'Alexis Bien', 'ingrownmagic@gmail.com', 'ingrownmagic@gmail.com', '912341234', 'SWO IV', 'ALBAY', 'CONTRACTUAL', '2025-07-18 02:48:12', '2025-07-18 02:48:12'),
(156, 'Bryan Trinidad', 'jazzvalid1@gmail.com', 'jazzvalid1@gmail.com', '912341234', 'SWO II', 'CAMARINES NORTE', 'PERMANENT', '2025-07-18 02:48:12', '2025-07-18 02:48:12'),
(157, 'Paulo Maranan', 'roselernboco@gmail.com', 'roselernboco@gmail.com', '912341234', 'PDO II', 'CATANDUANES- AICS', 'CONTRACTUAL', '2025-07-18 02:48:12', '2025-07-18 02:48:12'),
(158, 'Rommel Boco', 'rommelboco@gmail.com', 'rommelboco@gmail.com', '012323421', 'Higa', 'Rawis', 'Contract of Service', '2025-07-19 06:11:55', '2025-07-19 06:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KqEPEcDDet59nttwdyU5HuTZJKdZswtLE4nJArq2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieW9oTEY5dEpldHRwYVlXRTl3R1ZEMWlhM3JnZG9BMGlDRWZoalhPRCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xpcXVpZGF0aW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9fQ==', 1753175222);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$MAw.g.tAHDGqq3o2B6klJeUJNR/JENNGlNzDQdsfVbNSGRK7iHOeu', 'Kk7EQb3zMEb2PxHiVnoKdRyAwiWF7uoR4y9sRwbZoVVSYQRF7m1b1cUYXCeN', '2025-07-01 23:17:08', '2025-07-01 23:17:08'),
(2, 'Bryan Trinidad', 'roselernboco@gmail.com', NULL, '$2y$12$RhCT/6.2jDfwg3NU8wLmVusNNIZ9u8XsR4R61Yj/GwhTeIG6oiB4.', NULL, '2025-07-01 23:18:40', '2025-07-02 19:23:53'),
(3, 'Nicky Palero', 'reportermagic@gmail.com', NULL, '$2y$12$M0/38J/7HtoPLC39ocysYut/i8RG.p8rU6Q9w5yipPCOTLfYPWPE6', NULL, '2025-07-01 23:19:05', '2025-07-01 23:19:05'),
(4, 'Paulo Maranan', 'ingrownmagic@gmail.com', NULL, '$2y$12$BZUzWQGPwxU6PtkfFu.NWOwNM9C19nUVAuu4TpMHgjhV6M7ejlxLC', NULL, '2025-07-01 23:19:35', '2025-07-01 23:19:35'),
(5, 'Alexis Bien', 'renegade160501@gmail.com', NULL, '$2y$12$J3XisYy0/CsxUbWzCuvtzuFUe8YVKxASjToM3znTRZe7fXzEWiK.C', NULL, '2025-07-01 23:20:13', '2025-07-01 23:20:13'),
(6, 'Rommel Boco', 'rommel@gmail.com', NULL, '$2y$12$fPqWxllnQk2k94AJJeUlCOSEkB0y8PmUFd5aPRBFkokHf7Snvkqyu', NULL, '2025-07-06 07:17:06', '2025-07-06 07:17:06'),
(7, 'Mark Joey Noel', 'macky@gmail.com', NULL, '$2y$12$D/UmwIpUL2x7qbk2/2FvquxF002epb/AUada8a00TbwaFuY35a0OW', NULL, '2025-07-06 07:29:31', '2025-07-06 07:29:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonded_officials`
--
ALTER TABLE `bonded_officials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bonded_officials_sdo_id_foreign` (`sdo_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cash_advance`
--
ALTER TABLE `cash_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliance_files`
--
ALTER TABLE `compliance_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliance_status`
--
ALTER TABLE `compliance_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create`
--
ALTER TABLE `create`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_sdo_id_foreign` (`sdo_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liquidated_reports`
--
ALTER TABLE `liquidated_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liquidated_reports_cash_advance_id_foreign` (`cash_advance_id`);

--
-- Indexes for table `liquidation`
--
ALTER TABLE `liquidation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `liquidation_liq_number_unique` (`liq_number`),
  ADD KEY `liquidation_cash_advance_id_foreign` (`cash_advance_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `pap`
--
ALTER TABLE `pap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pap_pap_name_unique` (`pap_name`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payout_date_histories`
--
ALTER TABLE `payout_date_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payout_date_histories_cash_advance_id_foreign` (`cash_advance_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `pre_auditors`
--
ALTER TABLE `pre_auditors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_auditor_liquidation`
--
ALTER TABLE `pre_auditor_liquidation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_auditor_liquidation_liquidation_id_foreign` (`liquidation_id`),
  ADD KEY `pre_auditor_liquidation_pre_auditor_id_foreign` (`pre_auditor_id`);

--
-- Indexes for table `pre_auditor_liquidation_entries`
--
ALTER TABLE `pre_auditor_liquidation_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_auditor_liquidation_entries_pre_auditor_id_foreign` (`pre_auditor_id`),
  ADD KEY `pre_auditor_liquidation_entries_liquidation_id_foreign` (`liquidation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sack_assignment`
--
ALTER TABLE `sack_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sack_assignment_liq_number_index` (`liq_number`);

--
-- Indexes for table `sdo`
--
ALTER TABLE `sdo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sdo_email_unique` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `bonded_officials`
--
ALTER TABLE `bonded_officials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `cash_advance`
--
ALTER TABLE `cash_advance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `compliance_files`
--
ALTER TABLE `compliance_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliance_status`
--
ALTER TABLE `compliance_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `create`
--
ALTER TABLE `create`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liquidated_reports`
--
ALTER TABLE `liquidated_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `liquidation`
--
ALTER TABLE `liquidation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3513;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pap`
--
ALTER TABLE `pap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `payout_date_histories`
--
ALTER TABLE `payout_date_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_auditors`
--
ALTER TABLE `pre_auditors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pre_auditor_liquidation`
--
ALTER TABLE `pre_auditor_liquidation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pre_auditor_liquidation_entries`
--
ALTER TABLE `pre_auditor_liquidation_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sack_assignment`
--
ALTER TABLE `sack_assignment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdo`
--
ALTER TABLE `sdo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonded_officials`
--
ALTER TABLE `bonded_officials`
  ADD CONSTRAINT `bonded_officials_sdo_id_foreign` FOREIGN KEY (`sdo_id`) REFERENCES `sdo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `create`
--
ALTER TABLE `create`
  ADD CONSTRAINT `create_sdo_id_foreign` FOREIGN KEY (`sdo_id`) REFERENCES `sdo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liquidated_reports`
--
ALTER TABLE `liquidated_reports`
  ADD CONSTRAINT `liquidated_reports_cash_advance_id_foreign` FOREIGN KEY (`cash_advance_id`) REFERENCES `cash_advance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liquidation`
--
ALTER TABLE `liquidation`
  ADD CONSTRAINT `liquidation_cash_advance_id_foreign` FOREIGN KEY (`cash_advance_id`) REFERENCES `cash_advance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payout_date_histories`
--
ALTER TABLE `payout_date_histories`
  ADD CONSTRAINT `payout_date_histories_cash_advance_id_foreign` FOREIGN KEY (`cash_advance_id`) REFERENCES `cash_advance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pre_auditor_liquidation`
--
ALTER TABLE `pre_auditor_liquidation`
  ADD CONSTRAINT `pre_auditor_liquidation_liquidation_id_foreign` FOREIGN KEY (`liquidation_id`) REFERENCES `liquidation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pre_auditor_liquidation_pre_auditor_id_foreign` FOREIGN KEY (`pre_auditor_id`) REFERENCES `pre_auditors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pre_auditor_liquidation_entries`
--
ALTER TABLE `pre_auditor_liquidation_entries`
  ADD CONSTRAINT `pre_auditor_liquidation_entries_liquidation_id_foreign` FOREIGN KEY (`liquidation_id`) REFERENCES `liquidation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pre_auditor_liquidation_entries_pre_auditor_id_foreign` FOREIGN KEY (`pre_auditor_id`) REFERENCES `pre_auditors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sack_assignment`
--
ALTER TABLE `sack_assignment`
  ADD CONSTRAINT `sack_assignment_liq_number_foreign` FOREIGN KEY (`liq_number`) REFERENCES `liquidation` (`liq_number`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
