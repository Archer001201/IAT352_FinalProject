-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2023 at 07:19 AM
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
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artifacts`
--

INSERT INTO `artifacts` (`id`, `name`, `image`, `description`) VALUES
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
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `elementType` varchar(20) NOT NULL,
  `region` varchar(20) NOT NULL,
  `characterRarity` varchar(20) NOT NULL,
  `character_weaponType` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `name`, `elementType`, `region`, `characterRarity`, `character_weaponType`, `image`, `description`) VALUES
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
(21, 'Yea Miko', 'Electro', 'Inazuma', '5-star', 3, 'Miko.png', NULL),
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

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`guideID`, `postDate`, `likes`, `favorites`, `characterID`, `userID`, `guideTitle`, `guideDescription`, `bestWeaponID`, `replacementWeaponID`, `artifactID_1`, `artifactID_2`) VALUES
(1, '2023-12-03 05:58:32', 0, 0, 1, 3, 'title', 'guide', 12, 12, 1, 1),
(2, '2023-12-03 06:05:35', 0, 0, 1, 3, 'best guide for Nahida', 'this is the best guide for Nahida', 12, 13, 4, 1),
(3, '2023-12-03 06:07:00', 0, 0, 2, 3, 'My beloved Furina ', 'Best Hydro archon', 4, 2, 3, 4),
(4, '2023-12-03 06:11:37', 0, 0, 2, 3, 'Furina best', 'You are real hydro god', 1, 1, 1, 1),
(5, '2023-12-03 06:13:14', 0, 0, 2, 4, 'haha', 'lala', 1, 1, 1, 1),
(6, '2023-12-03 22:11:06', 0, 0, 13, 4, 'Keqing best', 'Nya Keqing', 1, 1, 1, 1),
(7, '2023-12-03 22:19:43', 0, 0, 1, 4, 'new guide', '', 12, 12, 1, 1),
(8, '2023-12-03 22:19:56', 0, 0, 1, 4, 'nahida', '', 12, 12, 1, 1),
(9, '2023-12-03 22:20:06', 0, 0, 1, 4, 'nice', '', 12, 12, 1, 1),
(10, '2023-12-04 01:10:18', 0, 0, 11, 4, 'nb', 'nb kaeya', 3, 3, 3, 4),
(11, '2023-12-04 02:56:44', 0, 0, 5, 4, 'hhhhhh', '', 25, 25, 1, 1),
(12, '2023-12-04 06:14:10', 0, 0, 1, 4, 'real nahida', 'Nahida\'s best build as a Sub-DPS and Support role will have her use the Deepwood Memories with Elemental Mastery Stats. Your goal should be to get around 800 to 1000 Elemental Mastery on Nahida.\r\n\r\nGenerally, EM Mainstats are her best choice. But since Nahida\'s passive lets any character share their Elemental Mastery with the character on-field, you can also opt to use a Dendro Goblet or a Crit Circlet to increase her damage.\r\n\r\nIt is better to invest in CRIT stats rather than going past 1000 EM since it provides more value.', 14, 12, 1, 1),
(13, '2023-12-04 07:23:05', 0, 0, 1, 4, 'Dendro', 'You won\'t have to focus as much on EM substats for this build since a teammate with a very high EM stat can share their Elemental Mastery with Nahida.\r\n\r\nFor an on-field Main DPS Nahida, her talent priority should have an equal spread for leveling up all three of her talents.\r\n\r\nFor a Sub-DPS and Support Nahida, you need to prioritize leveling her Elemental Skill first since it is the bulk of her damage. Next, you can level up your Elemental Burst while leaving her Normal Attacks for last.', 12, 12, 1, 1),
(14, '2023-12-04 20:52:04', 0, 0, 2, 3, 'fsdhkjfhksjd', 'gsdhjkgfhdskjghkjs', 5, 4, 3, 3),
(15, '2023-12-05 06:47:06', 0, 0, 7, 3, 'gang', '', 18, 18, 1, 1),
(16, '2023-12-06 04:19:34', 0, 0, 8, 3, 'the', '', 37, 35, 1, 1),
(17, '2023-12-06 06:07:48', 0, 0, 8, 3, 'shdjkashdjkhaskj', 'fsdjkgfhahjgsdjyfgjkhasd', 37, 39, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `userName`, `email`, `password`) VALUES
(2, 'Archer', 'zhongchuqiao1201@gmail.com', '$2y$10$k20iROwePOlPYtqy2hJqjuQMAf5jBg0Gy.RALM8u4CbDAG9ryIJPu'),
(3, 'Chuqiao', '2111410956@qq.com', '$2y$10$8Fr2rENWyt/xkGP6VYjLv.fJkqdRKzUz6gyV6uO5fOxG0BdN0qIvC'),
(4, 'freya', '123@qq.com', '$2y$10$Aib6RFotbhU/qhus7Ruja.lf556LMow8YHP/JMqCokZdamFO39ghK');

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
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `weaponRarity` varchar(20) NOT NULL,
  `weapon_weaponType` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weapons`
--

INSERT INTO `weapons` (`id`, `name`, `weaponRarity`, `weapon_weaponType`, `image`, `description`) VALUES
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
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weaponTypes`
--

INSERT INTO `weaponTypes` (`id`, `name`) VALUES
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weaponTypeID` (`character_weaponType`);

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
  ADD PRIMARY KEY (`uid`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `weaponTypeID` (`weapon_weaponType`);

--
-- Indexes for table `weaponTypes`
--
ALTER TABLE `weaponTypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artifacts`
--
ALTER TABLE `artifacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `guideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `weaponTypes`
--
ALTER TABLE `weaponTypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`character_weaponType`) REFERENCES `weaponTypes` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`guideID`) REFERENCES `guides` (`guideID`);

--
-- Constraints for table `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `guides_ibfk_1` FOREIGN KEY (`characterID`) REFERENCES `characters` (`id`),
  ADD CONSTRAINT `guides_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `guides_ibfk_3` FOREIGN KEY (`bestWeaponID`) REFERENCES `weapons` (`id`),
  ADD CONSTRAINT `guides_ibfk_4` FOREIGN KEY (`replacementWeaponID`) REFERENCES `weapons` (`id`),
  ADD CONSTRAINT `guides_ibfk_5` FOREIGN KEY (`artifactID_1`) REFERENCES `artifacts` (`id`),
  ADD CONSTRAINT `guides_ibfk_6` FOREIGN KEY (`artifactID_2`) REFERENCES `artifacts` (`id`);

--
-- Constraints for table `user_favorite`
--
ALTER TABLE `user_favorite`
  ADD CONSTRAINT `user_favorite_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `user_favorite_ibfk_2` FOREIGN KEY (`guideID`) REFERENCES `guides` (`guideID`);

--
-- Constraints for table `weapons`
--
ALTER TABLE `weapons`
  ADD CONSTRAINT `weapons_ibfk_1` FOREIGN KEY (`weapon_weaponType`) REFERENCES `weaponTypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
