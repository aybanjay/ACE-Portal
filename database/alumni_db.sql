-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 05:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus_bio`
--

CREATE TABLE `alumnus_bio` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `course_id` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `connected_to` text NOT NULL,
  `avatar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= Unverified, 1= Verified',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumnus_bio`
--

INSERT INTO `alumnus_bio` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `batch`, `course_id`, `email`, `address`, `connected_to`, `avatar`, `status`, `date_created`) VALUES
(7, 'Neil Carlos', 'Melendez', 'Gubatan', 'Male', '2024', 1, 'gneiil@gmail.com', '', '', '', 1, '2023-03-21'),
(8, 'Engilbert', '', 'Comadre', 'Male', '2009', 1, 'bert@gmail.com', '', '', '', 1, '2023-03-21'),
(62, 'vdfgd', 'dferer', 'fgdgfg', 'Male', ' 2023', 1, 'jaal.biasbas.up@phinmaed.com', 'Gueguesangen, Mangaldan, Pangasinan', '', '', 1, '2023-05-22'),
(63, 'Jay Ivan', 'Alicoben', 'Biasbas', 'Male', ' 2023', 1, 'biasbas.jayivan@gmail.com', 'Gueguesangen Mangaldan', '', '', 1, '2023-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `user_id` int(30) NOT NULL,
  `career_id` int(30) NOT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1=shortlisted, 2=interviewed, 3=hired',
  `date_applied` datetime NOT NULL,
  `date_updated` datetime DEFAULT current_timestamp(),
  `date_interview` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`user_id`, `career_id`, `status`, `date_applied`, `date_updated`, `date_interview`) VALUES
(44, 62, 1, '2023-05-23 15:36:52', '2023-05-23 15:36:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(30) NOT NULL,
  `company` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `job_title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `company`, `location`, `job_title`, `description`, `user_id`, `date_created`, `confirmed_at`) VALUES
(57, 'Accenture', 'Jan Lang', 'Web Dev', 'Herllo World&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;sd&lt;/p&gt;&lt;p&gt;sd&lt;/p&gt;', 10, '2023-05-02 17:33:52', '2023-05-02 17:35:56'),
(58, 'Accenture', 'Dito', 'Data Analyst', 'dsfsdfds', 10, '2023-05-02 20:08:32', '2023-05-02 20:09:00'),
(60, 'Accenture', 'Manila, Philippines', 'Programmer', '&lt;i&gt;&lt;b&gt;Salary 20k&lt;/b&gt;&lt;/i&gt;&lt;p&gt;&lt;i&gt;&lt;b&gt;&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;G&lt;/b&gt;ood Communication Skills&lt;/p&gt;&lt;p&gt;Knowledgeable in DBMS such asMSSQL, MYSQL, NOsql&lt;/p&gt;', 10, '2023-05-03 02:16:49', '2023-05-03 02:38:34'),
(61, 'Free Lance', 'Dagupan City', 'Web Developer', 'Jan Jan Lanah<p><br></p><p>asdas</p><p>dasd</p><p>as</p>', 42, '2023-05-03 06:45:49', '2023-05-03 06:47:17'),
(62, 'random', 'mangaldan', 'title ito', 'blahblahblah', 42, '2023-05-22 19:48:52', '2023-05-23 00:23:50'),
(63, 'Accenture', 'manila', 'project manager', 'project manager', 10, '2023-05-22 19:51:26', '2023-05-23 00:22:54'),
(64, 'Accenture', 'makati', 'data analyst', '&lt;ul&gt;&lt;li&gt;&lt;span style=&quot;background-color: rgb(247, 247, 248); white-space-collapse: preserve;&quot;&gt;Collect and analyze large datasets to extract meaningful insights&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;background-color: rgb(247, 247, 248); white-space-collapse: preserve;&quot;&gt;Develop and maintain dashboards and reports for key stakeholders&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;background-color: rgb(247, 247, 248); white-space-collapse: preserve;&quot;&gt;Identify trends, patterns, and anomalies to support business objectives&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;background-color: rgb(247, 247, 248); white-space-collapse: preserve;&quot;&gt;Collaborate with cross-functional teams to optimize data processes&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;background-color: rgb(247, 247, 248); white-space-collapse: preserve;&quot;&gt;Generate actionable recommendations based on analytical findings&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;', 10, '2023-05-22 19:53:19', '2023-05-23 00:23:39'),
(65, 'Web Solutions', 'Dagupan City, Pangasinan', 'Web Developer', '', 42, '2023-05-23 10:59:48', NULL),
(66, 'Sample Company', 'Manila, NCR', 'Social Media Specialist', '', 42, '2023-05-23 11:00:38', NULL),
(91, 'dsffdf', 'dfsfd', 'dfsdf', 'dsffsdf', 42, '2023-05-23 13:52:28', NULL),
(99, 'Accenture', 'ghfh', 'jgyu', 'tuyu', 10, '2023-05-23 15:34:58', NULL),
(100, 'okijg', 'lkjg', 'tyj', 'ij', 42, '2023-05-23 15:35:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `name`, `user_id`) VALUES
(4, 'Power Tools!', 8),
(5, 'Accenture', 10),
(6, 'Oracle Philippines Corportion', 11),
(7, 'Freelance', 41),
(8, 'Sample Company', 45);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `about`) VALUES
(1, 'BS Information Technology', 'Sample'),
(2, 'BS Psych', 'sample');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `objectives` text NOT NULL,
  `skills` text NOT NULL,
  `course` varchar(50) NOT NULL DEFAULT '',
  `batch` varchar(50) NOT NULL DEFAULT '',
  `job_title` varchar(50) DEFAULT '',
  `emp` varchar(50) DEFAULT '',
  `sdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `ref_1` text NOT NULL,
  `ref_2` text NOT NULL,
  `ref_3` text NOT NULL,
  `profile` varchar(50) NOT NULL DEFAULT '',
  `contact` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `user_id`, `alumni_id`, `objectives`, `skills`, `course`, `batch`, `job_title`, `emp`, `sdate`, `edate`, `ref_1`, `ref_2`, `ref_3`, `profile`, `contact`, `status`, `created_at`) VALUES
