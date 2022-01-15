-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table majo.master_category
CREATE TABLE IF NOT EXISTS `master_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table majo.master_category: ~0 rows (approximately)
DELETE FROM `master_category`;
/*!40000 ALTER TABLE `master_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_category` ENABLE KEYS */;

-- Dumping structure for table majo.master_role
CREATE TABLE IF NOT EXISTS `master_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table majo.master_role: ~2 rows (approximately)
DELETE FROM `master_role`;
/*!40000 ALTER TABLE `master_role` DISABLE KEYS */;
INSERT INTO `master_role` (`id`, `role_id`, `role_name`, `created_at`, `updated_at`) VALUES
	(1, 'R000', 'Admin', '2021-12-09 10:54:43', '2021-12-13 21:50:28'),
	(5, 'R001', 'User', '2022-01-15 13:30:23', '2022-01-15 13:30:27');
/*!40000 ALTER TABLE `master_role` ENABLE KEYS */;

-- Dumping structure for table majo.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_products_master_category` (`category_id`),
  CONSTRAINT `FK_products_master_category` FOREIGN KEY (`category_id`) REFERENCES `master_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table majo.products: ~0 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table majo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `api_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) DEFAULT NULL,
  `active_login` int(10) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table majo.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `api_token`, `username`, `password`, `role`, `status`, `active_login`, `last_login`, `name`, `email`, `photo`, `created_at`, `updated_at`) VALUES
	(1, '$2y$10$s9RxdakDfDf6FnlaoTNKL.zmK17cxNuJqI0kjqW1.DGzei191RBne', 'admin', '$2y$10$K3oMukFyI4b9NE.tlGi/j.hfUgUJb7OhgQsUF/MfBcX3henHfS.km', 'R000', 1, 1, '2022-01-15 13:27:04', 'Admin', 'akuntsaya01@gmail.com', 'avatarDefault.png', '2021-12-13 21:45:26', '2022-01-15 13:28:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
