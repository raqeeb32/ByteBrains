-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 06:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bytebrainsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `a_id` int(10) NOT NULL,
  `about` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`a_id`, `about`) VALUES
(1, 'ByteBrains is an LMS platform designed for learners to have an insight on various courses.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(2, 'raqeeb@admin.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_ID` int(25) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `cat_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_ID`, `categoryName`, `cat_icon`) VALUES
(1, 'Finance', '<i class=\"fa-solid fa-coins\"></i>'),
(2, 'Development', '<i class=\"fa-solid fa-code\"></i>'),
(3, 'Marketting', '<i class=\"fa-solid fa-timeline\"></i>'),
(4, 'Account', '<i class=\"fa-solid fa-file-invoice-dollar\"></i>'),
(27, 'Design', '<i class=\"fa-solid fa-code\"></i>'),
(31, 'Art', '<i class=\"fa-solid fa-timeline\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `ch_id` int(11) NOT NULL,
  `ch_name` varchar(255) NOT NULL,
  `duration` text NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`ch_id`, `ch_name`, `duration`, `course_id`) VALUES
(18, 'Introduction to Java', '5mins', 50),
(19, 'Download and install JDK', '10mins', 50),
(20, 'Intro to AI', '10min', 51),
(21, 'Introduction to Data Science', '1hr', 52),
(22, 'Probability and Statistics', '1hr', 52),
(23, 'Key AI Techniques', '1hr', 51),
(24, 'The AI tech stack', '50min', 51),
(25, 'First java program using Notepad', '20mins', 50),
(26, 'What is python', '5mins', 54);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `con_id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `yt` varchar(20) NOT NULL,
  `fb` varchar(20) NOT NULL,
  `gp` varchar(20) NOT NULL,
  `tw` varchar(20) NOT NULL,
  `link` varchar(20) NOT NULL,
  `phn` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`con_id`, `email`, `address1`, `address2`, `yt`, `fb`, `gp`, `tw`, `link`, `phn`) VALUES
(1, 'raqeebrabdul32@gmail.com', '27/3 Haines Road', 'Bangalore 51', 'www.youtube.com/@use', 'www.facebook.com/sye', 'www.googleplus.com/s', '', '', '9019112599');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL,
  `category_ID` int(11) NOT NULL,
  `course_desc` text NOT NULL,
  `course_img` text NOT NULL,
  `course_duration` text NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_org_price` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  `what_will_you_learn` varchar(255) NOT NULL,
  `requirements` text NOT NULL,
  `ins_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `category_ID`, `course_desc`, `course_img`, `course_duration`, `course_price`, `course_org_price`, `language`, `what_will_you_learn`, `requirements`, `ins_id`) VALUES
(50, 'Java', 27, 'Java Course', 'images/courseimg/Screenshot 2025-03-19 152244.png', '3', 1999, 3999, 'English ', 'gfyui9o0ppjhg', 'java\r\njdk', 94),
(51, 'Artificial Intelligence', 2, 'The AI Engineer Course 2025: Complete AI Engineer Bootcamp', 'images/courseimg/finch.jpg', '6 months', 1999, 5000, 'English ', 'The course provides the entire toolbox you need to become an AI Engineer\r\nUnderstand key Artificial Intelligence concepts and build a solid foundation\r\nStart coding in Python and learn how to use it for NLP and AI', 'Computer/\r\nLaptop\r\nMobile', 94),
(52, 'Data Scientist Career Accelerator', 2, 'Your career in data science starts here. Fast-track learning and interview prep. Grow skills at your own pace. Expand your earnings potential.', 'images/courseimg/DATA SCIENCE.jpg', '46hrs', 1400, 11999, 'English ', 'Statistics, Python, & Deep Learning\r\nSQL & MySQL', 'Pc/Laptop', 94),
(53, 'Complete Guide to Build IOT Things from Scratch to Market', 2, 'Build IOT products using Arduino, NodeMCU,ESP8266, IOT Platforms, Sensors, Displays, Keypads,Relays, PCB\'s,Casing & more', 'images/courseimg/iot.jpg', '60hrs', 2000, 6999, 'English ', 'Learn how to Independently Design, Code and Build IOT products.', 'Laptop/Mobile with internet', 94),
(54, 'Python', 2, 'Python for beginners', 'images/courseimg/Screenshot 2025-05-14 122747.png', '1hr', 2000, 5000, 'English ', 'Python fundamentals', 'Pc', 94);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `e_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `purchase_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`e_id`, `stu_id`, `course_p_id`, `purchase_time`) VALUES
(17, 41, 50, '2025-05-09'),
(19, 41, 51, '2025-05-12'),
(20, 41, 54, '2025-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `q_id` int(10) NOT NULL,
  `qsn` varchar(500) NOT NULL,
  `ans` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`q_id`, `qsn`, `ans`) VALUES
