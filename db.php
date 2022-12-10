<?php
//dsn
//username
//password

$dsn = "mysql:host=localhost;dbname=seussology";
$user = "root";
$pass = "";

try{
    $db = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Database connection unsuccessful';
    die();
}
