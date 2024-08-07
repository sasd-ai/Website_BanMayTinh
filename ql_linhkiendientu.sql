-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 02, 2024 lúc 06:15 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_linhkiendientu`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTinhTrangBHProc` (IN `p_MaDH` VARCHAR(10), IN `p_MaSP` VARCHAR(10))   BEGIN
    DECLARE TGBaoHanh INT;
    DECLARE NgayHoaDon DATE;
    DECLARE ThoiGianBaoHanhTinhDenNgay DATE;
    DECLARE TinhTrang VARCHAR(255);

    -- Lấy thông tin bảo hành từ các bảng liên quan
    SELECT sp.Tg_BaoHanh, dh.NgayDatHang
    INTO TGBaoHanh, NgayHoaDon
    FROM sanpham sp 
    JOIN dathang dh ON sp.MaSP = p_MaSP AND dh.MaDH = p_MaDH; 

    -- Tính ngày hết hạn bảo hành
    SET ThoiGianBaoHanhTinhDenNgay = DATE_ADD(NgayHoaDon, INTERVAL TGBaoHanh MONTH);

    -- Xác định trạng thái bảo hành
    IF NOW() <= ThoiGianBaoHanhTinhDenNgay THEN
        SET TinhTrang = CONCAT('Còn bảo hành đến ngày ', DATE_FORMAT(ThoiGianBaoHanhTinhDenNgay, '%Y-%m-%d'));
    ELSE
        SET TinhTrang = CONCAT('Hết bảo hành từ ngày ', DATE_FORMAT(ThoiGianBaoHanhTinhDenNgay, '%Y-%m-%d'));
    END IF;

    -- Cập nhật trạng thái bảo hành vào bảng chitietdathang
    UPDATE chitietdathang 
    SET TinhTrang_BH = TinhTrang 
    WHERE MaDH = p_MaDH AND MaSP = p_MaSP;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `MaDH` varchar(10) NOT NULL,
  `MaSP` varchar(10) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `TinhTrang_BH` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`MaDH`, `MaSP`, `SoLuong`, `ThanhTien`, `TinhTrang_BH`) VALUES
('DHC9wiynYr', 'SP014', 1, 700000, 'Hết bảo hành từ ngày 2021-12-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `MaGH` varchar(10) NOT NULL,
  `MaSP` varchar(10) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietgiohang`
--

INSERT INTO `chitietgiohang` (`MaGH`, `MaSP`, `SoLuong`, `ThanhTien`) VALUES
('MAGHEmbjXq', 'SP002', 5, 1500000),
('MAGHEmbjXq', 'SP012', 1, 550000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `madg` varchar(10) NOT NULL,
  `masp` varchar(10) NOT NULL,
  `makh` varchar(10) NOT NULL,
  `noidungdanhgia` text NOT NULL,
  `ngaygiodanhgia` datetime NOT NULL,
  `sosao` int(1) NOT NULL,
  `hinhanh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`madg`, `masp`, `makh`, `noidungdanhgia`, `ngaygiodanhgia`, `sosao`, `hinhanh`) VALUES
('madghCT4Jg', 'SP013', 'KH3zyopOAq', 'ok nha', '2024-06-02 12:29:41', 4, 'danhgia/Rq5C0DgKQMCnZss1zqrCC0ldA66Tf8tIjyWCR5LM.jpg'),
('madgJKBBQF', 'SP013', 'KH3zyopOAq', 'ok', '2024-06-01 16:40:40', 5, 'danhgia/oy1e7AzATKkqQjJJXrPF1oc1GAWjVz7eV1XQPcmT.jpg'),
('madgJmH5zm', 'SP012', 'KHwwQEJfHU', 'OUTJHDFL', '2024-06-02 23:07:57', 5, 'danhgia/rliTBxbf55h0yrJmltlddUl4LULxSToKmE0ZUU6J.jpg'),
('madgW0xn3C', 'SP013', 'KH3zyopOAq', 'đẹp lắm', '2024-05-13 07:40:52', 5, 'danhgia/ONgleKXS3RphB7DknHFdUmrPH9bCZIzgdOG87e0c.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `MaDH` varchar(10) NOT NULL,
  `MaKH` varchar(10) NOT NULL,
  `MaKM` varchar(10) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `TienKM` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `GhiChu` varchar(500) NOT NULL,
  `DiaChi` varchar(500) NOT NULL,
  `TenKH` varchar(100) NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `NgayDatHang` datetime DEFAULT NULL,
  `TinhTrang_TT` varchar(200) NOT NULL,
  `TinhTrang_DH` varchar(200) NOT NULL,
  `transaction_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`MaDH`, `MaKH`, `MaKM`, `TongTien`, `TienKM`, `ThanhTien`, `GhiChu`, `DiaChi`, `TenKH`, `SDT`, `NgayDatHang`, `TinhTrang_TT`, `TinhTrang_DH`, `transaction_id`) VALUES
('DHC9wiynYr', 'KH3zyopOAq', 'KM001', 700000, 100000, 600000, 'giao giờ hành chính', 'tân bình', 'thanh', '123', '2020-06-01 21:49:47', 'Đã Thanh Toán', 'Đã Xác Nhận Đơn', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGH` varchar(10) NOT NULL,
  `MaKH` varchar(10) NOT NULL,
  `TongTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MaGH`, `MaKH`, `TongTien`) VALUES
