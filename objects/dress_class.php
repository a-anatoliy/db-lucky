<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 28.10.2018
 * Time: 13:36
 */

class Dress {

    private $langID, $itemsCount, $dbh, $items;
    private $dressDataArray;   // dress out data array
    private $title,$description,$image;


    public function __construct($langID,$count,$dbh) {
        $this->itemsCount = $count;
        $this->langID = $langID;
        $this->dbh = $dbh;
        $this->items = array();
        $this->dressDataArray = array();
    }

    public function getItems() {
/*
        $result = $this->dbh->getAll(QueryMap::SELECT_DRESSES,
            [$this->langID, $this->itemsCount ]);

        foreach (range(1, $this->itemsCount) as $id) {
            $this->setSingleRow( array_shift($result) );
            $this->dressDataArray['dress_'.$id] =
                array(
                    'title' => $this->getTitle(),
                    'description' => $this->getDescription(),
                    'image' => $this->getImage()
                );
        }
*/
        return $this->dressDataArray;
    }

    private function setSingleRow($dressRow) {
        $this->setTitle($dressRow['title']);
        $this->setDescription($dressRow['description']);
        $this->setImage($dressRow['image']);
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
