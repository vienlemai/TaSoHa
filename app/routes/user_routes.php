<?php

Route::group(array('namespace' => 'User', 'prefix' => 'user'), function() {
            Route::get('/', array('as' => 'user.root', 'uses' => 'HomeController@index'));
        });
?>