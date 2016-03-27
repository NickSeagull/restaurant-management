<?php

require_once("DatabaseQuery.php");

$TYPES = array(1 => "waiter",
               2 => "cook");

check_login();

function check_login(){
    if(password_is_correct()){
        login_success(user_from_request());
    } else {
        login_failure();
    }
}

function password_is_correct(){
    return pass_from_request() == pass_from_database(user_from_request());
}

function user_from_request(){
    return $_POST['user'];
}

function pass_from_request(){
    return md5($_POST['pass']);
}

function pass_from_database($user){
    $database_query = new DatabaseQuery();
    return $database_query
        ->select("clave")
        ->from("usuarios")
        ->where("usuario = \"$user\"")
        ->execute();
}

function login_success($user){
    global $TYPES;
    reset_session();
    $_SESSION['role'] = $TYPES[role_from_database($user)];
    header('Location: index.php');
    exit;
}

function reset_session(){
    session_unset();
    session_destroy();
    session_start();
}

function role_from_database($user){
    $database_query = new DatabaseQuery();
    return $database_query
             ->select("tipo")
             ->from("usuarios")
             ->where("usuario = \"$user\"")
             ->execute();
}

function login_failure(){
    echo "Username or password was incorrect, try again.";
}