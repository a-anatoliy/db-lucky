<?php
session_start(); //Запускаем сессии

/**
 * Класс для авторизации
 * и просмотра логов
 */

include('../lib/SxGeo.php');



class AuthClass {
    private $_login = "";    //Устанавливаем логин
    private $_password = ""; //Устанавливаем пароль

    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }

    /**
     * @param $login
     * @param $passwors
     * @return bool
     */

    public function auth($login, $passwors) {
        if ($login == $this->_login && $passwors == $this->_password) { //Если логин и пароль введены правильно
            $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
            return true;
        }
        else { //Логин и пароль не подошел
            $_SESSION["is_auth"] = false;
            return false;
        }
    }

    /**
     * Метод возвращает логин авторизованного пользователя
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }

    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
}


class analyzeIt {
    private $logFile;
    const LOG_FILENAME = 'hitcount.txt';
    private $knownBots;

    public function viewFile() {
        if ($this->checkStatFile($this::LOG_FILENAME)) {
            $handle = @fopen($this->logFile, "r");
            if ($handle) {
                $this->setGeoObj();
                $this->setKnownBots();
                $today = date("d");
                $yesty = date("d")-1;
                if($yesty && $yesty<10) { $yesty = "0".$yesty;}
                $todayCounter=0; $yestyCounter=0;

                echo '<div class="table-responsive"><table class="table table-sm table-striped table-bordered"><thead>';
                while (($buffer = fgets($handle, 4096)) !== false) {
                    $pieces = explode("|", $buffer);

                    if ($this->isBot($pieces[4])) { continue; }

                    if ( preg_match('/\#/',$pieces[0])) {
                        echo "\n<tr>";
                        $format = "\n\t<th scope=\"col\">%s</th>";
                        $this->printArray($format,$pieces);
                        echo "</tr></thead><tbody>";
                    } else {
                        $format = "\n\t<td><small>%s</small></td>";
                    }

                    list($d) = explode(".",$pieces[1]);
                    if ($d == $today) {
//                    if ($d == $yesty) {
                        echo "\n<tr>";
                        $todayCounter++; $pieces[0] = $todayCounter;
                        $this->printArray($format,$pieces);
                        echo "\n</tr>";
                    } elseif ($d == $yesty) { $yestyCounter++;
                    } else { continue; }
                }
                echo ' </tbody></table></div>';
                echo '<div style="padding-left: 20px"><button type="button" class="btn btn-primary text-uppercase font-weight-bold">Today: <span class="badge badge-light">'.$todayCounter.'</span><span class="sr-only">unique hosts</span></button></div>';
//              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Today:</strong> '.$todayCounter.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
//                echo '<div class="alert alert-dark" role="alert">Yesterday: ['.$yestyCounter .'] </div>';
                echo '<h5 style="padding-left: 20px">Yesterday: <span class="badge badge-secondary">'.$yestyCounter .'</span></h5>';

                if (!feof($handle)) {
                    echo "Error: unexpected fgets() fail\n";
                }
                fclose($handle);
            } else {
                echo "<h4>Can't open [".$this->logFile."] for reading!</h4>";
            }
        }
    }

    private function printArray($format,$arr) {
        $workStr = $arr[2];
        if (preg_match("/\,/",$workStr)) {
            list($workStr) = explode(",",$workStr);
        }

        $country = $this->geoDB->getCountry($workStr);

        if ($country) {
            $arr[2] = "<div align='center' title=\"".$arr[2]."\"><b>".$country."</b></div>";
        }
        foreach ($arr as $line) {
            printf($format,trim($line));
        }
    }

    private function checkStatFile( $filename ) {
        $this->logFile = $_SERVER['DOCUMENT_ROOT']."/data/".$filename;
        if( !file_exists($this->logFile) ) {
            echo "ERROR: Stat file '".$this->logFile."'does not exists!";
            return false;
        } else {return true;}
    }

    private function setGeoObj() {
        $this->geoDB = new SxGeo('../lib/SxGeo.dat');
    }

    public function setKnownBots() {
        $this->knownBots = array();
        $this->knownBots = require $_SERVER['DOCUMENT_ROOT'].'/data/cfg/botList.php';
    }

    public function getKnownBots() { return $this->knownBots; }

    private function isBot($name) {
        foreach ($this->knownBots as $botName) {
            if (preg_match("/$botName/i",$name)) {
                return true;
            }
        }
        return false;
    }

}

$auth = new AuthClass();

if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
        echo "<h4 style=\"color:red;\">Incorrect value of either login or password</h4>";
    }
}

if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
    if ($_GET["is_exit"] == 1) {
        $auth->out(); //Выходим
        header("Location: ?is_exit=0"); //Редирект после выхода
    }
}
?>

<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Template</title><link href="../css/bootstrap.min.css" rel="stylesheet">
<style>
    .form-signin {width: 100%;max-width: 330px;padding: 15px;margin: 0 auto;}
    .form-signin .checkbox {font-weight: 400;}
    .form-signin .form-control {position: relative;box-sizing: border-box;height: auto;padding: 10px;font-size: 16px;}
    .form-signin .form-control:focus {z-index: 2;}
    .form-signin input[type="email"] {margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;}
    .form-signin input[type="password"] {margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;}
</style></head>


<?php if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:
    echo "<body><h4 class='p-5'>Hi, " . $auth->getLogin() ." <br><small class=\"text-muted\">only unique visits(no bots, crawlers, archivers)</small></h4>";
    $log = new analyzeIt();
    $log->viewFile();
//    echo "<br><p><a href=\"?is_exit=1\">Выйти</a></p>"; //Показываем кнопку выхода
    echo "<div style=\"padding-left: 30px\"><a href=\"?is_exit=1\" class=\"badge badge-danger\">Logout</a></div>"; //Показываем кнопку выхода
    echo '<br><footer><p align="center">Copyright &copy; Yukai 2018</p></footer>
    <script src="/js/jquery-1.9.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- script src="/js/jquery.easing.min.js"></script -->
    </body></html>';
}
else { //Если не авторизован, показываем форму ввода логина и пароля
?>

    <body class="text-center">
    <form  method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
    </body>
    </html>
<?php } ?>
