-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2017 at 01:08 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin _id` int(11) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `othername` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin _id`, `surname`, `firstname`, `othername`, `mobile`, `email`, `password`, `datetime`) VALUES
(1, 'Ani', 'Chukwuma', 'Mitchell', '08108440362', 'anichukwuma@gmail.com', 'ani01', '2017-06-28 15:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `tax id` int(11) NOT NULL,
  `taxcategory` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`tax id`, `taxcategory`, `amount`) VALUES
(1, 'event centers', '10000'),
(2, 'fines', '5000'),
(3, 'market levy', '3000'),
(4, 'security', '2000'),
(5, 'waste management', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `taxcategory` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `amount` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `email_address`, `transaction_id`, `taxcategory`, `description`, `amount`, `datetime`) VALUES
(1, 'okpala_chuks@yahoo.com', 'RMSYBJzIDWA', 'event centers', 'This is for the community town hall for a wedding purpose', '10000', '2017-06-26 13:01:47'),
(2, 'okpala_chuks@yahoo.com', 'RMShw7KZWO8', 'market levy', 'The monthly market levy', '3000', '2017-06-26 13:05:35'),
(27, 'okpala_chuks@yahoo.com', 'RMSme027UHq', 'market levy', 'market', '3000', '2017-08-02 11:12:11'),
(29, 'okpala_chuks@yahoo.com', 'RMS9h5L8kQD', 'fines', 'fines fines', '5000', '2017-08-05 15:54:08'),
(31, 'okpala_chuks@yahoo.com', 'RMS1sNaH6Lj', 'market levy', 'market oo', '3000', '2017-08-07 16:33:36'),
(32, 'okpala_chuks@yahoo.com', 'RMSMHTRv97G', 'market levy', 'market levy today', '3000', '2017-08-09 07:14:24'),
(33, 'okpala_chuks@yahoo.com', 'RMS8vx2BFnc', 'market levy', 'market levy for defence', '3000', '2017-08-09 10:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `othername` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `occupation` varchar(200) NOT NULL,
  `homeaddress` text NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `sec_question` text NOT NULL,
  `sec_answer` text NOT NULL,
  `paid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `surname`, `firstname`, `othername`, `mobile`, `occupation`, `homeaddress`, `dob`, `email`, `password`, `sec_question`, `sec_answer`, `paid`) VALUES
(2, 'Okpala', 'Chukwualasu', 'Andrew', '08164544461', 'Trader', 'No 31, Block 2b, Banana Island, Lekki Lagos State ', '1991-08-12', 'okpala_chuks@yahoo.com', 'chuks01', 'What is the name of your favorite uncle?', 'Tony', 7),
(13, 'Agadi', 'ifeanyi', 'Daniel', '08108440362', 'Trader', 'no 45 Margaret catwright avenue,UNN,Nsukka', '1998-12-12', 'ifeanyi_agadi@gmail.com', 'name', 'What is the name of your favourite uncle?', 'ikechukwu', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin _id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`tax id`),
  ADD KEY `taxcategory` (`taxcategory`,`amount`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `email_address` (`email_address`,`taxcategory`,`amount`),
  ADD KEY `fk_taxcategory` (`taxcategory`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin _id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `tax id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email_address`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_taxcategory` FOREIGN KEY (`taxcategory`) REFERENCES `category` (`taxcategory`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
