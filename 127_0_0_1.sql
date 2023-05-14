-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 14. kvě 2023, 23:27
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
VALUES (3, 'Markvartovice', 'Šil 7', 74714),
       (6, 'Markvartovice', 'Šil 7', 74714),
       (7, 'Markvartovice', 'Šil 7', 74714),
       (8, 'Markvartovice', 'Šil 7', 74714),
       (9, 'Markvartovice', 'Šil 7', 74714),
       (10, 'Markvartovice', 'Šil 7', 74714),
       (11, 'Markvartovice', 'Šil 7', 74714),
       (12, 'Markvartovice', 'Šil 7', 74714),
       (13, 'Mar', 'Šil 7', 74714),
       (14, 'Markvartovice', 'Šil 7', 74714),
       (15, 'Markvartovice', 'Šil 7', 74714),
       (16, 'Mar', 'Šilh 7', 74714);

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

--
-- Vypisuji data pro tabulku `dodaci_udaje`
--

INSERT INTO `dodaci_udaje` (`ID_DU`, `Email`, `Telefon`, `Jmeno`, `Přijmeni`, `Mesto`, `Ulice_Cp`, `PSC`)
VALUES (7, 'admin@admin.cz', '778456672', 'Lukas', 'Dihel', 'Šil 7', 'Mar', 74714),
       (8, 'admin@admin.cz', '778456672', 'Lukas', 'Dihel', 'Šil 7', 'Mar', 74714),
       (9, 'admin@admin.cz', '778456672', 'Lukas', 'Dihel', 'Šil 7', 'Mar', 74714),
       (10, 'sdf@sa.vc', '788456123', 'das', 'das', 'sdf 4', 'asd', 12345),
       (11, 'sdf@sa.vc', '788456123', 'das', 'das', 'sdf 4', 'asd', 12345),
       (12, 'admin@admin.cz', '778456672', 'Lukas', 'Dihel', 'Šil 7', 'Mar', 74714),
       (13, 'ak@a.CZ', '778456672', 'Lu', 'A', 'As 7', 'Ma', 74714);

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie`
(
    `ID_K`  int(11)      NOT NULL,
    `Nazev` varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`ID_K`, `Nazev`)
VALUES (0, 'error'),
       (14, 'AAA155678'),
       (15, 'A'),
       (16, 'AS'),
       (17, 'AS5'),
       (18, 'AAA'),
       (19, '8451'),
       (20, 'AAA6');

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavka`
--

