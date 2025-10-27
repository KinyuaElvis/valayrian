/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.32-MariaDB : Database - valayrian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`valayrian` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `valayrian`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`) values (1,'Admin User','admin@pestguard.com','password','2025-09-09 10:19:52','2025-09-09 10:19:52');

/*Table structure for table `ai_models` */

DROP TABLE IF EXISTS `ai_models`;

CREATE TABLE `ai_models` (
  `model_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ml_algorithm` varchar(255) NOT NULL,
  `model_version` varchar(255) NOT NULL,
  `accuracy` decimal(5,2) NOT NULL,
  `f1_score` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ai_models` */

insert  into `ai_models`(`model_id`,`ml_algorithm`,`model_version`,`accuracy`,`f1_score`,`created_at`,`updated_at`) values (1,'YOLOv5','v1.2.3','95.50','92.10','2025-09-09 10:23:22','2025-09-09 10:23:22');

/*Table structure for table `analysis_results` */

DROP TABLE IF EXISTS `analysis_results`;

CREATE TABLE `analysis_results` (
  `result_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` bigint(20) unsigned NOT NULL,
  `detection_status` tinyint(1) NOT NULL,
  `severity_level` int(11) NOT NULL,
  `confidence_score` decimal(5,2) NOT NULL,
  `analysis_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`result_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `analysis_results_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `tomato_plant_images` (`image_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `analysis_results` */

insert  into `analysis_results`(`result_id`,`image_id`,`detection_status`,`severity_level`,`confidence_score`,`analysis_timestamp`) values (1,1,1,75,'92.50','2025-09-10 10:00:00'),(2,2,0,0,'99.80','2025-09-10 11:30:00'),(3,3,1,40,'88.10','2025-09-11 09:05:00');

/*Table structure for table `recommendations` */

DROP TABLE IF EXISTS `recommendations`;

CREATE TABLE `recommendations` (
  `recommendation_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `result_id` bigint(20) unsigned NOT NULL,
  `recommendation_text` text NOT NULL,
  `recommendation_type` varchar(255) NOT NULL COMMENT 'e.g., Immediate, Secondary, Follow-up',
  PRIMARY KEY (`recommendation_id`),
  KEY `result_id` (`result_id`),
  CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `analysis_results` (`result_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `recommendations` */

insert  into `recommendations`(`recommendation_id`,`result_id`,`recommendation_text`,`recommendation_type`) values (1,1,'Apply a certified organic insecticidal soap immediately. Ensure full coverage of all leaf surfaces.','Immediate Action'),(2,1,'Introduce Encarsia formosa (parasitic wasps) as a biological control agent after 3 days.','Secondary Action'),(3,1,'Monitor plant health daily for the next week and repeat soap application if necessary.','Follow-up Action'),(4,3,'Remove and destroy the most heavily infested leaves to reduce the pest population.','Immediate Action'),(5,3,'Increase air circulation around the plants to create a less favorable environment for pests.','Secondary Action');

/*Table structure for table `tomato_plant_images` */

DROP TABLE IF EXISTS `tomato_plant_images`;

CREATE TABLE `tomato_plant_images` (
  `image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) unsigned NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `farmer_id` (`farmer_id`),
  CONSTRAINT `tomato_plant_images_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`farmer_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tomato_plant_images` */

insert  into `tomato_plant_images`(`image_id`,`farmer_id`,`filepath`,`status`,`created_at`,`updated_at`) values (1,1,'tomato_images/infested_leaf_1.jpg',1,'2025-09-09 10:21:30','2025-09-09 10:21:30'),(2,1,'tomato_images/healthy_leaf_1.jpg',1,'2025-09-09 10:21:30','2025-09-09 10:21:30'),(3,2,'tomato_images/infested_leaf_2.jpg',1,'2025-09-09 10:21:30','2025-09-09 10:21:30');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `farmer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(55) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`farmer_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`farmer_id`,`fullname`,`username`,`email`,`password`,`created_at`,`updated_at`) values (1,'John Farmer','jfarmer','john.farmer@example.com','password','2025-09-09 10:20:50','2025-09-09 10:20:50'),(2,'Jane Doe','jdoe','jane.doe@example.com','password','2025-09-09 10:20:50','2025-09-09 10:20:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
