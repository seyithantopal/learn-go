-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 Ağu 2018, 19:24:23
-- Sunucu sürümü: 10.1.16-MariaDB
-- PHP Sürümü: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `learn_go`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_turkish_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `person_id`, `comment`, `datetime`) VALUES
(1, 9, 'Deneme Yorum', '2016-01-15 10:00:00'),
(2, 9, 'Deneme Yorum2', '2016-01-18 10:00:00'),
(3, 10, 'Deneme Yorum (2)', '2016-01-14 12:00:00'),
(4, 9, 'Çok güzel', '2016-01-15 10:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `dates`
--

INSERT INTO `dates` (`id`, `student_id`, `teacher_id`, `viewed`, `status`, `datetime`) VALUES
(2, 15, 9, 0, 0, '2016-01-19 10:00:00'),
(3, 15, 10, 0, -1, '2016-01-16 12:00:00'),
(10, 12, 9, 1, 0, '2016-01-19 10:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name_surname` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `statement` varchar(8) COLLATE utf8_turkish_ci NOT NULL,
  `branch` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `isAvailable` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `socketID` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `profile_photo` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name_surname`, `username`, `password`, `statement`, `branch`, `isAvailable`, `status`, `socketID`, `profile_photo`, `datetime`) VALUES
(9, 'deneme', 'abc', '202cb962ac59075b964b07152d234b70', 'Öğretmen', 'Matematik', 1, 0, '/#3-CxYWI_F7TTH8QXAAAM', 'aa.jpg', '2016-01-24 15:08:10'),
(10, 'John Doe', 'johndoe', '202cb962ac59075b964b07152d234b70', 'Öğretmen', 'Matematik', 1, 0, '/#Onu3gRjmyPoW96G0AAAH', 'aa.jpg', '2016-01-26 19:26:38'),
(12, 'John Doe 2', 'jdoe', '202cb962ac59075b964b07152d234b70', 'Öğrenci', '', 1, 1, '/#bEhsinUdN1CxdKzhAAAI', 'bb.jpg', '2016-01-27 19:41:28'),
(15, 'aa', 'aa', '202cb962ac59075b964b07152d234b70', 'Öğrenci', '', 0, 0, '/#nB54XzsOss_LnIZAAAAD', 'cc.jpg', '2016-01-27 21:33:01'),
(16, 'aaa', 'aai', '202cb962ac59075b964b07152d234b70', 'Öğretmen', 'Matematik', 0, 0, '/#Zan-EgL3TWeTSOHMAAAG', '', '2016-01-27 21:34:23'),
(19, 'bb', 'aa', 'bb', '', '', 0, 0, '', '', '2016-12-14 21:06:22'),
(20, 'bb', 'bb', 'bb', 'bb', 'bb', 0, 0, 'bb', 'bb', '0000-00-00 00:00:00'),
(21, 'bb', 'bb', 'bb', 'bb', 'bb', 0, 0, 'bb', 'bb', '2016-12-14 21:06:57'),
(22, 'Ali Yıldız Ali Yıldız Ali Yıldız Ali Yıldız Ali Yıldız', 'aliyildiz', '123', 'Öğretmen', 'Matematik', 1, 1, '/#qhIk2iPnni61q5yjAAAS', '', '2016-12-14 23:40:03'),
(25, 'Ali Yıldız', 'aliyildiz4', '123', 'Öğretmen', 'Matematik', 0, 1, '', '', '2016-12-14 23:50:46'),
(26, 'Pelin Çift', 'pelincift', '123', 'Öğrenci', '', 1, 1, '/#svyxk71xmA85a8OmAAAI', '', '2016-12-15 23:19:23'),
(27, 'Sibel Çelik', 'sibelcelik', '123', 'Öğrenci', '', 1, 1, '/#Tpd1U1yV03cQTZ-EAAAY', '', '2016-12-17 23:51:14'),
(28, 'Zeki Güçlü', 'zekiguclu', '123', 'Öğretmen', 'Matematik', 1, 1, '/#G1xSYNKznDx5AZM9AAAg', '', '2016-12-17 23:53:02'),
(30, 'Leyla Atik', 'leylaatik', '123', 'Öğretmen', 'Matematik', 1, 0, '/#J5LZUqJJsbM2YNnsAAAd', '', '2017-01-07 15:28:13');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
