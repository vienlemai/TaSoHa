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

    public function tree() {
        $type = Input::get('type', 'sun');
        $this->layout->contetn = View::make('member.member.tree', array(
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
            $result['success'] = true;
            $result['message'] = 'Mật khẩu của bạn đã được đổi thành công';
            $result['redirect'] = route('member.profile');
        } else {
            $result['success'] = false;
            \Former::withErrors($v->messages());
            $result['html'] = View::make('member.member._form_change_password')->render();
        }
        return Response::json($result);
    }

    public function getUpdateProfile() {
        $this->layout->content = View::make('member.member.update_profile');
    }

    public function postUpdateProfile() {
        $member = Auth::member()->get();
        $v = Member::validateUpdateSelfProfile(Input::all(), $member->id);
        $result = array();
        if ($v->passes()) {
            $member->fill(Input::all());
            $member->save();
            $result['success'] = true;
            $result['message'] = 'Thông tin cá nhân của bạn đã được cập nhật thành công.';
            $result['redirect'] = route('member.profile');
        } else {
            \Former::withErrors($v->messages());
            $result['success'] = false;
            $result['html'] = View::make('member.member.partials._form_personal_info')->render();
        }
        return Response::json($result);
    }

    public function profile() {
        $memberId = Auth::member()->get()->id;
        $member = Member::with(array(
                'sunMember.parent.member',
                'binaryMember.parent.member'
            ))
            ->find($memberId);
        $this->layout->content = View::make('member.member.profile', array(
                'member' => $member
        ));
    }

    public function bonus() {
        //dd(Input::all());
        $month = Input::get('month', \Carbon\Carbon::now()->format('m/Y'));
        $memberId = Auth::member()->get()->id;
        $member = \Member::find($memberId);
        $bonusAmount = \MyBonus::getBonus($memberId, $month);
        $statistic = DB::table('statistics')
            ->where('month', $month)
            ->first();
        $receipt = DB::table('receipts')
            ->where('month', $month)
            ->where('member_id', $memberId)
            ->first();
        $isPaid = false;
        $isCalculated = false;
        if ($statistic !== null) {
            $isCalculated = true;
        }
        if ($receipt !== null) {
            $isPaid = true;
        }
        //$months = \Member::getMonthLogByMember($id);
        $months = \Member::getMonthsLog();
        $total = DB::table('member_bonus')
            ->where('member_id', $memberId)
            ->where('month', $month)
            ->sum('amount');
        $viewData = array(
            'member' => $member,
            'bonus' => $bonusAmount,
            'isPaid' => $isPaid,
            'isCalculated' => $isCalculated,
            'month' => $month,
            'receipt' => $receipt,
            'total' => round($total, 1),
            'months' => $months
        );
        if (\Request::ajax()) {
            return View::make('member.member.partials._bonus', $viewData);
        } else {
            $this->layout->content = View::make('member.member.bonus', $viewData);
        }
    }

    public function bills() {
        $month = Input::get('month', \Carbon\Carbon::now()->format('m/Y'));
        $memberId = Auth::member()->get()->id;
        $bills = \Bill::where('member_id', $memberId)
                ->whereBetween('created_at', array(
                    \Carbon\Carbon::createFromFormat('m/Y', $month)->startOfMonth(),
                    \Carbon\Carbon::createFromFormat('m/Y', $month)->endOfMonth(),
                ))->get();
        //$months = \Member::getMonthLogByMember($id);
        $months = \Member::getMonthsLog();
        $member = \Member::find($memberId);
        $viewData = array(
            'member' => $member,
            'bills' => $bills,
            'months' => $months,
            'month' => $month,
        );
        if (\Request::ajax()) {
            return View::make('member.member.partials._bills', $viewData);
        } else {
            $this->layout->content = View::make('member.member.bills', $viewData);
        }
    }

}
