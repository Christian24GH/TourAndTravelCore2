/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - core
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`core` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `core`;

/*Table structure for table `application` */

DROP TABLE IF EXISTS `application`;

CREATE TABLE `application` (
  `applicationID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` bigint(20) unsigned NOT NULL,
  `submittion_date` datetime DEFAULT NULL,
  `status` enum('waiting','approved','rejected','cancelled') DEFAULT NULL,
  PRIMARY KEY (`applicationID`),
  KEY `applicantID` (`customerID`),
  CONSTRAINT `application_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `application` */

insert  into `application`(`applicationID`,`customerID`,`submittion_date`,`status`) values 
(5,1,'2025-05-22 15:35:09','approved'),
(6,1,'2025-05-22 16:02:49','approved');

/*Table structure for table `applicationdocuments` */

DROP TABLE IF EXISTS `applicationdocuments`;

CREATE TABLE `applicationdocuments` (
  `applicationID` int(11) NOT NULL,
  `passportID` int(11) NOT NULL,
  `documentID` int(11) DEFAULT NULL,
  KEY `passportID` (`passportID`),
  KEY `personalID` (`applicationID`),
  CONSTRAINT `applicationdocuments_ibfk_1` FOREIGN KEY (`applicationID`) REFERENCES `application` (`applicationID`),
  CONSTRAINT `applicationdocuments_ibfk_2` FOREIGN KEY (`passportID`) REFERENCES `passportdetails` (`passportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `applicationdocuments` */

insert  into `applicationdocuments`(`applicationID`,`passportID`,`documentID`) values 
(5,5,5),
(6,6,6);

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`) values 
(5,'Adventure'),
(6,'Budget'),
(7,'Educational');

/*Table structure for table `communication_logs` */

DROP TABLE IF EXISTS `communication_logs`;

CREATE TABLE `communication_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `communication_logs_customer_id_foreign` (`customer_id`),
  CONSTRAINT `communication_logs_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `communication_logs` */

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `contactId` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(255) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contactId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contact` */

/*Table structure for table `customer_communications` */

DROP TABLE IF EXISTS `customer_communications`;

CREATE TABLE `customer_communications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `type` enum('call','email','message','meeting') NOT NULL,
  `summary` text NOT NULL,
  `communicated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `handled_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_communications_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_communications_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_communications` */

/*Table structure for table `customer_issues` */

DROP TABLE IF EXISTS `customer_issues`;

CREATE TABLE `customer_issues` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  `handled_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_issues_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_issues_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_issues` */

/*Table structure for table `customer_notes` */

DROP TABLE IF EXISTS `customer_notes`;

CREATE TABLE `customer_notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `note` text NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_notes_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_notes` */

/*Table structure for table `customer_preferences` */

DROP TABLE IF EXISTS `customer_preferences`;

CREATE TABLE `customer_preferences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `preferred_destination` varchar(255) DEFAULT NULL,
  `budget_min` decimal(10,2) DEFAULT NULL,
  `budget_max` decimal(10,2) DEFAULT NULL,
  `travel_style` varchar(255) DEFAULT NULL,
  `accommodation_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_preferences_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_preferences_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_preferences` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`first_name`,`last_name`,`email`,`phone`,`address`,`date_of_birth`,`notes`,`created_at`,`updated_at`) values 
(1,'Client','asd','dev2@gmail.com','asdadasd','1212','2025-05-22','asdsad','2025-05-22 05:32:01','2025-05-22 05:32:01');

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `documentID` int(11) NOT NULL AUTO_INCREMENT,
  `documentName` varchar(255) NOT NULL,
  `documentServerPath` varchar(255) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`documentID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `documents` */

insert  into `documents`(`documentID`,`documentName`,`documentServerPath`,`uploadDate`) values 
(1,'1747897609_346108020_2198120380386568_5658895559870479969_n.jpg','C:/xampp/htdocs/dashboard/TourAndTravel/core2/public/server/documents/1747897609_346108020_2198120380386568_5658895559870479969_n.jpg','2025-05-22 15:06:49'),
(2,'1747897610_346108020_2198120380386568_5658895559870479969_n.jpg','C:/xampp/htdocs/dashboard/TourAndTravel/core2/public/server/documents/1747897610_346108020_2198120380386568_5658895559870479969_n.jpg','2025-05-22 15:06:50'),
(3,'1747897630_346108020_2198120380386568_5658895559870479969_n.jpg','C:/xampp/htdocs/dashboard/TourAndTravel/core2/public/server/documents/1747897630_346108020_2198120380386568_5658895559870479969_n.jpg','2025-05-22 15:07:10'),
(4,'1747897630_346108020_2198120380386568_5658895559870479969_n.jpg','C:/xampp/htdocs/dashboard/TourAndTravel/core2/public/server/documents/1747897630_346108020_2198120380386568_5658895559870479969_n.jpg','2025-05-22 15:07:10'),
(5,'1747899309_334209728_977302846585929_3744386073591401457_n.jpg','C:/xampp/htdocs/dashboard/TourAndTravel/core2/public/server/documents/1747899309_334209728_977302846585929_3744386073591401457_n.jpg','2025-05-22 15:35:09'),
(6,'1747900969_368397655_250145257335936_7219371353739684705_n.png','C:/xampp/htdocs/dashboard/TourAndTravel/core2/public/server/documents/1747900969_368397655_250145257335936_7219371353739684705_n.png','2025-05-22 16:02:49');

/*Table structure for table `exchange_rates` */

DROP TABLE IF EXISTS `exchange_rates`;

CREATE TABLE `exchange_rates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_currency` varchar(255) NOT NULL,
  `to_currency` varchar(255) NOT NULL,
  `rate` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exchange_rates` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `group_pricing_tiers` */

DROP TABLE IF EXISTS `group_pricing_tiers`;

CREATE TABLE `group_pricing_tiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `min_pax` int(11) DEFAULT NULL,
  `max_pax` int(11) DEFAULT NULL,
  `price_per_person` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `group_pricing_tiers` */

insert  into `group_pricing_tiers`(`id`,`tour_id`,`min_pax`,`max_pax`,`price_per_person`) values 
(2,0,2,4,350.00),
(3,8,2,6,3500.00),
(4,10,1,1,1000.00),
(5,7,6,7,3500.00),
(6,11,1,2,10000.00);

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `locations` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `notifications` */

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `tour_id` (`tour_id`),
  CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `packages` */

insert  into `packages`(`id`,`tour_id`,`name`,`description`,`price`,`created_at`) values 
(1,11,'europe','Auto-created package for europe',10000.00,'2025-05-21 01:07:41');

/*Table structure for table `passportdetails` */

DROP TABLE IF EXISTS `passportdetails`;

CREATE TABLE `passportdetails` (
  `passportID` int(11) NOT NULL AUTO_INCREMENT,
  `passportNumber` varchar(20) NOT NULL,
  `passportType` char(1) NOT NULL,
  `dateOfIssue` date NOT NULL,
  `dateOfExpiry` date NOT NULL,
  PRIMARY KEY (`passportID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `passportdetails` */

insert  into `passportdetails`(`passportID`,`passportNumber`,`passportType`,`dateOfIssue`,`dateOfExpiry`) values 
(1,'231','P','2025-05-22','2025-05-22'),
(2,'231','P','2025-05-22','2025-05-22'),
(3,'231','P','2025-05-22','2025-05-22'),
(4,'231','P','2025-05-22','2025-05-22'),
(5,'2132','P','2025-05-22','2025-05-22'),
(6,'21312','P','2025-05-22','2025-05-22');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `rates` */

DROP TABLE IF EXISTS `rates`;

CREATE TABLE `rates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rate_name` varchar(255) NOT NULL,
  `multiplier` decimal(5,2) NOT NULL DEFAULT 1.00,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rates` */

insert  into `rates`(`id`,`rate_name`,`multiplier`,`description`,`created_at`,`updated_at`) values 
(1,'Heaven',2.00,'Standard tour rate.','2025-05-22 08:30:20','2025-05-22 08:33:46'),
(2,'adad',2.00,'12','2025-05-24 04:43:46','2025-05-24 04:43:46');

/*Table structure for table `rejections` */

DROP TABLE IF EXISTS `rejections`;

CREATE TABLE `rejections` (
  `rejectionID` int(11) NOT NULL AUTO_INCREMENT,
  `applicationID` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rejectionID`),
  KEY `applicationID` (`applicationID`),
  CONSTRAINT `rejections_ibfk_1` FOREIGN KEY (`applicationID`) REFERENCES `application` (`applicationID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rejections` */

/*Table structure for table `schedules` */

DROP TABLE IF EXISTS `schedules`;

CREATE TABLE `schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tour_package_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `rate_id` bigint(20) unsigned NOT NULL,
  `final_price` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_tour_package_id_foreign` (`tour_package_id`),
  KEY `schedules_rate_id_foreign` (`rate_id`),
  CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `schedules_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `schedules` */

/*Table structure for table `seasonal_pricing` */

DROP TABLE IF EXISTS `seasonal_pricing`;

CREATE TABLE `seasonal_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `season_name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `seasonal_pricing` */

insert  into `seasonal_pricing`(`id`,`tour_id`,`season_name`,`start_date`,`end_date`,`price`) values 
(1,0,'Winter','2025-05-25','2025-05-30',4500.00),
(2,8,'summer','2025-03-25','2025-03-25',3500.00),
(3,10,'maulan','2025-07-07','2025-07-07',10000.00),
(4,7,'winter','2025-05-21','2025-05-28',5500.00),
(5,11,'hot','2025-06-07','2025-06-10',12000.00);

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('UPbWjRMhU8dccEbNhKtsyGFAGCJoFre6N2DlBzN2',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGY2eVFQR2R6VzR5OU1NaWRZdzA3MnNDbmJKbmhaU3pLWmZBM2VRUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3QvZGFzaGJvYXJkL1RvdXJBbmRUcmF2ZWwvY29yZTIvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748061904);

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket` varchar(50) NOT NULL,
  `customerID` bigint(20) unsigned NOT NULL,
  `date_issued` date DEFAULT NULL,
  `status` enum('Active','Deactivated') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tickets` */

/*Table structure for table `tour_category_assignments` */

DROP TABLE IF EXISTS `tour_category_assignments`;

CREATE TABLE `tour_category_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_id` (`tour_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `tour_category_assignments_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tour_category_assignments_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tour_category_assignments` */

insert  into `tour_category_assignments`(`id`,`tour_id`,`category_id`) values 
(2,3,5),
(3,11,6),
(4,7,7);

/*Table structure for table `tour_package_services` */

DROP TABLE IF EXISTS `tour_package_services`;

CREATE TABLE `tour_package_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `service_details` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`),
  CONSTRAINT `tour_package_services_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tour_package_services` */

insert  into `tour_package_services`(`id`,`package_id`,`service_type`,`service_details`) values 
(1,1,'Flight','Beach'),
(2,2,'Activity','Park'),
(3,3,'Hotel','4start');

/*Table structure for table `tour_packages` */

DROP TABLE IF EXISTS `tour_packages`;

CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `tour_id` (`tour_id`),
  CONSTRAINT `tour_packages_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tour_packages` */

insert  into `tour_packages`(`id`,`tour_id`,`package_name`,`created_at`) values 
(1,3,'Summer Adventure','2025-05-21 01:33:55'),
(2,7,'Balik aral','2025-05-21 01:35:00'),
(3,3,'adventyaaaa','2025-05-21 01:36:16');

/*Table structure for table `tour_pricing_config` */

DROP TABLE IF EXISTS `tour_pricing_config`;

CREATE TABLE `tour_pricing_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `max_guests` int(11) DEFAULT NULL,
  `min_guests` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tour_pricing_config` */

insert  into `tour_pricing_config`(`id`,`tour_id`,`base_price`,`currency`,`max_guests`,`min_guests`) values 
(1,0,2500.00,'PHP',5,4),
(2,8,3500.00,'PHP',4,2),
(3,10,32323.00,'PHP',131,131),
(4,3,0.00,'PHP',1,1),
(5,7,3500.00,'PHP',25,15),
(6,11,10000.00,'PHP',3,2);

/*Table structure for table `tour_schedules` */

DROP TABLE IF EXISTS `tour_schedules`;

CREATE TABLE `tour_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `rate_id` bigint(20) unsigned NOT NULL,
  `tour_date` date NOT NULL,
  `tour_time` time NOT NULL,
  `tour_guide` varchar(100) NOT NULL,
  `vehicle_assigned` varchar(100) NOT NULL,
  `max_participants` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_id` (`tour_id`),
  KEY `tour_rates_ibfk_2` (`rate_id`),
  CONSTRAINT `tour_rates_ibfk_2` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tour_schedules_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tour_schedules` */

insert  into `tour_schedules`(`id`,`tour_id`,`rate_id`,`tour_date`,`tour_time`,`tour_guide`,`vehicle_assigned`,`max_participants`,`status`) values 
(4,3,1,'2025-05-29','12:15:00','J.Coleee','L300ID22',2333,'available'),
(5,7,2,'2025-05-24','12:44:00','J.Cole','L300ID2',22,'available');

/*Table structure for table `tours` */

DROP TABLE IF EXISTS `tours`;

CREATE TABLE `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `inclusions` text DEFAULT NULL,
  `exclusions` text DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('draft','pending','active','inactive','archived','cancelled') NOT NULL DEFAULT 'draft',
  `visibility` enum('public','private','role','scheduled','unlisted') NOT NULL DEFAULT 'public',
  `visible_from` date DEFAULT NULL,
  `visible_until` date DEFAULT NULL,
  `booking_from` date DEFAULT NULL,
  `booking_to` date DEFAULT NULL,
  `blockout_dates` text DEFAULT NULL,
  `visible_roles` text DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tours` */

insert  into `tours`(`id`,`title`,`destination`,`description`,`inclusions`,`exclusions`,`itinerary`,`images`,`created_at`,`status`,`visibility`,`visible_from`,`visible_until`,`booking_from`,`booking_to`,`blockout_dates`,`visible_roles`,`updated_at`) values 
(3,'Palawan Escapade','Palawan, Philippines','Find out the many charming attractions, adventures, and cuisine that await you in The Palawan.','Accomodation with breakfast in all hotels.\r\nTransfers and sightseeing as indicated in the itinerary.\r\nAccomodation in hill stations is non a/c unless specified.\r\nChauffeured services between 0800 hrs and 2000hrs.\r\nAll sightseeing and transfers as per itinerary.\r\nUnstinted service support.','Cost of flights/ trains/ bus journey unless specified.\r\nCost of early arrival/ late departure.\r\nCost of amendment/addition in the itinerary.\r\nMeals other than breakfast unless specified.\r\nCost of entrance fees, camera & video charges.\r\nCost of additional activities other than what is included, Porterages, tips etc.\r\nTravel/Medical insurance.\r\nAnything not mentioned in the inclusions.','Day 1:\r\nDay 2:\r\nDay 3:','[\"uploads/tours/tour_682c1b7eb260b2.76704478.jpg\"]','2025-05-20 14:04:46','draft','public',NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-21 00:55:06'),
(7,'WOW BAGUIO','BAGUIO','HAHAHAH','HAHAHA','HAHAHA','HAHAHA','[\"uploads/tours/tour_682c81518d95f3.14849455.jpg\"]','2025-05-20 21:19:13','active','public',NULL,NULL,'0000-00-00','0000-00-00','2025-05-21',NULL,'2025-05-21 01:45:17'),
(8,'eqeq','eqe','qeq','qe','qeqe','qeqe','[\"uploads/tours/tour_682c94da37afb8.80037250.jpg\"]','2025-05-20 22:42:34','active','public',NULL,NULL,'2025-05-21','2025-05-21','2025-05-21',NULL,'2025-05-21 00:55:06'),
(9,'eqeqeqe','qeqeqeqe','qeqeqeq','qeqeqeqe','qeqeqeqe','qeqeqeqe','[\"uploads/tours/tour_682c98fa4c27e1.12958918.jpg\"]','2025-05-20 23:00:10','draft','public',NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-21 00:55:06'),
(10,'eqeqe','qeqeqe','qeqeqe','eqeq','qeqeq','qeqeqe','[\"uploads/tours/tour_682c9a3c79d3e3.27835425.jpg\"]','2025-05-20 23:05:32','draft','public',NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-21 00:55:06'),
(11,'europe','Europe','maganda ata','wla','wla','qeqe','[\"uploads/tours/tour_682cafe353c636.88111945.jpg\"]','2025-05-21 00:37:55','draft','public',NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-21 00:55:06');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/* Procedure structure for procedure `insertApplication` */

/*!50003 DROP PROCEDURE IF EXISTS  `insertApplication` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insertApplication`(
	IN p_customerID int,
	IN p_documentName VARCHAR(255),
	IN p_documentServerPath VARCHAR(255),
	IN p_passportNumber VARCHAR(20),
	IN p_passportType CHAR(1),
	IN p_dateOfIssue DATE,
	IN p_dateOfExpiry DATE	
)
BEGIN

	DECLARE new_applicationId INT;
	DECLARE new_documentId INT;
	DECLARE new_passportId INT;

	-- START TRANSACTION
	START TRANSACTION;
	
	-- Insert into application
	INSERT INTO application(customerID, submittion_date, `STATUS`) 
	VALUES (p_customerID, NOW(), "waiting");
	SET new_applicationId = LAST_INSERT_ID();
	
	-- Insert into documents
	INSERT INTO documents(documentName, documentServerPath) 
	VALUES (p_documentName, p_documentServerPath);
	SET new_documentId = LAST_INSERT_ID();
	
	-- Insert into passportdetails
	INSERT INTO passportdetails(passportNumber, passportType, dateOfIssue, dateOfExpiry) 
	VALUES (p_passportNumber, p_passportType, p_dateOfIssue, p_dateOfExpiry);
	SET new_passportId = LAST_INSERT_ID();
	
	-- Insert into applicationdocuments
	INSERT INTO applicationdocuments(applicationID, passportID, documentID)
	VALUES (new_applicationId, new_passportId, new_documentId);

	-- COMMIT TRANSACTION
	COMMIT;

END */$$
DELIMITER ;

/* Procedure structure for procedure `resetDB` */

/*!50003 DROP PROCEDURE IF EXISTS  `resetDB` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `resetDB`()
BEGIN
	SET FOREIGN_KEY_CHECKS = 0;
	
	TRUNCATE TABLE email;
	TRUNCATE TABLE application;
	TRUNCATE TABLE applicant;
	TRUNCATE TABLE applicationdocuments;	
	TRUNCATE table address;
	TRUNCATE TABLE contact;
	TRUNCATE TABLE documents;
	TRUNCATE TABLE passportdetails;
	TRUNCATE TABLE rejections;
	SET FOREIGN_KEY_CHECKS = 1;
	
END */$$
DELIMITER ;

/*Table structure for table `getcustomerdocuments` */

DROP TABLE IF EXISTS `getcustomerdocuments`;

/*!50001 DROP VIEW IF EXISTS `getcustomerdocuments` */;
/*!50001 DROP TABLE IF EXISTS `getcustomerdocuments` */;

/*!50001 CREATE TABLE  `getcustomerdocuments`(
 `applicationID` int(11) ,
 `documentID` int(11) ,
 `documentName` varchar(255) ,
 `documentServerPath` varchar(255) 
)*/;

/*Table structure for table `getpassportinfo` */

DROP TABLE IF EXISTS `getpassportinfo`;

/*!50001 DROP VIEW IF EXISTS `getpassportinfo` */;
/*!50001 DROP TABLE IF EXISTS `getpassportinfo` */;

/*!50001 CREATE TABLE  `getpassportinfo`(
 `applicationID` int(11) ,
 `passportID` int(11) ,
 `passportNumber` varchar(20) ,
 `status` enum('waiting','approved','rejected','cancelled') ,
 `firstName` varchar(255) ,
 `lastName` varchar(255) ,
 `dateOfBirth` date 
)*/;

/*Table structure for table `getpassportlist` */

DROP TABLE IF EXISTS `getpassportlist`;

/*!50001 DROP VIEW IF EXISTS `getpassportlist` */;
/*!50001 DROP TABLE IF EXISTS `getpassportlist` */;

/*!50001 CREATE TABLE  `getpassportlist`(
 `applicationID` int(11) ,
 `documentID` int(11) ,
 `passportID` int(11) ,
 `passportNumber` varchar(20) ,
 `status` enum('waiting','approved','rejected','cancelled') 
)*/;

/*View structure for view getcustomerdocuments */

/*!50001 DROP TABLE IF EXISTS `getcustomerdocuments` */;
/*!50001 DROP VIEW IF EXISTS `getcustomerdocuments` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getcustomerdocuments` AS select `ad`.`applicationID` AS `applicationID`,`d`.`documentID` AS `documentID`,`d`.`documentName` AS `documentName`,`d`.`documentServerPath` AS `documentServerPath` from (`documents` `d` join `applicationdocuments` `ad` on(`d`.`documentID` = `ad`.`documentID`)) */;

/*View structure for view getpassportinfo */

/*!50001 DROP TABLE IF EXISTS `getpassportinfo` */;
/*!50001 DROP VIEW IF EXISTS `getpassportinfo` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getpassportinfo` AS select `ad`.`applicationID` AS `applicationID`,`ps`.`passportID` AS `passportID`,`ps`.`passportNumber` AS `passportNumber`,`ap`.`status` AS `status`,`c`.`first_name` AS `firstName`,`c`.`last_name` AS `lastName`,`c`.`date_of_birth` AS `dateOfBirth` from (((`passportdetails` `ps` join `applicationdocuments` `ad` on(`ps`.`passportID` = `ad`.`passportID`)) join `application` `ap` on(`ap`.`applicationID` = `ad`.`applicationID`)) join `customers` `c` on(`c`.`id` = `ap`.`customerID`)) */;

/*View structure for view getpassportlist */

/*!50001 DROP TABLE IF EXISTS `getpassportlist` */;
/*!50001 DROP VIEW IF EXISTS `getpassportlist` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getpassportlist` AS select `ad`.`applicationID` AS `applicationID`,`ad`.`documentID` AS `documentID`,`ps`.`passportID` AS `passportID`,`ps`.`passportNumber` AS `passportNumber`,`ap`.`status` AS `status` from ((`passportdetails` `ps` join `applicationdocuments` `ad` on(`ps`.`passportID` = `ad`.`passportID`)) join `application` `ap` on(`ap`.`applicationID` = `ad`.`applicationID`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
