<?php

namespace Admin;

use \Input;
use \View;
use \Session;
use \Redirect;
use \Member;
use \MyBonus;

class MemberController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $members = Member::paging(\Input::all());
        $this->layout->content = View::make('admin.members.index', array(
                'members' => $members,
                'input' => Input::all(),
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
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
        $bonus = MyBonus::lists('name','id');
        $bonusAmoun();
        foreach ($bonus as $k=>$v) {
            $bonusAmoun[$k] = 
        }
        $this->layout->content = View::make('admin.members.show',  array(
            'member'=>$member
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
