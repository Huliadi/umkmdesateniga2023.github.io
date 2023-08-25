-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Agu 2023 pada 18.38
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_teniga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(6, 'Makanan'),
(14, 'Minuman'),
(17, 'Anyaman'),
(18, 'Hiasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `stok`) VALUES
(35, 6, 'Kembang Pisang', 10000, 'Ju1XacEZiroMXlie917j.jpeg', '            Kripik pisang adalah camilan yang populer dan lezat yang terbuat dari potongan tipis pisang yang diiris dan kemudian dikeringkan atau digoreng hingga renyah. Kripik pisang memiliki cita rasa manis alami dari pisang matang dan kelezatan renyahnya setelah diolah.\r\nKripik pisang tersedia dalam berbagai varian rasa dan gaya. Beberapa diantaranya memiliki tambahan rasa seperti cokelat, tiramisu, dan Greentea untuk memberikan variasi cita rasa. Ada juga pisang sale untuk memberikan sentuhan rasa unik.           ', 'tersedia'),
(36, 6, 'Kue Kering', 10000, 'ofh4sOAbM93EAcFqMyIT.jpeg', 'Kue kering adalah jenis penganan ringan yang biasanya disajikan dalam bentuk kecil dan kering. Kue kering sering dihidangkan sebagai camilan pendamping saat minum teh, di acara khusus, atau sebagai oleh-oleh dalam berbagai kesempatan. Mereka memiliki variasi rasa, bentuk, dan hiasan yang beragam, menciptakan pengalaman rasa dan visual yang menarik.', 'tersedia'),
(37, 14, 'Kopi Vanili Mama Ola', 10000, 'fa28QxB4qbW84GRAisVI.jpeg', '            Kopi Vanili Mama Ola adalah perpaduan yang menggoda antara kekuatan karakteristik kopi dengan kelembutan dan kehangatan aroma vanili. Minuman ini memiliki dasar kopi yang kaya dan penuh cita rasa, yang dipadukan dengan sentuhan manis yang lembut dari vanili, menciptakan harmoni rasa yang menggiurkan. Setiap tegukan Kopi Vanili Mama Ola membawa sensasi kenikmatan dari kekuatan kopi yang terasa di lidah, diimbangi oleh kemolekan rasa vanili yang melengkapi dengan lembut. harga Rp.10.000/120 gram.           ', 'tersedia'),
(38, 18, 'Buket', 30000, 'OoFNhW828o7Wa1FLslVQ.jpeg', 'Buket merupakan cara populer untuk merayakan berbagai kesempatan, seperti ulang tahun, pernikahan, atau perayaan lainnya. Dalam buket, bunga-bunga tidak hanya merupakan benda mati, tetapi juga simbol keindahan alam, cinta, persahabatan, atau penghargaan. Kisaran harga buket mulai dari 17K-550K, sesuai dengan bentuk dan isi dari buket tersebut.', 'tersedia'),
(39, 6, 'Kue', 50000, 'IBkBwMzsHk3YAhn0l1KO.jpeg', 'Cake atau kue dapat di pesan sesuai dengan ukuran dan bentuk. Kisaran harga kue mulai dari 50K-300K tergantung bentuk dan ukuran yang diminati.', 'tersedia'),
(41, 6, 'Kue Kering Dasan Baro', 5000, 'fIXbuRhCwnadjkdlgJV6.jpeg', 'Kue Kering Dasan Baro adalah hidangan manis yang menggoda dengan sentuhan tradisional yang khas. Terinspirasi dari resep warisan budaya, setiap gigitan mengajak Anda dalam perjalanan rasa yang autentik dan menghangatkan hati. Dibuat dengan telaten dan cinta, kue-kue kering ini memiliki tekstur renyah namun lembut di dalam, menciptakan harmoni sempurna di setiap kunyahannya. Dipenuhi dengan aroma dan cita rasa yang mengingatkan pada cita rasa masa lalu, Kue Kering Dasan Baro adalah pilihan sempurna untuk menemani momen santai, acara istimewa, atau sebagai hadiah manis untuk orang terkasih. Dengan kemasan yang menawan, kue-kue ini tidak hanya memanjakan lidah, tetapi juga menghadirkan sejumput kehangatan tradisional dalam setiap kesempatan.', 'tersedia'),
(42, 6, 'Keripik Pisang 5R', 5000, 'Ax2oZQ2Ht0IbTI26WZ37.jpeg', 'Kripik Pisang 5R adalah camilan lezat yang terbuat dari irisan pisang matang yang diolah melalui proses pengeringan khusus hingga menjadi kripik renyah. Setiap gigitan menghadirkan kombinasi sempurna antara rasa manis alami dari pisang dan sensasi renyah yang memikat. Diproduksi dengan standar kualitas tinggi, Kripik Pisang 5R dijamin menggunakan bahan pisang pilihan sehingga menghasilkan produk akhir yang lezat, gurih, dan menggoda selera. Cocok sebagai teman santai di sore hari, tambahan dalam acara bersama, atau sebagai cemilan praktis kapan saja. Dengan citarasa yang khas dan tekstur yang memukau, Keripik Pisang 5R adalah pilihan camilan yang menggugah selera dan memanjakan lidah. Varian rasa keripik pisang 5R yaitu Balado, Asin, dan Original. Harga murah meriah mulai dari harga Rp.5.000           ', 'tersedia'),
(43, 6, 'Tempe Super', 2500, '2RhbmpmVRO0X6t9W9m49.jpeg', 'Tempe Super yang di kelola oleh UMKM Nina Kreatif adalah pilihan luar biasa bagi pecinta makanan sehat dan bergizi tinggi. Dibuat dari bahan baku kedelai pilihan yang kaya protein, Tempe Super menjadi sumber nutrisi yang luar biasa untuk tubuh Anda. Proses produksi yang cermat menghasilkan tempe dengan tekstur lembut di dalam namun renyah di luar, menciptakan pengalaman makan yang memuaskan. Dengan kandungan serat, vitamin, dan mineral yang melimpah, Tempe Super tidak hanya menggugah selera tetapi juga mendukung gaya hidup sehat Anda. Cocok sebagai menu utama atau sebagai tambahan dalam hidangan, Tempe Super memberikan energi berkelanjutan dan memberi nilai gizi tinggi tanpa mengorbankan rasa yang lezat. Dapatkan manfaat optimal dari makanan yang bergizi dengan menikmati Tempe Super dalam setiap hidangan Anda. Harga mulai Rp.2500', 'tersedia'),
(44, 6, 'Tempe Super Ibu Ani', 2500, 'WThR1QxaLFJ48vIeD6Lm.jpeg', 'Produk Ibu Ani adalah simbol rasa lezat dan cinta dalam setiap sajian. Terlahir dari tangan terampil Ibu Ani yang penuh kasih, setiap hidangan menghadirkan sentuhan rumah yang hangat dan cita rasa yang autentik. Dari rempah-rempah yang dipilih dengan teliti hingga proses memasak yang hati-hati, setiap produk Ibu Ani adalah hasil dari dedikasi untuk menghadirkan makanan berkualitas tinggi kepada Anda. Tidak hanya mengisi perut, tetapi juga memenuhi jiwa dengan kepuasan. Dari masakan sehari-hari hingga hidangan istimewa, produk Ibu Ani adalah pilihan yang tepat untuk menghadirkan kenikmatan meja makan Anda. Harga mulai Rp.2500', 'tersedia'),
(45, 14, 'Coffe Macco', 15000, 'KnrxRJlZiqcbUAabYAwC.jpeg', 'Nikmati kelezatan dalam setiap tegukan dengan Coffee Macco, yang hadir dalam tiga varian rasa yang menggoda: Original, Coklat, dan Jahe. \r\n\r\n1. **Original**: Rasakan cita rasa kopi yang otentik dan memikat dalam setiap cangkir. Dibuat dengan biji kopi pilihan, varian Original Coffee Macco memberikan sentuhan kafein yang sempurna untuk memulai hari Anda. Aroma kopi yang khas dan rasa yang mendalam menghadirkan pengalaman minum kopi yang sejati.\r\n\r\n2. **Coklat**: Untuk pecinta rasa manis, varian Coklat Coffee Macco adalah pilihan yang sempurna. Menggabungkan kelezatan coklat dengan aroma kopi yang kaya, minuman ini menciptakan harmoni rasa yang luar biasa. Cocok untuk dinikmati sebagai cemilan mewah atau penyemangat suasana hati di tengah hari.\r\n\r\n3. **Jahe**: Jika Anda mencari kombinasi yang hangat dan menyegarkan, varian Jahe Coffee Macco adalah jawabannya. Kombinasi antara cita rasa jahe yang segar dan kekuatan kopi menciptakan minuman yang menghangatkan tubuh dan merangsang indera. Ideal untuk dinikmati pada pagi yang dingin atau sebagai alternatif yang menghidupkan dalam daftar minuman Anda.\r\n\r\nDengan kualitas biji kopi yang unggul dan varian rasa yang terasa autentik, Coffee Macco memberikan pengalaman minum kopi yang menggugah selera dan memenuhi berbagai selera penikmat kopi.', 'tersedia'),
(46, 14, 'Madu Lebah Tawon Dan Trigona', 240000, '7s2MKMnTjld9Y4BesNAu.jpeg', 'Madu Lebah Tawon Dan Trigona adalah pilihan alami yang menghadirkan manfaat dan kelezatan dalam setiap tetesnya. Terbuat dari nektar bunga-bunga yang berkualitas tinggi, madu ini berasal dari kerja keras lebah tawon dan trigona yang mengumpulkan sari bunga dengan teliti. \r\n\r\n1. **Madu Lebah Tawon**: Rasakan keaslian alam dalam setiap tegukan madu lebah tawon. Dengan cita rasa manis yang khas, madu ini menyajikan kandungan nutrisi yang melimpah, termasuk enzim alami dan senyawa antioksidan. Cocok sebagai tambahan dalam minuman hangat, makanan penutup, atau bahkan sebagai bahan alami dalam perawatan kecantikan.\r\n\r\n2. **Madu Trigona**: Dikenal sebagai madu kelulut, madu trigona memiliki karakter unik dengan rasa yang lebih kompleks. Diproduksi oleh lebah trigona yang eksklusif, madu ini memiliki profil rasa yang beragam, dari manis hingga asam. Keunikan ini juga disertai dengan manfaat kesehatan yang beragam, termasuk potensi sebagai antibakteri alami dan sumber antioksidan.\r\n\r\nKedua jenis madu ini merupakan pilihan yang sangat baik untuk mendukung gaya hidup sehat dan alami. Dipanen dengan keahlian dan diolah dengan cermat, Madu Lebah Tawon Dan Trigona adalah produk alami yang menghadirkan kesehatan dan cita rasa alamiah dalam setiap sendoknya.', 'tersedia'),
(47, 17, 'Anyaman Bambu', 60000, 'bPGKxAlHSYQgzJiyRf2V.jpeg', 'Produk anyaman bambu adalah contoh sempurna dari kerajinan tangan yang menggabungkan keindahan alami dengan keahlian manusia. Terbuat dari serat bambu yang kuat dan lentur, setiap anyaman adalah karya seni yang unik dan fungsional. Dari keranjang untuk berbelanja hingga alas makan yang elegan, produk anyaman bambu menghadirkan sentuhan alam dan nuansa rustik dalam setiap ruangan. Dengan tangan terampil para pengrajin, bambu diolah menjadi bentuk-bentuk yang beragam, menciptakan produk yang kuat, tahan lama, dan ramah lingkungan. Cocok sebagai dekorasi, alat bantu sehari-hari, atau sebagai hadiah istimewa, produk anyaman bambu adalah simbol keindahan alam yang diolah menjadi karya seni berguna dalam kehidupan sehari-hari.', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2a$12$EHoIIMwzooLgOy2lSyfCRuw6hhp/ye7vSFfaKhAzY4tTNYvJXKMdC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
