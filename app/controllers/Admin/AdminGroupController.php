<?php

namespace Admin;

use \AdminGroup;
use View;
use \Response;
use Lang;
use Session;
use \Input;
use \AdminUser;
use \Redirect;

class AdminGroupController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $groups = AdminGroup::paging(Input::all());
        return View::make('admin.groups.index', array(
                'groups' => $groups,
                'input' => Input::all(),
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $users = AdminUser::getLists('last_name');
        return View::make('admin.groups.create', array(
                'users' => $users,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $group = new AdminGroup(Input::all());
        if ($group->save()) {
            $group->attachUsers(Input::get('users', ''));
            Session::flash('success', Lang::get('messages.group_saved_successfully', array('name' => $group->name)));
            return Redirect::route('admin.groups.index');
        } else {
            return Redirect::back()->withErrors($group->errors());
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
        $group = AdminGroup::findOrFail($id);
        $curentUsers = $group->users()->lists('user_id');
        $users = AdminUser::getLists('last_name');
        return View::make('admin.groups.edit', array(
                'group' => $group,
                'users' => $users,
                'curentUsers' => $curentUsers
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $group = AdminGroup::findOrFail($id);
        $group->fill(Input::all());
        if ($group->updateUniques()) {
            $group->attachUsers(Input::get('users', ''));
            Session::flash('success', Lang::get('messages.group_saved_successfully', array('name' => $group->name)));
            return Redirect::route('admin.groups.index');
        } else {
            return Redirect::back()->withErrors($group->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $group = AdminGroup::findOrFail($id);
        $group->users()->detach();
        $group->delete();
        Session::flash('success', Lang::get('messages.group_deleted', array('name' => $group->name)));
        return Redirect::back();
    }
    
    public function getPermission($id) {
        $group = AdminGroup::findOrFail($id);
        $resources = \AdminResource::$resources;
        $currentPers = json_decode($group['permissions']);
        $this->layout->content = View::make('admin.groups.permission', array(
                'group' => $group,
                'resources' => $resources,
                'currentPers' => $currentPers
        ));
    }

    public function postPermission($id) {
        $group = AdminGroup::findOrFail($id);
        $permissions = Input::get('permissions');
        $fullPerStr = implode(',', $permissions);
        $group->savePermission($fullPerStr);
        Session::flash('success', Lang::get('messages.group_permission_saved', array('name' => $group->name)));
        return Redirect::route('admin.groups.index');
    }

}
