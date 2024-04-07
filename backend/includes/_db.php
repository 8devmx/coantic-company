<?php

use Medoo\Medoo;

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $db = new Medoo([
        'type' => 'mysql',
        'host' => 'localhost',
        'database' => 'coatinc',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ]);
} else {
    $db = new Medoo([
        'type' => 'mysql',
        'host' => 'localhost',
        'database' => 'qxpmaqmy_web',
        'username' => 'qxpmaqmy_web',
        'password' => 'Web.2024!',
        'charset' => 'utf8'
    ]);
}
