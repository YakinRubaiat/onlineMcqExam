-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 04:28 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `q_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `q_title` text NOT NULL,
  `q1` varchar(255) NOT NULL,
  `q2` varchar(255) NOT NULL,
  `q3` varchar(255) NOT NULL,
  `q4` varchar(255) NOT NULL,
  `solution` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`q_id`, `class_id`, `subject_id`, `chapter_id`, `q_title`, `q1`, `q2`, `q3`, `q4`, `solution`) VALUES
(2, 2, 4, 6, 'What is your country name?', 'Bangladesh', 'India', 'Pakistan', 'Nepal', 1),
(3, 2, 4, 6, 'Who is the Father of Bangladesh?', 'Sher-E-Bangla A.K Fajlul Haque', 'Kazi Nazrul', 'Shekh Mujibur Rahman', 'Jiyaur Rahman', 3),
(4, 11, 25, 7, 'à¦†à¦œ à¦ªà¦°à§à¦¯à¦¨à§à¦¤  à¦•à¦¤ à¦²à¦•à§à¦· à¦ªà§à¦°à¦œà¦¾à¦¤à¦¿ à¦†à¦¬à¦¿à¦·à§à¦•à§ƒà¦¤ à¦¹à§Ÿà§‡à¦›à§‡ ?', 'à§§à§¦ à¦²à¦•à§à¦·', 'à§§à§« à¦²à¦•à§à¦·', 'à§¨à§¦ à¦²à¦•à§à¦·', 'à§©à§¦ à¦²à¦•à§à¦·', 2),
(5, 11, 25, 7, 'à¦¶à§à¦°à§‡à¦£à¦¿à¦¬à¦¿à¦¨à§à¦¯à¦¾à¦¸à§‡à¦° à¦¸à¦¬à¦šà§‡à§Ÿà§‡ à¦¨à¦¿à¦šà§‡à¦° à¦§à¦¾à¦ª à¦•à§‡ à¦•à¦¿ à¦¬à¦²à§‡?', 'à¦ªà§à¦°à¦œà¦¾à¦¤à¦¿', 'à¦—à¦£', 'à¦ªà¦°à§à¦¬', 'à¦¶à§à¦°à§‡à¦£à§€', 1),
(6, 11, 25, 7, 'à¦•à¦¾à¦•à§‡ à¦¶à§à¦°à§‡à¦£à¦¿à¦¬à¦¿à¦¨à§à¦¯à¦¾à¦¸à§‡à¦° à¦œà¦¨à¦• à¦¬à¦²à¦¾ à¦¹à§Ÿ?', 'à¦à¦°à¦¿à¦¸à§à¦Ÿà§à¦¯à¦¾à¦Ÿà¦²', 'à¦‰à¦‡à¦²à¦¿à§Ÿà¦¾à¦® à¦¹à¦¾à¦°à§à¦­à§‡', 'à¦¡à¦¾à¦°à¦‰à¦‡à¦¨', 'à¦•à§à¦¯à¦¾à¦°à§‹à¦²à¦¾à¦¸ à¦²à¦¿à¦¨à¦¿à§Ÿà¦¾à¦¸', 4),
(7, 11, 25, 7, 'à¦•à§‡à¦šà§‹ à¦“ à¦œà§‹à¦• à¦•à§‹à¦¨ à¦ªà¦°à§à¦¬à§‡à¦°?', 'à¦ªà§‡à¦°à¦¿à¦«à§‡à¦°à¦¾', 'à¦¨à¦¿à¦¡à¦¾à¦°à¦¿à§Ÿà¦¾', 'à¦à¦¨à¦¿à¦²à¦¿à¦¡à¦¾ ', 'à¦®à¦²à¦¾à¦¸à§à¦•à¦¾', 3),
(8, 11, 25, 7, 'à¦ªà§à¦°à¦¥à¦® à¦•à§Ÿà¦Ÿà¦¿ à¦ªà¦°à§à¦¬ à¦…à¦®à§‡à¦°à§à¦¦à¦¨à§à¦¡à§€?', 'à¦›à§Ÿà¦Ÿà¦¿', 'à¦†à¦Ÿà¦Ÿà¦¿', 'à¦¦à¦¶à¦Ÿà¦¿', 'à¦¤à¦¿à¦¨à¦Ÿà¦¿', 2),
(9, 11, 25, 7, 'à¦ªà§à¦°à¦¾à¦£à§€à¦œà¦—à¦¤à§‡à¦° à¦¸à¦¬à¦šà§‡à§Ÿà§‡ à¦¬à§ƒà¦¹à¦¤à§à¦¤à¦® à¦ªà¦°à§à¦¬ à¦•à§‹à¦¨à¦Ÿà¦¿?', 'à¦†à¦°à§à¦¥à§à¦°à§‹à¦ªà§‹à¦¡à¦¾', 'à¦¨à¦¿à¦¡à¦¾à¦°à¦¿à§Ÿà¦¾', 'à¦à¦¨à¦¿à¦²à¦¿à¦¡à¦¾ ', 'à¦®à¦²à¦¾à¦¸à§à¦•à¦¾', 1);

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
(25, 'General Sience', 11);

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
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subject_id`);

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
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
