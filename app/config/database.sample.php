<?php

return array(
    'fetch' => PDO::FETCH_CLASS,
    'default' => 'mysql',
    'connections' => array(
        'sqlite' => array(
            'driver' => 'sqlite',
            'database' => __DIR__ . '/../database/production.sqlite',
            'prefix' => '',
        ),
        'mysql' => array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'tasoha',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        )
    ),
    'migrations' => 'migrations'
);
