-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.7.1-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table tiket_event.event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_berakhir` time DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` enum('Y','N','D') NOT NULL DEFAULT 'Y',
  `gambar` varchar(255) NOT NULL,
  `kategori_event_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_event_kategori_event` (`kategori_event_id`),
  KEY `FK_event_petugas` (`petugas_id`),
  CONSTRAINT `FK_event_kategori_event` FOREIGN KEY (`kategori_event_id`) REFERENCES `kategori_event` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_event_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.event: ~6 rows (approximately)
DELETE FROM `event`;
INSERT INTO `event` (`id`, `nama`, `deskripsi`, `tanggal`, `waktu_mulai`, `waktu_berakhir`, `alamat`, `status`, `gambar`, `kategori_event_id`, `petugas_id`, `created_at`, `updated_at`) VALUES
	(1, 'Hanabi Matsuri', '-', '2024-01-07', '10:00:00', '20:00:00', 'Hypermart Pal 7', 'Y', 'public/uploads/images/hanabi.jpg', 4, 3, '2023-12-31 07:54:51', '2024-02-24 03:47:32'),
	(4, 'KING PROMISE - Live in Concert', 'King Promise is a young Ghanaian artist and songwriter. His budding talent considers himself a versatile artist, quickly becoming an international phenomenon, who falls in the Afrobeats, Highlife, R&B and Hip-Hop genres.', '2024-05-03', '21:00:00', '02:00:00', 'Bengkel Space, SCBD, DKI Jakarta', 'Y', 'public/uploads/images/1707443891_34b30ffc5fa969a6e9d0.jpg', 1, 1, '2024-02-09 01:58:11', '2024-02-24 03:41:05'),
	(5, 'Japanese Musical - Hyakunen no Ie Monogatari (Satu Atap, Seratus Tahun, Seribu Kisah)', 'Japanese Musical - Hyakunen no Ie Monogatari (Satu Atap, Seratus Tahun, Seribu Kisah) merupakan drama musical kedua dari SHiN DORAMA PROJECT. Kisah kali ini akan berlangsung kurang lebih selama 2 jam (akan ada interval/break 15 menit).\r\n日本語ミュージカル 「百年の家物語」は、シン・ドラマプロジェクトの2作目で、上演時間は2時間です。（途中15分の休憩あり）。\r\n', '2024-02-17', '16:00:00', '21:00:00', 'Salihara Art Theater, DKI Jakarta', 'Y', 'public/uploads/images/1707444680_15c40c45fee6355f99dc.jpg', 1, 1, '2024-02-09 02:11:20', '2024-02-24 03:41:07'),
	(6, 'Jeff Bernat Asia Tour 2024', 'Finally the wait is over!! Penyanyi R&B Filipina-Amerika, Jeff Bernat, akan menggelar konser Asia Tour pertamanya di beberapa negara di Asia termasuk Indonesia yang bertajuk "Jeff Bernat Asia Tour 2024”. Are you ready to sing "Call You Mine", "Still", "Cruel", "Wrong About Forever" dan lagu hits Jeff Bernat lainnya? Secure your ticket fast, this is an intimate concert with limited capacity. For more information follow Intagram @otelloasia', '2024-03-03', '20:00:00', '22:00:00', 'Bengkel, SCBD Jakarta, DKI Jakarta', 'Y', 'public/uploads/images/1707444878_31e40278ad879fd1f5e4.png', 1, 1, '2024-02-09 02:14:38', '2024-02-24 03:41:08'),
	(7, 'Time Capsule (Arcadaz 6th Anniversary)', 'The Journey of an Marvelous Era, "Time Capsule" \r\n\r\nArcadaz Lounge & Bar present the 6th Anniversary with love.\r\n\r\nFariz RM Live intimate concert, opening by Naughty Boys Band,\r\n\r\nand afterparty with Guling & House Of Yahya\r\n\r\nFriday, 16 February 2024 only on Arcadaz Lounge & Bar (5th Floor Gramm Hotel Yogyakarta)\r\n\r\nGet your Ticket now!\r\n\r\nInfo & Table Package RSVP : 0878 3572 2278', '2024-02-16', '20:00:00', '02:30:00', 'Arcadaz Lounge & Bar (5th Floor Gramm Hotel Yogyakarta)', 'Y', 'public/uploads/images/1707445032_d4d42227351332bfafcf.jpg', 1, 1, '2024-02-09 02:17:12', '2024-02-24 03:41:10'),
	(8, 'coba', 'coba saja', '2024-01-11', '10:00:00', '15:00:00', 'alamat', 'Y', 'public/uploads/images/1708746240_c8eee98b63f5304f835b.jpg', 1, 1, '2024-02-24 03:44:00', NULL);

