SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `onlineshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `onlineshop` ;

-- -----------------------------------------------------
-- Table `onlineshop`.`artikel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`artikel` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `beschreibung` VARCHAR(1023) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `veroeffentlicht` TINYINT(1) NOT NULL ,
  `verfuegbar` INT(10) UNSIGNED NOT NULL ,
  `kategorieid` INT(11) NOT NULL ,
  `preis` DECIMAL(8,2) NOT NULL ,
  `bildpfad` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `seit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`bestellungen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`bestellungen` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `kundenid` INT(11) NOT NULL ,
  `bestelldatum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `statusid` INT(11) NOT NULL ,
  `zahlungsmethodeid` INT(11) NOT NULL ,
  `lieferungsmethodeid` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `zahlungsmethodeid` (`zahlungsmethodeid` ASC) ,
  INDEX `lieferungsmethodeid` (`lieferungsmethodeid` ASC) ,
  INDEX `kundenid` (`kundenid` ASC) ,
  INDEX `statusid` (`statusid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`bestellungen_artikel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`bestellungen_artikel` (
  `bestellungid` INT(11) NOT NULL ,
  `artikelid` INT(11) NOT NULL ,
  `anzahl` INT(10) UNSIGNED NOT NULL ,
  UNIQUE INDEX `bestellungid` (`bestellungid` ASC, `artikelid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`kategorien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`kategorien` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `beschreibung` VARCHAR(1023) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `superkategorie` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `superkategorie` (`superkategorie` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`kunden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`kunden` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `vorname` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `strasse` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `plz` INT(5) UNSIGNED ZEROFILL NOT NULL ,
  `zusatz` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `passwort` VARCHAR(127) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `registriertseit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`lieferungsmethoden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`lieferungsmethoden` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(127) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `beschreibung` VARCHAR(511) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `kosten` DECIMAL(8,2) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(127) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `beschreibung` VARCHAR(511) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `onlineshop`.`zahlungsmethoden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `onlineshop`.`zahlungsmethoden` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(127) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `beschreibung` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `skript` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `kosten` DECIMAL(8,2) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `skript` (`skript` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
