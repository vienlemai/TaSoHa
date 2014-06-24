<?php

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin'), function() {
            Route::get('/', array('as' => 'admin.root', 'uses' => 'HomeController@index'));
        });
?>
