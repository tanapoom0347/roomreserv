-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 พ.ค. 2020 เมื่อ 07:57 AM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roomreserv`
--
CREATE DATABASE IF NOT EXISTS `roomreserv` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `roomreserv`;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_date` date DEFAULT NULL,
  `book_adult` int(2) DEFAULT NULL,
  `book_child` int(2) DEFAULT NULL,
  `book_scheduled` date DEFAULT NULL,
  `book_deposit` float(8,2) DEFAULT NULL,
  `book_paydate` date DEFAULT NULL,
  `book_total` float(8,2) DEFAULT NULL,
  `book_discount` float(8,2) DEFAULT NULL,
  `book_status_deposit` int(1) DEFAULT NULL,
  `book_status_pay` int(1) DEFAULT NULL,
  `book_debt` float(8,2) DEFAULT NULL,
  `book_note` varchar(50) DEFAULT NULL,
  `book_deposit_picture` varchar(255) DEFAULT NULL,
  `cus_id` int(5) DEFAULT NULL,
  `cus_id_2` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `book`
--

INSERT INTO `book` (`book_id`, `book_date`, `book_adult`, `book_child`, `book_scheduled`, `book_deposit`, `book_paydate`, `book_total`, `book_discount`, `book_status_deposit`, `book_status_pay`, `book_debt`, `book_note`, `book_deposit_picture`, `cus_id`, `cus_id_2`) VALUES
(1, '2020-04-01', 5, 2, '2020-04-01', 1350.00, '2020-04-01', 2700.00, 0.00, 6, 2, 0.00, '', 'S__3751939.jpg', 2, 1),
(2, '2020-04-02', 16, 0, '2020-04-02', 3600.00, '2020-04-02', 7200.00, 0.00, 2, 1, 7200.00, '', 'S__3751939.jpg', 4, 2),
(3, '2020-04-04', 12, 0, '2020-04-04', 5000.00, '2020-04-04', 10000.00, 0.00, 1, 1, 5000.00, '...', 'S__3751939.jpg', 3, 3),
(4, '2020-04-05', 5, 1, '2020-04-05', 1350.00, '2020-04-05', 2700.00, 0.00, 5, 2, 0.00, '..', 'S__3751939.jpg', 4, 3),
(5, '2020-05-06', 6, 2, '2020-04-06', 1850.00, '2020-04-06', 3700.00, 0.00, 5, 2, 0.00, '....', 'S__3751939.jpg', 4, 5),
(6, '2020-05-06', 13, 1, '2020-04-06', 3100.00, '2020-04-06', 6200.00, 0.00, 3, 1, 3100.00, '..............', 'S__3751939.jpg', 3, 3),
(7, '2020-04-02', 12, 0, '2020-04-02', 2500.00, '2020-04-02', 5000.00, 0.00, 2, 1, 5000.00, '', 'S__3751939.jpg', 1, 1),
(8, '2020-04-05', 2, 0, '2020-04-05', 1200.00, '2020-04-05', 2400.00, 0.00, 4, 3, 0.00, '', 'S__3751939.jpg', 2, 2),
(9, '2020-04-01', 8, 1, '2020-04-01', 1500.00, '2020-04-01', 3000.00, 0.00, 6, 2, 0.00, '', 'S__3751939.jpg', 4, 5),
(10, '2020-05-07', 6, 0, '2020-05-09', 1350.00, '2020-04-07', 2700.00, 0.00, 1, 1, 2700.00, '...', '', 6, 6),
(11, '2020-05-07', 14, 0, '2020-05-09', 3000.00, '2020-04-07', 6000.00, 0.00, 1, 1, 6000.00, '..', NULL, 6, 6),
(12, '2020-05-07', 2, 0, '2020-04-07', 600.00, '2020-04-07', 1200.00, 0.00, 3, 1, 600.00, '', 'S__3751939.jpg', 7, 7),
(13, '2020-05-07', 4, 0, '2020-05-08', 1200.00, '2020-04-07', 2400.00, 0.00, 4, 3, 0.00, '', 'S__3751939.jpg', 6, 5),
(14, '2020-05-14', 8, 0, '2020-05-14', 1050.00, '2020-04-14', 2100.00, 900.00, 2, 1, 2100.00, '', 'S__3751939.jpg', 6, 6),
(15, '2020-05-14', 6, 0, '2020-05-14', 945.00, '2020-04-14', 1890.00, 810.00, 6, 2, 0.00, '', 'S__3751939.jpg', 6, 6),
(16, '2020-05-14', 6, 0, '2020-05-14', 875.00, '2020-04-14', 1750.00, 750.00, 1, 1, 1750.00, '', NULL, 2, 2),
(17, '2020-05-28', 5, 3, '2020-05-28', 1050.00, '2020-04-28', 2100.00, 900.00, 0, 1, 2100.00, '', NULL, 2, 4),
(18, '2020-05-28', 7, 3, '2020-05-28', 1400.00, NULL, 2800.00, 1200.00, 4, 3, 1400.00, '-ขอเตียงเสริม1ที่', 'S__3751939.jpg', 2, 5),
(19, '2020-05-03', 6, 0, '2020-05-03', 1350.00, NULL, 2700.00, 0.00, 0, 1, 2700.00, '', NULL, 1, 3),
(20, '2020-05-05', 6, 0, '2020-05-05', 1350.00, NULL, 2700.00, 0.00, 0, 1, 2700.00, '', '', 1, 2),
(21, '2020-05-09', 0, 0, '2020-05-09', 2000.00, NULL, 4000.00, NULL, 1, 1, 2000.00, '', NULL, 5, 1),
(22, '2020-05-09', 0, 0, '2020-05-09', 1750.00, NULL, 3500.00, NULL, 5, 2, 1750.00, '', NULL, 6, 2),
(23, '2020-05-09', 0, 0, '2020-05-09', 4500.00, NULL, 9000.00, NULL, 3, 1, 4500.00, '', 'S__3751939.jpg', 4, 3),
(24, '2020-05-09', 0, 0, '2020-05-09', 2700.00, NULL, 5400.00, NULL, 6, 2, 0.00, '', 'S__3751939.jpg', 1, 2),
(25, '2020-05-11', 5, 1, '2020-05-11', 1350.00, NULL, 2700.00, 0.00, 4, 1, 1350.00, 'ขอเตียงเสริม', 'S__3751939.jpg', 10, 10),
(26, '2020-05-11', 6, 0, '2020-05-11', 1250.00, NULL, 2500.00, 0.00, 4, 3, 0.00, '', NULL, 10, 4),
(27, '2020-05-11', 10, 2, '2020-05-11', 2350.00, NULL, 4700.00, NULL, 5, 2, 0.00, 'ขอเตียงเตรียม 2 ที่', 'S__3751939.jpg', 2, 7),
(28, '2020-05-26', 10, 0, '2020-05-26', 2000.00, NULL, 4000.00, 0.00, 5, 2, 0.00, 'ขอเตียงเสริม1เตียง', '007.jpg', 1, 1),
(29, '2020-05-26', 0, 0, '2020-05-26', 2350.00, NULL, 4700.00, NULL, 0, 1, 2350.00, 'ขอเตียงเสริมเพิ่ม3ที่', NULL, 1, 1),
(30, '2020-05-28', 4, 0, '2020-05-28', 750.00, NULL, 1500.00, 0.00, 4, 1, 750.00, '', '007.jpg', 1, 1),
(31, '2020-05-28', 4, 0, '2020-05-28', 750.00, NULL, 1500.00, NULL, 4, 1, 750.00, '', NULL, 2, 1),
(32, '2020-05-28', 8, 0, '2020-05-28', 1750.00, NULL, 3500.00, NULL, 4, 1, 1750.00, '', NULL, 2, 2),
(33, '2020-05-28', 8, 0, '2020-05-28', 1500.00, NULL, 3000.00, NULL, 3, 1, 1500.00, '', NULL, 10, 10),
(34, '2020-05-28', 8, 0, '2020-05-28', 1750.00, NULL, 3500.00, NULL, 5, 2, 0.00, '', NULL, 2, 13),
(35, '2020-05-28', 8, 3, '2020-05-28', 4000.00, NULL, 8000.00, NULL, 6, 2, 0.00, '...', NULL, 9, 5),
(36, '2020-05-28', 8, 0, '2020-05-28', 1750.00, NULL, 3500.00, 0.00, 5, 2, 0.00, '...', '007.jpg', 3, 3),
(37, '2020-05-28', 8, 0, '2020-05-28', 1750.00, NULL, 3500.00, 0.00, 5, 2, 0.00, '..', '007.jpg', 3, 5),
(38, '2020-05-28', 3, 1, '2020-05-28', 1200.00, NULL, 2400.00, 0.00, 5, 2, 0.00, '123', '007.jpg', 4, 7),
(39, '2020-05-28', 6, 0, '2020-05-28', 1350.00, NULL, 2700.00, NULL, 3, 3, 1350.00, '12', NULL, 3, 3),
(40, '2020-05-29', 4, 0, '2020-05-30', 750.00, NULL, 1500.00, NULL, 4, 3, 750.00, '', NULL, 5, 5),
(41, '2020-05-29', 4, 0, '2020-05-29', 750.00, NULL, 1500.00, NULL, 4, 3, 750.00, '', NULL, 6, 6),
(42, '2020-05-29', 4, 0, '2020-05-29', 750.00, NULL, 1500.00, NULL, 3, 3, 750.00, '', NULL, 10, 10),
(43, '2020-05-29', 4, 0, '2020-05-29', 750.00, NULL, 1500.00, NULL, 4, 3, 750.00, '', NULL, 10, 10),
(44, '2020-05-29', 4, 0, '2020-05-29', 750.00, NULL, 1500.00, NULL, 5, 2, 0.00, '', NULL, 4, 4),
(45, '2020-05-29', 10, 1, '2020-05-29', 2000.00, NULL, 4000.00, NULL, 5, 2, 0.00, '1234', NULL, 6, 6),
(46, '2020-05-29', 8, 2, '2020-05-29', 2350.00, NULL, 4700.00, NULL, 5, 2, 0.00, '', NULL, 13, 13);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `booklist`
--

