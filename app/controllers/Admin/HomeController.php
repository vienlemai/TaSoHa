<?php

namespace Admin;

use \View;
use \Input;
use \Redirect;
use \Session;
use \Auth;

class HomeController extends AdminBaseController {

    /**
     * GET /
     */
    public function index() {

        if (!Auth::admin()->check()) { // Not logged in
            return View::make('admin/home/login');
        } else {
            $this->layout->content = View::make('admin/home/index');
        }
    }

    public function getLogin() {
        return View::make('admin.home.login');
    }

    public function postLogin() {
        $checkLogin = Auth::admin()->attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')), Input::has('remember_me'));
        if ($checkLogin) {
            return Redirect::intended('/admin');
        } else {
            Session::flash('error', trans('auth.login_failed'));
            return Redirect::back()->withInput();
        }
    }

    public function logout() {
        Auth::admin()->logout();
        return Redirect::route('admin.login');
    }

    public function error($type) {
        return View::make('admin.home.error', array(
                'type' => $type
        ));
    }

}
