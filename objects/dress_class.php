<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 28.10.2018
 * Time: 13:36
 */

//echo '<pre>'; var_dump($drIDs); echo '</pre>';
class Dress {

    private $langID, $itemsCount, $dbh, $items;
    private $dressDataArray;   // dress out data array
    private $title,$description,$img,$url_name,$short_descr,$imgWH;
    private $fields = array();

    public function __construct($langID,$count,$dbh) {
        $this->fields = ['title','description','img','short_descr','url_name', 'imgWH'];
        $this->itemsCount = $count;
        $this->langID = $langID;
        $this->dbh = $dbh;
        $this->items = array();
        $this->dressDataArray = array();
    }

    public function getItems() {
        // select total dresses
        $drTot = $this->dbh->getValue(QueryMap::SELECT_ACTIVE_DRESS);
        $drTot = $drTot['total'];
        // get an array of two randim ID's
        $drIDs = $this->UniqueRandomNumbersWithinRange(1,$drTot,$this->itemsCount);
        // prepare the array of parameters
        // [1_dressID,1_langID, 2_dressID,2_langID]
        $t = array_pop($drIDs); $drIDs[1]=$this->langID;
        array_push($drIDs,$t); array_push($drIDs,$this->langID);
        $result = $this->dbh->getAll(QueryMap::SELECT_BLOG_RANDOM_DRESS, $drIDs);

        foreach (range(1, $this->itemsCount) as $id) {
            $this->setSingleRow( array_shift($result) );
            $this->dressDataArray['dress_'.$id] = $this->getFields();
        }
        return $this->dressDataArray;
    }

    private function setFields($rowData = array()) {
        foreach ($this->fields as $field) {
            $act = sprintf("set%s", ucfirst($field));
            if ($field === 'imgWH') { $rowData[$field] = $rowData['img']; }
            $this->$act($rowData[$field]);
        }
        return $this;
    }

    private function getFields() {
        $out = array();
        foreach ($this->fields as $field) {
            $act = sprintf("get%s",ucfirst($field));
            $out[$field] = $this->$act();
        }
        return $out;
    }

    private function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    private function setSingleRow($dressRow = array()) {
        $this->setFields($dressRow);
    }

// the url to page contains description of current dress
    public function getUrl_name() { return $this->url_name; }
    public function setUrl_name($url_name) { $this->url_name = $url_name; }

// short description of current dress
    public function getShort_descr() { return $this->short_descr; }
    public function setShort_descr($short_descr) { $this->short_descr = $short_descr; }

// path to article image path
    public function getImg() { return $this->img; }
    public function setImg($image) { $this->img = $image; }

// image width & height
    public function getImgWH() { return $this->imgWH; }
    public function setImgWH($image) {
        list($w, $h) = getimagesize(ROOT_DIR.$image);
//        $this->imgWH = sprintf(" width='%d' height='%d' ",$w,$h);
        $this->imgWH = '';
    }


// title
    public function getTitle() { return $this->title; }
    private function setTitle($title='') { $this->title = $title; }
// description
    public function getDescription() { return $this->description; }
    private function setDescription($description='') { $this->description = $description; }

}
