-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 07:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `productid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`productid`, `orderid`, `price`, `quantity`) VALUES
(1, 1, 20000, 1),
(2, 1, 30000, 1),
(1, 2, 20000, 1),
(1, 3, 20000, 1),
(2, 3, 30000, 1),
(28, 3, 10000, 1),
(2, 4, 30000, 1),
(2, 4, 30000, 1),
(1, 5, 20000, 1),
(1, 8, 20000, 1),
(5, 8, 20000, 1),
(1, 10, 20000, 1),
(6, 10, 15000, 1),
(19, 10, 12000, 1),
(17, 10, 15500, 1),
(12, 11, 12000, 1),
(12, 11, 12000, 1),
(1, 15, 20000, 1),
(66, 20, 200000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `datecreation`, `status`, `user`) VALUES
(1, 'New Order', '2021-12-12 13:54:17', 0, 'kasir1'),
(2, 'New Order', '2021-12-12 13:55:16', 0, 'kasir1'),
(3, 'New Order', '2021-12-12 14:28:08', 0, 'kasir1'),
(4, 'New Order', '2021-12-12 14:28:46', 0, 'kasir1'),
(5, 'New Order', '2021-12-12 14:33:17', 0, 'kasir1'),
(6, 'New Order', '2021-12-12 14:34:26', 0, 'kasir1'),
(7, 'New Order', '2021-12-12 14:34:51', 0, 'kasir1'),
(8, 'New Order', '2021-12-12 14:34:59', 0, 'kasir1'),
(9, 'New Order', '2021-12-12 14:35:08', 0, 'kasir1'),
(10, 'New Order', '2021-12-12 14:35:38', 0, 'kasir1'),
(11, 'New Order', '2021-12-13 06:05:48', 0, 'kasir1'),
(12, 'New Order', '2021-12-13 06:06:43', 0, 'kasir1'),
(13, 'New Order', '2021-12-13 06:07:00', 0, 'kasir1'),
(14, 'New Order', '2021-12-13 06:07:40', 0, 'kasir1'),
(15, 'New Order', '2021-12-13 06:09:02', 0, 'kasir1'),
(16, 'New Order', '2021-12-13 06:09:40', 0, 'kasir1'),
(17, 'New Order', '2021-12-13 06:10:03', 0, 'kasir1'),
(18, 'New Order', '2021-12-13 06:10:26', 0, 'kasir1'),
(19, 'New Order', '2021-12-13 06:11:48', 0, 'kasir1'),
(20, 'New Order', '2021-12-13 06:15:48', 0, 'kasir1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `user` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user`, `pass`) VALUES
('admin1', 'admin1'),
('admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `ID_Barang` varchar(6) CHARACTER SET latin1 NOT NULL,
  `Nama_Barang` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Harga` int(11) NOT NULL,
  `Stok` int(11) NOT NULL,
  `ID_Supplier` varchar(4) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`ID_Barang`, `Nama_Barang`, `Harga`, `Stok`, `ID_Supplier`) VALUES
('AAA001', 'Piring Cantik', 20000, 20, 'SP01'),
('AAA002', 'Sendok Makan', 30000, 20, 'SP01'),
('AAA003', 'Gelas Minum', 15000, 35, 'SP01'),
('AAA004', 'Garpu Makan', 25000, 30, 'SP01'),
('AAA005', 'Botol Minum', 20000, 25, 'SP01'),
('AAA006', 'Mug', 15000, 10, 'SP01'),
('AAA007', 'Teko', 25000, 20, 'SP01'),
('AAA008', 'Tumbler', 30000, 5, 'SP01'),
('AAA009', 'Cangkir', 20000, 15, 'SP01'),
('AAA010', 'Taplak Meja', 35000, 30, 'SP01'),
('AAA011', 'Lays', 15000, 30, 'SP02'),
('AAA012', 'Chitato', 12000, 35, 'SP02'),
('AAA013', 'Kusuka', 10500, 40, 'SP02'),
('AAA014', 'Cheetos', 13000, 25, 'SP02'),
('AAA015', 'Pringles', 15000, 30, 'SP02'),
('AAA016', 'Taro', 12500, 30, 'SP02'),
('AAA017', 'Maichi', 15500, 35, 'SP02'),
('AAA018', 'TicTac', 10000, 20, 'SP02'),
('AAA019', 'Qtela', 12000, 10, 'SP02'),
('AAA020', 'Doritos', 20000, 20, 'SP02'),
('AAA021', 'Pisau', 25000, 30, 'SP03'),
('AAA022', 'Panci', 30000, 20, 'SP03'),
('AAA023', 'Talenan', 25000, 25, 'SP03'),
('AAA024', 'Spatula', 20000, 20, 'SP03'),
('AAA025', 'Timbangan Dapur', 30000, 10, 'SP03'),
('AAA026', 'Blender', 50000, 10, 'SP03'),
('AAA027', 'Sendok Ukur', 20000, 15, 'SP03'),
('AAA028', 'Gunting', 10000, 30, 'SP03'),
('AAA029', 'Food Processor', 90000, 5, 'SP03'),
('AAA030', 'Penyaring', 25000, 20, 'SP03'),
('AAA031', 'Stop Kontak', 20000, 20, 'SP04'),
('AAA032', 'Saklar Listrik', 15000, 15, 'SP04'),
('AAA033', 'Steker Listrik', 15000, 10, 'SP04'),
('AAA034', 'Fitting Lampu', 10000, 15, 'SP04'),
('AAA035', 'Kabel Listrik', 5000, 50, 'SP04'),
('AAA036', 'Terminal Listrik', 30000, 20, 'SP04'),
('AAA037', 'Soket Listrik', 15000, 15, 'SP04'),
('AAA038', 'Lampu Neon', 25000, 30, 'SP04'),
('AAA039', 'Led Strip', 30000, 5, 'SP04'),
('AAA040', 'Lampu Led', 20000, 20, 'SP04'),
('AAA041', 'Meja Makan', 150000, 5, 'SP05'),
('AAA042', 'Kursi Makan', 50000, 20, 'SP05'),
('AAA043', 'Lemari Baju', 80000, 10, 'SP05'),
('AAA044', 'Hanger', 10000, 25, 'SP05'),
('AAA045', 'Rak Buku', 95000, 15, 'SP05'),
('AAA046', 'Jemuran', 70000, 10, 'SP05'),
('AAA047', 'Kasur', 200000, 10, 'SP05'),
('AAA048', 'Bantal', 25000, 20, 'SP05'),
('AAA049', 'Selimut', 60000, 20, 'SP05'),
('AAA050', 'Cermin', 50000, 25, 'SP05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_baru`
--

CREATE TABLE `tbl_barang_baru` (
  `ID_Barang` varchar(6) CHARACTER SET latin1 NOT NULL,
  `Nama_Barang` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Harga` int(11) NOT NULL,
  `Stok` int(11) NOT NULL,
  `ID_Supplier` varchar(4) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang_baru`
--

INSERT INTO `tbl_barang_baru` (`ID_Barang`, `Nama_Barang`, `Harga`, `Stok`, `ID_Supplier`) VALUES
('001', 'Piring Cantik', 20000, 20, 'SP01'),
('002', 'Sendok Makan', 30000, 20, 'SP01'),
('003', 'Gelas Minum', 15000, 35, 'SP01'),
('004', 'Garpu Makan', 25000, 30, 'SP01'),
('005', 'Botol Minum', 20000, 25, 'SP01'),
('006', 'Mug', 15000, 10, 'SP01'),
('007', 'Teko', 25000, 20, 'SP01'),
('008', 'Tumbler', 30000, 5, 'SP01'),
('009', 'Cangkir', 20000, 15, 'SP01'),
('010', 'Taplak Meja', 35000, 30, 'SP01'),
('011', 'Lays', 15000, 30, 'SP02'),
('012', 'Chitato', 12000, 35, 'SP02'),
('013', 'Kusuka', 10500, 40, 'SP02'),
('014', 'Cheetos', 13000, 25, 'SP02'),
('015', 'Pringles', 15000, 30, 'SP02'),
('016', 'Taro', 12500, 30, 'SP02'),
('017', 'Maichi', 15500, 35, 'SP02'),
('018', 'TicTac', 10000, 20, 'SP02'),
('019', 'Qtela', 12000, 10, 'SP02'),
('020', 'Doritos', 20000, 20, 'SP02'),
('021', 'Pisau', 25000, 30, 'SP03'),
('022', 'Panci', 30000, 20, 'SP03'),
('023', 'Talenan', 25000, 25, 'SP03'),
('024', 'Spatula', 20000, 20, 'SP03'),
('025', 'Timbangan Dapur', 30000, 10, 'SP03'),
('026', 'Blender', 50000, 10, 'SP03'),
('027', 'Sendok Ukur', 20000, 15, 'SP03'),
('028', 'Gunting', 10000, 30, 'SP03'),
('029', 'Food Processor', 90000, 5, 'SP03'),
('030', 'Penyaring', 25000, 20, 'SP03'),
('031', 'Stop Kontak', 20000, 20, 'SP04'),
('032', 'Saklar Listrik', 15000, 15, 'SP04'),
('033', 'Steker Listrik', 15000, 10, 'SP04'),
('034', 'Fitting Lampu', 10000, 15, 'SP04'),
('035', 'Kabel Listrik', 5000, 50, 'SP04'),
('036', 'Terminal Listrik', 30000, 20, 'SP04'),
('037', 'Soket Listrik', 15000, 15, 'SP04'),
('038', 'Lampu Neon', 25000, 30, 'SP04'),
('039', 'Led Strip', 30000, 5, 'SP04'),
('040', 'Lampu Led', 20000, 20, 'SP04'),
('041', 'Meja Makan', 150000, 5, 'SP05'),
('042', 'Kursi Makan', 50000, 20, 'SP05'),
('043', 'Lemari Baju', 80000, 10, 'SP05'),
('044', 'Hanger', 10000, 25, 'SP05'),
('045', 'Rak Buku', 95000, 15, 'SP05'),
('046', 'Jemuran', 70000, 10, 'SP05'),
('047', 'Kasur', 200000, 10, 'SP05'),
('048', 'Bantal', 25000, 20, 'SP05'),
('049', 'Selimut', 60000, 20, 'SP05'),
('050', 'Cermin', 50000, 25, 'SP05'),
('051', 'apa aja', 1111, 1, 'sp00'),
('111', 'testcart', 100, 11, 'sp4'),
('66', 'Sepeda engkol', 200000, 1, 'SP99');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasir`
--

CREATE TABLE `tbl_kasir` (
  `user` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kasir`
--

INSERT INTO `tbl_kasir` (`user`, `pass`) VALUES
('kasir1', 'kasir1'),
('kasir2', 'kasir2'),
('kasir3', 'kasir3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `ID_Supplier` varchar(4) NOT NULL,
  `Nama_Supplier` varchar(20) NOT NULL,
  `Telp` char(13) NOT NULL,
  `Alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`ID_Supplier`, `Nama_Supplier`, `Telp`, `Alamat`) VALUES
('SP01', 'PT Peralatan Makan', '0899128231267', 'Salatiga, Jawa Tengah, Indonesia'),
('SP02', 'PT Makanan Enak', '0897364500921', 'Semarang, Jawa Tengah, Indonesia'),
('SP03', 'PT Peralatan Dapur', '0859127231845', 'Bogor, Jawa Barat, Indonesia'),
('SP04', 'PT Peralatan Listrik', '0849225231134', 'Bandung, Jawa Barat, Indonesia'),
('SP05', 'PT Perabot Rumah', '0879589331646', 'Surabaya, Jawa Timur, Indonesia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`ID_Barang`);

--
-- Indexes for table `tbl_barang_baru`
--
ALTER TABLE `tbl_barang_baru`
  ADD PRIMARY KEY (`ID_Barang`);

--
-- Indexes for table `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
