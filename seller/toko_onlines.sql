/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - toko_onlines
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`toko_onlines` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `toko_onlines`;

/*Table structure for table `image` */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `kode_image` char(10) NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `kode_produk` char(20) DEFAULT NULL,
  KEY `kode_produk` (`kode_produk`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `image` */

insert  into `image`(`kode_image`,`image`,`kode_produk`) values 
('GD2d47_Gw5','6585789863429_maxresdefault.jpg','D37tcIdJkqCkenEOzt9Z'),
('V6Q93T9Cdm','6585789863c9c_6691be38-c347-45b7-afe6-5eccec362fda.jpg','D37tcIdJkqCkenEOzt9Z'),
('VRdE7ehMAH','658578986a50e_Review-ASUS-ROG-Zephyrus-G14-2022_main.jpg','D37tcIdJkqCkenEOzt9Z'),
('N5upZu1T0B','658578986aac3_1-89.jpg','D37tcIdJkqCkenEOzt9Z'),
('DHwBMrcvNx','658578986b552_zephyrus-1-1858874084.webp','D37tcIdJkqCkenEOzt9Z');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `kode_produk` char(20) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `spesifikasi` text NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(20,0) NOT NULL,
  `created_at` datetime(4) NOT NULL DEFAULT current_timestamp(4),
  `update_at` datetime(4) NOT NULL DEFAULT current_timestamp(4),
  `id_warna` char(5) NOT NULL,
  `id_ukuran` char(5) NOT NULL,
  `id_seller` char(10) NOT NULL,
  `produk_status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`kode_produk`),
  KEY `id_warna` (`id_warna`),
  KEY `id_ukuran` (`id_ukuran`),
  KEY `id_seller` (`id_seller`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_warna`) REFERENCES `warna` (`id_warna`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_ukuran`) REFERENCES `ukuran` (`id_ukuran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`kode_produk`,`nama_produk`,`deskripsi`,`spesifikasi`,`stok`,`harga`,`created_at`,`update_at`,`id_warna`,`id_ukuran`,`id_seller`,`produk_status`) values 
