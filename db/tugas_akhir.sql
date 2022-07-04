-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Bulan Mei 2022 pada 05.07
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bendahara`
--

CREATE TABLE `bendahara` (
  `id_bendahara` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(255) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `bendahara`
--

INSERT INTO `bendahara` (`id_bendahara`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(149764, 'Pengasuh', 'pengasuh@gmail.com', '1634055042117.jpg', '$2y$10$qV1UskdPE/MISrVUqAS2V.OhWL9HGo1rEgvcxUnlEvgcYTzQVD2L2', 2, 1, 1634055042),
(483806, 'Dani Lukman Hakim', 'dhanispeed90@yahoo.co.id', '1651690518314.png', '$2y$10$sjPrxBpeFs438dZD3F67MOgd3Ub0dNvYhobdIUok1HFmkIC61BnMG', 1, 1, 1651690518),
(547310, 'sasdads', 'danilukman2206@gmail.com', '1651690547426.jpg', '$2y$10$Z8Qj1M0XUBR0g92cBk8cGuDrKNCevRTxZHLPHbv.EpxpQPagm0j26', 1, 1, 1651690547),
(551737, 'dani', 'hakim2206@gmail.com', NULL, '$2y$10$VO/fGHqzHck51ieeOoqVN.m5UFJL4RIhF2qA0dByBEVaI1q6Umo5i', 1, 1, 1629293242);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nama_bulan` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
('01', 'Januari'),
('02', 'Februari'),
('03', 'Maret'),
('04', 'April'),
('05', 'Mei'),
('06', 'Juni'),
('07', 'Juli'),
('08', 'Agustus'),
('09', 'September'),
('10', 'Oktober'),
('11', 'November'),
('12', 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hapus_transaksi`
--

CREATE TABLE `hapus_transaksi` (
  `id_hapus` int(11) NOT NULL,
  `id_transaksi` varchar(12) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `id_bulan` varchar(5) NOT NULL,
  `id_tahun` varchar(5) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `id_bendahara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hapus_transaksi`
--

INSERT INTO `hapus_transaksi` (`id_hapus`, `id_transaksi`, `nis`, `id_bulan`, `id_tahun`, `tanggal_bayar`, `id_bendahara`) VALUES
(235, 'SPP-21032200', '18070030', '06', '19', '2022-03-21', 483806),
(236, 'SPP-21032200', '18070030', '07', '19', '2022-03-21', 483806),
(237, 'SPP-25032200', '18070029', '03', '60', '2022-03-25', 483806),
(238, 'SPP-25032200', '18070029', '04', '60', '2022-03-25', 483806),
(239, 'SPP-15042200', '18070029', '05', '60', '2022-04-15', 483806),
(240, 'SPP-15042200', '18070029', '06', '60', '2022-04-15', 483806),
(241, 'SPP-15042200', '18070029', '03', '60', '2022-04-15', 483806),
(242, 'SPP-15042200', '18070029', '04', '60', '2022-04-15', 483806),
(243, 'SPP-15042200', '18070029', '03', '60', '2022-04-15', 483806),
(244, 'SPP-15042200', '18070029', '04', '60', '2022-04-15', 483806);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_ngaji`
--

CREATE TABLE `jenis_ngaji` (
  `id_ngaji` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_ngaji`
--

INSERT INTO `jenis_ngaji` (`id_ngaji`, `jenis`) VALUES
(1, 'Juz \'Amma'),
(2, 'Surat 7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id` int(11) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id`, `jenis_pembayaran`, `date_created`) VALUES
(25, 'daftar ulang', 1623768816),
(56, 'pembayaran', 1610132545),
(79, 'Mawar Blok B NO 1', 1647440310),
(92, 'pembayaran khataman', 1610132585);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `uang_masuk` float NOT NULL,
  `uang_keluar` float NOT NULL,
  `jenis_kas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kas`
--

INSERT INTO `kas` (`id_kas`, `tgl_transaksi`, `keterangan`, `uang_masuk`, `uang_keluar`, `jenis_kas`) VALUES
(153, '2020-12-24', 'buat beli', 0, 200000, 'Kas Keluar'),
(2134, '2021-01-26', 'poiiii', 0, 200000, 'Kas Keluar'),
(3872, '2020-12-31', 'buat beli sabun', 100000, 0, 'Kas Masuk'),
(5042, '2021-01-26', 'sampoooo', 800000, 0, 'Kas Masuk'),
(5361, '2020-12-24', 'buat beli sabun', 100000, 0, 'Kas Masuk'),
(7419, '2021-01-26', 'poiiii', 500000, 0, 'Kas Masuk'),
(7832, '2021-08-18', 'buat beli sabun', 800000, 0, 'Kas Masuk'),
(8163, '2021-01-11', 'sampoooo', 800000, 0, 'Kas Masuk'),
(8319, '2020-12-24', 'buat beli', 100000, 0, 'Kas Masuk'),
(9206, '2021-08-24', 'dari sodara ade rohmat', 100000, 0, 'Kas Masuk'),
(9332, '2021-01-26', 'sampo', 0, 200000, 'Kas Keluar'),
(10209, '2021-01-11', 'sampo', 0, 200000, 'Kas Keluar'),
(13914, '2021-08-18', 'buat', 0, 200000, 'Kas Keluar'),
(84784, '2021-08-24', 'untuk membeli sapu', 0, 50000, 'Kas Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_bulanan`
--

CREATE TABLE `pembayaran_bulanan` (
  `id_pem_bulan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `jenis_pembayaran` varchar(225) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_bulanan`
--

INSERT INTO `pembayaran_bulanan` (`id_pem_bulan`, `nis`, `jenis_pembayaran`, `tahun_ajaran`) VALUES
(2099, 18070030, 'Spp Bulanan', '2021'),
(2100, 18070031, 'Spp Bulanan', '2021'),
(2101, 18070032, 'Spp Bulanan', '2021'),
(2102, 18070034, 'Spp Bulanan', '2021'),
(2103, 18070035, 'Spp Bulanan', '2021'),
(2104, 18070036, 'Spp Bulanan', '2021'),
(2105, 18070037, 'Spp Bulanan', '2021'),
(2106, 18070038, 'Spp Bulanan', '2021'),
(2107, 18070039, 'Spp Bulanan', '2021'),
(2108, 18070040, 'Spp Bulanan', '2021'),
(2109, 18070041, 'Spp Bulanan', '2021'),
(2110, 18070042, 'Spp Bulanan', '2021'),
(2111, 18070043, 'Spp Bulanan', '2021'),
(2112, 18070044, 'Spp Bulanan', '2021'),
(2113, 18070045, 'Spp Bulanan', '2021'),
(2114, 18070046, 'Spp Bulanan', '2021'),
(2115, 18070047, 'Spp Bulanan', '2021'),
(2116, 18070048, 'Spp Bulanan', '2021'),
(2117, 18070049, 'Spp Bulanan', '2021'),
(2118, 18070050, 'Spp Bulanan', '2021'),
(2148, 18070029, 'Spp Bulanan', '2021/2022'),
(6910, 18070030, 'Spp Bulanan', '2024'),
(7141, 18070029, 'Spp Bulanan', '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_lainnya`
--

CREATE TABLE `pembayaran_lainnya` (
  `id_pem_lainya` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `jenis_pembayaran` varchar(225) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `metode_pembayaran` varchar(128) NOT NULL,
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `status_bayar` char(1) NOT NULL DEFAULT '' COMMENT '0=Lunsa,\r\n1=Pending, 2=Error',
  `id_tahun` int(4) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_lainnya`
--

INSERT INTO `pembayaran_lainnya` (`id_pem_lainya`, `nis`, `jenis_pembayaran`, `tanggal_bayar`, `metode_pembayaran`, `id`, `order_id`, `total_tagihan`, `status_bayar`, `id_tahun`, `tahun_ajaran`) VALUES
(1353, 18070029, 'Mawar Blok B NO 1', '0000-00-00', '', 483806, '', 450000, '', 0, '2023'),
(1647, 18070030, 'daftar ulang', '2021-08-18', 'Manual', 483806, '', 100000, '0', 0, '2021'),
(1648, 18070031, 'daftar ulang', '2021-08-24', 'Manual', 483806, '', 100000, '0', 0, '2021'),
(1649, 18070032, 'daftar ulang', '2021-12-15', 'Manual', 483806, '', 100000, '0', 0, '2021'),
(1650, 18070034, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1651, 18070035, 'daftar ulang', '2021-09-13', 'Manual', 483806, '', 100000, '0', 0, '2021'),
(1652, 18070036, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1653, 18070037, 'daftar ulang', '2021-12-14', 'Online', 483806, '718540632', 100000, '0', 0, '2021'),
(1654, 18070038, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1655, 18070039, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1656, 18070040, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1657, 18070041, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1658, 18070042, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1659, 18070043, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1660, 18070044, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1661, 18070045, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1662, 18070046, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1663, 18070047, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1664, 18070048, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1665, 18070049, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(1666, 18070050, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(2700, 18070039, 'pembayaran', '0000-00-00', '', 483806, '', 100000, '', 0, '2021'),
(4511, 18070029, 'daftar ulang', '2021-12-23', 'Manual', 483806, '', 100000, '0', 0, '2024'),
(4512, 18070030, 'daftar ulang', '2021-12-23', 'Online', 483806, '312838030', 100000, '0', 0, '2024'),
(4513, 18070031, 'daftar ulang', '2022-01-28', 'Online', 483806, '523979725', 100000, '1', 0, '2024'),
(4514, 18070032, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4515, 18070034, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4516, 18070035, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4517, 18070036, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4518, 18070037, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4519, 18070038, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4520, 18070039, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4521, 18070040, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4522, 18070041, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4523, 18070042, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4524, 18070043, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4525, 18070044, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4526, 18070045, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4527, 18070046, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4528, 18070047, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4529, 18070048, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4530, 18070049, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(4531, 18070050, 'daftar ulang', '0000-00-00', '', 483806, '', 100000, '', 0, '2024'),
(5743, 18070029, 'pembayaran', '2022-02-08', 'Manual', 483806, '', 600000, '0', 0, '2021'),
(6193, 18070030, 'Mawar Blok B NO 1', '0000-00-00', '', 483806, '', 300000, '', 0, '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengampu`
--

CREATE TABLE `pengampu` (
  `id_pengampu` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengampu`
--

INSERT INTO `pengampu` (`id_pengampu`, `nama`) VALUES
(1, 'KH. Munawwar'),
(2, 'Ust. Rifa\'I KN.'),
(3, 'Ust. A. Kharis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `nis` varchar(9) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_santri` varchar(30) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp` varchar(13) NOT NULL,
  `ayah` varchar(100) NOT NULL,
  `ibu` varchar(100) NOT NULL,
  `kamar` varchar(100) NOT NULL,
  `angkatan` varchar(100) NOT NULL,
  `pengampu` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `surat` varchar(50) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `univ` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`nis`, `password`, `nama_santri`, `image`, `email`, `jenis_kelamin`, `alamat`, `tanggal_lahir`, `no_hp`, `ayah`, `ibu`, `kamar`, `angkatan`, `pengampu`, `jenis`, `surat`, `wali_kelas`, `kelas`, `univ`, `jurusan`, `status`, `role_id`, `date_created`) VALUES
('18070029', '$2y$10$.wnOpEe854vDX01LeZzI.ufsonJe5vmrn6DnRgBtVc8sRIUxpKmia', 'dsadad', NULL, 'hakimdani987@gmail.com', 'laki-laki', 'dasd', '2021-10-12', '23123', 'skvdascdusad', 'sdad', '', '2019', '', '', '', '', '', '', '', '', 2, 1634055574),
('18070030', '$2y$10$cL1YvaZDabJ4UNDxXbIzXOcQ6lFF3Qp0wEjq5OusUw5uy/ZoV/VJy', 'Abdul Hakim Amrulloh', '1634056023751.jpg', 'hakimamrulloh43@gmail.com', 'laki-laki', 'Bumirejo, Margorejo, Pati', '2001-02-14', '89601899864', 'Suyitno Wahid', 'Nur Rofi\'ah', '', '2017', '', '', '', '', '', '', '', '', 2, 1628957235),
('18070031', '$2y$10$CUIW4Lf2xtlCzd08Kqw15uq5rGiFOxjZCGa6iwhqK0ws91YheweDa', 'Abdul Wahib', '', 'abdulwahib', 'laki-laki', 'Ngampel Wetan, Ngampel, Kendal                    ', '1997-03-08', '87884115479', 'Reban', 'Jamiyah', '', '', '', '', '', '', '', '', '', '', 3, 1628958359),
('18070032', '$2y$10$85KlfL.fWc/ldIrpvLJp9uawt/uVHXO7GYOix.FEH4.vxJPj6.ywO', 'Muhammad Iqbal Zamzami', '', 'iqbalzamzami23@gmail.com', 'laki-laki', 'Turus, Gurah, Kediri', '1998-02-19', '85852226541', 'M. Damami', 'Inayatur Rohmah', '', '', '', '', '', '', '', '', '', '', 3, 1628958504),
('18070034', '$2y$10$IYa/9LbJs6YPvsxch6zOs./dA4dh1P.LEvW6i1r5q6HVW1.srPfNS', 'Prasetyo Adi sutopo', '', 'adisutopo12@gmail.com', 'laki-laki', 'Jatinegara, Cakung, Cakung', '2001-06-06', '8990907436', 'Bambang Murtopo', 'Paijem', '', '', '', '', '', '', '', '', '', '', 3, 1628959023),
('18070035', '$2y$10$Fq6wNjfFzs2VTIZ3GCXPOepjljWxBplBrm18S0jUf4Du87ookodwu', 'Rizal Fathurrohman', '', 'fathurrohman54@gmail.com', 'laki-laki', 'Hargantoro, Tirtoroyo, Wonogiri', '1997-01-15', '85877439351', 'Khoiru Rohmad', 'Eni Hidayati', '', '', '', '', '', '', '', '', '', '', 3, 1628959314),
('18070036', '$2y$10$Nn9PGcHBGO90QIj94sCbjOsRQediQFd.MhZQ/F/Qj1cR//Dm1CaCG', 'Sugeng Nugraha', '', 'nugraha23@gmail.com', 'laki-laki', 'Tambak Jati, PatokBeusi, Subang ', '2001-11-15', '81227422899', 'Abdul Choeri', 'Emsih Amsilah', '', '', '', '', '', '', '', '', '', '', 3, 1628960325),
('18070037', '$2y$10$8z2rEgWGgO1xwGNU345Kie9MONXc9UuZ5PhqGsB/vW6Fdor7AkHAS', 'Mohamad Zian Nooramadhan', '', 'ziannooramadhan@gmail.com', 'laki-laki', 'Baros,  Warung Gunung, Lebak Banten', '1996-05-06', '85210957335', 'Enjat Sudrajat', 'Yenni Sofia', '', '', '', '', '', '', '', '', '', '', 3, 1628960540),
('18070038', '$2y$10$SlOFjqbNtcndz3/zOmXw8OuFqs26y.diAE9OD/sqa5g4dce0G.Rfu', 'Hilmi ikhwan Syarofi ', '', 'ikhwansyarofi67@gmail.com', 'laki-laki', 'Kluwan, Penawangan, Grobogan', '1997-10-16', '81542868365', 'Maskuri', 'Maimoah', '', '', '', '', '', '', '', '', '', '', 3, 1628960672),
('18070039', '$2y$10$By898dEiu2PZvIbpaM/sRuvktfYCS3aPdHm6Q4OGqeSmDcua0.r.W', 'Iftah Miftahur Rizky', '', 'miftahurrizky34@gmail.com', 'laki-laki', 'Bantarwaru, Ligung, Majalengka ', '1995-09-14', '85211585151', 'H. Abidin  ', 'Hj. Kasminah', '', '', '', '', '', '', '', '', '', '', 3, 1628960762),
('18070040', '$2y$10$rHB97zutAa/oTpAIgul5yO.Fii6ni1VV2n6V9mb2JgT4BB.4iP07.', 'M. Badrul Fadli ', '', 'badrulfadli55@gmail.com', 'laki-laki', 'Batokan, Ngantru, Tulungagung', '2000-01-03', '85853665538', 'Ischak Abdullah', 'Lailatul Badriyah', '', '', '', '', '', '', '', '', '', '', 3, 1628960868),
('18070041', '$2y$10$7oVkg7/3kj6p5cTzIW08M.pzgkrK9ECLObp3ahB9FsfJjWkIvP/9O', 'M. Budi Riyanto', '', 'budiriyanto@gmail.com', 'laki-laki', 'Samirejo, Gembong, Pati', '2000-06-13', '85640104586', 'Sarwi ', 'Sumiyah', '', '', '', '', '', '', '', '', '', '', 3, 1628961024),
('18070042', '$2y$10$zh3NyH7MfFViR9Tu/24hMOkwEFoFcSY4Xa9wJYz7QmpQBR28cRroK', 'Muhammad Amirudin', '', 'amirudin34@gmail.com', 'laki-laki', 'Kalirejo, Lampung Tengah', '1999-05-11', '85725289005', 'Ahmad Mustaqim (alm)', 'Muntahanah ', '', '', '', '', '', '', '', '', '', '', 3, 1628962421),
('18070043', '$2y$10$8qNqT6cXqGmQmzeuklCyxuCs1uteq40E5rv5DhViz886oJKeV2JGi', 'Muhammad Fachry Ghozali', '', 'fachryghozali@gmail.com', 'laki-laki', 'Panggang Sari, Losari, Cirebon', '1999-02-10', '8999879958', 'H. Ahmad Nasyi\'in ', 'Hj. Junaidatin Istiyah', '', '', '', '', '', '', '', '', '', '', 3, 1628964264),
('18070044', '$2y$10$wEnOiq5/AQAJBO2YAlF.HOYzZfUQObNIIAQWpGG1uSo49wgQF3n3.', 'Muhammad Faqih Mubarok', '', 'faqihmubarok12@gmail.com', 'laki-laki', 'Ringinanom, Parakan, Temanggung', '1998-08-07', '85326408050', 'Zainudin ', 'Umiyati', '', '', '', '', '', '', '', '', '', '', 3, 1628964351),
('18070045', '$2y$10$bY82/L5j29jAvfFJEuc2xeobbxBLUfRZSEZd/mkIUZs7Y6.B0XrOq', 'Taufik Hidayatullah', '', 'hidayatullah54@gmail.com', 'laki-laki', 'Teluk Meranti, Delawan, Riau', '1997-05-16', '081322112420 ', 'Masjuki ', 'Nafiah', '', '', '', '', '', '', '', '', '', '', 3, 1628964467),
('18070046', '$2y$10$GPRivaLXPwDvRZ1/..dQX.z16N8IMmPSk/H1iWssP88kcMCFuJz/6', 'Yusuf Ashidicki Pradana', '', 'Ashidickipradana@gmail.com', 'laki-laki', 'Cileng, Poncol, Magetan', '2000-07-05', '082330920789 ', 'Suratno ', 'Kholishotun Nuria H', '', '', '', '', '', '', '', '', '', '', 3, 1628964546),
('18070047', '$2y$10$RpI6FC95.kVxyqgcnPvetuU5KM4ZFpo4.1enIKo/4npzSDdV9GFoi', 'Ahmad Wahyu Rusli Sofiyulloh', '', 'Wahyurusli34@gmail.com', 'laki-laki', 'Pakelen, Madukara, Banjarnegara', '2000-03-16', '081215732051 ', 'Parso ', 'Sumarliyah', '', '', '', '', '', '', '', '', '', '', 3, 1628964645),
('18070048', '$2y$10$iNTxE5tcJeZWFaMmmVCbYeZFroreUc1eQL3jLb1dcSK/odeem06HG', 'Yusuf Nugroho', '', 'Yusufnugroho@gmail.com', 'laki-laki', 'Sumberejo, Semin, Gunung Kidul, DIY', '1999-01-08', '87739731174', 'Sugiman ', 'Lestari', '', '', '', '', '', '', '', '', '', '', 3, 1628964728),
('18070049', '$2y$10$mQD4vVbbp/vb8cDqXt91GOGOErBEmJkHJcWDUZqfVUGgHKkORjjim', 'Muhammad Maimun Rifqi', '', 'Maimunrifqi98@gmail.com', 'laki-laki', 'Wonokusumo, Semampir, Surabaya', '1998-06-04', '081234399098 ', 'Ahmad Suad ', 'Nurul Widad Tomari', '', '', '', '', '', '', '', '', '', '', 3, 1628964810),
('18070050', '$2y$10$YZVwXFDet.xsBDp9uTbUZeIexDgNIZis4TaY35/KhZ9muW3ii9wEa', 'Wikrama Erlangga', '', 'Erlangga@gmail.com', 'laki-laki', 'Kupu, Wanasari, Brebes', '1999-08-17', '085540615845 ', 'Rasdi Dinata ', 'Khujemah', '', '', '', '', '', '', '', '', '', '', 3, 1628964894);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp_bulanan`
--

CREATE TABLE `spp_bulanan` (
  `id_transaksi` varchar(128) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `nama_santri` varchar(30) NOT NULL,
  `id_bulan` varchar(5) NOT NULL,
  `id_tahun` int(4) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `metode_pembayaran` varchar(225) NOT NULL,
  `no_virtual` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `status` char(1) DEFAULT '' COMMENT '0=lunas, 1=pending, 2=error',
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spp_bulanan`
--

INSERT INTO `spp_bulanan` (`id_transaksi`, `nis`, `nama_santri`, `id_bulan`, `id_tahun`, `tanggal_bayar`, `metode_pembayaran`, `no_virtual`, `jumlah`, `id`, `status`, `order_id`) VALUES
('SPP-010921001', '18070034', 'Prasetyo Adi sutopo', '09', 60, '2021-09-01', 'Online', '', 70000, 483806, '0', '1017568809'),
('SPP-010921002', '18070034', 'Prasetyo Adi sutopo', '10', 60, '2021-09-01', 'Online', '', 70000, 483806, '0', '1017568809'),
('SPP-080222001', '18070034', 'Prasetyo Adi sutopo', '11', 60, '2022-02-08', 'Manual', '', 70000, 483806, '0', ''),
('SPP-080222002', '18070034', 'Prasetyo Adi sutopo', '12', 60, '2022-02-08', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921001', '18070035', 'Rizal Fathurrohman', '01', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921002', '18070035', 'Rizal Fathurrohman', '02', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921003', '18070035', 'Rizal Fathurrohman', '03', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921004', '18070035', 'Rizal Fathurrohman', '04', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921005', '18070035', 'Rizal Fathurrohman', '05', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921006', '18070035', 'Rizal Fathurrohman', '06', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921007', '18070035', 'Rizal Fathurrohman', '07', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921008', '18070035', 'Rizal Fathurrohman', '08', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921009', '18070035', 'Rizal Fathurrohman', '09', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921010', '18070035', 'Rizal Fathurrohman', '10', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921011', '18070035', 'Rizal Fathurrohman', '11', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-130921012', '18070035', 'Rizal Fathurrohman', '12', 60, '2021-09-13', 'Manual', '', 70000, 483806, '0', ''),
('SPP-150422001', '18070029', 'dsadad', '03', 60, '2022-04-15', 'Online', '75180393162|bca', 70000, 483806, '1', '612373892'),
('SPP-160322001', '18070038', 'Hilmi ikhwan Syarofi ', '01', 60, '2022-03-16', 'Online', '', 70000, 483806, '0', '1795844494'),
('SPP-160322002', '18070038', 'Hilmi ikhwan Syarofi ', '02', 60, '2022-03-16', 'Online', '', 70000, 483806, '0', '1795844494'),
('SPP-160322003', '18070038', 'Hilmi ikhwan Syarofi ', '03', 60, '2022-03-16', 'Online', '', 70000, 483806, '0', '1795844494'),
('SPP-160322004', '18070030', 'Abdul Hakim Amrulloh', '01', 19, '2022-03-16', 'Online', '', 70000, 18070030, '0', '1110369609'),
('SPP-160322005', '18070030', 'Abdul Hakim Amrulloh', '02', 19, '2022-03-16', 'Online', '', 70000, 18070030, '0', '1110369609'),
('SPP-160322006', '18070030', 'Abdul Hakim Amrulloh', '03', 19, '2022-03-16', 'Online', '', 70000, 18070030, '0', '1110369609'),
('SPP-180821001', '18070030', 'Abdul Hakim Amrulloh', '01', 60, '2021-08-18', 'Manual', '', 70000, 483806, '0', ''),
('SPP-180821002', '18070030', 'Abdul Hakim Amrulloh', '02', 60, '2021-08-18', 'Manual', '', 70000, 483806, '0', ''),
('SPP-200322001', '18070030', 'Abdul Hakim Amrulloh', '04', 19, '2022-03-20', 'Manual', '', 70000, 483806, '0', ''),
('SPP-200322002', '18070030', 'Abdul Hakim Amrulloh', '05', 19, '2022-03-20', 'Manual', '', 70000, 483806, '0', ''),
('SPP-200322003', '18070029', 'dsadad', '01', 60, '2022-03-20', 'Manual', '', 70000, 483806, '0', ''),
('SPP-200322004', '18070029', 'dsadad', '02', 60, '2022-03-20', 'Manual', '', 70000, 483806, '0', ''),
('SPP-231221001', '18070029', 'dsadad', '01', 77, '2021-12-23', 'Manual', '', 30000, 483806, '0', ''),
('SPP-231221002', '18070029', 'dsadad', '02', 77, '2021-12-23', 'Manual', '', 30000, 483806, '0', ''),
('SPP-231221003', '18070029', 'dsadad', '03', 77, '2021-12-23', 'Manual', '', 30000, 483806, '0', ''),
('SPP-240821001', '18070030', 'Abdul Hakim Amrulloh', '03', 60, '2021-08-24', 'Manual', '', 70000, 483806, '0', ''),
('SPP-240821002', '18070030', 'Abdul Hakim Amrulloh', '04', 60, '2021-08-24', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821001', '18070031', 'Abdul Wahib', '01', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821002', '18070031', 'Abdul Wahib', '02', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821003', '18070031', 'Abdul Wahib', '03', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821004', '18070031', 'Abdul Wahib', '04', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821005', '18070031', 'Abdul Wahib', '05', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821006', '18070031', 'Abdul Wahib', '06', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821007', '18070031', 'Abdul Wahib', '07', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821008', '18070031', 'Abdul Wahib', '08', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821009', '18070031', 'Abdul Wahib', '09', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821010', '18070031', 'Abdul Wahib', '10', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821011', '18070031', 'Abdul Wahib', '11', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821012', '18070031', 'Abdul Wahib', '12', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821013', '18070032', 'Muhammad Iqbal Zamzami', '01', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821014', '18070032', 'Muhammad Iqbal Zamzami', '02', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821015', '18070032', 'Muhammad Iqbal Zamzami', '03', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821016', '18070032', 'Muhammad Iqbal Zamzami', '04', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821017', '18070032', 'Muhammad Iqbal Zamzami', '05', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821018', '18070034', 'Prasetyo Adi sutopo', '01', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821019', '18070034', 'Prasetyo Adi sutopo', '02', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821020', '18070034', 'Prasetyo Adi sutopo', '03', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821021', '18070034', 'Prasetyo Adi sutopo', '04', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821022', '18070034', 'Prasetyo Adi sutopo', '05', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821023', '18070034', 'Prasetyo Adi sutopo', '06', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821024', '18070034', 'Prasetyo Adi sutopo', '07', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-250821025', '18070034', 'Prasetyo Adi sutopo', '08', 60, '2021-08-25', 'Manual', '', 70000, 483806, '0', ''),
('SPP-251021001', '18070030', 'Abdul Hakim Amrulloh', '05', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021002', '18070030', 'Abdul Hakim Amrulloh', '06', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021003', '18070030', 'Abdul Hakim Amrulloh', '07', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021004', '18070030', 'Abdul Hakim Amrulloh', '08', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021005', '18070030', 'Abdul Hakim Amrulloh', '09', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021006', '18070030', 'Abdul Hakim Amrulloh', '10', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021007', '18070030', 'Abdul Hakim Amrulloh', '11', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486'),
('SPP-251021008', '18070030', 'Abdul Hakim Amrulloh', '12', 60, '2021-10-25', 'Online', '', 70000, 483806, '0', '1639926486');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `nama_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id_surat`, `nama_surat`) VALUES
(1, 'Al-Balad'),
(2, 'Muthaffifin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun` int(4) NOT NULL,
  `tahun_ajaran` varchar(9) CHARACTER SET latin1 NOT NULL,
  `besar_spp` varchar(225) NOT NULL,
  `Status` enum('ON','OFF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun`, `tahun_ajaran`, `besar_spp`, `Status`) VALUES
(19, '2024', '70000', 'ON'),
(60, '2021', '70000', 'ON'),
(77, '2021/2022', '30000', 'ON'),
(90, '2023', '100000', 'ON'),
(99, '2022', '80000', 'ON');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_aktif`
--

CREATE TABLE `tahun_aktif` (
  `id_thaktif` int(11) NOT NULL,
  `nis` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahun_aktif`
--

INSERT INTO `tahun_aktif` (`id_thaktif`, `nis`) VALUES
(730, '18070029'),
(9385, '18070030'),
(9386, '18070031'),
(9387, '18070032'),
(9388, '18070034'),
(9389, '18070035'),
(9390, '18070036'),
(9391, '18070037'),
(9392, '18070038'),
(9393, '18070039'),
(9394, '18070040'),
(9395, '18070041'),
(9396, '18070042'),
(9397, '18070043'),
(9398, '18070044'),
(9399, '18070045'),
(9400, '18070046'),
(9401, '18070047'),
(9402, '18070048'),
(9403, '18070049'),
(9404, '18070050');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunggakan`
--

CREATE TABLE `tunggakan` (
  `id` int(11) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `id_tahun` varchar(4) NOT NULL,
  `tunggakan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(29, 1, 2),
(30, 2, 1),
(35, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `sort` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `sort`) VALUES
(27, 'Bendahara', 1),
(28, 'Pengasuh', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Bendahara'),
(2, 'Pengasuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` int(255) DEFAULT NULL,
  `order` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `order`) VALUES
(50, 4, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt', 1, NULL),
(54, 2, 'Admin', 'user', 'fas fa-fw fa-users', 1, NULL),
(65, 3, 'Kas Masuk', 'kas/kas_masuk', 'fas fa-fw fa-hand-holding-usd', 1, NULL),
(67, 5, 'Kas Keluar', 'kas/kas_keluar', 'fas fa-hand-holding', 1, NULL),
(69, 1, 'Santri', 'santri', 'fas fa-user', 1, NULL),
(88, 3, 'pembayaran', 'pembayaran', 'fas fa-fw fa-money-bill-wave', 1, NULL),
(90, 27, 'Adm', 'user', 'fas fa-fw fa-users', 1, NULL),
(91, 27, 'Kas M', 'kas_masuk/kasmasuk', 'fas fa-print', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_wali_kelas` int(11) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_wali_kelas`, `wali_kelas`) VALUES
(1, 'gilang'),
(2, 'rotsik');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bendahara`
--
ALTER TABLE `bendahara`
  ADD PRIMARY KEY (`id_bendahara`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indeks untuk tabel `hapus_transaksi`
--
ALTER TABLE `hapus_transaksi`
  ADD PRIMARY KEY (`id_hapus`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `jenis_ngaji`
--
ALTER TABLE `jenis_ngaji`
  ADD PRIMARY KEY (`id_ngaji`);

--
-- Indeks untuk tabel `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_pembayaran` (`jenis_pembayaran`);

--
-- Indeks untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indeks untuk tabel `pembayaran_bulanan`
--
ALTER TABLE `pembayaran_bulanan`
  ADD PRIMARY KEY (`id_pem_bulan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `tahun_ajaran` (`tahun_ajaran`);

--
-- Indeks untuk tabel `pembayaran_lainnya`
--
ALTER TABLE `pembayaran_lainnya`
  ADD PRIMARY KEY (`id_pem_lainya`),
  ADD KEY `nis` (`nis`);

--
-- Indeks untuk tabel `pengampu`
--
ALTER TABLE `pengampu`
  ADD PRIMARY KEY (`id_pengampu`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `spp_bulanan`
--
ALTER TABLE `spp_bulanan`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nis` (`nis`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun`),
  ADD UNIQUE KEY `tahun_ajaran` (`tahun_ajaran`);

--
-- Indeks untuk tabel `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  ADD PRIMARY KEY (`id_thaktif`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indeks untuk tabel `tunggakan`
--
ALTER TABLE `tunggakan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_wali_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bendahara`
--
ALTER TABLE `bendahara`
  MODIFY `id_bendahara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3082023;

--
-- AUTO_INCREMENT untuk tabel `hapus_transaksi`
--
ALTER TABLE `hapus_transaksi`
  MODIFY `id_hapus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT untuk tabel `jenis_ngaji`
--
ALTER TABLE `jenis_ngaji`
  MODIFY `id_ngaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3600;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7567;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23233;

--
-- AUTO_INCREMENT untuk tabel `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  MODIFY `id_thaktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9902;

--
-- AUTO_INCREMENT untuk tabel `tunggakan`
--
ALTER TABLE `tunggakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_wali_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4546;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
