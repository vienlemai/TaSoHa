<?php

App::before(function($request) {
    
});


App::after(function($request, $response) {
    
});

Route::filter('auth', function() {
    if (Auth::guest())
        return Redirect::guest('login');
});


Route::filter('auth.basic', function() {
    return Auth::basic();
});

Route::filter('admin.auth', function() {
    if (!Auth::admin()->check()) {
        Session::put('url.intended', URL::full());
        return Redirect::route('admin.login');
    } else {
        if (Auth::admin()->get()->is_supper) {
            $allowed_routes = AdminResource::allRoutes();
        } else {
            $allowed_routes = AdminGroup::getPermissionsByUser(Auth::admin()->get()->id);
        }
        App::singleton('allowed_routes', function() use ($allowed_routes) {
            return $allowed_routes;
        });
        View::share('allowed_routes', $allowed_routes);
    }
});

Route::filter('admin.permission', function() {
    if (!Auth::admin()->get()->is_supper) {
        $allowed_routes = App::make('allowed_routes');
        if (!in_array(Route::currentRouteName(), $allowed_routes)) {
            return Redirect::route('admin.error', 'permission');
        }
    }
});
Route::filter('member.auth', function() {
    if (!Auth::member()->check()) {
        Session::put('url.intended', URL::full());
        return Redirect::route('fe.root');
    }
});
/*
  |--------------------------------------------------------------------------
  | Guest Filter
  |--------------------------------------------------------------------------
  |
  | The "guest" filter is the counterpart of the authentication filters as
  | it simply checks that the current user is not logged in. A redirect
  | response will be issued if they are, which you may freely change.
  |
 */

Route::filter('guest', function() {
    if (Auth::check())
        return Redirect::to('/');
});

/*
  |--------------------------------------------------------------------------
  | CSRF Protection Filter
  |--------------------------------------------------------------------------
  |
  | The CSRF filter is responsible for protecting your application against
  | cross-site request forgery attacks. If this special token in a user
  | session does not match the one given in this request, we'll bail.
  |
 */

Route::filter('csrf', function() {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
