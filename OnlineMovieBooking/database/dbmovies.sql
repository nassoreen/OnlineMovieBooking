-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 01:23 PM
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
-- Database: `dbmovies`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid` int(11) NOT NULL,
  `theaterid` int(11) NOT NULL,
  `bookingdate` date NOT NULL,
  `person` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `theaterid`, `bookingdate`, `person`, `userid`, `status`) VALUES
(54, 36, '2024-10-20', '1', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL,
  `catname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catname`) VALUES
(1, 'Thriller'),
(2, 'Fantasy'),
(5, 'Action'),
(12, 'Adventure'),
(13, 'Comedy'),
(15, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classid` int(11) NOT NULL,
  `classname` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `releasedate` date NOT NULL,
  `image` varchar(1000) NOT NULL,
  `trailer` varchar(1000) NOT NULL,
  `movie` varchar(10000) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieid`, `title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `rating`, `catid`) VALUES
(27, 'SPIDERMAN MILES MORALES', 'ตัวตนที่แท้จริงของปีเตอร์ ปาร์คเกอร์ถูกเปิดเผยให้คนทั้งโลกรู้ ปีเตอร์ต้องการความช่วยเหลืออย่างมาก', '2024-10-20', 'spiderman.jpg', 'smart phone mode.mp4', 'smart phone mode.mp4', '', 5),
(30, 'JOKKER', 'สนุกมาก', '2024-10-21', 'jokker.jpg', '', '', '', 5),
(31, 'AVATAR', 'สนุกมาก', '2024-10-22', 'avatar.jpg', '', '', '', 2),
(32, 'VENOM', 'สนุกมาก', '2024-10-22', 'venom.jpg', '', '', '', 5),
(35, 'STAR  WARS', '', '2024-10-24', 'starwar.jpg', '', '', '', 2),
(36, 'IT', 'หลอน', '2024-10-24', 'it.jpg', '', '', '', 1),
(37, 'TEARS OF THE SUN', '', '2024-10-22', 'download.jpeg', '', '', '', 2),
(39, 'WORDWAR', 'น่ากลัว', '2024-10-21', 'WORDWAR.jpg', '', '', '', 1),
(40, 'WARCRAFT', '', '2024-10-21', 'Warcraft.jpg', '', '', '', 2),
(41, 'WAKANDA FOREVER', 'น่าเศร้า', '2024-10-24', 'WAKANDA FOREVER.jpg', 'mov_bbb.mp4', 'mov_bbb.mp4', '', 5),
(42, 'TRILER', 'สยอง', '2024-10-22', 'triler.jpg', '', '', '', 1),
(43, 'THE RING OF POWER', 'ประวัติศาสตร์', '2024-10-24', 'The Rings Of Power.jpg', '', '', '', 13),
(44, 'SHANG-CHI', 'ตลกนิดหน่อย', '2024-10-30', 'SHANG-CHI.jpg', '', '', '', 13),
(45, 'ROBIN HOOD', '', '2024-10-30', 'Robin Hood.jpg', '', '', '', 2),
(46, 'PIRATES OF THE CARIBBEAN', 'ผจญภัย', '2024-10-28', 'Pirates of the Caribbean.jpg', '', '', '', 12),
(47, 'MADMAX', '', '2024-11-06', 'MADMAX.jpg', '', '', '', 2),
(48, 'IRONMAN', '', '2024-10-30', 'IRONMAN.jpg', '', '', '', 5),
(49, 'FREE GUY', 'ฮาอยู่', '2024-10-23', 'FREEGUY.jpg', '', '', '', 13),
(50, 'DEADPOOL', 'ต่อสู้', '2024-10-21', 'DEADPOOL.jpg', '', '', '', 5),
(51, 'CAPTAIN MAVEL', '', '2024-10-22', 'CAPTAIN MAVEL.jpg', '', '', '', 5),
(54, 'US', 'น่ากลัวจัด', '2024-10-22', 'US.jpg', '', '', '', 1),
(55, 'TALK TO ME', 'สยอง', '2024-10-24', 'TALK TO ME.jpg', '', '', '', 1),
(56, 'THE LAST OF US', 'หลอนๆ', '2024-10-22', 'THE LAST OF US.jpg', '', '', '', 12),
(57, 'ARCHER', 'สนุกมาก', '2024-10-21', 'ARCHER.jpg', '', '', '', 12),
(58, 'THE MAZE RUNNER', 'สนุกมาก', '2024-10-24', 'THE MAZE RUNNER.jpg', '', '', '', 12),
(59, 'THE MAZE RUNNER 2', 'สนุกมาก', '2024-10-25', 'THE MAZE RUNNER 2.jpg', '', '', '', 12),
(61, 'MADMAX', 'ดี', '2024-10-21', 'MADMAX.jpg', '', '', '', 13),
(62, 'test2222', 'สนุกมาก', '2024-10-20', 'US.jpg', '', '', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `region_name`) VALUES
(1, 'ปัตตานี'),
(2, 'ยะลา'),
(3, 'นราธิวาส');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theaterid` int(11) NOT NULL,
  `theater_name` varchar(100) NOT NULL,
  `timing` varchar(50) NOT NULL,
  `days` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image_theater` varchar(1000) NOT NULL,
  `movieid` int(11) DEFAULT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`theaterid`, `theater_name`, `timing`, `days`, `date`, `price`, `location`, `image_theater`, `movieid`, `region_id`) VALUES
