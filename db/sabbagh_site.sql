-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2026 at 10:56 AM
-- Server version: 8.4.9
-- PHP Version: 8.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabbagh_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpy_branch`
--

CREATE TABLE `cpy_branch` (
  `id` smallint NOT NULL COMMENT 'PK',
  `name` varchar(250) NOT NULL COMMENT 'Name',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Phone Number',
  `address` varchar(256) DEFAULT NULL COMMENT 'Address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cpy_branch`
--

INSERT INTO `cpy_branch` (`id`, `name`, `phone`, `address`) VALUES
(0, '-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_perm`
--

CREATE TABLE `cpy_perm` (
  `id` int NOT NULL COMMENT 'PK',
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
  `spc` tinyint NOT NULL DEFAULT '0' COMMENT 'Special'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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

CREATE TABLE `cpy_perm_grp` (
  `id` int NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `wpstatus_id` tinyint NOT NULL DEFAULT '2' COMMENT 'Workperiod Status',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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

CREATE TABLE `cpy_token` (
  `id` int NOT NULL COMMENT 'PK',
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
  `host` varchar(100) DEFAULT NULL COMMENT 'Host'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cpy_user`
--

CREATE TABLE `cpy_user` (
  `id` int NOT NULL COMMENT 'PK',
  `bran_id` smallint NOT NULL DEFAULT '0' COMMENT 'Branch',
  `grp_id` int NOT NULL COMMENT 'Permission Group',
  `gender_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Gender',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `logon` varchar(50) NOT NULL COMMENT 'Logon Name',
  `password` varchar(512) DEFAULT NULL COMMENT 'Password',
  `image` varchar(512) DEFAULT NULL COMMENT 'User Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cpy_user`
--

INSERT INTO `cpy_user` (`id`, `bran_id`, `grp_id`, `gender_id`, `status_id`, `name`, `logon`, `password`, `image`) VALUES
(-9, 0, -1, 1, 1, 'System', 'system', 'eb0a191797624dd3a48fa681d3061212', NULL),
(-1, 0, -1, 1, 1, 'Supervisor', 'super', 'eb0a191797624dd3a48fa681d3061212', NULL),
(0, 0, 0, 1, 1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL),
(93, 0, 3, 1, 1, 'مدير المحتوى', 'treats', '152df8c4a937be35f5f0663c541eec01', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cpy_vuser`
-- (See below for the actual view)
--
CREATE TABLE `cpy_vuser` (
`id` int
,`bran_id` smallint
,`bran_name` varchar(250)
,`grp_id` int
,`status_id` tinyint
,`gender_id` tinyint
,`name` varchar(100)
,`logon` varchar(50)
,`password` varchar(512)
,`image` varchar(512)
);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_about`
--

CREATE TABLE `ecom_about` (
  `id` int NOT NULL COMMENT 'PK',
  `image` varchar(512) NOT NULL COMMENT 'Image',
  `text1` text NOT NULL COMMENT 'Text 1',
  `text2` text NOT NULL COMMENT 'Text 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_adv`
--

CREATE TABLE `ecom_adv` (
  `id` int NOT NULL COMMENT 'PK',
  `text1` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Text1',
  `text2` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Text2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_amt_type`
--

CREATE TABLE `ecom_amt_type` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `rem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Remarks'
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

CREATE TABLE `ecom_banner` (
  `id` int NOT NULL COMMENT 'Id',
  `order` int NOT NULL DEFAULT '0' COMMENT 'Order',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `image` varchar(512) NOT NULL COMMENT 'Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_brand`
--

CREATE TABLE `ecom_brand` (
  `id` int NOT NULL COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name1` varchar(100) NOT NULL COMMENT 'Name 1',
  `name2` varchar(100) NOT NULL COMMENT 'Name 2',
  `image` varchar(512) NOT NULL COMMENT 'Logo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_brand`
--

INSERT INTO `ecom_brand` (`id`, `status_id`, `name1`, `name2`, `image`) VALUES
(0, 1, '-', '-', 'Brands.png'),
(1, 1, 'Sabbagh', 'صباغ', 'sabbagh.png');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_cart`
--

CREATE TABLE `ecom_cart` (
  `id` int NOT NULL COMMENT 'PK',
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
  `net` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Net Amount'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_cat`
--

CREATE TABLE `ecom_cat` (
  `id` int NOT NULL COMMENT 'PK',
  `status_id` tinyint NOT NULL COMMENT 'Status',
  `order` int NOT NULL DEFAULT '0' COMMENT 'Order',
  `wdays` smallint NOT NULL DEFAULT '365' COMMENT 'Warranty',
  `name1` varchar(100) NOT NULL COMMENT 'Name 1',
  `name2` varchar(100) NOT NULL COMMENT 'Name 2',
  `image` varchar(512) DEFAULT NULL COMMENT 'Image',
  `descrip` text NOT NULL COMMENT 'Description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_cat`
--

INSERT INTO `ecom_cat` (`id`, `status_id`, `order`, `wdays`, `name1`, `name2`, `image`, `descrip`) VALUES
(0, 2, 0, 365, '-', '-', NULL, ''),
(1, 1, 1, 365, 'Shampoo', '', '01-cat.png', ''),
(2, 1, 2, 365, 'Shower Gel', '', '02-cat.png', ''),
(3, 1, 3, 365, 'Hand Sanitizer Gel', '', '03-cat.png', ''),
(4, 1, 4, 365, 'Sanitizer Spray', '', '04-cat.png', ''),
(5, 1, 5, 365, 'Hair Coloration', '', '05-cat.png', ''),
(6, 1, 6, 365, 'Bleaching Powder', '', '06-cat.png', ''),
(7, 1, 7, 365, 'Nail Polish Remover', '', '07-cat.png', ''),
(8, 1, 8, 365, 'Hand Cream', '', '08-cat.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_curn`
--

CREATE TABLE `ecom_curn` (
  `id` int NOT NULL COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rate` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT 'Rate',
  `color` varchar(100) DEFAULT NULL COMMENT 'Color',
  `symbole` varchar(512) DEFAULT NULL COMMENT 'Symbole'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_curn`
--

INSERT INTO `ecom_curn` (`id`, `status_id`, `name`, `rate`, `color`, `symbole`) VALUES
(1, 1, 'KR', 1.00, '#56ffb0', 'KR'),
(2, 1, 'EUR', 11.00, '#ff9556', 'EUR'),
(3, 1, 'USD', 10.00, '#ff9556', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_customer`
--

CREATE TABLE `ecom_customer` (
  `id` int NOT NULL COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '2' COMMENT 'Status',
  `name` varchar(256) NOT NULL COMMENT 'Company Name',
  `orgnum` varchar(15) NOT NULL COMMENT 'Organization Number',
  `logon` varchar(100) NOT NULL COMMENT 'Logon Name',
  `pwd` varchar(1024) NOT NULL COMMENT 'Password',
  `mobile` varchar(25) NOT NULL COMMENT 'Mobile',
  `phone` varchar(25) DEFAULT NULL COMMENT 'Phone',
  `address` varchar(256) DEFAULT NULL COMMENT 'Address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_faq`
--

CREATE TABLE `ecom_faq` (
  `id` int NOT NULL COMMENT 'PK',
  `ord` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `qtext` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Question',
  `atext` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Answer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `ecom_order` (
  `id` int NOT NULL COMMENT 'PK',
  `cust_id` int NOT NULL COMMENT 'Customer',
  `curn_id` int NOT NULL COMMENT 'Currency',
  `status_id` tinyint NOT NULL DEFAULT '0' COMMENT 'Status',
  `rate` decimal(10,5) NOT NULL DEFAULT '1.00000' COMMENT 'Currency Rate',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_item`
--

CREATE TABLE `ecom_order_item` (
  `id` int NOT NULL COMMENT 'PK',
  `order_id` int NOT NULL COMMENT 'Order',
  `prod_id` int NOT NULL COMMENT 'Product',
  `size_id` int NOT NULL COMMENT 'Size',
  `qnt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantity',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price By Product Currency',
  `cprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Price By Customer Currency',
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount',
  `disc` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Discount',
  `net` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Net Amount'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_service`
--

CREATE TABLE `ecom_order_service` (
  `id` int NOT NULL COMMENT 'PK',
  `order_id` int NOT NULL COMMENT 'Order',
  `service_id` int NOT NULL COMMENT 'Service',
  `type_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Service Type Amount OR Percent',
  `amtperc` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount OR Percent',
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Amount'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_status`
--

CREATE TABLE `ecom_order_status` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name'
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

CREATE TABLE `ecom_product` (
  `id` int NOT NULL COMMENT 'PK',
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
  `image` varchar(512) DEFAULT NULL COMMENT 'Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_product`
--

INSERT INTO `ecom_product` (`id`, `mnum`, `brand_id`, `status_id`, `cat_id`, `tag_id`, `name1`, `name2`, `qnt`, `price`, `cprice`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `image`) VALUES
(11, 11, 0, 1, 1, 0, 'Aloe Vera', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Aloe Vera.png'),
(12, 12, 0, 1, 1, 0, 'Antidandruff', 'Antidandruff', 0.00, 0.00, 0.00, 'Aqua, Sodium Laureth Sulfate, Lanolin, Cocamidopropyl Betaine, Cocamide DEA and Glycerin, Sodium Chloride, Glycol Didtearate, Glycerin, Perfume, Disodium hydrogen Phosphate, Monosodium Phosphate, Methylchloroiso-thiazolinone / Methylisothiazolinone, Citric Acid, polyquaternium-10, Pirocton Olamine,C.l:42090.', 'PARABEN FREE', 'In case of content with eyes, rinse immediately with water. For external use only.', 'Keep away from sunlight, in a cool and dry place.', '', 'Joelle 2L Antidandruff.png'),
(13, 13, 0, 1, 1, 0, 'Conditioner', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Conditioner.png'),
(14, 14, 0, 1, 1, 0, 'Dry Hair', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Dry Hair.png'),
(15, 15, 0, 1, 1, 0, 'Greasy Hair', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Greasy Hair.png'),
(16, 16, 0, 1, 1, 0, 'Keratin', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Keratin.png'),
(17, 17, 0, 1, 1, 0, 'Kids Melon', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Kids Melon.png'),
(18, 18, 0, 1, 1, 0, 'Kids Mango', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Kids Mango.png'),
(19, 19, 0, 1, 1, 0, 'Laurel', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Laurel.png'),
(20, 20, 0, 1, 1, 0, 'Normal Hair', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Normal Hair.png'),
(21, 21, 0, 1, 1, 0, 'Olive Oil', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Olive Oil.png'),
(22, 22, 0, 1, 1, 0, 'Apricot', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 3L 2x1 Apricot.png'),
(23, 23, 0, 1, 1, 0, 'Apple', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 3L 2x1 Apple.png'),
(24, 24, 0, 1, 1, 0, 'Kiwi', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 3L 2x1 Kiwi.png'),
(25, 25, 0, 1, 1, 0, 'Tropical Fruits', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 3L 2x1 Tropical Fruits.png'),
(31, 31, 0, 1, 2, 0, 'Exotica', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Exotica.png'),
(32, 32, 0, 1, 2, 0, 'Harmony', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Harmony.png'),
(33, 33, 0, 1, 2, 0, 'Ocean', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Ocean.png'),
(34, 34, 0, 1, 2, 0, 'Paradise', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Paradise.png'),
(35, 35, 0, 1, 2, 0, 'Passion', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Passion.png'),
(36, 36, 0, 1, 2, 0, 'Red Fruits', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Red Fruits.png'),
(37, 37, 0, 1, 5, 0, '60ml Kit 1 Black', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 1 Black - Nigella.png'),
(38, 38, 0, 1, 5, 0, '60ml Kit 2.10 Blue Black', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 2.10 Blue Black - Blackberry.png'),
(39, 39, 0, 1, 5, 0, '60ml Kit 3 Dark Brown', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 3 Dark Brown - Arabica Coffee.png'),
(40, 40, 0, 1, 5, 0, '60ml Kit 4 Brown', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 4 Brown - Dark Chocolate.png'),
(41, 41, 0, 1, 6, 0, '20g', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'White Touch Powder.png'),
(42, 42, 0, 1, 7, 0, '100ml', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Nail Polish Remover.png'),
(43, 43, 0, 1, 8, 0, '75ml', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Soft Touch Hand Cream 75ml.png'),
(44, 44, 0, 1, 3, 0, '59ml Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59ml Original.png'),
(45, 45, 0, 1, 3, 0, '250ml Clean & Soft', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 250ml Clean & Soft.png'),
(46, 46, 0, 1, 3, 0, '250ml Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 250ml Original.png'),
(47, 47, 0, 1, 3, 0, '500ml Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 500ml Original.png'),
(48, 48, 0, 1, 3, 0, '1L Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 1L Original.png'),
(49, 49, 0, 1, 3, 0, '3L Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 3L Original.png'),
(50, 50, 0, 1, 3, 0, '3ml Sachet', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 3ml Sachet.png'),
(109, 109, 0, 1, 3, 0, '59ml Clean & Soft', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59ml Clean & Soft.png'),
(110, 110, 0, 1, 4, 0, '100ml Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Sanitizer Spray 100ml Original.png'),
(111, 111, 0, 1, 4, 0, '250ml Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Sanitizer Spray 250ml Original.png'),
(112, 112, 0, 1, 4, 0, '500ml Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Sanitizer Spray 500ml Original.png'),
(113, 113, 0, 1, 5, 0, '60ml Kit 5 Chestnut', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 5 Light Brown - Chestnut.png'),
(114, 114, 0, 1, 5, 0, '60ml Kit 5.3 Walnut', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 5.3 Light Golden Brown - Walnut.png'),
(115, 115, 0, 1, 5, 0, '60ml Kit 5.65 Red Fig', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 5.65 Light Red Mahogany Brown - Red Fig.png'),
(116, 116, 0, 1, 5, 0, '60ml Kit 6 Dark Blond', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 6 Dark Blond - Raisin.png'),
(117, 117, 0, 1, 5, 0, '60ml Kit 6.1 Dark Ash Blond', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 6.1 Dark Ash Blond.png'),
(118, 118, 0, 1, 5, 0, '60ml Kit 6.3 Honey', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 6.3 Golden Dark Blond - Honey.png'),
(119, 119, 0, 1, 5, 0, '60ml Kit 6.53 Gazelle', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 6.53 Golden Mahogany Dark Blond - Gazelle.png'),
(120, 120, 0, 1, 5, 0, '60ml Kit 6.62 Pomegranate', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 6.62 Dark Red Violet Blond - Pomegranate.png'),
(121, 121, 0, 1, 5, 0, '60ml Kit 6.7 Cacao', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 6.7 Chestnut Medium Blond - Cacao.png'),
(122, 122, 0, 1, 5, 0, '60ml Kit 7 Blond', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 7 Blond - Mustard Seed.png'),
(123, 123, 0, 1, 5, 0, '60ml Kit 7.01 Ash Natural Blond', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 7.01 Ash Natural Blond - Ginger.png'),
(124, 124, 0, 1, 5, 0, '60ml Kit 7.3 Hazelnut', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 7.3 Golden Blond - Hazelnut.png'),
(125, 125, 0, 1, 5, 0, '60ml Kit 7.32 Cappuccino', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 7.32 Beige Blond - Cappuccino.png'),
(126, 126, 0, 1, 5, 0, '60ml Kit 8 Light Blond - Beige', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 8 Light Blond - Beige.png'),
(127, 127, 0, 1, 5, 0, '60ml Kit 8.1 Light Ash Blond', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 8.1 Light Ash Blond.png'),
(128, 128, 0, 1, 5, 0, '60ml Kit 9.1 Cashew', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 9.1 Very Light Blond - Cashew.png'),
(129, 129, 0, 1, 5, 0, '60ml Kit 10 Wheat', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 10 Very Very Light Blond - Wheat.png'),
(130, 130, 0, 1, 5, 0, '60ml Kit 10.1 Platinum Ash Blond', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 10.1 Platinum Ash Blond.png'),
(134, 134, 0, 1, 1, 0, 'Kids Peach', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Kids Peach.png'),
(135, 135, 0, 1, 1, 0, 'Kids Strawberry', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L Kids Strawberry.png'),
(139, 139, 0, 1, 2, 0, 'Vanilla', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L vanilla.png'),
(140, 140, 0, 1, 2, 0, 'Coconut', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Joelle 2L coconut.png'),
(203, 203, 0, 1, 5, 0, '60ml Kit 9 Cashew', '', 0.00, 0.00, 0.00, '', '', '', '', '', '60ml Kit 9 Very Light Blond - Cashew.png'),
(271, 271, 0, 1, 3, 0, '59ml Passion', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59ml Passion.png'),
(272, 272, 0, 1, 3, 0, '59ml Sweet', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59ml Sweet.png'),
(273, 273, 0, 1, 3, 0, '59ml Pure', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59ml Pure.png'),
(274, 274, 0, 1, 3, 0, '59ml Stand 12 Original', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59 ml 3 in 1 Stand 12 Original.png'),
(275, 275, 0, 1, 3, 0, '59ml Stand 12 fragrances', '', 0.00, 0.00, 0.00, '', '', '', '', '', 'Touch Hand Gel Sanitizer 59 ml 3 in 1 Stand 12 fragrances.png');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_facts`
--

CREATE TABLE `ecom_prod_facts` (
  `id` int NOT NULL COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `ord` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `name1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name1',
  `name2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name2',
  `val1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Value 1',
  `val2` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Value 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_image`
--

CREATE TABLE `ecom_prod_image` (
  `id` int NOT NULL COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `image` varchar(512) NOT NULL COMMENT 'Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_review`
--

CREATE TABLE `ecom_prod_review` (
  `id` int NOT NULL COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `status_id` tinyint NOT NULL DEFAULT '2' COMMENT 'Status',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  `name` varchar(100) NOT NULL COMMENT 'Reviewer Name',
  `email` varchar(100) NOT NULL COMMENT 'Reviewer Email',
  `text` text NOT NULL COMMENT 'Review Text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_prod_size`
--

CREATE TABLE `ecom_prod_size` (
  `id` int NOT NULL COMMENT 'PK',
  `prod_id` int NOT NULL COMMENT 'Product',
  `unit_id` smallint NOT NULL DEFAULT '0',
  `snum` int NOT NULL COMMENT 'Sub Number',
  `anum` int NOT NULL COMMENT 'Article Number',
  `name` varchar(20) DEFAULT NULL COMMENT 'Size',
  `box` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantity in Box',
  `qnt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Quantity',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Normal Price',
  `cprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Current Price'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_service`
--

CREATE TABLE `ecom_service` (
  `id` int NOT NULL COMMENT 'PK',
  `Name1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `Name2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `type_id` tinyint NOT NULL COMMENT 'Type',
  `amtperc` decimal(10,5) NOT NULL DEFAULT '0.00000' COMMENT 'Amount or Percent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecom_service`
--

INSERT INTO `ecom_service` (`id`, `Name1`, `Name2`, `type_id`, `amtperc`) VALUES
(1, 'Moms', 'Moms', 2, 12.00000),
(2, 'Fakt.Avgift', 'Fakt.Avgift', 1, 39.00000);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_slider_mst`
--

CREATE TABLE `ecom_slider_mst` (
  `id` int NOT NULL COMMENT 'PK',
  `name` varchar(200) NOT NULL COMMENT 'Name',
  `rem` text COMMENT 'Remarks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_slider_mst`
--

INSERT INTO `ecom_slider_mst` (`id`, `name`, `rem`) VALUES
(1, 'Main Slider', 'Main Slider');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_slider_trn`
--

CREATE TABLE `ecom_slider_trn` (
  `id` int NOT NULL COMMENT 'PK',
  `slid_id` int NOT NULL COMMENT 'Slider',
  `order` smallint NOT NULL DEFAULT '0' COMMENT 'Order',
  `header` varchar(200) DEFAULT NULL COMMENT 'Header',
  `text` text COMMENT 'Text',
  `image` varchar(200) NOT NULL COMMENT 'Image',
  `link` varchar(200) DEFAULT NULL COMMENT 'Link',
  `label` varchar(100) DEFAULT NULL COMMENT 'Label'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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

CREATE TABLE `ecom_tag` (
  `id` int NOT NULL COMMENT 'PK',
  `status_id` tinyint NOT NULL DEFAULT '1' COMMENT 'Status',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `classname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Class Name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `ecom_unit` (
  `id` smallint NOT NULL COMMENT 'PK',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name',
  `rem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Rearks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE `ecom_vorders` (
`ord_id` int
,`ord_curn_rate` decimal(10,5)
,`ord_addat` datetime
,`status_id` tinyint
,`status_name` varchar(100)
,`curn_id` int
,`curn_name` varchar(100)
,`curn_status_id` tinyint
,`curn_rate` decimal(10,2)
,`curn_color` varchar(100)
,`curn_symbole` varchar(512)
,`cust_id` int
,`cust_status_id` tinyint
,`cust_name` varchar(256)
,`cust_orgnum` varchar(15)
,`cust_logon` varchar(100)
,`cust_mobile` varchar(25)
,`cust_phone` varchar(25)
,`cust_address` varchar(256)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vorder_items`
-- (See below for the actual view)
--
CREATE TABLE `ecom_vorder_items` (
`ord_id` int
,`ord_curn_rate` decimal(10,5)
,`ord_addat` datetime
,`ord_status_id` tinyint
,`curn_id` int
,`curn_name` varchar(100)
,`curn_status_id` tinyint
,`curn_rate` decimal(10,2)
,`curn_color` varchar(100)
,`curn_symbole` varchar(512)
,`cust_id` int
,`cust_status_id` tinyint
,`cust_name` varchar(256)
,`cust_orgnum` varchar(15)
,`cust_logon` varchar(100)
,`cust_mobile` varchar(25)
,`cust_phone` varchar(25)
,`cust_address` varchar(256)
,`item_id` int
,`item_prod_id` int
,`item_size_id` int
,`item_qnt` decimal(10,2)
,`item_price` decimal(10,2)
,`item_cprice` decimal(10,2)
,`item_amt` decimal(10,2)
,`item_disc` decimal(10,2)
,`item_net` decimal(10,2)
,`brand_id` int
,`brand_status_id` tinyint
,`brand_name1` varchar(100)
,`brand_name2` varchar(100)
,`brand_image` varchar(512)
,`cat_id` int
,`cat_status_id` tinyint
,`cat_order` int
,`cat_name1` varchar(100)
,`cat_name2` varchar(100)
,`cat_image` varchar(512)
,`tag_id` int
,`tag_status_id` tinyint
,`tag_name` varchar(100)
,`tag_classname` varchar(100)
,`prod_id` int
,`prod_mnum` int
,`prod_status_id` tinyint
,`prod_name1` varchar(256)
,`prod_name2` varchar(256)
,`prod_qnt` decimal(10,2)
,`prod_price` decimal(10,2)
,`prod_cprice` decimal(10,2)
,`prod_desc1` text
,`prod_desc2` text
,`prod_image` varchar(512)
,`size_id` int
,`size_snum` int
,`size_anum` int
,`size_name` varchar(20)
,`size_box` decimal(10,2)
,`size_qnt` decimal(10,2)
,`size_price` decimal(10,2)
,`size_cprice` decimal(10,2)
,`unit_id` smallint
,`unit_name` varchar(100)
,`unit_rem` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vproducts`
-- (See below for the actual view)
--
CREATE TABLE `ecom_vproducts` (
`brand_id` int
,`brand_status_id` tinyint
,`brand_name1` varchar(100)
,`brand_name2` varchar(100)
,`brand_image` varchar(512)
,`cat_id` int
,`cat_status_id` tinyint
,`cat_order` int
,`cat_name1` varchar(100)
,`cat_name2` varchar(100)
,`cat_image` varchar(512)
,`tag_id` int
,`tag_status_id` tinyint
,`tag_name` varchar(100)
,`tag_classname` varchar(100)
,`prod_id` int
,`prod_mnum` int
,`prod_status_id` tinyint
,`prod_name1` varchar(256)
,`prod_name2` varchar(256)
,`prod_qnt` decimal(10,2)
,`prod_price` decimal(10,2)
,`prod_cprice` decimal(10,2)
,`prod_desc1` text
,`prod_desc2` text
,`prod_image` varchar(512)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ecom_vproduct_sizes`
-- (See below for the actual view)
--
CREATE TABLE `ecom_vproduct_sizes` (
`brand_id` int
,`brand_status_id` tinyint
,`brand_name1` varchar(100)
,`brand_name2` varchar(100)
,`brand_image` varchar(512)
,`cat_id` int
,`cat_status_id` tinyint
,`cat_order` int
,`cat_name1` varchar(100)
,`cat_name2` varchar(100)
,`cat_image` varchar(512)
,`tag_id` int
,`tag_status_id` tinyint
,`tag_name` varchar(100)
,`tag_classname` varchar(100)
,`prod_id` int
,`prod_mnum` int
,`prod_status_id` tinyint
,`prod_name1` varchar(256)
,`prod_name2` varchar(256)
,`prod_qnt` decimal(10,2)
,`prod_price` decimal(10,2)
,`prod_cprice` decimal(10,2)
,`prod_desc1` text
,`prod_desc2` text
,`prod_image` varchar(512)
,`size_id` int
,`size_snum` int
,`size_anum` int
,`size_name` varchar(20)
,`size_box` decimal(10,2)
,`size_qnt` decimal(10,2)
,`size_price` decimal(10,2)
,`size_cprice` decimal(10,2)
,`unit_id` smallint
,`unit_name` varchar(100)
,`unit_rem` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_wishlist`
--

CREATE TABLE `ecom_wishlist` (
  `id` int NOT NULL COMMENT 'PK',
  `token` varchar(50) NOT NULL COMMENT 'Token',
  `addat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date Time',
  `status_id` tinyint NOT NULL DEFAULT '0' COMMENT 'Status',
  `prod_id` int NOT NULL COMMENT 'Product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `phs_cod_gender`
--

CREATE TABLE `phs_cod_gender` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks'
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

CREATE TABLE `phs_cod_status` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks'
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

CREATE TABLE `phs_cod_yes_no` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks'
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

CREATE TABLE `phs_lang` (
  `id` int NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `code` varchar(10) NOT NULL COMMENT 'Language Code',
  `dir` varchar(10) NOT NULL DEFAULT 'ltr' COMMENT 'Direction',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks'
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

CREATE TABLE `phs_log` (
  `id` int NOT NULL COMMENT 'PK',
  `log_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Log Text',
  `log_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Inserted AT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phs_pref`
--

CREATE TABLE `phs_pref` (
  `id` int NOT NULL COMMENT 'PK',
  `key` varchar(50) NOT NULL COMMENT 'Key',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `value` varchar(100) NOT NULL COMMENT 'Value',
  `rem` varchar(100) DEFAULT NULL COMMENT 'Remarks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(12, 'Copy_Title', 'Application Name', 'Sabbagh CMS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_program`
--

CREATE TABLE `phs_program` (
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
  `params` varchar(50) NOT NULL COMMENT 'Parameters'
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

CREATE TABLE `phs_program_type` (
  `id` tinyint NOT NULL COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Name'
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

CREATE TABLE `phs_system` (
  `id` int NOT NULL COMMENT 'Id',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `status_id` tinyint NOT NULL DEFAULT '1'
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
CREATE TABLE `phs_vprogram` (
`id` int
,`prog_id` int
,`name` varchar(100)
,`ord` smallint
,`icon` varchar(50)
,`grp_id` tinyint
,`open` tinyint
,`status_id` tinyint
,`status_name` varchar(100)
,`file` varchar(100)
,`css` varchar(100)
,`js` varchar(100)
,`attributes` varchar(512)
,`sys_id` int
,`sys_name` varchar(100)
,`type_id` tinyint
,`type_name` varchar(100)
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpy_branch`
--
ALTER TABLE `cpy_branch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cpy_perm`
--
ALTER TABLE `cpy_perm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prog_id` (`prog_id`),
  ADD KEY `grp_id` (`grp_id`);

--
-- Indexes for table `cpy_perm_grp`
--
ALTER TABLE `cpy_perm_grp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `wpstatus_id` (`wpstatus_id`);

--
-- Indexes for table `cpy_token`
--
ALTER TABLE `cpy_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gid` (`gid`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `cpy_user`
--
ALTER TABLE `cpy_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `logon` (`logon`),
  ADD KEY `grp_id` (`grp_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `ecom_about`
--
ALTER TABLE `ecom_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_adv`
--
ALTER TABLE `ecom_adv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_amt_type`
--
ALTER TABLE `ecom_amt_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_banner`
--
ALTER TABLE `ecom_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_brand`
--
ALTER TABLE `ecom_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name1` (`name1`),
  ADD UNIQUE KEY `name2` (`name2`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_cart`
--
ALTER TABLE `ecom_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `cart_token` (`cust_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `ecom_cat`
--
ALTER TABLE `ecom_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_curn`
--
ALTER TABLE `ecom_curn`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `curn_name` (`name`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_customer`
--
ALTER TABLE `ecom_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cust_logon` (`logon`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_faq`
--
ALTER TABLE `ecom_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_order`
--
ALTER TABLE `ecom_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `curn_id` (`curn_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_order_item`
--
ALTER TABLE `ecom_order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `ecom_order_service`
--
ALTER TABLE `ecom_order_service`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `ecom_order_status`
--
ALTER TABLE `ecom_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_product`
--
ALTER TABLE `ecom_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mnum` (`mnum`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_prod_facts`
--
ALTER TABLE `ecom_prod_facts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prod_id` (`prod_id`,`name1`);

--
-- Indexes for table `ecom_prod_image`
--
ALTER TABLE `ecom_prod_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `ecom_prod_review`
--
ALTER TABLE `ecom_prod_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_prod_size`
--
ALTER TABLE `ecom_prod_size`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prod_id_uk` (`prod_id`,`name`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `ecom_service`
--
ALTER TABLE `ecom_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `ecom_slider_mst`
--
ALTER TABLE `ecom_slider_mst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_slider_trn`
--
ALTER TABLE `ecom_slider_trn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slid_id` (`slid_id`);

--
-- Indexes for table `ecom_tag`
--
ALTER TABLE `ecom_tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `ecom_unit`
--
ALTER TABLE `ecom_unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ecom_wishlist`
--
ALTER TABLE `ecom_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wish_token` (`token`,`prod_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `phs_cod_gender`
--
ALTER TABLE `phs_cod_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phs_cod_status`
--
ALTER TABLE `phs_cod_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `phs_cod_yes_no`
--
ALTER TABLE `phs_cod_yes_no`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `phs_lang`
--
ALTER TABLE `phs_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `phs_log`
--
ALTER TABLE `phs_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phs_pref`
--
ALTER TABLE `phs_pref`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `phs_program`
--
ALTER TABLE `phs_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mprg_id` (`prog_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `sys_id` (`sys_id`);

--
-- Indexes for table `phs_program_type`
--
ALTER TABLE `phs_program_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `phs_system`
--
ALTER TABLE `phs_system`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpy_branch`
--
ALTER TABLE `cpy_branch`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cpy_perm`
--
ALTER TABLE `cpy_perm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=1051;

--
-- AUTO_INCREMENT for table `cpy_perm_grp`
--
ALTER TABLE `cpy_perm_grp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cpy_token`
--
ALTER TABLE `cpy_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK';

--
-- AUTO_INCREMENT for table `cpy_user`
--
ALTER TABLE `cpy_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `ecom_about`
--
ALTER TABLE `ecom_about`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecom_adv`
--
ALTER TABLE `ecom_adv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ecom_banner`
--
ALTER TABLE `ecom_banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ecom_brand`
--
ALTER TABLE `ecom_brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ecom_cart`
--
ALTER TABLE `ecom_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `ecom_cat`
--
ALTER TABLE `ecom_cat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ecom_curn`
--
ALTER TABLE `ecom_curn`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ecom_customer`
--
ALTER TABLE `ecom_customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `ecom_faq`
--
ALTER TABLE `ecom_faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ecom_order`
--
ALTER TABLE `ecom_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ecom_order_item`
--
ALTER TABLE `ecom_order_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `ecom_product`
--
ALTER TABLE `ecom_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `ecom_prod_facts`
--
ALTER TABLE `ecom_prod_facts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `ecom_prod_image`
--
ALTER TABLE `ecom_prod_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `ecom_prod_review`
--
ALTER TABLE `ecom_prod_review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK';

--
-- AUTO_INCREMENT for table `ecom_prod_size`
--
ALTER TABLE `ecom_prod_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `ecom_service`
--
ALTER TABLE `ecom_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ecom_slider_mst`
--
ALTER TABLE `ecom_slider_mst`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecom_slider_trn`
--
ALTER TABLE `ecom_slider_trn`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ecom_tag`
--
ALTER TABLE `ecom_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ecom_unit`
--
ALTER TABLE `ecom_unit`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ecom_wishlist`
--
ALTER TABLE `ecom_wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK';

--
-- AUTO_INCREMENT for table `phs_log`
--
ALTER TABLE `phs_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK';

--
-- AUTO_INCREMENT for table `phs_pref`
--
ALTER TABLE `phs_pref`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=13;

-- --------------------------------------------------------

--
-- Structure for view `cpy_vuser`
--
DROP TABLE IF EXISTS `cpy_vuser`;

CREATE VIEW `cpy_vuser`  AS SELECT `uu`.`id` AS `id`, `bb`.`id` AS `bran_id`, `bb`.`name` AS `bran_name`, `uu`.`grp_id` AS `grp_id`, `uu`.`status_id` AS `status_id`, `uu`.`gender_id` AS `gender_id`, `uu`.`name` AS `name`, `uu`.`logon` AS `logon`, `uu`.`password` AS `password`, `uu`.`image` AS `image` FROM (`cpy_user` `uu` join `cpy_branch` `bb`) WHERE (`uu`.`bran_id` = `bb`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vorders`
--
DROP TABLE IF EXISTS `ecom_vorders`;

CREATE VIEW `ecom_vorders`  AS SELECT `o`.`id` AS `ord_id`, `o`.`rate` AS `ord_curn_rate`, `o`.`addat` AS `ord_addat`, `s`.`id` AS `status_id`, `s`.`name` AS `status_name`, `r`.`id` AS `curn_id`, `r`.`name` AS `curn_name`, `r`.`status_id` AS `curn_status_id`, `r`.`rate` AS `curn_rate`, `r`.`color` AS `curn_color`, `r`.`symbole` AS `curn_symbole`, `c`.`id` AS `cust_id`, `c`.`status_id` AS `cust_status_id`, `c`.`name` AS `cust_name`, `c`.`orgnum` AS `cust_orgnum`, `c`.`logon` AS `cust_logon`, `c`.`mobile` AS `cust_mobile`, `c`.`phone` AS `cust_phone`, `c`.`address` AS `cust_address` FROM (((`ecom_order` `o` join `ecom_curn` `r`) join `ecom_customer` `c`) join `ecom_order_status` `s`) WHERE ((`o`.`curn_id` = `r`.`id`) AND (`o`.`cust_id` = `c`.`id`) AND (`o`.`status_id` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vorder_items`
--
DROP TABLE IF EXISTS `ecom_vorder_items`;

CREATE VIEW `ecom_vorder_items`  AS SELECT `o`.`id` AS `ord_id`, `o`.`rate` AS `ord_curn_rate`, `o`.`addat` AS `ord_addat`, `o`.`status_id` AS `ord_status_id`, `r`.`id` AS `curn_id`, `r`.`name` AS `curn_name`, `r`.`status_id` AS `curn_status_id`, `r`.`rate` AS `curn_rate`, `r`.`color` AS `curn_color`, `r`.`symbole` AS `curn_symbole`, `cs`.`id` AS `cust_id`, `cs`.`status_id` AS `cust_status_id`, `cs`.`name` AS `cust_name`, `cs`.`orgnum` AS `cust_orgnum`, `cs`.`logon` AS `cust_logon`, `cs`.`mobile` AS `cust_mobile`, `cs`.`phone` AS `cust_phone`, `cs`.`address` AS `cust_address`, `i`.`id` AS `item_id`, `i`.`prod_id` AS `item_prod_id`, `i`.`size_id` AS `item_size_id`, `i`.`qnt` AS `item_qnt`, `i`.`price` AS `item_price`, `i`.`cprice` AS `item_cprice`, `i`.`amt` AS `item_amt`, `i`.`disc` AS `item_disc`, `i`.`net` AS `item_net`, `b`.`id` AS `brand_id`, `b`.`status_id` AS `brand_status_id`, `b`.`name1` AS `brand_name1`, `b`.`name2` AS `brand_name2`, `b`.`image` AS `brand_image`, `ct`.`id` AS `cat_id`, `ct`.`status_id` AS `cat_status_id`, `ct`.`order` AS `cat_order`, `ct`.`name1` AS `cat_name1`, `ct`.`name2` AS `cat_name2`, `ct`.`image` AS `cat_image`, `t`.`id` AS `tag_id`, `t`.`status_id` AS `tag_status_id`, `t`.`name` AS `tag_name`, `t`.`classname` AS `tag_classname`, `p`.`id` AS `prod_id`, `p`.`mnum` AS `prod_mnum`, `p`.`status_id` AS `prod_status_id`, `p`.`name1` AS `prod_name1`, `p`.`name2` AS `prod_name2`, `p`.`qnt` AS `prod_qnt`, `p`.`price` AS `prod_price`, `p`.`cprice` AS `prod_cprice`, `p`.`desc1` AS `prod_desc1`, `p`.`desc2` AS `prod_desc2`, `p`.`image` AS `prod_image`, `s`.`id` AS `size_id`, `s`.`snum` AS `size_snum`, `s`.`anum` AS `size_anum`, `s`.`name` AS `size_name`, `s`.`box` AS `size_box`, `s`.`qnt` AS `size_qnt`, `s`.`price` AS `size_price`, `s`.`cprice` AS `size_cprice`, `u`.`id` AS `unit_id`, `u`.`name` AS `unit_name`, `u`.`rem` AS `unit_rem` FROM (((((((((`ecom_order` `o` join `ecom_curn` `r`) join `ecom_customer` `cs`) join `ecom_order_item` `i`) join `ecom_product` `p`) join `ecom_brand` `b`) join `ecom_cat` `ct`) join `ecom_tag` `t`) join `ecom_prod_size` `s`) join `ecom_unit` `u`) WHERE ((`o`.`curn_id` = `r`.`id`) AND (`o`.`cust_id` = `cs`.`id`) AND (`p`.`brand_id` = `b`.`id`) AND (`p`.`cat_id` = `ct`.`id`) AND (`p`.`tag_id` = `t`.`id`) AND (`s`.`prod_id` = `p`.`id`) AND (`s`.`unit_id` = `u`.`id`) AND (`i`.`order_id` = `o`.`id`) AND (`i`.`prod_id` = `p`.`id`) AND (`i`.`size_id` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vproducts`
--
DROP TABLE IF EXISTS `ecom_vproducts`;

CREATE VIEW `ecom_vproducts`  AS SELECT `b`.`id` AS `brand_id`, `b`.`status_id` AS `brand_status_id`, `b`.`name1` AS `brand_name1`, `b`.`name2` AS `brand_name2`, `b`.`image` AS `brand_image`, `c`.`id` AS `cat_id`, `c`.`status_id` AS `cat_status_id`, `c`.`order` AS `cat_order`, `c`.`name1` AS `cat_name1`, `c`.`name2` AS `cat_name2`, `c`.`image` AS `cat_image`, `t`.`id` AS `tag_id`, `t`.`status_id` AS `tag_status_id`, `t`.`name` AS `tag_name`, `t`.`classname` AS `tag_classname`, `p`.`id` AS `prod_id`, `p`.`mnum` AS `prod_mnum`, `p`.`status_id` AS `prod_status_id`, `p`.`name1` AS `prod_name1`, `p`.`name2` AS `prod_name2`, `p`.`qnt` AS `prod_qnt`, `p`.`price` AS `prod_price`, `p`.`cprice` AS `prod_cprice`, `p`.`desc1` AS `prod_desc1`, `p`.`desc2` AS `prod_desc2`, `p`.`image` AS `prod_image` FROM (((`ecom_product` `p` join `ecom_brand` `b`) join `ecom_cat` `c`) join `ecom_tag` `t`) WHERE ((`p`.`brand_id` = `b`.`id`) AND (`p`.`cat_id` = `c`.`id`) AND (`p`.`tag_id` = `t`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `ecom_vproduct_sizes`
--
DROP TABLE IF EXISTS `ecom_vproduct_sizes`;

CREATE VIEW `ecom_vproduct_sizes`  AS SELECT `b`.`id` AS `brand_id`, `b`.`status_id` AS `brand_status_id`, `b`.`name1` AS `brand_name1`, `b`.`name2` AS `brand_name2`, `b`.`image` AS `brand_image`, `c`.`id` AS `cat_id`, `c`.`status_id` AS `cat_status_id`, `c`.`order` AS `cat_order`, `c`.`name1` AS `cat_name1`, `c`.`name2` AS `cat_name2`, `c`.`image` AS `cat_image`, `t`.`id` AS `tag_id`, `t`.`status_id` AS `tag_status_id`, `t`.`name` AS `tag_name`, `t`.`classname` AS `tag_classname`, `p`.`id` AS `prod_id`, `p`.`mnum` AS `prod_mnum`, `p`.`status_id` AS `prod_status_id`, `p`.`name1` AS `prod_name1`, `p`.`name2` AS `prod_name2`, `p`.`qnt` AS `prod_qnt`, `p`.`price` AS `prod_price`, `p`.`cprice` AS `prod_cprice`, `p`.`desc1` AS `prod_desc1`, `p`.`desc2` AS `prod_desc2`, `p`.`image` AS `prod_image`, `s`.`id` AS `size_id`, `s`.`snum` AS `size_snum`, `s`.`anum` AS `size_anum`, `s`.`name` AS `size_name`, `s`.`box` AS `size_box`, `s`.`qnt` AS `size_qnt`, `s`.`price` AS `size_price`, `s`.`cprice` AS `size_cprice`, `u`.`id` AS `unit_id`, `u`.`name` AS `unit_name`, `u`.`rem` AS `unit_rem` FROM (((((`ecom_product` `p` join `ecom_brand` `b`) join `ecom_cat` `c`) join `ecom_tag` `t`) join `ecom_prod_size` `s`) join `ecom_unit` `u`) WHERE ((`p`.`brand_id` = `b`.`id`) AND (`p`.`cat_id` = `c`.`id`) AND (`p`.`tag_id` = `t`.`id`) AND (`s`.`prod_id` = `p`.`id`) AND (`s`.`unit_id` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `phs_vprogram`
--
DROP TABLE IF EXISTS `phs_vprogram`;

CREATE VIEW `phs_vprogram`  AS SELECT `p`.`id` AS `id`, `p`.`prog_id` AS `prog_id`, `p`.`name` AS `name`, `p`.`ord` AS `ord`, ifnull(`p`.`icon`,' ') AS `icon`, `p`.`grp_id` AS `grp_id`, `p`.`open` AS `open`, `s`.`id` AS `status_id`, `s`.`name` AS `status_name`, `p`.`file` AS `file`, `p`.`css` AS `css`, `p`.`js` AS `js`, `p`.`attributes` AS `attributes`, `y`.`id` AS `sys_id`, `y`.`name` AS `sys_name`, `t`.`id` AS `type_id`, `t`.`name` AS `type_name` FROM (((`phs_program` `p` join `phs_system` `y`) join `phs_program_type` `t`) join `phs_cod_status` `s`) WHERE ((`p`.`sys_id` = `y`.`id`) AND (`p`.`type_id` = `t`.`id`) AND (`p`.`status_id` = `s`.`id`)) ;

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
