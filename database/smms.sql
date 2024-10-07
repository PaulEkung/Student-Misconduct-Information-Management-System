-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 02:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` mediumint(9) NOT NULL,
  `Admin_Id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Admin_Id`, `password`, `date`) VALUES
(1, '001-2022-din', '1937', '2022-11-16 21:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `appeal`
--

CREATE TABLE `appeal` (
  `id` mediumint(9) NOT NULL,
  `regNumber` varchar(50) NOT NULL,
  `appeal_Message` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appeal`
--

INSERT INTO `appeal` (`id`, `regNumber`, `appeal_Message`, `date`) VALUES
(1, '2020/nd/36117/cs', '                I am sorry for this misconduct', '2022-12-02 08:22:02'),
(2, '2020/nd/36117/cs', '                sir am very sorry', '2022-12-08 11:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` mediumint(9) NOT NULL,
  `feedbackMsg` varchar(200) NOT NULL,
  `regNumber` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `feedbackMsg`, `regNumber`, `date`) VALUES
(1, 'ok', ' 2020/nd/36117/cs', '2022-12-02 08:22:56'),
(2, 'accepted', ' 2020/nd/36117/cs', '2022-12-05 12:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `quick_report`
--

CREATE TABLE `quick_report` (
  `id` mediumint(9) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `report` varchar(250) NOT NULL,
  `image1` varchar(200) NOT NULL,
  `image2` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quick_report`
--

INSERT INTO `quick_report` (`id`, `unique_id`, `mobile`, `report`, `image1`, `image2`, `date`) VALUES
(1, '3637393736', '09088776655', 'blabalabalabalabalabalanalk', '09088776655638f29b291f774.62546424.jpg', '', '2022-12-06 11:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` mediumint(9) NOT NULL,
  `studentName` varchar(200) NOT NULL,
  `regNumber` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `student_category` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `misType` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `time` varchar(10) NOT NULL,
  `report_img` varchar(200) NOT NULL,
  `punishment` varchar(100) NOT NULL,
  `punishmentDate` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `studentName`, `regNumber`, `department`, `level`, `student_category`, `mobile`, `email`, `misType`, `description`, `time`, `report_img`, `punishment`, `punishmentDate`, `date`) VALUES
(1, 'Ekung Paul Ekarekup', '2020/nd/36117/cs', 'Computer Science', '200', 'ND-Regular', '09067476828', 'pauldrums32@gmail.com', 'Absenteeism', 'Hardly attends lectures', '2022-11-15', '', '', '', '2022-11-16 21:53:36'),
(2, 'Odey James Eta', '2020/nd/35882/cs', 'Computer Science', '100', 'ND-Regular', '09061971506', 'odeyjameseta2@gmail.com', 'Theft', 'Stole a text book belonging to another student', '2022-11-13', 'Odey James Eta63755eb98a6548.78230674.png', 'expulsion', '2022-12-05', '2022-12-05 12:05:55'),
(3, 'Odey James Eta', '2020/nd/35882/cs', 'Computer Science', '100', 'ND-Regular', '09061971506', 'odeyjameseta2@gmail.com', 'Theft', 'Stole a text book belonging to another student', '2022-11-13', 'Odey James Eta63756b9066a315.29805120.png', '', '', '2022-11-16 23:00:32'),
(4, 'Amap Sunday Erap', '2020/nd/35905/cs', 'Computer Science', '200', 'ND-Regular', '09078654321', 'amapsunday909@gmail.com', 'Absenteeism', 'Hardly attends lectures', '2022-11-21', '', 'expulsion', '2022-12-05', '2022-12-16 09:04:41'),
(5, 'Sandra James', '2020/nd/33333/cs', 'Computer Science', '200', 'ND-Regular', '09011111111', 'sandrajamesc@gmail.com', 'Bribery', 'Tried to sort HOD of computer science department', '2022-12-06', '', '', '', '2022-12-06 11:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `staffnotification`
--

CREATE TABLE `staffnotification` (
  `id` mediumint(9) NOT NULL,
  `department` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `department`, `password`, `Image`, `date`) VALUES
(1, 'M.E EZIECHINNA', 'Computer Science', 'dept-01', 'M.E EZIECHINNA63755b3ac0f6f8.47331664.jpg', '2022-11-16 21:50:50'),
(2, 'Odey James Eta', 'Agricultural Technology', 'password', 'Odey James Eta638ddd28b80d31.24345295.jpg', '2022-12-05 11:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `staffwriteadmin`
--

CREATE TABLE `staffwriteadmin` (
  `id` mediumint(9) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `msg` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffwriteadmin`
--

INSERT INTO `staffwriteadmin` (`id`, `Department`, `msg`, `date`) VALUES
(1, 'Computer Science', 'Hello admin', '2022-12-02 22:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` mediumint(9) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `regNumber` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studentName`, `department`, `regNumber`, `category`, `Image`, `password`, `date`) VALUES
(1, 'Ekung Paul Ekarekup', 'Computer Science', '2020/nd/36117/cs', 'ND', 'Ekung Paul Ekarekup63755b9e06ee48.84768322.jpg', 'password', '2022-11-16 21:52:30'),
(2, 'Odey James Eta', 'Computer Science', '2020/nd/35882/cs', 'ND', 'Odey James Eta63755e2b165350.20796826.jpg', 'password', '2022-11-16 22:03:23'),
(3, 'Amap Sunday Erap', 'Computer Science', '2020/nd/35905/cs', 'ND', 'Amap Sunday Erap637b3ea2033872.14403097.jpg', 'password', '2022-11-21 09:02:26'),
(4, 'Sandra James', 'Computer Science', '2020/nd/33333/cs', 'ND', 'Sandra James638f27c85c4c81.67461065.jpg', 'password', '2022-12-06 11:30:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appeal`
--
ALTER TABLE `appeal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_report`
--
ALTER TABLE `quick_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffnotification`
--
ALTER TABLE `staffnotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffwriteadmin`
--
ALTER TABLE `staffwriteadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appeal`
--
ALTER TABLE `appeal`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quick_report`
--
ALTER TABLE `quick_report`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staffnotification`
--
ALTER TABLE `staffnotification`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffwriteadmin`
--
ALTER TABLE `staffwriteadmin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
