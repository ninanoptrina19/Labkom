-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table labkom.data_dosen: ~10 rows (approximately)
REPLACE INTO `data_dosen` (`id`, `user_id`, `nama`, `nidn`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Dhina Puspasari Wijaya, S.Kom., M.Kom.', 526019202, 'Jalan Mgelang', '2324432', '2024-06-13 17:49:21', '2024-06-13 12:28:36'),
	(2, 3, 'Deden Hardan Gutama, S.Kom., M.Kom.', 502029201, 'klaten', '0987654', '2024-06-13 12:29:54', '2024-06-13 12:29:54'),
	(3, 4, 'Andri Pramuntadi, S.Kom., M.Kom', 525028403, 'pajangan', '09876543', '2024-06-13 12:31:16', '2024-06-13 12:31:16'),
	(4, 5, 'Dita Danianti, S.Kom., M.Kom', 530079103, 'sleman', '02233456', '2024-06-13 12:32:31', '2024-06-13 12:32:31'),
	(5, 6, 'Tri Rochmadi, S.Kom., M.Kom.', 513088901, 'sleman', '087665432', '2024-06-13 12:34:04', '2024-06-13 12:34:04'),
	(6, 7, 'Yanuar Wicaksono, S.Kom., M.Kom.', 611018301, 'sleman', '0899765432', '2024-06-13 12:37:15', '2024-06-13 12:37:15'),
	(7, 8, '(Cand). Dr. Meutia Layli, S.E., M.Ak.', 530059202, 'bantul', '0977543', '2024-06-13 12:39:08', '2024-06-13 12:39:08'),
	(8, 9, 'Dr. Kusumaningdiah Retno Setiorini, S.E.,M.Ak. Ak, CA.', 519058101, 'maguwo', '09872234', '2024-06-13 12:40:41', '2024-06-13 12:40:41'),
	(9, 10, 'Raden Jaka Sarwadhamana, S.Kep., Ns., M.P.H', 528109202, 'sleman', '0976345521', '2024-06-13 12:42:09', '2024-06-13 12:42:09'),
	(14, 19, 'Mastamah, S.Keb., MARS', 518029801, 'Kebumen', '089777122345', '2024-06-22 02:01:23', '2024-06-22 02:01:23');

-- Dumping data for table labkom.data_jadwal: ~5 rows (approximately)
REPLACE INTO `data_jadwal` (`id`, `dosen_id`, `prodi`, `penggunaan`, `laboratorium_id`, `hari`, `jam`, `tahun_akademik`, `semester`, `angkatan`, `keterangan`, `created_at`, `updated_at`) VALUES
	(3, 7, 'S1 Farmasi', 'GIZI BAYI', 1, 'Rabu', '13:30-14:40', '2024', 'GANJIL', '21', 'Praktikum hitung gizi bayi', '2024-06-13 21:35:49', '2024-06-23 15:23:26'),
	(4, 5, 'S1 Informatika', 'cloud computing', 1, 'Jumat', '10:30-12:00', '2024', 'GENAP', '21', 'Praktikum jaringan', '2024-06-13 21:37:46', '2024-06-23 16:29:08'),
	(5, 8, 'S1 Administrasi Rumah Sakit', 'kalkulus', 1, 'Selasa', '13:30-14:40', '2024', 'GENAP', '20', 'praktikum kalkulus', '2024-06-13 21:40:13', '2024-06-13 21:40:13'),
	(6, 9, 'S1 Administrasi Rumah Sakit', 'praktikum administrasi', 2, 'Senin', '13:30-14:40', '2023', 'GENAP', '20', 'kegiatan', '2024-06-16 11:11:33', '2024-06-16 11:11:33'),
	(7, 2, 'S1 Informatika', 'Study Banding', 1, 'Selasa', '08:45-10:25', '2023', 'GANJIL', '20', 'latihan', '2024-06-21 10:28:47', '2024-06-22 02:05:51');

-- Dumping data for table labkom.data_laboratorium: ~2 rows (approximately)
REPLACE INTO `data_laboratorium` (`id`, `nama`, `kapasitas`, `created_at`, `updated_at`) VALUES
	(1, 'LABORATORIUM PEMOGRAMAN', 30, '2024-06-13 17:49:50', '2024-06-13 12:43:38'),
	(2, 'LABORATORIUM BAHASA DAN MULTIMEDIA', 30, '2024-06-13 12:44:27', '2024-06-13 12:44:35');

-- Dumping data for table labkom.failed_jobs: ~0 rows (approximately)

-- Dumping data for table labkom.migrations: ~9 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_02_09_165755_create_data_dosen_table', 1),
	(7, '2024_03_28_171958_create_data_laboratorium_table', 1),
	(8, '2024_05_03_154332_create_data_jadwal_table', 1),
	(9, '2024_05_06_164548_create_data_hasil_table', 1);

-- Dumping data for table labkom.password_resets: ~0 rows (approximately)

-- Dumping data for table labkom.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table labkom.personal_access_tokens: ~0 rows (approximately)

-- Dumping data for table labkom.users: ~11 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$uwPhifjfaeiKYT/yOb1bA..WQjvktTdgSkKf/kEt6dslPJl5AaXhC', 'admin', NULL, NULL, NULL),
	(2, 'Dhina Puspasari Wijaya, S.Kom., M.Kom.', 'dhina.puspa@almaata.ac.id', NULL, '$2y$12$6ZholQf4AAdNY4YUoRaEoeP1eRZty1OOWFVNEMtrPmni8bTbiuHuK', 'dosen', NULL, '2024-06-13 10:46:22', '2024-06-13 12:28:36'),
	(3, 'Deden Hardan Gutama, S.Kom., M.Kom.', 'hardan@almaata.ac.id', NULL, '$2y$12$8z4mKq0IUgtYmQBvDI9Hr.cuSGPr2u13BrCywHL018R38R1WjtJM6', 'dosen', NULL, '2024-06-13 12:29:54', '2024-06-13 12:29:54'),
	(4, 'Andri Pramuntadi, S.Kom., M.Kom', 'andripramuntadi@almaata.ac.id', NULL, '$2y$12$pE/CrrdGFheOTGrLlXkbTO1TFWJ9tEEeeLOoGC5vBR.LWjk6Mcb6G', 'dosen', NULL, '2024-06-13 12:31:16', '2024-06-13 12:31:16'),
	(5, 'Dita Danianti, S.Kom., M.Kom', 'dita@almaata.ac.id', NULL, '$2y$12$P/cOOoOCWntTPgoYtYfSJeoKu02oqs21SNXTenmwD4RFD9nWcFWuW', 'dosen', NULL, '2024-06-13 12:32:31', '2024-06-13 12:32:31'),
	(6, 'Tri Rochmadi, S.Kom., M.Kom.', 'trirochmadi@almaata.ac.id', NULL, '$2y$12$I1kLSk6MBLZ9HxuYlWKkBeWPB4a0j83PbeTTCHc4rV4VWK1TNW7Iy', 'dosen', NULL, '2024-06-13 12:34:04', '2024-06-13 12:34:04'),
	(7, 'Yanuar Wicaksono, S.Kom., M.Kom.', 'yanuar@almaata.ac.id', NULL, '$2y$12$XV.m4whlhOfg7BD2dp8JS.cXetsI.nxR4JmpaEIqYyYahSKhSnrr2', 'dosen', NULL, '2024-06-13 12:37:15', '2024-06-13 12:37:15'),
	(8, '(Cand). Dr. Meutia Layli, S.E., M.Ak.', 'meutialayli@almaata.ac.id', NULL, '$2y$12$u5H1fRSWVEyl9mwvxzV5Yenfh2cm2jpLNnjUFuVeGXIxpVl5ptqw2', 'dosen', NULL, '2024-06-13 12:39:08', '2024-06-13 12:39:08'),
	(9, 'Dr. Kusumaningdiah Retno Setiorini, S.E.,M.Ak. Ak, CA.', 'k.retno.s@almaata.ac.id', NULL, '$2y$12$VFbQu3YEog.BMydrvINiZOWNziQli.Z9bHsC2JZyh99nmqCUnVT8G', 'dosen', NULL, '2024-06-13 12:40:40', '2024-06-13 12:40:40'),
	(10, 'Raden Jaka Sarwadhamana, S.Kep., Ns., M.P.H', 'jaka.sarwadhamana@almaata.ac.id', NULL, '$2y$12$nkAJuHQwDwpflW82IscOAu25jMPSwz4YgdqiapYQl4B1w1a3UEEam', 'dosen', NULL, '2024-06-13 12:42:09', '2024-06-21 09:37:29'),
	(19, 'Mastamah, S.Keb., MARS', 'Mastamah@almaata.ac.id', NULL, '$2y$12$7DdAxKn7bmyw1ijWaJLrkOsixX7EnDgRd75Pn0PlN603.PGV3eD8e', 'dosen', NULL, '2024-06-22 02:01:23', '2024-06-22 02:01:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
