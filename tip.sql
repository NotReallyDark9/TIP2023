-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 08:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tip`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `applyID` int(11) NOT NULL,
  `jobID` int(11) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  `fn` varchar(20) DEFAULT NULL,
  `ln` varchar(20) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `rcq` text DEFAULT NULL,
  `resume` blob DEFAULT NULL,
  `job_status` enum('Rejected','Waiting','Accepted') DEFAULT 'Waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`applyID`, `jobID`, `memberID`, `fn`, `ln`, `web`, `start_date`, `phone`, `rcq`, `resume`, `job_status`) VALUES
(28, 6, 2, 'H', 'L', 'https://www.youtube.com/', '2023-05-31', '0410409699', 'uiagwevriukujhb rawevirgvuya', 0x433a5c78616d70705c6874646f63735c7469702f75706c6f6164732f5265706f72742e706466, 'Waiting');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `memberID` int(11) DEFAULT NULL,
  `jobID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`memberID`, `jobID`) VALUES
(NULL, NULL),
(NULL, NULL),
(1, NULL),
(1, NULL),
(1, NULL),
(1, NULL),
(1, 3),
(1, 5),
(1, 6),
(2, 6),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `job_type` enum('Casual','Part-Time') DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `area` enum('Business','Design','Education','Engineering','Health','Information Technology','Law','Media and Communication','Nursing','Psychology','Science') DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `job_des` text DEFAULT NULL,
  `job_req` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobID`, `name`, `job_type`, `location`, `area`, `salary`, `job_des`, `job_req`) VALUES
(3, 'School Counselor', 'Part-Time', 'Carlton', 'Education', 45600.00, 'As a School Counselor, you will be responsible for helping students navigate the educational system, planning their academic goals, overcoming personal challenges, and setting career goals. You will provide individual and group counseling, academic advisement and personal development support.', 'Master’s degree in counseling or related field. State licensure and certification to practice counseling. Proven experience as a school counselor. Excellent listening and questioning skills, and the ability to interpret complex information to help students make suitable decisions.'),
(4, 'Software Engineer', 'Casual', 'Brunswick', 'Engineering', 68000.00, 'The Software Engineer will develop information systems by designing, developing, and installing software solutions. Responsibilities include development of software solutions by studying information needs, conferring with users, studying systems flow, data usage, and work processes.', 'Bachelor’s degree in Computer Science, Software Engineering or a related field. Proven software engineering experience. Solid programming skills and a proficiency in languages such as Python, Java, C++. Knowledge of databases and operating systems.'),
(5, 'Nutritionist', 'Part-Time', 'Richmond', 'Health', 53000.00, 'The Nutritionist will provide our clients with comprehensive advice on matters of well being. As an expert in food and nutrition, you will guide people to lead a healthy lifestyle or achieve a specific health-related goal.', 'Degree in nutrition, health and dietetics or relevant field. Valid license to practice the profession. Proven experience as nutritionist. Excellent communication and interpersonal skills with the ability to explain complex health issues in simple terms.'),
(6, 'Data Analyst', 'Casual', 'St Kilda', 'Information Technology', 62000.00, 'The Data Analyst will turn data into information, information into insight and insight into business decisions. Data analyst responsibilities include conducting full lifecycle analysis to include requirements, activities and design.', 'Bachelor’s degree in Mathematics, Economics, Computer Science, Information Management or Statistics. Proven working experience as a Data Analyst. Strong analytical skills with the ability to collect, organize, analyze, and disseminate significant amounts of information.'),
(7, 'Paralegal', 'Part-Time', 'Caulfield', 'Law', 47000.00, 'The Paralegal will provide comprehensive legal support to our lawyers and clients. This includes conducting legal research, organizing files, preparing legal documents, and drafting correspondence.', 'Paralegal certification or degree in Legal Studies. Proven work experience as a paralegal. Knowledge of legal terminologies and procedures. Excellent verbal and written communication skills.'),
(9, 'Registered Nurse', 'Part-Time', 'Port Melbourne', 'Nursing', 72000.00, 'The Registered Nurse will be responsible for providing care to patients, collecting patient health data, administering medications and treatments, educating patients on disease prevention, and working collaboratively with the healthcare team to optimize patient care.', 'Bachelor’s degree in Nursing. Registered Nurse (RN) license. Proven nursing experience. Excellent clinical, customer service and communication skills. Familiarity with healthcare regulations.'),
(10, 'Research Scientist', 'Casual', 'Collingwood', 'Science', 69000.00, 'The Research Scientist will conduct a series of research procedures in a particular field of science. The candidate will be performing scientific tests on samples in the lab, recording findings, analyzing results and reporting to the relevant parties.', 'PhD or Master’s degree in a related field. Proven work experience as a research scientist. Profound knowledge in the specific scientific field. Good understanding of research methods and data analysis.'),
(15, 'Social Media Coordinator', 'Casual', 'Glen Iris', 'Media and Communication', 696969.00, 'Tracks key metrics such as audience engagement, impressions, reach, referrals, and conversions\r\nSchedules social media posts and monitors relevant news and content\r\nWrites and reviews press releases, newsletters, blogs, and other content\r\nCreates infographics and other appealing visuals\r\nMaintains awareness with the latest social media platform developments\r\nSecures social media passwords\r\nCreates and manages lead generation ads across different platforms', 'Social media marketing experience is a plus\r\nHighly proficient in MS Office\r\nExperience in using social media management software solutions (Sprout Social, Buffer, Hootsuite) and web analytics (Google Analytics) \r\nWorking knowledge in Adobe Photoshop and other editing tools\r\nOutstanding written and verbal communication skills\r\nSolid editing and presentation skills\r\nCreative and innovative\r\nBachelor’s degree in Marketing, Business, or related fields');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `qname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `qname`, `email`, `subject`, `message`) VALUES
(1, 'Hoang Lai', '1@2.com', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `memberID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_main` varchar(255) NOT NULL,
  `status` enum('Waiting','Staff','PStaff') DEFAULT 'Waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`memberID`, `firstname`, `lastname`, `phone`, `email`, `password`, `password_main`, `status`) VALUES
(1, 'Jahnavi', 'Nagireddy', '047077777', 'jahnavinagireddy1996@gmail.com', '$2y$10$gVdzgwwhj1iwRycV1fJka.NYcwfX0Fwlb9Eh7N4oPEqsrDZUaiUn6', 'jahnavi96', 'Waiting'),
(2, 'Hoang', 'Lai', '0410409699', 'hoangmeobeo@gmail.com', '$2y$10$jo0DigsIIp6FVJA/uIZ/k.37jPshrmlCswJOgqgab0OE1ZBfe38Pi', '1234', 'PStaff'),
(3, 'Hoang', 'Lai', '099999999', 'a@b.com', '$2y$10$PvhyVbTqTT1IkRKLklpBBOWO2B4CaMhf4qLDDAelWijifWzVGSH6i', '1111', 'Waiting');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`applyID`),
  ADD KEY `jobID` (`jobID`),
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD KEY `memberID` (`memberID`),
  ADD KEY `jobID` (`jobID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `applyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`jobID`),
  ADD CONSTRAINT `apply_ibfk_2` FOREIGN KEY (`memberID`) REFERENCES `users` (`memberID`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `users` (`memberID`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`jobID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
