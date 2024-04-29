<?php

return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'world_cities',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'options' => [
            //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    ]
];