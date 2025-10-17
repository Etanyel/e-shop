-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 09:37 PM
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
-- Database: `petshop`
--
CREATE DATABASE IF NOT EXISTS `petshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `petshop`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` text NOT NULL,
  `product_name` text NOT NULL,
  `category` text NOT NULL,
  `species` text DEFAULT NULL,
  `breed` text DEFAULT NULL,
  `age` text DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('Available','Sold_out') NOT NULL DEFAULT 'Available',
  `arrival_date` datetime NOT NULL,
  `description` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_name`, `category`, `species`, `breed`, `age`, `qty`, `price`, `status`, `arrival_date`, `description`, `photo`, `deleted`) VALUES
(1, '72705', 'Betta splendens', 'pet', 'Fish', 'Halfmoon Betta', '1', 2, 5000, 'Available', '2025-08-02 08:50:00', 'Blue and White Fighting Fish', '1754095828_3a608cf1e626efd8c9ab.webp', 0),
(2, '14161', 'Fish Feeds', 'feeds', '', '', '', 5, 20, 'Available', '2025-08-02 14:48:00', 'Pagkaon sa fishball', '1754117344_dfe4ff0e6d00745d8369.png', 1),
(3, '3547', 'Fancy Guppy', 'feeds', NULL, NULL, NULL, 8, 550, 'Available', '2025-08-05 10:45:00', 'FOOR FISH FOOD', '1754361945_3c0df8be0b918afc2de8.jpeg', 0),
(4, '88391', 'JP', 'pet', 'Dog', 'Japanese Spitz', '2', 2, 4000, 'Available', '2025-08-05 10:55:00', 'White Dog', '1754362536_8ba7e38209e82b04c4b3.jpeg', 0),
(5, '80741', 'Garfield', 'pet', 'Cat', 'Garfield Cat', '1', 0, 4000, 'Sold_out', '2025-08-05 10:56:00', 'Garfield Cat orange', '1754362591_715d28a53443d69900c6.jpg', 0),
(6, '33005', 'Puggy', 'pet', 'Dog', 'Pug', '2', 1, 6000, 'Available', '2025-08-05 10:57:00', 'Puggy Dog', '1754362654_38147394d3e5d344ed78.webp', 0),
(7, '2153', 'Ruro', 'pet', 'Dog', 'Shih Tzu', '1', 2, 5000, 'Available', '2025-08-05 10:58:00', 'Shih Tzu Doggy', '1754362730_28befbb7ba4922d6cd1f.webp', 0),
(8, '52395', 'Arowana', 'pet', 'Fish', 'Silver Arowana', '2', 2, 12000, 'Available', '2025-08-05 10:59:00', 'Silver Back Arowana', '1754362815_612f7d1cf0645a64ac11.webp', 0),
(9, '68510', 'Feed Me', 'feeds', '', '', '', 4, 200, 'Available', '2025-08-05 11:01:00', 'Feed Me Brand With Turkey flavor', '1754362906_c896abe1acd5a1b09da0.webp', 0),
(10, '25456', 'Oscar Feeds', 'feeds', '', '', '', 3, 100, 'Available', '2025-08-05 11:02:00', 'Oscar Fish Foods', '1754362952_de54893b069f60d39350.jpg', 0),
(11, '92904', 'Pet One', 'feeds', '', '', '', 2, 250, 'Available', '2025-08-06 00:03:00', 'Pet One Dog Feeds', '1754362995_aadc1b9b19c4091d76b6.webp', 0),
(12, '81435', 'Webbox Natural', 'feeds', '', '', '', 0, 150, 'Sold_out', '2025-07-31 00:04:00', 'Webbox Natural Cat Feeds', '1754363086_4de4c53689b78f3d9f7c.webp', 0),
(13, '20178', 'Multivitamins', 'vitamins', '', '', '', 7, 500, 'Available', '2025-07-27 15:08:00', 'Multivitamins for strong bones 10-in-1', '1754370541_4b106fe0f5fb3a19356a.webp', 0),
(14, '61867', 'Bird Liv', 'vitamins', '', '', '', 10, 240, 'Available', '2025-08-02 13:09:00', 'FOR LIVER', '1754370605_047dab5501bd62a71b00.jpg', 0),
(15, '91949', 'Multivitamins Papi', 'vitamins', '', '', '', 6, 257, 'Available', '2025-08-05 13:10:00', 'For Puppy', '1754370644_2a965284fac2ad217e6d.png', 0),
(16, '15652', 'Vetflix', 'vitamins', '', '', '', 6, 450, 'Available', '2025-08-16 13:11:00', 'Multivitamins for your pet', '1754370709_46dcf5d0cf26d23602b0.jpg', 0),
(17, '49016', 'LC Vet', 'vitamins', NULL, NULL, NULL, 6, 200, 'Available', '2025-08-02 13:12:00', 'Multivitamins for pets', '1756023041_3505a61370b77e02c810.webp', 0),
(18, '74026', 'Cage 1', 'equipment', '', '', '', 2, 2500, 'Available', '2025-08-07 13:13:00', 'Cage for pet', '1754370798_8d2b936515764a339774.webp', 0),
(19, '71908', 'Bowl Pet', 'equipment', NULL, NULL, NULL, 10, 500, 'Available', '2025-08-09 13:13:00', 'Steel Bowl for Pet\r\n', '1754370827_9b04464c80ed16e960bf.jpg', 0),
(20, '90524', 'Plastic Bowl ', 'equipment', NULL, NULL, NULL, 7, 150, 'Available', '2025-07-15 13:14:00', 'Plastic Bowl for pets only', '1754370864_43f7bf5bd27e59b696bf.jpg', 0),
(21, '72898', 'Cage 2', 'equipment', '', '', '', 2, 3500, 'Available', '2025-08-05 13:22:00', 'Heavy Duty Cage', '1754371369_d126f1f978fe1b7a83d6.webp', 0),
(22, '27623', 'Cage 3', 'equipment', '', '', '', 1, 3000, 'Available', '2025-08-05 13:23:00', 'Stee Cage for Pets', '1754371417_631a35e8b95466fdbca2.jpg', 0),
(23, '57877', 'Next Guard', 'medicine', '', '', '', 15, 400, 'Available', '2025-06-18 13:26:00', 'For Parasites', '1754371607_a4feb71d4d8b3daee252.jpg', 0),
(24, '68968', 'Rid All Set', 'medicine', '', '', '', 10, 250, 'Available', '2025-08-05 13:27:00', 'For Fish', '1754371663_2ecf12ea0f21c176cd59.jpg', 0),
(25, '28094', 'Stressza', 'medicine', '', '', '', 4, 350, 'Available', '2025-08-05 13:28:00', 'For Cat and Dogs', '1754371695_feb74f331a3872acd5d8.jpg', 0),
(26, '76775', 'Birds Care', 'medicine', '', '', '', 13, 150, 'Available', '2025-08-05 13:28:00', 'Bird Medicine', '1754371736_2f6a40f040f8180e1afd.jpg', 0),
(27, '99072', 'Frontline', 'medicine', '', '', '', 5, 250, 'Available', '2025-08-05 13:29:00', 'Medicine For Cats\r\n', '1754371788_2af2ca6f2a12330c4b2b.jpg', 0),
(28, '58645', 'Aquadine', 'medicine', '', '', '', 7, 250, 'Available', '2025-08-05 13:30:00', 'Aquadine for Fish Medicine', '1754371827_af0a9f1ccfdd857e8061.webp', 0),
(29, '16223', 'Rubber Bone', 'accessories', '', '', '', 4, 100, 'Available', '2025-08-05 13:31:00', 'Toy for dogs', '1754371882_5a451f2021703284e570.jpg', 0),
(30, '55743', 'Dog Tag', 'accessories', '', '', '', 18, 50, 'Available', '2025-07-31 13:31:00', 'Dog Tag', '1754371924_f617d735cbb2fdf8cb36.webp', 0),
(31, '61911', 'Rubber Ball Toy', 'accessories', '', '', '', 100, 50, 'Available', '2025-08-05 13:33:00', 'Toy for pets', '1754372017_0bfc293731476ba57788.webp', 0),
(32, '87490', 'Aquarium Seeds', 'seeds', NULL, NULL, NULL, 50, 25, 'Available', '2025-08-05 13:34:00', 'Aquarium Plan Seeds', '1754372090_d6ea27c7462ef78fca9c.webp', 0),
(33, '11681', 'Crash Aquatic Seeds', 'seeds', '', '', '', 25, 50, 'Available', '2025-08-05 14:09:00', '', '1754374155_76d4b426649cb2b241ed.jpeg', 0),
(34, '75384', 'Golden ', 'pet', 'cat', 'Garfield', '3', 2, 4000, 'Available', '2025-09-09 20:55:00', '', '1758286985_44b557563fce019b4945.jpg', 0),
(35, '8383', 'Tiger', 'pet', 'cat', 'Tiger Cat', '2', 3, 3500, 'Available', '2025-09-19 21:03:00', '', '1758287308_de9c7516e1458bf155ea.jpg', 0),
(36, '41647', 'Lucario', 'pet', 'dog', 'Rottwiler', '.5', 2, 12000, 'Available', '2025-09-18 21:07:00', '', '1758287283_bb8699c635264c44d1de.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `sale_id` int(11) NOT NULL,
  `date_sold` datetime NOT NULL,
  `item_sold` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `sold_by` text DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`sale_id`, `date_sold`, `item_sold`, `total_qty`, `total_amount`, `sold_by`, `remarks`) VALUES
(3, '2025-08-05 07:06:46', 4, 1, 5000, 'staff', 'Noneee'),
(4, '2025-08-05 07:47:03', 18, 1, 2500, '', ''),
(5, '2025-08-05 12:04:43', 10, 4, 400, 'Dingdong', ''),
(6, '2025-08-05 12:05:11', 11, 7, 1750, 'Batman', 'Ok'),
(7, '2025-08-05 12:26:48', 8, 1, 12000, 'Boyet', ''),
(8, '2025-08-05 12:27:21', 13, 1, 500, 'Jackie Chan', ''),
(9, '2025-08-05 12:36:15', 19, 2, 1000, 'Jose Marie Chan', 'HO HO HO'),
(10, '2025-08-06 01:08:35', 15, 1, 257, 'Freddie Aguilar', 'None'),
(11, '2025-08-06 01:18:46', 4, 1, 5000, 'Happy', 'None'),
(12, '2025-08-06 01:19:16', 3, 3, 1650, 'staff', ''),
(13, '2025-08-08 10:45:35', 3, 4, 2200, 'staff', ''),
(14, '2025-08-08 10:45:48', 7, 1, 5000, 'Jose Marie Chan', ''),
(15, '2025-08-09 01:07:01', 6, 1, 6000, 'Boyet', ''),
(16, '2025-08-09 03:42:26', 11, 1, 250, 'Superman', ''),
(17, '2025-08-13 08:41:28', 17, 2, 400, '', ''),
(18, '2025-08-13 08:41:58', 28, 3, 750, 'Batman', ''),
(19, '2025-08-14 08:15:41', 13, 2, 1000, 'Jingkoy', ''),
(20, '2025-08-14 08:16:25', 15, 2, 514, 'Robin', ''),
(21, '2025-08-14 08:16:43', 16, 4, 1800, 'Bradley', ''),
(22, '2025-08-14 08:17:05', 20, 3, 450, 'John', 'Kike'),
(23, '2025-08-14 08:17:32', 30, 2, 100, 'Luna', ''),
(24, '2025-08-14 08:18:23', 25, 1, 350, '', ''),
(25, '2025-08-14 08:18:29', 29, 1, 100, ' ', ''),
(26, '2025-08-14 08:18:41', 26, 2, 300, ' ', ''),
(27, '2025-08-16 03:50:26', 15, 2, 514, 'Batman ', ''),
(28, '2025-08-16 23:13:53', 3, 2, 1100, 'None', ''),
(29, '2025-08-16 23:15:28', 9, 2, 400, ' ', ''),
(30, '2025-08-16 23:18:00', 12, 3, 450, ' ', ''),
(31, '2025-08-16 23:19:46', 11, 2, 500, ' ', ''),
(32, '2025-08-17 07:20:37', 13, 1, 500, ' ', ''),
(33, '2025-08-17 14:18:30', 9, 3, 600, 'Batman', ''),
(34, '2025-08-17 19:14:11', 10, 2, 200, ' ', ''),
(35, '2025-08-20 20:02:24', 11, 1, 250, 'Ethaniel Obordo', ''),
(36, '2025-08-20 20:20:04', 11, 1, 250, 'Kerk Ruzzel', ''),
(37, '2025-08-20 20:22:36', 4, 1, 5000, 'Kerk Ruzzel', ''),
(38, '2025-08-20 20:31:55', 12, 3, 450, 'Kerk Ruzzel', ''),
(39, '2025-08-22 18:37:05', 3, 3, 1650, 'Ethaniel Obordo', ''),
(40, '2025-08-22 18:39:23', 12, 4, 600, 'Ethaniel Obordo', ''),
(41, '2025-08-22 18:39:40', 5, 2, 8000, 'Ethaniel Obordo', ''),
(42, '2025-08-24 09:37:29', 4, 1, 5000, 'Ethaniel Obordo', ''),
(43, '2025-08-24 15:58:15', 10, 2, 200, 'Jose  Marie Chan', ''),
(44, '2025-08-24 16:20:50', 11, 2, 500, 'Jose  Marie Chan', ''),
(45, '2025-08-30 15:20:52', 11, 1, 250, 'lovely clapano', ''),
(46, '2025-09-19 20:07:25', 22, 1, 3000, 'Jose  Marie Chan', ''),
(47, '2025-09-19 20:07:32', 7, 1, 5000, 'Jose  Marie Chan', ''),
(48, '2025-09-19 20:07:37', 9, 1, 200, 'Jose  Marie Chan', ''),
(49, '2025-09-30 20:34:21', 36, 1, 12000, 'Jose  Marie Chan', ''),
(50, '2025-09-30 20:35:36', 17, 2, 400, 'Jose  Marie Chan', ''),
(51, '2025-10-01 20:57:57', 3, 2, 1100, 'Jose  Marie Chan', 'Mr. Bruce Wayne Buyer'),
(52, '2025-10-01 20:59:11', 6, 1, 6000, 'Jose  Marie Chan', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_sched`
--

