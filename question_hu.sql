-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2020. Jan 20. 14:01
-- Kiszolgáló verziója: 5.7.26
-- PHP verzió: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `quiz`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `question_hu`
--

DROP TABLE IF EXISTS `question_hu`;
CREATE TABLE IF NOT EXISTS `question_hu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `difficulty` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `question_hu`
--

INSERT INTO `question_hu` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `difficulty`) VALUES
(1, 'Hány fokon fagy a víz?', '0', '-1', '2', '-4', '0', 1),
(2, 'Melyik évben csatlakozott Magyarország az Európai Unióhoz?', '2004', '2006', '2002', '2007', '2004', 1),
(3, 'Melyik folyó szeli át Londont?', 'Temze', 'Severn', 'Mersey', 'Trent', 'Temze', 1),
(4, 'Hogy hívják Pumukli háziurát?', 'Éder', 'Elek', 'Endre', 'Ede', 'Éder', 1),
(5, 'Hogy hívják angliában a hasábburgonyát?', 'Chips', 'Fries', 'Pommes Frites', 'McPom', 'Chips', 1),
(6, 'Melyik épület ezek közül a legmagasabb?', 'Burdzs Kalifa', 'Shanghai Tower', 'One World Trade Center', 'Tokyo Skytree', 'Burdzs Kalifa', 2),
(7, 'A világ népességének hány százaléka balkezes?', 'Kb. 8-15%', 'Kb. 0-8%', 'Kb. 15-20%', 'Kb. 20-30%', 'Kb. 8-15%', 2),
(8, 'Ki számít a logika atyjának?', 'Arisztotelész', 'John Locke', 'Parmenidész', 'Platón', 'Arisztotelész', 2),
(9, 'Ki kapta az első orvostudományi Nobel-díjat? (1901)', 'Louis Pasteur', 'Robert Koch', 'Semmelweis Ignác', 'Emil von Behring', 'Emil von Behring', 2),
(10, 'Hányszor költenek a galambok egy évben?', 'Maximum 5 alkalommal', 'Maximum 6 alkalommal', 'Maximum 7 alkalommal', 'Maximum 8 alkalommal', 'Maximum 5 alkalommal', 3),
(11, 'Legalább hány csápja van egy tintahalnak?', 'Négy', 'Hat', 'Tíz', 'Nyolc', 'Nyolc', 3),
(12, 'Hogy hívják a medvét a Dzsungel könyvében?', 'Balu', 'Babu', 'Timon', 'Pumba', 'Balu', 1),
(13, 'Melyik írott nyelv használja az ö és ü betűket, de ä-t nem?', 'Svéd', 'Török', 'Német', 'Finn', 'Török', 3),
(14, 'Melyik napon van Valentin-nap?', 'Február 14.', 'Február 4.', 'Március 14.', 'Március 8.', 'Február 14.', 1),
(15, 'Mi a legegyszerűbb telített szénhidrogén?', 'Metán', 'Grafit', 'Bután', 'Propán', 'Metán', 3),
(16, 'Milyen állat a cerkóf?', 'Medve', 'Madár', 'Majom', 'Hal', 'Majom', 2),
(17, 'Hogyan nevezik az ember legnagyobb erét?', 'Aorta', 'Artéria', 'Véna', 'Koszorúér', 'Aorta', 2),
(18, 'Melyik amerikai ország a legnagyobb területű?', 'USA', 'Kanada', 'Brazília', 'Argentína', 'Kanada', 2),
(19, 'Melyik hegy nem vulkán az alábbiak közül?', 'Stromboli', 'Agung', 'Matterhorn', 'Erebus', 'Matterhorn', 3),
(20, 'Mi Burkina Faso fővárosa?', 'Ouagadougou', 'Yamoussoukrou', 'Bulawayo', 'Niamey', 'Ouagadougou', 3),
(21, 'Melyik autóipari vállalat kezdett el először autót gyártani futószalagon?', 'Ford', 'Opel', 'Honda', 'Volkswagen', 'Ford', 2),
(22, 'Ezen képregényhősök közül melyiknek nincsenek emberfeletti képességei?', 'Szupermen', 'Ultraman', 'Pókember', 'Batman', 'Batman', 1),
(23, 'Melyik hegy nem Európában található?', 'Monte Rosa', 'Triglav', 'Piz Bernina', 'Ojos del Salado', 'Ojos del Salado', 3),
(24, 'Melyik csatornát nem mesterségesen hozták létre?', 'Panama-csatorna', 'La Manche', 'Szuezi-csatorna', 'Dortmund-Ems-csatorna', 'La Manche', 2),
(25, 'A labdarúgás olimpiai sportág...', '1896 óta', '1900 óta', '1904 óta', '1908 óta', '1896 óta', 3),
(26, 'Mitől való félelem az arachnofóbia?', 'Pókók', 'Kígyók', 'Skorpiók', 'Denevérek', 'Pókok', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
