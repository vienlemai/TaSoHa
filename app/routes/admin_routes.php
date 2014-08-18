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
    Route::get('direct-bonus', function() {
        Member::updateDirectBonus();
    });
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
    Route::get('tinh-hoa-hong', function() {
        return View::make('admin.tmp.tinh_hoa_hong');
    });
    Route::post('tinh-hoa-hong', function() {
        $month = Carbon\Carbon::now()->format('m/Y');
        $result = Member::getMonthlyBonus($month);
        //$result = false;
        if ($result) {
            $message = 'Đã tính thành công hoa hồng cho tháng ' . $month;
        } else {
            $message = 'Hoa hồng cho tháng ' . $month . ' đã được tính trước đó, bạn không thể tính lại';
        }
        $response = array(
            'status' => $result,
            'message' => $message
        );
        return Response::json($response);
    });
    Route::get('xoa-du-lieu', function() {
        return View::make('admin.tmp.xoa_du_lieu');
    });
    Route::post('xoa-du-lieu', function() {
        Bill::resetBill();
        $response = array(
            'status' => true,
            'message' => 'Đã xóa hết dữ liệu của hóa đơn, xóa hết điểm của thành viên.'
        );
        return Response::json($response);
    });

    Route::get('member/tree-binary/children/{parentId?}', function($parentId = null) {
        $data = BinaryMember::getChildren($parentId);
        return Response::json($data);
    });
    Route::get('member/tree-sun/children/{parentId?}', function($introducerId = null) {
        $data = SunMember::getChildren($introducerId);
        return Response::json($data);
    });
    Route::group(array('before' => 'admin.permission'), function() {
        Route::resource('articles', 'ArticleController');
        Route::resource('article_categories', 'ArticleCategoryController');

        Route::resource('product', 'ProductController');
        Route::resource('product_category', 'ProductCategoryController');

        Route::resource('news', 'NewsController');
        Route::resource('page', 'PageController', array('only' => array('index', 'edit', 'update')));

        Route::resource('members', 'MemberController');
        Route::resource('menu', 'MenuController');
        Route::get('menu/select-article', array(
            'as' => 'menu.select.article',
            'uses' => 'MenuController@selectCategory',
        ));
        Route::get('/members/{id}/shares', array(
            'as' => 'admin.members.shares',
            'uses' => 'MemberController@getShares'
        ));
        Route::post('/members/{id}/shares', array(
            'as' => 'admin.members.shares',
            'uses' => 'MemberController@postShares'
        ));
        Route::get('/members/{id}/change-password', array(
            'as' => 'admin.members.change_password',
            'uses' => 'MemberController@getChangePassword'
        ));
        Route::post('/members/{id}/change-password', array(
            'as' => 'admin.members.change_password',
            'uses' => 'MemberController@postChangePassword'
        ));
        Route::resource('users', 'AdminUserController');
        Route::resource('groups', 'AdminGroupController');
        Route::resource('slide', 'SlideController');
        Route::resource('bills', 'BillController');
        Route::get('bills/{id}/print', array(
            'as' => 'admin.bills.print',
            'uses' => 'BillController@printBill'
        ));
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