-- Dumping structure for table tiket_event.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `feedback` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__event` (`event_id`),
  KEY `FK_feedback_transaksi` (`transaksi_id`),
  CONSTRAINT `FK__event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_feedback_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.feedback: ~2 rows (approximately)
DELETE FROM `feedback`;
INSERT INTO `feedback` (`id`, `event_id`, `transaksi_id`, `rating`, `feedback`) VALUES
	(2, 1, 17, 5, 'Rekomended tempat beli tiket'),
	(3, 7, 19, 5, 'Rekomended tempat beli tiket');

-- Dumping structure for table tiket_event.kategori_event
CREATE TABLE IF NOT EXISTS `kategori_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.kategori_event: ~4 rows (approximately)
DELETE FROM `kategori_event`;
INSERT INTO `kategori_event` (`id`, `nama`) VALUES
	(1, 'Konser Musik'),
	(2, 'Seminar'),
	(4, 'Expo');

-- Dumping structure for table tiket_event.metode_pembayaran
CREATE TABLE IF NOT EXISTS `metode_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_metode` varchar(255) NOT NULL,
  `nomor_metode` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.metode_pembayaran: ~2 rows (approximately)
DELETE FROM `metode_pembayaran`;
INSERT INTO `metode_pembayaran` (`id`, `nama_metode`, `nomor_metode`, `atas_nama`) VALUES
	(1, 'BRI', '6123123123', 'Tiket Online'),
	(2, 'BNI', '5123123123', 'Tiket Online'),
	(4, 'BCA', '234341', 'Tiket Online');

-- Dumping structure for table tiket_event.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `waktu_pembayaran` datetime DEFAULT NULL,
  `status` enum('wait_for_payment','cancel','paid','wait_for_confirmation','req_refund','refund') NOT NULL,
  `metode_pembayaran_id` int(11) NOT NULL,
  `atas_nama_pengirim` varchar(255) DEFAULT '',
  `no_rek_pengirim` varchar(255) DEFAULT '',
  `metode_pembayaran_pengirim` varchar(255) DEFAULT '',
  `bukti_pembayaran` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_pembayaran_metode_pembayaran` (`metode_pembayaran_id`),
  KEY `FK_pembayaran_transaksi` (`transaksi_id`),
  CONSTRAINT `FK_pembayaran_metode_pembayaran` FOREIGN KEY (`metode_pembayaran_id`) REFERENCES `metode_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.pembayaran: ~4 rows (approximately)
DELETE FROM `pembayaran`;
INSERT INTO `pembayaran` (`id`, `transaksi_id`, `waktu_pembayaran`, `status`, `metode_pembayaran_id`, `atas_nama_pengirim`, `no_rek_pengirim`, `metode_pembayaran_pengirim`, `bukti_pembayaran`) VALUES
	(3, 16, '2024-01-17 23:22:01', 'refund', 1, 'Bernardius', '73198237978', 'BRI', 'public/uploads/images/1705555321_5a53f4736d296d0427bf.jpg'),
	(4, 17, '2024-01-17 23:26:28', 'paid', 1, 'SUrya', '73198237978', 'BRI', 'public/uploads/images/1705555588_14b7043688cdba712f04.jpg'),
	(5, 18, '2024-01-17 23:28:03', 'paid', 4, 'SUrya', '73198237978', 'BRI', 'public/uploads/images/1705555683_29cbe84fabd132a07470.jpg'),
	(6, 19, '2024-02-08 20:36:12', 'paid', 1, 'Bernardius', '731276876', 'BRI', 'public/uploads/images/1707446172_47c4d385de8089738d29.png');

-- Dumping structure for table tiket_event.pembeli
CREATE TABLE IF NOT EXISTS `pembeli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.pembeli: ~4 rows (approximately)
DELETE FROM `pembeli`;
INSERT INTO `pembeli` (`id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`) VALUES
	(1, 'bernardinus', '0852', 'bernardinus@mail.com', 'L', '1997-01-03'),
	(19, 'Bernardius', '0822', 'bernardinus@mail.com', 'L', '2000-12-31'),
	(20, 'Bernardius', '', 'bernardinus@mail.com', 'P', '2000-10-10'),
	(21, 'Bernardius', '0822', 'bernardinus@mail.com', 'L', '2000-02-20'),
	(22, 'Bernardius', '0822', 'bernar@mail.com', 'L', '2000-01-01');

