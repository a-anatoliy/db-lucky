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
    const SELECT_AUX_PHRASES  = 'SELECT subst_name,phrase FROM '.QueryMap::DB_PREFIX.'auxiliary_phrases WHERE page_name=? AND lang_id=?';
    const SELECT_LANGUAGES    = 'SELECT id,title FROM '.QueryMap::DB_PREFIX.'langs WHERE active=1';
    const SELECT_PAGE_DATA    = 'SELECT * FROM '.QueryMap::DB_PREFIX.'pages WHERE page_name=? AND lang_id=? AND active=1';
    const SELECT_PAGES        = 'SELECT id,page_name,announcement FROM '.QueryMap::DB_PREFIX.'pages WHERE sort_id > 0 AND lang_id=? AND active=1 ORDER BY sort_id;';
    const SELECT_FAMOUS       = '(SELECT * FROM '.QueryMap::DB_PREFIX.'famous WHERE lang_id=? ORDER BY RAND() LIMIT ?)';
    const SELECT_FAMOUS_BY_ID = '(SELECT * FROM '.QueryMap::DB_PREFIX.'famous WHERE id=?)';
    const SELECT_ACTIVE_DRESS = '(SELECT count(id) AS total FROM '.QueryMap::DB_PREFIX.'dresses WHERE is_active=1)';

    // this one below returns[RANDOM] a few fields from the DRESSES table
    // + one random image from the DRESS_IMAGES
    // + an appropriate description from the DESCRIPTION table
    // there are four input parameters: DRESS_ID,DRESS_ID, LANG_ID,LANG_ID
    const SELECT_BLOG_RANDOM_DRESS = "(SELECT d.id, UCASE(d.title) as title,lower(d.url_name) as url_name, ld.short_descr, d.like_count,ld.description, ldc.name as collection, 
        (SELECT getRndDressImgThumb(d.id)) as img FROM ".QueryMap::DB_PREFIX."dresses d 
        JOIN ".QueryMap::DB_PREFIX."descriptions ld ON d.id = ? AND d.id = ld.dress_id AND ld.lang_id = ?
        JOIN ".QueryMap::DB_PREFIX."collection_map lcm ON d.id = lcm.dress_id
        JOIN ".QueryMap::DB_PREFIX."collection ldc     ON lcm.collection_id = ldc.id
        ) UNION (
        SELECT d.id, UCASE(d.title) as title,lower(d.url_name) as url_name, ld.short_descr, d.like_count,ld.description, ldc.name as collection, 
        (SELECT getRndDressImgThumb(d.id)) as img FROM ".QueryMap::DB_PREFIX."dresses d
        JOIN ".QueryMap::DB_PREFIX."descriptions ld ON d.id = ? AND d.id = ld.dress_id AND ld.lang_id = ?
        JOIN ".QueryMap::DB_PREFIX."collection_map lcm ON d.id = lcm.dress_id
        JOIN ".QueryMap::DB_PREFIX."collection ldc     ON lcm.collection_id = ldc.id);";

    // there are two input parameters: DRESS_ID, LANG_ID
    // there are few additional requests required: images, colors, size
    // (SELECT getRndDressImg(d.id)) as img
    const SELECT_DRESS_BY_ID = 'SELECT UCASE(d.title) as title,
                                   LOWER(d.url_name) as url_name,
                                   ld.description,  ld.short_descr, ld.product_details, ld.care_advices,
                                   ldc.name as collection, d.price, ldcurr.name as currency,
                                   d.like_count,d.offer_price,d.discount_price,d.price_offer_end_date,d.order_count,d.view_count,d.add_date,
                                        FROM '.QueryMap::DB_PREFIX.'dresses d
                                        JOIN '.QueryMap::DB_PREFIX.'descriptions ld ON d.id = ? AND d.id = ld.dress_id AND ld.lang_id = ?
                                        
                                        JOIN '.QueryMap::DB_PREFIX.'collection_map lcm ON d.id = lcm.dress_id
                                        JOIN '.QueryMap::DB_PREFIX.'collection ldc     ON lcm.collection_id = ldc.id
                                        
                                        JOIN '.QueryMap::DB_PREFIX.'currency_map lcm2  ON d.id = lcm2.dress_id
                                        JOIN '.QueryMap::DB_PREFIX.'currency ldcurr    ON lcm2.currency_id = ldcurr.id;';

    const SELECT_SIZES_BY_DRESS_ID = 'SELECT lds.name as size from '.QueryMap::DB_PREFIX.'size lds 
                                        JOIN '.QueryMap::DB_PREFIX.'size_map ldsm ON ldsm.dress_id=? AND ldsm.size_id=lds.id;';
    const SELECT_COLORS_BY_DRESS_ID = 'SELECT ldc.name as color from '.QueryMap::DB_PREFIX.'color ldc
                                        JOIN '.QueryMap::DB_PREFIX.'color_map ldcm ON ldcm.dress_id=? AND ldcm.color_id=ldc.id;';

    const SELECT_IMAGES_BY_DRESS_ID = '';

    // get NOT RANDOM dresses

}



