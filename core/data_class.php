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
    protected $_config;

    // Database Connection
    public $dbc;

    // Connection options
    private $opts;

    /* function __construct
     * Opens the database connection
     * @param $config is an array of database connection parameters
     */
    public function __construct() {
        $cfg = require_once CONFIG;
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
//            $dsn = "mysql:host=".$this->_cfg['hst'].";dbname=". $this->_cfg['tbl'].";charset=utf8mb4";
            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4",
                $this->_cfg['hst'],$this->_cfg['tbl']);
            try {
                $this->dbc = new PDO($dsn,$this->_cfg['usr'],$this->_cfg['pss'],$this->opts );
            } catch( PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
        return $this;
    }

    /* Function runQuery
     * Runs a insert, update or delete query
     * @param string sql insert update or delete statement
     * @return int count of records affected by running the sql statement.
     */
    public function runQuery( $sql ) {
        try {
            $count = $this->dbc->exec($sql) or print_r($this->dbc->errorInfo());
        } catch(PDOException $e) {
            echo __LINE__.$e->getMessage();
        }
        return $count;
    }

    /* Function getQuery
     * Runs a select query
     * @param string sql insert update or delete statement
     * @returns associative array
     */
    public function getQuery( $sql ) {
        $stmt = $this->dbc->query( $sql );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt;
    }

/*
        private $usr,$pss, $hst, $tbl;
        private $opts;

    public function __construct($cfg) {


    }

    // ============================================================================
    public function lemmeIn() {

        set_exception_handler(function($e) {
            error_log($e->getMessage());
            exit('Something weird happened: '.$e->getMessage()); //something a user can understand
        });

        $dsn = "mysql:host=".$this->hst.";dbname=".$this->tbl.";charset=utf8mb4";

        try { $this->pdo = new PDO($dsn, $this->usr, $this->pss, $this->opts); }
        catch (PDOException $e) { $e->getMessage();       }

    }
*/
}