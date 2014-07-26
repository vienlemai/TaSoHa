<?php

namespace Admin;

use \Input;
use \View;
use \Session;
use \Redirect;
use \Member;
use \MyBonus;
use \DB;
use \Hash;

class MemberController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $query = \Member::buildQuery(Input::all());
        $members = $query->with('parent', 'introducer')->paginate();
        $this->layout->content = View::make('admin.members.index', array(
                'members' => $members,
                'input' => Input::all(),
        ));
    }

    public function tree($type = 'binary') {
        $this->layout->content = View::make('admin.members.tree', array(
                'type' => $type,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $members = \Member::get()->lists('name_uid', 'id');
        $this->layout->content = View::make('admin.members.create', array(
                'members' => $members
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $v = Member::validate(Input::all());
        if ($v->passes()) {
            $member = new Member(Input::all());
            $member->save();
//            $viewData = array(
//                'member' => $member,
//                'password' => $password,
//            );
//            \Mail::send('admin.members.mail', $viewData, function($message)use($member) {
//                $message->to($member->email, 'TASOHA GROUP')->subject('Thông báo về tài khoản tại tasoha.com');
//            });
            Session::flash('success', 'Lưu thành công thành viên' . $member->full_name);
            return Redirect::route('admin.members.index');
        } else {
            return Redirect::back()->withInput()->withErrors($v->messages());
        }
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
            $bonusStatus = DB::table('bonus_status')
                ->where('member_id', $member->id)
                ->where('bonus_type', $k)
                ->first();
            if ($bonusStatus !== null) {
                
            }
//            $bonusAmoun[$k]['amount'] = DB::table('member_bonus')
//                ->where('member_id', $member->id)
//                ->where('bonus_id', $k)
//                ->sum('amount');
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
        $members = \Member::get()->lists('name_uid', 'id');
        $member = \Member::findOrFail($id);
        $this->layout->content = View::make('admin.members.edit', array(
                'members' => $members,
                'member' => $member
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $member = \Member::findOrFail($id);
        $v = Member::validate(Input::all(), $id);
        if ($v->passes()) {
            $member->fill(Input::all());
            $member->save();
            Session::flash('success', 'Chỉnh sửa thành công thành viên <b>' . $member->full_name . '</b>');
            return Redirect::route('admin.members.index');
        } else {
            return Redirect::back()->withInput()->withErrors($v->messages());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $member = \Member::findOrFail($id);
        $member->delete();
        Session::flash('success', 'Xóa thành công thành viên <b>' . $member->full_name . '</b>');
        return Redirect::route('admin.members.index');
    }

    public function getChangePassword($id) {
        $member = Member::findOrFail($id);
        $this->layout->content = View::make('admin.members.change_password', array(
                'member' => $member,
        ));
    }

    public function postChangePassword($id) {
        $member = Member::findOrFail($id);
        $v = Member::validateChangePassword(Input::all(), $id);
        if ($v->passes()) {
            $member->password = Hash::make(Input::get('password'));
            $member->save();
            Session::flash('success', 'Đổi mật khẩu thành công cho thành viên <b>' . $member->full_name . '</b>');
            return Redirect::route('admin.members.show', $member->id);
        } else {
            return Redirect::back()->withErrors($v->messages());
        }
    }

}
