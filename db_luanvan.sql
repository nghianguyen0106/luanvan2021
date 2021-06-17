-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th6 17, 2021 lúc 03:06 PM
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
  `adQuyen` int(11) NOT NULL,
  `adTinhtrang` int(11) NOT NULL,
  PRIMARY KEY (`adMa`),
  UNIQUE KEY `admin_adten_unique` (`adTen`),
  UNIQUE KEY `admin_adtaikhoan_unique` (`adTaikhoan`),
  UNIQUE KEY `admin_ademail_unique` (`adEmail`),
  UNIQUE KEY `admin_adsdt_unique` (`adSdt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adMa`, `adTen`, `adTaikhoan`, `adMatkhau`, `adEmail`, `adHinh`, `adSdt`, `adQuyen`, `adTinhtrang`) VALUES
(1, 'boss', 'master', '12345', 't@n.com', 'ok.jpg', '1234567890', 1, 0),
(35212, 'giao hàng 1', 'giaohang1', '123456789', 'a@a.com', 'bg-login.png', '1234567891', 2, 1);

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
(1, 'Thêm loại mới:Laptop', '2021-06-17 05:43:44'),
(1, 'Thêm loại mới:PC', '2021-06-17 05:43:47'),
(1, 'Thêm thương hiệu mới:MSI', '2021-06-17 05:44:00'),
(1, 'Thêm thương hiệu mới:ASUS', '2021-06-17 05:44:03'),
(1, 'Thêm thương hiệu mới:MACBOOK', '2021-06-17 05:44:08'),
(1, 'Thêm nhu cầu mới:Văn phòng', '2021-06-17 05:44:25'),
(1, 'Thêm nhu cầu mới:Gaming', '2021-06-17 05:44:29'),
(1, 'Thêm nhà cung cấp mới: ho chi minh', '2021-06-17 05:44:47'),
(1, 'Thêm nhà cung cấp mới: ha noi', '2021-06-17 05:44:58'),
(1, 'Thêm sản phẩm mới:GVN Aresâs', '2021-06-17 05:45:54'),
(1, 'Lập phiếu nhập mới, ngày2021-06-17 12:46:21', '2021-06-17 05:46:21'),
(1, 'Thêm sản phẩm mới:GVN Usopp', '2021-06-17 06:41:43'),
(1, 'Cập nhật nhân viên:nhan->nhan', '2021-06-17 06:42:03'),
(1, 'Lập phiếu nhập mới, ngày2021-06-17 13:59:00', '2021-06-17 06:59:00'),
(1, 'Thêm nhân mới: giao hàng 1', '2021-06-17 10:46:53'),
(1, 'Thêm sản phẩm mới:GVN Ares', '2021-06-17 12:05:00'),
(1, 'Lập phiếu nhập mới, ngày2021-06-17 19:05:22', '2021-06-17 12:05:22');

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
  `cthdGia` double(20,4) NOT NULL,
  `cthdTrigiakm` int(11) NOT NULL DEFAULT '0',
  `cthdImeisp` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  KEY `chitietdonhang_hdma_foreign` (`hdMa`),
  KEY `chitietdonhang_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`hdMa`, `spMa`, `cthdSoluong`, `cthdGia`, `cthdTrigiakm`, `cthdImeisp`) VALUES
(84231676, 63811650, 1, 3300000.0000, 0, '0'),
(592011676, 6679439, 1, 1100000.0000, 0, '0');

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
(9984118, 63811650, 2, 0, 12000000.00, 0.00),
(58429, 63811650, 1, 15, 15000000.00, 225000000.00),
(423497, 6679439, 2, 0, 2000000.00, 0.00),
(72428, 6679439, 2, 12, 1000000.00, 12000000.00),
(72428, 63811650, 1, 16, 3000000.00, 48000000.00),
(96484, 3748253, 2, 0, 0.00, 0.00),
(24428, 3748253, 2, 10, 1111111.00, 11111110.00);

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
  PRIMARY KEY (`hdMa`),
  KEY `donhang_khma_foreign` (`khMa`),
  KEY `donhang_vcma_foreign` (`vcMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`hdMa`, `khMa`, `hdNgaytao`, `hdSoluongsp`, `hdTongtien`, `hdTinhtrang`, `hdSdtnguoinhan`, `hdDiachi`, `hdGhichu`, `hdGiamgia`, `hdGiakhuyenmai`, `vcMa`, `adMa`) VALUES