('AAsCxE2OA5MZvXB0Cgsn','hahahaah','<div class=\"flex flex-grow flex-col max-w-full\">\r\n<div class=\"min-h-[20px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5 overflow-x-auto\" data-message-author-role=\"assistant\" data-message-id=\"312edc36-2541-4d23-bc45-1e6d7bd3f29d\">\r\n<div class=\"markdown prose w-full break-words dark:prose-invert dark\">\r\n<p>Pertanyaan Anda tampaknya kurang jelas, tetapi jika Anda mengacu pada nomor gambar dan langkah-langkah di Microsoft Word, berikut adalah beberapa informasi yang mungkin berguna:</p>\r\n<p>Jika Anda telah memasukkan 3 gambar sebelumnya dan sekarang memasukkan gambar ke-4, maka nomor gambar yang otomatis akan menjadi 4.0. Anda dapat menentukan nomor gambar dengan memilih gambar tersebut, kemudian pergi ke tab \"Referensi\" dan klik pada grup \"Penomoran\". Di sana, Anda dapat mengatur format nomor gambar.</p>\r\n<p>Sebagai contoh, jika Anda ingin mengatur nomor gambar menjadi \"Gambar 4.0\" untuk gambar ke-4, Anda dapat mengikuti langkah-langkah berikut:</p>\r\n<ol>\r\n<li>Pilih gambar ke-4.</li>\r\n<li>Pergi ke tab \"Referensi\" di menu Word.</li>\r\n<li>Klik pada grup \"Penomoran\".</li>\r\n<li>Pilih opsi \"Nomor gambar\".</li>\r\n<li>Pilih format yang diinginkan, misalnya, \"Gambar 4.0\".</li>\r\n</ol>\r\n<p>Jika pertanyaan Anda berbeda atau Anda memerlukan bantuan lebih lanjut, harap berikan detail tambahan sehingga saya dapat memberikan jawaban yang lebih akurat.</p>\r\n</div>\r\n</div>\r\n</div>','<ul>\r\n<li>ilih gambar ke-4.</li>\r\n<li>Pergi ke tab \"Referensi\" di menu Word.</li>\r\n<li>Klik pada grup \"Penomoran\".</li>\r\n<li>Pilih opsi \"Nomor gambar\".</li>\r\n<li>Pilih format yang diinginkan, misalnya, \"Gambar 4.0\".</li>\r\n</ul>',100,10000000,'2023-12-22 18:36:30.9832','2023-12-22 18:36:30.9832','VnT5P','NYBF8','vpq1caBDHj',0),
('cxAfw50P34AhURJS6qy-','test 2','<p>asdahsjvaas 2</p>','<p>&nbsp;bvhjei2jkkkkkk 1</p>',100,1000000,'2023-12-23 09:17:17.5927','2023-12-23 09:17:17.5927','zWvkq','CWAfN','vpq1caBDHj',1),
('D37tcIdJkqCkenEOzt9Z','Rog Zephyrus G16 RTX-6000 Intel Core i9','<div class=\"markdown markdown-main-panel\" dir=\"ltr\" style=\"--animation-duration: 600ms;\">\r\n<h2 data-sourcepos=\"1:1-1:71\"><strong>ASUS ROG Zephyrus G16 RTX 3060 Intel Core i9 - Deskripsi Lengkap</strong></h2>\r\n<p data-sourcepos=\"3:1-3:28\"><strong>Desain dan Portabilitas:</strong></p>\r\n<p data-sourcepos=\"5:1-5:314\">ASUS ROG Zephyrus G16 menghadirkan desain ramping dan modern dengan ketebalan hanya 19.9mm dan berat 1.9kg. Bodinya terbuat dari magnesium-lithium alloy yang kokoh dan ringan, menjadikannya laptop gaming yang ideal untuk dibawa bepergian. Laptop ini tersedia dalam dua pilihan warna: Off Black dan Moonlight White.</p>\r\n<p data-sourcepos=\"7:1-7:10\"><strong>Layar:</strong></p>\r\n<p data-sourcepos=\"9:1-9:330\">Zephyrus G16 dilengkapi layar 16 inci dengan rasio aspek 16:10 yang memberikan ruang layar lebih luas untuk bekerja dan bermain game. Layar ini memiliki resolusi WQXGA (2560x1600) dan refresh rate 165Hz untuk visual yang tajam dan mulus. Panel layarnya juga mendukung Dolby Vision HDR untuk pengalaman menonton yang lebih imersif.</p>\r\n<p data-sourcepos=\"11:1-11:13\"><strong>Performa:</strong></p>\r\n<p data-sourcepos=\"13:1-13:282\">Ditenagai oleh prosesor Intel Core i9-12900H dan GPU NVIDIA GeForce RTX 3060, laptop ini mampu menangani game modern dengan mudah. RAM DDR5 16GB memastikan multitasking yang lancar, dan penyimpanan SSD PCIe Gen 4 1TB menyediakan ruang penyimpanan yang cepat untuk aplikasi dan game.</p>\r\n<p data-sourcepos=\"15:1-15:17\"><strong>Fitur Gaming:</strong></p>\r\n<p data-sourcepos=\"17:1-17:427\">Zephyrus G16 dilengkapi dengan berbagai fitur gaming untuk meningkatkan pengalaman bermain game Anda. Sistem pendingin AAS Plus 2.0 yang inovatif memastikan laptop tetap dingin saat bermain game, dan keyboard RGB per-key memungkinkan Anda untuk menyesuaikan pencahayaan sesuai keinginan Anda. Laptop ini juga dilengkapi dengan software ROG Armoury Crate yang memungkinkan Anda untuk memantau dan mengoptimalkan performa laptop.</p>\r\n<p data-sourcepos=\"19:1-19:17\"><strong>Konektivitas:</strong></p>\r\n<p data-sourcepos=\"21:1-21:196\">Zephyrus G16 dilengkapi dengan berbagai pilihan konektivitas, termasuk Wi-Fi 6E, Bluetooth 5.2, dan Thunderbolt 4. Laptop ini juga memiliki port USB Type-C, USB Type-A, HDMI, dan jack audio 3.5mm.</p>\r\n<p data-sourcepos=\"23:1-23:12\"><strong>Baterai:</strong></p>\r\n<p data-sourcepos=\"25:1-25:186\">Zephyrus G16 dilengkapi dengan baterai 90Wh yang memberikan daya tahan baterai hingga 10 jam. Laptop ini juga mendukung fast charging sehingga Anda dapat mengisi baterainya dengan cepat.</p>\r\n<p data-sourcepos=\"27:1-27:15\"><strong>Kesimpulan:</strong></p>\r\n<p data-sourcepos=\"29:1-29:275\">ASUS ROG Zephyrus G16 adalah pilihan yang tepat bagi gamer yang menginginkan laptop gaming yang ramping, ringan, dan bertenaga. Laptop ini menawarkan performa gaming yang luar biasa, layar yang indah, dan berbagai fitur gaming untuk meningkatkan pengalaman bermain game Anda.</p>\r\n<p data-sourcepos=\"31:1-31:14\"><strong>Kelebihan:</strong></p>\r\n<ul data-sourcepos=\"33:1-42:0\">\r\n<li data-sourcepos=\"33:1-33:27\">Desain ramping dan ringan</li>\r\n<li data-sourcepos=\"34:1-34:47\">Layar WQXGA 16 inci dengan refresh rate 165Hz</li>\r\n<li data-sourcepos=\"35:1-35:33\">Performa gaming yang luar biasa</li>\r\n<li data-sourcepos=\"36:1-36:15\">RAM DDR5 16GB</li>\r\n<li data-sourcepos=\"37:1-37:32\">Penyimpanan SSD PCIe Gen 4 1TB</li>\r\n<li data-sourcepos=\"38:1-38:31\">Sistem pendingin AAS Plus 2.0</li>\r\n<li data-sourcepos=\"39:1-39:22\">Keyboard RGB per-key</li>\r\n<li data-sourcepos=\"40:1-40:28\">Software ROG Armoury Crate</li>\r\n<li data-sourcepos=\"41:1-42:0\">Baterai tahan lama</li>\r\n</ul>\r\n<p data-sourcepos=\"43:1-43:15\"><strong>Kekurangan:</strong></p>\r\n<ul data-sourcepos=\"45:1-48:0\">\r\n<li data-sourcepos=\"45:1-45:13\">Harga mahal</li>\r\n<li data-sourcepos=\"46:1-46:18\">Tidak ada webcam</li>\r\n<li data-sourcepos=\"47:1-48:0\">Penyimpanan tidak dapat diupgrade</li>\r\n</ul>\r\n<p data-sourcepos=\"49:1-49:12\"><strong>Catatan:</strong></p>\r\n<p data-sourcepos=\"51:1-51:76\">Spesifikasi dan fitur dapat berbeda tergantung pada wilayah dan konfigurasi.</p>\r\n</div>','<p data-sourcepos=\"7:1-7:16\"><strong>Spesifikasi:</strong></p>\r\n<ul data-sourcepos=\"9:1-17:0\">\r\n<li data-sourcepos=\"9:1-9:36\"><strong>Prosesor:</strong> Intel Core i9-12900H</li>\r\n<li data-sourcepos=\"10:1-10:37\"><strong>Grafis:</strong> NVIDIA GeForce RTX 3060</li>\r\n<li data-sourcepos=\"11:1-11:20\"><strong>RAM:</strong> 16GB DDR5</li>\r\n<li data-sourcepos=\"12:1-12:37\"><strong>Penyimpanan:</strong> 1TB PCIe Gen 4 SSD</li>\r\n<li data-sourcepos=\"13:1-13:40\"><strong>Layar:</strong> 16&rdquo; WQXGA (2560x1600) 165Hz</li>\r\n<li data-sourcepos=\"14:1-14:58\"><strong>Konektivitas:</strong> Wi-Fi 6E, Bluetooth 5.2, Thunderbolt 4</li>\r\n<li data-sourcepos=\"15:1-15:19\"><strong>Baterai:</strong> 90Wh</li>\r\n<li data-sourcepos=\"16:1-17:0\"><strong>Berat:</strong> 1.9kg</li>\r\n</ul>\r\n<p data-sourcepos=\"18:1-18:10\"><strong>Fitur:</strong></p>\r\n<ul data-sourcepos=\"20:1-32:0\">\r\n<li data-sourcepos=\"20:1-20:27\">Desain ramping dan ringan</li>\r\n<li data-sourcepos=\"21:1-21:40\">Layar WQXGA 16 inci dengan bezel tipis</li>\r\n<li data-sourcepos=\"22:1-22:29\">NVIDIA GeForce RTX 3060 GPU</li>\r\n<li data-sourcepos=\"23:1-23:24\">Prosesor Intel Core i9</li>\r\n<li data-sourcepos=\"24:1-24:15\">RAM DDR5 16GB</li>\r\n<li data-sourcepos=\"25:1-25:32\">Penyimpanan SSD PCIe Gen 4 1TB</li>\r\n<li data-sourcepos=\"26:1-26:10\">Wi-Fi 6E</li>\r\n<li data-sourcepos=\"27:1-27:15\">Bluetooth 5.2</li>\r\n<li data-sourcepos=\"28:1-28:15\">Thunderbolt 4</li>\r\n<li data-sourcepos=\"29:1-29:14\">Baterai 90Wh</li>\r\n<li data-sourcepos=\"30:1-30:41\">Keyboard yang nyaman dengan per-key RGB</li>\r\n<li data-sourcepos=\"31:1-32:0\">Sistem pendingin yang efisien</li>\r\n</ul>\r\n<p data-sourcepos=\"33:1-33:8\"><strong>Pro:</strong></p>\r\n<ul data-sourcepos=\"35:1-40:0\">\r\n<li data-sourcepos=\"35:1-35:33\">Performa gaming yang luar biasa</li>\r\n<li data-sourcepos=\"36:1-36:18\">Layar yang indah</li>\r\n<li data-sourcepos=\"37:1-37:27\">Desain ramping dan ringan</li>\r\n<li data-sourcepos=\"38:1-38:30\">Daya tahan baterai yang lama</li>\r\n<li data-sourcepos=\"39:1-40:0\">Keyboard yang nyaman</li>\r\n</ul>\r\n<p data-sourcepos=\"41:1-41:11\"><strong>Kontra:</strong></p>\r\n<ul data-sourcepos=\"43:1-46:0\">\r\n<li data-sourcepos=\"43:1-43:7\">Mahal</li>\r\n<li data-sourcepos=\"44:1-44:18\">Tidak ada webcam</li>\r\n<li data-sourcepos=\"45:1-46:0\">Penyimpanan tidak dapat diupgrade</li>\r\n</ul>',300,70000000,'2023-12-22 18:52:56.4044','2023-12-22 18:52:56.4044','OvKle','CWAfN','vpq1caBDHj',1);

