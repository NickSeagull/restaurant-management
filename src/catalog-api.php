<?php

require_once "DatabaseQuery.php";

$query = $_GET['query'];

$database_query = new DatabaseQuery();
$product_names = $database_query
               ->select("nombre")
               ->from("articulos")
               ->where("nombre LIKE \"%$query%\"")
               ->execute_for_all();

$database_query = new DatabaseQuery();
$product_prices = $database_query
                ->select("PVP")
                ->from("articulos")
                ->where("nombre LIKE \"%$query%\"")
                ->execute_for_all();

$response = "";
$pairs = array_combine($product_names, $product_prices);
foreach($pairs as $name => $price){
    $response .= "$name:$price;";
}

echo $response;