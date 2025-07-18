-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 02:21 PM
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
  `status` varchar(255) DEFAULT NULL,
  `approved_bond_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `max_cash_accountability` decimal(15,2) NOT NULL DEFAULT 0.00,
  `effectivity_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `unliquidated_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `received_in_accounting` date DEFAULT NULL,
  `remarks_status` varchar(255) DEFAULT NULL,
  `date_complied` date DEFAULT NULL,
  `compliance_returned` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(34, '2025_07_18_114948_create_payout_date_histories_table', 27);

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
('k1aAxy7R3yvRSFXu7HlwcRSdnamcP3CiQm7dhfkF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOEZWdTM0Y1ZEVjd5VE9xOU5Kbm50dEpLSlBSN05McXJYaEtObUlPYSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saXF1aWRhdGlvbi9jb25kZW5zZWQtZXhwb3J0P2xpcV9kYXRlX2Zyb209JmxpcV9kYXRlX3RvPSZudW1iZXI9JnJlY2VpdmVkX2RhdGVfZnJvbT0mcmVjZWl2ZWRfZGF0ZV90bz0mc2RvX25hbWU9JnN0YXR1cz1BcHByb3ZlZCZ0eXBlPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752839566),
('Rjud0zHqz440e4pmheA7G7ACVhkplnIfy7XhFfpr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY3dFd2tkQkJsaTRvMmZtWWVyV1Q0T0dCTllRdGVMTzRydDlaZ2FGcyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saXF1aWRhdGlvbi9jb25kZW5zZWQtZXhwb3J0P2xpcV9kYXRlX2Zyb209JmxpcV9kYXRlX3RvPSZudW1iZXI9JnJlY2VpdmVkX2RhdGVfZnJvbT0mcmVjZWl2ZWRfZGF0ZV90bz0mc2RvX25hbWU9JnN0YXR1cz1BcHByb3ZlZCZ0eXBlPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjI6IlBIUERFQlVHQkFSX1NUQUNLX0RBVEEiO2E6MDp7fX0=', 1752822206),
('t7NQYkzxOe4eczsydehI5rO7YhOBEjNdiWitdeKB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNFF3bXBMUHlDRlhZUnNDRDdyVm42SzB0cmYxNlR5bTllbm5FdUdUdyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo4NjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xpcXVpZGF0aW9uP2RhdGVfZnJvbT0mZGF0ZV90bz0mc2VhcmNoPSZzdGF0dXM9JnR5cGU9TGlxdWlkYXRpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1752838962),
('v8hHxDhFp5ExhFFzbVjmrt3rXoH6XD6Kt8wbrill', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieENPTnd4Vm9DZHlJSFFVUjA4YnFPS0NPRjd0V0Myc2t3UnhFcUxtRSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3NkbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752838967);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_advance`
--
ALTER TABLE `cash_advance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liquidation`
--
ALTER TABLE `liquidation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pap`
--
ALTER TABLE `pap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `payout_date_histories`
--
ALTER TABLE `payout_date_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_auditors`
--
ALTER TABLE `pre_auditors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_auditor_liquidation`
--
ALTER TABLE `pre_auditor_liquidation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_auditor_liquidation_entries`
--
ALTER TABLE `pre_auditor_liquidation_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sdo`
--
ALTER TABLE `sdo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
