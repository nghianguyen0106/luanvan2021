-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th5 04, 2021 lúc 09:33 AM
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
  `adMa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adTaikhoan` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adMatkhau` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adSdt` int(11) NOT NULL,
  `adEmail` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adHinh` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adQuyen` int(11) NOT NULL,
  PRIMARY KEY (`adMa`),
  UNIQUE KEY `admin_adten_unique` (`adTen`),
  UNIQUE KEY `admin_adtaikhoan_unique` (`adTaikhoan`),
  UNIQUE KEY `admin_ademail_unique` (`adEmail`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adMa`, `adTen`, `adTaikhoan`, `adMatkhau`, `adSdt`, `adEmail`, `adHinh`, `adQuyen`) VALUES
(2, 'nhan', 'nhan', '1', 909090, 'nhan@gmail.com', 'ok.jpg', 1),
(4, 'nghia', 'nghia', '1', 12323131, 'nghia@gmail.com', '119924581_752408281992880_1050379176225078592_n.jpg', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `bnMa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bnHinh` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`bnMa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocao`
--

DROP TABLE IF EXISTS `baocao`;
CREATE TABLE IF NOT EXISTS `baocao` (
  `bcMa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bcTonghangxuat` int(11) NOT NULL,
  `bcTonghangnhap` int(11) DEFAULT NULL,
  `bcThu` int(11) NOT NULL,
  `bcChi` int(11) DEFAULT NULL,
  `bcTonkho` int(11) DEFAULT NULL,
  `bcNgayBD` date NOT NULL,
  `bcNgayKT` date NOT NULL,
  `bcNgaylap` date NOT NULL,
  PRIMARY KEY (`bcMa`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

DROP TABLE IF EXISTS `chitiethoadon`;
CREATE TABLE IF NOT EXISTS `chitiethoadon` (
  `hdMa` int(11) NOT NULL,
  `spMa` int(11) NOT NULL,
  `cthdSoluong` int(11) NOT NULL,
  `cthdGia` int(11) NOT NULL,
  KEY `chitiethoadon_hdma_foreign` (`hdMa`),
  KEY `chitiethoadon_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`hdMa`, `spMa`, `cthdSoluong`, `cthdGia`) VALUES
(7113456, 97051115, 1, 7050000),
(7113453, 553641115, 2, 72910000),
(3113457, 553641115, 1, 36455000),
(99115451, 189361115, 1, 93690000),
(91121548, 96091115, 3, 18270000),
(91121548, 97051115, 3, 21150000),
(91121548, 114431115, 2, 88780000),
(86121559, 96091115, 1, 6090000);

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
  `dgNgay` date NOT NULL,
  `dgTrangthai` int(11) NOT NULL,
  PRIMARY KEY (`dgMa`),
  KEY `danhgia_spma_foreign` (`spMa`),
  KEY `danhgia_khma_foreign` (`khMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`dgMa`, `khMa`, `dgNoidung`, `spMa`, `dgNgay`, `dgTrangthai`) VALUES
(71134297, 11651, 'hihihih', 97051115, '2021-04-24', 0),
(211138397, 11651, 'bao nhiêu 1 chục ?', 97051115, '2021-04-24', 0);

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
(411841115, 'aspire715-75g-41g_black-02_521acc5fae0543b7a92204c59d1f94b0.jpg'),
(411841115, 'aspire7_a715-75g-41g_black-06_1b4ba29f13ad4c9a99385d46ada20656.jpg'),
(411841115, 'r4st_e4cdcf53ef724ad093cc2d439bdd5994.jpg'),
(524191115, '78tn_a29a4ed5ae4142e6ad3c3cd2fb28a8d2.jpg'),
(381731115, 'eg0070tu_3_72f8767bf0534f319ac97ef28f3186ac.jpg'),
(401041115, 'lenovo_ideapad_slim_3_14iil05_81wd00vjvn_10494c734622428ab75aab9369954cd0.jpg'),
(97051115, 'prime_def2f501a2cb4421ace4e19697ef24c7.jpg'),
(96091115, 'usopp_56df5d4d3c884fa7952ef74716dd73e9.jpg'),
(185341115, 'c701-2_8e9a56b6e37049038bcb4b11ca70d97c.jpg'),
(189361115, 'c703-2_2caa458c242f4b7aaf42ca737fbe5ca3.jpg'),
(114431115, 'garen01_e404f80487304e97a7c88b4b6ba0d1a7.jpg'),
(382841115, '241vn_220e2af97cb64ba29ceb8a9281e6252b.jpg'),
(416691115, '073vn_d6fb25ffb4eb4301b99eff4c30fa6df2.jpg'),
(416691115, 'product_8_20200309093024_5e659c3095f4e_3e88cd79d4504b379f378f8429280c47.jpg'),
(416691115, 'product_0_20200309093021_5e659c2deda33_4189c4430eb746d6a0d3b28c0c8d0839.jpg'),
(416691115, 'product_5_20200309093027_5e659c3301fd8_28ec1913837a49fdab0c8758944e1f3f.jpg'),
(701191115, 'unnamed.jpg'),
(701191115, 'unnamedx.jpg'),
(701191115, 'y.jpg'),
(553641115, 'pros.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

DROP TABLE IF EXISTS `hoadon`;
CREATE TABLE IF NOT EXISTS `hoadon` (
  `hdMa` int(11) NOT NULL,
  `khMa` int(11) NOT NULL,
  `hdNgaytao` date NOT NULL,
  `hdSoluongsp` int(11) NOT NULL,
  `hdTongtien` int(11) NOT NULL,
  `hdTinhtrang` int(11) NOT NULL,
  `hdDiachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdSdtnguoinhan` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hdGhichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hdNhanvien` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hdMa`),
  KEY `hoadon_khma_foreign` (`khMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`hdMa`, `khMa`, `hdNgaytao`, `hdSoluongsp`, `hdTongtien`, `hdTinhtrang`, `hdDiachi`, `hdSdtnguoinhan`, `hdGhichu`, `hdNhanvien`) VALUES
