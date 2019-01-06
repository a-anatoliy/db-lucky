<?php

/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 07.05.2018
 * Time: 16:07
 */
class Data {
    // Database Connection Configuration Parameters
    // array('driver' => 'mysql','host' => '','dbname' => '','username' => '','password' => '')
//    protected $_config;

    // Database Connection
    public $dbc;

    // Connection options
    private $opts;

    /**
     * Statement Handle.
     */
    public static $sth = null;

    /**
     * An SQL query.
     */
    public static $query = '';

    /* function __construct
     * Opens the database connection
     * @param $config is an array of database connection parameters
     */
    public function __construct($cfg) {

        $this->_cfg = $cfg['db'];
        $this->opts = [
            // turn off emulation mode for "real" prepared statements
            PDO::ATTR_EMULATE_PREPARES   => false,

            //turn on errors in the form of exceptions
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,

            //make the default fetch be an associative array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->getPDOConnection();
    }

    /* Function __destruct
     * Closes the database connection
     */
    public function __destruct() {
        $this->dbc = NULL;
    }

    /* Function getPDOConnection
     * Get a connection to the database using PDO.
     */
    private function getPDOConnection() {
        // Check if the connection is already established
        if ($this->dbc == NULL) {
            // Create the connection
            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4",
                $this->_cfg['hst'],$this->_cfg['tbl']);
            try {
                $this->dbc = new PDO($dsn,$this->_cfg['usr'],$this->_cfg['pss'],$this->opts );
            } catch( PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
        return $this->dbc;
    }

    public function selectPair($query) {
        try {
            $sth = $this->dbc->prepare($query);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_KEY_PAIR);
        } catch(PDOException $e) {
            echo __LINE__.' - '.$e->getMessage();
        }
    }

    /**
     * select all rows from table
     */
    public function getAll($query, $param = array()) {
        try {
            self::$sth = self::getPDOConnection()->prepare($query);
            self::$sth->execute((array) $param);
            return self::$sth->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo __LINE__.' - '.$e->getMessage();
        }
    }

    /**
     * call the stored procedure or function
     */
    public function callProc($proc,$param = array()) {
        try {
            $stmt = $this->dbc->prepare($proc);
            $stmt->bindParam(1, $param[0]);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }  catch(PDOException $e) {
            echo __LINE__.' - '.$e->getMessage();
        }
    }

    /**
     * get value
     */
    public function getValue($query, $param = array(), $default = null) {
        $result = self::getAll($query, $param);
        if (!empty($result)) {
            $result = array_shift($result);
        }

        return (empty($result)) ? $default : $result;
    }

    /* Function runQuery
     * Runs a insert, update or delete query
     * @param string sql insert update or delete statement
     * @return int count of records affected by running the sql statement.
     */
//    public function runQuery( $sql ) {
//        $count = '';
//        try {
//            $count = $this->dbc->exec($sql);
//        } catch(PDOException $e) {
//            echo __LINE__.$e->getMessage();
//        }
//        return $count;
//    }


}
