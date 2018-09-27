<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 27.09.2018
 * Time: 19:01
 */


$path_parts = pathinfo(__FILE__);
// we need one level up
define ( 'ROOT_DIR', dirname($path_parts['dirname']) );

$IndexFile = ROOT_DIR . '/init/famous.txt';

echo "Working with $IndexFile";
echo '-----------------------------';
$insertStringFMT = "\n(NULL,%s,'%s',%d),";
$insStr = 'INSERT INTO `ld_famous` (`id`,`phrase`,`auth`,`lang_id`) values';
$resFile = ROOT_DIR . '/init/famous.sql';
//


$handle = @fopen($IndexFile, "r");
//            echo var_dump($IndexFile);
if ($handle) {
    $langID = 2;
    while (($buffer = fgets($handle, 4096)) !== false) {
        $Images = explode("|", $buffer);
        if ($langID>3) { $langID = 2; }
        if (! empty($Images[1])) {
            $Images[1] = str_replace("\n",'',$Images[1]);
        }
        $insStr .= sprintf($insertStringFMT,$Images[0],$Images[1],$langID);
        $langID++;
    }
    fclose($handle);
} else { echo "Can't open $IndexFile"; }

$insStr = substr($insStr,0,-1);
$insStr .= "\n;";
writeFile($resFile,$insStr);

echo 'DONE';


function writeFile($file,$entry) {
    $fp = fopen($file, 'a+', LOCK_EX)
    or die("ERROR: Can't write to [".$file."], please make sure that your path is correct and you have
                    appropriate permissions on the target directory and/or file!");
    fputs($fp, $entry);
    fclose($fp);
}
