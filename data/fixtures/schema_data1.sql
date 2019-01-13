/*
SQLyog Ultimate v9.10 
MySQL - 5.1.66-0ubuntu0.11.10.3 : Database - school
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`school` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `school`;

/*Table structure for table `sch_account` */

DROP TABLE IF EXISTS `sch_account`;

CREATE TABLE `sch_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` tinyint(4) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_account_FI_1` (`contract_id`),
  CONSTRAINT `sch_account_FK_1` FOREIGN KEY (`contract_id`) REFERENCES `sch_contract` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_account` */

LOCK TABLES `sch_account` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_account_deposit` */

DROP TABLE IF EXISTS `sch_account_deposit`;

CREATE TABLE `sch_account_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_account_deposit_FI_1` (`account_id`),
  KEY `sch_account_deposit_FI_2` (`deposit_id`),
  CONSTRAINT `sch_account_deposit_FK_1` FOREIGN KEY (`account_id`) REFERENCES `sch_account` (`id`),
  CONSTRAINT `sch_account_deposit_FK_2` FOREIGN KEY (`deposit_id`) REFERENCES `sch_deposit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_account_deposit` */

LOCK TABLES `sch_account_deposit` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_attribute` */

DROP TABLE IF EXISTS `sch_attribute`;

CREATE TABLE `sch_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `label` text NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_attribute_FI_1` (`person_id`),
  CONSTRAINT `sch_attribute_FK_1` FOREIGN KEY (`person_id`) REFERENCES `sch_person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_attribute` */

LOCK TABLES `sch_attribute` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_attribute_contract` */

DROP TABLE IF EXISTS `sch_attribute_contract`;

CREATE TABLE `sch_attribute_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `label` text NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_attribute_contract_FI_1` (`contract_id`),
  CONSTRAINT `sch_attribute_contract_FK_1` FOREIGN KEY (`contract_id`) REFERENCES `sch_contract` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_attribute_contract` */

LOCK TABLES `sch_attribute_contract` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_billet` */

DROP TABLE IF EXISTS `sch_billet`;

CREATE TABLE `sch_billet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `value` float DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `sch_billet` */

LOCK TABLES `sch_billet` WRITE;

