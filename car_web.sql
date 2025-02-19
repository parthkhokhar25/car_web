-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 07:33 PM
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
-- Database: `car_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `massage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `massage`) VALUES
('Raj', 'rajramani6609@gmail.com', 'hello this massage is for demo purpose. My name is raj ramani and i am studying in Rk University.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `p_id` int(10) NOT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `fname`, `lname`, `email`, `mobile_no`, `address`, `p_id`, `status`) VALUES
(2, 'Raj', 'Ramani', 'rajramani6609@gmail.com', '8980260250', 'minaxi sosity,sr.2,rajkot - 360002', 5, 'completed'),
(4, '24qr2q', '45345r', 'as@gmail.com', '123123123123', 'q3r v2q3r qw rqw qwer frqwre', 6, 'panding'),
(5, 'a;licz mxc cnqweo', 'a.f aweilraw', 'a@gmail.com', '32424234234', 'a ;wjoraw o8n 8waca', 4, 'panding');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(10) NOT NULL,
  `car_compney` varchar(100) NOT NULL,
  `car_purch_year` varchar(100) NOT NULL,
  `car_name` varchar(100) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `car_hestory` varchar(100) NOT NULL,
  `kms_driven` varchar(100) NOT NULL,
  `last_service` varchar(100) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `fual_type` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `insurance` varchar(100) NOT NULL,
  `price` varchar(100) DEFAULT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL,
  `img4` varchar(100) NOT NULL,
  `img5` varchar(100) NOT NULL,
  `img6` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `car_compney`, `car_purch_year`, `car_name`, `car_model`, `car_hestory`, `kms_driven`, `last_service`, `reg_no`, `owner`, `fual_type`, `type`, `insurance`, `price`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `status`) VALUES
