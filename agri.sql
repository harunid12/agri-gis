-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2024 pada 15.35
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sawah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dusun`
--

CREATE TABLE `dusun` (
  `id_dusun` int(11) NOT NULL,
  `nama_dusun` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dusun`
--

INSERT INTO `dusun` (`id_dusun`, `nama_dusun`, `created_at`, `updated_at`) VALUES
(1, 'Pematang Gajah oke', '2024-12-29 07:04:20', '2024-12-29 07:21:26'),
(4, 'palembang', '2024-12-30 00:50:43', '2024-12-30 00:50:43'),
(5, 'Monas', '2024-12-30 06:29:36', '2024-12-30 06:29:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komoditas`
--

CREATE TABLE `komoditas` (
  `id_komoditas` int(11) NOT NULL,
  `nama_tanaman` varchar(255) DEFAULT NULL,
  `kode_warna` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komoditas`
--

INSERT INTO `komoditas` (`id_komoditas`, `nama_tanaman`, `kode_warna`, `created_at`, `updated_at`) VALUES
(1, 'sawit', 'hijau', '2024-12-29 07:49:52', '2024-12-29 07:49:52'),
(4, 'Jati', 'coklat', '2024-12-30 06:29:45', '2024-12-30 06:29:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lahan`
--

CREATE TABLE `lahan` (
  `koordinat_poligon` polygon DEFAULT NULL,
  `id_lahan` int(11) NOT NULL,
  `id_komoditas` int(11) DEFAULT NULL,
  `id_dusun` int(11) DEFAULT NULL,
  `alamat_lahan` varchar(255) DEFAULT NULL,
  `luas_lahan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lahan`
--

INSERT INTO `lahan` (`koordinat_poligon`, `id_lahan`, `id_komoditas`, `id_dusun`, `alamat_lahan`, `luas_lahan`, `created_at`, `updated_at`) VALUES
(0x0000000001030000000100000005000000a54a94bda5b45a40b874cc79c6ae18c072a8df85adb45a40317daf2138ae18c0632afd84b3b45a40512ff83427af18c0f6d4eaababb45a40d926158db5af18c0a54a94bda5b45a40b874cc79c6ae18c0, 1, 1, 4, 'jambi', '2000 Ha', NULL, '2024-12-30 07:32:09'),
(0x0000000001030000000100000005000000a54a94bda5b45a40b874cc79c6ae18c072a8df85adb45a40317daf2138ae18c0632afd84b3b45a40512ff83427af18c0f6d4eaababb45a40d926158db5af18c0a54a94bda5b45a40b874cc79c6ae18c0, 4, 4, 5, 'Jakarta Pusat', '10 Ha', '2024-12-30 06:30:16', '2024-12-30 06:31:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `no_hp`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, '082271212178', 'noelobed@gmail.com', 'admin_agri', '$2y$10$Tn3vvM6v0fcGFkEZ15PfBueL/r/87NMliyzbXgL7DAJ0FW9wQ76.y', NULL, '2024-12-29 02:30:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id_dusun`);

--
-- Indeks untuk tabel `komoditas`
--
ALTER TABLE `komoditas`
  ADD PRIMARY KEY (`id_komoditas`);

--
-- Indeks untuk tabel `lahan`
--
ALTER TABLE `lahan`
  ADD PRIMARY KEY (`id_lahan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id_dusun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `komoditas`
--
ALTER TABLE `komoditas`
  MODIFY `id_komoditas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lahan`
--
ALTER TABLE `lahan`
  MODIFY `id_lahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