(84231676, 1018410, '2021-06-17 10:42:08', 1, 3300000.00, 2, '1234567890', 'ấdadadsadadasdad', NULL, 0, 0, NULL, 35212),
(592011676, 1018410, '2021-06-17 12:20:59', 1, 1100000.00, 3, '1234567890', 'ấdadadsadadasdad', NULL, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh`
--

DROP TABLE IF EXISTS `hinh`;
CREATE TABLE IF NOT EXISTS `hinh` (
  `spMa` int(11) NOT NULL,
  `spHinh` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `hinh_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh`
--

INSERT INTO `hinh` (`spMa`, `spHinh`) VALUES
(63811650, 'gvn1.png'),
(6679439, 'acer1.png'),
(3748253, 'gvn2.png');

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
(1018410, 'trung nhan', 'letrungnhan99@gmail.com', 'nhan', 'e807f1fcf82d132f9bb018ca6738a19f', '1999-08-22', 'adas23432423234', '1234567890', 0, 'ok.jpg', '1', NULL, '2021-06-17', 0);

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
(63811650, 31, '2021-06-17 06:59:00', 0),
(6679439, 12, '2021-06-17 06:59:00', 0),
(3748253, 10, '2021-06-17 12:05:22', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho_sp_hong`
--

DROP TABLE IF EXISTS `kho_sp_hong`;
CREATE TABLE IF NOT EXISTS `kho_sp_hong` (
  `spMa` int(11) NOT NULL,
  `khoSlsphong` int(11) NOT NULL,
  KEY `kho_sp_hong_spma_foreign` (`spMa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Laptop'),
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(27, '2021_06_13_153020_create_kho_sp_hong_table', 1);

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
(63811650, '12312', '1232131', '123213', '123213', '123213', '123123213', '', '', '', '12313', '', '', '', '', '', '', '', '', '', ''),
(6679439, 'ádasdas', 'đâsd', 'ádasdasd', '', '', '', 'ádasd', 'ádasd', 'ádasd', '', 'ádasdasd', 'đâsd', 'ádasdas', 'đâsd', 'đâs', 'ádasdas', 'đâs', 'sadsadsa', 'ádasdasd', 'ádasdasd'),
(3748253, 'qưe', 'qưew', 'qưeqwe', 'qeqw', 'eqwe', 'qưeqwe', '', '', '', 'qưew', '', '', '', '', '', '', '', '', '', '');

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
  PRIMARY KEY (`nccMa`),
  UNIQUE KEY `nhacungcap_nccten_unique` (`nccTen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`nccMa`, `nccTen`, `nccSdt`, `nccDiachi`) VALUES
(1, 'ho chi minh', '1234567890', 'adasdqweasdadqwe'),
(2, 'ha noi', '1234567890', 'ádasdwewrwwrwer');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhucau`
--

INSERT INTO `nhucau` (`ncMa`, `ncTen`) VALUES
(2, 'Gaming'),
(1, 'Văn phòng');

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
) ENGINE=InnoDB AUTO_INCREMENT=9984119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`pnMa`, `pnNgaylap`, `adMa`, `pnSoluongsp`, `pnTongtien`) VALUES
(24428, '2021-06-17 12:05:22', 1, 10, 11111110.00),
(58429, '2021-06-17 05:46:21', 1, 15, 225000000.00),
(72428, '2021-06-17 06:59:00', 1, 28, 60000000.00),
(96484, '2021-06-17 12:05:00', 1, 0, 0.00),
(423497, '2021-06-17 06:41:43', 1, 0, 0.00),
(9984118, '2021-06-17 05:45:54', 1, 0, 0.00);

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
(3748253, 'GVN Ares', 1222222.10, 0, 1, 2, 2, 2, 2, NULL, NULL),
(6679439, 'GVN Usopp', 1100000.00, 1, 1, 2, 1, 2, 2, NULL, NULL),
(63811650, 'GVN Aresâs', 3300000.00, 0, 1, 2, 2, 2, 1, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=100234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`bnMa`, `bnTieude`, `bnHinh`, `bnNgay`, `bnVitri`) VALUES
(12233, '12', 'solid2.png', '2021-06-17 09:48:25', 1),
(16233, '2', 'solid3.png', '2021-06-17 09:48:34', 1),
(23233, 'ádasd', 'img-main.png', '2021-06-17 09:23:05', 0),
(26233, '334543fr', 'solid4.png', '2021-06-17 09:58:28', 1),
(29233, 'get34a', 'img-main.png', '2021-06-17 09:58:48', 1),
(75233, 'ab', 'tải xuống.png', '2021-06-17 09:29:09', 0),
(87233, '23r', 'solid4.png', '2021-06-17 09:58:16', 1),
(88233, 'x', 'bg-login.png', '2021-06-17 09:29:01', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`thMa`, `thTen`) VALUES
(2, 'ASUS'),
(3, 'MACBOOK'),
(1, 'MSI');

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
  `vcGiatritoithieu` int(11) DEFAULT NULL,
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