CREATE TABLE `booklist` (
  `booklist_id` int(5) NOT NULL,
  `booklist_datein` date DEFAULT NULL,
  `booklist_dateout` date DEFAULT NULL,
  `booklist_price` float(8,2) DEFAULT NULL,
  `booklist_note` varchar(50) DEFAULT NULL,
  `booklist_numadults` int(2) DEFAULT NULL,
  `booklist_numchild` int(2) DEFAULT NULL,
  `booklist_checkin` date NOT NULL,
  `booklist_checkout` date NOT NULL,
  `book_id` int(5) DEFAULT NULL,
  `room_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `booklist`
--

INSERT INTO `booklist` (`booklist_id`, `booklist_datein`, `booklist_dateout`, `booklist_price`, `booklist_note`, `booklist_numadults`, `booklist_numchild`, `booklist_checkin`, `booklist_checkout`, `book_id`, `room_id`) VALUES
(1, '2020-04-01', '2020-04-02', 1200.00, 'aaa', 2, 1, '2020-04-01', '2020-04-02', 1, 1),
(2, '2020-04-01', '2020-04-02', 1500.00, '.....', 3, 1, '2020-04-01', '2020-04-02', 1, 2),
(3, '2020-04-02', '2020-04-03', 2500.00, 'bbb', 6, 0, '2020-04-02', '2020-04-03', 2, 3),
(4, '2020-04-02', '2020-04-03', 3500.00, 'ccc', 8, 0, '2020-04-02', '2020-04-03', 2, 4),
(5, '2020-04-02', '2020-04-03', 1200.00, NULL, 2, 0, '2020-04-02', '2020-04-03', 2, 5),
(6, '2020-04-04', '2020-04-06', 1500.00, NULL, 4, 0, '2020-04-04', '2020-04-06', 3, 2),
(7, '2020-04-04', '2020-04-06', 3500.00, NULL, 8, 0, '2020-04-04', '2020-04-06', 3, 4),
(8, '2020-04-05', '2020-04-06', 1200.00, NULL, 2, 0, '2020-04-05', '2020-04-06', 4, 6),
(9, '2020-04-05', '2020-04-06', 1500.00, NULL, 3, 1, '2020-04-05', '2020-04-06', 4, 7),
(10, '2020-04-06', '2020-04-07', 1200.00, NULL, 2, 0, '2020-04-06', '2020-04-07', 5, 1),
(11, '2020-04-06', '2020-04-07', 2500.00, NULL, 4, 2, '2020-04-06', '2020-04-07', 5, 3),
(12, '2020-04-06', '2020-04-07', 1200.00, NULL, 2, 0, '2020-04-06', '2020-04-07', 6, 5),
(13, '2020-04-06', '2020-04-07', 3500.00, NULL, 7, 1, '2020-04-06', '2020-04-07', 6, 8),
(14, '2020-04-06', '2020-04-07', 1500.00, NULL, 4, 0, '2020-04-06', '2020-04-07', 6, 9),
(15, '2020-04-02', '2020-04-03', 1500.00, NULL, 4, 0, '2020-04-02', '2020-04-03', 7, 7),
(16, '2020-04-02', '2020-04-03', 3500.00, NULL, 8, 0, '2020-04-02', '2020-04-03', 7, 8),
(17, '2020-04-05', '2020-04-07', 1200.00, NULL, 2, 0, '2020-04-05', '2020-04-07', 8, 1),
(18, '2020-04-01', '2020-04-02', 1500.00, NULL, 4, 0, '2020-04-01', '2020-04-02', 9, 9),
(19, '2020-04-01', '2020-04-02', 1500.00, NULL, 4, 1, '2020-04-01', '2020-04-02', 9, 10),
(20, '2020-04-09', '2020-04-10', 1200.00, NULL, 2, 0, '2020-04-09', '2020-04-10', 10, 1),
(21, '2020-04-09', '2020-04-10', 1500.00, NULL, 4, 0, '2020-04-09', '2020-04-10', 10, 2),
(22, '2020-04-09', '2020-04-10', 2500.00, NULL, 6, 0, '2020-04-09', '2020-04-10', 11, 3),
(23, '2020-04-09', '2020-04-10', 3500.00, NULL, 8, 0, '2020-04-09', '2020-04-10', 11, 4),
(24, '2020-04-07', '2020-04-08', 1200.00, NULL, 2, 0, '2020-04-07', '2020-04-08', 12, 1),
(25, '2020-04-08', '2020-04-09', 1200.00, NULL, 2, 0, '2020-04-08', '2020-04-09', 13, 5),
(26, '2020-04-08', '2020-04-09', 1200.00, NULL, 2, 0, '2020-04-08', '2020-04-09', 13, 6),
(27, '2020-04-14', '2020-04-15', 1500.00, NULL, 4, 0, '2020-04-14', '2020-04-15', 14, 9),
(28, '2020-04-14', '2020-04-15', 1500.00, NULL, 4, 0, '2020-04-14', '2020-04-15', 14, 10),
(29, '2020-04-14', '2020-04-15', 1200.00, NULL, 2, 0, '2020-04-14', '2020-04-15', 15, 1),
(30, '2020-04-14', '2020-04-15', 1500.00, NULL, 4, 0, '2020-04-14', '2020-04-15', 15, 2),
(31, '2020-04-14', '2020-04-15', 2500.00, NULL, 6, 0, '2020-04-14', '2020-04-15', 16, 3),
(32, '2020-04-28', '2020-04-29', 1500.00, NULL, 2, 2, '2020-04-28', '2020-04-29', 17, 9),
(33, '2020-04-28', '2020-04-29', 1500.00, NULL, 3, 1, '2020-04-28', '2020-04-29', 17, 10),
(34, '2020-04-28', '2020-04-29', 1500.00, NULL, 3, 1, '2020-04-28', '2020-04-29', 18, 2),
(35, '2020-04-28', '2020-04-29', 2500.00, NULL, 4, 2, '2020-04-28', '2020-04-29', 18, 3),
(36, '2020-05-03', '2020-05-04', 1200.00, NULL, 2, 0, '2020-05-03', '2020-05-04', 19, 1),
(37, '2020-05-03', '2020-05-04', 1500.00, NULL, 4, 0, '2020-05-03', '2020-05-06', 19, 2),
(38, '2020-05-05', '2020-05-06', 1200.00, NULL, 2, 0, '2020-05-05', '2020-05-06', 20, 1),
(39, '2020-05-05', '2020-05-06', 1500.00, NULL, 4, 0, '2020-05-05', '2020-05-06', 20, 2),
(40, '2020-05-09', '2020-05-10', 1500.00, NULL, NULL, NULL, '2020-05-09', '2020-05-10', 21, 2),
(41, '2020-05-09', '2020-05-10', 2500.00, NULL, NULL, NULL, '2020-05-09', '2020-05-10', 21, 3),
(42, '2020-05-09', '2020-05-10', 3500.00, NULL, 6, 2, '2020-05-09', '2020-05-10', 22, 4),
(43, '2020-05-09', '2020-05-12', 1500.00, NULL, 3, 1, '2020-05-09', '2020-05-12', 23, 10),
(44, '2020-05-09', '2020-05-12', 1500.00, NULL, 2, 1, '2020-05-09', '2020-05-12', 23, 9),
(45, '2020-05-09', '2020-05-11', 1200.00, NULL, 4, 1, '2020-05-24', '2020-05-24', 24, 6),
(46, '2020-05-09', '2020-05-11', 1500.00, NULL, 3, 2, '2020-05-24', '2020-05-24', 24, 7),
(47, '2020-05-11', '2020-05-12', 1200.00, NULL, 2, 0, '2020-05-11', '2020-05-12', 25, 1),
(48, '2020-05-11', '2020-05-12', 1500.00, NULL, 3, 1, '2020-05-11', '2020-05-12', 25, 2),
(49, '2020-05-11', '2020-05-12', 2500.00, NULL, 6, 0, '2020-05-11', '2020-05-12', 26, 3),
(50, '2020-05-11', '2020-05-12', 3500.00, NULL, 7, 2, '2020-05-11', '2020-05-12', 27, 4),
(51, '2020-05-11', '2020-05-12', 1200.00, NULL, 2, 0, '2020-05-11', '2020-05-12', 27, 5),
(52, '2020-05-26', '2020-05-27', 1500.00, NULL, 4, 0, '2020-05-26', '0000-00-00', 28, 2),
(53, '2020-05-26', '2020-05-27', 2500.00, NULL, 6, 0, '2020-05-26', '0000-00-00', 28, 3),
(54, '2020-05-26', '2020-05-27', 3500.00, NULL, 7, 2, '0000-00-00', '0000-00-00', 29, 4),
(55, '2020-05-26', '2020-05-27', 1200.00, NULL, 2, 1, '0000-00-00', '0000-00-00', 29, 5),
(56, '2020-05-27', '2020-05-28', 1500.00, NULL, 4, 0, '2020-05-28', '0000-00-00', 30, 10),
(57, '2020-05-27', '2020-05-28', 1500.00, NULL, 4, 0, '2020-05-28', '0000-00-00', 31, 9),
(58, '2020-05-27', '2020-05-28', 3500.00, NULL, 8, 0, '2020-05-28', '0000-00-00', 32, 8),
(59, '2020-05-27', '2020-05-28', 1500.00, NULL, 4, 0, '0000-00-00', '0000-00-00', 33, 9),
(60, '2020-05-27', '2020-05-28', 1500.00, NULL, 4, 0, '0000-00-00', '0000-00-00', 33, 10),
(61, '2020-05-27', '2020-05-28', 3500.00, NULL, 8, 0, '2020-05-28', '0000-00-00', 34, 8),
(62, '2020-05-27', '0000-00-00', 1500.00, NULL, 3, 1, '2020-05-28', '2020-05-28', 35, 2),
(63, '2020-05-27', '0000-00-00', 2500.00, NULL, 5, 2, '2020-05-28', '2020-05-28', 35, 3),
(64, '2020-05-27', '2020-05-28', 3500.00, NULL, 8, 0, '0000-00-00', '0000-00-00', 36, 4),
(65, '2020-05-27', '2020-05-28', 3500.00, NULL, 8, 0, '2020-05-28', '0000-00-00', 37, 8),
(66, '2020-05-27', '2020-05-28', 1200.00, NULL, 1, 1, '2020-05-28', '0000-00-00', 38, 1),
(67, '2020-05-27', '2020-05-28', 1200.00, NULL, 2, 0, '2020-05-28', '0000-00-00', 38, 6),
(68, '2020-05-28', '2020-05-29', 1200.00, NULL, 2, 0, '0000-00-00', '0000-00-00', 39, 5),
(69, '2020-05-28', '2020-05-29', 1500.00, NULL, 4, 0, '0000-00-00', '0000-00-00', 39, 7),
(70, '2020-05-30', '2020-05-31', 1500.00, NULL, 4, 0, '2020-05-29', '0000-00-00', 40, 9),
(71, '2020-05-29', '2020-05-30', 1500.00, NULL, 4, 0, '2020-05-29', '0000-00-00', 41, 10),
(72, '2020-05-29', '2020-05-30', 1500.00, NULL, 4, 0, '0000-00-00', '0000-00-00', 42, 10),
(73, '2020-05-29', '2020-05-30', 1500.00, NULL, 4, 0, '2020-05-29', '0000-00-00', 43, 9),
(74, '2020-05-29', '2020-05-30', 1500.00, NULL, 4, 0, '2020-05-29', '0000-00-00', 44, 9),
(75, '2020-05-29', '2020-05-30', 1500.00, NULL, 4, 1, '2020-05-29', '0000-00-00', 45, 2),
(76, '2020-05-29', '2020-05-30', 2500.00, NULL, 6, 0, '2020-05-29', '0000-00-00', 45, 3),
(77, '2020-05-29', '2020-05-30', 1200.00, NULL, 2, 0, '2020-05-29', '0000-00-00', 46, 1),
(78, '2020-05-29', '2020-05-30', 3500.00, NULL, 6, 2, '2020-05-29', '0000-00-00', 46, 4);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(5) NOT NULL,
  `cus_citizenid` varchar(13) DEFAULT NULL,
  `cus_username` varchar(20) DEFAULT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `cus_address` varchar(100) DEFAULT NULL,
  `cus_phone` varchar(15) DEFAULT NULL,
  `cus_password` varchar(20) DEFAULT NULL,
  `cus_birthday` date DEFAULT NULL,
  `cus_email` varchar(30) DEFAULT NULL,
  `cus_status` int(1) DEFAULT NULL,
  `cus_type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_citizenid`, `cus_username`, `cus_name`, `cus_address`, `cus_phone`, `cus_password`, `cus_birthday`, `cus_email`, `cus_status`, `cus_type`) VALUES
(1, '3333333333333', 'user01', 'สมปอง ทองดี', '543 อ.เมือง จ.ปทุมธานี 15150', '081-4545454', '123456', '2005-07-07', 'User1@gmail.com', 1, 1),
(2, '1323123123132', 'user02', 'สมชาย อยู่สุข', '44 บางประกง กรุงเทพ 14140', '082-2323323', '123456', '1990-04-12', 'User2@gmail.com', 1, 1),
(3, '3215415113215', 'user03', 'สมหญิง แวววาว', '33 ม.3 คลองเตย กรุงเทพ 15343', '083-4305556', '123456', '1993-03-30', 'User3@gmail.com', 1, 1),
(4, '1213232312312', 'user04', 'สมศรี ใบบัว', '55 ม.5 คลอง5 ปทุมธานี 15210', '084-4321231', '123456', '1990-05-06', 'User4@gmail.com', 1, 1),
(5, '1111111111111', 'user05', 'สมหวัง อารมณ์ดี', '11 ม.1 หมู่1 ระยอง 12120', '081-1111111', '123456', '2020-02-20', 'User5@gmail.com', 1, 1),
(6, '1231231231231', 'user06', 'ยินดี ปรีดา', '123 ม.4', '082-2222222', '123456', '2001-02-20', 'user6@gmail.com', 1, 2),
(7, '1223122222332', 'user07', 'สมใจ แสนสุข', '222 ม.2 ตำบล ท่าพระจันทร์ จ.ปราจีนบุรี 22120', '082-2323223', '123456', '2002-12-01', 'user7@gmail.com', 1, 1),
(9, '1111111111111', 'user99', 'สมนึก ทองเหลา', '333 ม.3 กรุงเทพ 31130', '083-3333333', '123456', '0000-00-00', '11@11', 1, 1),
(10, '1231321321122', 'user22', 'สมชาย มรกต', '123 ม.2 จังหวัด กรุงเทพ', '061-8203070', '123456', '1994-05-26', 'user22@gmai.com', 1, 1),
(13, '1231321321321', '1231321321321', 'สมชัย เสกสรรค์', '', '083-3232323', '1231321321321', '1980-05-01', 'somchai1@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(5) NOT NULL,
  `emp_citizenid` varchar(13) DEFAULT NULL,
  `emp_username` varchar(20) DEFAULT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `emp_address` varchar(100) DEFAULT NULL,
  `emp_phone` varchar(15) DEFAULT NULL,
  `emp_birthday` date DEFAULT NULL,
  `emp_password` varchar(20) DEFAULT NULL,
  `emp_salary` int(6) DEFAULT NULL,
  `emp_email` varchar(30) DEFAULT NULL,
  `emp_status` int(1) DEFAULT NULL,
  `emp_level` int(1) DEFAULT NULL,
  `emp_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_citizenid`, `emp_username`, `emp_name`, `emp_address`, `emp_phone`, `emp_birthday`, `emp_password`, `emp_salary`, `emp_email`, `emp_status`, `emp_level`, `emp_picture`) VALUES
(1, '1231454165131', 'emp001', 'พจมาน สว่างวงศ์', '43 ม.5 กรุงเทพ 43430', '081-1231231', '1989-05-21', '123456', 15000, 'emp1@gmail.com', 1, 1, '11.jpg'),
(2, '1321231351321', 'emp002', 'สมชาย เข็มกลัด', '32 ม.3 กรุงเทพ 32320', '082-2342342', '1982-03-31', '123456', 15000, 'emp2@gmail.com', 1, 1, '22.jpg'),
(3, '213213243213', 'emp003', 'ป้อม บิ๊ก', '23 ม.2 กรุงเทพ 23230', '083-3453453', '1975-07-05', '123456', 18000, 'emp3@gmail.com', 2, 1, '33.jpg'),
(4, '121990066666', 'admin01', 'ธนะภูมิ เฟื่องทัศน์พาณิชย์', '58 ม.4 ระยอง 21160', '061-8203070', '1994-05-26', '111111', 25000, 'tanapoom.feau@bumail.net', 1, 2, '44.jpg'),
(5, '3333333333333', '3333333333333', '3333333333333333', '33 ม.3 กรุงเทพ 31330', '083-3333333', '0000-00-00', '3333333333333', 33333, '33333@a', 1, 1, '55.jpg'),
(10, '1231454165132', '1231454165132', 'เสกสรรค์ ทองดี', '', '', '0000-00-00', '1231454165132', 15000, 'somjai@gmail.com', 1, 1, '22.jpg'),
(13, '1231454165133', '1231454165133', 'สมใจ ทองกวา', '', '082-2222222', '0000-00-00', '1231454165133', 0, 'somjai@gmail.com', 1, 1, '11.jpg');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(5) NOT NULL,
  `receipt_outdate` date DEFAULT NULL,
  `receipt_status` int(1) DEFAULT NULL,
  `receipt_numcheck` varchar(10) DEFAULT NULL,
  `receipt_net` float(8,2) DEFAULT NULL,
  `receipt_detail` varchar(50) DEFAULT NULL,
  `receipt_bank` varchar(30) DEFAULT NULL,
  `receipt_branch` varchar(30) DEFAULT NULL,
  `receipt_paymenttype` int(1) DEFAULT NULL,
  `receipt_discount` float(8,2) DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  `cus_id` int(5) DEFAULT NULL,
  `emp_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `receipt_outdate`, `receipt_status`, `receipt_numcheck`, `receipt_net`, `receipt_detail`, `receipt_bank`, `receipt_branch`, `receipt_paymenttype`, `receipt_discount`, `receipt_date`, `cus_id`, `emp_id`) VALUES
