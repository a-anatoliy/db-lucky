<?php
//  debug string:
//    echo "<pre>";print_r($this->page_props);echo "</pre>";

class MainController extends AbstractController {

	protected $data, $user, $cfg, $page_props, $carousel;

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

        $this->carousel = $this->view->render('carousel', $this->page_props, true);
        $content = $this->view->render('index', $this->page_props, true);
        $this->render($content);

    }

    public function actionAbout() {
        $this->getPageData();
        $content = $this->view->render('about', $this->page_props, true);
        $this->render($content);
    }

    public function actionMedia() {
        // honestly - nothing special data there.
        // for now only additional headers & page name
        $this->getPageData();
        // now get all of auxiliary
        $this->getAuxPhrases();

        foreach ($this->cfg["mediaDirs"] as $n => $dir) {
            if (!empty($this->page_props[$n])) {
                $this->page_props[$n."Title"] = $this->page_props[$n];
                $this->page_props[$n]  = $this->utils->getImgContainer($this->getImgIndex(),$dir);
            } else {continue;}
        }

        $content = $this->view->render('media', $this->page_props, true);
        $this->render($content);
    }

    public function actionContact() {
        $this->getPageData();
        // now we have only useful "content" in $this->page_props
        // ------------------------------------------------------
        // now get all of auxiliary
        $this->getAuxPhrases();
        // ------------------------------------------------------
        // now get all of form phrases
        $items = $this->data->getAll(QueryMap::SELECT_FORM_PHRASES,
            [$this->user->lang_code]);
        // now fill the contact page template using form phrases
        foreach ($items as $item) {
            foreach ($item as $k => $v) {
                $newKey = sprintf("%s_%s",$k,$item["field_name"]);
                $this->page_props[$newKey] = $v;
            }
        }
        // ------------------------------------------------------
        // now let's render all of above data
        $content = $this->view->render('contact', $this->page_props, true);
        $this->render($content);
    }

    public function actionBlog() {
        $this->getPageData();
        $content = $this->view->render('blog_main', $this->page_props, true);
        $this->render($content);
    }

    protected function render($str) {

	    $menu_properties = array(
	        'lang'    => $this->user->langAbbr,
            'langID'  => $this->user->lang_code,
            's_langs' => $this->user->supp_langs,
            'model'   => $this->user->model . $this->user->sub_model,
            'dbh'     => $this->data,
        );
        $menu = new MenuController($menu_properties);

        $menus = array(
            "baseMenu" => $menu->renderBase(),
            "langsMenu"=> $menu->renderLangs()
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

    private function getAuxPhrases() {
        $aux = $this->data->getAll(QueryMap::SELECT_AUX_PHRASES,
            [$this->user->model, $this->user->lang_code]);

        if (empty($aux)) {
            return 1;
        } else {
            while ($item = array_shift($aux)) {
                $this->page_props[ $item['subst_name'] ] = $item['phrase'];
            }
        }
        return $this;
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
