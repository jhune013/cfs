-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.30 - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cfs_db
CREATE DATABASE IF NOT EXISTS `cfs_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cfs_db`;

-- Dumping structure for table cfs_db.issue_type
CREATE TABLE IF NOT EXISTS `issue_type` (
  `issue_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `issue_name_type` varchar(50) NOT NULL,
  `support_type` varchar(50) NOT NULL,
  PRIMARY KEY (`issue_type_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.issue_type: ~26 rows (approximately)
/*!40000 ALTER TABLE `issue_type` DISABLE KEYS */;
INSERT INTO `issue_type` (`issue_type_id`, `type_id`, `issue_name_type`, `support_type`) VALUES
	(1, 1, 'Support - Site restrictions', 'Infrastructure'),
	(2, 2, 'NetSuite - Saved Search Creation', 'Development'),
	(3, 1, 'Support - Bluescreen', 'Infrastructure'),
	(4, 1, 'Support - Internet connectivity issues', 'Infrastructure'),
	(5, 2, 'NetSuite - Saved Search Enhancement', 'Development'),
	(6, 2, 'NetSuite - Report Creation', 'Development'),
	(7, 2, 'NetSuite - Report Enhancement', 'Development'),
	(8, 2, 'NetSuite - Technical Error', 'Development'),
	(9, 2, 'NetSuite - Reset Password', 'Development'),
	(10, 2, 'NetSuite - Reset Security Question', 'Development'),
	(11, 2, 'NetSuite - Unlock Account', 'Development'),
	(12, 2, 'NetSuite - Account Creation', 'Development'),
	(13, 2, 'NetSuite - Account Disable', 'Development'),
	(14, 2, 'Google Sheet Automation', 'Development'),
	(15, 2, 'Google Sheet Creation', 'Development'),
	(16, 2, 'Others', 'Development'),
	(17, 1, 'Support - Computer laptop slow', 'Infrastructure'),
	(18, 1, 'Support - Screen is stuck', 'Infrastructure'),
	(19, 1, 'Support - Abnormally functioning computer', 'Infrastructure'),
	(20, 1, 'Support - CCTV', 'Infrastructure'),
	(21, 1, 'Support - Phone', 'Infrastructure'),
	(22, 1, 'Support  - Cellphone', 'Infrastructure'),
	(23, 1, 'Support  - Slack Issues', 'Infrastructure'),
	(24, 1, 'Support  - Printer', 'Infrastructure'),
	(25, 1, 'Support  - Computer laptop wont start', 'Infrastructure'),
	(26, 1, 'Others', 'Infrastructure');
/*!40000 ALTER TABLE `issue_type` ENABLE KEYS */;

-- Dumping structure for table cfs_db.priority
CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_name` varchar(50) NOT NULL,
  `p_time_to_respond` varchar(50) NOT NULL,
  `p_time_to_resolve` varchar(50) NOT NULL,
  `tos_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.priority: ~3 rows (approximately)
/*!40000 ALTER TABLE `priority` DISABLE KEYS */;
INSERT INTO `priority` (`id`, `priority_name`, `p_time_to_respond`, `p_time_to_resolve`, `tos_type_id`) VALUES
	(1, 'Low', '1 hour', '3 hours', 1),
	(2, 'Medium', '1 hour', '2 hours', 1),
	(3, 'High', '5 minutes', '30 minutes', 1),
	(4, 'Low', '2 hour', '4 hours', 2),
	(5, 'Medium', '2 hour', '3 hours', 2),
	(6, 'Medium', '10 minutes', '40 minutes', 2);
/*!40000 ALTER TABLE `priority` ENABLE KEYS */;

-- Dumping structure for table cfs_db.remarks
CREATE TABLE IF NOT EXISTS `remarks` (
  `remark_id` int(11) NOT NULL AUTO_INCREMENT,
  `remark_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`remark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cfs_db.remarks: ~3 rows (approximately)
/*!40000 ALTER TABLE `remarks` DISABLE KEYS */;
INSERT INTO `remarks` (`remark_id`, `remark_name`) VALUES
	(1, 'First Attempt'),
	(2, 'Second Attempt'),
	(3, 'Third Attempt');
/*!40000 ALTER TABLE `remarks` ENABLE KEYS */;

-- Dumping structure for table cfs_db.service_level_agreement_infra
CREATE TABLE IF NOT EXISTS `service_level_agreement_infra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_name` varchar(11) NOT NULL,
  `response_time` varchar(11) NOT NULL,
  `resolution` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.service_level_agreement_infra: ~3 rows (approximately)
/*!40000 ALTER TABLE `service_level_agreement_infra` DISABLE KEYS */;
INSERT INTO `service_level_agreement_infra` (`id`, `priority_name`, `response_time`, `resolution`) VALUES
	(1, 'Low', '1hr', '3hr'),
	(2, 'Medium', '1hr', '1hr'),
	(3, 'High', '30min', '30min');
/*!40000 ALTER TABLE `service_level_agreement_infra` ENABLE KEYS */;

-- Dumping structure for table cfs_db.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.status: ~4 rows (approximately)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`status_id`, `status_name`) VALUES
	(1, 'Open'),
	(2, 'Replied'),
	(3, 'On Hold'),
	(4, 'Closed');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table cfs_db.ticket_creation
CREATE TABLE IF NOT EXISTS `ticket_creation` (
  `create_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_role` enum('ITD','HR') DEFAULT NULL,
  `ticket_id` int(5) unsigned zerofill DEFAULT NULL,
  `type_id` int(11) DEFAULT '0',
  `issue_id` int(11) DEFAULT '0',
  `status_id` int(11) DEFAULT '0',
  `priority_id` int(11) DEFAULT '0',
  `remark_id` int(11) DEFAULT '0',
  `validity_id` int(11) DEFAULT '0',
  `details` text,
  `employee_name` varchar(50) DEFAULT NULL,
  `assign` varchar(50) DEFAULT NULL,
  `opening_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `service_level_agreement_status` varchar(50) DEFAULT NULL,
  `time_to_resolve` varchar(50) DEFAULT NULL,
  `datime_to_respond` datetime DEFAULT CURRENT_TIMESTAMP,
  `datetime_to_resolve` datetime DEFAULT NULL,
  PRIMARY KEY (`create_id`),
  KEY `type_id` (`type_id`),
  KEY `issue_id` (`issue_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `remark_id` (`remark_id`),
  KEY `status_id` (`status_id`),
  KEY `validity_id` (`validity_id`),
  KEY `priority_id` (`priority_id`),
  KEY `ticket_role` (`ticket_role`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.ticket_creation: ~57 rows (approximately)
/*!40000 ALTER TABLE `ticket_creation` DISABLE KEYS */;
INSERT INTO `ticket_creation` (`create_id`, `ticket_role`, `ticket_id`, `type_id`, `issue_id`, `status_id`, `priority_id`, `remark_id`, `validity_id`, `details`, `employee_name`, `assign`, `opening_date`, `service_level_agreement_status`, `time_to_resolve`, `datime_to_respond`, `datetime_to_resolve`) VALUES
	(1, 'ITD', 00001, 1, 3, 1, 1, NULL, NULL, '<p>sdsds</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 11:45:03', NULL, NULL, '2022-05-04 11:45:03', NULL),
	(2, 'ITD', 00002, 1, 3, 1, 1, NULL, NULL, 'help!!!!', 'Coleen Jae Moralidad', NULL, '2022-05-04 11:45:39', NULL, NULL, '2022-05-04 11:45:39', NULL),
	(3, 'ITD', 00003, 2, 6, 1, 1, NULL, NULL, '<p>ewewqeq</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 11:46:12', NULL, NULL, '2022-05-04 11:46:12', NULL),
	(4, 'ITD', 00004, 2, 6, 1, 1, NULL, NULL, '<p>helppppppppp!!!!!!!!!!!!!!!!</p>', 'Jane Doe', NULL, '2022-05-04 11:46:34', NULL, NULL, '2022-05-04 11:46:34', NULL),
	(5, 'ITD', 00005, 2, 6, 1, 1, NULL, NULL, 'rere', 'Jane Doe', NULL, '2022-05-04 12:02:14', NULL, NULL, '2022-05-04 12:02:14', NULL),
	(6, 'ITD', 00006, 2, 6, 1, 1, NULL, NULL, 'test1', 'Jane Doe', NULL, '2022-05-04 13:21:52', NULL, NULL, '2022-05-04 13:21:52', NULL),
	(7, 'ITD', 00007, 2, 6, 1, 1, NULL, NULL, 'test1', 'Jane Doe', NULL, '2022-05-04 13:22:58', NULL, NULL, '2022-05-04 13:22:58', NULL),
	(8, 'ITD', 00008, 2, 6, 1, 1, NULL, NULL, 'testing12', 'Jane Doe', NULL, '2022-05-04 13:23:17', NULL, NULL, '2022-05-04 13:23:17', NULL),
	(9, 'ITD', 00009, 2, 2, 1, 1, NULL, NULL, '<p>wqwqwqwq</p>', 'Jane Doe', NULL, '2022-05-04 13:51:27', NULL, NULL, '2022-05-04 13:51:27', NULL),
	(10, 'ITD', 00010, 2, 2, 1, 1, NULL, NULL, '<p>wqwqwqwqqwq</p>', 'Jane Doe', NULL, '2022-05-04 13:51:58', NULL, NULL, '2022-05-04 13:51:58', NULL),
	(11, 'ITD', 00011, 2, 2, 1, 1, NULL, NULL, '<p>tesr</p>', 'Jane Doe', NULL, '2022-05-04 13:55:06', NULL, NULL, '2022-05-04 13:55:06', NULL),
	(12, 'ITD', 00012, 2, 2, 1, 1, NULL, NULL, '<p>tesrt</p>', 'Jane Doe', NULL, '2022-05-04 13:59:21', NULL, NULL, '2022-05-04 13:59:21', NULL),
	(13, 'ITD', 00013, 2, 2, 1, 1, NULL, NULL, '<p>wqwqwq</p>', 'Jane Doe', NULL, '2022-05-04 14:05:18', NULL, NULL, '2022-05-04 14:05:18', NULL),
	(14, 'ITD', 00014, 2, 2, 1, 1, NULL, NULL, '<p>wewew</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 14:36:16', NULL, NULL, '2022-05-04 14:36:16', NULL),
	(15, 'ITD', 00015, 2, 2, 1, 1, NULL, NULL, '<p>test123weweq</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 14:41:01', NULL, NULL, '2022-05-04 14:41:01', NULL),
	(16, 'ITD', 00016, 1, 17, 1, 1, NULL, NULL, '<p>ewewweewew</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 14:53:10', NULL, NULL, '2022-05-04 14:53:10', NULL),
	(17, 'ITD', 00017, 1, 17, 1, 1, NULL, NULL, '<p>test</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 14:53:19', NULL, NULL, '2022-05-04 14:53:19', NULL),
	(18, 'ITD', 00018, 2, 7, 1, 1, NULL, NULL, '<p>ewew</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 14:57:20', NULL, NULL, '2022-05-04 14:57:20', NULL),
	(19, 'ITD', 00019, 2, 7, 1, 1, NULL, NULL, '<p>help</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 14:57:33', NULL, NULL, '2022-05-04 14:57:33', NULL),
	(20, 'ITD', 00020, 2, 8, 1, 1, NULL, NULL, '<p>rwwe</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 15:04:36', NULL, NULL, '2022-05-04 15:04:36', NULL),
	(21, 'ITD', 00021, 2, 8, 1, 1, NULL, NULL, '<p>test12</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 15:05:10', NULL, NULL, '2022-05-04 15:05:10', NULL),
	(22, 'ITD', 00022, 2, 8, 1, 1, NULL, NULL, '<p>test123</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 15:43:19', NULL, NULL, '2022-05-04 15:43:19', NULL),
	(23, 'ITD', 00023, 2, 7, 1, 1, NULL, NULL, '<p>qwq</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 15:48:14', NULL, NULL, '2022-05-04 15:48:14', NULL),
	(24, 'ITD', 00024, 2, 7, 1, 1, NULL, NULL, '<p>qwq12qwqwq</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 15:48:22', NULL, NULL, '2022-05-04 15:48:22', NULL),
	(25, 'ITD', 00025, 2, 7, 1, 1, NULL, NULL, '<p>testing101</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 16:01:49', NULL, NULL, '2022-05-04 16:01:49', NULL),
	(26, 'ITD', 00026, 1, 3, 1, 1, NULL, NULL, '<p>qwqw</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 16:25:49', NULL, NULL, '2022-05-04 16:25:49', NULL),
	(27, 'ITD', 00027, 1, 3, 1, 1, NULL, NULL, '<p>helppppppp</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 16:26:03', NULL, NULL, '2022-05-04 16:26:03', NULL),
	(28, 'ITD', 00028, 2, 6, 1, 1, NULL, NULL, '<p>sasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 16:28:46', NULL, NULL, '2022-05-04 16:28:46', NULL),
	(29, 'ITD', 00029, 1, 3, 1, 1, NULL, NULL, '<p>wqewqew</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 16:56:23', NULL, NULL, '2022-05-04 16:56:23', NULL),
	(30, 'ITD', 00030, 1, 3, 1, 1, NULL, NULL, '<p>wqewqewqwq</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 17:01:24', NULL, NULL, '2022-05-04 17:01:24', NULL),
	(31, 'ITD', 00031, 2, 7, 1, 1, NULL, NULL, '<p>sasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 22:55:42', NULL, NULL, '2022-05-04 22:55:42', NULL),
	(32, 'ITD', 00032, 2, 7, 1, 1, NULL, NULL, '<p>sdsds</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 23:02:38', NULL, NULL, '2022-05-04 23:02:38', NULL),
	(33, 'ITD', 00033, 2, 5, 1, 1, NULL, NULL, '<p>fesasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 23:04:36', NULL, NULL, '2022-05-04 23:04:36', NULL),
	(34, 'ITD', 00034, 2, 5, 1, 1, NULL, NULL, '<p>tetssasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 23:24:25', NULL, NULL, '2022-05-04 23:24:25', NULL),
	(35, 'ITD', 00035, 1, 17, 2, 1, NULL, NULL, '<p>testing108</p>', 'Coleen Jae Moralidad', NULL, '2022-05-04 23:45:59', NULL, NULL, '2022-05-04 23:45:59', NULL),
	(36, 'ITD', 00036, 1, 3, 1, 1, NULL, NULL, '<p>test12</p>', 'Coleen Jae Moralidad', NULL, '2022-05-05 08:20:53', NULL, NULL, '2022-05-05 08:20:53', NULL),
	(37, 'ITD', 00037, 2, 7, 1, 1, NULL, NULL, 'helpppp', 'Coleen Jae Moralidad', NULL, '2022-05-05 16:46:28', NULL, NULL, '2022-05-05 16:46:28', NULL),
	(38, 'ITD', 00038, 2, 5, 1, 1, NULL, NULL, '<p>ewrwe</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 08:42:55', NULL, NULL, '2022-05-06 08:42:55', NULL),
	(39, 'ITD', 00039, 2, 7, 1, 1, NULL, NULL, '<p>test11</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 15:12:31', NULL, NULL, '2022-05-06 15:12:31', NULL),
	(40, 'ITD', 00040, 1, 1, 3, 1, NULL, NULL, '<p>qwqwq</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 15:37:08', NULL, NULL, '2022-05-06 15:37:08', NULL),
	(41, 'ITD', 00041, 2, 6, 1, 1, NULL, NULL, '<p>sasasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 15:37:43', NULL, NULL, '2022-05-06 15:37:43', NULL),
	(42, 'ITD', 00042, 2, 6, 1, 1, NULL, NULL, '<p>asasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 15:38:02', NULL, NULL, '2022-05-06 15:38:02', NULL),
	(43, 'ITD', 00043, 2, 5, 1, 1, NULL, NULL, '<p>sasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 15:38:28', NULL, NULL, '2022-05-06 15:38:28', NULL),
	(44, 'ITD', 00044, 2, 6, 3, 1, NULL, NULL, '<p>sadsad</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 16:34:33', NULL, NULL, '2022-05-06 16:34:33', NULL),
	(45, 'ITD', 00045, 1, 17, 1, 1, NULL, NULL, '<p>sasa</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 23:34:21', NULL, NULL, '2022-05-06 23:34:21', NULL),
	(46, 'ITD', 00046, 2, 5, 1, 1, NULL, NULL, '<p>ssds</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 23:35:19', NULL, NULL, '2022-05-06 23:35:19', NULL),
	(47, 'ITD', 00047, 2, 6, 1, 1, NULL, NULL, '<p>dssadas</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 23:37:25', NULL, NULL, '2022-05-06 23:37:25', NULL),
	(48, 'ITD', 00048, 2, 5, 1, 1, NULL, NULL, '<p>test10</p>', 'Coleen Jae Moralidad', NULL, '2022-05-06 23:44:00', NULL, NULL, '2022-05-06 23:44:00', NULL),
	(49, 'ITD', 00049, 1, 3, 2, 1, NULL, NULL, '<p>testfdfd</p>', 'Coleen Jae Moralidad', NULL, '2022-05-07 09:55:15', NULL, NULL, '2022-05-07 09:55:15', NULL),
	(50, 'ITD', 00050, 1, 22, 2, 1, NULL, NULL, '<p>test</p>', 'Coleen Jae Moralidad', NULL, '2022-05-07 10:54:45', NULL, NULL, '2022-05-07 10:54:45', NULL),
	(51, 'ITD', 00051, 1, 3, 1, 1, NULL, NULL, '<p>rwr</p>', 'Coleen Jae Moralidad', NULL, '2022-05-07 13:05:47', NULL, NULL, '2022-05-07 13:05:47', NULL),
	(52, 'ITD', 00052, 1, 4, 1, 1, NULL, NULL, '<p>test105</p>', 'Coleen Jae Moralidad', NULL, '2022-05-07 13:30:02', NULL, NULL, '2022-05-07 13:30:02', NULL),
	(53, 'ITD', 00053, 2, 6, 1, 1, NULL, NULL, '<p><img data-filename="Screenshot 2022-04-12 092140.png"><br><img src="http://cfs.local/public/img/uploads/a0a080f42e6f13b3a2df133f073095dd.png"></p>', 'Henry Planillo', NULL, '2022-05-07 14:55:25', NULL, NULL, '2022-05-07 14:55:25', NULL),
	(54, 'ITD', 00054, 1, 4, 2, 1, NULL, NULL, NULL, 'Eloisa Casumpang', NULL, '2022-05-07 19:07:38', NULL, NULL, '2022-05-07 19:07:38', NULL),
	(55, 'ITD', 00055, 1, 17, 1, 1, NULL, NULL, NULL, 'Coleen Jae Moralidad', NULL, '2022-05-09 10:40:34', NULL, NULL, '2022-05-09 10:40:34', NULL),
	(56, 'ITD', 00056, 1, 17, 3, 1, NULL, NULL, NULL, 'Coleen Jae Moralidad', NULL, '2022-05-09 10:40:56', NULL, NULL, '2022-05-09 10:40:56', NULL),
	(57, 'ITD', 00057, 1, 1, 1, 1, NULL, NULL, NULL, 'Coleen Jae Moralidad', NULL, '2022-05-09 15:16:12', NULL, NULL, '2022-05-09 11:12:35', NULL);
/*!40000 ALTER TABLE `ticket_creation` ENABLE KEYS */;

-- Dumping structure for table cfs_db.ticket_details
CREATE TABLE IF NOT EXISTS `ticket_details` (
  `td_no` int(11) NOT NULL AUTO_INCREMENT,
  `td_create_id` int(11) DEFAULT NULL,
  `td_message` text,
  `td_user_id` int(11) DEFAULT NULL,
  `td_created` datetime(3) DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`td_no`),
  KEY `td_create_id` (`td_create_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table cfs_db.ticket_details: ~5 rows (approximately)
/*!40000 ALTER TABLE `ticket_details` DISABLE KEYS */;
INSERT INTO `ticket_details` (`td_no`, `td_create_id`, `td_message`, `td_user_id`, `td_created`) VALUES
	(1, 53, '<p><img src="http://cfs.local/public/img/uploads/a0a080f42e6f13b3a2df133f073095dd.png"></p>', 1, '2022-05-09 10:10:21.400'),
	(2, 54, '<p><img src="http://cfs.local/public/img/uploads/b3e3e393c77e35a4a3f3cbd1e429b5dc.png"></p><p>test 123456</p>', 1, '2022-05-09 10:29:22.390'),
	(3, 54, '<p>test 12345</p><p><b>BOLD TEST</b></p>', 1, '2022-05-09 10:36:08.087'),
	(5, 57, '<p>test</p>', 1, '2022-05-09 11:12:35.239'),
	(7, 57, '<p>test reply</p>', 1, '2022-05-09 11:39:55.757');
/*!40000 ALTER TABLE `ticket_details` ENABLE KEYS */;

-- Dumping structure for table cfs_db.type_of_support
CREATE TABLE IF NOT EXISTS `type_of_support` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `support_type` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.type_of_support: ~2 rows (approximately)
/*!40000 ALTER TABLE `type_of_support` DISABLE KEYS */;
INSERT INTO `type_of_support` (`type_id`, `support_type`) VALUES
	(1, 'Infrastructure'),
	(2, 'Development');
/*!40000 ALTER TABLE `type_of_support` ENABLE KEYS */;

-- Dumping structure for table cfs_db.users_master
CREATE TABLE IF NOT EXISTS `users_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_prefix` enum('EMP') DEFAULT NULL,
  `emp_no` int(5) unsigned zerofill NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `datesaved` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `emp_prefix` (`emp_prefix`),
  KEY `emp_no` (`emp_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cfs_db.users_master: ~9 rows (approximately)
/*!40000 ALTER TABLE `users_master` DISABLE KEYS */;
INSERT INTO `users_master` (`user_id`, `emp_prefix`, `emp_no`, `firstname`, `lastname`, `username`, `password`, `email`, `datesaved`, `updated_at`, `active`, `user_type_id`, `user_type`) VALUES
	(1, 'EMP', 00001, 'Coleen Jae', 'Moralidad', 'coleen.moralidad', '$2y$10$HHfBe78EzUeQ6yX4r37a9uFQatSfgxUQvCX5tdppNBJhOBHdBWr9C', 'coleenjae.moralidad@consistent.com.ph', '2022-04-01 08:43:35', '2022-04-01 08:43:35', 0, 1, 'Superadmin'),
	(2, 'EMP', 00002, 'Rywin', 'Costales', 'rywin.costales', '$2y$10$78iYAMZPvwOzu2SYwphi2OvHSn.bhMyaKa2ywmupRNQcy58vaBDvC', 'rywinshyrr.costales@consistent.com.ph', '2022-04-01 13:05:38', '2022-04-01 13:05:38', 0, 2, 'Support'),
	(3, 'EMP', 00003, 'Jhune', 'Elbambuena', 'jhune.elbambuena', '$2y$10$78iYAMZPvwOzu2SYwphi2OvHSn.bhMyaKa2ywmupRNQcy58vaBDvC', 'jhune.elbambuena@consistent.com.ph', '2022-04-27 09:27:01', '2022-04-27 09:27:01', 0, 1, 'Superadmin'),
	(4, 'EMP', 00004, 'Jane', 'Doe', 'jane.doe', '$2y$10$78iYAMZPvwOzu2SYwphi2OvHSn.bhMyaKa2ywmupRNQcy58vaBDvC', 'janedoe@test.com', '2022-04-27 11:08:00', '2022-04-27 11:08:00', 0, 3, 'User'),
	(5, 'EMP', 00005, 'John', 'Valdez', 'john.valdez', '$2y$10$78iYAMZPvwOzu2SYwphi2OvHSn.bhMyaKa2ywmupRNQcy58vaBDvC', 'john.valdez@consistent.com.ph', '2022-05-06 10:42:57', '2022-05-06 10:42:57', 0, 2, 'Support'),
	(6, 'EMP', 00006, 'Mark', 'Flores', 'mark.flores', '$2y$10$78iYAMZPvwOzu2SYwphi2OvHSn.bhMyaKa2ywmupRNQcy58vaBDvC', '\r\nmark.flores@consistent.com.ph', '2022-05-07 14:07:13', '2022-05-07 14:07:13', 0, 2, 'Support'),
	(7, 'EMP', 00007, 'Eloisa', 'Casumpang', 'eloisa.casumpang', '$2y$10$fZlC38cSAucPr1/v8Qe4ou37hHJfzTZPgXcabNLIpVhOBkyTblsUW', 'eloisa.casumpang@consistent.com.ph', '2022-05-07 14:11:53', '2022-05-07 14:11:53', 0, 2, 'Support'),
	(8, 'EMP', 00008, 'Henry', 'Planillo', 'henry.planillo', '$2y$10$fZlC38cSAucPr1/v8Qe4ou37hHJfzTZPgXcabNLIpVhOBkyTblsUW', 'henry.planillo@consistent.com.ph', '2022-05-07 14:27:46', '2022-05-07 14:27:46', 0, 1, 'Superadmin'),
	(9, 'EMP', 00009, 'John', 'Doe', 'john.doe', '$2y$10$fZlC38cSAucPr1/v8Qe4ou37hHJfzTZPgXcabNLIpVhOBkyTblsUW', 'johndoe@test.com', '2022-05-07 14:37:10', '2022-05-07 14:37:10', 0, 2, 'User');
/*!40000 ALTER TABLE `users_master` ENABLE KEYS */;

-- Dumping structure for table cfs_db.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cfs_db.user_role: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`role_id`, `user_type_id`, `user_type`) VALUES
	(1, 1, 'Superadmin'),
	(2, 2, 'Support'),
	(3, 3, 'User');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

-- Dumping structure for table cfs_db.validity
CREATE TABLE IF NOT EXISTS `validity` (
  `validity_id` int(11) NOT NULL AUTO_INCREMENT,
  `validity_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`validity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cfs_db.validity: ~3 rows (approximately)
/*!40000 ALTER TABLE `validity` DISABLE KEYS */;
INSERT INTO `validity` (`validity_id`, `validity_name`) VALUES
	(1, '1 Day'),
	(2, '1 Week'),
	(3, '1 Month');
/*!40000 ALTER TABLE `validity` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
