CREATE DATABASE laundry;
USE laundry;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

CREATE TABLE `Order` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jenis_laundry` VARCHAR(8) DEFAULT NULL,
  `massa_barang` INT(3) DEFAULT NULL,
  `jumlah_barang` INT(3) DEFAULT NULL,
  `waktu_pengambilan` DATE DEFAULT NULL,
  `waktu_pengantaran` DATE DEFAULT NULL,
  `alamat` VARCHAR (80) DEFAULT NULL,
  `catatan` VARCHAR (255) DEFAULT NULL,
  `garis_lintang` FLOAT(10, 6) DEFAULT NULL,
  `garis_bujur` FLOAT(10, 6) DEFAULT NULL,
  `harga_total` INT(10) DEFAULT NULL,
  `status_pemesanan` VARCHAR(50) DEFAULT NULL,
  `id_user` INT(11) DEFAULT NULL,
  `list_satuan` VARCHAR (255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(30) DEFAULT NULL,
  `harga` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Tambah row untuk admin
INSERT INTO users (name, email, password, nomor_telepon) VALUES ("Administrator", "admin@laundryonlinemks.com", "$2y$10$3ZovOOjFDvk4eain7/XFFuAfVLt9.zOyFM/FK8NC/2KHmA0Zk5O6W", "081242133333");

-- Tambah row untuk harga
INSERT INTO `harga` (id, nama_barang, harga) VALUES(1, "Kaos/T-Shirt", "Rp.10000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(2, "Kemeja", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(3, "Kemeja Batik", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(4, "Baju Muslim", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(5, "Kebaya", "Rp.40000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(6, "Gaun Panjang", "Rp.25000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(7, "Rok", "Rp.15000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(8, "Baju Hangat/Sweater", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(9, "Jaket", "Rp.30000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(10, "Jas/Blazer", "Rp.45000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(11, "Celana Pendek", "Rp.10000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(12, "Celana Panjang", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(13, "Sarung", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(14, "Tas Sekolah/Ransel", "Rp.30000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(15, "Selendang/Kerudung", "Rp.10000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(16, "Blouse", "Rp.15000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(17, "Mukena", "Rp.25000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(18, "Sajadah", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(19, "Topi", "Rp.10000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(20, "Handuk Mandi", "Rp.25000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(21, "Bantal", "Rp.20000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(22, "Sarung Bantal/Guling", "Rp.5000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(23, "Sprei Single", "Rp.15000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(24, "Selimut", "Rp.25000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(25, "Bed Cover", "Rp.60000");
INSERT INTO `harga` (id, nama_barang, harga) VALUES(26, "Keset", "Rp.20000");

