-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema re_portfolio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema re_portfolio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `re_portfolio` DEFAULT CHARACTER SET utf8 ;
USE `re_portfolio` ;

-- -----------------------------------------------------
-- Table `re_portfolio`.`software`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`software` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `type` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_category1_idx` (`type` ASC),
  CONSTRAINT `fk_category_category1`
    FOREIGN KEY (`type`)
    REFERENCES `re_portfolio`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`projekt_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`projekt_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projekt_type_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_projekt_type_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `re_portfolio`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`arbejds_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`arbejds_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`projekt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`projekt` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `favorite` INT NOT NULL,
  `dato` DATE NOT NULL,
  `description` TEXT(500) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `software_id` INT NOT NULL,
  `projekt_type_id` INT NOT NULL,
  `arbejds_type_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projekt_software_idx` (`software_id` ASC),
  INDEX `fk_projekt_projekt_type1_idx` (`projekt_type_id` ASC),
  INDEX `fk_projekt_arbejds_type1_idx` (`arbejds_type_id` ASC),
  CONSTRAINT `fk_projekt_software`
    FOREIGN KEY (`software_id`)
    REFERENCES `re_portfolio`.`software` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_projekt_type1`
    FOREIGN KEY (`projekt_type_id`)
    REFERENCES `re_portfolio`.`projekt_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_arbejds_type1`
    FOREIGN KEY (`arbejds_type_id`)
    REFERENCES `re_portfolio`.`arbejds_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`billeder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`billeder` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `sted` TEXT(500) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`billeder_has_projekt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`billeder_has_projekt` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `projekt_id` INT NOT NULL,
  `billeder_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_billede_has_projekt_projekt1_idx` (`projekt_id` ASC),
  INDEX `fk_billede_has_projekt_billede1_idx` (`billeder_id` ASC),
  INDEX `fk_billeder_has_projekt_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_billede_has_projekt_projekt1`
    FOREIGN KEY (`projekt_id`)
    REFERENCES `re_portfolio`.`projekt` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_billede_has_projekt_billede1`
    FOREIGN KEY (`billeder_id`)
    REFERENCES `re_portfolio`.`billeder` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_billeder_has_projekt_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `re_portfolio`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`diagrammer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`diagrammer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`projekt_has_diagrammer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`projekt_has_diagrammer` (
  `projekt_id` INT NOT NULL,
  `diagrammer_id` INT NOT NULL,
  PRIMARY KEY (`projekt_id`, `diagrammer_id`),
  INDEX `fk_projekt_has_diagram_diagram1_idx` (`diagrammer_id` ASC),
  INDEX `fk_projekt_has_diagram_projekt1_idx` (`projekt_id` ASC),
  CONSTRAINT `fk_projekt_has_diagram_projekt1`
    FOREIGN KEY (`projekt_id`)
    REFERENCES `re_portfolio`.`projekt` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_has_diagram_diagram1`
    FOREIGN KEY (`diagrammer_id`)
    REFERENCES `re_portfolio`.`diagrammer` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`sprog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`sprog` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sprog_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_sprog_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `re_portfolio`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`projekt_has_sprog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`projekt_has_sprog` (
  `projekt_id` INT NOT NULL,
  `sprog_id` INT NOT NULL,
  PRIMARY KEY (`projekt_id`, `sprog_id`),
  INDEX `fk_projekt_has_sprog_sprog1_idx` (`sprog_id` ASC),
  INDEX `fk_projekt_has_sprog_projekt1_idx` (`projekt_id` ASC),
  CONSTRAINT `fk_projekt_has_sprog_projekt1`
    FOREIGN KEY (`projekt_id`)
    REFERENCES `re_portfolio`.`projekt` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projekt_has_sprog_sprog1`
    FOREIGN KEY (`sprog_id`)
    REFERENCES `re_portfolio`.`sprog` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`education`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`education` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sted` VARCHAR(100) NOT NULL,
  `tittel` VARCHAR(100) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`work_experience`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`work_experience` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sted` VARCHAR(100) NOT NULL,
  `tittel` VARCHAR(100) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`qualifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`qualifications` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `re_portfolio`.`about_me`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `re_portfolio`.`about_me` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `teskt` TEXT(500) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
