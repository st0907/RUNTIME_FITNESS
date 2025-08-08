-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 04:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `body_measurements`
--

CREATE TABLE `body_measurements` (
  `bdm_measurement_ID` int(11) NOT NULL,
  `bdm_member_ID` int(11) NOT NULL,
  `bdm_waist` decimal(5,2) DEFAULT NULL,
  `bdm_hip` decimal(5,2) DEFAULT NULL,
  `bdm_thigh` decimal(5,2) DEFAULT NULL,
  `bdm_entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_logs`
--

CREATE TABLE `daily_logs` (
  `dll_log_ID` int(11) NOT NULL,
  `dll_member_ID` int(11) NOT NULL,
  `dll_water_cups` int(11) DEFAULT NULL,
  `dll_sleep_hours` decimal(4,2) DEFAULT NULL,
  `dll_entry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_meals`
--

CREATE TABLE `journal_meals` (
  `jnm_meal_id` int(11) NOT NULL,
  `jnm_journal_id` int(11) NOT NULL,
  `jnm_meal_type` enum('breakfast','lunch','dinner','snack') NOT NULL,
  `jnm_food_name` varchar(100) NOT NULL,
  `jnm_portion_size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meal_plans`
--

CREATE TABLE `meal_plans` (
  `mpl_id` int(11) NOT NULL,
  `mpl_user_id` int(11) NOT NULL,
  `mpl_title` varchar(255) DEFAULT NULL,
  `mpl_plan_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mpl_plan_data`)),
  `mpl_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_profiles`
--

CREATE TABLE `member_profiles` (
  `mbp_user_ID` int(11) DEFAULT NULL,
  `mbp_dob` date DEFAULT NULL,
  `mbp_gender` varchar(10) DEFAULT NULL,
  `mbp_height` float DEFAULT NULL,
  `mbp_weight` float DEFAULT NULL,
  `mbp_goal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_journal`
--

CREATE TABLE `nutrition_journal` (
  `ntj_journal_id` int(11) NOT NULL,
  `ntj_user_id` int(11) NOT NULL,
  `ntj_entry_date` date NOT NULL,
  `ntj_breakfast_calories` int(11) DEFAULT NULL,
  `ntj_lunch_calories` int(11) DEFAULT NULL,
  `ntj_dinner_calories` int(11) DEFAULT NULL,
  `ntj_snacks_calories` int(11) DEFAULT NULL,
  `ntj_water_intake` varchar(20) DEFAULT NULL,
  `ntj_supplements` text DEFAULT NULL,
  `ntj_notes` text DEFAULT NULL,
  `ntj_mood` varchar(20) DEFAULT NULL,
  `ntj_created_at` datetime DEFAULT current_timestamp(),
  `ntj_updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_user_id` int(11) NOT NULL,
  `usr_username` varchar(50) DEFAULT NULL,
  `usr_full_name` varchar(100) DEFAULT NULL,
  `usr_email` varchar(100) DEFAULT NULL,
  `usr_phone` varchar(15) DEFAULT NULL,
  `usr_password` varchar(255) DEFAULT NULL,
  `usr_security_keyword` varchar(100) DEFAULT NULL,
  `usr_role` enum('member','coach','nutritionist') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weight_logs`
--

CREATE TABLE `weight_logs` (
  `wgl_weight_id` int(11) NOT NULL,
  `wgl_member_ID` int(11) DEFAULT NULL,
  `wgl_entry_date` date DEFAULT NULL,
  `wgl_weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan`
--

CREATE TABLE `workout_plan` (
  `wop_id` int(11) NOT NULL,
  `wop_user_id` varchar(50) DEFAULT NULL,
  `wop_height` decimal(5,2) DEFAULT NULL,
  `wop_weight` decimal(5,2) DEFAULT NULL,
  `wop_bmi` decimal(5,2) DEFAULT NULL,
  `wop_category` varchar(20) DEFAULT NULL,
  `wop_plan` mediumtext DEFAULT NULL,
  `wop_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workout_status`
--

CREATE TABLE `workout_status` (
  `wos_user_id` varchar(50) NOT NULL,
  `wos_day` varchar(20) NOT NULL,
  `wos_item` varchar(255) NOT NULL,
  `wos_checked` tinyint(1) DEFAULT NULL,
  `wos_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body_measurements`
--
ALTER TABLE `body_measurements`
  ADD PRIMARY KEY (`bdm_measurement_ID`),
  ADD KEY `memberID` (`bdm_member_ID`);

--
-- Indexes for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD PRIMARY KEY (`dll_log_ID`),
  ADD KEY `memberID` (`dll_member_ID`);

--
-- Indexes for table `journal_meals`
--
ALTER TABLE `journal_meals`
  ADD PRIMARY KEY (`jnm_meal_id`),
  ADD KEY `fk_jnm_journal` (`jnm_journal_id`);

--
-- Indexes for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD PRIMARY KEY (`mpl_id`);

--
-- Indexes for table `member_profiles`
--
ALTER TABLE `member_profiles`
  ADD KEY `userID` (`mbp_user_ID`);

--
-- Indexes for table `nutrition_journal`
--
ALTER TABLE `nutrition_journal`
  ADD PRIMARY KEY (`ntj_journal_id`),
  ADD UNIQUE KEY `unique_user_date` (`ntj_user_id`,`ntj_entry_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_user_id`),
  ADD UNIQUE KEY `username` (`usr_username`);

--
-- Indexes for table `weight_logs`
--
ALTER TABLE `weight_logs`
  ADD PRIMARY KEY (`wgl_weight_id`),
  ADD KEY `memberID` (`wgl_member_ID`);

--
-- Indexes for table `workout_plan`
--
ALTER TABLE `workout_plan`
  ADD PRIMARY KEY (`wop_id`);

--
-- Indexes for table `workout_status`
--
ALTER TABLE `workout_status`
  ADD PRIMARY KEY (`wos_user_id`,`wos_day`,`wos_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body_measurements`
--
ALTER TABLE `body_measurements`
  MODIFY `bdm_measurement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daily_logs`
--
ALTER TABLE `daily_logs`
  MODIFY `dll_log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `journal_meals`
--
ALTER TABLE `journal_meals`
  MODIFY `jnm_meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `meal_plans`
--
ALTER TABLE `meal_plans`
  MODIFY `mpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nutrition_journal`
--
ALTER TABLE `nutrition_journal`
  MODIFY `ntj_journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `weight_logs`
--
ALTER TABLE `weight_logs`
  MODIFY `wgl_weight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workout_plan`
--
ALTER TABLE `workout_plan`
  MODIFY `wop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `body_measurements`
--
ALTER TABLE `body_measurements`
  ADD CONSTRAINT `body_measurements_ibfk_1` FOREIGN KEY (`bdm_member_ID`) REFERENCES `member_profiles` (`mbp_user_ID`);

--
-- Constraints for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD CONSTRAINT `daily_logs_ibfk_1` FOREIGN KEY (`dll_member_ID`) REFERENCES `member_profiles` (`mbp_user_ID`);

--
-- Constraints for table `journal_meals`
--
ALTER TABLE `journal_meals`
  ADD CONSTRAINT `fk_jnm_journal` FOREIGN KEY (`jnm_journal_id`) REFERENCES `nutrition_journal` (`ntj_journal_id`) ON DELETE CASCADE;

--
-- Constraints for table `member_profiles`
--
ALTER TABLE `member_profiles`
  ADD CONSTRAINT `member_profiles_ibfk_1` FOREIGN KEY (`mbp_user_ID`) REFERENCES `users` (`USR_user_id`);

--
-- Constraints for table `nutrition_journal`
--
ALTER TABLE `nutrition_journal`
  ADD CONSTRAINT `fk_ntj_user` FOREIGN KEY (`ntj_user_id`) REFERENCES `users` (`USR_user_id`) ON DELETE CASCADE;

--
-- Constraints for table `weight_logs`
--
ALTER TABLE `weight_logs`
  ADD CONSTRAINT `weight_logs_ibfk_1` FOREIGN KEY (`wgl_member_ID`) REFERENCES `member_profiles` (`mbp_user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
