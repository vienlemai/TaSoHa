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

class MemberController extends \BaseController {

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
    public function create($parentId) {
        $root = Member::findOrFail($parentId);
        $nodeToAdd = $root->findNodeToAdd();
        $newMember = new Member(array(
            'email' => Input::get('full_name') . '@gmail.com',
            'password' => Hash::make('123456'),
            'username' => StringHelper::slug(Input::get('full_name')),
            'sex' => false,
            'day_of_birth' => '',
            'full_name' => Input::get('full_name'),
            'is_left' => $nodeToAdd['position'] == 'left' ? true : false,
            'is_right' => $nodeToAdd['position'] == 'right' ? true : false,
        ));
        $newMember->save();
        $newMember->makeChildOf($nodeToAdd['node']);
        //Session::flash('success', 'Thêm thành công thành viên ' . $newMember->full_name);
        return Redirect::back();
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
