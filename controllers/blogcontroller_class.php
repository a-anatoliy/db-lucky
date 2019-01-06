<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 27.09.2018
 * Time: 16:53
 * echo '<pre>Blog SETTER: '.$setter. ' TO '; print_r($val); echo '</pre>';
 * echo '<pre>';print_r($this);echo '</pre><hr>';
 */

class BlogController extends MainController {

    public $outDataArray = array();
    private $famous,$dress,$article,
        $workImage, $blogImgPath;    // image related string

    private $initItems = array('famous','dress','article');

    public function __construct($p) {
        parent::__construct($p);

        // fill the objects
        foreach ($this->initItems as $k) {
            $cnfg = $k.'Count';
            $val = $this->getCfgValue('site',$cnfg);
            $setter = 'set'. ucfirst($k);

            if (method_exists($this, $setter)) {
                $this->$setter($val);
            } else {
                //  $this->$k = $val; <-- it's not a true jedi way
                continue;
            }
        }

        $this->setBlogImgPath(
            $this->getCfgValue('site','blogImgPath')
        );

        $this->outDataArray = array(
            'workImage' => $this->getWorkImage()
        );

    }

    public function getAllDataArr() {

        foreach ($this->initItems as $objectName) {
            $getter = 'get'. ucfirst($objectName);

            $arr = $this->$getter();
            if (is_array($arr)) {
                foreach($arr as $key => $val) {
                    if (is_array($val)) {
                        $this->outDataArray[$key] =
                            $this->view->render($objectName.'_card',  $val, true);
                    } else {
                        $this->outDataArray[$key] = $val;
                    }
                }

            } else {
//                echo '<pre> got no array: ';var_dump($arr);echo '</pre><hr>';
                continue;
            }
        }

        return $this->outDataArray;
    }

// workImage
    private function getWorkImage() {
        $imgList = $this->getUtilsObj()->getFilesFromDir(
            $this->getBlogImgPath()
        );
        shuffle($imgList);
        return array_shift($imgList);
    }

// blogImgPath
    private function getBlogImgPath() { return $this->blogImgPath; }
    private function setBlogImgPath($blogImgPath) { $this->blogImgPath = ROOT_DIR.$blogImgPath; }

// Objects
    private function getFamous() { return $this->famous; }
    private function setFamous($count) {
        $famous = new Famous($this->getLangID(),$count,$this->data);
        $this->famous = $famous->getItems();
    }

    private function getDress() { return $this->dress; }
    private function setDress($count)   {
        $dresses = new Dress($this->getLangID(),$count,$this->data);
        $this->dress = $dresses->getItems();
    }

    private function getArticle() { return $this->article; }
    private function setArticle($count) {
        $articles = new Article($this->getLangID(),$count,$this->data);
        $this->article = $articles;
    }

}
