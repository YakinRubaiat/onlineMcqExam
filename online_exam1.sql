-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2017 at 03:48 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chapter`
--

CREATE TABLE `tbl_chapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(100) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chapter`
--

INSERT INTO `tbl_chapter` (`chapter_id`, `chapter_name`, `subject_id`, `class_id`) VALUES
(7, 'à¦ªà§à¦°à¦¾à¦£à¦¿à¦œà¦—à¦¤à§‡à¦° à¦¶à§à¦°à§‡à¦£à¦¿à¦¬à¦¿à¦¨à§à¦¯à¦¾à¦¸', 25, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`class_id`, `class_name`) VALUES
(9, 'Six'),
(10, 'Seven'),
(11, 'Eight'),
(12, 'SSC (Nine to Ten)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_title` text NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) DEFAULT NULL,
  `option_4` varchar(255) DEFAULT NULL,
  `correct_option` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `test_id`, `question_title`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`, `created_at`) VALUES
(1, 9, 'What is your name?', 'Yakin', 'Akash', 'Nur', 'Polash', '1', '2017-12-22 03:04:49'),
(2, 9, 'Who is the prime minister of Bangladesh?', 'Shekh Hasina', 'Khaleda Jiya', 'Polash', NULL, '1', '2017-12-22 03:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subject_name`, `class_id`) VALUES
(5, 'Bangla First Paper', 12),
(6, 'Bangla Second Paper', 12),
(7, 'English First Paper', 12),
(8, 'English Second Paper', 12),
(9, 'Mathematics', 12),
(10, 'Bangla First Paper', 9),
(11, 'Bangla First Paper', 10),
(12, 'Bangla First Paper', 11),
(13, 'Bangla Second Paper', 9),
(14, 'Bangla Second Paper', 10),
(15, 'Bangla Second Paper', 11),
(16, 'English First Paper', 11),
(17, 'English First Paper', 10),
(18, 'English First Paper', 9),
(19, 'English Second Paper', 11),
(20, 'English Second Paper', 10),
(21, 'English Second Paper', 9),
(22, 'Mathematics', 11),
(23, 'Mathematics', 10),
(24, 'Mathematics', 9),
(25, 'General Sience', 11),
(26, 'Social Science', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `max_question` int(11) NOT NULL DEFAULT '40',
  `is_published` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `exam_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`id`, `test_name`, `max_question`, `is_published`, `created_at`, `exam_date`) VALUES
(9, 'Test 233', 40, 1, '2017-12-22 03:43:30', '2017-12-15 06:22:28'),
(10, 'Test 2', 40, 0, '2017-12-22 03:43:30', '0000-00-00 00:00:00'),
(11, 'Test 3', 40, 0, '2017-12-22 03:43:30', '0000-00-00 00:00:00'),
(12, 'Test 1 - a', 40, 0, '2017-12-22 03:43:30', '0000-00-00 00:00:00'),
(13, 'Test 1 - b', 40, 0, '2017-12-22 03:43:30', '0000-00-00 00:00:00'),
(14, 'Test 4', 40, 0, '2017-12-22 03:44:00', '0000-00-00 00:00:00'),
(17, 'Test Null', 40, 0, '2017-12-22 04:14:49', '0000-00-00 00:00:00'),
(18, 'TEst', 40, 0, '2017-12-22 04:16:28', '0000-00-00 00:00:00'),
(19, 'Test 8', 40, 0, '2017-12-22 19:36:48', '2017-12-14 12:12:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_chapter`
--
ALTER TABLE `tbl_chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
