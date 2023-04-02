-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 03. dub 2023, 00:27
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Struktura tabulky `adresa`
--

CREATE TABLE `adresa`
(
    `ID_A`  int(11)     NOT NULL,
    `Mesto` varchar(40) NOT NULL,
    `Ulice` varchar(33) NOT NULL,
    `PSC`   int(5)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `adresa`
--

INSERT INTO `adresa` (`ID_A`, `Mesto`, `Ulice`, `PSC`)
VALUES (3, 'Markvartovice', 'Xxxx', 74714),
       (6, 'aa', 'aa', 0),
       (7, 'Markvartovice', 'Xxxx 1', 74714),
       (8, 'Mar', 'Sil 7', 74714),
       (9, 'Mar', 'Šil 7', 74714),
       (10, 'Mar', 'Šil 7', 74714);

-- --------------------------------------------------------

--
-- Struktura tabulky `dodaci_udaje`
--

CREATE TABLE `dodaci_udaje`
(
    `ID_DU`    int(11)     NOT NULL,
    `Email`    varchar(50) NOT NULL,
    `Telefon`  varchar(9)  NOT NULL,
    `Jmeno`    varchar(25) NOT NULL,
    `Přijmeni` varchar(25) NOT NULL,
    `Mesto`    varchar(40) NOT NULL,
    `Ulice_Cp` varchar(33) NOT NULL,
    `PSC`      int(5)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavka`
--

CREATE TABLE `objednavka`
(
    `ID_OB` int(11) NOT NULL,
    `ID_U`  varchar(255) DEFAULT NULL,
    `ID_DU` int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `obrazky`
--

CREATE TABLE `obrazky`
(
    `Obrazek` varchar(255) NOT NULL,
    `Nazev`   varchar(255) NOT NULL,
    `ID_P`    varchar(255) NOT NULL,
    `ID_O`    int(11)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `obrazky`
--

INSERT INTO `obrazky` (`Obrazek`, `Nazev`, `ID_P`, `ID_O`)
VALUES ('GTd6OAkYJE_cNqBQnwDxlg2bV1pCr9XCCPAMSX2Yeodgee9ismFaIWnmnVlsB.jpeg', 'as',
        'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', 13);

-- --------------------------------------------------------

--
-- Struktura tabulky `predmety`
--

CREATE TABLE `predmety`
(
    `ID_P`         varchar(255) NOT NULL,
    `Nazev`        tinytext     NOT NULL,
    `Popis`        text                  DEFAULT NULL,
    `Cena_Bez_DPH` float        NOT NULL,
    `Hodnoceni`    float(1, 1)  NOT NULL DEFAULT 0.0,
    `H_Obrazek`    varchar(255) NOT NULL,
    `Parametry`    longtext              DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `predmety`
--

INSERT INTO `predmety` (`ID_P`, `Nazev`, `Popis`, `Cena_Bez_DPH`, `Hodnoceni`, `H_Obrazek`, `Parametry`)
VALUES ('9AkdLOy7Kv_rHhJRl6EWC16783737006409f34479f836.14863861', 'dsad', 'asdda', 1244, 0.0,
        'het6FZ5gCu_V8zJ3D1bhUUOjFGynrFjzFecUAR1a60l8TMfox59fPeLMFvog7.jpeg', '{}'),
       ('dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', '25\" Samsung Odyssey G40B',
        'LCD monitor Full HD 1920 × 1080, IPS, 16:9, 1 ms, 240Hz, G-Sync kompatibilní, HDR, 400 cd/m2, kontrast 1000:1, DisplayPort 1.2, HDMI 2.0, sluchátkový výstup, nastavitelná výška, pivot, VESA',
        6989, 0.0, 'CmFdpLg0wP_yM700T1fuRDfXsiId492gIErM7PCDFKbC3Ykh3DeDxeZLfQxCY.jpeg',
        '{\"Úhlopříčka a rozlišení\":{\"Úhlopříčka\":\"25\\\" (63,5 cm)\",\"Typ rozlišení\":\"Full HD\"},\"Obrazovka\":{\"Maximální jas\":\"400 cd/m2\",\"Odezva\":\"1 ms\"}}');

-- --------------------------------------------------------

--
-- Struktura tabulky `recenze`
--

CREATE TABLE `recenze`
(
    `ID_R`      int(11)      NOT NULL,
    `ID_U`      varchar(255) NOT NULL,
    `ID_P`      varchar(255) NOT NULL,
    `Popis`     text                                               DEFAULT NULL,
    `Kladne`    tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Kladne`)),
    `Zaporne`   tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Zaporne`)),
    `Hodnoceni` int(1)       NOT NULL,
    `Obrazek`   varchar(255)                                       DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `recenze`
--

INSERT INTO `recenze` (`ID_R`, `ID_U`, `ID_P`, `Popis`, `Kladne`, `Zaporne`, `Hodnoceni`, `Obrazek`)
VALUES (74, '2', 'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', '', '[\"dsa\"]', '[\"dasda\"]', 3,
        'liplvTqa2Z_omL35k8EBzyRnMdoIPF7Fho81jY6hMDNOKJg3DLXRSb0mmkjO8.png');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel`