(1, 'How to learn', 'Just learn'),
(2, 'How to watch', 'Need source'),
(3, 'what is pen', 'Its just a pen'),
(4, 'what is this website', 'This website is for making students or learners or disabilities to learn from their home without going out at their time any where anytime and any one can just buy and learn with affordable price.'),
(5, 'Whats the pre requisite to learn any course', 'just ur time and serious mind to learn and become something'),
(6, 'How to view this course?', 'Through mobile or desktop.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `f_content` text NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `bio` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `name`, `email`, `password`, `photo`, `bio`, `specialization`) VALUES
(94, 'Raqeeb', 'raqeeb@instructor.com', '123456', '', '', ''),
(95, 'Johny', 'johny@instructor.com', '123456', '', 'Mtech, PHD', 'BCA, MCA'),
(96, 'Zain', 'zain@instructor.com', '123456', '', 'I\'m chor', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `lang_id` int(10) NOT NULL,
  `lang_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`lang_id`, `lang_name`) VALUES
(3, 'English '),
(5, 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `l_id` int(11) NOT NULL,
  `l_name` text NOT NULL,
  `l_link` text NOT NULL,
  `l_duration` text NOT NULL,
  `ch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`l_id`, `l_name`, `l_link`, `l_duration`, `ch_id`) VALUES
(9, 'What is java?', 'What is Java  _ Java for Beginners.mp4', '8mins', 18),
(10, 'What is Ai?', 'What is AI .mp4', '5mins', 20),
(11, 'What is Data Science?', 'What is Data Science.mp4.crdownload', '5mins', 21);

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `r_id` int(10) NOT NULL,
  `requirement` text NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`r_id`, `requirement`, `course_id`) VALUES
(6, '', 25),
(7, 're1', 27),
(8, 're0', 28),
(9, 're10', 29),
(10, 'eng,jid,hhh,kkkk', 30),
(11, 'eng,jid,hhh,kkkk3', 31),
(12, 're109', 32);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `stu_pass` varchar(255) NOT NULL,
  `stu_img` text NOT NULL DEFAULT '../student/images/profileIMG/std1.jpg',
  `stu_occ` text NOT NULL DEFAULT 'Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_email`, `stu_pass`, `stu_img`, `stu_occ`) VALUES
(41, 'Abdul Raqeeb', 'raqeeb@student.com', '123456', '../student/images/stdi.jpg', 'Student'),
(42, 'Zain', 'zain@student.com', '123456', '../student/images/stdz.jpg', 'Student'),
(43, 'Abdul Raqeeb', 'raqeeb1@student.com', '5987', '../student/images/profileIMG/std1.jpg', 'Student'),
(44, 'Abdul Raqeeb', 'raqeeb2@student.com', '123', '../student/images/profileIMG/std1.jpg', 'Student'),
(45, 'Abdul Raqeeb', 'raqeeb000@student.com', '1234', '../student/images/profileIMG/std1.jpg', 'Student'),
(46, 'Abdul Raqeeb', 'raqeeb20@student.com', '123', '../student/images/profileIMG/std1.jpg', 'Student'),
(47, 'Abdul Raqeeb', 'raqeeb20@student.com', '123', '../student/images/profileIMG/std1.jpg', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_ID` int(25) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `category_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_ID`, `subcategory_name`, `category_ID`) VALUES
(5, 'Investment', 3),
(6, 'HTML', 2),
(7, 'figma', 27);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `t_id` int(10) NOT NULL,
  `term` varchar(100) NOT NULL,
  `for_whome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`t_id`, `term`, `for_whome`) VALUES
(3, 'Always ensure quality education.', 'teacher'),
(5, 'Happy Learning : )', 'student'),
(10, 'Teacher is GURU', 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`ch_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `category_ID` (`category_ID`),
  ADD KEY `ins_id` (`ins_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `stu_id` (`stu_id`),
  ADD KEY `course_p_id` (`course_p_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `ch_id` (`ch_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_ID`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `con_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `q_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `lang_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `r_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `category_ID` FOREIGN KEY (`category_ID`) REFERENCES `categories` (`category_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ins_id` FOREIGN KEY (`ins_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `course_p_id` FOREIGN KEY (`course_p_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `stu_id` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `ch_id` FOREIGN KEY (`ch_id`) REFERENCES `chapter` (`ch_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
