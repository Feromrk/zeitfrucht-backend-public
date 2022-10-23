-- MySQL Script generated by MySQL Workbench
-- Mo 17 Jun 2019 22:20:12 CEST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DB3701281
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DB3701281
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB3701281` DEFAULT CHARACTER SET utf8 ;
USE `DB3701281` ;

-- -----------------------------------------------------
-- Table `DB3701281`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`admin` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`admin` (
  `idadmin` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(64) NOT NULL,
  `last_name` VARCHAR(64) NOT NULL,
  `nickname` VARCHAR(64) NULL,
  `email` VARCHAR(64) NOT NULL,
  `pw` VARCHAR(256) NOT NULL,
  `telnr` VARCHAR(64) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idadmin`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`room`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`room` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`room` (
  `idroom` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `admin_idadmin` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idroom`),
  UNIQUE INDEX `fk_admin_idadmin_UNIQUE` (`admin_idadmin` ASC),
  CONSTRAINT `fk_room_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `DB3701281`.`admin` (`idadmin`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`user` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(64) NOT NULL,
  `last_name` VARCHAR(64) NOT NULL,
  `nickname` VARCHAR(64) NULL,
  `email` VARCHAR(64) NOT NULL,
  `pw` VARCHAR(256) NOT NULL,
  `telnr` VARCHAR(64) NULL,
  `superuser` TINYINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`room_has_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`room_has_user` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`room_has_user` (
  `user_iduser` INT NOT NULL,
  `room_idroom` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_iduser`, `room_idroom`),
  INDEX `fk_user_has_room_room1_idx` (`room_idroom` ASC),
  INDEX `fk_user_has_room_user_idx` (`user_iduser` ASC),
  CONSTRAINT `fk_user_has_room_user`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `DB3701281`.`user` (`iduser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_has_room_room1`
    FOREIGN KEY (`room_idroom`)
    REFERENCES `DB3701281`.`room` (`idroom`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`shift`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`shift` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`shift` (
  `date` DATE NOT NULL,
  `start` TIME NOT NULL,
  `end` TIME NULL,
  `admin_idadmin` INT NULL,
  `room_idroom` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`date`, `start`, `room_idroom`),
  INDEX `fk_shift_admin1_idx` (`admin_idadmin` ASC),
  INDEX `fk_shift_room1_idx` (`room_idroom` ASC),
  CONSTRAINT `fk_shift_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `DB3701281`.`admin` (`idadmin`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_shift_room1`
    FOREIGN KEY (`room_idroom`)
    REFERENCES `DB3701281`.`room` (`idroom`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`notification_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`notification_type` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`notification_type` (
  `idnotification` INT NOT NULL AUTO_INCREMENT,
  `text` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idnotification`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`notification_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`notification_user` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`notification_user` (
  `idnotifications` INT NOT NULL AUTO_INCREMENT,
  `seen` TINYINT NOT NULL,
  `notification_type_idnotification` INT NOT NULL,
  `user_iduser` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `fk_notification_notification_type1_idx` (`notification_type_idnotification` ASC),
  INDEX `fk_notification_user1_idx` (`user_iduser` ASC),
  PRIMARY KEY (`idnotifications`),
  CONSTRAINT `fk_notification_notification_type1`
    FOREIGN KEY (`notification_type_idnotification`)
    REFERENCES `DB3701281`.`notification_type` (`idnotification`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_notification_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `DB3701281`.`user` (`iduser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`notification_admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`notification_admin` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`notification_admin` (
  `idnotifications` INT NOT NULL AUTO_INCREMENT,
  `seen` TINYINT NOT NULL,
  `admin_idadmin` INT NOT NULL,
  `notification_type_idnotification` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idnotifications`),
  INDEX `fk_notification_admin_admin1_idx` (`admin_idadmin` ASC),
  INDEX `fk_notification_admin_notification_type1_idx` (`notification_type_idnotification` ASC),
  CONSTRAINT `fk_notification_admin_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `DB3701281`.`admin` (`idadmin`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_notification_admin_notification_type1`
    FOREIGN KEY (`notification_type_idnotification`)
    REFERENCES `DB3701281`.`notification_type` (`idnotification`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB3701281`.`shift_has_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DB3701281`.`shift_has_user` ;

CREATE TABLE IF NOT EXISTS `DB3701281`.`shift_has_user` (
  `shift_date` DATE NOT NULL,
  `shift_start` TIME NOT NULL,
  `shift_room_idroom` INT NOT NULL,
  `user_iduser` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shift_date`, `shift_start`, `shift_room_idroom`, `user_iduser`),
  INDEX `fk_shift_has_user1_user1_idx` (`user_iduser` ASC),
  INDEX `fk_shift_has_user1_shift1_idx` (`shift_date` ASC, `shift_start` ASC, `shift_room_idroom` ASC),
  CONSTRAINT `fk_shift_has_user1_shift1`
    FOREIGN KEY (`shift_date` , `shift_start` , `shift_room_idroom`)
    REFERENCES `DB3701281`.`shift` (`date` , `start` , `room_idroom`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_shift_has_user1_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `DB3701281`.`user` (`iduser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;