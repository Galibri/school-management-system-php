-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2018 at 06:11 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myschool_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `attendance` varchar(15) DEFAULT 'N',
  `global_name_id` int(10) NOT NULL,
  `teacher_email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `dates`, `student_id`, `attendance`, `global_name_id`, `teacher_email`) VALUES
(46, '2018-07-17', '20180A0602@school.com', 'N', 52, 'mdserajuddin1958@gmail.com'),
(45, '2018-07-17', '20180A0601@school.com', 'N', 52, 'mdserajuddin1958@gmail.com'),
(40, '2018-07-18', '20180A0605@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(41, '2018-07-18', '20180A0604@gmail.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(42, '2018-07-18', '20180A0603@school.com', 'N', 52, 'mdserajuddin1958@gmail.com'),
(43, '2018-07-18', '20180A0602@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(44, '2018-07-18', '20180A0601@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(47, '2018-07-17', '20180A0603@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(48, '2018-07-17', '20180A0604@gmail.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(49, '2018-07-17', '20180A0605@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(50, '2018-07-16', '20180A0601@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(51, '2018-07-16', '20180A0602@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(52, '2018-07-16', '20180A0603@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com'),
(53, '2018-07-16', '20180A0604@gmail.com', 'N', 52, 'mdserajuddin1958@gmail.com'),
(54, '2018-07-16', '20180A0605@school.com', 'Y', 52, 'mdserajuddin1958@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(3) NOT NULL,
  `class` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`) VALUES
