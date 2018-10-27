<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 27.09.2018
 * Time: 16:53
 * echo '<pre>Blog SETTER: '.$setter. ' TO '; print_r($val); echo '</pre>';
 * echo '<pre>';print_r($this);echo '</pre><hr>';
 */

class Blog extends MainController {

    public $outDataArray = array();
    private $blogs, $dresses, $famous,      // an arrays of articles
        $famousQuote, $famousAuthor,        // famous strings
        $workImage, $blogImgPath,           // image related string
        $famsCount, $dresCount, $blogCount; // how many articles do we have to show on
                                            // the blog initial page

    private $initItems = array('blogImgPath','famsCount','dresCount','blogCount');
    private $outItems = array('workImage','famousQuote','famousAuthor');

    public function __construct($p) {
        parent::__construct($p);

        foreach ($this->initItems as $k) {
            $val = $this->getCfgValue('site',$k);
            $setter = 'set'. ucfirst($k);
            if (method_exists($this, $setter)) {
                $this->$setter($val);
            } else {
            //  $this->$k = $val; <-- it's not a true jedi way
                continue;
            }
        }

        // path to image
        $this->setWorkImage();

        // create an array of Blogs articles (2 rows currently)
        $this->setBlogs();

        // create an array of Dresses articles (2 rows currently)
        $this->setDresses();

        // create an array of Famous articles (2 rows currently)
        $this->setFamous();

        //
        $this->setFamousRow();

    }

    /**
     * @return mixed
     */
    public function fillBlogData() {



        return $outDataArray;
    }

    public function setFamousRow() {
        if(sizeof($this->getFamous())>0) {
            $fams = array_shift($this->famous);
            $this->setFamousQuote($fams['phrase']);
            $this->setFamousAuthor($fams['auth']);
        }
    }

// blogs array
    public function getBlogs() { return $this->blogs; }
    private function setBlogs(array $blogs = array()) { $this->blogs = $blogs; }

// dresses array
    public function getDresses() { return $this->dresses; }
    private function setDresses(array $dresses = array()) { $this->dresses = $dresses; }

// famous phrases array
    public function getFamous() { return $this->famous; }
    private function setFamous(array $famous = array()) {
        if ($famous === []) {
            // increase the FamsCount to one since we need to
            // set one additional row with famousQuote/famousAuthor
            $fc = 1 +$this->getFamsCount();
            // since there are no wise thoughts in Polish
            $l = $this->getLangID(); if ($l == 1) { $l++; }
            $famous = $this->data->getAll(QueryMap::SELECT_FAMOUS,
                [$l, $fc ]);
        }

    $this->famous = $famous;
    }

// famousQuote
    public function getFamousQuote() { return $this->famousQuote; }
    private function setFamousQuote($famousQuote='') { $this->famousQuote = $famousQuote; }
// famousAuthor
    public function getFamousAuthor() { return $this->famousAuthor; }
    private function setFamousAuthor($famousAuthor='') { $this->famousAuthor = $famousAuthor; }

// workImage
    public function getWorkImage() { return $this->workImage; }
    private function setWorkImage($workImage = '') {
        if (empty($workImage)) {
            $imgList = $this->getUtilsObj()->getFilesFromDir($this->getBlogImgPath());
            shuffle($imgList);
            $workImage = array_shift($imgList);
        }

        $this->workImage = $workImage;
    }

// blogImgPath
    public function getBlogImgPath() { return $this->blogImgPath; }
    public function setBlogImgPath($blogImgPath) { $this->blogImgPath = ROOT_DIR.$blogImgPath; }
// counters
    public function getFamsCount() { return $this->famsCount; }
    private function setFamsCount($famsCount) { $this->famsCount = $famsCount; }
    protected function getDresCount() { return $this->dresCount; }
    private function setDresCount($dresCount) { $this->dresCount = $dresCount; }
    protected function getBlogCount() { return $this->blogCount; }
    private function setBlogCount($blogCount) { $this->blogCount = $blogCount; }

}
