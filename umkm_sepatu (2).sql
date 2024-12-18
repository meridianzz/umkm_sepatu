-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2024 pada 18.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_sepatu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_admin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_admin`) VALUES
(1, 'rena', '123', 'renagaol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_brg` int(11) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `kode_kategori` varchar(50) DEFAULT NULL,
  `harga_brg` float NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `ukuran` int(11) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT NULL,
  `foto_brg` varchar(50) DEFAULT NULL,
  `deskripsi_brg` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_brg`, `nama_brg`, `kode_kategori`, `harga_brg`, `stok`, `ukuran`, `status`, `foto_brg`, `deskripsi_brg`) VALUES
(11, 'Nike Air Jordan High Pink', '7', 500000, 5, 38, 'Aktif', '1733310739_96353d0c0f4cd692b285.png', 'Sepatu basket Dengan Design Mahalsssss'),
(14, 'Black Sport', '4', 150000, 12, 40, 'Aktif', '1733336245_c34f55cfb42f851fadeb.png', 'Mahal tah sepatu apa'),
(15, 'Nike Air Jordan High Pink', '7', 500000, 5, 39, 'Aktif', '1733336193_1fbecb115d141ea2ddac.png', 'Sepatu basket Dengan Design Mahalsssss'),
(16, 'Converse 70s', '5', 450000, 5, 38, 'Aktif', '1733336323_cdde16c98af693bd918a.png', 'Conver dengan design HITAM putih dengan nuansa tahun 1970s'),
(17, 'Converse Chuck 20s', '5', 599000, 12, 41, 'Aktif', '1733336514_58e2ae693c3b2fb62dde.png', 'Converse pokoknya'),
(18, 'Nike Black', '7', 799000, 6, 41, 'Aktif', '1733336617_4a959131a903097036a8.png', 'Nike water jordan'),
(19, 'Skechers Putih Pink', '9', 459000, 5, 42, 'Aktif', '1733337134_fc6e4ce97c512224e57e.png', 'i like ur skechers'),
(20, 'Skechers Putih', '9', 479000, 4, 39, 'Aktif', '1733337388_a22d5e58dd8270f871e8.png', 'i like ur skechers'),
(21, 'Adidas Black Stripe', '3', 679000, 6, 41, 'Aktif', '17333374988451.png', 'ABIBAAAASSS'),
(22, 'NB Pink', '3', 789000, 6, 40, 'Aktif', '17333377103547.png', 'Keseimbangan Baru'),
(23, 'Puma Cream', '4', 569000, 5, 40, 'Aktif', '17333378319167.png', 'PUMAAAAAAAA'),
(24, 'Reebok Oren Biru', '8', 459000, 6, 43, 'Aktif', '17333379632084.png', 'REEBOK SIBOOK BANGET'),
(25, 'Reebook White Black Stripe', '8', 799000, 6, 41, 'Aktif', '17333380629856.png', 'REEBOK SIBOOK BANGET'),
(26, 'Reebook White Black Stripe', '8', 799000, 6, 42, 'Aktif', '17333380629856.png', 'REEBOK SIBOOK BANGET'),
(27, 'Reebook White Black Stripe', '8', 799000, 6, 43, 'Aktif', '17333380629856.png', 'REEBOK SIBOOK BANGET'),
(28, 'Reebook White Black Stripe', '8', 799000, 6, 44, 'Aktif', '17333380629856.png', 'REEBOK SIBOOK BANGET'),
(29, 'Reebook White Black Stripe', '8', 799000, 6, 39, 'Aktif', '17333380629856.png', 'REEBOK SIBOOK BANGET'),
(32, 'Nike Air Jordan High Pink', '7', 500000, 5, 39, 'Aktif', '1733310739_96353d0c0f4cd692b285.png', 'Sepatu basket Dengan Design Mahalsssss'),
(33, 'Nike Air Jordan High Pink', '7', 500000, 5, 40, 'Aktif', '1733310739_96353d0c0f4cd692b285.png', 'Sepatu basket Dengan Design Mahalsssss'),
(34, 'Nike Air Jordan High Pink', '7', 500000, 0, 41, 'Nonaktif', '1733310739_96353d0c0f4cd692b285.png', 'Sepatu basket Dengan Design Mahalsssss'),
(35, 'Nike Air Jordan High Pink', '7', 500000, 5, 42, 'Aktif', '1733310739_96353d0c0f4cd692b285.png', 'Sepatu basket Dengan Design Mahalsssss'),
(36, 'Nike Air Jordan High Pink', '7', 500000, 5, 43, 'Aktif', '1733310739_96353d0c0f4cd692b285.png', 'Sepatu basket Dengan Design Mahalsssss'),
(37, 'Black Sport', '4', 150000, 12, 41, 'Aktif', '1733336245_c34f55cfb42f851fadeb.png', 'Mahal tah sepatu apa'),
(38, 'Black Sport', '4', 150000, 12, 42, 'Aktif', '1733336245_c34f55cfb42f851fadeb.png', 'Mahal tah sepatu apa'),
(39, 'Black Sport', '4', 150000, 12, 39, 'Aktif', '1733336245_c34f55cfb42f851fadeb.png', 'Mahal tah sepatu apa'),
(40, 'Reebok Oren Biru', '8', 459000, 6, 42, 'Aktif', '17333379632084.png', 'REEBOK SIBOOK BANGET'),
(41, 'Reebok Oren Biru', '8', 459000, 6, 41, 'Nonaktif', '17333379632084.png', 'REEBOK SIBOOK BANGET'),
(42, 'Reebok Oren Biru', '8', 459000, 6, 40, 'Nonaktif', '17333379632084.png', 'REEBOK SIBOOK BANGET'),
(43, 'Reebok Oren Biru', '8', 459000, 6, 39, 'Aktif', '17333379632084.png', 'REEBOK SIBOOK BANGET'),
(44, 'Puma Cream', '4', 569000, 5, 39, 'Aktif', '17333378319167.png', 'PUMAAAAAAAA'),
(45, 'Puma Cream', '4', 569000, 5, 41, 'Nonaktif', '17333378319167.png', 'PUMAAAAAAAA'),
(46, 'Puma Cream', '4', 569000, 5, 42, 'Aktif', '17333378319167.png', 'PUMAAAAAAAA'),
(47, 'Puma Cream', '4', 569000, 5, 38, 'Aktif', '17333378319167.png', 'PUMAAAAAAAA'),
(48, 'Nike Air Jordan High Pink', '7', 500000, 5, 40, 'Aktif', '1733336193_1fbecb115d141ea2ddac.png', 'Sepatu basket Dengan Design Mahalsssss'),
(49, 'Nike Air Jordan High Pink', '7', 500000, 5, 41, 'Aktif', '1733336193_1fbecb115d141ea2ddac.png', 'Sepatu basket Dengan Design Mahalsssss'),
(50, 'Nike Air Jordan High Pink', '7', 500000, 5, 42, 'Aktif', '1733336193_1fbecb115d141ea2ddac.png', 'Sepatu basket Dengan Design Mahalsssss'),
(51, 'Nike Air Jordan High Pink', '7', 500000, 5, 43, 'Nonaktif', '1733336193_1fbecb115d141ea2ddac.png', 'Sepatu basket Dengan Design Mahalsssss'),
(52, 'Nike Air Jordan High Pink', '7', 500000, 4, 44, 'Aktif', '1733336193_1fbecb115d141ea2ddac.png', 'Sepatu basket Dengan Design Mahalsssss'),
(53, 'Converse 70s', '5', 450000, 5, 39, 'Aktif', '1733336323_cdde16c98af693bd918a.png', 'Conver dengan design HITAM putih dengan nuansa tahun 1970s'),
(54, 'Converse 70s', '5', 450000, 5, 40, 'Aktif', '1733336323_cdde16c98af693bd918a.png', 'Conver dengan design HITAM putih dengan nuansa tahun 1970s'),
(55, 'Converse 70s', '5', 450000, 5, 41, 'Nonaktif', '1733336323_cdde16c98af693bd918a.png', 'Conver dengan design HITAM putih dengan nuansa tahun 1970s'),
(56, 'Converse Chuck 20s', '5', 599000, 12, 40, 'Aktif', '1733336514_58e2ae693c3b2fb62dde.png', 'Converse pokoknya'),
(57, 'Converse Chuck 20s', '5', 599000, 12, 39, 'Nonaktif', '1733336514_58e2ae693c3b2fb62dde.png', 'Converse pokoknya'),
(58, 'Converse Chuck 20s', '5', 599000, 12, 38, 'Nonaktif', '1733336514_58e2ae693c3b2fb62dde.png', 'Converse pokoknya'),
(59, 'Converse Chuck 20s', '5', 599000, 12, 37, 'Nonaktif', '1733336514_58e2ae693c3b2fb62dde.png', 'Converse pokoknya'),
(60, 'Nike Black', '7', 799000, 8, 42, 'Aktif', '1733336617_4a959131a903097036a8.png', 'Nike water jordan'),
(61, 'Nike Black', '7', 799000, 8, 43, 'Aktif', '1733336617_4a959131a903097036a8.png', 'Nike water jordan'),
(62, 'Skechers Putih Pink', '9', 459000, 5, 43, 'Nonaktif', '1733337134_fc6e4ce97c512224e57e.png', 'i like ur skechers'),
(63, 'Skechers Putih Pink', '9', 459000, 5, 41, 'Aktif', '1733337134_fc6e4ce97c512224e57e.png', 'i like ur skechers'),
(64, 'Skechers Putih', '9', 479000, 4, 40, 'Aktif', '1733337388_a22d5e58dd8270f871e8.png', 'i like ur skechers'),
(65, 'Skechers Putih', '9', 479000, 4, 41, 'Nonaktif', '1733337388_a22d5e58dd8270f871e8.png', 'i like ur skechers'),
(66, 'Skechers Putih', '9', 479000, 4, 38, 'Aktif', '1733337388_a22d5e58dd8270f871e8.png', 'i like ur skechers');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_brgmasuk` varchar(50) NOT NULL DEFAULT 'AUTO_INCREMENT',
  `kode_supp` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `ukuran` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk_detail`
--

CREATE TABLE `barang_masuk_detail` (
  `kode_brgmskdetail` varchar(50) NOT NULL DEFAULT 'AUTO_INCREMENT',
  `kode_brgmasuk` varchar(50) NOT NULL DEFAULT '0',
  `kode_barang` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `harga` float NOT NULL DEFAULT 0,
  `total_harga` float NOT NULL DEFAULT 0,
  `ukuran` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL DEFAULT 0,
  `kode_brg` int(11) NOT NULL DEFAULT 0,
  `jumlah` int(11) NOT NULL,
  `harga_brg` double NOT NULL DEFAULT 0,
  `total_harga` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `id_penjualan`, `kode_brg`, `jumlah`, `harga_brg`, `total_harga`) VALUES
(53, 37, 14, 4, 150000, 600000),
(54, 37, 15, 1, 500000, 500000),
(56, 39, 54, 2, 450000, 900000),
(57, 40, 52, 1, 500000, 500000),
(58, 41, 18, 2, 799000, 1598000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` int(11) NOT NULL,
  `nama_kategori` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
