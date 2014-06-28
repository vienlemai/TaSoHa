<?php

namespace Admin;

class HomeController extends AdminBaseController {

    /**
     * GET /
     */
    public function index() {

        if (false) { // Not logged in
            return \View::make('shared/login');
        } else {
            \Session::flash('success', 'Chào mừng đến với trang quản trị');
            $this->layout->content = \View::make('admin/home/index');
        }
    }

    public function getLogin() {
        return \View::make('admin.home.login');
    }

    public function postLogin() {
        $remember = \Input::has('remember_me') ? true : false;
        $checkLogin = \Auth::attempt(array('email' => \Input::get('email'), 'password' => \Input::get('password')), $remember);
        if ($checkLogin) {
            return \Redirect::intended('/admin');
        } else {
            \Session::flash('error', \Lang::get('login_fail'));
            return \Redirect::back()->withInput();
        }
    }

    public function logout() {
        \Auth::logout();
        return \Redirect::route('admin.login');
    }

}