('GH001', 'KH001', 0),
('GH002', 'KH002', 0),
('MAGHEmbjXq', 'KHyoFoV3tP', 2050000),
('MAGHlWMHWS', 'KH3zyopOAq', 3000000),
('MAGHOC3gS1', 'KHwwQEJfHU', 550000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` varchar(10) NOT NULL,
  `TenKH` varchar(500) NOT NULL,
  `SDT` varchar(12) DEFAULT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `SDT`, `Email`) VALUES
('KH001', 'Nguyễn Văn A', '0123456789', 'nguyenvana@example.com'),
('KH002', 'Trần Thị B', '0987654321', 'tranthib@example.com'),
('KH3zyopOAq', 'Tran Thanh', NULL, 'thanhtran.070103@gmail.com'),
('KHwwQEJfHU', '22631205 Tran Thi Tuong Van', NULL, '22631205@kthcm.edu.vn'),
('KHyoFoV3tP', 'thanhhh', NULL, 'thanh@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKM` varchar(10) NOT NULL,
  `TenKM` varchar(500) NOT NULL,
  `GiaTri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKM`, `TenKM`, `GiaTri`) VALUES
('KM001', 'Giảm giá ', 100000),
('KM002', 'Giảm giá ', 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoai` varchar(10) NOT NULL,
  `TenLoai` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoai`, `TenLoai`) VALUES
('CPU', 'Bộ xử lý trung tâm'),
('GPU', 'card đồ họa'),
('Keyboard', 'Bàn phím'),
('Monitor', 'Monitor'),
('Mouse', 'Chuột'),
('RAM', 'bộ nhớ khả biến');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` varchar(10) NOT NULL,
  `TenNV` varchar(500) NOT NULL,
  `DiaChi` varchar(500) NOT NULL,
  `SDT` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `TenNV`, `DiaChi`, `SDT`) VALUES
('NV001', 'Phạm Thị C', '123 Đường ABC, Quận XYZ, TP HCM', '0123456789'),
('NV002', 'Trần Văn D', '456 Đường XYZ, Quận ABC, TP HCM', '0987654321');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(10) NOT NULL,
  `TenSP` varchar(500) NOT NULL,
  `HinhAnh` varchar(500) NOT NULL,
  `GiaDeXuat` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `MoTa` varchar(500) NOT NULL,
  `Tg_BaoHanh` int(11) NOT NULL,
  `MaLoai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `HinhAnh`, `GiaDeXuat`, `SoLuong`, `GiaBan`, `MoTa`, `Tg_BaoHanh`, `MaLoai`) VALUES
