<?php

return array(
    'fetch' => PDO::FETCH_CLASS,
    'default' => 'mysql',
    'connections' => array(
        'mysql' => array(
            'driver' => 'mysql',
            'host' => '127.10.129.2',
            'database' => 'tasoha',
            'username' => 'adminMl4uygt',
            'password' => 'PjhCemc6Aysp',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci', 
            'prefix' => '',
        )
    ),
    'migrations' => 'migrations'
);
