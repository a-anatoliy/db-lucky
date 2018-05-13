<?php

class Route {

	public static function start() {

        // collect all of vizitor parameters
        // http_ref, uri, cookies etc.
        // also get page and default language parameters
        $v = new Visitor;

        // establish the db connection
        $d = new Data;

//        echo "<pre>";print_r($v);echo "</pre>";
        // check if we need to insert info about current visitor into db ?
        if ($v->insert) {
            foreach ($v->dbFields as $key){
                printf("%s: %s<hr>",$key,$v->$key);
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form processing code
            if (isset($_POST["c"]) && ($_POST["c"] === "6w-1LdB0TAAAAAPoB8GKdbG-XOqq8QaZ-ft2VGQ3n")) {
//                require_once ROOT_DIR .'/core/informer.php';
//                require_once ROOT_DIR .'/core/ency.php';
//                $informer = new Informer( $d );
//                $informer->informUs();
//
//                echo json_encode(['code' => $informer->sentStatusCode, 'message'=> $informer->sentMsgStatus]);
//
//                $countIt = new Ency($informer);
//                $countIt->evidence();
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

//            echo "<pre>";print_r($d);echo "</pre>";
//            echo "<pre>";print_r($v);echo "</pre>";
//            echo "<pre>";print_r($langs);echo "</pre>";


            $controller_name = "Main";
//		$action_name = "index";
            $action_name = $v->model;

//		$uri = $_SERVER["REQUEST_URI"];
//		$uri = substr($uri, 1);
//		if ($uri) $action_name = $uri;

            $controller_name = $controller_name."Controller";
            $action_name = "action".$action_name;


            $controller = new $controller_name(array('data'=>$d,'user'=>$v));

            if (method_exists($controller, $action_name)) {
//            echo "<pre>";var_dump($v);echo "</pre>";
//            echo "<pre>";print_r($v);echo "</pre>";
//            echo "<pre>";var_dump($vizitor->insert);echo "</pre>";
                $controller->$action_name();
            }
            else { $controller->action404(); }
        }
	}
	
}
