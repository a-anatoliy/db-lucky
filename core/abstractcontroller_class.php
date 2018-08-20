<?php

abstract class AbstractController {

	protected $view;
	public function __construct($view,$objects) {
		$this->view = $view;
        $this->utils = new Utils();
	}

	abstract protected function render($str);

//	public function getHeaders() {
//        echo "<pre>";print_r($this->user->langAbbr);echo "</pre>";
//        echo "<pre>";var_dump($this);echo "</pre>";
//    }

	public function action404() {
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
	}

}
