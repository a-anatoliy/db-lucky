<?php

/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 13.02.2018
 * Time: 17:03
 */

defined('_ATHREERUN') or die('Ай-яй-яй, сюда нельзя!');

class MenuController  {

    private $ul_open, $ul_close, $li_open, $activeHrefStr, $lang, $s_langs, $model, $dbh, $langID;
//    private $pageIDs = array();

    public function __construct($parent) {

        if (empty($parent)) {
            echo "The parent object didn't initialized properly!";
            return 0;
        } else {

            $this->ul_open  = '<ul class="navbar-nav">';
            $this->ul_close = '</ul>';
            $this->li_open  = '<li class="nav-item">';
            $this->activeHrefStr = '<a class="nav-link active-link" href="%s">%s</a>';

            foreach ($parent as $k => $v) {
                $this->$k = $v;
            }

        }

    }

    public function renderBase() {
//        $separator = "\n\t";
        $separator = " ";
        $outString = $this->ul_open;
        $pages = $this->dbh->getAll(QueryMap::SELECT_PAGES,[$this->langID]);


        foreach ($pages as $item) {

                $pageTitle = $item['announcement'];

                /*
                 * if there are some subItems exists, like:
                 * 5 => array('href' => 'media'  )
                 * 5 => array('href' => 'galleries', 'items' => array( 1=>'001',2=>'002' ) ),
                */
                if (is_array($item) && array_key_exists('items',$item)) {
                    $outString .= $separator
                        . '<li class="nav-item dropdown">'
    //                    . $separator
                        . '<a class="nav-link dropdown-toggle" data-toggle="dropdown" id="Preview" href="#" role="button" aria-haspopup="true" aria-expanded="false">'
                        .     $pageTitle
                        . '</a>'
                        . '<div class="dropdown-menu" aria-labelledby="Preview">'
                        .     $this->buildDropDown($pageTitle,$item['items'])
                        . '</div></li>';
                    continue;
                } else {
                    if ($item['page_name'] === $this->model) {
                        $format = $this->activeHrefStr;
                        $url = '#top';
                    } else {
                        $format = '<a class="nav-link" href="/%s">%s</a>';
                        $url = $item['page_name'];
                    }
                }

                $outString .= $this->li_open . sprintf($format, $url, $pageTitle) . "</li>";

        }

        $outString .= $this->ul_close;
        return $outString;
    }

    public function renderLangs() {
        $outString = $this->ul_open;
        foreach ($this->s_langs as $k => $v) {
            if ($k === $this->lang) {
                $format = $this->activeHrefStr;
                $url = '#top';
            } else {
                $format = '<a class="nav-link" href="%s">%s</a>';
                $url = sprintf("/%s/%s",$this->model,$k);
            }
            $outString .= $this->li_open . sprintf($format, $url, $k) . "</li>";
        }

        $outString .= $this->ul_close;
        return $outString;
    }

/*
    private function buildDropDown($parentID,$items) {
        $outStr=''; // $separator="\n\t";
        $separator=" ";
        $format = '<a class="dropdown-item" href="/media/%s/%s">%s</a>';

        foreach ($items as $cID => $item) {
            $id = $parentID.$cID;
            $outStr.= $separator . sprintf($format,$this->lang,$item,$this->langPack["pages"][$id]);
        }
        return $outStr;
    }
*/
}


