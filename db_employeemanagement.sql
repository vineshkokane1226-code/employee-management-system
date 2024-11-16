-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 06:23 AM
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
-- Database: `db_employeemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendences`
--

CREATE TABLE `tbl_attendences` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `check_in_time` time DEFAULT NULL,
  `late_time` varchar(255) DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `over_time` varchar(255) DEFAULT NULL,
  `total_working_hours` varchar(255) DEFAULT NULL,
  `status` enum('Present','Absent','On Leave','Partial Day') NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendences`
--

INSERT INTO `tbl_attendences` (`id`, `employee_id`, `date`, `check_in_time`, `late_time`, `check_out_time`, `over_time`, `total_working_hours`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(13, 7, '2024-11-19', '09:00:00', '', '17:30:00', '0 Hours 30 Minutes', '8 Hours 30 Minutes', 'Present', 'Very Good', '2024-11-16 03:52:42', '2024-11-16 03:52:42'),
(14, 5, '2024-11-16', '09:01:00', '0 Hours 1 Minutes', '18:01:00', '1 Hours 1 Minutes', '9 Hours 0 Minutes', 'Present', 'Awesome Work', '2024-11-16 04:01:45', '2024-11-16 04:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'CEO', 'The CEO (Chief Executive Officer) is the highest-ranking executive in an organization, responsible for setting its vision, strategy, and overall direction. ', 1, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Developer', 'A developer is a professional who designs, builds, and maintains software applications, systems, or websites using programming languages and tools. Developers play a key role in translating ideas and requirements into functional and efficient digital solutions.', 1, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Designer', 'A designer is a professional who conceptualizes, plans, and creates visual or functional elements to solve problems, enhance user experiences, or convey ideas.', 1, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Finance', 'Finance is the management of money, investments, and other financial resources to achieve personal, business, or institutional goals. It involves the processes of planning, allocating, investing, and monitoring funds to ensure efficiency, profitability, and sustainability.', 1, 3, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leaves`
--

CREATE TABLE `tbl_leaves` (
  `id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `reason` text NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leaves`
--

INSERT INTO `tbl_leaves` (`id`, `leave_type_id`, `requested_by`, `status`, `reason`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(2, 1, 7, 'Approved', '', '1997-12-22 00:00:00', '1989-11-21 00:00:00', '2024-11-09 08:52:38', '2024-11-09 08:52:38'),
(3, 1, 7, 'Approved', '', '2006-01-15 00:00:00', '1972-11-15 00:00:00', '2024-11-09 08:52:43', '2024-11-09 08:52:43'),
(4, 5, 7, 'Rejected', '', '2024-11-23 00:00:00', '2024-11-17 00:00:00', '2024-11-16 05:03:24', '2024-11-16 05:03:24'),
(5, 5, 7, 'Pending', '', '1999-07-03 00:00:00', '1991-10-21 00:00:00', '2024-11-16 05:43:46', '2024-11-16 05:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_types`
--

CREATE TABLE `tbl_leave_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_types`
--

INSERT INTO `tbl_leave_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Casual Leave', 1, 3, 3, '2024-11-09 07:21:10', '2024-11-09 07:21:10'),
(3, 'Annual Leave', 1, 3, 3, '2024-11-09 07:34:26', '2024-11-09 07:34:26'),
(5, 'Sick Leave', 1, 3, 3, '2024-11-09 09:26:32', '2024-11-09 09:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `joint_date` date NOT NULL,
  `leaved_date` date DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `role` enum('Employer','Employee') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `department_id`, `name`, `email`, `password`, `phone`, `address`, `position`, `joint_date`, `leaved_date`, `date_of_birth`, `gender`, `role`, `created_at`, `updated_at`, `status`) VALUES
(3, 2, 'Super Admin', 'superadmin@gmail.com', '6e088c3cf35987ad4e3dfc90e7b8dec6', '9843779778', 'Kathandu', 'Employer', '2024-11-10', '1970-01-01', '1970-02-21', 'Male', 'Employer', '2024-11-09 03:49:10', '2024-11-09 03:49:10', 1),
(5, 6, 'Manish Khadka', 'manish@gmail.com', '4def9ae5b32502d59a4c874997490932', '984655555555', 'Itahari', 'Businessman', '2024-11-20', NULL, '2024-11-09', 'Male', 'Employee', '2024-11-09 03:51:05', '2024-11-09 03:51:05', 1),
(7, 5, 'Rahul Rai', 'rahul@gmail.com', 'bf58d3ae3a4f63fdc9719204846e3ffd', '98045256857', 'Dharan', 'Teacher', '2024-11-10', NULL, '2024-11-10', 'Male', 'Employee', '2024-11-09 03:52:14', '2024-11-09 03:52:14', 1),
(9, 7, 'Rajesh Hamal', 'rajeshhamal@gmail.com', 'd22ad4d73b92f0348880d1a52106d510', '984378757585', 'Kathmandu', 'Actor', '2024-11-10', '1970-01-01', '2024-11-29', 'Male', 'Employee', '2024-11-09 03:52:44', '2024-11-09 03:52:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendences`
--
ALTER TABLE `tbl_attendences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_types`
--
ALTER TABLE `tbl_leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendences`
--
ALTER TABLE `tbl_attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_leave_types`
--
ALTER TABLE `tbl_leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
