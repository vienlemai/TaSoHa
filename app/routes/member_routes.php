<?php

Route::group(array('namespace' => 'Member', 'prefix' => 'member'), function() {
    Route::group(array('before' => 'member.auth'), function() {
        Route::get('/', array('as' => 'member.root', 'uses' => 'HomeController@index'));
        Route::get('create/{parentId}', array(
            'as' => 'member.create',
            'uses' => 'MemberController@create',
        ));

        Route::get('{id}/show', array(
            'as' => 'member.show',
            'uses' => 'MemberController@show'
        ));
        Route::get('logout', array(
            'as' => 'member.logout',
            'uses' => 'HomeController@getLogout',
        ));
    });
    Route::post('login', array(
        'as' => 'member.login',
        'uses' => 'HomeController@postLogin',
    ));
});
