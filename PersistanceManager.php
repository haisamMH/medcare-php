<?php

class PersistanceManager {

    private $pdo;
    private $dbHost = 'localhost';
    private $dbUserName = 'root';
    private $dbPassword = 'root';
    private $dbName = 'uor_pms';

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUserName, $this->dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function run($query, $param = null, $fetchFirstRecOnly = false) {
        $result = $this->executeQuery($query, $param, $fetchFirstRecOnly);
        return $result;
    }

    public function insertAndGetLastRowId($query, $param = null) {
        $result = $this->executeQuery($query, $param, true, true);
        return $result;
    }

    private function executeQuery($query, $param = null, $fetchFirstRecOnly = false, $getLastInsertedId = false) {
        try {
            $stmt = $this->pdo->prepare($query);
            $t = $stmt->execute($param);
            if ($getLastInsertedId) {
                return $this->pdo->lastInsertId();
            }
            if (strtoupper(substr(trim($query), 0, 6)) == "SELECT") {
                if ($fetchFirstRecOnly)
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                else
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $result;
            }
            $stmt->closeCursor();
            if ($t) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>