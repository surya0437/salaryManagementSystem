-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 08:43 PM
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
-- Database: `salary`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(4) NOT NULL,
  `employeeId` int(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` varchar(30) NOT NULL,
  `day` int(2) NOT NULL,
  `days` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employeeId`, `year`, `month`, `day`, `days`, `status`, `date`) VALUES
(1484, 8553, 2023, 'April', 10, '', 0, '2024-04-20 00:00:00'),
(1773, 8553, 2024, 'April', 30, 'Tuesday', 1, '2024-04-30'),
(1817, 5605, 2024, 'May', 27, 'Monday', 1, '2024-05-27'),
(1974, 8553, 2024, 'April', 23, '', 0, '2024-04-23 00:00:00'),
(2150, 8553, 2024, 'April', 29, 'Monday', 0, '2024-04-29'),
(3246, 8553, 2024, 'April', 21, 'Sunday', 1, '2024-04-21'),
(3329, 8553, 2024, 'April', 26, 'Friday', 1, '2024-04-26'),
(3412, 2591, 2024, 'May', 27, 'Monday', 1, '2024-05-27'),
(3874, 8553, 2024, 'April', 25, 'Thursday', 1, '2024-04-25'),
(4701, 8553, 2024, 'April', 20, '', 0, '2024-04-20 00:00:00'),
(5173, 2591, 2024, 'May', 26, 'Sunday', 0, '2024-05-26'),
(6035, 8553, 2023, 'April', 2, '', 0, '2024-04-22 00:00:00'),
(8168, 8553, 2024, 'April', 24, 'Wednesday', 0, '2024-04-24'),
(8462, 8553, 2024, 'April', 22, '', 0, '2024-04-22 00:00:00'),
(8528, 8553, 2024, 'April', 28, 'Sunday', 1, '2024-04-28'),
(9497, 8553, 2023, 'April', 11, '', 0, '2024-04-21 00:00:00'),
(9683, 8553, 2023, 'April', 13, '', 0, '2024-04-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(4) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `gender` varchar(225) NOT NULL,
  `address` longtext NOT NULL,
  `employeeType` int(4) NOT NULL,
  `salaryType` int(4) NOT NULL,
  `image` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `phone`, `gender`, `address`, `employeeType`, `salaryType`, `image`, `password`, `role`, `date`) VALUES
