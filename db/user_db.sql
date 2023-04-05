-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 11:32 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_form`
--

CREATE TABLE `news_form` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_date` datetime NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_form`
--

INSERT INTO `news_form` (`id`, `user_id`, `title`, `status`, `body`, `created_date`, `image_url`) VALUES
(31, 16, 'news1', '1', '<p>body</p>', '2023-04-05 10:58:58', 'https://content.ikon.mn/news/2023/4/4/le24hd_Site_Statebank-ToH_buteegdehuun_x974.jpg'),
(32, 16, 'news2', '1', '<p>body</p>', '2023-04-05 10:59:11', 'https://www.khanbank.com/uploaded/images/2023/Apr/1.jpg'),
(33, 16, 'news3', '1', '<p>body</p>', '2023-04-05 10:59:23', 'https://content.ikon.mn/news/2019/1/2/6cf02b_MPA_PHOTO_2017_-3994_x974.jpg'),
(34, 16, 'news4', '1', '<p>body</p>', '2023-04-05 10:59:32', 'https://content.ikon.mn/news/2019/1/2/6cf02b_MPA_PHOTO_2017_-3994_x974.jpg'),
(35, 16, 'News5', '1', '<p>bods</p>', '2023-04-05 11:17:33', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_form`
--
ALTER TABLE `news_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news_form`
--
ALTER TABLE `news_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news_form`
--
ALTER TABLE `news_form`
  ADD CONSTRAINT `fk_news_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
