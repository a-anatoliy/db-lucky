<?php

/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 04.05.2018
 * Time: 12:49
 */
class Visitor {
    // default value which will be used for all of undef variables
    const UNDEF_VALUE  = 'none';

    // default language
    const DEF_LANGUAGE = 'pl';

    // Cookie Name to define value of current language
    const LANGUAGE_COOKIE_NAME = 'LuckyDRESS_lang';

    // Cookie Name used for each visitor
    const VISITED_COOKIE_NAME  = 'LuckyDRESS_Visited';

    // Where to obtain info about visitor
    const IP_INFO_SITE  = 'http://ipinfo.io/';

    // Number of hours a visitor is considered as "unique"
    const UNIQUE_HOURS = 48;

    // ------- variables --------------------------------------------------------------------
    // Show "unique" visits only ?
    private $unique_visits = true;

    // do we need to insert info about this visitor into db ?
    public $insert = true;

    //      time| ip| url| agent|refer|query|user  | geo Location
    public $date,$ip,$uri,$agent,$ref,$query,$user,$geoloc;

    private $ruLangSupport = array("ru","ua","by");

    private $country_code;

    // $lang  - current language
    // $model - requested page name
    // $sub_model page name: /media/pl/2018
    public $langAbbr,$model,$sub_model;

    public $dbFields = array('date','ip','uri','agent','ref','query','user','geoloc');
    
    private $propName = array(
        'agent' => 'HTTP_USER_AGENT',
        'uri'   => 'REQUEST_URI',
        'query' => 'QUERY_STRING',
        'user'  => 'PHP_AUTH_USER'
    );

    public function __construct() {
        $this->date = date("d.m.Y H:i:s");
        $this->ip   = $this->getVisitorIP();

        // set default value of requested page name
        $this->model = 'home';

        // set initial value of current language
        // and default value of requested sub page name
        // $this->langAbbr = $this->sub_model = '';

        // set default country code
        $this->country_code = $this::DEF_LANGUAGE;

        // set all of values defined in the propName array
        // as an object properties
        foreach ($this->propName as $prop => $val) {
            $this->$prop = $this->v($_SERVER[$val]);
        }

        // decode the value of HTTP_REFERER
        $this->ref = isset($_SERVER['HTTP_REFERER'])
            ? urldecode($_SERVER['HTTP_REFERER'])
            : $_SESSION["origURL"] ;

        // get the country info of current visitor
        if (! empty($this->ip) && (strcmp($this->ip, '127.0.0.1') !== 0)) {
            $details = json_decode(file_get_contents($this::IP_INFO_SITE.$this->ip."/json"));
            if(isset($details->country)) {
                $this->geoloc = sprintf("%s %s, %s - %s",
                    $details->country,$details->region,$details->city,$details->org);
                $this->country_code = strtolower($details->country);
            }
        }

        // check if we have new unique visitor
        if ( !$this->unique_visits || !isset($_COOKIE[$this::VISITED_COOKIE_NAME]) ) {
            if( $this->unique_visits ) {
                // Send a cookie to the visitor (to track him) along with the P3P compact privacy policy
                header('P3P: CP="NOI NID"');
                setcookie($this::VISITED_COOKIE_NAME, 'yes', time() + 60 * 60 * $this::UNIQUE_HOURS, '/');
            }
        } else { $this->insert = false; }

        // set the value of requested page
        $this->setPageName();
    }

    private function checkLanguage() {

        if ( empty($this->langAbbr) ) {
            $needGeo = false;
            // either unsupported lang or doesn't set
            // 1. try to read it from Cookie & Session_ID
            $cookieLang = $this->checkCookie();
            $sessinLang = $this->checkSession();

            if ( (isset($cookieLang) && isset($sessinLang)) ) {
                // we have lang in COOKIE and SESSION
                // check if it has same value
                if (strcasecmp($cookieLang,$sessinLang) > 0) { $needGeo = true; }
                // we've lost either COOKIE or SESSION
            } else { $needGeo = true; }
            $this->langAbbr = ($needGeo) ? $this->getLangByGeo() : $sessinLang ;
        }

        $key = $this::LANGUAGE_COOKIE_NAME;
        setcookie ($key, $this->langAbbr, time() + 3600*24, "/");
        $_SESSION[$key] = $this->langAbbr;
    }

    private function getLangByGeo() {
        $lang = '';
        if (isset($this->country_code)) {
            $lc = strtolower($this->country_code);
            if (strcasecmp($lc,'pl') == 0) { $lang = 'pl'; }
            elseif(in_array($lc, $this->ruLangSupport )) { $lang = 'ru'; }
            else { $lang = 'en'; }
        }
        return $lang ? $lang : $this::DEF_LANGUAGE;
    }

    private function checkCookie() {
        $lang = NULL;
        if (isset($_COOKIE[$this::LANGUAGE_COOKIE_NAME])) {
            $lang = $_COOKIE[$this::LANGUAGE_COOKIE_NAME];
        }
        return $lang;
    }

    private function checkSession() {
        $lang = NULL;
        if (@$_SESSION[$this::LANGUAGE_COOKIE_NAME]) {
            $lang = @$_SESSION[$this::LANGUAGE_COOKIE_NAME];
        }
        return $lang;
    }

    private function setPageName() {
        $this->uri = substr($this->uri, 1);
        if (! empty($this->uri)) {

            $routs = explode('/', str_replace(dirname($_SERVER['PHP_SELF'])."/",
                "",$this->uri));
            $this->model     = array_shift($routs);     // first param in uri
            $this->langAbbr  = array_shift($routs);     // second
            $this->sub_model = array_shift($routs); // third param
        }

//        if (empty($this->lang)) {
            // set the value language for current visitor
            $this->checkLanguage();
//        } else {

//        }

//        return $this;
    }

    // Obtaining A visitor IP address
    private function getVisitorIP() {
        $ip = '0.0.0.0';
        if( ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) && ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
        elseif( ( isset( $_SERVER['HTTP_CLIENT_IP'])) && (!empty($_SERVER['HTTP_CLIENT_IP'] ) ) ) {
            $ip = explode(".",$_SERVER['HTTP_CLIENT_IP']);
            $ip = $ip[3].".".$ip[2].".".$ip[1].".".$ip[0]; }
        elseif((!isset( $_SERVER['HTTP_X_FORWARDED_FOR'])) || (empty($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            if ((!isset( $_SERVER['HTTP_CLIENT_IP'])) && (empty($_SERVER['HTTP_CLIENT_IP']))) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        return $ip;
    }

    private function v(&$var) { return !empty($var) ? $var : $this::UNDEF_VALUE; }

}