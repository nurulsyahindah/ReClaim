-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2026 at 07:06 PM
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
-- Database: `reclaim`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `category` enum('user','lost_report','found_report','claim') NOT NULL,
  `is_read` enum('Yes','No') DEFAULT 'No',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `title`, `message`, `category`, `is_read`, `created`, `modified`) VALUES
(1, 'New User Registered', 'NURYANI NURYANI has created a new ReClaim account.', 'user', 'Yes', '2026-07-16 13:37:13', '2026-07-16 18:40:40'),
(2, 'New Found Report', 'nuryani submitted a Found Report for \"Iphone 13\".', 'found_report', 'Yes', '2026-07-16 13:47:01', '2026-07-16 17:59:41'),
(3, 'New Found Report', 'nuryani submitted a Found Report for \"Makeup Pouch\".', 'found_report', 'Yes', '2026-07-19 11:01:43', '2026-07-19 12:14:19'),
(4, 'New Found Report', 'nuryani submitted a Found Report for \"Necklace\".', 'found_report', 'Yes', '2026-07-19 11:23:48', '2026-07-19 12:14:17'),
(5, 'New Found Report', 'nuryani submitted a Found Report for \"Phone case\".', 'found_report', 'No', '2026-07-19 13:12:16', '2026-07-19 13:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created`, `modified`) VALUES
(1, 'Electronic', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(2, 'Wallet', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(3, 'Bag', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(4, 'Keys', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(5, 'Document', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(6, 'Clothing', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(7, 'Accessories', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(8, 'Others', '2026-06-27 08:48:09', '2026-06-27 08:48:09'),
(10, 'Stationary', '2026-07-16 09:08:15', '2026-07-16 10:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `report_id`, `user_id`, `reason`, `contact_number`, `evidence`, `status`, `created`, `modified`) VALUES
(1, 9, 1, 'i lost this yesterday and it matched with my lost item', '01023456789', NULL, 'Pending', '2026-06-28 17:23:55', '2026-06-28 18:04:39'),
(2, 8, 1, 'itu saya punyaaaaa', '01158801572', NULL, 'Pending', '2026-06-28 18:33:46', '2026-06-28 18:33:46'),
(3, 10, 1, 'This wallet belongs to me. It contains my student ID, ATM card and several personal cards. I can verify the contents if required.', '01158801572', NULL, 'Approved', '2026-06-29 00:32:33', '2026-07-15 18:30:25'),
(4, 13, 5, 'this item i punya laa, i tertinggal waktu exam', '0102729075', NULL, 'Approved', '2026-07-14 08:30:02', '2026-07-18 06:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `is_read` enum('Yes','No') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `created`, `modified`) VALUES
(1, 5, 'Report Approved', 'Your report \"Pink Water Bottle\" has been approved by the administrator.', '', '2026-07-13 15:17:11', '2026-07-13 15:17:11'),
(2, 5, 'Report Approved', 'Your report \"Black Umbrella\" has been approved by the administrator.', '', '2026-07-13 15:17:20', '2026-07-13 15:17:20'),
(3, 1, 'Claim Approved', 'Congratulations! Your claim for \"Black Leather Wallet\" has been approved. Please collect your item.', '', '2026-07-13 15:57:32', '2026-07-13 15:57:32'),
(4, 1, 'Claim Rejected', 'Your claim has been rejected by the administrator.', '', '2026-07-13 16:03:42', '2026-07-13 16:03:42'),
(5, 1, 'Claim Approved', 'Congratulations! Your claim for \"Black Leather Wallet\" has been approved. Please collect your item.', '', '2026-07-13 16:03:44', '2026-07-13 16:03:44'),
(6, 5, 'Report Rejected', 'Your report \"Phone Straps\" has been rejected by the administrator.', '', '2026-07-13 16:50:08', '2026-07-13 16:50:08'),
(7, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-13 16:50:14', '2026-07-13 16:50:14'),
(8, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-13 19:56:59', '2026-07-13 19:56:59'),
(9, 5, 'Report Rejected', 'Your report \"Phone Straps\" has been rejected by the administrator.', '', '2026-07-13 19:58:05', '2026-07-13 19:58:05'),
(10, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-13 19:58:41', '2026-07-13 19:58:41'),
(11, 5, 'Report Rejected', 'Your report \"Phone Straps\" has been rejected by the administrator.', '', '2026-07-13 20:19:00', '2026-07-13 20:19:00'),
(12, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-13 20:19:02', '2026-07-13 20:19:02'),
(13, 1, 'Report Approved', 'Your report \"Blue Laptop Backpack\" has been approved by the administrator.', '', '2026-07-13 20:31:31', '2026-07-13 20:31:31'),
(14, 1, 'Report Rejected', 'Your report \"Blue Laptop Backpack\" has been rejected by the administrator.', '', '2026-07-13 20:31:36', '2026-07-13 20:31:36'),
(15, 1, 'Claim Approved', 'Congratulations! Your claim for \"Black Leather Wallet\" has been approved. Please collect your item.', '', '2026-07-13 23:05:40', '2026-07-13 23:05:40'),
(16, 5, 'Report Rejected', 'Your report \"Coach bag\" has been rejected by the administrator.', '', '2026-07-13 23:27:50', '2026-07-13 23:27:50'),
(17, 5, 'Report Approved', 'Your report \"Coach bag\" has been approved by the administrator.', '', '2026-07-13 23:27:52', '2026-07-13 23:27:52'),
(18, 1, 'Report Approved', 'Your report \"charger\" has been approved by the administrator.', '', '2026-07-14 01:36:20', '2026-07-14 01:36:20'),
(19, 5, 'Claim Approved', 'Congratulations! Your claim for \"Student ID Card\" has been approved. Please collect your item.', '', '2026-07-14 08:30:22', '2026-07-14 08:30:22'),
(20, 5, 'Report Approved', 'Your report \"Apple MacBook\" has been approved by the administrator.', '', '2026-07-14 08:30:41', '2026-07-14 08:30:41'),
(21, 5, 'Report Rejected', 'Your report \"Apple MacBook\" has been rejected by the administrator.', '', '2026-07-14 08:30:44', '2026-07-14 08:30:44'),
(22, 5, 'Report Approved', 'Your report \"Spectacles\" has been approved by the administrator.', '', '2026-07-15 10:42:51', '2026-07-15 10:42:51'),
(23, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-15 16:43:27', '2026-07-15 16:43:27'),
(24, 5, 'Report Rejected', 'Your report \"Phone Straps\" has been rejected by the administrator.', '', '2026-07-15 16:43:31', '2026-07-15 16:43:31'),
(25, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-15 16:43:33', '2026-07-15 16:43:33'),
(26, 5, 'Claim Approved', 'Congratulations! Your claim for \"Student ID Card\" has been approved. Please collect your item.', '', '2026-07-15 18:14:17', '2026-07-15 18:14:17'),
(27, 1, 'Claim Rejected', 'Your claim has been rejected by the administrator.', '', '2026-07-15 18:15:50', '2026-07-15 18:15:50'),
(28, 5, 'Claim Rejected', 'Your claim has been rejected by the administrator.', '', '2026-07-15 18:30:22', '2026-07-15 18:30:22'),
(29, 1, 'Claim Approved', 'Congratulations! Your claim for \"Black Leather Wallet\" has been approved. Please collect your item.', '', '2026-07-15 18:30:25', '2026-07-15 18:30:25'),
(30, 5, 'Report Rejected', 'Your report \"Spectacles\" has been rejected by the administrator.', '', '2026-07-15 18:37:10', '2026-07-15 18:37:10'),
(31, 5, 'Report Approved', 'Your report \"Black Umbrella\" has been approved by the administrator.', '', '2026-07-15 18:39:59', '2026-07-15 18:39:59'),
(32, 5, 'Report Rejected', 'Your report \"Phone Straps\" has been rejected by the administrator.', '', '2026-07-18 06:57:35', '2026-07-18 06:57:35'),
(33, 5, 'Claim Approved', 'Congratulations! Your claim for \"Student ID Card\" has been approved. Please collect your item.', '', '2026-07-18 06:57:43', '2026-07-18 06:57:43'),
(34, 5, 'Report Approved', 'Your report \"Necklace\" has been approved by the administrator.', '', '2026-07-19 12:09:33', '2026-07-19 12:09:33'),
(35, 5, 'Report Approved', 'Your report \"Makeup Pouch\" has been approved by the administrator.', '', '2026-07-19 12:09:34', '2026-07-19 12:09:34'),
(36, 5, 'Report Approved', 'Your report \"Iphone 13\" has been approved by the administrator.', '', '2026-07-19 12:09:37', '2026-07-19 12:09:37'),
(37, 5, 'Report Approved', 'Your report \"Phone Straps\" has been approved by the administrator.', '', '2026-07-19 12:13:42', '2026-07-19 12:13:42'),
(38, 5, 'Report Approved', 'Your report \"Phone case\" has been approved by the administrator.', '', '2026-07-19 13:33:29', '2026-07-19 13:33:29'),
(39, 5, 'Claim Approved', 'Congratulations! Your claim for \"Student ID Card\" has been approved. Please collect your item.', '', '2026-07-19 13:34:08', '2026-07-19 13:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report_code` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type` enum('Lost','Found') NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `report_date` date NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected','Claimed') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_code`, `user_id`, `category_id`, `type`, `item_name`, `description`, `location`, `report_date`, `contact_number`, `image`, `status`, `created`, `modified`) VALUES
(10, 'L001', 1, 2, 'Lost', 'Black Leather Wallet', 'Lost my black leather wallet containing student ID and bank cards.', 'Library Level 2', '2026-06-28', '0102729075', '1784463666_1784449472_wallet.jfif', 'Claimed', '2026-06-29 00:12:44', '2026-07-19 12:21:06'),
(11, 'F001', 1, 4, 'Found', 'Car Keys with Red Keychain', 'Found a bunch of car keys near cafeteria entrance.', 'Cafeteria', '2026-06-27', '0102729075', '1784463651_key.jfif', 'Pending', '2026-06-29 00:15:06', '2026-07-19 12:20:51'),
(12, 'L002', 1, 3, 'Lost', 'Blue Laptop Backpack', 'Lost blue backpack containing notes and charger.', 'Seminar Hall 1', '2026-06-26', '0102729075', '1784463609_bluebag.jfif', 'Rejected', '2026-06-29 00:16:36', '2026-07-19 12:20:09'),
(13, 'F002', 1, 5, 'Found', 'Student ID Card', 'Found student ID card in classroom.', 'Block A Classroom 3', '2026-06-25', '0102729075', '1784463546_id_card.png', 'Claimed', '2026-06-29 00:17:49', '2026-07-19 12:19:17'),
(14, 'L003', 1, 1, 'Lost', 'iPhone 13 Black', 'Lost iPhone 13 with black silicone case.', 'Library Discussion Room', '2026-06-24', '0102729075', '1784463467_iphoneblack.jfif', 'Pending', '2026-06-29 00:18:59', '2026-07-19 12:17:47'),
(15, 'L004', 5, 7, 'Lost', 'Pink Water Bottle', 'Left my water bottle after class.', 'Block C', '2026-06-30', '0102729075', '1784462841_bottle.jfif', 'Approved', '2026-06-29 00:21:25', '2026-07-19 12:07:21'),
(16, 'F003', 5, 7, 'Found', 'Black Umbrella', 'Found umbrella near main gate.', 'Main Entrance', '2026-06-10', '0102729075', '1784462817_umbrella.jfif', 'Approved', '2026-06-29 00:23:15', '2026-07-19 12:06:57'),
(18, 'F004', 5, 7, 'Found', 'Spectacles', 'Found black frame spectacles inside classroom.', 'Lecture Hall 2', '2026-06-16', '0102729075', '1784462776_spec.jfif', 'Rejected', '2026-06-29 00:25:19', '2026-07-19 12:06:16'),
(19, 'L006', 5, 5, 'Lost', 'Green Notebook', 'Notebook contains lecture notes for Semester 4.', 'Library', '2026-06-22', '0102729075', '1784462742_notebook.jfif', 'Approved', '2026-06-29 00:26:13', '2026-07-19 12:05:42'),
(20, 'L007', 1, 1, 'Lost', 'charger', 'kerusi ', 'PTAR', '2026-06-24', '01158801572', NULL, 'Approved', '2026-06-29 02:00:33', '2026-07-14 01:36:19'),
(21, 'F005', 5, 1, 'Found', 'Apple MacBook', 'Found Apple Macbook colour pink at library', 'Library ', '2026-07-16', '0134998919', '1784462639_macbook.jfif', 'Approved', '2026-07-13 03:28:22', '2026-07-19 12:03:59'),
(23, 'L008', 5, 7, 'Lost', 'Phone Straps', 'I lost my black phone strap near the cafeteria. It has a small teddy bear charm and a silver key ring attached. If anyone has found it, please contact me using the number provided. Thank you.', 'Cafeteria', '2026-07-10', '0134998919', '1784462699_phonestraps.jfif', 'Approved', '2026-07-13 06:03:24', '2026-07-19 12:13:42'),
(24, 'F006', 5, 1, 'Found', 'Iphone 13', 'Found Iphone 13 colour', 'J4 Laman C', '2026-07-14', '0102729075', '1784462677_iphone13.jpeg', 'Approved', '2026-07-16 13:47:01', '2026-07-19 12:09:37'),
(25, 'F007', 5, 3, 'Found', 'Makeup Pouch', 'Found makeup pouch at prayer room', 'Prayer Room', '2026-07-21', '0102729075', '1784458903_makeup.jpeg', 'Approved', '2026-07-19 11:01:43', '2026-07-19 12:09:34'),
(26, 'F008', 5, 8, 'Found', 'Necklace', 'Found a necklace', 'gazebo laman c j2', '2026-07-15', '0102729075', '1784460228_necklace.jpeg', 'Approved', '2026-07-19 11:23:48', '2026-07-19 12:09:33'),
(27, 'F009', 5, 7, 'Found', 'Phone case', 'found phone case ', 'gazebo', '2026-07-15', '0123456789', '1784466736_phonecase.jpeg', 'Approved', '2026-07-19 13:12:16', '2026-07-19 13:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `student_id`, `email`, `password`, `role`, `created`, `modified`) VALUES
(1, 'NURUL SYAHINDAH HUSSAIN', '2024234528', '2024234528@student.uitm.edu.my', '$2y$10$PZfzu8G76al09MH431xJgucn0P5U0zDUVNaXB.g2/f357ghZwLGDu', 'user', '2026-06-27 04:35:27', '2026-06-27 04:35:27'),
(3, 'Laila', 'Admin001', 'admin01@reclaim.com', '$2y$10$sYhJhXRpCWr2uejI9OROSufAL9Gij.OncQxhjS2AYTnU8PJ5h/qE6', 'admin', '2026-06-27 07:21:09', '2026-06-27 07:21:09'),
(5, 'nuryani', '2024436152', 'yani@gmail.com', '$2y$10$oQrJhfAUeQwlnE.Bn.3mkOtlv5hnHcA3PCDjXNxKgSG1ypSgWqZSK', 'user', '2026-06-27 19:36:42', '2026-06-27 19:36:42'),
(10, 'NURYANI NURYANI', '2024436151', '2024436152@student.uitm.edu.my', '$2y$10$CZ1ZptVTB5TgkC5hzy.9tOl2EYMnXC8og0SPLP7yPekVnSAthuJJ6', 'user', '2026-07-16 13:37:13', '2026-07-16 13:37:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `report_id` (`report_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `report_code` (`report_code`),
  ADD KEY `user_id` (`user_id`,`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
