-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th7 07, 2021 lúc 09:06 PM
-- Phiên bản máy phục vụ: 5.7.28
-- Phiên bản PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_luanvan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adMa` int(11) NOT NULL,
  `adTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adTaikhoan` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adMatkhau` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adEmail` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adHinh` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adSdt` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adHinhcmnd` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adDiachi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adQuyen` int(11) NOT NULL,
  `adTinhtrang` int(11) NOT NULL,
  PRIMARY KEY (`adMa`),
  UNIQUE KEY `admin_adten_unique` (`adTen`),
  UNIQUE KEY `admin_adtaikhoan_unique` (`adTaikhoan`),
  UNIQUE KEY `admin_ademail_unique` (`adEmail`),
  UNIQUE KEY `admin_adsdt_unique` (`adSdt`),
  UNIQUE KEY `admin_adhinhcmnd_unique` (`adHinhcmnd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adMa`, `adTen`, `adTaikhoan`, `adMatkhau`, `adEmail`, `adHinh`, `adSdt`, `adHinhcmnd`, `adDiachi`, `adQuyen`, `adTinhtrang`) VALUES
(1, 'nhan', 'nhan', '123456789', 'n@gmail.com', 'ok.jpg', '1234567890', '123456789', 'ádsdwewqeqewdasdadad', 1, 1),
(5435, 'nghia', 'nghia', '123456789', 'nghia@gmail.com', 'bg-login.png', '1234567889', '1232312321', 'eqwewqe2312eqweqwe', 1, 1),
(9399, 'Thu Ngân', 'thungan', '123456789', 'tn@gmail.com', 'bg-login.png', '1234567888', '123312345', 'qưe234ewqweqeewwqee', 3, 1),
(21810, 'Quản lý', 'quanly', '123456789', 'ql@gmail.com', 'bg-login.png', '9999999990', '123123213', 'ad32ewe23424eqwe', 2, 1),
(93711, 'Nhân Viên', 'nhanvien', '1234567890', 'nv@gmail.com', 'bg-login.png', '7664325223', '123867345', 'ádsd3423ewedeqweeqeweqeqe', 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE IF NOT EXISTS `admin_log` (
  `adMa` int(11) NOT NULL,
  `alChitiet` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alNgaygio` timestamp NOT NULL,
  KEY `admin_log_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_log`
--

