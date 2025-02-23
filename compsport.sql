SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compsport`
--

-- --------------------------------------------------------

--
-- Table structure for table `competitii`
--

CREATE TABLE `competitii` (
  `ID_Competitie` int(11) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Data_incepere` date NOT NULL,
  `Data_incheriere` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitii`
--

INSERT INTO `competitii` (`ID_Competitie`, `Nume`, `Data_incepere`, `Data_incheriere`) VALUES
(1, 'Cupa Nationala', '2024-01-15', '2024-02-15'),
(2, 'Liga Campionilor', '2024-03-01', '2024-04-01'),
(3, 'Campionatul Regional', '2024-05-10', '2024-06-10'),
(4, 'Turneu de Primavara', '2024-04-10', '2024-05-10'),
(5, 'Cupa de Vara', '2024-06-15', '2024-07-15'),
(6, 'Liga de Toamna', '2024-09-01', '2024-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `competitii_locatii`
--

CREATE TABLE `competitii_locatii` (
  `ID_Competitie` int(11) NOT NULL,
  `ID_Locatie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitii_locatii`
--

INSERT INTO `competitii_locatii` (`ID_Competitie`, `ID_Locatie`) VALUES
(1, 1),
(2, 2),
(4, 3),
(5, 2),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `competitii_sporturi`
--

CREATE TABLE `competitii_sporturi` (
  `ID_Competitie` int(11) NOT NULL,
  `ID_Sport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitii_sporturi`
--

INSERT INTO `competitii_sporturi` (`ID_Competitie`, `ID_Sport`) VALUES
(1, 1),
(2, 2),
(4, 3),
(5, 2),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `echipe`
--

CREATE TABLE `echipe` (
  `ID_Echipa` int(11) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Data_fondare` date DEFAULT NULL,
  `Antrenor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `echipe`
--

INSERT INTO `echipe` (`ID_Echipa`, `Nume`, `Data_fondare`, `Antrenor`) VALUES
(1, 'Echipa A', '2005-05-20', 'Antrenor A'),
(2, 'Echipa B', '2010-10-15', 'Antrenor B'),
(3, 'Echipa C', '2015-08-05', 'Antrenor C'),
(4, 'Echipa D', '2008-03-10', 'Antrenor D'),
(5, 'Echipa E', '2012-11-25', 'Antrenor E'),
(11, '1234', '2025-01-31', 'Rabc'),
(12, 'Echipa F', '2016-08-17', 'Antrenor F');

-- --------------------------------------------------------

--
-- Table structure for table `jucatori`
--

CREATE TABLE `jucatori` (
  `ID_Jucator` int(11) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Data_nasterii` date DEFAULT NULL,
  `ID_Echipa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jucatori`
--

INSERT INTO `jucatori` (`ID_Jucator`, `Nume`, `Data_nasterii`, `ID_Echipa`) VALUES
(1, 'Jucator 1', '1990-07-15', 1),
(2, 'Jucator 2', '1992-04-25', 1),
(3, 'Jucator 3', '1995-12-12', 2),
(4, 'Jucator 4', '1997-03-10', 2),
(5, 'Jucator 5', '1998-09-18', 3),
(6, 'Jucator 6', '1993-11-21', 4),
(7, 'Jucator 7', '2007-01-04', 2);

-- --------------------------------------------------------

--
-- Table structure for table `locatii`
--

