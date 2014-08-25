<?php

namespace Member;

use \Input;
use \Session;
use \View;
use \Lang;
use \Member;
use \Hash;
use \Redirect;
use \StringHelper;
use \MyBonus;
use \DB;
use \Response;
use \Auth;

class MemberController extends MemberBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($type = 'binary') {
        $this->layout->content = View::make('member.home.index', array(
                'type' => $type,
        ));
    }

    public function tree($type = 'binary') {
        $this->layout->content = View::make('member.member.tree', array(
                'type' => $type,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $this->layout->content = View::make('member.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $v = Member::validate(Input::all());
        if ($v->passes()) {
            $parentId = Input::get('parent_id');
            $parent = Member::findOrFail($parentId);
            $member = new Member(Input::all());
            $member->save();
            $member->makeChildOf($parent);
            $result['success'] = true;
        } else {
            $result['success'] = false;
            \Former::withErrors($v->messages());
            $result['html'] = View::make('member.partials._form_add_member')->render();
        }
        return \Response::json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $member = Member::with('creator', 'parent')
            ->findOrFail($id);
        $bonus = MyBonus::lists('name', 'id');
        $bonusAmoun = array();
        foreach ($bonus as $k => $v) {
            $bonusAmoun[$k]['name'] = $v;
            $bonusAmoun[$k]['amount'] = DB::table('member_bonus')
                ->where('member_id', $member->id)
                ->where('bonus_id', $k)
                ->sum('amount');
        }
        if (\Request::ajax()) {
            return View::make('admin.members.show_modal', array(
                    'member' => $member,
                    'bonus' => $bonusAmoun,
            ));
        }
        $this->layout->content = View::make('admin.members.show', array(
                'member' => $member,
                'bonus' => $bonusAmoun,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    public function getChangePassword() {
        $this->layout->content = View::make('member.member.change_password');
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
            $result['html'] = View::make('member.member._form_change_password')->render();
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
            $result['html'] = View::make('member.member._form_personal_info')->render();
        }
        return Response::json($result);
    }

    public function profile() {
        $this->layout->content = View::make('member.member.profile');
    }

}
