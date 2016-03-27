<?php
$user = $_POST['user'];
$pass = md5($_POST['pass']);

echo "U: $user P: $pass";