('SP001', 'AMD Ryzen 5 5600X', 'https://product.hstatic.net/200000722513/product/a_amdryzen5_wgraphics_3dpib_righ_c2564b6e8ec647b1827237adaf34ba4d_1024x1024.png', 300, 0, 350000, '6-core, 12-thread processor', 36, 'CPU'),
('SP002', 'Intel Core i5-11600K', 'https://phuongnamec.vn/media/product/250-2874-37202_i5_11400.jpg', 250, 0, 300000, '6-core, 12-thread processor', 36, 'CPU'),
('SP003', 'AMD Ryzen 7 5800X', 'https://product.hstatic.net/200000722513/product/8ghz-boost-4-7ghz-8-nhan-16-luon_0a6b8aebafb3469f987ba5200d6833e9_1024x1024.png', 450, 0, 500000, '8-core, 16-thread processor', 36, 'CPU'),
('SP004', 'Intel Core i9-11900K', 'https://product.hstatic.net/200000722513/product/s-1x1.png.rendition.intel.web.550.550_9097b0109cf040ac9cc64a18c62198f8_55d9d7cbe304419489e72d559beeee6e_1024x1024.png', 600, 0, 650000, '8-core, 16-thread processor', 36, 'CPU'),
('SP005', 'AMD Ryzen 9 5950X', 'https://product.hstatic.net/200000722513/product/-3-4ghz-boost-4-9ghz-16-nhan-32-luong_44080d881bbc4828b07fde3d76fd7955_e6c12721e7c740ef8e4ca29903a8ff7c_1024x1024.jpg', 800, 0, 850000, '16-core, 32-thread processor', 36, 'CPU'),
('SP006', 'Intel Core i7-11700K', 'https://product.hstatic.net/200000420363/product/i7.10700k.b.ch_10e0dd2093174ba5ab72154eeeea8334_master.jpg', 400, 0, 450000, '8-core, 16-thread processor', 36, 'CPU'),
('SP007', 'AMD Ryzen 5 5600G', 'https://product.hstatic.net/200000722513/product/a_amdryzen5_wgraphics_3dpib_right_row_99e7de9476c8487fa129b02a0d338ea3_c4301323354744c18da49d272dff73ab_1024x1024.png', 200, 0, 250000, '6-core, 12-thread processor with integrated graphics', 36, 'CPU'),
('SP008', 'Intel Core i3-10100F', 'https://product.hstatic.net/200000722513/product/n22746-001-rpl-i3f-fhs-dva-bc-univ_png_b7e80ee4a06f4662b2aa7f3d6ec97364.png', 100, 0, 150000, '4-core, 8-thread processor', 36, 'CPU'),
('SP009', 'AMD Ryzen 3 3300X', 'https://product.hstatic.net/200000722513/product/-4300g-processor-with-radeon-graphics_f334518704cc40e19a7198cee54d14f7_781e7f3301cd49a9b6180ae3d1bf0a97.png', 150, 0, 200000, '4-core, 8-thread processor', 36, 'CPU'),
('SP010', 'Intel Core i9-10900K', 'https://product.hstatic.net/200000722513/product/i9k_379efd950af74727a83b02c13817a3a7.png', 500, 0, 550000, '10-core, 20-thread processor', 36, 'CPU'),
('SP011', 'NVIDIA GeForce RTX 3060 Ti', 'https://product.hstatic.net/200000420363/product/khung-sp---hang-cu_c64476012bce4de29f74c3a33b23dff7_master.jpg', 400, 0, 450000, '8GB GDDR6 VRAM', 24, 'GPU'),
('SP012', 'AMD Radeon RX 6700 XT', 'https://product.hstatic.net/200000420363/product/khung-sp---hang-cu_3967f2a74a484cec910104d928f251b4_master.jpg', 500, 0, 550000, '12GB GDDR6 VRAM', 24, 'GPU'),
('SP013', 'NVIDIA GeForce RTX 3070', 'https://product.hstatic.net/200000420363/product/gg_rtx3070ti_vision_oc_5477b4318cda4adb8d787509fb916b3b_master.jpg', 600, 0, 650000, '8GB GDDR6 VRAM', 24, 'GPU'),
('SP014', 'AMD Radeon RX 6800', 'https://m.maihoang.com.vn/thumb/crop/12976', 650, 0, 700000, '16GB GDDR6 VRAM', 18, 'GPU'),
('SP015', 'NVIDIA GeForce RTX 3080 Ti', 'https://product.hstatic.net/1000333506/product/evga-geforce-rtx-3080-ftw3-ultra-gaming-10gb-gddr6x-01_0e8f10ba268b4fde93a7e7c358f0ae98_grande.jpeg', 900, 0, 950000, '12GB GDDR6X VRAM', 24, 'GPU'),
('SP016', 'AMD Radeon RX 6900 XT', 'https://product.hstatic.net/1000333506/product/as_rx6900xt_tuf_gm_oc-600x600_f3856f206e464db4bc875961991e01f5_grande.jpg', 1000, 0, 1050000, '16GB GDDR6 VRAM', 24, 'GPU'),
('SP017', 'NVIDIA GeForce RTX 3090', 'https://product.hstatic.net/1000333506/product/gx_3090-box_p-125f4e6415dab637.08901333-740x740_902efaa5a51d48269c38e595c32b88b2_grande.png', 1500, 0, 1550000, '24GB GDDR6X VRAM', 24, 'GPU'),
('SP018', 'AMD Radeon VII', 'https://i.ebayimg.com/images/g/3GQAAOSwKodlnIUO/s-l1600.jpg', 700, 0, 750000, '16GB HBM2 VRAM', 24, 'GPU'),
('SP019', 'NVIDIA GeForce RTX 3050 Ti', 'https://product.hstatic.net/1000333506/product/1024__35__ee52748278954dd29ac5eaa8db0722b3_grande.png', 250, 0, 300000, '4GB GDDR6 VRAM', 24, 'GPU'),
('SP020', 'AMD Radeon RX 6600 XT', 'https://product.hstatic.net/1000333506/product/39333_2106211414070_9d896d0faf8c4ebf889ca39231a82f95_grande.png', 350, 0, 400000, '8GB GDDR6 VRAM', 24, 'GPU'),
('SP021', 'Logitech G Pro X', 'https://product.hstatic.net/200000722513/product/thumbphim_9fb12e4f19d94b31aeb8cc81546d86df_b2aa143d682b4850a8f2abe30706a659_grande.png', 150, 0, 180000, 'Mechanical gaming keyboard with swappable switches', 24, 'Keyboard'),
('SP022', 'Razer BlackWidow Elite', 'https://product.hstatic.net/200000722513/product/phim_6c19f3491c624a93acecf707c68a9cd8_137391e150d54883a044e69479533a20_039fa00aaffc4cf69d81fc1c7d102537_grande.png', 120, 0, 150000, 'Mechanical gaming keyboard with RGB backlighting', 24, 'Keyboard'),
('SP023', 'Corsair K95 RGB Platinum XT', 'https://product.hstatic.net/1000333506/product/phim-co-corsair-k95-rgb-platinum-xt-1_5e273c8818544518b41639b720019258_3444f23c472e4eff9228a267e960b622_grande.jpg', 200, 0, 230000, 'Mechanical gaming keyboard with per-key RGB lighting', 24, 'Keyboard'),
('SP024', 'SteelSeries Apex Pro', 'https://i.ebayimg.com/images/g/-CEAAOSw9CZjK21R/s-l1600.jpg', 180, 0, 210000, 'Mechanical gaming keyboard with adjustable mechanical switches', 24, 'Keyboard'),
('SP025', 'HyperX Alloy Elite 2', 'https://owlgaming.vn/wp-content/uploads/2024/04/ban-phim-co-akko-mod007v3-he-year-of-dragon.jpg', 100, 0, 130000, 'Mechanical gaming keyboard with multimedia controls', 24, 'Keyboard'),
('SP026', 'Cooler Master MK850', 'https://product.hstatic.net/200000420363/product/kb_cm_sk630_b999e480e9034a4fb0072fe506e32438_master.jpg', 160, 0, 1900000, 'Mechanical gaming keyboard with analog Aimpad technology', 24, 'Keyboard'),
('SP027', 'Ducky One 2 Mini', 'https://owlgaming.vn/wp-content/uploads/2022/06/ban-phim-co-akko-3068-v2-rgb-black.jpg', 90, 0, 1200000, '60% mechanical gaming keyboard with PBT keycaps', 24, 'Keyboard'),
('SP028', 'Asus ROG Strix Scope', 'https://anphat.com.vn/media/product/46155_dareu_ek75_pro_black_golden__1_.jpg', 110, 0, 1400000, 'Mechanical gaming keyboard with quick-toggle switches', 24, 'Keyboard'),
('SP029', 'Glorious Modular Mechanical Keyboard', 'https://product.hstatic.net/1000129940/product/ban-phim-akko-acr75-pro-gasket-mount-hotswap-rgb-akko-switch_ca3f927fc7894545bbd8f9a72053a96c.jpg', 80, 0, 1100000, 'Mechanical gaming keyboard with hot-swappable switches', 24, 'Keyboard'),
('SP030', 'Roccat Vulcan 121 AIMO', 'https://product.hstatic.net/200000420363/product/ban-phim-co-machenike-k600t-b82-3_a8ac475811304ad5bd5119fd9c9a64dd_master.png', 140, 0, 1700000, 'Mechanical gaming keyboard with Titan switches and AIMO RGB lighting', 24, 'Keyboard'),
('SP031', 'LG 27UK650-W 27\" 4K UHD Monitor', 'https://product.hstatic.net/200000420363/product/man-hinh-lcd-27_-lg-27up600-w-4k-ips-60hz-5ms-chinh-hang-1__1__515d34920514483fa465b77a6f5739b7_master.jpg', 350, 0, 4000000, '27\" 4K UHD IPS display with HDR10 support', 24, 'Monitor'),
('SP032', 'ASUS VG248QE 24\" Full HD Monitor', 'https://product.hstatic.net/200000420363/product/asus-tuf-gaming-vg249q1a_6d47862ecbf54f8aa6782e7cbb9dff44_master.png', 200, 0, 2500000, '24\" Full HD TN display with 144Hz refresh rate', 24, 'Monitor'),
('SP033', 'Acer Predator X27 27\" 4K UHD Monitor', 'https://i.ebayimg.com/images/g/zQYAAOSwHz1lw9MG/s-l1600.jpg', 1000, 0, 1100000, '27\" 4K UHD IPS display with G-SYNC Ultimate and HDR1000 support', 24, 'Monitor'),
('SP034', 'Samsung Odyssey G7 32\" QHD Curved Monitor', 'https://product.hstatic.net/200000837185/product/man_hinh_samsung_odyssey_g5_lc34g55twwexxv_1601be7637904c9ebd42c90e16f9b90a_master.png', 700, 0, 7500000, '32\" QHD VA panel with 240Hz refresh rate and 1000R curvature', 24, 'Monitor'),
('SP035', 'Dell S3220DGF 32\" QHD Curved Monitor', 'https://i.ebayimg.com/images/g/b28AAOSw7kBmGZMk/s-l1600.jpg', 450, 0, 5000000, '32\" QHD VA panel with 165Hz refresh rate and AMD FreeSync support', 24, 'Monitor'),
('SP036', 'ViewSonic VX3276-2K-MHD 32\" QHD Monitor', 'https://pos.nvncdn.com/91002e-15402/ps/20230630_YRGIietqTJ.jpeg', 300, 0, 3500000, '32\" QHD IPS display with slim bezels and built-in speakers', 24, 'Monitor'),
('SP037', 'BenQ EW3270U 32\" 4K UHD Monitor', 'https://product.hstatic.net/200000722513/product/earvn-man-hinh-viewsonic-vx3219-2k-pro-2-32-ips-2k-165hz-chuyen-game-1_6bafdddaec3e4c598924096be558fbd7.png', 550, 0, 6000000, '32\" 4K UHD VA panel with HDR support and USB-C connectivity', 24, 'Monitor'),
('SP038', 'Alienware AW2521HFL 25\" Full HD Monitor', 'https://nguyencongpc.vn/media/product/250-23153-aw2521hf.jpg', 300, 0, 350, '25\" Full HD IPS display with 240Hz refresh rate and AMD FreeSync Premium support', 24, 'Monitor'),
('SP039', 'LG 34GN850-B 34\" UltraWide QHD Curved Monitor', 'https://product.hstatic.net/1000129940/product/38gn950_ad58cb7345a047b48de38b486fd948d2_master.jpg', 800, 0, 850000, '34\" UltraWide QHD IPS display with 144Hz refresh rate and G-SYNC compatibility', 24, 'Monitor'),
('SP040', 'ASUS ROG Swift PG279Q 27\" QHD Monitor', 'https://product.hstatic.net/200000837185/product/rog-swift-oled-pg27aqdm-1_compressed_9d4795b9f6af41ce868c39faf62a7406_grande.jpg', 600, 0, 650000, '27\" QHD IPS panel with G-SYNC technology and 165Hz refresh rate', 24, 'Monitor');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TaiKhoan` varchar(100) NOT NULL,
  `MatKhau` varchar(25) NOT NULL,
  `MaNV` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`TaiKhoan`, `MatKhau`, `MaNV`) VALUES
('admin', 'admin@123', 'NV001'),
('staff', 'staff@123', 'NV002');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoankh`
--

