-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2017 at 10:40 PM
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
-- Database: `resume`
--

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE `controller` (
  `ControllerID` int(11) NOT NULL,
  `ControllerName` varchar(80) NOT NULL,
  `Controller_Username` varchar(50) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `College` varchar(50) NOT NULL,
  `Controller_Email` varchar(255) NOT NULL,
  `Controller_Password` varchar(80) NOT NULL,
  `JoinedIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Controller_YouTube` text NOT NULL,
  `Controller_FB` text NOT NULL,
  `Controller_Twitter` text NOT NULL,
  `Controller_GoogleP` text NOT NULL,
  `Controller_Instagram` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`ControllerID`, `ControllerName`, `Controller_Username`, `Job`, `College`, `Controller_Email`, `Controller_Password`, `JoinedIn`, `Controller_YouTube`, `Controller_FB`, `Controller_Twitter`, `Controller_GoogleP`, `Controller_Instagram`) VALUES
(31, 'Abdulrahman Saber', 'admin', 'Full Stack Web Developer', 'Not in college', 'abdulrahman@abdulrahman-saber.space', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2017-08-07 22:58:01', 'https://www.youtube.com/channel/UCclw2xdEtnwp0EWwWGm_sOA', 'https://www.youtube.com/channel/UCclw2xdEtnwp0EWwWGm_sOA', 'https://www.youtube.com/channel/UCclw2xdEtnwp0EWwWGm_sOA', 'https://www.youtube.com/channel/UCclw2xdEtnwp0EWwWGm_sOA', 'https://www.youtube.com/channel/UCclw2xdEtnwp0EWwWGm_sOA'),
(32, 'Abdullah Saber', 'abdullah', 'Enginner', 'FOE', 'abdullah@abdullah.com', '4b0e9528574b16e0121b0787dd76bf5e1cc83b27', '2017-09-29 19:02:25', 'https://www.facebook.com/abdulrahman.saberPRO', 'https://www.facebook.com/abdulrahman.saberPRO', 'https://www.facebook.com/abdulrahman.saberPRO', 'https://www.facebook.com/abdulrahman.saberPRO', 'https://www.facebook.com/abdulrahman.saberPRO');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(80) NOT NULL,
  `CourseDesc` text NOT NULL,
  `CourseDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CourseLink` text NOT NULL,
  `Lessons` varchar(50) NOT NULL,
  `Lang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `CourseDesc`, `CourseDate`, `CourseLink`, `Lessons`, `Lang`) VALUES
(14, 'Learn HTML5', 'This is course for learn html5 now watch it now what are you waiting for \r\n This is course for learn html5 now watch it now what are you waiting for \r\n This is course for learn html5 now watch it now what are you waiting for \r\n This is course for learn html5 now watch it now what are you waiting for \r\n ', '2017-08-16 22:10:18', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/6gjg5n9kyBU?list=PLDoPjvoNmBAyXCAQMLhDRZsLi_HurqTBZ\" frameborder=\"0\" allowfullscreen></iframe>', '35', 'Arabic');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `MessageUsername` varchar(80) NOT NULL,
  `MessageContent` text NOT NULL,
  `MessagePhone` varchar(50) NOT NULL,
  `MessageDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(80) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  `College` varchar(50) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `JoinedIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Fullname`, `Email`, `Password`, `Status`, `College`, `Job`, `JoinedIn`) VALUES
(22, 'ahmed_khalid', 'Ahmed Khalid', 'ahmed_khalid@gmail.com', '65ccda4f5282793b7e9522ef1f021fdc208cd83b', 0, 'FCI', 'Web Developer', '2017-08-16 22:05:38'),
(23, 'helload', 'Hello2easdasd', 'adsasda@ads.ads', '152be2b790f51e2c18e5af60ac71e6cf410a7fef', 0, 'asdasdasd', 'asdasdas', '2017-08-17 17:30:13'),
(25, 'abdulrahman', 'Abdulrahman Saber', 'abdulrahmansaber120@gmail.com', '23ff4de0a047d43fac14c902a674346162754c46', 1, 'Faculty Of Medicine', 'Doctor', '2017-09-29 18:54:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controller`
--
ALTER TABLE `controller`
  ADD PRIMARY KEY (`ControllerID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `controller`
--
ALTER TABLE `controller`
  MODIFY `ControllerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
