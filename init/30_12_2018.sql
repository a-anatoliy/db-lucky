-- MySQL Script generated by MySQL Workbench
-- Sun Dec 30 14:24:34 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema luckyDress_db
-- -----------------------------------------------------
-- LuckyDress DB
DROP SCHEMA IF EXISTS `luckyDress_db` ;

-- -----------------------------------------------------
-- Schema luckyDress_db
--
-- LuckyDress DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `luckyDress_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `luckyDress_db` ;

-- -----------------------------------------------------
-- Table `ld_langs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_langs` ;

CREATE TABLE IF NOT EXISTS `ld_langs` (
  `id` TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(6) NOT NULL,
  `title` VARCHAR(12) NOT NULL,
  `active` ENUM('1', '0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'available languages';


-- -----------------------------------------------------
-- Table `ld_auxiliary_phrases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_auxiliary_phrases` ;

CREATE TABLE IF NOT EXISTS `ld_auxiliary_phrases` (
  `id` TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` VARCHAR(255) NOT NULL,
  `subst_name` VARCHAR(255) NULL DEFAULT NULL,
  `phrase` VARCHAR(255) NOT NULL,
  `edit_date` INT(10) NULL DEFAULT NULL,
  `lang_id` TINYINT(1) UNSIGNED NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `fk_ld_auxiliary_phrases_ld_langs1_idx` (`lang_id`),
  CONSTRAINT `fk_ld_auxiliary_phrases_ld_langs1`
    FOREIGN KEY (`lang_id`)
    REFERENCES `ld_langs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'auxiliary phrases used on web-site';


-- -----------------------------------------------------
-- Table `ld_dresses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_dresses` ;

CREATE TABLE IF NOT EXISTS `ld_dresses` (
  `id` INT(3) UNSIGNED NOT NULL,
  `article_num` VARCHAR(255) NULL DEFAULT NULL,
  `url_name` VARCHAR(255) NULL DEFAULT NULL COMMENT 'all of dresses',
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  `offer_price` INT(11) NULL DEFAULT NULL,
  `discount_price` INT(11) NULL DEFAULT NULL,
  `price_offer_end_date` INT(10) NULL DEFAULT NULL,
  `order_count` INT(11) NULL DEFAULT NULL,
  `like_count` INT(11) NULL DEFAULT NULL,
  `view_count` INT(11) NULL DEFAULT NULL,
  `add_date` INT(10) NULL DEFAULT NULL,
  `is_available` ENUM('1', '0') NOT NULL DEFAULT '1',
  `is_active` ENUM('1', '0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `idx_ld_blog_dress_id` (`id`),
  UNIQUE INDEX `article_num_UNIQUE` (`article_num`),
  UNIQUE INDEX `url_name_UNIQUE` (`url_name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'all of available dresses'
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `ld_collection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_collection` ;

CREATE TABLE IF NOT EXISTS `ld_collection` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ld_collection_map`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_collection_map` ;

