<?php

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin'), function() {
    Route::group(array('before' => 'admin.auth'), function() {
        Route::get('/', array('as' => 'admin.root', 'uses' => 'HomeController@index'));
        Route::get('/logout', array(
            'as' => 'admin.logout',
            'uses' => 'HomeController@logout',
        ));

        Route::resource('articles', 'ArticleController');
        Route::resource('article_categories', 'ArticleCategoryController');
        Route::resource('members', 'MemberController');
        Route::resource('users', 'AdminUserController');
        Route::get('bonus/{memberId}/create', array(
            'as' => 'admin.bonus.create',
            'uses' => 'BonusController@create',
        ));
        Route::post('bonus/{memberId}/store', array(
            'uses' => 'BonusController@store',
            'as' => 'admin.bonus.store'
        ));
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

