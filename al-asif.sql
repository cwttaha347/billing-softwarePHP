-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 06:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al-asif`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `category_desc` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_desc`, `status`) VALUES
(1, 'lawn 2pc', 'lawn suits 2 pc', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `contact_responses`
--

CREATE TABLE `contact_responses` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_contacted` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_responses`
--

INSERT INTO `contact_responses` (`id`, `fullname`, `email`, `telephone`, `message`, `date_contacted`) VALUES
(3, 'Muhammad taha', 'noreply@ecommerce.com', '03152773880', 'vdcdcdcdcdd', '2024-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `total_amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `total_amount`) VALUES
(1, 140400);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `qty` varchar(255) NOT NULL,
  `pro_serial` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `product_name`, `qty`, `pro_serial`, `price`, `date`) VALUES
(108, 'INV999165', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 18:02:59'),
(109, 'INV486168', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 18:03:58'),
(110, 'INV450069', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 18:05:58'),
(111, 'INV206174', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 18:08:06'),
(112, 'INV604532', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 18:10:55'),
(113, 'INV676059', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 18:12:25'),
(149, 'INV051872', 'ladien 2pc lawn safayah', '1', '4435434', '12000', '2024-08-30 20:56:57'),
(150, 'INV683447', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200', '2024-08-30 20:57:25'),
(151, 'INV902051', 'ladien 2pc lawn safayah', '1', '4435434', '12000', '2024-08-30 21:02:37'),
(152, 'INV021558', 'ladien 2pc lawn safayah', '1', '4435434', '12000', '2024-08-30 21:03:28'),
(153, 'INV091015', 'ladien 2pc lawn safayah', '1', '4435434', '12000', '2024-08-30 21:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_config`
--

CREATE TABLE `notifications_config` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reciever_email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications_config`
--

INSERT INTO `notifications_config` (`id`, `email`, `password`, `reciever_email`, `status`) VALUES
(1, 'codewithtaha.mentor@gmail.com', 'wgpigaxkaktcxvgl', 'codewithtaha.mentor@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `serial_no`, `product_name`, `image_1`, `qty`, `price`, `date_added`) VALUES
(2, 1, '4435434', 'ladien 2pc lawn safayah', 'images/products/image.jpg', '68', '12000', '2024-08-27'),
(6, 1, '721445', 'Laptop', 'images/products/Thermal-printer-invoice-template.png', '-35', '1200', '2024-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `date_saled` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_id`, `date_saled`) VALUES
(87, 'INV999165', '2024-08-30'),
(88, 'INV486168', '2024-08-30'),
(89, 'INV450069', '2024-08-30'),
(90, 'INV206174', '2024-08-30'),
(91, 'INV604532', '2024-08-30'),
(92, 'INV676059', '2024-08-30'),
(128, 'INV051872', '2024-08-30'),
(129, 'INV683447', '2024-08-30'),
(130, 'INV902051', '2024-08-30'),
(131, 'INV021558', '2024-08-30'),
(132, 'INV091015', '2024-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `slide_1` varchar(255) NOT NULL,
  `slide_2` varchar(255) NOT NULL,
  `slide_3` varchar(255) NOT NULL,
  `slide_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `slide_1`, `slide_2`, `slide_3`, `slide_4`) VALUES
(1, 'images/slider/279115233_856542721968724_3689345342691993694_n.webp', 'images/slider/312379163_829794031394537_3667875526302012956_n.webp', 'images/slider/291042717_3373209529632909_5542160190898772031_n.webp', 'images/slider/290613411_137730278928777_5824455407908636221_n.webp');

-- --------------------------------------------------------

--
-- Table structure for table `temp_mail`
--

CREATE TABLE `temp_mail` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `product_names` text NOT NULL,
  `qty` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_mail`
--

INSERT INTO `temp_mail` (`id`, `session_id`, `invoice_id`, `product_names`, `qty`, `serial_no`, `price`) VALUES
(47, '112', 'INV604532', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(48, '113', 'INV676059', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(49, '114', 'INV047013', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(50, '115', 'INV108847', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(51, '116', 'INV189201', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(52, '117', 'INV086008', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(53, '118', 'INV509631', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(54, '119', 'INV956166', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(55, '120', 'INV843309', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(56, '121', 'INV598723', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(57, '122', 'INV546308', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(58, '123', 'INV799334', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(59, '124', 'INV230195', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(60, '125', 'INV549772', 'ladien 2pc lawn safayah, Laptop', '1, 1', '4435434, 721445', '13200'),
(63, '128', 'INV791898', '', '', '721445', '1200'),
(64, '129', 'INV865048', '', '', '721445', '1200'),
(65, '130', 'INV865048', '', '', '721445', '1200'),
(66, '131', 'INV865048', '', '', '721445', '1200'),
(67, '132', 'INV703489', '', '', '721445', '1200'),
(68, '133', 'INV763224', '', '', '721445', '1200'),
(69, '134', 'INV276202', '', '', '721445', '1200'),
(70, '135', 'INV661655', '', '', '721445', '1200'),
(71, '136', 'INV661655', '', '', '721445', '1200'),
(72, '137', 'INV110022', '', '', '721445', '1200'),
(73, '138', 'INV066706', '', '', '721445', '1200'),
(74, '139', 'INV210345', '', '', '721445', '1200'),
(75, '140', 'INV377769', '', '', '721445', '1200'),
(76, '141', 'INV076752', '', '', '721445', '1200'),
(77, '142', 'INV076752', '', '', '721445', '1200'),
(78, '143', 'INV805304', '', '', '721445', '1200'),
(79, '144', 'INV785876', '', '', '721445', '1200'),
(80, '145', 'INV892087', '', '', '721445', '1200'),
(81, '146', 'INV899938', '', '1', '721445', '1200'),
(82, '147', 'INV042219', 'Laptop', '1', '721445', '1200'),
(84, '149', 'INV051872', 'ladien 2pc lawn safayah', '1', '4435434', '12000'),
(86, '151', 'INV902051', 'ladien 2pc lawn safayah', '1', '4435434', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`) VALUES
(1, 'Al-Asif', 'admin@asif.com', '$2y$10$6Z5Urm39rAoynbv8R2jnyuCIdtSP7AFW2Fu1U1wXih/26R1XwA5hi', 775),
(2, 'Seller name', 'admin@seller.com', '$2y$10$JdzxTR3aodKAu2VVWBWrF.mSl7OgTe3aaplesR5.Dz3e7r082v9KS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `andoid` varchar(255) DEFAULT NULL,
  `iphone` varchar(255) DEFAULT NULL,
  `windows` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `andoid`, `iphone`, `windows`) VALUES
(2, NULL, NULL, '::1'),
(3, '::1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `about_page_top_text` text NOT NULL,
  `about_page_nature_text` text NOT NULL,
  `about_page_company_v_text` text NOT NULL,
  `about_bg` varchar(255) NOT NULL,
  `home_vid` varchar(255) NOT NULL,
  `home_text_d` text NOT NULL,
  `about_page_nature_img` varchar(255) NOT NULL,
  `factory_bg_v` varchar(255) NOT NULL,
  `factory_vid_link` varchar(255) NOT NULL,
  `factory_text` text NOT NULL,
  `products_bg_v` varchar(255) NOT NULL,
  `projects_bg_v` varchar(255) NOT NULL,
  `projects_text` text NOT NULL,
  `contact_maps` varchar(2550) NOT NULL,
  `contact_text` text NOT NULL,
  `contact_address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone1` varchar(255) NOT NULL,
  `telephone2` varchar(255) NOT NULL,
  `website_name` text NOT NULL,
  `website_mode` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `social_fb` varchar(255) NOT NULL,
  `social_insta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `about_page_top_text`, `about_page_nature_text`, `about_page_company_v_text`, `about_bg`, `home_vid`, `home_text_d`, `about_page_nature_img`, `factory_bg_v`, `factory_vid_link`, `factory_text`, `products_bg_v`, `projects_bg_v`, `projects_text`, `contact_maps`, `contact_text`, `contact_address`, `email`, `telephone1`, `telephone2`, `website_name`, `website_mode`, `contact_email`, `contact_phone`, `social_fb`, `social_insta`) VALUES
(1, 'The success story of Palma Furniture started in the year 2000 in the city of Vitia, where from a small warehouse with an area of 700m², Palma successfully sold wholesale and retail imported furniture from Italy. As the demand for wholesale increased, it pushed us to branch out, and in 2004, we moved to a new location with an area of 2500m². After 6 years of intense work, Palma gained the trust of its consumers by always offering high quality products and unique furniture designs. In order to be as close as possible to the consumers, Palma expanded its activity, and in 2006, it opened its first showroom in Viti with an area of 1300m². During this period, our company’s expansion crossed the Kosovo borders and in 2010 we opened our first showroom in Switzerland, in the city of Spreitenbach, with an area of 3200m². The store-opening made Palma the only company from Kosovo that operates in Switzerland in the furniture industry.\r\n\r\nIn 2015, Palma furniture expended its activity by investing in a 40,000m2 factory in Gjilan, and started the production of Kitchens. Every year, parallel with technology development, the production capacity expands. With 10,000 kitchens produced yearly, Palma is a leader in the Balkan states. Today, Palma is spread over 60,000m² and has over 200 employees.\r\n\r\nIn a very short time, Palma furniture managed to become the biggest kitchen production company in Balkans. To follow the latest trends, we were part of many fairs in different European countries. The first fair that we attended was “Imm Cologne” in 2006, in Cologne, Germany, in an area of 150m². This was the starting point of our exports in Europe. Palma returned to the same fair in 2018 with a bigger area and expanded its exports network even further. Today, products of Palma furniture are exported in 17 countries around the world including Switzerland, Germany, Austria, United Arab Emirates, France, Belgium, Greece and Israel. Besides exports, we managed to cooperate in different projects with major hotel chains around the world such as Marriot Hotel, Bowfield, Cruachan, Hotel Stirling, Hotel Crown Plaza.\r\n\r\nOur latest project will set a new standard for showrooms in the capital city of Kosovo, Prishtina. With over 30,000m² we will offer the latest and most unique designs combined with the best possible quality. We continue to lead the furniture industry in Kosovo by always staying close to our clients, being on par with the latest trends and offering quality and variety of products.\r\n\r\nWe are always thankful for our clients.\r\n\r\nWe live with you!', 'We live with you.\r\nWe think of every tree that is cut down, and the power and privilege we have to extend its life and display its beauty in the furniture we make.', 'The first participation in the fairs was in 2016 at the “Imm Colgone” in Cologne, Germany in a space of 150 square meters. This was also the starting point of our exports to many European countries.\r\n\r\nParticipating in the same fair in 2018, in an even greater space made Palma further expand its export network and today Palma furniture products are exported to 17 countries around the world including Switzerland, Germany, Austria, Dubai, France, Belgium, Greece and Israel..', 'images/slider/Artboard-2.jpg', 'images/binni_video.mp4', 'We ensures that every corner of your environment reflects<br> superior quality and inspirational design. ', 'images/slider/bg_projektet.jpg', 'images/pages/Untitled-1SIERRA2-768x768.jpg', 'https://youtube.com/', 'In 2015, Urban Gallery expended its activity by investing in a 40,000m2 factory in Gjilan, and started the production of Kitchens. Every year, parallel with technology development, the production capacity expands. With 10,000 kitchens produced yearly, Palma is a leader in the Balkan states.\r\n\r\nA key characteristic of our factory is the automation process. The latest technology that Palma uses, starts with the selection of the raw material and continues to the final product, via a process that is led by a professional team using global standards machinery. Quality is our main principle, and that is why each of our products passes through quality control and testing, prior to being placed on stock. The process in the factory ends with the careful ranking of products for exports and showrooms.', 'images/products/Artboard-4.jpg', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2964.273881381728!2d20.977636075006163!3d42.01585665677964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2018fb0a3d79f00f%3A0x425c80f7469a6f99!2sUrban%20Gallery!5e0!3m2!1sen!2s!4v1724008604738!5m2!1sen!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'fsdfnsdjnfsdjfsdfnsdjfndfjdf', 'example 123 example street, <br>\r\nexample 1 , example 2,<br>\r\nhello 123 mic check.', 'noreply@ecommerce.com', '12949293847', '12949293847', 'Al Asif Boutique', '0', 'noreply@ecommerce.com', '2395239723423', 'https://facebook.com', 'https://instagram.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_responses`
--
ALTER TABLE `contact_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_config`
--
ALTER TABLE `notifications_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_mail`
--
ALTER TABLE `temp_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_responses`
--
ALTER TABLE `contact_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `notifications_config`
--
ALTER TABLE `notifications_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_mail`
--
ALTER TABLE `temp_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
