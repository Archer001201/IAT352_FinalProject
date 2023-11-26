-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2023 at 05:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genshinGuides`
--

-- --------------------------------------------------------

--
-- Table structure for table `artifacts`
--

CREATE TABLE `artifacts` (
  `artifactID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artifacts`
--

INSERT INTO `artifacts` (`artifactID`, `name`, `image`, `description`) VALUES
(1, 'Maiden Beloved', 'MaidenBeloved.png', NULL),
(2, 'Thundersoother', 'Thundersoother.png', NULL),
(3, 'Blizzard Strayer', 'BlizzardStrayer.png', NULL),
(4, 'Gladiator\'s Finale', 'GladiatorsFinale.png', NULL),
(5, 'Wanderer\'s Troupe', 'WanderersTroupe.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `characterID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `elementType` varchar(20) NOT NULL,
  `region` varchar(20) NOT NULL,
  `rarity` varchar(20) NOT NULL,
  `weaponTypeID` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`characterID`, `name`, `elementType`, `region`, `rarity`, `weaponTypeID`, `image`, `description`) VALUES
(1, 'Nahida', 'Dendro', 'Sumeru', '5-star', 3, 'Nahida.png', NULL),
(2, 'Furina', 'Hydro', 'Fontaine', '5-star', 1, 'Furina.png', NULL),
(3, 'Jean', 'Anemo', 'Mondstadt', '5-star', 1, 'Jean.png', NULL),
(4, 'Barbara', 'Hydro', 'Mondstadt', '4-star', 3, 'Barbara.png', NULL),
(5, 'Noelle', 'Geo', 'Mondstadt', '4-star', 2, 'Noelle.png', NULL),
(6, 'Fischl', 'Electro', 'Mondstadt', '4-star', 5, 'Fischl.png', NULL),
(7, 'Ganyu', 'Cyro', 'Liyue', '5-star', 5, 'Ganyu.png', NULL),
(8, 'Xiao', 'Anemo', 'Liyue', '5-star', 4, 'Xiao.png', NULL),
(9, 'Kaedehara Kazuha', 'Anemo', 'Inazuma', '5-star', 1, 'KaedeharaKazuha.png', NULL),
(10, 'Wanderer', 'Anemo', 'Inazuma', '5-star', 3, 'Wanderer.png', NULL),
(11, 'Kaeya', 'Cyro', 'Mondstadt', '4-star', 1, 'Kaeya.png', NULL),
(12, 'Hu Tao', 'Pyro', 'Liyue', '5-star', 4, 'HuTao.png', NULL),
(13, 'Keqing', 'Electro', 'Liyue', '5-star', 1, 'Keqing.png', NULL),
(14, 'Yun Jin', 'Geo', 'Liyue', '4-star', 4, 'YunJin.png', NULL),
(15, 'RaidenShogun', 'Electro', 'Inazuma', '5-star', 4, 'RaidenShogun.png', NULL),
(16, 'Kamisato Ayaka', 'Cyro', 'Inazuma', '5-star', 1, 'Ayaka.png', NULL),
(17, 'Sangonomiya Kokomi', 'Hydro', 'Inazuma', '5-star', 3, 'kokomi.png', NULL),
(18, 'Lisa', 'Electro', 'Mondstadt', '4-star', 3, 'Lisa.png', NULL),
(19, 'Bennett', 'Pyro', 'Mondstadt', '4-star', 1, 'Bennett.png', NULL),
(20, 'Xingqiu', 'Hydro', 'Liyue', '4-star', 1, 'Xingqiu.png', NULL),
(21, '', 'Electro', 'Inazuma', '5-star', 3, 'Miko.png', NULL),
(22, 'Nilou', 'Hydro', 'Sumeru', '5-star', 1, 'Nilou.png', NULL),
(23, 'Arataki Itto', 'Geo', 'Inazuma', '5-star', 2, 'AratakiItto.png', NULL),
(24, 'Thoma', 'Pyro', 'Inazuma', '4-star', 4, 'Thoma.png', NULL),
(25, 'Collei', 'Dendro', 'Sumeru', '4-star', 5, 'Collei.png', NULL),
(26, 'Yaoyao', 'Dendro', 'Liyue', '4-star', 4, 'Yaoyao.png', NULL),
(27, 'Klee', 'Pyro', 'Mondstadt', '5-star', 3, 'Klee.png', NULL),
(28, 'Diluc', 'Pyro', 'Mondstadt', '5-star', 2, 'Diluc.png', NULL),
(29, 'Xiangling', 'Pyro', 'Liyue', '4-star', 4, 'Xiangling.png', NULL),
(30, 'Mika', 'Cyro', 'Mondstadt', '4-star', 4, 'Mika.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `text` text DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `userID` int(11) DEFAULT NULL,
  `guideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `guideID` int(11) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `favorites` int(11) DEFAULT 0,
  `characterID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `guideTitle` varchar(255) NOT NULL,
  `guideDescription` text DEFAULT NULL,
  `bestWeaponID` int(11) DEFAULT NULL,
  `replacementWeaponID` int(11) DEFAULT NULL,
  `artifactID_1` int(11) DEFAULT NULL,
  `artifactID_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_favorite`
--

CREATE TABLE `user_favorite` (
  `userID` int(11) DEFAULT NULL,
  `guideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weapons`
--

CREATE TABLE `weapons` (
  `weaponID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `weaponRarity` varchar(20) NOT NULL,
  `weaponTypeID` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weapons`
--

INSERT INTO `weapons` (`weaponID`, `name`, `weaponRarity`, `weaponTypeID`, `image`, `description`) VALUES
(1, 'Harbinger of Dawn', '3-star', 1, 'HarbingerOfDawn.png', NULL),
(2, 'Sacrificial Sword', '4-star', 1, 'SacrificialSword.png', NULL),
(3, 'Freedom-Sword', '5-star', 1, 'FreedomSword.png', NULL),
(4, 'Primordial Jade Cutter', '5-star', 1, 'PrimordialJadeCutter.png', NULL),
(5, 'Lion\'s Roar', '4-star', 1, 'LionsRoar.png', NULL),
(6, 'Prototype Rancour', '4-star', 1, 'PrototypeRancour.png', NULL),
(7, 'Aqulia Favonia', '5-star', 1, 'AquliaFavonia.png', NULL),
(8, 'Iron Sting', '4-star', 1, 'IronSting.png', NULL),
(9, 'Amenoma Kageuchi', '4-star', 1, 'AmenomaKageuchi.png', NULL),
(10, 'Favonius Sword', '4-star', 1, 'FavoniusSword.png', NULL),
(11, 'Fillet Blade', '3-star', 1, 'FilletBlade.png', NULL),
(12, 'Everlasting Moonglow', '5-star', 3, 'EverlastingMoonglow.png', NULL),
(13, 'Solar Pearl', '4-star', 3, 'SolarPearl.png', NULL),
(14, 'The Widsith', '4-star', 3, 'TheWidsith.png', NULL),
(15, 'Favonius Codex', '4-star', 3, 'FavoniusCodex.png', NULL),
(16, 'Twin Nephrite', '3-star', 3, 'TwinNephrite.png', NULL),
(17, 'Skyward Atlas', '5-star', 3, 'SkywardAtlas.png', NULL),
(18, 'Amo\'s Bow', '5-star', 5, 'AmosBow.png', NULL),
(19, 'Elegy for theEnd', '5-star', 5, 'ElegyForTheEnd.png', NULL),
(20, 'Rust', '4-star', 5, 'Rust.png', NULL),
(21, 'The Stringless', '4-star', 5, 'TheStringless.png', NULL),
(22, 'Skyward Harp', '5-star', 5, 'SkywardHarp.png', NULL),
(23, 'Raven Bow', '3-star', 5, 'RavenBow.png', NULL),
(24, 'Sacrificial Bow', '4-star', 5, 'SacrificialBow.png', NULL),
(25, 'Skyward Pride', '5-star', 2, 'SkywardPride.png', NULL),
(26, 'Song of Broken Pines', '5-star', 2, 'SongOfBrokenPines.png', NULL),
(27, 'Wolf\'s Gravestone', '5-star', 2, 'WolfsGravestone.png', NULL),
(28, 'Rainslasher', '4-star', 2, 'Rainslasher.png', NULL),
(29, 'Debate Club', '3-star', 2, 'DebateClub.png', NULL),
(30, 'Whiteblind', '4-star', 2, 'Whiteblind.png', NULL),
(31, 'The Bell', '4-star', 2, 'TheBell.png', NULL),
(32, 'Favoinius Greatsword', '4-star', 2, 'FavoiniusGreatsword.png', NULL),
(33, 'Ferrous Shadow', '3-star', 2, 'FerrousShadow.png', NULL),
(34, 'Prototype Archaic', '4-star', 2, 'PrototypeArchaic.png', NULL),
(35, 'Primordial Jade', '5-star', 4, 'PrimordialJade.png', NULL),
(36, 'Vortext Vanguisher', '5-star', 4, 'VortextVanguisher.png', NULL),
(37, 'Dragon\'s Bane', '4-star', 4, 'DragonsBane.png', NULL),
(38, 'White Tassel', '3-star', 4, 'WhiteTassel.png', NULL),
(39, 'Favonius Lance', '4-star', 4, 'FavoniusLance.png', NULL),
(40, 'Halberd', '3-star', 4, 'Halberd.png', NULL),
(41, 'Blackcliff Pole', '4-star', 4, 'BlackcliffPole.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weaponTypes`
--

CREATE TABLE `weaponTypes` (
  `weaponTypeID` int(11) NOT NULL,
  `weaponTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weaponTypes`
--

INSERT INTO `weaponTypes` (`weaponTypeID`, `weaponTypeName`) VALUES
(1, 'Sword'),
(2, 'Claymore'),
(3, 'Catalyst'),
(4, 'Polearm'),
(5, 'Bow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artifacts`
--
ALTER TABLE `artifacts`
  ADD PRIMARY KEY (`artifactID`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`characterID`),
  ADD KEY `weaponTypeID` (`weaponTypeID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `guideID` (`guideID`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`guideID`),
  ADD KEY `characterID` (`characterID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bestWeaponID` (`bestWeaponID`),
  ADD KEY `replacementWeaponID` (`replacementWeaponID`),
  ADD KEY `artifactID_1` (`artifactID_1`),
  ADD KEY `artifactID_2` (`artifactID_2`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_favorite`
--
ALTER TABLE `user_favorite`
  ADD KEY `userID` (`userID`),
  ADD KEY `guideID` (`guideID`);

--
-- Indexes for table `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`weaponID`),
  ADD KEY `weaponTypeID` (`weaponTypeID`);

--
-- Indexes for table `weaponTypes`
--
ALTER TABLE `weaponTypes`
  ADD PRIMARY KEY (`weaponTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artifacts`
--
ALTER TABLE `artifacts`
  MODIFY `artifactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `characterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `guideID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `weaponID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `weaponTypes`
--
ALTER TABLE `weaponTypes`
  MODIFY `weaponTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`weaponTypeID`) REFERENCES `weaponTypes` (`weaponTypeID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`guideID`) REFERENCES `guides` (`guideID`);

--
-- Constraints for table `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `guides_ibfk_1` FOREIGN KEY (`characterID`) REFERENCES `characters` (`characterID`),
  ADD CONSTRAINT `guides_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `guides_ibfk_3` FOREIGN KEY (`bestWeaponID`) REFERENCES `weapons` (`weaponID`),
  ADD CONSTRAINT `guides_ibfk_4` FOREIGN KEY (`replacementWeaponID`) REFERENCES `weapons` (`weaponID`),
  ADD CONSTRAINT `guides_ibfk_5` FOREIGN KEY (`artifactID_1`) REFERENCES `artifacts` (`artifactID`),
  ADD CONSTRAINT `guides_ibfk_6` FOREIGN KEY (`artifactID_2`) REFERENCES `artifacts` (`artifactID`);

--
-- Constraints for table `user_favorite`
--
ALTER TABLE `user_favorite`
  ADD CONSTRAINT `user_favorite_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `user_favorite_ibfk_2` FOREIGN KEY (`guideID`) REFERENCES `guides` (`guideID`);

--
-- Constraints for table `weapons`
--
ALTER TABLE `weapons`
  ADD CONSTRAINT `weapons_ibfk_1` FOREIGN KEY (`weaponTypeID`) REFERENCES `weaponTypes` (`weaponTypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
