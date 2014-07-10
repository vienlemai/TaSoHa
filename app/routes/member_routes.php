<?php

Route::group(array('namespace' => 'Member', 'prefix' => 'member'), function() {
    Route::group(array('before' => 'member.auth'), function() {
        Route::get('/', array('as' => 'member.root', 'uses' => 'HomeController@index'));
        Route::get('member/create', array(
            'as' => 'member.create',
            'uses' => 'MemberController@create',
        ));

        Route::post('member/store', array(
            'as' => 'member.store',
            'uses' => 'MemberController@store',
        ));
        

        Route::get('{id}/show', array(
            'as' => 'member.show',
            'uses' => 'MemberController@show'
        ));
        Route::get('logout', array(
            'as' => 'member.logout',
            'uses' => 'HomeController@getLogout',
        ));
        Route::get('filter-bonus', array(
            'as' => 'member.filter_bonus',
            'uses' => 'HomeController@filterBonus',
        ));        
    });
    Route::post('login', array(
        'as' => 'member.login',
        'uses' => 'HomeController@postLogin',
    ));
});
