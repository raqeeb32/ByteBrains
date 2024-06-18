-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 12:13 PM
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
-- Database: `skillyearndb`
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
(1, 'hello this is ok !');

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
(1, 'syedmatheen@admin.com', '777');

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
(27, 'Design', '<i class=\"fa-solid fa-code\"></i>');

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
(8, 'intro to web4', '20minutes', 13),
(10, 'basic css', '20min', 13);

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
(1, 'syedmatheenma3@gmail.com', '#54 Govindappa dj halli bangalore-45', '#54 shrinivasnagar dj halli bangalore-45', 'www.youtube.com/@use', 'www.facebook.com/sye', 'www.googleplus.com/s', 'www.twitter.com/syed', 'www.linkedin.com/sye', '7338661899');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL,
  `course_desc` text NOT NULL,
  `course_img` text NOT NULL,
  `course_duration` text NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_org_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `course_img`, `course_duration`, `course_price`, `course_org_price`) VALUES
(13, 'Learn react basic', 'learn complete react in 1 day', '../images/courseimg/react.png', '1 day', 300, 200),
(15, 'graphic designing', 'gs', '../images/courseimg/', '5 days', 99, 199);

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
(5, 'Whats the pre requisite to learn any course', 'just ur time and serious mind to learn and become something');

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
(89, 'iamInst', 'inst2@mail.com', '2', '../images/instructorIMG/std1.jpg', '', ''),
(90, 'Ayman1', 'aafath@gmail.com', '121', '', 'i dont know', 'developer'),
(91, 'saq', 'saq1@mail.com', '1', '../images/instructorIMG/std1.jpg', '', '');

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
(5, 'Hindi'),
(7, 'kannada');

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
(2, 'html basic', 'New Rules.mp4', '3hr', 8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `stu_pass` varchar(255) NOT NULL,
  `stu_img` text NOT NULL DEFAULT '../student/images/profileIMG/std1.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_email`, `stu_pass`, `stu_img`) VALUES
(25, 'matheen2', 'matheen2@mail.com', '2', '../student/images/profileImg/ic_google-3.png'),
(29, 'saqlain', 'itsSaqu@gmail.com', '121', '../student\\images\\profileImg/std1.jpg'),
(40, 'demo', 'demo@mail.com', '121', '../student\\images\\profileImg/std1.jpg');

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
(5, 'investment', 3),
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
(3, 'nothing', 'teacher'),
(5, 'demo', 'teacher'),
(6, 'mj is not working properly', 'teacher'),
(10, 'Learn properly', 'teacher');

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
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`q_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `con_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `q_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `lang_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `ch_id` FOREIGN KEY (`ch_id`) REFERENCES `chapter` (`ch_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
