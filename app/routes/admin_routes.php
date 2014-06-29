<?php

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin'), function() {
    Route::group(array('before' => 'admin.auth'), function() {
        Route::get('/', array('as' => 'admin.root', 'uses' => 'HomeController@index'));
        Route::get('/logout', array(
            'as' => 'admin.logout',
            'uses' => 'HomeController@logout',
        ));

        Route::get('list-routes', function() {
            $routeCollection = \Route::getRoutes();

            foreach ($routeCollection as $value) {
                var_dump($value->getName());
            }
            exit();
        });

        Route::get('paths', function() {
            $destinationPath = app_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
            var_dump($destinationPath);
        });
        Route::resource('articles', 'ArticleController');
        Route::resource('article_categories', 'ArticleCategoryController');
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

