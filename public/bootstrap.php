<?php

session_start();

include 'config.php';
include '../vendor/autoload.php';

try {
    $db = new \PDO("mysql:host=$dbHost;dbname=".$dbName, $dbUser, $dbPassword);
} catch (\Exception $e) {
    die($e->getMessage());
}

$di = [
    'db' => $db,
    'config' => $config,
];
