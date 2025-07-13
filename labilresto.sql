-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 07:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labilresto`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `bahan_id` int(10) UNSIGNED NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `stok` int(12) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`bahan_id`, `nama_bahan`, `satuan`, `stok`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wortel', 'pcs', 5, '2025-07-12 07:08:26', '2025-07-13 17:08:12', NULL),
(2, 'Telur Ayam', 'pcs', 300, '2025-07-12 08:53:47', '2025-07-12 08:53:47', NULL),
(10, 'Margarin', 'gram', 1800, '2025-07-12 09:19:52', '2025-07-13 17:08:12', NULL),
(11, 'Cabe Merah', 'gram', 4850, '2025-07-12 09:20:19', '2025-07-13 17:08:12', NULL),
(12, 'Cabe Hijau', 'gram', 4850, '2025-07-12 09:20:33', '2025-07-13 17:08:12', NULL),
(13, 'Beras', 'gram', 19700, '2025-07-12 09:20:58', '2025-07-13 17:08:12', NULL),
(15, 'Minyak Goreng', 'mililiter', 4800, '2025-07-12 09:21:55', '2025-07-13 17:08:12', NULL),
(16, 'Ayam', 'pcs', 39, '2025-07-12 09:22:22', '2025-07-13 17:08:12', NULL),
(17, 'Jeruk Takengoen', 'pcs', 38, '2025-07-13 10:06:22', '2025-07-13 17:08:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(5) UNSIGNED NOT NULL,
  `pelapor` varchar(128) NOT NULL DEFAULT 'Anonim',
  `no_telp` varchar(15) NOT NULL DEFAULT '-',
  `detail` text NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 = baru, 1 = diproses, 2 = selesai',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `meja_id` int(10) UNSIGNED NOT NULL,
  `nomor_meja` varchar(10) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `status` enum('kosong','digunakan','reservasi') DEFAULT 'kosong',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`meja_id`, `nomor_meja`, `keterangan`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '6 Orang', 'kosong', '2025-07-12 10:59:22', '2025-07-13 10:11:53', NULL),
(2, '2', '6 Orang', 'kosong', '2025-07-12 14:21:17', '2025-07-13 09:59:50', NULL),
(3, '3', '4 Orang', 'kosong', '2025-07-12 14:21:26', '2025-07-13 10:00:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `kategori` enum('makanan','minuman') NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `nama_menu`, `harga`, `kategori`, `deskripsi`, `foto`, `is_available`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wortel Goreng', '20000.00', 'makanan', 'Wortel Digoreng Saja', '1752426207_3ad985a0c546b922d580.webp', 1, '2025-07-12 08:34:01', '2025-07-13 10:13:58', NULL),
(2, 'Jus Wortel', '12000.00', 'minuman', 'Jus Segar Sangat  Bila Di Nikmati Dengan Pasangan', '1752426218_483505ff904722bddd71.webp', 1, '2025-07-12 08:42:46', '2025-07-13 10:13:58', NULL),
(3, 'Ayam Geprek', '32000.00', 'makanan', 'Ayam Geprek Resep Aceh', '1752426308_01defb8059ec81832878.webp', 1, '2025-07-13 10:05:08', '2025-07-13 10:13:58', NULL),
(4, 'Jus Jeruk', '14000.00', 'minuman', 'Jus Jeruk Takengoen Segar', '1752426423_5dd7c46f6945e7ef0a7d.webp', 1, '2025-07-13 10:07:03', '2025-07-13 10:13:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_bahan`
--