INSERT INTO `admin_log` (`adMa`, `alChitiet`, `alNgaygio`) VALUES
(1, 'Cập nhật nhân viên:nhan->nhan', '2021-07-07 15:21:21'),
(1, 'Thêm tin tức tiêu đề: a', '2021-07-07 16:29:24'),
(1, 'Cập nhật tin tức tiêu đề a', '2021-07-07 17:22:27'),
(1, 'Thêm tin tức tiêu đề: ád', '2021-07-07 17:23:40'),
(1, 'Cập nhật tin tức tiêu đề a', '2021-07-07 17:40:40'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 17:47:29'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 2', '2021-07-07 17:47:58'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 17:48:18'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 17:48:25'),
(1, 'Xóa tin tức tiêu đề: Bài đăng 1', '2021-07-07 17:49:27'),
(1, 'Thêm tin tức tiêu đề: bài đăng 2', '2021-07-07 17:49:43'),
(1, 'Thêm tin tức tiêu đề: Bài đăng 3', '2021-07-07 18:10:45'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:23:35'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:26:32'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:27:45'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:27:51'),
(1, 'Thêm tin tức tiêu đề: Bài đăng 4', '2021-07-07 18:29:23'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:29:31'),
(1, 'Xóa tin tức tiêu đề: Bài đăng 1', '2021-07-07 18:29:37'),
(1, 'Xóa tin tức tiêu đề: Bài đăng 1', '2021-07-07 18:29:38'),
(1, 'Xóa tin tức tiêu đề: Bài đăng 1', '2021-07-07 18:29:40'),
(1, 'Xóa tin tức tiêu đề: Bài đăng 1', '2021-07-07 18:29:42'),
(1, 'Thêm tin tức tiêu đề: Bài đăng 1', '2021-07-07 18:30:07'),
(1, 'Thêm tin tức tiêu đề: Bài đăng 2', '2021-07-07 18:30:25'),
(1, 'Thêm tin tức tiêu đề: Bài đăng', '2021-07-07 18:30:49'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng', '2021-07-07 18:31:01'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:38:52'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 2', '2021-07-07 18:39:02'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng', '2021-07-07 18:39:15'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 1', '2021-07-07 18:39:23'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 3', '2021-07-07 18:39:30'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 3', '2021-07-07 18:39:38'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 3', '2021-07-07 18:39:47'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 2', '2021-07-07 18:39:52'),
(1, 'Thêm tin tức tiêu đề: Bài đăng 4', '2021-07-07 18:40:15'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 18:43:04'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 19:02:45'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 19:31:28'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 19:33:24'),
(1, 'Thêm tin tức tiêu đề: Bài đăng 5', '2021-07-07 19:52:31'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 5', '2021-07-07 19:55:49'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 20:32:02'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 20:32:18'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 20:32:46'),
(1, 'Cập nhật tin tức tiêu đề Bài đăng 4', '2021-07-07 20:33:42'),
(1, 'Cập nhật nhân viên:nhan->nhan', '2021-07-07 20:39:46'),
(1, 'Thêm nhân mới: nghia', '2021-07-07 20:40:55'),
(1, 'Thêm nhân mới: Quản lý', '2021-07-07 20:43:59'),
(1, 'Thêm nhân mới: Thu Ngân', '2021-07-07 20:44:48'),
(1, 'Thêm nhân mới: Nhân Viên', '2021-07-07 20:45:36'),
(1, 'Thêm loại mới:LAPTOP', '2021-07-07 20:45:47'),
(1, 'Thêm loại mới:PC', '2021-07-07 20:45:51'),
(1, 'Thêm thương hiệu mới:MSI', '2021-07-07 20:45:58'),
(1, 'Thêm thương hiệu mới:ACER', '2021-07-07 20:46:02'),
(1, 'Thêm thương hiệu mới:DELL', '2021-07-07 20:46:06'),
(1, 'Thêm thương hiệu mới:ASUS', '2021-07-07 20:46:11'),
(1, 'Thêm thương hiệu mới:ANGEL', '2021-07-07 20:46:22'),
(1, 'Xóa thương hiệu:ANGEL', '2021-07-07 20:46:28'),
(1, 'Thêm thương hiệu mới:ANGEL', '2021-07-07 20:46:36'),
(1, 'Thêm nhà cung cấp mới: Hà Nội', '2021-07-07 20:47:01'),
(1, 'Thêm nhà cung cấp mới: Hồ Chí Minh', '2021-07-07 20:47:25'),
(1, 'Thêm nhà cung cấp mới: Đà Nẵng', '2021-07-07 20:47:59'),
(1, 'Thêm nhu cầu mới:Văn phòng', '2021-07-07 20:48:10'),
(1, 'Thêm nhu cầu mới:Gaming', '2021-07-07 20:48:16'),
(1, 'Thêm nhu cầu mới:Văn phòng + Gaming', '2021-07-07 20:48:30'),
(1, 'Thêm thương hiệu mới:GVN', '2021-07-07 20:51:48'),
(1, 'Thêm sản phẩm mới:ASUS_1', '2021-07-07 20:52:54'),
(1, 'Thêm sản phẩm mới:ACER_1', '2021-07-07 20:54:14'),
(1, 'Thêm sản phẩm mới:MSI_1', '2021-07-07 20:55:36'),
(1, 'Thêm sản phẩm mới:DELL', '2021-07-07 20:56:57'),
(1, 'Cập nhật sản phẩm:DELL_1', '2021-07-07 20:57:07'),
(1, 'Thêm sản phẩm mới:GVN Usopp', '2021-07-07 20:58:08'),
(1, 'Thêm sản phẩm mới:GVN Ares', '2021-07-07 20:58:56'),
(1, 'Thêm sản phẩm mới:ANGEL_1', '2021-07-07 20:59:42'),
(1, 'Thêm sản phẩm mới:ANGEL_2', '2021-07-07 21:00:25'),
(1, 'Thêm sản phẩm mới:ACER_2', '2021-07-07 21:01:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocao`
--

DROP TABLE IF EXISTS `baocao`;
CREATE TABLE IF NOT EXISTS `baocao` (
  `bcMa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bcTonghangxuat` int(11) NOT NULL,
  `bcTonghangnhap` int(11) NOT NULL,
  `bcThu` int(11) NOT NULL,
  `bcChi` int(11) NOT NULL,
  `bcTonkho` int(11) NOT NULL,
  `bcNgaylap` timestamp NOT NULL,
  `bcTungay` timestamp NOT NULL,
  `bcDenngay` timestamp NOT NULL,
  `bcGhichu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adMa` int(11) NOT NULL,
  PRIMARY KEY (`bcMa`),
  KEY `baocao_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baohanh_logs`
--

DROP TABLE IF EXISTS `baohanh_logs`;
CREATE TABLE IF NOT EXISTS `baohanh_logs` (
  `imeisp` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bhNgay` timestamp NOT NULL,
  `khMa` int(11) NOT NULL,
  KEY `baohanh_logs_khma_foreign` (`khMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi`
--

DROP TABLE IF EXISTS `chi`;
CREATE TABLE IF NOT EXISTS `chi` (
  `adMa` int(11) NOT NULL,
  `chiNgaygiolap` timestamp NOT NULL,
  `chiSoluong` int(11) NOT NULL,
  `chiTongtien` double(20,2) NOT NULL,
  `chiNoidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `chi_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `hdMa` int(11) NOT NULL,
  `spMa` int(11) NOT NULL,
  `cthdSoluong` int(11) NOT NULL,
  `cthdGia` double(20,2) NOT NULL,
  `cthdTrigiakm` int(11) NOT NULL DEFAULT '0',
  `cthdImeisp` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  KEY `chitietdonhang_hdma_foreign` (`hdMa`),
  KEY `chitietdonhang_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

DROP TABLE IF EXISTS `chitietphieunhap`;
CREATE TABLE IF NOT EXISTS `chitietphieunhap` (
  `pnMa` int(11) NOT NULL,
  `spMa` int(11) NOT NULL,
  `nccMa` int(11) NOT NULL,
  `ctpnSoluong` int(11) NOT NULL,
  `ctpnDongia` double(20,2) NOT NULL,
  `ctpnThanhtien` double(20,2) NOT NULL,
  KEY `chitietphieunhap_pnma_foreign` (`pnMa`),
  KEY `chitietphieunhap_spma_foreign` (`spMa`),
  KEY `chitietphieunhap_nccma_foreign` (`nccMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`pnMa`, `spMa`, `nccMa`, `ctpnSoluong`, `ctpnDongia`, `ctpnThanhtien`) VALUES
(531468, 1086788, 2, 10, 12000000.00, 120000000.00),
(444468, 7186479, 1, 10, 10000000.00, 100000000.00),
(58458, 1285118, 3, 10, 20000000.00, 200000000.00),
(663448, 684682, 2, 10, 10000000.00, 100000000.00),
(845497, 279683, 2, 15, 3000000.00, 45000000.00),
(887487, 6978456, 1, 10, 5000000.00, 50000000.00),
(459477, 967736, 2, 20, 2000000.00, 40000000.00),
(839477, 1377741, 2, 8, 7000000.00, 56000000.00),
(822468, 9586920, 1, 5, 15000000.00, 75000000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

DROP TABLE IF EXISTS `danhgia`;
CREATE TABLE IF NOT EXISTS `danhgia` (
  `dgMa` int(11) NOT NULL,
  `dgNoidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dgNgay` timestamp NOT NULL,
  `dgTrangthai` int(11) NOT NULL,
  `khMa` int(11) NOT NULL,
  `spMa` int(11) NOT NULL,
  PRIMARY KEY (`dgMa`),
  KEY `danhgia_spma_foreign` (`spMa`),
  KEY `danhgia_khma_foreign` (`khMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `hdMa` int(11) NOT NULL,
  `khMa` int(11) NOT NULL,
  `hdNgaytao` timestamp NOT NULL,
  `hdSoluongsp` int(11) NOT NULL,
  `hdTongtien` double(20,2) NOT NULL,
  `hdTinhtrang` int(11) NOT NULL,
  `hdSdtnguoinhan` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdDiachi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdGhichu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hdGiamgia` int(11) NOT NULL,
  `hdGiakhuyenmai` int(11) NOT NULL,
  `vcMa` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adMa` int(11) DEFAULT NULL,
  `kmMa` int(11) DEFAULT NULL,
  PRIMARY KEY (`hdMa`),
  KEY `donhang_khma_foreign` (`khMa`),
  KEY `donhang_kmma_foreign` (`kmMa`),
  KEY `donhang_vcma_foreign` (`vcMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh`
--

DROP TABLE IF EXISTS `hinh`;
CREATE TABLE IF NOT EXISTS `hinh` (
  `spMa` int(11) NOT NULL,
  `spHinh` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thutu` int(11) NOT NULL,
  KEY `hinh_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh`
--

INSERT INTO `hinh` (`spMa`, `spHinh`, `thutu`) VALUES
(1086788, 'as1.png', 1),
(1086788, 'as3.png', 0),
(7186479, 'acer1.png', 1),
(7186479, 'ac2.png', 0),
(7186479, 'ac3.png', 0),
(1285118, 'msi1.png', 1),
(1285118, 'msi2.png', 0),
(684682, 'dell1.png', 1),
(684682, 'dell2.png', 0),
(684682, 'dell3.png', 0),
(279683, 'gvn1.png', 1),
(6978456, 'gvn2.png', 1),
(967736, 'pc1.png', 1),
(1377741, 'pc2.png', 1),
(9586920, 'acer1.png', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `khMa` int(11) NOT NULL,
  `khTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khEmail` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khTaikhoan` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khMatkhau` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khNgaysinh` date NOT NULL,
  `khDiachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khSdt` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khGioitinh` int(11) NOT NULL,
  `khHinh` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khXtemail` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khResetpassword` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khNgaythamgia` date NOT NULL,
  `khQuyen` int(11) NOT NULL,
  PRIMARY KEY (`khMa`),
  UNIQUE KEY `khachhang_khemail_unique` (`khEmail`),
  UNIQUE KEY `khachhang_khtaikhoan_unique` (`khTaikhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`khMa`, `khTen`, `khEmail`, `khTaikhoan`, `khMatkhau`, `khNgaysinh`, `khDiachi`, `khSdt`, `khGioitinh`, `khHinh`, `khXtemail`, `khResetpassword`, `khNgaythamgia`, `khQuyen`) VALUES
(391513, 'Nhân', 'ltn@gmail.com', 'nhan', '1234567890', '1999-09-22', 'qưeqedasdadasdadadd', '1235345679', 1, 'ok.jpg', '1', NULL, '2021-07-08', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

DROP TABLE IF EXISTS `kho`;
CREATE TABLE IF NOT EXISTS `kho` (
  `spMa` int(11) NOT NULL,
  `khoSoluong` int(11) NOT NULL,
  `khoNgaynhap` timestamp NOT NULL,
  `khoSoluongdaban` int(11) NOT NULL DEFAULT '0',
  KEY `kho_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`spMa`, `khoSoluong`, `khoNgaynhap`, `khoSoluongdaban`) VALUES
(1086788, 10, '2021-07-07 20:52:54', 0),
(7186479, 10, '2021-07-07 20:54:14', 0),
(1285118, 10, '2021-07-07 20:55:36', 0),
(684682, 10, '2021-07-07 20:56:57', 0),
(279683, 15, '2021-07-07 20:58:08', 0),
(6978456, 10, '2021-07-07 20:58:56', 0),
(967736, 20, '2021-07-07 20:59:42', 0),
(1377741, 8, '2021-07-07 21:00:25', 0),
(9586920, 5, '2021-07-07 21:01:43', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho_sp_hong`
--

DROP TABLE IF EXISTS `kho_sp_hong`;
CREATE TABLE IF NOT EXISTS `kho_sp_hong` (
  `spMa` int(11) NOT NULL,
  `khoSlsphong` int(11) NOT NULL,
  KEY `kho_sp_hong_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `kmMa` int(11) NOT NULL,
  `kmTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmMota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmTrigia` int(11) NOT NULL,
  `kmTinhtrang` int(11) NOT NULL,
  `kmNgaybd` timestamp NOT NULL,
  `kmNgaykt` timestamp NOT NULL,
  `kmSoluong` int(11) DEFAULT NULL,
  `kmGioihanmoikh` int(11) DEFAULT NULL,
  `kmGiatritoida` int(11) DEFAULT NULL,
  PRIMARY KEY (`kmMa`),
  UNIQUE KEY `khuyenmai_kmten_unique` (`kmTen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

DROP TABLE IF EXISTS `loai`;
CREATE TABLE IF NOT EXISTS `loai` (
  `loaiMa` int(11) NOT NULL AUTO_INCREMENT,
  `loaiTen` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`loaiMa`),
  UNIQUE KEY `loai_loaiten_unique` (`loaiTen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`loaiMa`, `loaiTen`) VALUES
(1, 'LAPTOP'),
(2, 'PC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_05_11_211448_create_loai_table', 1),
(2, '2021_05_11_211549_create_thuonghieu_table', 1),
(3, '2021_05_11_211737_create_nhucau_table', 1),
(4, '2021_05_11_211828_create_khuyenmai_table', 1),
(5, '2021_05_11_212039_create_slide_table', 1),
(6, '2021_05_11_212256_create_admin_table', 1),
(7, '2021_05_11_214518_create_baocao_table', 1),
(8, '2021_05_11_230743_create_admin_log_table', 1),
(9, '2021_05_11_230957_create_thu_table', 1),
(10, '2021_05_11_231734_create_chi_table', 1),
(11, '2021_05_11_231824_create_khachhang_table', 1),
(12, '2021_05_11_233641_create_sanpham_table', 1),
(13, '2021_05_11_235245_create_donhang_table', 1),
(14, '2021_05_12_000239_create_chitietdonhang_table', 1),
(15, '2021_05_12_000327_create_danhgia_table', 1),
(16, '2021_05_12_000851_create_wishlist_table', 1),
(17, '2021_05_12_001305_create_password_log_table', 1),
(18, '2021_05_12_001413_create_hinh_table', 1),
(19, '2021_05_12_001445_create_kho_table', 1),
(20, '2021_05_12_001545_create_mota_table', 1),
(21, '2021_05_17_124939_create_nhacungcap_table', 1),
(22, '2021_05_17_125057_update_sanpham_table', 1),
(23, '2021_05_28_192728_create_phieunhap_table', 1),
(24, '2021_05_28_192741_create_chitietphieunhap_table', 1),
(25, '2021_06_01_193313_create_voucher_table', 1),
(26, '2021_06_01_194222_update_donhang_table', 1),
(27, '2021_06_13_153020_create_kho_sp_hong_table', 1),
(28, '2021_06_27_183026_create_baohanh_logs_table', 1),
(29, '2021_07_07_192153_create_tintuc_table', 1),
(30, '2021_07_07_192331_create_tthinh_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mota`
--

DROP TABLE IF EXISTS `mota`;
CREATE TABLE IF NOT EXISTS `mota` (
  `spMa` int(11) NOT NULL,
  `ram` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpu` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocung` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `psu` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vga` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mainboard` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manhinh` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chuot` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banphim` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vocase` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tannhiet` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loa` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mau` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trongluong` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conggiaotiep` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webcam` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chuanlan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chuanwifi` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hedieuhanh` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `mota_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mota`
--

INSERT INTO `mota` (`spMa`, `ram`, `cpu`, `ocung`, `psu`, `vga`, `mainboard`, `manhinh`, `chuot`, `banphim`, `vocase`, `pin`, `tannhiet`, `loa`, `mau`, `trongluong`, `conggiaotiep`, `webcam`, `chuanlan`, `chuanwifi`, `hedieuhanh`) VALUES
(1086788, 'ádasd', 'ádasd', 'ádasd', '', '', '', 'ádsad', 'qưeqe', 'qưeqeqe', '', '3eeqe', '3123qeqwe', 'qưeqw', 'adasd', 'qưewqe', 'ưqeqwe', 'eqweqwe', 'qưeqwe', 'qưeqwe', 'qưewqe'),
(7186479, 'qưewqe', 'qưeqwe', 'qưewqe', '', '', '', '32123eq', 'qeqwe', '23123qeqwe', '', 'qưeqwe', 'qưeqe', 'qưeqwe', 'eqweqe', 'qưeqwe', 'ưeqweqwe', 'qưewqeqwe', 'qưeqwe', 'qưeqwe', '233213eqewwq'),
(1285118, 'adasd', 'ádsadád', 'ádasd', '', '', '', 'ádasdas', 'ádasd', 'ádasdssa', '', 'ádadad', 'ssadda', 'ádasd', 'ádasd', 'ádasdsa', 'ádasdád', 'ádsadaa', 'ádasd', 'ádad', 'ádsadasd'),
(684682, 'ádasd', 'ádqweqwe', 'qưead', '', '', '', 'ádasdqweqwe', 'adae324e', 'ưeqweeaas', '', 'ádqweqe', 'đâsd', '2324234', 'sâdqw', 'ádasdasd', 'adasdqweqw', 'qê', 'đaqưe23', 'eq234eqwe', 'eadeqweqwe'),
(684682, 'ádasd', 'ádqweqwe', 'qưead', '', '', '', 'ádasdqweqwe', 'adae324e', 'ưeqweeaas', '', 'ádqweqe', 'đâsd', '2324234', 'sâdqw', 'ádasdasd', 'adasdqweqw', 'qê', 'đaqưe23', 'eq234eqwe', 'eadeqweqwe'),
(279683, 'qưeqwe', 'qưeweqeqwe', 'ưeqqwe', 'qưeqe', 'qưewqe', 'qưeqwe', '', '', '', 'qewqweqeq', '', '', '', '', '', '', '', '', '', ''),
(6978456, 'đâsd', 'ádsadas', 'ádasdad', 'ưeqweqw', 'adasda', 'qưeqweq', '', '', '', 'adasdasd', '', '', '', '', '', '', '', '', '', ''),
(967736, 'qưeqew', 'qưewqe', 'qưeqqe', 'qưeqweqwe', 'qưeqweqưewqe', 'qưeqwe', '', '', '', 'qưeqweqwe', '', '', '', '', '', '', '', '', '', ''),
(1377741, 'qưeqwe', 'qưeqe', '123e', 'qưewqe', 'qưeqew', 'qưeqwe', '', '', '', 'qưewqeqe', '', '', '', '', '', '', '', '', '', ''),
(9586920, 'qưeqwe', 'qưeqe', 'qeqe', '', '', '', 'qưeqe', 'eqweasdasd', 'qưeqweadsd', '', 'qeqweqeadas', 'ưeeeqwe', 'qưewqe', 'qưeqwe', 'qưeqe', 'qưeqe', 'qưeqwe', 'qưeqweqweada', 'ádadad', 'sdqweqeadasd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

DROP TABLE IF EXISTS `nhacungcap`;
CREATE TABLE IF NOT EXISTS `nhacungcap` (
  `nccMa` int(11) NOT NULL AUTO_INCREMENT,
  `nccTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nccSdt` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nccDiachi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nccTinhtrang` int(11) NOT NULL,
  PRIMARY KEY (`nccMa`),
  UNIQUE KEY `nhacungcap_nccten_unique` (`nccTen`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`nccMa`, `nccTen`, `nccSdt`, `nccDiachi`, `nccTinhtrang`) VALUES
(1, 'Hà Nội', '1234567890', 'Hà Nội, Việt Nam', 1),
(2, 'Hồ Chí Minh', '3126459871', 'Hồ Chí Minh, Việt Nam', 1),
(3, 'Đà Nẵng', '3123131323', 'Đà Nẵng, Việt Nam', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhucau`
--

DROP TABLE IF EXISTS `nhucau`;
CREATE TABLE IF NOT EXISTS `nhucau` (
  `ncMa` int(11) NOT NULL AUTO_INCREMENT,
  `ncTen` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ncMa`),
  UNIQUE KEY `nhucau_ncten_unique` (`ncTen`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhucau`
--

INSERT INTO `nhucau` (`ncMa`, `ncTen`) VALUES
(2, 'Gaming'),
(1, 'Văn phòng'),
(3, 'Văn phòng + Gaming');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_log`
--

DROP TABLE IF EXISTS `password_log`;
CREATE TABLE IF NOT EXISTS `password_log` (
  `khMa` int(11) NOT NULL,
  `plOld` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `password_log_khma_foreign` (`khMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

DROP TABLE IF EXISTS `phieunhap`;
CREATE TABLE IF NOT EXISTS `phieunhap` (
  `pnMa` int(11) NOT NULL AUTO_INCREMENT,
  `pnNgaylap` timestamp NOT NULL,
  `adMa` int(11) NOT NULL,
  `pnSoluongsp` int(11) NOT NULL,
  `pnTongtien` double(20,2) NOT NULL,
  PRIMARY KEY (`pnMa`),
  KEY `phieunhap_adma_foreign` (`adMa`)
) ENGINE=InnoDB AUTO_INCREMENT=887488 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`pnMa`, `pnNgaylap`, `adMa`, `pnSoluongsp`, `pnTongtien`) VALUES
(58458, '2021-07-07 20:55:36', 1, 10, 200000000.00),
(444468, '2021-07-07 20:54:14', 1, 10, 100000000.00),
(459477, '2021-07-07 20:59:42', 1, 20, 40000000.00),
(531468, '2021-07-07 20:52:54', 1, 10, 120000000.00),
(663448, '2021-07-07 20:56:57', 1, 10, 100000000.00),
(822468, '2021-07-07 21:01:43', 1, 5, 75000000.00),
(839477, '2021-07-07 21:00:26', 1, 8, 56000000.00),
(845497, '2021-07-07 20:58:08', 1, 15, 45000000.00),
(887487, '2021-07-07 20:58:57', 1, 10, 50000000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `spMa` int(11) NOT NULL,
  `spTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spGia` double(20,2) NOT NULL,
  `spHanbh` int(11) NOT NULL,
  `spTinhtrang` int(11) NOT NULL,
  `thMa` int(11) NOT NULL,
  `loaiMa` int(11) NOT NULL,
  `ncMa` int(11) NOT NULL,
  `nccMa` int(11) NOT NULL,
  `kmMa` int(11) DEFAULT NULL,
  `spSlkmtoida` int(11) DEFAULT NULL,
  PRIMARY KEY (`spMa`),
  KEY `sanpham_ncma_foreign` (`ncMa`),
  KEY `sanpham_loaima_foreign` (`loaiMa`),
  KEY `sanpham_thma_foreign` (`thMa`),
  KEY `sanpham_kmma_foreign` (`kmMa`),
  KEY `sanpham_nccma_foreign` (`nccMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`spMa`, `spTen`, `spGia`, `spHanbh`, `spTinhtrang`, `thMa`, `loaiMa`, `ncMa`, `nccMa`, `kmMa`, `spSlkmtoida`) VALUES
(279683, 'GVN Usopp', 3150000.00, 1, 1, 7, 2, 3, 2, NULL, NULL),
(684682, 'DELL_1', 10000000.00, 0, 1, 3, 1, 2, 2, NULL, NULL),
(967736, 'ANGEL_1', 2100000.00, 1, 1, 6, 2, 1, 2, NULL, NULL),
(1086788, 'ASUS_1', 12600000.00, 0, 1, 4, 1, 2, 2, NULL, NULL),
(1285118, 'MSI_1', 21000000.00, 0, 1, 1, 1, 2, 3, NULL, NULL),
(1377741, 'ANGEL_2', 7350000.00, 1, 1, 6, 2, 2, 2, NULL, NULL),
(6978456, 'GVN Ares', 5250000.00, 0, 1, 7, 2, 1, 1, NULL, NULL),
(7186479, 'ACER_1', 10500000.00, 0, 1, 2, 1, 1, 1, NULL, NULL),
(9586920, 'ACER_2', 15750000.00, 0, 1, 2, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

DROP TABLE IF EXISTS `slide`;
CREATE TABLE IF NOT EXISTS `slide` (
  `bnMa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bnTieude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bnHinh` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bnNgay` timestamp NOT NULL,
  `bnVitri` int(11) NOT NULL,
  PRIMARY KEY (`bnMa`)
) ENGINE=InnoDB AUTO_INCREMENT=99234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`bnMa`, `bnTieude`, `bnHinh`, `bnNgay`, `bnVitri`) VALUES
(19233, 'bn2', 'solid2.png', '2021-07-07 21:04:23', 1),
(27233, 'bn5', 'solid1.png', '2021-07-07 21:05:43', 1),
(28232, 'bn4', 'solid5.jpg', '2021-07-07 21:04:48', 1),
(42233, 'slide1', 'bn.png', '2021-07-07 21:03:43', 0),
(52233, 'slide3', 'img-main.png', '2021-07-07 21:03:59', 0),
(91233, 'bn3', 'solid4.png', '2021-07-07 21:04:38', 1),
(97233, 'slide2', 'bg-login.png', '2021-07-07 21:03:51', 0),
(99233, 'bn1', 'solid2.png', '2021-07-07 21:04:09', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu`
--

DROP TABLE IF EXISTS `thu`;
CREATE TABLE IF NOT EXISTS `thu` (
  `adMa` int(11) NOT NULL,
  `alNgaygio` timestamp NOT NULL,
  `thuSoluong` int(11) NOT NULL,
  `thuTongtien` double(20,2) NOT NULL,
  `thuNoidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `thu_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

DROP TABLE IF EXISTS `thuonghieu`;
CREATE TABLE IF NOT EXISTS `thuonghieu` (
  `thMa` int(11) NOT NULL AUTO_INCREMENT,
  `thTen` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`thMa`),
  UNIQUE KEY `thuonghieu_thten_unique` (`thTen`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`thMa`, `thTen`) VALUES
(2, 'ACER'),
(6, 'ANGEL'),
(4, 'ASUS'),
(3, 'DELL'),
(7, 'GVN'),
(1, 'MSI');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

DROP TABLE IF EXISTS `tintuc`;
CREATE TABLE IF NOT EXISTS `tintuc` (
  `ttMa` int(11) NOT NULL,
  `ttTieude` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttGioithieu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttNoidung` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttLoai` int(1) NOT NULL,
  `ttHinh` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttNgaydang` timestamp NOT NULL,
  `ttTinhtrang` int(11) NOT NULL,
  `ttLuotxem` int(11) NOT NULL DEFAULT '0',
  `adMa` int(11) NOT NULL,
  PRIMARY KEY (`ttMa`),
  KEY `tintuc_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`ttMa`, `ttTieude`, `ttGioithieu`, `ttNoidung`, `ttLoai`, `ttHinh`, `ttNgaydang`, `ttTinhtrang`, `ttLuotxem`, `adMa`) VALUES
(2901319, 'Bài đăng 4', 'ádsadaaad', '<p>qưaeqwee2323432234 &aacute;dasdsadsadadadaddasa</p>', 1, 'bg-login.png', '2021-07-07 18:40:15', 0, 47, 1),
(4313117, 'Bài đăng 1', 'ádaqưqeqưewqeqeqeqeưeesdd', 'ádaqưqeqưewqeqeqeqeưeesddádaqưqeqưewqeqeqeqeưeesddádaqưqeqưewqeqeqeqeưeesdd', 1, 'bn.png', '2021-07-07 18:30:07', 0, 12, 1),
(7311187, 'Bài đăng 2', 'ádaqưqeqưewqeqeqeqeưeesdd', 'ádaqưqeqưewqeqeqeqeưeesddádaqưqeqưewqeqeqeqeưeesddádaqưqeqưewqeqeqeqeưeesdd', 2, 'solid5.jpg', '2021-07-07 18:30:49', 0, 6, 1),
(9401332, 'Bài đăng 3', 'ádaqưqeqưewqeqeqeqeưeesdd', 'ádaqưqeqưewqeqeqeqeưeesddádaqưqeqưewqeqeqeqeưeesddádaqưqeqưewqeqeqeqeưeesdd', 2, 'solid5.jpg', '2021-07-07 18:30:25', 0, 0, 1),
(82213433, 'Bài đăng 5', 'Ckeditor', '<h1>9 th&iacute; sinh bị đ&igrave;nh chỉ trong ng&agrave;y thi tốt nghiệp THPT đầu ti&ecirc;n</h1>\r\n\r\n<p>Ng&agrave;y 7/7, trong một triệu th&iacute; sinh đăng k&yacute;, tỷ lệ dự thi tốt nghiệp THPT đạt tr&ecirc;n 97%, c&oacute; 9 em bị đ&igrave;nh chỉ, đồng nghĩa bị hủy kết quả.</p>\r\n\r\n<p>Bộ Gi&aacute;o dục v&agrave; Đ&agrave;o tạo cho biết buổi s&aacute;ng thi Ngữ văn c&oacute; hơn 977.600 th&iacute; sinh đến dự thi, đạt tỷ lệ 97,1% so với số lượng đăng k&yacute; thi m&ocirc;n n&agrave;y. Số th&iacute; sinh thi To&aacute;n buổi chiều gần 981.800, đạt 97,18%. Tổng số th&iacute; sinh bị ảnh hưởng bởi Covid-19 n&ecirc;n kh&ocirc;ng thể dự&nbsp;<a href=\"https://vnexpress.net/chu-de/thi-tot-nghiep-thpt-2021-3336\">thi tốt nghiệp THPT&nbsp;</a>đợt 1 l&agrave; gần 23.800.</p>\r\n\r\n<p>Trong ng&agrave;y thi, nhiều t&igrave;nh huống bất thường xảy ra, đặc biệt ở TP HCM khi một th&iacute; sinh ngất xỉu khi đang l&agrave;m b&agrave;i Ngữ văn tại điểm thi trường THPT L&ecirc; Qu&yacute; Đ&ocirc;n, quận 3. Em n&agrave;y sau đ&oacute; c&oacute; kết quả test nhanh dương t&iacute;nh nCoV. 23 th&iacute; sinh c&ugrave;ng ph&ograve;ng v&agrave; hai c&aacute;n bộ coi thi phải c&aacute;ch ly tại trường.</p>\r\n\r\n<p>Cũng tại TP HCM, trường THCS Đặng Trần C&ocirc;n, T&acirc;n Ph&uacute; c&oacute; một th&iacute; sinh F0 đến l&agrave;m thủ tục v&agrave;o chiều qua, s&aacute;ng nay kh&ocirc;ng đến điểm thi. Tại trường THPT L&ecirc; Th&aacute;nh T&ocirc;n, quận 7, c&oacute; th&iacute; sinh F0 vẫn dự thi m&ocirc;n Ngữ văn s&aacute;ng nay.</p>\r\n\r\n<p><img alt=\"Thí sinh dự thi tốt nghiệp THPT tại TP HCM. Ảnh: Quỳnh Trần.\" src=\"https://i1-vnexpress.vnecdn.net/2021/07/07/tot-nghiep-1625658707-8052-1625658746.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=btie2GC4NFx7j0bmIbwxwA\" /></p>\r\n\r\n<p>Th&iacute; sinh dự thi tốt nghiệp THPT tại TP HCM. Ảnh:&nbsp;<em>Quỳnh Trần.</em></p>\r\n\r\n<p>Li&ecirc;n quan đến Covid-19, một điểm thi ở Bắc Giang v&agrave; hai điểm thi ở Ph&uacute; Y&ecirc;n đ&atilde; phải dừng ngay ph&uacute;t ch&oacute;t do ph&aacute;t hiện ca dương t&iacute;nh. Bắc Giang thậm ch&iacute; đ&atilde; đ&igrave;nh chỉ c&ocirc;ng t&aacute;c c&aacute;n bộ v&igrave; sự cố dừng điểm thi khiến 472 th&iacute; sinh phải chuyển sang thi đợt 2 d&ugrave; đ&atilde; l&agrave;m thủ tục dự thi đợt 1.</p>\r\n\r\n<p>Đ&aacute;nh gi&aacute; chung về ng&agrave;y thi đầu ti&ecirc;n, Bộ Gi&aacute;o dục v&agrave; Đ&agrave;o tạo cho rằng c&aacute;c hội đồng thi đ&atilde; &quot;thực hiện tốt biện ph&aacute;p ph&ograve;ng chống Covid-19 v&agrave; triển khai c&aacute;c phương &aacute;n dự ph&ograve;ng n&ecirc;n xử l&yacute; kịp thời c&aacute;c t&igrave;nh huống bất thường, bảo đảm tổ chức thi an to&agrave;n, nghi&ecirc;m t&uacute;c&quot;.</p>\r\n\r\n<p>Năm nay, cả nước c&oacute; hơn 1.021.000 th&iacute; sinh đăng k&yacute; dự thi tốt nghiệp THPT, nhiều hơn năm trước khoảng 100.000. Trong đ&oacute;, số vừa x&eacute;t tốt nghiệp, vừa x&eacute;t tuyển đại học gần 759.000. Chỉ ti&ecirc;u tuyển sinh dựa v&agrave;o kết quả thi tốt nghiệp THPT chiếm 55% v&agrave; x&eacute;t tuyển bằng h&igrave;nh thức kh&aacute;c chiếm 45%.</p>\r\n\r\n<p>Ng&agrave;y mai, c&aacute;c em sẽ l&agrave;m hai b&agrave;i thi cuối l&agrave; b&agrave;i tổ hợp (Khoa học tự nhi&ecirc;n hoặc Khoa học x&atilde; hội) v&agrave; Ngoại ngữ.</p>', 1, 'img-main.png', '2021-07-07 19:52:31', 0, 7, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE IF NOT EXISTS `voucher` (
  `vcMa` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vcTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vcTinhtrang` int(11) NOT NULL,
  `vcSoluot` int(11) NOT NULL,
  `vcLoai` int(11) NOT NULL,
  `vcNgaybd` timestamp NOT NULL,
  `vcNgaykt` timestamp NOT NULL,
  `vcLoaigiamgia` int(11) NOT NULL,
  `vcMucgiam` int(11) NOT NULL,
  `vcGiatritoida` int(11) DEFAULT NULL,
  `vcDkapdung` int(11) DEFAULT NULL,
  `vcGtcandat` int(11) DEFAULT NULL,
  `spMa` int(11) DEFAULT NULL,
  PRIMARY KEY (`vcMa`),
  UNIQUE KEY `voucher_vcten_unique` (`vcTen`),
  KEY `voucher_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `khMa` int(11) NOT NULL,
  `spMa` int(11) NOT NULL,
  KEY `wishlist_khma_foreign` (`khMa`),
  KEY `wishlist_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_log`
--
ALTER TABLE `admin_log`
  ADD CONSTRAINT `admin_log_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `baocao`
--
ALTER TABLE `baocao`
  ADD CONSTRAINT `baocao_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `baohanh_logs`
--
ALTER TABLE `baohanh_logs`
  ADD CONSTRAINT `baohanh_logs_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chi`
--
ALTER TABLE `chi`
  ADD CONSTRAINT `chi_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_hdma_foreign` FOREIGN KEY (`hdMa`) REFERENCES `donhang` (`hdMa`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietdonhang_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `chitietphieunhap_nccma_foreign` FOREIGN KEY (`nccMa`) REFERENCES `nhacungcap` (`nccMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietphieunhap_pnma_foreign` FOREIGN KEY (`pnMa`) REFERENCES `phieunhap` (`pnMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietphieunhap_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE,
  ADD CONSTRAINT `danhgia_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_kmma_foreign` FOREIGN KEY (`kmMa`) REFERENCES `khuyenmai` (`kmMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_vcma_foreign` FOREIGN KEY (`vcMa`) REFERENCES `voucher` (`vcMa`);

--
-- Các ràng buộc cho bảng `hinh`
--
ALTER TABLE `hinh`
  ADD CONSTRAINT `hinh_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `kho`
--
ALTER TABLE `kho`
  ADD CONSTRAINT `kho_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `kho_sp_hong`
--
ALTER TABLE `kho_sp_hong`
  ADD CONSTRAINT `kho_sp_hong_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `mota`
--
ALTER TABLE `mota`
  ADD CONSTRAINT `mota_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `password_log`
--
ALTER TABLE `password_log`
  ADD CONSTRAINT `password_log_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_kmma_foreign` FOREIGN KEY (`kmMa`) REFERENCES `khuyenmai` (`kmMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_loaima_foreign` FOREIGN KEY (`loaiMa`) REFERENCES `loai` (`loaiMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_nccma_foreign` FOREIGN KEY (`nccMa`) REFERENCES `nhacungcap` (`nccMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_ncma_foreign` FOREIGN KEY (`ncMa`) REFERENCES `nhucau` (`ncMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_thma_foreign` FOREIGN KEY (`thMa`) REFERENCES `thuonghieu` (`thMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thu`
--
ALTER TABLE `thu`
  ADD CONSTRAINT `thu_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD CONSTRAINT `tintuc_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `voucher_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
