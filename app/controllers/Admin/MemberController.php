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
        $members = $query->with(array(
                'sunMember.parent.member',
                'binaryMember.parent.member'
            ))
            ->orderBy('created_at', 'desc')
            ->select(array('id', 'full_name', 'created_at'))
            ->paginate();
        $months = \Member::getMonthsLog();
        $month = Input::get('month', \Carbon\Carbon::now()->format('m/Y'));
        $this->layout->content = View::make('admin.members.index', array(
                'members' => $members,
                'input' => Input::all(),
                'month' => $month,
                'months' => $months
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
            $sunParentId = Input::get('sun_parent_id');
            $binayParentId = Input::get('binary_parent_id');
            //var_dump($sunParentId);
            //dd($binayParentId);
            if (!\BinaryMember::validateNumberOfChildren($binayParentId)) {
                Session::flash('error', '<b>Lỗi: </b> Người quản lý này đã có 2 con, vui lòng chọn người khác');
                return Redirect::back()->withInput();
            }
            $member = \Member::create(Input::all());
            $binaryMember = new \BinaryMember(array(
                'member_id' => $member->id,
            ));
            $binaryMember->save();
            $sunMember = new \SunMember(array(
                'member_id' => $member->id,
            ));
            $sunMember->save();
            if (!empty($binayParentId)) {
                $binaryParent = \BinaryMember::find($binayParentId);
                $binaryMember->makeChildOf($binaryParent);
            }

            if (!empty($sunParentId)) {
                $sunParent = \SunMember::find($sunParentId);
                $sunMember->makeChildOf($sunParent);
            }

            Session::flash('success', 'Lưu thành công thành viên ' . $member->full_name);
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
        $member = Member::with('creator')
            ->findOrFail($id);
        $member->updateTeamBonus();
        $months = \Member::getMonthLogByMember($id);
        $month = \Carbon\Carbon::now()->format('m/Y');
        $bonusAmoun = \MyBonus::getBonus($id, $month);
        if (\Request::ajax()) {
            return View::make('admin.members.show_modal', array(
                    'member' => $member,
                    'bonus' => $bonusAmoun,
                    'months' => $months
            ));
        }
        $this->layout->content = View::make('admin.members.show', array(
                'member' => $member,
                'bonus' => $bonusAmoun,
                'months' => $months
        ));
    }

    public function bonus($id) {
        $month = Input::get('month', \Carbon\Carbon::now()->format('m/Y'));
        $member = \Member::find($id);
        $bonusAmount = \MyBonus::getBonus($id, $month);
        $statistic = DB::table('statistics')
            ->where('month', $month)
            ->first();
        $receipt = DB::table('receipts')
            ->where('month', $month)
            ->where('member_id', $id)
            ->first();
        $isPaid = false;
        $isCalculated = false;
        if ($statistic !== null) {
            $isCalculated = true;
        }
        if ($receipt !== null) {
            $isPaid = true;
        }
        $total = DB::table('member_bonus')
            ->where('member_id', $id)
            ->where('month', $month)
            ->sum('amount');
        return View::make('admin.members.partials._bonus', array(
                'member' => $member,
                'bonus' => $bonusAmount,
                'isPaid' => $isPaid,
                'isCalculated' => $isCalculated,
                'month' => $month,
                'receipt' => $receipt,
                'total' => round($total, 1)
        ));
    }

    public function getReceipt($id) {
        $month = Input::get('month');
        $member = \Member::find($id);
        $bonusAmount = \MyBonus::getBonus($id, $month);
        $total = DB::table('member_bonus')
            ->where('member_id', $id)
            ->where('month', $month)
            ->sum('amount');
        $this->layout->content = View::make('admin.members.receipt', array(
                'bonus' => $bonusAmount,
                'total' => $total,
                'month' => $month,
                'member' => $member
        ));
    }

    public function postReceipt($id) {
        $month = Input::get('month');
        $receipt = DB::table('receipts')
            ->where('member_id', $id)
            ->where('month', $month)
            ->first();
        if ($receipt == null) {
            $bonusAmount = \MyBonus::getBonus($id, $month);
            $total = DB::table('member_bonus')
                ->where('member_id', $id)
                ->where('month', $month)
                ->sum('amount');
            $receipt_id = DB::table('receipts')
                ->insertGetId(array(
                'member_id' => $id,
                'month' => $month,
                'content' => json_encode($bonusAmount),
                'total' => $total
            ));
            $result = array(
                'status' => true,
                'receipt_id' => $receipt_id,
                'url_print_receipt' => route('admin.member.print.receipt', array($receipt_id, 'month' => $month)),
                'month' => $month,
                'member_id' => $id
            );
        } else {
            $member = \Member::find($id, array('full_name'));
            $result = array(
                'status' => false,
                'message' => 'Hoa hồng của thành viên ' . $member->full_name . ' trong tháng ' . $month . ' đã được tính',
            );
        }
        return \Response::json($result);
    }

    public function printReceipt($id) {
        $receipt = DB::table('receipts')
            ->where('id', $id)
            ->first();
        $member = \Member::find($receipt->member_id);
        $this->setPrintLayout();
        $this->layout->content = View::make('admin.members.print_receipt', array(
                'member' => $member,
                'receipt' => $receipt
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
        echo 'KHÔNG ĐƯỢC PHÉP XÓA THÀNH VIÊN';
        exit();
        $member = \Member::findOrFail($id);
        $sunMember = \SunMember::with('children')
            ->where('member_id', $id)
            ->first();
        if ($sunMember->isRoot()) {
            foreach ($sunMember->children as $child) {
                $child->makeRoot();
            }
        } else {
            $parent = \SunMember::where('id', $sunMember->parent_id)
                ->first();
            foreach ($sunMember->children as $child) {
                $child->makeChildOf($parent);
            }
        }

        $sunMember->delete();
        $binaryMember = \BinaryMember::with('children')
            ->where('member_id', $id)
            ->first();
        if ($binaryMember->isRoot()) {
            foreach ($binaryMember->children as $child) {
                $child->makeRoot();
            }
        } else {
            $parent = \BinaryMember::where('id', $binaryMember->parent_id)
                ->first();
            foreach ($binaryMember->children as $child) {
                $child->makeChildOf($parent);
            }
        }

        \Bill::where('member_id', $id)
            ->delete();
        DB::table('member_bonus')
            ->where('member_id', $id)
            ->delete();
        DB::table('team_bonus')
            ->where('member_id', $id)
            ->delete();
        DB::table('second_scores')
            ->where('member_id', $id)
            ->delete();
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

    public function getShares($id) {
        $member = Member::findOrFail($id);
        $this->layout->content = View::make('admin.members.shares', array(
                'member' => $member,
        ));
    }

    public function postShares($id) {
        $v = \Member::validateShare(Input::all());
        if ($v->passes()) {
            $member = \Member::findOrFail($id);
            $member->shares += Input::get('shares');
            $member->save();
            Session::flash('success', 'Cập nhật thành công cổ phần cho thành viên <b>' . $member->full_name . '</b>');
            return Redirect::back();
        } else {
            return Redirect::back()->withInput()->withErrors($v->messages());
        }
    }

}
