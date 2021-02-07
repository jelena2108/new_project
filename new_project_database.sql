-- MySQL Script generated by MySQL Workbench
-- Thu Jan  7 19:14:51 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema new_project1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema new_project1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `new_project1` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `new_project1` ;

-- -----------------------------------------------------
-- Table `new_project1`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `new_project1`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `new_project1`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `new_project1`.`posts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` LONGTEXT NOT NULL,
  `time` DATETIME NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `post_approved` INT(11) NOT NULL,
  `category_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_id` (`category_id` ASC) VISIBLE,
  CONSTRAINT `fk_category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `new_project1`.`categories` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `new_project1`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `new_project1`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `admin` INT(11) NOT NULL,
  `subscriber` INT(11) NOT NULL,
  `user_visitor` INT(11) NOT NULL,
  `delete_user` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `new_project1`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `new_project1`.`comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(255) NOT NULL,
  `comment_time` DATETIME NOT NULL,
  `comment_approved` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `post_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_id` (`user_id` ASC) VISIBLE,
  INDEX `fk_post_id` (`post_id` ASC) VISIBLE,
  CONSTRAINT `fk_post_id`
    FOREIGN KEY (`post_id`)
    REFERENCES `new_project1`.`posts` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `new_project1`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `new_project1`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `new_project1`.`likes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `likes` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL,
  `id_post` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_id_user` (`id_user` ASC) VISIBLE,
  INDEX `fk_id_post` (`id_post` ASC) VISIBLE,
  CONSTRAINT `fk_id_post`
    FOREIGN KEY (`id_post`)
    REFERENCES `new_project1`.`posts` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_id_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `new_project1`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 54
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
