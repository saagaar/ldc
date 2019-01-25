-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2019 at 03:04 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.14-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ldc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `permission_id` int(10) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_id` int(10) NOT NULL DEFAULT '0' COMMENT 'parent id',
  `display_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles_permission`
--

CREATE TABLE `admin_roles_permission` (
  `user_type` int(5) NOT NULL,
  `permission_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `block_ips`
--

CREATE TABLE `block_ips` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT '',
  `iso_code` varchar(2) NOT NULL,
  `isd_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country`, `iso_code`, `isd_code`) VALUES
(1, 'United Kingdom', '', NULL),
(2, 'Australia', '', NULL),
(3, 'Canada', '', NULL),
(4, 'Ireland', '', NULL),
(5, 'New Zealand', '', NULL),
(6, 'Angola', '', NULL),
(7, 'Antigua', '', NULL),
(8, 'Argentina', '', NULL),
(9, 'Armenia', '', NULL),
(10, 'Australia', '', NULL),
(11, 'Austria', '', NULL),
(12, 'Azerbaijan', '', NULL),
(13, 'Bahamas', '', NULL),
(14, 'Bahrain', '', NULL),
(15, 'Bangladesh', '', NULL),
(16, 'Barbados', '', NULL),
(17, 'Belarus', '', NULL),
(18, 'Belgium', '', NULL),
(19, 'Belize', '', NULL),
(20, 'Benin', '', NULL),
(21, 'Bhutan', '', NULL),
(22, 'Bolivia', '', NULL),
(23, 'Bosnia', '', NULL),
(24, 'Herzegovina', '', NULL),
(25, 'Botswana', '', NULL),
(26, 'Brazil', '', NULL),
(27, 'Brunei', '', NULL),
(28, 'Bulgaria', '', NULL),
(29, 'Barbuda', '', NULL),
(30, 'Burkina Faso', '', NULL),
(31, 'Burma', '', NULL),
(32, 'Burundi', '', NULL),
(33, 'Cambodia', '', NULL),
(34, 'Cameroon', '', NULL),
(35, 'Afghanistan', '', NULL),
(36, 'Cape Verde', '', NULL),
(37, 'Central African Republic', '', NULL),
(38, 'Chad', '', NULL),
(39, 'Chile', '', NULL),
(40, 'China', '', NULL),
(41, 'Colombia', '', NULL),
(42, 'Comoros', '', NULL),
(43, 'Congo (Brazzaville)', '', NULL),
(44, 'Congo (Kinshasa)', '', NULL),
(45, 'Costa Rica', '', NULL),
(46, 'Cote d\'Ivoire', '', NULL),
(47, 'Croatia', '', NULL),
(48, 'Cuba', '', NULL),
(49, 'Cyprus', '', NULL),
(50, 'Czech Republic', '', NULL),
(51, 'Denmark', '', NULL),
(52, 'Djibouti', '', NULL),
(53, 'Dominica', '', NULL),
(54, 'Dominican Republic', '', NULL),
(55, 'Ecuador', '', NULL),
(56, 'Egypt', '', NULL),
(57, 'El Salvador', '', NULL),
(58, 'Equatorial Guinea', '', NULL),
(59, 'Eritrea', '', NULL),
(60, 'Estonia', '', NULL),
(61, 'Ethiopia', '', NULL),
(62, 'Fiji', '', NULL),
(63, 'Finland', '', NULL),
(64, 'France', '', NULL),
(65, 'Gabon', '', NULL),
(66, 'Gambia', '', NULL),
(67, 'Georgia', '', NULL),
(68, 'Germany', '', NULL),
(69, 'Ghana', '', NULL),
(70, 'Greece', '', NULL),
(71, 'Grenada', '', NULL),
(72, 'Guatemala', '', NULL),
(73, 'Guinea', '', NULL),
(74, 'Guinea-Bissau', '', NULL),
(75, 'Guyana', '', NULL),
(76, 'Haiti', '', NULL),
(77, 'Holy See', '', NULL),
(78, 'Honduras', '', NULL),
(79, 'Hungary', '', NULL),
(80, 'Iceland', '', NULL),
(81, 'India', '', NULL),
(82, 'Indonesia', '', NULL),
(83, 'Iran', '', NULL),
(84, 'Iraq', '', NULL),
(86, 'Israel', '', NULL),
(87, 'Italy', '', NULL),
(88, 'Jamaica', '', NULL),
(89, 'Japan', '', NULL),
(90, 'Jordan', '', NULL),
(91, 'Kazakhstan', '', NULL),
(92, 'Kenya', '', NULL),
(93, 'Kiribati', '', NULL),
(94, 'North Korea', '', NULL),
(95, 'South Korea', '', NULL),
(96, 'Kuwait', '', NULL),
(97, 'Kyrgyzstan', '', NULL),
(98, 'Laos', '', NULL),
(99, 'Latvia', '', NULL),
(100, 'Lebanon', '', NULL),
(101, 'Lesotho', '', NULL),
(102, 'Liberia', '', NULL),
(103, 'Libya', '', NULL),
(104, 'Liechtenstein', '', NULL),
(105, 'Lithuania', '', NULL),
(106, 'Luxembourg', '', NULL),
(107, 'Macedonia', '', NULL),
(108, 'Madagascar', '', NULL),
(109, 'Malaqi', '', NULL),
(110, 'Malaysia', '', NULL),
(111, 'Maldives', '', NULL),
(112, 'Mali', '', NULL),
(113, 'Malta', '', NULL),
(114, 'Marshall Islands', '', NULL),
(115, 'Mauritania', '', NULL),
(116, 'Mauritius', '', NULL),
(117, 'Mexico', '', NULL),
(118, 'Micronesia', '', NULL),
(119, 'Moldova', '', NULL),
(120, 'Monaco', '', NULL),
(121, 'Mongolia', '', NULL),
(122, 'Morocco', '', NULL),
(123, 'Mozambique', '', NULL),
(124, 'Namibia', '', NULL),
(125, 'Nauru', '', NULL),
(126, 'Nepal', '', NULL),
(127, 'Netherlands', '', NULL),
(128, 'Andorra', '', NULL),
(129, 'Nicaragua', '', NULL),
(130, 'Niger', '', NULL),
(131, 'Nigeria', '', NULL),
(132, 'Norway', '', NULL),
(133, 'Oman', '', NULL),
(134, 'Pakistan', '', NULL),
(135, 'Palau', '', NULL),
(136, 'Panama', '', NULL),
(137, 'Papua New Guinea', '', NULL),
(138, 'Paraguay', '', NULL),
(139, 'Peru', '', NULL),
(140, 'Philippines', '', NULL),
(141, 'Polska', '', NULL),
(142, 'Portugal', '', NULL),
(143, 'Qatar', '', NULL),
(144, 'Romania', '', NULL),
(145, 'Russia', '', NULL),
(146, 'Rwanda', '', NULL),
(147, 'Saint Kitts & Nevis', '', NULL),
(148, 'Saint Lucia', '', NULL),
(149, 'Saint Vincent & the Grenadines', '', NULL),
(150, 'Samoa', '', NULL),
(151, 'San Marino', '', NULL),
(152, 'Sao Tome & Principe', '', NULL),
(153, 'Saudi Arabia', '', NULL),
(154, 'Senegal', '', NULL),
(155, 'Seychelles', '', NULL),
(156, 'Sierra Leone', '', NULL),
(157, 'Singapore', '', NULL),
(158, 'Slovakia', '', NULL),
(159, 'Slovenia', '', NULL),
(160, 'Solomon Islands', '', NULL),
(161, 'Somalia', '', NULL),
(162, 'South Africa', '', NULL),
(163, 'Spain', '', NULL),
(164, 'Sri Lanka', '', NULL),
(165, 'Sudan', '', NULL),
(166, 'Suriname', '', NULL),
(167, 'Swaziland', '', NULL),
(168, 'Sweden', '', NULL),
(169, 'Switzerland', '', NULL),
(170, 'Syria', '', NULL),
(171, 'Tajikistan', '', NULL),
(172, 'Tanzania', '', NULL),
(173, 'Thailand', '', NULL),
(174, 'Togo', '', NULL),
(175, 'Tonga', '', NULL),
(176, 'Trinidad & Tobago', '', NULL),
(177, 'Tunisia', '', NULL),
(178, 'Turkey', '', NULL),
(179, 'Turkmenistan', '', NULL),
(180, 'Tuvalu', '', NULL),
(181, 'Uganda', '', NULL),
(182, 'Ukraine', '', NULL),
(183, 'United Arab Emirates', '', NULL),
(184, 'United States', '', NULL),
(185, 'Uruguay', '', NULL),
(186, 'Uzbekistan', '', NULL),
(187, 'Vanuatu', '', NULL),
(188, 'Venezuela', '', NULL),
(189, 'Vietnam', '', NULL),
(190, 'Yemen', '', NULL),
(191, 'Yugoslavia', '', NULL),
(192, 'Zambia', '', NULL),
(193, 'Zimbabwe', '', NULL),
(194, 'Taiwan', '', NULL),
(195, 'N. Ireland', '', NULL),
(196, 'Republic of Ireland', '', NULL),
(197, 'Albania', '', NULL),
(198, 'Algeria', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `email_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sms_text` text COLLATE utf8_unicode_ci NOT NULL,
  `last_update` datetime NOT NULL,
  `email_type` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Admin, 2=Buyer, 3=Seller',
  `is_display_notification` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=disable, 1=enable ; in the user account',
  `is_email_notification_send` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '0=No, 1=Yes ',
  `is_sms_notification_send` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No,1=Yes',
  `listing_order` int(11) NOT NULL COMMENT 'Display Order in the backend  and front end',
  `enable_rating` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=disable, 1=enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `email_code`, `subject`, `email_body`, `sms_text`, `last_update`, `email_type`, `is_display_notification`, `is_email_notification_send`, `is_sms_notification_send`, `listing_order`, `enable_rating`) VALUES
