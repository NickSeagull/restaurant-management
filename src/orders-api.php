<?php
require_once("DatabaseQuery.php");
session_start();

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
    echo json_encode($tables);
}

function get_table_ids(){
    $database_query = new DatabaseQuery();
    $tables = $database_query
            ->select("id")
            ->from("mesas")
            ->execute_for_all();
    echo json_encode($tables);
}

function get_orders(){
    $database_query = new DatabaseQuery();
    $tables = $database_query
            ->select("*")
            ->from("comandas")
            ->execute_and_get_pdo();
    echo json_encode($tables);
}

function get_order_items(){
    $database_query = new DatabaseQuery();
    $tables = $database_query
            ->select("*")
            ->from("lineascomanda")
            ->execute_and_get_pdo();
    echo json_encode($tables);
}

function get_catalog(){
    $database_query = new DatabaseQuery();
    $tables = $database_query
            ->select("*")
            ->from("articulos")
            ->execute_and_get_pdo();
    echo json_encode($tables);
}

function get_waiters(){
    $database_query = new DatabaseQuery();
    $tables = $database_query
            ->select("nombre")
            ->from("usuarios")
            ->execute_and_get_pdo();
    echo json_encode($tables);
}

function get_logged_id(){
    echo $_SESSION['id'];
}