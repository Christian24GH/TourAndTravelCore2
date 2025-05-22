/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - core2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`core2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `core2`;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rates` */

insert  into `rates`(`id`,`rate_name`,`multiplier`,`description`,`created_at`,`updated_at`) values 
(1,'Heaven',2.00,'Standard tour rate.','2025-05-22 08:30:20','2025-05-22 08:33:46');

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
  `tour_package_id` bigint(20) unsigned NOT NULL,
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
  CONSTRAINT `schedules_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `schedules_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `schedules` */

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
('Nukkp7ITS6FCFXMGE9GZnYrXrJ5uBABx2y0FOB7J',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHg0T3J0UGNKYXB4OUVxMVh1QkRpbjlmWnIxV25TQWd5VnB2dm1BNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3QvZGFzaGJvYXJkL1RvdXJBbmRUcmF2ZWwvY29yZTIvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1747904504);

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket` varchar(50) NOT NULL,
  `customerID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tickets` */

insert  into `tickets`(`id`,`ticket`,`customerID`) values 
(1,'TourAndTravel202505221002551',1);

/*Table structure for table `tour_packages` */

DROP TABLE IF EXISTS `tour_packages`;

CREATE TABLE `tour_packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `days` int(11) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tour_packages` */

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