-- Dumping structure for table tiket_event.petugas
CREATE TABLE IF NOT EXISTS `petugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.petugas: ~1 rows (approximately)
DELETE FROM `petugas`;
INSERT INTO `petugas` (`id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`) VALUES
	(1, 'Bernardius', '0822xx', 'bernardius@mail.com', 'L', '2000-01-01'),
	(3, 'Dimas', '0822xx', 'dimas@mail.com', 'L', '2000-01-01');

-- Dumping structure for table tiket_event.tiket_event
CREATE TABLE IF NOT EXISTS `tiket_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `harga` bigint(20) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tiket_event_event` (`event_id`),
  CONSTRAINT `FK_tiket_event_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.tiket_event: ~6 rows (approximately)
DELETE FROM `tiket_event`;
INSERT INTO `tiket_event` (`id`, `nama`, `harga`, `stok`, `deskripsi`, `event_id`) VALUES
	(1, 'Reguler', 45000, 100, '-', 1),
	(2, 'VIP', 65000, 110, '-', 1),
	(3, 'Normal', 399000, 1000, 'Get First Drink', 4),
	(4, 'SHOW', 200000, 100, '-', 5),
	(5, 'Early Bird', 100000, 50, '-', 7),
	(6, 'GA Ticket + Drink', 150000, 50, 'Tiket masuk harga normal yang termasuk 1 minuman soft drink / beer', 7);

-- Dumping structure for table tiket_event.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pembeli_id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('paid','wait_for_payment','cancel','refund','wait_for_confirmation','req_refund') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_transaksi_pembeli` (`pembeli_id`),
  CONSTRAINT `FK_transaksi_pembeli` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.transaksi: ~4 rows (approximately)
DELETE FROM `transaksi`;
INSERT INTO `transaksi` (`id`, `pembeli_id`, `kode`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
	(16, 19, 'Mwte1iGJ', '2024-01-17 23:20:20', 'refund', '2024-01-18 13:20:20', '2024-02-26 13:09:54'),
	(17, 20, 'mbiNLDaM', '2024-01-16 23:26:16', 'paid', '2024-01-16 13:26:16', '2024-01-30 11:23:26'),
	(18, 21, 'k0wFBS9q', '2024-02-17 23:27:45', 'paid', '2024-01-18 13:27:45', '2024-01-30 11:26:06'),
	(19, 22, 'DNnjTItK', '2024-02-08 20:31:52', 'paid', '2024-02-09 10:31:52', '2024-02-09 10:38:29');

-- Dumping structure for table tiket_event.transaksi_detail
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `tiket_event_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_transaksi_detail_tiket_event` (`tiket_event_id`),
  KEY `FK_transaksi_detail_transaksi` (`transaksi_id`),
  CONSTRAINT `FK_transaksi_detail_tiket_event` FOREIGN KEY (`tiket_event_id`) REFERENCES `tiket_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_transaksi_detail_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.transaksi_detail: ~4 rows (approximately)
DELETE FROM `transaksi_detail`;
INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `tiket_event_id`, `quantity`, `sub_total`) VALUES
	(6, 16, 2, 5, 325000),
	(7, 17, 1, 5, 225000),
	(8, 18, 2, 4, 260000),
	(9, 19, 5, 1, 100000);

-- Dumping structure for table tiket_event.transaksi_refund
CREATE TABLE IF NOT EXISTS `transaksi_refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `status` enum('refund','req_refund','reject') NOT NULL,
  `alasan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.transaksi_refund: ~0 rows (approximately)
DELETE FROM `transaksi_refund`;
INSERT INTO `transaksi_refund` (`id`, `transaksi_id`, `status`, `alasan`, `created_at`, `updated_at`) VALUES
	(3, 16, 'refund', 'batal beli, berhalangan ', '2024-02-26 05:02:28', '2024-02-26 05:09:54'),
	(4, 16, 'req_refund', 'batal beli, berhalangan', '2024-02-26 05:08:10', NULL);

-- Dumping structure for table tiket_event.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tiket_event.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `petugas_id`) VALUES
	(1, 'admin', '$2a$10$Sas5AQx.GnV.vuBaLGMHq.Nt8YbsgJCjg5ZuMvFWMhs4bQztpaxKS', 'admin', NULL),
	(2, 'petugas2', '$2y$10$sAWtiFkBpe9417p31sAvbekxc0BJtJiHfhcrjHnRwrZM5vbMgm8/W', 'petugas', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
