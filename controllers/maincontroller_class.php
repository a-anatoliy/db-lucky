<?php
//  debug string:
//    echo '<pre>';print_r($this->page_props);echo '</pre>';

class MainController extends AbstractController {

    protected $page_props, $carousel;

	public function __construct($objects) {
		parent::__construct(new View(DIR_TMPL),$objects);
		    $this->setPageProps();
    }

	public function action404() {
		parent::action404();

        $this->user->model = "404";
        $this->getPageData();
        $this->page_props['requested_page'] = $this->user->uri;

        if (isset($this->user->ip)) {
            $details = json_decode(file_get_contents("http://ipinfo.io/{$this->user->ip}/json"));
            if(isset($details->country)) {
                $this->page_props["country"] = sprintf("<div>[%s] %s</div><div>%s<br><em>%s</em></div>",
                    $details->country, $details->region, $details->org, $details->city);
            } else {
                $this->page_props['country'] = "...";
            }
        }

		$content = $this->view->render('404', $this->page_props, true);

		$this->render($content);
	}

    public function actionHome() {

        $this->getPageData();

        $this->page_props['intro'] = $this->page_props['content'];
        $this->setCarousel(
            $this->utils->buildCarouselImages($this->getImgIndex())
        );
        $this->page_props['carouselImages'] = $this->getCarousel();

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
        // there is nothing special data there.
        // for now only additional headers & page name
        $this->getPageData();
        // now get all of auxiliary
        $this->getAuxPhrases();

        foreach ($this->cfg['mediaDirs'] as $n => $dir) {
            if (!empty($this->page_props[$n])) {
                $this->page_props[$n.'Title'] = $this->page_props[$n];
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
            [$this->getLangID()]);
        // now fill the contact page template using form phrases
        foreach ($items as $item) {
            foreach ($item as $k => $v) {
                $newKey = sprintf("%s_%s",$k,$item['field_name']);
                $this->page_props[$newKey] = $v;
            }
        }
        // ------------------------------------------------------
        // now let's render all of above data
        $content = $this->view->render('contact', $this->page_props, true);
        $this->render($content);
    }

    public function actionBlog() {
	    // perform select from db to get all of
        // text data for current page
        $this->getPageData();

        $this->page_props['langAbbr'] = $this->getLang();

        // now create a blog object
        $blogObject = new Blog($this);

        // get random image, famousQuote and famousAuthor
        foreach (array('workImage','famousQuote','famousAuthor') as $val) {
            $getter = 'get'.$val;
            $this->page_props[$val] = $blogObject->$getter();
        }


        foreach (range(1, $blogObject->getFamsCount()) as $id) {
            $blogObject->setFamousRow();
            $q = $blogObject->getFamousQuote();
            $a = $blogObject->getFamousAuthor();

            $this->page_props['famous_'.$id] =
                $this->view->render('famous_card', array(
                    'famousQuote' => $q,
                    'famousAuthor' => $a
                ), true);
        }

//            echo '<pre>';print_r($this->page_props);echo '</pre>';

        $this->page_props['dress']  = $this->view->render('dress_card',  array(), true);
        $this->page_props['blog']   = $this->view->render('blog_card',   array(), true);


        $content = $this->view->render('blog_main', $this->page_props, true);
        $this->render($content);
    }


    protected function render($str) {

        $menu = new MenuController( $this->getMinObjProps() );

        $menus = array(
            'baseMenu' => $menu->renderBase(),
            'langsMenu'=> $menu->renderLangs()
        );

        $this->page_props['header']    = $this->view->render('header', array(), true);
        $this->page_props['carousel']  = $this->user->model == 'home' ? $this->carousel : '';

        $this->page_props['menu']      = $this->view->render('menu', $menus, true);

        $this->page_props['footer']    = $this->view->render('footer', array(), true);

        $this->page_props['content']   = $str;
        $this->view->render(MAIN_LAYOUT, $this->page_props);
    }

    public function getCfgValue($node,$value) {
	    $out = false;
	    if (!empty($node) && !empty($value)) {
            $out = $this->cfg[$node][$value];
	    }
        return $out;
    }

    private function getMinObjProps() {
	    return array(
            'lang'    => $this->getLang(),
            'langID'  => $this->getLangID(),
            's_langs' => $this->getSuppLangs(),
            'model'   => $this->getUrlPath(),
            'dbh'     => $this->data,
        );
    }

    private function getImgIndex() {
        return ROOT_DIR.$this->getCfgValue('site','imgIndex');
    }

    private function getAuxPhrases() {
        $aux = $this->data->getAll(QueryMap::SELECT_AUX_PHRASES,
            [$this->getModel(), $this->getLangID()]);

        if (empty($aux)) { return 1;
        } else {
            while ($item = array_shift($aux)) {
                $this->page_props[ $item['subst_name'] ] = $item['phrase'];
            }
        }
        return $this;
    }

    private function getPageData() {
        $items = $this->data->getAll(QueryMap::SELECT_PAGE_DATA,
            [$this->getModel(), $this->getLangID()]);

        if (empty($items)) { $this->action404();
        } else {
            $this->page_props = array_shift($items);
        }
        return $this;
    }

    /**
     * @return string 'home'|'media'...
     */
    public function getModel() { return $this->user->model; }

    /**
     * @return string
     */
    public function getUrlPath() {
	    return $this->user->model . $this->user->sub_model;
    }

    /**
     * @return array ([pl] => 1...)
     */
    public function getSuppLangs() {
        return $this->user->supp_langs;
    }

    /**
     * @return string ['pl'|'en'|...]
     */
    public function getLang() { return $this->user->langAbbr; }

    /**
     * @return int [1|2|...]
     */
    public function getLangID() { return $this->user->lang_code; }

// START main obj base get/set
    /**
     * @return array
     */
    public function getPageProps() { return $this->page_props; }

    /**
     * @param array $page_props
     */
    public function setPageProps( array $page_props = array()) { $this->page_props = $page_props; }

    /**
     * @return mixed
     */
    public function getCarousel() { return $this->carousel; }

    /**
     * @param mixed $carousel
     */
    public function setCarousel($carousel = '') { $this->carousel = $carousel; }

// STOP main obj base get/set

}