(1524, 'Elijah Martinez', 'elijah.martinez@example.com', '2345678901', 'Male', '789 Oak St', 5177, 1408, 'elijah_martinez.jpg', '', '', '2024-04-19 18:15:00'),
(1616, 'Ava Wilson', 'ava.wilson@example.com', '1234567890', 'Female', '456 Elm St', 1935, 5480, 'ava_wilson.jpg', '', '', '2024-04-19 18:15:00'),
(2385, 'Mia Martinez', 'mia.martinez@example.com', '7890123456', 'Female', '753 Walnut St', 6023, 5139, 'mia_martinez.jpg', '', '', '2024-04-19 18:15:00'),
(2591, 'Surya Narayan Chaudhary', 'suryasnc12345@gmail.com', '9854532500', 'Male', 'Bouddha', 5177, 5278, '1642.jpg', '$2y$10$7fgSwPTVE4Kr0joq.fs5v.wXLpJO/FUlc97JXhX66vPhPQWNd0DkG', 'Admin', '2024-05-27 18:41:41'),
(2900, 'Isabella Garcia', 'isabella.garcia@example.com', '5678901234', 'Female', '321 Cedar St', 4979, 1408, 'isabella_garcia.jpg', '', '', '2024-04-19 18:15:00'),
(3075, 'adsasdasdas', 'suryaa0437.nc@gmail.com', '9855555557', 'female', 'asfdafa', 3331, 5278, '9502.jpg', '$2y$10$H93HS.FtflkxYfmNXARKYejkAjUaFtjcmGs.7nu7naw/BltUb61O.', 'Employee', '2024-04-30 06:25:26'),
(3291, 'Benjamin Thompson', 'benjamin.thompson@example.com', '4567890123', 'Male', '987 Pine St', 6023, 3166, 'benjamin_thompson.jpg', '', '', '2024-04-19 18:15:00'),
(3594, 'Emma Martinez', 'emma.martinez@example.com', '2109876543', 'Female', '159 Maple St', 7986, 5621, 'emma_martinez.jpg', '', 'Employee', '2024-04-21 05:28:56'),
(3813, 'Oliver Garcia', 'oliver.garcia@example.com', '6789012345', 'Male', '159 Maple St', 8557, 5278, 'oliver_garcia.jpg', '', '', '2024-04-19 18:15:00'),
(4864, 'sbdjaksb', 'addd.nc@gmail.com', '9805687593', 'female', 'nckjas', 1935, 1408, '7161.jpeg', '@123Surya', 'Admin', '2024-04-21 06:03:02'),
(5088, 'sdasdAD', 'dsdd.nc@gmail.com', '9812345678', 'female', 'asdasda', 4979, 7999, '6884.jpeg', '@123Surya', 'Admin', '2024-04-21 05:58:42'),
(5416, 'Ethan Wilson', 'ethan.wilson@example.com', '0123456789', 'Male', '123 Maple St', 7986, 9916, 'ethan_wilson.jpg', '', '', '2024-04-19 18:15:00'),
(5447, 'aewqeqw', 'rererere.nc@gmail.com', '9855555555', 'female', 'safasd', 3331, 5139, '6582.jpg', '$2y$10$BJ3H78pS7jU9RzGk3apMluhywF3YD8e8nFmBXBxb.UMV95SFvqGMG', 'Employee', '2024-04-28 15:47:36'),
(5605, 'sss', 'sss@gmail.com', '9844532522', 'Male', 'xzmcnk', 1935, 3166, '8255.jpg', '$2y$10$r9lMmdkevdPxaSDMC5F4uutNWs6bUhHADYgTsk0cCw9EFeP0e.oxC', 'Employee', '2024-05-27 16:08:42'),
(5653, 'Isabella Brown', 'isabella.brown@example.com', '7890123456', 'Female', '753 Walnut St', 3331, 5621, 'isabella_brown.jpg', '', '', '2024-04-19 18:15:00'),
(6279, 'asrweqwer', 'fffffffffff.nc@gmail.com', '9844532500', 'Male', '234234', 5177, 5480, '7143.jpg', '@123Surya', 'Employee', '2024-04-28 14:55:23'),
(6714, 'Bob Brown', 'bob.brown@example.com', '0123456789', 'Male', '321 Pine St', 5177, 5139, 'bob_brown.jpg', '', '', '2024-04-19 18:15:00'),
(6828, 'Lucas Taylor', 'lucas.taylor@example.com', '8901234567', 'Male', '852 Spruce St', 4979, 7999, 'lucas_taylor.jpg', '', '', '2024-04-19 18:15:00'),
(7180, 'Ava Rodriguez', 'ava.rodriguez@example.com', '9012345678', 'Female', '456 Oakwood Ave', 5177, 9254, 'ava_rodriguez.jpg', '', '', '2024-04-19 18:15:00'),
(7294, 'Daniel Lee', 'daniel.lee@example.com', '4567890123', 'Male', '987 Pine St', 9937, 5621, 'daniel_lee.jpg', '', '', '2024-04-19 18:15:00'),
(7331, 'David Wilson', 'david.wilson@example.com', '2345678901', 'Male', '789 Oak St', 7986, 3166, 'david_wilson.jpg', '', '', '2024-04-19 18:15:00'),
(7689, 'asndfajsn', 'ddd.nc@gmail.com', '9877777777', 'Male', 'asdas', 8557, 5621, '1099.jpeg', '', '', '2024-04-21 05:55:23'),
(7857, 'Sophia Thompson', 'sophia.thompson@example.com', '3456789012', 'Female', '654 Elm St', 8557, 5278, 'sophia_thompson.jpg', '', '', '2024-04-19 18:15:00'),
(8427, 'Michael Wilson', 'michael.wilson@example.com', '5432109876', 'Male', '987 Cedar St', 6817, 5480, 'michael_wilson.jpg', '', '', '2024-04-19 18:15:00'),
(8502, 'John Doe', 'john.doe@example.com', '1234567890', 'Male', '123 Main St', 1935, 1408, 'john_doe.jpg', '', '', '2024-04-19 18:15:00'),
(9074, 'Alexander Brown', 'alexander.brown@example.com', '8901234567', 'Male', '852 Spruce St', 3331, 9916, 'alexander_brown.jpg', '', '', '2024-04-19 18:15:00'),
(9238, 'Jane Smith', 'jane.smith@example.com', '0987654321', 'Female', '456 Elm St', 3331, 2495, 'jane_smith.jpg', '', '', '2024-04-19 18:15:00'),
(9266, 'James Rodriguez', 'james.rodriguez@example.com', '8901234567', 'Male', '456 Oakwood Ave', 9937, 9916, 'james_rodriguez.jpg', '', '', '2024-04-19 18:15:00'),
(9514, 'Emily Davis', 'emily.davis@example.com', '6789012345', 'Female', '654 Birch St', 6023, 5278, 'emily_davis.jpg', '', '', '2024-04-19 18:15:00'),
(9617, 'Joseph Hernandez', 'joseph.hernandez@example.com', '6789012345', 'Male', '159 Maple St', 5177, 2495, 'joseph_hernandez.jpg', '', '', '2024-04-19 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `employeetype`
--

CREATE TABLE `employeetype` (
  `id` int(4) NOT NULL,
  `employeeType` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeetype`
--

INSERT INTO `employeetype` (`id`, `employeeType`, `date`) VALUES
(1935, 'Human Resources Coordinator', '2024-04-19 18:15:00'),
(3331, 'Software Developer', '2024-04-19 18:15:00'),
(4979, 'Supervisor', '2024-04-19 18:15:00'),
(5177, 'Sales Associate', '2024-04-19 18:15:00'),
(6023, 'Team Leader', '2024-04-19 18:15:00'),
(6817, 'Customer Service Representative', '2024-04-19 18:15:00'),
(7986, 'Data Analyst', '2024-04-19 18:15:00'),
(8557, 'Accountant', '2024-04-19 18:15:00'),
(8958, 'Assistant Manager', '2024-04-19 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(4) NOT NULL,
  `SalaryTypeId` varchar(255) NOT NULL,
  `amount` int(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `SalaryTypeId`, `amount`, `date`) VALUES
(2495, 'Accountant', 110000, '2024-04-19 18:15:00'),
(3166, 'Sales Associate', 90000, '2024-04-19 18:15:00'),
(5139, 'Human Resources Coordinator', 1400000, '2024-04-28 15:00:37'),
(5278, 'Team Leader', 80000, '2024-04-19 18:15:00'),
(5480, 'Software Developer', 120000, '2024-04-19 18:15:00'),
(5621, 'Manager', 50000, '2024-04-19 18:15:00'),
(7999, 'Customer Service Representative', 100000, '2024-04-19 18:15:00'),
(9254, 'Assistant Manager', 60000, '2024-04-19 18:15:00'),
(9916, 'Data Analyst', 130000, '2024-04-19 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `salarypaid`
--

CREATE TABLE `salarypaid` (
  `id` int(4) NOT NULL,
  `employeeId` int(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` varchar(30) NOT NULL,
  `salary` int(50) NOT NULL,
  `bonus` decimal(50,2) NOT NULL,
  `vatPercentage` float NOT NULL,
  `vatAmount` decimal(50,2) NOT NULL,
  `totalPaidAmount` decimal(50,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salarypaid`
--

INSERT INTO `salarypaid` (`id`, `employeeId`, `year`, `month`, `salary`, `bonus`, `vatPercentage`, `vatAmount`, `totalPaidAmount`, `date`) VALUES
(4282, 8553, 2024, 'April', 1400000, 34532.00, 13, 186489.16, 1248042.84, '2024-04-28 15:05:33'),
(4325, 2591, 2024, 'May', 80000, 2000.00, 13, 10660.00, 71340.00, '2024-05-27 16:06:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeetype`
--
ALTER TABLE `employeetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
