-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 01:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Trà sữa'),
(2, 'Món ăn nhẹ'),
(3, 'Bánh mì'),
(4, 'Cà phê');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fullname`, `sex`, `phone`, `address`) VALUES
(1, 'Lê Thị Trâm Anh', 'Nữ', '0937942618', 'Hóc Môn, Tp.HCM'),
(2, 'Nguyễn Xuân Thi', 'Nữ', '0338944613', 'Hóc Môn, Tp.HCM'),
(3, 'Nguyễn Trọng Nghĩa', 'Nam', '0368362945', 'Quận 12,Tp.HCM'),
(4, 'Cao Thanh Điền', 'Nam', '0475284629', 'Quận 12,Tp.HCM'),
(5, 'Đồng Văn Duy', 'Nam', '0937286382', 'Quận 12, Tp.HCM'),
(6, 'Trần Lâm Tâm Như', 'Nữ', '0368364826', 'Hóc Môn, Tp.HCM');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `note` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_customer`, `order_date`, `note`) VALUES
(223, 2, '2023-11-11', ''),
(224, 3, '2023-11-11', ''),
(226, 1, '2023-11-12', ''),
(227, 4, '2023-11-15', ''),
(228, 5, '2023-11-16', ''),
(229, 6, '2023-11-17', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `id_user`, `num`, `price`, `status`) VALUES
(1, 223, 11, 5, 3, 20000, 'Đã nhận hàng'),
(2, 227, 16, 3, 1, 35000, 'Đã nhận hàng'),
(4, 224, 2, 6, 2, 35000, 'Đã hủy'),
(5, 226, 15, 4, 4, 30000, 'Đã hủy'),
(6, 229, 10, 1, 2, 35000, 'Đang chuẩn bị'),
(7, 228, 6, 2, 4, 25000, 'Đã nhận hàng');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `number` float NOT NULL,
  `thumbnail` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `number`, `thumbnail`, `content`, `id_category`) VALUES
