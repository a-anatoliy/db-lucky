CREATE DATABASE IF NOT EXISTS `luckyDress_db`;

USE `luckyDress_db`;

-- ld_langs -------------------------------------------------------------
DROP TABLE IF EXISTS `ld_langs`;
CREATE TABLE `ld_langs` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(6) DEFAULT NULL,
  `title` VARCHAR(12) DEFAULT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ld_contact_form -------------------------------------------------------
DROP TABLE IF EXISTS `ld_contact_form`;
CREATE TABLE IF NOT EXISTS `ld_contact_form` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(3) DEFAULT NULL,
  `sort_id` tinyint(3) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT 'text',
  `label` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `placeholder`varchar(255) DEFAULT NULL,
  `edit_date` int(10) DEFAULT NULL,
  `lang_id` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- ld_auxiliary_phrases -------------------------------------------------------------
DROP TABLE IF EXISTS `ld_auxiliary_phrases`;
CREATE TABLE IF NOT EXISTS `ld_auxiliary_phrases` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `page_name` VARCHAR(255) DEFAULT NULL,             -- on which page it's used
  `subst_name` VARCHAR(255) DEFAULT NULL,             -- on which page it's used
  `phrase` varchar(255) DEFAULT NULL,
  `edit_date` int(10) DEFAULT NULL,
  `lang_id` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;


-- ld_user_role -------------------------------------------------------------
DROP TABLE IF EXISTS `ld_user_role`;
CREATE TABLE `ld_user_role` (
  `role_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` tinyint(1) UNSIGNED DEFAULT '1',
  `name` char(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into `ld_user_role` values (1,1,'Administrator'),(2,1,'Subscriber'),(3,1,'Editor'),(4,1,'Author'),(5,1,'TeamMember');