(2, 'Adidas'),
(3, 'New Balance'),
(4, 'Puma'),
(5, 'Converse'),
(7, 'NIKE'),
(8, 'Reebook'),
(9, 'Skechers');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `kode_brg` int(11) DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `harga_brg` float UNSIGNED NOT NULL DEFAULT 0,
  `total_harga` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `username`, `kode_brg`, `jumlah`, `harga_brg`, `total_harga`) VALUES
(87, 'dapa', 36, 2, 500000, 1000000),
(88, 'bit2', 54, 1, 450000, 450000),
(89, 'bit2', 56, 1, 599000, 599000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` char(50) DEFAULT NULL,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `handphone` varchar(15) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `otp_expired_at` datetime DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `is_verified` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `username`, `password`, `email`, `handphone`, `alamat`, `otp_expired_at`, `otp_code`, `is_verified`) VALUES
(1, 'Daffa Olivian', 'dapa', '123', 'wassuuwesse@gmail.com', '087725042005', 'Pasar 1', NULL, NULL, 1),
(2, 'adirok', 'dirul', '123', 'kelas@gmail.com', '9823454563', 'asoka', NULL, NULL, 1),
(10, 'asda3wea', 'bit2', '123', 'wassuuwesse@gmail.com', '0877234234', 'asdawdasd', '2024-11-27 19:17:07', '420889', 1),
(11, 'asda2w3dsd', 'bit3', '123', 'wassuuwesse@gmail.com', '1232353245', 'dawdasdawd', '2024-11-27 19:20:57', '297243', 1),
(13, 'anajya', 'dapaolipian', '123', 'daffaolivian09@gmail.com', '45345', 'asdawdwa', '2024-11-27 19:28:52', '157342', 1),
(15, 'dasoidawiod', 'gaawk3000', '123', 'newsc6050@gmail.com', '89247528397', 'skldjlkwjd', '2024-12-05 04:01:00', '743105', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `kode_pembayaran` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_pelanggan` int(11) DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bukti_bayar` varchar(200) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_pelanggan`, `total_harga`, `status`, `bukti_bayar`, `tanggal_pembelian`) VALUES
(37, 1, 1100000, 'Selesai', '1.jpg', '2024-12-04 18:02:26'),
(39, 1, 900000, 'Dibatalkan', 'b2bc440b90af7d4e1cbf0903fd7b0f43-removebg-preview.png', '2024-12-05 03:02:43'),
(40, 1, 500000, 'Selesai', '1.jpg', '2024-12-05 03:51:44'),
(41, 1, 1598000, 'Proses', '1.jpg', '2024-12-05 05:15:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `kode_supp` int(11) NOT NULL,
  `nama_supp` char(50) NOT NULL DEFAULT '0',
  `handphone` int(15) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kode_supp`, `nama_supp`, `handphone`) VALUES
(3, 'Pak Anton', 2147483647),
(5, 'Pak Sep', 444444);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_brg`) USING BTREE,
  ADD KEY `FK_barang_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`kode_brgmasuk`),
  ADD KEY `FK_barang_masuk_supplier` (`kode_supp`);

--
-- Indeks untuk tabel `barang_masuk_detail`
--
ALTER TABLE `barang_masuk_detail`
  ADD PRIMARY KEY (`kode_brgmskdetail`),
  ADD KEY `FK_barang_masuk_detail_barang_masuk` (`kode_brgmasuk`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`) USING BTREE,
  ADD KEY `FK_penjualan_detail_barang` (`kode_brg`),
  ADD KEY `FK_penjualan_detail_penjualan` (`id_penjualan`) USING BTREE;

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_keranjang_barang` (`kode_brg`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`kode_pembayaran`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `FK_penjualan_pelanggan` (`kode_pelanggan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `kode_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `kode_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `kode_supp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `FK_barang_masuk_supplier` FOREIGN KEY (`kode_supp`) REFERENCES `supplier` (`kode_supp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `barang_masuk_detail`
--
ALTER TABLE `barang_masuk_detail`
  ADD CONSTRAINT `FK_barang_masuk_detail_barang_masuk` FOREIGN KEY (`kode_brgmasuk`) REFERENCES `barang_masuk` (`kode_brgmasuk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `FK_detail_penjualan_barang` FOREIGN KEY (`kode_brg`) REFERENCES `barang` (`kode_brg`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_detail_penjualan_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_keranjang_barang` FOREIGN KEY (`kode_brg`) REFERENCES `barang` (`kode_brg`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `FK_penjualan_pelanggan` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
