<?php

Route::group(array('namespace' => 'Frontend'), function() {
            Route::get('/', array('as' => 'fe.root', 'uses' => 'HomeController@index'));
            Route::post('/login', array('as' => 'fe.login', 'uses' => 'AuthController@login'));
        });
