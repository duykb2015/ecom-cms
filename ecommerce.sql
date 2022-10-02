-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 08:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `level`, `status`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 'admin', '20d135f0f28185b84a4cf7aa51f29500', 3, 1, '2022-08-13 12:52:22', '2022-09-15 13:34:18', '2022-09-15 13:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_item_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_item_id`, `product_name`, `color`, `discount`, `quantity`, `price`, `status`, `created_at`, `updated_at`, `last_login_at`) VALUES
(2, 1, 1, '[value-4]', '[value-5]', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 1, '[value-4]', '[value-5]', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_item_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `name`, `slug`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Điện thoại', 'dien-thoai', 0, 1, '2022-08-13 13:39:10', '2022-08-13 13:39:10'),
(2, 0, 'Âm thanh', 'am-thanh', 0, 1, '2022-08-13 13:39:27', '2022-08-17 15:05:44'),
(3, 0, 'Máy tính bảng', 'may-tinh-bang', 0, 1, '2022-08-13 13:39:40', '2022-08-13 13:39:40'),
(4, 2, 'Tai nghe', 'tai-nghe', 1, 1, '2022-08-17 15:02:47', '2022-08-17 15:06:16'),
(5, 2, 'Loa', 'loa', 1, 1, '2022-08-17 15:04:22', '2022-08-17 15:06:25'),
(6, 0, 'Phụ kiện', 'phu-kien', 0, 1, '2022-08-17 15:25:26', '2022-08-17 15:25:26'),
(7, 6, 'Ổ cứng', 'o-cung', 1, 1, '2022-08-17 15:26:04', '2022-08-17 15:26:04'),
(8, 6, 'Cường lực', 'cuong-luc', 1, 1, '2022-08-17 15:26:33', '2022-08-17 15:26:33'),
(9, 6, 'Bàn phím - chuột', 'ban-phim-chuot', 1, 1, '2022-08-17 15:27:10', '2022-08-17 15:27:10'),
(10, 6, 'Balo', 'balo', 1, 1, '2022-08-17 15:27:52', '2022-08-17 15:27:52'),
(11, 6, 'Phụ kiện máy', 'phu-kien-may', 1, 1, '2022-08-17 15:28:10', '2022-08-17 15:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(10, '2022-02-20-141414', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1660369574, 1),
(11, '2022-03-15-015657', 'App\\Database\\Migrations\\Menu', 'default', 'App', 1660369574, 1),
(12, '2022-08-01-103328', 'App\\Database\\Migrations\\Category', 'default', 'App', 1660369574, 1),
(13, '2022-08-02-061829', 'App\\Database\\Migrations\\Product', 'default', 'App', 1660369574, 1),
(14, '2022-08-02-061956', 'App\\Database\\Migrations\\ProductItems', 'default', 'App', 1660369574, 1),
(15, '2022-08-02-064557', 'App\\Database\\Migrations\\ProductItemColors', 'default', 'App', 1660369574, 1),
(16, '2022-08-02-065047', 'App\\Database\\Migrations\\ProductItemImages', 'default', 'App', 1660369574, 1),
(17, '2022-08-02-065113', 'App\\Database\\Migrations\\ProductAttributeValue', 'default', 'App', 1660369574, 1),
(18, '2022-08-02-065254', 'App\\Database\\Migrations\\ProductAttribute', 'default', 'App', 1660369862, 2),
(22, '2022-09-12-095233', 'App\\Database\\Migrations\\User', 'default', 'App', 1663117498, 3),
(23, '2022-09-12-095251', 'App\\Database\\Migrations\\Cart', 'default', 'App', 1663117498, 3),
(24, '2022-09-12-095256', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1663117498, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `slug` varchar(512) NOT NULL,
  `additional_information` varchar(2048) NOT NULL,
  `support_information` varchar(2048) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `admin_id`, `category_id`, `name`, `slug`, `additional_information`, `support_information`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Samsung Galaxy A23', 'samsung-galaxy-a23', '<p>Kh&ocirc;ng</p>\r\n', '<ul>\r\n	<li>Tặng cho kh&aacute;ch lần đầu mua h&agrave;ng online tại web\r\n	<p>M&atilde; giảm <strong>100.000đ &aacute;p dụng đơn h&agrave;ng từ 400.000đ</strong></p>\r\n\r\n	<p>Đại si&ecirc;u thị Online với <strong>15.000</strong> sản phẩm ti&ecirc;u d&ugrave;ng, thịt, c&aacute;, rau&hellip;</p>\r\n\r\n	<p><strong>FREEship</strong> đơn h&agrave;ng từ 300.000đ hoặc th&agrave;nh vi&ecirc;n V&Agrave;NG</p>\r\n\r\n	<p>Giao nhanh trong <strong>2 giờ</strong></p>\r\n	&Aacute;p dụng tại Tp.HCM v&agrave; 22 tỉnh th&agrave;nh</li>\r\n	<li>\r\n	<p>Tặng suất mua xe đạp giảm đến 30%(kh&ocirc;ng k&egrave;m khuyến m&atilde;i kh&aacute;c)</p>\r\n	</li>\r\n</ul>\r\n', '<h3>Samsung Galaxy A23 4GB sở hữu bộ th&ocirc;ng số kỹ thuật kh&aacute; ấn tượng trong ph&acirc;n kh&uacute;c, m&aacute;y c&oacute; một hiệu năng ổn định, cụm 4 camera th&ocirc;ng minh c&ugrave;ng một diện mạo trẻ trung ph&ugrave; hợp cho mọi đối tượng người d&ugrave;ng.</h3>\r\n\r\n<h3>Xử l&yacute; mượt m&agrave; nhờ chipset đến từ Qualcomm</h3>\r\n\r\n<p>Để m&aacute;y vận h&agrave;nh một c&aacute;ch ổn định hơn&nbsp;Samsung trang bị cho Galaxy A23 con chip quốc d&acirc;n d&agrave;nh cho thị trường di động tầm trung hiện nay (04/2022) mang t&ecirc;n Snapdragon 680 8 nh&acirc;n với hiệu suất tối đa đạt được l&agrave; 2.4 GHz.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113212.jpg\" onclick=\"return false;\"><img alt=\"Hiệu năng mạnh mẽ  - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113212.jpg\" /></a></p>\r\n\r\n<p>Đ&aacute;nh gi&aacute; sức mạnh của thiết bị qua hai ứng dụng thường được mọi người d&ugrave;ng để so s&aacute;nh hiệu năng với kết quả đạt được như sau: 283 (đơn nh&acirc;n), 1515 (đa nh&acirc;n) tr&ecirc;n Benchmark v&agrave; 6830 cho ứng dụng PCMark.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113214.jpg\" onclick=\"return false;\"><img alt=\"Điểm đánh giá hiệu năng - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113214.jpg\" /></a></p>\r\n\r\n<p>Khởi động với một tựa game chiến thuật hiện đang rất thịnh h&agrave;nh l&agrave; Li&ecirc;n Qu&acirc;n Mobile ở mức cấu h&igrave;nh max setting, Galaxy A23 cho ra qu&aacute; tr&igrave;nh chơi tương đối l&agrave; mượt m&agrave;, h&igrave;nh ảnh đẹp mắt v&agrave; kỹ năng được t&aacute;i hiện sống động. T&igrave;nh trạng giật, lag vẫn c&ograve;n xuất hiện nhưng kh&ocirc;ng qu&aacute; đ&aacute;ng kể, tốc độ khung h&igrave;nh dao động loanh quanh ở mức 55 - 60 FPS.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113216.jpg\" onclick=\"return false;\"><img alt=\"Cấu hình Liên Quân Mobile - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113216.jpg\" /></a></p>\r\n\r\n<p>Tr&ograve; chơi thứ 2 m&agrave; m&igrave;nh thử qua l&agrave; PUBG Mobile với cấu h&igrave;nh được m&igrave;nh thiết lập l&agrave; mức đồ họa mượt v&agrave; tốc độ khung h&igrave;nh cực cao để đảm bảo m&aacute;y hoạt động một c&aacute;ch ổn định nhất c&oacute; thể, nhưng b&ugrave; lại h&igrave;nh ảnh thể hiện kh&ocirc;ng được xuất sắc.</p>\r\n\r\n<p>Trải nghiệm ổn định, nh&acirc;n vật di chuyển tương đối l&agrave; mượt m&agrave;, qu&aacute; tr&igrave;nh đi nhặt đồ diễn ra kh&aacute; mượt, tốc độ khung h&igrave;nh dao động loanh quanh ở mức 25 - 29 FPS. Hiện tượng khựng khung h&igrave;nh khi m&igrave;nh tham chiến ở những vị tr&iacute; đ&ocirc;ng kẻ địch vẫn c&ograve;n xuất hiện nhưng kh&ocirc;ng đến mức kh&oacute; chịu.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113218.jpg\" onclick=\"return false;\"><img alt=\"Cấu hình PUBG Mobile - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113218.jpg\" /></a></p>\r\n\r\n<p>M&aacute;y trang bị 4 GB RAM c&ugrave;ng 128 GB bộ nhớ trong mang đến khả năng đa nhiệm một c&aacute;ch mượt m&agrave; c&ugrave;ng kh&ocirc;ng gian lưu trữ đ&aacute;p ứng vừa đủ cho người d&ugrave;ng cơ bản để tải xuống một lượng ứng dụng v&agrave; h&igrave;nh ảnh kh&aacute; lớn.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113220.jpg\" onclick=\"return false;\"><img alt=\"Đa nhiệm mượt mà - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113220.jpg\" /></a></p>\r\n\r\n<h3>Chụp ảnh sắc n&eacute;t với cụm camera th&ocirc;ng minh</h3>\r\n\r\n<p>M&aacute;y sở hữu 4 camera với camera ch&iacute;nh c&oacute; độ ph&acirc;n giải l&ecirc;n đến 50 MP, camera g&oacute;c rộng 5 MP,&nbsp;cảm biến x&oacute;a ph&ocirc;ng&nbsp;v&agrave;&nbsp;macro c&oacute; c&ugrave;ng độ ph&acirc;n giải 2 MP, k&egrave;m với đ&oacute; l&agrave; nhiều t&iacute;nh năng chụp ảnh mới lạ gi&uacute;p m&igrave;nh thỏa sức kh&aacute;m ph&aacute;.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113223.jpg\" onclick=\"return false;\"><img alt=\"Trang bị 4 camera - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113223.jpg\" /></a></p>\r\n\r\n<p>Kh&aacute; ấn tượng về kết quả thu lại tr&ecirc;n bức h&igrave;nh m&agrave; m&igrave;nh c&oacute; chụp từ điện thoại khi đang di chuyển ngo&agrave;i đường, m&agrave;u sắc ảnh c&oacute; độ tương phản cao, c&aacute;c chi tiết nhỏ đều được m&aacute;y thu lại r&otilde; n&eacute;t, ảnh kh&ocirc;ng qu&aacute; &ldquo;bể&rdquo; khi zoom hay hậu kỳ - chỉnh sửa.&nbsp;</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113221.jpg\" onclick=\"return false;\"><img alt=\"Ảnh chụp ở môi trường đủ sáng - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113221.jpg\" /></a></p>\r\n\r\n<p>Về phần chụp đ&ecirc;m th&igrave; Galaxy A23 chưa mang lại kết quả tốt, tổng thể bức ảnh chỉ dừng ở mức chấp nhận được, hiện tượng &ldquo;nh&ograve;e s&aacute;ng&rdquo; ở những vị tr&iacute; nguồn s&aacute;ng cao như b&oacute;ng đ&egrave;n vẫn xuất hiện.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113225.jpg\" onclick=\"return false;\"><img alt=\"Ảnh chụp vào buổi tối - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113225.jpg\" /></a></p>\r\n\r\n<p>Ở chế độ chụp ảnh selfie bằng camera 8 MP cho ra bức h&igrave;nh sắc n&eacute;t, nước da kh&ocirc;ng qu&aacute; bệt, sử dụng t&iacute;nh năng l&agrave;m đẹp đi k&egrave;m để che đi những khuyết điểm li ti như mụn, nốt ruồi nhỏ gi&uacute;p m&igrave;nh tự tin hơn tr&ecirc;n c&aacute;c bức ảnh tự chụp.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113226.jpg\" onclick=\"return false;\"><img alt=\"Ảnh chụp selfie - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113226.jpg\" /></a></p>\r\n\r\n<h3>Thiết kế đặc trưng từ d&ograve;ng Galaxy A</h3>\r\n\r\n<p>Galaxy A23 c&oacute; khung v&agrave; mặt lưng được l&agrave;m từ nhựa mang lại cảm gi&aacute;c cầm nắm nhẹ nh&agrave;ng, c&ugrave;ng với đ&oacute; l&agrave; cạnh viền bo cong gi&uacute;p m&igrave;nh sử dụng l&acirc;u d&agrave;i m&agrave; kh&ocirc;ng cảm thấy bị cấn tay như tr&ecirc;n một số d&ograve;ng sản phẩm c&oacute; thiết kế vu&ocirc;ng vức.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113228.jpg\" onclick=\"return false;\"><img alt=\"Thiết kế hoàn toàn từ nhựa - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113228.jpg\" /></a></p>\r\n\r\n<p>Sở hữu một mặt lưng s&aacute;ng b&oacute;ng c&ugrave;ng m&agrave;u sắc trẻ trung gi&uacute;p m&igrave;nh trở n&ecirc;n nổi bật hơn khi cầm chiếc m&aacute;y tr&ecirc;n tay, tuy nhi&ecirc;n theo m&igrave;nh đ&acirc;y cũng l&agrave; một điểm hạn chế bởi n&oacute; vẫn xuất hiện t&igrave;nh trạng b&aacute;m dấu v&acirc;n tay.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113230.jpg\" onclick=\"return false;\"><img alt=\"Mặt lưng sáng bóng - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113230.jpg\" /></a></p>\r\n\r\n<p>Tr&ecirc;n cạnh viền được bố tr&iacute; ph&iacute;m nguồn t&iacute;ch hợp cảm biến v&acirc;n tay với tốc độ phản hồi kh&aacute; nhanh, vị tr&iacute; đặt của ph&iacute;m cũng kh&ocirc;ng qu&aacute; cao gi&uacute;p m&igrave;nh dễ d&agrave;ng k&iacute;ch hoạt thiết bị một c&aacute;ch nhanh ch&oacute;ng chỉ với một tay.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113232.jpg\" onclick=\"return false;\"><img alt=\"Cảm biến vân tay cạnh viền - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113232.jpg\" /></a></p>\r\n\r\n<p>Mặt trước l&agrave; m&agrave;n h&igrave;nh giọt nước, trang bị tấm nền PLS TFT LCD với k&iacute;ch thước 6.6 inch c&oacute; độ ph&acirc;n giải Full HD+ (1080 x 2408 Pixels) cho ra m&agrave;u sắc c&oacute; độ tương phản cao, h&igrave;nh ảnh t&aacute;i hiện chi tiết c&ugrave;ng một kh&ocirc;ng gian hiển thị rộng lớn hỗ trợ cho c&aacute;c t&aacute;c vụ học tập, l&agrave;m việc tốt hơn.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113233.jpg\" onclick=\"return false;\"><img alt=\"Màn hình kích thước lớn - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113233.jpg\" /></a></p>\r\n\r\n<p>M&agrave;n h&igrave;nh 90 Hz cũng l&agrave; một điểm s&aacute;ng tr&ecirc;n Galaxy A23 v&igrave; n&oacute; gi&uacute;p m&igrave;nh thao t&aacute;c c&ocirc;ng việc một c&aacute;ch mượt m&agrave; v&agrave; đ&atilde; mắt hơn, c&ugrave;ng với đ&oacute; l&agrave; t&iacute;nh năng tự động điều chỉnh tần số qu&eacute;t xuống mức mặc định (60 Hz) nhằm tiết kiệm điện năng cho những t&aacute;c vụ kh&ocirc;ng cần thiết như đọc văn bản, đ&agrave;m thoại rất hữu &iacute;ch.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113235.jpg\" onclick=\"return false;\"><img alt=\"Màn hình  tần số 90 Hz - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113235.jpg\" /></a></p>\r\n\r\n<h3>Pin tr&acirc;u d&ugrave;ng l&acirc;u cả ng&agrave;y</h3>\r\n\r\n<p>B&ecirc;n trong thiết bị l&agrave; vi&ecirc;n pin c&oacute; dung lượng 5000 mAh thừa sức đ&aacute;p ứng nhu cầu sử dụng li&ecirc;n tục trong nhiều giờ, m&igrave;nh c&oacute; d&ugrave;ng m&aacute;y để phục vụ cho việc lướt web, xem phim, chơi game cho thấy Galaxy A23 đ&aacute;p ứng thời lượng l&ecirc;n đến hơn 8 tiếng*.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113237.jpg\" onclick=\"return false;\"><img alt=\"Thời lượng sử dụng - Samsung Galaxy A23 4GB\" src=\"https://cdn.tgdd.vn/Products/Images/42/262650/samsung-galaxy-a23-160422-113237.jpg\" /></a></p>\r\n\r\n<p>Samsung trang bị cho m&aacute;y c&ocirc;ng nghệ sạc pin nhanh 25 W nhằm tối ưu thời gian sạc gi&uacute;p r&uacute;t ngắn thời gian lấp đầy vi&ecirc;n pin xuống c&ograve;n 1 giờ 35 ph&uacute;t*, đ&acirc;y l&agrave; một khoảng thời gian kh&aacute; hợp l&yacute;, kh&ocirc;ng qu&aacute; l&acirc;u.</p>\r\n', 1, '2022-08-13 14:35:42', '2022-08-13 17:10:59'),
(2, 1, 1, 'Samsung Galaxy Z Fold 4', 'samsung-galaxy-z-fold-4', '<p>Th&ocirc;ng tin th&ecirc;m về sản phẩm ...</p>\r\n', '<p>Hỗ trợ khi mua h&agrave;ng ...</p>\r\n', '<p>M&ocirc; tả về về sản phẩm ...</p>\r\n', 2, '2022-08-26 15:50:28', '2022-08-26 15:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_item_id` int(11) DEFAULT NULL,
  `product_attribute_value_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `product_item_id`, `product_attribute_value_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 4, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(2, 1, NULL, 5, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(3, 1, NULL, 6, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(4, 1, NULL, 7, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(5, 1, NULL, 8, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(6, 1, NULL, 11, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(7, 1, NULL, 12, 1, '2022-08-13 14:35:42', '2022-08-13 14:35:42'),
(8, 1, 1, 9, 1, '2022-08-13 19:07:59', '2022-08-13 19:07:59'),
(9, 1, 1, 10, 1, '2022-08-13 19:07:59', '2022-08-13 19:07:59'),
(10, 1, 2, 9, 1, '2022-08-26 15:43:04', '2022-08-26 15:43:04'),
(11, 1, 2, 14, 1, '2022-08-26 15:43:04', '2022-08-26 15:43:04'),
(12, 1, 3, 13, 1, '2022-08-26 15:44:44', '2022-08-26 15:44:44'),
(13, 1, 3, 14, 1, '2022-08-26 15:44:44', '2022-08-26 15:44:44'),
(14, 2, NULL, 4, 1, '2022-08-26 15:50:28', '2022-08-26 15:50:28'),
(15, 2, NULL, 6, 1, '2022-08-26 15:50:28', '2022-08-26 15:50:28'),
(16, 2, NULL, 7, 1, '2022-08-26 15:50:28', '2022-08-26 15:50:28'),
(17, 2, NULL, 8, 1, '2022-08-26 15:50:28', '2022-08-26 15:50:28'),
(18, 2, NULL, 15, 1, '2022-08-26 15:50:28', '2022-08-26 15:50:28'),
(19, 2, NULL, 16, 1, '2022-08-26 15:50:28', '2022-08-26 15:50:28'),
(20, 2, 4, 13, 1, '2022-08-26 15:51:47', '2022-08-26 15:51:47'),
(21, 2, 4, 14, 1, '2022-08-26 15:51:47', '2022-08-26 15:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(2048) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `name`, `key`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Công nghệ màn hình OLED LPTO', 'Công nghệ màn hình', 'OLED LPTO', 1, '2022-08-13 13:59:52', '2022-08-13 13:59:52'),
(2, ' Độ phân giải  FHD+ (2640 x 1080 Pixels)', ' Độ phân giải', 'FHD+ (2640 x 1080 Pixels)', 1, '2022-08-13 14:01:43', '2022-08-13 14:01:43'),
(3, ' Độ sáng tối đa  1200 nits', ' Độ sáng tối đa', '1200 nits', 1, '2022-08-13 14:02:20', '2022-08-13 14:02:20'),
(4, 'Màn hình PLS TFT LCD 6.6\" Full HD+', 'Màn hình', 'PLS TFT LCD 6.6\" Full HD+', 1, '2022-08-13 14:06:09', '2022-08-13 14:06:09'),
(5, 'Hệ điều hành Android 12', 'Hệ điều hành', 'Android 12', 0, '2022-08-13 14:06:36', '2022-08-13 14:06:36'),
(6, 'Camera sau Chính 50 MP & Phụ 5 MP, 2 MP, 2 MP', 'Camera sau', 'Chính 50 MP & Phụ 5 MP, 2 MP, 2 MP', 0, '2022-08-13 14:06:56', '2022-08-13 14:06:56'),
(7, 'Camera trước 8 MP', 'Camera trước', '8 MP', 1, '2022-08-13 14:31:29', '2022-08-13 14:31:29'),
(8, '  Chip Snapdragon 680 8 nhân', 'Chip', 'Snapdragon 680 8 nhân', 1, '2022-08-13 14:31:49', '2022-08-13 14:31:49'),
(9, 'RAM 4GB', 'RAM', '4 GB', 1, '2022-08-13 14:32:12', '2022-08-26 15:29:30'),
(10, 'Bộ nhớ trong 128 GB', 'Bộ nhớ trong', '128 GB', 0, '2022-08-13 14:32:37', '2022-08-13 14:32:37'),
(11, 'SIM 2 Nano SIM Hỗ trợ 4G', 'SIM', '2 Nano SIM Hỗ trợ 4G', 1, '2022-08-13 14:33:02', '2022-08-13 14:33:02'),
(12, 'Pin, Sạc 5000 mAh 25 W', 'Pin, Sạc', '5000 mAh 25 W', 1, '2022-08-13 14:33:24', '2022-08-13 14:33:24'),
(13, 'RAM 8GB', 'RAM', '8GB', 1, '2022-08-26 15:29:50', '2022-08-26 15:29:50'),
(14, 'Bộ nhớ trong 256GB', 'Bộ nhớ trong', '256GB', 0, '2022-08-26 15:30:27', '2022-08-26 15:30:27'),
(15, 'Công nghệ màn hình: Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', 'Công nghệ màn hình ', 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', 0, '2022-08-26 15:47:26', '2022-08-26 15:47:26'),
(16, 'Độ phân giải: Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', 'Độ phân giải', 'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', 1, '2022-08-26 15:47:55', '2022-08-26 15:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `menu_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Samsung', 'samsung', 1, '2022-08-13 13:43:42', '2022-08-13 13:43:42'),
(2, 1, 'Xiaomi', 'xiaomi', 1, '2022-08-13 13:43:55', '2022-08-13 13:43:55'),
(3, 1, 'iPhone', 'iphone', 0, '2022-08-13 13:44:12', '2022-08-13 13:44:12'),
(4, 2, 'iPod', 'ipod', 0, '2022-08-13 13:44:24', '2022-08-13 13:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(2048) NOT NULL,
  `slug` varchar(2048) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` (`id`, `product_id`, `admin_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Samsung Galaxy A23 4GB/128GB', 'samsung-galaxy-a23-4gb-128gb', 1, '2022-08-13 17:58:08', '2022-08-26 15:30:49'),
(2, 1, 1, 'Samsung Galaxy A23 4GB/256GB', 'samsung-galaxy-a23-4gb-256gb', 1, '2022-08-26 15:43:04', '2022-08-26 15:43:04'),
(3, 1, 1, 'Samsung Galaxy A23 8GB/256GB', 'samsung-galaxy-a23-8gb-256gb', 2, '2022-08-26 15:44:44', '2022-08-26 15:44:44'),
(4, 2, 1, 'Samsung Galaxy Z Fold 4 8GB/256GB', 'samsung-galaxy-z-fold-4-8gb-256gb', 2, '2022-08-26 15:51:47', '2022-08-26 15:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_item_colors`
--

CREATE TABLE `product_item_colors` (
  `id` int(11) NOT NULL,
  `product_item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hexcode` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_item_colors`
--

INSERT INTO `product_item_colors` (`id`, `product_item_id`, `name`, `hexcode`, `price`, `discount`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Đen', '#000000', '5690000', '0', 5690000, 1, '2022-08-13 19:06:14', '2022-08-13 19:06:14'),
(3, 1, 'Cam', '#ff8040', '5690000', '9', 569, 1, '2022-08-13 19:14:02', '2022-08-13 19:14:02'),
(5, 2, 'Đen', '#000000', '5666999', '8', 332, 1, '2022-08-26 15:43:04', '2022-08-26 15:43:04'),
(6, 3, 'Golden', '#ffff00', '8999000', '5', 0, 2, '2022-08-26 15:44:44', '2022-08-26 15:44:44'),
(7, 4, 'Đen', '#000000', '23990000', '0', 0, 2, '2022-08-26 15:51:47', '2022-08-26 15:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_item_images`
--

CREATE TABLE `product_item_images` (
  `id` int(11) NOT NULL,
  `product_item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_item_images`
--

INSERT INTO `product_item_images` (`id`, `product_item_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1660388288_37f7a3808b979d727997.jpg', 1, '2022-08-13 17:58:08', '2022-08-13 17:58:08'),
(2, 1, '1660388288_fe8d8a411617e085b4fd.jpg', 1, '2022-08-13 17:58:08', '2022-08-13 17:58:08'),
(3, 1, '1660388288_582c80935d7d1172d3a9.jpg', 1, '2022-08-13 17:58:08', '2022-08-13 17:58:08'),
(4, 1, '1660388288_d3763772e06032555e77.jpg', 1, '2022-08-13 17:58:08', '2022-08-13 17:58:08'),
(5, 1, '1660388288_f97cec3e98daaee16158.jpg', 1, '2022-08-13 17:58:08', '2022-08-13 17:58:08'),
(6, 1, '1660388288_373ac74ba76cd45cc4a4.jpg', 1, '2022-08-13 17:58:08', '2022-08-13 17:58:08'),
(14, 4, '1661503907_56ced24535c634a4e921.png', 1, '2022-08-26 15:51:47', '2022-08-26 15:51:47'),
(15, 2, '1662805382_0e498c7001533bc0cd57.webp', 1, '2022-09-10 17:23:02', '2022-09-10 17:23:02'),
(16, 3, '1662805406_23c612e6fb50ebd8e54a.webp', 1, '2022-09-10 17:23:26', '2022-09-10 17:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `address`, `phone`, `token`, `status`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 'test', 'iha6r45f@duck.com', '1112', '77/99 chuyên dùng 12, phường Phú Mỹ, Quận 7', '012312412', '', 1, '2022-09-14 17:50:22', '2022-09-14 17:50:22', '2022-09-14 17:50:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_product_item_id_foreign` (`product_item_id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkout_product_item_id_foreign` (`product_item_id`),
  ADD KEY `checkout_user_id_foreign` (`user_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_admin_id_foreign` (`admin_id`),
  ADD KEY `product_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_product_item_id_foreign` (`product_item_id`),
  ADD KEY `product_attributes_product_attribute_value_id_foreign` (`product_attribute_value_id`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_items_product_id_foreign` (`product_id`),
  ADD KEY `product_items_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `product_item_colors`
--
ALTER TABLE `product_item_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_item_colors_product_item_id_foreign` (`product_item_id`);

--
-- Indexes for table `product_item_images`
--
ALTER TABLE `product_item_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_item_images_product_item_id_foreign` (`product_item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_item_colors`
--
ALTER TABLE `product_item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_item_images`
--
ALTER TABLE `product_item_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`),
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`),
  ADD CONSTRAINT `checkout_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_product_attribute_value_id_foreign` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_values` (`id`),
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_attributes_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `product_items`
--
ALTER TABLE `product_items`
  ADD CONSTRAINT `product_items_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `product_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_item_colors`
--
ALTER TABLE `product_item_colors`
  ADD CONSTRAINT `product_item_colors_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`);

--
-- Constraints for table `product_item_images`
--
ALTER TABLE `product_item_images`
  ADD CONSTRAINT `product_item_images_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
