/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.13-MariaDB : Database - multi-user
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`multi-user` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `multi-user`;

/*Table structure for table `aplikasi` */

DROP TABLE IF EXISTS `aplikasi`;

CREATE TABLE `aplikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `aplikasi` */

insert  into `aplikasi`(`id`,`nama_owner`,`alamat`,`tlp`,`title`,`nama_aplikasi`,`logo`,`copy_right`,`versi`,`tahun`) values 
(1,'Nama owner','JL. Rawabali','0812-9936-9059','Aplikasi Penjualan','Nama Aplikasi','AdminLTELogo1.png','Copy Right &copy;','1.0.0.0',2020);

/*Table structure for table `tbl_akses_menu` */

DROP TABLE IF EXISTS `tbl_akses_menu`;

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses_menu` */

insert  into `tbl_akses_menu`(`id`,`id_level`,`id_menu`,`view_level`) values 
(1,1,1,'Y'),
(2,1,2,'Y'),
(13,2,1,'Y'),
(14,2,2,'N'),
(17,1,32,'Y'),
(18,2,32,'N'),
(35,1,41,'Y'),
(36,2,41,'Y'),
(37,3,1,'Y'),
(38,3,2,'Y'),
(39,3,32,'N'),
(40,3,41,'N');

/*Table structure for table `tbl_akses_submenu` */

DROP TABLE IF EXISTS `tbl_akses_submenu`;

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses_submenu` */

insert  into `tbl_akses_submenu`(`id`,`id_level`,`id_submenu`,`view_level`,`add_level`,`edit_level`,`delete_level`,`print_level`,`upload_level`) values 
(2,1,2,'Y','Y','Y','Y','Y','Y'),
(4,1,1,'Y','Y','Y','Y','Y','Y'),
(6,1,7,'Y','Y','Y','Y','Y','Y'),
(7,1,8,'Y','Y','Y','Y','Y','Y'),
(9,1,10,'Y','Y','Y','Y','Y','Y'),
(13,1,14,'Y','Y','Y','Y','Y','Y'),
(26,1,15,'Y','Y','Y','Y','Y','Y'),
(30,1,17,'Y','Y','Y','Y','Y','Y'),
(32,1,18,'Y','Y','Y','Y','Y','Y'),
(34,1,19,'Y','Y','Y','Y','Y','Y'),
(36,1,20,'Y','Y','Y','Y','Y','Y'),
(38,2,1,'N','N','N','N','N','N'),
(39,2,2,'N','N','N','N','N','N'),
(40,2,7,'N','N','N','N','N','N'),
(41,2,8,'N','N','N','N','N','N'),
(42,2,10,'N','N','N','N','N','N'),
(43,2,15,'N','N','N','N','N','N'),
(44,2,17,'N','N','N','N','N','N'),
(45,2,18,'N','N','N','N','N','N'),
(46,2,19,'Y','N','N','N','N','N'),
(47,2,20,'N','N','N','N','N','N'),
(48,3,1,'N','N','N','N','N','N'),
(49,3,2,'N','N','N','N','N','N'),
(50,3,7,'Y','N','N','N','N','N'),
(51,3,8,'N','N','N','N','N','N'),
(52,3,10,'N','N','N','N','N','N'),
(53,3,15,'N','N','N','N','N','N'),
(54,3,17,'N','N','N','N','N','N'),
(55,3,18,'N','N','N','N','N','N'),
(56,3,19,'N','N','N','N','N','N'),
(57,3,20,'N','N','N','N','N','N');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`id_menu`,`nama_menu`,`link`,`icon`,`urutan`,`is_active`,`parent`) values 
(1,'Dashboard','dashboard','fas fa-tachometer-alt',1,'N','Y'),
(2,'System','#','fas fa-cogs',2,'Y','Y'),
(32,'Data Master','#','fas fa-database',3,'Y','Y'),
(41,'Transaksi','#','fa fa-exchange-alt',4,'Y','Y');

/*Table structure for table `tbl_submenu` */

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_submenu` */

insert  into `tbl_submenu`(`id_submenu`,`nama_submenu`,`link`,`icon`,`id_menu`,`is_active`) values 
(1,'Menu','menu','far fa-circle',2,'Y'),
(2,'SubMenu','submenu','far fa-circle',2,'Y'),
(7,'Aplikasi','aplikasi','far fa-circle',2,'Y'),
(8,'User','user','far fa-circle',2,'Y'),
(10,'User Level','userlevel','far fa-circle',2,'Y'),
(15,'Barang','barang','far fa-circle',32,'Y'),
(17,'Kategori','kategori','far fa-circle',32,'Y'),
(18,'Satuan','satuan','far fa-circle',32,'Y'),
(19,'Pembelian','pembelian','far fa-circle',41,'Y'),
(20,'Penjualan','penjualan','far fa-circle',41,'Y');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`username`,`full_name`,`password`,`id_level`,`image`,`is_active`) values 
(1,'admin','Administrator','$2y$05$3oQlxl8wMGd8VecO4nFXre3SjeHWqFN79oMy/.pdEj5Q89xopj4oi',1,'admin1.jpg','Y'),
(4,'user','user satu','$2y$05$Ok3CXwfQRtyQPlTVGLoqteRwQBGZEG9/8x9R1CS5uNkiyY40YryYG',2,'user.png','Y'),
(5,'user1','user satu','$2y$05$DRVcQlQYXw7PzhKxyJUEd.b6pay8/KsElNlfDJ0KpbYFqahEp9ka2',3,'user11.png','Y');

/*Table structure for table `tbl_userlevel` */

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_userlevel` */

insert  into `tbl_userlevel`(`id_level`,`nama_level`) values 
(1,'admin'),
(2,'user'),
(3,'user 1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
