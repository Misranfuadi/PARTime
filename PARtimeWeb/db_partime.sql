-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- 主機: localhost:3306
-- 產生時間： 2018 年 08 月 11 日 11:52
-- 伺服器版本: 5.5.56-MariaDB-cll-lve
-- PHP 版本： 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db_partime`
--

-- --------------------------------------------------------

--
-- 資料表結構 `bankbri`
--

CREATE TABLE `bankbri` (
  `id` int(22) NOT NULL,
  `type_loket` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `buka` varchar(20) DEFAULT NULL,
  `tutup` varchar(20) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `bankbri`
--

INSERT INTO `bankbri` (`id`, `type_loket`, `tanggal`, `buka`, `tutup`, `status`) VALUES
(3, 'Teller', '2018-05-29', '08:00', '18:00', 'Buka'),
(10, 'Customer Service', '2018-05-29', '22:22', '22:22', 'Buka');

-- --------------------------------------------------------

--
-- 資料表結構 `cempaka`
--

CREATE TABLE `cempaka` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `buka` varchar(100) DEFAULT NULL,
  `tutup` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `cempaka`
--

INSERT INTO `cempaka` (`id`, `nama`, `spesialis`, `tanggal`, `buka`, `tutup`, `status`) VALUES
(1, 'dr. RUSDI ANDID, SP. A', 'ANAK', '2018-05-29', '08:00', '15:00', 'Buka'),
(2, 'dr. DARNIFAYANTI, M.Ked. Ped, Sp.A', 'ANAK', '2018-05-29', '08:12', '12:00', 'Buka'),
(3, 'dr. YOPIE AFRIANDI HABIBIE.SP.BTKV', 'BEDAH TORAK', '2018-05-29', '13:00', '16:00', 'Buka'),
(4, 'dr. DIAN ADI SAPUTRA, SP.BA', 'BEDAH ANAK', '2018-07-23', '00:00', '16:00', 'Buka'),
(5, 'dr. AZHARUDDIN, SP. BO', 'BEDAH ORTHOPEDI', '2018-07-23', '14:00', '17:00', 'Buka'),
(6, 'dr. ARIFDIAN', 'UMUM ', '2018-07-23', '19:00', '22:00', 'Buka'),
(7, 'drg. Diana Setya Ningsih, M.Si', 'GIGI & MULUT', '2018-07-23', '19:00', '22:00', 'Buka'),
(8, 'drg. Anita Maisuri', 'GIGI & MULUT', '2018-05-29', '08:00', '12:00', 'Buka'),
(9, 'Drg. Syawal Setiawan', 'GIGI & MULUT', '2018-07-23', '13:00', '16:00', 'Buka'),
(10, 'dr. IVA MEUTIA FHONNA', 'UMUM', '2018-07-23', '08:00', '12:00', 'Buka'),
(11, 'dr. KHATAB', 'UMUM', '2018-07-23', '19:00', '22:00', 'Buka'),
(12, 'dr. RIKI ADRIAN', 'UMUM', '2018-05-30', '19:00', '22:00', 'Buka'),
(13, 'dr. H.T. FARIZAL FADIL, SP.B', 'BEDAH ', '2018-07-23', '08:00', '12:00', 'Buka'),
(14, 'dr. H. RUSMUNANDAR, SP.J', 'JANTUNG', '2018-05-30', '13:00', '16:00', 'Buka'),
(15, 'dr. MALAWATI, SP.KJ', 'KEJIWAAN', '2018-07-23', '13:00', '16:00', 'Buka'),
(16, 'dr. H.A. GARLI, SP. KK', 'KULIT & KELAMIN', '2018-07-23', '08:00', '12:00', 'Buka'),
(17, 'dr. SITI HAJAR, SP.KK', 'KULIT & KELAMIN', '2018-07-23', '13:00', '16:00', 'Buka'),
(18, 'dr. HJ. FIRDALENA MEUTIA, SP.M', 'MATA', '2018-05-30', '08:00', '12:00', 'Buka');

-- --------------------------------------------------------

--
-- 資料表結構 `Mandiri`
--

CREATE TABLE `Mandiri` (
  `id` int(100) NOT NULL,
  `type_loket` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `buka` varchar(100) DEFAULT NULL,
  `tutup` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Mandiri`
--

INSERT INTO `Mandiri` (`id`, `type_loket`, `tanggal`, `buka`, `tutup`, `status`) VALUES
(1, 'Customer Service', '2018-07-11', '08:29', '12:30', 'Buka'),
(2, 'Teller', '2018-07-11', '09:51', '12:55', 'Buka');

-- --------------------------------------------------------

--
-- 資料表結構 `master_pengantri`
--

