-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 10:56 AM
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
-- Database: `math_stars`
--
CREATE DATABASE IF NOT EXISTS `math_stars` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `math_stars`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `add_student`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_student` (IN `s_first_name` VARCHAR(255), IN `s_last_name` VARCHAR(255), IN `s_stars` INT(11))   BEGIN

INSERT INTO `student` (`first_name`, `last_name`, `star_num`)
VALUES (s_first_name, s_last_name, s_stars);

END$$

DROP PROCEDURE IF EXISTS `delete_student`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_student` (IN `s_idx` INT(11))   BEGIN

DELETE FROM `student` WHERE `idx`=s_idx;

END$$

DROP PROCEDURE IF EXISTS `read_all_student`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `read_all_student` ()   BEGIN

SELECT idx, uid, CONCAT(first_name, ' ', last_name) AS "Name", star_num AS "Stars" FROM student;


END$$

DROP PROCEDURE IF EXISTS `read_student`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `read_student` (IN `s_idx` INT(11))   BEGIN

SELECT s.idx, s.uid, CONCAT(s.first_name, ' ', s.last_name) AS "Name", s.star_num AS "Stars"
FROM `student` AS s
WHERE idx=s_idx;

END$$

DROP PROCEDURE IF EXISTS `update_student`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_student` (IN `s_u_idx` INT(11), IN `s_first_name` VARCHAR(255), IN `s_last_name` VARCHAR(255), IN `s_star_num` INT(11))   BEGIN

UPDATE `student`
SET `first_name`=IFNULL(s_first_name, `first_name`),
	`last_name`=IFNULL(s_last_name, `last_name`),
    `star_num`=IFNULL(s_star_num, `star_num`)
WHERE idx=s_u_idx;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `idx` int(11) NOT NULL,
  `uid` varchar(36) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `star_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idx`, `uid`, `first_name`, `last_name`, `star_num`) VALUES
(1, 'b84a65b4-bd9f-11ed-addb-244bfedee9a7', 'ALEX', 'CHEA', 100),
(2, '11dae4ad-bda2-11ed-addb-244bfedee9a7', 'TEST', 'CHEA', 150),
(3, '23d84fb8-bda2-11ed-addb-244bfedee9a7', 'CHRIS', 'P', 2000),
(4, 'a3718888-bf05-11ed-8090-244bfedee9a7', 'NOT', 'LAST', 1000),
(5, 'd2f80caa-bf05-11ed-8090-244bfedee9a7', 'BOBBY', 'BOB', 123);

--
-- Triggers `student`
--
DROP TRIGGER IF EXISTS `student_id`;
DELIMITER $$
CREATE TRIGGER `student_id` BEFORE INSERT ON `student` FOR EACH ROW SET NEW.uid = UUID()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idx`),
  ADD UNIQUE KEY `student_id` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
