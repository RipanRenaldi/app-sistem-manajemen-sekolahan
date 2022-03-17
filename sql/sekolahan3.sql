-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2022 at 11:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolahan3`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id` int(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `catatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id`, `nis`, `tgl_transaksi`, `catatan`) VALUES
(1, '0028011720', '2022-01-04 08:00:40', ''),
(2, '0028011725', '2022-01-04 08:17:13', ''),
(3, '0028011720', '2022-01-05 02:30:19', ''),
(4, '0028011720', '2022-01-05 02:31:25', ''),
(5, '0028011720', '2022-01-05 02:33:19', ''),
(6, '0028011721', '2022-01-05 02:34:29', ''),
(7, '0028011720', '2022-01-05 02:36:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `kd_guru` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nm_guru` varchar(255) NOT NULL,
  `wali_kelas` int(11) NOT NULL,
  `gambar_guru` varchar(255) NOT NULL DEFAULT 'nophoto.jpg',
  `tipe` int(11) NOT NULL,
  `gaji` int(255) DEFAULT NULL,
  `status_gaji` enum('1','2') NOT NULL DEFAULT '1',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kd_guru`, `nip`, `nm_guru`, `wali_kelas`, `gambar_guru`, `tipe`, `gaji`, `status_gaji`, `id_user`) VALUES
('ark05', '0301200016', 'Arka', 4, 'nophoto.jpg', 2, 3000000, '1', 10),
('dni03', '0301200013', 'Dani', 3, 'nophoto.jpg', 1, 6000000, '1', 3),
('dwi01', '0301200012', 'Dewi Mustika', 1, 'nophoto.jpg', 1, 6000000, '2', 0),
('lls02', '0301200014', 'Lilis Sulistiawati', 7, 'nophoto.jpg', 1, 6000000, '1', 12),
('wwn04', '0301200015', 'Wawan', 8, 'nophoto.jpg', 1, 6000000, '1', 9);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `kd_jurusan` char(255) NOT NULL,
  `nm_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `kd_jurusan`, `nm_jurusan`) VALUES
(1, 'mipa', 'Matematika & Ilmu Alam'),
(2, 'iis', 'Ilmu Ilmu Sosial'),
(3, 'iik', 'Keagamaan'),
(4, 'lng', 'Bahasa');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'XII-MIPA-01'),
(3, 'XII-MIPA-03'),
(4, 'XII-IIK-01'),
(5, 'XII-IIS-01'),
(7, 'XII-MIPA-02'),
(8, 'XII-MIPA-04');

-- --------------------------------------------------------

--
-- Table structure for table `list_bayar`
--

CREATE TABLE `list_bayar` (
  `id_bayar` int(11) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `status_bayar` enum('1','2','3','') NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_bayar`
--

INSERT INTO `list_bayar` (`id_bayar`, `nis`, `id_kelas`, `status_bayar`, `bukti_bayar`) VALUES
(1, '0028011720', 1, '1', NULL),
(2, '123', 3, '1', NULL),
(3, '0028011721', 3, '1', NULL),
(4, 'test', 3, '1', NULL),
(5, 'test', 3, '1', NULL),
(6, '0028011722', 3, '1', NULL),
(7, '0028011723', 7, '1', NULL),
(8, '0028011724', 7, '1', NULL),
(9, '0028011725', 3, '1', NULL),
(10, 'test', 8, '1', NULL),
(11, '', 4, '1', NULL),
(12, '', 4, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `id_matpel` int(11) NOT NULL,
  `kd_matpel` char(255) NOT NULL,
  `nm_matpel` varchar(255) NOT NULL,
  `jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`id_matpel`, `kd_matpel`, `nm_matpel`, `jam`) VALUES
(1, 'mtk01', 'Matematika', 8),
(2, 'blg02', 'Biologi', 8),
(3, 'bind03', 'Bahasa Indonesia', 6);

-- --------------------------------------------------------

--
-- Table structure for table `roleuser`
--

CREATE TABLE `roleuser` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roleuser`
--

INSERT INTO `roleuser` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'Siswa');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `email` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `guru_wali` char(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nm_siswa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`email`, `gambar`, `guru_wali`, `id_kelas`, `id_user`, `jurusan`, `nis`, `nm_siswa`) VALUES
('ripanrenaldi25@gmail.com', 'Formal.jpeg', 'dwi01', 1, 2, 1, '0028011720', 'RIpan Renaldi'),
('ekakw@gmail.com', 'nophoto.jpg', 'dni03', 3, 5, 1, '0028011721', 'Eka'),
('samidf11@gmail.com', 'nophoto.jpg', 'dni03', 3, 6, 1, '0028011722', 'Dimas'),
('akbarfs@gmail.com', 'nophoto.jpg', 'lls02', 7, 13, 1, '0028011723', 'Akbar'),
('abdussalam1221@gmail.com', 'nophoto.jpg', 'lls02', 7, 9, 1, '0028011724', 'Salman'),
('eginef@gmail.com', 'nophoto.jpg', 'dni03', 3, 7, 1, '0028011725', 'Egin');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_guru`
--

