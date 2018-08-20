<?php

class MainController extends AbstractController {

	protected $data, $user, $cfg;

	public function __construct($objects) {
		parent::__construct(new View(DIR_TMPL),$objects);
		foreach ($objects as $k => $v) {
		    $this->$k = $v;
        }
	}

	public function action404() {
		parent::action404();
		$this->title     = "Страница не найдена - 404";
		$this->meta_desc = "Запрошенная страница не существует.";
		$this->meta_key  = "страница не найдена, страница не существует, 404";

		$content = $this->view->render("404", array(), true);

		$this->render($content);
	}

    public function actionHome() {

        $items = $this->data->getAll(QueryMap::SELECT_PAGE_DATA,
            [$this->user->model, $this->user->lang_code]);

        if (empty($items)) {
            $this->action404();
        } else {
            $params = array_shift($items);

            $params["intro"] = $params["content"];
            $params["carouselImages"] = $this->utils->buildCarouselImages($this->getImgIndex());

            $this->carousel  = $this->view->render("carousel", $params, true);
            $content = $this->view->render("index", $params, true);
            // echo "<pre>";print_r($content);echo "</pre>";
            $this->render($content);
        }

    }


    protected function render($str) {
/*
        $menu = new MenuController($this);
        $menus = array(
            "baseMenu" => $menu->renderBase(),
            "langsMenu"=> $menu->renderLangs()
        );
*/
        $menus = array(
            "baseMenu" => "renderBase",
            "langsMenu"=> "renderLangs"
        );
        $params = array();

//        foreach (array("meta_desc","meta_key") as $key) {
//		    if (empty($params[$key])) {
//            $params[$key] = sprintf("%s - %s",$this->$key, $this->langPack[$key]);
//            $params[$key] = $this->$key;
//            }
//        }

//        if (preg_match("/home/i",$this->title)) {
//            $params["title"] = $this->langPack["title"];
//        } else {
//            $params["title"] = $this->title." - ".$this->langPack["title"];
//        }

//		$params["meta_desc"] = $this->langPack["meta_desc"];
//		$params["meta_key"]  = $this->langPack["meta_key"];

//		$params["header"]    = $this->header;
//		$params["footer"]    = $this->footer;

//        $this->actionPage = 'home';
        $params["header"]    = $this->view->render("header", array(), true);
        $params["carousel"]  = $this->user->model == 'home' ? $this->carousel : '';

//		$params["menu"]      = $menu->buildMenu();
        $params["menu"]      = $this->view->render("menu", $menus, true);

        $params["footer"]    = $this->view->render("footer", array(), true);
        $params["content"]   = $str;
        $this->view->render(MAIN_LAYOUT, $params);
    }

    private function getImgIndex() {
        return ROOT_DIR.$this->cfg["site"]["imgIndex"];
    }

}
