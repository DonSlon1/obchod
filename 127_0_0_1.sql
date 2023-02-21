-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 21. úno 2023, 23:55
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Struktura tabulky `obrazky`
--

CREATE TABLE `obrazky` (
                           `Obrazek` varchar(255) NOT NULL,
                           `Nazev` varchar(255) NOT NULL,
                           `ID_P` varchar(255) NOT NULL,
                           `ID_O` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `obrazky`
--

INSERT INTO `obrazky` (`Obrazek`, `Nazev`, `ID_P`, `ID_O`) VALUES
    ('6e0lLV9TRv_wotOOKsuvTuMrnShSpSmgKp5txN1CeoffZW9aHMpD7QdjEG138.jpeg', 'dfgdfgdf', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `predmety`
--

CREATE TABLE `predmety` (
                            `ID_P` varchar(255) NOT NULL,
                            `Nazev` tinytext NOT NULL,
                            `Popis` text DEFAULT NULL,
                            `Cena_Bez_DPH` float NOT NULL,
                            `Hodnoceni` float(1,1) NOT NULL DEFAULT 0.0,
                            `H_Obrazek` varchar(255) NOT NULL,
                            `Parametry` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Parametry`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `predmety`
--

INSERT INTO `predmety` (`ID_P`, `Nazev`, `Popis`, `Cena_Bez_DPH`, `Hodnoceni`, `H_Obrazek`, `Parametry`) VALUES
                                                                                                             ('DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 'dsfsd', 'fsdfsdfsdfeatret', 245, 0.0, 'SGsQDKbGkX_HXfAiFMOGvEniWmb6buuJuo3h4iLGmn5IgDSceBFLKooVwfPeV.jpeg', '{\"rerwerwe\":{\"rwerwer\":\"werwerwerwe\",\"rwerwerw\":\"rwerwerwe\"},\"34534\":{\"3453453\":\"453453\"}}'),
                                                                                                             ('TUwq2GNsgq_wiCqLtFZCa167701444563f535ade3a903.16760167', 'sdasda', 'sadasd', 985, 0.0, 'MZ0HDyVr5l_EGHYYxg4r3gcuzRSDLBXs7ihq5jtcdrKNhlk2DS5oX0ZN3T5Wb.png', '{}');

-- --------------------------------------------------------

--
-- Struktura tabulky `recenze`
--

CREATE TABLE `recenze` (
                           `ID_R` int(11) NOT NULL,
                           `ID_U` varchar(255) NOT NULL,
                           `ID_P` varchar(255) NOT NULL,
                           `Popis` text DEFAULT NULL,
                           `Kladne` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Kladne`)),
                           `Zaporne` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Zaporne`)),
                           `Hodnoceni` int(1) NOT NULL,
                           `Obrazek` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `recenze`
--

INSERT INTO `recenze` (`ID_R`, `ID_U`, `ID_P`, `Popis`, `Kladne`, `Zaporne`, `Hodnoceni`, `Obrazek`) VALUES
                                                                                                         (23, '1', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 'fdsfsdfs', NULL, NULL, 5, NULL),
                                                                                                         (50, '2', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', '', '[\"ads\"]', '[\"das\"]', 3, '3vawaksczM_NC8zZgLF3D37NpfL50jcUfI8X86MgBSKYLJWISSq4fkvo7de6V.jpeg'),
                                                                                                         (51, '2', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 'hhoiurgnremtiophgk,rtoé=hkjthgofsgk,mnéoitzkrtob,fstgéionrksjthéostm,béoifsgnbmsfétz=ohnkmsrtzé=hsmrtn,=otrnkmsrtnmtiowerhngfiejravbwEOUZCHeb vczhusdVBUIdfbiP', '[\"sdfsgfdsfgsdg\"]', '[\"dsfdsfgsd\",\"gsdgs\",\"gdfgfgrlopdfkgplfb,fpgkhm,ftpohrtmjhiortszuhjmertigjmkeru00ediuoghrteioghmtrhoierjmghu00e9oiertghjmeru00e9tighmetpohrmtghfgmhbnrfstgjnmbu00e9irfgthbjmsrftgiu00e9hbmfgu00e9injkmrtzsu00e9hbnrstu00faob\"]', 3, NULL),
                                                                                                         (52, '2', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 'das', '[\"dasds\"]', '[\"adasdas\"]', 4, '4UMM9Bay0P_H1JmkqxvaHxjHBvTtVzqhaUUimwoKvxMGsOjuPaIBCqBSys4Qh.png'),
                                                                                                         (53, '2', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 'das', '[\"asd\"]', '[\"asd\"]', 3, 'k37u4Fisl2_RnhYti1RYPWy0waEBYOgYnnakuCPVoDprvJX4IHvWMYXyR6DGz.png'),
                                                                                                         (54, '2', 'DzC7F7fd24_0oWwGEXslX167396977663c6c0701d61e4.96152136', 'das', '[\"dasd\"]', '[\"asdas\"]', 4, 'MhXAYLBbkn_dlqKDMeeFgLXqY0fqdVLBGBVrmgCwjyPKayWzjhzzMd2wdaSwG.png');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
                            `ID_U` varchar(255) NOT NULL,
                            `Email` varchar(30) NOT NULL,
                            `Password` varchar(255) NOT NULL,
                            `Jmeno` varchar(30) NOT NULL,
                            `Prijmeni` varchar(30) NOT NULL,
                            `Mesto` varchar(20) DEFAULT NULL,
                            `Ulice` varchar(20) DEFAULT NULL,
                            `PSC` varchar(20) DEFAULT NULL,
                            `Role` varchar(20) NOT NULL DEFAULT 'Uzivatel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`ID_U`, `Email`, `Password`, `Jmeno`, `Prijmeni`, `Mesto`, `Ulice`, `PSC`, `Role`) VALUES
                                                                                                               ('1', 'l.dihel.st@spseiostrava.cz', '!Xiaomi2006', 'Lukas', 'Dihel', 'Markvartovice', 'Šilheřovická', '74714', 'Uzivatel'),
                                                                                                               ('2', 'ltrngkjgnreoigújoitjgitrjoiútw', 'gqrgifqwjfofmoúvanafoúvnaovnadvoknofnaovnaojknma', 'das', 'da', 'ads', 'das', 'asd', 'Anonym'),
                                                                                                               ('7uAYrXHtJ1_UrYUWnh1q2167396880063c6bca0c1a335.97174575', 'll@ll.cz', '$2y$10$ye.FrnCdezDrIDxkWXIXK.OGyD4CNeYPyu07W1KMRi8WkyL0FrSJq', 'l', 'l', 'l', 'l', 'l', 'Uzivatel'),
                                                                                                               ('k29bI9XEHG_cnsDaFMcjo7Ixf0YCCx7ZOPwXhqOKhNBGdGWVFbal1lrPfKdMR167329150963bc66f5dc32a9.36067979', 'fsdf@adsda.cc', '$2y$10$S2Ef/OO2vcK3qlmYkgbTluRqc4nemdGToPPldOVW/UTC3OiK3tep6', 'a', 'a', 'a', 'a', 'a', 'Uzivatel'),
                                                                                                               ('SgrinpuKM7_mqOIQNNgvm167676317263f160249c6826.56392140', 'lukindihel@gmail.com', '$2y$10$ogMI2mYCOuPw2c.1jkui5uE4BW65KlHH9JwJUj0whTz67QPjtrVC2', 'asd', 'das', 'addas', 'asd', 'ads', 'Uzivatel');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    ADD PRIMARY KEY (`ID_O`),
    ADD UNIQUE KEY `Obrazek` (`Obrazek`),
    ADD KEY `ID_P` (`ID_P`);

--
-- Indexy pro tabulku `predmety`
--
ALTER TABLE `predmety`
    ADD PRIMARY KEY (`ID_P`),
    ADD UNIQUE KEY `H_Obrazek` (`H_Obrazek`);

--
-- Indexy pro tabulku `recenze`
--
ALTER TABLE `recenze`
    ADD PRIMARY KEY (`ID_R`),
    ADD KEY `ID_U` (`ID_U`),
    ADD KEY `ID_P` (`ID_P`);

--
-- Indexy pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
    ADD PRIMARY KEY (`ID_U`),
    ADD UNIQUE KEY `ID_U` (`ID_U`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    MODIFY `ID_O` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `recenze`
--
ALTER TABLE `recenze`
    MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    ADD CONSTRAINT `obrazky_ibfk_1` FOREIGN KEY (`ID_P`) REFERENCES `predmety` (`ID_P`);

--
-- Omezení pro tabulku `recenze`
--
ALTER TABLE `recenze`
    ADD CONSTRAINT `recenze_ibfk_1` FOREIGN KEY (`ID_U`) REFERENCES `uzivatel` (`ID_U`),
    ADD CONSTRAINT `recenze_ibfk_2` FOREIGN KEY (`ID_P`) REFERENCES `predmety` (`ID_P`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
