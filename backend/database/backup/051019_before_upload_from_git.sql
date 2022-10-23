-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: esmeralda.store.d0m.de:3474
-- Erstellungszeit: 05. Okt 2019 um 20:08
-- Server-Version: 5.6.42-log
-- PHP-Version: 7.2.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `DB3701281`
--
CREATE DATABASE IF NOT EXISTS `DB3701281` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `DB3701281`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `nickname` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `pw` varchar(256) NOT NULL,
  `telnr` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`idadmin`, `first_name`, `last_name`, `nickname`, `email`, `pw`, `telnr`, `created_at`, `modified_at`) VALUES
(12, 'der', 'MÃ¼ller', 'oshi', '1@2.derr', '$2y$10$llRwPBe/bTVAKYz4LAVp.eLbKLdifrv3e6HxDpPsZtn0wSZhfYQYW', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(13, 'der', 'MÃ¼ller', 'oshi', '1@2.dertr', '$2y$10$DLfoogDYo242pIRWJrtV3.hmcZaibJPMrQ8d5.ynVvCGd2WCzHaE2', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(14, 'der', 'MÃ¼ller', 'oshi', '1@2.dertrt', '$2y$10$PHmvNurOqD4XXI3YLLT9GeTcLTwhpqV1xdU/iMVMZwkMIqYuSL3vC', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(15, 'der', 'MÃ¼ller', 'oshi', '1@2.dertrt12', '$2y$10$ZtW9YaRkujSHKKWZrcOc9uJSHnNFOrvVtjbpWze67Nk44SI7pyNdu', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(16, 'der', 'MÃ¼ller', 'oshi', '1@2.dertrt14', '$2y$10$kTBqpcbfWoZn..o3s0yHH.uscW6fIHHTutkNw7NY5/dwF.vhrN/QO', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(17, 'der', 'MÃ¼ller', 'oshi', '1@2.dertrt145', '$2y$10$YgJ7/WeTRuE0VctFJ3dU6uXCVJ5RcpXmBYooymZRY/zS3sCUIpzmK', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(18, 'der', 'MÃ¼ller', 'oshi', '1@2.dertrt1459', '$2y$10$hrMhNWbv2dyRPqHNLbPCWee/96BFvGZ.yuG5Vqr0YOKHvNo3qSKoC', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(19, 'der', 'MÃ¼ller', 'oshi', '1@2.de', '$2y$10$2f8clE6RTjqDaVqtSdD1qeR0/owF45mvqBGPqziM8NklAXTdav7la', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(20, 'der', 'MÃ¼ller', 'oshi', '1@2.d', '$2y$10$awbhHYs4FgvgImOOHrK.cefONTavwmW9ZVtGULyFX1BJiy1p/.gsW', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(21, 'der', 'MÃ¼ller', 'oshi', 'admin@test.de', '$2y$10$edrmZEYsskSXR2pjYxVSiOJL2fXhRtwJ.sNAzKDAIp54dR2t1cBo.', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(22, 'der', 'MÃ¼ller', 'oshi', 'admin@test.dee', '$2y$10$VKIH1P6ArKA2c36t2DED9uj9J.6DU89CXUuCBJRs.v1L3vzuWZi6G', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(23, 'der', 'MÃ¼ller', 'oshi', 'admin@test.der', '$2y$10$nAeHMMycPYe49BxIyEt85.IE1VzwYAWFrs1VSPnpyJ.mfrmKByiri', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(24, 'der', 'MÃ¼ller', 'oshi', 'admin@test.dere', '$2y$10$cnW4dvgF.QI4xnVp36ZWROulWmO2b6FoVky2bjfERtua7O8I5Y5ne', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(25, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree', '$2y$10$wR918AhTN3f/7jtcuqNVN.tOi6XaFBc8Wr7NuxnQMiHYDBGV225Ti', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(26, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree3', '$2y$10$QPEMa.ENiCPo27nIwn1NhexACdV/qSYnEiIvs5Bh7KrHo7Nz27FEq', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(27, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree33', '$2y$10$WzB7iEyBXgND4NLxLlThgOVtI6w3CQx.7vmEtAWCw2QEQsBRX3yRK', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(28, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree333', '$2y$10$ni77lS4eLc4RxWml7LLKI.ZCah8Nn6.zB93wcl.XQij.pN6AK1sYa', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(29, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree3433', '$2y$10$xU/ZW.gcXqZ46cOAz.tDxuwJOgagWJbu/albf5B9/kseocbYlNwhG', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(30, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree34343', '$2y$10$TWFcogbYIW/mMN4FYzAa6uJOK7NkkA.qDuIQr4ZfxmWamynO0tSMO', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(31, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree344343', '$2y$10$bVi.pUmusJfv5lZcHa1ZAu//G9WT9qd2wJn.JG/qKbjqNHKeJCCt.', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(32, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree3443643', '$2y$10$XdZxYeInmNYk93C4oiicjOboasRPTblT9Om6Su0RBj9rncJh6y.dW', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(33, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree34436463', '$2y$10$7aoQYkQX9eLw7Zdful.fdO/sOSRLzQjwTRi2FwQEi/e7bqOM0KRBC', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(37, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree344365463', '$2y$10$Gk0YhmJueOUk/5jZIgiKueC3HM2i7JraRo/GvnUj6VKi7brt.9ebS', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(38, 'der', 'MÃ¼ller', 'oshi', 'admin@test.deree3443654463', '$2y$10$tREW/VCAydjTQht7YvLUXe4hRtaL4jNPKg7baxLHihVMIC1iSHUga', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(39, 'der', 'MÃ¼ller', 'oshi', 'admin@test.der5ee3443654463', '$2y$10$ROT4W3dPnvycp09DiQJc3.qDVJkMroHd5zdwBg9jlMdNaKxon.e.K', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(41, 'der', 'MÃ¼ller', 'oshi', 'admin@test.der5ee34436g54f463', '$2y$10$cELcQl.Bsm/5JlTQIP.NAONuS6X43r7zBr6MLExwu.W5KGMlDFK12', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(45, 'der', 'MÃ¼ller', 'oshi', 'admin@test.der5ee34t436g54f463', '$2y$10$iYT0s9DPjtB4ZpAxKvsR1O1FB3cv5gP1haAjYiXs4e.NdEQGopQRy', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(46, 'Jon', 'Snow', 'johny', 'jon@snow.de', '$2y$10$3kGll2KseZPXzKGOqaweruL8UhaIlHQ0iOkZtofrPXNleyQVjdckG', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(47, 'der', 'MÃ¼ller', 'oshi', 'user@tes6g54fd4.de', '$2y$10$NuS2A3I67U2gLSv9m8tgh.f/0/wvwGaUnTOlJRJH3AVTiiFYEaLea', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(48, 'Umberto', 'Eco', 'johny', 'umberto@eco.com', '$2y$10$3eJD/apTGA.XUTRVjfrroONXnpccu.qVTTqcWULRJ97axq/.Vdv62', '', '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(49, 'marki', 'mark', 'johny', 'marki@web.de', '$2y$10$JyQDZ3xfm23cQiXeQKZJy.dCnzCNwQTnXlRjMeXtGK0/qBYY5qUOm', '', '2019-06-04 17:41:04', '2019-06-04 17:41:04'),
(50, 'Peter', 'Pan', 'Petey', 'peter@pan.com', '$2y$10$cT.0eM8pFLVUUwJ51.MFSezoSniCPqJVkIgaiQbdQxFa.sQeyiS4K', '', '2019-06-04 20:22:55', '2019-06-04 20:22:55'),
(51, 'hans', 'power', 'powerhans', 'hans@wurst.com', '$2y$10$r9WtHxtc2CyEPUsckePaqOuaHxIS/WNqv3yv9zYBNSsK.yIpWFn9G', '', '2019-06-04 20:27:47', '2019-06-04 20:27:47'),
(52, 'jürgen', 'rot', 'juri', 'juri@rot.com', '$2y$10$n0kysGe5CVBb7klp0z7YyupZqPzg8Q3X..pRr1X1MePJ0/SQAwiAW', '', '2019-06-04 20:37:20', '2019-06-04 20:37:20'),
(53, 'Alex', 'Boss', '', 'alex@alex.de', '$2y$10$zwUX70PpjthJt0oo2qr22OZF7xFjTUeYHeC7YzUoDQnH2qRrlNb4K', '', '2019-06-05 18:59:15', '2019-06-05 18:59:15'),
(54, 'Test', 'Test', '', 'Test@test.test', '$2y$10$/bhG1WzM.Qi.2mhuWqstgO8BEp2CtVXKLVSjtyjCfVrccFDUTeyO6', '', '2019-06-15 11:39:42', '2019-06-15 11:39:42'),
(55, 'testi', 'testi', '', 'test@test.testi', '$2y$10$DYCr7NLcsWORVYRMR/KgY.CkGDL/9jVftfhJeX0j12Fgo11y6PGvG', '', '2019-06-16 13:45:30', '2019-06-16 13:45:30'),
(56, 'Armin', 'Utz', '', 'armin@web.de', '$2y$10$97/dxEnka/cnFTmkdXrPAeLCjqzUQKqcDqsmwI8KyIddc1FIh0JVW', '', '2019-06-16 13:50:04', '2019-06-16 13:50:04'),
(57, 'aaa', 'aaa', '', 'aaa@aaa.aaa', '$2y$10$TfpuBTTr5MefVIeoyQ7Sdex2uAtzziCMgTE2XfOyxvYWOiVjDHKGK', '', '2019-06-16 13:53:39', '2019-06-16 13:53:39'),
(58, 'Jo', 'Strong', '', 'johannes.stark.js@gmail.com', '$2y$10$.ZjD2UIELjOpYxepopeppOGoPRf1t8HAMJZ3N3MtJb2Pqxmx4KKq.', '', '2019-09-28 19:21:36', '2019-09-28 19:21:36');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notification_admin`
--

CREATE TABLE `notification_admin` (
  `idnotifications` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `admin_idadmin` int(11) NOT NULL,
  `notification_type_idnotification` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notification_type`
--

CREATE TABLE `notification_type` (
  `idnotification` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notification_user`
--

CREATE TABLE `notification_user` (
  `idnotifications` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `notification_type_idnotification` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE `room` (
  `idroom` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_idadmin` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`idroom`, `name`, `admin_idadmin`, `created_at`, `modified_at`) VALUES
(4, '235', 41, '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(8, '235', 45, '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(9, 'Winterfell', 46, '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(10, '235', 47, '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(11, 'Philly', 48, '2019-06-04 10:57:39', '2019-06-04 10:57:39'),
(12, 'room1', 49, '2019-06-04 17:41:04', '2019-06-04 17:41:04'),
(13, 'room1', 50, '2019-06-04 20:22:55', '2019-06-04 20:22:55'),
(14, 'room1', 51, '2019-06-04 20:27:47', '2019-06-04 20:27:47'),
(15, 'room1', 52, '2019-06-04 20:37:20', '2019-06-04 20:37:20'),
(16, 'Bossraum', 53, '2019-06-05 18:59:15', '2019-06-05 18:59:15'),
(17, 'Test', 54, '2019-06-15 11:39:42', '2019-06-15 11:39:42'),
(18, 'testi', 55, '2019-06-16 13:45:30', '2019-06-16 13:45:30'),
(19, 'Weckmanns', 56, '2019-06-16 13:50:04', '2019-06-16 13:50:04'),
(20, 'aaa', 57, '2019-06-16 13:53:39', '2019-06-16 13:53:39'),
(21, 'Zimmer', 58, '2019-09-28 19:21:36', '2019-09-28 19:21:36');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room_has_user`
--

CREATE TABLE `room_has_user` (
  `user_iduser` int(11) NOT NULL,
  `room_idroom` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `room_has_user`
--

INSERT INTO `room_has_user` (`user_iduser`, `room_idroom`, `created_at`, `modified_at`) VALUES
(1, 4, '2019-06-04 11:24:17', '2019-06-04 11:24:17'),
(2, 4, '2019-06-04 11:24:30', '2019-06-04 11:24:30'),
(3, 4, '2019-06-04 11:28:02', '2019-06-04 11:28:02'),
(4, 4, '2019-06-04 21:08:17', '2019-06-04 21:08:17'),
(5, 12, '2019-06-05 09:45:32', '2019-06-05 09:45:32'),
(6, 4, '2019-06-05 18:49:21', '2019-06-05 18:49:21'),
(7, 12, '2019-06-05 18:54:21', '2019-06-05 18:54:21'),
(8, 12, '2019-06-05 18:55:26', '2019-06-05 18:55:26'),
(9, 16, '2019-06-05 18:59:56', '2019-06-05 18:59:56'),
(10, 12, '2019-06-10 14:18:58', '2019-06-10 14:18:58'),
(11, 12, '2019-06-10 14:30:02', '2019-06-10 14:30:02'),
(12, 12, '2019-06-10 14:31:16', '2019-06-10 14:31:16'),
(13, 12, '2019-06-10 15:55:21', '2019-06-10 15:55:21'),
(14, 12, '2019-06-12 18:49:37', '2019-06-12 18:49:37'),
(15, 20, '2019-06-16 13:54:33', '2019-06-16 13:54:33');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shift`
--

CREATE TABLE `shift` (
  `idshift` int(11) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `admin_idadmin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shift_has_user`
--

CREATE TABLE `shift_has_user` (
  `shift_idshift` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `nickname` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `pw` varchar(256) NOT NULL,
  `telnr` varchar(64) DEFAULT NULL,
  `superuser` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`iduser`, `first_name`, `last_name`, `nickname`, `email`, `pw`, `telnr`, `superuser`, `created_at`, `modified_at`) VALUES
(1, 'der', 'Müller', 'oshi', 'useerefeerd@1.de', '$2y$10$Yspl1m9KY5/dAJ4jBC.haOCE3yoCMLevlYd46XjQGaBtV5e80/2Fq', '', 0, '2019-06-04 11:24:17', '2019-06-04 11:24:17'),
(2, 'der', 'Müller', 'oshi', 'user@1.de', '$2y$10$sY7EzvCxurMXqxgL.rwne.P/qgQSc4gJFOXnvAvlNMYo4I6g88YQS', '', 0, '2019-06-04 11:24:30', '2019-06-04 11:24:30'),
(3, 'der', 'Müller', 'oshi', 'userq@1.de', '$2y$10$ve2CGH7sZtyT7h936aDluOR9DJ7GtX9/wHWNUJEYrUmJNIpv/3Rgm', '', 0, '2019-06-04 11:28:02', '2019-06-04 11:28:02'),
(4, 'der', 'Müller', 'oshi', 'use4rq@1.de', '$2y$10$g73TJmV3ZWxQaQfrJPyaWOPIGBFLKaxfXCyO6tO9BrLqqn/632zZO', '', 0, '2019-06-04 21:08:17', '2019-06-04 21:08:17'),
(5, 'Johannes', 'Stark', 'Jo', 'jo@gmail.com', '$2y$10$mK6HxycFVMyU5u0z.nyYFOusNqxYZTlRcRliE2s0u37vDp3wFK4.K', '', 0, '2019-06-05 09:45:32', '2019-06-05 09:45:32'),
(6, 'der', 'Müller', 'oshi', 'usedddrq@1.de', '$2y$10$.Ms1xAojWtyzh8gkfGKo2.A0ZEFGaBuXeJW6V5m3sffITiX/j4xnK', '', 0, '2019-06-05 18:49:21', '2019-06-05 18:49:21'),
(7, 'hans', 'wurst', 'hansi', 'hans@hansi.hans', '$2y$10$Yuag26Lvi7tOMgRwm11hDecEefdL1FzigY56QEogj6MLH/RsKBaAC', '', 0, '2019-06-05 18:54:21', '2019-06-05 18:54:21'),
(8, 'asdfasdf', 'asdfasdf', '', 'asdfadf@asdf.de', '$2y$10$e6OsLZC2CfLTfvhmVAVRhud59U3m1HDhDdulYatbkNmgkCNWARxay', '', 0, '2019-06-05 18:55:26', '2019-06-05 18:55:26'),
(9, 'pimmel', 'pimmel', 'pimmel', 'pimmel@pimmel.pimmel', '$2y$10$pGqthcuVgCfQ9s7oVmf0Eu4IN64UuEFb3BaUlfeLW5W0SRO6FD1JW', '', 0, '2019-06-05 18:59:56', '2019-06-05 18:59:56'),
(10, 'Alex', 'Schröder', 'Alex', 'alex_skatefreak@web.de', '$2y$10$rYQ6/BBmKEFoDdbb05X/VepEQ0w3Hh18zYwP3LxoXMnKsxsrIXPvm', '', 0, '2019-06-10 14:18:58', '2019-06-10 14:18:58'),
(11, 'Viktoria', 'Rudik', 'Vicki', 'v.r@email.de', '$2y$10$JHz0i13c8yHmyBDlrResqeDOnu/S2UquX3NUpk1iQHYIHH9LvL59K', '', 0, '2019-06-10 14:30:02', '2019-06-10 14:30:02'),
(12, 'Peter', 'Pan', 'Petey', 'peter@pan2.com', '$2y$10$QqF36DnW3FM2XbA8Xc5i7uXqDXgvMIftScJT0uc4NrHKzpmPhDNsW', '', 0, '2019-06-10 14:31:16', '2019-06-10 14:31:16'),
(13, 'Max', 'Sommer', 'Maxi', 'max@bla.com', '$2y$10$eVCA9LIaL22FR7Y0PXc20uUIq0JxDhMBJXWvfVMwnev2dCCX7sRHq', '', 0, '2019-06-10 15:55:21', '2019-06-10 15:55:21'),
(14, 'Jon', 'Snow', 'Johny', 'jon@snow.com', '$2y$10$sL9XLcYVr6ftS3gML7Z0CuMpzOfQxNCKfC2LwiVJV.YXV9b2x2LGq', '', 0, '2019-06-12 18:49:37', '2019-06-12 18:49:37'),
(15, 'bbb', 'bbb', 'bbb', 'bbb@bbb.bbb', '$2y$10$Eq/c2sazX.Kq/t49ZJMrKe.uWVMtUyENYILzVwB3U5G2qwIjW9pa.', '', 0, '2019-06-16 13:54:33', '2019-06-16 13:54:33');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indizes für die Tabelle `notification_admin`
--
ALTER TABLE `notification_admin`
  ADD PRIMARY KEY (`idnotifications`),
  ADD KEY `fk_notification_admin_admin1_idx` (`admin_idadmin`),
  ADD KEY `fk_notification_admin_notification_type1_idx` (`notification_type_idnotification`);

--
-- Indizes für die Tabelle `notification_type`
--
ALTER TABLE `notification_type`
  ADD PRIMARY KEY (`idnotification`);

--
-- Indizes für die Tabelle `notification_user`
--
ALTER TABLE `notification_user`
  ADD PRIMARY KEY (`idnotifications`),
  ADD KEY `fk_notification_notification_type1_idx` (`notification_type_idnotification`),
  ADD KEY `fk_notification_user1_idx` (`user_iduser`);

--
-- Indizes für die Tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`idroom`),
  ADD UNIQUE KEY `fk_admin_idadmin_UNIQUE` (`admin_idadmin`);

--
-- Indizes für die Tabelle `room_has_user`
--
ALTER TABLE `room_has_user`
  ADD PRIMARY KEY (`user_iduser`,`room_idroom`),
  ADD KEY `fk_user_has_room_room1_idx` (`room_idroom`),
  ADD KEY `fk_user_has_room_user_idx` (`user_iduser`);

--
-- Indizes für die Tabelle `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`idshift`),
  ADD KEY `fk_shift_admin1_idx` (`admin_idadmin`);

--
-- Indizes für die Tabelle `shift_has_user`
--
ALTER TABLE `shift_has_user`
  ADD PRIMARY KEY (`shift_idshift`,`user_iduser`),
  ADD KEY `fk_shift_has_user_user1_idx` (`user_iduser`),
  ADD KEY `fk_shift_has_user_shift1_idx` (`shift_idshift`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `notification_admin`
--
ALTER TABLE `notification_admin`
  MODIFY `idnotifications` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `notification_type`
--
ALTER TABLE `notification_type`
  MODIFY `idnotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `notification_user`
--
ALTER TABLE `notification_user`
  MODIFY `idnotifications` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `room`
--
ALTER TABLE `room`
  MODIFY `idroom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `shift`
--
ALTER TABLE `shift`
  MODIFY `idshift` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `notification_admin`
--
ALTER TABLE `notification_admin`
  ADD CONSTRAINT `fk_notification_admin_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notification_admin_notification_type1` FOREIGN KEY (`notification_type_idnotification`) REFERENCES `notification_type` (`idnotification`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `notification_user`
--
ALTER TABLE `notification_user`
  ADD CONSTRAINT `fk_notification_notification_type1` FOREIGN KEY (`notification_type_idnotification`) REFERENCES `notification_type` (`idnotification`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notification_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `room_has_user`
--
ALTER TABLE `room_has_user`
  ADD CONSTRAINT `fk_user_has_room_room1` FOREIGN KEY (`room_idroom`) REFERENCES `room` (`idroom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_room_user` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `fk_shift_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `shift_has_user`
--
ALTER TABLE `shift_has_user`
  ADD CONSTRAINT `fk_shift_has_user_shift1` FOREIGN KEY (`shift_idshift`) REFERENCES `shift` (`idshift`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shift_has_user_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
