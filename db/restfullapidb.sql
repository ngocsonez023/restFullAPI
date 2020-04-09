-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 11:27 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restfullapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments_setting`
--

CREATE TABLE `payments_setting` (
  `payments_id` int(100) NOT NULL,
  `braintree_enviroment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `braintree_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `braintree_merchant_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `braintree_public_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `braintree_private_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brantree_active` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_enviroment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publishable_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_active` tinyint(1) NOT NULL DEFAULT 0,
  `cash_on_delivery` tinyint(1) NOT NULL DEFAULT 0,
  `cod_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_status` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_enviroment` tinyint(1) DEFAULT 0,
  `payment_currency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `instamojo_enviroment` tinyint(1) NOT NULL,
  `instamojo_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instamojo_api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instamojo_auth_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instamojo_client_id` text COLLATE utf8_unicode_ci NOT NULL,
  `instamojo_client_secret` text COLLATE utf8_unicode_ci NOT NULL,
  `instamojo_active` tinyint(1) NOT NULL DEFAULT 0,
  `cybersource_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cybersource_status` tinyint(1) NOT NULL DEFAULT 0,
  `cybersource_enviroment` tinyint(1) NOT NULL DEFAULT 0,
  `hyperpay_enviroment` tinyint(1) NOT NULL DEFAULT 0,
  `hyperpay_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hyperpay_active` tinyint(1) NOT NULL DEFAULT 0,
  `hyperpay_userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hyperpay_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hyperpay_entityid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `momopay_active` tinyint(1) DEFAULT NULL,
  `momopay_partnercode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `momopay_enviroment` tinyint(1) DEFAULT NULL,
  `momopay_accesskey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `momopay_secretkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `momopay_apipoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_active` tinyint(1) DEFAULT NULL,
  `giaohangtietkiempay_enviroment` tinyint(1) DEFAULT NULL,
  `giaohangtietkiempay_tokenkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_apipoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_pickername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_pickeraddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_pickerprovince` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_pickerdistrict` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `giaohangtietkiempay_pickertel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nganluongpay_active` tinyint(1) DEFAULT NULL,
  `nganluongpay_enviroment` tinyint(1) DEFAULT NULL,
  `nganluongpay_merchantsitecode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nganluongpay_receiver` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nganluongpay_securepass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nganluongpay_apipoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nganluongpay_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `momopay_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments_setting`
--

INSERT INTO `payments_setting` (`payments_id`, `braintree_enviroment`, `braintree_name`, `braintree_merchant_id`, `braintree_public_key`, `braintree_private_key`, `brantree_active`, `stripe_enviroment`, `stripe_name`, `secret_key`, `publishable_key`, `stripe_active`, `cash_on_delivery`, `cod_name`, `paypal_name`, `paypal_id`, `paypal_status`, `paypal_enviroment`, `payment_currency`, `instamojo_enviroment`, `instamojo_name`, `instamojo_api_key`, `instamojo_auth_token`, `instamojo_client_id`, `instamojo_client_secret`, `instamojo_active`, `cybersource_name`, `cybersource_status`, `cybersource_enviroment`, `hyperpay_enviroment`, `hyperpay_name`, `hyperpay_active`, `hyperpay_userid`, `hyperpay_password`, `hyperpay_entityid`, `momopay_active`, `momopay_partnercode`, `momopay_enviroment`, `momopay_accesskey`, `momopay_secretkey`, `momopay_apipoint`, `giaohangtietkiempay_active`, `giaohangtietkiempay_enviroment`, `giaohangtietkiempay_tokenkey`, `giaohangtietkiempay_apipoint`, `giaohangtietkiempay_name`, `giaohangtietkiempay_pickername`, `giaohangtietkiempay_pickeraddress`, `giaohangtietkiempay_pickerprovince`, `giaohangtietkiempay_pickerdistrict`, `giaohangtietkiempay_pickertel`, `nganluongpay_active`, `nganluongpay_enviroment`, `nganluongpay_merchantsitecode`, `nganluongpay_receiver`, `nganluongpay_securepass`, `nganluongpay_apipoint`, `nganluongpay_name`, `momopay_name`) VALUES
(1, '0', 'Braintree', 'wrv3cwbft6n3bg5g', '2bz5kxcj2gs3hdbx', '55ae08cb061e36dca59aaf2a883190bf', 1, '0', 'Stripe', 'sk_test_Gsz7jL4wRikI8YFaNzbwxKOF', 'pk_test_cCAEC6EejawuAvsvR9bhKrGR', 1, 1, 'Cash On Delivery', 'Paypal', 'AULJ0Q_kdXwEbi7PCBunUBJc4Kkg2vvdazF8kJoywAV9_i7iJMQphB9NLwdR0v2BAUlLF974iTrynbys', 1, 0, 'USD', 0, 'Instamojo', 'c5a348bd5fcb4c866074c48e9c77c6c4', '99448897defb4423b921fe47e0851b86', 'test_9l7MW8I7c2bwIw7q0koc6B1j5NrvzyhasQh', 'test_m9Ey3Jqp9AfmyWKmUMktt4K3g1uMIdapledVRRYJha7WinxOsBVV5900QMlwvv3l2zRmzcYDEOKPh1cvnVedkAKtHOFFpJbqcoNCNrjx1FtZhtDMkEJFv9MJuXD', 1, 'cybersource', 0, 0, 0, 'hyperpay', 1, '8a82941865340dc8016537cdac1e0841', 'sXrYy8pnsf', '8a82941865340dc8016537ce08db0845', 1, 'MOMOGKOJ20190707', 0, 'gU6z4mmwWWQ4rVyB', '8xJKIZXRSJYDg5hRBlwNVvEx25KhZM7u', 'https://test-payment.momo.vn/gw_payment/transactionProcessor', 1, 0, '1d5261338ACE773eEE972c038E80B355cFC604D5', 'https://services.giaohangtietkiem.vn', 'giaohangtietkiempay', 'Nhan hoa', '88 Nguyễn Thị Minh Khai', 'Đà lạt', 'Phường 1', '0913639798', 1, 0, '47809', 'hieu.tran@viralworks.com', '975f851b3eb436f1ddebdc790d4eb63a', 'https://sandbox.nganluong.vn:8088/nl35/checkout.php', 'nganluongpay', 'momopay');

-- --------------------------------------------------------

--
-- Table structure for table `payment_description`
--

CREATE TABLE `payment_description` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `payment_name` varchar(32) NOT NULL,
  `sub_name_1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_name_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_description`
--

INSERT INTO `payment_description` (`id`, `name`, `language_id`, `payment_name`, `sub_name_1`, `sub_name_2`) VALUES
(1, 'Braintree', 1, 'Braintree', 'Credit Card', 'Paypal'),
(2, 'Braintree', 2, 'Braintree', 'Kreditkarte', 'Paypal'),
(4, 'Stripe', 1, 'Stripe', '', ''),
(5, 'Paypal', 1, 'Paypal', '', ''),
(6, 'Giao hàng nhận tiền', 1, 'Cash On Delivery', '', ''),
(7, 'Stripe', 2, 'Stripe', '', ''),
(8, 'Paypal', 2, 'Paypal', '', ''),
(9, 'Nachnahme', 2, 'Cash On Delivery', '', ''),
(20, 'Instamojo', 2, 'Instamojo', '', ''),
(19, 'Instamojo', 1, 'Instamojo', '', ''),
(22, 'Cybersoure', 1, 'cybersource', '', ''),
(24, 'Hyperpay', 1, 'hyperpay', '', ''),
(25, 'Momopay', 1, 'momopay', 'Momo', 'Momo'),
(26, 'Nganluongpay', 1, 'nganluongpay', 'Nganluong', 'Nganluong'),
(27, 'giaohangtietkiempay', 1, 'giaohangtietkiempay', 'Giaohangtietkiem', 'Giaohangtietkiem');

-- --------------------------------------------------------

--
-- Table structure for table `tblimage`
--

CREATE TABLE `tblimage` (
  `id` int(9) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblimage`
