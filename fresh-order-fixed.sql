-- 农心鲜生电商平台数据库（修复中文编码版本）
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8;

-- --------------------------------------------------------
-- tbl_admin
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(34, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------
-- tbl_area
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_area` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(12, '辽宁丹东', 'Product-Area-331.png', '是', '是'),
(13, '四川宜宾', 'Product-Area-876.png', '是', '是'),
(14, '吉林松原', 'Product-Area-119.png', '是', '是'),
(15, '浙江象山', 'Product-Area-537.png', '是', '是'),
(16, '山东威海', 'Product-Area-455.png', '是', '是'),
(17, '云南昆明', 'Product-Area-640.png', '是', '是');

-- --------------------------------------------------------
-- tbl_order
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_order` (`id`, `product`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, '99牛奶草莓', '148', 1, '148', '2022-01-30 06:10:52', 'status', '翟丹兰', '18252050128', 'danlanz11@163.com', '河南省濮阳市');

-- --------------------------------------------------------
-- tbl_product
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`, `area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_product` (`id`, `title`, `description`, `price`, `image_name`, `area_id`, `featured`, `active`) VALUES
(9, '99牛奶草莓', '色泽鲜艳，果肉饱满，汁水充沛，美味可口', '148', 'Product-Name-9646.jpg', 12, '是', '是'),
(11, '春见耙耙柑', '圆润饱满，色泽艳丽，肉质脆爽，香甜多汁', '18', 'Product-Name-4310.jpg', 13, '是', '是'),
(14, '查干湖黑糯玉米', '真空包装，颗粒饱满，甜而不腻，粗粮代餐', '23', 'Product-Name-7045.jpg', 14, '是', '是'),
(15, '海捕小黄鱼', '刺头直挺，肉嫩味美，新鲜可口，天然生长', '58', 'Product-Name-4270.jpg', 15, '是', '是'),
(16, '虾皮', '新鲜海捕，天然晒干，口感丰富，营养健康', '88', 'Product-Name-4187.jpg', 16, '是', '是'),
(17, '有机水果甘蔗', '有机种植，色泽嫩绿，脆甜爽口，富含纤维', '20', 'Product-Name-2557.jpg', 17, '是', '是');

ALTER TABLE `tbl_admin` MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
ALTER TABLE `tbl_area` MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
ALTER TABLE `tbl_order` MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `tbl_product` MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
