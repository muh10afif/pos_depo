/*
 Navicat Premium Data Transfer

 Source Server         : mysql_skd
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_depo

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 22/10/2020 09:06:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mst_bahan
-- ----------------------------
DROP TABLE IF EXISTS `mst_bahan`;
CREATE TABLE `mst_bahan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `created_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_bahan
-- ----------------------------
INSERT INTO `mst_bahan` VALUES (1, 'Kayu', 1, '2020-10-07');
INSERT INTO `mst_bahan` VALUES (2, 'Besi', 6, '2020-10-07');
INSERT INTO `mst_bahan` VALUES (4, 'Kayu', 2, '2020-10-07');
INSERT INTO `mst_bahan` VALUES (5, 'kayu jati', 1, '2020-10-07');

-- ----------------------------
-- Table structure for mst_jenis
-- ----------------------------
DROP TABLE IF EXISTS `mst_jenis`;
CREATE TABLE `mst_jenis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diskon` bigint(20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_jenis
-- ----------------------------
INSERT INTO `mst_jenis` VALUES (2, 'Agen Kecil', 10000, '2020-10-16 00:00:00');
INSERT INTO `mst_jenis` VALUES (3, 'Agen Besar', 20000, '2020-10-16 00:00:00');
INSERT INTO `mst_jenis` VALUES (4, 'Distributor', 50000, '2020-10-16 00:00:00');

-- ----------------------------
-- Table structure for mst_kategori
-- ----------------------------
DROP TABLE IF EXISTS `mst_kategori`;
CREATE TABLE `mst_kategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `have_bahan` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_kategori
-- ----------------------------
INSERT INTO `mst_kategori` VALUES (1, 'Meja', 1, '2020-10-07');
INSERT INTO `mst_kategori` VALUES (2, 'Kursi', 1, '2020-10-07');
INSERT INTO `mst_kategori` VALUES (3, 'Lemari', 0, '2020-10-07');
INSERT INTO `mst_kategori` VALUES (5, 'Rak', 1, '2020-10-07');
INSERT INTO `mst_kategori` VALUES (6, 'Meja Tamu', 1, '2020-10-07');

-- ----------------------------
-- Table structure for mst_merk
-- ----------------------------
DROP TABLE IF EXISTS `mst_merk`;
CREATE TABLE `mst_merk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_merk
-- ----------------------------
INSERT INTO `mst_merk` VALUES (1, 'Livien', '2020-10-07');
INSERT INTO `mst_merk` VALUES (2, 'IKEA', '2020-10-07');
INSERT INTO `mst_merk` VALUES (3, 'iFurnholic', '2020-10-07');
INSERT INTO `mst_merk` VALUES (4, 'Red Sun', '2020-10-07');
INSERT INTO `mst_merk` VALUES (5, 'JYSK', '2020-10-07');
INSERT INTO `mst_merk` VALUES (6, 'Olympic', '2020-10-07');
INSERT INTO `mst_merk` VALUES (7, 'Informa', '2020-10-07');
INSERT INTO `mst_merk` VALUES (8, 'Dove’s', '2020-10-07');
INSERT INTO `mst_merk` VALUES (9, 'Funika', '2020-10-07');
INSERT INTO `mst_merk` VALUES (10, 'Atria', '2020-10-07');
INSERT INTO `mst_merk` VALUES (12, 'Miels', '2020-10-07');

-- ----------------------------
-- Table structure for mst_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `mst_pelanggan`;
CREATE TABLE `mst_pelanggan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `jenis` int(11) NULL DEFAULT 0,
  `tot_piutang` bigint(50) NULL DEFAULT 0,
  `tot_hutang` bigint(50) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_pelanggan
-- ----------------------------
INSERT INTO `mst_pelanggan` VALUES (1, 'Bintang', '0812345898700', 'Buahbatu', '2020-10-07 00:00:00', 3, 2980000, 3000000);
INSERT INTO `mst_pelanggan` VALUES (3, 'Bambang', '08345980009', 'Bandung', '2020-10-07 11:05:32', 4, 0, 0);
INSERT INTO `mst_pelanggan` VALUES (9, 'Riki', '0812897999028', 'Gatot Subroto', '2020-10-16 15:38:48', 2, 1000000, 0);
INSERT INTO `mst_pelanggan` VALUES (10, 'Toko Hati', '0812900998', 'Bandung', '2020-10-20 10:04:17', 4, 0, 5500000);
INSERT INTO `mst_pelanggan` VALUES (12, 'Umum', '0', '-', '2020-10-22 08:26:56', 2, 0, 0);

-- ----------------------------
-- Table structure for mst_product
-- ----------------------------
DROP TABLE IF EXISTS `mst_product`;
CREATE TABLE `mst_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `nama_product` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` bigint(20) NOT NULL,
  `hpp` bigint(20) NOT NULL,
  `harga_reseller` bigint(20) NOT NULL,
  `created_at` date NOT NULL,
  `foto_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `ukuran_panjang` float(50, 0) NULL DEFAULT NULL,
  `ukuran_lebar` float(50, 0) NULL DEFAULT NULL,
  `tipe_ukuran` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_product
-- ----------------------------
INSERT INTO `mst_product` VALUES (1, 2, 4, 7, 'Margot Kursi Makan Panjang', 3000000, 200000, 3200000, '2020-10-07', 'Kursi-Produk-Margot_Kursi_Makan_Panjang-20201007051938.jpg', 160, 60, 'cm');
INSERT INTO `mst_product` VALUES (2, 1, 5, 12, 'Meja Tamu', 1500000, 220000, 1550000, '2020-10-07', 'Meja-Produk-Meja_Tamu-20201007052433.jpg', 150, 50, 'cm');
INSERT INTO `mst_product` VALUES (3, 3, 0, 7, 'Lemari Pakaian', 2500000, 300000, 2650000, '2020-10-07', 'Lemari-Produk-Lemari_Pakaian-20201007105425.jpg', 250, 70, 'cm');

-- ----------------------------
-- Table structure for mst_stok
-- ----------------------------
DROP TABLE IF EXISTS `mst_stok`;
CREATE TABLE `mst_stok`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_stok
-- ----------------------------
INSERT INTO `mst_stok` VALUES (1, 1, 1, '2020-10-07 10:19:38');
INSERT INTO `mst_stok` VALUES (2, 2, 2, '2020-10-07 10:24:33');
INSERT INTO `mst_stok` VALUES (3, 3, 0, '2020-10-07 03:54:25');

-- ----------------------------
-- Table structure for mst_user
-- ----------------------------
DROP TABLE IF EXISTS `mst_user`;
CREATE TABLE `mst_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  `id_role` int(11) NULL DEFAULT NULL,
  `id_owner` int(11) NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `api_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` date NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_user
-- ----------------------------
INSERT INTO `mst_user` VALUES (1, 'admin', '$2y$10$4ZzjoW0AlNAEXMdS1uFutOZxfiRLItcwuKw0Eo0plsxJ7P42t/DXm', 1, 2, 0, NULL, NULL, '2020-07-03');
INSERT INTO `mst_user` VALUES (32, 'bulan', '$2y$10$3U1o4Ue8JFmMuIhY0v5TrOelrlcdDUJ/2KsCjzwPB7ILIrFcjnDy.', 1, 1, 1, NULL, NULL, '2020-10-07');
INSERT INTO `mst_user` VALUES (34, 'afif', '$2y$10$cXcdk2xStCq3HG2yNQI/He88gVr0JKhtf5nLiYJYUTyNKkDeWCPWC', 1, 1, 1, NULL, NULL, '2020-10-07');

-- ----------------------------
-- Table structure for trn_bayar_hutang
-- ----------------------------
DROP TABLE IF EXISTS `trn_bayar_hutang`;
CREATE TABLE `trn_bayar_hutang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `bayar` bigint(50) NULL DEFAULT NULL,
  `sisa_hutang` bigint(50) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_bayar_hutang
-- ----------------------------
INSERT INTO `trn_bayar_hutang` VALUES (1, 1, '2020-10-20', 1000000, 8000000, '2020-10-20 11:37:59');
INSERT INTO `trn_bayar_hutang` VALUES (2, 1, '2020-10-20', 8000000, 0, '2020-10-20 13:16:59');
INSERT INTO `trn_bayar_hutang` VALUES (3, 10, '2020-10-20', 500000, 8000000, '2020-10-20 13:35:54');
INSERT INTO `trn_bayar_hutang` VALUES (4, 10, '2020-10-20', 1000000, 7000000, '2020-10-20 13:39:42');
INSERT INTO `trn_bayar_hutang` VALUES (5, 10, '2020-10-20', 7000000, 0, '2020-10-20 13:40:14');
INSERT INTO `trn_bayar_hutang` VALUES (7, 1, '2020-10-20', 0, 3000000, '2020-10-20 13:44:08');
INSERT INTO `trn_bayar_hutang` VALUES (8, 10, '2020-10-20', 0, 1500000, '2020-10-20 13:54:39');
INSERT INTO `trn_bayar_hutang` VALUES (9, 10, '2020-10-20', 1500000, 0, '2020-10-20 13:55:06');
INSERT INTO `trn_bayar_hutang` VALUES (10, 10, '2020-10-20', 0, 2500000, '2020-10-20 13:56:44');

-- ----------------------------
-- Table structure for trn_bayar_piutang
-- ----------------------------
DROP TABLE IF EXISTS `trn_bayar_piutang`;
CREATE TABLE `trn_bayar_piutang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `bayar` bigint(50) NULL DEFAULT NULL,
  `sisa_piutang` bigint(50) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_bayar_piutang
-- ----------------------------
INSERT INTO `trn_bayar_piutang` VALUES (1, 9, '2020-10-20', 490000, 2000000, '2020-10-20 14:22:51');
INSERT INTO `trn_bayar_piutang` VALUES (2, 9, '2020-10-20', 500000, 1500000, '2020-10-20 14:24:07');
INSERT INTO `trn_bayar_piutang` VALUES (3, 1, '2020-10-20', 2000000, 0, '2020-10-20 14:25:48');
INSERT INTO `trn_bayar_piutang` VALUES (4, 1, '2020-10-20', 0, 2980000, '2020-10-20 14:27:29');
INSERT INTO `trn_bayar_piutang` VALUES (5, 9, '2020-10-20', 1500000, 0, '2020-10-20 14:30:34');
INSERT INTO `trn_bayar_piutang` VALUES (6, 9, '2020-10-20', 0, 1000000, '2020-10-20 14:30:56');

-- ----------------------------
-- Table structure for trn_detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `trn_detail_transaksi`;
CREATE TABLE `trn_detail_transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `discount` bigint(20) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_detail_transaksi
-- ----------------------------
INSERT INTO `trn_detail_transaksi` VALUES (1, 1, 1, 1, 0, 3000000, '2020-10-07 10:21:06');
INSERT INTO `trn_detail_transaksi` VALUES (2, 2, 2, 1, 0, 1500000, '2020-10-07 11:05:32');
INSERT INTO `trn_detail_transaksi` VALUES (3, 3, 1, 1, 0, 3000000, '2020-10-07 11:29:13');
INSERT INTO `trn_detail_transaksi` VALUES (4, 4, 1, 1, 0, 3000000, '2020-10-07 13:30:28');
INSERT INTO `trn_detail_transaksi` VALUES (5, 5, 1, 2, 0, 6000000, '2020-10-07 13:57:28');
INSERT INTO `trn_detail_transaksi` VALUES (6, 5, 2, 2, 0, 3000000, '2020-10-07 13:57:28');
INSERT INTO `trn_detail_transaksi` VALUES (7, 6, 2, 1, 0, 1500000, '2020-10-07 15:51:39');
INSERT INTO `trn_detail_transaksi` VALUES (8, 7, 2, 1, 0, 1500000, '2020-10-14 16:46:30');
INSERT INTO `trn_detail_transaksi` VALUES (9, 9, 1, 1, 0, 2990000, '2020-10-19 13:38:17');
INSERT INTO `trn_detail_transaksi` VALUES (10, 10, 3, 1, 0, 2490000, '2020-10-19 13:41:25');
INSERT INTO `trn_detail_transaksi` VALUES (11, 11, 3, 1, 0, 2480000, '2020-10-20 14:25:02');
INSERT INTO `trn_detail_transaksi` VALUES (12, 12, 1, 1, 0, 2980000, '2020-10-20 14:26:17');
INSERT INTO `trn_detail_transaksi` VALUES (13, 13, 2, 1, 0, 1490000, '2020-10-20 14:30:56');
INSERT INTO `trn_detail_transaksi` VALUES (14, 14, 2, 3, 0, 4440000, '2020-10-20 16:29:29');
INSERT INTO `trn_detail_transaksi` VALUES (15, 15, 3, 1, 0, 2450000, '2020-10-21 10:45:51');
INSERT INTO `trn_detail_transaksi` VALUES (16, 16, 3, 1, 480000, 2000000, '2020-10-21 10:50:33');
INSERT INTO `trn_detail_transaksi` VALUES (17, 16, 1, 1, 0, 2980000, '2020-10-21 10:50:34');
INSERT INTO `trn_detail_transaksi` VALUES (18, 17, 3, 2, 0, 4960000, '2020-10-21 10:53:39');
INSERT INTO `trn_detail_transaksi` VALUES (19, 18, 1, 1, 500000, 2490000, '2020-10-21 11:04:38');

-- ----------------------------
-- Table structure for trn_hutang
-- ----------------------------
DROP TABLE IF EXISTS `trn_hutang`;
CREATE TABLE `trn_hutang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NULL DEFAULT NULL,
  `id_trn_stok` int(11) NULL DEFAULT NULL,
  `hutang` bigint(100) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_hutang
-- ----------------------------
INSERT INTO `trn_hutang` VALUES (1, 10, 18, 3000000, 0, '2020-10-20 10:04:30');
INSERT INTO `trn_hutang` VALUES (2, 1, 19, 9000000, 0, '2020-10-20 10:07:18');
INSERT INTO `trn_hutang` VALUES (3, 10, 21, 3000000, 0, '2020-10-20 10:39:17');
INSERT INTO `trn_hutang` VALUES (4, 10, 22, 2500000, 0, '2020-10-20 10:41:00');
INSERT INTO `trn_hutang` VALUES (5, 1, 23, 3000000, 0, '2020-10-20 13:40:48');
INSERT INTO `trn_hutang` VALUES (6, 10, 24, 1500000, 0, '2020-10-20 13:52:28');
INSERT INTO `trn_hutang` VALUES (7, 10, 25, 2500000, 0, '2020-10-20 13:56:43');
INSERT INTO `trn_hutang` VALUES (8, 10, 35, 3000000, 0, '2020-10-21 16:36:50');

-- ----------------------------
-- Table structure for trn_piutang
-- ----------------------------
DROP TABLE IF EXISTS `trn_piutang`;
CREATE TABLE `trn_piutang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NULL DEFAULT NULL,
  `id_transaksi` int(11) NULL DEFAULT NULL,
  `bayar` bigint(50) NULL DEFAULT NULL,
  `piutang` bigint(50) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_piutang
-- ----------------------------
INSERT INTO `trn_piutang` VALUES (1, 9, 10, 0, 2490000, '2020-10-19 13:41:25');
INSERT INTO `trn_piutang` VALUES (2, 1, 11, 480000, 2000000, '2020-10-20 14:25:02');
INSERT INTO `trn_piutang` VALUES (3, 1, 12, 0, 2980000, '2020-10-20 14:26:17');
INSERT INTO `trn_piutang` VALUES (4, 9, 13, 490000, 1000000, '2020-10-20 14:30:56');

-- ----------------------------
-- Table structure for trn_stok
-- ----------------------------
DROP TABLE IF EXISTS `trn_stok`;
CREATE TABLE `trn_stok`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stok` int(11) NOT NULL,
  `barang_masuk` int(11) NOT NULL,
  `barang_keluar` int(11) NOT NULL,
  `barang_retur` int(11) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_stok
-- ----------------------------
INSERT INTO `trn_stok` VALUES (1, 1, 2, 0, 0, '2020-10-07 10:19:38.000000');
INSERT INTO `trn_stok` VALUES (2, 1, 0, 1, 0, '2020-10-07 10:21:06.000000');
INSERT INTO `trn_stok` VALUES (3, 2, 1, 0, 0, '2020-10-07 10:24:33.000000');
INSERT INTO `trn_stok` VALUES (4, 2, 0, 1, 0, '2020-10-07 11:05:32.000000');
INSERT INTO `trn_stok` VALUES (5, 2, 1, 0, 0, '2020-10-07 11:27:04.000000');
INSERT INTO `trn_stok` VALUES (6, 1, 0, 1, 0, '2020-10-07 11:29:13.000000');
INSERT INTO `trn_stok` VALUES (7, 1, 1, 0, 0, '2020-10-07 11:29:27.000000');
INSERT INTO `trn_stok` VALUES (8, 1, 0, 1, 0, '2020-10-07 13:30:28.000000');
INSERT INTO `trn_stok` VALUES (9, 2, 4, 0, 0, '2020-10-07 13:56:38.000000');
INSERT INTO `trn_stok` VALUES (10, 1, 4, 0, 0, '2020-10-07 13:56:51.000000');
INSERT INTO `trn_stok` VALUES (11, 1, 0, 2, 0, '2020-10-07 13:57:28.000000');
INSERT INTO `trn_stok` VALUES (12, 2, 0, 2, 0, '2020-10-07 13:57:28.000000');
INSERT INTO `trn_stok` VALUES (13, 2, 0, 1, 0, '2020-10-07 15:51:39.000000');
INSERT INTO `trn_stok` VALUES (14, 3, 4, 0, 0, '2020-10-07 03:54:25.000000');
INSERT INTO `trn_stok` VALUES (15, 2, 0, 1, 0, '2020-10-14 16:46:30.000000');
INSERT INTO `trn_stok` VALUES (16, 1, 0, 1, 0, '2020-10-19 13:38:17.000000');
INSERT INTO `trn_stok` VALUES (17, 3, 0, 1, 0, '2020-10-19 13:41:25.000000');
INSERT INTO `trn_stok` VALUES (18, 2, 2, 0, 0, '2020-10-20 10:04:30.000000');
INSERT INTO `trn_stok` VALUES (19, 1, 3, 0, 0, '2020-10-20 10:07:18.000000');
INSERT INTO `trn_stok` VALUES (20, 1, 0, 0, 2, '2020-10-20 10:09:04.000000');
INSERT INTO `trn_stok` VALUES (21, 1, 1, 0, 0, '2020-10-20 10:39:17.000000');
INSERT INTO `trn_stok` VALUES (22, 3, 1, 0, 0, '2020-10-20 10:40:59.000000');
INSERT INTO `trn_stok` VALUES (23, 1, 1, 0, 0, '2020-10-20 13:40:48.000000');
INSERT INTO `trn_stok` VALUES (24, 2, 1, 0, 0, '2020-10-20 13:52:28.000000');
INSERT INTO `trn_stok` VALUES (25, 3, 1, 0, 0, '2020-10-20 13:56:43.000000');
INSERT INTO `trn_stok` VALUES (26, 3, 0, 1, 0, '2020-10-20 14:25:02.000000');
INSERT INTO `trn_stok` VALUES (27, 1, 0, 1, 0, '2020-10-20 14:26:17.000000');
INSERT INTO `trn_stok` VALUES (28, 2, 0, 1, 0, '2020-10-20 14:30:56.000000');
INSERT INTO `trn_stok` VALUES (29, 2, 0, 3, 0, '2020-10-20 16:29:29.000000');
INSERT INTO `trn_stok` VALUES (30, 3, 0, 1, 0, '2020-10-21 10:45:51.000000');
INSERT INTO `trn_stok` VALUES (31, 3, 0, 1, 0, '2020-10-21 10:50:33.000000');
INSERT INTO `trn_stok` VALUES (32, 1, 0, 1, 0, '2020-10-21 10:50:34.000000');
INSERT INTO `trn_stok` VALUES (33, 3, 0, 2, 0, '2020-10-21 10:53:39.000000');
INSERT INTO `trn_stok` VALUES (34, 1, 0, 1, 0, '2020-10-21 11:04:38.000000');
INSERT INTO `trn_stok` VALUES (35, 2, 2, 0, 0, '2020-10-21 16:36:50.000000');

-- ----------------------------
-- Table structure for trn_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `trn_transaksi`;
CREATE TABLE `trn_transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `total_discount` bigint(20) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `id_pelanggan` int(255) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `tunai` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trn_transaksi
-- ----------------------------
INSERT INTO `trn_transaksi` VALUES (1, 'TRN07102000001', 3000000, 0, '2020-10-07 10:21:06', 1, 1, 1, 3000000);
INSERT INTO `trn_transaksi` VALUES (2, 'TRN07102000002', 1500000, 0, '2020-10-07 11:05:32', 3, 1, 1, 1500000);
INSERT INTO `trn_transaksi` VALUES (3, 'TRN07102000003', 3000000, 0, '2020-10-07 11:29:13', 3, 1, 1, 3000000);
INSERT INTO `trn_transaksi` VALUES (4, 'TRN07102000004', 3000000, 0, '2020-10-07 13:30:28', 1, 1, 32, 3000000);
INSERT INTO `trn_transaksi` VALUES (5, 'TRN07102000005', 9000000, 0, '2020-10-07 13:57:28', 1, 1, 32, 9000000);
INSERT INTO `trn_transaksi` VALUES (6, 'TRN07102000006', 1500000, 0, '2020-10-07 15:51:39', 1, 1, 34, 1500000);
INSERT INTO `trn_transaksi` VALUES (7, 'TRN14102000001', 1500000, 0, '2020-10-14 16:46:30', 3, 1, 1, 0);
INSERT INTO `trn_transaksi` VALUES (8, 'TRN14102000002', 0, 0, '2020-10-14 16:46:49', 4, 1, 1, 0);
INSERT INTO `trn_transaksi` VALUES (9, 'TRN19102000001', 2990000, 0, '2020-10-19 13:38:17', 9, 1, 1, 3000000);
INSERT INTO `trn_transaksi` VALUES (10, 'TRN19102000002', 2490000, 0, '2020-10-19 13:41:25', 9, 1, 1, 0);
INSERT INTO `trn_transaksi` VALUES (11, 'TRN20102000001', 2480000, 0, '2020-10-20 14:25:02', 1, 1, 1, 480000);
INSERT INTO `trn_transaksi` VALUES (12, 'TRN20102000002', 2980000, 0, '2020-10-20 14:26:17', 1, 1, 1, 0);
INSERT INTO `trn_transaksi` VALUES (13, 'TRN20102000003', 1490000, 0, '2020-10-20 14:30:55', 9, 1, 1, 490000);
INSERT INTO `trn_transaksi` VALUES (14, 'TRN20102000004', 4440000, 0, '2020-10-20 16:29:29', 1, 1, 1, 5000000);
INSERT INTO `trn_transaksi` VALUES (15, 'TRN21102000001', 2450000, 0, '2020-10-21 10:45:51', 3, 1, 1, 2450000);
INSERT INTO `trn_transaksi` VALUES (16, 'TRN21102000002', 4980000, 0, '2020-10-21 10:50:33', 1, 1, 1, 5000000);
INSERT INTO `trn_transaksi` VALUES (17, 'TRN21102000003', 4960000, 0, '2020-10-21 10:53:39', 1, 1, 1, 5000000);
INSERT INTO `trn_transaksi` VALUES (18, 'TRN21102000004', 2490000, 500000, '2020-10-21 11:04:38', 9, 1, 1, 3000000);

SET FOREIGN_KEY_CHECKS = 1;
