<?php

require_once("DatabaseQuery.php");

$TYPES = array(1 => "waiter",
               2 => "cook");

$user = $_POST['user'];
$pass = md5($_POST['pass']);

$database_query = new DatabaseQuery();

$db_pass = $database_query
         ->select("clave")
         ->from("usuarios")
         ->where("usuario = \"$user\"")
         ->execute();

if($pass == $db_pass){
    login_success($user);
} else {
    echo "Nope!";
}

function login_success($user){
    global $TYPES;
    $database_query = new DatabaseQuery();
    $db_role = $database_query
             ->select("tipo")
             ->from("usuarios")
             ->where("usuario = \"$user\"")
             ->execute();
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['role'] = $TYPES[$db_role];
    header('Location: login.php');
    exit;
}