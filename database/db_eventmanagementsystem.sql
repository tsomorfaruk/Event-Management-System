-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 06:30 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eventmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-07-05 11:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblactivationstatus`
--

CREATE TABLE `tblactivationstatus` (
  `id` int(10) NOT NULL,
  `PerformerId` int(10) NOT NULL,
  `InactiveDates` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblactivationstatus`
--

INSERT INTO `tblactivationstatus` (`id`, `PerformerId`, `InactiveDates`, `Created_at`) VALUES
(13, 7, '11/14/2018, 11/15/2018', '2018-10-31 13:03:19'),
(14, 7, '11/22/2018, 11/23/2018', '2018-10-31 13:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `BookingId` int(10) NOT NULL,
  `ClientName` varchar(255) NOT NULL,
  `ClientEmail` varchar(255) NOT NULL,
  `ClientContactNumber` char(12) NOT NULL,
  `ClientAddress` varchar(255) NOT NULL,
  `ClientCity` varchar(255) NOT NULL,
  `ClientNid` varchar(255) NOT NULL,
  `ClientAccNumber` varchar(255) NOT NULL,
  `ClientAccPass` varchar(255) NOT NULL,
  `PerformerId` int(10) NOT NULL,
  `PerformerName` varchar(255) NOT NULL,
  `PerformanceDate` varchar(255) NOT NULL,
  `DateQuantity` int(10) NOT NULL,
  `PerformanceCost` int(10) NOT NULL,
  `Status` int(10) NOT NULL,
  `BookingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `ClientName`, `ClientEmail`, `ClientContactNumber`, `ClientAddress`, `ClientCity`, `ClientNid`, `ClientAccNumber`, `ClientAccPass`, `PerformerId`, `PerformerName`, `PerformanceDate`, `DateQuantity`, `PerformanceCost`, `Status`, `BookingDate`) VALUES
(5, 'Nahid', 'nahid@zahid.com', '1710101010', 'dfglliou kiuo', 'Dhaka', '2551346895875495', '105.119.48734', '2555', 7, 'Omor Faruk', '10/06/2018, 10/07/2018', 2, 4000, 1, '2018-10-06 06:00:44'),
(6, 'Jaber', 'jaber@baber.com', '1326547894', 'Dania Dhaka', 'Dhaka', '101.12536.3', '', '', 7, 'Omor Faruk', '10/30/2018, 10/31/2018', 2, 4000, 1, '2018-10-30 05:25:33'),
(7, 'Bony', 'bony@mony.com', '01326547894', 'Dania Dhaka', 'Dhaka', '1254698736', '', '', 9, 'Nazmul', '11/06/2018, 11/07/2018', 2, 3000, 1, '2018-10-31 01:27:21'),
(8, 'arif', 'arif@barif.com', '01369852147', 'Dhanmondi, Dhaka', 'Dhaka', '12365478963258', '', '', 7, 'Omor Faruk', '11/21/2018, 11/22/2018', 2, 4000, 1, '2018-10-31 02:23:32'),
(9, 'Nahid', 'nahid@bahid.com', '01326547894', 'Dhanmondi', 'Dhaka', '12365478963258', '', '', 7, 'Omor Faruk', '11/14/2018, 11/15/2018', 2, 4000, 1, '2018-10-31 16:18:08'),
(10, 'arif', 'jaber@baber.com', '01369852147', 'fg erhgr', 'Dhaka', '12365478963258', '', '', 8, 'Shah Mahmud', '10/31/2018', 1, 10000, 0, '2018-10-31 17:11:47'),
(11, 'Omor Faruk', 'arif@barif.com', '01326547894', 'dfg betyhn b ', 'Dhaka', '12365478963258', '', '', 9, 'Nazmul', '10/31/2018', 1, 1500, 0, '2018-10-31 17:18:33'),
(12, 'Jaber', 'jaber@baber.com', '01369852147', ' ef  tgr5', 'Dhaka', '12365478963258', '', '', 8, 'Shah Mahmud', '11/21/2018, 11/22/2018', 2, 20000, 0, '2018-10-31 17:20:53'),
(13, 'arif', 'arif@barif.com', '01369852147', 'gh hj ', 'Dhaka', '12365478963258', '', '', 7, 'Omor Faruk', '11/26/2018, 11/27/2018', 2, 4000, 0, '2018-10-31 17:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `CartId` int(11) NOT NULL,
  `SessionId` varchar(255) NOT NULL,
  `PerformerId` int(10) NOT NULL,
  `PerformerName` varchar(255) NOT NULL,
  `PerformanceCost` int(10) NOT NULL,
  `PerformanceDate` varchar(255) NOT NULL,
  `DateQuantity` int(10) NOT NULL,
  `PerformerPhoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategories`
--

CREATE TABLE `tblcategories` (
  `CategoryId` int(10) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategories`
--

INSERT INTO `tblcategories` (`CategoryId`, `CategoryName`, `Created_at`, `Updated_at`) VALUES
(1, 'Photographer', '2018-09-25 07:06:31', '2018-09-25 07:06:31'),
(2, 'Singer', '2018-09-25 07:09:07', '2018-09-25 07:09:07'),
(4, 'Dancer', '2018-09-25 07:12:16', '2018-09-25 07:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'Test Demo test demo																									', 'test@test.com', '8585233222');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Anuj Kumar', 'webhostingamigo@gmail.com', '2147483647', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2017-06-18 10:03:07', 1),
(2, 'Omor Faruk', 'tsomorfaruk@gmail.com', '01677134949', 'sdfgr yhe ', '2018-10-30 04:04:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '<P align=justify><FONT size=2><STRONG><FONT color=#990000>(1) ACCEPTANCE OF TERMS</FONT><BR><BR></STRONG>Welcome to Yahoo! India. 1Yahoo Web Services India Private Limited Yahoo", "we" or "us" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service ("TOS"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: <A href="http://in.docs.yahoo.com/info/terms/">http://in.docs.yahoo.com/info/terms/</A>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>\r\n<P align=justify><FONT size=2>Welcome to Yahoo! India. Yahoo Web Services India Private Limited Yahoo", "we" or "us" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service ("TOS"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </FONT><A href="http://in.docs.yahoo.com/info/terms/"><FONT size=2>http://in.docs.yahoo.com/info/terms/</FONT></A><FONT size=2>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>\r\n<P align=justify><FONT size=2>Welcome to Yahoo! India. Yahoo Web Services India Private Limited Yahoo", "we" or "us" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service ("TOS"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </FONT><A href="http://in.docs.yahoo.com/info/terms/"><FONT size=2>http://in.docs.yahoo.com/info/terms/</FONT></A><FONT size=2>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>'),
(2, 'Privacy Policy', 'privacy', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(3, 'About Us ', 'aboutus', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(11, 'FAQs', 'faqs', '																														<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Address------Test &nbsp; &nbsp;dsfdsfds</span>');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `SubscriberEmail`, `PostingDate`) VALUES
(2, 'a@b.com', '2018-10-24 03:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `PerformerId` int(10) NOT NULL,
  `TestimonialText1` mediumtext NOT NULL,
  `TestimonialImage1` varchar(255) NOT NULL,
  `TestimonialText2` mediumtext NOT NULL,
  `TestimonialImage2` varchar(255) NOT NULL,
  `TestimonialText3` mediumtext NOT NULL,
  `TestimonialImage3` varchar(255) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltestimonial`
--

INSERT INTO `tbltestimonial` (`id`, `PerformerId`, `TestimonialText1`, `TestimonialImage1`, `TestimonialText2`, `TestimonialImage2`, `TestimonialText3`, `TestimonialImage3`, `PostingDate`, `status`) VALUES
(1, 7, 'rgfar', 'assets/uploads/testimonial.png', 'rger tenh', 'assets/uploads/testimonial2.png', 'trhethjnntjhn', 'assets/uploads/testimonial3.png', '2018-10-30 13:27:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `PerformerCategoryId` int(10) DEFAULT NULL,
  `FatherName` varchar(120) DEFAULT NULL,
  `MotherName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `PerformanceCost` int(10) DEFAULT NULL,
  `PerformerPhoto` varchar(255) NOT NULL,
  `NidPhoto` varchar(255) NOT NULL,
  `PerformancePhoto1` varchar(255) NOT NULL,
  `PerformancePhoto2` varchar(255) NOT NULL,
  `PerformancePhoto3` varchar(255) NOT NULL,
  `Video` varchar(255) NOT NULL,
  `Overview` longtext NOT NULL,
  `PublicationStatus` varchar(15) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `PerformerCategoryId`, `FatherName`, `MotherName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `PerformanceCost`, `PerformerPhoto`, `NidPhoto`, `PerformancePhoto1`, `PerformancePhoto2`, `PerformancePhoto3`, `Video`, `Overview`, `PublicationStatus`, `RegDate`, `UpdationDate`) VALUES
(1, 'Anuj Kumar', 0, NULL, NULL, 'demo@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2147483647', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '2017-06-17 19:59:27', '2017-06-26 21:02:58'),
(2, 'AK', 0, NULL, NULL, 'anuj@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '8285703354', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '2017-06-17 20:00:49', '2017-06-26 21:03:09'),
(3, 'Anuj Kumar', 0, NULL, NULL, 'webhostingamigo@gmail.com', 'f09df7868d52e12bba658982dbd79821', '09999857868', '03/02/1990', 'New Delhi', 'New Delhi', NULL, '', '', '', '', '', '', '', NULL, '2017-06-17 20:01:43', '2017-06-17 21:07:41'),
(4, 'Anuj Kumar', 0, NULL, NULL, 'test@gmail.com', '5c428d8875d2948607f3e3fe134d71b4', '9999857868', '', 'New Delhi', 'Delhi', NULL, '', '', '', '', '', '', '', NULL, '2017-06-17 20:03:36', '2017-06-26 19:18:14'),
(5, 'test', 0, NULL, NULL, 'test1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '9015501898', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '2017-06-29 18:19:08', NULL),
(6, 'php', 0, NULL, NULL, 'php@gmail.com', '202cb962ac59075b964b07152d234b70', '9015501898', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '2017-07-05 11:06:55', '2017-07-05 11:08:02'),
(7, 'Omor Faruk', 1, 'Abubakkar', 'Fatema', 'a@b.com', '733d7be2196ff70efaf6913fc8bdcabf', '01612345678', '27/12/1995', '798, South Dania', 'Dhaka', 2000, 'assets/uploads/diu15.jpg', 'assets/uploads/20140826_191049.jpg', 'assets/uploads/22366797_2041828469370433_7155275343878211843_n.jpg', 'assets/uploads/diu3.jpg', 'assets/uploads/diu8.jpg', 'assets/uploads/---Aguner pahar.mp4', 'Hello World dsfsdbngi dfg cvujhweif hgevbfiuwebf defvbweufy', 'Published', '2018-09-21 04:19:06', '2018-10-31 17:03:49'),
(8, 'Shah Mahmud', 1, '', '', 'b@b.com', '83b4ef5ae4bb360c96628aecda974200', '01928391314', '', '', 'Dhaka', 10000, '', '', '', '', '', '', '', 'Published', '2018-09-26 04:02:01', '2018-10-24 04:40:24'),
(9, 'Nazmul', 2, 'Jani na', 'Doesnot know', 'c@b.com', '827ccb0eea8a706c4c34a16891f84e7b', '01712345678', '12/12/1993', 'Dhanmondi', 'Dhaka', 1500, 'assets/uploads/diu5.jpg', 'assets/uploads/diu4.jpg', '', '', '', 'assets/uploads/Facebook_3.mp4', '', 'Published', '2018-09-28 13:49:11', NULL),
(10, 'Omor Sarif', 1, NULL, NULL, 'b@c.com', 'e10adc3949ba59abbe56e057f20f883e', '01714725836', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', 'Unpublished', '2018-10-30 04:23:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblactivationstatus`
--
ALTER TABLE `tblactivationstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`CartId`);

--
-- Indexes for table `tblcategories`
--
ALTER TABLE `tblcategories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblactivationstatus`
--
ALTER TABLE `tblactivationstatus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `BookingId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `CartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblcategories`
--
ALTER TABLE `tblcategories`
  MODIFY `CategoryId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
