-- SchoolVoice Database Schema
-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_md5` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL DEFAULT 'siswa',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `kategori`
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `aspirasi`
CREATE TABLE IF NOT EXISTS `aspirasi` (
  `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','proses','selesai','ditolak') NOT NULL DEFAULT 'pending',
  `fotobukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_aspirasi`),
  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `feedback`
CREATE TABLE IF NOT EXISTS `feedback` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `id_aspirasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_feedback`),
  FOREIGN KEY (`id_aspirasi`) REFERENCES `aspirasi` (`id_aspirasi`) ON DELETE CASCADE,
  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
INSERT INTO `users` (`id_user`, `nama`, `username`, `password_md5`, `role`) VALUES
(1, 'Administrator', 'admin', MD5('admin123'), 'admin'),
(2, 'Ahmad Siswa', 'siswa', MD5('siswa123'), 'siswa');

-- Dumping data for table `kategori`
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sarana Prasarana'),
(2, 'Kebersihan'),
(3, 'Keamanan'),
(4, 'Lainnya');
