-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Apr 2020 pada 02.19
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
-- Struktur dari tabel `autocomplete_roles`
--

CREATE TABLE `autocomplete_roles` (
  `id` int(255) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `autocomplete_roles`
--

INSERT INTO `autocomplete_roles` (`id`, `role_name`) VALUES
(1, 'Backend Developer'),
(2, 'Frontend Developer'),
(3, 'UI Designer\n'),
(4, 'UX Designer'),
(5, 'Network Architect'),
(6, 'Security Analyst'),
(7, 'Data Scientist'),
(8, 'Web Designer'),
(9, 'Full Stack Developer'),
(10, 'System Analyst'),
(11, 'SEO Specialist\n'),
(12, 'Programmer'),
(13, 'Multi-cloud integrator'),
(14, 'Data Engineer'),
(15, 'Deep Learning Engineer'),
(16, 'Internet of Things Engineer'),
(17, 'VR/AR Developer'),
(18, 'Android Developer'),
(19, 'Developer'),
(20, 'Designer'),
(21, 'Teknologi Informasi'),
(22, 'Mikrocontroller'),
(23, 'Tester'),
(24, 'IT Consultant'),
(25, 'Big Data'),
(26, 'Game Developer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `autocomplete_roles`
--
ALTER TABLE `autocomplete_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `autocomplete_roles`
--
ALTER TABLE `autocomplete_roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
