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

    public function insert_into($table){
        return $this->bind("INSERT INTO [$table] ");
    }

    public function fields(){
        $fields = "(";
        $fields .= implode(",", array_map(function($f){
            return "[$f]";
        }, func_get_args()));
        $fields .= ") ";
        return  $this->bind($fields);
    }

    public function values(){
        $values = "VALUES (";
        $values .= implode(",", array_map(function($v){
            return "'$v'";
        }, func_get_args()));
        $values .= ") ";
        return $this->bind($values);
    }

    public function delete(){
        return $this->bind("DELETE ");
    }

    public function update($table){
        return $this->bind("UPDATE $table ");
    }

    public function set($query){
        return $this->bind("SET $query ");
    }

    public function commit(){
        $query = $this->query .";\n";
        return $this->database->exec($query);
    }

    public function get_query(){
        return $this->query;
    }

    public function execute(){
        $query = $this->query . ";\n";
        $result = $this->database->query($query)->fetch();
        return $result[$this->selection];
    }

    public function execute_for_all(){
        $query = $this->query . ";\n";
        $result = $this->database->query($query)->fetchAll();
        $r = array();
        foreach($result as $row){
            $r[] =$row[$this->selection];
        }
        return $r;
    }

    public function execute_and_get_pdo(){
        $query = $this->query . ";\n";
        $result = $this->database->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

$in_database = new DatabaseQuery();