(3, 'Vokswagen', '2018', 'Polo', 'HIGH LINE PLUS 1.0', 'Non-Accidental', '50,755 km', '50,755km (28 Feb 2022)', 'GJ-15-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '5,95,000', '6251b3d3abc6bcar2.jpeg', '6251b3d3abeb7car2_angle1.jpeg', '6251b3d3ac15ccar2_angle2.jpeg', '6251b3d3ac39ecar2_angle3.jpeg', '6251b3d3ac565car2_intiriur.jpeg', '6251b3d3ac7bccar2_speedometer.jpeg', 'onsell'),
(4, 'Maruti', '2016', 'Vitara Brezza', 'ZDI PLUSH', 'Accidental', '1,49,890 km', '1,49,890km (13 Dec 2021)', 'GJ-03-x-xxxx', '2nd Owner', 'Diesel', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '7,15,000', '6251b4491f6e9car3.jpeg', '6251b4491f8e0car3_angle1.jpeg', '6251b4491fb58car3_angle2.jpeg', '6251b4491fd55car3_angle3.jpeg', '6251b4491ffbbcar3_interior.jpeg', '6251b449201eacar3_speedometer.jpeg', 'onsell'),
(5, 'Hyundai', '2018', 'Elite i20', 'SPORTZ 1.2', 'Non-Accidental', '35,297 km', '35,297km (13 Nov 2021)', 'GJ-12-x-xxxx', '2nd Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '6,08,000', '6251b51ca6f51car4.jpeg', '6251b51ca7176car4_angle1.jpeg', '6251b51ca73f2car4_angle2.jpeg', '6251b51ca75cdcar4_angle3.jpeg', '6251b51ca77e0car4_interior.jpeg', '6251b51ca7a09car4_speedometer.jpeg', 'sold'),
(6, 'Hyundai', '2018', 'Verna', '1.6 SX VTVT', 'Non-Accidental', '55,769 km', '55,769km (28 Jan 2022)', 'GJ-05-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '7,37,000', '6251b6076e121car5.jpeg', '6251b6076e35ecar5_angle1.jpeg', '6251b6076e68ccar5_angle2.jpeg', '6251b6076eaedcar5_angle3.jpeg', '6251b6076ed4acar5_interior.jpeg', '6251b6076ef89car5_speedometer.jpeg', 'onsell'),
(7, 'Hyundai', '2019', 'Creta', '1.6 E + VTVT', 'Non-Accidental', '5,616 km', '5,616km (01 Jan 2022)', 'GJ-18-x-xxxx', '2nd Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '9,93,000', '6251b6d639d62car6.jpeg', '6251b6d639f89car6_angle1.jpeg', '6251b6d63a1e1car6_angle2.jpeg', '6251b6d63a599car6_angle3.jpeg', '6251b6d63a7dfcar6_interior.jpeg', '6251b6d63aa6dcar6_speedometer.jpeg', 'onsell'),
(8, 'Maruti', '2014', 'Swift', 'VID', 'Non-Accidental', '92,600 km', '92,600km (14 Dec 2021)', 'GJ-10-x-xxxx', '4th Owner', 'Diesel', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '3,53,000', '6251b7850ce9ccar7.jpeg', '6251b7850d0e1car7_angle1.jpeg', '6251b7850d380car7_angle2.jpeg', '6251b7850d57dcar7_angle3.jpeg', '6251b7850d799car7_interior.jpeg', '6251b7850d9c5car7_speedometer.jpeg', 'onsell'),
(9, 'Ford', '2018', 'Ecosports', '1.5 TITANIUM TDC', 'Non-Accidental', '44,229 km', '44,229km (04 Jan 2022)', 'GJ-05-x-xxxx', '1st Owner', 'Diesel', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '7,35,000', '6251b7f9e4f24car8.jpeg', '6251b7f9e51d0car8_angle1.jpeg', '6251b7f9e5427car8_angle2.jpeg', '6251b7f9e583dcar8_angle3.jpeg', '6251b7f9e5b05car8_interior.jpeg', '6251b7f9e5d57car8_speedometer.jpeg', 'onsell'),
(10, 'Hyundai', '2018', 'Verna', '1.6 SX VTVT', 'Non-Accidental', '49,212 km', '49,212km (30 Oct 2021)', 'GJ-05-x-xxxx', '2nd Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '7,83,000', '6251b85f88798car9.jpeg', '6251b85f889fbcar9_angle1.jpeg', '6251b85f88d8acar9_angle2.jpeg', '6251b85f88f9acar9_angle3.jpeg', '6251b85f891abcar9_interior.jpeg', '6251b85f893b9car9_speedometer.jpeg', 'onsell'),
(11, 'Hyundai', '2020', 'Aura', 'SX+ AT 1.2CRDI', 'Non-Accidental', '12,392 km', '12,392km (25 Dec 2021)', 'GJ-01-x-xxxx', '1st Owner', 'Diesel', 'AUTOMATIC', 'Valid upto Apr 2023(3rd Party)', '9,65,000', '6251b8fec1416car10.jpeg', '6251b8fec1642car10_angle1.jpeg', '6251b8fec18b5car10_angle2.jpeg', '6251b8fec1b70car10_angle3.jpeg', '6251b8fec1dd6car10_interior.jpeg', '6251b8fec20d5car10_speedometer.jpeg', 'onsell'),
(12, 'Hyundai', '2018', 'Verna', '1.4 VTVT E', 'Non-Accidental', '86,324 km', '86,324km (29 Jan 2022)', 'GJ-21-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '6,70,000', '6251ba643a780car11.jpeg', '6251ba643accbcar11_angle1.jpeg', '6251ba643b2eccar11_angle2.jpeg', '6251ba643b8facar11_angle3.jpeg', '6251ba643c216car11_interior.jpeg', '6251ba643cf79car11_speedometer.jpeg', 'onsell'),
(13, 'Maruti', '2017', 'Baleno', 'DELTA 1.2 K12', 'Non-Accidental', '52,237 km', '52,237km (28 Feb 2022)', 'GJ-09-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '5,31,000', '6251bb1a1e2dfcar12.jpeg', '6251bb1a1e681car12_angle1.jpeg', '6251bb1a1e9b8car12_angle2.jpeg', '6251bb1a1ec9ecar12_angle3.jpeg', '6251bb1a1ef2ecar12_interior.jpeg', '6251bb1a1f1c8car12_speedometer.jpeg', 'onsell'),
(14, 'Maruti', '2014', 'Swift', 'VXI', 'Non-Accidental', '65,062 km', '65,062km (01 Jan 2022)', 'GJ-16-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '4,12,000', '6251bb990a908car13.jpeg', '6251bb990acb2car13_angle1.jpeg', '6251bb990b00acar13_angle2.jpeg', '6251bb990b301car13_angle3.jpeg', '6251bb990b668car13_interior.jpeg', '6251bb990ba13car13_speedometer.jpeg', 'onsell'),
(15, 'Hyundai', '2017', 'Elite i20', 'SPORTZ 1.4', 'Non-Accidental', '96,336 km', '96,336km (09 Nov 2021)', 'GJ-13-x-xxxx', '1st Owner', 'Diesel', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '5,80,000', '6251bc279221bcar14.jpeg', '6251bc2792473car14_angle1.jpeg', '6251bc279272ccar14_angle2.jpeg', '6251bc2792961car14_angle3.jpeg', '6251bc2792bb5car14_interior.jpeg', '6251bc2792e19car14_speedometer.jpeg', 'onsell'),
(16, 'Hyundai', '2020', 'Venue', 'S MT 1.2 KAPPA', 'Non-Accidental', '4,689 km', '4,689km (03 Jan 2022)', 'GJ-05-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '7,74,000', '6251bc9f5a089car15.jpeg', '6251bc9f5a331car15_angle1.jpeg', '6251bc9f5a55ccar15_angle2.jpeg', '6251bc9f5a7d1car15_angle3.jpeg', '6251bc9f5aa0dcar15_interior.jpeg', '6251bc9f5adb5car15_speedometer.jpeg', 'onsell'),
(17, 'Maruti', '2020', 'Vitara Brezza', 'VXI', 'Non-Accidental', '7,848 km', '7,848km (03 Nov 2021)', 'GJ-01-x-xxxx', '1st Owner', 'Petrol', 'MANUAL', 'Valid upto Apr 2023(3rd Party)', '7,74,000', '6251bd05d2c62car16.jpeg', '6251bd05d30facar16_angle1.jpeg', '6251bd05d34a9car16_angle2.jpeg', '6251bd05d3786car16_angle3.jpeg', '6251bd05d3a4ccar16_interior.jpeg', '6251bd05d3dafcar16_speedometer.jpeg', 'onsell'),
(23, 'Honda', '2018', 'Jazz', '1.2 V MT', 'Non-Accidental', '30,771 km', '30,771 km(28 Feb 2022)', 'GJ-06-x-xxxx', '1st Owner', 'Patrol', 'Manual', 'Valid upto Apr 2023(3rd Party)', '5,77,000', '6283b5e12e475car17.jpeg', '6283b5e12e7cacar17_angle1.jpeg', '6283b5e12e9b8car17_angle2.jpeg', '6283b5e12ebb1car17_angle3.jpeg', '6283b5e12edc7car17_interior.jpeg', '6283b5e12ef7bcar17_speedometer.jpeg', 'onsell');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `car_compney` varchar(100) NOT NULL,
  `car_name` varchar(100) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `fual_type` varchar(100) NOT NULL,
  `kms_driven` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `car_purch_year` varchar(100) NOT NULL,
  `insurance` varchar(100) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `document` varchar(100) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL,
  `img4` varchar(100) NOT NULL,
  `img5` varchar(100) NOT NULL,
  `img6` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `fname`, `lname`, `car_compney`, `car_name`, `car_model`, `fual_type`, `kms_driven`, `owner`, `reg_no`, `type`, `car_purch_year`, `insurance`, `mobile_no`, `email`, `document`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `status`) VALUES
(2, 'Raj', 'Ramani', 'Honda', 'Jazz', '1.2 V MT', 'Patrol', '30,771 km', '1st Owner', 'GJ-06-x-xxxx', 'Manual', '2018', 'Valid upto Apr 2023(3rd Party)', '8980260250', 'rajramani6609@gmail.com', '6283b5e12e1dcdoc.png', '6283b5e12e475car17.jpeg', '6283b5e12e7cacar17_angle1.jpeg', '6283b5e12e9b8car17_angle2.jpeg', '6283b5e12ebb1car17_angle3.jpeg', '6283b5e12edc7car17_interior.jpeg', '6283b5e12ef7bcar17_speedometer.jpeg', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `token1`
--

CREATE TABLE `token1` (
  `token_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `s_time` datetime DEFAULT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `otp` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `email`, `password`, `profile`, `role`) VALUES
(1, 'sahil Lotiya', 'sahillotiya3847@gmail.com', 'Tar055523', '66b255933f44aBilly 30.jpg', 'admin'),
(9, 'parth', 'parthkhokhar997@gmail.com', 'parth@123', '66f6426352931Billy 30.jpg', 'user'),
(10, 'dhruv', 'dhruv112@gmail.com', 'dhruv@123', '66c557ee9c08aCREATING WEALTH on Instagram_ _Don’t settle for….jfif', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `token1`
--
ALTER TABLE `token1`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token1`
--
ALTER TABLE `token1`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
