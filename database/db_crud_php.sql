-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2024 pada 13.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crud_php`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `whatsapp` varchar(13) NOT NULL,
  `foto_profil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `tanggal_masuk`, `divisi`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `email`, `whatsapp`, `foto_profil`) VALUES
(1, '2023-03-01', 'Web Development', 'Indra Styawantoro', 'Laki-laki', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'indra.styawantoro@gmail.com', '081377783334', 'c6a2a061d50317f437ba389a349f19e1d65897f3.jpg'),
(2, '2023-03-03', 'Web Design', 'Lindsay Spice', 'Perempuan', 'Kedaton, Kota Bandar Lampung, Lampung', 'lindsay.spice@gmail.com', '0895881122441', 'b5c388ea770724501edcabfe10c225339ba0e050.png'),
(3, '2023-03-03', 'Digital Marketing', 'Lynda Marquez', 'Perempuan', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'lynda.marquez@gmail.com', '0898557766889', 'bf754465bdf84f1f5e23e75d4c29e1b9b4b5c37f.png'),
(4, '2023-03-07', 'Web Design', 'James Doe', 'Laki-laki', 'Rajabasa, Kota Bandar Lampung, Lampung', 'james.doe@gmail.com', '082380905643', '587a38071d566578a39912e6dd71145ae708bb80.png'),
(5, '2023-03-11', 'Web Development', 'Mark Parker', 'Laki-laki', 'Kedaton, Kota Bandar Lampung, Lampung', 'mark.parker@gmail.com', '082123459876', '4dc0073f39fdb56fc5d64f4dc41329ea4218e30e.png'),
(6, '2023-03-13', 'Web Development', 'Frank Gibson', 'Laki-laki', 'Kemiling, Kota Bandar Lampung, Lampung', 'frank.gibson@gmail.com', '081379793535', '3b2841799de6fbf02a1c5f8225d5578d6279520c.png'),
(7, '2023-03-15', 'Digital Marketing', 'Ashlyn Jordan', 'Perempuan', 'Langkapura, Kota Bandar Lampung, Lampung', 'ashlyn.jordan@gmail.com', '081381195335', 'c6dc27673e8518b9c751bdf9a4094b0afe23107f.jpg'),
(8, '2023-03-15', 'Web Development', 'Patric Green', 'Laki-laki', 'Way Halim, Kota Bandar Lampung, Lampung', 'patric.green@gmail.com', '081366782234', '57de309cdc6eadddca798ba752f56197a974cf3d.png'),
(9, '2023-03-17', 'Mobile Development', 'Jeffery Riley', 'Laki-laki', 'Labuhan Ratu, Kota Bandar Lampung, Lampung', 'jeffery.riley@gmail.com', '081376891324', 'd6e6faf65717c420cd732445727738907eba58cd.png'),
(10, '2023-03-17', 'Data Analysis', 'Alice Doe', 'Perempuan', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'alice.doe@gmail.com', '082377883344', 'ea2612ffe3894d7c0ede840bfb31672583f71e7c.png'),
(11, '2023-03-21', 'Data Analysis', 'Jonathan Smart', 'Laki-laki', 'Kedaton, Kota Bandar Lampung, Lampung', 'jonathan.smart@gmail.com', '082373378448', '30357ff150897ccca11e26525d2843fcf1b91622.png'),
(12, '2023-03-23', 'Mobile Development', 'Mike Brown', 'Laki-laki', 'Rajabasa, Kota Bandar Lampung, Lampung', 'mike.brown@gmail.com', '082188669988', '5a8e7999a10b7e132c35b5c5de14f746df87860c.png'),
(13, '2023-03-23', 'Web Design', 'Pauline Smith', 'Perempuan', 'Teluk Betung, Kota Bandar Lampung, Lampung', 'pauline.smith@gmail.com', '085669919779', '0363ad161bcde3b53b8cd61721151fd7befd7faf.png'),
(14, '2023-03-23', 'Game Development', 'Ronnie Blake', 'Laki-laki', 'Tanjung Karang, Kota Bandar Lampung, Lampung', 'ronnie.blake@gmail.com', '082173775544', '12e8ad69d2dedf8f335cc77ab0de4d369c7304ce.png'),
(15, '2024-06-04', 'Web Development', 'Rizqi Bagus', 'Laki-laki', 'Kecamatan Sarang, Kabupaten Rembang', 'bagusrizqi@gmail.com', '0863451296543', 'd8b7ec8a752a188f7280d9c50d2e5a590203d968.jpg'),
(16, '2024-06-11', 'Digital Marketing', 'Dani', 'Laki-laki', 'Kudus', 'bagusbagus@gmail.com', '0853437965554', '36e9b2aaef2a841d137f32cd4359a3f87f7ff05f.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_pengguna`, `kata_sandi`) VALUES
(1, 'admin', '$2y$10$DhcewSbWEEHxt87zmX5zX.Y5i41tMHub0pP.ThPlZjHoECO670KGG'),
(2, 'admin1', '$2y$10$I8xoS0OkiWooww7rw.pKyesmYMQ1QiO6aSTeSYAJvbxgtGgvt7.fq');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
