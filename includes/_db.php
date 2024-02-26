<?php

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $db = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'coatinc',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ]);
} else {
    $db = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'coatinc',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ]);
}
