-- -------------------------------------------------------------
-- TablePlus 6.1.6(570)
--
-- https://tableplus.com/
--
-- Database: mathstoodent
-- Generation Time: 2024-09-30 21:09:01.7400
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagihan_id` int(11) NOT NULL,
  `waktu` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `wali` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE `tagihan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` int(11) NOT NULL,
  `bulan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `biaya` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(42, '2024-09-12-062659', 'App\\Database\\Migrations\\Users', 'default', 'App', 1727370053, 1),
(43, '2024-09-12-073608', 'App\\Database\\Migrations\\Siswa', 'default', 'App', 1727370053, 1),
(44, '2024-09-12-074216', 'App\\Database\\Migrations\\Tagihan', 'default', 'App', 1727370053, 1),
(45, '2024-09-13-121715', 'App\\Database\\Migrations\\Pembayaran', 'default', 'App', 1727370053, 1);

INSERT INTO `siswa` (`id`, `name`, `wali`, `whatsapp`) VALUES
(1, 'Ichwan', 'Ahmad', '085876106683');

INSERT INTO `tagihan` (`id`, `siswa_id`, `bulan`, `tahun`, `biaya`, `status`) VALUES
(1, 1, '01', '2024', 200000, 'belum lunas');

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `siswa_id`) VALUES
(1, 'Admin', 'mathstoodent', '$2y$10$wOIXaDzAtpec17dpMHFCAOmZL00zPrkb6SxIibwrHwutsYPwqem5.', 'admin', NULL),
(2, 'Ahmad', '085876106683', '$2y$10$QSIiuV0SakqE2WupgmFuSeg1XZDhIutyl.JDyYkz6C8w5Vd.ssxx.', 'wali', 1);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;