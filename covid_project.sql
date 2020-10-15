-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2020 at 12:46 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `business_id` int(11) NOT NULL,
  `business_num` int(11) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `business_address` varchar(50) DEFAULT NULL,
  `business_hours` varchar(200) DEFAULT NULL,
  `business_type` varchar(50) NOT NULL,
  `business_link` varchar(200) NOT NULL,
  `entry_date` date NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`business_id`, `business_num`, `business_name`, `business_address`, `business_hours`, `business_type`, `business_link`, `entry_date`, `last_updated`) VALUES
(1, 0, 'Applebees', '4331 Credit Union Dr, Anchorage, AK 99503', 'Sun 11:00 am - 11:00 pm\r\nMon 11:00 am - 12:00 pm\r\nTue 11:00 am - 12:00 pm\r\nWed 11:00 am - 12:00 pm\r\nThu 11:00 am - 12:00 pm\r\nFri 11:00 am - 12:00 pm\r\nSat 11:00 am - 12:00 pm', 'Food/Restaurant', 'https://www.applebees.com/en/news/2020/safety-first-at-applebees', '2020-10-09', '2020-10-09'),
(2, 0, 'Bass Pro Shop', ' 3046 Mountain View Dr, Anchorage, AK 99501', 'Sun 11:00 am - 5:00 pm\r\nMon 10:00 am - 8:00 pm\r\nTue 10:00 am - 8:00 pm\r\nWed 10:00 am - 8:00 pm\r\nThu 10:00 am - 8:00 pm\r\nFri 10:00 am - 8:00 pm\r\nSat 10:00 am - 8:00 pm', 'Sporting/Hunting', 'https://www.basspro.com/shop/en/covid-commitment', '2020-10-09', '2020-10-09'),
(3, 0, 'Bear Tooth', ' 3046 Mountain View Dr, Anchorage, AK 99501', 'Sun 11:00 am - 9:30 pm\r\nMon 11:00 am - 9:30 pm\r\nTue 11:00 am - 9:30 pm\r\nWed 11:00 am - 9:30 pm\r\nThu 11:00 am - 9:30 pm\r\nFri 11:00 am - 9:30 pm\r\nSat 11:00 am - 9:30 pm', 'Food/Restaurant', 'https://beartooththeatre.net/', '2020-10-09', '2020-10-09'),
(4, 0, 'Best Buy', '800 E Dimond Blvd Ste 100, Anchorage, AK 99515', 'Sun 10:00 am - 8:00 pm\r\nMon 10:00 am - 8:00 pm\r\nTue 10:00 am - 8:00 pm\r\nWed 10:00 am - 6:00 pm\r\nThu 10:00 am - 6:00 pm\r\nFri 10:00 am - 6:00 pm\r\nSat 10:00 am - 6:00 pm', 'Retail', 'https://www.bestbuy.com/site/misc/shop-confidently', '2020-10-09', '2020-10-09'),
(5, 0, 'Cabelas', '155 W 104th AvenueAnchorage, AK 99515', 'Sun 11:00 am - 5:00 pm\r\nMon 10:00 am - 8:00 pm\r\nTue 10:00 am - 8:00 pm\r\nWed 10:00 am - 8:00 pm\r\nThu 10:00 am - 8:00 pm\r\nFri 10:00 am - 8:00 pm\r\nSat 10:00 am - 8:00 pm', 'Sporting/Hunting', 'https://www.cabelas.com/shop/en/covid-commitment', '2020-10-09', '2020-10-09'),
(6, 0, 'Carrs', '1340 Gambell St, Anchorage, AK 99501', 'Sun 11:00 am - 5:00 pm\r\nMon 10:00 am - 8:00 pm\r\nTue 10:00 am - 8:00 pm\r\nWed 10:00 am - 8:00 pm\r\nThu 10:00 am - 8:00 pm\r\nFri 10:00 am - 8:00 pm\r\nSat 10:00 am - 8:00 pm', 'Grocery/Pharmacy', 'https://www.carrsqc.com/pharmacy/covid-19.html', '2020-10-09', '2020-10-09'),
(7, 0, 'Century 16', '301 E 36th Ave, Anchorage, AK 99503', NULL, 'Entertainment', 'https://www.cinemark.com/theatres/ak-anchorage/century-16-and-xd#theatreInfo', '2020-10-09', '2020-10-09'),
(8, 0, 'Dimond Center Mall', '800 E Dimond Blvd, Anchorage, AK 99515', 'Sun 12:00 pm - 7:00 pm\r\nMon 11:00 am - 8:00 pm\r\nTue 11:00 am - 8:00 pm\r\nWed 11:00 am - 8:00 pm\r\nThu 11:00 am - 8:00 pm\r\nFri 11:00 am - 8:00 pm\r\nSat 11:00 am - 8:00 pm', 'Retail', 'https://dimondcenter.com/', '2020-10-09', '2020-10-09'),
(9, 0, 'Great Clips', '1380 W Northern Lights Blvd, Anchorage, AK 99503', 'Sun 10:00 am - 5:00 pm\r\nMon 9:00 am - 6:00 pm\r\nTue 9:00 am - 7:00 pm\r\nWed 9:00 am - 7:00 pm\r\nThu 9:00 am - 7:00 pm\r\nFri 9:00 am - 7:00 pm\r\nSat 9:00 am - 7:00 pm', 'Hair/Beauty', 'https://www.greatclips.com/about-us/news-room/coronavirus', '2020-10-09', '2020-10-09'),
(10, 0, 'Lowes', '333 E Tudor Rd, Anchorage, AK 99503', 'Sun 7:00 am - 8:00 pm\r\nMon 6:00 am - 9:00 pm\r\nTue 6:00 am - 9:00 pm\r\nWed 6:00 am - 9:00 pm\r\nThu 6:00 am - 9:00 pm\r\nFri 6:00 am - 9:00 pm\r\nSat 6:00 am - 9:00 pm', 'Home and Improvement', 'https://corporate.lowes.com/newsroom/stories/inside-lowes/responding-covid-19-serving-customers-and-associates-essential-products-and-services', '2020-10-09', '2020-10-09'),
(11, 0, 'Mooses Tooth', '3300 Old Seward Hwy, Anchorage, AK 99503', 'Sun 11:00 am - 11:00 pm\r\nMon 11:00 am - 10:00 pm\r\nTue 11:00 am - 10:00 pm\r\nWed 10:00 am - 10:00 pm\r\nThu 10:00 am - 10:00 pm\r\nFri 11:00 am - 11:00 pm\r\nSat 11:00 am - 11:00 pm', 'Food/Restaurant', 'https://moosestooth.net/', '2020-10-09', '2020-10-09'),
(12, 0, 'Petco', '8621 Old Seward Hwy, Anchorage, AK 99515', 'Sun 10:00 am - 6:00 pm\r\nMon 10:00 am - 6:00 pm\r\nTue 10:00 am - 6:00 pm\r\nWed 10:00 am - 6:00 pm\r\nThu 10:00 am - 6:00 pm\r\nFri 10:00 am - 6:00 pm\r\nSat 9:00 am - 6:00 pm', 'Pets', 'https://www.petco.com/shop/en/petcostore/c/our-stores-remain-open\r\n', '2020-10-09', '2020-10-09'),
(13, 0, 'USPS', '4141 Postmark Dr, Anchorage, AK 99530', 'Sun 9:00 am - 11:00 pm\r\nMon 8:00 am - 11:00 pm\r\nTue 8:00 am - 11:00 pm\r\nWed 8:00 am - 11:00 pm\r\nThu 8:00 am - 11:00 pm\r\nFri 8:00 am - 11:00 pm\r\nSat 9:00 am - 11:00 pm', 'Government Services', 'https://faq.usps.com/s/article/USPS-Coronavirus-Updates-for-Residential-Customers', '2020-10-09', '2020-10-09'),
(14, 0, 'Walgreens', '4353 Lake Otis Pkwy, Anchorage, AK 99508', 'Sun 8:00 am - 10:00 pm\r\nMon 7:00 am - 10:00 pm\r\nTue 7:00 am - 10:00 pm\r\nWed 7:00 am - 10:00 pm\r\nThu 7:00 am - 10:00 pm\r\nFri 7:00 am - 10:00 pm\r\nSat 8:00 am - 10:00 pm', 'Grocery/Pharmacy', 'https://news.walgreens.com/covid-19/covid-19-faq.htm', '2020-10-09', '2020-10-09'),
(15, 0, 'Walmart', '8900 Old Seward Hwy, Anchorage, AK 99515', 'Sun 7:00 am - 10:00 pm\r\nMon 7:00 am - 10:00 pm\r\nTue 7:00 am - 10:00 pm\r\nWed 7:00 am - 10:00 pm\r\nThu 7:00 am - 10:00 pm\r\nFri 7:00 am - 10:00 pm\r\nSat 7:00 am - 10:00 pm', 'Retail', 'https://corporate.walmart.com/important-store-info', '2020-10-09', '2020-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `protocols`
--

CREATE TABLE `protocols` (
  `business_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `mask_required` varchar(50) NOT NULL,
  `customer_limit` varchar(50) DEFAULT NULL,
  `curbside_pickup` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `protocols`
--

INSERT INTO `protocols` (`business_id`, `status`, `mask_required`, `customer_limit`, `curbside_pickup`) VALUES
(1, 'OPEN', 'REQUIRED - local mandate', '50% capacity - local mandate', 'TRUE'),
(2, 'OPEN', 'REQUIRED - local mandate', NULL, ''),
(3, 'OPEN', 'REQUIRED - local mandate', '50% capacity - local mandate', 'TRUE'),
(4, 'OPEN', 'REQUIRED', NULL, 'TRUE'),
(5, 'OPEN', 'REQUIRED - local mandate', NULL, 'TRUE'),
(6, 'OPEN', 'REQUIRED - local mandate', NULL, 'TRUE'),
(7, 'OPEN', 'REQUIRED - local mandate', '50% capacity - local mandate', 'TRUE'),
(8, 'OPEN', 'TRUE', NULL, NULL),
(9, 'OPEN', 'REQUIRED', NULL, NULL),
(10, 'OPEN', 'REQUIRED', NULL, 'TRUE'),
(11, 'OPEN', 'REQUIRED - local mandate', '50% capacity - local mandate', 'TRUE'),
(12, 'OPEN', 'Required - local mandate', NULL, 'TRUE'),
(13, 'OPEN', 'REQUIRED', NULL, NULL),
(14, 'OPEN', 'REQUIRED', NULL, 'TRUE'),
(15, 'OPEN', 'REQUIRED', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `first_name`, `last_name`) VALUES
(1, 'dexter.j1.bulaong@gmail.com', '$2y$10$nch5O8tSEQxd9oSPabK5POcHi7U5Zi7eT0JDK5QYRqM', 'dexter', 'bulaong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`business_id`,`business_num`);

--
-- Indexes for table `protocols`
--
ALTER TABLE `protocols`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `protocols`
--
ALTER TABLE `protocols`
  ADD CONSTRAINT `protocols_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`business_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
