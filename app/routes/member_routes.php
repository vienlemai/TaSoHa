<?php

Route::group(array('namespace' => 'Member', 'prefix' => 'member'), function() {
    Route::group(array('before' => 'member.auth'), function() {
        Route::get('/', array('as' => 'member.root', 'uses' => 'HomeController@index'));
        Route::get('profile', array(
            'as' => 'member.profile',
            'uses' => 'MemberController@profile'
        ));
        Route::get('bonus', array(
            'as' => 'member.bonus',
            'uses' => 'MemberController@bonus'
        ));
        Route::get('tree', array(
            'as' => 'member.tree',
            'uses' => 'MemberController@tree',
        ));
        Route::get('bills', array(
            'as' => 'member.bills',
            'uses' => 'MemberController@bills',
        ));
        Route::get('tree-binary/children/{parentId?}', function($parentId = null) {
            if ($parentId == null) {
                $memberId = Auth::member()->get()->id;
                $data = BinaryMember::getNode($memberId);
            } else {
                $data = BinaryMember::getChildren($parentId);
            }
            return Response::json($data);
        });
        Route::get('tree-sun/children/{parentId?}', function($introducerId = null) {
            if ($introducerId == null) {
                $memberId = Auth::member()->get()->id;
                $data = SunMember::getNode($memberId);
            } else {
                $data = SunMember::getChildren($introducerId);
            }
            return Response::json($data);
        });
        Route::get('change-password', array(
            'as' => 'member.change_password',
            'uses' => 'MemberController@getChangePassword',
        ));
        Route::post('change-password', array('as' => 'member.change_password', 'uses' => 'MemberController@changePassword'));
        Route::get('update-profile', array(
            'as' => 'member.update_profile',
            'uses' => 'MemberController@getUpdateProfile'
        ));
        Route::post('update-profile', array(
            'as' => 'member.update_profile',
            'uses' => 'MemberController@postUpdateProfile'
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