(28, 'เมเจอร์ บิ๊กซี', '14:00', 'วันจันทร์', '2024-10-21', 150, 'อำเภอเมือง', '', 31, 3),
(29, 'โลตัส เมเจอร์', '11:00', 'วันจันทร์', '2024-10-21', 200, 'อำเภอเมือง', '', 27, 2),
(30, 'บิกซี เมเจอร์', '11:00', 'วันจันทร์', '2024-10-21', 120, 'อำเภอเมือง', '', 30, 1),
(32, 'โคลิเซียม ', '11:00', 'วันอังคาร', '2024-10-22', 150, 'อำเภอเมือง', '', 44, 2),
(33, 'บิกซี เมเจอร์', '12:00', 'วันอังคาร', '2024-10-22', 120, 'อำเภอ', '', 27, 1),
(34, 'บิกซี เมเจอร์', '15:00', 'วันจันทร์', '2024-10-21', 120, 'อำเภอเมือง', '', 31, 2),
(35, 'บิกซี เมเจอร์', '12:30', 'วันจันทร์', '2024-10-21', 150, 'อำเภอเมือง', '', 27, 3),
(36, 'บิกซี เมเจอร์', '19:30', 'วันอังคาร', '2024-10-22', 120, 'อำเภอเมือง', '', 36, 3),
(37, 'โลตัส เมเจอร์', '19:00', 'วันพุธ', '2024-10-23', 99, 'อำเภอเมือง', '', 36, 2),
(38, 'บิกซี เมเจอร์', '20:00', 'วันอังคาร', '2024-10-22', 120, 'อำเภอเมือง', '', 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roteype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`, `roteype`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 1),
(8, 'reen', 'reen123@gmail.com', '1234', 2),
(20, 'Dong', 'Dong123@gmail.com', '1234', 2),
(21, 'Chabu', 'chabu123@gmail.com', '1234', 2),
(22, 'test01', 'test01@gmail.com', '1234', 2),
(23, 'test65', 'test65@gmail.com', '1234', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `FK_booking_users` (`userid`),
  ADD KEY `FK_booking` (`theaterid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieid`),
  ADD KEY `FK_movies` (`catid`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterid`),
  ADD KEY `FK_theater` (`movieid`),
  ADD KEY `FK_region` (`region_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `theaterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_booking` FOREIGN KEY (`theaterid`) REFERENCES `theater` (`theaterid`),
  ADD CONSTRAINT `FK_booking_users` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `FK_movies` FOREIGN KEY (`catid`) REFERENCES `categories` (`catid`);

--
-- Constraints for table `theater`
--
ALTER TABLE `theater`
  ADD CONSTRAINT `FK_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`region_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
