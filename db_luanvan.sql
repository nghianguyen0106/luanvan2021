-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th5 23, 2021 lúc 11:33 PM
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
(1, 'Lê Trung Nhân', 'nhan', '1', 'a@gmail.com', '123', 1, 'ok.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE IF NOT EXISTS `admin_log` (
  `adMa` int(11) NOT NULL,
  `alChitiet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alNgaygio` date NOT NULL,
  KEY `admin_log_adma_foreign` (`adMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_log`
--

INSERT INTO `admin_log` (`adMa`, `alChitiet`, `alNgaygio`) VALUES
(1, 'Thêm loại mới:LAPTOP', '2021-05-23'),
(1, 'Thêm loại mới:PC', '2021-05-23'),
(1, 'Thêm loại mới:a', '2021-05-23'),
(1, 'Xóa loại:', '2021-05-23'),
(1, 'Thêm loại mới:zxczxc', '2021-05-23'),
(1, 'Sửa loại:[{\"loaiTen\":\"zxczxc\"}] thành ok', '2021-05-23'),
(1, 'Sửa loại:[{\"loaiTen\":\"ok\"}] thành ssf', '2021-05-23'),
(1, 'Sửa loại:[{loaiTen:ssf}] thành ssfzxcc', '2021-05-23'),
(1, 'Sửa loại: thành ssfzxcczxczc', '2021-05-23'),
(1, 'Sửa loại:loaiTen thành a', '2021-05-23'),
(1, 'Sửa loại:[{\"loaiTen\":\"a\"}] thành ab', '2021-05-23'),
(1, 'Sửa loại:ab thành abzxcx', '2021-05-23'),
(1, 'Xóa loại:abzxcx', '2021-05-23'),
(1, 'Thêm nhu cầu mới:Văn phòng', '2021-05-23'),
(1, 'Thêm nhu cầu mới:LAPTOP', '2021-05-23'),
(1, 'Sửa nhu cầu:LAPTOP->Gaming', '2021-05-23'),
(1, 'Thêm nhu cầu mới:z', '2021-05-23'),
(1, 'Xóa nhu cầu:z', '2021-05-23'),
(1, 'Thêm thương hiệu mới:MSI', '2021-05-23'),
(1, 'Thêm thương hiệu mới:ASUS', '2021-05-23'),
(1, 'Thêm thương hiệu mới:MACBOOK', '2021-05-23'),
(1, 'Sửa thương hiệu:MACBOOK->MACBOOKK', '2021-05-23'),
(1, 'Xóa thương hiệu:MACBOOKK', '2021-05-23'),
(1, 'Thêm thương hiệu mới:MACBOOK', '2021-05-23'),
(1, 'Thêm nhà cung cấp mới:hcm', '2021-05-23'),
(1, 'Sửa nhà cung cấp:hcm->hcmmm', '2021-05-23'),
(1, 'Sửa nhà cung cấp:hcmmm->hcn', '2021-05-23'),
(1, 'Thêm thương hiệu mới:DELL', '2021-05-24'),
(1, 'Thêm thương hiệu mới:A', '2021-05-24'),
(1, 'Sửa thương hiệu:A->ACER', '2021-05-24'),
(1, 'Thêm thương hiệu mới:GVN', '2021-05-24'),
(1, 'Cập nhật nhân viên:trung nh\\u00e2n->Lê Trung Nhân', '2021-05-24'),
(1, 'Cập nhật sản phẩm:ASUS', '2021-05-24'),
(1, 'Thêm sản phẩm mới:GVN Aresss', '2021-05-24'),
(1, 'Xóa sản phẩm: GVN Aress', '2021-05-24'),
(1, 'Xóa sản phẩm: GVN Ares', '2021-05-24'),
(1, 'Cập nhật sản phẩm:GVN Ares', '2021-05-24'),
(1, 'Cập nhật kho, sản phẩm có mã: ASUS số lượng 16->19', '2021-05-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `bnMa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bnTieude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bnHinh` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bnNgay` timestamp NOT NULL,
  `bnVitri` int(11) NOT NULL,
  `kmMa` int(11) DEFAULT NULL,
  PRIMARY KEY (`bnMa`),
  KEY `banner_kmma_foreign` (`kmMa`)
) ENGINE=InnoDB AUTO_INCREMENT=100234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`bnMa`, `bnTieude`, `bnHinh`, `bnNgay`, `bnVitri`, `kmMa`) VALUES
(41233, 'd', 'solid5.jpg', '2021-05-23 22:37:09', 1, NULL),
(43232, '3', 'backlight_neon_electronics_144683_3840x2400.jpg', '2021-05-23 22:49:56', 0, NULL),
(50233, 'b', 'solid3.png', '2021-05-23 22:36:54', 1, NULL),
(53233, '1', 'bg-login.png', '2021-05-23 22:36:28', 0, NULL),
(83233, 'cc', 'solid4.png', '2021-05-23 22:48:48', 1, NULL),
(86233, 'a', 'solid2.png', '2021-05-23 22:36:46', 1, NULL),
(97223, '2', 'img-main.png', '2021-05-23 22:36:34', 0, NULL);

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
  `chiTongtien` double(20,4) NOT NULL,
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
  `hdTongtien` double(20,4) NOT NULL,
  `hdTinhtrang` int(11) NOT NULL,
  `hdDiachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdSdtnguoinhan` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdGhichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kmMa` int(11) DEFAULT NULL,
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
(1384796, 'asus1.png'),
(50811675, 'gvn1.png'),
(6284837, 'acer1.png'),
(76710833, 'gvn2.png');

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

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`spMa`, `khoSoluong`, `khoNgaynhap`) VALUES
(6284837, 10, '2021-05-23 22:32:46'),
(1384796, 19, '2021-05-23 23:32:23'),
(50811675, 5, '2021-05-23 22:58:35'),
(76710833, 9, '2021-05-23 23:24:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `kmMa` int(11) NOT NULL AUTO_INCREMENT,
  `kmMota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmTrigia` int(11) NOT NULL,
  `kmNgaybd` timestamp NOT NULL,
  `kmNgaykt` timestamp NOT NULL,
  `kmLoai` int(11) NOT NULL,
  `kmSoluong` int(11) DEFAULT NULL,
  `kmSoluongsp` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(20, '2021_05_12_001545_create_mota_table', 1),
(21, '2021_05_17_124939_create_nhacungcap_table', 1),
(22, '2021_05_17_125057_update_sanpham_table', 1),
(23, '2021_05_18_001638_update_khuyenmai_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mota`
--

DROP TABLE IF EXISTS `mota`;
CREATE TABLE IF NOT EXISTS `mota` (
  `spMa` int(11) NOT NULL,
  `ram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `psu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `mota` (`spMa`, `ram`, `cpu`, `ocung`, `psu`, `vga`, `mainboard`, `manhinh`, `vocase`, `pin`, `tannhiet`, `loa`, `mau`, `trongluong`, `conggiaotiep`, `webcam`, `chuanlan`, `chuanwifi`, `hedieuhanh`) VALUES
(6284837, '8GB DDR4 2400MHz (2x SO-DIMM socket, up to 32GB SDRAM)', 'AMD Ryzen 5 3550H 2.1GHz up to 3.7GHz 4MB', '512GB PCIe® NVMe™ M.2 SSD', '', '', '', '15.6\" FHD (1920 x 1080) IPS, Anti-Glare', '', '4 Cell 48Whr', 'Có', 'True Harmony; Dolby® Audio Premium', 'đen', '2kg', '2x USB 3.2- 1x USB Type C -1x USB 2.0 -1x HDMI -1x RJ45', 'HD Webcam', '10/100/1000/Gigabits Base T', 'Wi-Fi 6(Gig+)(802.11ax) (2x2)', 'Windows 10 Home'),
(1384796, '8GB Onboard DDR4 3200MHz (1x SO-DIMM socket, up to 24GB SDRAM)', 'Intel Core i7-11370H 3.0GHz up to 4.8GHz 12MB', '512GB SSD M.2 NVMe™ PCIe® 3.0 (Còn trống 1 khe SSD M.2 PCIE/ SATA3)', '', '', '', '15.6\" FHD (1920 x 1080) 16:9, Anti-Glare Display, 62.5% sRGB, 144Hz, IPS, Adaptive-Sync', '', '4 Cell 76Whr', 'Có', 'DTS:X® Ultra', 'Đen', '2,5kg', '1x Type C USB 4 with Power Delivery, Display Port and Thunderbolt™ 4-	 1x Type C USB 4 with Power Delivery, Display Port and Thunderbolt™ 4 3x USB 3.2 Gen 1 Type-A-1x HDMI 2.0b-1x RJ45-1x 3.5mm Combo Audio Jack', 'None', '10/100/1000 Mbps', '802.11ax (2X2), Bluetooth v5.1', 'Windows 10 Home'),
(50811675, 'G.SKILL Ripjaws V 1x8G bus 2800', 'Intel Core i5 10400F / 12MB / 2.9GHz / 6 Nhân 12 Luồng / LGA 1200', 'Gigabyte SSD 240GB 2.5\" Sata 3', 'Nguồn SilverStone ST65F-ES230 - 80 Plus', 'GIGABYTE GeForce RTX™ 2060 OC 6G', 'ASROCK B460M Pro4', '', 'Case MSI MAG VAMPIRIC 100R', '', '', '', '', '', '', '', '', '', ''),
(76710833, 'G.SKILL Ripjaws V 1x8G bus 2800', 'CPU AMD Athlon™ 3000G 3.5GHz / 2 nhân 4 luồng / Radeon™ Vega 3 Graphics', 'Lexar NS100 RB 2.5\'\' SATA3 128GB', 'Nguồn Deepcool DN450 - 80 Plus', 'none', 'Mainboard ASUS PRIME A320M-E', '', 'XIGMATEK XA-20 (ATX)', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

DROP TABLE IF EXISTS `nhacungcap`;
CREATE TABLE IF NOT EXISTS `nhacungcap` (
  `nccMa` int(11) NOT NULL AUTO_INCREMENT,
  `nccTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`nccMa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`nccMa`, `nccTen`) VALUES
(1, 'hcn');

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
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `spMa` int(11) NOT NULL,
  `spTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spGia` double(20,4) NOT NULL,
  `spHanbh` int(11) NOT NULL,
  `spTinhtrang` int(11) NOT NULL,
  `kmMa` int(11) DEFAULT NULL,
  `thMa` int(11) NOT NULL,
  `loaiMa` int(11) NOT NULL,
  `ncMa` int(11) NOT NULL,
  `nccMa` int(11) NOT NULL,
  PRIMARY KEY (`spMa`),
  UNIQUE KEY `sanpham_spten_unique` (`spTen`),
  KEY `sanpham_ncma_foreign` (`ncMa`),
  KEY `sanpham_loaima_foreign` (`loaiMa`),
  KEY `sanpham_thma_foreign` (`thMa`),
  KEY `sanpham_kmma_foreign` (`kmMa`),
  KEY `sanpham_nccma_foreign` (`nccMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`spMa`, `spTen`, `spGia`, `spHanbh`, `spTinhtrang`, `kmMa`, `thMa`, `loaiMa`, `ncMa`, `nccMa`) VALUES
(1384796, 'ASUS', 24000000.0000, 1, 1, NULL, 2, 1, 2, 1),
(6284837, 'Acer', 19000000.0000, 1, 1, NULL, 6, 1, 1, 1),
(50811675, 'GVN Ghost S', 20000000.0000, 1, 1, NULL, 7, 2, 2, 1),
(76710833, 'GVN Ares', 5000000.0000, 1, 1, NULL, 7, 2, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu`
--

DROP TABLE IF EXISTS `thu`;
CREATE TABLE IF NOT EXISTS `thu` (
  `adMa` int(11) NOT NULL,
  `alNgaygio` timestamp NOT NULL,
  `thuSoluong` int(11) NOT NULL,
  `thuTongtien` double(20,4) NOT NULL,
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
(6, 'ACER'),
(2, 'ASUS'),
(5, 'DELL'),
(7, 'GVN'),
(4, 'MACBOOK'),
(1, 'MSI');

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
  ADD CONSTRAINT `sanpham_nccma_foreign` FOREIGN KEY (`nccMa`) REFERENCES `nhacungcap` (`nccMa`) ON DELETE CASCADE ON UPDATE CASCADE,
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