insert  into `sch_billet`(`id`,`id_state`,`name`,`description`,`value`,`deleted_by`,`created_at`,`updated_at`) values (1,2,'Recibo','Para los recibos de Boveda.',1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'Billete 200','Para los billetes de 200.',200,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(3,2,'Billete 100','Para los billetes de 100.',100,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(4,2,'Billete 50','Para los billetes de 50.',50,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(5,2,'Billete 20','Para los billetes de 20.',20,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(6,2,'Billete 10','Para los billetes de 10.',10,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(7,2,'Billete 5','Para los billetes de 5.',5,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(8,2,'Billete 2','Para los billetes de 2.',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(9,2,'Billete 1','Para los billetes de 1.',1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(10,2,'Moneda 5','Para las monedas de 5.',5,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(11,2,'Moneda 2','Para las monedas de 2.',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(12,2,'Moneda 1','Para las monedas de 1.',1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(13,2,'Moneda 0,50','Para las monedas de 0,50.',0.5,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(14,2,'Moneda 0,20','Para las monedas de 1.',0.2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(15,2,'Moneda 0,10','Para las monedas de 0,10.',0.1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(16,2,'Lote','Para los cierre de lotes de las ATM.',1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_business_entity` */

DROP TABLE IF EXISTS `sch_business_entity`;

CREATE TABLE `sch_business_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `server_name` varchar(100) NOT NULL,
  `connection` varchar(100) NOT NULL,
  `night_audit_hour` int(11) NOT NULL,
  `night_audit_overtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `sch_business_entity` */

LOCK TABLES `sch_business_entity` WRITE;

insert  into `sch_business_entity`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`name`,`description`,`server_name`,`connection`,`night_audit_hour`,`night_audit_overtime`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Colegio Rene Moreno','Colegio Rene Moreno','server_name','connection',10,10);

UNLOCK TABLES;

/*Table structure for table `sch_cashbox` */

DROP TABLE IF EXISTS `sch_cashbox`;

CREATE TABLE `sch_cashbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `closing_date` datetime DEFAULT NULL,
  `comment` text,
  `cashier_id` int(11) NOT NULL,
  `night_audit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_cashbox_FI_1` (`cashier_id`),
  KEY `sch_cashbox_FI_2` (`night_audit_id`),
  CONSTRAINT `sch_cashbox_FK_1` FOREIGN KEY (`cashier_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `sch_cashbox_FK_2` FOREIGN KEY (`night_audit_id`) REFERENCES `sch_night_audit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_cashbox` */

LOCK TABLES `sch_cashbox` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_classroom` */

DROP TABLE IF EXISTS `sch_classroom`;

CREATE TABLE `sch_classroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grade_subject_period_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_classroom_FI_1` (`grade_subject_period_id`),
  KEY `sch_classroom_FI_2` (`account_id`),
  CONSTRAINT `sch_classroom_FK_1` FOREIGN KEY (`grade_subject_period_id`) REFERENCES `sch_grade_subject_period` (`id`),
  CONSTRAINT `sch_classroom_FK_2` FOREIGN KEY (`account_id`) REFERENCES `sch_account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_classroom` */

LOCK TABLES `sch_classroom` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_contract` */

DROP TABLE IF EXISTS `sch_contract`;

CREATE TABLE `sch_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `container` text,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` text,
  `record_date` datetime DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `period_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_contract_FI_1` (`period_id`),
  KEY `sch_contract_FI_2` (`student_id`),
  CONSTRAINT `sch_contract_FK_1` FOREIGN KEY (`period_id`) REFERENCES `sch_period` (`id`),
  CONSTRAINT `sch_contract_FK_2` FOREIGN KEY (`student_id`) REFERENCES `sch_student` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_contract` */

LOCK TABLES `sch_contract` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_contract_grade` */

DROP TABLE IF EXISTS `sch_contract_grade`;

CREATE TABLE `sch_contract_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_contract_grade_FI_1` (`contract_id`),
  KEY `sch_contract_grade_FI_2` (`grade_id`),
  CONSTRAINT `sch_contract_grade_FK_1` FOREIGN KEY (`contract_id`) REFERENCES `sch_contract` (`id`),
  CONSTRAINT `sch_contract_grade_FK_2` FOREIGN KEY (`grade_id`) REFERENCES `sch_grade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_contract_grade` */

LOCK TABLES `sch_contract_grade` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_currency` */

DROP TABLE IF EXISTS `sch_currency`;

CREATE TABLE `sch_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `sale` float NOT NULL,
  `purchase` float NOT NULL,
  `exchange_rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sch_currency` */

LOCK TABLES `sch_currency` WRITE;

insert  into `sch_currency`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`name`,`description`,`sale`,`purchase`,`exchange_rate`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Boliviano','Para los bolivianos',1,1,1),(2,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Dolar','Para los dolares',7.1,6.8,1);

UNLOCK TABLES;

/*Table structure for table `sch_currency_price` */

DROP TABLE IF EXISTS `sch_currency_price`;

CREATE TABLE `sch_currency_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `reference` varchar(100) NOT NULL,
  `sale` float NOT NULL,
  `purchase` float NOT NULL,
  `since_date` datetime NOT NULL,
  `until_date` datetime NOT NULL,
  `currency_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_currency_price_FI_1` (`currency_id`),
  KEY `sch_currency_price_FI_2` (`user_id`),
  CONSTRAINT `sch_currency_price_FK_1` FOREIGN KEY (`currency_id`) REFERENCES `sch_currency` (`id`),
  CONSTRAINT `sch_currency_price_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sch_currency_price` */

LOCK TABLES `sch_currency_price` WRITE;

insert  into `sch_currency_price`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`reference`,`sale`,`purchase`,`since_date`,`until_date`,`currency_id`,`user_id`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Boliviano desde 2013-01-12    sale: 1',0,1,'2013-01-12 00:00:00','2013-12-31 00:00:00',1,1),(2,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Dolar desde 2013-01-12    sale: 6.9',0,6.8,'2013-01-12 00:00:00','2013-12-31 00:00:00',2,1);

UNLOCK TABLES;

/*Table structure for table `sch_curso` */

DROP TABLE IF EXISTS `sch_curso`;

CREATE TABLE `sch_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `sch_curso` */

LOCK TABLES `sch_curso` WRITE;

insert  into `sch_curso`(`id`,`id_state`,`name`,`description`,`deleted_by`,`created_at`,`updated_at`) values (1,2,'MATERNAL','MATERNAL DE LA GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'INFANTIL','INFATIL DE LA GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(3,2,'NIDITO','NIDITO DE INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(4,2,'PREKINDER','PREKINDER DE INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(5,2,'KINDER','KINDER DE INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(6,2,'1','PRIMERO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(7,2,'2','SEGUNDO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(8,2,'3','TERCERO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(9,2,'4','CUARTO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(10,2,'5','QUINTO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(11,2,'6','SEXTO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_degree` */

DROP TABLE IF EXISTS `sch_degree`;

CREATE TABLE `sch_degree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `sch_degree` */

LOCK TABLES `sch_degree` WRITE;

insert  into `sch_degree`(`id`,`id_state`,`name`,`description`,`deleted_by`,`created_at`,`updated_at`) values (1,2,'GUARDERIA','GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'INICIAL','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(3,2,'PRIMARIA - BASICO','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(4,2,'INTERMEDIO','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(5,2,'SECUNDARIA','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_deposit` */

DROP TABLE IF EXISTS `sch_deposit`;

CREATE TABLE `sch_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `comment` text,
  `discount` float DEFAULT NULL,
  `cashier_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_deposit_FI_1` (`cashier_id`),
  KEY `sch_deposit_FI_2` (`currency_id`),
  CONSTRAINT `sch_deposit_FK_1` FOREIGN KEY (`cashier_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `sch_deposit_FK_2` FOREIGN KEY (`currency_id`) REFERENCES `sch_currency` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_deposit` */

LOCK TABLES `sch_deposit` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_discount` */

DROP TABLE IF EXISTS `sch_discount`;

CREATE TABLE `sch_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sch_discount` */

LOCK TABLES `sch_discount` WRITE;

insert  into `sch_discount`(`id`,`id_state`,`name`,`discount`,`description`,`created_at`,`updated_at`,`deleted_by`) values (1,2,'Beca Completa',100,'Para los mejores alumnos','2013-01-12 07:01:58','2013-01-12 07:01:58',NULL),(2,2,'Media Beca',50,'Para los mejores alumnos','2013-01-12 07:01:58','2013-01-12 07:01:58',NULL);

UNLOCK TABLES;

/*Table structure for table `sch_discount_contract` */

DROP TABLE IF EXISTS `sch_discount_contract`;

CREATE TABLE `sch_discount_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_discount_contract_FI_1` (`contract_id`),
  KEY `sch_discount_contract_FI_2` (`discount_id`),
  CONSTRAINT `sch_discount_contract_FK_1` FOREIGN KEY (`contract_id`) REFERENCES `sch_contract` (`id`),
  CONSTRAINT `sch_discount_contract_FK_2` FOREIGN KEY (`discount_id`) REFERENCES `sch_discount` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_discount_contract` */

LOCK TABLES `sch_discount_contract` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_discount_item` */

DROP TABLE IF EXISTS `sch_discount_item`;

CREATE TABLE `sch_discount_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_discount_item_FI_1` (`item_id`),
  KEY `sch_discount_item_FI_2` (`discount_id`),
  CONSTRAINT `sch_discount_item_FK_1` FOREIGN KEY (`item_id`) REFERENCES `sch_item` (`id`),
  CONSTRAINT `sch_discount_item_FK_2` FOREIGN KEY (`discount_id`) REFERENCES `sch_discount` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_discount_item` */

LOCK TABLES `sch_discount_item` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_form_of_payment` */

DROP TABLE IF EXISTS `sch_form_of_payment`;

CREATE TABLE `sch_form_of_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sch_form_of_payment` */

LOCK TABLES `sch_form_of_payment` WRITE;

insert  into `sch_form_of_payment`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`name`,`description`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Efectivo','Dinero en Efectivo.'),(2,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Tarjeta','Tarjeta de Crédito o Débito.'),(3,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','Cuenta','Cuenta por cobrar o pagar.');

UNLOCK TABLES;

/*Table structure for table `sch_grade` */

DROP TABLE IF EXISTS `sch_grade`;

CREATE TABLE `sch_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `degree_id` int(11) NOT NULL,
  `timetable_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `paralelo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_grade_FI_1` (`degree_id`),
  KEY `sch_grade_FI_2` (`timetable_id`),
  KEY `sch_grade_FI_3` (`curso_id`),
  KEY `sch_grade_FI_4` (`paralelo_id`),
  CONSTRAINT `sch_grade_FK_1` FOREIGN KEY (`degree_id`) REFERENCES `sch_degree` (`id`),
  CONSTRAINT `sch_grade_FK_2` FOREIGN KEY (`timetable_id`) REFERENCES `sch_timetable` (`id`),
  CONSTRAINT `sch_grade_FK_3` FOREIGN KEY (`curso_id`) REFERENCES `sch_curso` (`id`),
  CONSTRAINT `sch_grade_FK_4` FOREIGN KEY (`paralelo_id`) REFERENCES `sch_paralelo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `sch_grade` */

LOCK TABLES `sch_grade` WRITE;

insert  into `sch_grade`(`id`,`id_state`,`name`,`description`,`deleted_by`,`created_at`,`updated_at`,`degree_id`,`timetable_id`,`curso_id`,`paralelo_id`) values (1,2,'MATERNAL','GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',1,1,1,1),(2,2,'INFANTIL','GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',1,1,2,1),(3,2,'NIDITO','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',2,1,3,1),(4,2,'PREKINDER','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',2,1,4,1),(5,2,'KINDER','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',2,1,5,1),(6,2,'1','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,1,6,1),(7,2,'2','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,1,7,1),(8,2,'3','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,1,8,1),(9,2,'4','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,1,9,1),(10,2,'5','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,1,10,1),(11,2,'1','INTERMEDIO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',4,1,11,1),(12,2,'2','INTERMEDIO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',4,1,6,1),(13,2,'2','INTERMEDIO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',4,1,7,1),(14,2,'3','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,1,8,1),(15,2,'4','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,1,9,1),(16,2,'5','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,1,10,1),(17,2,'6','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,1,11,1),(18,2,'MATERNAL','GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',1,2,1,1),(19,2,'INFANTIL','GUARDERIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',1,2,2,1),(20,2,'NIDITO','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',2,2,3,1),(21,2,'PREKINDER','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',2,2,4,1),(22,2,'KINDER','INICIAL',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',2,2,5,1),(23,2,'1','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,2,6,1),(24,2,'2','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,2,7,1),(25,2,'3','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,2,8,1),(26,2,'4','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,2,9,1),(27,2,'5','PRIMARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',3,2,10,1),(28,2,'1','INTERMEDIO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',4,2,11,1),(29,2,'2','INTERMEDIO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',4,2,6,1),(30,2,'2','INTERMEDIO',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',4,2,7,1),(31,2,'3','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,2,8,1),(32,2,'4','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,2,9,1),(33,2,'5','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,2,10,1),(34,2,'6','SECUNDARIA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',5,2,11,1);

UNLOCK TABLES;

/*Table structure for table `sch_grade_subject` */

DROP TABLE IF EXISTS `sch_grade_subject`;

CREATE TABLE `sch_grade_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grade_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_grade_subject_FI_1` (`grade_id`),
  KEY `sch_grade_subject_FI_2` (`subject_id`),
  CONSTRAINT `sch_grade_subject_FK_1` FOREIGN KEY (`grade_id`) REFERENCES `sch_grade` (`id`),
  CONSTRAINT `sch_grade_subject_FK_2` FOREIGN KEY (`subject_id`) REFERENCES `sch_subject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_grade_subject` */

LOCK TABLES `sch_grade_subject` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_grade_subject_period` */

DROP TABLE IF EXISTS `sch_grade_subject_period`;

CREATE TABLE `sch_grade_subject_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grade_subject_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_grade_subject_period_FI_1` (`grade_subject_id`),
  KEY `sch_grade_subject_period_FI_2` (`period_id`),
  CONSTRAINT `sch_grade_subject_period_FK_1` FOREIGN KEY (`grade_subject_id`) REFERENCES `sch_grade_subject` (`id`),
  CONSTRAINT `sch_grade_subject_period_FK_2` FOREIGN KEY (`period_id`) REFERENCES `sch_period` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_grade_subject_period` */

LOCK TABLES `sch_grade_subject_period` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_grade_subject_period_teacher` */

DROP TABLE IF EXISTS `sch_grade_subject_period_teacher`;

CREATE TABLE `sch_grade_subject_period_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grade_subject_period_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_grade_subject_period_teacher_FI_1` (`grade_subject_period_id`),
  KEY `sch_grade_subject_period_teacher_FI_2` (`teacher_id`),
  CONSTRAINT `sch_grade_subject_period_teacher_FK_1` FOREIGN KEY (`grade_subject_period_id`) REFERENCES `sch_grade_subject_period` (`id`),
  CONSTRAINT `sch_grade_subject_period_teacher_FK_2` FOREIGN KEY (`teacher_id`) REFERENCES `sch_teacher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_grade_subject_period_teacher` */

LOCK TABLES `sch_grade_subject_period_teacher` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_item` */

DROP TABLE IF EXISTS `sch_item`;

CREATE TABLE `sch_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `alter_price` tinyint(4) DEFAULT NULL,
  `quantity_load` tinyint(4) DEFAULT NULL,
  `name_load` text,
  `type_item_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_item_FI_1` (`type_item_id`),
  CONSTRAINT `sch_item_FK_1` FOREIGN KEY (`type_item_id`) REFERENCES `sch_type_item` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `sch_item` */

LOCK TABLES `sch_item` WRITE;

insert  into `sch_item`(`id`,`id_state`,`name`,`description`,`price`,`alter_price`,`quantity_load`,`name_load`,`type_item_id`,`deleted_by`,`created_at`,`updated_at`) values (1,2,'RECARGA POR MORA','Recarga por no pago de una mensualidad',0,127,1,NULL,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'MATERNAL','Mensualidad de guarderia',450,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(3,2,'INFANTIL','Mensualidad de guarderia',450,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(4,2,'NIDITO MAÑANA','Mensualidad Inicial',420,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(5,2,'NIDITO TARDE','Mensualidad Inicial',350,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(6,2,'PREKINDER MAÑANA','Mensualidad Inicial',NULL,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(7,2,'PREKINDER TARDE','Mensualidad Inicial',350,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(8,2,'KINDER MAÑANA','Mensualidad Inicial',420,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(9,2,'KINDER TARDE','Mensualidad Inicial',350,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(10,2,'PRIMARIA MAÑANA','Mensualidad PRIMARIA',420,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(11,2,'PRIMARIA TARDE','Mensualidad PRIMARIA',350,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(12,2,'SECUNDARIA MAÑANA','Mensualidad PRIMARIA',600,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(13,2,'SECUNDARIA TARDE','Mensualidad PRIMARIA',520,127,10,'{\"1\":\"Enero\", \"2\":\"Febrero\",\"3\":\"Marzo\",\"4\":\"Abril\",\"5\":\"Mayo\",\"6\":\"Junio\",\"7\":\"Julio\",\"8\":\"Agosto\",\"9\":\"Septiembre\",\"10\":\"Octubre\"}',2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_item_for_sale` */

DROP TABLE IF EXISTS `sch_item_for_sale`;

CREATE TABLE `sch_item_for_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `discount_name` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `additional_information` text,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_item_for_sale_FI_1` (`sales_id`),
  KEY `sch_item_for_sale_FI_2` (`item_id`),
  CONSTRAINT `sch_item_for_sale_FK_1` FOREIGN KEY (`sales_id`) REFERENCES `sch_sales` (`id`),
  CONSTRAINT `sch_item_for_sale_FK_2` FOREIGN KEY (`item_id`) REFERENCES `sch_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_item_for_sale` */

LOCK TABLES `sch_item_for_sale` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_item_grade` */

DROP TABLE IF EXISTS `sch_item_grade`;

CREATE TABLE `sch_item_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_item_grade_FI_1` (`item_id`),
  KEY `sch_item_grade_FI_2` (`grade_id`),
  CONSTRAINT `sch_item_grade_FK_1` FOREIGN KEY (`item_id`) REFERENCES `sch_item` (`id`),
  CONSTRAINT `sch_item_grade_FK_2` FOREIGN KEY (`grade_id`) REFERENCES `sch_grade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_item_grade` */

LOCK TABLES `sch_item_grade` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_movement_cashbox` */

DROP TABLE IF EXISTS `sch_movement_cashbox`;

CREATE TABLE `sch_movement_cashbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `cashbox_id` int(11) NOT NULL,
  `currency_price_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_movement_cashbox_FI_1` (`cashbox_id`),
  KEY `sch_movement_cashbox_FI_2` (`currency_price_id`),
  KEY `sch_movement_cashbox_FI_3` (`payment_type_id`),
  CONSTRAINT `sch_movement_cashbox_FK_1` FOREIGN KEY (`cashbox_id`) REFERENCES `sch_cashbox` (`id`),
  CONSTRAINT `sch_movement_cashbox_FK_2` FOREIGN KEY (`currency_price_id`) REFERENCES `sch_currency_price` (`id`),
  CONSTRAINT `sch_movement_cashbox_FK_3` FOREIGN KEY (`payment_type_id`) REFERENCES `sch_payment_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_movement_cashbox` */

LOCK TABLES `sch_movement_cashbox` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_movement_cashbox_deposit` */

DROP TABLE IF EXISTS `sch_movement_cashbox_deposit`;

CREATE TABLE `sch_movement_cashbox_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movement_cashbox_id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_movement_cashbox_deposit_FI_1` (`movement_cashbox_id`),
  KEY `sch_movement_cashbox_deposit_FI_2` (`deposit_id`),
  CONSTRAINT `sch_movement_cashbox_deposit_FK_1` FOREIGN KEY (`movement_cashbox_id`) REFERENCES `sch_movement_cashbox` (`id`),
  CONSTRAINT `sch_movement_cashbox_deposit_FK_2` FOREIGN KEY (`deposit_id`) REFERENCES `sch_deposit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_movement_cashbox_deposit` */

LOCK TABLES `sch_movement_cashbox_deposit` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_movement_cashbox_pay_inf` */

DROP TABLE IF EXISTS `sch_movement_cashbox_pay_inf`;

CREATE TABLE `sch_movement_cashbox_pay_inf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `movement_cashbox_id` int(11) NOT NULL,
  `payment_information_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_movement_cashbox_pay_inf_FI_1` (`movement_cashbox_id`),
  KEY `sch_movement_cashbox_pay_inf_FI_2` (`payment_information_id`),
  CONSTRAINT `sch_movement_cashbox_pay_inf_FK_1` FOREIGN KEY (`movement_cashbox_id`) REFERENCES `sch_movement_cashbox` (`id`),
  CONSTRAINT `sch_movement_cashbox_pay_inf_FK_2` FOREIGN KEY (`payment_information_id`) REFERENCES `sch_payment_information` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_movement_cashbox_pay_inf` */

LOCK TABLES `sch_movement_cashbox_pay_inf` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_movement_cashbox_receipt` */

DROP TABLE IF EXISTS `sch_movement_cashbox_receipt`;

CREATE TABLE `sch_movement_cashbox_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movement_cashbox_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_movement_cashbox_receipt_FI_1` (`movement_cashbox_id`),
  KEY `sch_movement_cashbox_receipt_FI_2` (`receipt_id`),
  CONSTRAINT `sch_movement_cashbox_receipt_FK_1` FOREIGN KEY (`movement_cashbox_id`) REFERENCES `sch_movement_cashbox` (`id`),
  CONSTRAINT `sch_movement_cashbox_receipt_FK_2` FOREIGN KEY (`receipt_id`) REFERENCES `sch_receipt` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_movement_cashbox_receipt` */

LOCK TABLES `sch_movement_cashbox_receipt` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_movement_cashbox_sales` */

DROP TABLE IF EXISTS `sch_movement_cashbox_sales`;

CREATE TABLE `sch_movement_cashbox_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movement_cashbox_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_movement_cashbox_sales_FI_1` (`movement_cashbox_id`),
  KEY `sch_movement_cashbox_sales_FI_2` (`sales_id`),
  CONSTRAINT `sch_movement_cashbox_sales_FK_1` FOREIGN KEY (`movement_cashbox_id`) REFERENCES `sch_movement_cashbox` (`id`),
  CONSTRAINT `sch_movement_cashbox_sales_FK_2` FOREIGN KEY (`sales_id`) REFERENCES `sch_sales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_movement_cashbox_sales` */

LOCK TABLES `sch_movement_cashbox_sales` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_movement_cashbox_transfer` */

DROP TABLE IF EXISTS `sch_movement_cashbox_transfer`;

CREATE TABLE `sch_movement_cashbox_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movement_cashbox_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_movement_cashbox_transfer_FI_1` (`movement_cashbox_id`),
  KEY `sch_movement_cashbox_transfer_FI_2` (`transfer_id`),
  CONSTRAINT `sch_movement_cashbox_transfer_FK_1` FOREIGN KEY (`movement_cashbox_id`) REFERENCES `sch_movement_cashbox` (`id`),
  CONSTRAINT `sch_movement_cashbox_transfer_FK_2` FOREIGN KEY (`transfer_id`) REFERENCES `sch_transfer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_movement_cashbox_transfer` */

LOCK TABLES `sch_movement_cashbox_transfer` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_night_audit` */

DROP TABLE IF EXISTS `sch_night_audit`;

CREATE TABLE `sch_night_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_entity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_night_audit_FI_1` (`user_id`),
  KEY `sch_night_audit_FI_2` (`business_entity_id`),
  CONSTRAINT `sch_night_audit_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `sch_night_audit_FK_2` FOREIGN KEY (`business_entity_id`) REFERENCES `sch_business_entity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `sch_night_audit` */

LOCK TABLES `sch_night_audit` WRITE;

insert  into `sch_night_audit`(`id`,`deleted_by`,`created_at`,`updated_at`,`date`,`user_id`,`business_entity_id`) values (1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','2013-01-10 00:00:00',1,1);

UNLOCK TABLES;

/*Table structure for table `sch_paralelo` */

DROP TABLE IF EXISTS `sch_paralelo`;

CREATE TABLE `sch_paralelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sch_paralelo` */

LOCK TABLES `sch_paralelo` WRITE;

insert  into `sch_paralelo`(`id`,`id_state`,`name`,`description`,`deleted_by`,`created_at`,`updated_at`) values (1,2,'A','Paralelo A',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'B','Paralelo B',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_payment_information` */

DROP TABLE IF EXISTS `sch_payment_information`;

CREATE TABLE `sch_payment_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `comment` text,
  `address` text,
  `validity` datetime DEFAULT NULL,
  `cvv_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_payment_information` */

LOCK TABLES `sch_payment_information` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_payment_type` */

DROP TABLE IF EXISTS `sch_payment_type`;

CREATE TABLE `sch_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_name` tinyint(4) DEFAULT NULL,
  `number` tinyint(4) DEFAULT NULL,
  `document` tinyint(4) DEFAULT NULL,
  `comment` tinyint(4) DEFAULT NULL,
  `address` tinyint(4) DEFAULT NULL,
  `validity` tinyint(4) DEFAULT NULL,
  `cvv_code` tinyint(4) DEFAULT NULL,
  `sales_check` tinyint(4) DEFAULT NULL,
  `accounting_record` tinyint(4) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `form_of_payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_payment_type_FI_1` (`currency_id`),
  KEY `sch_payment_type_FI_2` (`form_of_payment_id`),
  CONSTRAINT `sch_payment_type_FK_1` FOREIGN KEY (`currency_id`) REFERENCES `sch_currency` (`id`),
  CONSTRAINT `sch_payment_type_FK_2` FOREIGN KEY (`form_of_payment_id`) REFERENCES `sch_form_of_payment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `sch_payment_type` */

LOCK TABLES `sch_payment_type` WRITE;

insert  into `sch_payment_type`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`user_name`,`number`,`document`,`comment`,`address`,`validity`,`cvv_code`,`sales_check`,`accounting_record`,`currency_id`,`form_of_payment_id`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',NULL,0,0,0,NULL,NULL,NULL,1,1,1,1),(2,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',NULL,1,1,0,NULL,NULL,NULL,1,1,2,1),(3,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',NULL,1,1,0,NULL,NULL,NULL,1,1,1,2),(4,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58',NULL,0,0,0,NULL,NULL,NULL,1,1,1,3);

UNLOCK TABLES;

/*Table structure for table `sch_payment_type_billet` */

DROP TABLE IF EXISTS `sch_payment_type_billet`;

CREATE TABLE `sch_payment_type_billet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `billet_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_payment_type_billet_FI_1` (`billet_id`),
  KEY `sch_payment_type_billet_FI_2` (`payment_type_id`),
  CONSTRAINT `sch_payment_type_billet_FK_1` FOREIGN KEY (`billet_id`) REFERENCES `sch_billet` (`id`),
  CONSTRAINT `sch_payment_type_billet_FK_2` FOREIGN KEY (`payment_type_id`) REFERENCES `sch_payment_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `sch_payment_type_billet` */

LOCK TABLES `sch_payment_type_billet` WRITE;

insert  into `sch_payment_type_billet`(`id`,`id_state`,`billet_id`,`payment_type_id`,`deleted_by`,`created_at`,`updated_at`) values (1,2,2,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,3,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(3,2,4,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(4,2,5,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(5,2,6,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(6,2,10,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(7,2,11,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(8,2,12,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(9,2,13,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(10,2,14,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(11,2,15,1,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(12,2,16,3,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(13,2,3,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(14,2,4,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(15,2,5,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(16,2,6,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(17,2,7,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(18,2,9,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_period` */

DROP TABLE IF EXISTS `sch_period`;

CREATE TABLE `sch_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sch_period` */

LOCK TABLES `sch_period` WRITE;

insert  into `sch_period`(`id`,`id_state`,`name`,`from_date`,`to_date`,`deleted_by`,`created_at`,`updated_at`) values (1,3,'GESTION 2012','2012-01-02 00:00:00','2012-12-30 00:00:00',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'GESTION 2013','2013-01-02 00:00:00','2013-12-30 00:00:00',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_person` */

DROP TABLE IF EXISTS `sch_person`;

CREATE TABLE `sch_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_person` */

LOCK TABLES `sch_person` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_question` */

DROP TABLE IF EXISTS `sch_question`;

CREATE TABLE `sch_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `label` text NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_question_FI_1` (`contract_id`),
  CONSTRAINT `sch_question_FK_1` FOREIGN KEY (`contract_id`) REFERENCES `sch_contract` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_question` */

LOCK TABLES `sch_question` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_receipt` */

DROP TABLE IF EXISTS `sch_receipt`;

CREATE TABLE `sch_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` float DEFAULT NULL,
  `total_net` float DEFAULT NULL,
  `night_audit_id` int(11) NOT NULL,
  `discount` float DEFAULT NULL,
  `service` float DEFAULT NULL,
  `canceled` tinyint(4) DEFAULT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `comment` text,
  `name` varchar(100) DEFAULT NULL,
  `nit` varchar(12) DEFAULT NULL,
  `telefon` varchar(12) DEFAULT NULL,
  `additional_information` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_receipt_FI_1` (`night_audit_id`),
  CONSTRAINT `sch_receipt_FK_1` FOREIGN KEY (`night_audit_id`) REFERENCES `sch_night_audit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_receipt` */

LOCK TABLES `sch_receipt` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_sale_account` */

DROP TABLE IF EXISTS `sch_sale_account`;

CREATE TABLE `sch_sale_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `sales_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_sale_account_FI_1` (`sales_id`),
  KEY `sch_sale_account_FI_2` (`account_id`),
  CONSTRAINT `sch_sale_account_FK_1` FOREIGN KEY (`sales_id`) REFERENCES `sch_sales` (`id`),
  CONSTRAINT `sch_sale_account_FK_2` FOREIGN KEY (`account_id`) REFERENCES `sch_account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_sale_account` */

LOCK TABLES `sch_sale_account` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_sales` */

DROP TABLE IF EXISTS `sch_sales`;

CREATE TABLE `sch_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `cashier_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_sales_FI_1` (`cashier_id`),
  CONSTRAINT `sch_sales_FK_1` FOREIGN KEY (`cashier_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_sales` */

LOCK TABLES `sch_sales` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_sales_deposit` */

DROP TABLE IF EXISTS `sch_sales_deposit`;

CREATE TABLE `sch_sales_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `sales_id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_sales_deposit_FI_1` (`sales_id`),
  KEY `sch_sales_deposit_FI_2` (`deposit_id`),
  CONSTRAINT `sch_sales_deposit_FK_1` FOREIGN KEY (`sales_id`) REFERENCES `sch_sales` (`id`),
  CONSTRAINT `sch_sales_deposit_FK_2` FOREIGN KEY (`deposit_id`) REFERENCES `sch_deposit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_sales_deposit` */

LOCK TABLES `sch_sales_deposit` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_student` */

DROP TABLE IF EXISTS `sch_student`;

CREATE TABLE `sch_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `rude` varchar(100) NOT NULL,
  `codigo` char(30) NOT NULL,
  `birth_date` datetime DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_student_FI_1` (`person_id`),
  CONSTRAINT `sch_student_FK_1` FOREIGN KEY (`person_id`) REFERENCES `sch_person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_student` */

LOCK TABLES `sch_student` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_student_tutor` */

DROP TABLE IF EXISTS `sch_student_tutor`;

CREATE TABLE `sch_student_tutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_student_tutor_FI_1` (`student_id`),
  KEY `sch_student_tutor_FI_2` (`tutor_id`),
  CONSTRAINT `sch_student_tutor_FK_1` FOREIGN KEY (`student_id`) REFERENCES `sch_student` (`id`),
  CONSTRAINT `sch_student_tutor_FK_2` FOREIGN KEY (`tutor_id`) REFERENCES `sch_tutor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_student_tutor` */

LOCK TABLES `sch_student_tutor` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_subject` */

DROP TABLE IF EXISTS `sch_subject`;

CREATE TABLE `sch_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_subject` */

LOCK TABLES `sch_subject` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_teacher` */

DROP TABLE IF EXISTS `sch_teacher`;

CREATE TABLE `sch_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_teacher` */

LOCK TABLES `sch_teacher` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_timetable` */

DROP TABLE IF EXISTS `sch_timetable`;

CREATE TABLE `sch_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sch_timetable` */

LOCK TABLES `sch_timetable` WRITE;

insert  into `sch_timetable`(`id`,`id_state`,`name`,`description`,`deleted_by`,`created_at`,`updated_at`) values (1,2,'M','MAÑANA',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(2,2,'T','TARDE',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58'),(3,2,'N','NOCHE',NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58');

UNLOCK TABLES;

/*Table structure for table `sch_transfer` */

DROP TABLE IF EXISTS `sch_transfer`;

CREATE TABLE `sch_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `comment` text,
  `type` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_transfer_FI_1` (`user_id`),
  CONSTRAINT `sch_transfer_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_transfer` */

LOCK TABLES `sch_transfer` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_transfer_billet` */

DROP TABLE IF EXISTS `sch_transfer_billet`;

CREATE TABLE `sch_transfer_billet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `billet_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_transfer_billet_FI_1` (`transfer_id`),
  KEY `sch_transfer_billet_FI_2` (`billet_id`),
  CONSTRAINT `sch_transfer_billet_FK_1` FOREIGN KEY (`transfer_id`) REFERENCES `sch_transfer` (`id`),
  CONSTRAINT `sch_transfer_billet_FK_2` FOREIGN KEY (`billet_id`) REFERENCES `sch_billet` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_transfer_billet` */

LOCK TABLES `sch_transfer_billet` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_tutor` */

DROP TABLE IF EXISTS `sch_tutor`;

CREATE TABLE `sch_tutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `ci` char(20) NOT NULL,
  `languaje` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type_tutor_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sch_tutor_FI_1` (`type_tutor_id`),
  KEY `sch_tutor_FI_2` (`person_id`),
  CONSTRAINT `sch_tutor_FK_1` FOREIGN KEY (`type_tutor_id`) REFERENCES `sch_type_tutor` (`id`),
  CONSTRAINT `sch_tutor_FK_2` FOREIGN KEY (`person_id`) REFERENCES `sch_person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sch_tutor` */

LOCK TABLES `sch_tutor` WRITE;

UNLOCK TABLES;

/*Table structure for table `sch_type_item` */

DROP TABLE IF EXISTS `sch_type_item`;

CREATE TABLE `sch_type_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `sch_type_item` */

LOCK TABLES `sch_type_item` WRITE;

insert  into `sch_type_item`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`name`,`description`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','RECARGAR','Es para registrar las recarga cuando se retrasen en sus respectivos pagos'),(2,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','MENSUALIDAD COLEGIO','Para las mensualidades del colegio que se debe realizar el pago mensual'),(3,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','MENSUALES','Para items que se debe realizar el pago mensual que no esea mesualidad'),(4,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','ROPA','Almuerzo escolar'),(5,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','LIBROS Y CUADERNOS','Piscina'),(6,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','CREDENCIALES','Piscina'),(7,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','OTRO','Otro');

UNLOCK TABLES;

/*Table structure for table `sch_type_tutor` */

DROP TABLE IF EXISTS `sch_type_tutor`;

CREATE TABLE `sch_type_tutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_state` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sch_type_tutor` */

LOCK TABLES `sch_type_tutor` WRITE;

insert  into `sch_type_tutor`(`id`,`id_state`,`deleted_by`,`created_at`,`updated_at`,`name`,`description`) values (1,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','MADRE','Madre de la o el estudiante.'),(2,2,NULL,'2013-01-12 07:01:58','2013-01-12 07:01:58','PADRE','Padre de la o el estudiante.');

UNLOCK TABLES;

/*Table structure for table `sf_guard_group` */

DROP TABLE IF EXISTS `sf_guard_group`;

CREATE TABLE `sf_guard_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_group_U_1` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_group` */

LOCK TABLES `sf_guard_group` WRITE;

UNLOCK TABLES;

/*Table structure for table `sf_guard_group_permission` */

DROP TABLE IF EXISTS `sf_guard_group_permission`;

CREATE TABLE `sf_guard_group_permission` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`),
  KEY `sf_guard_group_permission_FI_2` (`permission_id`),
  CONSTRAINT `sf_guard_group_permission_FK_1` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_group_permission_FK_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_group_permission` */

LOCK TABLES `sf_guard_group_permission` WRITE;

UNLOCK TABLES;

/*Table structure for table `sf_guard_permission` */

DROP TABLE IF EXISTS `sf_guard_permission`;

CREATE TABLE `sf_guard_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_permission_U_1` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_permission` */

LOCK TABLES `sf_guard_permission` WRITE;

UNLOCK TABLES;

/*Table structure for table `sf_guard_remember_key` */

DROP TABLE IF EXISTS `sf_guard_remember_key`;

CREATE TABLE `sf_guard_remember_key` (
  `user_id` int(11) NOT NULL,
  `remember_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`ip_address`),
  CONSTRAINT `sf_guard_remember_key_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_remember_key` */

LOCK TABLES `sf_guard_remember_key` WRITE;

UNLOCK TABLES;

/*Table structure for table `sf_guard_user` */

DROP TABLE IF EXISTS `sf_guard_user`;

CREATE TABLE `sf_guard_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_user_U_1` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_user` */

LOCK TABLES `sf_guard_user` WRITE;

insert  into `sf_guard_user`(`id`,`username`,`algorithm`,`salt`,`password`,`created_at`,`last_login`,`is_active`,`is_super_admin`) values (1,'fabiola','sha1','6179de7d5736335ed2f5b956e872ffad','9c80e8a8875478d8e1ae3075110d6a07920a0ef7','2013-01-12 07:01:58',NULL,1,1),(2,'cajero1','sha1','8e00612aff54541ec599aa7f956baa31','101e1361529353d2b9002f93546a31400ed69cfe','2013-01-12 07:01:58',NULL,1,0),(3,'cajero2','sha1','8cd292807d3fc76e425d01c2d61c9d09','bc82c073a0ad83a66152120059c14f2a407ed63e','2013-01-12 07:01:58',NULL,1,0),(4,'usuario1','sha1','aca6c186703da47cfd33636dd91a6731','f2f4c801b80502a3ba057fdee83b485a8185d14d','2013-01-12 07:01:58',NULL,1,0),(5,'usuario2','sha1','8dd41af1173f04edb64264fd46196585','2370c4f870608a8b5b20af36db65721e00ef170d','2013-01-12 07:01:58',NULL,1,0),(6,'usuario3','sha1','982d76e8a26dae209da0bdfcf8427f50','7b2ca23b91c640b3389e006cd9816a1722d95d57','2013-01-12 07:01:58',NULL,1,0),(7,'usuario4','sha1','bd7aa609bc1dc6c6f731c2c8481a3b95','e667d2a9408cb7b7311c47e105e9a031b4fcfc56','2013-01-12 07:01:58',NULL,1,0),(8,'usuario5','sha1','2986082e028f5b11980d747de1657ed3','222e962ff55f250581dba4bf6f216a7abd23739d','2013-01-12 07:01:58',NULL,1,0),(9,'usuario6','sha1','7a1e7ad44a9112a7c221311a225096f5','df79bc8b921827a96f5285121129694a01f62c6b','2013-01-12 07:01:58',NULL,1,0),(10,'usuario7','sha1','5b59ff911887f1681c1e4360716f5358','3ce4b0d70ab66d7364f940147a5707f2c9fed9cc','2013-01-12 07:01:58',NULL,1,0),(11,'usuario8','sha1','6db32ee9cb89e6de405b3fb4960678cc','7b954c115a58bb5cfd5039b10766eb226c96463b','2013-01-12 07:01:58',NULL,1,0),(12,'usuario9','sha1','a311139d1b7bd3ab16af892a544beb6e','034bcb61d170c5a3b566f7275a88a718ac8e8e5c','2013-01-12 07:01:58',NULL,1,0),(13,'usuario10','sha1','a92fd3039ae33e939e3b34917b29f6bc','927e8f61843cfcdfc30dfd2268ba8d79579ce356','2013-01-12 07:01:58',NULL,1,0);

UNLOCK TABLES;

/*Table structure for table `sf_guard_user_group` */

DROP TABLE IF EXISTS `sf_guard_user_group`;

CREATE TABLE `sf_guard_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `sf_guard_user_group_FI_2` (`group_id`),
  CONSTRAINT `sf_guard_user_group_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_user_group_FK_2` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_user_group` */

LOCK TABLES `sf_guard_user_group` WRITE;

UNLOCK TABLES;

/*Table structure for table `sf_guard_user_permission` */

DROP TABLE IF EXISTS `sf_guard_user_permission`;

CREATE TABLE `sf_guard_user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `sf_guard_user_permission_FI_2` (`permission_id`),
  CONSTRAINT `sf_guard_user_permission_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_user_permission_FK_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sf_guard_user_permission` */

LOCK TABLES `sf_guard_user_permission` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