(1, 'BÁNH SÔ-CÔ-LA', 35000, 20, 'uploads/SOCOLAHL.png', 'Sô cô la ngọt ngào và kem tươi béo ngậy, được phủ thêm một lớp sô cô la mỏng bên trên cho thêm phần hấp dẫn.', 2),
(2, 'Trà Sen Vàng', 50000, 50, 'uploads/TRASENVANG.png', 'Sự kết hợp độc đáo giữa trà Ô long, hạt sen thơm bùi và củ năng giòn tan. Thêm vào chút sữa sẽ để vị thêm ngọt ngào.', 1),
(3, 'Bánh Mì Thịt Nướng', 25000, 30, 'uploads/BMTHITNUONG.png', 'Đặc sản của Việt Nam! Bánh mì giòn với nhân thịt nướng, rau thơm và gia vị đậm đà, hòa quyện trong lớp nước sốt tuyệt hảo.', 3),
(4, 'BÁNH MOUSSE ĐÀO', 35000, 10, 'uploads/MOUSSEDAO.png', 'Một sự kết hợp khéo léo giữa kem và lớp bánh mềm, được phủ lên trên vài lát đào ngon tuyệt', 2),
(5, 'Trà sữa trân trâu đường đen', 50000, 10, 'uploads/Trà-sữa-Trân-châu-đen-1.png', 'Trà sữa trân trâu đường đen', 1),
(6, 'Trà sữa Matcha', 50000, 46, 'uploads/TRASUAMATCHA.png', 'Trà sữa Matcha', 1),
(7, 'Cafe Phin Đen Nóng', 40000, 44, 'uploads/AMERICANO.png', 'Cà phê đậm đà pha từ Phin, cho thêm 1 thìa đường, mang đến vị cà phê đậm đà chất Phin.', 4),
(8, 'Bạc Xỉu Đá', 40000, 10, 'uploads/Trà-sữa-Trân-châu-đen-1.png', 'Nếu Phin Sữa Đá dành cho các bạn đam mê vị đậm đà, thì Bạc Xỉu Đá là một sự lựa chọn nhẹ “đô\" cà phê nhưng vẫn thơm ngon, chất lừ không kém!', 4),
(9, 'BÁNH CHUỐI', 19000, 20, 'uploads/BANHCHUOI.jpg', 'Bánh chuối truyền thống, sự kết hợp của 100% chuối tươi và nước cốt dừa Việt Nam.', 2),
(10, 'Bánh Mousse Cacao', 35000, 10, 'uploads/MOUSSECACAO.png', 'Bánh Mousse Ca Cao, là sự kết hợp giữa ca-cao Việt Nam đậm đà cùng kem tươi.', 2),
(11, 'Bánh Mì Xíu Mại', 20000, 30, 'uploads/BMXIUMAI.png', 'Bánh mì Việt Nam giòn thơm, với nhân thịt viên hấp dẫn, phủ thêm một lớp nước sốt cà chua ngọt, cùng với rau tươi và gia vị đậm đà.', 3),
(12, 'Bánh Caramel Phô Mai', 35000, 10, 'uploads/CARAMELPHOMAI.jpg', 'Ngon khó cưỡng! Bánh phô mai thơm béo được phủ bằng lớp caramel ngọt ngào.', 2),
(13, 'Trà Thạch Đào', 50000, 10, 'uploads/TRATHANHDAO.png', 'Vị trà đậm đà kết hợp cùng những miếng đào thơm ngon mọng nước cùng thạch đào giòn dai. Thêm vào ít sữa để gia tăng vị béo', 1),
(14, 'Trà Thạch Vải', 50000, 46, 'uploads/TRATHACHVAI.png', 'Một sự kết hợp thú vị giữa trà đen, những quả vải thơm ngon và thạch giòn khó cưỡng, mang đến thức uống tuyệt hảo!', 1),
(15, 'Cà Phê Đá', 30000, 15, 'uploads/CFD.png', 'Cà phê đậm đà pha hoàn toàn từ Phin, cho thêm 1 thìa đường, một ít đá viên mát lạnh, tạo nên Phin Đen Đá mang vị cà phê đậm đà chất Phin.', 4),
(16, 'Bánh Tiramisu', 35000, 12, 'uploads/TIRAMISU.jpg', 'Tiramisu thơm béo, làm từ ca-cao Việt Nam đậm đà, kết hợp với phô mai ít béo, vani và chút rum nhẹ nhàng.', 2),
(17, 'Chả Lụa Xá Xíu', 20000, 30, 'uploads/BMCHALUAXAXIU.png', 'Bánh mì Việt Nam giòn thơm với chả lụa và thịt xá xíu thơm ngon, kết hợp cùng rau và gia vị, hòa quyện cùng nước sốt độc đáo.', 3),
(18, 'Gà Xé Tương Ớt', 19000, 20, 'uploads/BMGAXE.png', 'Bánh mì Việt Nam giòn thơm với nhân gà xé, rau, gia vị hòa quyện cùng nước sốt đặc biệt.', 3),
(19, 'Cafe Phindi Hồng Trà', 40000, 32, 'uploads/PHINDI_Hong_Tra.png', 'PhinDi Hồng Trà - Cà phê Phin thế hệ mới với chất Phin êm hơn, lần đầu tiên kết hợp cùng Hồng Trà mang đến hương vị quyện êm.', 4),
(20, 'Cafe Phindi Kem Sữa', 40000, 42, 'uploads/Phindi_Kem_Sua.png', 'PhinDi Kem Sữa - Cà phê Phin thế hệ mới với chất Phin êm hơn, kết hợp cùng Kem Sữa béo ngậy mang đến hương vị mới lạ, không thể hấp dẫn hơn!', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `access` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `password`, `phone`, `email`, `sex`, `access`) VALUES
(1, 'Phạm Thị Thúy Vy', 'thuyvy0708', 'thuyvy0803', '0937942618', 'vy2003@gmail.com', 'Nữ', 'admin'),
(2, 'Lê Đức Thịnh', 'ducthinh2003', 'thinhle2003', '0387578520', 'thinh@gmail.com', 'Nam', ''),
(3, 'Vũ Đức Cường', 'cuongvu', 'vuduccuong02', '0329397493', 'cuongvu@gmail.com', 'Nam', ''),
(4, 'Trần Ngọc Bích Vy', 'bichvyy', 'bichhvy2003', '0367497419', 'vytran@gmail.com', 'Nữ', ''),
(5, 'Nguyễn Huỳnh Bảo Trân', 'tranhuynh', 'tranhuynh0803', '0359173894', 'baotran@gmail.com', 'Nữ', ''),
(6, 'Ngô Huỳnh Minh Đạt', 'dathuynh', 'dathuynh1103', '0928384718', 'minhdat@gmail.com', 'Nam', ''),
(13, 'Nguyễn Thị Ngọc Hạnh', 'ngochanh', 'hanh123', '0359384628', 'hanh2003@gmail.com', 'Nữ', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
