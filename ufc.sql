-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2015 at 05:48 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ufc`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_age`(
  `date_of_birth` DATE,
  `current_time` DATETIME
) RETURNS int(11) unsigned
    NO SQL
    DETERMINISTIC
    COMMENT 'Calculates the age from the date of birth'
RETURN ((YEAR(current_time) - YEAR(date_of_birth)) - ((DATE_FORMAT(current_time, '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d'))))$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`Event_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date DEFAULT NULL,
  `Start_time` time NOT NULL,
  `End_time` time DEFAULT NULL,
  `Location_area` varchar(100) NOT NULL,
  `Location_city` varchar(100) NOT NULL,
  `Location_state` varchar(100) NOT NULL,
  `Volunteer_Capacity` int(11) DEFAULT NULL,
  `Volunteer_max_age` int(11) DEFAULT NULL,
  `Volunteer_min_age` int(11) DEFAULT NULL,
  `Gender_requirements` char(1) DEFAULT NULL,
  `Repetition_details` int(11) DEFAULT NULL,
  `Event_type_name` varchar(100) NOT NULL,
  `NGO_Username` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Event_id`, `Name`, `Start_date`, `End_date`, `Start_time`, `End_time`, `Location_area`, `Location_city`, `Location_state`, `Volunteer_Capacity`, `Volunteer_max_age`, `Volunteer_min_age`, `Gender_requirements`, `Repetition_details`, `Event_type_name`, `NGO_Username`) VALUES
