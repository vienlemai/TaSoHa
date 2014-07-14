<?php

Route::group(array('namespace' => 'Frontend'), function() {
    Route::get('/', array('as' => 'fe.root', 'uses' => 'HomeController@index'));
    Route::get('/search', array('as' => 'fe.search', 'uses' => 'HomeController@search'));
    Route::post('/login', array('as' => 'fe.login', 'uses' => 'AuthController@login'));
    Route::get('/category/{category}', array(
        'as' => 'fe.category', 'uses' => 'ArticleController@category')
    );
    Route::get('/article/{article}', array(
        'as' => 'fe.article.show', 'uses' => 'ArticleController@show')
    );
    Route::get('/news', array(
        'as' => 'fe.news.index', 'uses' => 'NewsController@index')
    );
    Route::get('/news/{news}', array(
        'as' => 'fe.news.show', 'uses' => 'NewsController@show')
    );
    Route::get('/tasoha/{page}', array(
        'as' => 'fe.page.show', 'uses' => 'HomeController@page')
    );
});
