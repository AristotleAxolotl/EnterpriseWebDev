-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql.cms.gre.ac.uk:3306
-- Generation Time: Apr 06, 2018 at 12:19 PM
-- Server version: 5.5.59-0ubuntu0.14.04.1-log
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdb_cl7533q`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(20) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `End_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Type`, `End_Date`) VALUES
(1, 'Admin Ideas', '0000-00-00'),
(2, 'A Category', '2018-03-22'),
(3, '1st Year Ideas', '2018-04-14');

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
  `Reply_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `Content`, `Date`, `User_ID`, `Idea_ID`, `Reply_ID`) VALUES
(1, 'A comment.', '2018-03-30', 1, 2, 1),
(2, ' Type comment here...', '2018-03-30', 1, 1, NULL),
(3, 'Here is another comment.', '2018-03-30', 2, 1, NULL),
(4, 'Here is a comment.', '2018-03-30', 2, 1, NULL),
(5, 'comment.', '2018-03-30', 2, 1, NULL),
(6, 'asdasdas', '2018-03-30', 2, 1, NULL),
(7, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(8, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(9, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(10, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(11, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(12, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(13, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(14, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(15, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(16, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(17, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(18, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(19, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(20, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(21, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(22, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(23, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(24, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(25, ' Type comment here...', '2018-03-30', 2, 3, NULL),
(26, ' Type comment here...nh7unh8ukm9l,9li9', '2018-03-30', 2, 16, NULL),
(27, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(28, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(29, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(30, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(31, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(32, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(33, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(34, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(35, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(36, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(37, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(38, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(39, ' Type comment here...', '2018-03-30', 2, 16, NULL),
(40, 'Asda.', '2018-03-30', 2, 1, NULL);

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
  `Category_ID` int(20) NOT NULL,
  `anonymous` int(11) NOT NULL DEFAULT '0',
  `Reported` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`Idea_ID`, `Content`, `Title`, `Date`, `User_ID`, `Category_ID`, `anonymous`, `Reported`) VALUES
(1, 'There should be no university fee.', 'Free Admision', '2018-03-03', 1, 1, 0, 4),
(2, 'This is some content to be placed in the database.', 'Test Idea', '2014-03-18', 1, 1, 0, 0),
(3, 'This is some more testing content to ensure that it is working as intended.', 'Test Idea 2', '2014-03-18', 1, 2, 0, 2),
(4, 'Still testing that all of the ideas are working as they should do.', 'Test Idea 3', '2018-03-14', 1, 2, 0, 6),
(5, 'Test Content.', 'Test Idea 4', '2018-03-15', 1, 2, 0, 8),
(6, 'Here is another test Idea.', 'Test Idea 5', '2018-03-15', 1, 2, 0, 0),
(7, 'Nope!', 'A New Idea', '2018-03-28', 1, 3, 0, 0),
(16, 'nujhmiokojmuk,o,ko9,ko,kok,o,ko', 'ki0oik0oki9', '2018-03-30', 2, 1, 0, 0);

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
  `Account_Type` int(10) NOT NULL,
  `Last_Login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `UserPassword`, `Email`, `Department`, `Account_Type`, `Last_Login`) VALUES
(1, 'Chris', 'Password', 'cl7533q@greenwich.ac.uk', 'Computing', 1, '2018-04-06 11:40:15'),
(2, 'Admin', 'Admin', 'test@test.co.uk', 'Computing', 0, '2018-04-03 11:06:49');

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
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`Vote_ID`, `Vote`, `User_ID`, `Idea_ID`) VALUES
(1, 0, 2, 1),
(2, 1, 1, 1),
(3, 1, 2, 1),
(4, 1, 2, 1),
(5, 1, 2, 1),
(6, 1, 2, 1),
(7, 1, 2, 1),
(8, 1, 2, 1),
(9, 1, 2, 1),
(10, 1, 2, 1),
(11, 1, 2, 1),
(12, 1, 2, 1),
(13, 1, 2, 1),
(14, 1, 2, 1),
(15, 1, 2, 1),
(16, 1, 2, 1),
(17, 1, 2, 1),
(18, 1, 2, 1);

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
