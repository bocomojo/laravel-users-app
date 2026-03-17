-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2026 at 09:00 AM
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
(121, 153, 'With SO', 50000.00, 25000.00, '2025-01-01', '2026-01-01', NULL, 10000.00, '2025-02-01', '2025-03-01', '2025-03-15', '2025-08-27 15:43:42', '2025-08-27 15:43:42', NULL),
(122, 154, 'With SO', 30000.00, 15000.00, '2025-02-15', '2026-02-15', NULL, 5000.00, '2025-03-10', '2025-04-05', '2025-04-10', '2025-08-27 15:43:42', '2025-08-27 15:43:42', NULL),
(123, 155, 'With SO', 50000.00, 25000.00, '2025-01-01', '2026-01-01', NULL, 10000.00, '2025-02-01', '2025-03-01', '2025-03-15', '2025-08-27 15:43:42', '2025-08-27 15:43:42', NULL),
(124, 156, 'With SO', 30000.00, 15000.00, '2025-02-15', '2026-02-15', NULL, 5000.00, '2025-03-10', '2025-04-05', '2025-04-10', '2025-08-27 15:43:42', '2025-08-27 15:43:42', NULL),
(125, 157, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-31 02:25:56', '2025-08-31 02:25:56', NULL),
(126, 158, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-31 03:26:13', '2025-08-31 03:26:13', NULL),
(128, 160, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-31 04:31:21', '2025-08-31 04:31:21', NULL),
(129, 161, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-31 04:34:41', '2025-08-31 04:34:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admin@example.com|127.0.0.1', 'i:1;', 1770344487),
('laravel_cache_admin@example.com|127.0.0.1:timer', 'i:1770344487;', 1770344487),
('laravel_cache_admin@gmail.com|127.0.0.1', 'i:2;', 1770344471),
('laravel_cache_admin@gmail.com|127.0.0.1:timer', 'i:1770344471;', 1770344471),
('laravel_cache_bryan@gmail.com|127.0.0.1', 'i:2;', 1772069361),
('laravel_cache_bryan@gmail.com|127.0.0.1:timer', 'i:1772069361;', 1772069361),
('laravel_cache_nicky@gmail.com|127.0.0.1', 'i:1;', 1770357643),
('laravel_cache_nicky@gmail.com|127.0.0.1:timer', 'i:1770357643;', 1770357643),
('laravel_cache_roseler@gmail.com|127.0.0.1', 'i:1;', 1770344523),
('laravel_cache_roseler@gmail.com|127.0.0.1:timer', 'i:1770344523;', 1770344523);

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
(34, 154, '9925021307', '1970-01-01', '25-02-02666', '1970-01-01', '25-02-00597', '1970-01-01', 'To attend the PMB Year Starter Planning and Writeshop on February 18-21, 2025 at Savannah Resort Hotel, Angeles City, Pampanga', 'Cash Advance', 37, 11000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2026-02-06 00:04:31', '2026-02-06 00:04:31', NULL),
(35, 155, '2903001', '1970-01-01', '25-02-02906', '1970-01-01', '25-02-00784', '1970-01-01', 'Payment for Financial Assistance to AICS in Provinces of Region V (February 19-March 14, 2025) - Camarines Sur', 'Cash Advance', 37, 5000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2026-02-06 00:04:31', '2026-02-06 00:04:31', NULL),
(36, 156, '2900800', '1970-01-01', '25-02-02905', '1970-01-01', '25-02-00785', '1970-01-01', 'Payment for Financial Assistance to AICS in Provinces of Region V (February 20-March 20, 2025) - Camarines Sur', 'Cash Advance', 37, 15000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2026-02-06 00:04:31', '2026-02-06 00:04:31', NULL),
(37, 153, '2900799', '1970-01-01', '25-02-02904', '1970-01-01', '25-02-00786', '1970-01-01', 'Payment for Financial Assistance to AICS in Provinces of Region V (February 26-March 14, 2025) -Albay', 'Cash Advance', 37, 7000000.00, '1970-01-01', '1970-01-01', 'Ongoing', NULL, '2026-02-06 00:04:31', '2026-02-06 00:04:31', NULL);

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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '8421aad8-0bb6-4d87-90d4-b87cc0e36a6c', 'database', 'default', '{\"uuid\":\"8421aad8-0bb6-4d87-90d4-b87cc0e36a6c\",\"displayName\":\"App\\\\Mail\\\\ComplianceFileSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ComplianceFileSubmitted\\\":4:{s:11:\\\"liquidation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\Liquidation\\\";s:2:\\\"id\\\";i:38;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"filePath\\\";s:61:\\\"supporting_files\\/mHshb2qL4I0tf0cEJVA2gic2Q9o7xNWzCjpUe89o.pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"ingrownmagic@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1755146638,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection to \"smtp.gmail.com:587\" timed out. in C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\Stream\\AbstractStream.php:85\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(350): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#1 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(280): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#2 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(211): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#3 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#11 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#37 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-08-14 04:45:06'),
(2, 'b27e7be6-edbc-4437-8e22-c965d2af5df4', 'database', 'default', '{\"uuid\":\"b27e7be6-edbc-4437-8e22-c965d2af5df4\",\"displayName\":\"App\\\\Mail\\\\ComplianceFileSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ComplianceFileSubmitted\\\":4:{s:11:\\\"liquidation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\Liquidation\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"filePath\\\";s:61:\\\"supporting_files\\/5EbcLzeG6ZgmdkSdzBkiA2lBYp3ETeMlQBVlulhT.pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"reportermagic@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1755146828,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection to \"smtp.gmail.com:587\" timed out. in C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\Stream\\AbstractStream.php:85\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(350): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#1 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(280): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#2 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(211): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#3 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#11 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#37 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-08-14 04:48:09'),
(3, '50978ccd-18f4-44ee-80ef-2287aeaba6fb', 'database', 'default', '{\"uuid\":\"50978ccd-18f4-44ee-80ef-2287aeaba6fb\",\"displayName\":\"App\\\\Mail\\\\ComplianceFileSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ComplianceFileSubmitted\\\":4:{s:11:\\\"liquidation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\Liquidation\\\";s:2:\\\"id\\\";i:46;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"filePath\\\";s:61:\\\"supporting_files\\/VhWBU8vnLiJ04yWEm6xXcbV9ScUpIZKrqLmZm0v6.pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"roselernboco@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1755146928,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection to \"smtp.gmail.com:587\" timed out. in C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\Stream\\AbstractStream.php:85\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(350): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#1 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(280): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#2 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(211): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#3 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#11 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#37 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-08-14 04:49:49'),
(4, '43096684-2052-4a71-b43d-37a741ed7b23', 'database', 'default', '{\"uuid\":\"43096684-2052-4a71-b43d-37a741ed7b23\",\"displayName\":\"App\\\\Mail\\\\ComplianceFileSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ComplianceFileSubmitted\\\":4:{s:11:\\\"liquidation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\Liquidation\\\";s:2:\\\"id\\\";i:47;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"filePath\\\";s:61:\\\"supporting_files\\/VN4JiHhBuT5YyvHaD8HTa9jLq1oThIHdMB9SPxL8.pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"roselernboco@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1755147712,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection to \"smtp.gmail.com:587\" timed out. in C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\Stream\\AbstractStream.php:85\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(350): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\AbstractStream->readLine()\n#1 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(280): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->getFullResponse()\n#2 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(211): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#3 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#4 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#5 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#11 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#37 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2025-08-14 05:02:52');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(5, 'd8202e2d-4546-4a11-b016-40978ba49359', 'database', 'default', '{\"uuid\":\"d8202e2d-4546-4a11-b016-40978ba49359\",\"displayName\":\"App\\\\Mail\\\\ComplianceFileSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ComplianceFileSubmitted\\\":4:{s:11:\\\"liquidation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\Liquidation\\\";s:2:\\\"id\\\";i:48;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"filePath\\\";s:61:\\\"supporting_files\\/cnowj4rGzNwrCz5M3sYlzfMCLvhctrBqrB1kGFQ4.pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"roselernboco@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1755148301,\"delay\":null}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"roselernboco16@gmail.com\" using the following authenticators: \"LOGIN\", \"PLAIN\", \"XOAUTH2\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. For more information, go to\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials d9443c01a7336-241d1ef5970sm338676585ad.20 - gsmtp\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. For more information, go to\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials d9443c01a7336-241d1ef5970sm338676585ad.20 - gsmtp\".\". Authenticator \"XOAUTH2\" returned \"Expected response code \"235\" but got code \"334\", with message \"334 eyJzdGF0dXMiOiI0MDAiLCJzY2hlbWVzIjoiQmVhcmVyIiwic2NvcGUiOiJodHRwczovL21haWwuZ29vZ2xlLmNvbS8ifQ==\".\". in C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php:269\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php(199): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth(Array)\n#1 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php(150): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(255): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'HELO [127.0.0.1...\', Array)\n#3 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(281): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(211): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#6 C:\\Users\\rosel\\my-project\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(138): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(584): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(331): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#9 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#11 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#37 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#39 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#47 {main}', '2025-08-14 05:11:48'),
(6, '7ed1f4df-a1da-4e44-92af-ebaaa769c0f7', 'database', 'default', '{\"uuid\":\"7ed1f4df-a1da-4e44-92af-ebaaa769c0f7\",\"displayName\":\"App\\\\Mail\\\\ComplianceFileSubmitted\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\ComplianceFileSubmitted\\\":4:{s:11:\\\"liquidation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\Liquidation\\\";s:2:\\\"id\\\";a:2:{i:0;i:37;i:1;i:46;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"filePath\\\";s:61:\\\"supporting_files\\/GTBSHTkARShszXsbp7BjjF9UTKB94TRFMVMNK2vV.pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:22:\\\"roselernboco@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1755148513,\"delay\":null}', 'Exception: Property [liq_number] does not exist on this collection instance. in C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\Traits\\EnumeratesValues.php:1045\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\storage\\framework\\views\\da184a2d3b3e7c592f6e8c2b2d17f9ec.php(16): Illuminate\\Support\\Collection->__get(\'liq_number\')\n#1 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(123): require(\'C:\\\\Users\\\\rosel\\\\...\')\n#2 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#3 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#4 C:\\Users\\rosel\\my-project\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(22): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#5 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(74): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->evaluatePath(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#6 C:\\Users\\rosel\\my-project\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(10): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->get(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#9 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(93): Illuminate\\View\\View->render()\n#11 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Compilers\\BladeCompiler.php(1034): call_user_func(Object(Closure))\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.complian...\', Array)\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(440): value(Object(Closure), Array)\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#37 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#39 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#40 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#41 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#42 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#43 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#44 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#45 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#46 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#47 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#48 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#49 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#50 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#51 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#53 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#55 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#56 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#57 {main}\n\nNext Illuminate\\View\\ViewException: Property [liq_number] does not exist on this collection instance. (View: C:\\Users\\rosel\\my-project\\resources\\views\\emails\\compliance\\notice.blade.php) in C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\Traits\\EnumeratesValues.php:1045\nStack trace:\n#0 C:\\Users\\rosel\\my-project\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(58): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(Exception), 0)\n#1 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(59): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->handleViewException(Object(Exception), 0)\n#2 C:\\Users\\rosel\\my-project\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(22): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#3 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(74): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->evaluatePath(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#4 C:\\Users\\rosel\\my-project\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(10): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#5 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->get(\'C:\\\\Users\\\\rosel\\\\...\', Array)\n#6 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#7 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#8 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(93): Illuminate\\View\\View->render()\n#9 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#10 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Compilers\\BladeCompiler.php(1034): call_user_func(Object(Closure))\n#11 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#12 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.complian...\', Array)\n#13 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#14 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(440): value(Object(Closure), Array)\n#15 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#16 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#17 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#18 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#19 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#20 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#21 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#22 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#27 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#28 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#29 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#30 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(125): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#31 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#32 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#33 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#35 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#36 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#37 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#38 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#39 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#40 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#41 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#42 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#43 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#44 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#45 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(754): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#46 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(209): Illuminate\\Container\\Container->call(Array)\n#47 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Command\\Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#48 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(178): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#49 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 C:\\Users\\rosel\\my-project\\vendor\\symfony\\console\\Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#53 C:\\Users\\rosel\\my-project\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 C:\\Users\\rosel\\my-project\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#55 {main}', '2025-08-14 05:15:14');

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
(274, 35, 'Nicky Palero', '2903001', 21627.00, -8532.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00044', '2025-01-14', NULL, NULL, '', 'Approved', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(275, 35, 'Nicky Palero', '2903001', 21627.00, -13095.00, 'Liquidation', '2025-01-13', 'L-OE-25-02-0005', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(276, 37, 'Alexis Bien', '2900799', 21827.00, -9053.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00043', '2025-01-14', NULL, NULL, '', 'Approved', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(277, 37, 'Alexis Bien', '2900799', 21827.00, -12774.00, 'Liquidation', '2025-01-13', 'L-OE-25-02-0007', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(278, 34, 'Bryan Trinidad', '9925021307', 130745.00, -3173.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00050', '2025-01-15', NULL, NULL, '', 'Approved', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(279, 34, 'Bryan Trinidad', '9925021307', 130745.00, -127354.00, 'Liquidation', '2025-01-13', 'L-OE-25-03-0021', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(280, 34, 'Bryan Trinidad', '9925021307', 130745.00, -218.00, 'Refund', '2025-01-13', NULL, NULL, '25-01-00050', '2025-01-15', NULL, NULL, '', 'Approved', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(281, 36, 'Paulo Maranan', '2900800', 15000000.00, -1029000.00, 'Liquidation', '2025-01-13', 'L-25-01-00003', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:15', '2026-02-06 00:06:15'),
(282, 36, 'Paulo Maranan', '2900800', 15000000.00, -1913000.00, 'Liquidation', '2025-01-13', 'L-25-01-00004', NULL, NULL, NULL, 0.00, 1700001.00, '', 'Processing', 0, NULL, '2026-02-06 00:06:16', '2026-03-02 14:57:45'),
(283, 36, 'Paulo Maranan', '2900800', 15000000.00, -1917500.00, 'Liquidation', '2025-01-13', 'L-25-01-00005', NULL, NULL, NULL, 140000.00, 0.00, '', 'Processing', 0, NULL, '2026-02-06 00:06:16', '2026-02-28 06:19:07'),
(284, 36, 'Paulo Maranan', '2900800', 15000000.00, -712000.00, 'Liquidation', '2025-01-13', 'L-25-02-00025', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:16', '2026-02-06 00:06:16'),
(285, 36, 'Paulo Maranan', '2900800', 15000000.00, -1651000.00, 'Liquidation', '2025-01-13', 'L-25-02-00027', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:16', '2026-02-06 00:06:16'),
(286, 36, 'Paulo Maranan', '2900800', 15000000.00, -1448000.00, 'Liquidation', '2025-01-13', 'L-25-02-00034', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:16', '2026-02-06 00:06:16'),
(287, 36, 'Paulo Maranan', '2900800', 15000000.00, -1182000.00, 'Liquidation', '2025-01-13', 'L-25-02-00035', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:16', '2026-02-06 00:06:16'),
(288, 36, 'Paulo Maranan', '2900800', 15000000.00, -1141000.00, 'Liquidation', '2025-01-13', 'L-25-02-00068', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:16', '2026-02-06 00:06:16'),
(289, 36, 'Paulo Maranan', '2900800', 15000000.00, -795500.00, 'Liquidation', '2025-01-13', 'L-25-02-00033', NULL, NULL, NULL, NULL, NULL, '', 'For Checking', 0, NULL, '2026-02-06 00:06:16', '2026-02-06 00:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `liquidation_activities`
--

CREATE TABLE `liquidation_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `liquidation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liquidation_activities`
--

INSERT INTO `liquidation_activities` (`id`, `liquidation_id`, `user_id`, `action`, `details`, `created_at`, `updated_at`) VALUES
(247, 282, 1, 'Pre-Audit Entry Added', 'Complied Amount: ₱1,000,000.00', '2026-02-06 00:07:01', '2026-02-06 00:07:01'),
(248, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-06 00:10:47', '2026-02-06 00:10:47'),
(249, 282, 1, 'Marked as Done', 'Status changed to Processing', '2026-02-06 00:11:21', '2026-02-06 00:11:21'),
(250, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-06 02:48:00', '2026-02-06 02:48:00'),
(251, 282, 2, 'Marked as Done', 'Status changed to Processing', '2026-02-09 02:37:26', '2026-02-09 02:37:26'),
(252, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-09 02:46:27', '2026-02-09 02:46:27'),
(253, 282, 1, 'Marked as Done', 'Status changed to Processing', '2026-02-09 02:46:40', '2026-02-09 02:46:40'),
(254, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-09 02:54:08', '2026-02-09 02:54:08'),
(255, 282, 2, 'Marked as Done', 'Status changed to Processing', '2026-02-09 03:39:59', '2026-02-09 03:39:59'),
(256, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-09 03:40:44', '2026-02-09 03:40:44'),
(257, 282, 2, 'Marked as Done', 'Status changed to Processing', '2026-02-09 03:45:13', '2026-02-09 03:45:13'),
(258, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-26 01:36:11', '2026-02-26 01:36:11'),
(259, 282, 1, 'Marked as Done', 'Status changed to Processing', '2026-02-26 01:36:28', '2026-02-26 01:36:28'),
(260, 282, 2, 'Pre-Audit Entry Added', 'Complied Amount: ₱10,000.00', '2026-02-26 02:38:26', '2026-02-26 02:38:26'),
(261, 282, 2, 'Pre-Audit Entry Added', 'Complied Amount: ₱3,000.00', '2026-02-26 03:50:49', '2026-02-26 03:50:49'),
(262, 282, 2, 'Pre-Audit Entry Added', 'For Compliance Total: ₱10,000.00', '2026-02-27 01:05:34', '2026-02-27 01:05:34'),
(263, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-28 02:22:06', '2026-02-28 02:22:06'),
(264, 282, 2, 'Pre-Audit Entry Updated', 'Entry ID: 276', '2026-02-28 02:49:09', '2026-02-28 02:49:09'),
(265, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-28 06:06:51', '2026-02-28 06:06:51'),
(266, 283, 1, 'Pre-Audit Entry Added', 'For Compliance Total: ₱140,000.00', '2026-02-28 06:07:59', '2026-02-28 06:07:59'),
(267, 283, 1, 'Draft', 'Status changed to Draft from Processing', '2026-02-28 06:08:57', '2026-02-28 06:08:57'),
(268, 283, 1, 'Marked as Done', 'Status changed to Processing', '2026-02-28 06:19:07', '2026-02-28 06:19:07'),
(269, 282, 2, 'Pre-Audit Entry Deleted', 'Entry ID: 277', '2026-02-28 08:14:44', '2026-02-28 08:14:44'),
(270, 282, 1, 'Draft', 'Status changed to Draft from For Approval', '2026-03-01 14:16:12', '2026-03-01 14:16:12'),
(271, 282, 1, 'Pre-Audit Entry Deleted', 'Entry ID: 276', '2026-03-01 14:16:28', '2026-03-01 14:16:28'),
(272, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-03-01 14:36:11', '2026-03-01 14:36:11'),
(273, 282, 1, 'Pre-Audit Entry Deleted', 'Entry ID: 275', '2026-03-01 14:42:42', '2026-03-01 14:42:42'),
(274, 282, 1, 'Marked as Done', 'Status changed to Processing', '2026-03-01 14:42:53', '2026-03-01 14:42:53'),
(275, 282, 1, 'Pre-Audit Entry Added', 'Complied Amount: ₱500,000.00', '2026-03-01 14:43:28', '2026-03-01 14:43:28'),
(276, 282, 2, 'Pre-Audit Entry Added', 'Complied Amount: ₱200,000.00', '2026-03-01 14:45:40', '2026-03-01 14:45:40'),
(277, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-03-01 15:26:51', '2026-03-01 15:26:51'),
(278, 282, 2, 'Pre-Audit Entry Added', 'Complied Amount: ₱1.00', '2026-03-01 15:27:16', '2026-03-01 15:27:16'),
(279, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-03-01 15:30:35', '2026-03-01 15:30:35'),
(280, 282, 2, 'Pre-Audit Entry Added', 'Complied Amount: ₱1.00', '2026-03-01 15:30:52', '2026-03-01 15:30:52'),
(281, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-03-01 15:57:26', '2026-03-01 15:57:26'),
(282, 282, 1, 'Marked as Done', 'Status changed to Processing', '2026-03-01 16:06:46', '2026-03-01 16:06:46'),
(283, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-03-01 16:07:13', '2026-03-01 16:07:13'),
(284, 282, 2, 'Pre-Audit Entry Deleted', 'Entry ID: 283', '2026-03-01 16:07:52', '2026-03-01 16:07:52'),
(285, 282, 2, 'Marked as Done', 'Status changed to Processing', '2026-03-01 16:08:04', '2026-03-01 16:08:04'),
(286, 282, 1, 'Draft', 'Status changed to Draft from Processing', '2026-03-01 16:08:36', '2026-03-01 16:08:36'),
(287, 282, 1, 'Marked as Done', 'Status changed to Processing', '2026-03-02 14:57:45', '2026-03-02 14:57:45');

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
(8, '2025_05_19_141550_create_cash_advance_table', 1),
(9, '2025_07_27_111752_create_activity_logs_table', 2),
(10, '2025_07_27_120750_create_liquidation_activities_table', 3),
(11, '2025_07_27_124653_add_compliance_file_to_pre_auditor_liquidation_entries_table', 4),
(12, '2025_07_27_125017_fix_id_on_pre_auditor_liquidation_entries_table', 5),
(13, '2025_07_27_125516_fix_liquidation_id_auto_increment', 6),
(14, '2025_07_27_130005_fix_pre_auditor_liquidation_pivot_table', 7),
(15, '2025_07_28_095525_add_corporate_email_to_sdo_table', 8),
(16, '2025_07_28_095907_add_position_to_sdo_table', 9),
(17, '2025_07_28_100213_add_employment_status_and_station_columns_to_sdo_table', 10),
(18, '2025_08_14_093427_create_sent_mails_table', 11),
(19, '2025_08_31_222651_add_co_checker_to_pre_auditor_liquidation_entries_table', 12),
(20, '2025_09_01_144906_add_user_fk_to_pre_auditors_table', 13),
(21, '2025_10_16_140025_add_compliance_file_name_to_pre_auditor_liquidation_entries_table', 14);

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
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 6);

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

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ingrownmagic@gmail.com', '$2y$12$JH1Jp41kBRPey3RDp0Dgbe2WstK/ZrCHJR8CnPqsv1svwyIXhLBaC', '2025-09-02 06:21:08');

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
(2, 190, '2025-07-18', '2025-07-23', '2025-07-16', '2025-07-22', '2025-07-18 04:41:20'),
(3, 1, '1970-01-01', '1970-01-01', '2025-08-15', '2025-08-28', '2025-08-15 07:13:13');

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
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_auditors`
--

INSERT INTO `pre_auditors` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(9, 2, 'Bryan Trinidad', '2025-09-01 08:11:09', '2025-09-01 08:11:09'),
(10, 5, 'Alexis Bien', '2025-09-01 08:31:09', '2025-09-01 08:31:09'),
(12, 3, 'Nicky Palero', '2025-09-01 08:37:06', '2025-09-01 08:37:06'),
(13, 4, 'Paulo Maranan', '2025-09-01 08:37:10', '2025-09-01 08:37:10'),
(14, 6, 'Rommel Boco', '2026-02-26 02:49:29', '2026-02-26 02:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `pre_auditor_liquidation_entries`
--

CREATE TABLE `pre_auditor_liquidation_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pre_auditor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `liquidation_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `for_compliance` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `compliance_file` varchar(255) DEFAULT NULL,
  `compliance_file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_auditor_liquidation_entries`
--

INSERT INTO `pre_auditor_liquidation_entries` (`id`, `pre_auditor_id`, `liquidation_id`, `amount`, `for_compliance`, `created_at`, `updated_at`, `compliance_file`, `compliance_file_name`) VALUES
(260, 2, 263, 0.00, 5000.00, '2025-10-16 06:14:18', '2025-10-16 06:14:18', 'supporting_files/3pAEazWgnoqfsRVNDn8LgAlIaHaFqaXDYuurZkKP.pdf', NULL),
(261, 4, 263, 0.00, 10000.00, '2025-10-16 06:14:18', '2025-10-16 06:14:18', 'supporting_files/3pAEazWgnoqfsRVNDn8LgAlIaHaFqaXDYuurZkKP.pdf', NULL),
(262, 3, 263, 0.00, 5000.00, '2025-10-16 06:14:18', '2025-10-16 06:14:18', 'supporting_files/3pAEazWgnoqfsRVNDn8LgAlIaHaFqaXDYuurZkKP.pdf', NULL),
(263, 1, 263, 107354.00, 0.00, '2025-10-16 06:15:18', '2025-10-16 06:15:18', NULL, NULL),
(264, 4, 265, 0.00, 10000.00, '2025-10-16 06:16:30', '2025-10-16 06:16:30', 'supporting_files/vluTJPOQKgSr0y2xPNbb4eyr8mm4Ek3GQiYXjpiZ.pdf', NULL),
(265, 2, 265, 0.00, 15000.00, '2025-10-16 06:16:30', '2025-10-16 06:16:30', 'supporting_files/vluTJPOQKgSr0y2xPNbb4eyr8mm4Ek3GQiYXjpiZ.pdf', NULL),
(266, 1, 265, 1004000.00, 0.00, '2025-10-16 06:17:11', '2025-10-16 06:17:11', NULL, NULL),
(267, 2, 266, 0.00, 2000.00, '2025-10-16 06:21:11', '2025-10-16 06:21:11', 'supporting_files/9gIO2tX2tPQdfTPw0MHqDMs8cW8yxeLsoQJVhmkI.pdf', NULL),
(268, 3, 266, 0.00, 6000.00, '2025-10-16 06:21:11', '2025-10-16 06:21:11', 'supporting_files/9gIO2tX2tPQdfTPw0MHqDMs8cW8yxeLsoQJVhmkI.pdf', NULL),
(269, 4, 266, 0.00, 5000.00, '2025-10-16 06:21:11', '2025-10-16 06:21:11', 'supporting_files/9gIO2tX2tPQdfTPw0MHqDMs8cW8yxeLsoQJVhmkI.pdf', NULL),
(270, 1, 266, 1900000.00, 0.00, '2025-10-16 06:21:40', '2025-10-16 06:21:40', NULL, NULL),
(271, 1, 267, 1917500.00, 0.00, '2025-10-16 11:42:43', '2025-10-16 11:42:43', NULL, NULL),
(272, 1, 268, 712000.00, 0.00, '2025-10-16 11:43:04', '2025-10-16 11:43:04', NULL, NULL),
(273, 1, 269, 1651000.00, 0.00, '2025-10-16 11:43:46', '2025-10-16 11:43:46', NULL, NULL),
(274, 1, 282, 1000000.00, 0.00, '2026-02-06 00:07:01', '2026-02-06 00:07:01', NULL, NULL),
(278, 2, 283, 0.00, 50000.00, '2026-02-28 06:07:59', '2026-02-28 06:07:59', 'supporting_files/u9bBX9lazAYR7Kb3ga7DrbY5J7EZFUhPlEbAAjMW.pdf', NULL),
(279, 3, 283, 0.00, 90000.00, '2026-02-28 06:07:59', '2026-02-28 06:07:59', 'supporting_files/u9bBX9lazAYR7Kb3ga7DrbY5J7EZFUhPlEbAAjMW.pdf', NULL),
(280, 1, 282, 500000.00, 0.00, '2026-03-01 14:43:28', '2026-03-01 14:43:28', NULL, NULL),
(281, 2, 282, 200000.00, 0.00, '2026-03-01 14:45:40', '2026-03-01 14:45:40', NULL, NULL),
(282, 2, 282, 1.00, 0.00, '2026-03-01 15:27:16', '2026-03-01 15:27:16', NULL, NULL);

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
(2, 'pre-auditor', 'web', '2025-07-06 05:14:42', '2025-08-31 05:35:37'),
(3, 'user', 'web', '2025-07-06 05:14:42', '2025-07-06 05:14:42'),
(4, 'reporting', 'web', '2025-08-31 05:34:46', '2025-08-31 05:34:46'),
(5, 'verifier', 'web', '2025-09-19 07:38:36', '2025-09-19 07:38:36');

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

--
-- Dumping data for table `sack_assignment`
--

INSERT INTO `sack_assignment` (`id`, `liq_number`, `sack_number`, `created_at`, `updated_at`) VALUES
(1, 'L-25-01-00003', '1', '2025-11-07 02:30:04', '2025-11-07 02:30:04'),
(2, 'L-25-01-00004', '1', '2025-11-07 02:30:04', '2025-11-07 02:30:04'),
(3, 'L-25-01-00005', '1', '2025-11-07 02:30:04', '2025-11-07 02:30:04'),
(4, 'L-25-02-00025', '1', '2025-11-07 02:30:04', '2025-11-07 02:30:04'),
(5, 'L-25-02-00027', '1', '2025-11-07 02:30:04', '2025-11-07 02:30:04'),
(6, 'L-OE-25-03-0021', '1', '2025-11-07 02:30:04', '2025-11-07 02:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `sdo`
--

CREATE TABLE `sdo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `official_station` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `corporate_email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sdo`
--

INSERT INTO `sdo` (`id`, `name`, `employment_status`, `official_station`, `email`, `corporate_email`, `contact_number`, `position`, `created_at`, `updated_at`) VALUES
(153, 'Alexis Bien', 'CONTRACTUAL', 'ALBAY', 'ingrownmagic@gmail.com', 'ingrownmagic@gmail.com', '09171234567', 'SWO IV', '2025-08-27 15:43:42', '2025-08-27 15:43:42'),
(154, 'Bryan Trinidad', 'PERMANENT', 'CAMARINES NORTE', 'jazzvalid1@gmail.com', 'jazzvalid1@gmail.com', '09179876543', 'SWO II', '2025-08-27 15:43:42', '2025-08-27 15:43:42'),
(155, 'Nicky Palero', 'PERMANENT', 'FO V', 'reportermagic@gmail.com', 'reportermagic@gmail.com', '09171234567', 'PO IV', '2025-08-27 15:43:42', '2025-08-27 15:43:42'),
(156, 'Paulo Maranan', 'CONTRACTUAL', 'CATANDUANES- AICS', 'roselernboco@gmail.com', 'roselernboco@gmail.com', '09179876543', 'PDO II', '2025-08-27 15:43:42', '2025-08-27 15:43:42'),
(157, 'Rommel Boco', 'Contract of Service', 'Tagaytay', 'rommel@gmail.com', 'rommel@gmail.com', '1231231212', 'Center', '2025-08-31 02:25:55', '2025-08-31 02:25:55'),
(158, 'Roseler Boco', 'Contractual', 'FOV', 'roselernboco16@gmail.com', 'roselernboco16@gmail.com', '123123123', 'AA-III', '2025-08-31 03:26:13', '2025-08-31 03:26:13'),
(160, 'roseler', 'Job Order', 'asdasda', 'asdasda@gmail.com', 'asdasda@gmail.com', '1231231', 'qweq', '2025-08-31 04:31:21', '2025-08-31 04:31:21'),
(161, 'ASDAS', 'OJT', 'ASDASD', 'ASDASD@GMAIL.COM', 'ASDASD@GMAIL.COM', '1231231', 'ASDAS', '2025-08-31 04:34:41', '2025-08-31 04:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `sent_mails`
--

CREATE TABLE `sent_mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sent_mails`
--

INSERT INTO `sent_mails` (`id`, `to`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 'john@example.com', 'Project Update', 'Hello John, here is the latest update on the project...', '2025-08-14 01:38:32', '2025-08-14 01:38:32'),
(2, 'sara@example.com', 'Invoice Sent', 'Hi Sara, Ive sent you the invoice for the last month...', '2025-08-14 01:38:42', '2025-08-14 01:38:42');

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
('Iod6mYSGpEOQkqzj681wATJfL1jXZhIep8AQjx47', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQXJWcXZkTkVBZ3ZTSkRSN1FpQzNLbHlhU1N6QWhuZ25XSUFpUjJtMSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xpcXVpZGF0aW9uLzI4Mi9wcmUtYXVkaXRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772524465),
('UY2GQJnpcSlkD3CNU3G4wrZX6fmaNLWudoAKuKQW', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSjZMSGl3SXFPSVpDeXhsMHMyeDRBUno4WmJJWlpaVGk2ZDZwM0ZPSyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xpcXVpZGF0aW9uLzI4My9wcmUtYXVkaXRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772524777);

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
(1, 'admin', 'roselernboco16@gmail.com', NULL, '$2y$12$MAw.g.tAHDGqq3o2B6klJeUJNR/JENNGlNzDQdsfVbNSGRK7iHOeu', 'UqsbdjUwWJFEExTwtvoAABGqzLk3YfWwZv6ZAl7qv9s1rlmLyQGEKeCedVYo', '2025-07-01 23:17:08', '2025-09-09 03:00:15'),
(2, 'Bryan Trinidad', 'roselernboco@gmail.com', NULL, '$2y$12$RhCT/6.2jDfwg3NU8wLmVusNNIZ9u8XsR4R61Yj/GwhTeIG6oiB4.', '2rXzruiMx5f7IUmD8uLeiXSktCJyZP8WR1xoCdlx1PMHPfkNQsR4jwh7YXxf', '2025-07-01 23:18:40', '2025-07-02 19:23:53'),
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
-- Indexes for table `liquidation`
--
ALTER TABLE `liquidation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cash_advance` (`cash_advance_id`);

--
-- Indexes for table `liquidation_activities`
--
ALTER TABLE `liquidation_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liquidation_activities_liquidation_id_foreign` (`liquidation_id`),
  ADD KEY `liquidation_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payout_date_histories`
--
ALTER TABLE `payout_date_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_auditors`
--
ALTER TABLE `pre_auditors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pre_auditors_user_id_unique` (`user_id`);

--
-- Indexes for table `pre_auditor_liquidation_entries`
--
ALTER TABLE `pre_auditor_liquidation_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_liquidation_id` (`liquidation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sack_assignment`
--
ALTER TABLE `sack_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdo`
--
ALTER TABLE `sdo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sdo_email_unique` (`email`);

--
-- Indexes for table `sent_mails`
--
ALTER TABLE `sent_mails`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `cash_advance`
--
ALTER TABLE `cash_advance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `liquidation`
--
ALTER TABLE `liquidation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `liquidation_activities`
--
ALTER TABLE `liquidation_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payout_date_histories`
--
ALTER TABLE `payout_date_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pre_auditors`
--
ALTER TABLE `pre_auditors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pre_auditor_liquidation_entries`
--
ALTER TABLE `pre_auditor_liquidation_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sack_assignment`
--
ALTER TABLE `sack_assignment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sdo`
--
ALTER TABLE `sdo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `sent_mails`
--
ALTER TABLE `sent_mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `create`
--
ALTER TABLE `create`
  ADD CONSTRAINT `create_sdo_id_foreign` FOREIGN KEY (`sdo_id`) REFERENCES `sdo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liquidation`
--
ALTER TABLE `liquidation`
  ADD CONSTRAINT `fk_cash_advance` FOREIGN KEY (`cash_advance_id`) REFERENCES `cash_advance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liquidation_activities`
--
ALTER TABLE `liquidation_activities`
  ADD CONSTRAINT `liquidation_activities_liquidation_id_foreign` FOREIGN KEY (`liquidation_id`) REFERENCES `liquidation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `liquidation_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pre_auditors`
--
ALTER TABLE `pre_auditors`
  ADD CONSTRAINT `pre_auditors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
