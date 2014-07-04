<?php

namespace Admin;

use \Input;
use \View;
use \Session;
use \Redirect;
use \Member;
use \MyBonus;
use \DB;
class BonusController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($memberId) {
        $member = Member::findOrFail($memberId);
        $bonus = \MyBonus::lists('name', 'id');
        $this->layout->content = View::make('admin.bonus.create', array(
                'member' => $member,
                'bonus' => $bonus,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($memberId) {
        $v = MyBonus::validate(Input::all());
        if ($v->passes()) {
            $member = Member::findOrFail($memberId);
            DB::table('member_bonus')->insert(array(
                'member_id' => $member->id,
                'bonus_id' => Input::get('bonus_id'),
                'amount' => Input::get('amount'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ));
            Session::flash('success', 'Nhập thành công hoa hồng cho thành viên ' . $member->full_name);
            return Redirect::route('admin.members.show', $member->id);
        } else {
            return Redirect::back()->withErrors($v->messages());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