/*Table structure for table `seller` */

DROP TABLE IF EXISTS `seller`;

CREATE TABLE `seller` (
  `id_seller` char(10) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastnama` varchar(100) DEFAULT NULL,
  `sellername` varchar(100) NOT NULL,
  `email` varchar(55) NOT NULL,
  `passwords` varchar(100) NOT NULL,
  `foto_seller` varchar(100) DEFAULT NULL,
  `status_seller` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime(4) NOT NULL DEFAULT current_timestamp(4),
  `update_at` datetime(4) NOT NULL DEFAULT current_timestamp(4),
  PRIMARY KEY (`id_seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `seller` */

insert  into `seller`(`id_seller`,`firstname`,`lastnama`,`sellername`,`email`,`passwords`,`foto_seller`,`status_seller`,`created_at`,`update_at`) values 
('i77tQoLgXd','Default','Seller','Default Seller create','default@example.com','$2y$10$fV/vDB3FYzbtkwA5uR92Je6c/rUejGJ/QdylRYmJqtjyxSFaitZNi','default.png',1,'2023-12-17 19:10:15.6304','2023-12-17 19:10:15.6304'),
('UCxt5Z6szx',NULL,NULL,'Toko Rama','tokorama@gmail.com','$2y$10$8hIkqEE8Ff21otTPR9a.vu5eiYzCLLpJJkKWEA6GhqWR71ZwpDwRu',NULL,1,'2023-12-17 19:20:24.7515','2023-12-17 19:20:24.7515'),
('vpq1caBDHj','Toko','Rog Oficial','Rog Zpyrush Store','rogofc.co.id','$2y$10$kCm7X8CuyLo51aDvvJqJZOr99zSjWV4jPpYGSyDieiA/KhF/lcAia','../../../dist/images/rog.jpeg',1,'2023-12-18 18:37:00.3320','2023-12-18 18:37:00.3320'),
('VVA6luY6cJ',NULL,NULL,'Blashing laptop','blashing.com.id','$2y$10$R1neeNO6HsAgZB3gDvpzRegoWd/tLzGav5kor3DARmPLp50wU0e5G',NULL,1,'2023-12-18 16:02:52.4923','2023-12-18 16:02:52.4923');

/*Table structure for table `ukuran` */

DROP TABLE IF EXISTS `ukuran`;

CREATE TABLE `ukuran` (
  `id_ukuran` char(5) NOT NULL,
  `besar_ukuran` varchar(100) NOT NULL,
  `id_seller` char(10) NOT NULL,
  `desk` varchar(150) NOT NULL,
  PRIMARY KEY (`id_ukuran`),
  KEY `fk_id_ukuran` (`id_seller`),
  CONSTRAINT `fk_id_ukuran` FOREIGN KEY (`id_seller`) REFERENCES `seller` (`id_seller`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ukuran` */

insert  into `ukuran`(`id_ukuran`,`besar_ukuran`,`id_seller`,`desk`) values 
('CWAfN','15.3 inch','vpq1caBDHj','Dimension 15.3 inch for the Monitor'),
('NYBF8','14 inch','vpq1caBDHj','14 Inch Desktop Monitor'),
('r9Vwi','L','UCxt5Z6szx','Large');

/*Table structure for table `warna` */

DROP TABLE IF EXISTS `warna`;

CREATE TABLE `warna` (
  `id_warna` char(5) NOT NULL,
  `nama_warna` varchar(50) NOT NULL,
  `kode_warna` varchar(20) DEFAULT NULL,
  `id_seller` char(10) NOT NULL,
  PRIMARY KEY (`id_warna`),
  KEY `fk_id_seller` (`id_seller`),
  CONSTRAINT `fk_id_seller` FOREIGN KEY (`id_seller`) REFERENCES `seller` (`id_seller`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `warna` */

insert  into `warna`(`id_warna`,`nama_warna`,`kode_warna`,`id_seller`) values 
('OvKle','Dark Mode Strix','#1c1c1c','vpq1caBDHj'),
('VnT5P','pink','#a2579a','vpq1caBDHj'),
('zWvkq','Black','#000000','vpq1caBDHj');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
