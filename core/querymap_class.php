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
    const SELECT_LANGUAGES    = "SELECT id,title FROM ".QueryMap::DB_PREFIX."langs WHERE active=1;";
    const SELECT_PAGE_DATA    = "SELECT * FROM ".QueryMap::DB_PREFIX."pages WHERE page_name = ? AND lang_id = ? AND active=1;";

}
