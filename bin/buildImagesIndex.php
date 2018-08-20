<?php
/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 01.04.2018
 * Time: 15:14
 */

$path_parts = pathinfo(__FILE__);
// we need one level up
define ( 'ROOT_DIR', dirname($path_parts['dirname']) );
define ( 'CONFIG'  , ROOT_DIR .'/data/cfg/config.php');

$cfg = require_once CONFIG;

$images_dir = ROOT_DIR.'/i/dress';
$csvFile    = ROOT_DIR .$cfg["site"]["imgIndex"];
$GLOBALS["fields"] = array();

$fp = fopen($csvFile, 'w', LOCK_EX)
or die("ERROR: Can't write to [".$csvFile."], please make sure that your path is correct and you have appropriate permissions on the target directory and/or file!");
scan_recursive($images_dir, 'scan_callback');

fclose($fp);

function scan_recursive($directory, $callback=null) {
    $directory=realpath($directory);

    if ($d=opendir($directory)) {
        while($fname=readdir($d)) {
            if ($fname=='.' || $fname=='..') {
                continue;
            } else {
                if ($callback!=null && is_callable($callback)) {
                    $currFname = $directory.DIRECTORY_SEPARATOR.$fname;
                    if(!is_dir($currFname)){ $callback($currFname); }
                }
            }

            if (is_dir($directory.DIRECTORY_SEPARATOR.$fname)) {
                scan_recursive($directory.DIRECTORY_SEPARATOR.$fname, $callback);
            }
        }
        closedir($d);
    }
}


function scan_callback($fname) {
    $pattern = preg_quote(sprintf("/%st%s/",DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR),
        DIRECTORY_SEPARATOR);

    if (preg_match($pattern,$fname)) { return;
    } else {
        list($wi, $hi) = getimagesize($fname);
        $i = str_replace(ROOT_DIR,'',$fname);
        $path_parts = pathinfo($i);

//        array_push($GLOBALS["fields"],
//            sprintf("%s|%s|%d|%d\n",$path_parts['dirname'],$path_parts['basename'],$wi,$hi));

        fputs($GLOBALS["fp"],
            sprintf("%s|%s|%d|%d\n",$path_parts['dirname'],$path_parts['basename'],$wi,$hi)
        );

    }
}

