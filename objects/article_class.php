<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 28.10.2018
 * Time: 13:37
 */

class Article {

    private $langID, $itemsCount, $dbh, $items;
    private $articleDataArray;   // article out data array
    private $title,$description,$image;


    public function __construct($langID,$count,$dbh) {
        $this->itemsCount = $count;
        $this->langID = $langID;
        $this->dbh = $dbh;
        $this->items = array();
        $this->articleDataArray = array();
    }

    public function getItems() {
/*
        $result = $this->dbh->getAll(QueryMap::SELECT_ARTICLES,
            [$this->langID, $this->itemsCount ]);

        foreach (range(1, $this->itemsCount) as $id) {
            $this->setSingleRow( array_shift($result) );
            $this->articleDataArray['article_'.$id] =
                array(
                    'title' => $this->getTitle(),
                    'description' => $this->getDescription(),
                    'image' => $this->getImage()
                );
        }
*/
        return $this->articleDataArray;
    }

    private function setSingleRow($articleRow) {
        $this->setTitle($articleRow['title']);
        $this->setDescription($articleRow['description']);
        $this->setImage($articleRow['image']);
    }

// path to article image path
    public function getImage() { return $this->image; }
    public function setImage($image) { $this->image = $image; }

// title
    public function getTitle() { return $this->title; }
    private function setTitle($title='') { $this->title = $title; }
// description
    public function getDescription() { return $this->description; }
    private function setDescription($description='') { $this->description = $description; }

}
