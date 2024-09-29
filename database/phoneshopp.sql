-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 29, 2024 lúc 02:07 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phoneshopp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `builds`
--

CREATE TABLE `builds` (
  `buildsId` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_customerId` int(11) NOT NULL,
  `products_productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `products_productId` int(11) NOT NULL,
  `customer_customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `quantity`, `date`, `products_productId`, `customer_customerId`) VALUES
(27, 1, '2024-09-29', 24, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categorys`
--

CREATE TABLE `categorys` (
  ` categoryid` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categorys`
--

INSERT INTO `categorys` (` categoryid`, `categoryName`) VALUES
(1, 'SamSum'),
(2, 'Iphone'),
(3, 'Nokia'),
(4, 'Readme'),
(5, 'ViVo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `credits`
--

CREATE TABLE `credits` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `creditCardCode` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(45) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `customerImg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`customerId`, `customerName`, `phone`, `email`, `address`, `password`, `gender`, `birthday`, `customerImg`) VALUES
(0, 'Lê Huy  ', '0878007000', 'hoang11@gmail.com', NULL, '7fa8282ad93047a4d6fe6111c93b308a', NULL, NULL, NULL),
(9, 'Lê Huy Hoàng', '0878007397', 'hoang310704@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `methodPayment` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `infomation` varchar(550) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `priceOld` double DEFAULT NULL,
  `quantity_product` int(11) NOT NULL,
  `productlmgMain` varchar(550) DEFAULT NULL,
  `numberViewed` int(11) DEFAULT NULL,
  `categorys_categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productId`, `productName`, `infomation`, `price`, `priceOld`, `quantity_product`, `productlmgMain`, `numberViewed`, `categorys_categoryid`) VALUES
(21, 'Iphone 16 promax', 'đẹp và sang', 10000, 23000, 100, '1.jpg', NULL, 2),
(22, 'iphone 15 promax', 'đẹp và sang', 10000, 30000, 100, '2.jpg', NULL, 2),
(23, 'Iphone 11 Pro', 'đẹp và sang', 10000, 23000, 30, '3.jpg', NULL, 2),
(24, 'iphone 11 promax', 'đẹp và sang', 1500, 23000, 34, '5.jpg', 1, 2),
(25, 'Iphone 14 promax', 'đẹp và sang', 1500, 23000, 44, '6.jpg', NULL, 2),
(26, 'iphone 12 Promax', 'đẹp và sang', 10000, 12000, 33, '7.jpg', NULL, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `producttimgs`
--

CREATE TABLE `producttimgs` (
  ` producttimgsId` int(11) NOT NULL,
  `addressImg` text DEFAULT NULL,
  `moreInfor` text DEFAULT NULL,
  `products_productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `builds`
--
ALTER TABLE `builds`
  ADD PRIMARY KEY (`buildsId`),
  ADD KEY `fk_builds_customer1_idx` (`customer_customerId`),
  ADD KEY `fk_builds_products1_idx` (`products_productId`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_products_idx` (`products_productId`),
  ADD KEY `fk_cart_customer1_idx` (`customer_customerId`);

--
-- Chỉ mục cho bảng `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (` categoryid`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `fk_products_categorys1_idx` (`categorys_categoryid`),
  ADD KEY `categorys_ categoryid` (`categorys_categoryid`),
  ADD KEY `categorys_categoryid` (`categorys_categoryid`);

--
-- Chỉ mục cho bảng `producttimgs`
--
ALTER TABLE `producttimgs`
  ADD PRIMARY KEY (` producttimgsId`),
  ADD KEY `fk_producttimgs_products1_idx` (`products_productId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `categorys`
--
ALTER TABLE `categorys`
  MODIFY ` categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `builds`
--
ALTER TABLE `builds`
  ADD CONSTRAINT `fk_builds_customer1` FOREIGN KEY (`customer_customerId`) REFERENCES `customer` (`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_builds_products1` FOREIGN KEY (`products_productId`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_customer1` FOREIGN KEY (`customer_customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_products` FOREIGN KEY (`products_productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categorys1` FOREIGN KEY (`categorys_categoryid`) REFERENCES `categorys` (`categoryid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `producttimgs`
--
ALTER TABLE `producttimgs`
  ADD CONSTRAINT `fk_producttimgs_products1` FOREIGN KEY (`products_productId`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
