<?php

Route::group(array('namespace' => 'Member', 'prefix' => 'member'), function() {
    Route::get('/', array('as' => 'member.root', 'uses' => 'HomeController@index'));
    Route::post('member/{parentId}/create', array(
        'as' => 'member.create',
        'uses' => 'MemberController@create',
    ));
});
