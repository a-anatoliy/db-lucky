<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 27.09.2018
 * Time: 16:53
 */

class Blog {

    private $blogs, $dresses, $famous, $famousQuote, $famousAuthor, $workImage, $blogImgPath;

    public function __construct($parent) {
        if (empty($parent)) {
            echo "The parent object didn't initialized properly!";
            return 0;
        } else {
            foreach ($parent as $k => $v) {
                $this->$k = $v;
            }
//            $this->getWorkImage();
        }
    }

    /**
     * @return mixed
     */
    public function getBlogs() { return $this->blogs; }

    /**
     * @param mixed $blogs
     */
    public function setBlogs($blogs) { $this->blogs = $blogs; }

    /**
     * @return mixed
     */
    public function getDresses() { return $this->dresses; }

    /**
     * @param mixed $dresses
     */
    public function setDresses($dresses) { $this->dresses = $dresses; }

    /**
     * @return mixed
     */
    public function getFamous() { return $this->famous; }

    /**
     * @param mixed $famous
     */
    public function setFamous($famous) { $this->famous = $famous; }

    /**
     * @return mixed
     */
    public function getFamousQuote()  { return $this->famousQuote; }

    /**
     * @param mixed $famousQuote
     */
    public function setFamousQuote($famousQuote) { $this->famousQuote = $famousQuote; }

    /**
     * @return mixed
     */
    public function getFamousAuthor() { return $this->famousAuthor; }

    /**
     * @param mixed $famousAuthor
     */
    public function setFamousAuthor($famousAuthor) { $this->famousAuthor = $famousAuthor; }

    /**
     * @return mixed
     */
    public function getWorkImage() {
        $imgList = $this->utils->getFilesFromDir($this->blogImgPath);
        shuffle($imgList);
        $this->setWorkImage(array_shift($imgList));
        return $this->workImage;
    }

    /**
     * @param mixed $workImage
     */
    private function setWorkImage($workImage) { $this->workImage = $workImage; }

}
