<?php

Route::group(array('namespace' => 'Member', 'prefix' => 'member'), function() {
    Route::group(array('before' => 'member.auth'), function() {
        Route::get('/', array('as' => 'member.root', 'uses' => 'HomeController@index'));
        Route::get('member/create', array(
            'as' => 'member.create',
            'uses' => 'MemberController@create',
        ));
        Route::get('profile', array(
            'as' => 'member.profile',
            'uses' => 'HomeController@profile'
        ));
        Route::post('change-password', array('as' => 'member.change_password', 'uses' => 'HomeController@changePassword'));
        Route::post('update-profile', array('as' => 'member.update_profile', 'uses' => 'HomeController@updateProfile'));


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
        Route::get('member/tree-binary/children/{parentId?}', function($parentId = null) {
            $data = Member::getBinaryChildren($parentId);
            return Response::json($data);
        });
        Route::get('member/tree-sun/children/{parentId?}', function($introducerId = null) {
            $data = Member::getSunChildren($introducerId);
            return Response::json($data);
        });
    });
    Route::post('login', array(
        'as' => 'member.login',
        'uses' => 'HomeController@postLogin',
    ));
});