(67, 'register_notification', ' LG Web Portal Registration ', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello [USERNAME],</span></p>\r\n\r\n<p> You registration to the web portal has been approved by \r\n[DEALER_NAME]. Login with your registered email ID and password to join \r\nthe incentive program now. \r\nThank you \r\n\r\n </p>\r\n\r\n[WEBSITE_NAME]\r\n', 'sdasd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(68, 'email_footer', 'sda', ' ', ' ', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(69, 'email_header', 'header', ' \r\n', ' ', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(70, 'registration_rejected', 'LG Web Portal Registration ', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello [USERNAME],</span></p>\r\n\r\n<p> You registration to the web portal has been rejected by \r\nLG Admin. Please Contact LG admin for detail.\r\nThank you \r\n\r\n </p>\r\n\r\n[WEBSITE_NAME]\r\n', 'sd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(71, 'user_approved_admin', 'LG Web Portal Staff Registration ', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello Admin,</span></p>\r\n\r\n<p> [STAFF_NAME] has registered to LG Web Portal and has \r\napproved by  [DEALER_NAME]. Please proceed to approved this staff \r\nregistration.  \r\n \r\n\r\n </p>\r\n<p>\r\nThank you \r\n</p>\r\n[WEBSITE_NAME]\r\n', 'sdasdasd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(72, 'update_profile_request', ' Staff Change Request. LG Web Portal Change Information Request', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello Admin,</span></p>\r\n\r\n<p> \r\nI would like to update my personal information.\r\nStaff Name-[STAFF_NAME] <br/>\r\nEmail-[email] <br/>\r\nContact No.-[CONTACT_NO] <br/>\r\nDealer Name-[DEALER] <br/>\r\n \r\n\r\n </p>\r\nThank you \r\n[WEBSITE_NAME]\r\n', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello Admin,</span></p>\r\n\r\n<p> \r\nI would like to update my personal information.\r\nStaff Name-[STAFF_NAME] <br/>\r\nEmail-[email] <br/>\r\nContact No.-[CONTACT_NO] <br/>\r\nDealer Name-[DEALER] <br/>\r\n \r\n\r\n </p>\r\nThank you \r\n[WEBSITE_NAME]\r\n', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(73, 'forget_password', 'Forget password reset link', '<p>\r\n Dear Sir/Madam,</p>\r\n<p>\r\n Someone requested that the password be reset for your account in LG Incentive:</p>\r\n<p>\r\n If this was a mistake, just ignore or delete this email and nothing will happen. In order to reset your password, please click on the link below:<br />\r\n <strong>[CONFIRM]</strong></p>\r\n<p>\r\n Please reset your password within the next 24 hours.</p>\r\n<p>\r\n Sincerely,</p>\r\n<p>\r\n <strong>The [SITENAME] Support Team<br />\r\n [SITENAME]</strong></p>\r\n', '000000', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(74, 'dealer_sales_report_approve', 'Sales Report Approved', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello Admin,</span></p>\r\n\r\n<p> \r\n Some Sales Report has been submitted by a Dealer [DEALER_NAME].Please have a look at it.\r\n\r\n </p>\r\n<p>\r\nThank you \r\n</p>\r\n[WEBSITE_NAME]\r\n', 'asd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(75, 'sales_report_rejected', 'Sales Report Rejected-staff', '<p>\r\n Dear Sir/Madam,</p>\r\n<p>You Sales Report has been rejected by admin.Please check and consult Admin for more Info</p>\r\n\r\n Sincerely,</p>\r\n<p>\r\n <strong>The [WEBSITE_NAME] Support Team<br />\r\n [WEBSITE_NAME]</strong></p>\r\n', 'sd	', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(76, 'sales_report_accepted', 'Sales Report Accepted- Staff', '<p>\r\n Dear Sir/Madam,</p>\r\n<p>You Sales Report has been Approved by admin.Please check and consult Admin for more Info</p>\r\n\r\n Sincerely,</p>\r\n<p>\r\n <strong>The [WEBSITE_NAME] Support Team<br />\r\n [WEBSITE_NAME]</strong></p>\r\n', 'sd	', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(77, 'registration_admin_approval', 'Registration Success', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello [USERNAME],</span></p>\r\n\r\n<p> You registration to the web portal has been Completed. You can login only\r\nafter admin Approval. \r\n\r\n </p>\r\n<p>\r\nThank you \r\n</p>\r\n\r\n[SITENAME]\r\n', 'sd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(78, 'dealer_registration_complete', 'Dealer Registration Success', '<p>\r\n Dear Sir/Madam,</p>\r\n<p>You Dealer Account has been created by Admin.</p>\r\n<p>\r\nYou can login using\r\n<p>Username : <b>[USERNAME]</b></p>\r\n<p>Password : <b>[PASSWORD]</b></p>\r\n<p>Email : <b>[EMAIL]</b></p>\r\n</p>\r\n\r\n\r\n Sincerely,</p>\r\n<p>\r\n <strong>The [SITENAME] Support Team<br />\r\n [SITENAME]</strong></p>\r\n', 'sd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(79, 'staff_registered_dealer', 'Staff Registered ', '<p>\r\n Dear Sir/Madam,</p>\r\n<p>\r\nSome staff has registered to the system as your staff.\r\nPlease look at the staff and verfy.\r\n</p>\r\n<p>\r\nEmail : <b>[EMAIL]</b></p>\r\n<p>USERNAME:<b>[USERNAME]</b></p>\r\n<p>\r\n Sincerely,</p>\r\n<p>\r\n <strong>The [SITENAME] Support Team<br />\r\n [SITENAME]</strong></p>\r\n', 'sd\r\n', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(80, 'staff_profile_edit_accept', 'Profile Edit Successful', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello [USERNAME],</span></p>\r\n\r\n<p> You Profile Edit has been approved by \r\nLG Admin.You can now see your updated profile.\r\n\r\n </p>\r\n\r\n[WEBSITE_NAME]\r\n', 'asd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1'),
(81, 'staff_profile_edit_reject', 'Profile Edit Rejected', '<p><span style=\"color:rgb(107, 107, 107); font-family:arial,helvetica,sans-serif; font-size:12px\">Hello [USERNAME],</span></p>\r\n\r\n<p> You Profile Edit has been Rejected by \r\nLG Admin.Contact Admin for further detail.\r\n\r\n </p>\r\n\r\n[WEBSITE_NAME]\r\n', 'sdasd', '0000-00-00 00:00:00', '1', '1', '1', '0', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `incentive`
--

CREATE TABLE `incentive` (
  `id` int(11) NOT NULL,
  `model_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `added_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `staff_reward_type` enum('1','2') NOT NULL COMMENT '1=incremental tier,2=target_tier',
  `dealer_reward_type` enum('1','2') NOT NULL COMMENT '1=incremental tier,2=target_tier',
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incentive`
--

INSERT INTO `incentive` (`id`, `model_id`, `start_date`, `end_date`, `added_date`, `update_date`, `staff_reward_type`, `dealer_reward_type`, `name`) VALUES
(34, 14, '2017-08-01 00:00:00', '2017-08-31 00:00:00', '2017-08-24 12:25:57', '2017-09-07 10:00:29', '2', '2', 'dashain festival'),
(35, 10, '2017-08-25 00:00:00', '2017-08-30 00:00:00', '2017-08-25 15:21:54', '2017-08-29 09:25:40', '2', '2', 'test'),
(36, 10, '2017-08-28 00:00:00', '2017-08-31 00:00:00', '2017-08-28 09:51:59', '2017-08-29 09:25:19', '2', '2', 'test1'),
(37, 10, '2017-08-28 00:00:00', '2017-08-31 00:00:00', '2017-08-29 08:56:31', '2017-08-29 10:18:37', '2', '2', 'New-year_2017'),
(38, 14, '2017-09-01 00:00:00', '2017-09-30 00:00:00', '2017-09-06 09:08:39', NULL, '2', '2', 'LG G6 Sep'),
(39, 14, '2017-09-15 00:00:00', '2017-09-30 00:00:00', '2017-09-12 11:58:35', NULL, '2', '2', 'LG G6 (Sep Incentive)');

-- --------------------------------------------------------

--
-- Table structure for table `log_admin_activity`
--

CREATE TABLE `log_admin_activity` (
  `log_id` bigint(20) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_user_id` int(11) NOT NULL,
  `log_user_type` varchar(10) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_desc` text NOT NULL,
  `log_action` varchar(255) NOT NULL,
  `log_ip` varchar(255) NOT NULL,
  `log_browser` text,
  `log_platform` text,
  `log_agent` text,
  `log_referrer` text,
  `log_extra_info` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_admin_activity`
--

INSERT INTO `log_admin_activity` (`log_id`, `log_time`, `log_user_id`, `log_user_type`, `module_name`, `module_desc`, `log_action`, `log_ip`, `log_browser`, `log_platform`, `log_agent`, `log_referrer`, `log_extra_info`) VALUES
(1, '2017-08-23 18:39:14', 2, '1', 'Add Dealer', 'Dealer Added', 'Add', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer', 'Dealer id: 195'),
(2, '2017-08-23 18:55:57', 2, '1', 'Add Incentive', 'Incentive Added', 'Add', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive', 'Incentive id: 34'),
(3, '2017-08-23 19:05:27', 195, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 197'),
(4, '2017-08-23 19:05:36', 195, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 196'),
(5, '2017-08-23 19:08:19', 2, '1', 'Approve Staff by Admin ', 'Staff Management(staff approve)', 'Approve', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/staff_management', 'Member id: 197'),
(6, '2017-08-23 19:08:19', 2, '1', 'Approve Staff by Admin ', 'Staff Management(staff approve)', 'Approve', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/staff_management', 'Member id: 196'),
(7, '2017-08-23 19:18:07', 195, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 5,status:dealer_approve,time:2017-08-24 12:48:07'),
(8, '2017-08-23 19:18:07', 195, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 4,status:dealer_approve,time:2017-08-24 12:48:07'),
(9, '2017-08-23 19:18:07', 195, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 3,status:dealer_approve,time:2017-08-24 12:48:07'),
(10, '2017-08-23 19:18:08', 195, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 2,status:dealer_approve,time:2017-08-24 12:48:07'),
(11, '2017-08-23 19:18:08', 195, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 1,status:dealer_approve,time:2017-08-24 12:48:07'),
(12, '2017-08-23 19:19:32', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 5,status:accepted,time:2017-08-24 12:49:32'),
(13, '2017-08-23 19:19:32', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 4,status:accepted,time:2017-08-24 12:49:32'),
(14, '2017-08-23 19:19:32', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 3,status:accepted,time:2017-08-24 12:49:32'),
(15, '2017-08-23 19:19:32', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 2,status:accepted,time:2017-08-24 12:49:32'),
(16, '2017-08-23 19:19:33', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.218.193', 'Chrome | 60.0.3112.101', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 1,status:accepted,time:2017-08-24 12:49:32'),
(17, '2017-08-24 21:28:08', 2, '1', 'Add Dealer', 'Dealer Added', 'Add', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer', 'Dealer id: 198'),
(18, '2017-08-24 21:31:52', 198, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 199'),
(19, '2017-08-24 21:36:40', 2, '1', 'Approve Staff by Admin ', 'Staff Management(staff approve)', 'Approve', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/staff_management', 'Member id: 199'),
(20, '2017-08-24 21:51:54', 2, '1', 'Add Incentive', 'Incentive Added', 'Add', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive', 'Incentive id: 35'),
(21, '2017-08-24 21:55:43', 198, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 200'),
(22, '2017-08-24 21:55:50', 198, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 201'),
(23, '2017-08-24 21:56:12', 2, '1', 'Approve Staff by Admin ', 'Staff Management(staff approve)', 'Approve', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/staff_management', 'Member id: 201'),
(24, '2017-08-24 21:56:19', 2, '1', 'Approve Staff by Admin ', 'Staff Management(staff approve)', 'Approve', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/staff_management', 'Member id: 200'),
(25, '2017-08-24 22:03:07', 2, '1', 'Delete Product', 'Product Management', 'Delete', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/product_management', 'Product id: 68'),
(26, '2017-08-24 22:07:45', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 11,status:dealer_approve,time:2017-08-25 15:37:45'),
(27, '2017-08-24 22:07:46', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 10,status:dealer_approve,time:2017-08-25 15:37:45'),
(28, '2017-08-24 22:07:46', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 9,status:dealer_approve,time:2017-08-25 15:37:45'),
(29, '2017-08-24 22:07:46', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 8,status:dealer_approve,time:2017-08-25 15:37:45'),
(30, '2017-08-24 22:07:46', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 7,status:dealer_approve,time:2017-08-25 15:37:45'),
(31, '2017-08-24 22:07:46', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 6,status:dealer_approve,time:2017-08-25 15:37:45'),
(32, '2017-08-24 22:23:20', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 16,status:dealer_reject,time:2017-08-25 15:53:20'),
(33, '2017-08-24 22:23:20', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 15,status:dealer_reject,time:2017-08-25 15:53:20'),
(34, '2017-08-24 22:23:20', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 14,status:dealer_reject,time:2017-08-25 15:53:20'),
(35, '2017-08-24 22:23:20', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 13,status:dealer_reject,time:2017-08-25 15:53:20'),
(36, '2017-08-24 22:23:20', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 12,status:dealer_reject,time:2017-08-25 15:53:20'),
(37, '2017-08-24 22:23:34', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 22,status:dealer_approve,time:2017-08-25 15:53:34'),
(38, '2017-08-24 22:23:34', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 21,status:dealer_approve,time:2017-08-25 15:53:34'),
(39, '2017-08-24 22:23:34', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 20,status:dealer_approve,time:2017-08-25 15:53:34'),
(40, '2017-08-24 22:23:34', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 19,status:dealer_approve,time:2017-08-25 15:53:34'),
(41, '2017-08-24 22:23:34', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 18,status:dealer_approve,time:2017-08-25 15:53:34'),
(42, '2017-08-24 22:23:35', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 17,status:dealer_approve,time:2017-08-25 15:53:34'),
(43, '2017-08-24 22:27:53', 198, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 24,status:dealer_approve,time:2017-08-25 15:57:53'),
(44, '2017-08-24 22:28:24', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 11,status:accepted,time:2017-08-25 15:58:24'),
(45, '2017-08-24 22:28:25', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 10,status:accepted,time:2017-08-25 15:58:24'),
(46, '2017-08-24 22:28:25', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 9,status:accepted,time:2017-08-25 15:58:24'),
(47, '2017-08-24 22:28:26', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 8,status:accepted,time:2017-08-25 15:58:24'),
(48, '2017-08-24 22:28:26', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 7,status:accepted,time:2017-08-25 15:58:24'),
(49, '2017-08-24 22:28:26', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 6,status:accepted,time:2017-08-25 15:58:24'),
(50, '2017-08-24 22:31:46', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 22,status:accepted,time:2017-08-25 16:01:46'),
(51, '2017-08-24 22:31:46', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 21,status:accepted,time:2017-08-25 16:01:46'),
(52, '2017-08-24 22:31:46', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 20,status:accepted,time:2017-08-25 16:01:46'),
(53, '2017-08-24 22:31:46', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 19,status:accepted,time:2017-08-25 16:01:46'),
(54, '2017-08-24 22:31:46', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 18,status:accepted,time:2017-08-25 16:01:46'),
(55, '2017-08-24 22:31:47', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 17,status:accepted,time:2017-08-25 16:01:46'),
(56, '2017-08-24 22:32:30', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 24,status:accepted,time:2017-08-25 16:02:30'),
(57, '2017-08-27 16:21:00', 2, '1', 'Add Dealer', 'Dealer Added', 'Add', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer', 'Dealer id: 202'),
(58, '2017-08-27 16:21:59', 2, '1', 'Add Incentive', 'Incentive Added', 'Add', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive', 'Incentive id: 36'),
(59, '2017-08-27 16:24:27', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer/202', 'Dealer id: 202'),
(60, '2017-08-27 17:50:17', 202, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 25,status:dealer_approve,time:2017-08-28 11:20:17'),
(61, '2017-08-27 17:50:28', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 25,status:accepted,time:2017-08-28 11:20:28'),
(62, '2017-08-27 17:57:57', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive/35', 'Incentive id: 35'),
(63, '2017-08-27 18:01:23', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive/35', 'Incentive id: 35'),
(64, '2017-08-28 14:52:09', 2, '1', 'Add Dealer', 'Dealer Added', 'Add', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer', 'Dealer id: 203'),
(65, '2017-08-28 14:56:23', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive/36', 'Incentive id: 36'),
(66, '2017-08-28 15:21:36', 203, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Opera | 47.0.2631.55', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36 OPR/47.0.2631.55', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 26,status:dealer_approve,time:2017-08-29 08:51:36'),
(67, '2017-08-28 15:22:57', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 26,status:accepted,time:2017-08-29 08:52:57'),
(68, '2017-08-28 15:25:05', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive/36', 'Incentive id: 36'),
(69, '2017-08-28 15:26:31', 2, '1', 'Add Incentive', 'Incentive Added', 'Add', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive', 'Incentive id: 37'),
(70, '2017-08-28 15:27:20', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '219.92.20.214', 'Chrome | 60.0.3112.101', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive/37', 'Incentive id: 37'),
(71, '2017-08-28 15:41:26', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(72, '2017-08-28 15:43:22', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(73, '2017-08-28 15:44:55', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(74, '2017-08-28 15:48:01', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(75, '2017-08-28 15:48:58', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(76, '2017-08-28 15:49:14', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(77, '2017-08-28 15:49:32', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/36', 'Incentive id: 36'),
(78, '2017-08-28 15:50:02', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/36', 'Incentive id: 36'),
(79, '2017-08-28 15:51:17', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/36', 'Incentive id: 36'),
(80, '2017-08-28 15:51:21', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/36', 'Incentive id: 36'),
(81, '2017-08-28 15:52:34', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/36', 'Incentive id: 36'),
(82, '2017-08-28 15:53:09', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(83, '2017-08-28 15:55:20', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/36', 'Incentive id: 36'),
(84, '2017-08-28 15:55:41', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/admin/add_incentive/35', 'Incentive id: 35'),
(85, '2017-08-28 16:48:37', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '202.166.198.151', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_incentive/37', 'Incentive id: 37'),
(86, '2017-08-28 17:02:20', 195, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://localhost/lglive/dealer/staff_management', 'Member id: 204'),
(87, '2017-08-28 17:02:46', 199, '4', 'Approve Staff by Admin ', 'Staff Management(staff approve)', 'Approve', '202.166.198.151', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/staff_management', 'Member id: 204'),
(88, '2017-08-28 17:17:47', 199, '4', 'Edit Incentive', 'Incentive Edited', 'Edit', '202.166.198.151', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_incentive/34', 'Incentive id: 34'),
(89, '2017-08-28 17:44:30', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '202.166.198.151', 'Chrome | 60.0.3112.90', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_incentive/34', 'Incentive id: 34'),
(90, '2017-08-28 20:59:08', 198, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '219.92.23.152', 'Safari | 602.1', 'iOS', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_2 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) CriOS/60.0.3112.89 Mobile/14F89 Safari/602.1', 'http://lgmrewards.com/dealer/staff_management/pending', 'mobile:Apple iPhoneMember id: 205'),
(91, '2017-09-03 22:56:19', 2, '1', 'Add Dealer', 'Dealer Added', 'Add', '171.97.125.165', 'Chrome | 60.0.3112.113', 'Mac OS X', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://www.lgmrewards.com/admin/add_dealer', 'Dealer id: 208'),
(92, '2017-09-03 23:02:11', 2, '1', 'Add Dealer', 'Dealer Added', 'Add', '171.97.125.165', 'Chrome | 60.0.3112.113', 'Mac OS X', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://www.lgmrewards.com/admin/add_dealer', 'Dealer id: 209'),
(93, '2017-09-05 15:38:39', 2, '1', 'Add Incentive', 'Incentive Added', 'Add', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive', 'Incentive id: 38'),
(94, '2017-09-05 15:39:58', 195, '3', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.155.251', 'Spartan | 13.10586', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 'http://lgmrewards.com/dealer/approve_sales_report', ' sales report id: 28,status:dealer_approve,time:2017-09-06 09:09:58'),
(95, '2017-09-05 15:42:42', 2, '1', 'Update Sales Report status', ' Sales Report Management', 'update status', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/admin/sales_report', ' sales report id: 28,status:accepted,time:2017-09-06 09:12:42'),
(96, '2017-09-05 17:01:52', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '203.247.149.151', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer/209', 'Dealer id: 209'),
(97, '2017-09-05 17:42:27', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '203.247.149.151', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/admin/add_dealer/209', 'Dealer id: 209'),
(98, '2017-09-05 18:43:50', 209, '3', 'Reject Member', 'Staff Management', 'Reject', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 214;staffstatus=>2'),
(99, '2017-09-06 16:17:18', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '202.166.198.151', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_dealer/209', 'Outlet id: 12'),
(100, '2017-09-06 16:17:32', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '202.166.198.151', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_dealer/209', 'Outlet id: 18'),
(101, '2017-09-06 16:20:02', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '64.233.173.10', 'Chrome | 60.0.3112.107', 'Android', 'Mozilla/5.0 (Linux; Android 6.0.1; ONE A2003 Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.107 Mobile Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_dealer/209', 'mobile:AndroidOutlet id: 17'),
(102, '2017-09-06 16:30:32', 2, '1', 'Edit Incentive', 'Incentive Edited', 'Edit', '127.0.0.1', 'Firefox | 47.0', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 'http://localhost/lglive/admin/add_incentive/34', 'Incentive id: 34'),
(103, '2017-09-06 17:23:48', 209, '3', 'Reject Member', 'Staff Management', 'Reject', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 217;staffstatus=>2'),
(104, '2017-09-06 17:59:31', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '::1', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://localhost/lglive/admin/add_dealer/208', 'Outlet id: 10'),
(105, '2017-09-10 14:43:53', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '219.92.20.243', 'Opera | 30.0.1856.95530', 'Android', 'Mozilla/5.0 (Linux; Android 4.4.2; HM NOTE 1W Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.78 Mobile Safari/537.36 OPR/30.0.1856.95530', 'http://lgmrewards.com/admin/add_dealer/202', 'mobile:AndroidOutlet id: 5'),
(106, '2017-09-10 21:26:49', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '219.92.20.243', 'Chrome | 60.0.3112.113', 'Mac OS X', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://www.lgmrewards.com/admin/add_dealer/209', 'Dealer id: 209'),
(107, '2017-09-10 21:37:21', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '219.92.20.243', 'Chrome | 60.0.3112.113', 'Mac OS X', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://www.lgmrewards.com/admin/add_dealer/209', 'Dealer id: 209'),
(108, '2017-09-11 17:10:31', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '192.168.0.103', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://192.168.0.129/lglive/admin/add_dealer/209', 'Dealer id: 209'),
(109, '2017-09-11 17:12:07', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '192.168.0.103', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://192.168.0.129/lglive/admin/add_dealer/209', 'Dealer id: 209'),
(110, '2017-09-11 18:28:35', 2, '1', 'Add Incentive', 'Incentive Added', 'Add', '203.247.149.151', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/admin/add_incentive', 'Incentive id: 39'),
(111, '2017-09-11 19:59:55', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 231'),
(112, '2017-09-11 20:00:25', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 230'),
(113, '2017-09-11 20:00:38', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 228'),
(114, '2017-09-11 20:00:45', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 227'),
(115, '2017-09-11 20:00:57', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 226'),
(116, '2017-09-11 20:01:13', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 225'),
(117, '2017-09-11 20:01:34', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 224'),
(118, '2017-09-11 20:01:43', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 223'),
(119, '2017-09-11 20:01:55', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 211'),
(120, '2017-09-11 20:03:19', 209, '3', 'Reject Member', 'Staff Management', 'Reject', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 222;staffstatus=>2'),
(121, '2017-09-11 20:03:42', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 221'),
(122, '2017-09-11 20:03:52', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 220'),
(123, '2017-09-11 20:04:00', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 219'),
(124, '2017-09-11 20:04:09', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 218'),
(125, '2017-09-11 20:04:15', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 216'),
(126, '2017-09-11 20:04:26', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 215'),
(127, '2017-09-11 20:04:34', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 213'),
(128, '2017-09-11 20:06:32', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management/pending', 'Member id: 232'),
(129, '2017-09-11 20:22:34', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '64.233.173.8', 'Chrome | 60.0.3112.116', 'Android', 'Mozilla/5.0 (Linux; Android 7.1.1; ONEPLUS A3003 Build/NMF26F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.116 Mobile Safari/537.36', 'http://nepaimpressions.com/dev/lginc/admin/add_dealer/209', 'mobile:AndroidOutlet id: 22'),
(130, '2017-09-11 22:29:41', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '219.92.20.243', 'Safari | 602.1', 'iOS', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1', 'http://lgmrewards.com/admin/add_dealer/202', 'mobile:Apple iPhoneDealer id: 202'),
(131, '2017-09-11 22:30:03', 2, '1', 'Delete Outlet', 'Outlet Management', 'Delete', '219.92.20.243', 'Safari | 602.1', 'iOS', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1', 'http://lgmrewards.com/admin/add_dealer/202', 'mobile:Apple iPhoneOutlet id: 23'),
(132, '2017-09-11 22:30:10', 2, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '219.92.20.243', 'Safari | 602.1', 'iOS', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1', 'http://lgmrewards.com/admin/add_dealer/202', 'mobile:Apple iPhoneDealer id: 202'),
(133, '2017-09-12 14:53:02', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 233'),
(134, '2017-09-12 14:53:10', 209, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '118.200.155.251', 'Chrome | 60.0.3112.113', 'Windows 7', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'http://lgmrewards.com/dealer/staff_management', 'Member id: 234'),
(135, '2018-04-29 01:46:39', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff/2', 'Dealer id: 2'),
(136, '2018-04-29 03:18:02', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff/2', 'Dealer id: 2'),
(137, '2018-04-29 03:18:55', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff/2', 'Dealer id: 2'),
(138, '2018-04-29 04:36:43', 1, '1', 'Add Dealer', 'Dealer Added', 'Add', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff', 'Dealer id: 45');
INSERT INTO `log_admin_activity` (`log_id`, `log_time`, `log_user_id`, `log_user_type`, `module_name`, `module_desc`, `log_action`, `log_ip`, `log_browser`, `log_platform`, `log_agent`, `log_referrer`, `log_extra_info`) VALUES
(139, '2018-04-29 05:08:41', 1, '1', 'Add Dealer', 'Dealer Added', 'Add', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff', 'Dealer id: 46'),
(140, '2018-04-29 14:11:02', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff/46', 'Dealer id: 46'),
(141, '2018-04-29 14:11:12', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff/45', 'Dealer id: 45'),
(142, '2018-05-01 14:24:26', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/add_staff/46', 'Dealer id: 46'),
(143, '2018-05-07 17:36:13', 2, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/staff/student_management/pending', 'Member id: 51'),
(144, '2018-05-07 17:37:31', 2, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/staff/student_management/pending', 'Member id: 52'),
(145, '2018-05-08 00:49:26', 2, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/staff/student_management/pending', 'Member id: 48'),
(146, '2018-05-08 00:50:27', 2, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/staff/student_management/pending', 'Member id: 51'),
(147, '2018-05-08 00:56:19', 2, '3', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/staff/student_management/pending', 'Member id: 48'),
(148, '2018-05-08 15:04:18', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin//add_staff/46', 'Dealer id: 46'),
(149, '2018-05-14 01:25:55', 1, '1', 'Edit Dealer', 'Dealer Edited', 'Edit', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin//add_staff/46', 'Dealer id: 46'),
(150, '2018-05-15 01:34:45', 1, '1', 'Approve Staff by dealer ', 'Staff Management(staff approve)', 'Approve', '::1', 'Chrome | 58.0.3029.110', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 'http://localhost/lglive/admin/student_management/pendingadmin', 'Member id: 52'),
(151, '2018-09-05 15:29:18', 1, '1', 'Delete Member', 'Member Management', 'Delete', '::1', 'Chrome | 68.0.3440.106', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'http://localhost/ldc/admin/member_management', 'Member id: 53'),
(152, '2018-09-05 16:23:52', 1, '1', 'Delete Member', 'Member Management', 'Delete', '::1', 'Chrome | 68.0.3440.106', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'http://localhost/ldc/admin/member_management', 'Member id: 57'),
(153, '2018-09-17 00:22:15', 1, '1', 'Delete Member', 'Member Management', 'Delete', '::1', 'Chrome | 68.0.3440.106', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'http://localhost/ldc/admin/dashboard', 'Member id: 58');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` varchar(260) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email` varchar(260) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` enum('1','2','3','4','5','6','7') COLLATE utf8_unicode_ci NOT NULL DEFAULT '3' COMMENT '1=Super Admin, 2=Admin, 3=Manager, 4=customer,5=Cook,6=helper,7=others''',
  `reg_date` timestamp NULL DEFAULT NULL,
  `last_login_date` timestamp NULL DEFAULT NULL,
  `last_modify_date` timestamp NULL DEFAULT NULL,
  `reg_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '::1',
  `last_login_ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_login` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `status` enum('1','2','3','4','5','6') COLLATE utf8_unicode_ci NOT NULL COMMENT '1=Active or Verified, 2=Inactive or unverified, 3=Suspended, 4=Deleted, 5=rejected by dealer,6=rejected by admin',
  `mem_last_activated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activation_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgot_password_code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgot_password_code_expire` datetime DEFAULT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1->requested,0->request complete',
  `fat_rate` float DEFAULT NULL,
  `snf_rate` float DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `tc_rate` float NOT NULL DEFAULT '0',
  `commission` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `new_email`, `username`, `password`, `salt`, `user_type`, `reg_date`, `last_login_date`, `last_modify_date`, `reg_ip`, `last_login_ip`, `is_login`, `status`, `mem_last_activated`, `activation_code`, `forgot_password_code`, `forgot_password_code_expire`, `address`, `customer_name`, `phone`, `fat_rate`, `snf_rate`, `join_date`, `tc_rate`, `commission`) VALUES
(1, 'admin@gmail.com', '', 'admin', 'ffc643521d4bf396f0f32f2afb76bf1fc0b247a9', '2922cbefaa', '1', '2018-04-10 02:15:00', '2018-10-11 08:34:42', '2018-04-16 22:15:00', ':1', '::1', '0', '1', '2018-10-11 08:38:04', '', '', '2018-04-25 03:00:00', '8000', NULL, '0', NULL, NULL, '2018-04-17', 0, 0),
(2, 'mekhylsunar@gmail.com', '', 'mekhyl', '2809a2a92d84e87e2fa10e75ccb995980f0f20ac', '1e600803b0', '3', '2018-04-19 18:15:00', '2018-05-13 15:15:59', '2018-04-29 03:18:55', '::1', '::1', '0', '1', '2018-05-13 15:25:22', '', '0', '2018-09-02 00:00:00', '9000', NULL, '0', NULL, NULL, '2018-04-24', 0, 0),
(45, 'saagarchapagain@gmail.com', NULL, 'sagar.ch', '4b6f6a56a2bb0d3618b808a4947b621eb8e4967a', '22eb616bb1', '3', '2018-04-29 04:36:43', NULL, '2018-04-29 14:11:12', '::1', NULL, '0', '2', '2018-05-06 00:15:28', NULL, NULL, NULL, '9000', NULL, '0', NULL, NULL, '2018-04-13', 0, 0),
(46, 'nirajanjbh@gmail.com', NULL, 'nirajan.jbh', 'ef28e41e759e1df4c69c6adfe6d4e0da0f81b966', '88f940007d', '6', '2018-04-29 05:08:41', NULL, '2018-05-14 01:25:55', '::1', NULL, '0', '2', '2018-05-14 01:25:55', NULL, NULL, NULL, '9000', NULL, '0', NULL, NULL, '2018-04-26', 0, 0),
(48, 'ganesh.aryal2003@gmail.com', NULL, 'ganesh.aryal', '660318a50aad424fd3a8165a5839726f2e47c339', 'dc686e2e40', '4', '2018-04-29 08:52:19', NULL, '2018-05-08 00:56:19', '::1', NULL, '0', '', '2018-05-08 00:56:19', NULL, NULL, NULL, '1000', NULL, '0', NULL, 1000, '2018-04-27', 1000, 0),
(51, 'ramkoirala@gmail.com', NULL, 'Ram.koirala', '9c6e07ed88e9d5bf49e7a1d66188696fd4030411', 'cb15069684', '4', '2018-04-29 08:59:24', NULL, '2018-05-08 00:50:26', '::1', NULL, '0', '2', '2018-05-09 16:35:12', NULL, NULL, NULL, '1000', NULL, '0', NULL, 1000, '2018-04-27', 1000, 0),
(52, 'check@gmail.com', NULL, 'check.check', '73f2e58c25406de950e50490b80c784e1eb192ca', 'c832c4a412', '4', '2018-04-29 09:00:34', NULL, '2018-05-15 01:34:45', '::1', NULL, '0', '2', '2018-05-15 01:34:45', NULL, NULL, NULL, '199', NULL, '0', NULL, 100, '2018-04-25', 1000, 0),
(53, 'check@check.com', NULL, 'check.check', '9a0faf6bceff7a0ad7b8affc01a45105437f7fba', '36d2168645', '4', '2018-04-29 09:03:28', NULL, '2018-05-07 17:32:12', '::1', NULL, '0', '', '2018-09-05 15:29:17', NULL, NULL, NULL, 'New york , USA', 'Ramesh budhawothi', '9841121522', 50, 1, '2018-04-27', 10, 0),
(54, '', NULL, '', 'cdf7a2d07420410d0935e0728e3450ddb9a744d0', 'd45814d278', '4', '2018-04-29 14:05:05', NULL, NULL, '::1', NULL, '0', '', '2018-05-07 16:43:05', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, 0, 0),
(55, '', NULL, '', '', '', '4', NULL, NULL, NULL, '', NULL, '0', '1', '2018-09-17 00:21:57', NULL, NULL, NULL, 'Kathamndau Nepal', 'sagarchapagain', '32423423', 98, 12, '2018-09-05', 18, 2),
(56, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, '::1', NULL, '0', '1', '2018-09-15 08:24:57', NULL, NULL, NULL, 'Saina Maina Nagarpalika', 'Ram Dairy Pvt.Ltd', '9812312312', 4.83, 2.63, '2018-09-05', 0.32, 1),
(57, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, '::1', NULL, '0', '', '2018-09-05 16:23:52', NULL, NULL, NULL, 'KAthamndau', 'check', '23423423423', 2439, 2342, '2018-09-05', 2344, 2342),
(58, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, '::1', NULL, '0', '', '2018-09-17 00:22:15', NULL, NULL, NULL, 'Kathmand', 'Sujal Dairy Pvt. LTd', '9841213123', 2.3, 2.2, '2018-09-15', 12.2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members2`
--

CREATE TABLE `members2` (
  `id` int(11) NOT NULL,
  `email` varbinary(260) NOT NULL,
  `new_email` varbinary(260) NOT NULL,
  `username` varbinary(100) NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '3' COMMENT '1=Super Admin, 2=Admin, 3=Dealer, 4=Staff',
  `reg_date` timestamp NULL DEFAULT NULL,
  `last_login_date` timestamp NULL DEFAULT NULL,
  `last_modify_date` timestamp NULL DEFAULT NULL,
  `reg_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_login_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_login` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `status` enum('1','2','3','4','0','5','6') COLLATE utf8_unicode_ci NOT NULL COMMENT '0=accepted by dealer,1=Active or Verified, 2=Inactive or unverified, 3=Suspended, 4=Deleted, 5=rejected by dealer,6=rejected by admin',
  `mem_last_activated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activation_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `forgot_password_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `forgot_password_code_expire` datetime NOT NULL,
  `NRIC` varbinary(200) DEFAULT NULL,
  `room_charge` int(11) DEFAULT NULL,
  `display_name` varbinary(100) DEFAULT NULL,
  `edit_approve_status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '1->requested,0->request complete',
  `receipt_no` int(11) DEFAULT NULL,
  `room_no` int(11) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `admission_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members2`
--

INSERT INTO `members2` (`id`, `email`, `new_email`, `username`, `password`, `salt`, `user_type`, `reg_date`, `last_login_date`, `last_modify_date`, `reg_ip`, `last_login_ip`, `is_login`, `status`, `mem_last_activated`, `activation_code`, `forgot_password_code`, `forgot_password_code_expire`, `NRIC`, `room_charge`, `display_name`, `edit_approve_status`, `receipt_no`, `room_no`, `join_date`, `admission_charge`) VALUES
(2, 0x0bf56a520b38b3f2cad76f079f2ec2dcebba14bc3df696298e3c19bdec787bb1, '', 0x36ca58cc75122cdb00895daea915e437, 'a50ab15c057150088048150b0b40f98595eda1de', 'ba686a3a23', '1', '0000-00-00 00:00:00', '2018-04-25 16:14:32', '0000-00-00 00:00:00', '', '::1', '0', '1', '2018-04-25 16:38:28', '', '', '0000-00-00 00:00:00', '', NULL, '', '0', NULL, NULL, NULL, 0),
(195, 0x14f457e4208f2196629d210fdfabe90d39b9abb335e43a037c476eae8af1530f, '', 0x1aea3ea88a5cce3b25296f3f4cb175f9, '75a2eae639bdaae3055ec07aa8dd60d6267378dd', '50b6679fb8', '3', '2017-08-24 06:24:14', '2017-09-07 09:47:52', NULL, '118.200.218.193', '202.166.198.151', '0', '1', '2017-09-06 22:03:44', '', '', '0000-00-00 00:00:00', NULL, NULL, 0xf978b963954d732066ff416a9c6d6ba3, '0', 1, NULL, NULL, 0),
(196, 0xf1f0302664fc1ea127f5e9dd5c96c9aa338de54b1f32c87e18d616db487bf7c2, '', 0x9cc1ef1dca58f0579e01c0252608e5ab, '955d9a3b786c7d5f7adaf1e274f51d8bd7bff46e', '3e2406a5a3', '4', '2017-08-24 06:47:39', '2017-09-06 03:04:13', NULL, '183.90.36.58', '183.90.36.214', '0', '1', '2017-09-05 15:22:19', '', '', '0000-00-00 00:00:00', 0x340a2163fc763538db01dbb8ab9d05da, 195, 0xb41f2db9bb51e3985afeeeea57a1b993, '0', NULL, 1, NULL, 0),
(197, 0x3f62aefa004e0c0a1e4ec5d401abe08e289ed5675edb4b585cfdd176cd5228af, '', 0xbd69ac3dbbb4d0f14f7e5fe69626a571, '0f5c36e9adb8c7409b1d20bee6cb8c42f5878573', 'e3a942be70', '4', '2017-08-24 06:49:24', '2017-08-24 06:55:44', NULL, '203.247.149.151', '203.247.149.151', '0', '1', '2017-08-23 19:13:52', '', '', '0000-00-00 00:00:00', 0x4e181aecd3e15055e821917935d56fc1, 195, 0x94a4bc76419dbec8625a9101a323f8ac, '0', NULL, 1, NULL, 0),
(198, 0x844b9e31b1ffba72500c92d81b23df648a50177921cddeeebccf391443adc09a, '', 0x777075975ed0b7047b2811bbcc8fb342, '374f9b0307d8f43cbc2ad70714542de48f810197', 'd3f86d0f9f', '3', '2017-08-25 09:13:08', '2017-09-11 03:25:25', NULL, '219.92.20.214', '219.92.20.243', '0', '1', '2017-09-10 15:44:32', '', '', '0000-00-00 00:00:00', NULL, NULL, 0x5d2cb1377a906f5bb84b0617bf2c472c, '0', 4, NULL, NULL, 0),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, '', 0xb4a1f653c4662a07b3fd39961ca619b9, 'd455824b8d2670cb34edb4622caa7665f88ded90', 'ba22048e74', '4', '2017-08-25 09:16:31', '2017-09-12 09:48:58', '2017-08-30 07:45:17', '219.92.20.214', '202.79.37.78', '0', '1', '2017-09-11 22:08:18', '', '', '0000-00-00 00:00:00', 0x32f7438293e8903eb53a076421617c68, 203, 0x9f33bccb6433f4a172709e6a70e7d63c, '0', NULL, 6, NULL, 0),
(200, 0xac057fbcfa7864cdc56ea6145d9640c4cea2fa8ccf6bec1932c5ef171e084711, '', 0x77ec9a4ee42a6425e4c363c496acc9b4, 'd4c3978b02fb0ea13dbf826a40a79d42806fb9f2', 'a600241c83', '4', '2017-08-25 09:38:29', '2017-08-30 08:06:28', NULL, '219.92.20.214', '219.92.23.152', '0', '1', '2017-08-29 20:23:18', '', '', '0000-00-00 00:00:00', 0xda169929407dd2284214ed220ee628ad, 198, 0x91ab25e6e9d1ca9ab9858ecaa2d69789, '0', NULL, 3, NULL, 0),
(201, 0x1f5415c77222390d4fa0260b389ccda3833eb552592fe3f7753c07cdfb80bb69, '', 0xf1c55676b5069ab94f87b964b6d40e8a, '2309cbfbbef68dddeeb73fbeadc7f4964df98273', '72b49460f4', '4', '2017-08-25 09:39:52', '2017-08-25 10:21:23', NULL, '219.92.20.214', '219.92.20.214', '0', '1', '2017-08-24 22:36:27', '', '', '0000-00-00 00:00:00', 0x92ba4dfda5ca1dac307911ebe2b89e71, 198, 0xb547cc80c6452686794e72fe84a840c8, '0', NULL, 3, NULL, 0),
(202, 0xa9dcf9958a238fc78bb7ef30a7b050a6599980eb9dc42a091608333646aae994, '', 0xb123439399d74d69e515340efe899c81, '0e22727c40a890400b1f218f4a74c50dc97b13a3', '6c27f4c86c', '3', '2017-08-28 04:06:00', '2017-09-11 03:23:43', '2017-09-12 10:15:10', '219.92.20.214', '219.92.20.243', '0', '1', '2017-09-11 22:30:10', '', '', '0000-00-00 00:00:00', NULL, NULL, 0x04cc34051043975a1f0cd4401c8b31a0, '0', 4, NULL, NULL, 0),
(203, 0xcf183cd4e1b7bf0a3d3fe6e06ce7d24bed2390417be7cdd6238a4acb494309da, '', 0x15a9a3fcd54d4aca011db38989777cf8, 'cd6e84dcbd3db05e14d31c3df55aa3180f846348', '83496ddca8', '3', '2017-08-29 02:37:09', '2017-09-05 03:52:11', NULL, '219.92.20.214', '219.92.21.56', '0', '1', '2017-09-04 16:11:34', '', '', '0000-00-00 00:00:00', NULL, NULL, 0x5e333be7a01ae614b67d7b0fc64738c2, '0', 4, NULL, NULL, 0),
(204, 0xe7b4fcd874f29e8bf92e419a3dd24516c92392ad1ecd505d2709f1a8a1657d38, '', 0x4388ac4bd17c75dd3d558c325d836b1a, '920ec7231bab9d6629b407a2298f3834c25d3edc', '0e9115aa65', '4', '2017-08-29 04:39:15', '2017-08-31 04:44:27', '2017-08-31 04:51:18', '::1', '127.0.0.1', '0', '1', '2017-08-30 17:06:18', '', '', '0000-00-00 00:00:00', 0xdb80497cb8424d75d14035298ccf1ce8, 198, 0xd98763c314b283d8dc6e92762c86eb1c, '0', NULL, 3, NULL, 0),
(205, 0xbf28ec1203b5f9723a216a3f63c02ffe4417a9e930d049993279746949c79c4e, '', 0x4417a9e930d049993279746949c79c4e, '000b21b488caa63449ed0115431cc14b9a431907', 'a5690f2fe0', '4', '2017-08-29 08:39:33', NULL, NULL, '219.92.23.152', '', '0', '0', '2017-08-28 20:59:08', '', '', '0000-00-00 00:00:00', 0x90294fbe195ea2dca4302a40e156cc56, 198, 0x4541ae0900ee4edf6423cb5cc701f6df, '0', NULL, 3, NULL, 0),
(206, 0x5102c0a93dd10e241621f5c0c9daec59dace29b3c182f7e386ace2e7b946aae4, '', 0xdd97a3720ff2fc5c8b91ff51c50808ab, 'b5ecf6570337e407a3ec69b52cc5658d0918d2d5', 'fda5f5efec', '4', '2017-08-30 08:28:26', NULL, NULL, '219.92.23.152', '', '0', '2', '2017-08-29 20:43:26', '', '', '0000-00-00 00:00:00', 0xd46dc78d0a4c1ea2bdf40af2a62c1c74, 198, 0xa76254f23250ce0a2f53e7246a571174, '0', NULL, 3, NULL, 0),
(207, 0x87e06b6f83563f0b21e6e5028392bc0e, '', 0x5c450d1e65ea2db04a7db73429bfdca0, '0003d9fad0cb8c5ddebc4db54a53392316f554ed', '136c859aa8', '4', '2017-08-31 05:09:42', NULL, NULL, '127.0.0.1', '', '0', '2', '2017-08-30 17:24:44', '', '', '0000-00-00 00:00:00', 0x634855fb4659af19e5fe28ff4cda5dea, 195, 0x5ab490bbe770aee8524d0b5c500ba96e, '0', NULL, 1, NULL, 0),
(208, 0xd3eb75afb56b86eeb5905698940a1bb56d7c2d3b490cdc7037da0f1c71dbe755, '', 0xed238385ab7515988e1fd0afdc8423fe, '77050f9fbec3254d6bcf2aed66387d27bd8918a7', '527d774160', '3', '2017-09-04 10:41:19', NULL, NULL, '171.97.125.165', '', '0', '1', '2017-09-03 22:56:19', '', '', '0000-00-00 00:00:00', NULL, NULL, 0x0a6a9e6d564a3b51f238c81ea78bc97177242805787a58fe792aa25004e92008, '0', 3, NULL, NULL, 0),
(209, 0xeb00e2fe8a506cd4adf8dfe88974ab199569dc0ee178b2afdbb96b79bd451d5c, '', 0x1ae123bfab02d6a0cbe281f6281386e8, '9e580f8370455fc097bd6b34749fbd2f88fe6a5c', '25326d1b15', '3', '2017-09-04 10:47:11', '2017-09-13 02:37:49', '2017-09-12 04:57:04', '171.97.125.165', '118.200.155.251', '0', '1', '2017-09-12 15:08:51', '', '', '0000-00-00 00:00:00', NULL, NULL, 0xbf2de9361e5c231e6cc83f5358c5c7ecd41b113093497ff9f1b73c482da18869, '0', 1, NULL, NULL, 0),
(210, 0x9905f9a00b6969153632a0a4c9ad303f52c783e7411a94cfb9e6d9fa85863e3e, '', 0x7e816aed80f56239b6b2580fb2acc45f, '384bdbde68d4460b0edb02a165d42d32792f77da', '2e2159b549', '4', '2017-09-05 03:56:30', NULL, NULL, '219.92.21.56', '', '0', '2', '2017-09-04 16:11:30', '', '', '0000-00-00 00:00:00', 0x78fa86d0cbc930d92e295b556dfa6353, 203, 0x5649ed871bcaa594791d06668bc1ae3d, '0', NULL, 6, NULL, 0),
(211, 0x1641ff16fa61f20399c10d9135967bc9e1070999d0b467e1b42b5238750ccee4, '', 0xfa7c6b6a11af324c8bdce58ffd86b3b2, '15788654e07c2433f3b978fd299f36699f1676f3', '19721474eb', '4', '2017-09-06 05:23:02', NULL, NULL, '121.7.227.109', '', '0', '0', '2017-09-11 20:01:55', '', '', '0000-00-00 00:00:00', 0xa71ecead893ba27167bcdf5c9115078d, 209, 0x810f56a9cf7d4d52bcdadbf877a53a32, '0', NULL, 18, NULL, 0),
(212, 0xb7c2c33af1376c0971a6e621fc7b4e06f4d6aacbe379b8ed4948326b6541ae4d, '', 0xd9967e833dec28abdd8f40e8f2b38021, 'f2c170fac0910781c557cd16dce944ebf5120e9c', '964ccc6920', '4', '2017-09-06 05:26:23', NULL, NULL, '118.200.45.200', '', '0', '2', '2017-09-05 17:41:23', '', '', '0000-00-00 00:00:00', 0xe2500102b198c911621f245e769057da, 209, 0xc5f63e043180a925af0aee37dc1be6a4, '0', NULL, 11, NULL, 0),
(213, 0x483c77301f2921b0c424b8d66380a7e94662f2e922f2b6d543cc96490eb6310a, '', 0xc3b320f28f9c612c7ecf6186300c6659, '0c7a53e931a937c8ebee41d46cb33bf0b4ce2dcc', 'a47ab1b1a3', '4', '2017-09-06 05:46:30', NULL, NULL, '219.75.89.240', '', '0', '0', '2017-09-11 20:04:34', '', '', '0000-00-00 00:00:00', 0x22ae6fea835d5eba602cbd65400be879, 209, 0x2a45695be5ceac1536263ec7897bb4ea, '0', NULL, 17, NULL, 0),
(214, 0x3189fa849885b6c947ad064c416d0d487a77b20e4481481b4081b9debe08955f, '', 0xa606207a67492f3e689ac13bb6b429f6, '487ec3fa8e2ac92b8f9603245edce307382e9d8e', '94b5259761', '4', '2017-09-06 06:05:20', NULL, NULL, '118.200.126.66', '', '0', '5', '2017-09-05 18:43:50', '', '', '0000-00-00 00:00:00', 0xb9c9c1277392800ec7685a9f1a0f1a5b, 209, 0xf27b908988659fc0900f749c841e03f6, '0', NULL, 12, NULL, 0),
(215, 0xb526a082587c835a0ee994da818843d87520e974ed82caad3cc97609098b2b0a, '', 0x4b7c98d6a96428f5add48d3561b2c397, '20e46d0f2063a22c6f405be10c8a42e0bb803ac5', '574b6cc2bc', '4', '2017-09-06 06:11:36', NULL, NULL, '118.200.7.195', '', '0', '0', '2017-09-11 20:04:26', '', '', '0000-00-00 00:00:00', 0xa4407fb57020d3fe260163eff88c0af0, 209, 0x0bdcdb5b5049c10b8c41e1189e3aed2a, '0', NULL, 16, NULL, 0),
(216, 0x3492ec97cd4bd57a62fd66505c517801e5204b323e4b6267f5a6b08a9d07c2ae, '', 0x2b8ae6ae579d9ef87af9bb667ce8e8c6, '4297441538ec7e7f5f56b65e5872c92d186627bb', '300a6f74c8', '4', '2017-09-06 07:49:44', NULL, NULL, '118.200.45.200', '', '0', '0', '2017-09-11 20:04:15', '', '', '0000-00-00 00:00:00', 0x1bde48ffcf245d6647611f94f561bc8d, 209, 0xac42fc94daece60d93f443b428333f48, '0', NULL, 11, NULL, 0),
(217, 0x259ae161f7e658b1176fe9069f06322d03776822b290729bdd2b181917dcc072, '', 0xd5fb094738a18d38ef9bb3a1dbd912ae, '0ea0fa36b97d5318c0b00f5731de64a864c20272', 'a6c5098c5a', '4', '2017-09-07 03:14:29', NULL, NULL, '111.65.56.183', '', '0', '5', '2017-09-06 17:23:48', '', '', '0000-00-00 00:00:00', 0xc0f734f17ede6a752b6eadb8ac01f5a2, 209, 0x96a91172f6b5afb89f3c4ecb8c94b412, '0', NULL, 11, NULL, 0),
(218, 0x9638296ca4e87fe5038ec621477f2b1e34971c87cfafb52a7473dc444a365aeb, '', 0x4726d924c479dd9de43a4931199ffd57, '731cecf999f1b8202cda46aa46c1059cf674e69a', '81e3e7920b', '4', '2017-09-07 03:15:42', NULL, NULL, '111.65.56.183', '', '0', '0', '2017-09-11 20:04:09', '', '', '0000-00-00 00:00:00', 0x58ee8206732dc3bc93111a7f2e75162f, 209, 0x45a73cffec0dba1c8e859ff058f08df8, '0', NULL, 11, NULL, 0),
(219, 0x8cb83d4cb1af498fb4668e7eb454bef2beea5d5d68d0ac3e186ba59f2122549a, '', 0xe8357bcc6dea7ce9f04576994eb61c4e, '7a95086ebaeaf85838931b38c45e25436974922b', '8ef839ee95', '4', '2017-09-07 05:13:59', NULL, NULL, '111.65.45.10', '', '0', '0', '2017-09-11 20:04:00', '', '', '0000-00-00 00:00:00', 0xae8910a0643635577f18deaa92534027, 209, 0x86c4e9b31c2ecde3b4e0eebc82310bcb, '0', NULL, 11, NULL, 0),
(220, 0x8349828c3e5ac9eb4c169589cdfc3ffc4af0c3ed67979dcfa9cf9233bfc42534, '', 0x3b500ba47ec67d977ed52274b0ca1a0d, '4ae9071cb48f75d281892c824527a583d7cc0742', '65ab78dc1b', '4', '2017-09-07 07:16:45', NULL, NULL, '118.200.45.200', '', '0', '0', '2017-09-11 20:03:52', '', '', '0000-00-00 00:00:00', 0x8cafb1a0724e61b19937f14f8de8fced, 209, 0xd07e1e28a0bb5af43e834a33b9989950, '0', NULL, 11, NULL, 0),
(221, 0x0f59a55210235c3c0694202426a92a34f9792fcc076d0fd8212ecf7ab66e40c5, '', 0xcabebe9e53ff7b0407c50ac0b9c1a41a, 'ec87ab482680918197e1823e4292e79261ba86cf', '88832eb832', '4', '2017-09-07 08:59:28', NULL, NULL, '118.200.168.10', '', '0', '0', '2017-09-11 20:03:42', '', '', '0000-00-00 00:00:00', 0x52a5310b9ef8f651dda994482f7ec2d4, 209, 0xf51d0198779343fc10e2268505735f66, '0', NULL, 14, NULL, 0),
(222, 0xef4a6932bc418d74aaf2ee0ca5796eb78df981e4bc943cdb1dd6dd5dbf663b7a, '', 0x17e1f8dd65703cc3043bc83e9839208d, 'c858bc367be80be5be8053cade56d83c16d6860a', '5cfce0fd53', '4', '2017-09-08 09:51:08', NULL, NULL, '118.200.132.19', '', '0', '5', '2017-09-11 20:03:19', '', '', '0000-00-00 00:00:00', 0x1acadeb8a1aa3098736386fc9f60ede1, 209, 0xb2212cba7b5a777dc6e3dd28cef5fe4d17e1f8dd65703cc3043bc83e9839208d, '0', NULL, 13, NULL, 0),
(223, 0x45a6f7810cc9b432544bc7e8e1f56c1f745801c3a0624a3b2a110b49c1a9b527, '', 0x343aabe123475721055c1acb656bbba3, '784cc1c641adf5c93a693e27023c7051c9abb48f', '05016193e5', '4', '2017-09-08 10:01:14', NULL, NULL, '118.200.36.180', '', '0', '0', '2017-09-11 20:01:43', '', '', '0000-00-00 00:00:00', 0x4e556fd4fa8ca0989fff50a2eff66a8d, 209, 0x18826e898471bf9eb4ced641a49b86b0, '0', NULL, 15, NULL, 0),
(224, 0x76d3ffeefe4a2803ad58656ca6647bb6c8e27a4ca8dc0638184988a39d9b1c05, '', 0x0b152df516a8808303042a46061ff02c, 'c92d9cb6f7216dfdea3e3b0ad68ce5e989432042', '4a70847816', '4', '2017-09-08 10:09:05', NULL, NULL, '118.200.36.180', '', '0', '0', '2017-09-11 20:01:34', '', '', '0000-00-00 00:00:00', 0x706f5f81c2b535d25f08ffd714262718, 209, 0xac0242de562d8facb9be464dcb28996f, '0', NULL, 15, NULL, 0),
(225, 0xce215db8f481cc820689256897e22fea52599b860c6c5c7121d24d589f9d78a6, '', 0xe46cccfc19dd2273e3164aa26ea372ec, 'd7c8244fbce8a3415ed8d08902f1c01e6bf83d7d', 'b34b2a2e08', '4', '2017-09-08 10:23:55', NULL, NULL, '118.200.132.19', '', '0', '0', '2017-09-11 20:01:13', '', '', '0000-00-00 00:00:00', 0x3db255b467098f8f7a60acd7c0e4d140, 209, 0x756bbea4be57ec1960045dfb1a6df6e2ab7cb519a09902f9c900e6681108c6f4, '0', NULL, 13, NULL, 0),
(226, 0x14fe93d960be2f8e6b12e841ba22b0d4464c9b06c04e9d36e7d106e6fe70e902, '', 0x2b694de4588a70315c153cd9cfe4e738, '168602b4597dccb001ddab9afe6eea0725e96350', '8beb5a15a6', '4', '2017-09-09 02:31:33', NULL, NULL, '118.200.225.28', '', '0', '0', '2017-09-11 20:00:57', '', '', '0000-00-00 00:00:00', 0x821e23309fb23fe23870fa8eaa0f4679, 209, 0xd05b354775cf8ad4f1bdfbd1158e8bfa, '0', NULL, 13, NULL, 0),
(227, 0xe13c3980a917bbf329365dcd3548d40b4202100eca02194a4b1437f71420b593, '', 0xf6628847c906edff52b845af352cbdee, '114e4a68eb54605257366e65a4d16f4b8684fe32', '5e9cbbe041', '4', '2017-09-09 03:19:56', NULL, NULL, '118.200.36.180', '', '0', '0', '2017-09-11 20:00:45', '', '', '0000-00-00 00:00:00', 0x70d494cee987cb265d5c30962de5b700, 209, 0xc16907ada21a561002e362d16861110c, '0', NULL, 15, NULL, 0),
(228, 0xb06bdf496da3532e1010c59996797376aa25bd2880fe32e1fd6e10401a860921, '', 0xfda6787a8d94555c8511053787f9e742, '854d83ad45a0aae0ce0d24b8aa6837665f38be4c', '138472b681', '4', '2017-09-11 04:55:01', NULL, NULL, '118.200.45.200', '', '0', '0', '2017-09-11 20:00:38', '', '', '0000-00-00 00:00:00', 0x0179e24a81be9cf2f9de76d816951f0a, 209, 0xde9e228da38493750cf4bd1b643607f9, '0', NULL, 11, NULL, 0),
(229, 0x70572370c22aeeb4bc2f697e890ff221d8d9d97544b6293ff5dd8cf5450ee4e6, '', 0x117999caebe97e2828b73826049e0ba8, '0819be32391f373833f3a9eb9f886319ae047f84', '0a4be59a5e', '4', '2017-09-12 03:56:44', NULL, NULL, '118.200.126.66', '', '0', '2', '2017-09-11 16:11:44', '', '', '0000-00-00 00:00:00', 0x9170cb07850f82f1e3d02ae3ba237f54, 209, 0x8d678e37f6a17b7b91048dcfc730f07e, '0', NULL, 20, NULL, 0),
(230, 0x93ecde7b7999a312fa871607af10c9826cab4b3c24ce23179a7a89789ec0eef7, '', 0xf2366db40c54e4d5615e74e044a217e3, 'a7b2d1f42339f201cd203ebf806b4adaf634026a', '10e57f84dd', '4', '2017-09-12 04:00:19', NULL, NULL, '118.200.126.66', '', '0', '0', '2017-09-11 20:00:25', '', '', '0000-00-00 00:00:00', 0xc3bb15e7c785f71916494bae58165ccb, 209, 0xbf5465860934ba3395bbc610b6285807, '0', NULL, 13, NULL, 0),
(231, 0x48e84e28fd466b0cd6a07328e981b8ef8ab9e313789a7e0c2933d4bfc107a221, '', 0x3e033508631cf512ebeda383b5d3be13, '8d173ee62ca654861b3cf67246b122995a9ccd10', '5c176076fb', '4', '2017-09-12 04:51:59', NULL, NULL, '118.200.40.7', '', '0', '0', '2017-09-11 19:59:55', '', '', '0000-00-00 00:00:00', 0x24379ec7ea5ec68db5a3df9c97426b5b, 209, 0xd2707e0dcbd6b2c0fd956f4eb41384e1, '0', NULL, 21, NULL, 0),
(232, 0xca09a2f4e51cc3b68c71f3bbe1e7ddd78e64bf472af464d51c514a1ffc512085, '', 0x7ee383b01175903fefb05e71c6cd3c32, '36acbe77b7c0d61cfbe73c5dc371419416d813fd', '2236fbd8aa', '4', '2017-09-12 07:51:06', NULL, NULL, '118.200.132.19', '', '0', '0', '2017-09-11 20:06:32', '', '', '0000-00-00 00:00:00', 0x1d07d60ff440ea9957dcd807d8505110, 209, 0x8afd5e3a533bea8cbaeb8a38a48f69c17ee383b01175903fefb05e71c6cd3c32, '0', NULL, 14, NULL, 0),
(233, 0xd44b0d0e1623f8b9ab56b3dc67be49aa074cfa6c04eb14928c8283e3e0cc8038, '', 0xf0b2f13a812baf1d7f80e6ad6e2d10c9, '24283060cbf379dcf9804b1f5c41025a6d6f0d10', 'caec0d2e20', '4', '2017-09-12 13:15:29', NULL, NULL, '42.61.211.253', '', '0', '0', '2017-09-12 14:53:02', '', '', '0000-00-00 00:00:00', 0x55a6ade8549b2fa491a9571eb20b9b92, 209, 0xc99d8a9fa6a8389bf58f7018bd3409d6, '0', NULL, 15, NULL, 0),
(234, 0x51d01719d370ae1d530593ebb0d2b2f5e5bf0bd54e99f65b3cdae273fa0f9462, '', 0xb9ec19103ee65d7e746633fc837bec73, 'c51728dcdb99c00e5bab90bfe84c03c43f80d27b', 'b73fa84650', '4', '2017-09-12 13:30:07', NULL, NULL, '42.61.211.253', '', '0', '0', '2017-09-12 14:53:10', '', '', '0000-00-00 00:00:00', 0x97132e79d09a14342b893f8443f4cd19, 209, 0x15f0bc5c4b0ab98f7f6d5192c6f4728b, '0', NULL, 15, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members_details`
--

CREATE TABLE `members_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_contact` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_user` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identification_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identification_office` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `identification_doc` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('M','F','O') COLLATE utf8_unicode_ci NOT NULL COMMENT '''M->male,F->female'',O->Others',
  `dob` date DEFAULT NULL,
  `college_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faculty` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-','') COLLATE utf8_unicode_ci NOT NULL,
  `guardian_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_guardian_name_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relation_local_guardian` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties_handed` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medical_issue` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL,
  `medical_issue_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members_details`
--

INSERT INTO `members_details` (`id`, `user_id`, `first_name`, `last_name`, `paddress`, `address2`, `country`, `guardian_contact`, `phone`, `cover_image`, `about_user`, `mobile`, `identification_no`, `identification_office`, `identification_doc`, `gender`, `dob`, `college_name`, `faculty`, `father_name`, `mother_name`, `blood_group`, `guardian_phone`, `source`, `local_guardian_name_contact`, `relation_local_guardian`, `properties_handed`, `medical_issue`, `medical_issue_name`) VALUES
(3, 2, 'mekhyl', 'sunar', 'dailekh', NULL, 'nepal', NULL, NULL, NULL, NULL, '9841214222', '876t87', 'kls', '535e6aacd90f709511c5bdff8ec3bd2b.jpg', 'M', '2018-04-11', 'null', 'null', 'null', 'null', 'A-', 'null', 'null', 'null', '0', 'null', 'No', NULL),
(4, 45, 'sagar', 'chapagai', 'ktm nepal', NULL, NULL, NULL, NULL, NULL, NULL, '98412131', '238928', 'Rupendehi', NULL, 'M', '2018-04-27', NULL, NULL, NULL, NULL, 'B+', NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(5, 46, 'nirajan', 'adhikari', 'ktm nepal', NULL, NULL, NULL, NULL, NULL, NULL, '98412131', '238928', 'Rupendehi', NULL, 'M', '2018-04-25', NULL, NULL, NULL, NULL, 'A+', NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(6, 48, 'ganesh', 'aryal', 'ktm nepal', NULL, NULL, NULL, NULL, NULL, NULL, '9841214223', '238928', 'Rupendehi', '3a95858ec52f61ed886a95fc7edf12ad.jpg', 'F', '2018-04-25', 'dav', 'bachelor/ca', 'hari aryal', 'sita aryal', 'B+', NULL, 'G oogle/Google map', NULL, NULL, 'Chair,Table', 'No', ''),
(9, 51, 'Ram', 'koirala', 'ktm', NULL, NULL, NULL, NULL, NULL, NULL, '98412131', '1234566', 'Rupendehi', NULL, 'F', '2018-04-15', 'unique college', 'science', 'dilliram', 'tesarikumari', 'B+', NULL, 'Facebook', NULL, NULL, 'Chair', 'Yes', 'aasthama'),
(10, 52, 'check', 'check', 'check', NULL, NULL, NULL, NULL, NULL, NULL, '2398723', 'check', 'check', NULL, 'M', '2018-04-19', 'check', 'check', 'checks', 'checks', 'A+', NULL, 'Friends', NULL, NULL, 'Chair', 'Yes', 'check'),
(11, 53, 'check', 'check', 'checks', NULL, NULL, NULL, NULL, NULL, NULL, 'checks', 'check', '', NULL, 'M', '2018-04-17', 'check', 'check', 'checks', 'checks', 'AB+', NULL, 'G oogle/Google map', NULL, NULL, 'Chair', 'No', 'check'),
(12, 54, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, 'Advertisment', NULL, NULL, NULL, 'Yes', 'Cancer');

-- --------------------------------------------------------

--
-- Table structure for table `members_log`
--

CREATE TABLE `members_log` (
  `id` int(11) NOT NULL,
  `email` varbinary(260) NOT NULL,
  `first_name` varbinary(100) NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `NRIC` varbinary(30) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `display_name` varbinary(100) DEFAULT NULL,
  `address` varbinary(255) NOT NULL,
  `address2` varbinary(255) NOT NULL,
  `country` varbinary(200) NOT NULL,
  `postal_code` varbinary(200) NOT NULL,
  `phone` varbinary(200) NOT NULL,
  `about_user` varbinary(1000) NOT NULL,
  `gender` enum('M','F','O') COLLATE utf8_unicode_ci NOT NULL COMMENT 'M:male, F:femail,O:other',
  `dob` date NOT NULL,
  `cover_image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `outlet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members_log`
--

INSERT INTO `members_log` (`id`, `email`, `first_name`, `password`, `updated_date`, `NRIC`, `dealer_id`, `display_name`, `address`, `address2`, `country`, `postal_code`, `phone`, `about_user`, `gender`, `dob`, `cover_image`, `outlet_id`) VALUES
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-08-28 05:20:41', 0x32f7438293e8903eb53a076421617c68, 202, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', NULL),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-08-28 05:43:29', 0x32f7438293e8903eb53a076421617c68, 198, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', NULL),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-08-28 05:49:30', 0x32f7438293e8903eb53a076421617c68, 202, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', NULL),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-08-29 02:58:45', 0x32f7438293e8903eb53a076421617c68, 203, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', 6),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-08-29 03:02:38', 0x32f7438293e8903eb53a076421617c68, 203, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', 6),
(204, 0xe7b4fcd874f29e8bf92e419a3dd24516c92392ad1ecd505d2709f1a8a1657d38, 0xd98763c314b283d8dc6e92762c86eb1c, '', '2017-08-29 04:49:46', 0x95e3f4496e1c738606e4ef2ca4fc35a5, 198, 0xd98763c314b283d8dc6e92762c86eb1c, 0x3c775bd4e52061fdaca3eb33b6b5397b, 0xb833dc637ceaea2de9444d876ea464b3, 0x03d45635725ae09736078191bb9c3ed7, 0x92f3601ed1df406b26ce5d9b1e94a870, 0x67c4927fc8d1ca7510606e597529637c, 0x4388ac4bd17c75dd3d558c325d836b1a, 'M', '2017-08-25', '', 3),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-08-30 07:45:01', 0x32f7438293e8903eb53a076421617c68, 203, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', 6),
(204, 0xe7b4fcd874f29e8bf92e419a3dd24516c92392ad1ecd505d2709f1a8a1657d38, 0x2c53845d40a7788362dc630bef0e850d, '920ec7231bab9d6629b407a2298f3834c25d3edc', '2017-08-31 04:45:28', 0xdb80497cb8424d75d14035298ccf1ce8, 198, 0xd98763c314b283d8dc6e92762c86eb1c, 0x3c775bd4e52061fdaca3eb33b6b5397b, 0xb833dc637ceaea2de9444d876ea464b3, 0x03d45635725ae09736078191bb9c3ed7, 0x92f3601ed1df406b26ce5d9b1e94a870, 0x67c4927fc8d1ca7510606e597529637c, 0x4388ac4bd17c75dd3d558c325d836b1a, 'M', '2017-08-25', '', 3),
(199, 0xbd1f99d5a053d12653adaf497ed140d112f539374114bfd6b282c58843de04fa, 0x9f33bccb6433f4a172709e6a70e7d63c, '', '2017-09-05 05:31:22', 0x32f7438293e8903eb53a076421617c68, 198, 0x9f33bccb6433f4a172709e6a70e7d63c, 0x6d5f2c105e422bb24265fcb4716fa1ef, 0x9c2834113e3bc34a0df9c198e46f57ee, 0x897959cdd78d4f53e09adf7c81bcf7a1, 0x6e7d045d9fc8664741be636614abbceb, 0x33612265b4d83bd2febaa693c7330d83, 0xb4a1f653c4662a07b3fd39961ca619b9, 'F', '1991-11-11', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `model_name` varchar(250) NOT NULL,
  `display_name` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1->active ,0-->inactive',
  `imei8` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `model_name`, `display_name`, `created_date`, `update_date`, `status`, `imei8`) VALUES
(10, 'LGV20', 'LGV20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '35216308'),
(11, 'NMODEL', 'LGC', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '84514215'),
(12, 'LG Stylus 2 Plus', 'LG Stylus 2 Plus', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '35216308'),
(13, 'test model', 'test model', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '12345678'),
(14, 'LG G6', 'LG G6', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '35614508'),
(15, 'LG K10', 'LG K10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '35494908'),
(16, 'test modal', 'LGkk', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `id` int(11) NOT NULL,
  `milk` int(11) DEFAULT NULL,
  `fat` float DEFAULT NULL,
  `lacto` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tc_rate` float DEFAULT NULL,
  `fat_rate` float NOT NULL,
  `snf_rate` float DEFAULT NULL,
  `commission` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `invoice_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_report`
--

INSERT INTO `sales_report` (`id`, `milk`, `fat`, `lacto`, `user_id`, `tc_rate`, `fat_rate`, `snf_rate`, `commission`, `date`, `invoice_date`) VALUES
(5, 100, 12, 12, 55, 19, 98, 12, 2, '2018-09-14 06:50:40', '2075-05-14'),
(11, 481, 3.8, 23, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:10:27', '2074-04-16'),
(12, 401, 4.2, 20.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:11:02', '2074-04-18'),
(13, 400, 4.3, 22, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:11:36', '2074-04-21'),
(14, 400, 4.2, 21.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:12:49', '2074-04-23'),
(15, 520, 4.1, 18.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:14:04', '2074-04-25'),
(16, 400, 3.7, 22, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:14:45', '2074-04-28'),
(17, 460, 4.1, 20.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:15:36', '2074-04-30'),
(18, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(19, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(20, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(21, 100, 2.3, 5.3, 55, 19, 98, 1, 2, '2018-09-17 06:08:28', '2075-06-03'),
(22, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(23, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(24, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(25, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(26, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(27, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(28, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(29, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(30, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(31, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(32, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(33, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(34, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(35, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(36, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(37, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(38, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(39, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(40, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(41, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(42, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(43, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(44, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(45, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(46, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(47, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(48, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(49, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(50, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(51, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(52, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(53, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(54, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(55, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(56, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(57, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(58, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(59, 100, 2.3, 5.3, 55, 18, 98, 12, 2, '2018-09-17 06:08:28', '2075-06-03'),
(60, 100, 12, 12, 55, 19, 98, 12, 2, '2018-09-14 06:50:40', '2075-05-14'),
(61, 481, 3.8, 22, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:10:27', '2074-04-16'),
(62, 401, 4.1, 21.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:11:02', '2074-04-18'),
(63, 400, 4.3, 22, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:11:36', '2074-04-21'),
(64, 100, 12, 12, 55, 19, 98, 12, 2, '2018-09-14 06:50:40', '2075-05-14'),
(65, 481, 3.8, 23, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:10:27', '2074-04-16'),
(66, 401, 4.2, 20.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:11:02', '2074-04-18'),
(67, 400, 4.3, 22, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:11:36', '2074-04-21'),
(68, 400, 4.2, 21.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:12:49', '2074-04-23'),
(69, 520, 4.1, 18.5, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:14:04', '2074-04-25'),
(70, 400, 3.7, 22, 56, 0.32, 4.83, 2.63, 1, '2018-09-15 14:14:45', '2074-04-28'),
(72, 10, 7.8, 9.8, 56, 0.32, 4.83, 2.63, 1, '2018-10-11 14:23:38', '2075-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `seo_pages_id` int(11) NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `log_admin_activity` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL COMMENT 'keep log of admins activity',
  `log_admin_invalid_login` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL COMMENT 'keep log of admins invalid login ',
  `contact_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `system_email_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `system_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `site_status` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=online, 2=offline, 3=maintainance',
  `user_activation` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT 'need user activation after registration? 0=No, 1=Yes',
  `supplier_category_limit` int(2) NOT NULL COMMENT 'Limit No. of category choose by supplier to display as experience area',
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_app_id` bigint(20) NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rss_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `google_plus` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency_sign` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `google_analytics_code` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `auction_post_activation` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No Activation Require, 1= Activation Require by admin',
  `no_auction_post_free` int(11) NOT NULL DEFAULT '99999' COMMENT '0=No Free Post, 99999=Unlimited',
  `is_auction_post_cost` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No Buy package Enable, 1=Buy Package Enable',
  `no_bid_place_free` int(11) NOT NULL DEFAULT '999999999' COMMENT '0=No Free Bid, 999999999=Unlimited',
  `is_bid_place_cost` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No Buy package Enable, 1=Buy Package Enable',
  `enable_rating` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sms_notification` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `sms_gateway_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sms_api_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sms_api_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission_percent` float DEFAULT NULL,
  `v_content_static` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proposal_static` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dashboard_note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand_refer_point` int(11) DEFAULT NULL,
  `creator_refer_point` int(11) DEFAULT NULL,
  `fixed_commission` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `log_admin_activity`, `log_admin_invalid_login`, `contact_email`, `contact_name`, `system_email_name`, `system_email`, `address1`, `address2`, `city`, `state`, `zip_code`, `country_name`, `site_status`, `user_activation`, `supplier_category_limit`, `facebook`, `facebook_app_id`, `twitter`, `rss_url`, `linkedin`, `google_plus`, `currency_sign`, `currency_code`, `google_analytics_code`, `auction_post_activation`, `no_auction_post_free`, `is_auction_post_cost`, `no_bid_place_free`, `is_bid_place_cost`, `enable_rating`, `timezone`, `sms_notification`, `sms_gateway_url`, `sms_api_username`, `sms_api_password`, `commission_percent`, `v_content_static`, `proposal_static`, `dashboard_note`, `brand_refer_point`, `creator_refer_point`, `fixed_commission`) VALUES
(1, 'LG INCENTIVE', 'Y', '', 'lgmrewards@gmail.com', 'LG inc', 'LG incentive', 'lgmrewards@gmail.com', '', '', '', '', '', '', '1', '1', 0, 'http://www.facebook.com/vid.energy', 405264519614040, '', 'http://www.rss.com/bidcy', 'http://www.linkedin.com/vid.energy', '', '$', 'USD', 'this is test', '1', 0, '1', 0, '1', 'Yes', 'Asia/Kathmandu', '0', 'http://testapi.comm', 'apiuser', 'apipassword', 10, 'No Contents Found', 'No proposals Fopund', 'Please Don\'t contact Brand outside of Vid.Energy', 7, 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `admin_roles_permission`
--
ALTER TABLE `admin_roles_permission`
  ADD PRIMARY KEY (`user_type`,`permission_id`),
  ADD KEY `FK_ROLES_PERMS_PERMS_ID` (`permission_id`);

--
-- Indexes for table `block_ips`
--
ALTER TABLE `block_ips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incentive`
--
ALTER TABLE `incentive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`model_id`);

--
-- Indexes for table `log_admin_activity`
--
ALTER TABLE `log_admin_activity`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members2`
--
ALTER TABLE `members2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_emts_members` (`room_charge`);

--
-- Indexes for table `members_details`
--
ALTER TABLE `members_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `members_log`
--
ALTER TABLE `members_log`
  ADD KEY `emts_members_ibfk_1` (`dealer_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emts_sales_report_ibfk_1` (`milk`),
  ADD KEY `emts_sales_report_ibfk_2` (`lacto`),
  ADD KEY `emts_sales_report_ibfk_3` (`user_id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_pages_id` (`seo_pages_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `permission_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `block_ips`
--
ALTER TABLE `block_ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `incentive`
--
ALTER TABLE `incentive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `log_admin_activity`
--
ALTER TABLE `log_admin_activity`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `members2`
--
ALTER TABLE `members2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT for table `members_details`
--
ALTER TABLE `members_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `members2`
--
ALTER TABLE `members2`
  ADD CONSTRAINT `FK_emts_members` FOREIGN KEY (`room_charge`) REFERENCES `members2` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `members_details`
--
ALTER TABLE `members_details`
  ADD CONSTRAINT `members_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
