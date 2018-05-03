<?php
mb_internal_encoding("UTF-8");
date_default_timezone_set('CET');

error_reporting(E_ALL);
//    ini_set('display_errors', 0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."controllers");
spl_autoload_extensions("_class.php");
spl_autoload_register();

define("ROOT_DIR", __DIR__ );
define("DIR_TMPL", ROOT_DIR."/tmpl/");
define("MAIN_LAYOUT", "main");
define('_ATHREERUN', 1 );

define('CONFIG',ROOT_DIR .'/data/cfg/config.php');

include ROOT_DIR .'/lib/SxGeo.php';
require_once ROOT_DIR . '/lib/Utils.php';

if ( !isset( $_SESSION["origURL"] ) ) {

    $_SESSION["origURL"] =
        isset($_SERVER['HTTP_REFERER'])
            ? urldecode($_SERVER['HTTP_REFERER'])
            : 'empty_REFER';
}

