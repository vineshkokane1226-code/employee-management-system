-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 04:48 AM
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
-- Table structure for table `tbl_leaves`
--

CREATE TABLE `tbl_leaves` (
  `id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leaves`
--

INSERT INTO `tbl_leaves` (`id`, `leave_type_id`, `requested_by`, `approved_by`, `status`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(2, 1, 7, 3, 'Approved', '1997-12-22 00:00:00', '1989-11-21 00:00:00', '2024-11-09 08:52:38', '2024-11-09 08:52:38'),
(3, 1, 7, 3, 'Approved', '2006-01-15 00:00:00', '1972-11-15 00:00:00', '2024-11-09 08:52:43', '2024-11-09 08:52:43');

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
(1, 'Fever', 1, 3, NULL, '2024-11-09 07:21:10', '2024-11-09 07:21:10'),
(3, 'Urgently', 1, 3, 3, '2024-11-09 07:34:26', '2024-11-09 07:34:26'),
(5, 'Half Day', 1, 3, 3, '2024-11-09 09:26:32', '2024-11-09 09:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
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

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `phone`, `address`, `position`, `joint_date`, `leaved_date`, `date_of_birth`, `gender`, `role`, `created_at`, `updated_at`, `status`) VALUES
(3, 'Super Admin', 'superadmin@gmail.com', '6e088c3cf35987ad4e3dfc90e7b8dec6', '9843779778', 'Kathandu', 'Employer', '2024-11-10', '2024-11-25', '1970-02-21', 'Male', 'Employer', '2024-11-09 03:49:10', '2024-11-09 03:49:10', 1),
(5, 'Manish Khadka', 'manish@gmail.com', '4def9ae5b32502d59a4c874997490932', '984655555555', 'Itahari', 'Businessman', '2024-11-20', '2024-11-30', '2024-11-09', 'Male', 'Employee', '2024-11-09 03:51:05', '2024-11-09 03:51:05', 1),
(7, 'Rahul Rai', 'rahul@gmail.com', 'bf58d3ae3a4f63fdc9719204846e3ffd', '98045256857', 'Dharan', 'Teacher', '2024-11-10', '2024-11-15', '2024-11-10', 'Male', 'Employee', '2024-11-09 03:52:14', '2024-11-09 03:52:14', 1),
(9, 'Rajesh Hamal', 'rajeshhamal@gmail.com', 'd22ad4d73b92f0348880d1a52106d510', '984378757585', 'Kathmandu', 'Actor', '2024-11-10', '2024-11-30', '2024-11-29', 'Male', 'Employee', '2024-11-09 03:52:44', '2024-11-09 03:52:44', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_leave_types`
--
ALTER TABLE `tbl_leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
