<?php

namespace Admin;

use \Share;
use View;
use \Response;
use Lang;
use Session;
use \Input;
use \AdminUser;
use \Redirect;

class ShareController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $shares = Share::with('member')
            ->orderBy('created_at', 'ASC')
            ->paginate(100);
        $this->layout->content = View::make('admin.share.index', array(
                'shares' => $shares
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $members = \Member::get()->lists('name_uid', 'id');
        $this->layout->content = View::make('admin.share.create', array(
                'members' => $members,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $share = new Share(Input::all());
        $share->price = \Common::stringToInt($share->price);
        $share->score = \Common::stringToInt($share->score);
        if ($share->save()) {
            return Redirect::route('admin.share.index');
        } else {
            return Redirect::back()->withInput()->withErrors($share->errors());
        }
    }

    public function getLevel() {
        $shares = Share::getByLevel();
        $this->layout->content = View::make('admin.share.level', array(
                'shares' => $shares
        ));
    }

    public function postLevel() {
        $memberId = Input::get('member_id', null);
        $level = Input::get('level', 0);
        if ($memberId && in_array($level, array(1,2, 3, 4))) {
            \DB::table('shares')
                ->where('member_id', $memberId)
                ->where('level', $level - 1)
                ->update(array(
                    'level' => $level
            ));
            $memberName = \Member::find($memberId, array('full_name'));
            \Session::flash('success', 'Thành viên <b>' . $memberName->full_name . '</b> đã được lên cấp <b>' . $level . '</b>');
        } else {
            \Session::flash('error', 'Thao tác không hợp lệ');
        }
        return \Redirect::back();
    }

}