CREATE TABLE IF NOT EXISTS `ld_collection_map` (
  `dress_id` INT(3) UNSIGNED NOT NULL,
  `collection_id` TINYINT(1) NOT NULL,
  INDEX `fk_ld_collection_map_ld_dresses1_idx` (`dress_id`),
  INDEX `fk_ld_collection_map_ld_collection1_idx` (`collection_id`),
  CONSTRAINT `fk_ld_collection_map_ld_dresses1`
    FOREIGN KEY (`dress_id`)
    REFERENCES `ld_dresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ld_collection_map_ld_collection1`
    FOREIGN KEY (`collection_id`)
    REFERENCES `ld_collection` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'linked with all of COLLECTIONs table';


-- -----------------------------------------------------
-- Table `ld_color`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_color` ;

CREATE TABLE IF NOT EXISTS `ld_color` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ld_color_map`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_color_map` ;

CREATE TABLE IF NOT EXISTS `ld_color_map` (
  `dress_id` INT(3) UNSIGNED NOT NULL,
  `color_id` TINYINT(1) NOT NULL,
  INDEX `fk_ld_color_map_ld_dresses1_idx` (`dress_id`),
  INDEX `fk_ld_color_map_ld_color1_idx` (`color_id`),
  CONSTRAINT `fk_ld_color_map_ld_dresses1`
    FOREIGN KEY (`dress_id`)
    REFERENCES `ld_dresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ld_color_map_ld_color1`
    FOREIGN KEY (`color_id`)
    REFERENCES `ld_color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'linked to table contains all of available colors';


-- -----------------------------------------------------
-- Table `ld_contact_form`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_contact_form` ;

CREATE TABLE IF NOT EXISTS `ld_contact_form` (
  `id` TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` MEDIUMINT(3) NULL DEFAULT NULL,
  `sort_id` TINYINT(3) NULL DEFAULT NULL,
  `field_name` VARCHAR(255) NOT NULL DEFAULT 'text',
  `label` VARCHAR(255) NULL DEFAULT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `placeholder` VARCHAR(255) NULL DEFAULT NULL,
  `edit_date` INT(10) NULL DEFAULT NULL,
  `lang_id` TINYINT(1) UNSIGNED NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `fk_ld_contact_form_ld_langs1_idx` (`lang_id`),
  CONSTRAINT `fk_ld_contact_form_ld_langs1`
    FOREIGN KEY (`lang_id`)
    REFERENCES `ld_langs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'fields used in the contact form';


-- -----------------------------------------------------
-- Table `ld_currency`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_currency` ;

CREATE TABLE IF NOT EXISTS `ld_currency` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ld_currency_map`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_currency_map` ;

CREATE TABLE IF NOT EXISTS `ld_currency_map` (
  `dress_id` INT(3) UNSIGNED NOT NULL,
  `currency_id` TINYINT(1) NOT NULL,
  INDEX `fk_ld_currency_map_ld_dresses1_idx` (`dress_id`),
  INDEX `fk_ld_currency_map_ld_currency1_idx` (`currency_id`),
  CONSTRAINT `fk_ld_currency_map_ld_dresses1`
    FOREIGN KEY (`dress_id`)
    REFERENCES `ld_dresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ld_currency_map_ld_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `ld_currency` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ld_famous`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_famous` ;

CREATE TABLE IF NOT EXISTS `ld_famous` (
  `id` TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phrase` VARCHAR(500) NOT NULL,
  `auth` VARCHAR(255) NULL DEFAULT NULL,
  `lang_id` TINYINT(1) UNSIGNED NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `fk_ld_famous_ld_langs1_idx` (`lang_id`),
  CONSTRAINT `fk_ld_famous_ld_langs1`
    FOREIGN KEY (`lang_id`)
    REFERENCES `ld_langs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'the famous phrases. eng/ru';


-- -----------------------------------------------------
-- Table `ld_pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_pages` ;

CREATE TABLE IF NOT EXISTS `ld_pages` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` VARCHAR(255) NOT NULL,
  `sort_id` TINYINT(3) NULL DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL COMMENT 'the web-site content',
  `additional_header` MEDIUMTEXT NULL DEFAULT NULL,
  `keywords` MEDIUMTEXT NULL DEFAULT NULL,
  `meta_description` VARCHAR(200) NULL DEFAULT NULL,
  `announcement` VARCHAR(255) NULL DEFAULT NULL,
  `content` MEDIUMTEXT NULL DEFAULT NULL,
  `active` ENUM('1', '0') NOT NULL DEFAULT '1',
  `active_from` INT(10) NULL DEFAULT NULL,
  `lang_id` TINYINT(1) UNSIGNED NULL DEFAULT '1',
  `last_edit` INT(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ld_pages_ld_langs1_idx` (`lang_id`),
  CONSTRAINT `fk_ld_pages_ld_langs1`
    FOREIGN KEY (`lang_id`)
    REFERENCES `ld_langs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'web-site pages content';


-- -----------------------------------------------------
-- Table `ld_size`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_size` ;

CREATE TABLE IF NOT EXISTS `ld_size` (
  `id` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ld_size_map`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_size_map` ;

CREATE TABLE IF NOT EXISTS `ld_size_map` (
  `dress_id` INT(3) UNSIGNED NOT NULL,
  `size_id` TINYINT(1) NOT NULL,
  INDEX `fk_ld_size_map_ld_dresses1_idx` (`dress_id`),
  INDEX `fk_ld_size_map_ld_size1_idx` (`size_id`),
  CONSTRAINT `fk_ld_size_map_ld_dresses1`
    FOREIGN KEY (`dress_id`)
    REFERENCES `ld_dresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ld_size_map_ld_size1`
    FOREIGN KEY (`size_id`)
    REFERENCES `ld_size` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'related to SIZE table, that contains all of sizes';


-- -----------------------------------------------------
-- Table `ld_user_role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_user_role` ;

CREATE TABLE IF NOT EXISTS `ld_user_role` (
  `role_id` TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang_id` TINYINT(1) UNSIGNED NULL DEFAULT '1',
  `name` CHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  INDEX `fk_ld_user_role_ld_langs1_idx` (`lang_id`),
  CONSTRAINT `fk_ld_user_role_ld_langs1`
    FOREIGN KEY (`lang_id`)
    REFERENCES `ld_langs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'user roles';


-- -----------------------------------------------------
-- Table `ld_descriptions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_descriptions` ;

CREATE TABLE IF NOT EXISTS `ld_descriptions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang_id` TINYINT(1) NOT NULL DEFAULT 1,
  `dress_id` INT(3) UNSIGNED NOT NULL,
  `description` TEXT NULL,
  `short_descr` TEXT NULL COMMENT 'short dress description',
  `product_details` TEXT NULL COMMENT 'Product description.',
  `care_advices` TEXT NULL COMMENT 'How care about this product',
  PRIMARY KEY (`id`, `dress_id`),
  INDEX `fk_ld_descriptions_ld_dresses1_idx` (`dress_id`),
  CONSTRAINT `fk_ld_descriptions_ld_dresses1`
    FOREIGN KEY (`dress_id`)
    REFERENCES `ld_dresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin
COMMENT = 'contains dress description, short description, care advices and product details  available on three languages ideally';


-- -----------------------------------------------------
-- Table `ld_dress_images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ld_dress_images` ;

CREATE TABLE IF NOT EXISTS `ld_dress_images` (
  `id` INT(3) NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `width` INT NOT NULL,
  `height` INT NOT NULL,
  `is_active` ENUM('1', '0') NOT NULL DEFAULT '1',
  `dress_id` INT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name`),
  INDEX `fk_ld_dress_images_ld_dresses1_idx` (`dress_id`),
  CONSTRAINT `fk_ld_dress_images_ld_dresses1`
    FOREIGN KEY (`dress_id`)
    REFERENCES `ld_dresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin
COMMENT = 'the dress images';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