(1, '2020-04-07', 1, '', 2550.00, '', '', '', 1, 0.00, '2020-04-07', 1, 4),
(2, '2020-04-07', 1, '', 3150.00, '', '', '', 2, 0.00, '2020-04-07', 4, 4),
(3, '2020-04-07', 0, NULL, 2200.00, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(4, '2020-04-07', 0, NULL, 2100.00, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(5, '2020-04-08', 0, '', 2400.00, '', '', '', 1, 0.00, '2020-04-07', 5, 4),
(6, '2020-04-08', 1, '', 3500.00, '', '', '', 1, 0.00, '2020-05-10', 3, 4),
(7, '2020-04-07', 1, '', 6600.00, '', '', '', 3, 0.00, '2020-04-07', 1, 4),
(8, '2020-04-14', 1, '', 6945.00, '', '', '', 3, 0.00, '2020-04-14', 6, 4),
(10, '2020-05-09', 1, '', 5900.00, '', '', '', 1, 0.00, '2020-05-24', 1, 4),
(11, '2020-05-11', 1, '', 4850.00, '', '', '', 1, 0.00, '2020-05-11', 4, 4),
(12, '2020-05-11', 1, '', 8730.00, '8541449845198', '', '', 3, 970.00, '2020-05-11', 10, 4),
(13, '2020-05-24', 0, NULL, 5040.00, NULL, NULL, NULL, 1, 560.00, NULL, 5, NULL),
(14, '2020-05-24', 1, '', 3990.00, '', 'asdasd', '2119', 2, 210.00, '2020-05-24', 2, 4),
(15, '2020-05-26', 1, '', 7070.00, '', 'กสิกรไทย', 'รังสิต', 2, 630.00, '2020-05-26', 5, 4),
(16, '2020-05-28', 1, '', 10415.00, '8541449845198', '', '', 3, 385.00, '2020-05-28', 3, 4),
(17, '2020-05-28', 1, '', 11953.00, '', 'กสิกรไทย', 'รังสิต', 2, 947.00, '2020-05-28', 4, 4),
(18, '2020-05-28', 1, '', 13820.00, '8541449845199', '', '', 3, 1080.00, '2020-05-28', 7, 4),
(19, '2020-05-28', 1, '', 26950.00, '', '', '', 1, 0.00, '2020-05-28', 2, 4),
(20, '2020-05-28', 0, NULL, 5273.00, NULL, NULL, NULL, NULL, 277.00, NULL, 3, NULL),
(21, '2020-05-29', 1, '', 11835.00, '8541449845198', '', '', 3, 1315.00, '2020-05-29', 4, 4),
(22, '2020-05-29', 1, '', 17800.00, '8541449845198', '', '', 3, 0.00, '2020-05-29', 6, 4),
(23, '2020-05-29', 1, '', 16695.00, '', '', '', 1, 1855.00, '2020-05-29', 13, 4);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `room`
--

CREATE TABLE `room` (
  `room_id` int(5) NOT NULL,
  `room_name` varchar(15) DEFAULT NULL,
  `room_category` int(1) DEFAULT NULL,
  `room_price` int(4) DEFAULT NULL,
  `room_picture` varchar(255) DEFAULT NULL,
  `room_bed` int(2) DEFAULT NULL,
  `room_rate` int(6) DEFAULT NULL,
  `room_status` int(1) DEFAULT NULL,
  `room_statsv` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_category`, `room_price`, `room_picture`, `room_bed`, `room_rate`, `room_status`, `room_statsv`) VALUES
(1, 'room01', 1, 200, 'room1.jpg', 1, 1200, 1, 1),
(2, 'room02', 2, 250, 'room2.jpg', 2, 1500, 1, 1),
(3, 'room03', 3, 300, 'room3.jpg', 3, 2500, 1, 1),
(4, 'room04', 4, 350, 'room4.jpg', 4, 3500, 1, 1),
(5, 'room05', 1, 200, 'room1.jpg', 1, 1200, 1, 1),
(6, 'room06', 1, 200, 'room1.jpg', 1, 1200, 1, 1),
(7, 'room07', 2, 250, 'room2.jpg', 2, 1500, 1, 1),
(8, 'room08', 4, 350, 'room4.jpg', 4, 3500, 1, 1),
(9, 'room09', 2, 250, 'room2.jpg', 2, 1500, 1, 1),
(10, 'room10', 2, 250, 'room2.jpg', 2, 1500, 1, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `servicecost`
--

CREATE TABLE `servicecost` (
  `svcost_id` int(5) NOT NULL,
  `svcost_date` date DEFAULT NULL,
  `svcost_status` int(1) DEFAULT NULL,
  `svcost_total` int(6) DEFAULT NULL,
  `book_id` int(5) DEFAULT NULL,
  `receipt_id` int(5) DEFAULT NULL,
  `svcost_discount` int(5) DEFAULT NULL,
  `svcost_net` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `servicecost`
--

INSERT INTO `servicecost` (`svcost_id`, `svcost_date`, `svcost_status`, `svcost_total`, `book_id`, `receipt_id`, `svcost_discount`, `svcost_net`) VALUES
(1, '2020-04-07', 1, 2550, 1, 1, NULL, 2550),
(2, '2020-04-07', 1, 3150, 4, 2, NULL, 3150),
(3, '2020-04-07', 1, 2200, 8, 3, NULL, 2200),
(4, '2020-04-07', 0, 2100, 8, 4, NULL, 2100),
(5, '2020-04-07', 1, 2400, 9, 5, NULL, 2400),
(6, '2020-04-07', 0, 700, 8, NULL, NULL, 700),
(7, '2020-04-07', 0, 1400, 8, 11, NULL, 1400),
(8, '2020-04-07', 1, 3450, 5, 11, NULL, 3450),
(9, '2020-04-07', 0, 3500, 5, 7, NULL, 3500),
(10, '2020-04-07', 1, 3100, 13, 7, NULL, 3100),
(11, '2020-04-07', 0, 3500, 13, 6, NULL, 3500),
(12, '2020-04-14', 1, 6945, 15, 8, NULL, 6945),
(13, '2020-04-28', 0, 4100, 8, NULL, 205, 3895),
(14, '2020-04-28', 1, 5500, 18, NULL, NULL, 5500),
(15, '2020-04-28', 0, 3400, 18, NULL, 170, 3230),
(16, '2020-05-09', 1, 5200, 24, 10, NULL, 5200),
(17, '2020-05-09', 1, 700, 24, 10, 70, 630),
(18, '2020-05-11', 1, 7300, 26, 12, NULL, 7300),
(19, '2020-05-11', 0, 2400, 26, 12, 120, 2280),
(20, '2020-05-24', 0, 700, 26, NULL, 35, 665),
(21, '2020-05-24', 0, 2850, 27, NULL, NULL, 2850),
(22, '2020-05-24', 0, 1400, 27, NULL, 0, 1400),
(23, '2020-05-24', 0, 2800, 26, 13, 280, 2520),
(24, '2020-05-24', 0, 2800, 27, 13, 280, 2520),
(25, '2020-05-24', 1, 1400, 27, 14, 70, 1330),
(26, '2020-05-24', 1, 1400, 27, 14, 140, 1260),
(27, '2020-05-24', 1, 1400, 27, 14, 0, 1400),
(28, '2020-05-26', 1, 4900, 28, 15, 490, 4410),
(29, '2020-05-26', 1, 2800, 28, 15, 140, 2660),
(30, '2020-05-28', 1, 7700, 35, 16, 385, 7315),
(31, '2020-05-28', 1, 3100, 35, 16, 0, 3100),
(32, '2020-05-28', 1, 6050, 36, 17, 605, 5445),
(33, '2020-05-28', 1, 6850, 37, 17, 343, 6508),
(34, '2020-05-28', 1, 6700, 38, 18, 670, 6030),
(35, '2020-05-28', 1, 8200, 38, 18, 410, 7790),
(36, '2020-05-28', 1, 14350, 34, 19, 0, 14350),
(37, '2020-05-28', 1, 12600, 34, 19, 0, 12600),
(38, '2020-05-28', 0, 5550, 39, 20, 278, 5273),
(39, '2020-05-29', 0, 7850, 40, NULL, 785, 7065),
(40, '2020-05-29', 0, 6700, 40, NULL, 0, 6700),
(41, '2020-05-29', 0, 9250, 41, NULL, 925, 8325),
(42, '2020-05-29', 0, 7750, 42, NULL, 775, 6975),
(43, '2020-05-29', 0, 8350, 43, NULL, 835, 7515),
(44, '2020-05-29', 1, 6950, 44, 21, 695, 6255),
(45, '2020-05-29', 1, 6200, 44, 21, 620, 5580),
(46, '2020-05-29', 1, 9900, 45, 22, 0, 9900),
(47, '2020-05-29', 1, 7900, 45, 22, 0, 7900),
(48, '2020-05-29', 1, 10450, 46, 23, 1045, 9405),
(49, '2020-05-29', 1, 8100, 46, 23, 810, 7290);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `servicedetail`
--

CREATE TABLE `servicedetail` (
  `svdetail_id` int(5) NOT NULL,
  `svdetail_num` int(2) DEFAULT NULL,
  `svdetail_price` int(6) DEFAULT NULL,
  `svdetail_detail` varchar(50) DEFAULT NULL,
  `svcost_id` int(5) DEFAULT NULL,
  `svlist_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `servicedetail`
--

INSERT INTO `servicedetail` (`svdetail_id`, `svdetail_num`, `svdetail_price`, `svdetail_detail`, `svcost_id`, `svlist_id`) VALUES
(1, 1, 700, '', 1, 1),
(2, 1, 500, '', 1, 2),
(3, 2, 900, '', 2, 3),
(4, 2, 500, '', 3, 2),
(5, 3, 700, '', 4, 1),
(6, 1, 900, '', 5, 3),
(7, 1, 700, '', 6, 1),
(8, 2, 700, '', 7, 1),
(9, 1, 700, '', 8, 1),
(10, 1, 900, '', 8, 3),
(11, 7, 500, '', 9, 2),
(12, 2, 500, '', 10, 2),
(13, 1, 900, '', 10, 3),
(14, 5, 700, '', 11, 1),
(15, 5, 500, '', 12, 2),
(16, 5, 700, '', 12, 1),
(17, 2, 700, '', 13, 1),
(18, 3, 900, '', 13, 3),
(19, 3, 700, '', 14, 1),
(20, 4, 500, '', 14, 2),
(21, 2, 700, '', 15, 1),
(22, 4, 500, '', 15, 2),
(23, 2, 900, '', 16, 3),
(24, 1, 700, '', 16, 1),
(25, 1, 700, '', 17, 1),
(26, 3, 700, '', 18, 1),
(27, 3, 900, '', 18, 3),
(28, 2, 700, '', 19, 1),
(29, 2, 500, '', 19, 2),
(30, 1, 700, '', 20, 1),
(31, 1, 500, '', 21, 2),
(32, 2, 700, '', 22, 1),
(33, 4, 700, '', 23, 1),
(34, 4, 700, '', 24, 1),
(35, 2, 700, '', 25, 1),
(36, 2, 700, '', 26, 1),
(37, 2, 700, '', 27, 1),
(38, 2, 700, '', 28, 1),
(39, 3, 500, '', 28, 2),
(40, 2, 500, '', 29, 2),
(41, 2, 900, '', 29, 3),
(42, 2, 500, '', 30, 2),
(43, 3, 900, '', 30, 3),
(44, 3, 700, '', 31, 1),
(45, 2, 500, '', 31, 2),
(46, 1, 700, '', 32, 1),
(47, 4, 900, '', 32, 3),
(48, 3, 700, '', 33, 1),
(49, 6, 500, '', 33, 2),
(50, 5, 700, '', 34, 1),
(51, 4, 500, '', 34, 2),
(52, 8, 900, '', 35, 3),
(53, 2, 500, '', 35, 2),
(54, 14, 900, '', 36, 3),
(55, 14, 900, '', 37, 3),
(57, 2, 700, '', 38, 1),
(58, 2, 500, '', 38, 2),
(59, 2, 900, '', 38, 3),
(60, 5, 700, '', 39, 1),
(61, 4, 900, '', 39, 3),
(62, 5, 500, '', 40, 2),
(63, 6, 700, '', 40, 1),
(64, 8, 500, '', 41, 2),
(65, 5, 900, '', 41, 3),
(66, 10, 700, '', 42, 1),
(67, 1, 750, '', 42, 4),
(68, 8, 500, '', 43, 2),
(69, 4, 900, '', 43, 3),
(70, 1, 750, '', 43, 4),
(71, 6, 700, '', 44, 1),
(72, 4, 500, '', 44, 2),
(73, 1, 750, '', 44, 4),
(74, 6, 700, '', 45, 1),
(75, 4, 500, '', 45, 2),
(76, 7, 700, '', 46, 1),
(77, 6, 500, '', 46, 2),
(78, 1, 2000, '', 46, 4),
(79, 7, 700, '', 47, 1),
(80, 6, 500, '', 47, 2),
(81, 9, 500, '', 48, 2),
(82, 4, 900, '', 48, 3),
(83, 1, 2350, '', 48, 4),
(84, 9, 500, '', 49, 2),
(85, 4, 900, '', 49, 3);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `servicelist`
--

CREATE TABLE `servicelist` (
  `svlist_id` int(5) NOT NULL,
  `svlist_name` varchar(50) DEFAULT NULL,
  `svlist_price` int(6) DEFAULT NULL,
  `svlist_unit` varchar(30) DEFAULT NULL,
  `svlist_picture` varchar(255) DEFAULT NULL,
  `svlist_place` varchar(30) DEFAULT NULL,
  `svlist_statsv` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `servicelist`
--

INSERT INTO `servicelist` (`svlist_id`, `svlist_name`, `svlist_price`, `svlist_unit`, `svlist_picture`, `svlist_place`, `svlist_statsv`) VALUES
(1, 'ดำน้ำ', 700, 'คน', 'diving.jpg', 'อ่าวปะการัง', 1),
(2, 'ตกปลา', 500, 'คน', 'fishing.jpg', 'เกาะหินขาว', 1),
(3, '9หมู่เกาะ', 900, 'คน', '9island.jpg', 'หมู่เกาะเสม็ด', 1),
(4, 'ค่ามัดจำ', 0, 'บาท', 'priceplus.png', 'แสงเทียน บีช รีสอร์ท', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `cus_id_2` (`cus_id_2`);

--
-- Indexes for table `booklist`
--
ALTER TABLE `booklist`
  ADD PRIMARY KEY (`booklist_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `servicecost`
--
ALTER TABLE `servicecost`
  ADD PRIMARY KEY (`svcost_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `receipt_id` (`receipt_id`);

--
-- Indexes for table `servicedetail`
--
ALTER TABLE `servicedetail`
  ADD PRIMARY KEY (`svdetail_id`),
  ADD KEY `svcost_id` (`svcost_id`),
  ADD KEY `svlist_id` (`svlist_id`);

--
-- Indexes for table `servicelist`
--
ALTER TABLE `servicelist`
  ADD PRIMARY KEY (`svlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `booklist`
--
ALTER TABLE `booklist`
  MODIFY `booklist_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `servicecost`
--
ALTER TABLE `servicecost`
  MODIFY `svcost_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `servicedetail`
--
ALTER TABLE `servicedetail`
  MODIFY `svdetail_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `servicelist`
--
ALTER TABLE `servicelist`
  MODIFY `svlist_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`cus_id_2`) REFERENCES `customer` (`cus_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `booklist`
--
ALTER TABLE `booklist`
  ADD CONSTRAINT `booklist_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `booklist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `servicecost`
--
ALTER TABLE `servicecost`
  ADD CONSTRAINT `servicecost_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `servicecost_ibfk_2` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`receipt_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `servicedetail`
--
ALTER TABLE `servicedetail`
  ADD CONSTRAINT `servicedetail_ibfk_1` FOREIGN KEY (`svlist_id`) REFERENCES `servicelist` (`svlist_id`),
  ADD CONSTRAINT `servicedetail_ibfk_2` FOREIGN KEY (`svcost_id`) REFERENCES `servicecost` (`svcost_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