CREATE TABLE `locatii` (
  `ID_Locatie` int(11) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Adresa` varchar(200) DEFAULT NULL,
  `Cod_Postal` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locatii`
--

INSERT INTO `locatii` (`ID_Locatie`, `Nume`, `Adresa`, `Cod_Postal`) VALUES
(1, 'Stadion National', 'Strada Mare 10', '123456'),
(2, 'Sala Polivalenta', 'Strada Sportului 5', '654321'),
(3, 'Arena Centrala', 'Strada Centrala 1', '111111'),
(4, 'Sala Sporturilor', 'Bulevardul Sportiv 12', '222222'),
(5, 'Teren Municipal', 'Strada Campului 9', '333333');

-- --------------------------------------------------------

--
-- Table structure for table `meciuri`
--

CREATE TABLE `meciuri` (
  `ID_Meci` int(11) NOT NULL,
  `ID_Competitie` int(11) DEFAULT NULL,
  `ID_Echipa1` int(11) DEFAULT NULL,
  `ID_Echipa2` int(11) DEFAULT NULL,
  `ID_Locatie` int(11) DEFAULT NULL,
  `Data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meciuri`
--

INSERT INTO `meciuri` (`ID_Meci`, `ID_Competitie`, `ID_Echipa1`, `ID_Echipa2`, `ID_Locatie`, `Data`) VALUES
(1, 1, 1, 2, 1, '2024-01-20'),
(2, 2, 2, 3, 2, '2024-03-05'),
(3, 4, 4, 5, 3, '2024-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `rezultate`
--

CREATE TABLE `rezultate` (
  `ID_Rezultat` int(11) NOT NULL,
  `ID_Meci` int(11) DEFAULT NULL,
  `Scor_Echipa1` int(11) DEFAULT NULL,
  `Scor_Echipa2` int(11) DEFAULT NULL,
  `Echipa_Castigatoare` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezultate`
--

INSERT INTO `rezultate` (`ID_Rezultat`, `ID_Meci`, `Scor_Echipa1`, `Scor_Echipa2`, `Echipa_Castigatoare`) VALUES
(1, 1, 3, 1, 1),
(2, 2, 2, 2, NULL),
(3, 3, 2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sporturi`
--

CREATE TABLE `sporturi` (
  `ID_Sport` int(11) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Tip_Minge` varchar(50) DEFAULT NULL,
  `Tip_Sport` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sporturi`
--

INSERT INTO `sporturi` (`ID_Sport`, `Nume`, `Tip_Minge`, `Tip_Sport`) VALUES
(1, 'Fotbal', 'Minge de Fotbal', 'Echipa'),
(2, 'Baschet', 'Minge de Baschet', 'Echipa'),
(3, 'Tenis', 'Minge de Tenis', 'Individual'),
(4, 'Volei', 'Minge de Volei', 'Echipa'),
(5, 'Handbal', 'Minge de Handbal', 'Echipa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Email`, `Password`) VALUES
(1, 'john_doe', 'john.doe@example.com', '482c811da5d5b4bc6d497ffa98491e38'),
(2, 'jane_doe', 'jane.doe@example.com', '34819d7beeabb9260a5c854bc85b3e44'),
(3, 'alex_smith', 'alex.smith@example.com', 'b3d34352fc26117979deabdf1b9b6354'),
(4, 'emily_jones', 'emily.jones@example.com', 'bb77d0d3b3f239fa5db73bdf27b8d29a'),
(5, 'michael_brown', 'michael.brown@example.com', '0192023a7bbd73250516f069df18b500'),
(6, 'ion_daniel', 'ion_dan@gmail.com', '7315de75b6992d9eb6f64589aa691b0c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitii`
--
ALTER TABLE `competitii`
  ADD PRIMARY KEY (`ID_Competitie`);

--
-- Indexes for table `competitii_locatii`
--
ALTER TABLE `competitii_locatii`
  ADD PRIMARY KEY (`ID_Competitie`,`ID_Locatie`),
  ADD KEY `ID_Locatie` (`ID_Locatie`);

--
-- Indexes for table `competitii_sporturi`
--
ALTER TABLE `competitii_sporturi`
  ADD PRIMARY KEY (`ID_Competitie`,`ID_Sport`),
  ADD KEY `ID_Sport` (`ID_Sport`);

--
-- Indexes for table `echipe`
--
ALTER TABLE `echipe`
  ADD PRIMARY KEY (`ID_Echipa`);

--
-- Indexes for table `jucatori`
--
ALTER TABLE `jucatori`
  ADD PRIMARY KEY (`ID_Jucator`),
  ADD KEY `ID_Echipa` (`ID_Echipa`);

--
-- Indexes for table `locatii`
--
ALTER TABLE `locatii`
  ADD PRIMARY KEY (`ID_Locatie`);

--
-- Indexes for table `meciuri`
--
ALTER TABLE `meciuri`
  ADD PRIMARY KEY (`ID_Meci`),
  ADD KEY `ID_Competitie` (`ID_Competitie`),
  ADD KEY `ID_Echipa1` (`ID_Echipa1`),
  ADD KEY `ID_Echipa2` (`ID_Echipa2`),
  ADD KEY `fk_meciuri_locatii` (`ID_Locatie`);

--
-- Indexes for table `rezultate`
--
ALTER TABLE `rezultate`
  ADD PRIMARY KEY (`ID_Rezultat`),
  ADD KEY `ID_Meci` (`ID_Meci`),
  ADD KEY `Echipa_Castigatoare` (`Echipa_Castigatoare`);

--
-- Indexes for table `sporturi`
--
ALTER TABLE `sporturi`
  ADD PRIMARY KEY (`ID_Sport`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competitii`
--
ALTER TABLE `competitii`
  MODIFY `ID_Competitie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `echipe`
--
ALTER TABLE `echipe`
  MODIFY `ID_Echipa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jucatori`
--
ALTER TABLE `jucatori`
  MODIFY `ID_Jucator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `locatii`
--
ALTER TABLE `locatii`
  MODIFY `ID_Locatie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meciuri`
--
ALTER TABLE `meciuri`
  MODIFY `ID_Meci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rezultate`
--
ALTER TABLE `rezultate`
  MODIFY `ID_Rezultat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sporturi`
--
ALTER TABLE `sporturi`
  MODIFY `ID_Sport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competitii_locatii`
--
ALTER TABLE `competitii_locatii`
  ADD CONSTRAINT `competitii_locatii_ibfk_1` FOREIGN KEY (`ID_Competitie`) REFERENCES `competitii` (`ID_Competitie`) ON DELETE CASCADE,
  ADD CONSTRAINT `competitii_locatii_ibfk_2` FOREIGN KEY (`ID_Locatie`) REFERENCES `locatii` (`ID_Locatie`) ON DELETE CASCADE;

--
-- Constraints for table `competitii_sporturi`
--
ALTER TABLE `competitii_sporturi`
  ADD CONSTRAINT `competitii_sporturi_ibfk_1` FOREIGN KEY (`ID_Competitie`) REFERENCES `competitii` (`ID_Competitie`) ON DELETE CASCADE,
  ADD CONSTRAINT `competitii_sporturi_ibfk_2` FOREIGN KEY (`ID_Sport`) REFERENCES `sporturi` (`ID_Sport`) ON DELETE CASCADE;

--
-- Constraints for table `jucatori`
--
ALTER TABLE `jucatori`
  ADD CONSTRAINT `jucatori_ibfk_1` FOREIGN KEY (`ID_Echipa`) REFERENCES `echipe` (`ID_Echipa`) ON DELETE CASCADE;

--
-- Constraints for table `meciuri`
--
ALTER TABLE `meciuri`
  ADD CONSTRAINT `fk_meciuri_locatii` FOREIGN KEY (`ID_Locatie`) REFERENCES `locatii` (`ID_Locatie`) ON DELETE CASCADE,
  ADD CONSTRAINT `meciuri_ibfk_1` FOREIGN KEY (`ID_Competitie`) REFERENCES `competitii` (`ID_Competitie`) ON DELETE CASCADE,
  ADD CONSTRAINT `meciuri_ibfk_2` FOREIGN KEY (`ID_Echipa1`) REFERENCES `echipe` (`ID_Echipa`) ON DELETE CASCADE,
  ADD CONSTRAINT `meciuri_ibfk_3` FOREIGN KEY (`ID_Echipa2`) REFERENCES `echipe` (`ID_Echipa`) ON DELETE CASCADE;

--
-- Constraints for table `rezultate`
--
ALTER TABLE `rezultate`
  ADD CONSTRAINT `rezultate_ibfk_1` FOREIGN KEY (`ID_Meci`) REFERENCES `meciuri` (`ID_Meci`) ON DELETE CASCADE,
  ADD CONSTRAINT `rezultate_ibfk_2` FOREIGN KEY (`Echipa_Castigatoare`) REFERENCES `echipe` (`ID_Echipa`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
