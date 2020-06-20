-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 06:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.18
CREATE DATABASE hotel;
USE hotel;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `dobavljaci`
--

CREATE TABLE `dobavljaci` (
  `dobavljaci_id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dobavljaci`
--

INSERT INTO `dobavljaci` (`dobavljaci_id`, `ime`) VALUES
(1, 'Delhaize'),
(2, 'Henkel'),
(73, 'SPRINBOX DOO'),
(74, 'NELT DOO'),
(75, 'CENTROSINGERGIJA DOO');

-- --------------------------------------------------------

--
-- Table structure for table `domacinstvo`
--

CREATE TABLE `domacinstvo` (
  `domacinstvo_id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kolicina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suvenir` int(11) NOT NULL,
  `suv_prodajna` int(11) NOT NULL,
  `datum_unosa` date NOT NULL,
  `datum_promene` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `domacinstvo`
--

INSERT INTO `domacinstvo` (`domacinstvo_id`, `ime`, `kolicina`, `suvenir`, `suv_prodajna`, `datum_unosa`, `datum_promene`) VALUES
(12, 'Peskir', '55621', 0, 0, '2020-04-29', '2020-06-11 15:24:50'),
(13, 'Sapun', '0', 0, 0, '2020-04-29', '2020-06-11 15:24:53'),
(14, 'Sampon', '0', 0, 0, '2020-04-29', '2020-06-04 17:19:48'),
(16, 'Zavesa', '0', 0, 0, '2020-04-29', '2020-05-10 11:49:48'),
(17, 'Jastucnica', '0', 0, 0, '2020-04-29', '2020-05-09 19:27:23'),
(18, 'Bade-mantil', '0', 0, 0, '2020-04-29', '2020-05-09 19:27:26'),
(19, 'Magnet', '100', 1, 10, '2020-04-29', '2020-06-18 18:03:46'),
(21, 'Razglednica', '100', 1, 10, '2020-05-09', '2020-06-04 17:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guests_id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lk_broj` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guests_id`, `ime`, `prezime`, `e_mail`, `lk_broj`) VALUES
(30, 'Jovan', 'Radosavljevic', 'enginious1@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `kalkulacijedetailed`
--

CREATE TABLE `kalkulacijedetailed` (
  `kalk_det_id` int(11) NOT NULL,
  `racun_id` int(11) NOT NULL,
  `kolicina` float NOT NULL,
  `nabavnacena` float NOT NULL,
  `prodajnacena` float NOT NULL,
  `domacinstvo_id` float NOT NULL,
  `marza` float NOT NULL,
  `pdv` float NOT NULL,
  `rabat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kalkulacijedetailed`
--

INSERT INTO `kalkulacijedetailed` (`kalk_det_id`, `racun_id`, `kolicina`, `nabavnacena`, `prodajnacena`, `domacinstvo_id`, `marza`, `pdv`, `rabat`) VALUES
(1430, 696, 11, 12, 12.7345, 12, 2, 2, 2),
(1432, 696, 11, 12, 12.7345, 12, 2, 2, 2),
(1433, 696, 11, 12, 12.7345, 12, 2, 2, 2),
(1434, 696, 11, 12, 12.7345, 12, 2, 2, 2),
(1435, 696, 11, 12, 12.7345, 12, 2, 2, 2),
(1436, 696, 11, 12, 12.7345, 12, 2, 2, 2),
(1442, 702, 11111, 20, 24.9696, 12, 2, 20, 0),
(1443, 702, 11111, 0, 0, 12, 0, 0, 0),
(1444, 702, 11111, 0, 0, 12, 0, 0, 0),
(1445, 702, 11111, 20, 24.9696, 12, 2, 20, 0),
(1446, 702, 11111, 20, 24.9696, 12, 2, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kalkulacijemain`
--

CREATE TABLE `kalkulacijemain` (
  `racun_id` int(111) NOT NULL,
  `dobavljaci_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datum_prijema` date NOT NULL,
  `broj_fakture` int(11) NOT NULL,
  `broj_godine` int(11) NOT NULL,
  `napomena` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kalkulacijemain`
--

INSERT INTO `kalkulacijemain` (`racun_id`, `dobavljaci_id`, `datum_prijema`, `broj_fakture`, `broj_godine`, `napomena`) VALUES
(696, '1', '2020-06-17', 2, 2020, '1111'),
(702, '1', '2020-06-17', 8, 2020, '123123');

-- --------------------------------------------------------

--
-- Table structure for table `racunidetailed`
--

CREATE TABLE `racunidetailed` (
  `rac_det_id` int(11) NOT NULL,
  `d_racun_id` int(11) NOT NULL,
  `datum_racuna` datetime NOT NULL,
  `cena` float NOT NULL,
  `vrsta` int(11) NOT NULL,
  `ukupan_racun` float NOT NULL,
  `kolicina` int(11) NOT NULL,
  `stavka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racunidetailed`
--

INSERT INTO `racunidetailed` (`rac_det_id`, `d_racun_id`, `datum_racuna`, `cena`, `vrsta`, `ukupan_racun`, `kolicina`, `stavka`) VALUES
(640, 294, '2020-06-19 14:49:37', 150, 1, 2700, 18, 76),
(641, 294, '2020-06-19 14:49:37', 10, 2, 20, 2, 19),
(642, 294, '2020-06-19 14:49:37', 5, 3, 5, 1, 51),
(643, 294, '2020-06-19 14:49:37', 3, 3, 6, 2, 54);

-- --------------------------------------------------------

--
-- Table structure for table `racunimain`
--

CREATE TABLE `racunimain` (
  `racun_id` int(11) NOT NULL,
  `broj_racuna` int(11) NOT NULL,
  `broj_godine` int(11) NOT NULL,
  `gost_id` int(11) NOT NULL,
  `datum_izdavanja` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racunimain`
--

INSERT INTO `racunimain` (`racun_id`, `broj_racuna`, `broj_godine`, `gost_id`, `datum_izdavanja`) VALUES
(294, 1, 2020, 30, '2020-06-18 14:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `radnici`
--

CREATE TABLE `radnici` (
  `radnik_id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datum_registracije` date NOT NULL,
  `admin` int(11) NOT NULL,
  `hash` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `radnici`
--

INSERT INTO `radnici` (`radnik_id`, `ime`, `prezime`, `username`, `password`, `e_mail`, `datum_registracije`, `admin`, `hash`) VALUES
(1, 'Jovan', 'Radosavljevic', 'enginious1', 'hotel2', 'enginious1@gmail.com', '0000-00-00', 1, 'qwe123dastr56gvdy'),
(3, 'Jovan', 'Radosavljevic', 'bysergie', '111', 'mr.enginious@gmail.com', '2020-06-20', 1, 'mYrpBl18pfhrUwSqxgjg');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `rezervacije_id` int(11) NOT NULL,
  `gost_id` int(11) NOT NULL,
  `soba_id` int(11) NOT NULL,
  `datum_od` datetime NOT NULL,
  `datum_do` datetime NOT NULL,
  `rez_status_id` int(11) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`rezervacije_id`, `gost_id`, `soba_id`, `datum_od`, `datum_do`, `rez_status_id`, `cena`) VALUES
(76, 30, 51, '2020-06-13 14:19:00', '2020-06-30 14:19:00', 1, 280);

-- --------------------------------------------------------

--
-- Table structure for table `sobatip`
--

CREATE TABLE `sobatip` (
  `tipsobe_id` int(11) NOT NULL,
  `naziv_sobe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `broj_gostiju` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `broj_soba` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena_sobe` float NOT NULL,
  `broj_slobodnih` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `povrsina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis_sobe` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sobatip`
--

INSERT INTO `sobatip` (`tipsobe_id`, `naziv_sobe`, `broj_gostiju`, `broj_soba`, `cena_sobe`, `broj_slobodnih`, `povrsina`, `opis_sobe`) VALUES
(35, 'Penthause', '5', '2', 150, '2', '130', ''),
(36, 'Honeymoon\'s Suite', '3', '20', 75, '16', '75', ''),
(45, 'King\'s Private Suite', '8', '8', 100, '5', '100', ''),
(48, 'Regular Room', '5', '25', 50, '34', '55', '');

-- --------------------------------------------------------

--
-- Table structure for table `sobe`
--

CREATE TABLE `sobe` (
  `sobe_id` int(255) NOT NULL,
  `broj_sobe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sprat_sobe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tip_sobe` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sobe`
--

INSERT INTO `sobe` (`sobe_id`, `broj_sobe`, `sprat_sobe`, `tip_sobe`) VALUES
(51, '36', '4', '35'),
(52, '5', '4', '45'),
(53, '23', '2', '36'),
(54, '22', '2', '48'),
(73, '2', '2', '36'),
(74, '2', '2', '45');

-- --------------------------------------------------------

--
-- Table structure for table `sobestatus`
--

CREATE TABLE `sobestatus` (
  `sst_status_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sobestatus`
--

INSERT INTO `sobestatus` (`sst_status_id`, `status`) VALUES
(1, 'slobodna'),
(2, 'rezervisana'),
(3, 'predrezervacija'),
(4, 'servis');

-- --------------------------------------------------------

--
-- Table structure for table `usluge`
--

CREATE TABLE `usluge` (
  `usluge_id` int(11) NOT NULL,
  `naziv_usluge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena_usluge` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usluge`
--

INSERT INTO `usluge` (`usluge_id`, `naziv_usluge`, `cena_usluge`) VALUES
(51, 'Mini bar', 5),
(52, 'Parking', 2),
(53, 'Bazen', 5),
(54, 'Sauna', 3),
(55, 'Boravišna taksa ', 5),
(56, 'Salon', 10),
(57, 'WiFi', 5),
(58, 'Teretana', 5),
(59, 'Menjačnica', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `radnik_id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `broj_telefona` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `pozicija` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`radnik_id`, `ime`, `prezime`, `e_mail`, `slika`, `broj_telefona`, `pozicija`) VALUES
(160, 'Jovan', 'Radosavljevic', 'enginious1@gmail.com', 'profilslika.jpg', '0628635150', 'Sef kuhinje');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dobavljaci`
--
ALTER TABLE `dobavljaci`
  ADD PRIMARY KEY (`dobavljaci_id`);

--
-- Indexes for table `domacinstvo`
--
ALTER TABLE `domacinstvo`
  ADD PRIMARY KEY (`domacinstvo_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guests_id`);

--
-- Indexes for table `kalkulacijedetailed`
--
ALTER TABLE `kalkulacijedetailed`
  ADD PRIMARY KEY (`kalk_det_id`);

--
-- Indexes for table `kalkulacijemain`
--
ALTER TABLE `kalkulacijemain`
  ADD PRIMARY KEY (`racun_id`);

--
-- Indexes for table `racunidetailed`
--
ALTER TABLE `racunidetailed`
  ADD PRIMARY KEY (`rac_det_id`);

--
-- Indexes for table `racunimain`
--
ALTER TABLE `racunimain`
  ADD PRIMARY KEY (`racun_id`);

--
-- Indexes for table `radnici`
--
ALTER TABLE `radnici`
  ADD PRIMARY KEY (`radnik_id`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`rezervacije_id`);

--
-- Indexes for table `sobatip`
--
ALTER TABLE `sobatip`
  ADD PRIMARY KEY (`tipsobe_id`);

--
-- Indexes for table `sobe`
--
ALTER TABLE `sobe`
  ADD PRIMARY KEY (`sobe_id`);

--
-- Indexes for table `sobestatus`
--
ALTER TABLE `sobestatus`
  ADD PRIMARY KEY (`sst_status_id`);

--
-- Indexes for table `usluge`
--
ALTER TABLE `usluge`
  ADD PRIMARY KEY (`usluge_id`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`radnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dobavljaci`
--
ALTER TABLE `dobavljaci`
  MODIFY `dobavljaci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `domacinstvo`
--
ALTER TABLE `domacinstvo`
  MODIFY `domacinstvo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guests_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `kalkulacijedetailed`
--
ALTER TABLE `kalkulacijedetailed`
  MODIFY `kalk_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1447;

--
-- AUTO_INCREMENT for table `kalkulacijemain`
--
ALTER TABLE `kalkulacijemain`
  MODIFY `racun_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=718;

--
-- AUTO_INCREMENT for table `racunidetailed`
--
ALTER TABLE `racunidetailed`
  MODIFY `rac_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=655;

--
-- AUTO_INCREMENT for table `racunimain`
--
ALTER TABLE `racunimain`
  MODIFY `racun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `radnici`
--
ALTER TABLE `radnici`
  MODIFY `radnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `rezervacije_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `sobatip`
--
ALTER TABLE `sobatip`
  MODIFY `tipsobe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sobe`
--
ALTER TABLE `sobe`
  MODIFY `sobe_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `sobestatus`
--
ALTER TABLE `sobestatus`
  MODIFY `sst_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usluge`
--
ALTER TABLE `usluge`
  MODIFY `usluge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `radnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