(1, 6),
(2, 7),
(6, 8),
(4, 9),
(9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `classtime`
--

CREATE TABLE `classtime` (
  `id` int(11) NOT NULL,
  `class_time` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classtime`
--

INSERT INTO `classtime` (`id`, `class_time`) VALUES
(15, '3.30pm'),
(14, '10.20am'),
(5, '11:00am'),
(6, '11:30am'),
(11, '12:30pm'),
(10, '12:00pm'),
(19, '2.00pm'),
(20, '2.30pm'),
(21, '3.00pm'),
(22, '4.00pm');

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `id` int(5) NOT NULL,
  `global_name_id` int(5) NOT NULL,
  `teacher_email` varchar(50) NOT NULL,
  `subject_name_id` int(6) NOT NULL,
  `class_time` varchar(255) NOT NULL,
  `class_days` varchar(255) NOT NULL,
  `is_class_teacher` varchar(5) NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_teacher`
--

INSERT INTO `class_teacher` (`id`, `global_name_id`, `teacher_email`, `subject_name_id`, `class_time`, `class_days`, `is_class_teacher`) VALUES
(26, 52, 'mdsarwarhossain72@gmail.com', 3, '11:00am', '["Saturday","Sunday","Monday"]', 'N'),
(24, 52, 'mdserajuddin1958@gmail.com', 15, '10.20am', '["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"]', 'Y'),
(25, 53, 'mdserajuddin1958@gmail.com', 15, '11:00am', '["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"]', 'N'),
(27, 53, 'mdsarwarhossain72@gmail.com', 3, '11:30am', '["Saturday","Sunday","Monday"]', 'N'),
(28, 55, 'anchalabormon2000@gmail.com', 5, '10.20am', '["Saturday","Sunday","Monday"]', 'Y'),
(29, 52, 'anchalabormon2000@gmail.com', 5, '11:30am', '["Saturday","Sunday","Monday"]', 'N'),
(30, 52, 'mdserajuddin1958@gmail.com', 8, '12:00pm', '["Saturday","Sunday","Monday","Tuesday"]', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(6) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_desc` text,
  `event_date` date NOT NULL,
  `event_image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_title`, `event_desc`, `event_date`, `event_image`) VALUES
(2, 'Second Events', '<p>Lorem Ipsum dolor sit <span style="font-size: 14pt;"><strong>amets</strong></span></p>', '2018-06-29', 'Penguins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `grading_result`
--

CREATE TABLE `grading_result` (
  `id` int(5) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `total_marks` float NOT NULL,
  `final_gpa` float NOT NULL,
  `position` int(4) NOT NULL DEFAULT '0',
  `result_status` varchar(10) NOT NULL,
  `current_roll` int(4) NOT NULL,
  `student_class` int(3) NOT NULL,
  `section` varchar(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(5) NOT NULL,
  `class_id` int(5) NOT NULL,
  `group_name` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `class_id`, `group_name`) VALUES
(1, 4, 'Science'),
(2, 4, 'Humanities'),
(3, 1, 'Commerce'),
(4, 8, 'Science'),
(5, 8, 'Humanities'),
(6, 8, 'Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(6) NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `notice_desc` text NOT NULL,
  `notice_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice_title`, `notice_desc`, `notice_date`) VALUES
(1, 'Our first notice title', '<p>Yeaskasjdfhk jjhsdakfj knjkh sdfjaksldjf ksjfklasdjf</p>', '2018-06-24'),
(2, 'This is our second notice', 'From tomorrow, your school if off for life time.', '2018-06-13'),
(6, 'Our new notice', 'This will be added', '2018-06-13'),
(13, 'eid vacation', '<p>21 to 26 june</p>', '2018-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` int(11) NOT NULL,
  `page_name` varchar(20) NOT NULL,
  `page_text` text,
  `page_image` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `page_name`, `page_text`, `page_image`) VALUES
(1, 'about_page', '<h3><strong>About Us</strong></h3>\r\n<p><span style="font-size: 14pt;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium.</span></p>\r\n<p><span style="font-size: 14pt;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium.</span></p>\r\n<div class="theme-margin">&nbsp;</div>\r\n<h3><strong>Our Mission</strong></h3>\r\n<p><span style="font-size: 14pt;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium.</span></p>\r\n<div class="theme-margin">&nbsp;</div>\r\n<h3><strong>Our Vision</strong></h3>\r\n<p><span style="font-size: 14pt;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto accusamus iusto ducimus itaque officia, voluptate id sed sint, quas nulla voluptatum deleniti aliquam soluta dolorem et! Nisi distinctio eius praesentium.</span></p>', NULL),
(2, 'admission_page', '<h4><strong>Admission Classes:</strong>&nbsp;We only admit students in class 6 and class 9.</h4>\r\n<p>To get admitted, please bring the follwing&nbsp;<em>documents</em>:</p>\r\n<ol>\r\n<li>Certificate of Class 5/8</li>\r\n<li>Testimonial from school</li>\r\n<li>Four copy passport size photographs</li>\r\n<li>Marksheet of class 5/8</li>\r\n<li>Birth Certificate</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h4><strong>Admission Requirements</strong></h4>\r\n<ol>\r\n<li>Minimum GPA 3.50 out of 5.0</li>\r\n<li>Education gap upto 1 year</li>\r\n</ol>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_options`
--

CREATE TABLE `page_options` (
  `id` int(11) NOT NULL,
  `school_meta_key` varchar(55) NOT NULL,
  `school_meta_value` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_options`
--

INSERT INTO `page_options` (`id`, `school_meta_key`, `school_meta_value`) VALUES
(1, 'school_name', 'ROVER POLLY HIGH SCHOOL'),
(4, 'school_address', '<address>Joydevpur, Gazipur Sadar, Gazipur, Dhaka, Bangladesh</address>\r\n<p>Call now:&nbsp;<a href="callto:+8801700000000">+8801700000001</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `student_roll` int(4) NOT NULL,
  `exam_year` int(10) NOT NULL,
  `exam_type` varchar(20) NOT NULL,
  `global_name_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `marks` varchar(10) NOT NULL DEFAULT '0',
  `grade` float NOT NULL DEFAULT '0',
  `student_class` int(5) NOT NULL,
  `teacher_email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(5) NOT NULL,
  `class_id` int(5) NOT NULL,
  `section` varchar(20) NOT NULL,
  `group_name` varchar(30) DEFAULT NULL,
  `global_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `class_id`, `section`, `group_name`, `global_name`) VALUES
(52, 6, 'A', '', 'Class: 6 | Section: A '),
(53, 6, 'B', '', 'Class: 6 | Section: B '),
(54, 7, 'A', '', 'Class: 7 | Section: A '),
(55, 7, 'B', '', 'Class: 7 | Section: B '),
(56, 9, 'A', 'Science', 'Class: 9 | Section: A  | Group: Science'),
(57, 8, 'A', '', 'Class: 8 | Section: A '),
(58, 9, 'B', 'Science', 'Class: 9 | Section: B  | Group: Science'),
(59, 9, 'A', 'Commerce', 'Class: 9 | Section: A  | Group: Commerce'),
(60, 9, 'A', 'Humanities', 'Class: 9 | Section: A  | Group: Humanities'),
(61, 9, 'B', 'Commerce', 'Class: 9 | Section: B  | Group: Commerce'),
(62, 9, 'B', 'Humanities', 'Class: 9 | Section: B  | Group: Humanities'),
(63, 10, 'A', 'Science', 'Class: 10 | Section: A  | Group: Science'),
(64, 10, 'A', 'Humanities', 'Class: 10 | Section: A  | Group: Humanities'),
(65, 10, 'A', 'Commerce', 'Class: 10 | Section: A  | Group: Commerce'),
(66, 10, 'B', 'Science', 'Class: 10 | Section: B  | Group: Science'),
(67, 10, 'B', 'Humanities', 'Class: 10 | Section: B  | Group: Humanities'),
(68, 10, 'B', 'Commerce', 'Class: 10 | Section: B  | Group: Commerce'),
(69, 8, 'B', '', 'Class: 8 | Section: B ');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(12) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_class` int(3) NOT NULL,
  `student_section` varchar(10) DEFAULT NULL,
  `student_group` varchar(10) DEFAULT NULL,
  `student_roll` int(5) NOT NULL,
  `student_father_name` varchar(50) NOT NULL,
  `student_mother_name` varchar(50) NOT NULL,
  `student_address` text NOT NULL,
  `student_contact` varchar(20) NOT NULL,
  `student_dob` date DEFAULT NULL,
  `student_blood_group` varchar(15) DEFAULT NULL,
  `student_gender` varchar(10) DEFAULT NULL,
  `student_status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_email`, `student_name`, `student_class`, `student_section`, `student_group`, `student_roll`, `student_father_name`, `student_mother_name`, `student_address`, `student_contact`, `student_dob`, `student_blood_group`, `student_gender`, `student_status`) VALUES
(15, '20180B0601@school.com', 'Papia Akter', 6, 'B', '', 1, 'monsur Ali', 'Najma Akter', '<p>Gazipur, Dhaka</p>', '01789394095', '2006-03-17', 'A+', 'Female', 'active'),
(14, '20180A0605@school.com', 'Shakil Ahmed', 7, 'A', '', 1, 'Monsur Ali', 'Kobita Akter', '<p>Gazipur, Dhaka</p>', '017943074502', '2006-07-15', 'AB-', 'Male', 'active'),
(13, '20180A0604@gmail.com', 'Faruk Hossain', 7, 'B', '', 1, 'Sahjahan Mulla', 'Kamrunnahar', '<p>Gazipur,Dhaka</p>', '01837593920', '2006-02-14', 'A+', 'Male', 'active'),
(12, '20180A0603@school.com', 'Maksuda Akter', 7, 'B', '', 2, 'Nazmul Haque', 'Hasnahena', '<p>Gazipur, Dhaka</p>', '0189275979904', '2006-03-17', 'A+', 'Female', 'active'),
(11, '20180A0602@school.com', 'Nahida Akter Jhuma', 7, 'A', '', 2, 'Nazrul Islam', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01254789', '2006-02-17', 'O+', 'Female', 'active'),
(10, '20180A0601@school.com', 'Jahanara Akter', 6, 'A', '', 1, 'Ahsanullah', 'Najma Begum', '<p>Gazipur, Dhaka</p>', '01722898195', '2006-07-15', 'B+', 'Female', 'active'),
(16, '20180B0602@school.com', 'Nahid Hasan', 7, 'B', '', 3, 'Nazmul Haque', 'Samsun Nahar', '<p>Gazipur, dhaka</p>', '01728975960', '2006-02-17', 'A+', 'Male', 'active'),
(17, '20180B0603@school.com', 'Ibrahim Hossain', 7, 'A', '', 3, 'Najmul Huda', 'Sofia Akter', '<p>Gazipur,Dhaka</p>', '01478569321', '2006-02-17', 'AB-', 'Male', 'active'),
(18, '20180A0701@school.com', 'Labonno Akter', 7, 'A', '', 1, 'Ahsanullah', 'Najma Akter', '<p>Gazipur,Dhaka</p>', '01478569321', '2005-07-15', 'A+', 'Female', 'active'),
(19, '20180A0702@school.com', 'Shuma Akter', 7, 'A', '', 2, 'Gohor Mulla', 'Anwara Begum', '<p>Gazipur, Dhaka</p>', '017833333330', '2005-07-15', 'A+', 'Female', 'active'),
(20, '20180A0703@school.com', 'Saddam Hossain', 7, 'A', '', 3, 'Najmul Huda', 'Sofia Akter', '<p>Gazipur,Dhaka</p>', '018937520390', '2005-07-15', 'B+', 'Male', 'active'),
(21, '20180B0701@school.com', 'Kobita Bormon', 8, 'A', '', 2, 'Kushik Bormon', 'Moli Bormon', '<p>Gazipur,Dhaka</p>', '0178405022', '2004-02-11', 'O+', 'Female', 'active'),
(22, '20180B0702@school.com', 'Mili Akter', 8, 'B', '', 1, 'Najmul Huda', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '017878569321', '2004-07-15', 'A+', 'Female', 'active'),
(23, '20180B0703@school.com', 'Meheron Akter', 8, 'A', '', 1, 'Najmul Huda', 'Najma Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2005-02-14', 'O+', 'Female', 'active'),
(24, '20180A0801@school.com', 'Maliha Hossain', 8, 'A', '', 1, 'Ahsanullah', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01478569321', '2004-07-15', 'A+', 'Female', 'active'),
(25, '20180A08002@school.com', 'Jannatul Ferdous', 8, 'A', '', 2, 'Nazmul Haque', 'Samsun Nahar', '<p>Gazipur,Dhaka</p>', '01722898195', '2004-07-15', 'A+', 'Female', 'active'),
(26, '20180A0803@school.com', 'Monia Akter', 8, 'A', '', 3, 'Najmul Huda', 'Samsun Nahar', '<p>Gazipur,Dhaka</p>', '01722898195', '2004-07-15', 'AB+', 'Female', 'active'),
(27, '20180B0801@school.com', 'Mehedi Hasan', 8, 'B', '', 1, 'Ahsanullah', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2004-07-15', 'AB+', 'Male', 'active'),
(28, '20180B0802@school.com', 'Kanta Rani', 8, 'B', '', 2, 'Nazmul Haque', 'Samsun Nahar', '<p>Gazipur,Dhaka</p>', '0178349450', '2004-07-15', 'B-', 'Female', 'active'),
(29, '20180B0803@school.com', 'Moni Roy', 8, 'B', '', 3, 'Akash Roy', 'Bipasha Roy', '<p>Gazipur, Dhaka</p>', '01722898195', '2004-07-15', 'A+', 'Female', 'active'),
(30, '20180A0901@school.com', 'Israt Jahan', 9, 'A', 'Science', 1, 'Sanamul Haque', 'Alia Begum', '<p>Gazipur, Dhaka</p>', '01478569321', '2003-07-15', 'B+', 'Female', 'active'),
(31, '20180A0902@school.com', 'Laboni Akter', 9, 'A', 'Science', 2, 'Najmul Huda', 'Sofia Akter', '<p>Gazipur,Dhaka</p>', '01722898195', '2003-07-12', 'O+', 'Female', 'active'),
(32, '20180A0903@school.com', 'Maksuda Akter', 9, 'A', 'Science', 3, 'Nazrul Islam', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'B-', 'Female', 'active'),
(33, '20180A0904@school.com', 'Khairul Islam', 9, 'A', 'Commerce', 4, 'Ahsanullah', 'Najma Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'AB-', 'Male', 'active'),
(34, '20180A0905@school.com', 'Shamim hossian', 9, 'A', 'Humanities', 5, 'Nazrul Islam', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'A-', 'Male', 'active'),
(35, '20180B0901@school.com', 'Sangita Akter', 9, 'B', 'Science', 1, 'Najmul Huda', 'Samsun Nahar', '<p>Gazipur,Dhaka</p>', '01722898195', '2003-07-15', 'AB-', 'Female', 'active'),
(36, '20180B0902@school.com', 'Nasir Hossain', 9, 'B', 'Commerce', 2, 'Najmul Huda', 'Najma Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'O+', 'Male', 'active'),
(37, '20180B0903@school.com', 'Muhammad Asif', 9, 'B', 'Commerce', 3, 'Abdul Jobbar', 'Afia Begum', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'A+', 'Male', 'active'),
(38, '20180B0904@school.com', 'Aklima Akter', 9, 'B', 'Humanities', 4, 'Ahsanullah', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'A+', 'Female', 'active'),
(39, '20180B0905@school.com', 'Mahmuda Akter', 9, 'B', 'Humanities', 5, 'Abdur Rahman', 'Samsun Nahar', '<p>Gazipur, Dhaka</p>', '01722898195', '2003-07-15', 'AB+', 'Female', 'active'),
(40, '20180A1001@school.com', 'Tarin Islam', 10, 'A', 'Science', 1, 'Najmul Huda', 'Samsun Nahar', '<p>Gazipur, Dhaka</p>', '01722898195', '2002-07-15', 'O+', 'Female', 'active'),
(41, '20180A1002@school.com', 'Hillol Rahman', 10, 'A', 'Science', 2, 'Ahsanullah', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2002-07-15', 'AB+', 'Male', 'active'),
(42, '20180A1003@school.com', 'Mohsin Hossain', 10, 'A', 'Science', 3, 'Nazmul Haque', 'Samsun Nahar', '<p>Gazipur, dhaka</p>', '01722898195', '2002-07-15', 'O+', 'Male', 'active'),
(43, '20180A1004@school.com', 'shanta Islam', 10, 'A', 'Humanities', 4, 'Najmul Huda', 'Samsun Nahar', '<p>Dhaka, Gazipur</p>', '01722898195', '2002-07-15', 'B+', 'Female', 'active'),
(44, '20180B1001@school.com', 'Sajal bormon', 10, 'B', 'Science', 1, 'Kushik Bormon', 'Moli Bormon', '<p>Gazipur, Dhaka</p>', '01722898195', '2002-07-15', 'AB+', 'Male', 'active'),
(45, '20180B1002@school.com', 'Mithila Mahrin', 10, 'B', 'Commerce', 2, 'Ahsanullah', 'Najma Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2002-07-15', 'AB+', 'Female', 'active'),
(46, '20180B1003@school.com', 'Sabbir Hossain', 10, 'B', 'Commerce', 3, 'Nazmul Haque', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2002-07-15', 'A+', 'Male', 'active'),
(47, '20180B1004@school.com', 'Rubina Akter', 10, 'B', 'Humanities', 4, 'Najmul Huda', 'Samsun Nahar', '<p>Gazipr, Dhaka</p>', '01722898195', '2002-07-15', 'B+', 'Female', 'active'),
(48, '20180B1005@school.com', 'Shilpi Akter', 10, 'B', 'Humanities', 5, 'Najmul Huda', 'Sofia Akter', '<p>Gazipur, Dhaka</p>', '01722898195', '2002-07-15', 'A+', 'Female', 'active'),
(49, '20180A0606@school.com', 'Abu Raihan', 6, 'A', '', 6, 'Robiul Islam', 'Maliah khatun', '<p>Chaipara, Gazipur</p>', '01874154263', '2009-06-09', 'B+', 'Male', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(5) NOT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`) VALUES
(15, 'Matehmatics'),
(3, 'English First Paper'),
(6, 'Bangla Second Paper'),
(5, 'Bangla First Paper'),
(7, 'English Second Paper'),
(8, 'General Science'),
(9, 'Information and Communication Technology'),
(10, 'Social Science'),
(16, 'Biology'),
(12, 'Agriculture'),
(13, 'Home Economics'),
(14, 'Higher Mathmatics'),
(17, 'Physics'),
(18, 'Chemistry'),
(19, 'Business Study'),
(20, 'Accounting'),
(21, 'Finance'),
(22, 'Geography'),
(23, 'History'),
(24, 'Economics');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_designation` varchar(50) NOT NULL,
  `teacher_gender` varchar(10) DEFAULT NULL,
  `teacher_qualification` text NOT NULL,
  `teacher_email` varchar(50) NOT NULL,
  `teacher_address` text NOT NULL,
  `teacher_contact` varchar(20) NOT NULL,
  `teacher_image` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_designation`, `teacher_gender`, `teacher_qualification`, `teacher_email`, `teacher_address`, `teacher_contact`, `teacher_image`) VALUES
(13, 'Assistant Teacher', 'Male', '<p>M.Sc.</p>\r\n<p>B.Sc.</p>', 'monirhossain.roverpolly@gmail.com', '<p>Gazipur, Dhaka</p>', '01789456980', 'MONIR HOSSAIN.jpg'),
(16, 'Assistant Teacher', 'Male', '<p>BA</p>', 'bikaschandrabarman16@gmail.com', '<p>Gazipur, Dhaka</p>', '01712669724', 'BIKASH.jpg'),
(15, 'Assistant Teacher', 'Female', '<p>BA</p>', 'kanizfatemazuthi@gmail.com', '<p>Gazipur, Dhaka</p>', '01789346890', '2.jpg'),
(14, 'Assistant Teacher', 'Male', '<p>B.Sc</p>', 'mdsarwarhossain72@gmail.com', '<p>Gazipur, Dhaka</p>', '01789456145', 'SARWAR.jpg'),
(17, 'Sports Teacher', 'Male', '<p>BA</p>', 'azimrps40@gmail.com', '<p>Gazipur, Dhaka</p>', '01827589483', 'AZIM UDDIN.jpg'),
(18, 'Assistant Teacher', 'Male', '<p>BA</p>', 'habiluddin819@gmail.com', '<p>Gazipur, Dhaka</p>', '01711063038', 'HABIL.jpg'),
(19, 'Assistant Teacher', 'Female', '<p>BA</p>', 'anchalabormon2000@gmail.com', '<p>Gazipur, Dhaka</p>', '01714611401', 'ANCHALA.jpg'),
(20, 'Assistant Teacher', 'Female', '<p>BA</p>', 'lichia044@gmail.com', '<p>Gazipur, Dhaka</p>', '01724471977', 'LICHIA.jpg'),
(21, 'Assistant Teacher', 'Male', '<p>H.S.C</p>', 'mdserajuddin1958@gmail.com', '<p>Gazipur, Dhaka</p>', '01775035045', 'SIRAJ UDDIn.jpg'),
(22, 'Assistant Teacher', 'Male', '<p>BA</p>', 'mdabdurrahman256@gmail.com', '<p>Gazipur, Dhaka</p>', '01910447463', '3.jpg'),
(23, 'Assistant Teacher', 'Male', '<p>BA</p>', 'mdbillalhossain1964@gmail.com', '<p>Gazipur, Dhaka</p>', '0174446781', '4.jpg'),
(24, 'Assistant Teacher', 'Female', '<p>B.Sc</p>', 'nazninsultana100176@gmail.com', '<p>Gazipur, Dhaka</p>', '01927334373', '1.jpg'),
(25, 'Assistant Teacher', 'Female', '<p>B.Sc</p>', 'roksanarian@gmail.com', '<p>Gazipur, Dhaka</p>', '01713931588', 'ROKSANA.jpg'),
(26, 'Assistant Headmaster', 'Male', '<p>B.Sc</p>', 'momtazuddin1962@gmail.com', '<p>Gazipur, Dhaka</p>', '01713932922', 'MOMTAZ UDDIN.jpg'),
(27, 'Headmaster', 'Male', '<p>B.Sc.</p>', 'mdismailh807@gmail.com', '<p>Gazipur, Dhaka</p>', '01720132779', 'ISMAIL HOSSAIN.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `user_firstname` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `user_password`, `user_role`, `user_firstname`, `user_lastname`) VALUES
(1, 'rehana.rumi13@gmail.com', '123', 'administrator', 'Rehana', 'Rumi'),
(24, 'monirhossain.roverpolly@gmail.com', '123', 'teacher', 'MD MONIR', 'HOSSAIN'),
(43, '20180A0605@school.com', '123', 'student', 'Shakil', 'Ahmed'),
(25, 'mdsarwarhossain72@gmail.com', '123', 'teacher', 'MOHAMMAD SARWAR', 'HOSSAIN'),
(27, 'bikaschandrabarman16@gmail.com', '123', 'teacher', 'BIKAS CHANDRA', 'BARMAN'),
(42, '20180A0604@gmail.com', '123', 'student', 'Faruk', 'Hossain'),
(26, 'kanizfatemazuthi@gmail.com', '123', 'teacher', 'KANIZ', 'FATEMA'),
(41, '20180A0603@school.com', '123', 'student', 'Maksuda', 'Akter'),
(40, '20180A0602@school.com', '123', 'student', 'Nahida Akter', 'Jhuma'),
(39, '20180A0601@school.com', '123', 'student', 'Jahanara', 'Akter'),
(28, 'azimrps40@gmail.com', '123', 'teacher', 'MD. AZIM', 'UDDIN'),
(29, 'habiluddin819@gmail.com', '123', 'teacher', 'MD. HABIL', 'UDDIN'),
(30, 'anchalabormon2000@gmail.com', '123', 'teacher', 'ANCHALA', 'BORMON'),
(31, 'lichia044@gmail.com', '123', 'teacher', 'LICHIA', 'AKTER'),
(32, 'mdserajuddin1958@gmail.com', '123', 'teacher', 'MD. SIRAJ', 'UDDIN'),
(33, 'mdabdurrahman256@gmail.com', '123', 'teacher', 'MD.ABDUR', 'RAHMAN'),
(34, 'mdbillalhossain1964@gmail.com', '123', 'teacher', 'MD.BILLAL', 'HOSSAIN'),
(35, 'nazninsultana100176@gmail.com', '123', 'teacher', 'NAZNIN', 'SULTANA'),
(36, 'roksanarian@gmail.com', '123', 'teacher', 'ROKSANA', 'PARVIN'),
(37, 'momtazuddin1962@gmail.com', '123', 'teacher', 'MD MOMTAZ', 'UDDIN AHMED'),
(38, 'mdismailh807@gmail.com', '123', 'teacher', 'MD.ISMAIL', 'HOSSAIN'),
(44, '20180B0601@school.com', '123', 'student', 'Papia', 'Akter'),
(45, '20180B0602@school.com', '123', 'student', 'Nahid', 'Hasan'),
(46, '20180B0603@school.com', '123', 'student', 'Ibrahim', 'Hossain'),
(47, '20180A0701@school.com', '123', 'student', 'Labonno', 'Akter'),
(48, '20180A0702@school.com', '123', 'student', 'Shuma', 'Akter'),
(49, '20180A0703@school.com', '123', 'student', 'Saddam', 'Hossain'),
(50, '20180B0701@school.com', '123', 'student', 'Kobita', 'Bormon'),
(51, '20180B0702@school.com', '123', 'student', 'Mili', 'Akter'),
(52, '20180B0703@school.com', '123', 'student', 'Meheron', 'Akter'),
(53, '20180A0801@school.com', '123', 'student', 'Maliha', 'Hossain'),
(54, '20180A0802@school.com', '123', 'student', 'Jannatul', 'Ferdous'),
(55, '20180A08002@school.com', '123', 'student', 'Jannatul', 'Ferdous'),
(56, '20180A0803@school.com', '123', 'student', 'Monia', 'Akter'),
(57, '20180B0801@school.com', '123', 'student', 'Mehedi', 'Hasan'),
(58, '20180B0802@school.com', '123', 'student', 'Kanta', 'Rani'),
(59, '20180B0803@school.com', '123', 'student', 'Moni', 'Roy'),
(60, '20180A0901@school.com', '123', 'student', 'Israt', 'Jahan'),
(61, '20180A0902@school.com', '123', 'student', 'Laboni', 'Akter'),
(62, '20180A0903@school.com', '123', 'student', 'Maksuda', 'Akter'),
(63, '20180A0904@school.com', '123', 'student', 'Khairul', 'Islam'),
(64, '20180A0905@school.com', '123', 'student', 'Shamim', 'hossian'),
(65, '20180B0901@school.com', '123', 'student', 'Sangita', 'Akter'),
(66, '20180B0902@school.com', '123', 'student', 'Nasir', 'Hossain'),
(67, '20180B0903@school.com', '123', 'student', 'Muhammad', 'Asif'),
(68, '20180B0904@school.com', '123', 'student', 'Aklima', 'Akter'),
(69, '20180B0905@school.com', '123', 'student', 'Mahmuda', 'Akter'),
(70, '20180A1001@school.com', '123', 'student', 'Tarin', 'Islam'),
(71, '20180A1002@school.com', '123', 'student', 'Hillol', 'Rahman'),
(72, '20180A1003@school.com', '123', 'student', 'Mohsin', 'Hossain'),
(73, '20180A1004@school.com', '123', 'student', 'shanta', 'Islam'),
(74, '20180B1001@school.com', '123', 'student', 'Sajal', 'bormon'),
(75, '20180B1002@school.com', '123', 'student', 'Mithila', 'Mahrin'),
(76, '20180B1003@school.com', '123', 'student', 'Sabbir', 'Hossain'),
(77, '20180B1004@school.com', '123', 'student', 'Rubina', 'Akter'),
(78, '20180B1005@school.com', '123', 'student', 'Shilpi', 'Akter'),
(79, '20180A0606@school.com', '123', 'student', 'Abu', 'Raihan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classtime`
--
ALTER TABLE `classtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grading_result`
--
ALTER TABLE `grading_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_options`
--
ALTER TABLE `page_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `classtime`
--
ALTER TABLE `classtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grading_result`
--
ALTER TABLE `grading_result`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_options`
--
ALTER TABLE `page_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