--

INSERT INTO `tblimage` (`id`, `image`) VALUES
(37, 'resources/assets/image/1574477724.p1_nptz.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblqrcode`
--

CREATE TABLE `tblqrcode` (
  `id` int(9) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblqrcode`
--

INSERT INTO `tblqrcode` (`id`, `qr_code`) VALUES
(1, 'lotus'),
(2, 'yolo'),
(3, 'abc_VIP_001'),
(7, 'abc'),
(8, 'abcut'),
(9, 'lotus1'),
(10, 'lotus2'),
(11, 'abcd'),
(12, 'abcde'),
(13, 'abcdef'),
(14, 'abcdefg'),
(15, 'abcdefgh'),
(16, 'abcdefghk'),
(17, 'abcdefghkj'),
(18, 'abcdnm'),
(19, 'abcdch'),
(20, 'abcdol'),
(21, 'abcdli');

-- --------------------------------------------------------

--
-- Table structure for table `tblqrdetail`
--

CREATE TABLE `tblqrdetail` (
  `id` int(9) NOT NULL,
  `id_qrcode` int(9) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblqrdetail`
--

INSERT INTO `tblqrdetail` (`id`, `id_qrcode`, `detail`) VALUES
(1, 1, 'a plant believed to be a jujube or elm, referred to in Greek legend as yielding a fruit that induced a state of dreamy and contented forgetfulness in those who ate it.\r\nthe fruit itself.'),
(2, 2, 'YOLO là viết tắt của “You only live once” tạm dịch sang tiếng Việt là “Bạn chỉ sống \r\n'),
(3, 3, 'đây là chi tiết abc_VIP_001');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(5, 'abc005958', 'abc@gmail.com', '$2y$10$Gp6ywukte89XOWa7iZbDuO7IR47Zz.tWtNGAqpZtvxkNslMnNCOwa'),
(6, 'abc', 'abc@gmail.com', '$2y$10$qYdmoykCvOMAQhxw161vSOHBHk2jg0bNr9wzPpDrsVjVzCtK0idlK'),
(7, 'abc', 'abc@gmail.com', '$2y$10$qwLLnBk8zrln5D2f3SB8UuI.VFc2siANztxM5Bm8arNH0yxLVh9LO'),
(8, 'abc', 'abc@gmail.com', '$2y$10$NnDKbFWvA/hEygDUS5AeluG0e8TH0EW4Qki/LWuGctKFDP7h7/V0O'),
(9, 'abc', 'abc@gmail.com', '$2y$10$msTztljimau.CYivyCihl.iY3HmH/4vsocA3awlgAJwpenH9Djene'),
(10, 'abcd', 'abc@gmail.com', '$2y$10$7qPpLiuJjzfUIlxJacHZa.Q4268cgnUxoZ6FiUK3h53lBgskujaoO'),
(11, 'abcd', 'abc@gmail.com', '$2y$10$vUGVehj3pmppKEGegmhyd.G5jBPZV8KarhDGqpdvqF420LxDJIn3C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments_setting`
--
ALTER TABLE `payments_setting`
  ADD PRIMARY KEY (`payments_id`);

--
-- Indexes for table `payment_description`
--
ALTER TABLE `payment_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblimage`
--
ALTER TABLE `tblimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblqrcode`
--
ALTER TABLE `tblqrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblqrdetail`
--
ALTER TABLE `tblqrdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments_setting`
--
ALTER TABLE `payments_setting`
  MODIFY `payments_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_description`
--
ALTER TABLE `payment_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblimage`
--
ALTER TABLE `tblimage`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblqrcode`
--
ALTER TABLE `tblqrcode`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblqrdetail`
--
ALTER TABLE `tblqrdetail`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
