<?php

return array(
    'fetch' => PDO::FETCH_CLASS,
    'default' => 'mysql',
    'connections' => array(
        'mysql' => array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'tasoha-dev',
            'username' => 'root',
            'password' => 'Htlu@n2605',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci', 
            'prefix' => '',
        )
    ),
    'migrations' => 'migrations'
);
