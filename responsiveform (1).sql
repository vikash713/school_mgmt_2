-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 11:47 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `responsiveform`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_duration`) VALUES
(6, 'css', '22'),
(14, 'PHP', '6'),
(15, 'Express js', '9'),
(16, 'mongodb', '9'),
(17, 'Node js', '7'),
(18, 'html', '9');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `fname`, `lname`, `password`, `cpassword`, `gender`, `email`, `phone`, `address`) VALUES
(34, 'aditya', 'kumar', '$2y$10$mLHghavOfRLfsnNb8l7vO.NX.SKYmYlKR8GItwUai7gG83vqGqAxe', '', '', 'vikash@123', '1234567890', '123'),
(35, 'vikash', 'singh', '$2y$10$pcoRRJ5QbhZsHHmuv53yIe1i60kZTYKSy5Ohq.OVi3UAE5fAVNBxa', '', '', 'a@123', '1234567890', '123'),
(36, 'saurav', 'singh', '$2y$10$dwqc79/Qln61C9kO4tvhwuSOGZPnvmtg6dp1L44T99r6PXgR0LScK', '', '', 'b@123', '1234567890', '000'),
(37, 'vikash', 'kumar', '$2y$10$2tPW15aZNkbG3M9OgX0hdOZANyXpDhHkZSPJ24.Z7/77urWyjpjGS', '', '', 'c@123', '1234567890', '000'),
(38, 'vikash', 'kumar', '$2y$10$rNYjW0SLNC7.0a1lMF3ceuWj.Bh6dUvVDQjRx.AHQdTxAeFwMaYk.', '', '', 'd@123', '1234567890', '77'),
(39, 'vikash', 'kumar', '$2y$10$iqOZaKLHFTXBd5c26wpKeutB2V6OwnDyvPjv70k3.49ZJycMIltF.', '', '', 'f@123', '1234567890', '01'),
(40, 'ram', 'singh', '$2y$10$JuGBcos7p7bQYIsui8u8tO67qIfDlqmAFlAO0BxcfO6S3iBq4M8o2', '', '', 'y@123', '1234567890', 'pune'),
(41, 'ram', '12', '$2y$10$lq/NRzOZL0IdoJ5OEisBW.cV8qYmBWB5IU/o5x4Kc.8G8HuMFEsD.', '', '', 'ram@123', '1234567890', 'pi'),
(42, 'aditya', '12', '$2y$10$KhJcsY3wVe3bYK0P.O9l3OrXZPicoPJJxclkFwpSI.5MPGqvNIDrO', '', '', 'qp@123', '1234567890', 'patna');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `lname`, `password`, `cpassword`, `gender`, `email`, `phone`, `address`) VALUES
(119, 'adi', 'singh', '123456', '123456', 'Male', 'a@123', '1234567890', 'patna'),
(120, 'vikram', 'singh', '147852', '147852', 'Male', 'h@123', '1234567890', 'ranchi'),
(122, 'binit', 'kumar', '123654', '123654', 'Male', 'b@123', '1234567890', 'jainagar'),
(123, 'chotu', 'sungh', '147852', '147852', 'Male', 'vikash@456', '1234567890', 'yo'),
(127, 'ravindra', 'singh', '369852', '369852', 'Male', 'rm@122', '1234567890', 'mp');

-- --------------------------------------------------------

--
-- Table structure for table `studentcourse`
--

CREATE TABLE `studentcourse` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentcourse`
--

INSERT INTO `studentcourse` (`id`, `student_id`, `course_id`) VALUES
(12, 113, 6),
(24, 121, 5),
(25, 121, 6),
(26, 121, 10),
(27, 121, 13),
(48, 118, 6),
(49, 118, 14),
(50, 118, 15),
(58, 126, 6),
(59, 126, 18),
(66, 124, 6),
(67, 124, 14),
(68, 124, 15),
(69, 124, 18),
(70, 123, 6),
(71, 123, 14),
(72, 120, 6),
(73, 120, 14),
(74, 120, 15),
(80, 119, 6),
(81, 119, 14),
(82, 119, 15),
(85, 122, 6),
(86, 122, 14),
(87, 122, 15),
(92, 125, 6),
(93, 125, 14),
(94, 125, 15),
(95, 125, 18),
(96, 126, 6),
(97, 126, 18),
(111, 127, 6),
(112, 127, 14),
(113, 127, 18),
(114, 129, 18);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `fname`, `lname`, `password`, `cpassword`, `gender`, `email`, `phone`, `address`) VALUES
(15, 'bh', 'kumar', '147852', '147852', 'Node JS', 'a@123', '1234567890', 'patna'),
(16, 'vikash', 'singh', '147852', '147852', 'Male', 'vikash@123', '1234567890', 'patna'),
(18, 'saurav', 'singh', '123654', '123654', 'male', 's@123', '1234567890', 'ranchi'),
(22, 'Manish', 'singh', '123456', '123456', 'Male', 'm@123', '1234567890', 'bp'),
(31, 'ramprakash', 'singh', '369852', '369852', 'Male', 'rm@123', '1234567890', 'patna'),
(32, 'ramchandra', 'singh', '258963', '258963', 'Male', 'si@123', '943189109', 'patna');

-- --------------------------------------------------------

--
-- Table structure for table `teachercourse`
--

CREATE TABLE `teachercourse` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachercourse`
--

INSERT INTO `teachercourse` (`id`, `teacher_id`, `course_id`) VALUES
(7, 18, 15),
(8, 18, 16),
(9, 15, 16),
(10, 15, 17),
(11, 20, 5),
(30, 16, 6),
(31, 16, 14),
(32, 22, 6),
(33, 22, 14),
(41, 31, 6),
(42, 31, 18),
(45, 32, 6),
(46, 32, 15),
(47, 32, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fname` (`fname`);

--
-- Indexes for table `studentcourse`
--
ALTER TABLE `studentcourse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teachercourse`
--
ALTER TABLE `teachercourse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `studentcourse`
--
ALTER TABLE `studentcourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `teachercourse`
--
ALTER TABLE `teachercourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
