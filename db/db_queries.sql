
CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `category` (`id`, `title`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test1', 0, 1, 1, '2017-12-02 12:15:13', '2017-12-02 14:09:45'),
(2, 'test', 1, 1, 1, '2017-12-02 13:59:59', '2017-12-02 13:59:59'),
(3, 'test4', 1, 1, 1, '2017-12-02 14:00:08', '2017-12-02 14:00:08');

-- --------------------------------------------------------



CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `main_category` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



INSERT INTO `product` (`id`, `title`, `is_active`, `main_category`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test22', 1, 1, 1, 1, '2017-12-02 13:29:11', '2017-12-02 16:59:15'),
(2, 'test2', 1, 2, 1, 1, '2017-12-02 14:00:16', '2017-12-02 14:00:16');

-- --------------------------------------------------------



CREATE TABLE IF NOT EXISTS `product_category_mapping` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



INSERT INTO `product_category_mapping` (`id`, `product_id`, `cat_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '2017-12-02 13:37:48', '2017-12-02 13:37:48'),
(3, 1, 2, 1, 1, 1, '2017-12-02 14:00:26', '2017-12-02 14:00:26'),
(4, 1, 3, 1, 1, 1, '2017-12-02 14:00:40', '2017-12-02 14:00:40'),
(5, 2, 2, 1, 1, 1, '2017-12-02 14:00:47', '2017-12-02 14:00:47');

-- --------------------------------------------------------



CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'KWpCzw3cin6i2x3_J4Nj-tNptPQ7pLEX', '$2y$13$wTJcJ/BOrDeTxhCSlixKeuy5zRVZ7QSyjGr47QJwoi4VrofJ0sQ8G', NULL, 'admin@sact.in', 10, 1512193897, 1512193897);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `main_category` (`main_category`);

--
-- Indexes for table `product_category_mapping`
--
ALTER TABLE `product_category_mapping`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `product_id_2` (`product_id`,`cat_id`), ADD KEY `product_id` (`product_id`), ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_category_mapping`
--
ALTER TABLE `product_category_mapping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`main_category`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_category_mapping`
--
ALTER TABLE `product_category_mapping`
ADD CONSTRAINT `product_category_mapping_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
ADD CONSTRAINT `product_category_mapping_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
