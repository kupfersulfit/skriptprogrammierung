-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 14. Sep 2012 um 03:21
-- Server Version: 5.5.24
-- PHP-Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `onlineshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung` varchar(1023) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `veroeffentlicht` tinyint(1) NOT NULL,
  `verfuegbar` int(10) unsigned NOT NULL,
  `kategorieid` int(11) NOT NULL,
  `preis` decimal(8,2) NOT NULL,
  `bildpfad` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`id`, `name`, `beschreibung`, `veroeffentlicht`, `verfuegbar`, `kategorieid`, `preis`, `bildpfad`, `seit`) VALUES
(1, 'Rapid Elektroheftgerät Classic 106E TwinRig', 'Für Broschüren- und Ringösenheftung, sowie normales Heften Set bestehend aus zwei Heftgeräten 106e, sowie Zubehör für deren Verbindung, um gleichzeitig mehrfach zu heften Heftleistung: 50 Blatt (80 g/qm Papier) Einstellbare Heftkraft Einstellbare Hefttiefe bis zu 100 mm Montierte Zwinge für Tischbefestigung Schutzblende vor dem Heftmechanismus, Stromversorgung wird unterbrochen, sobald diese angehoben wird Austauschbarer Hefteinsatz gewährleistet einen langjährigen Gebrauch Lieferung inklusive Arbeitstisch für Broschürenheftung und normale Heftung, sowie Fußpedal und Fiberoptikkabel für die Verbindung der beiden Heftgeräte Einsatzhefter für Ringösenheftung nicht im Lieferung enthalten (separates Zubehör)', 1, 31, 2, 2300.00, 'artikel_1.jpg', '2012-09-03 08:45:12'),
(2, 'LEITZ Heftklammern 5572-00-00, Grösse: 26/6, Inhalt: 1000 Stück', 'Heftklammern 26/6     für Heftgerät 5500, 5501, 5502, 5504, 5505, 5508, 5522, 5524,5533, 5560 und Heftzange 5548     Heftleistung: 30 Blatt/3 mm     Material: verzinkt     Inhalt: 1000 Stück', 1, 8, 1, 12.00, 'artikel_2.jpg', '2012-09-09 15:15:40'),
(3, 'Herlitz 1601350 Big Butler V, Schreibtischbox/ Stiftablage, Farbe anthrazit (I like big butlers and i cannot lie...)', 'Schreibtischbox, Herlitz     Big Butler, aus Kunststoff     mit Klebefilm und -abroller, Anspitzer und Zettelhalter     anthrazit     1 Stück in Schachtel', 1, 14, 1, 23.00, 'artikel_3.jpg', '2012-09-02 10:32:30'),
(4, 'Verbotene Fantasien einer Sekretärin', 'Kurzbeschreibung Hocherotischer Film von Phil Defrys! Die bildhübsche Sekretärin Sandra steht total auf ihren Chef. Sie begehrt ihn mit Haut und Haaren und malt sich in ihrer Fantasie die wildesten Sex-Abenteuer aus, die sie in ihren schlaflosen Nächten niederschreibt. Jetzt soll Sandra ihren Boss auf eine Geschäftsreise begleiten. Werden ihre Fantasien jetzt endlich Wirklichkeit? Produktbeschreibungen Ein Phil Defrys Film! Sekretärin Sandra begehrt ihren Chef und in ihren schlaflosen Nächten schreibt sie sich ihre erotischen Fantasien von der Seele. Nun sollen beide auf Geschäftsreise. Werden Sandras Fantasien jetzt Wirklichkeit? Deutscher Ton. DVD, ca. 58 Minuten. ', 1, 12, 2, 42.00, 'artikel_4.jpg', '2012-09-12 13:37:00'),
(5, 'Original Charles Eames EA119 Aluchair Leder', 'Vitra Charles Eames, Aluchair Chrom Hochglanz in Lederschwarz  Modell: EA119n  Bürostuhl mit hoher Lehne, 5 Stern Gestell und Höhenverstellbar. ', 1, 5, 3, 2699.00, 'artikel_5.jpg', '2012-09-05 10:49:54'),
(6, 'Mies van der Rohe Barcelona Sessel für Knoll International ', 'Design: Mies van der Rohe von 1929 Hersteller: Knoll International Alter: unbekannt neuwertig Zustand: mit minimalsten Gebrauchsspuren Modell: Barcelona Sessel Flachfederstahl verchromt gepolstert und mit schwarzem Leder bezogen. Leder wohl Velluto Pelle black  Höhe ca. 77 cm Breite ca. 75 cm Tiefe ca. 77 cm', 1, 11, 3, 3599.00, 'artikel_6.jpg', '2012-09-05 10:53:07'),
(7, 'Artemide TIZIO 50 Schwarz', '      Der Design Klassiker von Richard Sapper 1972     Formales Meisterwerk mit zeitloser Elenganz     Leuchtmittel 1 x max. 50 Watt, 12 V / Gy6,35     Zweistufenschalter am Sockel     Lichtstärke in zwei verschiedenen Intensitäten eingestellbar', 1, 0, 3, 299.00, 'artikel_7.jpg', '2012-09-05 10:55:15'),
(8, 'Versicherungswesen [Taschenbuch]', 'Über den Autor Esther von Krosigk, 1964 in Hamburg geboren, studierte in München Japanologie, Neuere Geschichte und Kunstgeschichte. Nach ihrem Abschluss ging sie im Rahmen eines journalistischen Austauschprogramms der Konrad-Adenauer-Stiftung nach Tokio, und arbeitete dann in den Redaktionen der Abendzeitung, des Bayerischen Rundfunks und der Bild-Zeitung. Bis 2002 war sie Redakteurin im Ressort Wirtschaft und Politik bei Bunte. Heute lebt Esther von Krosigk mit ihrer Familie in Berlin, arbeitet als freie Journalistin und schreibt Romane. -- Dieser Text bezieht sich auf eine andere Ausgabe: Broschiert .', 1, 150, 2, 39.00, 'artikel_8.jpg', '2012-09-05 10:56:56'),
(9, 'Die Neuregelung der Bestechlichkeit und Bestechung im geschäftlichen Verkehr, § 299 StGB [Taschenbuch]', 'Bestechung und Bestechlichkeit im geschäftlichen Verkehr (§ 299 StGB) sind in den letzten Jahren zu einem Dauerthema (auch) in der nicht juristischen Presse geworden. Deutschlandweit verstärken Staatsanwaltschaften ihre Ermittlungen gegen Mitarbeiter der namhaftesten Unternehmen und Konzerne (Daimler Chrysler, BMW, IKEA, Siemens, Infineon, MAN). Die Arbeit befasst sich zunächst ausgehend von dem aktuellen Stand der Gesetzeslage mit der dazu vorliegenden Rechtsprechung und dem Meinungsstand im Schrifttum. Im Fokus der Arbeit steht jedoch die kritische Auseinandersetzung mit dem "Entwurf eines Strafrechtsänderungsgesetzes" vom 04.10.2007 - das "Echo" der Wissenschaft und verschiedenster Interessengruppen werden dabei berücksichtigt und gewürdigt. Der Masterstudiengang mit den individuellen Schwerpunkten Unternehmens- und Wirtschaftsstrafrecht sowie die frühzeitige universitäre Spezialisierung des Autors auf das Strafrecht bilden die theoretische Grundlage dieser Arbeit.', 1, 1, 2, 45.99, 'artikel_9.jpg', '2012-09-05 10:59:18'),
(10, 'HP ColorLaserjet CM6030f MFP A3 color Laserdrucker', ' HP ColorLaserjet CM6030f MFP A3 (ML)  Mit diesem hochleistungsfähigen Color LaserJet Drücker lässt sich Ihre Produktivität steigern. Erstellen Sie Farbdokumente in DIN A3 mit exzellenter Strich-/Bildqualität. Profitieren Sie von den hohen Druckgeschwindigkeiten; Druck-, Kopier-, Scan-, Fax- und Digital Sending-Funktionalität plus hohe Benutzerfreundlichkeit. Produktbeschreibungen Hewlett Packard Color Laserjet cm6030F MFP, Fax, Drucker, Scanner, Kopierer/ Laser color/ Druckaufl.: 1200x600 dpi/ Flachbettscanner mit ADF/ Druckgeschw. Mono: 31 ppm/ Druckgeschw. col: 40 ppm/ Duplex: automatisch/ 33600 bps/ Aufl. opt: 600x600 dpi/ Speicher: 768 MB/ Formate: A4, A5, B4, B5/ ', 1, 3, 4, 8099.99, 'artikel_10.jpg', '2012-09-05 11:02:40'),
(11, 'Montblanc Meisterstück Platinum Classique 164P Kugelschreiber', '     Marke:         MONTBLANC      Serie:         Meisterstück      Größe:         Classique      Artikelbeschreibung:         Schreibsystem: Kugelschreiber mit Drehmechanismus         Gehäuse / Korpus massiv schwarzes Edelharz         Kappe: Schwarzes Edelharz mit weißem Montblanc Stern als Intarsie         Beschläge: Drei platinierte Ringe mit eingeprägtem Montblanc Schriftzug         Clip: platinierter Clip mit individueller Nummerierung         Montblanc Ident. No. 02866      Lieferumfang:         MB Schreibgerät         MB Box         weißer Umkarton         Service Guide', 1, 5, 1, 399.99, 'artikel_11.jpg', '2012-09-05 11:04:33'),
(12, 'Moleskine Plain Notebook Large', 'Endlich gibt es sie wieder, die legendären Moleskine-Notizbücher. Ernest Hemingway, Oscar Wilde und Bruce Chatwin bannten Ihre Gedanken zwischen zwei schwarze Umschläge aus Maulwurfshaut" (englisch: moleskin). Auch Vincent van Gogh und Henri Matisse fingen ihre Eindrücke in Moleskine-Skizzenbüchern ein, bevor sie daraus berühmte Bilder zauberten. Die liebevoll verarbeiteten originalgetreuen Notizbücher im Taschenformat lassen sich mit einem Gummiband verschließen. Eine Falttasche im hinteren Buchdeckel bietet Stauraum für alles, was nicht verloren gehen soll. Damals und heute - eine kleine Geschichte. Moleskine war das legendäre Notizbuch der europäischen Künstler und intellektuellen der letzten zwei Jahrhunderte. Der englische Schriftsteller und ''Weltflaneur'' Bruce Chatwin setzte diese Tradition fort: Er ging nie auf Reisen ohne ausreichende Mengen dieser kleinen Bücher. Bis im Jahr 1986 der letzte Hersteller, ein Familienunternehmen in Tours, die Produktion einstellt. ', 1, 500, 1, 29.99, 'artikel_12.jpg', '2012-09-05 11:07:37');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `bestellungen`
--

