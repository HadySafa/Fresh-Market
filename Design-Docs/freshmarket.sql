-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 02:45 AM
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
-- Database: `freshmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PaymentMethod` varchar(100) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `UserId`, `PaymentMethod`, `Status`, `Location`, `Timestamp`) VALUES
(16, 10, 'cod', 'Delivered', 'Beirut,Lebanon', '2025-03-06 20:12:48'),
(17, 9, 'check', 'Delivered', 'Beirut,Lebanon', '2025-03-06 20:15:21'),
(18, 9, 'cod', 'Delivered', 'Hamra, near CMC', '2025-03-06 20:16:04'),
(19, 9, 'cod', 'Delivered', 'Beirut,Lebanon', '2025-03-06 20:16:48'),
(20, 9, 'cod', 'Delivered', 'Beirut,Lebanon', '2025-03-06 20:17:12'),
(21, 9, 'cod', 'Pending', 'beirut', '2025-03-06 20:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Description`, `Price`, `Image`, `Category`, `Quantity`) VALUES
(5, 'Pasta', 'Raw pasta.', 0.89, './Backend/Uploads/Pasta.png', 'Groceries', 95),
(10, 'Orange Juice', 'Fresh orange juice', 1.25, './Backend/Uploads/Orange Juice.png', 'Snacks&Beverages', 36),
(15, 'Chocolate', 'Premium Qualtiy Chocolate ', 1.50, './Backend/Uploads/Chocolate.png', 'Snacks&Beverages', 101),
(16, 'Chips', 'Crunchy Chips', 0.75, './Backend/Uploads/Chips.jpg', 'Snacks&Beverages', 87),
(19, 'Basil', 'Fresh Basil Leaves', 0.75, './Backend/Uploads/Basil.png', 'Fruits&Vegetables', 90),
(20, 'Mint', 'Fresh Mint Leaves', 1.25, './Backend/Uploads/Mint.png', 'Fruits&Vegetables', 150),
(21, 'Olive Oil', 'Virgin Olive Oil 750ml', 5.00, './Backend/Uploads/Olive Oil.png', 'Groceries', 43),
(22, 'Rice', 'White Rice 1kg', 3.25, './Backend/Uploads/Rice.png', 'Groceries', 200),
(23, 'Tomato', 'Fresh Tomato 1kg', 1.75, './Backend/Uploads/Tomato.png', 'Fruits&Vegetables', 200),
(24, 'Candies', 'Sweet Candies', 0.50, './Backend/Uploads/Candies.png', 'Snacks&Beverages', 295);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Id` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Id`, `Quantity`, `ProductId`, `OrderId`) VALUES
(14, 5, 10, 16),
(15, 5, 15, 16),
(16, 2, 21, 17),
(17, 5, 5, 17),
(18, 30, 23, 18),
(19, 5, 24, 19),
(20, 5, 16, 19),
(21, 5, 10, 19),
(22, 10, 15, 19),
(23, 4, 16, 20),
(24, 4, 10, 21),
(25, 4, 16, 21),
(26, 4, 15, 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Email`, `PhoneNumber`, `Password`, `Role`) VALUES
(8, 'Hady Safa', 'hadysafaa04@gmail.com', '70860816', '$2y$10$sZTuekm3sA2DLBIgUAHj1OwqNioA.aYAyko36R44SiIkBhxnuP2L6', 'Admin'),
(9, 'Adam', 'adam456@gmail.com', '70456456', '$2y$10$gSQdkTaETwASIzTbYOGaGunAIqU637NvhaIORdDMSH0wvOZtl8oI.', 'User'),
(10, 'Lamis', 'lamis654@gmail.com', '70654654', '$2y$10$QVbGDofEaNzlJiHtYiDKEuHiNc0eL4TNUKTLv/LBX.8QExKBlEeu6', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