CREATE TABLE `menu_bahan` (
  `id` int(11) NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `bahan_id` int(10) UNSIGNED DEFAULT NULL,
  `jumlah` int(12) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_bahan`
--

INSERT INTO `menu_bahan` (`id`, `menu_id`, `bahan_id`, `jumlah`, `satuan`) VALUES
(8, 1, 1, 3, NULL),
(9, 2, 1, 2, NULL),
(10, 3, 16, 1, NULL),
(11, 3, 11, 150, NULL),
(12, 3, 10, 200, NULL),
(13, 3, 12, 150, NULL),
(14, 3, 13, 300, NULL),
(15, 3, 15, 200, NULL),
(16, 4, 17, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-08-15-135538', 'App\\Database\\Migrations\\User', 'default', 'App', 1750856242, 1),
(2, '2023-08-15-140301', 'App\\Database\\Migrations\\Complaint', 'default', 'App', 1750856242, 1),
(3, '2023-08-21-083229', 'App\\Database\\Migrations\\UserTokens', 'default', 'App', 1750856242, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `pesanan_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `meja_id` int(10) UNSIGNED DEFAULT NULL,
  `meja_nomor` varchar(10) DEFAULT NULL,
  `status` enum('menunggu','diproses','dimasak','siap','selesai','batal') DEFAULT 'menunggu',
  `total` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`pesanan_id`, `user_id`, `meja_id`, `meja_nomor`, `status`, `total`, `created_at`, `updated_at`) VALUES
(11, 8, 1, '1', 'selesai', '32000.00', '2025-07-12 12:00:16', '2025-07-12 13:53:06'),
(12, 8, 2, '2', 'selesai', '32000.00', '2025-07-12 14:23:44', '2025-07-12 14:51:13'),
(13, 10, 1, '1', 'selesai', '40000.00', '2025-07-13 09:37:50', '2025-07-13 09:45:30'),
(14, 10, 1, '1', 'selesai', '60000.00', '2025-07-13 09:48:01', '2025-07-13 09:59:35'),
(15, 10, 2, '2', 'selesai', '72000.00', '2025-07-13 09:54:11', '2025-07-13 09:59:50'),
(16, 10, 3, '3', 'selesai', '52000.00', '2025-07-13 09:57:06', '2025-07-13 10:00:23'),
(17, 10, 1, '1', 'selesai', '78000.00', '2025-07-13 10:08:12', '2025-07-13 10:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `detail_id` int(11) NOT NULL,
  `pesanan_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`detail_id`, `pesanan_id`, `menu_id`, `qty`, `subtotal`) VALUES
(13, 11, 1, 1, '20000.00'),
(14, 11, 2, 1, '12000.00'),
(15, 12, 1, 1, '20000.00'),
(16, 12, 2, 1, '12000.00'),
(17, 13, 1, 1, '20000.00'),
(18, 13, 1, 1, '20000.00'),
(19, 14, 1, 3, '60000.00'),
(20, 15, 1, 3, '60000.00'),
(21, 15, 2, 1, '12000.00'),
(22, 16, 1, 2, '40000.00'),
(23, 16, 2, 1, '12000.00'),
(24, 17, 3, 1, '32000.00'),
(25, 17, 1, 1, '20000.00'),
(26, 17, 2, 1, '12000.00'),
(27, 17, 4, 1, '14000.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `pesanan_id` int(10) UNSIGNED DEFAULT NULL,
  `kasir_id` int(10) UNSIGNED DEFAULT NULL,
  `total_bayar` int(10) DEFAULT NULL,
  `metode_pembayaran` enum('cash','qris','transfer') DEFAULT 'cash',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `pesanan_id`, `kasir_id`, `total_bayar`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 11, NULL, 32000, 'cash', '2025-07-12 13:53:06', '2025-07-12 13:53:06'),
(2, 12, 8, 32000, 'cash', '2025-07-12 14:51:13', '2025-07-12 14:51:13'),
(3, 13, 14, 40000, 'cash', '2025-07-13 09:45:30', '2025-07-13 09:45:30'),
(4, 14, 14, 60000, 'cash', '2025-07-13 09:59:35', '2025-07-13 09:59:35'),
(5, 15, 14, 72000, 'cash', '2025-07-13 09:59:50', '2025-07-13 09:59:50'),
(6, 16, 14, 52000, 'cash', '2025-07-13 10:00:23', '2025-07-13 10:00:23'),
(7, 17, 13, 78000, 'cash', '2025-07-13 10:11:53', '2025-07-13 10:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(1) NOT NULL DEFAULT 1 COMMENT '1: owner, 2: kasir, 3: chef, 4: pelanggan',
  `is_active` int(1) NOT NULL DEFAULT 0 COMMENT '0: not active, 1: active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `email`, `password`, `user_level`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'AL MUZZAMMIL', 'muzammilkw07@gmail.com', '$2y$10$eIvHFDIwu5PtnmeekKMkB.ADVsRRa5IBQ4wdLvwCmFrDfZnyB6JNC', 4, 1, '2025-06-25 06:15:48', '2025-07-13 15:25:23', NULL),
(10, 'LABIL', 'jamilkw77@gmail.com', '$2y$10$J4feVsdHLmmesoPX1BrS2em9MtT2oPj1Pqzo5wwuHXk6jqTeQtyVG', 4, 1, '2025-07-13 08:33:50', '2025-07-13 08:34:19', NULL),
(11, 'OWNER', 'owner@gmail.com', '$2y$10$fzS5wB9ChtrDJbGrGiu0mOP1SImntMQ21wV7cSo9ysUq3cErjY3ra', 1, 1, '2025-07-13 08:35:59', '2025-07-13 15:37:34', NULL),
(12, 'CHEF', 'chef@gmail.com', '$2y$10$uCZA0JH3qQjWC4I1t9zDl.jdWIk/pMSExxLrqf7pbvRLJSanX3jHC', 3, 1, '2025-07-13 08:36:20', '2025-07-13 15:37:31', NULL),
(13, 'KASIR', 'kasir@gmail.com', '$2y$10$WeO9g/tG9Rv1yIBfPwKk3.Mf6wnRXETXKDI6dG74nvBJEx3g32qMC', 2, 1, '2025-07-13 08:36:44', '2025-07-13 15:37:27', NULL),
(14, 'Rizka', 'rizka@gmail.com', '$2y$10$WqQ/4vw8rYjodxAhtxvDieFDdxycoL.6qTKjuQD9jA3oCNobKsUrm', 2, 1, '2025-07-13 08:48:49', '2025-07-13 08:48:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `user_token_id` int(5) UNSIGNED NOT NULL,
  `user_id` int(5) UNSIGNED NOT NULL,
  `token` varchar(64) NOT NULL,
  `expire_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`user_token_id`, `user_id`, `token`, `expire_at`) VALUES