(3113457, 11651, '2021-04-24', 1, 36455000, 2, '180 cao lo p4 q8', '01623546872', NULL, 'nghia'),
(7113453, 11651, '2021-04-24', 2, 72910000, 1, 'asdada', '01692522094', NULL, 'nghia'),
(7113456, 11651, '2021-04-24', 1, 7050000, 0, 'asdada', '444444444', NULL, '4'),
(86121559, 11651, '2021-05-02', 1, 6090000, 0, 'asdada', '1111111111', NULL, NULL),
(91121548, 101041, '2021-05-02', 8, 128200000, 0, 'e2qwe', '1221222121', 'aqweqwe', NULL),
(99115451, 11651, '2021-04-26', 1, 93690000, 0, 'asdada', '0392522094', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `khMa` int(11) NOT NULL,
  `khTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khEmail` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khMatkhau` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khNgaysinh` date NOT NULL,
  `khDiachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khQuyen` int(11) NOT NULL,
  `khGioitinh` int(11) NOT NULL,
  `khTaikhoan` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khToken` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khSdt` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khHinh` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`khMa`),
  UNIQUE KEY `khachhang_khemail_unique` (`khEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`khMa`, `khTen`, `khEmail`, `khMatkhau`, `khNgaysinh`, `khDiachi`, `khQuyen`, `khGioitinh`, `khTaikhoan`, `khToken`, `khSdt`, `khHinh`) VALUES
