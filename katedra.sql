-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 06:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katedra`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tip` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `password`, `tip`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', '1'),
(4, 'test2', 'ad0234829205b9033196ba818f7a872b', '2'),
(5, 'tstudent', '0dfc4a2a56999a5cff58314eaef63896', '3');

-- --------------------------------------------------------

--
-- Table structure for table `materijali`
--

CREATE TABLE `materijali` (
  `id` int(11) NOT NULL,
  `id_predmeta` int(11) NOT NULL,
  `id_nastavnika` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL,
  `file` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `obavestenje`
--

CREATE TABLE `obavestenje` (
  `id` int(11) NOT NULL,
  `id_predmeta` int(11) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `sadrzaj` text NOT NULL,
  `datum_objave` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obavestenje`
--

INSERT INTO `obavestenje` (`id`, `id_predmeta`, `naslov`, `sadrzaj`, `datum_objave`) VALUES
(1, 1, 'Naslov', '<p>sadrzaj.........</p>\r\n', '2021-05-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `id` int(11) NOT NULL,
  `id_nastavnik` int(11) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `tip` varchar(20) NOT NULL,
  `sifra` varchar(20) NOT NULL,
  `espb` int(10) NOT NULL,
  `cilj_i_ishod_predmeta` text NOT NULL,
  `fond_casova` int(2) NOT NULL,
  `termini` text NOT NULL,
  `komentar` text DEFAULT NULL,
  `studije` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`id`, `id_nastavnik`, `ime`, `tip`, `sifra`, `espb`, `cilj_i_ishod_predmeta`, `fond_casova`, `termini`, `komentar`, `studije`) VALUES
(1, 1, 'Uvod u elektroniku', '1', 'ОС4ИП', 6, 'Cilj i ishod predmeta.....', 40, 'Termini.....', 'Komentar.....', 1),
(2, 2, 'Fizika', '1', 'OS4RT', 4, '<p>ASDOASD sdasd&nbsp; saf</p>\r\n', 22, '<p>TERMINI</p>\r\n', '<p>KOMENTAR,,,</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `indeks` varchar(100) NOT NULL,
  `tip_studija` varchar(1) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `id_korisnika`, `indeks`, `tip_studija`, `ime`, `prezime`, `status`) VALUES
(1, 0, 'GGGG/BBBB', 'd', 'testStudent', 'testStudentPrezime', '1'),
(2, 5, 'ggg/bbb', 'm', 'sIme', 'sPrezime', '1');

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `id` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `adresa` varchar(200) NOT NULL,
  `broj_telefona` varchar(20) DEFAULT NULL,
  `veb_sajt` varchar(200) DEFAULT NULL,
  `licni_podaci` text DEFAULT NULL,
  `zvanje` varchar(50) NOT NULL,
  `broj_kabineta` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `slika` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`id`, `id_korisnika`, `ime`, `prezime`, `adresa`, `broj_telefona`, `veb_sajt`, `licni_podaci`, `zvanje`, `broj_kabineta`, `status`, `slika`) VALUES
(1, 1, 'Petar', 'Petrovic', 'Ulica br 1', '0641111111', 'http://google.com', 'Prostor za licne podatke.....', 'лабораторијски инжењер', 11, '1', 'osoba.jpg'),
(2, 4, 'Ime2', 'Prezime2', 'dgrgbr', '42671', 'bthyab.com', '<p>beayrnr rtasgtr</p>\r\n', 'ванредни професор', 5, '1', '1621502802_2417.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materijali`
--
ALTER TABLE `materijali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obavestenje`
--
ALTER TABLE `obavestenje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materijali`
--
ALTER TABLE `materijali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obavestenje`
--
ALTER TABLE `obavestenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
