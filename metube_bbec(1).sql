-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: mysql1.cs.clemson.edu
-- Generation Time: Nov 23, 2021 at 11:24 PM
-- Server version: 5.5.52-0ubuntu0.12.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `metube_bbec`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `thread` int(11) NOT NULL,
  `fileId` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `commentText` text NOT NULL,
  `timeSent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstInThread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`thread`, `fileId`, `fromId`, `commentText`, `timeSent`, `firstInThread`) VALUES
(7, 20, 1, 'Commenting on file 20', '2021-11-22 17:41:34', 1),
(7, 20, 1, 'reply to this comment', '2021-11-23 07:56:03', 0),
(8, 19, 1240, 'Love this star!', '2021-11-24 03:00:11', 1),
(8, 19, 1240, 'Thanks me.', '2021-11-24 03:02:35', 0),
(9, 1, 1, 'this is a comment', '2021-11-24 03:53:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commentThreads`
--

CREATE TABLE IF NOT EXISTS `commentThreads` (
  `commentThread` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`commentThread`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `commentThreads`
--

INSERT INTO `commentThreads` (`commentThread`) VALUES
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `userId` int(11) NOT NULL,
  `contactId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`userId`, `contactId`) VALUES
(1, 8),
(1238, 7),
(1238, 8),
(1240, 1),
(1240, 1240),
(1240, 1239),
(1240, 1),
(1240, 7);

-- --------------------------------------------------------

--
-- Table structure for table `filedata`
--

CREATE TABLE IF NOT EXISTS `filedata` (
  `fileId` int(11) NOT NULL AUTO_INCREMENT,
  `timeUploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `numViews` int(11) NOT NULL,
  `numRatings` int(11) NOT NULL,
  UNIQUE KEY `fileId` (`fileId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `filedata`
--

INSERT INTO `filedata` (`fileId`, `timeUploaded`, `numViews`, `numRatings`) VALUES
(1, '2021-11-24 03:53:34', 2, 0),
(2, '2021-11-15 21:21:16', 0, 0),
(3, '2021-11-16 16:15:35', 0, 0),
(5, '2021-11-18 14:16:47', 0, 0),
(6, '2021-11-19 23:16:46', 0, 0),
(7, '2021-11-22 01:59:41', 0, 0),
(8, '2021-11-22 02:01:16', 0, 0),
(9, '2021-11-22 02:03:38', 0, 0),
(10, '2021-11-22 02:12:42', 0, 0),
(11, '2021-11-22 02:16:48', 0, 0),
(12, '2021-11-22 02:19:54', 0, 0),
(13, '2021-11-24 03:22:13', 8, 0),
(14, '2021-11-22 18:02:14', 1, 0),
(15, '2021-11-22 04:51:49', 0, 0),
(16, '2021-11-22 04:52:08', 0, 0),
(17, '2021-11-24 02:21:15', 7, 0),
(18, '2021-11-22 04:53:41', 0, 0),
(19, '2021-11-24 03:19:56', 9, 0),
(20, '2021-11-24 03:40:03', 19, 0),
(21, '2021-11-24 01:00:33', 0, 0),
(22, '2021-11-24 01:04:28', 0, 0),
(23, '2021-11-24 01:05:11', 0, 0),
(24, '2021-11-24 03:22:37', 1, 0),
(25, '2021-11-24 02:07:55', 1, 0),
(26, '2021-11-24 01:49:34', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fileList`
--

CREATE TABLE IF NOT EXISTS `fileList` (
  `fileId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fileList`
--

INSERT INTO `fileList` (`fileId`, `playlistId`) VALUES
(2, 1),
(1, 6),
(1, 7),
(1, 1),
(20, 20),
(13, 24),
(24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `filelocation`
--

CREATE TABLE IF NOT EXISTS `filelocation` (
  `userId` int(11) NOT NULL,
  `fileId` int(11) NOT NULL,
  `displayName` varchar(100) NOT NULL,
  `fileUrl` text NOT NULL,
  `fileDesc` text NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`fileId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filelocation`
--

INSERT INTO `filelocation` (`userId`, `fileId`, `displayName`, `fileUrl`, `fileDesc`, `category`) VALUES
(1, 13, 'filename', './uploads/id13idCanouse-Color.PNG', 'Description of File', 'humor'),
(1, 14, 'Video file', './uploads/id14idsample-mp4-file-small.mp4', 'this is a video file', 'educational'),
(1, 17, 'testfile', './uploads/id17idsample-mp4-file-small.mp4', 'this is an test file', 'humor'),
(1, 19, 'testing file', './uploads/id19idNotes-13.jpg', 'a picture of a star', 'entertainment'),
(1, 20, 'trying a pdf', './uploads/id20idCanouse-FixAWebsite.pdf', 'just seeing if a pdf works', 'educational'),
(1240, 21, 'userPicture', './uploads/id21idcolor test.PNG', 'Color Picture', 'humor'),
(1240, 22, 'Video', './uploads/id22idsample-mp4-file-small.mp4', 'Sample Video', 'news'),
(1240, 23, 'PDF', './uploads/id23idproblem2.pdf', 'Problem', 'entertainment'),
(1240, 24, 'GIF', './uploads/id24idcatgif.gif', 'Cute Cat', 'humor'),
(1240, 25, 'userPicture', './uploads/id25idIMG_0911.jpg', '7fdh', 'humor');

-- --------------------------------------------------------

--
-- Table structure for table `keywordList`
--

CREATE TABLE IF NOT EXISTS `keywordList` (
  `fileId` int(11) NOT NULL,
  `keyword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywordList`
--

INSERT INTO `keywordList` (`fileId`, `keyword`) VALUES
(6, 'smart'),
(6, 'happy'),
(6, 'Dog'),
(13, 'one'),
(20, 'project'),
(25, 'dog'),
(24, 'dance'),
(24, 'gif');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `thread` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `messageText` text NOT NULL,
  `timeSent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstInThread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`thread`, `fromId`, `toId`, `messageText`, `timeSent`, `firstInThread`) VALUES
(1, 1, 7, 'Hi, this is my first message', '2021-11-22 04:20:45', 1),
(1, 1, 7, 'Replying to user 7\r\n', '2021-11-22 06:14:57', 0),
(7, 1, 0, 'This is my reply', '2021-11-23 07:55:21', 0),
(8, 1240, 1, 'Your code is bangin!', '2021-11-24 02:39:20', 1),
(8, 1, 1, 'Thanks for the feedback!', '2021-11-24 02:49:46', 0),
(8, 1, 1, 'Love you!', '2021-11-24 02:52:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messageThreads`
--

CREATE TABLE IF NOT EXISTS `messageThreads` (
  `thread` int(11) NOT NULL AUTO_INCREMENT,
  `sub` varchar(50) NOT NULL,
  PRIMARY KEY (`thread`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `messageThreads`
--

INSERT INTO `messageThreads` (`thread`, `sub`) VALUES
(1, 'First Message'),
(2, ''),
(3, 'subject'),
(4, 'subject here'),
(5, 'sub'),
(6, 'sub'),
(7, 'sub'),
(8, 'I love you!');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `userId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL AUTO_INCREMENT,
  `listName` varchar(100) NOT NULL,
  `playlistDesc` text NOT NULL,
  PRIMARY KEY (`playlistId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`userId`, `playlistId`, `listName`, `playlistDesc`) VALUES
(1, 1, 'New Title', 'This is my first ever playlist'),
(1, 3, 'Title of Playlist', 'Descripition of playlist'),
(1237, 5, 'Favorites', 'Keep your favorite Files Here!'),
(1238, 6, 'Favorites', 'Keep your favorite Files Here!'),
(1238, 7, 'Playlist1', 'Fun playlist'),
(1238, 8, 'Playlist2', 'This is an interesting playlist'),
(1239, 13, 'Favorites', 'Keep your favorite Files Here!'),
(1240, 14, 'Favorites', 'Keep your favorite Files Here!'),
(1240, 15, 'Favorites', 'Keep your favorite Files Here!'),
(1241, 16, 'Favorites', 'Keep your favorite Files Here!'),
(1242, 17, 'Favorites', 'Keep your favorite Files Here!'),
(1243, 18, 'Favorites', 'Keep your favorite Files Here!'),
(1243, 19, 'Favorites', 'Keep your favorite Files Here!'),
(1240, 20, 'Favorites', 'Keep your favorite Files Here!'),
(2, 21, 'untitledplaylist', 'sample'),
(1240, 24, 'userPlaylist1', 'userDescription1'),
(1240, 25, 'userPlaylist1', 'userDescription1'),
(1244, 26, 'Favorites', 'Keep your favorite Files Here!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1245 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstName`, `lastName`, `email`, `pass`, `userId`) VALUES
('Elise', 'Canouse', 'ecanouse@gmail.com', 'password123', 1),
('Brandy', 'Barfield', 'heyitsbrandy0@gmail.com', '0brandy0', 2),
('Elise', 'Canouse', 'email@gmail.com', 'password123', 3),
('Allie', 'Aldrin', 'aldrin@gmail.com', 'aldrin', 4),
('Brian', 'Barnes', 'barnes@gmail.com', 'barnes', 5),
('Charlie', 'Crawford', 'crawford@gmail.com', 'crawford', 6),
('Daniel', 'Davis', 'davis@gmail.com', 'davis', 7),
('Ellen', 'Evans', 'evans@gmail.com', 'evans', 8),
('Fred', 'Ford', 'ford@gmail.com', 'ford', 1236),
('Gary', 'Gardner', 'gardner@gmail.com', 'gardner', 1237),
('Harry', 'Harrison', 'harrison@gmail.com', 'harrison', 1238),
('Jordan', 'Noel', 'noel@clemson.edu', 'password123', 1239),
('James', 'Canouse', 'user@clemson.edu', '9', 1240),
('Jimmy', 'Smith', 'jimmy@yahoo.com', 'password123', 1241),
('Jake', 'Jones', 'jake@statefarm.com', 'password123', 1242),
('Jake', 'Jones', 'jake@statefarm.edu', 'password123', 1243),
('Mr', 'Jones', 'jones@bbqandfootmassage.com', 'BigATrucks', 1244);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
