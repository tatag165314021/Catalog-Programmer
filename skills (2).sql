-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Apr 2020 pada 02.18
-- Versi server: 5.7.26-log
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orcoiste_root`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `skills`
--

CREATE TABLE `skills` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `skill` varchar(200) NOT NULL,
  `bintang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `skill`, `bintang`) VALUES
('pdq6s7qsc34ows4s4', 'MU-1', 'PHP', 5),
('pdqavvmwrms40kc8w', 'MU-2', 'PHP', 3),
('pdqavvp7u9wk88sc0', 'MU-2', 'HTML', 4),
('pdqay0w5ytwsscw4w', 'MU-1', 'SQL', 3),
('pdqay0wxxus0c08w0', 'MU-1', 'HTML', 3),
('pdqay0xf4eo8cw4ow', 'MU-1', 'MATLAB', 3),
('pdqay40l66o8s8w04', 'MU-3', 'Java', 3),
('pdqay41pzuow4o4os', 'MU-3', 'PHP', 4),
('pdqay432sys0kcck4', 'MU-3', 'HTML', 5),
('pdqay43moy8ccgww0', 'MU-3', 'JavaScript', 2),
('pdqay444kc0sw8ogo', 'MU-3', 'Python', 2),
('pdqay4551nkgcggok', 'MU-3', 'CSS', 4),
('pdqb04umhvk0kc4ww', 'MU-6', 'SQL', 4),
('pdqb0804risocsscg', 'MU-5', 'CSS', 2),
('pdqb081ytyoooogg4', 'MU-5', 'Html', 2),
('pdqb0adg9o0sckswg', 'MU-3', 'SQL', 3),
('pdqbvt3jtjkcgooog', 'MU-7', 'MATLAB', 2),
('pdqbvuvv9eokw44wg', 'MU-7', 'HTML', 3),
('pdqbvv5hxlw4wg0sg', 'MU-8', 'Java', 2),
('pdqbvy4z58g4w4o44', 'MU-7', 'Java', 1),
('pdqbxw4rj4g8ko0sg', 'MU-10', 'CSS', 4),
('pdqbxw5fdmo4gc48g', 'MU-10', 'JAVA', 3),
('pdqbxwziq9wkw4wo0', 'MU-4', 'Adobe XD', 3),
('pdqbxy4cpi8g88sww', 'MU-9', 'MATLAB', 2),
('pdqbxy4ywu8w4so4s', 'MU-9', 'PHP', 2),
('pdqbxy5icjk08ggwc', 'MU-9', 'HTML', 2),
('pdqbxzokzn4s8wgoc', 'MU-9', 'Java', 2),
('pdqby06rr9cwokkko', 'MU-11', 'Java', 4),
('pdqby0lohf4o40w4o', 'MU-10', 'HTML', 5),
('pdqbzz4z9hwo0s8co', 'MU-12', 'Java', 4),
('pdqbzznvhc004kk00', 'MU-14', 'python', 1),
('pdqbzzpveq8c0gg8c', 'MU-16', 'HTML', 1),
('pdqc00cnhvk44gsc0', 'MU-13', 'PHP', 2),
('pdqc00tyh80oggc84', 'MU-14', 'php', 3),
('pdqc01nsr1wcccs44', 'MU-12', 'HTML', 3),
('pdqc01uuspccc8ws0', 'MU-14', 'Java', 2),
('pdqc04b7odcgsgw04', 'MU-15', 'PHP', 2),
('pdqc04l6vggwwcc0o', 'MU-15', 'Java', 4),
('pdqc04lqgi88w8wco', 'MU-15', 'HTML', 3),
('pdqc237wfr4w4k0ks', 'MU-18', 'PHP', 1),
('pdqc246fwe8wc8okc', 'MU-17', 'HTML', 1),
('pdqc258s36og0c4g4', 'MU-20', 'Mikrotik', 2),
('pdqc25qhtxcwc4w4g', 'MU-21', 'Bootstrap', 2),
('pdqc27odjb40s4g4g', 'MU-12', 'Python', 1),
('pdqc28n33eskkc004', 'MU-19', 'Java', 4),
('pdqc4b0e3nk0gc80o', 'MU-16', 'Java', 1),
('pdqc4b1t3tc8g0cos', 'MU-16', 'PHP', 1),
('pdqc6h20wkgkkck48', 'MU-22', 'Adobe Photoshop', 1),
('pdqcgxgp7tw4gck0w', 'MU-23', 'PHP ', 2),
('pdqgqzsxp7kk8gc8g', 'MU-24', 'Tableau', 2),
('pdqgr19sza8gwsg0k', 'MU-25', 'Java', 2),
('pdqgzi5onaos4c8kc', 'MU-26', 'Java ', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
