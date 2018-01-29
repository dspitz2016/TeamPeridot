-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema RapidsCemetery
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `RapidsCemetery` ;

-- -----------------------------------------------------
-- Schema RapidsCemetery
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `RapidsCemetery` DEFAULT CHARACTER SET utf8 ;
USE `RapidsCemetery` ;

-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Account` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Account` (
  `idAccount` INT NOT NULL,
  `firstName` VARCHAR(80) NULL,
  `lastName` VARCHAR(80) NULL,
  `email` VARCHAR(80) NULL,
  `password` VARCHAR(80) NULL,
  PRIMARY KEY (`idAccount`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Location` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Location` (
  `idLocation` INT NOT NULL,
  `Account_idAccount` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  `url` VARCHAR(2083) NULL,
  `longitude` VARCHAR(45) NULL,
  `latitude` VARCHAR(45) NULL,
  `address` VARCHAR(100) NULL,
  `city` VARCHAR(100) NULL,
  `state` VARCHAR(2) NULL,
  `zipcode` INT NULL,
  PRIMARY KEY (`idLocation`, `Account_idAccount`),
  INDEX `fk_Location_Account_idx` (`Account_idAccount` ASC),
  CONSTRAINT `fk_Location_Account`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `RapidsCemetery`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`Event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`Event` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`Event` (
  `idEvent` INT NOT NULL,
  `Location_idLocation` INT NOT NULL,
  `Location_Account_idAccount` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  `startTime` DATETIME NULL,
  `endTime` DATETIME NULL,
  PRIMARY KEY (`idEvent`, `Location_idLocation`, `Location_Account_idAccount`),
  INDEX `fk_Event_Location1_idx` (`Location_idLocation` ASC, `Location_Account_idAccount` ASC),
  CONSTRAINT `fk_Event_Location1`
    FOREIGN KEY (`Location_idLocation` , `Location_Account_idAccount`)
    REFERENCES `RapidsCemetery`.`Location` (`idLocation` , `Account_idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`FAQ`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`FAQ` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`FAQ` (
  `idFAQ` INT NOT NULL,
  `Location_idLocation` INT NOT NULL,
  `Location_Account_idAccount` INT NOT NULL,
  `question` VARCHAR(150) NULL,
  `answer` BLOB NULL,
  PRIMARY KEY (`idFAQ`, `Location_idLocation`, `Location_Account_idAccount`),
  INDEX `fk_FAQ_Location1_idx` (`Location_idLocation` ASC, `Location_Account_idAccount` ASC),
  CONSTRAINT `fk_FAQ_Location1`
    FOREIGN KEY (`Location_idLocation` , `Location_Account_idAccount`)
    REFERENCES `RapidsCemetery`.`Location` (`idLocation` , `Account_idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`HistoricFilter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`HistoricFilter` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`HistoricFilter` (
  `idHistoricFilter` INT NOT NULL,
  `HistoricFilter` VARCHAR(100) NULL,
  PRIMARY KEY (`idHistoricFilter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`TypeFilter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`TypeFilter` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`TypeFilter` (
  `idTypeFilter` INT NOT NULL,
  `type` VARCHAR(45) NULL,
  PRIMARY KEY (`idTypeFilter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`GraveDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`GraveDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`GraveDetail` (
  `idGraveDetail` INT NOT NULL DEFAULT -1,
  `HistoricFilter_idHistoricFilter` INT NOT NULL,
  `firstName` VARCHAR(75) NULL,
  `middleName` VARCHAR(75) NULL,
  `lastName` VARCHAR(75) NULL,
  `birth` DATETIME NULL,
  `death` DATETIME NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idGraveDetail`, `HistoricFilter_idHistoricFilter`),
  INDEX `fk_GraveDetail_HistoricFilter1_idx` (`HistoricFilter_idHistoricFilter` ASC),
  CONSTRAINT `fk_GraveDetail_HistoricFilter1`
    FOREIGN KEY (`HistoricFilter_idHistoricFilter`)
    REFERENCES `RapidsCemetery`.`HistoricFilter` (`idHistoricFilter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`VegetationDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`VegetationDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`VegetationDetail` (
  `idVegetationDetail` INT NOT NULL DEFAULT -1,
  `commonName` VARCHAR(100) NULL,
  `scientificName` VARCHAR(150) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idVegetationDetail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`MiscDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`MiscDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`MiscDetail` (
  `idMiscDetail` INT NOT NULL DEFAULT -1,
  `name` VARCHAR(75) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idMiscDetail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`PlotDetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`PlotDetail` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`PlotDetail` (
  `idPlotDetail` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `description` BLOB NULL,
  PRIMARY KEY (`idPlotDetail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RapidsCemetery`.`TrackableObject`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RapidsCemetery`.`TrackableObject` ;

CREATE TABLE IF NOT EXISTS `RapidsCemetery`.`TrackableObject` (
  `idTrackableObject` INT NOT NULL,
  `Location_idLocation` INT NOT NULL,
  `Location_Account_idAccount` INT NOT NULL,
  `TypeFilter_idTypeFilter` INT NOT NULL,
  `GraveDetail_idGraveDetail` INT NOT NULL DEFAULT -1,
  `VegetationDetail_idVegetationDetail` INT NOT NULL DEFAULT -1,
  `MiscDetail_idMiscDetail` INT NOT NULL DEFAULT -1,
  `PlotDetail_idPlotDetail` INT NOT NULL DEFAULT -1,
  `longitude` VARCHAR(45) NULL,
  `latitude` VARCHAR(45) NULL,
  `qrCode` VARCHAR(45) NULL,
  `TrackableObjectcol` VARCHAR(45) NULL,
  `imagePath` VARCHAR(2083) NULL,
  `imageDescription` VARCHAR(100) NULL,
  PRIMARY KEY (`idTrackableObject`, `Location_idLocation`, `Location_Account_idAccount`, `TypeFilter_idTypeFilter`, `GraveDetail_idGraveDetail`, `VegetationDetail_idVegetationDetail`, `MiscDetail_idMiscDetail`, `PlotDetail_idPlotDetail`),
  INDEX `fk_TrackableObject_Location1_idx` (`Location_idLocation` ASC, `Location_Account_idAccount` ASC),
  INDEX `fk_TrackableObject_TypeFilter1_idx` (`TypeFilter_idTypeFilter` ASC),
  INDEX `fk_TrackableObject_GraveDetail1_idx` (`GraveDetail_idGraveDetail` ASC),
  INDEX `fk_TrackableObject_VegetationDetail1_idx` (`VegetationDetail_idVegetationDetail` ASC),
  INDEX `fk_TrackableObject_MiscDetail1_idx` (`MiscDetail_idMiscDetail` ASC),
  INDEX `fk_TrackableObject_PlotDetail1_idx` (`PlotDetail_idPlotDetail` ASC),
  CONSTRAINT `fk_TrackableObject_Location1`
    FOREIGN KEY (`Location_idLocation` , `Location_Account_idAccount`)
    REFERENCES `RapidsCemetery`.`Location` (`idLocation` , `Account_idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_TypeFilter1`
    FOREIGN KEY (`TypeFilter_idTypeFilter`)
    REFERENCES `RapidsCemetery`.`TypeFilter` (`idTypeFilter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_GraveDetail1`
    FOREIGN KEY (`GraveDetail_idGraveDetail`)
    REFERENCES `RapidsCemetery`.`GraveDetail` (`idGraveDetail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_VegetationDetail1`
    FOREIGN KEY (`VegetationDetail_idVegetationDetail`)
    REFERENCES `RapidsCemetery`.`VegetationDetail` (`idVegetationDetail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_MiscDetail1`
    FOREIGN KEY (`MiscDetail_idMiscDetail`)
    REFERENCES `RapidsCemetery`.`MiscDetail` (`idMiscDetail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_PlotDetail1`
    FOREIGN KEY (`PlotDetail_idPlotDetail`)
    REFERENCES `RapidsCemetery`.`PlotDetail` (`idPlotDetail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
