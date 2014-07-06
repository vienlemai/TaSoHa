<?php

namespace Member;

use Member;
use \Input;
use \Session;
use \Redirect;
use \Auth;
use \MyBonus;
use \DB;
class HomeController extends MemberBaseController {

    /**
     * GET /
     */
    public function index() {
        $member = Auth::member()->get();
        $root = Member::findOrFail($member->id);
        $html = $root->renderDescendents();
        $bonus = MyBonus::lists('name', 'id');
        $bonusAmoun = array();
        foreach ($bonus as $k => $v) {
            $bonusAmoun[$k]['name'] = $v;
            $bonusAmoun[$k]['amount'] = DB::table('member_bonus')->where('member_id', $member->id)->where('bonus_id', $k)->sum('amount');
        }
        $this->layout->content = \View::make('member.home.index', array(
                'treeData' => $html,
                'bonus' => $bonusAmoun
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
