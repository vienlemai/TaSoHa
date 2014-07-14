<?php

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function() {
    Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
    Route::get('elfinder/ckeditor4', 'Barryvdh\Elfinder\ElfinderController@showCKeditor4');
});

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin'), function() {
    Route::get('/login', array(
        'as' => 'admin.login',
        'uses' => 'HomeController@getLogin'
    ));
    Route::post('/login', array(
        'as' => 'admin.login',
        'uses' => 'HomeController@postLogin'
    ));
    Route::get('error/{type}', array(
        'as' => 'admin.error',
        'uses' => 'HomeController@error'
    ));
});

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin', 'before' => 'admin.auth'), function() {
    Route::get('/', array('as' => 'admin.root', 'uses' => 'HomeController@index'));
    Route::get('/logout', array(
        'as' => 'admin.logout',
        'uses' => 'HomeController@logout',
    ));
    Route::get('/users/profile', array(
        'as' => 'admin.users.profile',
        'uses' => 'AdminUserController@profile'
    ));
    Route::post('users/profile', array(
        'as' => 'admin.users.profile',
        'uses' => 'AdminUserController@postProfile'
    ));
    Route::get('users/password', array(
        'as' => 'admin.users.password',
        'uses' => 'AdminUserController@password'
    ));
    Route::post('users/password', array(
        'as' => 'admin.users.password',
        'uses' => 'AdminUserController@postPassword'
    ));
    Route::group(array('before' => 'admin.permission'), function() {
        Route::resource('articles', 'ArticleController');
        Route::resource('article_categories', 'ArticleCategoryController');

        Route::resource('product', 'ProductController');
        Route::resource('product_category', 'ProductCategoryController');

        Route::resource('news', 'NewsController');
        Route::resource('page', 'PageController', array('only' => array('index', 'edit', 'update')));

        Route::resource('members', 'MemberController');
        Route::resource('users', 'AdminUserController');
        Route::resource('groups', 'AdminGroupController');
        Route::resource('slide', 'SlideImageController');
        Route::resource('bills', 'BillController');
        Route::get('group/{id}/permission', array(
            'as' => 'admin.groups.permission',
            'uses' => 'AdminGroupController@getPermission'
        ));
        Route::post('group/{id}/permission', array(
            'as' => 'admin.groups.permission',
            'uses' => 'AdminGroupController@postPermission',
        ));
        Route::get('member/{type?}/tree', array(
            'as' => 'admin.members.tree',
            'uses' => 'MemberController@tree'
        ));
        Route::get('member/tree-binary/children/{parentId?}', function($parentId = null) {
            $data = Member::getBinaryChildren($parentId);
            return Response::json($data);
        });
        Route::get('member/tree-sun/children/{parentId?}', function($introducerId = null) {
            $data = Member::getSunChildren($introducerId);
            return Response::json($data);
        });
        Route::get('bonus/{memberId}/create', array(
            'as' => 'admin.bonus.create',
            'uses' => 'BonusController@create',
        ));
        Route::post('bonus/{memberId}/store', array(
            'uses' => 'BonusController@store',
            'as' => 'admin.bonus.store'
        ));
    });
});
