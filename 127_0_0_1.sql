-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 13. bře 2023, 00:06
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
    `ID_A`  int(11)      NOT NULL,
    `ID_U`  varchar(255) NOT NULL,
    `Mesto` varchar(60)  NOT NULL,
    `Ulice` varchar(60)  NOT NULL,
    `PSC`   int(10)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `adresa`
--

INSERT INTO `adresa` (`ID_A`, `ID_U`, `Mesto`, `Ulice`, `PSC`)
VALUES (1, 'PCStAtPKCU_noi8CeXoaz16783666336409d7a9730119.30701541', 'asd', 'sda', 123),
       (2, 'wyP99sTinr_aKCuZXHgt91678403854640a690ecb2462.13629156', 'asdddas', 'asdddas', 74714);

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
VALUES (58, '7uAYrXHtJ1_UrYUWnh1q2167396880063c6bca0c1a335.97174575',
        'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', 'das', '[\"DASDAS\",\"sda\"]', '[\"DAS\",\"das\"]', 3,
        'ox94Mn5wio_2HeGk8txxPVhh1soXfT2HvvoxMTfF0MmWmw2mdwelVKMa7S4vK.png'),
       (59, '2', 'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', '', '[\"das\"]', '[\"sadas\"]', 2,
        'SKLVnihHAP_rd4BihrCfQIN6KnCytHbOgYc5c4K5BR8OR2Yelqmw4K270sAXQ.jpeg'),
       (66, 'plRpDpckNi_IQRZ4QCEG916783535796409a4ab92b199.03584601',
        'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', 'dadadas', '[\"dsadasdas\",\"dasasdas\"]',
        '[\"dasdasdas\",\"dasd\"]', 5, 'TkLCNaKrsg_rJQtwA8KlBgLgkVcZikXs6UBF1lEwVzfrnKfcu6ZgQ75sJXnVo.jpeg'),
       (67, 'plRpDpckNi_IQRZ4QCEG916783535796409a4ab92b199.03584601',
        'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', 'asdasdada', '[\"dadasdas\",\"dasdada\",\"dadasda\"]',
        '[\"dasdasda\"]', 5, 'Cz00RWPHEU_deFEjbWTxRQSpfWgaWhs5dPOnkyG1crm56rBGP4SPD80BO5laO.jpeg'),
       (68, 'plRpDpckNi_IQRZ4QCEG916783535796409a4ab92b199.03584601',
        'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', 'asdsad', '[\"dass\"]', '[\"sdadada\"]', 3,
        'N1o6lJqs0m_Sg3jp00gDm6VXoBRbUQGwJ09BWHJuFEdQhQ3GSOhc7HOeREFB5.jpeg'),
       (69, 'SgrinpuKM7_mqOIQNNgvm167676317263f160249c6826.56392140',
        'dB5DnVyYii_azMdoChwex167743816063fbacd0cf8139.46558658', 'dasdds', '[\"dasda\"]', '[\"asdasda\"]', 3,
        '0z60OxtLHB_vLOGE7aaeI7jplG2TtoSHZXIt5fAaLyv3ozCUlSxpuRYcBPW37.png');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel`
(
    `ID_U`     varchar(255)              NOT NULL,
    `Email`    varchar(30)               NOT NULL,
    `Password` varchar(255)              NOT NULL,
    `Jmeno`    varchar(30)               NOT NULL,
    `Prijmeni` varchar(30)               NOT NULL,
    `Role`     enum ('Uzivatel','Admin') NOT NULL DEFAULT 'Uzivatel'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`ID_U`, `Email`, `Password`, `Jmeno`, `Prijmeni`, `Role`)
VALUES ('1', 'l.dihel.st@spseiostrava.cz', '!Xiaomi2006', 'Lukas', 'Dihel', 'Uzivatel'),
       ('2', 'ltrngkjgnreoigújoitjgitrjoiútw', 'gqrgifqwjfofmoúvanafoúvnaovnadvoknofnaovnaojknma', 'das', 'da',
        'Admin'),
       ('7uAYrXHtJ1_UrYUWnh1q2167396880063c6bca0c1a335.97174575', 'll@ll.cz',
        '$2y$10$ye.FrnCdezDrIDxkWXIXK.OGyD4CNeYPyu07W1KMRi8WkyL0FrSJq', 'l', 'l', 'Uzivatel'),
       ('k29bI9XEHG_cnsDaFMcjo7Ixf0YCCx7ZOPwXhqOKhNBGdGWVFbal1lrPfKdMR167329150963bc66f5dc32a9.36067979',
        'fsdf@adsda.cc', '$2y$10$S2Ef/OO2vcK3qlmYkgbTluRqc4nemdGToPPldOVW/UTC3OiK3tep6', 'a', 'a', 'Uzivatel'),
       ('PCStAtPKCU_noi8CeXoaz16783666336409d7a9730119.30701541', 'donliker1223@seznam.cz',
        '$2y$10$AuzR1ZY1qJgzFTD3MAqnheDkghm54GMJH.U7P/FV4KMlMo6tkZgh6', '126', '6541', 'Uzivatel'),
       ('plRpDpckNi_IQRZ4QCEG916783535796409a4ab92b199.03584601', 'donliker123@seznam.cz',
        '$2y$10$yUlvWsr.2I.yRgdNQGqwfuvfyzhK7T14u9JWxuNUAxS2IoYuRYp5m', 'sad', 'das', 'Uzivatel'),
       ('SgrinpuKM7_mqOIQNNgvm167676317263f160249c6826.56392140', 'lukindihel@gmail.com',
        '$2y$10$ogMI2mYCOuPw2c.1jkui5uE4BW65KlHH9JwJUj0whTz67QPjtrVC2', 'asd', 'das', 'Uzivatel'),
       ('wyP99sTinr_aKCuZXHgt91678403854640a690ecb2462.13629156', 'sdfsfsdf@fsd.cz',
        '$2y$10$8pka28GTycUSiAXj8C1/Uu/thwWdxCKfaZouyMkcSJG7u07xQhdI2', 'asdddas', 'asdddas', 'Uzivatel');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `adresa`
--
ALTER TABLE `adresa`
    ADD PRIMARY KEY (`ID_A`),
    ADD UNIQUE KEY `adresa_ID_U_uindex` (`ID_U`);

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
    ADD UNIQUE KEY `Email` (`Email`) USING BTREE;

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adresa`
--
ALTER TABLE `adresa`
    MODIFY `ID_A` int(11) NOT NULL AUTO_INCREMENT,
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
    AUTO_INCREMENT = 70;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `adresa`
--
ALTER TABLE `adresa`
    ADD CONSTRAINT `adresa_uzivatel_ID_U_fk` FOREIGN KEY (`ID_U`) REFERENCES `uzivatel` (`ID_U`);

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

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
