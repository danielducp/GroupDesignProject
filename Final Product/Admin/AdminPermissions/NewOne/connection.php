<?php

/*
 * This page contains the code for creating a PDO connection instance.
 */

// Db configs.
define('HOST', 'localhost');
define('DATABASE', 'g4udatabase');
define('USERNAME', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8');

$connection = new PDO(
        sprintf('mysql:host=%s;dbname=%s;charset=%s', HOST, DATABASE, CHARSET)
        , USERNAME
        , PASSWORD
        , [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => FALSE,
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
);