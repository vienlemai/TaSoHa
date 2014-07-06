<?php

Route::group(array('namespace' => 'Frontend'), function() {
    Route::get('/', array('as' => 'fe.root', 'uses' => 'HomeController@index'));
    Route::get('/search', array('as' => 'fe.search', 'uses' => 'HomeController@search'));
    Route::post('/login', array('as' => 'fe.login', 'uses' => 'AuthController@login'));
});
