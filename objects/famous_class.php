<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 28.10.2018
 * Time: 13:37
 */

class Famous {

    private $langID, $itemsCount, $dbh, $items;
    private $famousDataArray;   // famous out data array
    private $famousQuote,$famousAuthor;

    public function __construct($langID,$count,$dbh) {
        $this->itemsCount = $count;
        $this->langID = $langID;
        $this->dbh = $dbh;
        $this->items = array();
        $this->famousDataArray = array(
            'famousQuote'  => '',
            'famousAuthor' => ''
        );
    }

    public function getItems() {
        // increase the FamsCount to one since we need to
        // set one additional row with famousQuote/famousAuthor
        $fc = 1 + $this->itemsCount;
        // since there are no wise thoughts in Polish
        $l = $this->langID; if ($l == 1) { $l++; }
        $famous = $this->dbh->getAll(QueryMap::SELECT_FAMOUS,
            [$l, $fc ]);

        foreach (range(1, $fc) as $id) {
            $this->setSingleRow(
                array_shift($famous)
            );

            if(sizeof($famous) == 2) {

                $this->famousDataArray['famousQuote']  = $this->getFamousQuote();
                $this->famousDataArray['famousAuthor'] = $this->getFamousAuthor();
                continue;
            }

            $this->famousDataArray['famous_'.$id] =
                 array(
                    'famousQuote'  => $this->getFamousQuote(),
                    'famousAuthor' => $this->getFamousAuthor()
                );
        }

        return $this->famousDataArray;
    }

    private function setSingleRow($famRow) {
        $this->setFamousQuote($famRow['phrase']);
        $this->setFamousAuthor($famRow['auth']);
    }

// famousQuote
    public function getFamousQuote() { return $this->famousQuote; }
    private function setFamousQuote($famousQuote='') { $this->famousQuote = $famousQuote; }
// famousAuthor
    public function getFamousAuthor() { return $this->famousAuthor; }
    private function setFamousAuthor($famousAuthor='') { $this->famousAuthor = $famousAuthor; }

}
