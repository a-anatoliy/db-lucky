<?php

/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 22.04.2018
 * Time: 19:24
 */
class QueryMap {

    const DB_PREFIX = 'ld_';
    const SELECT_FORM_PHRASES = "SELECT field_name,placeholder,label,title FROM ".QueryMap::DB_PREFIX."contact_form WHERE lang_id=? GROUP BY field_name ORDER BY sort_id;";
    const SELECT_AUX_PHRASES  = "SELECT subst_name,phrase FROM ".QueryMap::DB_PREFIX."auxiliary_phrases WHERE page_name=? AND lang_id=?;";
    const SELECT_LANGUAGES    = "SELECT id,title FROM ".QueryMap::DB_PREFIX."langs WHERE active=1;";
    const SELECT_PAGE_DATA    = "SELECT * FROM ".QueryMap::DB_PREFIX."pages WHERE page_name=? AND lang_id=? AND active=1;";
    const SELECT_PAGES        = "SELECT id,page_name,announcement FROM ".QueryMap::DB_PREFIX."pages WHERE sort_id > 0 AND lang_id=? AND active=1 ORDER BY sort_id;";
    const SELECT_FAMOUS       = "SELECT * FROM ".QueryMap::DB_PREFIX."famous WHERE lang_id=? ORDER BY RAND() LIMIT ?;";
    const SELECT_FAMOUS_BY_ID = "SELECT * FROM ".QueryMap::DB_PREFIX."famous WHERE id=?";

    // this one below returns[RANDOM] a few fields from the DRESSES table
    // + one random image from the DRESS_IMAGES
    // + an appropriate description from the DESCRIPTION table
    const SELECT_RANDOM_DRESS = "SELECT d.title, d.short_descr, d.url_name,d.like_count,
  ldi.path,ldi.name,ldi.width,ldi.height,
  ld.description, (SELECT d.id FROM ".QueryMap::DB_PREFIX."dresses ORDER BY RAND() LIMIT 1)
  FROM ".QueryMap::DB_PREFIX."dresses d
  INNER JOIN ".QueryMap::DB_PREFIX."dress_images ldi ON ldi.dress_id = d.id AND d.id = ldi.dress_id AND ldi.is_active = 1 AND d.is_active = 1
  INNER JOIN ".QueryMap::DB_PREFIX."descriptions ld ON d.id = ld.dress_id AND ld.lang_id = ? ORDER BY RAND() LIMIT ?;";

    // there are two input parameters: DRESS_ID, LANG_ID
    // there are few additional requests required: images, colors, size
    const SELECT_DRESS_BY_ID = "SELECT d.title, d.short_descr, d.url_name,d.like_count,
  ld.description, ldc.name, ldcurr.name
FROM ".QueryMap::DB_PREFIX."dresses d
  INNER JOIN ".QueryMap::DB_PREFIX."descriptions ld
    ON d.id = ?
    AND d.id = ld.dress_id AND ld.lang_id = ?
-- get collection name
  INNER JOIN ".QueryMap::DB_PREFIX."collection_map lcm ON d.id = lcm.dress_id
  INNER JOIN ".QueryMap::DB_PREFIX."collection ldc ON lcm.collection_id = ldc.id
-- get currency name
  INNER JOIN ".QueryMap::DB_PREFIX."currency_map lcm2 ON d.id = lcm2.dress_id
  INNER JOIN ".QueryMap::DB_PREFIX."currency ldcurr ON lcm2.currency_id = ldcurr.id
;";
    const SELECT_IMAGES_BY_DRESS_ID = "";
    const SELECT_SIZES_BY_DRESS_ID = "";
    const SELECT_COLORS_BY_DRESS_ID = "";

    // get NOT RANDOM dresses

}



