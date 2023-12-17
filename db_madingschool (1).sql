-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2023 pada 16.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_madingschool`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` longtext NOT NULL,
  `user_id` int(50) NOT NULL,
  `deploy_date` timestamp NULL DEFAULT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT 0,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `judul`, `isi`, `user_id`, `deploy_date`, `is_allowed`, `category`) VALUES
(51, 'Cara Memposting Mading', '<p><span style=\"font-size: 14pt; font-family: helvetica, arial, sans-serif;\"><span style=\"font-size: 12pt;\">Perlu diketahui bahwa untuk dapat memposting mading baru, role anda harus di izinkan oleh admin untuk dapat memposting mading, </span><br><span style=\"font-size: 12pt;\">apabila role anda tidak di izinkan untuk menambahkan mading baru, maka anda tidak dapat menambahkan mading baru.</span><br><br><strong>Langkah Langkah</strong><br></span><span style=\"font-size: 12pt;\">1. Buka halaman Tambah Post<br>2. Masukan Judul mading yang ingin anda publikasikan<br>3. Masukan isi konten mading anda </span></p>\r\n<p style=\"line-height: 1.5;\"><span style=\"font-size: 12pt;\">4.&nbsp;anda Bisa menambahkan gambar dengan menggunakan tautan</span></p>\r\n<p style=\"line-height: 1.5;\"><span style=\"font-size: 12pt;\">5. selanjutnya pilih category mading yang relevan</span></p>\r\n<p style=\"line-height: 1.5;\"><span style=\"font-size: 12pt;\">6. selanjut nya atur tanggal terbit mading</span></p>\r\n<p style=\"line-height: 1.5;\"><span style=\"font-size: 12pt;\">7. lalu submit dan tunggu sampai postingan anda di acc oleh admin</span></p>\r\n<p style=\"line-height: 1.5;\"><span style=\"font-size: 12pt;\">8. hanya postingan yang sudah di acc admin saja yang dapat tampil di halaman home</span></p>\r\n<p style=\"line-height: 1.5;\">&nbsp;</p>\r\n<p style=\"line-height: 1;\"><em>Happy Writting&nbsp;</em>😀</p>\r\n<p>&nbsp;</p>', 14, '2023-12-17 13:10:00', 1, 'lain lain'),
(52, 'PENDAFTARAN CLASSMEETING 2023', '<p>&nbsp;</p>\r\n<pre style=\"text-align: center;\"><strong>✨<span style=\"font-family: helvetica, arial, sans-serif;\">OSIS SMKN 2 KOTA BEKASI✨</span></strong><br><span style=\"text-decoration: underline;\"><span style=\"font-family: helvetica, arial, sans-serif;\">💫 Proudly Present 💫</span></span><br><span style=\"font-family: helvetica, arial, sans-serif;\">⚽🏀📝 <em>CLASSMEETING </em>📝⚽🏀<br><br></span></pre>\r\n<p>📌MATA LOMBA📌<br>&bull;<strong> FASHION SHOW (Lomba Wajib)</strong><br>📞 : <a href=\"https://wa.me/0856-1212-2323\">wa.me/0856-1212-2323</a><br>(QADAFY)</p>\r\n<p><br><strong>&bull; BASKET</strong><br>📞 : <a href=\"https://wa.me/0857-1212-2323\">wa.me/0857-1212-2323</a><br>(AGIL)&nbsp;</p>\r\n<p><strong>&bull; DESAIN POSTER</strong><br>📞 : <a href=\"https://wa.me/0857-1212-2323\">wa.me/0887-1212-2323</a><br>(AFIFAH)</p>\r\n<p><strong>STAND UP</strong><br>📞 : <a href=\"https://wa.me/0858-1212-2323\">wa.me/0858-1212-2323</a><br>(WIDYA)</p>\r\n<p><strong>E-SPORT</strong><br>📞 : <a href=\"https://wa.me/0858-1428-6457\">wa.me/0858-1428-6457</a><br>(LUTHFI)</p>\r\n<p><br>Form Pendaftaran LOMBA CLASSMEETING :<br><a href=\"https://docs.google.com/forms/d/e/1FAsd12QLSfvxs1wcIeyWJYqwdqwpdQhpoZJZ8OktgX1XeeiC4RSi5xCP/viewform?usp=sf_link\">https://docs.google.com/forms/d/e/1FAsd12QLSfvxs1wcIeyWJYqwdqwpdQhpoZJZ8OktgX1XeeiC4RSi5xCP/viewform?usp=sf_link</a></p>\r\n<p><br>Ikuti kegiatan Technical Meeting untuk mengetahui informasi mengenai Event Classmeeting, yang akan dilaksanakan pada hari :</p>\r\n<p>📆 : Minggu, 3 Desember 2023<br>🏫 : Aula Lt. 3<br>🕐 : 09.00 s/d selesai<br>👕 : Baju Bebas sopan + menggunakan sepatu<br>💸 : HTM 55K /kelas</p>\r\n<p>Informasi lebih lanjut :&nbsp;<br>📞 : <a href=\"https://wa.me/0895-3434-1212\">wa.me/0895-3434-1212</a><br>(HANIF)</p>\r\n<p>📞:<a href=\"https://wa.me/0895-2323-1212\">wa.me/0895-2323-1212</a><br>(FAISAL)</p>\r\n<p>Terimakasih Atas Perhatiannya&nbsp;</p>', 15, '2023-12-17 13:30:00', 1, 'pengumuman penting'),
(53, 'Materi Singkat Tentang Bahasa Pemograman PHP', '<h2><strong><span style=\"font-size: 18pt;\">Apa itu PHP?</span></strong></h2>\r\n<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"><colgroup><col style=\"width: 29.3672%;\"><col style=\"width: 70.6328%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td><img src=\"https://images.pexels.com/photos/270557/pexels-photo-270557.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=600\" alt=\"\" width=\"286\" height=\"190\"></td>\r\n<td><span style=\"font-size: 12pt;\">PHP (Hypertext Preprocessor) adalah bahasa pemrograman server-side yang dirancang khusus untuk pengembangan web. Dikembangkan awalnya oleh Rasmus Lerdorf pada tahun 1994, PHP sejak itu telah menjadi salah satu bahasa pemrograman web paling populer di dunia.</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<h2><strong><span style=\"font-size: 18pt;\">Fitur Utama PHP:</span></strong></h2>\r\n<ol>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Server-Side Scripting</span></li>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Sintaks Mirip C</span></li>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Dukungan Database</span></li>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Fleksibel dan Kuat</span></li>\r\n</ol>\r\n<h2><strong><span style=\"font-size: 18pt;\">Contoh Kode PHP Sederhana:</span></strong></h2>\r\n<pre><code>&lt;?php\r\n// Menampilkan pesan sederhana\r\necho \"Hello, World!\";\r\n\r\n// Variabel dan operasi matematika\r\n$angka1 = 5;\r\n$angka2 = 10;\r\n$hasil = $angka1 + $angka2;\r\necho \"Hasil penjumlahan: \" . $hasil;\r\n?&gt;</code></pre>\r\n<h2><strong>Manfaat Penggunaan PHP:</strong></h2>\r\n<ul>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Dinamis</span></li>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Open Source</span></li>\r\n<li style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Cocok untuk Web</span></li>\r\n</ul>', 16, '2023-12-17 13:51:00', 1, 'lain lain'),
(54, 'Lingkungan SMKN 2 BEKASI', '<p style=\"text-align: center;\">&nbsp;</p>\r\n<h1 style=\"text-align: center;\"><span style=\"font-size: 14pt;\">NET12 - Lahan SMKN 2 Bekasi diganti menjadi hutan kota 2013</span></h1>\r\n<div style=\"max-width: 650px; margin-left: auto; margin-right: auto;\" data-ephox-embed-iri=\"https://youtu.be/t9Etpre8Jq8?si=xXXLl_qJAX3ApsYc\">\r\n<div style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><iframe style=\"top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;\" src=\"https://www.youtube.com/embed/t9Etpre8Jq8?rel=0\" scrolling=\"no\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share;\" allowfullscreen=\"allowfullscreen\"></iframe></div>\r\n</div>\r\n<p><span style=\"font-size: 14pt;\"><strong>Tentang Hutan Kota</strong></span></p>\r\n<p>Hutan Kota SMKN 2 Bekasi 2013 merupakan proyek lingkungan yang mengubah lahan sekolah menjadi sebuah hutan kota. Inisiatif ini bertujuan untuk meningkatkan kesadaran lingkungan, menyediakan ruang hijau, dan memberikan kontribusi positif terhadap kesehatan dan kesejahteraan masyarakat.</p>\r\n<p><span style=\"font-size: 14pt;\"><strong>Manfaat Hutan Kota:</strong></span></p>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Peningkatan Kualitas Udara</li>\r\n<li>Penyerapan Karbon</li>\r\n<li>Tempat Rekreasi dan Edukasi</li>\r\n<li>Perlindungan Biodiversitas</li>\r\n</ul>\r\n<p><span style=\"font-size: 12pt;\"><strong>Progres Pembangunan:</strong></span> Pembangunan hutan kota saat ini dalam tahap perencanaan dan pengumpulan dukungan dari pihak sekolah dan masyarakat sekitar. Diharapkan dengan adanya hutan kota, kita dapat bersama-sama menciptakan lingkungan yang lebih baik untuk generasi mendatang.</p>\r\n<p>&nbsp;</p>', 17, '2023-12-17 14:15:00', 1, 'ekstrakurikuler');

