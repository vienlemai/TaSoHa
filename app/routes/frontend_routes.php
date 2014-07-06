<?php

Route::group(array('namespace' => 'Frontend'), function() {
    Route::get('/', array('as' => 'fe.root', 'uses' => 'HomeController@index'));
    Route::get('/index2', array('as' => 'fe.root2', 'uses' => 'HomeController@index2'));
});
