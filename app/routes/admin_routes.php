<?php

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin'), function() {
    Route::group(array('before' => 'admin.auth'), function() {
        Route::get('/', array('as' => 'admin.root', 'uses' => 'HomeController@index'));
        Route::get('/logout', array(
            'as' => 'admin.logout',
            'uses' => 'HomeController@logout',
        ));
        Route::resource('articles', 'ArticleController');
//        Route::get('article',  array(
//            'as'=>'article',
//            'uses'=>'ArticleController@index'
//        ));
    });

    Route::get('/login', array(
        'as' => 'admin.login',
        'uses' => 'HomeController@getLogin'
    ));
    Route::post('/login', array(
        'as' => 'admin.login',
        'uses' => 'HomeController@postLogin'
    ));
});

