<?php

require_once "database.class.php";

$host = 'localhost';
$dbname = 'iti-labs';
$username = 'root';
$password = '';

$database = new Database();
$database->connect($host, $dbname, $username, $password);
?>