--
-- Trigger `posts`
--
DELIMITER $$
CREATE TRIGGER `create new record` AFTER INSERT ON `posts` FOR EACH ROW INSERT INTO posts_interaction VALUES('',NEW.id,'0','0')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts_interaction`
--

CREATE TABLE `posts_interaction` (
  `id` int(50) NOT NULL,
  `id_post` int(50) NOT NULL,
  `likes_total` int(255) NOT NULL,
  `views_total` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posts_interaction`
--

INSERT INTO `posts_interaction` (`id`, `id_post`, `likes_total`, `views_total`) VALUES
(29, 51, 3, 6),
(30, 52, 3, 22),
(31, 53, 2, 3),
(32, 54, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_settings`
--

CREATE TABLE `role_settings` (
  `id` int(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `can_add` tinyint(1) NOT NULL,
  `can_view_stats` tinyint(1) NOT NULL,
  `can_edit_posts` tinyint(1) NOT NULL,
  `can_delete_posts` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role_settings`
--

INSERT INTO `role_settings` (`id`, `role`, `can_add`, `can_view_stats`, `can_edit_posts`, `can_delete_posts`) VALUES
(1, 'siswa', 0, 0, 0, 0),
(2, 'admin', 1, 1, 1, 1),
(3, 'guru', 1, 1, 1, 0),
(4, 'osis', 1, 0, 1, 0),
(5, 'ketua eskul', 1, 0, 1, 0),
(6, 'guest', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(55) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(0, 'guest', 'guest', '', 'guest', '2023-12-17'),
(5, 'admin', 'dhitgtofficial@gmail.com', '$2y$10$Z9AWlXPtQNFVBZPdBSARlO2oubXlpEKlJFiJOk9bij1O5z2uAU5tC', 'admin', '0000-00-00'),
(12, 'siswa1', 'siswa1@gmail.com', '$2y$10$f2Q8jNyuFpZ3wcmKnsJkcOkq7BHq0yvxeytFBnZQ1IhxdbGbTNctC', 'siswa', '0000-00-00'),
(13, 'siswa2', 'siswa2@gmail.com', '$2y$10$FigtutxktJ/.jLZJdKYtHeDjc4/IVN0ZG4/9pxIlZZql1oMh7ntRa', 'siswa', '0000-00-00'),
(14, 'admin', 'admin@gmail.com', '$2y$10$xhDsnziqeVs02x1jVz9wzutaLCrm5KVg/UD7w.dXMw7IFGEe24xQm', 'admin', '0000-00-00'),
(15, 'osis1', 'osis@gmail.com', '$2y$10$EYKCk/3Qoe7dyuRRF3UQ/ek4QbZHpOxl8.lLxlU9LwOaJXy1EZcvu', 'osis', '0000-00-00'),
(16, 'guru1', 'guru@gmail.com', '$2y$10$HPevqNQJIu6GDZGYbJaQhufjP.P6GdYNXAPStaptkx.r6IAJY5Qta', 'guru', '0000-00-00'),
(17, 'ketua eskul', 'ketuaeskul@gmail.com', '$2y$10$xkVPj63CzpoD2IdGeBvOwultx/fg3lPdD0WigAXkRGvIKU9V.sqsu', 'ketua eskul', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_fav`
--

CREATE TABLE `users_fav` (
  `id` int(255) NOT NULL,
  `id_user` int(50) NOT NULL,
  `id_liked_post` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_fav`
--

INSERT INTO `users_fav` (`id`, `id_user`, `id_liked_post`) VALUES
(240, 12, 51),
(261, 14, 51),
(266, 14, 52),
(265, 14, 53),
(264, 14, 54),
(243, 16, 51),
(242, 16, 52),
(245, 17, 52),
(246, 17, 53),
(244, 17, 54);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_views`
--

CREATE TABLE `user_views` (
  `id` int(11) NOT NULL,
  `view_date` date NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_views`
--

INSERT INTO `user_views` (`id`, `view_date`, `views`) VALUES
(2, '2023-12-13', 23),
(5, '2023-12-14', 1),
(6, '2023-12-15', 15),
(7, '2023-12-16', 27),
(8, '2023-12-17', 207),
(9, '2023-12-18', 43),
(10, '2023-11-28', 17),
(11, '2023-11-29', 43);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `posts_interaction`
--
ALTER TABLE `posts_interaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indeks untuk tabel `role_settings`
--
ALTER TABLE `role_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `users_fav`
--
ALTER TABLE `users_fav`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_liked_post`),
  ADD KEY `id_liked_post` (`id_liked_post`);

--
-- Indeks untuk tabel `user_views`
--
ALTER TABLE `user_views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `posts_interaction`
--
ALTER TABLE `posts_interaction`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `role_settings`
--
ALTER TABLE `role_settings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users_fav`
--
ALTER TABLE `users_fav`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT untuk tabel `user_views`
--
ALTER TABLE `user_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts_interaction`
--
ALTER TABLE `posts_interaction`
  ADD CONSTRAINT `posts_interaction_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users_fav`
--
ALTER TABLE `users_fav`
  ADD CONSTRAINT `users_fav_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_fav_ibfk_2` FOREIGN KEY (`id_liked_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
