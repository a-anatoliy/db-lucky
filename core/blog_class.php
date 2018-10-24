<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 27.09.2018
 * Time: 16:53
 */

class Blog {

    private $blogs, $dresses, $famous,               // an arrays of articles
        $famousQuote, $famousAuthor,                 // famous strings
        $workImage, $blogImgPath,                    // image related string
        $famArticles, $dressArticles, $blogArticles; // how many articles do we have to show on
                                                     // the blog initial page

    public function __construct($parent) {
        if (empty($parent)) {
            echo "The parent object didn't initialized properly!";
            return 0;
        } else {
            echo '<pre>';print_r($parent);echo '</pre><hr>';
            foreach ($parent as $k => $v) {
                $this->$k = $v;
            }
        }
        // path to image
        $this->setWorkImage();

        // create an array of Famous articles (2 rows currently)
        $this->setFamous();

        // create an array of Blogs articles (2 rows currently)
        $this->setBlogs();

        // create an array of Dresses articles (2 rows currently)
        $this->setDresses();
    }

    /**
     * @return array
     */
    public function getBlogs() { return $this->blogs; }

    /**
     * @param array $blogs
     */
    private function setBlogs($blogs = array()) { $this->blogs = $blogs; }

    /**
     * @return array
     */
    public function getDresses() { return $this->dresses; }

    /**
     * @param array $dresses
     */
    private function setDresses($dresses = array()) { $this->dresses = $dresses; }

    /**
     * @return array
     */
    public function getFamous() {

        return $this->famous;
    }

    /**
     * @param array $famous
     */
    private function setFamous($famous = array()) {
        $this->famous = $famous;

    }

    /**
     * @return string
     */
    public function getFamousQuote() { return $this->famousQuote; }

    /**
     * @param string $famousQuote
     */
    private function setFamousQuote($famousQuote) { $this->famousQuote = $famousQuote; }

    /**
     * @return string
     */
    public function getFamousAuthor() { return $this->famousAuthor; }

    /**
     * @param string $famousAuthor
     */
    private function setFamousAuthor($famousAuthor) { $this->famousAuthor = $famousAuthor; }

    /**
     * @return mixed
     */
    public function getWorkImage() { return $this->workImage; }

    /**
     * @param mixed $workImage
     */
    private function setWorkImage($workImage) {
        $imgList = $this->utils->getFilesFromDir($this->blogImgPath);
        shuffle($imgList);
        $this->workImage = array_shift($imgList);
    }

    /**
     * @return mixed
     */
    public function getBlogImgPath() { return $this->blogImgPath; }

    /**
     * @param mixed $blogImgPath
     */
    public function setBlogImgPath($blogImgPath) { $this->blogImgPath = $blogImgPath; }

    /**
     * @return mixed
     */
    public function getFamArticles() { return $this->famArticles; }

    /**
     * @param mixed $famArticles
     */
    public function setFamArticles($famArticles) { $this->famArticles = $famArticles; }

    /**
     * @return mixed
     */
    public function getDressArticles() { return $this->dressArticles; }

    /**
     * @param mixed $dressArticles
     */
    public function setDressArticles($dressArticles) { $this->dressArticles = $dressArticles; }

    /**
     * @return mixed
     */
    public function getBlogArticles() { return $this->blogArticles; }

    /**
     * @param mixed $blogArticles
     */
    public function setBlogArticles($blogArticles) { $this->blogArticles = $blogArticles; }

}
