<?php

class MainController extends AbstractController {

	protected $title;
	protected $meta_desc;
	protected $meta_key;
	
	public function __construct($objects) {
		parent::__construct(new View(DIR_TMPL),$objects);
		foreach ($objects as $k => $v) {
		    $this->$k = $v;
        }
	}
	
	public function action404() {
		parent::action404();
		$this->title = "Страница не найдена - 404";
		$this->meta_desc = "Запрошенная страница не существует.";
		$this->meta_key = "страница не найдена, страница не существует, 404";
		
		$content = $this->view->render("404", array(), true);
		
		$this->render($content);
	}
	
	public function actionHome() {
		$this->title = "Главная страница";
		$this->meta_desc = "Описание главной страницы.";
		$this->meta_key = "описание, описание главной страницы";

		$content = $this->view->render("index", array(), true);
		
		$this->render($content);
	}
	
	public function actionPage() {
		$this->title = "Внутренняя страница";
		$this->meta_desc = "Описание внутренней страницы.";
		$this->meta_key = "описание, описание внутренней страницы";
		
		$content = $this->view->render("page", array(), true);
		
		$this->render($content);
	}
	
	protected function render($str) {
		$params = array();
		$params["title"] = $this->title;
		$params["meta_desc"] = $this->meta_desc;
		$params["meta_key"] = $this->meta_key;
		$params["content"] = $str;
		$this->view->render(MAIN_LAYOUT, $params);
	}
	
}
