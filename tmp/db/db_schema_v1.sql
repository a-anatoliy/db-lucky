CREATE DATABASE IF NOT EXISTS `luckyDress_db`;

USE `luckyDress_db`;

-- ld_langs -------------------------------------------------------------
DROP TABLE IF EXISTS `ld_langs`;
CREATE TABLE `ld_langs` (
  `id`     tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `name`   VARCHAR(6) DEFAULT NULL,
  `title`  VARCHAR(12) DEFAULT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ld_contact_form -------------------------------------------------------
DROP TABLE IF EXISTS `ld_contact_form`;
CREATE TABLE IF NOT EXISTS `ld_contact_form` (
  `id`          tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id`   mediumint(3) DEFAULT NULL,
  `sort_id`     tinyint(3) DEFAULT NULL,
  `field_name`  varchar(255) DEFAULT 'text',
  `label`       varchar(255) DEFAULT NULL,
  `title`       varchar(255) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `edit_date`   int(10) DEFAULT NULL,
  `lang_id`     tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- ld_auxiliary_phrases --------------------------------------------------
DROP TABLE IF EXISTS `ld_auxiliary_phrases`;
CREATE TABLE IF NOT EXISTS `ld_auxiliary_phrases` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `page_name`  VARCHAR(255) DEFAULT NULL,    -- on which page it's used
  `subst_name` VARCHAR(255) DEFAULT NULL,   -- an variable name that will be used for substitution
  `phrase`     varchar(255) DEFAULT NULL,
  `edit_date`  int(10) DEFAULT NULL,
  `lang_id`    tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ld_pages -------------------------------------------------------------
DROP TABLE IF EXISTS `ld_pages`;
CREATE TABLE IF NOT EXISTS `ld_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_name`         VARCHAR(255) DEFAULT NULL,    -- human readable url
  `sort_id`           tinyint(3) DEFAULT NULL,
  `title`             varchar(255) DEFAULT NULL,
  `additional_header` mediumtext,
  `keywords`          mediumtext,
  `meta_description`  varchar(200) DEFAULT NULL,
  `announcement`      varchar(255) DEFAULT NULL,
  `content`           mediumtext,
  `active`            enum('1','0') NOT NULL DEFAULT '1',
  `active_from`       int(10) DEFAULT NULL,
  `lang_id`           tinyint(1) unsigned DEFAULT '1',
  `last_edit`         int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- ld_user_role -------------------------------------------------------------
DROP TABLE IF EXISTS `ld_user_role`;
CREATE TABLE `ld_user_role` (
  `role_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` tinyint(1) UNSIGNED DEFAULT '1',
  `name`    char(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into `ld_user_role` values (1,1,'Administrator'),(2,1,'Subscriber'),(3,1,'Editor'),(4,1,'Author'),(5,1,'TeamMember');

-- ld_famous ----------------------------------------------------------------
DROP TABLE IF EXISTS `ld_famous`;
CREATE TABLE `ld_famous` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `phrase`  varchar(255) DEFAULT NULL,
  `auth`    varchar(255) DEFAULT NULL,
  `lang_id` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- short tables used as a maps START ------------------------------------------
-- ld_currency_map ------------------------------------------------------------
DROP TABLE IF EXISTS `ld_currency_map`;
CREATE TABLE `ld_currency_map` (`dress_id` int(1),`currency_id` int(1) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ld_color_map ---------------------------------------------------------------
DROP TABLE IF EXISTS `ld_color_map`;
CREATE TABLE `ld_color_map` (`dress_id` int(1),`color_id` int(1) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ld_collection_map ----------------------------------------------------------
DROP TABLE IF EXISTS `ld_collection_map`;
CREATE TABLE `ld_collection_map` (`dress_id` int(1),`collection_id` int(1)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ld_size_map ----------------------------------------------------------------
DROP TABLE IF EXISTS `ld_size_map`;
CREATE TABLE `ld_size_map` (`dress_id` int(1),`size_id` int(1)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- short tables used as a maps STOP -------------------------------------------

-- ld_currency ----------------------------------------------------------------
DROP TABLE IF EXISTS `ld_currency`;
CREATE TABLE `ld_currency` (`id` tinyint(1),`name` varchar(10) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ld_color -------------------------------------------------------------------
DROP TABLE IF EXISTS `ld_color`;
CREATE TABLE `ld_color` (`id` tinyint(1),`name` varchar(10) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ld_collection --------------------------------------------------------------
DROP TABLE IF EXISTS `ld_collection`;
CREATE TABLE `ld_collection` (`id` tinyint(1),`name` varchar(10) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ld_size --------------------------------------------------------------------
DROP TABLE IF EXISTS `ld_size`;
CREATE TABLE `ld_size` (`id` tinyint(1),`name` varchar(10) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ld_blog_dress --------------------------------------------------------------
DROP TABLE IF EXISTS `ld_blog_dress`;
CREATE TABLE `ld_blog_dress` (
`id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
`article_num`          varchar(255) DEFAULT NULL, --
`url_name`             varchar(255) DEFAULT NULL, -- a unique url name /aurora/
`title`                varchar(255) DEFAULT NULL, -- dress name
`description_map_id`   int,                -- one of three languages description [dress_id,lang_id]
`short_descr`          varchar(255),
`product_details`      varchar(255),
`price`                int,
`offer_price`          int,
`discount_price`       int,
`price_offer_end_date` int(10) DEFAULT NULL,
`order_count`          int,
`like_count`           int,
`view_count`           int,
`care_advice`          varchar(255),
`size_map_id`          int,        --
`color_map_id`         int,        --
`carrency_map_id`      int,        --
`collection_map_id`    int,        --
`add_date`             int(10) DEFAULT NULL,
`is_available`         enum('1','0') NOT NULL DEFAULT '1',
`is_active`            enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



/*

+------------+
| images     |
+------------+
| id         |
| path       |
| width      |
| height     |
| dress_id   |
+------------+

+----------------------+
| dresses              |
+----------------------+
| id                   |
| article_num          |
| url_name             |
| title                |
| description_map_id   |   ru, pl, en
| short_descr          |
| product_details      |
| price                |
| offer_price          |
| discount_price       |
| price_offer_end_date |
| order_count          |
| like_count           |
| view_count           |
| care_advice          |
| size_map_id          |
| color_map_id         |
| carrency_map_id      |
| collection_map_id    |
| add_date             |
| is_available         |
| is_active            |
+----------------------+

insert into dresses(1,'VW351178','Marie Clare',
'NEW to Bridal Pre-spring 18. Perfectly partnered with our NEW Marie Gown, this embroidered cape in antique blue features a new technique designed to capture the delicacy and beauty of antique lace. Fully embellished with iridescent sequins, this bridal cape has a satin ribbon tie detail for easy styling and is relaxed in fit. The perfect bridal accessory to compliment your wedding dress.<p><br>By Whispers & Echoes<br>Only available at BHLDN<br>Style #45266756</p',
'WHITE BY VERA WANG TEXTURED ORGANZA WEDDING DRESS',
'<div>Back zip with hook-and-eye closure; covered buttons<br>Polyester; polyester lining<br>Bust cups; boning<br>Professionally clean<br>Imported<br>We recommend pairing this gown with a veil in ivory<br>All gowns and select bridal apparel items require an additional shipping charge of $15</div>',
5378,NULL,NULL,NULL,4,4,'Delicate dry clean only',NOW,1,1);


    1 ----

    D:\xampp\htdocs\db-lucky\i\dress\2018\001\_R7A1012.jpg
    D:\xampp\htdocs\db-lucky\i\dress\2018\001\_R7A1024.jpg
    D:\xampp\htdocs\db-lucky\i\dress\2018\001\_R7A1045.jpg

    Аврора (рим.)  богиня утренней зари
    Aurora w mitologii rzymskiej bogini zorzy porannej, brzasku i świtu (poranku).

    Fantastyczna suknia evasé wykonana z białej krepy i kamieni w kolorze złota, tworzących kwiatowe motywy.
    Fason inspirowany Grecją, łączący w sobie spódnicę z niską talią z bardzo twarzowym dekoltem w łódkę oraz niewiarygodnymi, drapowanymi plecami
    z detalami z kamieni przy krągłościach i ramionach.
    Długie rękawy są również zdobione połyskującymi elementami w kolorze złota przy nadgarstkach, podkreślając styl Olimpu.

    2 ----
    D:\xampp\htdocs\db-lucky\i\dress\2018\002\_R7A1126.jpg
    D:\xampp\htdocs\db-lucky\i\dress\2018\002\_R7A1136.jpg
    D:\xampp\htdocs\db-lucky\i\dress\2018\002\_R7A1119.jpg
    D:\xampp\htdocs\db-lucky\i\dress\2018\002\_R7A1630.jpg

    Westa (łac. Vesta) – w mitologii rzymskiej bogini ogniska domowego i państwowego
    Веста (рим.)  богиня домашнего очага

    Urocza i romantyczna dzięki niewinnemu pięknu, które potrafią wydobyć jedynie miękki tiul i kwiaty.
    Tiulowa, dopasowana w talii spódnica evasé, połączona z koronkowym stanikiem z dekoltem w łódkę.
    Bardzo wyjątkowa kreacja dla wyjątkowej panny młodej.


    3 ----
    D:\xampp\htdocs\db-lucky\i\dress\2018\006\_R7A5378.jpg
    D:\xampp\htdocs\db-lucky\i\dress\2018\006\_R7A5378_1.jpg

    Izyda (egip. Iset, Iszet) – w mitologii egipskiej bogini płodności, opiekunka rodzin.
    Изида (египет.)  богиня жизни, плодородия и материнства, которую почитали также и в Риме

    Najbardziej artystyczny romantyzm ucieleśniony w tej koronkowo-tiulowej kreacji.
    Suknia, która posługuje się naturalną magią i przezroczystościami tkaniny, by stworzyć dopasowaną w talii sylwetkę evasé z okrągłym dekoltem i odkrytymi plecami.
    Krótkie koronkowe rękawy odsłaniają również ramiona.


 */
