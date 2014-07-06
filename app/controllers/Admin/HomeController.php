<?php

namespace Admin;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Auth;
use \Input;
use \Session;

class HomeController extends AdminBaseController {

    public function index() {
        Session::flash('success', 'Chào mừng đến với trang quản trị');
        $this->layout->content = View::make('admin/home/index');
    }

    public function getLogin() {
        return View::make('admin.home.login');
    }

    public function postLogin() {
        $checkLogin = Auth::admin()->attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')), Input::has('remember_me')
        );
        if ($checkLogin) {
            return Redirect::to('/admin');
        } else {
            Session::flash('error', trans('messages.login_fail'));
            return Redirect::back()->withInput();
        }
    }

    public function logout() {
        Auth::admin()->logout();
        return Redirect::route('admin.login');
    }

}
