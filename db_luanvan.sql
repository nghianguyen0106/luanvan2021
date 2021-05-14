-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th5 14, 2021 lúc 03:05 AM
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
  `adTaikhoan` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adMatkhau` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adEmail` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adSdt` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adQuyen` int(11) NOT NULL,
  `adHinh` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`adMa`),
  UNIQUE KEY `admin_adten_unique` (`adTen`),
  UNIQUE KEY `admin_adtaikhoan_unique` (`adTaikhoan`),
  UNIQUE KEY `admin_ademail_unique` (`adEmail`),
  UNIQUE KEY `admin_adsdt_unique` (`adSdt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adMa`, `adTen`, `adTaikhoan`, `adMatkhau`, `adEmail`, `adSdt`, `adQuyen`, `adHinh`) VALUES
(1, 'Lê Trung Nhân', 'nhan', '1', 't@gmail.com', '123123', 1, 'ok.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE IF NOT EXISTS `admin_log` (
  `adMa` int(11) NOT NULL,
  `alChitiet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alNgaygio` timestamp NOT NULL,
  KEY `admin_log_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `bnMa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bnHinh` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmMa` int(11) DEFAULT NULL,
  PRIMARY KEY (`bnMa`),
  KEY `banner_kmma_foreign` (`kmMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `bcGhichu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adMa` int(11) NOT NULL,
  PRIMARY KEY (`bcMa`),
  KEY `baocao_adma_foreign` (`adMa`)
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
  `chiTongtien` double(8,2) NOT NULL,
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
  `cthdGia` int(11) NOT NULL,
  KEY `chitietdonhang_hdma_foreign` (`hdMa`),
  KEY `chitietdonhang_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

DROP TABLE IF EXISTS `danhgia`;
CREATE TABLE IF NOT EXISTS `danhgia` (
  `dgMa` int(11) NOT NULL,
  `khMa` int(11) NOT NULL,
  `dgNoidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spMa` int(11) NOT NULL,
  `dgNgay` timestamp NOT NULL,
  `dgTrangthai` int(11) NOT NULL,
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
  `hdDiachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdSdtnguoinhan` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdGhichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kmMa` int(11) NOT NULL,
  `adMa` int(11) NOT NULL,
  PRIMARY KEY (`hdMa`),
  KEY `donhang_khma_foreign` (`khMa`),
  KEY `donhang_kmma_foreign` (`kmMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

DROP TABLE IF EXISTS `giohang`;
CREATE TABLE IF NOT EXISTS `giohang` (
  `khMa` int(11) NOT NULL,
  `spMa` int(11) NOT NULL,
  `ghSoluong` int(11) NOT NULL,
  KEY `giohang_khma_foreign` (`khMa`),
  KEY `giohang_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh`
--

DROP TABLE IF EXISTS `hinh`;
CREATE TABLE IF NOT EXISTS `hinh` (
  `spMa` int(11) NOT NULL,
  `spHinh` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `hinh_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh`
--

INSERT INTO `hinh` (`spMa`, `spHinh`) VALUES
(1584, '2021-03-09 (1).png'),
(4884, '2021-03-10 (1).png'),
(2277, '2021-03-10 (2).png'),
(5183, '2021-03-11.png'),
(8187, '2021-03-13 (1).png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `khMa` int(11) NOT NULL,
  `khTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khEmail` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khTaikhoan` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khMatkhau` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khNgaysinh` date NOT NULL,
  `khDiachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khSdt` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khGioitinh` int(11) NOT NULL,
  `khHinh` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khXtemail` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khResetpassword` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khQuyen` int(11) NOT NULL,
  PRIMARY KEY (`khMa`),
  UNIQUE KEY `khachhang_khemail_unique` (`khEmail`),
  UNIQUE KEY `khachhang_khtaikhoan_unique` (`khTaikhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

DROP TABLE IF EXISTS `kho`;
CREATE TABLE IF NOT EXISTS `kho` (
  `spMa` int(11) NOT NULL,
  `khoSoluong` int(11) NOT NULL,
  `khoNgaynhap` timestamp NOT NULL,
  KEY `kho_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `kmMa` int(11) NOT NULL AUTO_INCREMENT,
  `khMota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmTrigia` int(11) NOT NULL,
  `khNgaybd` timestamp NOT NULL,
  `kmNgaykt` timestamp NOT NULL,
  PRIMARY KEY (`kmMa`)
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_05_11_211448_create_loai_table', 1),
(2, '2021_05_11_211549_create_thuonghieu_table', 1),
(3, '2021_05_11_211737_create_nhucau_table', 1),
(4, '2021_05_11_211828_create_khuyenmai_table', 1),
(5, '2021_05_11_212039_create_banner_table', 1),
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
(16, '2021_05_12_000851_create_giohang_table', 1),
(17, '2021_05_12_001305_create_password_log_table', 1),
(18, '2021_05_12_001413_create_hinh_table', 1),
(19, '2021_05_12_001445_create_kho_table', 1),
(20, '2021_05_12_001545_create_mota_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mota`
--

DROP TABLE IF EXISTS `mota`;
CREATE TABLE IF NOT EXISTS `mota` (
  `spMa` int(11) NOT NULL,
  `ram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `psu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ocung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mainboard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manhinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vocase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tannhiet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trongluong` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conggiaotiep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webcam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chuanlan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chuanwifi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hedieuhanh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `mota_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mota`
--

INSERT INTO `mota` (`spMa`, `ram`, `cpu`, `psu`, `ocung`, `vga`, `mainboard`, `manhinh`, `vocase`, `pin`, `tannhiet`, `loa`, `mau`, `trongluong`, `conggiaotiep`, `webcam`, `chuanlan`, `chuanwifi`, `hedieuhanh`) VALUES
(1584, '8GB', 'a', '', 'b', '', '', 'c', '', 'i', 'h', 'g', 'f', 'e', 'd', 'g', 'k', 'j', 'm'),
(4884, '8', 'a', '', 'b', '', '', 'c', '', 'j', 'i', 'g', 'f', 'e', 'd', 'h', 'k', NULL, 'm'),
(2277, '16', 'ưe', 'ád', 'ds', 'ád', 'ád', '', 'đá', '', '', '', '', '', '', '', '', '', ''),
(5183, '8', 'ád', '', 'zxc', '', '', 'âsda', '', 'zxcz', 'cxzczx', 'z', 'zxc', 'áda', 'zxc', 'zcc', 'cxz', 'xzc', 'zxc'),
(8187, '8', 'a', '', 'cv', '', '', 'cvbc', '', 'bvcbb', 'cvbc', 'bcvbc', 'cvbcv', 'cvb', 'bvc', 'vbcvb', 'cvbb', 'vvcb', 'vcbcb');

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
(1, 'GAMING'),
(3, 'GAMING, VĂN PHÒNG'),
(2, 'VĂN PHÒNG');

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
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `spMa` int(11) NOT NULL,
  `spTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spGia` int(11) NOT NULL,
  `spHanbh` int(11) NOT NULL,
  `spTinhtrang` int(11) NOT NULL,
  `kmMa` int(11) DEFAULT NULL,
  `thMa` int(11) NOT NULL,
  `loaiMa` int(11) NOT NULL,
  `ncMa` int(11) NOT NULL,
  PRIMARY KEY (`spMa`),
  UNIQUE KEY `sanpham_spten_unique` (`spTen`),
  KEY `sanpham_ncma_foreign` (`ncMa`),
  KEY `sanpham_loaima_foreign` (`loaiMa`),
  KEY `sanpham_thma_foreign` (`thMa`),
  KEY `sanpham_kmma_foreign` (`kmMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`spMa`, `spTen`, `spGia`, `spHanbh`, `spTinhtrang`, `kmMa`, `thMa`, `loaiMa`, `ncMa`) VALUES
(1584, 'Asus', 12000000, 2, 0, NULL, 1, 1, 1),
(2277, 'ARES PC', 3000000, 1, 0, NULL, 6, 2, 1),
(4884, 'Dell', 11000000, 1, 0, NULL, 2, 1, 2),
(5183, 'MSI', 20000000, 2, 0, NULL, 6, 1, 3),
(8187, 'MAC PRO', 23000000, 2, 0, NULL, 4, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu`
--

DROP TABLE IF EXISTS `thu`;
CREATE TABLE IF NOT EXISTS `thu` (
  `adMa` int(11) NOT NULL,
  `alNgaygio` timestamp NOT NULL,
  `thuSoluong` int(11) NOT NULL,
  `thuTongtien` double(8,2) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`thMa`, `thTen`) VALUES
(6, 'ARES'),
(1, 'ASUS'),
(2, 'DELL'),
(4, 'MACBOOK'),
(3, 'MSI'),
(5, 'VIVO');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_log`
--
ALTER TABLE `admin_log`
  ADD CONSTRAINT `admin_log_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_kmma_foreign` FOREIGN KEY (`kmMa`) REFERENCES `khuyenmai` (`kmMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `baocao`
--
ALTER TABLE `baocao`
  ADD CONSTRAINT `baocao_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `donhang_kmma_foreign` FOREIGN KEY (`kmMa`) REFERENCES `khuyenmai` (`kmMa`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `giohang_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_kmma_foreign` FOREIGN KEY (`kmMa`) REFERENCES `khuyenmai` (`kmMa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_loaima_foreign` FOREIGN KEY (`loaiMa`) REFERENCES `loai` (`loaiMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_ncma_foreign` FOREIGN KEY (`ncMa`) REFERENCES `nhucau` (`ncMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_thma_foreign` FOREIGN KEY (`thMa`) REFERENCES `thuonghieu` (`thMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thu`
--
ALTER TABLE `thu`
  ADD CONSTRAINT `thu_adma_foreign` FOREIGN KEY (`adMa`) REFERENCES `admin` (`adMa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
