-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 16. dub 2023, 23:16
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
       (6, 'Adsa', 'Šil 7', 74714),
       (7, 'Markvartovice', 'Xxxx 1', 74714),
       (8, 'Mar', 'Sil 7', 74714),
       (9, 'Mar', 'Šil 7', 74714),
       (10, 'Mar', 'Šil 7', 74714),
       (11, 'Mar', 'ŠIl 7', 74714),
       (12, 'Mar', 'Čil 77', 74714),
       (13, 'Mar', 'Šil 7', 74714),
       (14, 'as', 'das 5', 14117),
       (15, 'asd', 'sdf 4', 12345);

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
       (12, 'admin@admin.cz', '778456672', 'Lukas', 'Dihel', 'Šil 7', 'Mar', 74714);

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
VALUES (9, NULL, 7, 'Na Cestě', '2023-04-13', 'Karta-online', 'dpd'),
       (10, NULL, 8, 'Přijatá', '2023-04-13', 'Karta-online', 'dpd'),
       (11, NULL, 9, 'Přijatá', '2023-04-14', 'Dobirka', 'dpd'),
       (12, NULL, 10, 'Přijatá', '2023-04-14', 'bankovni-prevod', 'dpd'),
       (13, 'BZuUL1Mku0_NjyyZyEkRC168147132064393758c75519.46884058', 11, 'Přijatá', '2023-04-14', 'bankovni-prevod',
        'dpd'),
       (14, '1', 12, 'Přijatá', '2023-04-14', 'Dobirka', 'posta');

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
       (13, 14, 43, 2);

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
    `Parametry`    longtext              DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `predmety`
--

INSERT INTO `predmety` (`ID_P`, `Nazev`, `Popis`, `Cena_Bez_DPH`, `Hodnoceni`, `H_Obrazek`, `Parametry`)
VALUES (43, 'as', 'a', 2, 0.0, 'bMbGqR.jfif', '{\"Typ sluchátek \":{\"dasdasdad\":\"dasdas\"}}'),
       (47, 'fsdfssd', 'das', 1234660, 0.0, '8upOVD.png',
        '{\"&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;\":{\"ads\":\"das\"}}');

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
        '[\"dasdad\",\"dasda\",\"dasdsa\",\"dasdas\",\"asdasdas\",\"recenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.phprecenze_uz.php\"]',
        '[\"asdasda\",\"asda\",\"dasdasdasdas\",\"dasd\",\"14859591466514\"]', 5,
        'NYbMj0qHQO_v20JtFnDcMjDyacozp9Bqlyu7eHl22YAHXLRln40w1fI1QIK40.jpeg'),
       (107, '1', 47, 'dasd', '[\"sdasdas\",\"das\"]', '[\"dasdasdas\",\"asdas\"]', 1,
        'D6fpqH406h_sOLDtCsUncV84gC979Rp4FTLU50UP0J8aegc77hxSvSUNW98R7.png'),
       (108, '1', 43, '', '[\"das\"]', '[]', 3, 'EUaHPYyCo9_gG0tVGdL4xiXNuOWchyUQYRQwupdByEmgPRni73VqpvmVrhesn.jpeg');

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
        'Admin', 13, '778456672'),
       ('2', ' ', ' ', 'Anonymní', ' ', 'Anonym', 3, ' '),
       ('7ChSVK4lE2_33GItK2PHy1680739542642e0cd680f0f3.73158983', 'l@gm.c',
        '$2y$10$FnwkWhv3rg7I2Nv3fDLuROfQpu3qGDb7Ouv05UQDI4W8744Cyhvb.', 'Lukas', 'A', 'Uzivatel', 12, '778456672'),
       ('BZuUL1Mku0_NjyyZyEkRC168147132064393758c75519.46884058', 'sdf@sa.vc',
        '$2y$10$Gubn7Qj/Xk0r.1XQBJvEN.RtdmKN/6Uy2Gzf.L6nHJkZgIbD6nXlW', 'das', 'das', 'Uzivatel', 15, '788456123'),
       ('hNXrULLwGo_AHgRmZZ9i71680639666642c86b28f19f7.37926065', 'lukindihel@gmail.co',
        '$2y$10$RlWDdYjMMUOuQTgjq1qCxeAP34hyxKO5W0zoBdofyZhrrom5bPOV.', 'Lukas', 'D', 'Uzivatel', 11, '778456672'),
       ('Iu2lV2UWM8_czBj9qAUG7168037563464287f52b85766.99463167', 'luk@gma.com',
        '$2y$10$7Z7rDK.mvgmzL.NXEA0.O.4f5hl3ZL6EB4f0WybbEJZuRCkNEufU2', 'Lukas', 'd', 'Uzivatel', 8, '778456672'),
       ('kW00W7s2zs_BDSMZWVku316804636366429d714b0f525.82314206', 'li@g.v',
        '$2y$10$UOf73ZX9BRbISJha5o4YduHEPY6AeBD4tOaDFl/BF2sR.5xgGxAAW', 'A', 'A', 'Uzivatel', 10, '778456672'),
       ('NvX3cWoMIy_XlLcLhzi6g1679764385641f2ba18b5c52.40623303', 'lukindihel@gmail.com',
        '$2y$10$4P6/eb0Gnvvzuuze/Mor5OAoU6eO0nWSsT9ZORIH4RMKGaX5D8Cg6', 'Lukáš', 'Dihel', 'Uzivatel', 3, '778456672'),
       ('Sc8D0OBM3S_wWKFQRc75U1679771436641f472c859ba3.51565290', 'aa@aa.cz',
        '$2y$10$UyAuAV0aCYDVkRiszZkaj.1rkbFCt4F7o.psydsamzxq/MYcheXcq', 'aa', 'aa', 'Uzivatel', 6, '777'),
       ('sD1uc9xgov_UuQqDwLYem168147126864393724b2f8c5.41678270', '154@xn--fea.cz',
        '$2y$10$o6AEz0kTEks2.R7My6mmLeEPKRZZyRZxYoYkM72KNwqnz8qeRym3S', 'L', 'L', 'Uzivatel', 14, '778456672'),
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
    ADD UNIQUE KEY `H_Obrazek` (`H_Obrazek`);

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
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adresa`
--
ALTER TABLE `adresa`
    MODIFY `ID_A` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT pro tabulku `dodaci_udaje`
--
ALTER TABLE `dodaci_udaje`
    MODIFY `ID_DU` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
    MODIFY `ID_OB` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 15;

--
-- AUTO_INCREMENT pro tabulku `objednavka_predmet`
--
ALTER TABLE `objednavka_predmet`
    MODIFY `ID_PO` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT pro tabulku `obrazky`
--
ALTER TABLE `obrazky`
    MODIFY `ID_O` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 30;

--
-- AUTO_INCREMENT pro tabulku `predmety`
--
ALTER TABLE `predmety`
    MODIFY `ID_P` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 48;

--
-- AUTO_INCREMENT pro tabulku `recenze`
--
ALTER TABLE `recenze`
    MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 109;

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
