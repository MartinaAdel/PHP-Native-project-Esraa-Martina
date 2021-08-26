-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 12:24 AM
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
-- Database: `e-learning_project`
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

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`ID`, `teacherID`, `title`) VALUES
(1, 9, 'Math'),
(2, 9, 'chemistry');

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
  `roleID` int(11) NOT NULL,
  `img_dir` varchar(50) DEFAULT NULL,
  `job` char(50) DEFAULT NULL,
  `education` char(50) DEFAULT NULL,
  `createdDate` date DEFAULT NULL,
  `modifiedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Fname`, `Lnme`, `email`, `address`, `phone`, `password`, `roleID`, `img_dir`, `job`, `education`, `createdDate`, `modifiedDate`) VALUES
(1, 'esraa', 'fahmy', 'esraafahmy03@gmail.com', 'cairo , Egypt', '1256486343', '19c2220e14268ff71f2b77b555e5e30ea55fc1e1', 2, './uploads/13893258491629929231.jpeg', 'Developer', 'helwan', NULL, NULL),
(2, 'eeeee', 'fffffffffffff', 'ee@ee.com', 'cairo , Egypt', '01010101011', '0273cc8e797611b202509f576c6a6e029427a52f', 3, '', '', '', NULL, NULL),
(3, 't', 'tt', 'tt@gg.com', 'cairo , Egypt', '54321789065', 'fba9f1c9ae2a8afe7815c9cdd492512622a66302', 2, '', '', '', NULL, NULL),
(4, 'martina', 'dfgdgdgd', 'm@g.com', 'cairo , Egypt', '01020304050', '57ca2dad17817a05249a192cc18ef326772df0d4', 3, '', '', '', NULL, NULL),
(6, 'soo', 'foo', 'soo@foo.com', 'cairo , Egypt', '01142669713', 'b7c40b9c66bc88d38a59e554c639d743e77f1b65', 3, '', '', '', NULL, NULL),
(9, 'teacher', 'f', 't@tech.com', 'cairo , Egypt', '01142669713', '3292ccfad2b02195cdb85f79124b12e476b65ac0', 2, '', 'Math teacher', 'commerce Egypt university', NULL, NULL),
(10, 'mo', 'mmo', 'm@m.com', 'cairo , Egypt', '010 6997 4160', 'cecec3ec436bf58a4ecce3e179835e25ff691f3e', 2, './uploads/9570369091629928549.jpeg', 'manager', 'science', NULL, NULL),
(11, 'soso', 'fahmy', 'so@so.com', 'alex', '010 6997 4160', '745f9202e2b7a5f6a3abca909746d615092bc215', 3, './uploads/13047372571629916964.jpeg', 'Developer', 'computer sciene', '0000-00-00', '0000-00-00'),
(12, 'ssssss', 'fahmy', 'sf@sf.com', 'cairo5', '01020304050', '25d00ebcb85756fb901833a9628e2886d09b64b3', 2, './uploads/20332778571629926574.jpeg', '12', 'computer s', '0000-00-00', '0000-00-00');

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
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