CREATE TABLE `taikhoankh` (
  `TaiKhoan` varchar(100) NOT NULL,
  `MatKhau` varchar(500) NOT NULL,
  `MaKH` varchar(10) NOT NULL,
  `google_id` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoankh`
--

INSERT INTO `taikhoankh` (`TaiKhoan`, `MatKhau`, `MaKH`, `google_id`, `created_at`, `updated_at`) VALUES
('22631205@kthcm.edu.vn', 'eyJpdiI6IjR0Slp3VHlGZHJTZFhzVC96WkIvQ1E9PSIsInZhbHVlIjoiSytDQzhvSGwvME9xR1oxdEJLeUsvK0VJOWc1bXRMaStKRTRzOTh0WXhDVT0iLCJtYWMiOiJiOWZmMDlmYjRiZjBmNDEwZDA3OGRiNDQ3MWE3NzU1ZjU3YTM1ZTBiYWRjNGM3MTQyZjc3YmUwMjY0MzU1YmNkIiwidGFnIjoiIn0=', 'KHwwQEJfHU', NULL, '2024-06-02 09:03:23', '2024-06-02 09:03:23'),
('customer1', 'customer1@123', 'KH001', NULL, '2024-05-08 04:00:52', NULL),
('customer2', 'customer2@123', 'KH002', NULL, '2024-05-08 04:00:52', NULL),
('thanh@gmail.com', '$2y$10$6qXEDWBk8X2ZZTX0ogqeeO/MJNnBe4My/FyKtUtLMdYI.GEqK/62.', 'KHyoFoV3tP', NULL, '2024-05-08 05:26:58', '2024-05-08 05:26:58'),
('thanhtran.070103@gmail.com', 'eyJpdiI6IkQwa0U1R285Ni9KU01qSUE1bmo1Ync9PSIsInZhbHVlIjoid2RDMGZmSUd6VUpZSkw3ay9RVHBjcHJRRno1ckhpR1VTTktkTVcwZGtnVT0iLCJtYWMiOiJlOWE4NGM4MmRkMWZhOGY0M2NmOWFjMDEzMWE3ODllNjE0YTIzMmExNjExYWUwNDRkODk4NzhmNDYzM2VkOTExIiwidGFnIjoiIn0=', 'KH3zyopOAq', NULL, '2024-05-07 21:58:13', '2024-05-07 21:58:13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`MaDH`,`MaSP`),
  ADD KEY `Fr_ChiTietDatHang_SanPham` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`MaGH`,`MaSP`),
  ADD KEY `Fr_ChiTietGioHang_SanPham` (`MaSP`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`madg`),
  ADD KEY `FK_danhgia_sanpham` (`masp`),
  ADD KEY `FK_danhgia_khachhang` (`makh`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `Fr_DatHang_KhachHang` (`MaKH`),
  ADD KEY `Fr_DatHang_KhuyenMai` (`MaKM`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGH`),
  ADD UNIQUE KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKM`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `Fr_SanPham_LoaiSP` (`MaLoai`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`TaiKhoan`),
  ADD UNIQUE KEY `MaNV` (`MaNV`);

--
-- Chỉ mục cho bảng `taikhoankh`
--
ALTER TABLE `taikhoankh`
  ADD PRIMARY KEY (`TaiKhoan`),
  ADD UNIQUE KEY `MaKH` (`MaKH`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `Fr_ChiTietDatHang_DatHang` FOREIGN KEY (`MaDH`) REFERENCES `dathang` (`MaDH`),
  ADD CONSTRAINT `Fr_ChiTietDatHang_SanPham` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `Fr_ChiTietGioHang_GioHang` FOREIGN KEY (`MaGH`) REFERENCES `giohang` (`MaGH`),
  ADD CONSTRAINT `Fr_ChiTietGioHang_SanPham` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `FK_danhgia_khachhang` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`MaKH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_danhgia_sanpham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `Fr_DatHang_KhachHang` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `Fr_DatHang_KhuyenMai` FOREIGN KEY (`MaKM`) REFERENCES `khuyenmai` (`MaKM`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `Fr_GioHang_KhachHang` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `Fr_SanPham_LoaiSP` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoai`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `Fr_TaiKhoan_NhanVien` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `taikhoankh`
--
ALTER TABLE `taikhoankh`
  ADD CONSTRAINT `Fr_TaiKhoanKH_KhachHang` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
