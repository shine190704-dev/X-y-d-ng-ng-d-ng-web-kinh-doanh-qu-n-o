-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2025 at 01:16 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlybanhang`
--
CREATE DATABASE IF NOT EXISTS `quanlybanhang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `quanlybanhang`;

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `ChiTietDonHangID` int NOT NULL AUTO_INCREMENT,
  `DonHangID` int DEFAULT NULL,
  `ChiTietSanPhamID` int DEFAULT NULL,
  `SoLuong` int DEFAULT NULL,
  `DonGia` decimal(10,2) DEFAULT NULL,
  `ThanhTien` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ChiTietDonHangID`),
  KEY `fk_ctdh_donhang` (`DonHangID`),
  KEY `fk_ctdh_ctsp` (`ChiTietSanPhamID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ChiTietDonHangID`, `DonHangID`, `ChiTietSanPhamID`, `SoLuong`, `DonGia`, `ThanhTien`) VALUES
(1, 1, 13, 4, 720000.00, 2880000.00),
(2, 1, 5, 1, 600000.00, 600000.00),
(3, 2, 4, 1, 600000.00, 600000.00),
(4, 3, 1, 2, 500000.00, 1000000.00),
(5, 4, 5, 1, 600000.00, 600000.00),
(6, 5, 22, 1, 900000.00, 900000.00),
(7, 6, 4, 1, 600000.00, 600000.00),
(8, 7, 9, 1, 600000.00, 600000.00),
(9, 8, 1, 2, 500000.00, 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `chitietsanpham`
--

DROP TABLE IF EXISTS `chitietsanpham`;
CREATE TABLE IF NOT EXISTS `chitietsanpham` (
  `ChiTietSanPhamID` int NOT NULL AUTO_INCREMENT,
  `SanPhamID` int DEFAULT NULL,
  `MauSac` varchar(50) DEFAULT NULL,
  `KichCo` varchar(50) DEFAULT NULL,
  `DonGia` decimal(10,2) DEFAULT NULL,
  `SoLuongTonKho` int DEFAULT '0',
  `Gia` decimal(10,2) DEFAULT NULL,
  `MaQuanLyKho` varchar(50) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `NgayCapNhat` datetime DEFAULT NULL,
  PRIMARY KEY (`ChiTietSanPhamID`),
  UNIQUE KEY `MaQuanLyKho` (`MaQuanLyKho`),
  KEY `fk_ctsp_sanpham` (`SanPhamID`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chitietsanpham`
--

