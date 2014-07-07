<?php

//return array(
//    'fetch' => PDO::FETCH_CLASS,
//    'default' => 'mysql',
//    'connections' => array(
//        'mysql' => array(
//            'driver' => 'mysql',
//            'host' => 'localhost',
//            'database' => 'tasoha',
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',
//            'collation' => 'utf8_unicode_ci', 
//            'prefix' => '',
//        )
//    ),
//    'migrations' => 'migrations'
//);

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
