-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 09:45 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

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
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`id`, `id_user`, `nama`, `image`) VALUES
(2, 68, 'Nama', '1143207.jpg');

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
(16, 65, 'cover', 'diona.png');

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

--
-- Dumping data for table `cover_ultah`
--

INSERT INTO `cover_ultah` (`id`, `id_user`, `cover`, `image`) VALUES
(9, 66, 'cover', 'diona.png');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `id_user`, `nama`, `image`) VALUES
(3, 67, 'amber.png', 'kaeya.png');

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
(10, 65, 'gallery', 'cover.jpg', 'default.jpg', 'sayu2.png', 'sayu3.png', 'sayu4.png'),
(11, 66, 'gallery', 'amber.png', 'kaeya1.png', 'diona.png', 'feiyan1.png', 'noelle.png'),
(12, 67, 'gallery', 'lisa.png', 'yaemiko.png', 'keqing.png', 'sucrose.png', 'mona.png'),
(13, 68, 'gallery', '1143207.jpg', '11432071.jpg', '11432072.jpg', '11432073.jpg', '11432074.jpg');

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
  `no_hp` varchar(14) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hadiah`
--

INSERT INTO `hadiah` (`id`, `id_user`, `nama_bank`, `no_rek`, `an`, `no_hp`, `alamat`) VALUES
(15, 65, 'Bank Jateng 1', '1234563 1', 'Riza Aftoni 1', '1475145 1', 'Barito rt08/3 semarang timur jateng 1'),
(16, 66, 'Mandiri 1', '51891231615145 1', 'Angga Priyastanto 1', '', 'Jl. Pudak payung no.57  1'),
(17, 67, 'Mandiri 1', '51891231615145 1', 'Abid Khoirudin 1', '01928392834 1', 'Barito rt08/3 semarand 1'),
(19, 68, 'DANA 1', '08463419121 1', 'Afrizal Mahendra 1', '', 'jl. pwd demax 1');

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
(1, 'Undangan Pernikahan', 'Edit Tanpa Batas', 'Amplop Digital', 'Google Maps', 'Galeri Foto', 'Share WhatsApp', 'Hitung Mundur', 'Quotes', 'Background Musik', 'Aktif Selamanya', 'Rp 55.000'),
(3, 'Undangan Ulang Tahun', 'Edit Tanpa Batas', 'Amplop Digital', 'Google Maps', 'Galeri Foto', 'Share WhatsApp', 'Hitung Mundur', 'Quotes', 'Background Musik', 'Aktif Selamanya', 'Rp 30.000'),
(4, 'Undangan Halal bi Halal', 'Edit Tanpa Batas', 'Metode Pembayaran', 'Galeri Foto', 'Share WhatsApp', 'Hitung Mundur', 'Quotes', 'Background Musik', 'Aktif Selamanya', '', 'Rp 20.000'),
(5, 'Undangan Syukuran', 'Edit Tanpa Batas', 'Amplop Digital', 'Galeri Foto', 'Share WhatsApp', 'Hitung Mundur', 'Quotes', 'Background Musik', 'Aktif Selamanya', '', 'Rp 20.000');

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
(17, 65, '2022', '10', '4'),
(18, 66, '2022', '10', '5'),
(19, 67, '2022', '10', '6'),
(20, 68, '2022', '12', '5');

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

--
-- Dumping data for table `list_undangan`
--

INSERT INTO `list_undangan` (`id`, `id_user`, `nama`, `no_hp`, `status`) VALUES
(66, 65, 'Abid Ke', '12', 0),
(67, 65, 'Budi Satria', '123', 0),
(68, 65, 'Afrizal mahendra', '628156489615', 0),
(72, 66, 'Abid Khoirudin', '621928392834', 1),
(73, 66, 'Afrizal mahendra', '62845631895', 0),
(74, 66, 'Riza Utomo', '628156489615', 0),
(91, 1, '1', '2', 0),
(94, 1, 'erer', '2323', 0);

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
(13, 65, 'Akah Nikah', 'Jl. Kaligawe kota lama', 'Rumah mempelai pria', '2022-10-09', '09:58:00', '19:58', 'WIT', 'https://maps.google.com/maps?q=-6.7259222,110.7240021&z=17&hl=en', 'Resepsi', 'Jl. Miroto Semarang tengah', 'Rumah mempelai wanita', '2022-10-09', '09:59:00', '19:59', 'WITA');

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

--
-- Dumping data for table `lok_ultah`
--

INSERT INTO `lok_ultah` (`id`, `id_user`, `judul_acara`, `alamat`, `nm_lokasi`, `tgl_acara`, `w_mulai`, `w_selesai`, `z_waktu`, `sharelok`) VALUES
(20, 66, 'Ulang Tahun 123s', 'Jl. pedurungan km.6 no8', 'Hotel dafam', '2022-10-10', '20:52:00', '21:52:00', 'WIT', 'https://maps.google.com/maps?q=-6.7259222,110.7240021&z=17&hl=en');

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
(7, 65, '1. Assassination_Classroom_Tabidachi_no_Uta_Lyrics', 'Alia_-_かくれんぼMV.mp3'),
(8, 66, 'Assassination_Classroom_Tabidachi_no_Uta_Lyrics_Te', 'Radwimps_-_Theme_of_Mitsuha.mp3'),
(9, 67, 'Alia_-_かくれんぼMV.mp3', 'YOASOBI_-_Yoru_ni_kakeru.mp3'),
(10, 68, 'Alia_-_かくれんぼMV.mp3', 'Joe_Inoue_CLOSER.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `nm_halal`
--

CREATE TABLE `nm_halal` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_grub` varchar(100) NOT NULL,
  `judul_acara` varchar(100) NOT NULL,
  `tgl_acara` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `zona_waktu` varchar(100) NOT NULL,
  `nm_lokasi` varchar(100) NOT NULL,
  `alamat_lengkap` varchar(100) NOT NULL,
  `sharelok` varchar(300) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nm_halal`
--

INSERT INTO `nm_halal` (`id`, `id_user`, `nama_grub`, `judul_acara`, `tgl_acara`, `waktu`, `zona_waktu`, `nm_lokasi`, `alamat_lengkap`, `sharelok`, `image`) VALUES
(2, 67, 'Tobanga Squad1', 'Halal bi halal', '2022-10-05', '09:14', 'WIT', 'Bikini Bottom', 'Jl. jogja km7 solo', 'sgd', 'diona.png');

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
  `urutan_pria` varchar(50) NOT NULL,
  `i_pria` varchar(50) NOT NULL,
  `np_wanita` varchar(100) NOT NULL,
  `nl_wanita` varchar(100) NOT NULL,
  `na_wanita` varchar(100) NOT NULL,
  `ni_wanita` varchar(100) NOT NULL,
  `i_wanita` varchar(50) NOT NULL,
  `urutan_wanita` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `image2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nm_mempelai`
--

INSERT INTO `nm_mempelai` (`id`, `id_user`, `np_pria`, `nl_pria`, `na_pria`, `ni_pria`, `urutan_pria`, `i_pria`, `np_wanita`, `nl_wanita`, `na_wanita`, `ni_wanita`, `i_wanita`, `urutan_wanita`, `image`, `image2`) VALUES
(32, 65, 'Abid', 'Abid Khoirudin 1', 'Yaksha 1', 'Adeptus', 'Pertama', '@abid_khoirudin89 1', 'Putri 1', 'Putri Wulandari 1', 'OZ 1', 'Dara 1', '@Putriaselole87 1', 'Ketiga', 'amber.png', 'diona.png');

-- --------------------------------------------------------

--
-- Table structure for table `nm_syukuran`
--

CREATE TABLE `nm_syukuran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nm_panggilan` varchar(100) NOT NULL,
  `nm_lengkap` varchar(100) NOT NULL,
  `jenkel` varchar(100) NOT NULL,
  `tgl_acara` varchar(100) NOT NULL,
  `w_mulai` varchar(100) NOT NULL,
  `w_selesai` varchar(100) NOT NULL,
  `z_waktu` varchar(100) NOT NULL,
  `nm_lokasi` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `sharelok` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nm_syukuran`
