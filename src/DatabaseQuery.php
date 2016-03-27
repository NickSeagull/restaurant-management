<?php

class DatabaseQuery {
    public function __construct($query = ""){
        $this->query = $query;
        $this->database = new PDO("sqlite:./datos.db");
        $this->enable_referential_integrity();
    }

    private function enable_referential_integrity(){
        $this->database->exec("PRAGMA foreign_keys = ON;");
    }

    private function bind($query){
        $this->query = $this->query . $query;
        return $this;
    }

    public function select($item){
        if($item != "*") $this->selection = $item;
        return $this->bind("SELECT $item ");
    }

    public function from($table){
        return $this->bind("FROM $table ");
    }

    public function where($condition){
        return $this->bind("WHERE $condition ");
    }

    public function new_line(){
        return $this->bind(";\n");
    }

    public function execute(){
        $query = $this->query . ";\n";
        $result = $this->database->query($query)->fetch();
        return $result[$this->selection];
    }
}

$in_database = new DatabaseQuery();