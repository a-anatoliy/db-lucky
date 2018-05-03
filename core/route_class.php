<?php

class Route {

	public static function start() {
		$controller_name = "Main";
		$action_name = "index";
		
		$uri = $_SERVER["REQUEST_URI"];
		$uri = substr($uri, 1);
		if ($uri) $action_name = $uri;
		
		$controller_name = $controller_name."Controller";
		$action_name = "action".$action_name;
		
		$controller = new $controller_name();
		if (method_exists($controller, $action_name)) $controller->$action_name();
		else $controller->action404();
	}
	
}

?>