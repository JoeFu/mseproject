-- MySQL Script generated by MySQL Workbench
-- Fri Aug  4 08:51:58 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema studentdata
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema studentdata
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `studentdata` DEFAULT CHARACTER SET utf8 ;
USE `studentdata` ;

-- -----------------------------------------------------
-- Table `studentdata`.`appuser`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentdata`.`appuser` ;

CREATE TABLE IF NOT EXISTS `studentdata`.`appuser` (
  `Id` VARCHAR(64) NOT NULL,
  `FirstName` VARCHAR(30) NULL DEFAULT NULL,
  `LastName` VARCHAR(30) NULL DEFAULT NULL,
  `DateCreated` DATETIME NULL DEFAULT NULL,
  `Password` VARCHAR(45) NULL DEFAULT NULL,
  `RepeatPassword` VARCHAR(45) NULL DEFAULT NULL,
  `UserTypeId` INT(11) NULL DEFAULT NULL,
  `Email` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC),
  INDEX `UserTypeAppUser_idx` (`UserTypeId` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `studentdata`.`component`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentdata`.`component` ;

CREATE TABLE IF NOT EXISTS `studentdata`.`component` (
  `Id` INT(11) NOT NULL,
  `Name` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `studentdata`.`eventtype`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentdata`.`eventtype` ;

CREATE TABLE IF NOT EXISTS `studentdata`.`eventtype` (
  `Id` INT(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Description` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `studentdata`.`usertype`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentdata`.`usertype` ;

CREATE TABLE IF NOT EXISTS `studentdata`.`usertype` (
  `Id` INT(11) NOT NULL,
  `Type` VARCHAR(45) NULL DEFAULT NULL,
  `Description` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `studentdata`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentdata`.`user` ;

CREATE TABLE IF NOT EXISTS `studentdata`.`user` (
  `Id` VARCHAR(64) NOT NULL,
  `FKUserTypeId` INT(11) NULL DEFAULT NULL,
  `FKParentId` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC),
  INDEX `FKIdParentId_idx` (`FKParentId` ASC),
  INDEX `FKUserUserType_idx` (`FKUserTypeId` ASC),
  CONSTRAINT `FKIdParentId`
    FOREIGN KEY (`FKParentId`)
    REFERENCES `studentdata`.`user` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FKUserUserType`
    FOREIGN KEY (`FKUserTypeId`)
    REFERENCES `studentdata`.`usertype` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `studentdata`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentdata`.`event` ;

CREATE TABLE IF NOT EXISTS `studentdata`.`event` (
  `Id` VARCHAR(64) NOT NULL,
  `Name` VARCHAR(100) NULL DEFAULT NULL,
  `Description` VARCHAR(150) NULL DEFAULT NULL,
  `FKComponentId` INT(11) NULL DEFAULT NULL,
  `FKEventTypeId` INT(11) NULL DEFAULT NULL,
  `FKUserId` VARCHAR(64) NULL DEFAULT NULL,
  `Grade` DECIMAL(10,0) NULL DEFAULT NULL,
  `StartDate` DATETIME NULL DEFAULT NULL,
  `DueDate` DATETIME NULL DEFAULT NULL,
  `Version` VARCHAR(10) NULL DEFAULT NULL,
  `CourseName` VARCHAR(100) NULL DEFAULT NULL,
  `Semester` VARCHAR(45) NULL DEFAULT NULL,
  `SchoolYear` INT(11) NULL DEFAULT NULL,
  `EventTime` DATETIME NULL DEFAULT NULL,
  `Context` VARCHAR(200) NULL DEFAULT NULL,
  `Repository` INT(11) NULL DEFAULT NULL,
  `Prefix` VARCHAR(20) NULL DEFAULT NULL,
  `DataSourceType` INT(11) NULL DEFAULT NULL,
  `AssignmentName` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC),
  INDEX `FKEventComponent_idx` (`FKComponentId` ASC),
  INDEX `FKEventEventType_idx` (`FKEventTypeId` ASC),
  INDEX `FKEventUser_idx` (`FKUserId` ASC),
  CONSTRAINT `FKEventComponent`
    FOREIGN KEY (`FKComponentId`)
    REFERENCES `studentdata`.`component` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FKEventEventType`
    FOREIGN KEY (`FKEventTypeId`)
    REFERENCES `studentdata`.`eventtype` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FKEventUser`
    FOREIGN KEY (`FKUserId`)
    REFERENCES `studentdata`.`user` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `studentdata`;

DELIMITER $$

USE `studentdata`$$
DROP TRIGGER IF EXISTS `studentdata`.`BEFORE_INSERT_APPUSERTABLE` $$
USE `studentdata`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `studentdata`.`BEFORE_INSERT_APPUSERTABLE`
BEFORE INSERT ON `studentdata`.`appuser`
FOR EACH ROW
SET new.Id = uuid()$$


USE `studentdata`$$
DROP TRIGGER IF EXISTS `studentdata`.`BEFORE_INSERT_EVENTTABLE` $$
USE `studentdata`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `studentdata`.`BEFORE_INSERT_EVENTTABLE`
BEFORE INSERT ON `studentdata`.`event`
FOR EACH ROW
SET new.Id = uuid()$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
