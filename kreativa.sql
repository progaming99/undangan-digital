-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 01:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kreativa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cover_pernikahan`
--

CREATE TABLE `cover_pernikahan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cover_pernikahan`
--

INSERT INTO `cover_pernikahan` (`id`, `id_user`, `cover`, `image`) VALUES
(13, 60, 'cover', 'Qiqi.png');

-- --------------------------------------------------------

--
-- Table structure for table `cover_ultah`
--

CREATE TABLE `cover_ultah` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `image2` varchar(50) NOT NULL,
  `image3` varchar(50) NOT NULL,
  `image4` varchar(50) NOT NULL,
  `image5` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `id_user`, `nama`, `image`, `image2`, `image3`, `image4`, `image5`) VALUES
(3, 60, 'gallery', 'chongyun.png', 'xingqiu.png', 'amber.png', 'diona.png', 'bennett.png');

-- --------------------------------------------------------

--
-- Table structure for table `hadiah`
--

CREATE TABLE `hadiah` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `an` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hadiah`
--

INSERT INTO `hadiah` (`id`, `id_user`, `nama_bank`, `no_rek`, `an`, `alamat`) VALUES
(7, 60, 'Bank Jateng', '123456789', 'Ayaka', 'Jl. Inazuma liyue');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id` int(11) NOT NULL,
  `nama_undangan` varchar(50) NOT NULL,
  `fitur1` varchar(50) NOT NULL,
  `fitur2` varchar(50) NOT NULL,
  `fitur3` varchar(50) NOT NULL,
  `fitur4` varchar(50) NOT NULL,
  `fitur5` varchar(50) NOT NULL,
  `fitur6` varchar(50) NOT NULL,
  `fitur7` varchar(50) NOT NULL,
  `fitur8` varchar(50) NOT NULL,
  `fitur9` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id`, `nama_undangan`, `fitur1`, `fitur2`, `fitur3`, `fitur4`, `fitur5`, `fitur6`, `fitur7`, `fitur8`, `fitur9`, `harga`) VALUES
