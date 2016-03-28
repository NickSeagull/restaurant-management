<?php
require_once("DatabaseQuery.php");
session_start();

if(isset($_GET['method'])){
    dispatch_get($_GET['method']);
} else {
    dispatch_post($_POST['method'], $_POST['args']);
}

function dispatch_get($method){
    call_user_func($method);
}

function dispatch_post($method, $args){
    call_user_func($method, json_decode($_POST['args']));
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

function commit_item($args){
    $database_query = new DatabaseQuery();

    $item = $args[0];
    $order = $args[1];
    $waiter = $_SESSION['id'];
    $time = time();
    $type = $database_query
          ->select("tipo")
          ->from("articulos")
          ->execute();

    $database_query = new DatabaseQuery();
    $success = $database_query
             ->insert_into("lineascomanda")
             ->fields("comanda",
                      "articulo",
                      "camareropeticion",
                      "horapeticion",
                      "tipo")
             ->values($order, $item, $waiter, $time, $type)
             ->commit();
    echo $success;
}