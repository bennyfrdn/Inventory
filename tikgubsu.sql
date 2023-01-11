-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2020 pada 03.23
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tikgubsu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `contents` text NOT NULL,
  `admin` varchar(20) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'aktif'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sbrg_keluar`
--

CREATE TABLE `sbrg_keluar` (
  `id` int(11) NOT NULL,
  `idx` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `jam` varchar(200) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `opd` varchar(200) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `ket_kel` varchar(200) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(300) NOT NULL,
  `pengembali` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sbrg_keluar`
--

INSERT INTO `sbrg_keluar` (`id`, `idx`, `tgl`, `jam`, `jumlah`, `penerima`, `opd`, `no_hp`, `nama_petugas`, `ket_kel`, `foto`, `status`, `pengembali`) VALUES
(94, '262', '2020-10-08', '11.00', 1, 'Dedi', 'Balitbang', '082345644532', 'Anggi Faradhiba', 'Di pinjam oleh ketua', 'PKL Anggi beni andreza.pdf', 'kembali', 'Gaong'),
(95, '262', '2020-10-09', '11.00', 1, 'Dedi', 'Balitbang', '0879642836482', 'Anggi Faradhiba', 'Di pinjam oleh sekretaris', 'Pengantar Kerja Praktek.pdf', 'pinjam', ''),
(96, '262', '2020-10-09', '12.00', 1, 'Bagus ajah', 'TIK', '0835934537496', 'Anggi Faradhiba', 'Bagus', 'Pengantar Kerja Praktek.pdf', 'kembali', 'Suharto'),
(97, 'Pilih barang', '2020-11-04', '10.00', 1, 'Jennie', 'Dinas', '08235445676', 'rahmat', 'Barang baru', 'WhatsApp Image 2020-10-31 at 15.27.14.jpeg', 'Pilih status', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sbrg_masuk`
--

CREATE TABLE `sbrg_masuk` (
  `id` int(11) NOT NULL,
  `idx` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `jam` varchar(200) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `peminjam` varchar(200) NOT NULL,
  `opd` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `nama_petugas` varchar(200) NOT NULL,
  `ket_mas` varchar(300) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `berita_acara` varchar(255) NOT NULL,
  `pengembali` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `slogin`
--

CREATE TABLE `slogin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slogin`
--

INSERT INTO `slogin` (`id`, `username`, `password`, `nickname`, `role`) VALUES
(23, 'rahmat', 'af2a4c9d4c4956ec9d6ba62213eed568', 'rahmat', 'admin'),
(24, 'wahyu', '32c9e71e866ecdbc93e497482aa6779f', 'Wahyu Kusnandar', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sstock_brg`
--

CREATE TABLE `sstock_brg` (
  `idx` int(11) NOT NULL,
  `kode_barang` varchar(55) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `serial_number` varchar(40) NOT NULL,
  `stock` int(100) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `lokasi` varchar(55) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sstock_brg`
--

INSERT INTO `sstock_brg` (`idx`, `kode_barang`, `nama`, `serial_number`, `stock`, `satuan`, `lokasi`, `keterangan`) VALUES
(262, 'SW002', 'SWITCH', '5678', 3, 'Buah', 'LT. 6', 'SIMULASI'),
(261, 'SW001', 'SWITCH', '12345', 1, 'Buah', 'LT. 6', 'SIMULASI');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slogin`
--
ALTER TABLE `slogin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sstock_brg`
--
ALTER TABLE `sstock_brg`
  ADD PRIMARY KEY (`idx`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `slogin`
--
ALTER TABLE `slogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `sstock_brg`
--
ALTER TABLE `sstock_brg`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