CREATE TABLE `system_sched` (
  `system_id` int(11) NOT NULL,
  `chip_id` int(11) NOT NULL,
  `system_name` varchar(200) DEFAULT NULL,
  `morning_sched` time DEFAULT NULL,
  `noon_sched` time DEFAULT NULL,
  `evening_sched` time DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_sched`
--

INSERT INTO `system_sched` (`system_id`, `chip_id`, `system_name`, `morning_sched`, `noon_sched`, `evening_sched`, `isActive`) VALUES
(1, 4022719, 'Doggie', '09:24:00', '12:00:00', '18:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `contact` text NOT NULL,
  `photo` text DEFAULT NULL,
  `status` enum('approved','rejected','pending') NOT NULL DEFAULT 'pending',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `contact`, `photo`, `status`, `deleted`, `role`) VALUES
(9, 'admin', 'admin', 'admin', '$2y$10$n5BywtUM6sspbdLRSJmUpu8LWytQ4L3zQ9YBYNGUU4lBvP7Wogzzi', '09999999999', '1756023725_d1f6516405803f65c379.gif', 'approved', 0, 'admin'),
(10, 'Jose ', 'Marie Chan', 'Jose', '$2y$10$a5bx4jpvAjYh1oRZQZlPmeGf11E86SIO1mhyM3.emYdtgORg6ZKy.', '0911111111', '1756022047_ed78cfc758160fc9a5db.gif', 'approved', 0, 'employee'),
(11, 'lovely', 'clapano', 'clapz', '$2y$10$2UDAhJcQF82lUS5ehah7IunoZSha10lpYrEmFnQc6Q7n9dYKxxF5u', '09098333983', '1756538634_cfa2b7a958de2a259429.gif', 'approved', 0, 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `for_reports` (`item_sold`);

--
-- Indexes for table `system_sched`
--
ALTER TABLE `system_sched`
  ADD PRIMARY KEY (`system_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `system_sched`
--
ALTER TABLE `system_sched`
  MODIFY `system_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `for_reports` FOREIGN KEY (`item_sold`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