(
    `ID_U`     varchar(255)              NOT NULL,
    `Email`    varchar(50)               NOT NULL,
    `Password` varchar(255)              NOT NULL,
    `Jmeno`    varchar(25)               NOT NULL,
    `Prijmeni` varchar(25)               NOT NULL,
    `Role`     enum ('Uzivatel','Admin') NOT NULL DEFAULT 'Uzivatel',
    `ID_A`     int(11)                   NOT NULL,
    `Telefon`  varchar(9)                NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`ID_U`, `Email`, `Password`, `Jmeno`, `Prijmeni`, `Role`, `ID_A`, `Telefon`)
VALUES ('2', ' ', ' ', 'Anonimní', ' ', 'Uzivatel', 3, ' '),
       ('Iu2lV2UWM8_czBj9qAUG7168037563464287f52b85766.99463167', 'luk@gma.com',
        '$2y$10$7Z7rDK.mvgmzL.NXEA0.O.4f5hl3ZL6EB4f0WybbEJZuRCkNEufU2', 'Lukas', 'd', 'Uzivatel', 8, '778456672'),
       ('kW00W7s2zs_BDSMZWVku316804636366429d714b0f525.82314206', 'li@g.v',
        '$2y$10$UOf73ZX9BRbISJha5o4YduHEPY6AeBD4tOaDFl/BF2sR.5xgGxAAW', 'A', 'A', 'Uzivatel', 10, '778456672'),
       ('NvX3cWoMIy_XlLcLhzi6g1679764385641f2ba18b5c52.40623303', 'lukindihel@gmail.com',
        '$2y$10$4P6/eb0Gnvvzuuze/Mor5OAoU6eO0nWSsT9ZORIH4RMKGaX5D8Cg6', 'Lukáš', 'Dihel', 'Uzivatel', 3, '0'),
       ('Sc8D0OBM3S_wWKFQRc75U1679771436641f472c859ba3.51565290', 'aa@aa.cz',
        '$2y$10$UyAuAV0aCYDVkRiszZkaj.1rkbFCt4F7o.psydsamzxq/MYcheXcq', 'aa', 'aa', 'Uzivatel', 6, '777'),
       ('SjyGkuYJji_DdHHjTtJpO1679852228642082c474cf70.50242347', 'lukindihel@gmail.comtz',
        '$2y$10$DNx2T2f96pC7QddOKrV4VuRc2O6S6EAHjgIHojDcWRe62tx1vDkva', 'Lukáš', 'Dihel', 'Uzivatel', 7, '777456672'),
       ('XMh22ABI9D_SwoNfmAm2V1680433893642962e52f2907.42545152', 'li@gmail.com',
        '$2y$10$BZ59f.NJDAOGLtqpVBqn7eQmPV8yd8Ozv6HrLaujwGZPlGnu..jeG', 'Lukjas', 'Dihe', 'Uzivatel', 9, '778456672');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `adresa`
--
ALTER TABLE `adresa`
    ADD PRIMARY KEY (`ID_A`);

--
-- Indexy pro tabulku `dodaci_udaje`
--
ALTER TABLE `dodaci_udaje`
    ADD PRIMARY KEY (`ID_DU`);

--
-- Indexy pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
    ADD PRIMARY KEY (`ID_OB`),
    ADD KEY `objednavka_uzivatel_ID_U_fk` (`ID_U`),
    ADD KEY `objednavka_dodaci_udaje_ID_DU_fk` (`ID_DU`);

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
    ADD UNIQUE KEY `ID_U` (`ID_U`),
    ADD UNIQUE KEY `Email` (`Email`) USING BTREE,
    ADD KEY `uzivatel_adresa_ID_A_fk` (`ID_A`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adresa`
--
ALTER TABLE `adresa`
    MODIFY `ID_A` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT pro tabulku `dodaci_udaje`
--
ALTER TABLE `dodaci_udaje`
    MODIFY `ID_DU` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
    MODIFY `ID_OB` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    MODIFY `ID_O` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT pro tabulku `recenze`
--
ALTER TABLE `recenze`
    MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 75;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
    ADD CONSTRAINT `objednavka_dodaci_udaje_ID_DU_fk` FOREIGN KEY (`ID_DU`) REFERENCES `dodaci_udaje` (`ID_DU`),
    ADD CONSTRAINT `objednavka_uzivatel_ID_U_fk` FOREIGN KEY (`ID_U`) REFERENCES `uzivatel` (`ID_U`);

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

--
-- Omezení pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
    ADD CONSTRAINT `uzivatel_adresa_ID_A_fk` FOREIGN KEY (`ID_A`) REFERENCES `adresa` (`ID_A`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
