-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2024 at 03:27 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `treats_phs_std_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpy_branch`
--

DROP TABLE IF EXISTS `cpy_branch`;
CREATE TABLE IF NOT EXISTS `cpy_branch` (
  `id` smallint NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(250) NOT NULL COMMENT 'Name',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Phone Number',
  `address` varchar(256) DEFAULT NULL COMMENT 'Address',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cpy_branch`
--

INSERT INTO `cpy_branch` (`id`, `name`, `phone`, `address`) VALUES
(0, '-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_perm`
--

DROP TABLE IF EXISTS `cpy_perm`;
CREATE TABLE IF NOT EXISTS `cpy_perm` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `grp_id` int NOT NULL COMMENT 'Permission Group',
  `prog_id` int NOT NULL COMMENT 'Menu Program',
  `isok` tinyint NOT NULL DEFAULT '0' COMMENT 'Permission',
  `ins` tinyint NOT NULL DEFAULT '0' COMMENT 'Insert',
  `upd` tinyint NOT NULL DEFAULT '0' COMMENT 'Update',
  `qry` tinyint NOT NULL DEFAULT '0' COMMENT 'Query',
  `del` tinyint NOT NULL DEFAULT '0' COMMENT 'Delete',
  `prt` tinyint NOT NULL DEFAULT '0' COMMENT 'Print',
  `exp` tinyint NOT NULL DEFAULT '0' COMMENT 'Export',
  `imp` tinyint NOT NULL DEFAULT '0' COMMENT 'Import',
  `cmt` tinyint NOT NULL DEFAULT '0' COMMENT 'Commit',
  `rvk` tinyint NOT NULL DEFAULT '0' COMMENT 'Revoke',
  `spc` tinyint NOT NULL DEFAULT '0' COMMENT 'Special',
  PRIMARY KEY (`id`),
  KEY `prog_id` (`prog_id`),
  KEY `grp_id` (`grp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1051 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cpy_perm`
--

INSERT INTO `cpy_perm` (`id`, `grp_id`, `prog_id`, `isok`, `ins`, `upd`, `qry`, `del`, `prt`, `exp`, `imp`, `cmt`, `rvk`, `spc`) VALUES
(957, 3, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(958, 3, 11, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(959, 3, 12, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(960, 3, 13, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(961, 3, 14, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(962, 3, 1101, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(963, 3, 1401, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(964, 3, 9001, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(965, 3, 9901, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(966, 3, 1901011, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(967, 3, 1901012, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(968, 3, 1901090, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(969, 3, 9001011, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(970, 3, 9001013, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(971, 3, 9001014, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(972, 3, 9001090, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(973, 3, 9901101, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(1050, 3, 1901015, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_perm_grp`
--

DROP TABLE IF EXISTS `cpy_perm_grp`;
CREATE TABLE IF NOT EXISTS `cpy_perm_grp` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `wpstatus_id` tinyint NOT NULL DEFAULT '2' COMMENT 'Workperiod Status',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `wpstatus_id` (`wpstatus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cpy_perm_grp`
--

INSERT INTO `cpy_perm_grp` (`id`, `name`, `wpstatus_id`, `rem`) VALUES
(-88, 'Dummy', 1, ''),
(-1, 'Super Users', 1, ''),
(0, 'Administrators', 1, ''),
(3, 'مدير محتوى', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_token`
--

DROP TABLE IF EXISTS `cpy_token`;
CREATE TABLE IF NOT EXISTS `cpy_token` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `gid` varchar(100) NOT NULL COMMENT 'GUID',
  `user_id` int NOT NULL COMMENT 'User',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `sdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Start',
  `edate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'End',
  `adate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Last Active',
  `pvkey` varchar(3072) DEFAULT NULL COMMENT 'Private Key',
  `pbkey` varchar(3072) DEFAULT NULL COMMENT 'Public Key',
  `ip` varchar(100) DEFAULT NULL COMMENT 'IP',
  `port` varchar(100) DEFAULT NULL COMMENT 'Port',
  `host` varchar(100) DEFAULT NULL COMMENT 'Host',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gid` (`gid`),
  KEY `user_id` (`user_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cpy_user`
--

DROP TABLE IF EXISTS `cpy_user`;
CREATE TABLE IF NOT EXISTS `cpy_user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `bran_id` smallint NOT NULL DEFAULT '0' COMMENT 'Branch',
  `grp_id` int NOT NULL COMMENT 'Permission Group',
  `gender_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Gender',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `logon` varchar(50) NOT NULL COMMENT 'Logon Name',
  `password` varchar(512) DEFAULT NULL COMMENT 'Password',
  `image` varchar(512) DEFAULT NULL COMMENT 'User Image',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `logon` (`logon`),
  KEY `grp_id` (`grp_id`),
  KEY `status_id` (`status_id`),
  KEY `gender_id` (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cpy_user`
--

INSERT INTO `cpy_user` (`id`, `bran_id`, `grp_id`, `gender_id`, `status_id`, `name`, `logon`, `password`, `image`) VALUES
(-9, 0, -1, 1, 1, 'System', 'system', 'eb0a191797624dd3a48fa681d3061212', NULL),
(-1, 0, -1, 1, 1, 'Supervisor', 'super', 'eb0a191797624dd3a48fa681d3061212', NULL),
(0, 0, 0, 1, 1, 'Admin', 'admin', '569f50178522af3982442682e5575642', NULL),
(93, 0, 3, 1, 1, 'مدير المحتوى', 'treats', '152df8c4a937be35f5f0663c541eec01', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cpy_vuser`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cpy_vuser`;
CREATE TABLE IF NOT EXISTS `cpy_vuser` (
`bran_id` smallint
,`bran_name` varchar(250)
,`gender_id` tinyint
,`grp_id` int
,`id` int
,`image` varchar(512)
,`logon` varchar(50)
,`name` varchar(100)
,`password` varchar(512)
,`status_id` tinyint
);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_about`
--

DROP TABLE IF EXISTS `ecom_about`;
CREATE TABLE IF NOT EXISTS `ecom_about` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `image` varchar(512) NOT NULL COMMENT 'Image',
  `text1` text NOT NULL COMMENT 'Text 1',
  `text2` text NOT NULL COMMENT 'Text 2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_about`
--

INSERT INTO `ecom_about` (`id`, `image`, `text1`, `text2`) VALUES
(0, 'about-1.png', '<p class=\"mb-5\">\r\nHaving been in the FMCG sector since 1949 when our grandfather started producing beauty and care products for renowned brands and having distributed confectionaries and snacks for multinational brands our love for sweets never stopped growing.</p>\r\n<p class=\"mb-10\">\r\nOur obsession for popcorn started when our elder brother brought us back from a trip some delicious caramel popcorns made in the US.</p>\r\n<p class=\"mb-10\">\r\nWhile sweet popcorn is not so common in our part of the world compared to salty, we could not stop nibbling on them!</p>\r\n<p class=\"mb-10\">\r\nOur friends had the same reaction when they tried them: Deliciousness; Which left us wondering … why don’t we produce them?</p>\r\n<p class=\"mb-10\">After many trials, burnt pans and tasting sessions we were able to create our own caramel popcorn recipe that captured the taste buds of our kids, family and friends. Folly Pops was born!</p>\r\n<p class=\"mb-10\">All of our treats, from savory to sweet popcorn, are made by using premium ingredients. Enjoy it and don’t forget to share the moment with your loved ones!</p>', '<h2 class=\"mb-30\">Hashem A&M AB för import av livsmedel produkter, startade i 2019.</h2>\n              <p class=\"mb-25\">Hashem A&M är ett företag som säljer och levererar mat produkter runt om Sverige och Norge. </p>\n              <p class=\"mb-50\">Vi säljer till 289 butiker, det är jätteviktig för oss att våra kunder är nöjda av våra produkter.</p>\n              <p class=\"mb-50\">Produkterna som vi importera kommer från olika länder i Europa, Dubai och Jordanien.</p>\n              <p class=\"mb-50\">vårt företag har bra personal som har förmågan och erfarenheten i enkla och goda kontakter med kunderna, snabbhet och noggrannhet utmärker oss allt vi gör, och detta är hemligheten för vår framgången.</p>'),
(1, 'about-1.png', '<h2 class=\"mb-30\">Hashem A&M AB för import av livsmedel produkter, startade i 2019.</h2>\r\n              <p class=\"mb-25\">Hashem A&M är ett företag som säljer och levererar mat produkter runt om Sverige och Norge. </p>\r\n              <p class=\"mb-50\">Vi säljer till 289 butiker, det är jätteviktig för oss att våra kunder är nöjda av våra produkter.</p>\r\n              <p class=\"mb-50\">Produkterna som vi importera kommer från olika länder i Europa, Dubai och Jordanien.</p>\r\n              <p class=\"mb-50\">vårt företag har bra personal som har förmågan och erfarenheten i enkla och goda kontakter med kunderna, snabbhet och noggrannhet utmärker oss allt vi gör, och detta är hemligheten för vår framgången.</p>', '<h2 class=\"mb-30\">Hashem A&M AB för import av livsmedel produkter, startade i 2019.</h2>\r\n              <p class=\"mb-25\">Hashem A&M är ett företag som säljer och levererar mat produkter runt om Sverige och Norge. </p>\r\n              <p class=\"mb-50\">Vi säljer till 289 butiker, det är jätteviktig för oss att våra kunder är nöjda av våra produkter.</p>\r\n              <p class=\"mb-50\">Produkterna som vi importera kommer från olika länder i Europa, Dubai och Jordanien.</p>\r\n              <p class=\"mb-50\">vårt företag har bra personal som har förmågan och erfarenheten i enkla och goda kontakter med kunderna, snabbhet och noggrannhet utmärker oss allt vi gör, och detta är hemligheten för vår framgången.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_adv`
--

DROP TABLE IF EXISTS `ecom_adv`;
CREATE TABLE IF NOT EXISTS `ecom_adv` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `text1` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Text1',
  `text2` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Text2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_adv`
--

INSERT INTO `ecom_adv` (`id`, `text1`, `text2`) VALUES
(8, 'DISCOVER OUR TREATS - FOLLY PRODUCTS', 'منتجات فولي'),
(9, 'POPCORN', 'بوشار'),
(10, 'POTATO STICKS', 'أصابع البطاطا'),
(11, 'CORN PUFFS', 'أصابع الذرة'),
(12, 'BISCUITS', 'بسكويت');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_amt_type`
--

DROP TABLE IF EXISTS `ecom_amt_type`;
CREATE TABLE IF NOT EXISTS `ecom_amt_type` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `rem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_amt_type`
--

INSERT INTO `ecom_amt_type` (`id`, `name`, `rem`) VALUES
(1, 'Amount', ''),
(2, 'Percent', '');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_banner`
--

DROP TABLE IF EXISTS `ecom_banner`;
CREATE TABLE IF NOT EXISTS `ecom_banner` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `order` int NOT NULL DEFAULT '0' COMMENT 'Order',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `image` varchar(512) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ecom_banner`
--

INSERT INTO `ecom_banner` (`id`, `order`, `name`, `image`) VALUES
(1, 1, 'test1', 'Banner_241120_183619.png'),
(2, 3, '11', 'Banner_241120_184215.png'),
(3, 2, '22', 'Banner_241120_184156.png'),
(4, 0, '223', 'Banner_241120_184131.png');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_brand`
--

DROP TABLE IF EXISTS `ecom_brand`;
CREATE TABLE IF NOT EXISTS `ecom_brand` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name1` varchar(100) NOT NULL COMMENT 'Name 1',
  `name2` varchar(100) NOT NULL COMMENT 'Name 2',
  `image` varchar(512) NOT NULL COMMENT 'Logo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name1` (`name1`),
  UNIQUE KEY `name2` (`name2`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_brand`
--

INSERT INTO `ecom_brand` (`id`, `status_id`, `name1`, `name2`, `image`) VALUES
(0, 1, '-', '-', 'Brands.png'),
(1, 1, 'FOLLY', 'فولي', 'Brand_241107_085152.png');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_cart`
--

DROP TABLE IF EXISTS `ecom_cart`;
CREATE TABLE IF NOT EXISTS `ecom_cart` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `cust_id` int NOT NULL COMMENT 'Customer',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date Time',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `prod_id` int NOT NULL COMMENT 'Product',
  `size_id` int NOT NULL COMMENT 'Size Id',
  `qnt` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT 'Quantity',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price By Product Currency',
  `cprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price By Customer Currency',
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount',
  `disc` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Discount',
  `net` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Net Amount',
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  KEY `cart_token` (`cust_id`),
  KEY `size_id` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_cat`
--

DROP TABLE IF EXISTS `ecom_cat`;
CREATE TABLE IF NOT EXISTS `ecom_cat` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `status_id` tinyint NOT NULL COMMENT 'Status',
  `order` int NOT NULL DEFAULT '0' COMMENT 'Order',
  `wdays` smallint NOT NULL DEFAULT '365' COMMENT 'Warranty',
  `name1` varchar(100) NOT NULL COMMENT 'Name 1',
  `name2` varchar(100) NOT NULL COMMENT 'Name 2',
  `image` varchar(512) DEFAULT NULL COMMENT 'Image',
  `descrip` text NOT NULL COMMENT 'Description',
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_cat`
--

INSERT INTO `ecom_cat` (`id`, `status_id`, `order`, `wdays`, `name1`, `name2`, `image`, `descrip`) VALUES
(0, 2, 0, 365, '-', '-', NULL, ''),
(1, 1, 2, 365, 'POTATO STICKS', 'أصابع البطاطا', 'Cat_241009_153237.png', ''),
(2, 1, 1, 365, 'POPCORN', 'بوشار الذرة', 'Cat_241009_153250.png', ''),
(3, 1, 3, 365, 'CORN PUFFS', 'أصابع النفش', 'Cat_241009_153303.png', ''),
(4, 1, 4, 365, 'BISCUITS', 'بسكويت', 'Cat_241009_153321.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_curn`
--

DROP TABLE IF EXISTS `ecom_curn`;
CREATE TABLE IF NOT EXISTS `ecom_curn` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rate` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT 'Rate',
  `color` varchar(100) DEFAULT NULL COMMENT 'Color',
  `symbole` varchar(512) DEFAULT NULL COMMENT 'Symbole',
  PRIMARY KEY (`id`),
  UNIQUE KEY `curn_name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_curn`
--

INSERT INTO `ecom_curn` (`id`, `status_id`, `name`, `rate`, `color`, `symbole`) VALUES
(1, 1, 'KR', '1.00', '#56ffb0', 'KR'),
(2, 1, 'EUR', '11.00', '#ff9556', 'EUR'),
(3, 1, 'USD', '10.00', '#ff9556', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_customer`
--

DROP TABLE IF EXISTS `ecom_customer`;
CREATE TABLE IF NOT EXISTS `ecom_customer` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '2' COMMENT 'Status',
  `name` varchar(256) NOT NULL COMMENT 'Company Name',
  `orgnum` varchar(15) NOT NULL COMMENT 'Organization Number',
  `logon` varchar(100) NOT NULL COMMENT 'Logon Name',
  `pwd` varchar(1024) NOT NULL COMMENT 'Password',
  `mobile` varchar(25) NOT NULL COMMENT 'Mobile',
  `phone` varchar(25) DEFAULT NULL COMMENT 'Phone',
  `address` varchar(256) DEFAULT NULL COMMENT 'Address',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cust_logon` (`logon`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_faq`
--

DROP TABLE IF EXISTS `ecom_faq`;
CREATE TABLE IF NOT EXISTS `ecom_faq` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `ord` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `qtext` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Question',
  `atext` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Answer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_faq`
--

INSERT INTO `ecom_faq` (`id`, `ord`, `qtext`, `atext`) VALUES
(1, 1, 'How should I store my popcorn to keep it fresh?', 'Keep your popcorn in a cool and dry place.\n                    Keep your popcorn away from direct sunlight.\n                    Do not microwave or freeze your popcorn.\n                    Make sure you eat your popcorn within the time frame printed on the bag. We know you will not be able to resist!'),
(2, 2, 'What is the expiry date of my popcorn?', 'See date printed on your bag.'),
(3, 3, 'Once opened how long will my popcorn last?', 'Not more than a few minutes! But if you do not wish to finish the pack in one sitting make sure to empty it in a sealed container and consume it within a week.'),
(4, 4, 'Which popcorn can I eat if I have some food allergies?', 'Our popcorn does not contain nuts. However some ingredients we use are produced in a facility that uses peanuts, tree nuts, eggs and soy.\n                    Our sweet popcorn contains milk and soy.  \n                    Our cheese popcorn is made with real cheese so it contains milk.'),
(5, 5, 'Is your popcorn gluten free?', 'Our sweet popcorn is gluten free.\n                    Our cheese flavored popcorn is gluten free.'),
(6, 6, 'Is your popcorn suitable for vegetarians?', 'All of our popcorn is suitable for vegetarians.'),
(7, 7, 'Is your popcorn suitable for vegans?', 'Due to dairy our current range of popcorn is not suitable for vegan.'),
(8, 8, 'What kind of oil is used in your popcorn?', 'We use sunflower oil that is not hydrogenated.'),
(9, 9, 'Is your popcorn free of alcohol and pork derivatives?', 'Yes! All of our range is.'),
(10, 10, 'How long before serving should I crack open my popcorn?', 'You should wait until the last minute so that you do not lose some of the crunchiness. Popcorn should not be exposed to air for long periods before being consumed.'),
(11, 11, 'Where can I find nutritional and ingredients information?', 'just click on the product you wish to learn more about on our products page.');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order`
--

DROP TABLE IF EXISTS `ecom_order`;
CREATE TABLE IF NOT EXISTS `ecom_order` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `cust_id` int NOT NULL COMMENT 'Customer',
  `curn_id` int NOT NULL COMMENT 'Currency',
  `status_id` tinyint NOT NULL DEFAULT '0' COMMENT 'Status',
  `rate` decimal(10,5) NOT NULL DEFAULT '1.00000' COMMENT 'Currency Rate',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date Time',
  PRIMARY KEY (`id`),
  KEY `cust_id` (`cust_id`),
  KEY `curn_id` (`curn_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_item`
--

DROP TABLE IF EXISTS `ecom_order_item`;
CREATE TABLE IF NOT EXISTS `ecom_order_item` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `order_id` int NOT NULL COMMENT 'Order',
  `prod_id` int NOT NULL COMMENT 'Product',
  `size_id` int NOT NULL COMMENT 'Size',
  `qnt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantity',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price By Product Currency',
  `cprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price By Customer Currency',
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount',
  `disc` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Discount',
  `net` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Net Amount',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `prod_id` (`prod_id`),
  KEY `size_id` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_service`
--

DROP TABLE IF EXISTS `ecom_order_service`;
CREATE TABLE IF NOT EXISTS `ecom_order_service` (
  `id` int NOT NULL COMMENT 'PK',
  `order_id` int NOT NULL COMMENT 'Order',
  `service_id` int NOT NULL COMMENT 'Service',
  `type_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Service Type Amount OR Percent',
  `amtperc` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount OR Percent',
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount',
  KEY `order_id` (`order_id`),
  KEY `service_id` (`service_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_status`
--

DROP TABLE IF EXISTS `ecom_order_status`;
CREATE TABLE IF NOT EXISTS `ecom_order_status` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ecom_order_status`
--

INSERT INTO `ecom_order_status` (`id`, `name`) VALUES
(0, 'New'),
(1, 'Canceled'),
(2, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_product`
--

DROP TABLE IF EXISTS `ecom_product`;
CREATE TABLE IF NOT EXISTS `ecom_product` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `mnum` int NOT NULL DEFAULT '0' COMMENT 'Number',
  `brand_id` int NOT NULL DEFAULT '0' COMMENT 'Brand',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `cat_id` int NOT NULL DEFAULT '0' COMMENT 'Category',
  `tag_id` int NOT NULL DEFAULT '0' COMMENT 'Tag',
  `name1` varchar(256) NOT NULL COMMENT 'Name 1',
  `name2` varchar(256) NOT NULL COMMENT 'Name 2',
  `qnt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantitiy',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Normal Price',
  `cprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Currecnt Price',
  `desc1` text COMMENT 'Description 1',
  `desc2` text COMMENT 'Description 2',
  `desc3` text COMMENT 'Contain',
  `desc4` text COMMENT 'May Contain',
  `desc5` text COMMENT 'Description 5',
  `image` varchar(512) DEFAULT NULL COMMENT 'Image',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mnum` (`mnum`),
  KEY `brand_id` (`brand_id`),
  KEY `cat_id` (`cat_id`),
  KEY `tag_id` (`tag_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_product`
--

INSERT INTO `ecom_product` (`id`, `mnum`, `brand_id`, `status_id`, `cat_id`, `tag_id`, `name1`, `name2`, `qnt`, `price`, `cprice`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `image`) VALUES
(1, 47, 1, 1, 2, 3, 'CARAMEL SEA SALT', 'فولي بوبس كراميل ملح البحر', '0.00', '0.00', '420.00', 'POPCORN KERNEL, SUGAR, RICE SYRUP, BUTTER, SUNFLOWER OIL, EMULSIFIER (Soy Lecithin), SEA SALT, RAISING AGENT (Baking Soda).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND SOY.', 'PEANUTS, TREENUTS AND EGGS.', NULL, 'Prod_240905_144945.png'),
(2, 48, 1, 1, 2, 3, 'CARAMEL PEANUT BUTTER', 'فولي بوبس كرامبل زبدة الفستق', '0.00', '0.00', '605.00', 'POPCORN KERNEL, SUGAR,PEANUT PASTE, RICE SYRUP, BUTTER, SUNFLOWER OIL, EMULSIFIER (Soy Lecithin), SEA SALT, RAISING AGENT (Baking Soda).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK, SOY AND PEANUTS.', 'TREENUTS AND EGGS.', NULL, 'Prod_240905_145653.png'),
(3, 49, 1, 1, 2, 3, 'MILK CHOCOLATE', 'فولي بوبس شوكولاتة الحليب', '0.00', '0.00', '340.00', 'POPCORN KERNEL, SUGAR, RICE SYRUP, BUTTER, MILK CHOCOLATE [Sugar, Whole Milk Powder, Cocoa Butter, Cocoa Mass, Emulsifier (Soy Lecithin)], SUNFLOWER OIL, EMULSIFIER (Soy Lecithin), RAISING AGENT (Baking Soda).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND SOY.', 'PEANUTS, TREENUTS AND EGGS.', NULL, 'Prod_240905_145913.png'),
(4, 50, 1, 1, 2, 3, 'WHITE CHOCOLATE', 'فولي بوبس بالشوكولاتة البيضاء', '0.00', '0.00', '180.00', 'POPCORN KERNEL, SUGAR, RICE SYRUP, BUTTER, WHITE CHOCOLATE [Sugar, Whole Milk Powder, Cocoa Butter, Emulsifier (Soy Lecithin), Vanilla], SUNFLOWER OIL, EMULSIFIER (Soy Lecithin), RAISING AGENT (Baking Soda).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND SOY.', 'PEANUTS, TREENUTS AND EGGS.', NULL, 'Prod_240905_150216.png'),
(5, 51, 1, 1, 2, 3, 'STRAWBERRIES CREAM', 'فولي بوبس يكريمة الفراولة', '0.00', '0.00', '140.00', 'POPCORN KERNEL, SUGAR, RICE SYRUP, BUTTER,  SKIMMED Milk Powder, SUNFLOWER OIL, EMULSIFIER (Soy Lecithin), RAISING AGENT (Baking Soda), STRAWBERRY FLAVORING COLORING E122.', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND SOY.', 'PEANUTS, TREENUTS AND EGGS.', NULL, 'Prod_240905_150352.png'),
(6, 52, 1, 1, 2, 3, 'CARAMEL SEA SALT [and] CHEDDAR CHEESE', 'فولي بوبس ميكس', '0.00', '0.00', '320.00', 'CARAMEL CORN :POPCORN KERNEL, SUGAR, RICE SYRUP, BUTTER, SUNFLOWER OIL, EMULSIFIER (Soy Lecithin), SEA SALT, RAISING AGENT (Baking Soda).CHEESE CORN:POPCORN KERNEL, SUNFLOWER OIL, FLAVORING PREPARATIONS, NATURAL AND NATURE IDENTICAL FLAVORINGS, WHEAT FLOUR, SALT, SUGAR, FLAVOR ENHANCERS (E621,E627,E631), MALTODEXTRIN, STABILIZER (E414), ANTI-CAKING AGENT (E551), ACID (E330), COLORING (E160c), ACIDITY REGULATORS [E327,E331 (iii)], ANTIOXIDANT (E307), MODIFIED MAIZE STARCH (E1450), EMULSIFIERS [E339(i), E339(ii)].', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK, SOY AND CEREALS (Gluten).', 'PEANUTS, TREENUTS AND EGGS.', 'Experience the ultimate flavor fusion with our irresistible rich, battery caramel and our creamy cheddar cheese popcorn mix, all in one bag! Our popcorn mix promises a unique and unforgettable gourmet experience that satisfies every craving.', 'Prod_240905_150721.png'),
(7, 53, 1, 1, 2, 3, 'CHEDDAR CHEESE', 'فولي بوبس بجبنة الشيدر', '0.00', '0.00', '230.00', 'POPCORN KERNEL, SUNFLOWER OIL, FLAVORING PREPARATIONS, NATURAL AND NATURE IDENTICAL FLAVORINGS, WHEAT FLOUR, SALT, SUGAR, FLAVOR ENHANCERS (E621,E627,E631), MALTODEXTRIN, STABILIZER (E414), ANTI-CAKING AGENT (E551), ACID (E330), COLORING (E160c), ACIDITY REGULATORS [E327,E331 (iii)], ANTIOXIDANT (E307), MODIFIED MAIZE STARCH (E1450), EMULSIFIERS [E339(i), E339(ii)].', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.\r\n', 'MILK AND CEREALS (Gluten).', 'soy.', NULL, 'Prod_240905_150836.png'),
(8, 54, 1, 1, 2, 3, 'WHITE CHEDDAR CHEESE', 'فولي بوبس بجبنة الشيدر البيضاء', '0.00', '0.00', '200.00', 'POPCORN KERNEL, SUNFLOWER OIL, FLAVORING PREPARATIONS, NATURAL AND NATURE IDENTICAL FLAVORINGS, WHEAT FLOUR, WHEY POWDER, SALT, SUGAR, FLAVOR ENHANCERS (E621,E627,E631), MALTODEXTRIN, ACID (E330),ANTI-CAKING AGENT (E551), ACIDITY REGULATORS [E331 (iii)], EMULSIFIERS [E339(ii)].', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND CEREALS (Gluten).', 'SOY.', NULL, 'Prod_240905_150928.png'),
(9, 55, 1, 1, 1, 3, 'FRENCH CHEESE', 'أصابع البطاطا بالجبنة الفرنسية', '12.00', '0.00', '135.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES,WHEY POWDER, FLAVORING PREPARATIONS, SALT, WHEAT FLOUR, FLAVOR ENHANCERS (E621, E627, E631),LACTOSE, ANTI-CAKING AGENT (E551), COLORINGS (E100, E160c), FRACTIONATED VEGETABLE OIL (PALM), FLAVORING SUBSTANCES, THERMAL PROCESS FLAVORING.', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK, SOY AND CEREALS (Gluten).', 'PEANUTS.', NULL, 'Prod_240905_151226.png'),
(10, 56, 1, 1, 1, 3, 'NACHO CHEESE', 'أصابع البطاطا بجبنة الناتشو', '12.00', '0.00', '165.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES, FLAVORING PREPARATIONS, NATURAL AND NATURE IDENTICAL FLAVORINGS, WHEAT FLOUR, SALT, SUGAR, LACTOSE, FLAVOR ENHANCERS (E621, E627, E631),MALTODEXTRIN, WHOLE MILK POWDER, COLORING (E110),ACID (E330), MODIFIED MAIZE STARCH (E1450), ANTI-CAKING AGENT (E551), ACIDITY REGULATOR (E327).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.\r\n', 'MILK AND CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240905_151519.png'),
(11, 57, 1, 1, 1, 3, 'BBQ', 'أصابع البطاطا بالباربكيو', '6.00', '0.00', '185.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES, WHEAT GRITS, SALT, SUGAR, WHEAT FLOUR, DEXTROSE, NATURAL AND ARTIFICIAL FLAVORINGS, TOMATO POWDER, YEAST POWDER, NATURAL FLAVORING (YEAST EXTRACT), GARLIC POWDER, SPICE, ONION POWDER, CHILI POWDER BLEND (Spices, Herb, Salt, Garlic), BLACK PEPPER, ANTI-CAKING AGENT [E551, E341(iii)], ACID (E330), COLORING (E160c), ANTIOXIDANT (E392).\r\n', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240905_151539.png'),
(12, 58, 1, 1, 1, 3, 'SALT VINEGAR', 'أصابع البطاطا بالملح والخل', '6.00', '0.00', '200.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES, NATURAL AND NATURE IDENTICAL FLAVORING, SALT, MAIZE MALTODEXTRIN, FLAVOR ENHANCER (E621), ANTI-CAKING AGENT (E551), ACID (E330).\r\n', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', NULL, 'MILK, SOY AND PEANUTS.', NULL, 'Prod_240905_151647.png'),
(13, 59, 1, 1, 1, 3, 'SOUR CREAM ONION', 'أصابع البطاطا بالكريمة الحامضة والبصل', '12.00', '0.00', '215.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES,SALT, SUGAR, FLAVORING, WHEAT FLOUR(Wheat Flour, Calcium Carbonate, Iron, Niacin, Thiamin), WHEY POWDER, ONION POWDER, FLAVOR ENHANCER (E621), WHOLE MILK POWDER, YEAST POWDER, HERB, NATURAL AND ARTIFICIAL FLAVORINGS, GARLIC POWDER, ACID(E296), ANTI-CAKING AGENT (E551).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240905_151806.png'),
(14, 60, 1, 1, 1, 3, 'KETCHUP', 'أصابع البطاطا بالكاتشب', '12.00', '0.00', '210.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES,SALT, WHEAT FLOUR(Wheat Flour, Calcium Carbonate, Iron, Niacin, Thiamin), SUGAR, FLAVOR ENHANCER (E621), NATURAL AND ARTIFICIAL FLAVORINGS, CORNFLOUR, DEXTROSE, ACID (E330), COLORINGS (E162,E160B,E160C), ANTI-CAKING AGENTS [E341(iii),E551], ANTIOXIDANT (E392).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK, SOY AND CEREALS (Gluten).', 'PEANUTS.', NULL, 'Prod_240905_151947.png'),
(15, 61, 1, 1, 1, 3, 'HOT CHEESE', 'أصابع البطاطا بالجبنة الحارة', '12.00', '0.00', '335.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES, NATURAL AND NATURE IDENTICAL FLAVORINGS, FLAVORIN PERPARATIONS,SMOKE FLAVORINGS, WHEAT FLOUR, SALT, SWEET WHEY POWDER, FLAVOR ENHANCERS (E621,E631), MAIZE MALTODEXTRIN, MOZZARELLA CHEESE POWDER, CHEDDER CHEESE POWDER, ANTI-CAKING AGENT (E551), ACID(E330), COLORINGS (E160B,E160C), EMULSIFIER (E414), STABILIZER[Mineral Salts(E339)].\r\n', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'milk and CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240905_152202.png'),
(16, 62, 1, 1, 1, 3, 'HOT CHILI LIME', 'أصابع البطاطا حار وليمون', '12.00', '940.00', '445.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES, RUSK(Wheat Flour, Calcium Carbonate, Iron, Niacin, Thiamin), SALT, SUGAR, NATURAL AND NATURE IDENTICAL FLAVORINGS, ACID(E330),RED CHILI PEPPER, FLAVOR ENHANCERS (E621, E635), ANTI-CAKING AGENT (E551), COLORINGS (E160C,E100), GARLIC POWDER, RAPESEED OIL, ANTIOXIDANT (E392), SMOKE FLAVORING.\r\n', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'CEREALS (Gluten).', 'MILK, SOY AND PEANUTS.', NULL, 'Prod_240905_152337.png'),
(17, 63, 1, 1, 1, 3, 'SWEET CHILI PEPPER', 'أصابع البطاطا حار وحلو', '4.00', '330.00', '290.00', 'CORN GRITS, VEGETABLE OIL (Palm),DRIED POTATOES, SUGAR, NATURE IDENTICAL FLAVORINGS, WHEAT FLOUR, SALT, FLAVOR ENHANCERS (E621, E627,E631), SPICES, COLORING (E160C),ACIDS (E296, E330), ANTI-CAKING AGENTS [E551, E341(iii)], SWEETENER(E951), STABILIZER (E307), EMULSIFIER (E471).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', '\r\nCEREALS (Gluten).', 'MILK, SOY AND PEANUTS.', NULL, 'Prod_240905_152443.png'),
(191, 64, 1, 1, 3, 0, 'PIZZA CURLS', 'أصابع بيتزا', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm),  NATURAL AND ARTIFICIAL FLAVORINGS, SALT, SUGAR, MALTODEXTRIN, CORNFLOUR, FLAVOR ENHANCER (E621), ANTI-CAKING AGENT (E341(iii), E551), COLORINGS (E160c, E100), SMOKE FLAVORINGS, ANTIOXIDANT(E392).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK, SOY AND CEREALS (Gluten).', 'PEANUTS.', NULL, 'Prod_240915_144630.png'),
(192, 65, 1, 1, 3, 0, 'CHEDDAR CHEESE', 'جبنة الشيدر', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm), SALT, SUGAR, NATURAL AND NATURE IDENTICAL FLAVORINGS, FLAVORING PREPARATIONS, WHEAT FLOUR,LACTOSE, FLAVOR ENHANCERS (E621, E627, E631), MALTODEXTRINE, WHOLE MILK POWDER, ACID(E330), MODIFIED MAIZE STARCH (E1450), ANTI-CAKING AGENT (E551), COLORINGS (E110), ACIDITY REGULATOR (327).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND CEREALS (Gluten)', 'SOY AND PEANUTS.', NULL, 'Prod_240915_145210.png'),
(193, 66, 1, 1, 3, 0, 'PEANUT', 'فستق سوداني', '0.00', '0.00', '0.00', 'CORN GRITS, PEANUT PASTE, VEGETABLE OIL (Palm), SUGAR, SALT.', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'PEANUTS.', 'MILK AND SOY.', NULL, 'Prod_240915_145328.png'),
(194, 67, 1, 1, 3, 0, 'NOODLES CURLS', 'نودلز', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm), SALT, SUGAR, NATURE IDENTICAL FLAVOR ENHANCER (E621), ANTI-CAKING AGENT (E551), COLORINGS (E102, E110, E129).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'CEREALS (Gluten), CELERY AND SULFUR DIOXIDE.', 'MILK, SOY AND PEANUTS.', NULL, 'Prod_240915_145411.png'),
(195, 68, 1, 1, 3, 0, 'SOUR CREAM ONION', 'كريمة حامضة وبصل', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm), SALT, SUGAR, WHEAT FLOUR (Wheat Flour,Calcium Carbonate,Iron,Niacin,Thiamin), WHEY POWDER, ONION POWDER, FLAVOR ENHANCER (E621), WHOLE MILK POWDER, YEAST POWDER, HERB, NATURAL AND ARTIFICIAL FLAVORINGS, GARLIC POWDER, ACID (E296), ANTI-CAKING AGENT (E551).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240915_145500.png'),
(196, 69, 1, 1, 3, 0, 'ZAATAR', 'زعتر', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm), ZA\'ATAR (Herbs, Spice, Salt), ACID(E330).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.\r\n', 'TREENUTS.', 'MILK, SOY AND PEANUTS.', NULL, 'Prod_240915_145536.png'),
(197, 70, 1, 1, 3, 0, 'SWEETCORN', 'ذرة حلوة', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm), SALT, SUGAR, WHEAT FLOUR (Wheat Flour,Calcium Carbonate,Iron,Niacin,Thiamin), FLAVOR ENHANCERS (E621, E635), NATURAL AND ARTIFICIAL FLAVORINGS, COLORING (E100), RAPESEED OIL, ANTI-CAKING AGENTS [E341(iii),E551], ACID (E330), NATURAL FLAVORING (Yeast Extract), SWEETENER (E951).', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.\r\n', 'MILK AND CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240915_145624.png'),
(198, 71, 1, 1, 3, 0, 'WHITE CHEDDAR CHEESE', 'جبنة الشيدر البيضاء', '0.00', '0.00', '0.00', 'CORN GRITS, VEGETABLE OIL (Palm), SALT, WHEAT FLOUR, SWEET WHEY POWDER, FLAVOR ENHANCERS (E621, E627),CHEDDER CHEESE POWDER, CHEESE POWDER, SUGAR, VEGETABLE OIL (Coconut, Palm), ANTI-CAKING AGENT (E551), STABILIZER [Mineral Salts (E339)].', 'The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2000 calories a day is used in general nutrition advice.', 'MILK AND CEREALS (Gluten).', 'SOY AND PEANUTS.', NULL, 'Prod_240915_145713.png'),
(199, 72, 1, 1, 4, 0, 'CHOCOLATE HAZELNUT', 'شوكولا البندق', '0.00', '0.00', '0.00', '', '', NULL, NULL, NULL, 'Prod_240915_145915.png'),
(200, 73, 1, 1, 4, 0, 'MILK CHOCOLATE', 'شوكولاتة الحليب', '0.00', '0.00', '0.00', '', '', NULL, NULL, NULL, 'Prod_240915_150003.png'),
(201, 74, 1, 1, 4, 0, 'WHITE CHOCOLATE', 'شوكولاتة بيضاء', '0.00', '0.00', '0.00', '', '', NULL, NULL, NULL, 'Prod_240915_150040.png'),
(202, 75, 1, 1, 4, 0, 'STRAWBERRY', 'كريمة الفريز', '0.00', '0.00', '0.00', '', '', '', '', NULL, 'Prod_241107_085601.png');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_facts`
--

DROP TABLE IF EXISTS `ecom_prod_facts`;
CREATE TABLE IF NOT EXISTS `ecom_prod_facts` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `ord` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `name1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name1',
  `name2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name2',
  `val1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Value 1',
  `val2` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Value 2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `prod_id` (`prod_id`,`name1`)
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_prod_facts`
--

INSERT INTO `ecom_prod_facts` (`id`, `prod_id`, `ord`, `name1`, `name2`, `val1`, `val2`) VALUES
(1, 194, 0, 'Calories', '', '134', ''),
(2, 194, 11, '* Amount Per 28g', '', NULL, NULL),
(3, 194, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(4, 194, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(6, 194, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(7, 194, 3, 'Trans Fat', '', '0 g', NULL),
(8, 194, 4, 'Cholesterol', '', '0 mg', '0%'),
(9, 194, 5, 'Sodium', '', '285 mg', '13%'),
(10, 194, 7, 'Dietary Fiber', '', '1 g', '4%'),
(11, 194, 8, 'Total Sugars', '', '1 g', NULL),
(12, 194, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(13, 194, 10, 'Protein', '', '2 g', NULL),
(14, 1, 0, 'Calories', 'Calories', '120', ''),
(15, 1, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(16, 1, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(17, 1, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(18, 1, 4, 'Cholesterol', 'Cholesterol', '8 g', '2%'),
(19, 1, 5, 'Sodium', 'Sodium', '136 g', '6%'),
(20, 1, 6, 'Total Carbohydrate', 'Total Carbohydrate', '21 g', '7%'),
(21, 1, 7, 'Dietary Fiber', 'Dietary Fiber', '1 g', '4%'),
(22, 1, 8, 'Total Sugars', 'Total Sugars', '15 g', ''),
(23, 1, 9, 'Includes Added sugars', 'Includes Added sugars', '15 g', '30%'),
(24, 1, 10, 'Protein', 'Protein', '1 g', ''),
(25, 1, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(26, 2, 0, 'Calories', 'Calories', '125', ''),
(27, 2, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(28, 2, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(29, 2, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(30, 2, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(31, 2, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(32, 2, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(33, 2, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(34, 2, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(35, 2, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(36, 2, 10, 'Protein', 'Protein', '2 g', ''),
(37, 2, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(38, 3, 0, 'Calories', 'Calories', '125', ''),
(39, 3, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(40, 3, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(41, 3, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(42, 3, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(43, 3, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(44, 3, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(45, 3, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(46, 3, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(47, 3, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(48, 3, 10, 'Protein', 'Protein', '2 g', ''),
(49, 3, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(50, 4, 0, 'Calories', 'Calories', '125', ''),
(51, 4, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(52, 4, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(53, 4, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(54, 4, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(55, 4, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(56, 4, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(57, 4, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(58, 4, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(59, 4, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(60, 4, 10, 'Protein', 'Protein', '2 g', ''),
(61, 4, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(62, 5, 0, 'Calories', 'Calories', '125', ''),
(63, 5, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(64, 5, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(65, 5, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(66, 5, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(67, 5, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(68, 5, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(69, 5, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(70, 5, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(71, 5, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(72, 5, 10, 'Protein', 'Protein', '2 g', ''),
(73, 5, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(74, 6, 0, 'Calories', 'Calories', '125', ''),
(75, 6, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(76, 6, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(77, 6, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(78, 6, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(79, 6, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(80, 6, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(81, 6, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(82, 6, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(83, 6, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(84, 6, 10, 'Protein', 'Protein', '2 g', ''),
(85, 6, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(86, 7, 0, 'Calories', 'Calories', '125', ''),
(87, 7, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(88, 7, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(89, 7, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(90, 7, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(91, 7, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(92, 7, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(93, 7, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(94, 7, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(95, 7, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(96, 7, 10, 'Protein', 'Protein', '2 g', ''),
(97, 7, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(98, 8, 0, 'Calories', 'Calories', '125', ''),
(99, 8, 1, 'Total Fat', 'Total Fat', '6 g', '9%'),
(100, 8, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(101, 8, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(102, 8, 4, 'Cholesterol', 'Cholesterol', '6 mg', '2%'),
(103, 8, 5, 'Sodium', 'Sodium', '127 mg', '6%'),
(104, 8, 6, 'Total Carbohydrate', 'Total Carbohydrate', '18 g', '6%'),
(105, 8, 7, 'Dietary Fiber', 'Dietary Fiber', '2 g', '8%'),
(106, 8, 8, 'Total Sugars', 'Total Sugars', '12 g', ''),
(107, 8, 9, 'Includes Added sugars', 'Includes Added sugars', '12 g', '24%'),
(108, 8, 11, '* Amount Per 28g', '* Amount Per 28g', '', ''),
(109, 191, 0, 'Calories', '', '134', ''),
(110, 191, 11, '* Amount Per 28g', '', NULL, NULL),
(111, 191, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(112, 191, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(113, 191, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(114, 191, 3, 'Trans Fat', '', '0 g', NULL),
(115, 191, 4, 'Cholesterol', '', '0 mg', '0%'),
(116, 191, 5, 'Sodium', '', '285 mg', '13%'),
(117, 191, 7, 'Dietary Fiber', '', '1 g', '4%'),
(118, 191, 8, 'Total Sugars', '', '1 g', NULL),
(119, 191, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(120, 191, 10, 'Protein', '', '2 g', NULL),
(121, 192, 0, 'Calories', '', '134', ''),
(122, 192, 11, '* Amount Per 28g', '', NULL, NULL),
(123, 192, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(124, 192, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(125, 192, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(126, 192, 3, 'Trans Fat', '', '0 g', NULL),
(127, 192, 4, 'Cholesterol', '', '0 mg', '0%'),
(128, 192, 5, 'Sodium', '', '285 mg', '13%'),
(129, 192, 7, 'Dietary Fiber', '', '1 g', '4%'),
(130, 192, 8, 'Total Sugars', '', '1 g', NULL),
(131, 192, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(132, 192, 10, 'Protein', '', '2 g', NULL),
(133, 193, 0, 'Calories', '', '134', ''),
(134, 193, 11, '* Amount Per 28g', '', NULL, NULL),
(135, 193, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(136, 193, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(137, 193, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(138, 193, 3, 'Trans Fat', '', '0 g', NULL),
(139, 193, 4, 'Cholesterol', '', '0 mg', '0%'),
(140, 193, 5, 'Sodium', '', '285 mg', '13%'),
(141, 193, 7, 'Dietary Fiber', '', '1 g', '4%'),
(142, 193, 8, 'Total Sugars', '', '1 g', NULL),
(143, 193, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(144, 193, 10, 'Protein', '', '2 g', NULL),
(145, 195, 0, 'Calories', '', '134', ''),
(146, 195, 11, '* Amount Per 28g', '', NULL, NULL),
(147, 195, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(148, 195, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(149, 195, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(150, 195, 3, 'Trans Fat', '', '0 g', NULL),
(151, 195, 4, 'Cholesterol', '', '0 mg', '0%'),
(152, 195, 5, 'Sodium', '', '285 mg', '13%'),
(153, 195, 7, 'Dietary Fiber', '', '1 g', '4%'),
(154, 195, 8, 'Total Sugars', '', '1 g', NULL),
(155, 195, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(156, 195, 10, 'Protein', '', '2 g', NULL),
(157, 196, 0, 'Calories', '', '134', ''),
(158, 196, 11, '* Amount Per 28g', '', NULL, NULL),
(159, 196, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(160, 196, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(161, 196, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(162, 196, 3, 'Trans Fat', '', '0 g', NULL),
(163, 196, 4, 'Cholesterol', '', '0 mg', '0%'),
(164, 196, 5, 'Sodium', '', '285 mg', '13%'),
(165, 196, 7, 'Dietary Fiber', '', '1 g', '4%'),
(166, 196, 8, 'Total Sugars', '', '1 g', NULL),
(167, 196, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(168, 196, 10, 'Protein', '', '2 g', NULL),
(169, 197, 0, 'Calories', '', '134', ''),
(170, 197, 11, '* Amount Per 28g', '', NULL, NULL),
(171, 197, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(172, 197, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(173, 197, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(174, 197, 3, 'Trans Fat', '', '0 g', NULL),
(175, 197, 4, 'Cholesterol', '', '0 mg', '0%'),
(176, 197, 5, 'Sodium', '', '285 mg', '13%'),
(177, 197, 7, 'Dietary Fiber', '', '1 g', '4%'),
(178, 197, 8, 'Total Sugars', '', '1 g', NULL),
(179, 197, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(180, 197, 10, 'Protein', '', '2 g', NULL),
(181, 198, 0, 'Calories', '', '134', ''),
(182, 198, 11, '* Amount Per 28g', '', NULL, NULL),
(183, 198, 1, 'Total Fat', 'Total Fat', '7 g', '11%'),
(184, 198, 6, 'Total Carbohydrate', '', '16 g', '6%'),
(185, 198, 2, 'Saturated Fat', 'Saturated Fat', '3 g', '15%'),
(186, 198, 3, 'Trans Fat', '', '0 g', NULL),
(187, 198, 4, 'Cholesterol', '', '0 mg', '0%'),
(188, 198, 5, 'Sodium', '', '285 mg', '13%'),
(189, 198, 7, 'Dietary Fiber', '', '1 g', '4%'),
(190, 198, 8, 'Total Sugars', '', '1 g', NULL),
(191, 198, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(192, 198, 10, 'Protein', '', '2 g', NULL),
(193, 9, 0, 'Calories', '', '122', ''),
(194, 9, 11, '* Amount Per 28g', '', NULL, NULL),
(195, 9, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(196, 9, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(197, 9, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(198, 9, 3, 'Trans Fat', '', '0 g', NULL),
(199, 9, 4, 'Cholesterol', '', '0 mg', '0%'),
(200, 9, 5, 'Sodium', '', '250 mg', '11%'),
(201, 9, 7, 'Dietary Fiber', '', '1 g', '4%'),
(202, 9, 8, 'Total Sugars', '', '1 g', NULL),
(203, 9, 9, 'Includes Added sugars', '', '0 g', '0%'),
(204, 9, 10, 'Protein', '', '2 g', NULL),
(205, 10, 0, 'Calories', '', '123', ''),
(206, 10, 11, '* Amount Per 28g', '', NULL, NULL),
(207, 10, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(208, 10, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(209, 10, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(210, 10, 3, 'Trans Fat', '', '0 g', NULL),
(211, 10, 4, 'Cholesterol', '', '0 mg', '0%'),
(212, 10, 5, 'Sodium', '', '156 mg', '7%'),
(213, 10, 7, 'Dietary Fiber', '', '1 g', '4%'),
(214, 10, 8, 'Total Sugars', '', '1 g', NULL),
(215, 10, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(216, 10, 10, 'Protein', '', '2 g', NULL),
(217, 11, 0, 'Calories', '', '123', ''),
(218, 11, 11, '* Amount Per 28g', '', NULL, NULL),
(219, 11, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(220, 11, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(221, 11, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(222, 11, 3, 'Trans Fat', '', '0 g', NULL),
(223, 11, 4, 'Cholesterol', '', '0 mg', '0%'),
(224, 11, 5, 'Sodium', '', '202 mg', '9%'),
(225, 11, 7, 'Dietary Fiber', '', '1 g', '4%'),
(226, 11, 8, 'Total Sugars', '', '1 g', NULL),
(227, 11, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(228, 11, 10, 'Protein', '', '2 g', NULL),
(229, 12, 0, 'Calories', '', '122', ''),
(230, 12, 11, '* Amount Per 28g', '', NULL, NULL),
(231, 12, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(232, 12, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(233, 12, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(234, 12, 3, 'Trans Fat', '', '0 g', NULL),
(235, 12, 4, 'Cholesterol', '', '0 mg', '0%'),
(236, 12, 5, 'Sodium', '', '138 mg', '6%'),
(237, 12, 7, 'Dietary Fiber', '', '1 g', '4%'),
(238, 12, 8, 'Total Sugars', '', '1 g', NULL),
(239, 12, 9, 'Includes Added sugars', '', '0 g', '0%'),
(240, 12, 10, 'Protein', '', '2 g', NULL),
(241, 13, 0, 'Calories', '', '122', ''),
(242, 13, 11, '* Amount Per 28g', '', NULL, NULL),
(243, 13, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(244, 13, 6, 'Total Carbohydrate', '', '17 g', '6%'),
(245, 13, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(246, 13, 3, 'Trans Fat', '', '0 g', NULL),
(247, 13, 4, 'Cholesterol', '', '0 mg', '0%'),
(248, 13, 5, 'Sodium', '', '196 mg', '9%'),
(249, 13, 7, 'Dietary Fiber', '', '1 g', '4%'),
(250, 13, 8, 'Total Sugars', '', '1 g', NULL),
(251, 13, 9, 'Includes Added sugars', '', '0 g', '0%'),
(252, 13, 10, 'Protein', '', '2 g', NULL),
(253, 14, 0, 'Calories', '', '122', ''),
(254, 14, 11, '* Amount Per 28g', '', NULL, NULL),
(255, 14, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(256, 14, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(257, 14, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(258, 14, 3, 'Trans Fat', '', '0 g', NULL),
(259, 14, 4, 'Cholesterol', '', '0 mg', '0%'),
(260, 14, 5, 'Sodium', '', '261 mg', '12%'),
(261, 14, 7, 'Dietary Fiber', '', '1 g', '4%'),
(262, 14, 8, 'Total Sugars', '', '1 g', NULL),
(263, 14, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(264, 14, 10, 'Protein', '', '2 g', NULL),
(265, 15, 0, 'Calories', '', '117', ''),
(266, 15, 11, '* Amount Per 28g', '', NULL, NULL),
(267, 15, 1, 'Total Fat', 'Total Fat', '2 g', '3%'),
(268, 15, 6, 'Total Carbohydrate', '', '21 g', '7%'),
(269, 15, 2, 'Saturated Fat', 'Saturated Fat', '1 g', '5%'),
(270, 15, 3, 'Trans Fat', '', '0 g', NULL),
(271, 15, 4, 'Cholesterol', '', '0 mg', '0%'),
(272, 15, 5, 'Sodium', '', '180 mg', '8%'),
(273, 15, 7, 'Dietary Fiber', '', '1 g', '4%'),
(274, 15, 8, 'Total Sugars', '', '1 g', NULL),
(275, 15, 9, 'Includes Added sugars', '', '0 g', '0%'),
(276, 15, 10, 'Protein', '', '2 g', NULL),
(277, 16, 0, 'Calories', '', '123', ''),
(278, 16, 11, '* Amount Per 28g', '', NULL, NULL),
(279, 16, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(280, 16, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(281, 16, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(282, 16, 3, 'Trans Fat', '', '0 g', NULL),
(283, 16, 4, 'Cholesterol', '', '0 mg', '0%'),
(284, 16, 5, 'Sodium', '', '187 mg', '9%'),
(285, 16, 7, 'Dietary Fiber', '', '1 g', '4%'),
(286, 16, 8, 'Total Sugars', '', '1 g', NULL),
(287, 16, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(288, 16, 10, 'Protein', '', '2 g', NULL),
(289, 17, 0, 'Calories', '', '123', ''),
(290, 17, 11, '* Amount Per 28g', '', NULL, NULL),
(291, 17, 1, 'Total Fat', 'Total Fat', '4 g', '6%'),
(292, 17, 6, 'Total Carbohydrate', '', '18 g', '6%'),
(293, 17, 2, 'Saturated Fat', 'Saturated Fat', '2 g', '10%'),
(294, 17, 3, 'Trans Fat', '', '0 g', NULL),
(295, 17, 4, 'Cholesterol', '', '0 mg', '0%'),
(296, 17, 5, 'Sodium', '', '152 mg', '7%'),
(297, 17, 7, 'Dietary Fiber', '', '1 g', '4%'),
(298, 17, 8, 'Total Sugars', '', '1 g', NULL),
(299, 17, 9, 'Includes Added sugars', '', '0.3 g', '1%'),
(300, 17, 10, 'Protein', '', '2 g', NULL),
(301, 199, 0, 'Calories', 'Calories', '54', ''),
(302, 199, 1, 'Total Fat', 'Total Fat', '2 g', '3%'),
(303, 199, 2, 'Saturated Fat', 'Saturated Fat', '1 g', '5%'),
(304, 199, 3, 'Trans Fat', 'Trans Fat', '0 g', ''),
(305, 199, 4, 'Cholesterol', 'Cholesterol', '1.1 mg', '0.4%'),
(306, 199, 5, 'Sodium', 'Sodium', '22 mg', '0.9%');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_image`
--

DROP TABLE IF EXISTS `ecom_prod_image`;
CREATE TABLE IF NOT EXISTS `ecom_prod_image` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `image` varchar(512) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_prod_image`
--

INSERT INTO `ecom_prod_image` (`id`, `prod_id`, `image`) VALUES
(1, 1, 'P0047.png'),
(2, 2, 'P0048.png'),
(3, 2, 'P0048.png'),
(4, 3, 'P0049.png'),
(5, 4, 'P0050.png'),
(6, 5, 'P0051.png'),
(7, 6, 'P0052.png'),
(8, 7, 'P0053.png'),
(9, 7, 'P0053.png'),
(10, 8, 'P0054.png'),
(11, 8, 'P0054.png'),
(12, 9, 'P0055.png'),
(13, 10, 'P0056.png'),
(14, 11, 'P0057.png'),
(15, 11, 'P0057.png'),
(16, 12, 'P0058.png'),
(17, 12, 'P0058.png'),
(18, 13, 'P0059.png'),
(19, 13, 'P0059.png'),
(20, 14, 'P0060.png'),
(21, 14, 'P0060.png'),
(22, 15, 'P0061.png'),
(23, 16, 'P0062.png'),
(24, 16, 'P0062.png'),
(25, 16, 'P0062.png'),
(26, 16, 'P0062.png'),
(27, 17, 'P0063.png'),
(28, 17, 'P0063.png'),
(29, 17, 'P0063.png');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_review`
--

DROP TABLE IF EXISTS `ecom_prod_review`;
CREATE TABLE IF NOT EXISTS `ecom_prod_review` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `status_id` tinyint NOT NULL DEFAULT '2' COMMENT 'Status',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  `name` varchar(100) NOT NULL COMMENT 'Reviewer Name',
  `email` varchar(100) NOT NULL COMMENT 'Reviewer Email',
  `text` text NOT NULL COMMENT 'Review Text',
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_size`
--

DROP TABLE IF EXISTS `ecom_prod_size`;
CREATE TABLE IF NOT EXISTS `ecom_prod_size` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `unit_id` smallint NOT NULL DEFAULT '0',
  `snum` int NOT NULL COMMENT 'Sub Number',
  `anum` int NOT NULL COMMENT 'Article Number',
  `name` varchar(20) DEFAULT NULL COMMENT 'Size',
  `box` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantity in Box',
  `qnt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantity',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Normal Price',
  `cprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Current Price',
  PRIMARY KEY (`id`),
  UNIQUE KEY `prod_id_uk` (`prod_id`,`name`),
  KEY `prod_id` (`prod_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_service`
--

DROP TABLE IF EXISTS `ecom_service`;
CREATE TABLE IF NOT EXISTS `ecom_service` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `Name1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `Name2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `type_id` tinyint NOT NULL COMMENT 'Type',
  `amtperc` decimal(10,5) NOT NULL DEFAULT '0.00000' COMMENT 'Amount or Percent',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_service`
--

INSERT INTO `ecom_service` (`id`, `Name1`, `Name2`, `type_id`, `amtperc`) VALUES
(1, 'Moms', 'Moms', 2, '12.00000'),
(2, 'Fakt.Avgift', 'Fakt.Avgift', 1, '39.00000');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_slider_mst`
--

DROP TABLE IF EXISTS `ecom_slider_mst`;
CREATE TABLE IF NOT EXISTS `ecom_slider_mst` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(200) NOT NULL COMMENT 'Name',
  `rem` text COMMENT 'Remarks',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_slider_mst`
--

INSERT INTO `ecom_slider_mst` (`id`, `name`, `rem`) VALUES
(1, 'Main Slider', 'Main Slider');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_slider_trn`
--

DROP TABLE IF EXISTS `ecom_slider_trn`;
CREATE TABLE IF NOT EXISTS `ecom_slider_trn` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `slid_id` int NOT NULL COMMENT 'Slider',
  `order` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `header` varchar(200) DEFAULT NULL COMMENT 'Header',
  `text` text COMMENT 'Text',
  `image` varchar(200) NOT NULL COMMENT 'Image',
  `link` varchar(200) DEFAULT NULL COMMENT 'Link',
  `label` varchar(100) DEFAULT NULL COMMENT 'Label',
  PRIMARY KEY (`id`),
  KEY `slid_id` (`slid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_slider_trn`
--

INSERT INTO `ecom_slider_trn` (`id`, `slid_id`, `order`, `header`, `text`, `image`, `link`, `label`) VALUES
(1, 1, 1, '', '', 'slider-1.png', NULL, NULL),
(2, 1, 2, '', '', 'slider-2.png', NULL, NULL),
(3, 1, 3, '', '', 'slider-3.png', NULL, NULL),
(6, 1, 4, NULL, NULL, 'slider-4.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_tag`
--

DROP TABLE IF EXISTS `ecom_tag`;
CREATE TABLE IF NOT EXISTS `ecom_tag` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `classname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Class Name',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_tag`
--

INSERT INTO `ecom_tag` (`id`, `status_id`, `name`, `classname`) VALUES
(0, 1, '-', '-'),
(1, 1, 'hot', 'hot'),
(2, 1, 'sale', 'sale'),
(3, 1, 'new', 'new'),
(4, 1, 'best', 'best');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_unit`
--

DROP TABLE IF EXISTS `ecom_unit`;
CREATE TABLE IF NOT EXISTS `ecom_unit` (
  `id` smallint NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `rem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Rearks',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_unit`
--

INSERT INTO `ecom_unit` (`id`, `name`, `rem`) VALUES
(0, 'None', NULL),
(1, 'G', NULL),
(2, 'KG', NULL),
(3, 'ML', NULL),
(4, 'L', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vorders`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `ecom_vorders`;
CREATE TABLE IF NOT EXISTS `ecom_vorders` (
`curn_color` varchar(100)
,`curn_id` int
,`curn_name` varchar(100)
,`curn_rate` decimal(10,2)
,`curn_status_id` tinyint
,`curn_symbole` varchar(512)
,`cust_address` varchar(256)
,`cust_id` int
,`cust_logon` varchar(100)
,`cust_mobile` varchar(25)
,`cust_name` varchar(256)
,`cust_orgnum` varchar(15)
,`cust_phone` varchar(25)
,`cust_status_id` tinyint
,`ord_addat` datetime
,`ord_curn_rate` decimal(10,5)
,`ord_id` int
,`status_id` tinyint
,`status_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vorder_items`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `ecom_vorder_items`;
CREATE TABLE IF NOT EXISTS `ecom_vorder_items` (
`brand_id` int
,`brand_image` varchar(512)
,`brand_name1` varchar(100)
,`brand_name2` varchar(100)
,`brand_status_id` tinyint
,`cat_id` int
,`cat_image` varchar(512)
,`cat_name1` varchar(100)
,`cat_name2` varchar(100)
,`cat_order` int
,`cat_status_id` tinyint
,`curn_color` varchar(100)
,`curn_id` int
,`curn_name` varchar(100)
,`curn_rate` decimal(10,2)
,`curn_status_id` tinyint
,`curn_symbole` varchar(512)
,`cust_address` varchar(256)
,`cust_id` int
,`cust_logon` varchar(100)
,`cust_mobile` varchar(25)
,`cust_name` varchar(256)
,`cust_orgnum` varchar(15)
,`cust_phone` varchar(25)
,`cust_status_id` tinyint
,`item_amt` decimal(10,2)
,`item_cprice` decimal(10,2)
,`item_disc` decimal(10,2)
,`item_id` int
,`item_net` decimal(10,2)
,`item_price` decimal(10,2)
,`item_prod_id` int
,`item_qnt` decimal(10,2)
,`item_size_id` int
,`ord_addat` datetime
,`ord_curn_rate` decimal(10,5)
,`ord_id` int
,`ord_status_id` tinyint
,`prod_cprice` decimal(10,2)
,`prod_desc1` text
,`prod_desc2` text
,`prod_id` int
,`prod_image` varchar(512)
,`prod_mnum` int
,`prod_name1` varchar(256)
,`prod_name2` varchar(256)
,`prod_price` decimal(10,2)
,`prod_qnt` decimal(10,2)
,`prod_status_id` tinyint
,`size_anum` int
,`size_box` decimal(10,2)
,`size_cprice` decimal(10,2)
,`size_id` int
,`size_name` varchar(20)
,`size_price` decimal(10,2)
,`size_qnt` decimal(10,2)
,`size_snum` int
,`tag_classname` varchar(100)
,`tag_id` int
,`tag_name` varchar(100)
,`tag_status_id` tinyint
,`unit_id` smallint
,`unit_name` varchar(100)
,`unit_rem` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vproducts`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `ecom_vproducts`;
CREATE TABLE IF NOT EXISTS `ecom_vproducts` (
`brand_id` int
,`brand_image` varchar(512)
,`brand_name1` varchar(100)
,`brand_name2` varchar(100)
,`brand_status_id` tinyint
,`cat_id` int
,`cat_image` varchar(512)
,`cat_name1` varchar(100)
,`cat_name2` varchar(100)
,`cat_order` int
,`cat_status_id` tinyint
,`prod_cprice` decimal(10,2)
,`prod_desc1` text
,`prod_desc2` text
,`prod_id` int
,`prod_image` varchar(512)
,`prod_mnum` int
,`prod_name1` varchar(256)
,`prod_name2` varchar(256)
,`prod_price` decimal(10,2)
,`prod_qnt` decimal(10,2)
,`prod_status_id` tinyint
,`tag_classname` varchar(100)
,`tag_id` int
,`tag_name` varchar(100)
,`tag_status_id` tinyint
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vproduct_sizes`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `ecom_vproduct_sizes`;
CREATE TABLE IF NOT EXISTS `ecom_vproduct_sizes` (
`brand_id` int
,`brand_image` varchar(512)
,`brand_name1` varchar(100)
,`brand_name2` varchar(100)
,`brand_status_id` tinyint
,`cat_id` int
,`cat_image` varchar(512)
,`cat_name1` varchar(100)
,`cat_name2` varchar(100)
,`cat_order` int
,`cat_status_id` tinyint
,`prod_cprice` decimal(10,2)
,`prod_desc1` text
,`prod_desc2` text
,`prod_id` int
,`prod_image` varchar(512)
,`prod_mnum` int
,`prod_name1` varchar(256)
,`prod_name2` varchar(256)
,`prod_price` decimal(10,2)
,`prod_qnt` decimal(10,2)
,`prod_status_id` tinyint
,`size_anum` int
,`size_box` decimal(10,2)
,`size_cprice` decimal(10,2)
,`size_id` int
,`size_name` varchar(20)
,`size_price` decimal(10,2)
,`size_qnt` decimal(10,2)
,`size_snum` int
,`tag_classname` varchar(100)
,`tag_id` int
,`tag_name` varchar(100)
,`tag_status_id` tinyint
,`unit_id` smallint
,`unit_name` varchar(100)
,`unit_rem` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_wishlist`
--

DROP TABLE IF EXISTS `ecom_wishlist`;
CREATE TABLE IF NOT EXISTS `ecom_wishlist` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `token` varchar(50) NOT NULL COMMENT 'Token',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date Time',
  `status_id` tinyint NOT NULL DEFAULT '0' COMMENT 'Status',
  `prod_id` int NOT NULL COMMENT 'Product',
  PRIMARY KEY (`id`),
  UNIQUE KEY `wish_token` (`token`,`prod_id`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `phs_cod_gender`
--

DROP TABLE IF EXISTS `phs_cod_gender`;
CREATE TABLE IF NOT EXISTS `phs_cod_gender` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_cod_gender`
--

INSERT INTO `phs_cod_gender` (`id`, `name`, `rem`) VALUES
(1, 'Male', NULL),
(2, 'Female', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_cod_status`
--

DROP TABLE IF EXISTS `phs_cod_status`;
CREATE TABLE IF NOT EXISTS `phs_cod_status` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_cod_status`
--

INSERT INTO `phs_cod_status` (`id`, `name`, `rem`) VALUES
(1, 'Active', NULL),
(2, 'Disabled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_cod_yes_no`
--

DROP TABLE IF EXISTS `phs_cod_yes_no`;
CREATE TABLE IF NOT EXISTS `phs_cod_yes_no` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_cod_yes_no`
--

INSERT INTO `phs_cod_yes_no` (`id`, `name`, `rem`) VALUES
(1, 'Yes', NULL),
(2, 'No', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_lang`
--

DROP TABLE IF EXISTS `phs_lang`;
CREATE TABLE IF NOT EXISTS `phs_lang` (
  `id` int NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `code` varchar(10) NOT NULL COMMENT 'Language Code',
  `dir` varchar(10) NOT NULL DEFAULT 'ltr' COMMENT 'Direction',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_lang`
--

INSERT INTO `phs_lang` (`id`, `name`, `code`, `dir`, `rem`) VALUES
(1, 'Arabic', 'ar', 'rtl', NULL),
(2, 'English', 'en', 'ltr', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_log`
--

DROP TABLE IF EXISTS `phs_log`;
CREATE TABLE IF NOT EXISTS `phs_log` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `log_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Log Text',
  `log_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Inserted AT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phs_pref`
--

DROP TABLE IF EXISTS `phs_pref`;
CREATE TABLE IF NOT EXISTS `phs_pref` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `key` varchar(50) NOT NULL COMMENT 'Key',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `value` varchar(100) NOT NULL COMMENT 'Value',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_pref`
--

INSERT INTO `phs_pref` (`id`, `key`, `name`, `value`, `rem`) VALUES
(1, 'Def_Direction', 'Default GUI Direction, LTR, RTL', 'ltr', NULL),
(2, 'Def_Language', 'Default GUI Language, ar, en ...', 'en', NULL),
(3, 'Def_Theme', 'Default GUI Theme light, dark', 'light', NULL),
(4, 'Def_GUI_ASide', 'Display aside', 'true', NULL),
(5, 'Def_GUI_ASide_Min', 'is ASide Minimized', 'true', NULL),
(6, 'Def_GUI_TOP_Menu', 'Display Top Menu', 'true', NULL),
(7, 'Def_GUI_TOP_Btns', 'Display Top Buttons', 'true', NULL),
(8, 'Def_Workperiod', 'Default Work Period', '0', NULL),
(9, 'IsWorkperiod', 'Is Copy have Work Period', 'true', NULL),
(10, 'Def_GUI_ASide_Hidden', 'is ASide Hidden when minimized', 'false', NULL),
(12, 'Copy_Title', 'Application Name', 'Folly CMS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_program`
--

DROP TABLE IF EXISTS `phs_program`;
CREATE TABLE IF NOT EXISTS `phs_program` (
  `id` int NOT NULL COMMENT 'PK',
  `prog_id` int DEFAULT NULL COMMENT 'Parent',
  `sys_id` int NOT NULL DEFAULT '0' COMMENT 'System',
  `grp_id` tinyint NOT NULL DEFAULT '127' COMMENT 'Minimum Permission Group',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `type_id` tinyint NOT NULL DEFAULT '0' COMMENT 'Type',
  `open` tinyint NOT NULL DEFAULT '0' COMMENT 'Open Type',
  `ord` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `icon` varchar(50) DEFAULT NULL COMMENT 'Icon',
  `file` varchar(100) DEFAULT NULL COMMENT 'Filename',
  `css` varchar(100) DEFAULT NULL COMMENT 'CSS File',
  `js` varchar(100) DEFAULT NULL COMMENT 'JS File',
  `attributes` varchar(512) DEFAULT NULL COMMENT 'Special Attributes',
  `params` varchar(50) NOT NULL COMMENT 'Parameters',
  PRIMARY KEY (`id`),
  KEY `mprg_id` (`prog_id`),
  KEY `type_id` (`type_id`),
  KEY `status_id` (`status_id`),
  KEY `sys_id` (`sys_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_program`
--

INSERT INTO `phs_program` (`id`, `prog_id`, `sys_id`, `grp_id`, `status_id`, `type_id`, `open`, `ord`, `name`, `icon`, `file`, `css`, `js`, `attributes`, `params`) VALUES
(0, NULL, 0, 127, 1, 0, 0, 0, 'Main Menu', NULL, NULL, NULL, NULL, NULL, ''),
(11, NULL, 0, 127, 1, 0, 0, 0, 'Top Menu', NULL, NULL, NULL, NULL, NULL, ''),
(12, NULL, 0, 127, 1, 0, 0, 0, 'User Menu', NULL, NULL, NULL, NULL, NULL, ''),
(13, NULL, 0, 127, 1, 0, 0, 0, 'Tool Menu', NULL, NULL, NULL, NULL, NULL, ''),
(14, NULL, 0, 127, 1, 0, 0, 0, 'Top Bar', NULL, NULL, NULL, NULL, NULL, ''),
(1101, 0, 1901, 127, 1, 1, 0, 1001, 'Dashboard', 'bi bi-columns-gap', 'dashboard', NULL, 'dashboard', NULL, ''),
(1401, 14, 0, 127, 1, 4, 0, 1401, 'Top Bar Item', 'bi bi-bullseye', NULL, NULL, NULL, NULL, ''),
(1901, 0, 1901, 127, 2, 1, 0, 1901, 'eCommerce', 'bi bi-app-indicator', NULL, NULL, NULL, NULL, ''),
(9001, 0, 9001, 127, 1, 1, 0, 9001, 'Management', 'bi bi-gear', NULL, NULL, NULL, NULL, ''),
(9901, 12, 9901, 127, 1, 1, 0, 9901, 'User', 'bi bi-person-circle', NULL, NULL, NULL, NULL, ''),
(1901011, 0, 1901, 127, 1, 3, 0, 2030, 'Products', 'bi bi-vinyl', 'ecom/products', NULL, 'ecom/products', NULL, ''),
(1901012, 0, 1901, 127, 1, 3, 0, 2010, 'Brands', 'bi bi-vinyl', 'ecom/brands', NULL, 'ecom/brands', NULL, ''),
(1901013, 0, 1901, 127, 2, 3, 0, 2030, 'Customers', 'bi bi-vinyl', 'ecom/customers', NULL, 'ecom/customers', NULL, ''),
(1901015, 0, 1901, 127, 1, 3, 0, 2030, 'Product Facts', 'bi bi-vinyl', 'ecom/productFacts', NULL, 'ecom/productFacts', NULL, ''),
(1901090, 0, 1901, 127, 1, 3, 0, 5010, 'Advertise', 'bi bi-vinyl', 'ecom/adv', NULL, 'ecom/adv', NULL, ''),
(9001010, 9001, 9001, 0, 1, 3, 0, 10, 'Permission Groups', 'bi bi-person-check-fill', 'cpy/pgrp', NULL, 'cpy/pgrp', NULL, ''),
(9001011, 9001, 9001, 127, 1, 3, 0, 11, 'Users', 'bi bi-person-circle', 'cpy/users', NULL, 'cpy/users', NULL, ''),
(9001012, 0, 1901, 127, 2, 3, 0, 12, 'Services', 'bi bi-vinyl', 'ecom/service', NULL, 'ecom/service', NULL, ''),
(9001013, 0, 1901, 127, 1, 3, 0, 2020, 'Categories', 'bi bi-vinyl', 'ecom/categories', NULL, 'ecom/categories', NULL, ''),
(9001014, 0, 1901, 127, 1, 3, 0, 2035, 'Tags', 'bi bi-vinyl', 'ecom/tag', NULL, 'ecom/tag', NULL, ''),
(9001090, 0, 1901, 127, 1, 3, 0, 5020, 'FAQ', 'bi bi-vinyl', 'ecom/faq', NULL, 'ecom/faq', NULL, ''),
(9001095, 0, 1901, 127, 1, 3, 0, 5025, 'Banners', 'bi bi-vinyl', 'ecom/banners', NULL, 'ecom/banners', NULL, ''),
(9901101, 9901, 9901, 127, 1, 5, 0, 11, 'Change Password', 'bi bi-key', 'PhChangePassword', NULL, NULL, 'data-toggle=\"modal\" data-target=\"#changePasswordModal\"', ''),
(19011010, 0, 1901, 127, 2, 3, 0, 2010, 'Orders', 'bi bi-play', 'ecom/orders', NULL, 'ecom/orders', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `phs_program_type`
--

DROP TABLE IF EXISTS `phs_program_type`;
CREATE TABLE IF NOT EXISTS `phs_program_type` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_program_type`
--

INSERT INTO `phs_program_type` (`id`, `name`) VALUES
(0, 'Menu'),
(2, 'Menu Item'),
(3, 'Menu Link'),
(5, 'Modal'),
(1, 'Sub Menu'),
(4, 'Top-Bar Item');

-- --------------------------------------------------------

--
-- Table structure for table `phs_system`
--

DROP TABLE IF EXISTS `phs_system`;
CREATE TABLE IF NOT EXISTS `phs_system` (
  `id` int NOT NULL COMMENT 'Id',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `status_id` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `phs_system`
--

INSERT INTO `phs_system` (`id`, `name`, `status_id`) VALUES
(0, 'Public', 1),
(1901, 'eCommerce', 1),
(9001, 'Management', 1),
(9901, 'User', 1),
(9909, 'Supervisor', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `phs_vprogram`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `phs_vprogram`;
CREATE TABLE IF NOT EXISTS `phs_vprogram` (
`attributes` varchar(512)
,`css` varchar(100)
,`file` varchar(100)
,`grp_id` tinyint
,`icon` varchar(50)
,`id` int
,`js` varchar(100)
,`name` varchar(100)
,`open` tinyint
,`ord` smallint
,`prog_id` int
,`status_id` tinyint
,`status_name` varchar(100)
,`sys_id` int
,`sys_name` varchar(100)
,`type_id` tinyint
,`type_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `cpy_vuser`
--
DROP TABLE IF EXISTS `cpy_vuser`;

DROP VIEW IF EXISTS `cpy_vuser`;
CREATE VIEW `cpy_vuser`  AS SELECT `uu`.`id` AS `id`, `bb`.`id` AS `bran_id`, `bb`.`name` AS `bran_name`, `uu`.`grp_id` AS `grp_id`, `uu`.`status_id` AS `status_id`, `uu`.`gender_id` AS `gender_id`, `uu`.`name` AS `name`, `uu`.`logon` AS `logon`, `uu`.`password` AS `password`, `uu`.`image` AS `image` FROM (`cpy_user` `uu` join `cpy_branch` `bb`) WHERE (`uu`.`bran_id` = `bb`.`id`)  ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vorders`
--
DROP TABLE IF EXISTS `ecom_vorders`;

DROP VIEW IF EXISTS `ecom_vorders`;
CREATE VIEW `ecom_vorders`  AS SELECT `o`.`id` AS `ord_id`, `o`.`rate` AS `ord_curn_rate`, `o`.`addat` AS `ord_addat`, `s`.`id` AS `status_id`, `s`.`name` AS `status_name`, `r`.`id` AS `curn_id`, `r`.`name` AS `curn_name`, `r`.`status_id` AS `curn_status_id`, `r`.`rate` AS `curn_rate`, `r`.`color` AS `curn_color`, `r`.`symbole` AS `curn_symbole`, `c`.`id` AS `cust_id`, `c`.`status_id` AS `cust_status_id`, `c`.`name` AS `cust_name`, `c`.`orgnum` AS `cust_orgnum`, `c`.`logon` AS `cust_logon`, `c`.`mobile` AS `cust_mobile`, `c`.`phone` AS `cust_phone`, `c`.`address` AS `cust_address` FROM (((`ecom_order` `o` join `ecom_curn` `r`) join `ecom_customer` `c`) join `ecom_order_status` `s`) WHERE ((`o`.`curn_id` = `r`.`id`) AND (`o`.`cust_id` = `c`.`id`) AND (`o`.`status_id` = `s`.`id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vorder_items`
--
DROP TABLE IF EXISTS `ecom_vorder_items`;

DROP VIEW IF EXISTS `ecom_vorder_items`;
CREATE VIEW `ecom_vorder_items`  AS SELECT `o`.`id` AS `ord_id`, `o`.`rate` AS `ord_curn_rate`, `o`.`addat` AS `ord_addat`, `o`.`status_id` AS `ord_status_id`, `r`.`id` AS `curn_id`, `r`.`name` AS `curn_name`, `r`.`status_id` AS `curn_status_id`, `r`.`rate` AS `curn_rate`, `r`.`color` AS `curn_color`, `r`.`symbole` AS `curn_symbole`, `cs`.`id` AS `cust_id`, `cs`.`status_id` AS `cust_status_id`, `cs`.`name` AS `cust_name`, `cs`.`orgnum` AS `cust_orgnum`, `cs`.`logon` AS `cust_logon`, `cs`.`mobile` AS `cust_mobile`, `cs`.`phone` AS `cust_phone`, `cs`.`address` AS `cust_address`, `i`.`id` AS `item_id`, `i`.`prod_id` AS `item_prod_id`, `i`.`size_id` AS `item_size_id`, `i`.`qnt` AS `item_qnt`, `i`.`price` AS `item_price`, `i`.`cprice` AS `item_cprice`, `i`.`amt` AS `item_amt`, `i`.`disc` AS `item_disc`, `i`.`net` AS `item_net`, `b`.`id` AS `brand_id`, `b`.`status_id` AS `brand_status_id`, `b`.`name1` AS `brand_name1`, `b`.`name2` AS `brand_name2`, `b`.`image` AS `brand_image`, `ct`.`id` AS `cat_id`, `ct`.`status_id` AS `cat_status_id`, `ct`.`order` AS `cat_order`, `ct`.`name1` AS `cat_name1`, `ct`.`name2` AS `cat_name2`, `ct`.`image` AS `cat_image`, `t`.`id` AS `tag_id`, `t`.`status_id` AS `tag_status_id`, `t`.`name` AS `tag_name`, `t`.`classname` AS `tag_classname`, `p`.`id` AS `prod_id`, `p`.`mnum` AS `prod_mnum`, `p`.`status_id` AS `prod_status_id`, `p`.`name1` AS `prod_name1`, `p`.`name2` AS `prod_name2`, `p`.`qnt` AS `prod_qnt`, `p`.`price` AS `prod_price`, `p`.`cprice` AS `prod_cprice`, `p`.`desc1` AS `prod_desc1`, `p`.`desc2` AS `prod_desc2`, `p`.`image` AS `prod_image`, `s`.`id` AS `size_id`, `s`.`snum` AS `size_snum`, `s`.`anum` AS `size_anum`, `s`.`name` AS `size_name`, `s`.`box` AS `size_box`, `s`.`qnt` AS `size_qnt`, `s`.`price` AS `size_price`, `s`.`cprice` AS `size_cprice`, `u`.`id` AS `unit_id`, `u`.`name` AS `unit_name`, `u`.`rem` AS `unit_rem` FROM (((((((((`ecom_order` `o` join `ecom_curn` `r`) join `ecom_customer` `cs`) join `ecom_order_item` `i`) join `ecom_product` `p`) join `ecom_brand` `b`) join `ecom_cat` `ct`) join `ecom_tag` `t`) join `ecom_prod_size` `s`) join `ecom_unit` `u`) WHERE ((`o`.`curn_id` = `r`.`id`) AND (`o`.`cust_id` = `cs`.`id`) AND (`p`.`brand_id` = `b`.`id`) AND (`p`.`cat_id` = `ct`.`id`) AND (`p`.`tag_id` = `t`.`id`) AND (`s`.`prod_id` = `p`.`id`) AND (`s`.`unit_id` = `u`.`id`) AND (`i`.`order_id` = `o`.`id`) AND (`i`.`prod_id` = `p`.`id`) AND (`i`.`size_id` = `s`.`id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vproducts`
--
DROP TABLE IF EXISTS `ecom_vproducts`;

DROP VIEW IF EXISTS `ecom_vproducts`;
CREATE VIEW `ecom_vproducts`  AS SELECT `b`.`id` AS `brand_id`, `b`.`status_id` AS `brand_status_id`, `b`.`name1` AS `brand_name1`, `b`.`name2` AS `brand_name2`, `b`.`image` AS `brand_image`, `c`.`id` AS `cat_id`, `c`.`status_id` AS `cat_status_id`, `c`.`order` AS `cat_order`, `c`.`name1` AS `cat_name1`, `c`.`name2` AS `cat_name2`, `c`.`image` AS `cat_image`, `t`.`id` AS `tag_id`, `t`.`status_id` AS `tag_status_id`, `t`.`name` AS `tag_name`, `t`.`classname` AS `tag_classname`, `p`.`id` AS `prod_id`, `p`.`mnum` AS `prod_mnum`, `p`.`status_id` AS `prod_status_id`, `p`.`name1` AS `prod_name1`, `p`.`name2` AS `prod_name2`, `p`.`qnt` AS `prod_qnt`, `p`.`price` AS `prod_price`, `p`.`cprice` AS `prod_cprice`, `p`.`desc1` AS `prod_desc1`, `p`.`desc2` AS `prod_desc2`, `p`.`image` AS `prod_image` FROM (((`ecom_product` `p` join `ecom_brand` `b`) join `ecom_cat` `c`) join `ecom_tag` `t`) WHERE ((`p`.`brand_id` = `b`.`id`) AND (`p`.`cat_id` = `c`.`id`) AND (`p`.`tag_id` = `t`.`id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vproduct_sizes`
--
DROP TABLE IF EXISTS `ecom_vproduct_sizes`;

DROP VIEW IF EXISTS `ecom_vproduct_sizes`;
CREATE VIEW `ecom_vproduct_sizes`  AS SELECT `b`.`id` AS `brand_id`, `b`.`status_id` AS `brand_status_id`, `b`.`name1` AS `brand_name1`, `b`.`name2` AS `brand_name2`, `b`.`image` AS `brand_image`, `c`.`id` AS `cat_id`, `c`.`status_id` AS `cat_status_id`, `c`.`order` AS `cat_order`, `c`.`name1` AS `cat_name1`, `c`.`name2` AS `cat_name2`, `c`.`image` AS `cat_image`, `t`.`id` AS `tag_id`, `t`.`status_id` AS `tag_status_id`, `t`.`name` AS `tag_name`, `t`.`classname` AS `tag_classname`, `p`.`id` AS `prod_id`, `p`.`mnum` AS `prod_mnum`, `p`.`status_id` AS `prod_status_id`, `p`.`name1` AS `prod_name1`, `p`.`name2` AS `prod_name2`, `p`.`qnt` AS `prod_qnt`, `p`.`price` AS `prod_price`, `p`.`cprice` AS `prod_cprice`, `p`.`desc1` AS `prod_desc1`, `p`.`desc2` AS `prod_desc2`, `p`.`image` AS `prod_image`, `s`.`id` AS `size_id`, `s`.`snum` AS `size_snum`, `s`.`anum` AS `size_anum`, `s`.`name` AS `size_name`, `s`.`box` AS `size_box`, `s`.`qnt` AS `size_qnt`, `s`.`price` AS `size_price`, `s`.`cprice` AS `size_cprice`, `u`.`id` AS `unit_id`, `u`.`name` AS `unit_name`, `u`.`rem` AS `unit_rem` FROM (((((`ecom_product` `p` join `ecom_brand` `b`) join `ecom_cat` `c`) join `ecom_tag` `t`) join `ecom_prod_size` `s`) join `ecom_unit` `u`) WHERE ((`p`.`brand_id` = `b`.`id`) AND (`p`.`cat_id` = `c`.`id`) AND (`p`.`tag_id` = `t`.`id`) AND (`s`.`prod_id` = `p`.`id`) AND (`s`.`unit_id` = `u`.`id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `phs_vprogram`
--
DROP TABLE IF EXISTS `phs_vprogram`;

DROP VIEW IF EXISTS `phs_vprogram`;
CREATE VIEW `phs_vprogram`  AS SELECT `p`.`id` AS `id`, `p`.`prog_id` AS `prog_id`, `p`.`name` AS `name`, `p`.`ord` AS `ord`, ifnull(`p`.`icon`,' ') AS `icon`, `p`.`grp_id` AS `grp_id`, `p`.`open` AS `open`, `s`.`id` AS `status_id`, `s`.`name` AS `status_name`, `p`.`file` AS `file`, `p`.`css` AS `css`, `p`.`js` AS `js`, `p`.`attributes` AS `attributes`, `y`.`id` AS `sys_id`, `y`.`name` AS `sys_name`, `t`.`id` AS `type_id`, `t`.`name` AS `type_name` FROM (((`phs_program` `p` join `phs_system` `y`) join `phs_program_type` `t`) join `phs_cod_status` `s`) WHERE ((`p`.`sys_id` = `y`.`id`) AND (`p`.`type_id` = `t`.`id`) AND (`p`.`status_id` = `s`.`id`))  ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpy_perm`
--
ALTER TABLE `cpy_perm`
  ADD CONSTRAINT `cpy_perm_ibfk_2` FOREIGN KEY (`prog_id`) REFERENCES `phs_program` (`id`),
  ADD CONSTRAINT `cpy_perm_ibfk_3` FOREIGN KEY (`grp_id`) REFERENCES `cpy_perm_grp` (`id`);

--
-- Constraints for table `cpy_token`
--
ALTER TABLE `cpy_token`
  ADD CONSTRAINT `cpy_token_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`id`),
  ADD CONSTRAINT `cpy_token_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `cpy_user`
--
ALTER TABLE `cpy_user`
  ADD CONSTRAINT `cpy_user_ibfk_1` FOREIGN KEY (`grp_id`) REFERENCES `cpy_perm_grp` (`id`),
  ADD CONSTRAINT `cpy_user_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_brand`
--
ALTER TABLE `ecom_brand`
  ADD CONSTRAINT `ecom_brand_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_cart`
--
ALTER TABLE `ecom_cart`
  ADD CONSTRAINT `ecom_cart_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`),
  ADD CONSTRAINT `ecom_cart_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `ecom_prod_size` (`id`),
  ADD CONSTRAINT `ecom_cart_ibfk_3` FOREIGN KEY (`cust_id`) REFERENCES `ecom_customer` (`id`);

--
-- Constraints for table `ecom_cat`
--
ALTER TABLE `ecom_cat`
  ADD CONSTRAINT `ecom_cat_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_curn`
--
ALTER TABLE `ecom_curn`
  ADD CONSTRAINT `ecom_curn_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_customer`
--
ALTER TABLE `ecom_customer`
  ADD CONSTRAINT `ecom_customer_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_order`
--
ALTER TABLE `ecom_order`
  ADD CONSTRAINT `ecom_order_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `ecom_customer` (`id`),
  ADD CONSTRAINT `ecom_order_ibfk_2` FOREIGN KEY (`curn_id`) REFERENCES `ecom_curn` (`id`),
  ADD CONSTRAINT `ecom_order_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `ecom_order_status` (`id`);

--
-- Constraints for table `ecom_order_item`
--
ALTER TABLE `ecom_order_item`
  ADD CONSTRAINT `ecom_order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ecom_order` (`id`),
  ADD CONSTRAINT `ecom_order_item_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`),
  ADD CONSTRAINT `ecom_order_item_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `ecom_prod_size` (`id`);

--
-- Constraints for table `ecom_order_service`
--
ALTER TABLE `ecom_order_service`
  ADD CONSTRAINT `ecom_order_service_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ecom_order` (`id`),
  ADD CONSTRAINT `ecom_order_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `ecom_service` (`id`),
  ADD CONSTRAINT `ecom_order_service_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `ecom_amt_type` (`id`);

--
-- Constraints for table `ecom_product`
--
ALTER TABLE `ecom_product`
  ADD CONSTRAINT `ecom_product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `ecom_cat` (`id`),
  ADD CONSTRAINT `ecom_product_ibfk_7` FOREIGN KEY (`brand_id`) REFERENCES `ecom_brand` (`id`),
  ADD CONSTRAINT `ecom_product_ibfk_8` FOREIGN KEY (`tag_id`) REFERENCES `ecom_tag` (`id`),
  ADD CONSTRAINT `ecom_product_ibfk_9` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_prod_facts`
--
ALTER TABLE `ecom_prod_facts`
  ADD CONSTRAINT `ecom_prod_facts_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `ecom_prod_image`
--
ALTER TABLE `ecom_prod_image`
  ADD CONSTRAINT `ecom_prod_image_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`);

--
-- Constraints for table `ecom_prod_review`
--
ALTER TABLE `ecom_prod_review`
  ADD CONSTRAINT `ecom_prod_review_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`),
  ADD CONSTRAINT `ecom_prod_review_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`);

--
-- Constraints for table `ecom_prod_size`
--
ALTER TABLE `ecom_prod_size`
  ADD CONSTRAINT `ecom_prod_size_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`),
  ADD CONSTRAINT `ecom_prod_size_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `ecom_unit` (`id`);

--
-- Constraints for table `ecom_service`
--
ALTER TABLE `ecom_service`
  ADD CONSTRAINT `ecom_service_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `ecom_amt_type` (`id`);

--
-- Constraints for table `ecom_tag`
--
ALTER TABLE `ecom_tag`
  ADD CONSTRAINT `ecom_tag_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);

--
-- Constraints for table `ecom_wishlist`
--
ALTER TABLE `ecom_wishlist`
  ADD CONSTRAINT `ecom_wishlist_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `ecom_product` (`id`);

--
-- Constraints for table `phs_program`
--
ALTER TABLE `phs_program`
  ADD CONSTRAINT `phs_program_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `phs_program` (`id`),
  ADD CONSTRAINT `phs_program_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `phs_program_type` (`id`),
  ADD CONSTRAINT `phs_program_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`),
  ADD CONSTRAINT `phs_program_ibfk_4` FOREIGN KEY (`sys_id`) REFERENCES `phs_system` (`id`);

--
-- Constraints for table `phs_system`
--
ALTER TABLE `phs_system`
  ADD CONSTRAINT `phs_system_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_cod_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
