-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 06:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persuratan_dosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kerja_lembur`
--

CREATE TABLE `laporan_kerja_lembur` (
  `id_lembur` int NOT NULL,
  `hari_tgl_laporan` date NOT NULL,
  `waktu` time NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_dosen` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_kerja_lembur`
--

INSERT INTO `laporan_kerja_lembur` (`id_lembur`, `hari_tgl_laporan`, `waktu`, `uraian_pekerjaan`, `keterangan`, `nama_dosen`) VALUES
(2, '2024-03-09', '21:09:16', 'Penyusunan atau penyuntingan artikel atau berita yang akan dipublikasikan', '-', 'Chiko Jerome'),
(4, '2024-01-21', '23:10:17', 'Revisi desain grafis atau web berdasarkan feedback klien', 'Penyelesaian sesuai target harian atau bulanan', 'Devi Aryanii'),
(5, '2024-02-07', '22:08:23', 'Penilaian tugas atau ujian siswa', '-', 'Hilma Abraham'),
(14, '2024-03-06', '21:20:11', 'Penyelesaian debugging atau pengembangan fitur baru dalam aplikasi', 'Dalam Aplikasi BNI Mobile', 'Rasya Darrent'),
(19, '2024-04-02', '23:43:24', 'Peningkatan sistem atau server maintenance\r\n', 'Lembur bersama para programmer yang sangat happy', 'Vannya S.Pd., M.Pd., Kom'),
(23, '2024-02-03', '07:17:54', 'Penyusunan dokumen-dokumen penting', 'Dokumen hari Kamis per kebutuhan', 'Chiko Jerome'),
(32, '2024-01-02', '07:13:24', 'Merekap data tambahan yang telat masuk', 'Lembur 3 jam mantap', 'Vannya S.Pd., M.Pd., Kom'),
(56, '2024-02-09', '21:09:16', 'Penyusunan atau penyuntingan artikel atau berita yang akan dipublikasikan', '-', 'Devi Aryanii');

-- --------------------------------------------------------

--
-- Table structure for table `penggatian_pengawas_ujian`
--

CREATE TABLE `penggatian_pengawas_ujian` (
  `id_pengganti` int NOT NULL,
  `nama_pengawas_diganti` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `hari_tgl_penggantian` datetime NOT NULL,
  `jam` time NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `nama_pengawas_pengganti` varchar(255) NOT NULL,
  `nama_dosen` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penggatian_pengawas_ujian`
--

INSERT INTO `penggatian_pengawas_ujian` (`id_pengganti`, `nama_pengawas_diganti`, `unit_kerja`, `hari_tgl_penggantian`, `jam`, `ruang`, `nama_pengawas_pengganti`, `nama_dosen`) VALUES
(1, 'Deva Aryano', 'Bidang Mechine Learning', '2024-10-16 01:58:46', '02:00:00', 'TRM-2A', 'Devi Aryani', 'Cerlyne'),
(3, 'Devina Pramesti', 'Bidang Mechine Learning', '2024-10-16 01:58:46', '02:00:00', 'TRM-2A', 'Eka Ramdhani', 'Fatir'),
(10, 'Denara', 'Bidang Kemahasiswaan', '2024-10-05 09:11:34', '08:11:34', 'J 4.9', 'Davian El Gavin', 'Rion'),
(12, 'Kalista', 'Bidang SAINS Akademik', '2024-10-03 09:05:53', '13:05:53', 'RKS-1B', 'Lidya', 'Arum'),
(14, 'Gavin', 'Bidang Keolahragaan', '2024-10-05 09:11:34', '08:11:34', 'J 4.9', 'Davian Aresta Gavin', 'Louis'),
(32, 'Seira ', 'Bidang SAINS Akademik', '2024-10-14 07:29:55', '08:00:00', 'J 5.12', 'Veirna', 'Rostika Listya'),
(42, 'Veronica', 'Bidang Kemahasiswaan', '2024-10-02 08:37:09', '13:00:09', 'TI - 1A', 'Alvaro', 'Livy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan_kerja_lembur`
--
ALTER TABLE `laporan_kerja_lembur`
  ADD PRIMARY KEY (`id_lembur`);

--
-- Indexes for table `penggatian_pengawas_ujian`
--
ALTER TABLE `penggatian_pengawas_ujian`
  ADD PRIMARY KEY (`id_pengganti`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
