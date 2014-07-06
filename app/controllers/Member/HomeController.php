<?php

namespace Member;

use Member;
use \Input;
use \Session;
use \Redirect;
use \Auth;

class HomeController extends MemberBaseController {

    /**
     * GET /
     */
    public function index() {
        $root = Member::roots()->first();
        $html = $root->renderDescendents();
        $this->layout->content = \View::make('member.home.index', array(
                'treeData' => $html,
        ));
    }

    public function postLogin() {
        $checkLogin = \Auth::member()->attempt(array(
            'username' => Input::get('username'),
            'password' => Input::get('password')), Input::has('remember_me')
        );
        if ($checkLogin) {
            return Redirect::to('/member');
        } else {
            Session::flash('error', trans('messages.login_fail'));
            return Redirect::back()->withInput();
        }
    }

    public function getLogout() {
        Auth::member()->logout();
        return Redirect::route('fe.root');
    }

}
