/*
SQLyog Professional v10.42 
MySQL - 5.5.5-10.1.9-MariaDB : Database - mapdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mapdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mapdb`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`username`,`password`) values ('ope','123');

/*Table structure for table `info_lokasi` */

DROP TABLE IF EXISTS `info_lokasi`;

CREATE TABLE `info_lokasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `jalan` varchar(100) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `jenis` varchar(10) DEFAULT NULL,
  `id_user` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `info_lokasi` */

insert  into `info_lokasi`(`id`,`nama`,`jalan`,`lat`,`lng`,`username`,`jenis`,`id_user`) values (49,'gereja','surabaya',-7.30083351212419,112.73727893829346,'ope','gereja',1),(50,'masjid','surabaya',-7.299471352862019,112.73749351501465,'oep','masjid',1),(51,'gereja','surabaya',-7.301386888139362,112.73719310760498,'ope','gereja',1),(52,'masjid','surabaya',-7.292958471571183,112.71161556243896,'ope','masijd',1),(53,'masjid lagi','sidoarjo',-7.369446900022521,112.70101547241211,'ope','masjid',1),(54,'Masjid apa ajalah','surabaya',-7.287594851126987,112.72436141967773,'ope','masjid',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama`) values (1,'ope');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