--

INSERT INTO `nm_syukuran` (`id`, `id_user`, `nm_panggilan`, `nm_lengkap`, `jenkel`, `tgl_acara`, `w_mulai`, `w_selesai`, `z_waktu`, `nm_lokasi`, `alamat`, `sharelok`, `image`) VALUES
(2, 68, 'Afrizal', 'Afrizal Mahendra 1', 'Putri', '2022-10-09', '08:13', '13:13', 'WITA', 'Rumah Pak Hendra 1', 'Jl. grobogan demak rt08/02 1', '', 'amber.png');

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
  `jenis_kelamin` varchar(50) NOT NULL,
  `urutan` varchar(50) NOT NULL,
  `ultah_ke` int(11) NOT NULL,
  `uc_tambahan` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nm_ultah`
--

INSERT INTO `nm_ultah` (`id`, `id_user`, `nama`, `nama_lengkap`, `nm_ayah`, `nm_ibu`, `jenis_kelamin`, `urutan`, `ultah_ke`, `uc_tambahan`, `image`) VALUES
(37, 66, 'Angga', 'Angga Priyastanto', 'Hashirama Senju', 'Uzumaki Senji', 'Putra', 'Pertama', 18, 'Semoga panjang umur dan naik ranking 1 :)', 'bennett1.png');

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

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_user`, `nama_pengirim`, `tanggal`, `image`, `status`) VALUES
(9, 65, 'Riza Aftoni', '1664774670', 'invoice.jpg', 'Lunas'),
(10, 66, 'Riza Aftoni', '1664801753', 'ada-2047-juta-pengguna-internet-di-indonesia-awal-2022-by-katadata2.png', 'Menunggu Verifikasi'),
(11, 67, 's', '1664860237', 'diona.png', 'Menunggu Pembayaran'),
(12, 68, 'Riza Aftoni', '1665026944', '', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `quotes_halal`
--

CREATE TABLE `quotes_halal` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hadir_tidak` varchar(50) NOT NULL,
  `ucapan` varchar(50) NOT NULL
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
(62, 65, 'Afrizal mahendra', 'Hadir', '                              selamat ya bid!!!                                                     '),
(63, 65, 'Budi Wibowo', 'Tidak Hadir', '                               hadir bid                                                            '),
(67, 65, 'Rizky Utomo', 'Akan Hadir', 'aselole'),
(68, 68, 'Abid Khoirudin', 'Hadir', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `quotes_syukuran`
--

CREATE TABLE `quotes_syukuran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hadir_tidak` varchar(100) NOT NULL,
  `ucapan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes_syukuran`
--

INSERT INTO `quotes_syukuran` (`id`, `id_user`, `nama`, `hadir_tidak`, `ucapan`) VALUES
(1, 68, 'asdas', 'Hadir', 'dadasd');

-- --------------------------------------------------------

--
-- Table structure for table `quotes_ultah`
--

CREATE TABLE `quotes_ultah` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hadir_tidak` varchar(50) NOT NULL,
  `ucapan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `template_halal`
--

CREATE TABLE `template_halal` (
  `id` int(11) NOT NULL,
  `nama_template` varchar(50) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_halal`
--

INSERT INTO `template_halal` (`id`, `nama_template`, `gambar`, `slug`) VALUES
(1, 'desan 1', 'd1.png', 'undangan'),
(2, 'desain 2', 'd2.png', 'undangan2');

-- --------------------------------------------------------

--
-- Table structure for table `template_pernikahan`
--

CREATE TABLE `template_pernikahan` (
  `id` int(11) NOT NULL,
  `nama_template` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_pernikahan`
--

INSERT INTO `template_pernikahan` (`id`, `nama_template`, `gambar`, `slug`, `active`) VALUES
(1, 'Desain 1', 'd2.png', 'undangan', 1),
(2, 'Desain 2', 'd1.png', 'undangan2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `template_syukuran`
--

CREATE TABLE `template_syukuran` (
  `id` int(11) NOT NULL,
  `nama_template` varchar(100) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_syukuran`
--

INSERT INTO `template_syukuran` (`id`, `nama_template`, `gambar`, `slug`, `active`) VALUES
(1, 'desain 1', 'd1.png', 'undangan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `template_ultah`
--

CREATE TABLE `template_ultah` (
  `id` int(11) NOT NULL,
  `nama_template` varchar(50) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_ultah`
--

INSERT INTO `template_ultah` (`id`, `nama_template`, `gambar`, `slug`, `active`) VALUES
(1, 'desain 1', 'd1.png', 'undangan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `template_user`
--

CREATE TABLE `template_user` (
  `id` int(11) NOT NULL,
  `id_template` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_user`
--

INSERT INTO `template_user` (`id`, `id_template`, `id_user`) VALUES
(2, 1, 11),
(4, 2, 61),
(5, 3, 62),
(6, 1, 65),
(7, 1, 66),
(8, 1, 67),
(9, 1, 68);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `no_rek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `bank`, `no_rek`) VALUES
(1, 'BRI', '33648942151621');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ulasan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_user`, `ulasan`) VALUES
(8, 65, 'Aplikasi mudah digunakan :)'),
(9, 66, 'fitur cukup lengkap!'),
(10, 67, 'aplikasi bagus!');

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
(1, 'Adeptus', 'progaming99.as48@gmail.com', 'amber.png', '$2y$10$9Kl7MmTMVMzDKoiBfw3AjO33aJnfLeMgkZkwwTHcaWFPDtTB72qZy', 1, 1, 1657855641),
(65, 'Abid Khoirudin', 'gimpact20211@gmail.com', 'images.jpg', '$2y$10$CWEZgn7lhVgxNtyIRJqfE.piTBXWTaGs63gfPKBNMCR5LwaKh9wrK', 3, 1, 1664763964),
(66, 'Afrizal mahendra', 'gimpact20212@gmail.com', 'beidou.png', '$2y$10$J/G5di0j.gprNPH077rkU.nfX9HqLfukGGFiR3Fkcycnpd97bR8pS', 2, 1, 1664786239),
(67, 'Riza', 'gimpact20213@gmail.com', 'default.jpg', '$2y$10$nm7o9cqphV.03WaxUci26uti/cwU4QicHnnIA5LupBSEnEWkYwb6m', 3, 1, 1664856614),
(68, 'Afrizal', 'gimpact202111@gmail.com', 'bennett.png', '$2y$10$pyTAEulzCnLWYmImrGwGBe.2PIPyVOa6GpwlzFlaM9ewnpWglwFRC', 3, 1, 1664942872);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `user_id`, `menu_id`) VALUES
(1, 1, 11, 1),
(14, 1, 11, 5),
(18, 2, 61, 6),
(47, 1, 11, 8),
(48, 2, 61, 8),
(49, 1, 11, 10),
(73, 1, 11, 7),
(76, 2, 61, 7),
(77, 2, 61, 11),
(78, 2, 61, 10),
(80, 1, 11, 6),
(81, 1, 11, 12),
(82, 1, 11, 3),
(83, 1, 11, 11),
(84, 2, 61, 12),
(86, 2, 61, 14),
(87, 2, 61, 15),
(88, 2, 61, 16),
(90, 1, 11, 2),
(91, 1, 11, 14),
(93, 1, 11, 21),
(94, 1, 11, 15),
(96, 2, 61, 23),
(106, 2, 0, 2),
(107, 61, 0, 2),
(109, 3, 0, 2),
(110, 3, 0, 14),
(111, 3, 0, 15),
(113, 3, 0, 17),
(114, 3, 0, 18),
(116, 3, 0, 16),
(117, 3, 0, 19),
(118, 3, 0, 20),
(119, 3, 0, 23),
(124, 61, 0, 11),
(139, 2, 0, 25),
(140, 2, 0, 26),
(141, 1, 0, 25),
(142, 1, 0, 26),
(143, 2, 0, 27),
(144, 3, 0, 25),
(145, 3, 0, 26),
(146, 3, 0, 27),
(147, 3, 0, 28),
(148, 2, 0, 29),
(149, 3, 0, 29),
(150, 2, 0, 30),
(151, 3, 0, 30),
(152, 3, 0, 31);

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
(16, 'DashboardPernikahan'),
(18, 'Upernikahan'),
(19, 'UUlangtahun'),
(21, 'User_Admin'),
(23, 'DashboardUltah'),
(25, 'Halalbihalal'),
(26, 'Syukuran'),
(27, 'DashboardHalal'),
(28, 'UHalalbihalal'),
(29, 'DashboardSyukuran'),
(30, 'Dashboard'),
(31, 'USyukuran');

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
(2, 'Member'),
(3, 'Acc');

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
(54, 14, 'Daftar Mempelai', 'admin/daftar_mempelai', 'fa-solid fa-folder-tree', 1),
(55, 15, 'Daftar User', 'admin/daftar_ultah', 'fa-solid fa-address-card', 1),
(56, 17, 'Daftar User', 'admin/daftar_lainnya', 'fa-solid fa-address-card', 1);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `foto`
--
ALTER TABLE `foto`
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
-- Indexes for table `nm_halal`
--
ALTER TABLE `nm_halal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nm_mempelai`
--
ALTER TABLE `nm_mempelai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nm_syukuran`
--
ALTER TABLE `nm_syukuran`
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
-- Indexes for table `quotes_halal`
--
ALTER TABLE `quotes_halal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes_pernikahan`
--
ALTER TABLE `quotes_pernikahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes_syukuran`
--
ALTER TABLE `quotes_syukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes_ultah`
--
ALTER TABLE `quotes_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_halal`
--
ALTER TABLE `template_halal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_pernikahan`
--
ALTER TABLE `template_pernikahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_syukuran`
--
ALTER TABLE `template_syukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_ultah`
--
ALTER TABLE `template_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_user`
--
ALTER TABLE `template_user`
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
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cover_pernikahan`
--
ALTER TABLE `cover_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cover_ultah`
--
ALTER TABLE `cover_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hitung_mundur`
--
ALTER TABLE `hitung_mundur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `list_undangan`
--
ALTER TABLE `list_undangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `lok_mempelai`
--
ALTER TABLE `lok_mempelai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lok_ultah`
--
ALTER TABLE `lok_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `musik_pernikahan`
--
ALTER TABLE `musik_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nm_halal`
--
ALTER TABLE `nm_halal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nm_mempelai`
--
ALTER TABLE `nm_mempelai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nm_syukuran`
--
ALTER TABLE `nm_syukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nm_ultah`
--
ALTER TABLE `nm_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quotes_halal`
--
ALTER TABLE `quotes_halal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes_pernikahan`
--
ALTER TABLE `quotes_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `quotes_syukuran`
--
ALTER TABLE `quotes_syukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotes_ultah`
--
ALTER TABLE `quotes_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `template_halal`
--
ALTER TABLE `template_halal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_pernikahan`
--
ALTER TABLE `template_pernikahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_syukuran`
--
ALTER TABLE `template_syukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_ultah`
--
ALTER TABLE `template_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_user`
--
ALTER TABLE `template_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
