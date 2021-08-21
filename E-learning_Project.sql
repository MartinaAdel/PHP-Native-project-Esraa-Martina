-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2021 at 09:44 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `E-learning_Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE `exam_result` (
  `studentID` int(11) NOT NULL,
  `lessonID` int(10) UNSIGNED NOT NULL,
  `result` float NOT NULL,
  `pass` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `ID` int(10) UNSIGNED NOT NULL,
  `title` tinytext NOT NULL,
  `video` char(50) NOT NULL,
  `trackID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ID` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer1` tinytext NOT NULL,
  `answer2` tinytext NOT NULL,
  `answer3` tinytext NOT NULL,
  `answer4` tinytext NOT NULL,
  `right_answer` int(11) NOT NULL,
  `lessonID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `title` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `title`) VALUES
(1, 'admin'),
(2, 'teacher'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `study`
--

CREATE TABLE `study` (
  `studentID` int(11) NOT NULL,
  `trackID` int(11) UNSIGNED NOT NULL,
  `lesson_finish` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `ID` int(10) UNSIGNED NOT NULL,
  `teacherID` int(11) NOT NULL,
  `title` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `track_rate`
--

CREATE TABLE `track_rate` (
  `userID` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `trackID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Fname` char(50) NOT NULL,
  `Lnme` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `address` text NOT NULL,
  `phone` char(20) NOT NULL,
  `password` char(50) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_rate`
--

CREATE TABLE `user_rate` (
  `userID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD KEY `studentID` (`studentID`),
  ADD KEY `lessonID` (`lessonID`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `trackID` (`trackID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lessonID` (`lessonID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `study`
--
ALTER TABLE `study`
  ADD KEY `studentID` (`studentID`),
  ADD KEY `trackID` (`trackID`),
  ADD KEY `lessonID` (`lesson_finish`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `track_rate`
--
ALTER TABLE `track_rate`
  ADD KEY `userID` (`userID`),
  ADD KEY `trackID` (`trackID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `user_rate`
--
ALTER TABLE `user_rate`
  ADD KEY `userID` (`userID`),
  ADD KEY `teacherID` (`teacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD CONSTRAINT `result_relation` FOREIGN KEY (`studentID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_relation2` FOREIGN KEY (`lessonID`) REFERENCES `lessons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lesson_realtion` FOREIGN KEY (`trackID`) REFERENCES `track` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_realtion` FOREIGN KEY (`lessonID`) REFERENCES `lessons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `study_relation1` FOREIGN KEY (`studentID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_relation2` FOREIGN KEY (`trackID`) REFERENCES `track` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_relation3` FOREIGN KEY (`lesson_finish`) REFERENCES `lessons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `track_realtion` FOREIGN KEY (`teacherID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track_rate`
--
ALTER TABLE `track_rate`
  ADD CONSTRAINT `track_rate_realtion` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `track_rate_realtion2` FOREIGN KEY (`trackID`) REFERENCES `track` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role_relation` FOREIGN KEY (`roleID`) REFERENCES `role` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_rate`
--
ALTER TABLE `user_rate`
  ADD CONSTRAINT `user_rate_relation` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rate_relation2` FOREIGN KEY (`teacherID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
