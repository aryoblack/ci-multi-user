#
# TABLE STRUCTURE FOR: aplikasi
#

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

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES (1, 'Nama owner', 'JL. Rawabali', '0812-9936-9059', 'Aplikasi Penjualan', 'Nama Aplikasi', 'AdminLTELogo1.png', 'Copy Right &copy;', '1.0.0.0', '2020');


#
# TABLE STRUCTURE FOR: barang
#

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kdbarang` varchar(15) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# TABLE STRUCTURE FOR: kategori
#

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kat` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# TABLE STRUCTURE FOR: tbl_akses_menu
#

DROP TABLE IF EXISTS `tbl_akses_menu`;

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES (1, 1, 1, 'Y');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES (2, 1, 2, 'Y');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES (43, 4, 1, 'Y');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES (44, 4, 2, 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES (62, 5, 1, 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES (63, 5, 2, 'N');


#
# TABLE STRUCTURE FOR: tbl_akses_submenu
#

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (7, 1, 8, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (13, 1, 14, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (26, 1, 15, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (30, 1, 17, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (32, 1, 18, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (34, 1, 19, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (36, 1, 20, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (59, 4, 1, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (60, 4, 2, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (61, 4, 7, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (62, 4, 8, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (63, 4, 10, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (64, 4, 15, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (65, 4, 17, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (66, 4, 18, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (67, 4, 19, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (68, 4, 20, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (72, 5, 1, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (73, 5, 2, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (74, 5, 7, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (75, 5, 8, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (76, 5, 10, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (77, 5, 15, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (78, 5, 17, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (79, 5, 18, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (80, 5, 19, 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES (81, 5, 20, 'N', 'N', 'N', 'N', 'N', 'N');


#
# TABLE STRUCTURE FOR: tbl_menu
#

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', '1', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (2, 'System', '#', 'fas fa-cogs', '2', 'Y', 'Y');


#
# TABLE STRUCTURE FOR: tbl_submenu
#

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (1, 'Menu', 'menu', 'far fa-circle', 2, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (2, 'SubMenu', 'submenu', 'far fa-circle', 2, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (7, 'Aplikasi', 'aplikasi', 'far fa-circle', 2, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (8, 'User', 'user', 'far fa-circle', 2, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (10, 'User Level', 'userlevel', 'far fa-circle', 2, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (15, 'Barang', 'barang', 'far fa-circle', 32, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (17, 'Kategori', 'kategori', 'far fa-circle', 32, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (18, 'Satuan', 'satuan', 'far fa-circle', 32, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (19, 'Pembelian', 'pembelian', 'far fa-circle', 41, 'Y');
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES (20, 'Penjualan', 'penjualan', 'far fa-circle', 41, 'Y');


#
# TABLE STRUCTURE FOR: tbl_user
#

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `is_active`) VALUES (1, 'admin', 'Administrator', '$2y$05$3oQlxl8wMGd8VecO4nFXre3SjeHWqFN79oMy/.pdEj5Q89xopj4oi', 1, 'admin1.jpg', 'Y');
INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `is_active`) VALUES (6, 'user', 'user satu', '$2y$05$3bEkbUWiTCavpM5FUUKbu.wdclj8vvsTgy58WSiS7Jje6i3XgZCC6', 4, 'user.jpg', 'Y');


#
# TABLE STRUCTURE FOR: tbl_userlevel
#

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (1, 'admin');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (4, 'kasir');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (5, 'amanah');


