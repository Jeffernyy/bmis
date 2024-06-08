-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 08:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncement`
--

CREATE TABLE `tblannouncement` (
  `id` int(11) NOT NULL,
  `announcement` varchar(100) NOT NULL,
  `announcement_date` varchar(50) NOT NULL,
  `announcement_description` varchar(255) NOT NULL,
  `announcement_date_added` varchar(50) NOT NULL,
  `announcement_date_edited` varchar(50) NOT NULL,
  `announcement_added_by` varchar(100) NOT NULL,
  `announcement_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblannouncement`
--

INSERT INTO `tblannouncement` (`id`, `announcement`, `announcement_date`, `announcement_description`, `announcement_date_added`, `announcement_date_edited`, `announcement_added_by`, `announcement_edited_by`) VALUES
(1, 'official web developer at xo3d', '06/02/2024 05:25 PM', 'thank you sir lems', '06/02/2024 09:45 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncementphoto`
--

CREATE TABLE `tblannouncementphoto` (
  `id` int(11) NOT NULL,
  `announcement_id` varchar(10) NOT NULL,
  `announcement_filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblannouncementphoto`
--

INSERT INTO `tblannouncementphoto` (`id`, `announcement_id`, `announcement_filename`) VALUES
(1, '1', '1717292716046Planet9_Wallpaper_5000x2813.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblbldgpermit`
--

CREATE TABLE `tblbldgpermit` (
  `id` int(11) NOT NULL,
  `bldgpermit_num` varchar(50) NOT NULL,
  `bldgpermit_res_id` varchar(10) NOT NULL,
  `bldgpermit_purpose` varchar(100) NOT NULL,
  `bldgpermit_findings` varchar(100) NOT NULL,
  `bldgpermit_or_num` varchar(50) NOT NULL,
  `bldgpermit_amount` varchar(10) NOT NULL,
  `bldgpermit_status` varchar(50) NOT NULL,
  `bldgpermit_date_added` varchar(50) NOT NULL,
  `bldgpermit_date_edited` varchar(50) NOT NULL,
  `bldgpermit_date_requested` varchar(50) NOT NULL,
  `bldgpermit_date_approved` varchar(50) NOT NULL,
  `bldgpermit_date_disapproved` varchar(50) NOT NULL,
  `bldgpermit_added_by` varchar(100) NOT NULL,
  `bldgpermit_edited_by` varchar(100) NOT NULL,
  `bldgpermit_requested_by` varchar(100) NOT NULL,
  `bldgpermit_approved_by` varchar(100) NOT NULL,
  `bldgpermit_disapproved_by` varchar(100) NOT NULL,
  `bldgpermit_extra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter`
--

CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL,
  `blotter_complainant` varchar(100) NOT NULL,
  `blotter_complainant_age` varchar(5) NOT NULL,
  `blotter_complainant_contact_num` varchar(15) NOT NULL,
  `blotter_complainant_address` varchar(200) NOT NULL,
  `blotter_respondent` varchar(100) NOT NULL,
  `blotter_respondent_age` varchar(5) NOT NULL,
  `blotter_respondent_contact_num` varchar(15) NOT NULL,
  `blotter_respondent_address` varchar(255) NOT NULL,
  `blotter_first_complaint` varchar(255) NOT NULL,
  `blotter_second_complaint` varchar(255) NOT NULL,
  `blotter_action_taken` varchar(50) NOT NULL,
  `blotter_status` varchar(50) NOT NULL,
  `blotter_location_of_incident` varchar(100) NOT NULL,
  `blotter_case_num` varchar(25) NOT NULL,
  `blotter_for` varchar(100) NOT NULL,
  `blotter_date_added` varchar(50) NOT NULL,
  `blotter_date_edited` varchar(50) NOT NULL,
  `blotter_added_by` varchar(100) NOT NULL,
  `blotter_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcaptain`
--

CREATE TABLE `tblcaptain` (
  `id` int(11) NOT NULL,
  `captain_fname` varchar(50) NOT NULL,
  `captain_mname` varchar(50) NOT NULL,
  `captain_lname` varchar(50) NOT NULL,
  `captain_uname` varchar(50) NOT NULL,
  `captain_upass` varchar(100) NOT NULL,
  `captain_image` varchar(100) NOT NULL,
  `captain_date_added` varchar(50) NOT NULL,
  `captain_date_edited` varchar(50) NOT NULL,
  `captain_added_by` varchar(100) NOT NULL,
  `captain_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcaptain`
--

INSERT INTO `tblcaptain` (`id`, `captain_fname`, `captain_mname`, `captain_lname`, `captain_uname`, `captain_upass`, `captain_image`, `captain_date_added`, `captain_date_edited`, `captain_added_by`, `captain_edited_by`) VALUES
(1, 'jeffern', 'dulla', 'malinao', 'jeffernzxc', '$2y$10$mFacXPnHonb/52B6UIerte/uQ8Al.qf2uMm2PMxIRZ9vGIBaPWWhK', '1717265901948_320100311_1405815266617048_55131045237012181_n.jpg', '06/02/2024 02:18 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblclearance`
--

CREATE TABLE `tblclearance` (
  `id` int(11) NOT NULL,
  `clearance_num` varchar(50) NOT NULL,
  `clearance_res_id` varchar(10) NOT NULL,
  `clearance_purpose` varchar(100) NOT NULL,
  `clearance_findings` varchar(100) NOT NULL,
  `clearance_or_num` varchar(50) NOT NULL,
  `clearance_amount` varchar(10) NOT NULL,
  `clearance_status` varchar(50) NOT NULL,
  `clearance_date_added` varchar(50) NOT NULL,
  `clearance_date_edited` varchar(50) NOT NULL,
  `clearance_date_requested` varchar(50) NOT NULL,
  `clearance_date_approved` varchar(50) NOT NULL,
  `clearance_date_disapproved` varchar(50) NOT NULL,
  `clearance_added_by` varchar(100) NOT NULL,
  `clearance_edited_by` varchar(100) NOT NULL,
  `clearance_requested_by` varchar(100) NOT NULL,
  `clearance_approved_by` varchar(100) NOT NULL,
  `clearance_disapproved_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclearance`
--

INSERT INTO `tblclearance` (`id`, `clearance_num`, `clearance_res_id`, `clearance_purpose`, `clearance_findings`, `clearance_or_num`, `clearance_amount`, `clearance_status`, `clearance_date_added`, `clearance_date_edited`, `clearance_date_requested`, `clearance_date_approved`, `clearance_date_disapproved`, `clearance_added_by`, `clearance_edited_by`, `clearance_requested_by`, `clearance_approved_by`, `clearance_disapproved_by`) VALUES
(1, 'n/a', '4', 'employment', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:46 AM', 'n/a', '06/02/2024 11:22 PM', 'n/a', 'n/a', 'acmali ampuan as resident', 'n/a', 'system administrator as administrator'),
(2, 'n/a', '4', 'registry of deeds', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:46 AM', 'n/a', '06/02/2024 11:22 PM', 'n/a', 'n/a', 'acmali ampuan as resident', 'n/a', 'system administrator as administrator'),
(3, 'n/a', '4', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:46 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'acmali ampuan as resident', 'n/a', 'system administrator as administrator'),
(4, 'n/a', '6', 'registrar', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:46 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'jasper tesoro as resident', 'n/a', 'system administrator as administrator'),
(5, 'n/a', '6', 'scholarship', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:47 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'jasper tesoro as resident', 'n/a', 'system administrator as administrator'),
(6, 'n/a', '6', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:47 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'jasper tesoro as resident', 'n/a', 'system administrator as administrator'),
(7, 'n/a', '7', 'employment', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:47 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'christopher arieta estrera as resident', 'n/a', 'system administrator as administrator'),
(8, 'n/a', '7', 'registry of deeds', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:47 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'christopher arieta estrera as resident', 'n/a', 'system administrator as administrator'),
(9, 'n/a', '7', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:47 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'christopher arieta estrera as resident', 'n/a', 'system administrator as administrator'),
(10, 'n/a', '8', 'registrar', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:49 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(11, 'n/a', '8', 'scholarship', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:49 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(12, 'n/a', '8', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:49 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(13, 'n/a', '5', 'registrar', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:50 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'abdul mokit madid as resident', 'n/a', 'system administrator as administrator'),
(14, 'n/a', '5', 'scholarship', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:50 AM', 'n/a', '06/02/2024 11:21 PM', 'n/a', 'n/a', 'abdul mokit madid as resident', 'n/a', 'system administrator as administrator'),
(15, 'n/a', '5', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:50 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'abdul mokit madid as resident', 'n/a', 'system administrator as administrator'),
(16, 'n/a', '3', 'employment', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:50 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'clarish solania sargado as resident', 'n/a', 'system administrator as administrator'),
(17, 'n/a', '3', 'registry of deeds', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:50 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'clarish solania sargado as resident', 'n/a', 'system administrator as administrator'),
(18, 'n/a', '3', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:50 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'clarish solania sargado as resident', 'n/a', 'system administrator as administrator'),
(19, 'n/a', '1', 'registrar', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:51 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'system administrator as administrator'),
(20, 'n/a', '1', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:51 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'system administrator as administrator'),
(21, 'n/a', '1', 'employment', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 09:51 AM', 'n/a', '06/02/2024 11:20 PM', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'system administrator as administrator'),
(22, '123123', '1', 'employment', 'good', '123123', '₱25.00', 'approved', '06/02/2024 09:55 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(23, '321321', '1', 'registry of deeds', 'good', '321321', '₱25.00', 'approved', '06/02/2024 09:56 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(24, '456456', '1', 'financial assistance', 'good', '345345', '₱25.00', 'approved', '06/02/2024 09:56 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(25, '654654', '3', 'employment', 'good', '654654', '₱25.00', 'approved', '06/02/2024 09:56 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(26, '789789', '3', 'financial assistance', 'good', '789789', '₱25.00', 'approved', '06/02/2024 09:56 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(27, '987987', '3', 'registrar', 'good', '987987', '₱25.00', 'approved', '06/02/2024 09:58 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(28, '112233', '4', 'registrar', 'good', '112233', '₱25.00', 'approved', '06/02/2024 09:59 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(29, '223344', '4', 'scholarship', 'good', '223344', '₱25.00', 'approved', '06/02/2024 09:59 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(30, '334455', '4', 'financial assistance', 'good', '334455', '₱25.00', 'approved', '06/02/2024 09:59 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(31, '445566', '5', 'employment', 'good', '445566', '₱25.00', 'approved', '06/02/2024 10:03 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(32, '556677', '5', 'registry of deeds', 'good', '556677', '₱25.00', 'approved', '06/02/2024 10:12 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(33, '667788', '5', 'financial assistance', 'good', '667788', '₱25.00', 'approved', '06/02/2024 10:12 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(34, '778899', '6', 'registrar', 'good', '778899', '₱25.00', 'approved', '06/02/2024 10:13 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(35, '889900', '6', 'scholarship', 'good', '889900', '₱25.00', 'approved', '06/02/2024 10:18 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(36, '990011', '6', 'financial assistance', 'good', '990011', '₱25.00', 'approved', '06/02/2024 10:18 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(37, '123321', '7', 'employment', 'good', '123321', '₱25.00', 'approved', '06/02/2024 10:20 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(38, '234432', '7', 'registry of deeds', 'good', '234432', '₱25.00', 'approved', '06/02/2024 10:20 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(39, '345543', '7', 'financial assistance', 'good', '345543', '₱25.00', 'approved', '06/02/2024 10:20 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(40, '456654', '8', 'registrar', 'good', '456654', '₱25.00', 'approved', '06/02/2024 10:21 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(41, '567567', '8', 'financial assistance', 'good', '567567', '₱25.00', 'approved', '06/02/2024 10:21 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(42, '678876', '8', 'employment', 'good', '678876', '₱25.00', 'approved', '06/02/2024 10:21 AM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(43, 'n/a', '1', 'employment', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:29 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(44, 'n/a', '1', 'registry of deeds', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:29 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(45, 'n/a', '1', 'financial assistance', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:29 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(46, 'n/a', '1', 'scholarship', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:29 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(47, 'n/a', '1', 'registrar', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:29 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(48, 'n/a', '1', 'employment', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(49, 'n/a', '1', 'registry of deeds', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(50, 'n/a', '1', 'financial assistance', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(51, 'n/a', '1', 'scholarship', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(52, 'n/a', '1', 'registrar', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(53, 'n/a', '1', 'employment', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(54, 'n/a', '1', 'registry of deeds', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(55, 'n/a', '1', 'financial assistance', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(56, 'n/a', '1', 'scholarship', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(57, 'n/a', '1', 'registrar', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:31 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'jeffern dulla malinao as resident', 'n/a', 'n/a'),
(58, 'n/a', '8', 'employment', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:43 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'n/a'),
(59, 'n/a', '8', 'registry of deeds', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'n/a'),
(60, 'n/a', '8', 'financial assistance', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'n/a'),
(61, 'n/a', '8', 'scholarship', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'n/a'),
(62, 'n/a', '8', 'registrar', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'n/a'),
(63, 'n/a', '8', 'employment', 'n/a', 'n/a', 'n/a', 'new', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'n/a'),
(64, 'n/a', '8', 'registry of deeds', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:51 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(65, 'n/a', '8', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:51 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(66, 'n/a', '8', 'scholarship', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:51 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(67, 'n/a', '8', 'registrar', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:51 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(68, 'n/a', '8', 'employment', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:50 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(69, 'n/a', '8', 'registry of deeds', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:50 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(70, 'n/a', '8', 'financial assistance', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:50 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(71, 'n/a', '8', 'scholarship', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:50 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(72, 'n/a', '8', 'registrar', 'lack of credentials', 'n/a', 'n/a', 'disapproved', 'n/a', 'n/a', '06/02/2024 11:44 PM', 'n/a', '06/02/2024 11:50 PM', 'n/a', 'n/a', 'katrina de ramos as resident', 'n/a', 'system administrator as administrator'),
(73, '789987', '1', 'employment', 'good', '789987', '₱25.00', 'approved', '06/02/2024 11:53 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(74, '890098', '1', 'registry of deeds', 'good', '890098', '₱25.00', 'approved', '06/02/2024 11:54 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(75, '901109', '1', 'financial assistance', 'good', '901109', '₱25.00', 'approved', '06/02/2024 11:54 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(76, '321123', '3', 'registrar', 'good', '321123', '₱25.00', 'approved', '06/02/2024 11:56 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a'),
(77, '654456', '3', 'scholarship', 'good', '654456', '₱25.00', 'approved', '06/02/2024 11:57 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblgovoffice`
--

CREATE TABLE `tblgovoffice` (
  `id` int(11) NOT NULL,
  `gov_office` varchar(255) NOT NULL,
  `gov_office_date_added` varchar(50) NOT NULL,
  `gov_office_date_edited` varchar(50) NOT NULL,
  `gov_office_added_by` varchar(100) NOT NULL,
  `gov_office_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgovoffice`
--

INSERT INTO `tblgovoffice` (`id`, `gov_office`, `gov_office_date_added`, `gov_office_date_edited`, `gov_office_added_by`, `gov_office_edited_by`) VALUES
(1, 'City Government of Panabo - City Legal Office', '06/02/2024 02:21 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(2, 'General Services Office - City Government of Panabo', '06/02/2024 02:21 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(3, 'City Government of Panabo - City Human Resource Management Office', '06/02/2024 02:21 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(4, 'City Government of Panabo - City Planning and Development Office', '06/02/2024 02:21 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(5, 'City Administrator’s Office - City Government of Panabo', '06/02/2024 02:22 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(6, 'City Government of Panabo - City Accountant’s Office', '06/02/2024 02:22 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(7, 'City Government of Panabo - CMO - Community Affairs', '06/02/2024 02:22 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblhousehold`
--

CREATE TABLE `tblhousehold` (
  `id` int(11) NOT NULL,
  `household_num` varchar(25) NOT NULL,
  `household_purok` varchar(50) NOT NULL,
  `household_total_mem` varchar(10) NOT NULL,
  `household_head_of_family` varchar(100) NOT NULL,
  `household_date_added` varchar(50) NOT NULL,
  `household_date_edited` varchar(50) NOT NULL,
  `household_added_by` varchar(100) NOT NULL,
  `household_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblindigent`
--

CREATE TABLE `tblindigent` (
  `id` int(11) NOT NULL,
  `indigent_num` varchar(50) NOT NULL,
  `indigent_res_id` varchar(10) NOT NULL,
  `indigent_requester_res_id` varchar(100) NOT NULL,
  `indigent_purpose` varchar(100) NOT NULL,
  `indigent_gov_office` varchar(255) NOT NULL,
  `indigent_findings` varchar(100) NOT NULL,
  `indigent_or_num` varchar(50) NOT NULL,
  `indigent_payment` varchar(10) NOT NULL,
  `indigent_status` varchar(50) NOT NULL,
  `indigent_officer_res_id` varchar(5) NOT NULL,
  `indigent_officer_position_id` varchar(5) NOT NULL,
  `indigent_date_added` varchar(50) NOT NULL,
  `indigent_date_edited` varchar(50) NOT NULL,
  `indigent_date_requested` varchar(50) NOT NULL,
  `indigent_date_approved` varchar(50) NOT NULL,
  `indigent_date_disapproved` varchar(50) NOT NULL,
  `indigent_added_by` varchar(100) NOT NULL,
  `indigent_edited_by` varchar(100) NOT NULL,
  `indigent_requested_by` varchar(100) NOT NULL,
  `indigent_approved_by` varchar(100) NOT NULL,
  `indigent_disapproved_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblindigent`
--

INSERT INTO `tblindigent` (`id`, `indigent_num`, `indigent_res_id`, `indigent_requester_res_id`, `indigent_purpose`, `indigent_gov_office`, `indigent_findings`, `indigent_or_num`, `indigent_payment`, `indigent_status`, `indigent_officer_res_id`, `indigent_officer_position_id`, `indigent_date_added`, `indigent_date_edited`, `indigent_date_requested`, `indigent_date_approved`, `indigent_date_disapproved`, `indigent_added_by`, `indigent_edited_by`, `indigent_requested_by`, `indigent_approved_by`, `indigent_disapproved_by`) VALUES
(1, '123123', '1', '3', 'registry of deeds', 'City Government of Panabo - City Human Resource Management Office', 'n/a', '123123', '₱25.00', 'approved', '1', '1', '06/02/2024 11:11 PM', 'n/a', 'n/a', 'n/a', 'n/a', 'system administrator as administrator', 'n/a', 'n/a', 'n/a', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblloginattempts`
--

CREATE TABLE `tblloginattempts` (
  `id` int(11) NOT NULL,
  `login_attempts_ip_address` varchar(255) NOT NULL,
  `login_attempts_time_banned` varchar(100) DEFAULT NULL,
  `login_attempts_count` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblloginattempts`
--

INSERT INTO `tblloginattempts` (`id`, `login_attempts_ip_address`, `login_attempts_time_banned`, `login_attempts_count`) VALUES
(1, '::1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `id` int(11) NOT NULL,
  `logs_user_type` varchar(100) NOT NULL,
  `logs_fname` varchar(50) NOT NULL,
  `logs_lname` varchar(50) NOT NULL,
  `logs_logdate` varchar(50) NOT NULL,
  `logs_action` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`id`, `logs_user_type`, `logs_fname`, `logs_lname`, `logs_logdate`, `logs_action`) VALUES
(1, 'administrator', 'system', 'administrator', '06/02/2024 01:50 AM', 'added resident details...\n\nid: 1\nresident_fname: jeffern\nresident_mname: dulla\nresident_lname: malinao\nresident_birth_date: 04/02/1997\nresident_age: 27\nresident_gender: male\nresident_household_num: 1760\nresident_total_household_mem: 3\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: nido\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 53\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639317348750\nresident_email_add: jeffern@gmail.com\nresident_uname: jeffern\nresident_date_added: 06/02/2024 01:50 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 1 for resident jeffern dulla malinao\ndate and time added 06/02/2024 01:50 AM\n'),
(2, 'administrator', 'system', 'administrator', '06/02/2024 01:52 AM', 'added resident details...\n\nid: 2\nresident_fname: flor\nresident_mname: n/a\nresident_lname: cabillar\nresident_birth_date: 08/03/1999\nresident_age: 24\nresident_gender: female\nresident_household_num: 1631\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: carmen, panabo city, davao del norte\nresident_purok: liberty\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 3\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: flor@gmail.com\nresident_uname: flor\nresident_date_added: 06/02/2024 01:52 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 2 for resident flor cabillar\ndate and time added 06/02/2024 01:52 AM\n'),
(3, 'administrator', 'system', 'administrator', '06/02/2024 01:55 AM', 'added resident details...\n\nid: 3\nresident_fname: clarish\nresident_mname: solania\nresident_lname: sargado\nresident_birth_date: 09/15/1999\nresident_age: 24\nresident_gender: female\nresident_household_num: 1389\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: lasang, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 35\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: clarish@gmail.com\nresident_uname: clarish\nresident_date_added: 06/02/2024 01:55 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 3 for resident clarish solania sargado\ndate and time added 06/02/2024 01:55 AM\n'),
(4, 'administrator', 'system', 'administrator', '06/02/2024 01:58 AM', 'added resident details...\n\nid: 4\nresident_fname: acmali\nresident_mname: n/a\nresident_lname: ampuan\nresident_birth_date: 05/12/1999\nresident_age: 25\nresident_gender: male\nresident_household_num: 1835\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: muslim\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: cogon, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 51\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: acmali@gmail.com\nresident_uname: acmali\nresident_date_added: 06/02/2024 01:58 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 4 for resident acmali ampuan\ndate and time added 06/02/2024 01:58 AM\n'),
(5, 'administrator', 'system', 'administrator', '06/02/2024 02:09 AM', 'added resident details...\n\nid: 5\nresident_fname: abdul\nresident_mname: mokit\nresident_lname: madid\nresident_birth_date: 07/21/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1335\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: muslim\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: lasang, panabo city, davao del norte\nresident_purok: liberty\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 57\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: abdul@gmail.com\nresident_uname: abdul\nresident_date_added: 06/02/2024 02:09 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 5 for resident abdul mokit madid\ndate and time added 06/02/2024 02:09 AM\n'),
(6, 'administrator', 'system', 'administrator', '06/02/2024 02:13 AM', 'added resident details...\n\nid: 6\nresident_fname: jasper\nresident_mname: n/a\nresident_lname: tesoro\nresident_birth_date: 11/27/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1664\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: northern, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 73\nresident_relationship_to_head: child\nresident_occupation: private employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: jasper@gmail.com\nresident_uname: jasper\nresident_date_added: 06/02/2024 02:13 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 6 for resident jasper tesoro\ndate and time added 06/02/2024 02:13 AM\n'),
(7, 'administrator', 'system', 'administrator', '06/02/2024 02:15 AM', 'added resident details...\n\nid: 7\nresident_fname: christopher\nresident_mname: arieta\nresident_lname: estrera\nresident_birth_date: 09/22/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1228\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: alaska\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 103\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: tooper@gmail.com\nresident_uname: tooper\nresident_date_added: 06/02/2024 02:15 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 7 for resident christopher arieta estrera\ndate and time added 06/02/2024 02:15 AM\n'),
(8, 'administrator', 'system', 'administrator', '06/02/2024 02:17 AM', 'added resident details...\n\nid: 8\nresident_fname: katrina\nresident_mname: n/a\nresident_lname: de ramos\nresident_birth_date: 06/13/1999\nresident_age: 24\nresident_gender: female\nresident_household_num: 1173\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: carmen, panabo city, davao del norte\nresident_purok: bearbrand\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 93\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: katrina@gmail.com\nresident_uname: katrina\nresident_date_added: 06/02/2024 02:17 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 8 for resident katrina de ramos\ndate and time added 06/02/2024 02:17 AM\n'),
(9, 'administrator', 'system', 'administrator', '06/02/2024 02:18 AM', 'added barangay captain details...\n\nid: 1\ncaptain_fname: jeffern\ncaptain_mname: dulla\ncaptain_lname: malinao\ncaptain_uname: jeffernzxc\ncaptain_date_added: 06/02/2024 02:18 AM\ncaptain_date_edited: n/a\ncaptain_added_by: system administrator as administrator\ncaptain_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay captain id number 1 for barangay captain jeffern dulla malinao\ndate and time added 06/02/2024 02:18 AM\n'),
(10, 'administrator', 'system', 'administrator', '06/02/2024 02:18 AM', 'added barangay staff details...\n\nid: 1\nstaff_fname: flor\nstaff_mname: n/a\nstaff_lname: cabillar\nstaff_uname: florzxc\nstaff_date_added: 06/02/2024 02:18 AM\nstaff_date_edited: n/a\nstaff_added_by: system administrator as administrator\nstaff_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay staff id number 1 for barangay staff flor cabillar\ndate and time added 06/02/2024 02:18 AM\n'),
(11, 'administrator', 'system', 'administrator', '06/02/2024 02:19 AM', 'added barangay official details...\n\nid: 1\nofficial_position: punong barangay\nofficial_res_name: jeffern dulla malinao\nofficial_contact_num: 639317348750\nofficial_address: 1760 molave street, purok nido, new pandan, panabo city, davao del norte\nofficial_term_start: 03-19-2025\nofficial_term_end: 07-13-2025\nofficial_status: ongoing term\nofficial_date_added: 06/02/2024 02:19 AM\nofficial_date_edited: n/a\nofficial_added_by: system administrator as administrator\nofficial_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay official id number 1 for barangay official jeffern dulla malinao\ndate and time added 06/02/2024 02:19 AM\n'),
(12, 'administrator', 'system', 'administrator', '06/02/2024 02:20 AM', 'added barangay official details...\n\nid: 2\nofficial_position: barangay kagawad (ordinance)\nofficial_res_name: flor cabillar\nofficial_contact_num: 639518272634\nofficial_address: carmen, panabo city, davao del norte\nofficial_term_start: 09-17-2025\nofficial_term_end: 11-23-2025\nofficial_status: ongoing term\nofficial_date_added: 06/02/2024 02:20 AM\nofficial_date_edited: n/a\nofficial_added_by: system administrator as administrator\nofficial_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay official id number 2 for barangay official flor cabillar\ndate and time added 06/02/2024 02:20 AM\n'),
(13, 'administrator', 'system', 'administrator', '06/02/2024 02:20 AM', 'added officer of the day details...\n\nid: 1\nofficer_fname: joy\nofficer_mname: malinao\nofficer_lname: hallegado\nofficer_position: Barangay kagawad\nofficer_date_added: 06/02/2024 02:20 AM\nofficer_date_edited: n/a\nofficer_added_by: system administrator as administrator\nofficer_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd officer of the day id number 1 for officer of the day joy malinao hallegado\ndate and time added 06/02/2024 02:20 AM\n'),
(14, 'administrator', 'system', 'administrator', '06/02/2024 02:20 AM', 'added officer of the day details...\n\nid: 2\nofficer_fname: delfin\nofficer_mname: salvador\nofficer_lname: hallegado\nofficer_position: Barangay kagawad\nofficer_date_added: 06/02/2024 02:20 AM\nofficer_date_edited: n/a\nofficer_added_by: system administrator as administrator\nofficer_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd officer of the day id number 2 for officer of the day delfin salvador hallegado\ndate and time added 06/02/2024 02:20 AM\n'),
(15, 'administrator', 'system', 'administrator', '06/02/2024 02:21 AM', 'added government office details...\n\nid: 1\ngov_office: City Government of Panabo - City Legal Office\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 1 for government office City Government of Panabo - City Legal Office\ndate and time added 06/02/2024 02:21 AM\n'),
(16, 'administrator', 'system', 'administrator', '06/02/2024 02:21 AM', 'added government office details...\n\nid: 2\ngov_office: General Services Office - City Government of Panabo\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 2 for government office General Services Office - City Government of Panabo\ndate and time added 06/02/2024 02:21 AM\n'),
(17, 'administrator', 'system', 'administrator', '06/02/2024 02:21 AM', 'added government office details...\n\nid: 3\ngov_office: City Government of Panabo - City Human Resource Management Office\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 3 for government office City Government of Panabo - City Human Resource Management Office\ndate and time added 06/02/2024 02:21 AM\n'),
(18, 'administrator', 'system', 'administrator', '06/02/2024 02:21 AM', 'added government office details...\n\nid: 4\ngov_office: City Government of Panabo - City Planning and Development Office\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 4 for government office City Government of Panabo - City Planning and Development Office\ndate and time added 06/02/2024 02:21 AM\n'),
(19, 'administrator', 'system', 'administrator', '06/02/2024 02:22 AM', 'added government office details...\n\nid: 5\ngov_office: City Administrator’s Office - City Government of Panabo\ngov_office_date_added: 06/02/2024 02:22 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 5 for government office City Administrator’s Office - City Government of Panabo\ndate and time added 06/02/2024 02:22 AM\n'),
(20, 'administrator', 'system', 'administrator', '06/02/2024 02:22 AM', 'added government office details...\n\nid: 6\ngov_office: City Government of Panabo - City Accountant’s Office\ngov_office_date_added: 06/02/2024 02:22 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 6 for government office City Government of Panabo - City Accountant’s Office\ndate and time added 06/02/2024 02:22 AM\n'),
(21, 'administrator', 'system', 'administrator', '06/02/2024 02:22 AM', 'added government office details...\n\nid: 7\ngov_office: City Government of Panabo - CMO - Community Affairs\ngov_office_date_added: 06/02/2024 02:22 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 7 for government office City Government of Panabo - CMO - Community Affairs\ndate and time added 06/02/2024 02:22 AM\n'),
(22, 'administrator', 'system', 'administrator', '06/02/2024 02:22 AM', 'added purpose details...\n\nid: 1\npurpose: employment\npurpose_date_added: 06/02/2024 02:22 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 1 for purpose employment\ndate and time added 06/02/2024 02:22 AM\n'),
(23, 'administrator', 'system', 'administrator', '06/02/2024 02:22 AM', 'added purpose details...\n\nid: 2\npurpose: registry of deeds\npurpose_date_added: 06/02/2024 02:22 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 2 for purpose registry of deeds\ndate and time added 06/02/2024 02:22 AM\n'),
(24, 'administrator', 'system', 'administrator', '06/02/2024 02:22 AM', 'added purpose details...\n\nid: 3\npurpose: financial assistance\npurpose_date_added: 06/02/2024 02:22 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 3 for purpose financial assistance\ndate and time added 06/02/2024 02:22 AM\n'),
(25, 'administrator', 'system', 'administrator', '06/02/2024 02:23 AM', 'added purpose details...\n\nid: 4\npurpose: scholarship\npurpose_date_added: 06/02/2024 02:23 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 4 for purpose scholarship\ndate and time added 06/02/2024 02:23 AM\n'),
(26, 'administrator', 'system', 'administrator', '06/02/2024 02:23 AM', 'added purpose details...\n\nid: 5\npurpose: registrar\npurpose_date_added: 06/02/2024 02:23 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 5 for purpose registrar\ndate and time added 06/02/2024 02:23 AM\n'),
(27, 'administrator', 'system', 'administrator', '06/02/2024 09:45 AM', 'added announcement details...\n\nid: 1\nannouncement: official web developer at xo3d\nannouncement_date: 06/02/2024 05:25 PM\nannouncement_description: thank you sir lems\nannouncement_date_added: 06/02/2024 09:45 AM\nannouncement_date_edited: n/a\nannouncement_added_by: system administrator as administrator\nannouncement_edited_by: n/a\n\nthis added is done by system administrator as administrator\nadd announcement id number 1 for announcement official web developer at xo3d\ndate and time added 06/02/2024 09:45 AM\n'),
(28, 'resident', 'acmali', 'ampuan', '06/02/2024 09:46 AM', 'requested clearance details...\n\nid: 1\nclearance_num: n/a\nclearance_res_id: acmali ampuan\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: acmali ampuan as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by acmali ampuan as resident\nrequest clearance id number 1 for resident acmali ampuan\ndate and time requested 06/02/2024 09:46 AM\n'),
(29, 'resident', 'acmali', 'ampuan', '06/02/2024 09:46 AM', 'requested clearance details...\n\nid: 2\nclearance_num: n/a\nclearance_res_id: acmali ampuan\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: acmali ampuan as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by acmali ampuan as resident\nrequest clearance id number 2 for resident acmali ampuan\ndate and time requested 06/02/2024 09:46 AM\n'),
(30, 'resident', 'acmali', 'ampuan', '06/02/2024 09:46 AM', 'requested clearance details...\n\nid: 3\nclearance_num: n/a\nclearance_res_id: acmali ampuan\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: acmali ampuan as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by acmali ampuan as resident\nrequest clearance id number 3 for resident acmali ampuan\ndate and time requested 06/02/2024 09:46 AM\n'),
(31, 'resident', 'jasper', 'tesoro', '06/02/2024 09:46 AM', 'requested clearance details...\n\nid: 4\nclearance_num: n/a\nclearance_res_id: jasper tesoro\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jasper tesoro as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jasper tesoro as resident\nrequest clearance id number 4 for resident jasper tesoro\ndate and time requested 06/02/2024 09:46 AM\n'),
(32, 'resident', 'jasper', 'tesoro', '06/02/2024 09:47 AM', 'requested clearance details...\n\nid: 5\nclearance_num: n/a\nclearance_res_id: jasper tesoro\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jasper tesoro as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jasper tesoro as resident\nrequest clearance id number 5 for resident jasper tesoro\ndate and time requested 06/02/2024 09:47 AM\n'),
(33, 'resident', 'jasper', 'tesoro', '06/02/2024 09:47 AM', 'requested clearance details...\n\nid: 6\nclearance_num: n/a\nclearance_res_id: jasper tesoro\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jasper tesoro as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jasper tesoro as resident\nrequest clearance id number 6 for resident jasper tesoro\ndate and time requested 06/02/2024 09:47 AM\n'),
(34, 'resident', 'christopher', 'estrera', '06/02/2024 09:47 AM', 'requested clearance details...\n\nid: 7\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by christopher arieta estrera as resident\nrequest clearance id number 7 for resident christopher arieta estrera\ndate and time requested 06/02/2024 09:47 AM\n'),
(35, 'resident', 'christopher', 'estrera', '06/02/2024 09:47 AM', 'requested clearance details...\n\nid: 8\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by christopher arieta estrera as resident\nrequest clearance id number 8 for resident christopher arieta estrera\ndate and time requested 06/02/2024 09:47 AM\n'),
(36, 'resident', 'christopher', 'estrera', '06/02/2024 09:47 AM', 'requested clearance details...\n\nid: 9\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by christopher arieta estrera as resident\nrequest clearance id number 9 for resident christopher arieta estrera\ndate and time requested 06/02/2024 09:47 AM\n'),
(37, 'resident', 'katrina', 'de ramos', '06/02/2024 09:49 AM', 'requested clearance details...\n\nid: 10\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:49 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 10 for resident katrina de ramos\ndate and time requested 06/02/2024 09:49 AM\n'),
(38, 'resident', 'katrina', 'de ramos', '06/02/2024 09:49 AM', 'requested clearance details...\n\nid: 11\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:49 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 11 for resident katrina de ramos\ndate and time requested 06/02/2024 09:49 AM\n'),
(39, 'resident', 'katrina', 'de ramos', '06/02/2024 09:49 AM', 'requested clearance details...\n\nid: 12\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:49 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 12 for resident katrina de ramos\ndate and time requested 06/02/2024 09:49 AM\n'),
(40, 'resident', 'abdul', 'madid', '06/02/2024 09:50 AM', 'requested clearance details...\n\nid: 13\nclearance_num: n/a\nclearance_res_id: abdul mokit madid\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: abdul mokit madid as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by abdul mokit madid as resident\nrequest clearance id number 13 for resident abdul mokit madid\ndate and time requested 06/02/2024 09:50 AM\n'),
(41, 'resident', 'abdul', 'madid', '06/02/2024 09:50 AM', 'requested clearance details...\n\nid: 14\nclearance_num: n/a\nclearance_res_id: abdul mokit madid\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: abdul mokit madid as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by abdul mokit madid as resident\nrequest clearance id number 14 for resident abdul mokit madid\ndate and time requested 06/02/2024 09:50 AM\n'),
(42, 'resident', 'abdul', 'madid', '06/02/2024 09:50 AM', 'requested clearance details...\n\nid: 15\nclearance_num: n/a\nclearance_res_id: abdul mokit madid\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: abdul mokit madid as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by abdul mokit madid as resident\nrequest clearance id number 15 for resident abdul mokit madid\ndate and time requested 06/02/2024 09:50 AM\n'),
(43, 'resident', 'clarish', 'sargado', '06/02/2024 09:50 AM', 'requested clearance details...\n\nid: 16\nclearance_num: n/a\nclearance_res_id: clarish solania sargado\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: clarish solania sargado as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by clarish solania sargado as resident\nrequest clearance id number 16 for resident clarish solania sargado\ndate and time requested 06/02/2024 09:50 AM\n'),
(44, 'resident', 'clarish', 'sargado', '06/02/2024 09:50 AM', 'requested clearance details...\n\nid: 17\nclearance_num: n/a\nclearance_res_id: clarish solania sargado\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: clarish solania sargado as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by clarish solania sargado as resident\nrequest clearance id number 17 for resident clarish solania sargado\ndate and time requested 06/02/2024 09:50 AM\n'),
(45, 'resident', 'clarish', 'sargado', '06/02/2024 09:50 AM', 'requested clearance details...\n\nid: 18\nclearance_num: n/a\nclearance_res_id: clarish solania sargado\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: clarish solania sargado as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by clarish solania sargado as resident\nrequest clearance id number 18 for resident clarish solania sargado\ndate and time requested 06/02/2024 09:50 AM\n'),
(46, 'resident', 'jeffern', 'malinao', '06/02/2024 09:51 AM', 'requested clearance details...\n\nid: 19\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:51 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 19 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 09:51 AM\n'),
(47, 'resident', 'jeffern', 'malinao', '06/02/2024 09:51 AM', 'requested clearance details...\n\nid: 20\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:51 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 20 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 09:51 AM\n'),
(48, 'resident', 'jeffern', 'malinao', '06/02/2024 09:51 AM', 'requested clearance details...\n\nid: 21\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:51 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 21 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 09:51 AM\n'),
(49, 'administrator', 'system', 'administrator', '06/02/2024 09:53 AM', 'edited resident details...\n\nold data:\nid: 1\nresident_fname: jeffern\nresident_mname: dulla\nresident_lname: malinao\nresident_birth_date: 04/02/1997\nresident_age: 27\nresident_gender: male\nresident_household_num: 1760\nresident_total_household_mem: 3\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: nido\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 53\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639317348750\nresident_email_add: jeffern@gmail.com\nresident_uname: jeffern\nresident_date_added: 06/02/2024 01:50 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nnew data:\nid: 1\nresident_fname: jeffern\nresident_mname: dulla\nresident_lname: malinao\nresident_birth_date: 04/02/1997\nresident_age: 27\nresident_gender: male\nresident_household_num: 1760\nresident_total_household_mem: 3\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: nido\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 53\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: jeffern@gmail.com\nresident_uname: jeffern\nresident_date_added: 06/02/2024 01:50 AM\nresident_date_edited: 06/02/2024 09:53 AM\nresident_added_by: system administrator as administrator\nresident_edited_by: system administrator as administrator\n\nthis edit is done by system administrator as administrator\nedit resident id number 1 for resident jeffern dulla malinao\ndate and time edited 06/02/2024 09:53 AM\n'),
(50, 'administrator', 'system', 'administrator', '06/02/2024 09:55 AM', 'added clearance details...\n\nid: 22\nclearance_num: 123123\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: good\nclearance_or_num: 123123\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:55 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 22 for resident jeffern dulla malinao\ndate and time added 06/02/2024 09:55 AM\n'),
(51, 'administrator', 'system', 'administrator', '06/02/2024 09:56 AM', 'added clearance details...\n\nid: 23\nclearance_num: 321321\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registry of deeds\nclearance_findings: good\nclearance_or_num: 321321\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:56 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 23 for resident jeffern dulla malinao\ndate and time added 06/02/2024 09:56 AM\n'),
(52, 'administrator', 'system', 'administrator', '06/02/2024 09:56 AM', 'added clearance details...\n\nid: 24\nclearance_num: 345345\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 345345\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:56 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 24 for resident jeffern dulla malinao\ndate and time added 06/02/2024 09:56 AM\n'),
(53, 'administrator', 'system', 'administrator', '06/02/2024 09:56 AM', 'added clearance details...\n\nid: 25\nclearance_num: 654654\nclearance_res_id: clarish solania sargado\nclearance_purpose: employment\nclearance_findings: good\nclearance_or_num: 654654\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:56 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 25 for resident clarish solania sargado\ndate and time added 06/02/2024 09:56 AM\n'),
(54, 'administrator', 'system', 'administrator', '06/02/2024 09:56 AM', 'added clearance details...\n\nid: 26\nclearance_num: 789789\nclearance_res_id: clarish solania sargado\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 789789\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:56 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 26 for resident clarish solania sargado\ndate and time added 06/02/2024 09:56 AM\n'),
(55, 'administrator', 'system', 'administrator', '06/02/2024 09:58 AM', 'added clearance details...\n\nid: 27\nclearance_num: 987987\nclearance_res_id: clarish solania sargado\nclearance_purpose: registrar\nclearance_findings: good\nclearance_or_num: 987987\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:58 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 27 for resident clarish solania sargado\ndate and time added 06/02/2024 09:58 AM\n'),
(56, 'administrator', 'system', 'administrator', '06/02/2024 09:59 AM', 'added clearance details...\n\nid: 28\nclearance_num: 112233\nclearance_res_id: acmali ampuan\nclearance_purpose: registrar\nclearance_findings: good\nclearance_or_num: 112233\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:59 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 28 for resident acmali ampuan\ndate and time added 06/02/2024 09:59 AM\n'),
(57, 'administrator', 'system', 'administrator', '06/02/2024 09:59 AM', 'added clearance details...\n\nid: 29\nclearance_num: 223344\nclearance_res_id: acmali ampuan\nclearance_purpose: scholarship\nclearance_findings: good\nclearance_or_num: 223344\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:59 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 29 for resident acmali ampuan\ndate and time added 06/02/2024 09:59 AM\n'),
(58, 'administrator', 'system', 'administrator', '06/02/2024 09:59 AM', 'added clearance details...\n\nid: 30\nclearance_num: 334455\nclearance_res_id: acmali ampuan\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 334455\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 09:59 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 30 for resident acmali ampuan\ndate and time added 06/02/2024 09:59 AM\n'),
(59, 'administrator', 'system', 'administrator', '06/02/2024 10:03 AM', 'added clearance details...\n\nid: 31\nclearance_num: 445566\nclearance_res_id: abdul mokit madid\nclearance_purpose: employment\nclearance_findings: good\nclearance_or_num: 445566\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:03 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 31 for resident abdul mokit madid\ndate and time added 06/02/2024 10:03 AM\n');
INSERT INTO `tbllogs` (`id`, `logs_user_type`, `logs_fname`, `logs_lname`, `logs_logdate`, `logs_action`) VALUES
(60, 'administrator', 'system', 'administrator', '06/02/2024 10:12 AM', 'added clearance details...\n\nid: 32\nclearance_num: 556677\nclearance_res_id: abdul mokit madid\nclearance_purpose: registry of deeds\nclearance_findings: good\nclearance_or_num: 556677\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:12 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 32 for resident abdul mokit madid\ndate and time added 06/02/2024 10:12 AM\n'),
(61, 'administrator', 'system', 'administrator', '06/02/2024 10:12 AM', 'added clearance details...\n\nid: 33\nclearance_num: 667788\nclearance_res_id: abdul mokit madid\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 667788\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:12 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 33 for resident abdul mokit madid\ndate and time added 06/02/2024 10:12 AM\n'),
(62, 'administrator', 'system', 'administrator', '06/02/2024 10:13 AM', 'added clearance details...\n\nid: 34\nclearance_num: 778899\nclearance_res_id: jasper tesoro\nclearance_purpose: registrar\nclearance_findings: good\nclearance_or_num: 778899\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:13 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 34 for resident jasper tesoro\ndate and time added 06/02/2024 10:13 AM\n'),
(63, 'administrator', 'system', 'administrator', '06/02/2024 10:18 AM', 'added clearance details...\n\nid: 35\nclearance_num: 889900\nclearance_res_id: jasper tesoro\nclearance_purpose: scholarship\nclearance_findings: good\nclearance_or_num: 889900\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:18 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 35 for resident jasper tesoro\ndate and time added 06/02/2024 10:18 AM\n'),
(64, 'administrator', 'system', 'administrator', '06/02/2024 10:18 AM', 'added clearance details...\n\nid: 36\nclearance_num: 990011\nclearance_res_id: jasper tesoro\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 990011\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:18 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 36 for resident jasper tesoro\ndate and time added 06/02/2024 10:18 AM\n'),
(65, 'administrator', 'system', 'administrator', '06/02/2024 10:20 AM', 'added clearance details...\n\nid: 37\nclearance_num: 123321\nclearance_res_id: christopher arieta estrera\nclearance_purpose: employment\nclearance_findings: good\nclearance_or_num: 123321\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:20 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 37 for resident christopher arieta estrera\ndate and time added 06/02/2024 10:20 AM\n'),
(66, 'administrator', 'system', 'administrator', '06/02/2024 10:20 AM', 'added clearance details...\n\nid: 38\nclearance_num: 234432\nclearance_res_id: christopher arieta estrera\nclearance_purpose: registry of deeds\nclearance_findings: good\nclearance_or_num: 234432\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:20 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 38 for resident christopher arieta estrera\ndate and time added 06/02/2024 10:20 AM\n'),
(67, 'administrator', 'system', 'administrator', '06/02/2024 10:20 AM', 'added clearance details...\n\nid: 39\nclearance_num: 345543\nclearance_res_id: christopher arieta estrera\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 345543\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:20 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 39 for resident christopher arieta estrera\ndate and time added 06/02/2024 10:20 AM\n'),
(68, 'administrator', 'system', 'administrator', '06/02/2024 10:21 AM', 'added clearance details...\n\nid: 40\nclearance_num: 456654\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: good\nclearance_or_num: 456654\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:21 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 40 for resident katrina de ramos\ndate and time added 06/02/2024 10:21 AM\n'),
(69, 'administrator', 'system', 'administrator', '06/02/2024 10:21 AM', 'added clearance details...\n\nid: 41\nclearance_num: 567567\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 567567\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:21 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 41 for resident katrina de ramos\ndate and time added 06/02/2024 10:21 AM\n'),
(70, 'administrator', 'system', 'administrator', '06/02/2024 10:21 AM', 'added clearance details...\n\nid: 42\nclearance_num: 678876\nclearance_res_id: katrina de ramos\nclearance_purpose: employment\nclearance_findings: good\nclearance_or_num: 678876\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 10:21 AM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 42 for resident katrina de ramos\ndate and time added 06/02/2024 10:21 AM\n'),
(71, 'administrator', 'system', 'administrator', '06/02/2024 11:11 PM', 'added certificate of low income details...\n\nid: 1\nindigent_num: 123123\nindigent_res_name: jeffern d. malinao\nindigent_requester_res_name: clarish s. sargado\nindigent_purpose: registry of deeds\nindigent_gov_office: City Government of Panabo - City Human Resource Management Office\nindigent_findings: n/a\nindigent_or_num: 123123\nindigent_payment: ₱25.00\nindigent_status: approved\nindigent_officer_name: joy m. hallegado\nindigent_officer_position_id: 1\nindigent_date_added: 06/02/2024 11:11 PM\nindigent_date_edited: n/a\nindigent_date_requested: n/a\nindigent_date_approved: n/a\nindigent_date_disapproved: n/a\nindigent_added_by: system administrator as administrator\nindigent_edited_by: n/a\nindigent_requested_by: n/a\nindigent_approved_by: n/a\nindigent_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd certificate of low income id number 1 for resident jeffern d. malinao\ndate and time added 06/02/2024 11:11 PM\n'),
(72, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 21\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:51 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 21 requested by jeffern dulla malinao\ndate and time added 06/02/2024 11:20 PM\n'),
(73, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 20\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:51 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 20 requested by jeffern dulla malinao\ndate and time added 06/02/2024 11:20 PM\n'),
(74, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 19\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registrar\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:51 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 19 requested by jeffern dulla malinao\ndate and time added 06/02/2024 11:20 PM\n'),
(75, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 18\nclearance_num: n/a\nclearance_res_id: clarish solania sargado\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: clarish solania sargado as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 18 requested by clarish solania sargado\ndate and time added 06/02/2024 11:20 PM\n'),
(76, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 17\nclearance_num: n/a\nclearance_res_id: clarish solania sargado\nclearance_purpose: registry of deeds\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: clarish solania sargado as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 17 requested by clarish solania sargado\ndate and time added 06/02/2024 11:20 PM\n'),
(77, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 16\nclearance_num: n/a\nclearance_res_id: clarish solania sargado\nclearance_purpose: employment\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: clarish solania sargado as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 16 requested by clarish solania sargado\ndate and time added 06/02/2024 11:20 PM\n'),
(78, 'administrator', 'system', 'administrator', '06/02/2024 11:20 PM', 'disapproved clearance details...\n\nid: 15\nclearance_num: n/a\nclearance_res_id: abdul mokit madid\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:20 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: abdul mokit madid as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 15 requested by abdul mokit madid\ndate and time added 06/02/2024 11:20 PM\n'),
(79, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 14\nclearance_num: n/a\nclearance_res_id: abdul mokit madid\nclearance_purpose: scholarship\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: abdul mokit madid as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 14 requested by abdul mokit madid\ndate and time added 06/02/2024 11:21 PM\n'),
(80, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 13\nclearance_num: n/a\nclearance_res_id: abdul mokit madid\nclearance_purpose: registrar\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:50 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: abdul mokit madid as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 13 requested by abdul mokit madid\ndate and time added 06/02/2024 11:21 PM\n'),
(81, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 12\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:49 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 12 requested by katrina de ramos\ndate and time added 06/02/2024 11:21 PM\n'),
(82, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 11\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:49 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 11 requested by katrina de ramos\ndate and time added 06/02/2024 11:21 PM\n'),
(83, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 10\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:49 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 10 requested by katrina de ramos\ndate and time added 06/02/2024 11:21 PM\n'),
(84, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 9\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 9 requested by christopher arieta estrera\ndate and time added 06/02/2024 11:21 PM\n'),
(85, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 9\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 9 requested by christopher arieta estrera\ndate and time added 06/02/2024 11:21 PM\n'),
(86, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 8\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: registry of deeds\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 8 requested by christopher arieta estrera\ndate and time added 06/02/2024 11:21 PM\n'),
(87, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 7\nclearance_num: n/a\nclearance_res_id: christopher arieta estrera\nclearance_purpose: employment\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: christopher arieta estrera as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 7 requested by christopher arieta estrera\ndate and time added 06/02/2024 11:21 PM\n'),
(88, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 6\nclearance_num: n/a\nclearance_res_id: jasper tesoro\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jasper tesoro as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 6 requested by jasper tesoro\ndate and time added 06/02/2024 11:21 PM\n'),
(89, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 5\nclearance_num: n/a\nclearance_res_id: jasper tesoro\nclearance_purpose: scholarship\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:47 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jasper tesoro as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 5 requested by jasper tesoro\ndate and time added 06/02/2024 11:21 PM\n'),
(90, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 4\nclearance_num: n/a\nclearance_res_id: jasper tesoro\nclearance_purpose: registrar\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jasper tesoro as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 4 requested by jasper tesoro\ndate and time added 06/02/2024 11:21 PM\n'),
(91, 'administrator', 'system', 'administrator', '06/02/2024 11:21 PM', 'disapproved clearance details...\n\nid: 3\nclearance_num: n/a\nclearance_res_id: acmali ampuan\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:21 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: acmali ampuan as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 3 requested by acmali ampuan\ndate and time added 06/02/2024 11:21 PM\n'),
(92, 'administrator', 'system', 'administrator', '06/02/2024 11:22 PM', 'disapproved clearance details...\n\nid: 2\nclearance_num: n/a\nclearance_res_id: acmali ampuan\nclearance_purpose: registry of deeds\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:22 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: acmali ampuan as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 2 requested by acmali ampuan\ndate and time added 06/02/2024 11:22 PM\n'),
(93, 'administrator', 'system', 'administrator', '06/02/2024 11:22 PM', 'disapproved clearance details...\n\nid: 1\nclearance_num: n/a\nclearance_res_id: acmali ampuan\nclearance_purpose: employment\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 09:46 AM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:22 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: acmali ampuan as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 1 requested by acmali ampuan\ndate and time added 06/02/2024 11:22 PM\n'),
(94, 'resident', 'jeffern', 'malinao', '06/02/2024 11:29 PM', 'requested clearance details...\n\nid: 43\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:29 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 43 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:29 PM\n'),
(95, 'resident', 'jeffern', 'malinao', '06/02/2024 11:29 PM', 'requested clearance details...\n\nid: 44\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:29 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 44 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:29 PM\n'),
(96, 'resident', 'jeffern', 'malinao', '06/02/2024 11:29 PM', 'requested clearance details...\n\nid: 45\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:29 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 45 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:29 PM\n'),
(97, 'resident', 'jeffern', 'malinao', '06/02/2024 11:29 PM', 'requested clearance details...\n\nid: 46\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:29 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 46 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:29 PM\n'),
(98, 'resident', 'jeffern', 'malinao', '06/02/2024 11:29 PM', 'requested clearance details...\n\nid: 47\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:29 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 47 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:29 PM\n'),
(99, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 48\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 48 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(100, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 49\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 49 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(101, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 50\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 50 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(102, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 51\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 51 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(103, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 52\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 52 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(104, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 53\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 53 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(105, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 54\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 54 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(106, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 55\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 55 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(107, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 56\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 56 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(108, 'resident', 'jeffern', 'malinao', '06/02/2024 11:31 PM', 'requested clearance details...\n\nid: 57\nclearance_num: n/a\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:31 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: jeffern dulla malinao as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by jeffern dulla malinao as resident\nrequest clearance id number 57 for resident jeffern dulla malinao\ndate and time requested 06/02/2024 11:31 PM\n'),
(109, 'resident', 'katrina', 'de ramos', '06/02/2024 11:43 PM', 'requested clearance details...\n\nid: 58\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:43 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 58 for resident katrina de ramos\ndate and time requested 06/02/2024 11:43 PM\n'),
(110, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 59\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 59 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(111, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 60\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 60 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(112, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 61\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 61 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(113, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 62\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 62 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(114, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 63\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 63 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(115, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 64\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 64 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(116, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 65\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 65 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(117, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 66\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 66 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(118, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 67\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 67 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n');
INSERT INTO `tbllogs` (`id`, `logs_user_type`, `logs_fname`, `logs_lname`, `logs_logdate`, `logs_action`) VALUES
(119, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 68\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: employment\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 68 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(120, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 69\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registry of deeds\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 69 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(121, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 70\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 70 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(122, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 71\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 71 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(123, 'resident', 'katrina', 'de ramos', '06/02/2024 11:44 PM', 'requested clearance details...\n\nid: 72\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: n/a\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: new\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis request is done by katrina de ramos as resident\nrequest clearance id number 72 for resident katrina de ramos\ndate and time requested 06/02/2024 11:44 PM\n'),
(124, 'administrator', 'system', 'administrator', '06/02/2024 11:50 PM', 'disapproved clearance details...\n\nid: 72\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:50 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 72 requested by katrina de ramos\ndate and time added 06/02/2024 11:50 PM\n'),
(125, 'administrator', 'system', 'administrator', '06/02/2024 11:50 PM', 'disapproved clearance details...\n\nid: 71\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:50 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 71 requested by katrina de ramos\ndate and time added 06/02/2024 11:50 PM\n'),
(126, 'administrator', 'system', 'administrator', '06/02/2024 11:50 PM', 'disapproved clearance details...\n\nid: 70\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:50 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 70 requested by katrina de ramos\ndate and time added 06/02/2024 11:50 PM\n'),
(127, 'administrator', 'system', 'administrator', '06/02/2024 11:50 PM', 'disapproved clearance details...\n\nid: 69\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registry of deeds\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:50 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 69 requested by katrina de ramos\ndate and time added 06/02/2024 11:50 PM\n'),
(128, 'administrator', 'system', 'administrator', '06/02/2024 11:50 PM', 'disapproved clearance details...\n\nid: 68\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: employment\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:50 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 68 requested by katrina de ramos\ndate and time added 06/02/2024 11:50 PM\n'),
(129, 'administrator', 'system', 'administrator', '06/02/2024 11:51 PM', 'disapproved clearance details...\n\nid: 67\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registrar\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:51 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 67 requested by katrina de ramos\ndate and time added 06/02/2024 11:51 PM\n'),
(130, 'administrator', 'system', 'administrator', '06/02/2024 11:51 PM', 'disapproved clearance details...\n\nid: 66\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: scholarship\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:51 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 66 requested by katrina de ramos\ndate and time added 06/02/2024 11:51 PM\n'),
(131, 'administrator', 'system', 'administrator', '06/02/2024 11:51 PM', 'disapproved clearance details...\n\nid: 65\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: financial assistance\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:51 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 65 requested by katrina de ramos\ndate and time added 06/02/2024 11:51 PM\n'),
(132, 'administrator', 'system', 'administrator', '06/02/2024 11:51 PM', 'disapproved clearance details...\n\nid: 64\nclearance_num: n/a\nclearance_res_id: katrina de ramos\nclearance_purpose: registry of deeds\nclearance_findings: lack of credentials\nclearance_or_num: n/a\nclearance_amount: n/a\nclearance_status: disapproved\nclearance_date_added: n/a\nclearance_date_edited: n/a\nclearance_date_requested: 06/02/2024 11:44 PM\nclearance_date_approved: n/a\nclearance_date_disapproved: 06/02/2024 11:51 PM\nclearance_added_by: n/a\nclearance_edited_by: n/a\nclearance_requested_by: katrina de ramos as resident\nclearance_approved_by: n/a\nclearance_disapproved_by: system administrator as administrator\n\nthis disapprove is done by system administrator as administrator\ndisapprove clearance id number 64 requested by katrina de ramos\ndate and time added 06/02/2024 11:51 PM\n'),
(133, 'administrator', 'system', 'administrator', '06/02/2024 11:53 PM', 'added clearance details...\n\nid: 73\nclearance_num: 789987\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: employment\nclearance_findings: good\nclearance_or_num: 789987\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 11:53 PM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 73 for resident jeffern dulla malinao\ndate and time added 06/02/2024 11:53 PM\n'),
(134, 'administrator', 'system', 'administrator', '06/02/2024 11:54 PM', 'added clearance details...\n\nid: 74\nclearance_num: 890098\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: registry of deeds\nclearance_findings: good\nclearance_or_num: 890098\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 11:54 PM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 74 for resident jeffern dulla malinao\ndate and time added 06/02/2024 11:54 PM\n'),
(135, 'administrator', 'system', 'administrator', '06/02/2024 11:54 PM', 'added clearance details...\n\nid: 75\nclearance_num: 901109\nclearance_res_id: jeffern dulla malinao\nclearance_purpose: financial assistance\nclearance_findings: good\nclearance_or_num: 901109\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 11:54 PM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 75 for resident jeffern dulla malinao\ndate and time added 06/02/2024 11:54 PM\n'),
(136, 'administrator', 'system', 'administrator', '06/02/2024 11:56 PM', 'added clearance details...\n\nid: 76\nclearance_num: 321123\nclearance_res_id: clarish solania sargado\nclearance_purpose: registrar\nclearance_findings: good\nclearance_or_num: 321123\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 11:56 PM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 76 for resident clarish solania sargado\ndate and time added 06/02/2024 11:56 PM\n'),
(137, 'administrator', 'system', 'administrator', '06/02/2024 11:57 PM', 'added clearance details...\n\nid: 77\nclearance_num: 654456\nclearance_res_id: clarish solania sargado\nclearance_purpose: scholarship\nclearance_findings: good\nclearance_or_num: 654456\nclearance_amount: ₱25.00\nclearance_status: approved\nclearance_date_added: 06/02/2024 11:57 PM\nclearance_date_edited: n/a\nclearance_date_requested: n/a\nclearance_date_approved: n/a\nclearance_date_disapproved: n/a\nclearance_added_by: system administrator as administrator\nclearance_edited_by: n/a\nclearance_requested_by: n/a\nclearance_approved_by: n/a\nclearance_disapproved_by: n/a\n\nthis add is done by system administrator as administrator\nadd clearance id number 77 for resident clarish solania sargado\ndate and time added 06/02/2024 11:57 PM\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbllowincome`
--

CREATE TABLE `tbllowincome` (
  `id` int(11) NOT NULL,
  `lowincome_num` varchar(50) NOT NULL,
  `lowincome_res_id` varchar(10) NOT NULL,
  `lowincome_requester_res_id` varchar(100) NOT NULL,
  `lowincome_children_res_id` varchar(100) NOT NULL,
  `lowincome_children_age` varchar(5) NOT NULL,
  `lowincome_num_of_children` varchar(20) NOT NULL,
  `lowincome_annual_income` varchar(20) NOT NULL,
  `lowincome_gov_office` varchar(255) NOT NULL,
  `lowincome_findings` varchar(100) NOT NULL,
  `lowincome_or_num` varchar(50) NOT NULL,
  `lowincome_payment` varchar(10) NOT NULL,
  `lowincome_status` varchar(50) NOT NULL,
  `lowincome_officer_res_id` varchar(5) NOT NULL,
  `lowincome_officer_position_id` varchar(5) NOT NULL,
  `lowincome_date_added` varchar(50) NOT NULL,
  `lowincome_date_edited` varchar(50) NOT NULL,
  `lowincome_date_requested` varchar(50) NOT NULL,
  `lowincome_date_approved` varchar(50) NOT NULL,
  `lowincome_date_disapproved` varchar(50) NOT NULL,
  `lowincome_added_by` varchar(100) NOT NULL,
  `lowincome_edited_by` varchar(100) NOT NULL,
  `lowincome_requested_by` varchar(100) NOT NULL,
  `lowincome_approved_by` varchar(100) NOT NULL,
  `lowincome_disapproved_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblofficer`
--

CREATE TABLE `tblofficer` (
  `id` int(11) NOT NULL,
  `officer_fname` varchar(50) NOT NULL,
  `officer_mname` varchar(50) NOT NULL,
  `officer_lname` varchar(50) NOT NULL,
  `officer_position` varchar(50) NOT NULL,
  `officer_date_added` varchar(50) NOT NULL,
  `officer_date_edited` varchar(50) NOT NULL,
  `officer_added_by` varchar(100) NOT NULL,
  `officer_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficer`
--

INSERT INTO `tblofficer` (`id`, `officer_fname`, `officer_mname`, `officer_lname`, `officer_position`, `officer_date_added`, `officer_date_edited`, `officer_added_by`, `officer_edited_by`) VALUES
(1, 'joy', 'malinao', 'hallegado', 'Barangay kagawad', '06/02/2024 02:20 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(2, 'delfin', 'salvador', 'hallegado', 'Barangay kagawad', '06/02/2024 02:20 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficial`
--

CREATE TABLE `tblofficial` (
  `id` int(11) NOT NULL,
  `official_position` varchar(50) NOT NULL,
  `official_res_id` varchar(100) NOT NULL,
  `official_contact_num` varchar(20) NOT NULL,
  `official_address` varchar(255) NOT NULL,
  `official_term_start` varchar(25) NOT NULL,
  `official_term_end` varchar(25) NOT NULL,
  `official_status` varchar(25) NOT NULL,
  `official_date_added` varchar(50) NOT NULL,
  `official_date_edited` varchar(50) NOT NULL,
  `official_added_by` varchar(100) NOT NULL,
  `official_edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficial`
--

INSERT INTO `tblofficial` (`id`, `official_position`, `official_res_id`, `official_contact_num`, `official_address`, `official_term_start`, `official_term_end`, `official_status`, `official_date_added`, `official_date_edited`, `official_added_by`, `official_edited_by`) VALUES
(1, 'punong barangay', '1', '639317348750', '1760 molave street, purok nido, new pandan, panabo city, davao del norte', '03-19-2025', '07-13-2025', 'ongoing term', '06/02/2024 02:19 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(2, 'barangay kagawad (ordinance)', '2', '639518272634', 'carmen, panabo city, davao del norte', '09-17-2025', '11-23-2025', 'ongoing term', '06/02/2024 02:20 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblpurpose`
--

CREATE TABLE `tblpurpose` (
  `id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `purpose_date_added` varchar(50) NOT NULL,
  `purpose_date_edited` varchar(50) NOT NULL,
  `purpose_added_by` varchar(100) NOT NULL,
  `purpose_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpurpose`
--

INSERT INTO `tblpurpose` (`id`, `purpose`, `purpose_date_added`, `purpose_date_edited`, `purpose_added_by`, `purpose_edited_by`) VALUES
(1, 'employment', '06/02/2024 02:22 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(2, 'registry of deeds', '06/02/2024 02:22 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(3, 'financial assistance', '06/02/2024 02:22 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(4, 'scholarship', '06/02/2024 02:23 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(5, 'registrar', '06/02/2024 02:23 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblresident`
--

CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL,
  `resident_fname` varchar(50) NOT NULL,
  `resident_mname` varchar(50) NOT NULL,
  `resident_lname` varchar(50) NOT NULL,
  `resident_birth_date` varchar(10) NOT NULL,
  `resident_age` varchar(5) NOT NULL,
  `resident_gender` varchar(25) NOT NULL,
  `resident_household_num` varchar(25) NOT NULL,
  `resident_total_household_mem` varchar(5) NOT NULL,
  `resident_civil_status` varchar(25) NOT NULL,
  `resident_blood_type` varchar(25) NOT NULL,
  `resident_renter` varchar(5) NOT NULL,
  `resident_religion` varchar(25) NOT NULL,
  `resident_nationality` varchar(50) NOT NULL,
  `resident_wra` varchar(50) NOT NULL,
  `resident_educational_attainment` varchar(50) NOT NULL,
  `resident_type_of_garbage_disposal` varchar(50) NOT NULL,
  `resident_interview_by` varchar(100) NOT NULL,
  `resident_birth_place` varchar(255) NOT NULL,
  `resident_purok` varchar(50) NOT NULL,
  `resident_tribe` varchar(50) NOT NULL,
  `resident_ips` varchar(5) NOT NULL,
  `resident_health_status` varchar(50) NOT NULL,
  `resident_length_of_stay` varchar(10) NOT NULL,
  `resident_relationship_to_head` varchar(50) NOT NULL,
  `resident_occupation` varchar(50) NOT NULL,
  `resident_types_of_toilet` varchar(50) NOT NULL,
  `resident_sources_of_water_supply` varchar(255) NOT NULL,
  `resident_blind_drainage` varchar(5) NOT NULL,
  `resident_email_add` varchar(100) NOT NULL,
  `resident_uname` varchar(100) NOT NULL,
  `resident_mobile_num` varchar(13) NOT NULL,
  `resident_upass` varchar(100) NOT NULL,
  `resident_secret_key` varchar(100) NOT NULL,
  `resident_image` varchar(100) NOT NULL,
  `resident_date_added` varchar(50) NOT NULL,
  `resident_date_edited` varchar(50) NOT NULL,
  `resident_added_by` varchar(100) NOT NULL,
  `resident_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresident`
--

INSERT INTO `tblresident` (`id`, `resident_fname`, `resident_mname`, `resident_lname`, `resident_birth_date`, `resident_age`, `resident_gender`, `resident_household_num`, `resident_total_household_mem`, `resident_civil_status`, `resident_blood_type`, `resident_renter`, `resident_religion`, `resident_nationality`, `resident_wra`, `resident_educational_attainment`, `resident_type_of_garbage_disposal`, `resident_interview_by`, `resident_birth_place`, `resident_purok`, `resident_tribe`, `resident_ips`, `resident_health_status`, `resident_length_of_stay`, `resident_relationship_to_head`, `resident_occupation`, `resident_types_of_toilet`, `resident_sources_of_water_supply`, `resident_blind_drainage`, `resident_email_add`, `resident_uname`, `resident_mobile_num`, `resident_upass`, `resident_secret_key`, `resident_image`, `resident_date_added`, `resident_date_edited`, `resident_added_by`, `resident_edited_by`) VALUES
(1, 'jeffern', 'dulla', 'malinao', '04/02/1997', '27', 'male', '1760', '3', 'single', 'o+', 'no', 'roman catholic', 'filipino', 'standard days method', 'college graduate', 'collection system', 'aiza romano', 'new pandan, panabo city, davao del norte', 'nido', 'bisaya', 'no', 'normal', '53', 'child', 'freelancing', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'jeffern@gmail.com', 'jeffern', '+639123456789', '$2y$10$2oG97gGvwqhR4.pgP5i1U.suF5lgqmY5cddvZD3Tlx8jODfW3YKHm', '6c622374a054cef67cd83d8e410b0393', '1717264244420_320100311_1405815266617048_55131045237012181_n.jpg', '06/02/2024 01:50 AM', '06/02/2024 09:53 AM', 'system administrator as administrator', 'system administrator as administrator'),
(2, 'flor', 'n/a', 'cabillar', '08/03/1999', '24', 'female', '1631', '5', 'single', 'o+', 'no', 'christianity', 'filipino', 'standard days method', 'college graduate', 'collection system', 'aiza romano', 'carmen, panabo city, davao del norte', 'liberty', 'bisaya', 'no', 'normal', '3', 'child', 'government employee', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'flor@gmail.com', 'flor', '+639123456789', '$2y$10$hMG.cKAoYQK2K5TAhb5lheWzFvGuNph8LTPLEolOsa9RVCTEgK0qa', '5d3a010e20747f680724f755740b2476', '1717264352170_415258647_3651147671871955_914763302564823368_n.jpg', '06/02/2024 01:52 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(3, 'clarish', 'solania', 'sargado', '09/15/1999', '24', 'female', '1389', '5', 'single', 'o+', 'no', 'roman catholic', 'filipino', 'standard days method', 'college graduate', 'collection system', 'aiza romano', 'lasang, panabo city, davao del norte', 'sustagen', 'bisaya', 'no', 'normal', '35', 'child', 'government employee', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'clarish@gmail.com', 'clarish', '+639123456789', '$2y$10$WaX4n1cMaFJAYZuxAOnwmuKUOEm8Jx.dVf90htLn1EWiFX2aylUke', '1fb477b55758311e6ff4c056cb7ac09e', '1717264556720_418500371_345381331753603_7294103899009814734_n.jpg', '06/02/2024 01:55 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(4, 'acmali', 'n/a', 'ampuan', '05/12/1999', '25', 'male', '1835', '7', 'single', 'o+', 'no', 'muslim', 'filipino', 'condom', 'college graduate', 'collection system', 'aiza romano', 'cogon, panabo city, davao del norte', 'sustagen', 'bisaya', 'no', 'normal', '51', 'child', 'government employee', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'acmali@gmail.com', 'acmali', '+639123456789', '$2y$10$bc5Ag5z3HyEBEyPT2iL1ye2eb/yS2oWzyTwddGu4IQswaY.4opmGS', '1268c94fc4e564f90739bb5f836987f8', '1717264706096_122432400_2665171743734615_3916165459951035233_n.jpg', '06/02/2024 01:58 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(5, 'abdul', 'mokit', 'madid', '07/21/1999', '24', 'male', '1335', '5', 'single', 'o+', 'no', 'muslim', 'filipino', 'condom', 'college level', 'collection system', 'aiza romano', 'lasang, panabo city, davao del norte', 'liberty', 'bisaya', 'no', 'normal', '57', 'child', 'freelancing', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'abdul@gmail.com', 'abdul', '+639123456789', '$2y$10$qxnVhvRTKCc/MM1q07xKEO0uz6.TXswrPQls7GdxKdjda9gom53ZK', '2a4d61029affe16c5117e75802fc43a5', '1717265363156_412591795_3446908852238500_4019734500755742446_n.jpg', '06/02/2024 02:09 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(6, 'jasper', 'n/a', 'tesoro', '11/27/1999', '24', 'male', '1664', '7', 'single', 'o+', 'no', 'roman catholic', 'filipino', 'condom', 'college graduate', 'collection system', 'aiza romano', 'northern, panabo city, davao del norte', 'sustagen', 'bisaya', 'no', 'normal', '73', 'child', 'private employee', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'jasper@gmail.com', 'jasper', '+639123456789', '$2y$10$2PqhvhSTSVFcVy2/xOXaJeBGZCF3AN2mQ.hkvpaXvd3nWk2LvKnGe', '79e7e063fb877450f5674d1dd7b8d88c', '1717265581093_66260721_177339276619149_409765542467993600_n.jpg', '06/02/2024 02:13 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(7, 'christopher', 'arieta', 'estrera', '09/22/1999', '24', 'male', '1228', '7', 'single', 'o+', 'no', 'roman catholic', 'filipino', 'condom', 'college graduate', 'collection system', 'aiza romano', 'new pandan, panabo city, davao del norte', 'alaska', 'bisaya', 'no', 'normal', '103', 'child', 'government employee', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'tooper@gmail.com', 'tooper', '+639123456789', '$2y$10$XrPkueMWzV83eswZ.s2XKO0c6.WjA7Ilow6d6/eSeZQgyx8pvPaxa', '6ddee4ecaed8a31d8b1fccac00b74834', '1717265723291_372683410_3523925534586719_1491809861384612562_n.jpg', '06/02/2024 02:15 AM', 'n/a', 'system administrator as administrator', 'n/a'),
(8, 'katrina', 'n/a', 'de ramos', '06/13/1999', '24', 'female', '1173', '5', 'single', 'o+', 'no', 'roman catholic', 'filipino', 'condom', 'college graduate', 'collection system', 'aiza romano', 'carmen, panabo city, davao del norte', 'bearbrand', 'bisaya', 'no', 'normal', '93', 'child', 'government employee', 'water sealed/flush toilet', 'truck/tanker peddler, bottled water', 'yes', 'katrina@gmail.com', 'katrina', '+639123456789', '$2y$10$9XAxpj.UIiuGHKArSBGEs.sNSsa0uOt6zzhHZBqHvUDLvQsnpCNAK', 'd44117ad6df649ea513a2f00730a141b', '1717265845087_361850788_1721581494970777_8117208781172735281_n.jpg', '06/02/2024 02:17 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `id` int(11) NOT NULL,
  `staff_fname` varchar(50) NOT NULL,
  `staff_mname` varchar(50) NOT NULL,
  `staff_lname` varchar(50) NOT NULL,
  `staff_uname` varchar(100) NOT NULL,
  `staff_upass` varchar(100) NOT NULL,
  `staff_image` varchar(100) NOT NULL,
  `staff_date_added` varchar(50) NOT NULL,
  `staff_date_edited` varchar(50) NOT NULL,
  `staff_added_by` varchar(100) NOT NULL,
  `staff_edited_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstaff`
--

INSERT INTO `tblstaff` (`id`, `staff_fname`, `staff_mname`, `staff_lname`, `staff_uname`, `staff_upass`, `staff_image`, `staff_date_added`, `staff_date_edited`, `staff_added_by`, `staff_edited_by`) VALUES
(1, 'flor', 'n/a', 'cabillar', 'florzxc', '$2y$10$yFQ7l98psdF1qinwKZapt.0ytfPiprzOggGNYcsOGcOWD5yW.VY0O', '1717265920478_415258647_3651147671871955_914763302564823368_n.jpg', '06/02/2024 02:18 AM', 'n/a', 'system administrator as administrator', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `admin_fname` varchar(50) NOT NULL,
  `admin_mname` varchar(50) NOT NULL,
  `admin_lname` varchar(50) NOT NULL,
  `admin_uname` varchar(100) NOT NULL,
  `admin_upass` varchar(100) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_user_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `admin_fname`, `admin_mname`, `admin_lname`, `admin_uname`, `admin_upass`, `admin_image`, `admin_user_type`) VALUES
(1, 'system', '', 'administrator', 'admin', '$2y$10$tp5q3t7cV5MGqgtHkl1whOq7lHqr8LD3IYagILEe61c9SP8xIafcW', 'boy.svg', 'administrator'),
(2, 'jeffern', 'dulla', 'malinao', 'jeffern', '$2y$10$wzdYGmUwzp2R59QAmDuaxOS4SCDgD2Zy5s3Gp6ng9XqA2N/gfKSYC', 'boy.svg', 'administrator'),
(3, 'flor', '', 'cabillar', 'flor', '$2y$10$4kZg8ZEU9c4KD3ViMjMFh.ilveB7wnr5QWGKBSx3mMRG5LejuEzwi', 'girl.svg', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblannouncement`
--
ALTER TABLE `tblannouncement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblannouncementphoto`
--
ALTER TABLE `tblannouncementphoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbldgpermit`
--
ALTER TABLE `tblbldgpermit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblblotter`
--
ALTER TABLE `tblblotter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcaptain`
--
ALTER TABLE `tblcaptain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclearance`
--
ALTER TABLE `tblclearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgovoffice`
--
ALTER TABLE `tblgovoffice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblindigent`
--
ALTER TABLE `tblindigent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblloginattempts`
--
ALTER TABLE `tblloginattempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_attempts_ip_address` (`login_attempts_ip_address`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllowincome`
--
ALTER TABLE `tbllowincome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblofficer`
--
ALTER TABLE `tblofficer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblofficial`
--
ALTER TABLE `tblofficial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpurpose`
--
ALTER TABLE `tblpurpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresident`
--
ALTER TABLE `tblresident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblannouncement`
--
ALTER TABLE `tblannouncement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblannouncementphoto`
--
ALTER TABLE `tblannouncementphoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbldgpermit`
--
ALTER TABLE `tblbldgpermit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblblotter`
--
ALTER TABLE `tblblotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcaptain`
--
ALTER TABLE `tblcaptain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclearance`
--
ALTER TABLE `tblclearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tblgovoffice`
--
ALTER TABLE `tblgovoffice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblindigent`
--
ALTER TABLE `tblindigent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblloginattempts`
--
ALTER TABLE `tblloginattempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `tbllowincome`
--
ALTER TABLE `tbllowincome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblofficer`
--
ALTER TABLE `tblofficer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblofficial`
--
ALTER TABLE `tblofficial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpurpose`
--
ALTER TABLE `tblpurpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblresident`
--
ALTER TABLE `tblresident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
