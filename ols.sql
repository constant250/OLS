/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.6-MariaDB : Database - ols
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ols` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `families` */

DROP TABLE IF EXISTS `families`;

CREATE TABLE `families` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `material_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discipline_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_discipline_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_type_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `families` */

insert  into `families`(`id`,`material_code`,`name`,`description`,`specification`,`project_ids`,`discipline_ids`,`sub_discipline_ids`,`category_ids`,`family_type_ids`,`user_id`,`created_at`,`updated_at`,`deleted_at`) values 
(4,NULL,'Test something weirhfg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2020-02-20 11:32:25','2020-02-22 03:19:53','2020-02-22 03:19:53'),
(5,NULL,'Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2020-02-20 13:27:33','2020-02-22 03:19:44','2020-02-22 03:19:44'),
(6,NULL,'Test Hospital',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2020-02-20 13:27:44','2020-02-20 13:27:44',NULL),
(7,NULL,'Test Hospital men',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2020-02-20 13:28:05','2020-02-22 03:33:18','2020-02-22 03:33:18'),
(8,NULL,'Test number 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2020-02-22 02:11:59','2020-02-22 02:11:59',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
