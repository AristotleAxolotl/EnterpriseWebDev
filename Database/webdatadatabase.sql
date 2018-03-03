-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 06:55 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdatadatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(20) NOT NULL,
  `Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Type`) VALUES
(1, 'Admin Ideas');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(20) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Idea_ID` int(20) NOT NULL,
  `Reply_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `Idea_ID` int(20) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Category_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`Idea_ID`, `Content`, `Title`, `Date`, `User_ID`, `Category_ID`) VALUES
(1, 'There should be no university fee.', 'Free Admision', '2018-03-03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `Upload_ID` int(20) NOT NULL,
  `Upload` blob NOT NULL,
  `Description` varchar(100) NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Idea_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(20) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `UserPassword` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Account_Type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `UserPassword`, `Email`, `Department`, `Account_Type`) VALUES
(1, 'Chris', 'Password', 'Email@Test.co.uk', 'Computing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `Vote_ID` int(20) NOT NULL,
  `Vote` int(10) NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Idea_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `comments_User_ID_FK` (`User_ID`),
  ADD KEY `comments_Idea_ID_FK` (`Idea_ID`),
  ADD KEY `comments_Reply_ID_FK` (`Reply_ID`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`Idea_ID`),
  ADD KEY `ideas_User_ID_FK` (`User_ID`),
  ADD KEY `ideas_Category_ID_FK` (`Category_ID`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`Upload_ID`),
  ADD KEY `uploads_User_ID_FK` (`User_ID`),
  ADD KEY `uploads_Idea_ID_FK` (`Idea_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`Vote_ID`),
  ADD KEY `votes_User_ID_FK` (`User_ID`),
  ADD KEY `votes_Idea_ID_FK` (`Idea_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_Idea_ID_FK` FOREIGN KEY (`Idea_ID`) REFERENCES `ideas` (`Idea_ID`),
  ADD CONSTRAINT `comments_Reply_ID_FK` FOREIGN KEY (`Reply_ID`) REFERENCES `comments` (`Comment_ID`),
  ADD CONSTRAINT `comments_User_ID_FK` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_Category_ID_FK` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`),
  ADD CONSTRAINT `ideas_User_ID_FK` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_Idea_ID_FK` FOREIGN KEY (`Idea_ID`) REFERENCES `ideas` (`Idea_ID`),
  ADD CONSTRAINT `uploads_User_ID_FK` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_Idea_ID_FK` FOREIGN KEY (`Idea_ID`) REFERENCES `ideas` (`Idea_ID`),
  ADD CONSTRAINT `votes_User_ID_FK` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