CREATE TABLE `objednavka`
(
    `ID_OB`         int(11)                                           NOT NULL,
    `ID_U`          varchar(255)                                               DEFAULT NULL,
    `ID_DU`         int(11)                                           NOT NULL,
    `Stav`          enum ('Přijatá','Na Cestě','Vyřízená','Zrušená')  NOT NULL DEFAULT 'Přijatá',
    `Datum_prijeti` date                                              NOT NULL DEFAULT curdate(),
    `platba`        enum ('Dobirka','Karta-online','bankovni-prevod') NOT NULL,
    `doprava`       enum ('posta','dpd')                              NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `objednavka`
--

INSERT INTO `objednavka` (`ID_OB`, `ID_U`, `ID_DU`, `Stav`, `Datum_prijeti`, `platba`, `doprava`)
VALUES (9, NULL, 7, 'Zrušená', '2023-04-13', 'Karta-online', 'dpd'),
       (10, NULL, 8, 'Vyřízená', '2023-04-13', 'Karta-online', 'dpd'),
       (11, NULL, 9, 'Zrušená', '2023-04-14', 'Dobirka', 'dpd'),
       (12, NULL, 10, 'Přijatá', '2023-04-14', 'bankovni-prevod', 'dpd'),
       (13, 'BZuUL1Mku0_NjyyZyEkRC168147132064393758c75519.46884058', 11, 'Přijatá', '2023-04-14', 'bankovni-prevod',
        'dpd'),
       (14, '1', 12, 'Přijatá', '2023-04-14', 'Dobirka', 'posta'),
       (15, NULL, 13, 'Zrušená', '2023-05-10', 'Karta-online', 'posta');

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavka_predmet`
--

CREATE TABLE `objednavka_predmet`
(
    `ID_PO`     int(11) NOT NULL,
    `ID_OB`     int(11) NOT NULL,
    `ID_P`      int(11) NOT NULL,
    `Poce_kusu` int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `objednavka_predmet`
--

INSERT INTO `objednavka_predmet` (`ID_PO`, `ID_OB`, `ID_P`, `Poce_kusu`)
VALUES (7, 9, 43, 1),
       (8, 10, 43, 1),
       (9, 11, 43, 1),
       (10, 12, 43, 1),
       (11, 13, 43, 1),
       (12, 14, 47, 2),
       (13, 14, 43, 2),
       (14, 15, 47, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `obrazky`
--

CREATE TABLE `obrazky`
(
    `Obrazek` varchar(255) NOT NULL,
    `Nazev`   varchar(255) NOT NULL,
    `ID_P`    int(11)      NOT NULL,
    `ID_O`    int(11)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `obrazky`
--

INSERT INTO `obrazky` (`Obrazek`, `Nazev`, `ID_P`, `ID_O`)
VALUES ('UijUHD.png', 'shopping-basket.png', 49, 30),
       ('g6yRL7.png', 'icon.png', 49, 31);

-- --------------------------------------------------------

--
-- Struktura tabulky `predmety`
--

CREATE TABLE `predmety`
(
    `ID_P`         int(11)      NOT NULL,
    `Nazev`        tinytext     NOT NULL,
    `Popis`        text                  DEFAULT NULL,
    `Cena_Bez_DPH` float        NOT NULL,
    `Hodnoceni`    float(1, 1)  NOT NULL DEFAULT 0.0,
    `H_Obrazek`    varchar(255) NOT NULL,
    `Parametry`    longtext              DEFAULT NULL,
    `ID_V`         int(11)               DEFAULT NULL COMMENT 'Vyrobce',
    `ID_K`         int(11)               DEFAULT NULL COMMENT 'Nazev Kategorie'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `predmety`
--

INSERT INTO `predmety` (`ID_P`, `Nazev`, `Popis`, `Cena_Bez_DPH`, `Hodnoceni`, `H_Obrazek`, `Parametry`, `ID_V`, `ID_K`)
VALUES (43, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}', 2, 20),
       (47, 'fsdfssd', 'das', 1234660, 0.0, '8upOVD.png',
        '{\"&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;\":{\"ads\":\"das\"}}', 10, 20),
       (48, '<script>window.location.reload()</script>',
        '5,9“ AMOLED displej s obnovovací frekvencí 120 Hz s dobou odezvy 1 ms, HDR10+, odolné sklo Corning Gorilla Glass Victus. Výkon 5nm mobilní platforma 2,84 GHz Qualcomm Snapdragon 888 5G, 64bitový osmijádrový procesor Qualcomm Adreno 660. GPU Adreno 660. RAM 8 GB, vnitřní paměť 256 GB. Duální fotoaparát – hlavní s rozlišením 64 MPx (f/1.8) a ultra-širokoúhlý fotoaparát s rozlišením 12 MPx (f2.2), video pak v kvalitě až 8K při 30 fps. Přední fotoaparát rozlišení 12 MPx (f/2.5). Stereofonní reproduktory se zesilovači Cirrus Logic, 3,5mm jack konektor. OS Android 11 a intuitivní prostředí ZenUI 8. Mimořádně odolný proti vodě a prachu s krytím IP68. Dual NanoSIM. Konektivita Wi-Fi, Bluetooth, GPS, NFC, FM rádio. Baterie s kapacitou 4000 mAh. Hmotnost 169 g. Rozměry 148 x 68,5 x 8,9 mm',
        1562, 0.0, 'j4W1iQ.jfif',
        '{\"&lt;script&gt;window.location.reload()&lt;\\/script&gt;\":{\"&lt;script&gt;window.location.reload()&lt;\\/script&gt;\":\"&lt;script&gt;window.location.reload()&lt;\\/script&gt;\"}}',
        9, NULL),
       (49, '<script>window.location.reload()</script>', '<script>window.location.reload()</script>', 1562, 0.0,
        'NfU5l4.png',
        '{\"&lt;script&gt;window.location.reload()&lt;\\/script&gt;\":{\"&lt;script&gt;window.location.reload()&lt;\\/script&gt;\":\"&lt;script&gt;window.location.reload()&lt;\\/script&gt;\"}}',
        6, 20),
       (50, 'Logitech G FITS True Wireless Gaming Earbuds - BLACK ', 'das', 423, 0.0, 'y8iK5d.png',
        '{\"&lt;a href=&#039;test&#039;&gt;Test&lt;\\/a&gt;\":{\"sdaada\":\"dfgdfg\"}}', 3, 20),
       (52, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}', 1, 20),
       (53, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}', 2, 20),
       (54, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}', 3, 20),
       (55, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}', 4, 20),
       (56, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}', 5, 20);

-- --------------------------------------------------------

--
-- Struktura tabulky `recenze`
--

CREATE TABLE `recenze`
(
    `ID_R`      int(11)      NOT NULL,
    `ID_U`      varchar(255) NOT NULL,
    `ID_P`      int(11)      NOT NULL,
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
VALUES (106, '1', 43, 'dasdasda415',
        '[\"dasdad\",\"dasda\",\"dasdsa\",\"dasdas\",\"asdasdas\",\"<script>window.location.reload()</script>\"]',
        '[\"asdasda\",\"asda\",\"dasdasdasdas\",\"dasd\",\"14859591466514\"]', 5,
        'NYbMj0qHQO_v20JtFnDcMjDyacozp9Bqlyu7eHl22YAHXLRln40w1fI1QIK40.jpeg'),
       (107, '1', 47, 'dasd', '[\"sdasdas\",\"das\"]', '[\"dasdasdas\",\"asdas\"]', 1,
        'D6fpqH406h_sOLDtCsUncV84gC979Rp4FTLU50UP0J8aegc77hxSvSUNW98R7.png'),
       (108, '1', 43, '', '[\"das\"]', '[\"das\"]', 3,
        'EUaHPYyCo9_gG0tVGdL4xiXNuOWchyUQYRQwupdByEmgPRni73VqpvmVrhesn.jpeg'),
       (111, 'NoZ0CA3ZUc_QritP3Kt4L1683731462645bb406d87974.19177149', 47, 'das', '[\"asd\"]', '[\"sda\"]', 2, NULL),
       (112, 'NoZ0CA3ZUc_QritP3Kt4L1683731462645bb406d87974.19177149', 47, 'das', '[\"das\"]', '[\"das\"]', 5, NULL),
       (113, 'NoZ0CA3ZUc_QritP3Kt4L1683731462645bb406d87974.19177149', 47, '', '[\"da\"]', '[]', 3, NULL),
       (114, 'NoZ0CA3ZUc_QritP3Kt4L1683731462645bb406d87974.19177149', 47, '', '[]', '[\"dsa\"]', 5, NULL),
       (115, 'NoZ0CA3ZUc_QritP3Kt4L1683731462645bb406d87974.19177149', 47, '', '[\"das\"]', '[\"das\"]', 1, NULL),
       (117, '1', 49, 'Next\n<script>window.location.reload()</script>',
        '[\"Next\\n<script>window.location.reload()<\\/script>\"]',
        '[\"Next\\n<script>window.location.reload()<\\/script>\"]', 3, NULL),
       (118, '1', 49, 'das', '[\"das\"]', '[\"sad\"]', 3, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel`
(
    `ID_U`     varchar(255)                       NOT NULL,
    `Email`    varchar(50)                        NOT NULL,
    `Password` varchar(255)                       NOT NULL,
    `Jmeno`    varchar(25)                        NOT NULL,
    `Prijmeni` varchar(25)                        NOT NULL,
    `Role`     enum ('Uzivatel','Admin','Anonym') NOT NULL DEFAULT 'Uzivatel',
    `ID_A`     int(11)                            NOT NULL,
    `Telefon`  varchar(9)                         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`ID_U`, `Email`, `Password`, `Jmeno`, `Prijmeni`, `Role`, `ID_A`, `Telefon`)
VALUES ('1', 'admin@admin.cz', '$2y$10$nBzFddOJ7KttgPPZ.tnW3u6OKwDeCX8Hk5sVrSKbS1.RGZxufbhnC', 'Lukas', 'Dihel',
        'Admin', 3, '778456672'),
       ('2', ' ', ' ', 'Lukas', 'Dihel', 'Anonym', 3, '778456672'),
       ('7ChSVK4lE2_33GItK2PHy1680739542642e0cd680f0f3.73158983', 'l@gm.c',
        '$2y$10$FnwkWhv3rg7I2Nv3fDLuROfQpu3qGDb7Ouv05UQDI4W8744Cyhvb.', 'Lukas', 'Dihel', 'Uzivatel', 12, '778456672'),
       ('BZuUL1Mku0_NjyyZyEkRC168147132064393758c75519.46884058', 'sdf@sa.vc',
        '$2y$10$Gubn7Qj/Xk0r.1XQBJvEN.RtdmKN/6Uy2Gzf.L6nHJkZgIbD6nXlW', 'Lukas', 'Dihel', 'Uzivatel', 15, '778456672'),
       ('hNXrULLwGo_AHgRmZZ9i71680639666642c86b28f19f7.37926065', 'lukindihel@gmail.co',
        '$2y$10$RlWDdYjMMUOuQTgjq1qCxeAP34hyxKO5W0zoBdofyZhrrom5bPOV.', 'Lukas', 'Dihel', 'Uzivatel', 11, '778456672'),
       ('Iu2lV2UWM8_czBj9qAUG7168037563464287f52b85766.99463167', 'luk@gma.com',
        '$2y$10$7Z7rDK.mvgmzL.NXEA0.O.4f5hl3ZL6EB4f0WybbEJZuRCkNEufU2', 'Lukas', 'Dihel', 'Uzivatel', 8, '778456672'),
       ('kW00W7s2zs_BDSMZWVku316804636366429d714b0f525.82314206', 'li@g.v',
        '$2y$10$UOf73ZX9BRbISJha5o4YduHEPY6AeBD4tOaDFl/BF2sR.5xgGxAAW', 'Lukas', 'Dihel', 'Uzivatel', 10, '778456672'),
       ('NoZ0CA3ZUc_QritP3Kt4L1683731462645bb406d87974.19177149', 'a@a.cz',
        '$2y$10$C3a/TNfMmNJcH8CUz57/uuFgX0DK4CQuYi44zJOoWWrIjB9g78nIS', 'Lukas', 'D', 'Uzivatel', 16, '778456672'),
       ('NvX3cWoMIy_XlLcLhzi6g1679764385641f2ba18b5c52.40623303', 'lukindihel@gmail.com',
        '$2y$10$4P6/eb0Gnvvzuuze/Mor5OAoU6eO0nWSsT9ZORIH4RMKGaX5D8Cg6', 'Lukas', 'Dihel', 'Uzivatel', 3, '778456672'),
       ('Sc8D0OBM3S_wWKFQRc75U1679771436641f472c859ba3.51565290', 'aa@aa.cz',
        '$2y$10$UyAuAV0aCYDVkRiszZkaj.1rkbFCt4F7o.psydsamzxq/MYcheXcq', 'Lukas', 'Dihel', 'Uzivatel', 6, '778456672'),
       ('sD1uc9xgov_UuQqDwLYem168147126864393724b2f8c5.41678270', '154@xn--fea.cz',
        '$2y$10$o6AEz0kTEks2.R7My6mmLeEPKRZZyRZxYoYkM72KNwqnz8qeRym3S', 'Lukas', 'Dihel', 'Uzivatel', 14, '778456672'),
       ('SjyGkuYJji_DdHHjTtJpO1679852228642082c474cf70.50242347', 'lukindihel@gmail.comtz',
        '$2y$10$DNx2T2f96pC7QddOKrV4VuRc2O6S6EAHjgIHojDcWRe62tx1vDkva', 'Lukas', 'Dihel', 'Uzivatel', 7, '778456672'),
       ('XMh22ABI9D_SwoNfmAm2V1680433893642962e52f2907.42545152', 'li@gmail.com',
        '$2y$10$BZ59f.NJDAOGLtqpVBqn7eQmPV8yd8Ozv6HrLaujwGZPlGnu..jeG', 'Lukas', 'Dihel', 'Uzivatel', 9, '778456672');

-- --------------------------------------------------------

--
-- Struktura tabulky `vyrobce`
--

CREATE TABLE `vyrobce`
(
    `ID_V`    int(11)      NOT NULL,
    `Nazev`   varchar(255) NOT NULL,
    `Obrazek` varchar(20)  NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `vyrobce`
--

INSERT INTO `vyrobce` (`ID_V`, `Nazev`, `Obrazek`)
VALUES (0, 'error', 'error.png'),
       (1, 'ASUS1', 'asus.png'),
       (2, 'ASUS2', 'asus.png'),
       (3, 'ASUS3', 'asus.png'),
       (4, 'ASUS4', 'asus.png'),
       (5, 'ASUS5', 'asus.png'),
       (6, 'a', 'asus.png'),
       (9, 'asd', 'QE4P27jQql.png'),
       (10, 'asda', 'v1o27wRrQp.png'),
       (11, 'asdad', 'YCa8VoB59T.jpg'),
       (12, 'aadsdsagdf', 'h9ESzBbEba.png');

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
-- Indexy pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
    ADD PRIMARY KEY (`ID_K`);

--
-- Indexy pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
    ADD PRIMARY KEY (`ID_OB`),
    ADD KEY `objednavka_uzivatel_ID_U_fk` (`ID_U`),
    ADD KEY `objednavka_dodaci_udaje_ID_DU_fk` (`ID_DU`);

--
-- Indexy pro tabulku `objednavka_predmet`
--
ALTER TABLE `objednavka_predmet`
    ADD PRIMARY KEY (`ID_PO`),
    ADD KEY `objednavka_predmet_objednavka_ID_OB_fk` (`ID_OB`),
    ADD KEY `objednavka_predmet_predmety_ID_P_fk` (`ID_P`);

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
    ADD KEY `predmety_vyrobce_ID_V_fk` (`ID_V`),
    ADD KEY `predmety_kategorie_ID_K_fk` (`ID_K`);

--
-- Indexy pro tabulku `recenze`
--
ALTER TABLE `recenze`
    ADD PRIMARY KEY (`ID_R`),
    ADD KEY `ID_U` (`ID_U`),
    ADD KEY `recenze_predmety_ID_P_fk` (`ID_P`);

--
-- Indexy pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
    ADD PRIMARY KEY (`ID_U`),
    ADD UNIQUE KEY `ID_U` (`ID_U`),
    ADD UNIQUE KEY `Email` (`Email`) USING BTREE,
    ADD KEY `uzivatel_adresa_ID_A_fk` (`ID_A`);

--
-- Indexy pro tabulku `vyrobce`
--
ALTER TABLE `vyrobce`
    ADD PRIMARY KEY (`ID_V`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adresa`
--
ALTER TABLE `adresa`
    MODIFY `ID_A` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT pro tabulku `dodaci_udaje`
--
ALTER TABLE `dodaci_udaje`
    MODIFY `ID_DU` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
    MODIFY `ID_K` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 22;

--
-- AUTO_INCREMENT pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
    MODIFY `ID_OB` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT pro tabulku `objednavka_predmet`
--
ALTER TABLE `objednavka_predmet`
    MODIFY `ID_PO` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 15;

--
-- AUTO_INCREMENT pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    MODIFY `ID_O` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 32;

--
-- AUTO_INCREMENT pro tabulku `predmety`
--
ALTER TABLE `predmety`
    MODIFY `ID_P` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 57;

--
-- AUTO_INCREMENT pro tabulku `recenze`
--
ALTER TABLE `recenze`
    MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 119;

--
-- AUTO_INCREMENT pro tabulku `vyrobce`
--
ALTER TABLE `vyrobce`
    MODIFY `ID_V` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

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
-- Omezení pro tabulku `objednavka_predmet`
--
ALTER TABLE `objednavka_predmet`
    ADD CONSTRAINT `objednavka_predmet_objednavka_ID_OB_fk` FOREIGN KEY (`ID_OB`) REFERENCES `objednavka` (`ID_OB`),
    ADD CONSTRAINT `objednavka_predmet_predmety_ID_P_fk` FOREIGN KEY (`ID_P`) REFERENCES `predmety` (`ID_P`);

--
-- Omezení pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    ADD CONSTRAINT `obrazky_predmety_ID_P_fk` FOREIGN KEY (`ID_P`) REFERENCES `predmety` (`ID_P`);

--
-- Omezení pro tabulku `predmety`
--
ALTER TABLE `predmety`
    ADD CONSTRAINT `predmety_kategorie_ID_K_fk` FOREIGN KEY (`ID_K`) REFERENCES `kategorie` (`ID_K`),
    ADD CONSTRAINT `predmety_vyrobce_ID_V_fk` FOREIGN KEY (`ID_V`) REFERENCES `vyrobce` (`ID_V`);

--
-- Omezení pro tabulku `recenze`
--
ALTER TABLE `recenze`
    ADD CONSTRAINT `recenze_ibfk_1` FOREIGN KEY (`ID_U`) REFERENCES `uzivatel` (`ID_U`),
    ADD CONSTRAINT `recenze_predmety_ID_P_fk` FOREIGN KEY (`ID_P`) REFERENCES `predmety` (`ID_P`);

--
-- Omezení pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
    ADD CONSTRAINT `uzivatel_adresa_ID_A_fk` FOREIGN KEY (`ID_A`) REFERENCES `adresa` (`ID_A`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