CREATE TABLE `master_pengantri` (
  `id` int(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `master_pengantri`
--

INSERT INTO `master_pengantri` (`id`, `nama`, `username`, `password`, `status`) VALUES
(10, 'muksalbakrie', 'muksal', 'muksal', '1'),
(15, 'Zery', 'zery', 'z', '1'),
(16, 'Yurizkal', 'ikal', 'i', '1'),
(17, 'Zulfahmi', 'fahmi', 'f', '1'),
(18, 'Misran Fuadi', 'misran', 'm', '1'),
(19, 'ahd muhajir', 'ajir', 'a', '1'),
(20, 'Ade Irwanda', 'ade', 'a', '1'),
(21, 'Hamdan Fajri', 'hamdan', 'h', '1'),
(22, 'Feri', 'feri', 'FERI', '1'),
(23, 'User testing', 'user', 'user', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `master_user`
--

CREATE TABLE `master_user` (
  `id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `master_user`
--

INSERT INTO `master_user` (`id`, `type`, `nama`, `username`, `password`, `email`, `alamat`) VALUES
(3, '', 'Admin', 'admin', 'admin', 'partimeadmin@email.com', 'Admin di ulka s'),
(22, 'Bank', 'Bank BRI', 'bankbri', 'bankbri', 'BRI@gmail.com', 'jalan T iskandar lamteh no 10'),
(48, 'Hospital', 'Klinik Cempaka Lima', 'cempaka', 'cempaka', 'cempakalima@gmail.com', 'Tgk. H. Daud Beureueh No 156 Kota Banda Aceh'),
(53, 'Bank', 'Bank Mandiri', 'Mandiri', 'mandiri', 'Mandiri@gmail.com', 'Jl. Teuku H.  Daud Beureuh No.  15 H,  Keuramat,  ');

-- --------------------------------------------------------

--
-- 資料表結構 `pengantri_bankbri`
--

CREATE TABLE `pengantri_bankbri` (
  `id` int(20) NOT NULL,
  `nomor` varchar(5) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `type_loket` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `pengantri_bankbri`
--

INSERT INTO `pengantri_bankbri` (`id`, `nomor`, `nama`, `type_loket`, `status`) VALUES
(2, '1', 'Zulfahmi', 'Teller', '2'),
(3, '2', 'ahd muhajir', 'Teller', '1'),
(4, '3', 'Ade Irwanda', 'Teller', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `pengantri_cempaka`
--

CREATE TABLE `pengantri_cempaka` (
  `id` int(100) NOT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `dokter` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `pengantri_cempaka`
--

INSERT INTO `pengantri_cempaka` (`id`, `nomor`, `nama`, `spesialis`, `dokter`, `status`) VALUES
(234, '1', 'ahd muhajir', 'ANAK', 'dr. RUSDI ANDID, SP. A', '2'),
(235, '2', 'muksalbakrie', 'ANAK', 'dr. RUSDI ANDID, SP. A', '2'),
(236, '3', 'Zery', 'ANAK', 'dr. RUSDI ANDID, SP. A', '1'),
(237, '4', 'Zulfahmi', 'ANAK', 'dr. RUSDI ANDID, SP. A', '1'),
(238, '5', 'Yurizkal', 'ANAK', 'dr. RUSDI ANDID, SP. A', '1'),
(240, '7', 'Hamdan Fajri', 'ANAK', 'dr. RUSDI ANDID, SP. A', '1'),
(241, '1', 'Misran Fuadi', 'MATA', 'dr. HJ. FIRDALENA MEUTIA, SP.M', '2'),
(242, '2', 'Feri', 'MATA', 'dr. HJ. FIRDALENA MEUTIA, SP.M', '1'),
(243, '1', 'Feri', 'KEJIWAAN', 'dr. MALAWATI, SP.KJ', '1'),
(276, '1', 'Ade Irwanda', 'JANTUNG', 'dr. H. RUSMUNANDAR, SP.J', '2'),
(277, '1', 'Ade Irwanda', 'BEDAH TORAK', 'dr. YOPIE AFRIANDI HABIBIE.SP.BTKV', '1'),
(278, '8', 'User testing', 'ANAK', 'dr. RUSDI ANDID, SP. A', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `pengantri_Mandiri`
--

CREATE TABLE `pengantri_Mandiri` (
  `id` int(100) NOT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `type_loket` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `pengantri_Mandiri`
--

INSERT INTO `pengantri_Mandiri` (`id`, `nomor`, `nama`, `type_loket`, `status`) VALUES
(2, '1', 'muksalbakrie', 'Customer Service', '1');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `bankbri`
--
ALTER TABLE `bankbri`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `cempaka`
--
ALTER TABLE `cempaka`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `Mandiri`
--
ALTER TABLE `Mandiri`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `master_pengantri`
--
ALTER TABLE `master_pengantri`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 資料表索引 `pengantri_bankbri`
--
ALTER TABLE `pengantri_bankbri`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pengantri_cempaka`
--
ALTER TABLE `pengantri_cempaka`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pengantri_Mandiri`
--
ALTER TABLE `pengantri_Mandiri`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `bankbri`
--
ALTER TABLE `bankbri`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表 AUTO_INCREMENT `cempaka`
--
ALTER TABLE `cempaka`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表 AUTO_INCREMENT `Mandiri`
--
ALTER TABLE `Mandiri`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `master_pengantri`
--
ALTER TABLE `master_pengantri`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用資料表 AUTO_INCREMENT `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- 使用資料表 AUTO_INCREMENT `pengantri_bankbri`
--
ALTER TABLE `pengantri_bankbri`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `pengantri_cempaka`
--
ALTER TABLE `pengantri_cempaka`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- 使用資料表 AUTO_INCREMENT `pengantri_Mandiri`
--
ALTER TABLE `pengantri_Mandiri`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