(4131, 'Tèo', 'a@a.com', 'c4ca4238a0b923820dcc509a6f75849b', '1999-06-01', '1', 0, 0, 'teo', NULL, NULL, ''),
(5119, 'a', 'a@abc.com', 'a', '2021-05-12', '1232', 0, 1, 'a', '', '12321312', '119924581_752408281992880_1050379176225078592_n.jpg'),
(8761, 'NghiaSTU', 'dh51700660@student.stu.edu.vn', 'c4ca4238a0b923820dcc509a6f75849b', '1999-06-01', '1sdssad', 0, 0, 'nghiat', NULL, NULL, ''),
(11651, 'nghianguyen', 'nguyenchinghia199916@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '1999-06-01', 'asdada', 0, 0, 'nghia', NULL, NULL, ''),
(15761, 'Huỳnh Lan Anh', 'Huynhlananh29032001@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2001-03-29', '1sdasds', 0, 0, 'lananh', NULL, NULL, ''),
(101041, 'trung nhan', 'letrungnhan99@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '1999-08-22', 'quoc lo 50', 0, 1, 'nhan', '041001212021', '5433445533', 'ok.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

DROP TABLE IF EXISTS `kho`;
CREATE TABLE IF NOT EXISTS `kho` (
  `spMa` int(11) NOT NULL,
  `khoSoluong` int(11) NOT NULL,
  `khoNgaynhap` date NOT NULL,
  KEY `kho_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`spMa`, `khoSoluong`, `khoNgaynhap`) VALUES
(411841115, 100, '2021-04-22'),
(381731115, 50, '2021-04-22'),
(401041115, 50, '2021-04-22'),
(97051115, 165, '2021-05-02'),
(96091115, 1000, '2021-05-02'),
(185341115, 16, '2021-04-22'),
(189361115, 9, '2021-04-22'),
(114431115, 10, '2021-04-22'),
(382841115, 100, '2021-04-22'),
(416691115, 30, '2021-04-22'),
(701191115, 15, '2021-04-22'),
(553641115, 0, '2021-04-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `kmMa` int(11) NOT NULL AUTO_INCREMENT,
  `kmTrigia` int(11) NOT NULL,
  `khMota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khNgaybd` date NOT NULL,
  `kmNgaykt` date NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_04_06_145630_create_khachhangs_table', 1),
(2, '2021_04_06_145708_create_hoadons_table', 1),
(3, '2021_04_06_145804_create_loais_table', 1),
(4, '2021_04_06_145813_create_thuonghieus_table', 1),
(5, '2021_04_06_145825_create_nhucaus_table', 1),
(6, '2021_04_06_145839_create_khuyenmais_table', 1),
(7, '2021_04_06_150037_create_sanphams_table', 1),
(8, '2021_04_06_150101_create_khos_table', 1),
(9, '2021_04_06_153048_create_chitiethoadons_table', 1),
(10, '2021_04_06_153107_create_motas_table', 1),
(11, '2021_04_06_155437_create_danhgias_table', 1),
(12, '2021_04_06_160954_create_baocaos_table', 1),
(13, '2021_04_06_161003_create_banners_table', 1),
(14, '2021_04_06_161106_create_hinhs_table', 1),
(15, '2021_04_06_161259_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mota`
--

DROP TABLE IF EXISTS `mota`;
CREATE TABLE IF NOT EXISTS `mota` (
  `spMa` int(11) NOT NULL,
  `manhinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chuot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banphim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `psu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainboard` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vocase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tannhiet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `mota_spma_foreign` (`spMa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mota`
--

INSERT INTO `mota` (`spMa`, `manhinh`, `chuot`, `banphim`, `ram`, `psu`, `mainboard`, `ocung`, `vga`, `vocase`, `pin`, `tannhiet`, `loa`) VALUES
(411841115, '15.6\" FHD (1920 x 1080) IPS, Anti-Glare, 60Hz', NULL, NULL, '8GB DDR4 (2x SO-DIMM socket, up to 32GB SDRAM)', '4 Cell 48Whr', 'AMD Ryzen 5 – 5500U', '256GB PCIe® NVMe™ M.2 SSD', 'NVIDIA GeForce GTX 1650 4GB GDDR6', NULL, '4 Cell 48Whr', 'Mặc định', 'True Harmony; Dolby® Audio Premium'),
(381731115, '15.6\" FHD (1920 x 1080) IPS, Anti-Glare with 45% NTSC, 250 nits', NULL, 'Không đèn', '8GB (4GBx2) DDR4 3200MHz (2x SO-DIMM socket, up to 16GB SDRAM)', '3 Cell 41Whr', 'Intel Core i5-1135G7 2.4GHz up to 4.2GHz 8MB', '512GB PCIe® NVMe™ M.2 SSD', 'Intel Iris Xe Graphics', NULL, '3 Cell 41Whr', 'Mặc định', 'B&O, Dual Speakers, HP Audio Boost'),
(401041115, '14\" FHD (1920x1080) TN 220nits Anti-glare', NULL, 'Non-backlit, English', '4GB Soldered DDR4-2666', 'Integrated 35Wh', 'Intel Core i3-1005G1 (2C / 4T, 1.2 / 3.4GHz, 4MB)', '256GB SSD M.2 2242 PCIe 3.0x2 NVMe', 'Integrated Intel UHD Graphics', NULL, 'Integrated 35Wh', 'Mặc định', 'High Definition (HD) Audio'),
(97051115, NULL, NULL, NULL, 'G.SKILL Ripjaws V 1x8G bus 2800', 'Deepcool DN450 80 Plus', 'AMD Ryzen 3 3200G /6MB /3.6GHz /4 nhân 4 luồng, Mainboard ASUS PRIME A320M-E', 'PNY SSD CS900 120G 2.5\" Sata 3', '----', 'XIGMATEK XA-20 (ATX)', NULL, 'Mặc định', NULL),
(96091115, NULL, NULL, NULL, 'Kingston HyperX Fury Black 1x8GB bus 2666', 'Deepcool DN450 80 Plus', 'Intel Pentium Gold G5420 / 4M / 3.8GHz / 2 nhân 4 luồng ,Asrock H310CM HDV LGA 1151v2', 'PNY SSD CS900 120G 2.5\" Sata 3', '-----', 'Deepcool DN450 80 Plus', NULL, 'Mặc định', NULL),
(185341115, NULL, NULL, NULL, 'G.SKILL Trident Z RGB 4x8GB 3000', 'Nguồn Corsair RM850 80 Plus GOLD', 'X299X AORUS MASTER (rev. 1.0) LGA 2066, 	 Intel Core i9 10900X / 19.5M / 3.7GHz / 10 nhân 20 luồng LGA2066', 'WD Black SN750 500GB M.2 NVMe PCIe, 	Seagate Barracuda 2TB 3.5\' 7200 RPM', 'Gigabyte GeForce GTX 1660 OC 6G GDDR5', 'Deepcool Matrexx70 3F', NULL, 'Tản Khí Noctua NH - U12A', NULL),
(189361115, NULL, NULL, NULL, 'GSKILL Trident Z RGB 4x16GB 3000', 'Asus ROG Strix 1000W 80 Plus Gold Full modular', 'Asus ROG Rampage VI Extreme Encore, 	Intel Core i9 10980XE 24.75M 18C26T 3.0GHz', 'Seagate Barracuda 2TB 3.5\' 7200 RPM, 	WD Black SN750 500GB M.2 PCIe NVMe', 'MSI GeForce RTX 3060 Ventus 2x OC 12GB GDDR6', 'Deepcool Matrexx70 3F', NULL, 'Noctua NH - U12A', NULL),
(114431115, NULL, NULL, NULL, 'HyperX Fury RGB 1x8G bus 3200 x 2', 'Nguồn CoolerMaster MWE 650 BRONZE - V2 230V', 'MSI MPG Z490 GAMING PLUS, 	Intel Core i7 10700KA Avengers Edition / 16MB / 3.8GHz / 8 Nhân 16 Luồng / LGA 1200', 'SSD KINGSTON A2000 250GB M.2 NVMe', 'GIGABYTE GeForce RTX 3060 GAMING OC 12G', 'MSI MAG VAMPIRIC 010 Mid-Tower', NULL, 'DEEPCOOL GAMMAXX GTE V2', NULL),
(382841115, '15.6\" FHD (1920 x 1080) IPS-Level, 144Hz, 72%NTSC Thin Bezel, close to 100%sRGB', NULL, NULL, '2 x 8GB DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)', '3 Cell 51WHr', 'Intel Core i5-10300H', '512GB SSD M.2 PCIE', 'NVIDIA GeForce RTX 3060 6GB GDDR6', NULL, '3 Cell 51WHr', 'Mặc định', '2x 2W Speaker'),
(416691115, '15.6\" FHD (1920 x 1080) IPS with Anti-Glare, 300Hz, 3ms, Thin Bezel, 100% sRGB', NULL, 'Steel Series per-Key RGB with Anti-Ghost key (84 Key)', '32GB (16GBx2) DDR4 3200MHz (2x SO-DIMM socket, up to 64GB SDRAM)', '4 Cell 99.9Whr', 'Intel Core i7-10870H 2.2 GHz up to 5.0GHz 16MB', '2TB SSD PCIE G3X4', 'NVIDIA GeForce RTX3070 Max-Q 8GB GDDR6', NULL, '4 Cell 99.9Whr', 'Mặc định', 'Sound by Dynaudio and High-Resolution Audio ready (2x 2W Speaker)'),
(701191115, NULL, NULL, NULL, '1 x 4GB DDR4 2400MHz ( 2 Khe cắm Hỗ trợ tối đa 32GB )', '---', 'CPU: Intel Core i5-8400 ( 2.80 GHz - 4.00 GHz / 9MB / 6 nhân, 6 luồng )', '1TB HDD 7200RPM', 'Intel UHD Graphics 630', NULL, NULL, 'Mặc định', NULL),
(553641115, NULL, NULL, NULL, '2 x 8GB DDR4 3000MHz ( 4 Khe cắm Hỗ trợ tối đa 64GB )', '---', 'Intel Core i5-8400 ( 2.8 GHz - 4.0 GHz / 9MB / 6 nhân, 6 luồng )', '128GB SSD', 'Intel UHD Graphics 630 / GeForce GTX 1070Ti 8GB', NULL, NULL, 'Mặc định', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhucau`
--

DROP TABLE IF EXISTS `nhucau`;
CREATE TABLE IF NOT EXISTS `nhucau` (
  `ncMa` int(11) NOT NULL AUTO_INCREMENT,
  `ncTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ncMa`),
  UNIQUE KEY `nhucau_ncten_unique` (`ncTen`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhucau`
--

INSERT INTO `nhucau` (`ncMa`, `ncTen`) VALUES
(3, 'Đồ họa'),
(2, 'Gaming'),
(1, 'Văn phòng'),
(4, 'Work Station');

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

INSERT INTO `sanpham` (`spMa`, `spTen`, `spGia`, `spHanbh`, `kmMa`, `thMa`, `loaiMa`, `ncMa`) VALUES
(96091115, 'GVN Usopp', 6090000, 12, NULL, 7, 2, 1),
(97051115, 'GVN Prime', 7050000, 24, NULL, 7, 2, 1),
(114431115, 'GVN Garen S', 44390000, 12, NULL, 7, 2, 2),
(185341115, 'GVN G-Creator C701', 53490000, 24, NULL, 7, 2, 3),
(189361115, 'GVN G-Creator C703', 93690000, 36, NULL, 7, 2, 4),
(381731115, 'Laptop HP Pavilion 15 eg0070TU 2L9H3PA', 17390000, 12, NULL, 3, 1, 1),
(382841115, 'Laptop Gaming MSI GF65 Thin 10UE 241VN', 28490000, 24, NULL, 4, 1, 2),
(401041115, 'LENOVO IDEAPAD SLIM 3 14IIL05 81WD00VJVN', 10490000, 12, NULL, 5, 1, 1),
(411841115, 'Laptop gaming Acer Aspire 7 A715 42G R4ST', 18490000, 12, NULL, 1, 1, 2),
(416691115, 'Laptop Gaming MSI GS66 Stealth 10UG 073VN', 66990000, 24, NULL, 4, 1, 2),
(524191115, 'Laptop gaming Acer Predator Helios 300 PH315 53 78TN', 41990000, 12, NULL, 1, 1, 2),
(553641115, 'PC Phong Vũ PUBG 1 (i5-8400/16GB/128GB SSD/GTX 1070Ti)', 36455000, 24, NULL, 2, 2, 2),
(701191115, 'PC Acer Aspire M230 UX.VQVSI.145 (i5-8400/4GB/1TB HDD/UHD 630/Endless)', 11990000, 12, NULL, 1, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

DROP TABLE IF EXISTS `thuonghieu`;
CREATE TABLE IF NOT EXISTS `thuonghieu` (
  `thMa` int(11) NOT NULL AUTO_INCREMENT,
  `thTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`thMa`),
  UNIQUE KEY `thuonghieu_thten_unique` (`thTen`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`thMa`, `thTen`) VALUES
(1, 'Acer'),
(2, 'Asus'),
(6, 'Dell'),
(7, 'GVN'),
(3, 'HP'),
(5, 'Lenovo'),
(4, 'MSI');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_hdma_foreign` FOREIGN KEY (`hdMa`) REFERENCES `hoadon` (`hdMa`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitiethoadon_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE,
  ADD CONSTRAINT `danhgia_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hinh`
--
ALTER TABLE `hinh`
  ADD CONSTRAINT `hinh_spma_foreign` FOREIGN KEY (`spMa`) REFERENCES `sanpham` (`spMa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_khma_foreign` FOREIGN KEY (`khMa`) REFERENCES `khachhang` (`khMa`) ON DELETE CASCADE;

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
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_kmma_foreign` FOREIGN KEY (`kmMa`) REFERENCES `khuyenmai` (`kmMa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_loaima_foreign` FOREIGN KEY (`loaiMa`) REFERENCES `loai` (`loaiMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_ncma_foreign` FOREIGN KEY (`ncMa`) REFERENCES `nhucau` (`ncMa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_thma_foreign` FOREIGN KEY (`thMa`) REFERENCES `thuonghieu` (`thMa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
