# Host: localhost  (Version 5.5.5-10.4.24-MariaDB)
# Date: 2022-08-22 10:29:33
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "detail_penjualan"
#

DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_keluar` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

#
# Data for table "detail_penjualan"
#

INSERT INTO `detail_penjualan` VALUES (8,10,37,2000,1,2000),(9,10,36,20000,2,40000),(10,11,36,20000,2,40000),(11,11,37,2000,10,20000),(12,12,36,20000,2,40000),(13,13,36,20000,10,200000),(14,14,38,80000,1,80000),(15,15,38,80000,2,160000),(16,16,39,10500,2,21000),(17,17,38,80000,2,160000);

#
# Structure for table "detail_servis"
#

DROP TABLE IF EXISTS `detail_servis`;
CREATE TABLE `detail_servis` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_keluar` int(11) NOT NULL,
  `id_servis` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# Data for table "detail_servis"
#

INSERT INTO `detail_servis` VALUES (1,4,13,45000,45000),(2,5,20,400000,400000);

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

#
# Data for table "migrations"
#


#
# Structure for table "servis"
#

DROP TABLE IF EXISTS `servis`;
CREATE TABLE `servis` (
  `id_servis` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nm_servis` varchar(55) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_servis`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "servis"
#

INSERT INTO `servis` VALUES (13,'Ganti Oli',7000),(18,'Service Ringan',60000),(19,'Service Menengah',200000),(20,'Service Berat',400000),(22,'Pit Stop Express',500000);

#
# Structure for table "servis_keluar"
#

DROP TABLE IF EXISTS `servis_keluar`;
CREATE TABLE `servis_keluar` (
  `id_servis_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_keluar` datetime NOT NULL,
  `id_servis` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_servis_keluar`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "servis_keluar"
#

INSERT INTO `servis_keluar` VALUES (4,'2022-08-22 00:00:00',0,0,45000,'Agus'),(5,'2022-08-22 00:00:00',0,0,400000,'Firman');

#
# Structure for table "sparepart"
#

DROP TABLE IF EXISTS `sparepart`;
CREATE TABLE `sparepart` (
  `id_sparepart` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nm_sparepart` varchar(55) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  PRIMARY KEY (`id_sparepart`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

#
# Data for table "sparepart"
#

INSERT INTO `sparepart` VALUES (36,'Belt',20000,'1660537173_e8571a12665fc5d55bb5.jpg'),(37,'Rem',2000,'1660726578_1c385fee2921f133691c.jpg'),(38,'Ban',80000,'1660788023_29c67a02de329ebeaec7.jpg'),(39,'Lampu',10500,'1661138441_827914c0d236f3cf5f2b.webp');

#
# Structure for table "sparepart_keluar"
#

DROP TABLE IF EXISTS `sparepart_keluar`;
CREATE TABLE `sparepart_keluar` (
  `id_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_keluar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_keluar`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

#
# Data for table "sparepart_keluar"
#

INSERT INTO `sparepart_keluar` VALUES (10,'2022-08-16 00:00:00',42000,'Rudi'),(11,'2022-08-16 00:00:00',60000,'Reza'),(12,'2022-08-17 00:00:00',40000,'Abdul'),(13,'2022-08-17 00:00:00',200000,'Zaenal'),(14,'2022-08-18 00:00:00',80000,'Surya'),(15,'2022-08-18 00:00:00',160000,'Boni'),(16,'2022-08-18 00:00:00',21000,'Kompo'),(17,'2022-08-18 00:00:00',160000,'joko'),(18,'2022-08-22 00:00:00',60000,'Toni'),(19,'2022-08-22 00:00:00',60000,'Toni');

#
# Structure for table "sparepart_masuk"
#

DROP TABLE IF EXISTS `sparepart_masuk`;
CREATE TABLE `sparepart_masuk` (
  `id_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_masuk` datetime NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_supplier` int(50) NOT NULL,
  PRIMARY KEY (`id_masuk`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

#
# Data for table "sparepart_masuk"
#

INSERT INTO `sparepart_masuk` VALUES (7,'2022-08-15 00:00:00',35,2,13776,2),(8,'2022-08-16 00:00:00',36,3,60000,2),(9,'2022-08-17 00:00:00',36,12,240000,2),(10,'2022-08-17 00:00:00',38,270,21600000,2),(11,'2022-08-18 00:00:00',39,100,1050000,2);

#
# Structure for table "stok"
#

DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok` (
  `id_sparepart` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_sparepart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "stok"
#

INSERT INTO `stok` VALUES (35,2),(36,12),(37,0),(38,268),(39,98);

#
# Structure for table "supplier"
#

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "supplier"
#

INSERT INTO `supplier` VALUES (2,'sup 1','-','-'),(4,'CV Perdana','Tenggilis Joyo, Surabaya','031-4867589');

#
# Structure for table "user_login"
#

DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

#
# Data for table "user_login"
#

INSERT INTO `user_login` VALUES (4,'admin','$2y$10$O7zVzr0JdP7D6tTg6Plr8OEAM.rN1iaDapL/RmhtkKjSZhPuTIk9u','admin','admin');