INSERT INTO `chitietsanpham` (`ChiTietSanPhamID`, `SanPhamID`, `MauSac`, `KichCo`, `DonGia`, `SoLuongTonKho`, `Gia`, `MaQuanLyKho`, `NgayTao`, `NgayCapNhat`) VALUES
(1, 1, 'Xanh', 'S', 500000.00, 0, 500000.00, 'C01-Xanh-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(2, 1, 'Xanh', 'M', 500000.00, 0, 500000.00, 'C01-Xanh-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(3, 1, 'Xanh', 'L', 500000.00, 0, 500000.00, 'C01-Xanh-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(4, 2, 'Vang', 'S', 600000.00, 0, 600000.00, 'C02-Vang-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(5, 2, 'Vang', 'M', 600000.00, 0, 600000.00, 'C02-Vang-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(6, 2, 'Vang', 'L', 600000.00, 0, 600000.00, 'C02-Vang-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(7, 2, 'Xanh', 'S', 600000.00, 0, 600000.00, 'C02-Xanh-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(8, 2, 'Xanh', 'M', 600000.00, 0, 600000.00, 'C02-Xanh-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(9, 2, 'Xanh', 'L', 600000.00, 0, 600000.00, 'C02-Xanh-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(10, 3, 'Xanh', 'S', 620000.00, 0, 620000.00, 'C03-Xanh-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(11, 3, 'Xanh', 'M', 620000.00, 0, 620000.00, 'C03-Xanh-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(12, 3, 'Xanh', 'L', 620000.00, 0, 620000.00, 'C03-Xanh-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(13, 4, 'Vang', 'S', 720000.00, 0, 720000.00, 'C04-Vang-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(14, 4, 'Vang', 'M', 720000.00, 0, 720000.00, 'C04-Vang-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(15, 4, 'Vang', 'L', 720000.00, 0, 720000.00, 'C04-Vang-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(16, 4, 'Trang', 'S', 720000.00, 0, 720000.00, 'C04-Trang-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(17, 4, 'Trang', 'M', 720000.00, 0, 720000.00, 'C04-Trang-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(18, 4, 'Trang', 'L', 720000.00, 0, 720000.00, 'C04-Trang-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(19, 5, 'Hong', 'S', 680000.00, 0, 680000.00, 'C05-Hong-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(20, 5, 'Hong', 'M', 680000.00, 0, 680000.00, 'C05-Hong-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(21, 5, 'Hong', 'L', 680000.00, 0, 680000.00, 'C05-Hong-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(22, 6, 'Nau', 'S', 900000.00, 0, 900000.00, 'C06-Nau-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(23, 6, 'Nau', 'M', 900000.00, 0, 900000.00, 'C06-Nau-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(24, 6, 'Nau', 'L', 900000.00, 0, 900000.00, 'C06-Nau-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(25, 7, 'Xanh', 'S', 600000.00, 0, 600000.00, 'C07-Xanh-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(26, 7, 'Xanh', 'M', 600000.00, 0, 600000.00, 'C07-Xanh-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(27, 7, 'Xanh', 'L', 600000.00, 0, 600000.00, 'C07-Xanh-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(28, 8, 'Xanh', 'S', 720000.00, 0, 720000.00, 'C08-Xanh-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(29, 8, 'Xanh', 'M', 720000.00, 0, 720000.00, 'C08-Xanh-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(30, 8, 'Xanh', 'L', 720000.00, 0, 720000.00, 'C08-Xanh-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(31, 9, 'Den', 'S', 650000.00, 0, 650000.00, 'C09-Den-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(32, 9, 'Den', 'M', 650000.00, 0, 650000.00, 'C09-Den-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(33, 9, 'Den', 'L', 650000.00, 0, 650000.00, 'C09-Den-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(34, 9, 'Xanh', 'S', 650000.00, 0, 650000.00, 'C09-Xanh-S', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(35, 9, 'Xanh', 'M', 650000.00, 0, 650000.00, 'C09-Xanh-M', '2025-11-29 16:26:24', '2025-11-29 16:26:24'),
(36, 9, 'Xanh', 'L', 650000.00, 0, 650000.00, 'C09-Xanh-L', '2025-11-29 16:26:24', '2025-11-29 16:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

DROP TABLE IF EXISTS `danhgia`;
CREATE TABLE IF NOT EXISTS `danhgia` (
  `DanhGiaID` int NOT NULL AUTO_INCREMENT,
  `SanPhamID` int DEFAULT NULL,
  `KhachHangID` int DEFAULT NULL,
  `SoSao` int DEFAULT NULL,
  `BinhLuan` text,
  `NgayDanhGia` datetime DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT NULL,
  PRIMARY KEY (`DanhGiaID`),
  KEY `fk_danhgia_sanpham` (`SanPhamID`),
  KEY `fk_danhgia_khachhang` (`KhachHangID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `DonHangID` int NOT NULL AUTO_INCREMENT,
  `KhachHangID` int DEFAULT NULL,
  `NgayDat` datetime DEFAULT NULL,
  `TongTien` decimal(10,2) DEFAULT NULL,
  `TrangThai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `DiaChiGiaoHang` varchar(250) DEFAULT NULL,
  `GhiChu` text,
  `PhuongThucThanhToan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`DonHangID`),
  KEY `fk_donhang_khachhang` (`KhachHangID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`DonHangID`, `KhachHangID`, `NgayDat`, `TongTien`, `TrangThai`, `DiaChiGiaoHang`, `GhiChu`, `PhuongThucThanhToan`) VALUES
(1, 3, '2025-12-10 01:21:08', 3515000.00, 'Đang chờ xử lý', 'quan 8, HCM, ', '', 'cod'),
(2, 3, '2025-12-10 01:32:05', 635000.00, 'Đang chờ xử lý', 'quan7, HCM, ', '', 'cod'),
(3, 3, '2025-12-10 01:53:44', 1035000.00, 'Đang chờ xử lý', 'quan 8, HCM, ', '', 'cod'),
(4, 3, '2025-12-10 01:54:27', 635000.00, 'Đang chờ xử lý', 'quan 8, HCM, ', '', 'cod'),
(5, 3, '2025-12-10 02:01:44', 935000.00, 'Đang chờ xử lý', 'quan 8, HCM, ', '', 'bank'),
(6, 3, '2025-12-10 10:31:45', 635000.00, 'Đang chờ xử lý', 'quan 8, HCM, ', '', 'cod'),
(7, 3, '2025-12-10 12:52:20', 635000.00, 'Đang chờ xử lý', 'quan 8, HN', '', 'bank'),
(8, 3, '2025-12-10 16:48:16', 1035000.00, 'Đang chờ xử lý', 'quan 8, HCM', '', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

DROP TABLE IF EXISTS `giohang`;
CREATE TABLE IF NOT EXISTS `giohang` (
  `GioHangID` int NOT NULL AUTO_INCREMENT,
  `KhachHangID` int DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT NULL,
  PRIMARY KEY (`GioHangID`),
  KEY `fk_gh_khachhang` (`KhachHangID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`GioHangID`, `KhachHangID`, `TrangThai`) VALUES
(2, 2, b'0'),
(3, 3, b'1'),
(4, 3, b'1'),
(5, 3, b'1'),
(6, 3, b'1'),
(7, 3, b'1'),
(8, 3, b'1'),
(9, 3, b'1'),
(10, 3, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `giohangchitiet`
--

DROP TABLE IF EXISTS `giohangchitiet`;
CREATE TABLE IF NOT EXISTS `giohangchitiet` (
  `GioHangChiTietID` int NOT NULL AUTO_INCREMENT,
  `GioHangID` int DEFAULT NULL,
  `ChiTietSanPhamID` int DEFAULT NULL,
  `SoLuong` int DEFAULT NULL,
  `DonGia` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`GioHangChiTietID`),
  KEY `fk_ghct_gh` (`GioHangID`),
  KEY `fk_ghct_ctsp` (`ChiTietSanPhamID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `giohangchitiet`
--

INSERT INTO `giohangchitiet` (`GioHangChiTietID`, `GioHangID`, `ChiTietSanPhamID`, `SoLuong`, `DonGia`) VALUES
(4, 2, 16, 1, 500000.00),
(5, 2, 4, 4, 600000.00),
(7, 2, 22, 1, 900000.00),
(8, 2, 31, 1, 650000.00),
(9, 2, 28, 2, 720000.00),
(10, 2, 5, 1, 600000.00),
(11, 3, 13, 4, 720000.00),
(12, 3, 5, 1, 600000.00),
(13, 4, 4, 1, 600000.00),
(14, 5, 1, 2, 500000.00),
(15, 6, 5, 1, 600000.00),
(16, 7, 22, 1, 900000.00),
(17, 8, 4, 1, 600000.00),
(18, 9, 9, 1, 600000.00),
(19, 10, 1, 2, 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `hinhanhsanpham`
--

DROP TABLE IF EXISTS `hinhanhsanpham`;
CREATE TABLE IF NOT EXISTS `hinhanhsanpham` (
  `HinhAnhID` int NOT NULL AUTO_INCREMENT,
  `SanPhamID` int DEFAULT NULL,
  `DuongDan` varchar(300) DEFAULT NULL,
  `LaHinhDaiDien` bit(1) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  PRIMARY KEY (`HinhAnhID`),
  KEY `fk_hasp_sanpham` (`SanPhamID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hinhanhsanpham`
--

INSERT INTO `hinhanhsanpham` (`HinhAnhID`, `SanPhamID`, `DuongDan`, `LaHinhDaiDien`, `NgayTao`) VALUES
(1, 1, 'pic6_1.png', b'1', '2025-11-29 16:25:24'),
(2, 1, 'pic6_2.png', b'0', '2025-11-29 16:25:24'),
(3, 1, 'pic6_3.png', b'0', '2025-11-29 16:25:24'),
(4, 1, 'pic6_4.png', b'0', '2025-11-29 16:25:24'),
(5, 2, 'pic2_1.png', b'1', '2025-11-29 16:25:24'),
(6, 2, 'pic2_2.png', b'0', '2025-11-29 16:25:24'),
(7, 2, 'pic2_3.png', b'0', '2025-11-29 16:25:24'),
(8, 2, 'pic2_4.png', b'0', '2025-11-29 16:25:24'),
(9, 3, 'pic9_1.png', b'1', '2025-11-29 16:25:24'),
(10, 3, 'pic9_2.png', b'0', '2025-11-29 16:25:24'),
(11, 3, 'pic9_3.png', b'0', '2025-11-29 16:25:24'),
(12, 3, 'pic9_4.png', b'0', '2025-11-29 16:25:24'),
(13, 4, 'pic3_1.png', b'1', '2025-11-29 16:25:24'),
(14, 4, 'pic3_2.png', b'0', '2025-11-29 16:25:24'),
(15, 4, 'pic3_3.png', b'0', '2025-11-29 16:25:24'),
(16, 4, 'pic3_4.png', b'0', '2025-11-29 16:25:24'),
(17, 5, 'pic1_1.png', b'1', '2025-11-29 16:25:24'),
(18, 5, 'pic1_2.png', b'0', '2025-11-29 16:25:24'),
(19, 5, 'pic1_3.png', b'0', '2025-11-29 16:25:24'),
(20, 5, 'pic1_4.png', b'0', '2025-11-29 16:25:24'),
(21, 6, 'pic8_1.png', b'1', '2025-11-29 16:25:24'),
(22, 6, 'pic8_2.png', b'0', '2025-11-29 16:25:24'),
(23, 6, 'pic8_3.png', b'0', '2025-11-29 16:25:24'),
(24, 6, 'pic8_4.png', b'0', '2025-11-29 16:25:24'),
(25, 7, 'pic4_1.png', b'1', '2025-11-29 16:25:24'),
(26, 7, 'pic4_2.png', b'0', '2025-11-29 16:25:24'),
(27, 7, 'pic4_3.png', b'0', '2025-11-29 16:25:24'),
(28, 7, 'pic4_4.png', b'0', '2025-11-29 16:25:24'),
(29, 8, 'pic7_1.png', b'1', '2025-11-29 16:25:24'),
(30, 8, 'pic7_2.png', b'0', '2025-11-29 16:25:24'),
(31, 8, 'pic7_3.png', b'0', '2025-11-29 16:25:24'),
(32, 8, 'pic7_4.png', b'0', '2025-11-29 16:25:24'),
(33, 9, 'pic5_1.png', b'1', '2025-11-29 16:25:24'),
(34, 9, 'pic5_2.png', b'0', '2025-11-29 16:25:24'),
(35, 9, 'pic5_3.png', b'0', '2025-11-29 16:25:24'),
(36, 9, 'pic5_4.png', b'0', '2025-11-29 16:25:24'),
(39, 2, 'pic2_1.png', b'1', NULL),
(40, 5, 'pic1_1.png', b'1', NULL),
(41, 4, 'pic3_1.png', b'1', NULL),
(42, 1, 'pic6_1.png', b'1', NULL),
(43, 7, 'pic4_1.png', b'1', NULL),
(44, 3, 'pic9_1.png', b'1', NULL),
(45, 8, 'pic7_1.png', b'1', NULL),
(46, 6, 'pic8_1.png', b'1', NULL),
(47, 6, 'pic8_1.png', b'1', NULL),
(48, 9, 'pic5_1.png', b'1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `KhachHangID` int NOT NULL AUTO_INCREMENT,
  `TaiKhoanID` int NOT NULL,
  `HoTen` varchar(250) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(50) DEFAULT NULL,
  `SoDienThoai` varchar(50) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  PRIMARY KEY (`KhachHangID`),
  UNIQUE KEY `TaiKhoanID` (`TaiKhoanID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`KhachHangID`, `TaiKhoanID`, `HoTen`, `Email`, `DiaChi`, `SoDienThoai`, `NgayTao`) VALUES
(2, 12, 'khách hàng', 'kieutho@mail.com', '', '1234567890', '2025-12-06 16:17:31'),
(3, 15, 'shine', 'shine19@gmail.com', '', '0707677190', '2025-12-09 22:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `kho`
--

DROP TABLE IF EXISTS `kho`;
CREATE TABLE IF NOT EXISTS `kho` (
  `KhoID` int NOT NULL AUTO_INCREMENT,
  `ChiTietSanPhamID` int NOT NULL,
  `SoLuongTonKho` int NOT NULL,
  `NgayCapNhat` datetime NOT NULL,
  PRIMARY KEY (`KhoID`),
  KEY `fk_kho_ctsp` (`ChiTietSanPhamID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kho`
--

INSERT INTO `kho` (`KhoID`, `ChiTietSanPhamID`, `SoLuongTonKho`, `NgayCapNhat`) VALUES
(1, 1, 100, '2025-12-07 00:58:10'),
(2, 2, 100, '2025-12-07 00:58:10'),
(3, 3, 100, '2025-12-07 00:58:10'),
(4, 4, 100, '2025-12-07 00:58:10'),
(5, 5, 100, '2025-12-07 00:58:10'),
(6, 6, 100, '2025-12-07 00:58:10'),
(7, 7, 100, '2025-12-07 00:58:10'),
(8, 8, 100, '2025-12-07 00:58:10'),
(9, 9, 100, '2025-12-07 00:58:10'),
(10, 10, 100, '2025-12-07 00:58:10'),
(11, 11, 100, '2025-12-07 00:58:10'),
(12, 12, 100, '2025-12-07 00:58:10'),
(13, 13, 100, '2025-12-07 00:58:10'),
(14, 14, 100, '2025-12-07 00:58:10'),
(15, 15, 100, '2025-12-07 00:58:10'),
(16, 16, 100, '2025-12-07 00:58:10'),
(17, 17, 100, '2025-12-07 00:58:10'),
(18, 18, 100, '2025-12-07 00:58:10'),
(19, 19, 100, '2025-12-07 00:58:10'),
(20, 20, 100, '2025-12-07 00:58:10'),
(21, 21, 100, '2025-12-07 00:58:10'),
(22, 22, 100, '2025-12-07 00:58:10'),
(23, 23, 100, '2025-12-07 00:58:10'),
(24, 24, 100, '2025-12-07 00:58:10'),
(25, 25, 100, '2025-12-07 00:58:10'),
(26, 26, 100, '2025-12-07 00:58:10'),
(27, 27, 100, '2025-12-07 00:58:10'),
(28, 28, 100, '2025-12-07 00:58:10'),
(29, 29, 100, '2025-12-07 00:58:10'),
(30, 30, 100, '2025-12-07 00:58:10'),
(31, 31, 100, '2025-12-07 00:58:10'),
(32, 32, 100, '2025-12-07 00:58:10'),
(33, 33, 100, '2025-12-07 00:58:10'),
(34, 34, 100, '2025-12-07 00:58:10'),
(35, 35, 100, '2025-12-07 00:58:10'),
(36, 36, 100, '2025-12-07 00:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `KhuyenMaiID` int NOT NULL AUTO_INCREMENT,
  `MaKhuyenMai` varchar(50) DEFAULT NULL,
  `TenKhuyenMai` varchar(50) DEFAULT NULL,
  `MoTa` text,
  `LoaiGiamGia` varchar(50) DEFAULT NULL,
  `GiaTri` decimal(10,2) DEFAULT NULL,
  `NgayBatDau` datetime DEFAULT NULL,
  `NgayKetThuc` datetime DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT NULL,
  PRIMARY KEY (`KhuyenMaiID`),
  UNIQUE KEY `MaKhuyenMai` (`MaKhuyenMai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmaisanpham`
--

DROP TABLE IF EXISTS `khuyenmaisanpham`;
CREATE TABLE IF NOT EXISTS `khuyenmaisanpham` (
  `KhuyenMaiSanPhamID` int NOT NULL AUTO_INCREMENT,
  `KhuyenMaiID` int DEFAULT NULL,
  `SanPhamID` int DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  PRIMARY KEY (`KhuyenMaiSanPhamID`),
  KEY `fk_kmsp_km` (`KhuyenMaiID`),
  KEY `fk_kmsp_sp` (`SanPhamID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

DROP TABLE IF EXISTS `loaisanpham`;
CREATE TABLE IF NOT EXISTS `loaisanpham` (
  `LoaiSanPhamID` int NOT NULL AUTO_INCREMENT,
  `TenLoai` varchar(250) DEFAULT NULL,
  `MaLoai` varchar(50) NOT NULL,
  PRIMARY KEY (`LoaiSanPhamID`),
  UNIQUE KEY `MaLoai` (`MaLoai`),
  UNIQUE KEY `TenLoai` (`TenLoai`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`LoaiSanPhamID`, `TenLoai`, `MaLoai`) VALUES
(1, 'Áo len', 'DM01'),
(2, 'Áo sơ mi', 'DM02'),
(3, 'Áo khoác', 'DM03'),
(4, 'Quần', 'DM04'),
(5, 'Váy', 'DM05'),
(6, 'All', 'DM00');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `NhanVienID` int NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(250) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(250) DEFAULT NULL,
  `SoDienThoai` varchar(50) DEFAULT NULL,
  `CCCD` varchar(50) DEFAULT NULL,
  `TaiKhoanID` int DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  PRIMARY KEY (`NhanVienID`),
  KEY `fk_nhanvien_taikhoan` (`TaiKhoanID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

DROP TABLE IF EXISTS `quyen`;
CREATE TABLE IF NOT EXISTS `quyen` (
  `QuyenID` int NOT NULL AUTO_INCREMENT,
  `MaQuyen` varchar(50) DEFAULT NULL,
  `TenQuyen` varchar(250) DEFAULT NULL,
  `MoTa` text,
  PRIMARY KEY (`QuyenID`),
  UNIQUE KEY `MaQuyen` (`MaQuyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quyentaikhoan`
--

DROP TABLE IF EXISTS `quyentaikhoan`;
CREATE TABLE IF NOT EXISTS `quyentaikhoan` (
  `TaiKhoanID` int NOT NULL,
  `QuyenID` int NOT NULL,
  `MoTa` text,
  PRIMARY KEY (`TaiKhoanID`,`QuyenID`),
  KEY `fk_qtk_quyen` (`QuyenID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `SanPhamID` int NOT NULL AUTO_INCREMENT,
  `TenSanPham` varchar(250) DEFAULT NULL,
  `GiaSanPham` decimal(10,2) DEFAULT NULL,
  `LoaiSanPhamID` int DEFAULT NULL,
  `HinhAnhDaiDien` varchar(250) DEFAULT NULL,
  `NoiBat` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = SP nổi bật',
  `TrangThai` bit(1) DEFAULT NULL,
  `MoTa` text,
  `NgayTao` datetime DEFAULT NULL,
  `NgayCapNhat` datetime DEFAULT NULL,
  PRIMARY KEY (`SanPhamID`),
  KEY `fk_sanpham_loaisp` (`LoaiSanPhamID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`SanPhamID`, `TenSanPham`, `GiaSanPham`, `LoaiSanPhamID`, `HinhAnhDaiDien`, `NoiBat`, `TrangThai`, `MoTa`, `NgayTao`, `NgayCapNhat`) VALUES
(1, 'Áo len đan', 500000.00, 1, 'pic6_1.png', 1, b'1', 'Chất len đan dày dặn, mềm mại mang đến cảm giác ấm áp.\r\nThiết kế cổ tròn đơn giản nhưng thanh lịch.\r\nDễ phối đồ và thích hợp cho cả đi chơi lẫn đi học.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(2, 'Áo len thêu hình ngôi sao', 600000.00, 1, 'pic2_1.png', 1, b'1', 'Chiếc áo len mềm mại với họa tiết nổi tinh xảo tạo điểm nhấn nhẹ nhàng.\r\nForm rộng thoải mái, dễ phối với chân váy hoặc quần jean.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(3, 'Sơ mi cổ nơ', 620000.00, 2, 'pic9_1.png', 1, b'1', 'Áo sơ mi cổ nơ mang phong cách nữ tính và thanh lịch.\r\nChất liệu mềm nhẹ, thoáng mát, thích hợp mọi thời tiết.\r\nDễ kết hợp với chân váy hoặc quần jean để tạo outfit tinh tế.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(4, 'Sơ mi tay dài nút gỗ', 720000.00, 2, 'pic3_1.png', 1, b'1', 'Áo sơ mi tay dài với hàng nút gỗ vintage đầy tinh tế.\r\nChất vải mềm nhẹ, đứng form nhưng vẫn tạo cảm giác thoải mái.\r\nPhù hợp cho đi làm, dạo phố hoặc phong cách nhẹ nhàng hằng ngày.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(5, 'Áo khoát len có mũ', 680000.00, 3, 'pic1_1.png', 1, b'1', 'Chiếc áo khoác len có mũ mềm mại, giữ ấm tốt trong mùa lạnh.\r\nThiết kế dáng rộng tạo cảm giác thoải mái và dễ phối đồ.\r\nMàu sắc nhẹ nhàng giúp tôn da và phù hợp nhiều phong cách.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(6, 'Áo khoát sọc caro', 900000.00, 3, 'pic8_1.png', 1, b'1', 'Áo khoác sọc caro thời thượng, phong cách Hàn Quốc.\r\nForm rộng tạo vẻ cá tính nhưng vẫn giữ được sự dễ thương.\r\nPhối cùng chân váy hoặc quần jean đều rất cuốn hút.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(7, 'Quần jean thiêu hoa', 600000.00, 4, 'pic4_1.png', 1, b'1', 'Quần jean suông với họa tiết thêu hoa tinh xảo.\r\nChất jean mềm, co giãn tốt tạo sự thoải mái suốt ngày dài.\r\nDễ phối cùng sơ mi, áo len hoặc áo thun đều đẹp.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(8, 'Quần jean ngắn', 720000.00, 4, 'pic7_1.png', 1, b'1', 'Quần jean ngắn dáng basic, trẻ trung và năng động.\r\nChất jean mềm, không gây khó chịu khi vận động.\r\nPhù hợp dạo phố, du lịch hoặc phong cách casual hằng ngày.', '2025-11-29 16:25:08', '2025-11-29 16:25:08'),
(9, 'Váy xếp ly dáng dài', 650000.00, 5, 'pic5_1.png', 0, b'1', 'Váy xếp ly dáng dài mềm mại tôn dáng thanh thoát.\r\nChất liệu nhẹ, tạo độ rủ đẹp khi di chuyển. Phù hợp cho những outfit nhẹ nhàng, nữ tính và sang.', '2025-11-29 16:25:08', '2025-11-29 16:25:08');

--
-- Triggers `sanpham`
--
DROP TRIGGER IF EXISTS `capnhat_hinhanh`;
DELIMITER $$
CREATE TRIGGER `capnhat_hinhanh` AFTER UPDATE ON `sanpham` FOR EACH ROW BEGIN
    IF NEW.HinhAnhDaiDien IS NOT NULL THEN
        INSERT INTO hinhanhsanpham (SanPhamID, DuongDan, LaHinhDaiDien)
        VALUES (NEW.SanPhamID, NEW.HinhAnhDaiDien, 1);
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `them_hinhanh_sanpham`;
DELIMITER $$
CREATE TRIGGER `them_hinhanh_sanpham` AFTER INSERT ON `sanpham` FOR EACH ROW BEGIN
    IF NEW.HinhAnhDaiDien IS NOT NULL THEN
        INSERT INTO hinhanhsanpham (SanPhamID, DuongDan, LaHinhDaiDien)
        VALUES (NEW.SanPhamID, NEW.HinhAnhDaiDien, 1);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `TaiKhoanID` int NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `NgaySinh` date NOT NULL,
  `VaiTroID` int NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `MatKhau` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `SoDienThoai` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`TaiKhoanID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `fk_taikhoan_vaitro` (`VaiTroID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TaiKhoanID`, `HoTen`, `NgaySinh`, `VaiTroID`, `Email`, `MatKhau`, `SoDienThoai`) VALUES
(5, 'kieutho', '2004-07-19', 3, 'july@gmail.com', '123456', '0767981346'),
(12, 'khách hàng', '1999-12-12', 1, 'kieutho@mail.com', '$2y$10$gjy7kI.R5FVRQc3tMRTNZ.zutOAtNu5xlHXg4RsJpbi0wpTApa3hu', '1234567890'),
(14, 'Kiều Thơ', '2004-07-19', 1, 'thocute@gmail.com', '19072004', '0767981345'),
(15, 'shine', '2025-12-11', 1, 'shine19@gmail.com', '$2y$10$XxOfxtqhvOy9dH6UfpFk6ebpFsRpDRw./fQrOcRAITM8u4AakfroG', '0707677190');

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

DROP TABLE IF EXISTS `thanhtoan`;
CREATE TABLE IF NOT EXISTS `thanhtoan` (
  `ThanhToanID` int NOT NULL AUTO_INCREMENT,
  `DonHangID` int DEFAULT NULL,
  `SoTien` decimal(10,2) DEFAULT NULL,
  `PhuongThuc` varchar(50) DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `NgayThanhToan` datetime DEFAULT NULL,
  PRIMARY KEY (`ThanhToanID`),
  KEY `fk_thanhtoan_donhang` (`DonHangID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

DROP TABLE IF EXISTS `vaitro`;
CREATE TABLE IF NOT EXISTS `vaitro` (
  `VaiTroID` int NOT NULL AUTO_INCREMENT,
  `TenVaiTro` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`VaiTroID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`VaiTroID`, `TenVaiTro`) VALUES
(1, 'Khách hàng'),
(2, 'Nhân viên'),
(3, 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `fk_ctdh_ctsp` FOREIGN KEY (`ChiTietSanPhamID`) REFERENCES `chitietsanpham` (`ChiTietSanPhamID`),
  ADD CONSTRAINT `fk_ctdh_donhang` FOREIGN KEY (`DonHangID`) REFERENCES `donhang` (`DonHangID`);

--
-- Constraints for table `chitietsanpham`
--
ALTER TABLE `chitietsanpham`
  ADD CONSTRAINT `fk_chitietsanpham_sanpham` FOREIGN KEY (`SanPhamID`) REFERENCES `sanpham` (`SanPhamID`),
  ADD CONSTRAINT `fk_ctsp_sanpham` FOREIGN KEY (`SanPhamID`) REFERENCES `sanpham` (`SanPhamID`);

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `fk_danhgia_khachhang` FOREIGN KEY (`KhachHangID`) REFERENCES `khachhang` (`KhachHangID`),
  ADD CONSTRAINT `fk_danhgia_sanpham` FOREIGN KEY (`SanPhamID`) REFERENCES `sanpham` (`SanPhamID`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_donhang_khachhang` FOREIGN KEY (`KhachHangID`) REFERENCES `khachhang` (`KhachHangID`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `fk_gh_khachhang` FOREIGN KEY (`KhachHangID`) REFERENCES `khachhang` (`KhachHangID`),
  ADD CONSTRAINT `fk_giohang_khachhang` FOREIGN KEY (`KhachHangID`) REFERENCES `khachhang` (`KhachHangID`);

--
-- Constraints for table `giohangchitiet`
--
ALTER TABLE `giohangchitiet`
  ADD CONSTRAINT `fk_ghct_ctsp` FOREIGN KEY (`ChiTietSanPhamID`) REFERENCES `chitietsanpham` (`ChiTietSanPhamID`),
  ADD CONSTRAINT `fk_ghct_gh` FOREIGN KEY (`GioHangID`) REFERENCES `giohang` (`GioHangID`),
  ADD CONSTRAINT `fk_ghct_giohang` FOREIGN KEY (`GioHangID`) REFERENCES `giohang` (`GioHangID`);

--
-- Constraints for table `hinhanhsanpham`
--
ALTER TABLE `hinhanhsanpham`
  ADD CONSTRAINT `fk_hasp_sanpham` FOREIGN KEY (`SanPhamID`) REFERENCES `sanpham` (`SanPhamID`),
  ADD CONSTRAINT `fk_hinhanh_sanpham` FOREIGN KEY (`SanPhamID`) REFERENCES `sanpham` (`SanPhamID`);

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `fk_khachhang_taikhoan` FOREIGN KEY (`TaiKhoanID`) REFERENCES `taikhoan` (`TaiKhoanID`);

--
-- Constraints for table `kho`
--
ALTER TABLE `kho`
  ADD CONSTRAINT `fk_kho_ctsp` FOREIGN KEY (`ChiTietSanPhamID`) REFERENCES `chitietsanpham` (`ChiTietSanPhamID`);

--
-- Constraints for table `khuyenmaisanpham`
--
ALTER TABLE `khuyenmaisanpham`
  ADD CONSTRAINT `fk_kmsp_km` FOREIGN KEY (`KhuyenMaiID`) REFERENCES `khuyenmai` (`KhuyenMaiID`),
  ADD CONSTRAINT `fk_kmsp_sp` FOREIGN KEY (`SanPhamID`) REFERENCES `sanpham` (`SanPhamID`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_nhanvien_taikhoan` FOREIGN KEY (`TaiKhoanID`) REFERENCES `taikhoan` (`TaiKhoanID`);

--
-- Constraints for table `quyentaikhoan`
--
ALTER TABLE `quyentaikhoan`
  ADD CONSTRAINT `fk_qtk_quyen` FOREIGN KEY (`QuyenID`) REFERENCES `quyen` (`QuyenID`),
  ADD CONSTRAINT `fk_qtk_taikhoan` FOREIGN KEY (`TaiKhoanID`) REFERENCES `taikhoan` (`TaiKhoanID`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_loaisanpham` FOREIGN KEY (`LoaiSanPhamID`) REFERENCES `loaisanpham` (`LoaiSanPhamID`),
  ADD CONSTRAINT `fk_sanpham_loaisp` FOREIGN KEY (`LoaiSanPhamID`) REFERENCES `loaisanpham` (`LoaiSanPhamID`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `fk_taikhoan_vaitro` FOREIGN KEY (`VaiTroID`) REFERENCES `vaitro` (`VaiTroID`);

--
-- Constraints for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `fk_thanhtoan_donhang` FOREIGN KEY (`DonHangID`) REFERENCES `donhang` (`DonHangID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
