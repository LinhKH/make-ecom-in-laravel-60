-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for make-ecom-in-laravel-60
CREATE DATABASE IF NOT EXISTS `make-ecom-in-laravel-60` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `make-ecom-in-laravel-60`;

-- Dumping structure for table make-ecom-in-laravel-60.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.admins: ~3 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'admin', '0968146461', 'admin@admin.com', NULL, '$2y$10$fMeWt2FgxdBtP5Rr8DUZoOv8haTY9rc5VypDfagkyce14BoBcC2vy', 'avatar2.png-89097.png', '1', NULL, NULL, '2020-09-01 05:22:49'),
	(2, 'user_1', 'subadmin', '0968146460', 'user_1@user_1.com', NULL, '$2y$10$ydXTQ2l86ZHZkAs.zKh0AOpJwFczo4PAaj/bM/2laVQYIlh7XwNiS', 'photo3.jpg', '1', NULL, NULL, NULL),
	(3, 'user_2', 'subadmin', '0968146460', 'user_2@user_2.com', NULL, '$2y$10$ydXTQ2l86ZHZkAs.zKh0AOpJwFczo4PAaj/bM/2laVQYIlh7XwNiS', 'user3-128x128.jpg', '1', NULL, NULL, NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.banners: ~3 rows (approximately)
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` (`id`, `image`, `link`, `title`, `alt`, `status`, `created_at`, `updated_at`) VALUES
	(3, '3.png', '', '', '', 1, NULL, '2020-08-29 15:41:48'),
	(5, '1.png-48101.png', 'banner-title', 'Banner Title', 'Banner Title', 1, '2020-08-29 15:00:01', '2020-08-29 15:40:29'),
	(6, '1.png-97618.png', 'Banner Title', 'Banner Title', 'Banner Title', 1, '2020-08-30 10:43:02', '2020-08-30 10:43:02');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.brands: ~4 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Arrow', 1, NULL, '2020-08-29 08:59:27'),
	(2, 'Gap', 1, NULL, '2020-08-27 15:30:29'),
	(3, 'Lee', 1, NULL, '2020-08-27 15:30:30'),
	(4, 'Monte Carlo', 1, NULL, '2020-09-01 05:33:23');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_discount` double(8,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.categories: ~7 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 'Tshirts', '', 0.00, '', 't-shirts', 'tshirts', 'tshirts', 'tshirts', 1, NULL, '2020-08-29 08:59:34'),
	(2, 0, 1, 'Shirts', '', 0.00, '', 'shirts', 'shirts', 'shirts', 'shirts', 1, NULL, NULL),
	(3, 0, 1, 'Denims', '', NULL, NULL, 'men-denims', 'denims', 'denims', 'denims', 1, NULL, '2020-09-01 04:51:57'),
	(4, 1, 1, 'Casual Tshirts', '', 0.00, '', 'casual-tshirts', 'casual tshirts', 'casual tshirts', 'casual tshirts', 1, NULL, '2020-08-29 08:56:55'),
	(5, 0, 2, 'Denims', '', 0.00, '', 'denims-women', 'denims women', 'denims women', 'denims women', 1, NULL, '2020-08-29 08:53:04'),
	(6, 1, 1, 'Denims Tshirts', 'Capture001.png-7845.png', 2.00, 'denims-tshirts', 'denims-tshirts', 'denims-tshirts', 'denims-tshirts', 'denims-tshirts', 1, '2020-08-29 08:47:29', '2020-08-29 08:56:56'),
	(7, 0, 3, 'T-shirts', 'Capture001 - Copy.png-86785.png', 2.00, 'kids-tshirts', 'kids-tshirts', 'kids-tshirts', 'kids-tshirts', 'kids-tshirts', 1, '2020-08-29 08:51:23', '2020-08-29 08:56:57');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.migrations: ~11 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_08_16_105700_create_admins_table', 1),
	(5, '2020_08_17_140031_create_sections_table', 1),
	(6, '2020_08_17_151619_create_categories_table', 1),
	(7, '2020_08_23_024142_create_products_table', 1),
	(8, '2020_08_27_020200_create_product_images_table', 1),
	(9, '2020_08_25_023741_create_products_attributes_table', 2),
	(10, '2020_08_27_144229_create_brands_table', 3),
	(11, '2020_08_29_135330_create_banners_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` double(8,2) DEFAULT NULL,
  `product_discount` double(8,2) DEFAULT NULL,
  `product_weight` double(8,2) DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wash_care` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pattern` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occasion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.products: ~14 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `category_id`, `section_id`, `brand_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_video`, `main_image`, `description`, `wash_care`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 3, 'Green T-Shirts', 'GT001', 'Green', 1500.00, 1500.00, 200.00, '', '2.jpg-25097.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-09-01 05:32:30'),
	(3, 6, 1, 2, 'Red T-Shirts', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '3.jpg-58015.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-09-01 05:32:32'),
	(4, 5, 2, 2, 'Red T-Shirts', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '4.jpg-86595.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:48:34'),
	(5, 4, 1, 2, 'Red T-Shirts 1', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '5.jpg-75408.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:48:51'),
	(6, 6, 1, 2, 'Red T-Shirts 2', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '6.jpg-90147.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:49:08'),
	(7, 6, 1, 2, 'Red T-Shirts 3', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '7.jpg-82655.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:49:23'),
	(8, 6, 1, 2, 'Red T-Shirts 4', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '8.jpg-766.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:49:40'),
	(9, 6, 1, 2, 'Red T-Shirts 5', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '9.jpg-87248.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:49:57'),
	(10, 6, 1, 2, 'T-Shirts 1', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '10.jpg-51626.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:50:13'),
	(11, 4, 1, 2, 'T-Shirts 2', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '11.jpg-17507.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:50:34'),
	(12, 4, 1, 2, 'T-Shirts 3', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '12.jpg-55610.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:50:53'),
	(13, 4, 1, 2, 'T-Shirts 4', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '13.jpg-89672.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:51:16'),
	(14, 4, 1, 2, 'T-Shirts 5', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '18.jpg-29021.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 09:51:42'),
	(15, 4, 1, 2, 'T-Shirts 6', 'RT001', 'Red', 1500.00, 1500.00, 200.00, '', '3.jpg-83107.jpg', 'Test Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-08-29 10:01:20');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.products_attributes
CREATE TABLE IF NOT EXISTS `products_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.products_attributes: ~3 rows (approximately)
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Small', 1200.00, 10, 'BT001-S', 1, NULL, NULL),
	(2, 1, 'Medium', 1300.00, 20, 'BT001-M', 1, NULL, NULL),
	(3, 1, 'Large', 1400.00, 30, 'BT001-L', 1, NULL, NULL);
/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.product_images: ~3 rows (approximately)
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, '', 1, NULL, '2020-08-29 15:13:49'),
	(2, 1, '', 1, NULL, '2020-08-29 15:13:49'),
	(4, 1, '', 1, '2020-08-27 14:26:08', '2020-08-29 15:13:49');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.sections: ~3 rows (approximately)
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Men', 1, NULL, '2020-08-31 04:48:07'),
	(2, 'Women', 1, NULL, '2020-08-29 14:32:34'),
	(3, 'Kids', 1, NULL, '2020-08-29 08:11:50');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;

-- Dumping structure for table make-ecom-in-laravel-60.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table make-ecom-in-laravel-60.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
