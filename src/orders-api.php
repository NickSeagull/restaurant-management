<?php
require_once("DatabaseQuery.php");


dispatch($_GET['method']);

function dispatch($method){
    call_user_func($method);
}

function get_tables(){
    $database_query = new DatabaseQuery();
    $tables = $database_query
            ->select("nombre")
            ->from("mesas")
            ->execute_for_all();
    $r = "";
    foreach($tables as $table){
        $r .= "$table;";
    }
    echo $r;
}