/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.9-MariaDB : Database - wsv1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wsv1` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `wsv1`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `co_cli` varchar(255) NOT NULL,
  `co_vendedor` varchar(255) DEFAULT NULL,
  `co_zona` varchar(255) DEFAULT NULL,
  `co_segmento` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `rif` varchar(255) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  `email` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `direc_entre` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`co_cli`,`co_vendedor`,`co_zona`,`co_segmento`,`tipo`,`rif`,`activo`,`email`,`descripcion`,`direccion`,`direc_entre`,`telefono`,`created_at`,`updated_at`,`deleted_at`) values (1,'I02365    ','RM','01',NULL,'G','J1122334455','','email@email.com','DESCRIPCION DEL CLIENTE','SIN DIRECCION','SIN DIRECCION','02431234567','2016-10-30 17:31:32','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'I02366','JX','02','',NULL,'J123456789','','jonnathanx@gmail.com','CLIENTE DE PRUEBA 01','SIN DIRECCION FISCAL',NULL,'02121234567','2016-10-30 17:31:34','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'I02367','HR','03','01','G','J987654321','','email@test.com','CLIENTE SIN DESCRIPCION','SIN DIRECCION',NULL,'02351234567','2016-10-30 17:32:25','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'I02368','JX','02',NULL,'J','J879654321','','sim@mail.com','CLIENTE DE PRUEBA','SIN DIRECCION','SIN DIRECCION','02351234567','2016-10-30 17:32:33','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'I02369','HR','03',NULL,NULL,'V18780176','','prueba@mail.com','CLIENTE DE PRUEBA','SIN DIRECCION',NULL,'02351234567','2016-10-30 17:34:45','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_11_17_010614_entrust_setup_tables',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'newcli','Crea Cliente','Crea Clientes','2016-11-17 02:25:51','2016-11-17 02:25:51'),(2,'readcli','Lee Cliente','Lee los Clientes','2016-11-17 02:26:36','2016-11-17 02:26:36'),(3,'upcli','Actualiza Cliente','Actualiza Clientes','2016-11-17 02:27:05','2016-11-17 02:27:05'),(4,'delcli','Borra Cliente','Borra Clientes','2016-11-17 02:27:35','2016-11-17 02:27:35');

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`user_id`,`role_id`) values (1,1),(2,2);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'admin','Administrador','Usuario con perfil de Administrador','2016-11-17 02:25:00','2016-11-17 02:25:00'),(2,'vend','Vendedor','Usuario con perfil de Vendedor','2016-11-17 02:32:28','2016-11-17 02:32:28');

/*Table structure for table `sync_config` */

DROP TABLE IF EXISTS `sync_config`;

CREATE TABLE `sync_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `sync_config` */

insert  into `sync_config`(`id`,`name`,`descripcion`,`activo`,`created_at`,`updated_at`,`deleted_at`) values (1,'agendado','Sincronizacion por hoas definidas',1,'2016-11-18 01:42:33','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'por_peticion','Sincronizacion a peticion de Usuario',0,'2016-11-18 01:43:29','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `sync_horas` */

DROP TABLE IF EXISTS `sync_horas`;

CREATE TABLE `sync_horas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sync_id` int(10) NOT NULL,
  `hora_sync` time DEFAULT '00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `sync_horas` */

insert  into `sync_horas`(`id`,`sync_id`,`hora_sync`) values (1,1,'08:00:00'),(2,1,'12:00:00'),(3,1,'15:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `co_sucu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_vendedor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `last_sync` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `security_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`admin`,`co_sucu`,`co_vendedor`,`nombre`,`apellido`,`activo`,`last_sync`,`password`,`security_code`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values (1,'instalador','instalador@email.com',1,NULL,'ADMIN','Instalador','De Prueba',1,'0000-00-00 00:00:00','$2y$10$b3x/yDJx8X4HEatr6OgaDOZ8wDaaP4wfwJ0L0rrBkk5oEAFQjTWHK',NULL,NULL,'2016-11-16 22:30:55','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'tester','tester@email.com',0,NULL,NULL,'Tester','De Prueba',0,'0000-00-00 00:00:00','$2y$10$b3x/yDJx8X4HEatr6OgaDOZ8wDaaP4wfwJ0L0rrBkk5oEAFQjTWHK',NULL,NULL,'2016-11-16 22:34:50','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
