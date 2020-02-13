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
-- Tábla szerkezet ehhez a táblához `question_de`
--

DROP TABLE IF EXISTS `question_de`;
CREATE TABLE IF NOT EXISTS `question_de` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `difficulty` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `question_de`
--

INSERT INTO `question_de` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `difficulty`) VALUES
(7, 'Nach wie vielen Sekunden ist eine Stunde vergangen', '3600', '60', '600', '1000', '3600', 1),
(2, 'Wer schön sein will, muss...', 'lernen', 'schreien', 'leiden', 'kämpfen', 'leiden', 1),
(3, 'Welcher Fluss fließt durch London', 'Kennste', 'Neckar', 'Themse', 'Bremse', 'Themse', 1),
(5, 'Wie heißt der Meister von Pumuckl', 'Nudelhaar', 'Lampe', 'Kohl', 'Eder', 'Eder', 1),
(6, 'Bei wieviel Grad gefriert Wasser', '0', '+1', '-2', '-4', '0', 1),
(8, 'Wie heißt der Bär aus dem Dschungelbuch', 'Balu', 'Blau', 'Baschu', 'Babu', 'Balu', 1),
(9, 'Wann ist der Valentinstag', '14. Februar', '16. Februar', '4. März', '7. Februar', '14. Februar', 1),
(10, 'Welche Farbe haben Marge Simpsons Haare', 'Grün', 'Lila', 'Blau', 'Gelb', 'Blau', 1),
(11, 'Wie nennt Man die Pommes Frites in England', 'Crisps', 'Fried Potatoes', 'McPom', 'Chips', 'Chips', 1),
(12, 'Wo befindet sich der Elisabeth Tower?', 'London', 'Budapest', 'Wien', 'Paris', 'London', 2),
(13, 'Womit beginnen viele Opern?', 'Maniküre', 'Ouvertüre', 'Valküre', 'Kouvertüre', 'Ouvertüre', 2),
(14, 'Was ist Arachnophobie?', 'Angst vor Spinnen', 'Angst vor Katzen', 'Angst vor Fledermäusen', 'Angst vor Vögeln', 'Angst vor Spinnen', 2),
(15, 'Welche Blume hat ihren Namen vom lateinischen Wort für einen Wolf?', 'Lupine', 'Arnika', 'Calla', 'Kadupul', 'Lupine', 3),
(16, 'Wie heißt der einfachste gesättigte Kohlenwasserstoff?', 'Methan', 'Graphit', 'Chloroform', 'Butan', 'Methan', 3),
(17, 'Wie nennt man im Netjargon Raubkopien von Software?', 'Warez', 'Warex', 'Torrent', 'Nerds', 'Warez', 1),
(18, 'Wo fanden 2004 die Olympischen Sommerspiele statt?', 'in Peking', 'in Atlanta', 'in Sydney', 'in Athen', 'in Athen', 2),
(19, 'Wie hieß der erste europäische Olympiasieger des 100-m-Laufs?', 'Harold Abrahams', 'Emil Zapotek', 'Ray C. Ewry', 'Paavo Nurmi', 'Harold Abrahams', 3),
(20, 'Wie viel Prozent der Weltbevölkerung sind Linkshänder?', 'Ca. zehn Prozent', 'Ca. dreißig Prozent', 'Ca. zwanzig Prozent', 'Ca. vierzig Prozent', 'Ca. zehn Prozent', 2),
(21, 'Was bedeutet der arabische Name Anwar?', 'Schatten', 'Sonne', 'Licht', 'Mond', 'Licht', 3),
(22, 'Wer gilt als Begründer der Logik?', 'John Locke', 'Demokrit', 'Parmenides', 'Aristoteles', 'Aristoteles', 1),
(23, 'Wie hieß der erste Medizin-Nobelpreisträger (1901)?', 'Louis Pasteur', 'Robert Koch', 'Ignaz Semmelweis', 'Emil von Behring', 'Emil von Behring', 3),
(24, 'Welche Schriftsprache benutzt die Buchstaben ö und ü, aber kein ä?', 'Schwedisch', 'Türkisch', 'Finnisch', 'Hochdeutsch', 'Türkisch', 2),
(25, 'Wie oft im Jahr brüten Tauben?', 'Bis zu fünf Mal', 'Bis zu acht Mal', 'Bis zu sieben Mal', 'Bis zu sechs Mal', 'Bis zu fünf Mal', 3),
(26, 'Wie heißt die Hülle von Insektenpuppen?', 'Kokon', 'Koke', 'Coco', 'Koka', 'Kokon', 3),
(27, 'Wie viele Arme hat ein Tintenfisch mindestens?', 'Acht', 'Vier', 'Sechs', 'Zehn', 'Acht', 2),
(28, 'Was sind Meerkatzen?', 'Vögel', 'Bären', 'Fische', 'Affen', 'Affen', 3),
(29, 'Das Gegenteil einer Kernfusion ist eine ...', 'Kernverdampfung', 'Kernspaltung', 'Kernverschmelzung', 'Kernverflüssigung', 'Kernspaltung', 2),
(30, 'Was für eine Größe ist die Geschwindigkeit?', 'Sektor', 'Skalar', 'Radiant', 'Vektor', 'Vektor', 1),
(31, 'Welche Vorsatzsilbe steht für 0,001?', 'Dezi', 'Zenti', 'Milli', 'Mikro', 'Milli', 1),
(32, 'Wie viel Wattsekunden hat eine Kilowattstunde?', '3600', '360 000', '144 000', '3 600 000', '3 600 000', 3),
(33, 'Welche Wellen nutzt man für Radargeräte?', 'Lichtwellen', 'Ultrakurzwellen', 'Dezimeterwellen', 'Zentimeterwellen', 'Zentimeterwellen', 3),
(34, 'Wie nennt man die Hauptschlagader des Menschen?', 'Arterie', 'Aorta', 'Vene', 'Bypass', 'Aorta', 2),
(35, 'Was ist eine Cholezystolithiasis?', 'Bauchspeicheldrüsenentzündung', 'Gallensteinleiden', 'Nierensteine', 'entzündliche Darmerkrankung', 'Gallensteinleiden', 3),
(36, 'Wie hoch ist die Zugspitze?', 'etwa 2000 Meter', 'etwa 3000 Meter', 'etwa 3500 Meter', 'etwa 4000 Meter', 'etwa 3000 Meter', 2),
(37, 'Die Insel Korfu gehört zu ...', 'Italien', 'Serbien', 'Kroatien', 'Griechenland', 'Griechenland', 1),
(38, 'Zu welchem Land gehört die Insel Texel?', 'Deutschland', 'Dänemark', 'Niederlande', 'Schweden', 'Niederlande', 2),
(39, 'Welcher Berg liegt nicht in Europa?', 'Monte Rosa', 'Triglav', 'Ojos del Salado', 'Piz Bernina', 'Ojos del Salado', 3),
(40, 'Welches amerikanische Land hat die größte Fläche?', 'Kanada', 'die USA', 'Argentinien', 'Brasilien', 'Kanada', 2),
(41, 'Welcher Berg ist kein Vulkan?', 'Stromboli', 'Agung', 'Matterhorn', 'Erebus', 'Matterhorn', 3),
(42, 'Wie heisst die Hauptstadt von Burkina Faso?', 'Ouagadougou', 'Yamoussoukrou', 'Bulawayo', 'Niamey', 'Ouagadougou', 3),
(43, 'Welcher der Kanäle wurde nicht künstlich geschaffen?', 'Panamakanal', 'Ärmelkanal', 'Suezkanal', 'Dortmund-Ems-Kanal', 'Ärmelkanal', 2),
(44, 'Was erfand Samuel Colt (1814-1862)?', 'eine Nähmaschine', 'einen Personenaufzug', 'einen Revolver', 'ein Maschinengewehr', 'einen Revolver', 1),
(45, 'Was geschah im Jahre 1492?', 'Kolumbus entdeckte Amerika.', 'Der Prager Fenstersturz ereignete sich.', 'Galileo Galilei erprobte das Gesetz des Falles.', 'Vasco da Gama entdeckte den Seeweg nach Indien.\r\n', 'Kolumbus entdeckte Amerika.', 1),
(46, 'Wie hieß Athens höchster Gerichtshof?', 'Kapitol', 'Areopag', 'Akropolis', 'Agora', 'Areopag', 3),
(47, 'Welche Autofirma begann als erste, Autos am Fließband zu produzieren?', 'Opel', 'Rolls Royce', 'Ford', 'Ferrari', 'Ford', 1),
(48, 'Welcher dieser Comic-Superhelden hat keine übermenschlichen Fähigkeiten?', 'Batman', 'Superman', 'Spiderman', 'Ultraman', 'Batman', 2),
(49, 'In welchem Musical tritt Eliza Doolittle auf?', 'Pygmalion', 'My Fair Lady', 'Porgy and Bess', 'West Side Story', 'My Fair Lady', 3),
(50, 'Aluminium ist ein ...', 'Schwermetall', 'Leichtmetall', 'Halbmetall', 'Edelmetall', 'Leichtmetall', 1),
(51, 'Welcher Stoff hat die Mohs-Härte 7?', 'Gips', 'Diamant', 'Quarz', 'Korund', 'Quarz', 2),
(52, 'Fußball ist olympische Sportart seit dem Jahre ...', '1896', '1900', '1904', '1906', '1896', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
