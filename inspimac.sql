-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 30, 2020 at 11:59 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspimac`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `idCategorie` int(10) NOT NULL,
  `nomCategorie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Musique'),
(2, 'Film'),
(3, 'Serie');

-- --------------------------------------------------------

--
-- Table structure for table `Oeuvres`
--

CREATE TABLE `Oeuvres` (
  `idOeuvre` int(10) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `auteur` varchar(30) NOT NULL,
  `lien` varchar(300) NOT NULL,
  `idCategorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Oeuvres`
--

INSERT INTO `Oeuvres` (`idOeuvre`, `titre`, `auteur`, `lien`, `idCategorie`) VALUES
(1, '잘나가서 그래', 'Hyuna', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ib_1ATfr8wM\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(2, 'Kill this love', 'BlackPink', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2S24-y0Ij3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(3, 'Drink', 'Cyn', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/YQbpkaTIQ2M\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(4, 'Sense 8', 'Netflix', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/iKpKAlbJ7BQ\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 3),
(5, 'Atomic Blonde', 'David Leitch', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/IIdNnNm6nvE\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2),
(6, 'Friends', 'David Crane', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/7z65wK5kgOY\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 3),
(7, 'Russian Dolls', 'Netflix', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/YHcKoAMGGvY\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 3),
(8, 'Ain t my fault', 'Zara Larsson', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/eC-F_VZ2T1c\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(9, 'Pentagon Papers', 'Steven Spielberg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/YyxAVB6wXW4\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2),
(10, 'Atypical', 'Netflix', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/WtVxpDcSGw8\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2),
(11, 'Soleil', 'Roméo Elvis', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JmIPRfMhzlM\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(12, 'Let me get me', 'Selena Gomez', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/tvW_QrDigWA\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Publications`
--

CREATE TABLE `Publications` (
  `idPublication` int(11) NOT NULL,
  `nbLike` int(11) NOT NULL,
  `date` date NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idOeuvre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Publications`
--

INSERT INTO `Publications` (`idPublication`, `nbLike`, `date`, `idCategorie`, `idUtilisateur`, `idOeuvre`) VALUES
(1, 1, '2020-05-31', 1, 4, 1),
(2, 0, '2020-05-30', 1, 3, 2),
(3, 0, '2020-05-30', 1, 4, 3),
(4, 0, '2020-05-31', 3, 2, 4),
(5, 0, '2020-05-31', 2, 1, 5),
(6, 10, '2020-05-31', 3, 2, 6),
(7, 0, '2020-05-30', 3, 4, 7),
(8, 0, '2020-05-30', 1, 3, 8),
(9, 0, '2020-05-30', 2, 5, 9),
(10, 0, '2020-05-30', 3, 4, 10),
(11, 0, '2020-05-30', 1, 1, 11),
(12, 0, '2020-05-30', 1, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUtilisateur`, `nom`, `prenom`) VALUES
(1, 'Aubert', 'Aloïs'),
(2, 'Huvier', 'Clothilde'),
(3, 'Dupuydenus', 'Nelly'),
(4, 'Gaillard', 'Loona'),
(5, 'Aubert', 'Alois');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `Oeuvres`
--
ALTER TABLE `Oeuvres`
  ADD PRIMARY KEY (`idOeuvre`);

--
-- Indexes for table `Publications`
--
ALTER TABLE `Publications`
  ADD PRIMARY KEY (`idPublication`);

--
-- Indexes for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `idCategorie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Oeuvres`
--
ALTER TABLE `Oeuvres`
  MODIFY `idOeuvre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Publications`
--
ALTER TABLE `Publications`
  MODIFY `idPublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
