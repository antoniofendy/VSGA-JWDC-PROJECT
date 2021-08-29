-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 11:55 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipus-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Fendyanto', 'fendyanto', '927aad2cf4eac3c9ad7d510d526c7ee7', '2021-08-20 18:49:18', '2021-08-20 18:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` varchar(100) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(100) NOT NULL,
  `writer` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `status` set('available','unavailable','','') NOT NULL,
  `cover` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `category`, `writer`, `publisher`, `status`, `cover`, `year`, `created_at`, `updated_at`) VALUES
('9780134101613', 'Computer Organization and Architecture Designing for Performance 10th Edition', 'Computers - Organization and Data Processing', 'William Stallings', 'Pearson', 'unavailable', '9780134101613_cover.jpg', 2016, '2021-08-23 19:58:12', '2021-08-26 16:08:11'),
('9780395925034', 'Mein Kampf', 'History', 'Adolf Hitler, Ralph Manheim', 'Houghton Mifflin Company', 'available', '9780395925034_cover.jpg', 1939, '2021-08-23 20:14:16', '2021-08-26 15:52:35'),
('9781449361327', 'Data Science for Business: What You Need to Know About Data Mining and Data-Analytic Thinking', 'Computers - Data Science', 'Foster Provost, Tom Fawcett', 'O’Reilly Media', 'available', '9781449361327_cover.jpg', 2013, '2021-08-20 20:14:40', '2021-08-21 19:21:38'),
('9781491960202', 'Learning Web Design - A Beginner’s Guide to HTML, CSS, JavaScript, and Web Graphics', 'Computers - Programming', 'Jennifer Niederst Robbins', 'O’Reilly Media', 'unavailable', '9781491960202_cover.jpg', 2018, '2021-08-20 21:32:54', '2021-08-26 16:08:40'),
('9781492041160', 'Laravel: Up & Running: A Framework for Building Modern PHP Apps', 'Computers - Programming', 'Matt Stauffer', 'O’Reilly Media', 'available', '9781492041160_cover.jpg', 2019, '2021-08-21 06:49:09', '2021-08-21 06:49:09'),
('9781683923534', 'Python Basics: A Self-Teaching Introduction', 'Computers - Programming', 'H. Bhasin', 'Mercury', 'available', '9781683923534_cover.jpg', 2019, '2021-08-26 10:20:13', '2021-08-26 13:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sex` set('male','female','other','') NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` set('is_borrowing','not_borrowing') NOT NULL,
  `picture` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `sex`, `address`, `status`, `picture`, `created_at`, `updated_at`) VALUES
('AG00001', 'Jessica Gunawan', 'female', 'Jalan Apel Blok C2 NO. 31, Tangerang, Banten', 'not_borrowing', 'AG00001_picture.jpg', '2021-08-20 00:00:00', '2021-08-26 13:05:36'),
('AG00002', 'Patricia Cassol', 'female', 'Palembang', 'is_borrowing', 'AG00002_picture.jpg', '2021-08-21 15:02:13', '2021-08-26 16:08:40'),
('AG00003', 'James Timothy', 'male', 'Jakarta', 'not_borrowing', 'AG00003_picture.jpg', '2021-08-21 15:08:35', '2021-08-26 15:52:37'),
('AG00004', 'Aaron Holmes', 'male', 'Jakarta', 'is_borrowing', 'AG00004_picture.jpg', '2021-08-20 19:35:31', '2021-08-26 16:08:11'),
('AG00005', 'Christian Bernard', 'male', 'New York', 'not_borrowing', 'AG00005_picture.jpg', '2021-08-24 20:13:20', '2021-08-24 20:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` varchar(20) NOT NULL,
  `members_id` varchar(10) NOT NULL,
  `books_isbn` varchar(100) NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date NOT NULL,
  `extend_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `members_id`, `books_isbn`, `borrow_date`, `due_date`, `return_date`, `extend_count`, `created_at`, `updated_at`) VALUES
('TR00000001', 'AG00001', '9781491960202', '2021-08-26', '2021-09-09', '2021-08-26', 1, '2021-08-26 13:02:25', '2021-08-26 13:05:36'),
('TR00000002', 'AG00002', '9780395925034', '2021-08-26', '2021-09-09', '2021-08-26', 1, '2021-08-26 09:51:44', '2021-08-26 15:52:35'),
('TR00000003', 'AG00003', '9780134101613', '2021-08-12', '2021-08-19', '2021-08-26', 0, '2021-08-26 10:24:15', '2021-08-26 15:52:37'),
('TR00000004', 'AG00004', '9781491960202', '2021-08-26', '2021-09-02', '2021-09-01', 0, '2021-08-26 10:26:41', '2021-08-26 10:26:41'),
('TR00000005', 'AG00004', '9780134101613', '2021-08-12', '2021-08-19', '0000-00-00', 0, '2021-08-26 16:08:11', '2021-08-26 16:08:11'),
('TR00000006', 'AG00002', '9781491960202', '2021-08-26', '2021-09-09', '0000-00-00', 1, '2021-08-26 16:08:40', '2021-08-26 16:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `members_id` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `members_id`, `username`, `password`, `created_at`, `updated_at`) VALUES
('US00001', 'AG00002', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-08-21 15:02:13', '2021-08-21 19:46:46'),
('US00002', 'AG00001', 'admin', '1526915a21e2500396016eec2726646a', '2021-08-21 13:05:25', '2021-08-21 14:50:24'),
('US00003', 'AG00003', 'jamietim', '', '2021-08-21 15:08:35', '2021-08-23 18:00:21'),
('US00004', 'AG00004', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-08-21 13:06:52', '2021-08-22 21:29:51'),
('US00005', 'AG00005', 'AG00005', 'cfb3fe24979302288361619db11feac6', '2021-08-24 20:13:21', '2021-08-24 20:13:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `transactions_to_members` (`members_id`),
  ADD KEY `transactions_to_books` (`books_isbn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_to_members` (`members_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_to_books` FOREIGN KEY (`books_isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `transactions_to_members` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_to_members` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
