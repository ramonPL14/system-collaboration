-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 08:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `submission`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(12) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `submission_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `subject`, `file_name`, `submission_date`) VALUES
(1, 'midoriya', 'izuku', '', 'SECTION-5.docx', '2023-05-08 21:51:33'),
(2, 'tanjiro', 'kamado', 'Networking 1', 'Router-Config.txt', '2023-05-08 21:53:37'),
(3, 'bell', 'cranel', 'Information Management', '', '2023-05-08 21:54:59'),
(4, 'naruto', 'namikaze', 'IPT 1', 'I-CAN-BE-HAPPY-NOW-MAYBE.pkt', '2023-05-08 22:04:04'),
(5, 'naruto', 'namikaze', 'IPT 1', 'I-CAN-BE-HAPPY-NOW-MAYBE.pkt', '2023-05-08 22:08:16'),
(6, 'naruto', 'namikaze', 'IPT 1', 'I-CAN-BE-HAPPY-NOW-MAYBE.pkt', '2023-05-08 22:09:21'),
(7, 'sasuke', 'uchiha', 'Networking 1', 'YEY-WE-MADE-IT.pkt', '2023-05-08 22:15:56'),
(8, 'sasuke', 'uchiha', 'Networking 1', 'YEY-WE-MADE-IT.pkt', '2023-05-08 22:16:47'),
(9, 'sasuke', 'uchiha', 'Networking 1', 'YEY-WE-MADE-IT.pkt', '2023-05-08 22:16:59'),
(10, 'sasuke', 'uchiha', 'Networking 1', 'YEY-WE-MADE-IT.pkt', '2023-05-08 22:17:40'),
(11, 'sasuke', 'uchiha', 'Networking 1', 'YEY-WE-MADE-IT.pkt', '2023-05-08 22:17:51'),
(12, '', '', '', 'Student POV.zip', '2023-05-11 14:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