(1, 'Undangan Pernikahan', 'Edit Tanpa Batas', 'Amplop Digital', 'Google Maps', 'Galeri Foto', 'Share WhatsApp', 'Hitung Mundur', 'Quotes', 'Background Musik', 'Aktif Selamanya', 'Rp 85.000'),
(3, 'Undangan Ulang Tahun', 'Edit Tanpa Batas', 'Amplop Digital', 'Google Maps', 'Galeri Foto', 'Share WhatsApp', 'Hitung Mundur', 'Quotes', 'Background Musik', 'Aktif Selamanya', 'Rp 50.000'),
(4, 'Undangan Halal bi Halal', 'xx', 'xx', 'xx', 'xx', 'x', 'xx', 'xx', 'xx', 'xx', 'Rp 50.000'),
(5, 'Undangan Coming Soon', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx');

-- --------------------------------------------------------

--
-- Table structure for table `hitung_mundur`
--

CREATE TABLE `hitung_mundur` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hitung_mundur`
--

INSERT INTO `hitung_mundur` (`id`, `id_user`, `tahun`, `bulan`, `hari`) VALUES
(9, 60, '2022', '8', '29');

-- --------------------------------------------------------

--
-- Table structure for table `list_pernikahan`
--

CREATE TABLE `list_pernikahan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `list_undangan`
--

CREATE TABLE `list_undangan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lok_mempelai`
--

CREATE TABLE `lok_mempelai` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_acara` varchar(100) NOT NULL,
  `alamat_acara` varchar(100) NOT NULL,
  `nm_lokasi` varchar(100) NOT NULL,
  `tgl_pernikahan` date NOT NULL,
  `w_mulai` time NOT NULL,
  `w_selesai` varchar(100) NOT NULL,
  `z_waktu` varchar(100) NOT NULL,
  `sharelok` varchar(300) NOT NULL,
  `judul_acara2` varchar(100) NOT NULL,
  `alamat_acara2` varchar(100) NOT NULL,
  `nm_lokasi2` varchar(100) NOT NULL,
  `tgl_pernikahan2` date NOT NULL,
  `w_mulai2` time NOT NULL,
  `w_selesai2` varchar(100) NOT NULL,
  `z_waktu2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lok_mempelai`
--

INSERT INTO `lok_mempelai` (`id`, `id_user`, `judul_acara`, `alamat_acara`, `nm_lokasi`, `tgl_pernikahan`, `w_mulai`, `w_selesai`, `z_waktu`, `sharelok`, `judul_acara2`, `alamat_acara2`, `nm_lokasi2`, `tgl_pernikahan2`, `w_mulai2`, `w_selesai2`, `z_waktu2`) VALUES
(10, 60, 'Akah Nikah', 'Jalan liyue', 'Rumah zhongli', '2022-08-28', '07:46:00', '12:46', 'WIT', 'https://maps.google.com/maps?q=-6.7259222,110.7240021&z=17&hl=en', 'Resepsi', 'Jalan inazuma', 'Rumah tenrou commition', '2022-08-31', '09:47:00', '22:47', 'WIT');

-- --------------------------------------------------------

--
-- Table structure for table `lok_ultah`
--

CREATE TABLE `lok_ultah` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_acara` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nm_lokasi` varchar(100) NOT NULL,
  `tgl_acara` date NOT NULL,
  `w_mulai` time NOT NULL,
  `w_selesai` time NOT NULL,
  `z_waktu` varchar(100) NOT NULL,
  `sharelok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `musik_pernikahan`
--

CREATE TABLE `musik_pernikahan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `musik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `musik_pernikahan`
--

INSERT INTO `musik_pernikahan` (`id`, `id_user`, `nama`, `musik`) VALUES
(3, 60, 'Qiqi ya', 'Radwimps_-_Theme_of_Mitsuha.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `nm_mempelai`
--

CREATE TABLE `nm_mempelai` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `np_pria` varchar(100) NOT NULL,
  `nl_pria` varchar(100) NOT NULL,
  `na_pria` varchar(100) NOT NULL,
  `ni_pria` varchar(100) NOT NULL,
  `i_pria` varchar(50) NOT NULL,
  `np_wanita` varchar(100) NOT NULL,
  `nl_wanita` varchar(100) NOT NULL,
  `na_wanita` varchar(100) NOT NULL,
  `ni_wanita` varchar(100) NOT NULL,
  `i_wanita` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `image2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nm_mempelai`
--

INSERT INTO `nm_mempelai` (`id`, `id_user`, `np_pria`, `nl_pria`, `na_pria`, `ni_pria`, `i_pria`, `np_wanita`, `nl_wanita`, `na_wanita`, `ni_wanita`, `i_wanita`, `image`, `image2`) VALUES
(28, 60, 'sayu', 'sayu chan', 'zhongli', 'ningguang', '@sayu99', 'qiqi', 'qiqi the zombie', 'childe', 'ganyu', '@qiqi11', 'sayu.png', 'Qiqi.png');

-- --------------------------------------------------------

--
-- Table structure for table `nm_ultah`
--

CREATE TABLE `nm_ultah` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nm_ayah` varchar(50) NOT NULL,
  `nm_ibu` varchar(50) NOT NULL,
  `ultah_ke` int(11) NOT NULL,
  `uc_tambahan` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quotes_pernikahan`
--

CREATE TABLE `quotes_pernikahan` (
  `id` int(11) NOT NULL,
  `id_user` int(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hadir_tidak` varchar(100) NOT NULL,
  `ucapan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes_pernikahan`
--

INSERT INTO `quotes_pernikahan` (`id`, `id_user`, `nama`, `hadir_tidak`, `ucapan`) VALUES
(19, 0, 'Qiqi', 'Hadir', 'hallo selamat');

-- --------------------------------------------------------

--
-- Table structure for table `quotes_ultah`
--

CREATE TABLE `quotes_ultah` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hadir_tidak` varchar(50) NOT NULL,
  `ucapan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `no_rek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ulasan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES
(11, 'Adeptus', 'progaming99.as48@gmail.com', 'ningguang1.png', '$2y$10$9Kl7MmTMVMzDKoiBfw3AjO33aJnfLeMgkZkwwTHcaWFPDtTB72qZy', 1, 1, 1657855641),
(60, 'Sayu', 'gimpact20211@gmail.com', 'default.jpg', '$2y$10$VwIGjIJ.UzqzEfPyvovlKOnpVpMDVw5cG576A939EpfyWpb53y2HC', 2, 1, 1661586242);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(14, 1, 5),
(18, 2, 6),
(30, 2, 2),
(47, 1, 8),
(48, 2, 8),
(49, 1, 10),
(73, 1, 7),
(76, 2, 7),
(77, 2, 11),
(78, 2, 10),
(80, 1, 6),
(81, 1, 12),
(82, 1, 3),
(83, 1, 11),
(84, 2, 12),
(86, 2, 14),
(87, 2, 15),
(88, 2, 16),
(89, 2, 17),
(90, 1, 2),
(91, 1, 14),
(92, 2, 18),
(93, 1, 21),
(94, 1, 15),
(95, 1, 17),
(96, 2, 23),
(97, 2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(14, 'Pernikahan'),
(15, 'UlangTahun'),
(16, 'Dashboard'),
(17, 'Lainnya'),
(18, 'Upernikahan'),
(19, 'UUlangtahun'),
(20, 'Ulainnya'),
(21, 'User_Admin'),
(23, 'DashboardUltah');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-id-card', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-cog', 1),
(9, 2, 'Ganti Password', 'user/gantipassword', 'fas fa-fw fa-key', 1),
(24, 5, 'Testimonial', 'testimonial/index', 'fas fa-fw fa-quote-right', 1),
(34, 7, 'Hitung Mundur', 'user/mundur', 'fas fa-fw fa-stopwatch-20', 1),
(40, 7, 'Data Mempelai', 'pernikahan', 'fab fa-facebook', 1),
(43, 10, 'Data Ulang Tahun', 'ulangtahun', 'fab fa-facebook', 1),
(46, 11, 'Beranda', 'dashboard', 'fab fa-facebook', 1),
(47, 10, 'Pengaturan', 'ulangtahun/pengaturan', 'fas fa-paint-roller', 1),
(48, 10, 'Lihat Undangan', 'ulangtahun/hasil', 'fas fa-paint-roller', 1),
(49, 7, 'Pengaturan', 'pernikahan/pengaturan', 'fab fa-facebook', 1),
(50, 7, 'Lihat Undangan', 'pernikahan/hasil', 'fab fa-facebook', 1),
(51, 7, 'List Undangan', 'pernikahan/list_undangan', 'fas fa-paint-roller', 1),
(52, 21, 'profile', 'user_admin', 'fa-solid fa-address-card', 1),
(53, 3, 'Status Pembayaran', 'menu/status_pembayaran', 'fa-solid fa-money-bills', 1),
(54, 14, 'Daftar Mempelai', 'admin/daftar_mempelai', 'fa-solid fa-folder-tree', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(49, 'genshinimpact20211@gmail.com', 'VzTVdgwhARSdK8vVvveSDtklBdvYmiO5DR3dOqffo40=', 1661585674);

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`ip`, `date`, `hits`, `online`, `time`) VALUES
('::1', '2021-01-31', 38, '1612116883', '2021-01-31 16:53:32'),
('::1', '2021-02-02', 5, '1612296086', '2021-02-02 17:59:59'),
('::1', '2021-02-03', 5, '1612373921', '2021-02-03 17:38:02'),
('::1', '2021-02-04', 30, '1612475072', '2021-02-04 19:39:45'),
('::1', '2021-02-07', 6, '1612719909', '2021-02-07 18:30:58'),
('::1', '2021-02-21', 2, '1613934944', '2021-02-21 20:15:23'),
('::1', '2021-03-11', 183, '1615498017', '2021-03-11 13:40:05'),
('::1', '2021-03-12', 10, '1615573533', '2021-03-12 12:05:12'),
('::1', '2021-03-13', 13, '1615670927', '2021-03-13 15:11:26'),
('::1', '2021-03-14', 79, '1615743862', '2021-03-14 15:19:51'),
('::1', '2021-04-03', 78, '1617481949', '2021-04-03 12:14:11'),
('::1', '2021-04-04', 59, '1617551599', '2021-04-04 11:18:58'),
('::1', '2021-04-05', 162, '1617653314', '2021-04-05 09:59:44'),
('::1', '2021-04-06', 38, '1617725397', '2021-04-06 08:26:55'),
('::1', '2021-04-07', 2, '1617813544', '2021-04-07 17:00:21'),
('::1', '2021-04-08', 30, '1617907783', '2021-04-08 10:33:53'),
('::1', '2021-04-09', 1, '1617985706', '2021-04-09 18:28:26'),
('::1', '2021-04-10', 6, '1618074492', '2021-04-10 17:40:20'),
('::1', '2021-04-11', 23, '1618165599', '2021-04-11 07:20:56'),
('::1', '2021-04-12', 32, '1618259070', '2021-04-12 09:32:49'),
('::1', '2021-04-13', 2, '1618345822', '2021-04-13 17:50:45'),
('::1', '2021-04-14', 7, '1618430687', '2021-04-14 20:14:32'),
('::1', '2021-04-15', 5, '1618508111', '2021-04-15 18:12:43'),
('::1', '2021-04-16', 18, '1618606217', '2021-04-16 00:31:35'),
('::1', '2021-04-18', 3, '1618769464', '2021-04-18 19:47:03'),
('::1', '2021-04-19', 1, '1618857157', '2021-04-19 20:32:37'),
('::1', '2022-07-15', 1, '1657900004', '2022-07-15 17:46:44'),
('::1', '2022-07-16', 20, '1657985312', '2022-07-16 04:12:56'),
('::1', '2022-07-17', 18, '1658071467', '2022-07-17 01:07:53'),
('::1', '2022-07-18', 47, '1658144942', '2022-07-18 00:40:37'),
('::1', '2022-07-19', 14, '1658239386', '2022-07-19 01:12:41'),
('::1', '2022-07-20', 105, '1658326074', '2022-07-20 00:42:51'),
('::1', '2022-07-21', 8, '1658413503', '2022-07-21 09:56:14'),
('::1', '2022-07-22', 8, '1658518625', '2022-07-22 00:22:03'),
('::1', '2022-07-23', 2, '1658570905', '2022-07-23 12:07:25'),
('::1', '2022-07-25', 8, '1658764295', '2022-07-25 15:01:06'),
('::1', '2022-07-30', 1, '1659148189', '2022-07-30 04:29:49'),
('::1', '2022-07-31', 5, '1659251640', '2022-07-31 09:04:34'),
('::1', '2022-08-01', 1, '1659352265', '2022-08-01 13:11:05'),
('::1', '2022-08-08', 9, '1659942660', '2022-08-08 07:19:52'),
('::1', '2022-08-09', 25, '1660060926', '2022-08-09 07:48:54'),
('::1', '2022-08-10', 6, '1660134123', '2022-08-10 06:23:18'),
('::1', '2022-08-12', 3, '1660289207', '2022-08-12 05:52:55'),
('::1', '2022-08-13', 1, '1660360452', '2022-08-13 05:14:12'),
('::1', '2022-08-14', 15, '1660487684', '2022-08-14 06:06:06'),
('::1', '2022-08-15', 1, '1660546863', '2022-08-15 09:01:03'),
('::1', '2022-08-16', 1, '1660646092', '2022-08-16 12:34:52'),
('::1', '2022-08-23', 3, '1661223449', '2022-08-23 04:30:57'),
('::1', '2022-08-25', 1, '1661431468', '2022-08-25 14:44:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cover_pernikahan`
--
ALTER TABLE `cover_pernikahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cover_ultah`
--
ALTER TABLE `cover_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitung_mundur`
--
ALTER TABLE `hitung_mundur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_pernikahan`
--
ALTER TABLE `list_pernikahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_undangan`
--
ALTER TABLE `list_undangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lok_mempelai`
--
ALTER TABLE `lok_mempelai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lok_ultah`
--
ALTER TABLE `lok_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `musik_pernikahan`
--
ALTER TABLE `musik_pernikahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nm_mempelai`
--
ALTER TABLE `nm_mempelai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nm_ultah`
--
ALTER TABLE `nm_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `quotes_pernikahan`
--
ALTER TABLE `quotes_pernikahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes_ultah`
--
ALTER TABLE `quotes_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cover_pernikahan`
--
ALTER TABLE `cover_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cover_ultah`
--
ALTER TABLE `cover_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hitung_mundur`
--
ALTER TABLE `hitung_mundur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `list_pernikahan`
--
ALTER TABLE `list_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_undangan`
--
ALTER TABLE `list_undangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `lok_mempelai`
--
ALTER TABLE `lok_mempelai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lok_ultah`
--
ALTER TABLE `lok_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `musik_pernikahan`
--
ALTER TABLE `musik_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nm_mempelai`
--
ALTER TABLE `nm_mempelai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nm_ultah`
--
ALTER TABLE `nm_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotes_pernikahan`
--
ALTER TABLE `quotes_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quotes_ultah`
--
ALTER TABLE `quotes_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
