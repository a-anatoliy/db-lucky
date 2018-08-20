<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 19.08.2018
 * Time: 17:54
 */

class Yet_another_CRUD {


    /* CRUD functions */

    /* $value = 'Justin Bieber' */
    /**
     * @param $pdo
     * @param $table
     * @param $value
     * @return string
     */
    public function sqlInsert($pdo,$table,$value) {
        try {
//            $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('INSERT INTO '.$table.' VALUES(:name)');
            $stmt->execute(array(
                ':name' => $value
            ));

            # affected rows?
            return $stmt->rowCount(); // 1
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param $pdo
     * @param $table
     * @param $id
     * @param $value
     * @return string
     */
    public function sqlUpdate($pdo,$table,$id,$value) {
        try {
//            $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('UPDATE '.$table.' SET name = :name WHERE id = :id');
            $stmt->execute(array(
                ':id'   => $id,
                ':name' => $value
            ));

            return $stmt->rowCount(); // 1
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }

    }

    /**
     * @param $pdo
     * @param $table
     * @param $id
     * @return string
     */
    public function sqlDelete($pdo,$table,$id) {
        try {
//            $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('DELETE FROM '.$table.' WHERE id = :id');
            $stmt->bindParam(':id', $id); // Воспользуемся методом bindParam
            $stmt->execute();

            return $stmt->rowCount(); // 1
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param $pdo
     * @param $query
     * @param $value
     * @return string
     */
    public function sqlSelect($pdo, $query, $value="") {
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare($query);
            if (empty($value)) {$q->execute();} else { $q->execute($value); }
            return $q->fetchAll();
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

//    public static function getSupportedLanguages($parent) {
//
//        try {
//            $parent->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $q = $parent->dbh->prepare(QueryMap::SELECT_LANGUAGES);
//            $res = $q->fetchAll();
//// echo '<pre>obj: '; var_dump($res); echo '</pre>';
//            return $res;
//
//        } catch(PDOException $e) {
//            return 'Error: ' . $e->getMessage();
//        }
//    }



}
