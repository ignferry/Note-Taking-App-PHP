<?php

namespace App\core;

require_once "Database.php";

use App\core\Database;

abstract class Model {
    protected string $tableName;

    private Database $db;

    private string $query;
    private array $attrToBind;

    public function __construct() {
        $this->db = new Database();
        $this->query = "";
        $this->attrToBind = [];
    }

    public function selectAll() {
        $this->query = "SELECT * FROM $this->tableName";

        return $this;
    }

    public function select(array $attrs) {
        $this->query .= "SELECT ";

        $firstDone = false;
        foreach($attrs as $attr) {
            if ($firstDone) {
                $this->query .= ", ";
            }
            else {
                $firstDone = true;
            }
            $this->query .= $attr;
        }

        $this->query .= " FROM $this->tableName";

        return $this;
    }

    public function create(array $attrVal) {
        $this->query = "INSERT INTO $this->tableName" . "(";

        $firstDone = false;
        foreach($attrVal as $attr => $val) {
            if ($firstDone) {
                $this->query .= ", ";
            }
            else {
                $firstDone = true;
            }
            $this->query .= $attr;
        }
        $this->query .= ") VALUES (";

        $firstDone = false;
        foreach($attrVal as $attr => $val) {
            if ($firstDone) {
                $this->query .= ", ";
            }
            else {
                $firstDone = true;
            }
            $this->query .= ":" . $attr;
            $this->attrToBind[$attr] = $val;
        }
        $this->query .= ")";

        return $this;
    }

    public function update(array $newAttrVal) {
        $this->query = "UPDATE $this->tableName SET ";
        
        $firstDone = false;
        foreach($newAttrVal as $attr => $val) {
            if ($firstDone) {
                $this->query .= ", ";
            }
            else {
                $firstDone = true;
            }
            $this->query .= $attr . " = :new" . $attr;
            $this->attrToBind["new" . $attr] = $val;
        }

        return $this;
    }

    public function delete() {
        $this->query = "DELETE FROM $this->tableName ";

        return $this;
    }

    public function where($attrOpValArray) {
        $this->query .= " WHERE ";

        $arrayLength = sizeof($attrOpValArray);

        $startIndex = 0;

        for ($i = 0; $i < $arrayLength; $i++) {
            if ($this->verifyOp($attrOpValArray[$i][1])) {
                if ($i != $startIndex) {
                    $this->query .= " AND ";
                }

                $this->query .= $attrOpValArray[$i][0] . " " . $attrOpValArray[$i][1] . " :" . $attrOpValArray[$i][0];
                $this->attrToBind[$attrOpValArray[$i][0]] = $attrOpValArray[$i][2];
                $startIndex = -999;
            }
            else {
                $startIndex += 1;
            }
        }
        
        return $this;
    }

    public function orderBy(string $attr, bool $ascending) {
        $this->query .= " ORDER BY $attr";
        if ($ascending) {
            $this->query .= " ASC ";
        }
        else {
            $this->query .= " DESC ";
        }

        return $this;
    }

    public function execute() {
        $this->prepareAndBindAll();
        $this->db->execute();
    }

    public function fetch() {
        $this->prepareAndBindAll();
        return $this->db->fetch();
    }

    public function fetchAll() {
        $this->prepareAndBindAll();
        return $this->db->fetchAll();
    }

    public function checkRowCount() {
        return $this->db->rowCount();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    private function verifyOp(string $op) {
        return $op == "=" || $op == ">" || $op == "<" || $op == ">=" || $op == "<=";
    }

    private function prepareAndBindAll() {
        $this->db->prepare($this->query);

        foreach($this->attrToBind as $attr => $val) {
            $this->db->bind($attr, $val);
        }
    }
}

?>