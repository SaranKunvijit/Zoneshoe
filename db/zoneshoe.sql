-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2024 at 06:51 AM
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
-- Database: `zoneshoe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `product_id`, `quantity`) VALUES
(19, 'saran', '43', 3),
(20, 'saran', '42', 1),
(21, 'saran1', '38', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `brand`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Puma'),
(4, 'Vans');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `item_count` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `total_price`, `item_count`, `name`, `address`, `phone`, `order_date`) VALUES
(21, 21300, 4, 'saran', 'surat', '0951454688', '2024-09-04 19:43:49'),
(22, 8600, 2, 'saran', 'surat', '0951454688', '2024-09-05 04:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `product_id`, `quantity`) VALUES
(29, 21, 43, 3),
(30, 21, 42, 1),
(31, 22, 38, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `product_price`, `category_id`, `image`) VALUES
(38, 'Nike Air Jordan 1 Low', 'Air Jordan 1 Low ได้แรงบันดาลใจจากรุ่นออริจินัลที่เปิดตัวในปี 1985 ด้วยลุคคลาสสิกสะอาดตาอย่างที่คุ้นเคย แต่ยังสดใหม่เสมอ รองเท้าคู่นี้มาในดีไซน์อันเป็นเอกลักษณ์ที่จับคู่กับทุกชุดได้อย่างลงตัว จึงมั่นใจได้ว่าคุณจะเป๊ะปังอยู่เสมอ', 4300, 1, 'Air-Jordan-1-Low-4300.png'),
(39, 'Air Jordan Legacy 312 Low', 'เฉลิมฉลองให้กับตำนาน MJ ด้วยการประกาศให้รู้ถึงรหัสพื้นที่ของชิคาโกนั่นคือ 312 รุ่นนี้มาพร้อมองค์ประกอบจาก Jordan สามรุ่นไอคอน (AJ3, AJ1 และ Air Alpha Force) จึงเป็นการผสมผสานสุดโมเดิร์นที่สื่อถึงความเป็นที่สุด', 5400, 1, 'Nike-Air-Jordan-Legacy-312-Low-5400..png'),
(40, 'Nike Jumpman MVP', 'เราไม่ได้คิดค้นการรีมิกซ์ แต่ถ้าลองพิจารณาถึงวัสดุที่เราหามาลองใช้ คู่นี้ก็ดูดีแบบไม่ต้องสืบเลย เรานำองค์ประกอบจาก AJ6, 7 และ 8 มารังสรรค์เป็นรองเท้าคู่ใหม่หมดจดที่เฉลิมฉลองให้กับครั้งแรกที่ MJ คว้าแชมป์ 3 สมัยติดเป็นครั้งแรก สนีกเกอร์คู่นี้ยกย่องตํานานเพียงหนึ่งเดียว พร้อมส่งเสริมให้คุณสร้างตำนานบทใหม่ของคุณเองด้วยรายละเอียดจากหนัง ผ้า และนูบัค', 6100, 1, 'รองเท้าผู้ชาย-Jumpman-MVP-6100.png'),
(41, 'Nike Air Jordan 1 Low OG ', 'Air Jordan 1 Low OG นำสนีกเกอร์สุดคลาสสิกมาปรับโฉมโดยใช้สีและเท็กซ์เจอร์แบบใหม่ มาพร้อมวัสดุและส่วนเน้นระดับพรีเมียมที่ทำให้รองเท้าคู่โปรดตลอดกาลมีความสดใหม่', 5400, 1, 'Nike-Air-Jordan-1- Low-OG-Wolf- Grey-5400.png'),
(42, 'YZY QNTM', 'โดดเด่นด้วยอัปเปอร์ที่ประกอบด้วยตาข่ายโมโนแบบปักที่ให้ความนุ่มและยืดหยุ่น พร้อมหุ้มชั้นหนังกลับสังเคราะห์ที่ให้การปกป้องนิ้วเท้าและความทนทาน วัสดุสะท้อนแสงบริเวณสายรัดด้านในและส่วนหุ้มส้นจะช่วยให้คุณโดดเด่นในความมืด', 5100, 2, '20240819_185531919_iOS.png'),
(43, 'Adidas Originals x Star Wars', 'เดินทางสู่กาแล็กซีอันไกลโพ้นด้วยสัดส่วนอันโดดเด่นและอาร์ตเวิร์คออริจินัลของรองเท้าเทรนเนอร์ Adidas Superstar คู่นี้ โดยความร่วมมือกับ Nanzuka แกลเลอรีศิลปะร่วมสมัยในโตเกียวที่เป็นจุดบรรจบของวัฒนธรรมและความคิดสร้างสรรค์ โดดเด่นด้วยลายพิมพ์ R2-D2 และ C-3PO สุดพิเศษจากศิลปิน Hiroki Tsukuda ซึ่งสร้างด้วยรายละเอียดสุดคลาสสิกที่ทำให้รองเท้า Adidas Superstar กลายเป็นรองเท้าคลาสสิกตลอดกาล ', 5400, 2, '20240819_185856841_iOS.png'),
(44, 'Adidas NMD_R1', 'เก็บกระเป๋าให้พร้อม ผูกเชือกรองเท้าให้แน่น แล้วออกลุย ออกผจญภัยในเมืองไปพร้อมกับรองเท้า NMD_R1 คู่นี้ ปรับโฉมรองเท้าวิ่งอาดิดาสสุดโด่งดังจากยุค 80 ให้กลายเป็นรองเท้าดีไซน์ทันสมัยที่ใส่สบายตลอดวันโดยมีอัปเปอร์ผ้าถักยืดหยุ่นสัมผัสนุ่มและส่วนรับแรงกระแทก Boost ที่ช่วยส่งคืนพลัง สร้างความโดดเด่นด้วยสีสันสะดุดตาและปลั๊กบนพื้นชั้นกลางที่เป็นซิกเนเจอร์ ไม่ว่าจะมุ่งหน้าไปที่ไหน คุณก็พร้อมเฉิดฉายอย่างมีสไตล์', 5500, 2, '20240819_185952043_iOS.png'),
(45, 'Adidas Superstar XLG', 'ถ้าคุณคิดว่ารองเท้าอาดิดาส Superstar คงไม่มีทางโดดเด่นไปมากกว่านี้ รองเท้าคู่นี้จะพิสูจน์ให้เห็นด้วยการนำรองเท้าคลาสสิกยุค 70 มาพลิกโฉมให้ใหญ่และทันสมัย ขยายสัดส่วนให้ใหญ่ขึ้นพอ ๆ กับตัวตนที่แสนโดดเด่นเพื่อความสะดุดตา พร้อมแต่งแถบ 3-Stripes ที่เป็นไอคอน อัปเปอร์ทำจากหนังแท้ทั้งหมดตามแบบรุ่นต้นฉบับ พร้อมปรับรูปทรงรองเท้าใหม่เพื่อความทันสมัย ก้าวอย่างมั่นใจไปกับรองเท้าหัวเปลือกหอยคู่นี้', 4300, 2, '20240819_185824233_iOS.png'),
(46, 'Zapatillas Road Rider Pace Setter unisex', 'Puma ยังคงพัฒนาสีสันที่เก่าของพวกเขาให้ตรงกับความต้องการสูงของผู้ที่รักรองเท้าสมัยใหม่ หนึ่งในรุ่นที่ปรับปรุงใหม่คือรองเท้า Puma Style Rider ซึ่งมีพื้นฐานจากรูปทรง Fast Ride รูปทรงที่ได้รับความนิยมอย่างมากในปี 1980 สีสันที่โดดเด่นของรองเท้า Puma Style Rider อาจจะซ่อนข้อดีที่แท้จริงของรองเท้า', 2900, 3, '20240819_193953344_iOS.png'),
(47, 'Caven 2.0 Year Of Sport Unisex Sneakers', 'ปลดปล่อยนักกีฬาภายในตัวคุณด้วยรองเท้าที่ได้รับแรงบันดาลใจจากสนามบาสเกตบอลเหล่านี้ พื้นรองเท้าสูงและส่วนบนที่มีลักษณะพื้นผิวทำให้คุณมีสไตล์ที่โดดเด่นสะดุดตา', 3000, 3, '20240819_194109350_iOS.png'),
(48, 'BMW M Motorsport Neo Cat Mid 2.0 Unisex Sneakers', 'ได้รับแรงบันดาลใจจากรองเท้าขับรถของ Bellof รองเท้ากีฬา PUMA Motorsport คู่แรกที่สร้างขึ้นสำหรับนักขับรถที่เป็นตำนาน Stefan Bellof ', 2300, 3, '20240819_193936531_iOS.png'),
(49, 'Blktop Rider Unisex Sneakers', 'พบกับสมาชิกใหม่ล่าสุดของครอบครัว PUMA Rider, Blktop Rider ในรุ่นนี้ สีสันและวัสดุที่มีต้นกำเนิดมาพบกับการออกแบบสมัยใหม่เพื่อเสนอคลาสสิกในอนาคต รองเท้าผ้าใบเหล่านี้ที่ได้รับแรงบันดาลใจจากยุค 80 ถูกออกแบบด้วยฐานที่ทำจากไนลอนและเสริมด้วยหนังกลับเพื่อดีไซน์ที่เรียบหรู', 3900, 3, '20240819_194004337_iOS.png'),
(50, ' Era Varsity Canvas | Green/Blue ', 'Vans Era ซึ่งเดิมเรียกว่า Vans #95 มีชีวิตขึ้นมาในปี 1976 และได้รับความนิยมจาก Z-Boys ในตำนานแห่งซานตาโมนิกา เป็นรองเท้าคู่แรกที่มีส่วนหุ้มข้อบุนวมอันโด่งดังของเรา และวันนี้ยังคงเป็นรองเท้าโปรดของผู้สร้างสรรค์ทั่วโลก โดดเด่นด้วยส่วนบนจากผ้าใบที่ทนทานและหนังกลับ เติมพลังให้กับรองเท้าส้นเตี้ยที่ไร้กาลเวลาของเราด้วยสไตล์ที่ง่ายดาย ', 2100, 4, '20240819_200713067_iOS.png'),
(51, 'VANS SK8-HI - MOONEYES FORMULA ONEMULTI', 'เปิดตัวในปี 1978 รองเท้าสเก็ต Vans Sk8-Hi ซึ่งเดิมชื่อว่า \"Style 38\" เป็นนวัตกรรมที่ก้าวล้ำในโลกของรองเท้าสเก็ตบอร์ด ออกแบบมาเพื่อให้การสนับสนุนข้อเท้าเพิ่มเติมสำหรับนักสเก็ตบอร์ด Sk8-Hi เป็นรุ่นที่สองที่มีลาย \"jazz stripe\" ที่โดดเด่นของ Vans ด้านข้าง', 2700, 4, '20240819_200807148_iOS.png'),
(52, 'VANS COMFYCUSH SK8-HI - AFTER DARK BLACK/GREEN', 'ทุกชิ้นส่วนจากไลน์ SK8-Hi Comfycush ถูกออกแบบมาเพื่อเน้นความเป็นเอกลักษณ์ของคุณ ความสบายและความเชื่อถือได้เป็นพื้นฐานของแบรนด์ Vans รองเท้าสีดำและเขียวนี้เข้ากันได้อย่างกลมกลืนกับเสื้อผ้าส่วนใหญ่', 3400, 4, '20240819_200925758_iOS.png'),
(53, 'Vans Old Skool Van Doren Special True White Red', 'รองเท้าสเก็ต Vans Old Skool มีพื้นรองเท้าสูตรวัลคาไนซ์ที่มีลาย \"วาฟเฟิล\" ของ Vans ซึ่งป้องกันการลื่นไถล รองเท้าของ Vans คู่นี้มีพื้นรองเท้าด้านในที่นุ่มสบาย รองเท้าสนีกเกอร์ Vans Old Skool มีส้นรองเท้าที่เสริมความแข็งแรงและบุด้านในด้วยหนัง', 2400, 4, '20240819_201131289_iOS.png');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userss`
--

INSERT INTO `userss` (`user_id`, `username`, `name`, `address`, `phone`, `password`, `status`) VALUES
(1, 'saran', 'saran', 'surat', '0951454688', '$2y$10$wEEPmLZcQ62yeKu1eNHlnuwt3aHPCmIYVTVhh7nPwrKnBnuLsfHPK', 'admin'),
(6, 'saran1', 'saran', 'surat', '0951454688', '$2y$10$4nRvdkGo8YeEfO1CjeHIsu0oCAw12IXqtMn5cv52VFQ1ONUbsYBjS', 'user'),
(7, 'saran13', 'saran', '31 หมู่ที่ 6 ตำบลมะขามเตี้ย อำเภอเมืองสุราษฎร์ธานี สุราษฎร์ธานี', '0951454688', '$2y$10$I2Gy5aEfojMhBfIHXz3YyuvrOdAC7iVwA6PZBn7KUo/Cpx2tKeati', 'user'),
(8, 'admin', 'saran', 'surat', '0951454688', '$2y$10$70MNBazp/SFpmA/X7Fc8fOWts8tVUyrRdM2SqOPUYSphzqjbZHMg2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `userss`
--
ALTER TABLE `userss`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
