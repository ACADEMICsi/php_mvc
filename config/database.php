<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'php_mvc_users');
define('DB_USER', 'root');
define('DB_PASS', 'Jay9Nine!');           
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO
{

    $dsn = "mysql:host=" . DB_HOST
         . ";dbname=" . DB_NAME
         . ";charset=" . DB_CHARSET;

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        
        PDO::ATTR_EMULATE_PREPARES   => false,                   
    ];

    try {
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        
        die("Database connection failed: " . $e->getMessage());
    }
}