<?php

Route::group(array('namespace' => 'Member', 'prefix' => 'member'), function() {
    Route::group(array('before' => 'member.auth'), function() {
        Route::get('/', array('as' => 'member.root', 'uses' => 'HomeController@index'));
        Route::get('profile', array(
            'as' => 'member.profile',
            'uses' => 'MemberController@profile'
        ));
        Route::get('change-password', array(
            'as' => 'member.change_password',
            'uses' => 'MemberController@getChangePassword',
        ));
        Route::post('change-password', array('as' => 'member.change_password', 'uses' => 'MemberController@changePassword'));
        Route::post('update-profile', array('as' => 'member.update_profile', 'uses' => 'MemberController@updateProfile'));

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