(5, 11, 'b5f0c0650a5172bbcabdf63ccdb9043847491b4b1489ecc3f70c29f8bcd046e9', '2025-07-13 16:05:59'),
(6, 12, 'ddd723fe536145f8cba0b301f0e9a86b0f39911c79b5fde8531b2f86c2fc58ce', '2025-07-13 16:06:20'),
(7, 13, '17a9b4a3c1b6997213038e6b96675842d6a864938c0b95c5fefc1d058acc483f', '2025-07-13 16:06:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`meja_id`),
  ADD UNIQUE KEY `nomor_meja` (`nomor_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_bahan`
--
ALTER TABLE `menu_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `bahan_id` (`bahan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`pesanan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_meja_id` (`meja_id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `kasir_id` (`kasir_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`user_token_id`),
  ADD KEY `user_tokens_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `bahan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `meja_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_bahan`
--
ALTER TABLE `menu_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `pesanan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `user_token_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_bahan`
--
ALTER TABLE `menu_bahan`
  ADD CONSTRAINT `menu_bahan_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `menu_bahan_ibfk_2` FOREIGN KEY (`bahan_id`) REFERENCES `bahan_baku` (`bahan_id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_meja_id` FOREIGN KEY (`meja_id`) REFERENCES `meja` (`meja_id`),
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`pesanan_id`),
  ADD CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`pesanan_id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kasir_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