(15, 62, 0, '', '', 'BS Information Technology', '', '', '', '0000-00-00', '0000-00-00', ', , ', ', ,', ', , ', '', '', 1, '2023-05-23 13:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `schedule` datetime NOT NULL,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Ace Portal', 'AcePortal@email.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Alumni officer, 3= alumnus, 4=company',
  `auto_generated_pass` text NOT NULL,
  `alumnus_id` int(30) NOT NULL,
  `password_token` varchar(250) DEFAULT NULL,
  `password_token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `auto_generated_pass`, `alumnus_id`, `password_token`, `password_token_expiration`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '', 0, NULL, NULL),
(4, 'Company Test', 'company@test.com', 'e10adc3949ba59abbe56e057f20f883e', 4, '', 0, NULL, NULL),
(8, 'Test Power', 'powertools@email.com', 'e10adc3949ba59abbe56e057f20f883e', 4, '', 0, NULL, NULL),
(9, 'test test', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', 3, '1807738025641916', '2023-03-21 02:27:21'),
(10, 'TestAccenture TestAccenture', 'accenture@email.com', '568ddb5e09e2c75d95d989d48ff3311f', 4, '', 0, NULL, NULL),
(11, 'TestOracle TestOracle', 'oracle@email.com', '754ac3325a7f835bd7b4fd99f85c25ff', 4, '', 0, NULL, NULL),
(13, 'qtcat ponyo', 'ivan@gmail.com', 'e67195e79f6fa9f02fd6437ee3996749', 3, '', 5, NULL, NULL),
(14, 'Neil Carlos  Gubatan', 'gneil@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3, '', 6, NULL, NULL),
(15, 'Neil Carlos Gubatan', 'gneiil@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3, '', 7, NULL, NULL),
(42, 'James Potter', 'hello@gmail.com', '$2y$10$2/VbCCsJe/ajYefEXW5zHe7h4mfGWDnOLw92bQvRUbGgJ95wn14Yy', 5, '', 0, NULL, NULL),
(44, 'vdfgd fgdgfg', 'jaal.biasbas.up@phinmaed.com', '3ea5c9c10d7649a7673cac967f38de6c', 3, '', 62, NULL, NULL),
(45, 'Web Web', 'backup.jayivan@gmail.com', 'b8b41c35259f3482a433eb5b5dcaafb0', 4, '', 0, NULL, NULL),
(46, 'Shairah', 'shai', 'ffd387bf945ea4d87b23690b8a373af0', 2, '', 0, NULL, NULL),
(48, 'random', 'random123', '332b3091416bc4687821c4653f1c6eb1', 2, '', 0, NULL, NULL),
(49, 'reynard', 'rey123', '03b6c04a53d08b6c4f9b76e814c52137', 2, '', 0, NULL, NULL),
(50, 'Reynardetfcc', 'rey1234', '38f1cf51cbcd637812615f4483424f21', 1, '', 0, NULL, NULL),
(51, 'neil', 'neil213', '90bf59aa12e033b457a0551a2f753354', 2, '', 0, NULL, NULL),
(52, 'ewan', 'ewan123', '795d3c8619f6f18cf7d1f5c8c13c65e2', 2, '', 0, NULL, NULL),
(53, 'Jay Ivan Biasbas', 'biasbas.jayivan@gmail.com', '7e1be7a41fc3e09cdf6ac73975fa1276', 3, '', 63, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
