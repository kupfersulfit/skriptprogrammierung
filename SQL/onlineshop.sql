-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2012 at 12:16 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `beschreibung` varchar(1023) COLLATE utf8_bin NOT NULL,
  `veroeffentlicht` tinyint(1) NOT NULL,
  `verfueggbar` int(10) unsigned NOT NULL,
  `kategorieid` int(11) NOT NULL,
  `preis` decimal(8,2) NOT NULL,
  `bildpfad` varchar(255) COLLATE utf8_bin NOT NULL,
  `seit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `artikel`
--


-- --------------------------------------------------------

--
-- Table structure for table `bestellungen`
--

CREATE TABLE IF NOT EXISTS `bestellungen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kundenid` int(11) NOT NULL,
  `bestelldatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusid` int(11) NOT NULL,
  `zahlungsmethodeid` int(11) NOT NULL,
  `lieferungsmethodeid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zahlungsmethodeid` (`zahlungsmethodeid`),
  KEY `lieferungsmethodeid` (`lieferungsmethodeid`),
  KEY `kundenid` (`kundenid`),
  KEY `statusid` (`statusid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bestellungen`
--


-- --------------------------------------------------------

--
-- Table structure for table `bestellungen_artikel`
--

CREATE TABLE IF NOT EXISTS `bestellungen_artikel` (
  `bestellungid` int(11) NOT NULL,
  `artikelid` int(11) NOT NULL,
  `anzahl` int(10) unsigned NOT NULL,
  UNIQUE KEY `bestellungid` (`bestellungid`,`artikelid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bestellungen_artikel`
--


-- --------------------------------------------------------

--
-- Table structure for table `kategorien`
--

CREATE TABLE IF NOT EXISTS `kategorien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `beschreibung` varchar(1023) COLLATE utf8_bin NOT NULL,
  `superkategorie` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `superkategorie` (`superkategorie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `kategorien`
--


-- --------------------------------------------------------

--
-- Table structure for table `kunden`
--

CREATE TABLE IF NOT EXISTS `kunden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `vorname` varchar(255) COLLATE utf8_bin NOT NULL,
  `strasse` varchar(255) COLLATE utf8_bin NOT NULL,
  `plz` int(5) unsigned zerofill NOT NULL,
  `zusatz` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `passwort` varchar(127) COLLATE utf8_bin NOT NULL,
  `registriertseit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `kunden`
--


-- --------------------------------------------------------

--
-- Table structure for table `lieferungsmethoden`
--

CREATE TABLE IF NOT EXISTS `lieferungsmethoden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  `beschreibung` varchar(511) COLLATE utf8_bin NOT NULL,
  `kosten` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lieferungsmethoden`
--


-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  `beschreibung` varchar(511) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `status`
--


-- --------------------------------------------------------

--
-- Table structure for table `zahlungsmethoden`
--

CREATE TABLE IF NOT EXISTS `zahlungsmethoden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_bin NOT NULL,
  `beschreibung` varchar(255) COLLATE utf8_bin NOT NULL,
  `skript` varchar(255) COLLATE utf8_bin NOT NULL,
  `kosten` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skript` (`skript`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `zahlungsmethoden`
--

