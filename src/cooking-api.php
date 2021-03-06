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

function get_catalog(){
    $database_query = new DatabaseQuery();
    $items = $database_query
           ->select("*")
           ->from("articulos")
           ->execute_and_get_pdo();
    echo json_encode($items);
}

function get_waiting(){
    $database_query = new DatabaseQuery();
    $items = $database_query
           ->select("*")
           ->from("lineascomanda")
           ->where("horainicio = 0 and tipo = 1")
           ->execute_and_get_pdo();
    echo json_encode($items);
}

function get_cooking(){
    $database_query = new DatabaseQuery();
    $items = $database_query
           ->select("*")
           ->from("lineascomanda")
           ->where("horainicio > 0 and tipo = 1 and horafinalizacion = 0")
           ->execute_and_get_pdo();
    echo json_encode($items);
}

function start_cooking($item){
    $time = time();
    $order = $item[1];
    $articulo = $item[0];
    
    $database_query = new DatabaseQuery();
    $items = $database_query
           ->update("lineascomanda")
           ->set("horainicio = $time")
           ->where("comanda = $order and articulo = $articulo")
           ->commit();
    echo $items;
}

function finish_cooking($item){
    $time = time();
    $order = $item[1];
    $articulo = $item[0];
    
    $database_query = new DatabaseQuery();
    $items = $database_query
           ->update("lineascomanda")
           ->set("horafinalizacion = $time")
           ->where("comanda = $order and articulo = $articulo")
           ->commit();
    echo $items;
}