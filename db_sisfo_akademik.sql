/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_sisfo_akademik

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-08-04 04:10:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_hasil_psikotes_bid_jurusan
-- ----------------------------
DROP TABLE IF EXISTS `t_hasil_psikotes_bid_jurusan`;
CREATE TABLE `t_hasil_psikotes_bid_jurusan` (
  `nis` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `ipa` varchar(13) COLLATE latin1_general_ci NOT NULL,
  `ips` varchar(13) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of t_hasil_psikotes_bid_jurusan
-- ----------------------------
INSERT INTO `t_hasil_psikotes_bid_jurusan` VALUES ('1001', 'Rendah', 'Tinggi');
INSERT INTO `t_hasil_psikotes_bid_jurusan` VALUES ('1002', 'Tinggi', 'Sedang');
INSERT INTO `t_hasil_psikotes_bid_jurusan` VALUES ('1003', 'Sedang', 'Tinggi');
INSERT INTO `t_hasil_psikotes_bid_jurusan` VALUES ('1004', 'Tinggi', 'Sedang');
INSERT INTO `t_hasil_psikotes_bid_jurusan` VALUES ('1005', 'Sedang', 'Tinggi');
INSERT INTO `t_hasil_psikotes_bid_jurusan` VALUES ('1006', 'Sangat Tinggi', 'Tinggi');

-- ----------------------------
-- Table structure for t_minat
-- ----------------------------
DROP TABLE IF EXISTS `t_minat`;
CREATE TABLE `t_minat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `ipa` tinyint(2) NOT NULL,
  `ips` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of t_minat
-- ----------------------------
INSERT INTO `t_minat` VALUES ('1', '1001', '60', '40');
INSERT INTO `t_minat` VALUES ('2', '1002', '45', '55');

-- ----------------------------
-- Table structure for t_nilai_rata2
-- ----------------------------
DROP TABLE IF EXISTS `t_nilai_rata2`;
CREATE TABLE `t_nilai_rata2` (
  `nis` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `ipa` float NOT NULL,
  `ips` float NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of t_nilai_rata2
-- ----------------------------
INSERT INTO `t_nilai_rata2` VALUES ('1001', '70', '95');
INSERT INTO `t_nilai_rata2` VALUES ('1002', '85', '70');
INSERT INTO `t_nilai_rata2` VALUES ('1003', '64', '70');
INSERT INTO `t_nilai_rata2` VALUES ('1004', '80', '60');
INSERT INTO `t_nilai_rata2` VALUES ('1005', '68', '79');
INSERT INTO `t_nilai_rata2` VALUES ('1006', '70', '72.5');

-- ----------------------------
-- Table structure for t_siswa
-- ----------------------------
DROP TABLE IF EXISTS `t_siswa`;
CREATE TABLE `t_siswa` (
  `nis` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(6) COLLATE latin1_general_ci NOT NULL,
  `rekomendasi` varchar(3) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of t_siswa
-- ----------------------------
INSERT INTO `t_siswa` VALUES ('1001', 'Taylor Laurent', '123456', 'IPS');
INSERT INTO `t_siswa` VALUES ('1002', 'Aming', '123456', 'IPA');
INSERT INTO `t_siswa` VALUES ('1003', 'Rocky Triputra', '123456', '');
INSERT INTO `t_siswa` VALUES ('1004', 'Luna Maya', '123456', '');
INSERT INTO `t_siswa` VALUES ('1005', 'Jeje Laurent', '123456', '');
INSERT INTO `t_siswa` VALUES ('1006', 'Sarif', '123456', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'bdec8acd3516883190a9a58cd3629314322097f4', '2016-08-04 01:43:07', null);
