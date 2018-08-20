<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 31.07.2018
 * Time: 23:38
 */

class DB {
    public static $dsn = 'mysql:dbname=table;host=localhost';
    public static $user = 'user';
    public static $pass = 'password';

    /**
     * PDO object.
     */
    public static $dbh = null;

    /**
     * Statement Handle.
     */
    public static $sth = null;

    /**
     * An SQL query.
     */
    public static $query = '';

    /**
     * Connection to the DB
     */
    public static function getDbh() {
        if (!self::$dbh) {
            try {
                self::$dbh = new PDO(
                    self::$dsn,
                    self::$user,
                    self::$pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (PDOException $e) {
                exit('Error connecting to database: ' . $e->getMessage());
            }
        }

        return self::$dbh;
    }

    /**
     * Add record to the DB, returns ID if success ant 0 otherwise
     */
    public static function add($query, $param = array()) {
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute((array) $param)) ? self::getDbh()->lastInsertId() : 0;
    }

    /**
     * Execution query
     */
    public static function set($query, $param = array()) {
        self::$sth = self::getDbh()->prepare($query);
        return self::$sth->execute((array) $param);
    }

    /**
     * get row from the db
     */
    public static function getRow($query, $param = array()) {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * select all rows from table
     */
    public static function getAll($query, $param = array()) {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * get value
     */
    public static function getValue($query, $param = array(), $default = null) {
        $result = self::getRow($query, $param);
        if (!empty($result)) {
            $result = array_shift($result);
        }

        return (empty($result)) ? $default : $result;
    }

    /**
     * get row from the table
     */
    public static function getColumn($query, $param = array()) {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_COLUMN);
    }
}

/*
Примеры использования
DB::getRow — получение одной записи из БД

$item = DB::getRow("SELECT * FROM `category` WHERE `id` = ?", 1);
// Или
$item = DB::getRow("SELECT * FROM `category` WHERE `id` = :id", array('id' => 1));

print_r($item);

Результат:

Array
(
    [id] => 1
    [parent] => 0
    [name] => Мороженое
)

DB::getAll — получение нескольких записей из БД

$items = DB::getAll("SELECT * FROM `category` WHERE `id` > 2");
print_r($items);

Результат:

Array
(
    [0] => Array
        (
            [id] => 3
            [parent] => 0
            [name] => Фрукты
        )
    [1] => Array
        (
            [id] => 4
            [parent] => 0
            [name] => Ягоды
        )
    [2] => Array
        (
            [id] => 5
            [parent] => 2
            [name] => Грибы
        )
    ...
)

DB::getValue — получения значения

$value = DB::getValue("SELECT `name` FROM `category` WHERE `id` = 2");
print_r($value);

Результат:

Овощи

DB::getColumn — получения значений колонки

$values = DB::getColumn("SELECT `name` FROM `category`");
print_r($values);

Результат:

Array
(
    [0] => Мороженое
    [1] => Овощи
    [2] => Фрукты
    [3] => Ягоды
    [4] => Грибы
    [5] => Морепродукты
    ...
)

DB::add — добавление в БД

Метод возвращает ID вставленной записи.

$insert_id = DB::add("INSERT INTO `category` SET `name` = ?", 'Яблоки');

DB::set — все остальные запросы

Выполняет запросы в БД, такие как DELETE, UPDATE, CREATE TABLE и т.д. В случаи успеха возвращает true.

DB::set("DELETE FROM `category` WHERE `id` > ? AND `parent` > ?", array(123, 0));
 */