(1, 'Social Animal', '2015-04-20', '2015-05-30', '02:00:00', '13:30:00', 'Satellite', 'Ahmedabad', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Sports', 'AJ999'),
(2, 'Marathon', '2015-04-22', '2015-04-23', '09:00:00', '17:00:00', 'Satellite', 'Ahmedabad', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Sports', 'ram10'),
(3, 'Career Guidance', '2015-04-08', '2015-04-09', '10:00:00', '16:00:00', 'Race course road', 'Rajkot', 'Gujarat', NULL, NULL, 18, 'B', 0, 'Education & Literacy', 'AS777'),
(4, 'Women Rights Awarness', '2015-05-15', '2015-05-15', '09:00:00', '16:00:00', 'Satellite', 'Ahmedabad', 'Gujarat', NULL, NULL, NULL, 'B', 7, 'Sports', 'MM666'),
(5, 'Children Growth', '2015-06-06', '2015-06-07', '09:00:00', '15:00:00', 'Kalupur', 'Ahmedabad', 'Gujarat', 25, NULL, 18, 'B', 0, 'Sports', 'DD444'),
(6, 'Human rights awareness program ', '2015-06-19', '2015-06-19', '09:00:00', '16:00:00', 'Station road', 'Mehsana', 'Gujarat', NULL, NULL, NULL, 'B', 0, 'Human rights', 'JM555'),
(7, 'Blood donation Camp', '2015-03-28', '2015-03-28', '09:00:00', '16:00:00', 'Race course road', 'Rajkot', 'Gujarat', NULL, NULL, 18, 'B', NULL, 'Health & Family Welfare', 'AS777'),
(8, 'Life event', '2015-05-25', '2015-05-25', '12:00:00', '15:00:00', 'Ranjit nagar', 'Jamnagar', 'Gujarat', NULL, NULL, NULL, 'B', 0, 'Aged/Elderly', 'BJ222'),
(9, 'Scientific & Industrial Meet', '2015-06-22', '2015-06-27', '09:00:00', '17:00:00', 'Kandiwali west', 'Mumbai', 'Maharashtra', 50, NULL, 22, 'B', NULL, 'Scientific & Industrial Research', 'MM333'),
(10, 'Sports Festival', '2015-05-29', '2015-05-29', '09:00:00', '17:00:00', 'Jalahalli west', 'Bangalore', 'Karnataka', 30, NULL, NULL, 'B', NULL, 'Differently Abled ', 'MM888'),
(11, 'Disaster Management Awareness Program', '2015-05-04', NULL, '10:00:00', '16:00:00', 'Gondal Road', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Disaster Management', 'Ma8281'),
(12, 'Biotechnology Knowledge Program', '2015-05-07', '2015-05-07', '12:00:00', NULL, 'Sadar Bazar', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Biotechnology', 'Pal7161'),
(13, 'Future planning guidance', '2015-05-09', NULL, '17:00:00', '20:00:00', 'Satellite', 'Ahmedabad', 'Gujarat', 20, 25, NULL, 'B', NULL, 'Youth Affairs', 'AJ999'),
(14, 'Minority Issues Awarness', '2015-05-09', '2015-05-09', '10:00:00', '17:00:00', 'Raiya Tele. Exchange', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Minority Issues', 'Quinn'),
(15, 'Minority Issues Awarness', '2015-05-12', '2015-05-12', '09:00:00', NULL, 'Vastrapur', 'Ahmedabad', 'Gujarat', 25, NULL, NULL, 'B', NULL, 'Minority Issues', 'Ka233'),
(16, 'Renewable Energy Awarness', '2015-05-10', NULL, '13:00:00', NULL, 'Moti Tanki Chowk', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'M', NULL, 'New & Renewable Energy', 'Ro7161n'),
(17, 'Women Development Opportunities', '2015-05-05', '2015-05-05', '16:00:00', NULL, 'Nana Mava Main Road', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'F', NULL, 'Women Development & Empowerment', 'St234'),
(18, 'My event', '2015-05-19', '0000-00-00', '07:00:00', '00:00:00', 'SG Highway', 'Ahmedabad', 'Gujarat', 50, 20, 30, 'M', 3, 'Sports', 'AS777'),
(19, 'My event', '2015-04-04', '2015-04-06', '01:18:00', '01:18:00', 'Navrangpura', 'Ahmedabad', 'Gujarat', 40, 20, 30, 'M', 4, 'Sports', 'AS777'),
(20, 'Right to Information', '2015-05-17', '2015-05-17', '11:00:00', '14:00:00', 'Pancheswer Tower Road', 'Jamnagar', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Right to Information & Advocacy', 'ter11'),
(21, 'My event', '2015-04-03', '2015-04-06', '06:00:00', '09:30:00', 'SG Highway', 'Ahmedabad', 'Gujarat', 50, 20, 30, 'M', 3, 'Sports', 'AS777'),
(22, 'My event', '2015-04-03', '2015-04-06', '06:00:00', '12:00:00', 'SG Highway', 'Ahmedabad', 'Gujarat', 50, 20, 30, 'M', 3, 'Sports', 'AS777'),
(23, 'Rural Development', '2015-05-17', '2015-05-24', '09:00:00', NULL, 'PHULCHHAB CHOWK', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Rural Development & Poverty Alleviation Science & Technology', 'Ma2828'),
(24, 'HIV/AIDS Awareness', '2015-05-20', '2015-05-20', '18:00:00', '20:00:00', 'Talala district', 'Junagadh', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'HIV/AIDS', 'anshul09'),
(25, 'Tourism', '2015-04-30', '2015-04-30', '17:00:00', '20:00:00', 'Ranjit Nagar', 'Jamnagar', 'Gujarat', NULL, NULL, NULL, 'B', 7, 'Tourism', 'BJ222'),
(26, ' Housing', '2015-05-12', '2015-05-12', '14:00:00', NULL, 'Maninagar', 'Ahmedabad', 'Gujarat', 40, NULL, NULL, 'B', 30, ' Housing', 'Jud8282'),
(27, 'Vocational Training', '2015-05-18', '2015-05-18', '10:00:00', NULL, 'Naroda road', 'Ahmedabad', 'Gujarat', NULL, NULL, NULL, 'B', 15, 'Vocational Training', 'ju982'),
(28, 'Nutrition Awareness', '2015-04-29', '2015-04-29', '17:00:00', '20:00:00', 'Rameshwarnagar', 'Jamnagar', 'Gujarat', NULL, NULL, NULL, 'B', 30, 'Nutrition', 'Ze33'),
(29, 'Environment Awareness', '2015-04-30', '2015-04-30', '10:00:00', NULL, 'Station road', 'Mehsana', 'Gujarat', NULL, NULL, NULL, 'B', 180, 'Environment & Forests', 'JM555'),
(30, 'Employment Planning ', '2015-05-01', '2015-05-01', '16:00:00', '20:00:00', 'Opp Income Tax Office', 'Ahmedabad', 'Gujarat', 50, 0, 20, 'B', 365, 'Labour & Employment', 'El7363'),
(31, 'Health Guidance', '2015-05-20', '2015-05-20', '18:00:00', NULL, 'Waghodia road', 'Vadodara', 'Gujarat', 0, 0, NULL, 'B', NULL, 'Health & Family Welfare ', 'DD444'),
(32, 'Land Resources', '2015-05-12', '2015-05-12', '12:00:00', NULL, 'Race course road', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', 0, 'Land Resources', 'AS777'),
(33, 'Tribal Affairs', '2015-05-19', '2015-05-19', '10:00:00', NULL, '150 feet ring road', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Tribal Affairs', 'Mart92'),
(34, 'Art Galary', '2015-05-04', '2015-05-04', '09:00:00', NULL, 'Thaltej', 'Ahmedabad', 'Gujarat', 25, NULL, 15, 'B', NULL, 'Art & Culture', 'Ha782'),
(35, 'Dalit Upliftment Program', '2015-05-11', '2015-05-15', '09:00:00', NULL, 'Vastrapur', 'Ahmedabad', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Dalit Upliftment', 'Ka233'),
(36, 'Civic Issues', '2015-05-13', '2015-05-13', '10:00:00', NULL, 'Ranjit Nagar', 'Jamnagar', 'Gujarat', NULL, NULL, NULL, 'B', 180, 'Civic Issues', 'BJ222'),
(37, 'Food Processing', '2015-05-19', NULL, '09:00:00', NULL, 'Station road', 'Mehsana', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Food Processing', 'JM555'),
(38, 'Dairying Support Program', '2015-05-12', '2015-05-14', '10:00:00', NULL, 'Waghodia road', 'Vadodara', 'Gujarat', NULL, NULL, NULL, 'B', 90, 'Dairying  &  Fisheries', 'DD444'),
(39, 'Micro Small & Medium Enterprises Summit', '2015-05-08', '2015-05-10', '09:00:00', NULL, 'Talala district', 'Junagadh', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Micro Small & Medium Enterprises', 'anshul09'),
(40, 'HIV/AIDS awareness program', '2015-05-04', '2015-05-04', '15:00:00', '17:00:00', 'PHULCHHAB CHOWK', 'Rajkot', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'HIV/AIDS', 'Ma2828'),
(41, 'event xyz', '2015-04-27', '2015-04-28', '19:00:00', '00:00:00', 'Satellite', 'Ahmedabad', 'Gujarat', NULL, NULL, NULL, 'B', NULL, 'Animal Husbandry', 'AJ999');

-- --------------------------------------------------------

--
-- Table structure for table `event_profession`
--

CREATE TABLE IF NOT EXISTS `event_profession` (
  `Event_id` int(11) NOT NULL,
  `Profession` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_profession`
--

INSERT INTO `event_profession` (`Event_id`, `Profession`) VALUES
(3, 'chemist'),
(3, 'dentist'),
(3, 'nurses'),
(3, 'pharmacists'),
(3, 'psychologists'),
(3, 'surgeons'),
(6, 'therapist'),
(12, 'veterinarians'),
(15, 'architects'),
(15, 'economists'),
(17, 'lawyers'),
(18, 'engineers'),
(18, 'librarians'),
(20, 'military officer'),
(20, 'police officer'),
(22, 'social worker'),
(24, 'professor'),
(25, 'teacher'),
(26, 'dentist'),
(27, 'midwives'),
(28, 'nurses'),
(28, 'therapist'),
(39, 'engineers'),
(40, 'lawyers');

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE IF NOT EXISTS `ngo` (
  `Username` varchar(30) NOT NULL DEFAULT '',
  `HQ_Area` varchar(100) NOT NULL,
  `HQ_City` varchar(100) NOT NULL,
  `HQ_State` varchar(100) NOT NULL,
  `Website_url` varchar(100) DEFAULT NULL,
  `Registration_no` varchar(30) NOT NULL,
  `NGO_Head` varchar(40) NOT NULL,
  `Description` varchar(150) NOT NULL,
  `Feedback_accessibility_status` tinyint(1) NOT NULL,
  `Verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`Username`, `HQ_Area`, `HQ_City`, `HQ_State`, `Website_url`, `Registration_no`, `NGO_Head`, `Description`, `Feedback_accessibility_status`, `Verified`) VALUES
('AJ999', 'Satellite', 'Ahmedabad', 'Gujarat', 'http://gaconfig.com/google-analytics-url-builder/', 'E 16523', 'Malay Dave', 'Morbi non sapien', 1, 1),
('anshul09', 'Talala district', 'Junagadh', 'Gujarat', '', 'GUJ/2377/JND-F/2323/JND', 'B M Pandya', 'ommodo a', 0, 1),
('AS777', 'Race course road', 'Rajkot', 'Gujarat', 'http://www.theirishworld.com/', 'E/7757', 'Dr. Gunvantkumar Sheth', 'Ut semper pretium', 1, 0),
('BJ222', 'Ranjit Nagar', 'Jamnagar', 'Gujarat', 'http://www.grimsey.com/', 'F 1143', 'Milan Joshi', 'Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh', 0, 0),
('Cadq2', 'Limda lane', 'Jamnagar', 'Gujarat', 'ut.pellentesque.eget@scelerisquedui.org', 'E-866', 'Bhavnaben Parmar', 'Nunc mauris. Morbi non sapien', 1, 0),
('DD444', 'Waghodia road', 'Vadodara', 'Gujarat', 'http://www.digitalproducer.com/', 'Guj 765 panchmahals', 'Prajakta Sarpotkar', 'Fusce aliquet magna a neque', 1, 0),
('El7363', 'Opp Income tax office', 'Ahmedabad', 'Gujarat', NULL, 'E.6700 ', 'Dineshbhai Mehta', 'Iona rhoncus', 0, 0),
('Ha782', 'Thaltej', 'Ahmedabad', 'Gujarat', 'imperdiet.ullamcorper@feugiat.edu', 'E 15953', 'Hasmukh Modi', ' Aliquam auctor, velit', 0, 0),
('JM555', 'Station road', 'Mehsana', 'Gujarat', 'http://www3.globalspin.org/', 'E-4228', 'Mihir Malde', 'In ornare sagittis felis. Donec tempor, est ac mattis semper', 0, 0),
('ju982', 'Naroda road', 'Ahmedabad', 'Gujarat', NULL, 'E/4760/AHMEDABAD', 'Mukesh Patel', ' Nunc lectus pede, ultrices', 0, 0),
('Jud8282', 'Maninagar', 'Ahmedabad', 'Gujarat', '"elit@lectussitamet.org', 'E 17013 AHMEDABAD', 'Jayant Trivedi', 'eu nulla at sem molestie', 0, 0),
('Ka233', 'Vastrapur', 'Ahmedabad', 'Gujarat', 'fermentum@ac.net', 'F/9196/Ahmedabad', 'Dhananjay Patel', 'Duis gravida', 1, 0),
('Ma2828', 'PHULCHHAB CHOWK', 'Rajkot', 'Gujarat', NULL, 'E-2237', 'Ushaben Karia', 'Etiam gravida molestie', 0, 0),
('Ma8281', 'Gondal Road', 'Rajkot', 'Gujarat', 'eu.tellus.Phasellus@mauris.co.uk', 'e/8141/rajkot', 'Nisha Ranpara', 'Euismod est arcu', 0, 0),
('Mart92', '150 feet ring road', 'Rajkot', 'Gujarat', NULL, 'E5259 Rajkot', 'Vasant Pathak', 'velit eget laoreet', 1, 0),
('MM333', 'Kandiwali west', 'Mumbai', 'Maharashtra', 'http://www.eulogyrecordings.com/', 'E 13757', 'Gopalji Chandarana', 'Suspendisse aliquet molestie tellus', 1, 0),
('MM666', 'Jagdalpur', 'Bastar', 'Chhattisgarh', 'http://www.rockunderground-mag.com/', '1729', 'Mr. Vinod Kumar', 'Phasellus dapibus quam quis diam', 0, 0),
('MM888', 'Jalahalli west', 'Bangalore', 'Karnataka', 'http://rustedhalo.net/', '980/98-99', 'Rajendra Kulkarni', 'Fusce aliquam, enim nec tempus scelerisque', 1, 0),
('Pal7161', 'Sadar Bazar', 'Rajkot', 'Gujarat', NULL, 'GUJ/227/RAJKOT', 'Ramjibhai Mavani', 'Cum sociis natoque penatibus ', 1, 0),
('PPK111', 'Sector-15, Rohini', 'Delhi', 'Delhi', 'http://www.trygve.com/visible_barbie.html', '59703/07', 'Jitin Sachdeva', 'Lorem ipsum sodales purus', 0, 0),
('Quinn', 'Raiya Tele.Exchange', 'Rajkot', 'Gujarat', 'suscipit@morbitristique.edu', 'F-2100-Rajkot', 'Mahesh Dave', 'Aenean euismod mauris', 0, 0),
('ram10', 'Sector 36-D', 'Chandigarh', 'Chandigarh', 'http://hhbtm.com/', '3260', 'Inderjit Singh', 'In molestie tortor nibh', 1, 0),
('Ro7161n', 'Moti Tanki Chowk ', 'Rajkot', 'Gujarat', NULL, 'SAU.GUJ.1254', 'Chhaganbhai Kathiriya', 'sit amet luctus vulputate, nisi sem semper erat', 1, 0),
('St234', 'Nana Mava Main Road', 'Rajkot', 'Gujarat', NULL, 'F/1108/RAJKOT GUJ/1238/RAJKOT', 'Jayeshbhai Savaliya', 'senectus', 0, 0),
('ter11', 'Pancheswer Tower Road', 'Jamnagar', 'Gujarat', NULL, 'E-1505', 'Raghubhai Mevada', 'Libero', 0, 0),
('Ze33', 'Rameshwarnagar', 'Jamnagar', 'Gujarat', NULL, 'f/713/jamnagar', 'Suresh Parghi', 'orci, consectetuer euismod est arcu ac orci', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ngo_event_type_name`
--

CREATE TABLE IF NOT EXISTS `ngo_event_type_name` (
  `NGO_Username` varchar(30) NOT NULL DEFAULT '',
  `Event_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ngo_event_type_name`
--

INSERT INTO `ngo_event_type_name` (`NGO_Username`, `Event_type_name`) VALUES
('AJ999', 'Animal Husbandry'),
('anshul09', 'HIV/AIDS'),
('anshul09', 'Micro Small & Medium Enterprises'),
('AS777', 'Education & Literacy'),
('AS777', 'Health & Family Welfare'),
('AS777', 'Land Resources'),
('BJ222', ' Aged/Elderly'),
('BJ222', 'Biotechnology'),
('BJ222', 'Civic Issues'),
('BJ222', 'Tourism'),
('DD444', ' Dalit Upliftment'),
('DD444', 'Children'),
('DD444', 'Dairying  &  Fisheries'),
('El7363', 'Labour & Employment'),
('Ha782', 'Art & Culture'),
('JM555', 'Environment & Forests'),
('JM555', 'Food Processing'),
('JM555', 'Human Rights'),
('JM555', 'Labour & Employment'),
('JM555', 'Legal Awareness & Aid '),
('ju982', 'Vocational Training'),
('Jud8282', 'Housing'),
('Ka233', 'Dalit Upliftment'),
('Ka233', 'Minority Issues'),
('Ma2828', 'Disaster Management'),
('Ma2828', 'HIV/AIDS'),
('Ma2828', 'Rural Development & Poverty Alleviation Science & Technology'),
('Mart92', 'Tribal Affairs'),
('MM333', 'Rural Development & Poverty Alleviation Science & Technology'),
('MM333', 'Scientific & Industrial Research'),
('MM666', 'Women Development & Empowerment'),
('MM666', 'Youth Affairs'),
('MM888', 'Differently Abled'),
('MM888', 'Disaster Management'),
('Pal7161', 'Biotechnology'),
('PPK111', 'Minority Issues'),
('PPK111', 'Panchayati Raj'),
('Quinn', 'Minority Issues'),
('ram10', 'Sports'),
('ram10', 'Tourism'),
('Ro7161n', 'New & Renewable Energy'),
('St234', 'Women Development & Empowerment'),
('ter11', 'Right to Information & Advocacy'),
('Ze33', 'Nutrition');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(30) NOT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Last_access_date` date NOT NULL,
  `Mobile_no` bigint(10) NOT NULL,
  `Validate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Email_ID`, `Name`, `Password`, `Last_access_date`, `Mobile_no`, `Validate`) VALUES
('AJ999', 'anshul94ag@gmail.com', 'anshul', 'c22fa1d113cd0b113cba29568a1ad0ee036a8482', '2015-04-19', 9876543211, 1),
('amisha07', '201201026@daiict.ac.in', 'amisha', '0e3f9724e03d5ac42539357f85fec5034756d2c0', '2015-04-20', 9765432180, 1),
('anshul09', '201201040@daiict.ac.in', 'cancer awareness trust', '88ddb54b82dc4b55a9853e6110a19a2e052f2708', '2015-01-28', 9654321087, 1),
('AS777', 'amishas157@gmail.com', 'jaya', '20ebc965d06d5fabcf44adf16c13f281803db2bf', '2014-10-22', 9543210876, 0),
('asdaq', 'dharani_dhar777@yahoo.co.in', 'asda', 'ee5ac002bae8e076f2757083a338cd3e8a551bdc', '2015-04-19', 987654321, 1),
('BJ222', 'bhuvanjoshi1993@gmail.com', 'shreya', 'd210989f4e27209e6ae2f6979fbdf32f09a5e916', '2015-04-01', 9321087654, 0),
('Cadq2', 'Nunc.mauris@leoinlobortis.co.uk', 'help centre', '5ff5496809fe7a16faf5121235f0284ed3543357', '2015-04-28', 7625209236, 1),
('DD444', 'dharanidharreddyg@gmail.com', 'abhiaan foundation', '01cef309a8abf00e785f48e66d10de0805c95a67', '2015-02-27', 9210876543, 0),
('dharni04', '201201014@daiict.ac.in', 'dharanidhar', 'd72aee0aa83337c24bcf1a7f1ccafdecc6a65911', '2014-11-25', 9108765432, 0),
('El7363', 'vitae.risus@gmail.com', 'asha foundation', '7f6a9bde711e66fcd8a152bb537fea7da7989b34', '2015-04-23', 8828282699, 1),
('Ha782', 'ac.eleifend@yahoo.com', 'abhishek foundation', '7a867902f9139e7f340681b7842a33bb409f5e65', '2015-04-14', 7543210987, 1),
('Ha828', 'nibh.dolor.nonum@gmail.com', 'chayya', 'adff65722ac1b086f0853d844797464878dd0ae7', '2015-04-25', 8171910191, 1),
('Id334', 'Vivamus.euismod.urna@yahoo.com', 'anand', 'e2c53ed6e8b49e04ee7baf6fce4d595fe74b1563', '2015-04-21', 8191910809, 1),
('In24', 'quis.diam.Pellentesque@gmail.com', 'uma', '0c143238e691e55cdd75a7bcc62c7fe74cff5798', '2015-04-16', 9875456960, 1),
('Je292', 'consequat.enim.diam@gmail.com', 'aryan', '44daa9bef6fcae6caefd98a17a33ba778afd344e', '2015-04-29', 7890654321, 1),
('JM555', 'jay.2997@gmail.com', 'yuvam edutech', 'a63eef3e80589d3c85bdbbc6a388bc9a777cdb52', '2015-04-07', 9987654321, 0),
('ju982', 'euismod.est.arcu@yahoo.com', 'anartfoundation', '8f5675742a5a8f7b5a45c563e321c1b221dfe3ee', '2015-04-17', 7666546820, 1),
('Jud8282', 'tellus.imperdiet.non@yahoo.com', 'arivoli trust', '7bec28c2b9561ad697bc5e8cb5720e1afb472177', '2015-05-02', 7020383631, 1),
('Ka233', 'lorem@gmail.com', 'green foundation', 'b20ef0b6ea6f65b566e4603616297c6d4a49f782', '2015-04-13', 9001230986, 1),
('L82672', 'blandit.enim.consequat@gmail.com', 'arun', '841b390645c77036f83e1a0d0dcc1d2fabe055bb', '2015-04-30', 7321098761, 1),
('La9q8', 'Maecenas.libero@ultricesmauris.com', 'chirag', 'd6060b634df7ff3950868915455760a1cca026d7', '2015-04-27', 9999878130, 1),
('Lli272', 'malesuada.fringilla@yahoo.com', 'aakash', 'a17a910c7dc0c86198e04305abc7b80e15fd321e', '2015-05-05', 7685943211, 1),
('Ma2828', 'semper.egestas@yahoo.com', 'aakash foundation', '9f1d888bda40ecf6ddd81e321fe884855d1bfda3', '2015-05-05', 8271910487, 1),
('Ma8281', 'et.netus@gmail.com', 'aro charitable trust', '494d5bda79229b6605dd6262cd2f78aa82419fba', '2015-05-03', 7543210981, 1),
('manisha03', '201201018@daiict.ac.in', 'manisha', 'c1e7adf22aef25403a0d613fbd1daf6320d4e6b6', '2014-12-13', 9886543210, 0),
('Mart92', 'adipiscing@yahoo.com', 'seva', 'c52b4dbb15ba763385f2ff48c281eda2337d34d1', '2015-05-08', 9171918791, 1),
('meenakshi08', '201201036@daiict.ac.in', 'meenakshi', '03406462a2929177fd5f2735975597907f0202bd', '2015-02-18', 9776543210, 0),
('miti06', '201201035@daiict.ac.in', 'miti', '2a8a14402152f9bb2caa64abc675788a6f15ba97', '2014-11-05', 9665432100, 0),
('MM333', 'manishamachhaiya93@gmail.com', 'shatayu', 'f9884f748d52a0d31bde52ece43729f9dd90a381', '2015-01-21', 9554321098, 0),
('MM666', 'mitimazmudar@gmail.com', 'yuva', '1cf3f28bf69943b459a19d47542b3acef42ed72b', '2014-10-08', 9443210987, 0),
('MM888', 'meena201201036@gmail.com', 'aadhar', '4d2c3715e3fca04890217091605e76068e6fd8d6', '2014-05-13', 9221087654, 0),
('O8171', 'accumsan@gmail.com', 'asha', '4c0b84bd6890ebbf5767ef0b7daefd31740ac6e7', '2015-04-24', 8291014080, 1),
('Pal7161', 'mollis@temporest.ca', 'chirag education trust', '926dbda886aa4f06a1959d41c5ba7dad5367efb6', '2015-04-25', 7382929859, 1),
('PPK111', 'p.philip.kisku@gmail.com', 'yuvavikass evasangh', '67f2b7f323963bb42f119f38196f911bbf791ee1', '2013-04-08', 9110876543, 0),
('pritam01', '201201005@daiict.ac.in', 'pritam', '2b70f363351175803dcd5660ed7e3bee6c6e2bb7', '2014-09-23', 9008765432, 0),
('Quinn', 'a@consequat.net', 'Altruist', '8277813d80a0e80cee7fee9dd76d6d1657f1f8a6', '2015-04-11', 9999920525, 1),
('ram10', 'meenakshi2294@yahoo.com', 'ram', '138bf3a8d6cba0b75c19d8f19cb32cdb4e26e353', '2014-02-09', 9998765431, 0),
('RM1000', 'jaylu.mehta2277@gmail.com', 'Rama', 'e51944e975b5755017d476c8b48bd2e0d1ae7d05', '2014-08-31', 9998765432, 0),
('Ro7161n', 'mauris.ut@gmail.com', 'asad foundation', '6dd0a9a57d9b590050fee3ad3a989bde12b1cf4d', '2015-05-06', 7654321098, 1),
('Sol282', 'a.ultricies.adipiscing@gmail.com', 'Deeksha', 'fc65d0e951432d86b05bcef88d3677f4642bb765', '2015-05-05', 7119201756, 1),
('St234', 'neque.Nullam@yahoo.ocom', 'chayya charitable trust', '588f3a6f557f5be79bf83bdcaed4eb10041e01d0', '2015-04-24', 8271195196, 1),
('ter11', 'Morbi.quis@gmail.com', 'adivasi vikas mandal', '41e405049e934fdbf180ecdcf509f4e3f85a5713', '2015-04-29', 9874321110, 1),
('Uma22', 'Donec.vitae.erat@yahoo.com', 'abhishek', '436a32db55256a459b2d51a7d196578caf24c55c', '2015-04-18', 8765439821, 1),
('Ze33', 'Donec.nibh@yahoo.com', 'a to z education trust', '5d9a4a9192598807d1b1a3a5c08bb02035226569', '2015-04-13', 7432109871, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE IF NOT EXISTS `user_otp` (
  `Username` char(30) NOT NULL,
  `otp` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_otp`
--

INSERT INTO `user_otp` (`Username`, `otp`) VALUES
('asdaq', 0);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE IF NOT EXISTS `volunteer` (
  `Username` varchar(30) NOT NULL DEFAULT '',
  `Gender` varchar(1) NOT NULL DEFAULT '',
  `DOB` date NOT NULL,
  `Profession` varchar(40) NOT NULL DEFAULT '',
  `Email_notification_control` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`Username`, `Gender`, `DOB`, `Profession`, `Email_notification_control`) VALUES
('amisha07', 'F', '1994-02-03', 'Researcher', 1),
('asdaq', 'M', '0008-09-07', 'chemist', 1),
('BJ222', 'F', '1988-08-08', 'Student', 0),
('dharni04', 'M', '1990-09-09', 'engineers', 1),
('Ha828', 'F', '1990-09-21', 'engineers', 1),
('Id334', 'M', '1993-02-21', 'lawyers', 1),
('In24', 'F', '1991-02-22', 'agriculturists', 0),
('Je292', 'M', '1993-09-21', 'teacher', 1),
('L82672', 'M', '1988-07-23', 'police officer', 0),
('La9q8', 'M', '1992-10-22', 'veterinarians', 0),
('Lli272', 'M', '1988-04-22', 'therapist', 0),
('manisha03', 'F', '1997-03-04', 'surgeons', 1),
('meenakshi08', 'F', '1998-02-03', 'enigneer', 1),
('miti06', 'F', '1998-09-09', 'pathologist', 0),
('O8171', 'F', '1989-03-15', 'teacher', 1),
('pritam01', 'M', '1990-02-11', 'student', 0),
('ram10', 'M', '1994-03-09', 'teacher', 1),
('RM1000', 'F', '1991-02-21', 'economists', 1),
('Sol282', 'F', '1995-05-23', 'psychologists', 1),
('Uma22', 'M', '1990-03-21', 'nurses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_following_events`
--

CREATE TABLE IF NOT EXISTS `volunteers_following_events` (
  `Volunteer_Username` varchar(30) NOT NULL DEFAULT '',
  `Event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers_following_events`
--

INSERT INTO `volunteers_following_events` (`Volunteer_Username`, `Event_id`) VALUES
('Id334', 1),
('pritam01', 1),
('Sol282', 1),
('BJ222', 3),
('Id334', 5),
('Id334', 9),
('dharni04', 12),
('BJ222', 13),
('dharni04', 13),
('BJ222', 14),
('Ha828', 14),
('In24', 14),
('ram10', 18),
('Je292', 19),
('manisha03', 20),
('pritam01', 20),
('ram10', 20),
('Sol282', 20),
('O8171', 21),
('In24', 22),
('O8171', 26),
('Uma22', 33),
('BJ222', 39),
('amisha07', 40);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_following_event_types`
--

CREATE TABLE IF NOT EXISTS `volunteers_following_event_types` (
  `Volunteer_Username` varchar(30) NOT NULL DEFAULT '',
  `Event_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers_following_event_types`
--

INSERT INTO `volunteers_following_event_types` (`Volunteer_Username`, `Event_type_name`) VALUES
('amisha07', 'Dairying  &  Fisheries'),
('BJ222', 'Biotechnology'),
('dharni04', 'Legal Awareness & Aid '),
('dharni04', 'Scientific & Industrial Research'),
('dharni04', 'Youth Affairs'),
('Id334', 'Labour & Employment'),
('In24', 'Agriculture'),
('In24', 'HIV/AIDS'),
('L82672', 'Housing '),
('La9q8', 'HIV/AID'),
('Lli272', 'Health & Family Welfare'),
('manisha03', 'Education & Literacy '),
('meenakshi08', 'Legal Awareness & Aid '),
('meenakshi08', 'Micro Small & Medium Enterprises '),
('meenakshi08', 'Rural Development & Poverty Alleviation Science & Technology '),
('miti06', 'Education & Literacy '),
('miti06', 'Human Rights '),
('O8171', 'Art & Culture '),
('O8171', 'Health & Family Welfare '),
('pritam01', 'Disaster Management '),
('pritam01', 'Environment & Forests'),
('ram10', 'Minority Issues '),
('RM1000', 'Health & Family Welfare'),
('Sol282', 'Panchayati Raj ');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_following_ngos`
--

CREATE TABLE IF NOT EXISTS `volunteers_following_ngos` (
  `Volunteer_Username` varchar(30) NOT NULL DEFAULT '',
  `NGO_Username` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers_following_ngos`
--

INSERT INTO `volunteers_following_ngos` (`Volunteer_Username`, `NGO_Username`) VALUES
('manisha03', 'AJ999'),
('dharni04', 'anshul09'),
('dharni04', 'AS777'),
('miti06', 'AS777'),
('ram10', 'AS777'),
('BJ222', 'DD444'),
('dharni04', 'DD444'),
('miti06', 'DD444'),
('BJ222', 'Ha782'),
('amisha07', 'JM555'),
('manisha03', 'JM555'),
('Ha828', 'ju982'),
('O8171', 'ju982'),
('Uma22', 'ju982'),
('In24', 'Jud8282'),
('RM1000', 'Ka233'),
('pritam01', 'Mart92'),
('meenakshi08', 'MM333'),
('meenakshi08', 'MM666'),
('Uma22', 'MM666'),
('L82672', 'MM888'),
('Lli272', 'MM888'),
('O8171', 'MM888'),
('La9q8', 'Pal7161');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_registered_for_events`
--

CREATE TABLE IF NOT EXISTS `volunteers_registered_for_events` (
  `Volunteer_Username` varchar(30) NOT NULL DEFAULT '',
  `Event_id` int(11) NOT NULL,
  `Feedback` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers_registered_for_events`
--

INSERT INTO `volunteers_registered_for_events` (`Volunteer_Username`, `Event_id`, `Feedback`) VALUES
('amisha07', 2, NULL),
('amisha07', 3, NULL),
('amisha07', 29, ''),
('BJ222', 30, NULL),
('BJ222', 40, 'Nice event.NGO is going a great work for people'),
('dharni04', 18, NULL),
('dharni04', 39, 'Event was good and the NGO is also doing a great job'),
('Ha828', 39, 'nice event'),
('Je292', 24, NULL),
('Je292', 25, 'Good event. Nice work guys!'),
('L82672', 20, NULL),
('L82672', 33, NULL),
('La9q8', 20, NULL),
('manisha03', 1, 'Had a nice experience of working on such a good event'),
('manisha03', 3, 'Nice work'),
('manisha03', 21, NULL),
('meenakshi08', 15, NULL),
('meenakshi08', 24, NULL),
('miti06', 2, NULL),
('pritam01', 5, NULL),
('pritam01', 10, NULL),
('ram10', 25, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`Event_id`), ADD UNIQUE KEY `Event_id` (`Event_id`), ADD KEY `event_references_ngo_username` (`NGO_Username`);

--
-- Indexes for table `event_profession`
--
ALTER TABLE `event_profession`
 ADD PRIMARY KEY (`Event_id`,`Profession`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
 ADD PRIMARY KEY (`Username`), ADD UNIQUE KEY `Username` (`Username`), ADD UNIQUE KEY `Username_2` (`Username`), ADD UNIQUE KEY `WEbsite_url` (`Website_url`,`Registration_no`);

--
-- Indexes for table `ngo_event_type_name`
--
ALTER TABLE `ngo_event_type_name`
 ADD PRIMARY KEY (`NGO_Username`,`Event_type_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD UNIQUE KEY `Username` (`Username`), ADD UNIQUE KEY `Email_ID` (`Email_ID`), ADD UNIQUE KEY `Mobile_no` (`Mobile_no`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
 ADD PRIMARY KEY (`Username`), ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
 ADD PRIMARY KEY (`Username`), ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `volunteers_following_events`
--
ALTER TABLE `volunteers_following_events`
 ADD PRIMARY KEY (`Volunteer_Username`,`Event_id`), ADD KEY `Event_id` (`Event_id`);

--
-- Indexes for table `volunteers_following_event_types`
--
ALTER TABLE `volunteers_following_event_types`
 ADD PRIMARY KEY (`Volunteer_Username`,`Event_type_name`);

--
-- Indexes for table `volunteers_following_ngos`
--
ALTER TABLE `volunteers_following_ngos`
 ADD PRIMARY KEY (`Volunteer_Username`,`NGO_Username`), ADD KEY `NGO_id` (`NGO_Username`);

--
-- Indexes for table `volunteers_registered_for_events`
--
ALTER TABLE `volunteers_registered_for_events`
 ADD PRIMARY KEY (`Volunteer_Username`,`Event_id`), ADD KEY `Event_id` (`Event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `Event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `event_references_ngo_username` FOREIGN KEY (`NGO_Username`) REFERENCES `ngo` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo`
--
ALTER TABLE `ngo`
ADD CONSTRAINT `ngo_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo_event_type_name`
--
ALTER TABLE `ngo_event_type_name`
ADD CONSTRAINT `ngo_event_type_name_ibfk_1` FOREIGN KEY (`NGO_Username`) REFERENCES `ngo` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_otp`
--
ALTER TABLE `user_otp`
ADD CONSTRAINT `user_otp_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteers_following_events`
--
ALTER TABLE `volunteers_following_events`
ADD CONSTRAINT `volunteers_following_events_ibfk_1` FOREIGN KEY (`Volunteer_Username`) REFERENCES `volunteer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `volunteers_following_events_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteers_following_event_types`
--
ALTER TABLE `volunteers_following_event_types`
ADD CONSTRAINT `volunteers_following_event_types_ibfk_1` FOREIGN KEY (`Volunteer_Username`) REFERENCES `volunteer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteers_following_ngos`
--
ALTER TABLE `volunteers_following_ngos`
ADD CONSTRAINT `volunteers_following_ngos_ibfk_1` FOREIGN KEY (`Volunteer_Username`) REFERENCES `volunteer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `volunteers_following_ngos_ibfk_2` FOREIGN KEY (`NGO_Username`) REFERENCES `ngo` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteers_registered_for_events`
--
ALTER TABLE `volunteers_registered_for_events`
ADD CONSTRAINT `volunteers_registered_for_events_ibfk_1` FOREIGN KEY (`Volunteer_Username`) REFERENCES `volunteer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `volunteers_registered_for_events_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