INSERT INTO `bestellungen` (`id`, `kundenid`, `bestelldatum`, `statusid`, `zahlungsmethodeid`, `lieferungsmethodeid`) VALUES
(1, 1, '2012-09-05 11:22:03', 1, 2, 2),
(2, 1, '2012-09-14 01:14:13', 1, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen_artikel`
--

CREATE TABLE IF NOT EXISTS `bestellungen_artikel` (
  `bestellungid` int(11) NOT NULL,
  `artikelid` int(11) NOT NULL,
  `anzahl` int(10) unsigned NOT NULL,
  UNIQUE KEY `bestellungid` (`bestellungid`,`artikelid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bestellungen_artikel`
--

INSERT INTO `bestellungen_artikel` (`bestellungid`, `artikelid`, `anzahl`) VALUES
(1, 2, 2),
(1, 3, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE IF NOT EXISTS `kategorien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung` varchar(1023) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `superkategorie` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `superkategorie` (`superkategorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`id`, `name`, `beschreibung`, `superkategorie`) VALUES
(1, 'Schreibwaren', 'Schreibwaren fürs Büro', 0),
(2, 'Buch und DVD', 'Bücher, DVDs', 0),
(3, 'Büromöbel', 'Möbel fürs Büro', 0),
(4, 'Elektronik', 'Elektronisches Zubehör fürs Büro', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunden`
--

CREATE TABLE IF NOT EXISTS `kunden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `plz` int(5) unsigned zerofill NOT NULL,
  `zusatz` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registriertseit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `kunden`
--

INSERT INTO `kunden` (`id`, `name`, `vorname`, `strasse`, `plz`, `zusatz`, `email`, `passwort`, `registriertseit`) VALUES
(1, 'Josef', 'Ackermann', 'See am Hügel 12', 83128, '', 'josef.ackermann@lionsclub.com', '$P$Bm/m/Y/5cQ0D3/F3tACTx4V3Cm7s7g1', '2012-09-05 11:11:11'),
(2, 'Springer', 'Friede', 'Fichtenweg in der Heide 23', 12529, '', 'friede.springer@springergroup.com', '$P$BVcEZoxaLW51bNALFc5TiuqknBIbwv.', '2012-09-05 11:15:22'),
(3, 'Horst', 'von Post', 'Lieferandostraße 42', 53065, '', 'lieferant@post.de', '$P$BVcEZoxaLW51bNALFc5TiuqknBIbwv.', '2012-09-13 22:30:31'),
(4, 'Jesus', 'Nazareth', 'Am Kreuz 13', 12345, 'tod?', 'postvon@oben.com', '$P$BVcEZoxaLW51bNALFc5TiuqknBIbwv.', '2012-09-11 21:21:39'),
(5, 'Alex', 'Cremer', 'Warmweiherst 2233', 52066, '', 'ac@foo.de', '$P$BVcEZoxaLW51bNALFc5TiuqknBIbwv.', '2012-09-14 01:04:59'),
(6, 'Freddy', 'Krueger', 'Elmstree 666', 60606, '', 'freddy.krueger@nightmare.uk', '$P$BQmlmExf5CkH29rZ0IH2RwDM9gUwTr.', '2012-09-11 17:04:59');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferungsmethoden`
--

CREATE TABLE IF NOT EXISTS `lieferungsmethoden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung` varchar(511) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kosten` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `lieferungsmethoden`
--

INSERT INTO `lieferungsmethoden` (`id`, `name`, `beschreibung`, `kosten`) VALUES
(1, 'Standardversand', 'Versanddauer ca. 3-4 Werktage', 9.99),
(2, 'Expressversand', 'Versanddauer zum nächsten Werktag', 14.99),
(3, 'Nachtversand', 'Versanddauer max. 12 Stunden', 19.99);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung` varchar(511) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `status`
--

INSERT INTO `status` (`id`, `name`, `beschreibung`) VALUES
(1, 'Offen', 'Die Bestellung wird demnächst bearbeitet.'),
(2, 'In Bearbeitung', 'Die Bestellung wird verpackt oder befindet sich auf dem Weg in die Versandabteilung.'),
(3, 'Versandt', 'Die Leiferung wurde dem Logistikpartner übergeben.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsmethoden`
--

CREATE TABLE IF NOT EXISTS `zahlungsmethoden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `skript` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kosten` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skript` (`skript`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `zahlungsmethoden`
--

INSERT INTO `zahlungsmethoden` (`id`, `name`, `beschreibung`, `skript`, `kosten`) VALUES
(1, 'Überweisung', 'Überweisung per EC Karte.', '', 0.09),
(2, 'Kreditkarte', 'Zahlung per Kreditkarte.', 'null', 0.99);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
