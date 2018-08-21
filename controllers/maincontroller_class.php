<?php

class MainController extends AbstractController {

	protected $data, $user, $cfg, $page_props;

	public function __construct($objects) {
		parent::__construct(new View(DIR_TMPL),$objects);
		foreach ($objects as $k => $v) {
		    $this->$k = $v;
        }
        $this->page_props = array();
	}

	public function action404() {
		parent::action404();

        $this->user->model = "404";
        $this->getPageData();
        $this->page_props["requested_page"] = $this->user->uri;

        if (isset($this->user->ip)) {
            $details = json_decode(file_get_contents("http://ipinfo.io/{$this->user->ip}/json"));
            if(isset($details->country)) {
                $this->page_props["country"] = sprintf("<div>[%s] %s</div><div>%s<br><em>%s</em></div>",
                    $details->country, $details->region, $details->org, $details->city);
            } else {
                $this->page_props["country"] = "...";
            }
        }

		$content = $this->view->render("404", $this->page_props, true);

		$this->render($content);
	}

    public function actionHome() {

        $this->getPageData();

        $this->page_props["intro"] = $this->page_props["content"];
        $this->page_props["carouselImages"] = $this->utils->buildCarouselImages($this->getImgIndex());

        $this->carousel = $this->view->render("carousel", $this->page_props, true);
        $content = $this->view->render("index", $this->page_props, true);
        // echo "<pre>";print_r($content);echo "</pre>";
        $this->render($content);
//        }

    }

    public function actionAbout() {
        $this->getPageData();
        $content = $this->view->render("about", $this->page_props, true);
        $this->render($content);
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

        $this->page_props["header"]    = $this->view->render("header", array(), true);
        $this->page_props["carousel"]  = $this->user->model == 'home' ? $this->carousel : '';

        $this->page_props["menu"]      = $this->view->render("menu", $menus, true);

        $this->page_props["footer"]    = $this->view->render("footer", array(), true);

        $this->page_props["content"]   = $str;
        $this->view->render(MAIN_LAYOUT, $this->page_props);
    }

    private function getImgIndex() {
        return ROOT_DIR.$this->cfg["site"]["imgIndex"];
    }

    private function getPageData() {
        $items = $this->data->getAll(QueryMap::SELECT_PAGE_DATA,
            [$this->user->model, $this->user->lang_code]);

        if (empty($items)) {
            $this->action404();
        } else {
            $this->page_props = array_shift($items);
        }
        return $this;
    }
}
