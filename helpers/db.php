<?php

// Information to connect to database
$host = 'localhost';
$db   = 'ccva';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

/*
$host = '10.10.23.183';
$db   = 'db_a52092';
$user = 'a52092';
$pass = '02ae55';
$charset = 'utf8';
*/

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// We use PDO connection
$pdo = new PDO($dsn, $user, $pass, $opt);

?>