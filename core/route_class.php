<?php

class Route {

    const DEF_CONTROLLER_NAME = 'Main';

//	public static function start() {
	public function start() {

        $cfg = require_once CONFIG;
        // collect all of visitor parameters
        // http_ref, uri, cookies etc.
        // also get page and default language parameters
        $v = new Visitor;

        // establish the db connection
        $d = new Data($cfg);

//        echo "<pre>";print_r($d);echo "</pre>";
        // check if we need to insert info about current visitor into db ?
        if ($v->insert) {
            echo "this is an unique user.thus we need to store information below in the database";
            foreach ($v->dbFields as $key) {
                printf("<div>%s: %s</div>",$key,$v->$key);
            }
            echo "<hr><div>^^^information stored ^^^</div>";
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form processing code
            if (isset($_POST["c"]) && ($_POST["c"] === "6w-1LdB0TAAAAAPoB8GKdbG-XOqq8QaZ-ft2VGQ3n")) {
            // require_once ROOT_DIR .'/core/informer.php';
            // require_once ROOT_DIR .'/core/ency.php';
            // $informer = new Informer( $d );
            // $informer->informUs();
            //
            // echo json_encode(['code' => $informer->sentStatusCode, 'message'=> $informer->sentMsgStatus]);
            //
            // $countIt = new Ency($informer);
            // $countIt->evidence();
                return "POST";
            }
            else { echo json_encode(['code' => 500, 'message'=> "you can't use this form"]); }
            exit;
        }
        else {
            // get an array of available languages
            $langs = $d->selectPair(QueryMap::SELECT_LANGUAGES);

            // check if current language supported
            $v->isLangSupported($langs);
/*
            $cntrl_name  = $this::DEF_CONTROLLER_NAME.'Controller';
            $controller  = new $cntrl_name($params);
            $action_name = 'action'.$params['model'];

            if (method_exists($controller, $action_name)) {
                $controller->$action_name();
            }

*/

//            $controller_name = "Main";
            // $action_name = "index";
            $action_name = $v->model;

            $controller_name = $this::DEF_CONTROLLER_NAME.'Controller';
            $action_name = "action".$action_name;

            $controller = new $controller_name(array('data'=>$d,'user'=>$v,'cfg'=>$cfg));

            if (method_exists($controller, $action_name)) {
                $controller->$action_name();
            }
            else { $controller->action404(); }
        }
	}

}
