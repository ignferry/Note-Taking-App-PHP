<?php

namespace App\core;

use PDO;
use PDOException;
use PDOStatement;

class Database {
    private $host = "db";
    private $user = "root";
    private $pass = "";
    private $dbName = "NoteTakingApp";

    private PDO $dbConnection;
    private PDOStatement|false $statement;

    public function __construct() {
        try {
            $this->dbConnection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->user, $this->pass);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function prepare(string $query) {
        $this->statement = $this->dbConnection->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->statement->execute();
    }

    public function resultSet() {
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single() {
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        return $this->statement->rowCount();
    }
}


?>