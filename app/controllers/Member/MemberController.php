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

class MemberController extends MemberBaseController {

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
            $result['status'] = true;
            $result['redirect'] = route('member.root');
        } else {
            $result['status'] = false;
            $errors = $v->messages()->all('<li>:message</li>');
            $result['errors'] = $errors;
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
        $member = Member::with('creator', 'children')->findOrFail($id);
        $bonus = \MyBonus::getBonus($member->id);
        return View::make('member.member.show', array(
                'member' => $member,
                'bonus' => $bonus,
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
