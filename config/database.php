<?php
require_once __DIR__ . 'config.php';

function getDBConnection() {
    $host = getenv('localhost');
    $db   = getenv('biblioteca');
    $user = getenv('root');
<<<<<<< HEAD
    $pass = getenv('');
=======
    $pass = getenv('ZOskAlesufLbKVbvYFmyZelfBHzROMsG');
>>>>>>> 2f23a7bc328f41b0f56059eac88060d12c7bf710
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}