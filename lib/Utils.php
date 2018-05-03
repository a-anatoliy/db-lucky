<?php

/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 14.02.2018
 * Time: 14:55
 */
class Utils {


    /**
     * @param $directoryPath
     */
    public function readDirectory($directoryPath) {
        if ($handle = opendir($directoryPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo "$entry\n";
                }
            }
            closedir($handle);
        }
    }

    /**
     * @param $path
     * @param $filename
     * @return string
     */
    public function checkFileName($path, $filename) {
        if ($pos  = strrpos($filename, '.')) {
            $name = substr($filename, 0, $pos);
            $ext  = substr($filename, $pos);
        } else {
            $name = $filename;
        }

        $newpath = $path.'/'.$filename;
        $newname = $filename;
        $counter = 0;
        while (file_exists($newpath)) {
            $newname = $name .'_'. $counter . $ext;
            $newpath = $path.'/'.$newname;
            $counter++;
        }

        return $newname;
    }

    /* CRUD functions */
    // ============================================================================
    public function lemmeIn($inParams) {
        extract($inParams,EXTR_OVERWRITE);
        set_exception_handler(function($e) {
            error_log($e->getMessage());
            exit('Something weird happened'); //something a user can understand
        });

        $dsn = "mysql:host=".$host.";dbname=".$name.";charset=utf8mb4";
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];

        try { $pdo = new PDO($dsn, $user, $pass, $options); }
        catch (PDOException $e) { $e->getMessage();       }

        return $pdo;
    }



    /* $value = 'Justin Bieber' */
    /**
     * @param $pdo
     * @param $table
     * @param $value
     * @return string
     */
    public function sqlInsert($pdo,$table,$value) {
        try {
//            $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('INSERT INTO '.$table.' VALUES(:name)');
            $stmt->execute(array(
                ':name' => $value
            ));

            # affected rows?
            return $stmt->rowCount(); // 1
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param $pdo
     * @param $table
     * @param $id
     * @param $value
     * @return string
     */
    public function sqlUpdate($pdo,$table,$id,$value) {
        try {
//            $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('UPDATE '.$table.' SET name = :name WHERE id = :id');
            $stmt->execute(array(
                ':id'   => $id,
                ':name' => $value
            ));

            return $stmt->rowCount(); // 1
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }

    }

    /**
     * @param $pdo
     * @param $table
     * @param $id
     * @return string
     */
    public function sqlDelete($pdo,$table,$id) {
        try {
//            $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('DELETE FROM '.$table.' WHERE id = :id');
            $stmt->bindParam(':id', $id); // Воспользуемся методом bindParam
            $stmt->execute();

            return $stmt->rowCount(); // 1
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param $pdo
     * @param $query
     * @param $value
     * @return string
     */
    public function sqlSelect($pdo, $query, $value="") {
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare($query);
            if (empty($value)) {$q->execute();} else { $q->execute($value); }
            return $q->fetchAll();
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public static function getSupportedLanguages($parent) {
        // ->dbh,QueryMap::SELECT_LANGUAGES
        try {
            $parent->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $parent->dbh->prepare(QueryMap::SELECT_LANGUAGES);
            $res = $q->fetchAll();
echo '<pre>obj: '; var_dump($res); echo '</pre>';
            return $res;

        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param $availableLanguages
     * @param string $default
     * @return bool|string
     */
    public function get_client_language($availableLanguages, $default='en'){
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

            foreach ($langs as $value){
                $choice=substr($value,0,2);
                if(in_array($choice, $availableLanguages)){
                    return $choice;
                }
            }
        }
        return $default;
    }

    // Определяем предпочтительный язык
    /**
     * @param $sWhere
     * @param $sDefaultLang
     * @return string
     */
    public function tryToFindLang($sWhere, $sDefaultLang) {
        // all the possible languages codes
        $aLanguages = array(
            'ua' => 'Ukraine', 'ru' => 'Russia',
            'pl' => 'Poland',  'en' => 'USA'
        );
        // Устанавливаем текущий язык как язык по умолчанию
        $sLanguage = $sDefaultLang;

        // Изначально используется лучшее качество
        $fBetterQuality = 0;

        // Поиск всех подходящих парметров
        preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i", $sWhere, $aMatches, PREG_SET_ORDER);
        foreach ($aMatches as $aMatch) {

            // Устанавливаем префикс языка
            $sPrefix = strtolower ($aMatch[1]);

            // Подготоваливаем временный язык
            $sTempLang = (empty($aMatch[3])) ? $sPrefix : $sPrefix . '-' . strtolower ($aMatch[3]);

            // Получаем значения качества (если оно есть)
            $fQuality = (empty($aMatch[5])) ? 1.0 : floatval($aMatch[5]);

            if ($sTempLang) {

                // Определяем наилучшее качество
                if ($fQuality > $fBetterQuality && in_array($sTempLang, array_keys($aLanguages))) {

                    // Устанавливаем текущий язык как временный и обновляем значение качества
                    $sLanguage = $sTempLang;
                    $fBetterQuality = $fQuality;
                } elseif (($fQuality*0.9) > $fBetterQuality && in_array($sPrefix, array_keys($aLanguages))) {

                    // Устанавливаем текущий язык как значение префикса и обновляем значение качества
                    $sLanguage = $sPrefix;
                    $fBetterQuality = $fQuality * 0.9;
                }
            }
        }
        return $sLanguage;
    }

    /**
     * @param $string
     * @param $limit
     * @return bool|string
     */
    public function trimString($string,$limit) {
        $string = strip_tags($string);
        $string = substr($string, 0, $limit);
        $string = rtrim($string, "!,.-");
        $string = substr($string, 0, strrpos($string, ' '));
        $string.="… ";
        return $string;
    }

    // Получаем IP посетителя
    public function getVisitorIP() {
        $ip = "0.0.0.0";
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

    /**
     * @param $address
     * @return bool
     *
     * Получаем координаты по заданному адресу
     * принимает адрес и возвращает массив содержащий широту и долготу
     */

    public function getLatLong($address){
        if (!is_string($address))die("All Addresses must be passed as a string");
        $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
        $_result = false;
        if($_result = file_get_contents($_url)) {
            if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
            preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
            $_coords['lat'] = $_match[1];
            $_coords['long'] = $_match[2];
        }
        return $_coords;
    }

    public function getImgContainer($IndexFile,$containerName) {
        $stringFormat = '<div class="ramka"><a href="%s/%s"><img class="rounded float-left" src="%s/t/%s" alt="Lucky dress"></a></div>';
        $imagesString="\n"; $pattern = preg_quote(sprintf("/%s/",$containerName));
        if (! $this->checkFileExists($IndexFile)) {
            return $imagesString;
        } else {
            $handle = @fopen($IndexFile, "r");
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                    $Images = explode("|", $buffer);

                    if (preg_match($pattern,$Images[0])) {
                        $i = $Images[0]; $f = $Images[1];
                        $imagesString .= sprintf($stringFormat,$i,$f,$i,$f);
                    }
                }
                fclose($handle);
            }
        }
        return $imagesString;
    }

    public function buildCarouselImages($IndexFile,$limit = 5) {
        $stringFormat = '<div class="carousel-item%s"><img class="d-block w-100" src="%s"></div>';
        $count = 0; $imgList = array();
        $imagesString="\n"; $activeMark = " active";
        if (! $this->checkFileExists($IndexFile)) {
            return $imagesString;
        } else {
            $handle = @fopen($IndexFile, "r");
//            echo var_dump($IndexFile);
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                    $Images = explode("|", $buffer);
                    if ($Images[3] == 400) {
                        array_push($imgList,sprintf("%s/%s",$Images[0],$Images[1]));
                    }
                }
                fclose($handle);
            } else { return $imagesString; }
        }

/*
        # read all of directories under root $directoryPath
        $handle = opendir($directoryPath);

        while(($entry = readdir($handle)) !== false) {
            if($entry == "." || $entry == "..") { continue; }

            $currDir = $directoryPath.DIRECTORY_SEPARATOR.$entry;

            if(is_dir($currDir)) {
                foreach(glob($currDir . "/*.jpg") as $file) {
                    // Получаем размеры и тип изображения (число)
                    list($wi, $hi, $type) = getimagesize($file);
                    if ($hi > 400) { continue; }
                    else { $imgList[] = $file; }
                }
            }
        }
*/
        # shuffle the array
        shuffle($imgList);
        $randImages = array_rand($imgList, $limit);

        foreach ($randImages as $index) {
            $item = $imgList[$index];
            $i = str_replace(ROOT_DIR,'',$item);
            $imgStr = sprintf($stringFormat,$activeMark,$i);
            $activeMark=''; $imagesString .= "\n".$imgStr;
        }

        # create images string
//        foreach ($imgList as $item) {
//            if ($count === $limit) { break; }
//            $i = str_replace(ROOT_DIR,'',$item);
//            $imgStr = sprintf($stringFormat,$activeMark,$i);
//            $activeMark=''; $imagesString .= $imgStr."\n";
//            $count++;
//        }

    return $imagesString."\n";
    }

    public function getFilesFromDir($dirPath, $ext = 'jpg') {
//        $imgList = array_diff(scandir($directoryPath), array('..', '.'));

        $result = array(); $ext = '.'.$ext;
        $cdir = scandir($dirPath);
        foreach ($cdir as $item) {
            // если это "не точки" и не директория
            if(stripos($item,$ext )){ $result[] = $item; }
        }
        return $result;
    }

    public function writeFile($file,$entry) {
        $fp = fopen($file, 'a+', LOCK_EX)
            or die("ERROR: Can't write to [".$file."], please make sure that your path is correct and you have
                    appropriate permissions on the target directory and/or file!");
        fputs($fp, $entry);
        fclose($fp);
    }

    public function dumpObjToFile($fileName,$obj) {
//        $data = array('one', 'two', 'three');
        $fh = fopen($fileName, 'w') or die("Can't open file $fileName");
        // output the value as a variable by setting the 2nd parameter to true
        $results = print_r($obj, true);
        fwrite($fh, $results);
        fclose($fh);
    }

    public function checkFileExists( $filename ) {
        return (file_exists($filename) ? true : false);
    }

}