CREATE TABLE `tipe_guru` (
  `id_tipe` int(11) NOT NULL,
  `tipe_guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_guru`
--

INSERT INTO `tipe_guru` (`id_tipe`, `tipe_guru`) VALUES
(1, 'Tetap'),
(2, 'Honorer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_role`, `last_login`, `username`, `password`) VALUES
(1, 1, '2022-01-04 04:53:13', 'admin', '$2y$10$vjt3ay0L8LCdTAFjtpMSBeUCd0SHnrS7BikR67m.VB9NoxlG.bOKm'),
(2, 3, '2022-01-05 02:36:36', 'ripan', '$2y$10$syW6gdcnuS/5T/9rIDwK8er1wGzvbhY8LSrgXsHGZVsFuFO95d1z.'),
(3, 2, '2022-01-05 06:11:25', 'dani', '$2y$10$ub.G9GgTHY8s7YiTp6jGMebACyxr9WNAyWyh0Jt7bHgb0h4CUInxq'),
(5, 3, '2022-01-05 02:34:30', 'siswa2', '$2y$10$oy7iOqaZz7XrA0ku46.NtuTHZhVAHEDMpOJXofGwSKoSiCpTIeKYq'),
(6, 3, '2022-01-04 08:15:06', 'dimas', '$2y$10$rSn2R96wjtuGFraglOVvV.6ozbt4aAKsgqx3pDaoZstTDCdtQryzm'),
(7, 3, '2022-01-04 08:17:49', 'egin', '$2y$10$BwVL6T0/6MqQqyp7yN9RQuU8zZlhPigCwZ3NHfklX..kEJ2AW1K8a'),
(8, 3, '2022-01-04 08:08:48', 'salman', '$2y$10$koiu73H2CqWEEd9Usvutbebw6GRJU10VqHhWzObGJxtCReZtNOxQ6'),
(9, 2, '2022-01-05 02:20:21', 'wawan', '$2y$10$RIZUGRA9d9KsqVL7aAx6x.0LJC8J7tiRguQyU5IxvI8w41pHOhpOW'),
(10, 2, '2022-01-05 02:20:04', 'arka', '$2y$10$2BA4atM4oY6qV7cuzJ.IHuha9Yepp9ED6r78bO2wEF8BRmxzZqlV2'),
(11, 2, '2022-01-04 08:09:32', 'bibah', '$2y$10$dRvVV76ykFr0YmHUMmE8EeYhdfyDodKu/MBD5JTmTUZ/VDXjS/CvC'),
(12, 2, '2022-01-05 02:20:15', 'lilis', '$2y$10$ViE89MQCkrtyYgU97KBr1.RMeMP1/uRtizDXvU7iL96k4j6jYD0VS'),
(13, 3, '2022-01-04 08:15:21', 'akbar', '$2y$10$0xeK9NGW7ZB.6VSU2BX9zeLVohH56FDzu3hCp8lkJOtC1VSzxP0OC'),
(14, 3, '2022-01-05 01:40:06', 'na', '$2y$10$q9.wb0cy3AeH3VEfuT32dOAosiD894QFJhHSzuRFH/iVsBOuFbMnu'),
(15, 3, '2022-01-05 01:44:33', ' rio', '$2y$10$zXeV.0jwOGUGTc/KJ1Y.BubA.d4uek2A3gTShCC331h6kR3yUrkrq'),
(16, 3, '2022-01-05 01:48:05', 'rio2', '$2y$10$yZefbV31q6qEHtIkJUwwzelI5FgSJSQYvDmpqgiLBfjBWK.Xxquem');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kd_guru`,`nip`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `list_bayar`
--
ALTER TABLE `list_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`id_matpel`,`kd_matpel`);

--
-- Indexes for table `roleuser`
--
ALTER TABLE `roleuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tipe_guru`
--
ALTER TABLE `tipe_guru`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `list_bayar`
--
ALTER TABLE `list_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `id_matpel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roleuser`
--
ALTER TABLE `roleuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipe_guru`
--
ALTER TABLE `tipe_guru`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
