<?php

namespace Member;

use Member;
use \Input;
use \View;
use \Session;
use \Redirect;
use \Auth;
use \MyBonus;
use \Response;

class HomeController extends MemberBaseController {

    /**
     * GET /
     */
    public function index() {
        $type = Input::get('type', 'binary');
        $member = Auth::member()->get();
        $root = Member::findOrFail($member->id);
        $html = $root->renderDescendents();
        $bonus = \MyBonus::getBonus($member->id);
        $this->layout->content = View::make('member.home.index', array(
                'treeData' => $html,
                'bonus' => $bonus,
                'type' => $type,
        ));
    }

    public function filterBonus() {
        $res = array();
        $bonus = MyBonus::getBonus(Auth::member()->get()->id);
        $res['success'] = true;
        $res['html'] = View::make('member.partials._bonus_list')
                ->with('bonus', $bonus)->render();
        return Response::json($res);
    }

    public function postLogin() {
        $checkLogin = Auth::member()->attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')), Input::has('remember_me')
        );
        $res = array();
        if ($checkLogin) {
            $res['success'] = true;
        } else {
            $res['success'] = false;
            $res['message'] = trans('messages.login_fail');
        }
        return Response::json($res);
    }

    public function getLogout() {
        Auth::member()->logout();
        return Redirect::route('fe.root');
    }

    public function changePassword() {
        $v = \Member::validateChangePassword(Input::all());
        if ($v->passes()) {
            $member = Auth::member()->get();
            $member->update(Input::all());
            $member->save();
            Session::flash('success', 'Đổi mật khẩu thành công');
            $result['success'] = true;
            $result['message'] = 'Đổi mật khẩu thành công';
        } else {
            $result['success'] = false;
            \Former::withErrors($v->messages());
            $result['html'] = View::make('member.home._form_change_password')->render();
        }
        return Response::json($result);
    }

    public function updateProfile() {
        $member = Auth::member()->get();
        $v = Member::validateUpdateSelfProfile(Input::all(), $member->id);
        $result = array();
        if ($v->passes()) {
            $member->fill(Input::all());
            $member->save();
            $result['success'] = true;
            $result['message'] = 'Cập nhật thông tin cá nhân thành công.';
        } else {
            \Former::withErrors($v->messages());
            $result['success'] = false;
            $result['html'] = View::make('member.home._form_personal_info')->render();
        }
        return Response::json($result);
    }

    public function profile() {
        $this->layout->content = View::make('member.home.profile');
    }

}
