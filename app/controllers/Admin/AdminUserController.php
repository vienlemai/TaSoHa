<?php

namespace Admin;

use \AdminGroup;
use \View;
use \Response;
use \Lang;
use \Session;
use \Input;
use \AdminUser;
use \Redirect;
use \Auth;
use \App;
use \Hash;

class AdminUserController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $users = AdminUser::paging(Input::all());
        return View::make('admin.users.index', array(
                'users' => $users,
                'input' => Input::all(),
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $groups = AdminGroup::lists('name', 'id');
        return View::make('admin.users.create', array(
                'groups' => $groups
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user = new AdminUser(Input::all());
        if ($user->save()) {
            $user->attachGroup(Input::get('groups', ''));
            Session::flash('success', Lang::get('messages.user_saved_successfully', array('name' => $user->getFullName())));
            return Redirect::route('admin.users.index');
        } else {
            return Redirect::back()->withErrors($user->errors());
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
        $groups = AdminGroup::lists('name', 'id');
        $user = AdminUser::findOrFail($id);
        $curentGroup = $user->groups()->lists('group_id');
        return View::make('admin.users.edit', array(
                'user' => $user,
                'groups' => $groups,
                'curentGroup' => $curentGroup
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user = AdminUser::findOrFail($id);
        $user->fill(Input::all());
        if ($user->updateUniques(AdminUser::$updateRules)) {
            $user->attachGroup(Input::get('groups', ''));
            Session::flash('success', Lang::get('messages.user_saved_successfully', array('name' => $user->getFullName())));
            return Redirect::route('admin.users.index');
        } else {
            return Redirect::back()->withErrors($user->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $user = \AdminUser::findOrFail($id);
        $user->groups()->detach();
        $user->delete();
        Session::flash('success', Lang::get('messages.user_deleted', array('name' => $user->getFullName())));
        return Redirect::back();
    }

    /**
     * Show the form to edit profile
     * @return Response
     */
    public function profile() {
        $user = Auth::admin()->get();
        $resources = \AdminResource::$resources;
        $allowedRoutes = App::make('allowed_routes');
        $this->layout->content = View::make('admin.users.profile', array(
                'user' => $user,
                'resources' => $resources,
                'allowedRoutes' => $allowedRoutes,
        ));
    }

    /**
     * Update profile
     * @return Response
     */
    public function postProfile() {
        $user = Auth::admin()->get();
        $user->fill(Input::all());
        if ($user->updateUniques(AdminUser::$profileRules)) {
            Session::flash('success', Lang::get('messages.profile_saved'));
            return Redirect::back();
        }
        return Redirect::back()->withErrors($user->errors());
    }

    /**
     * Show the form to change password
     * @return Response
     */
    public function password() {
        $this->layout->content = View::make('admin.users.password');
    }

    public function postPassword() {
        $user = Auth::admin()->get();
        if (!Hash::check(Input::get('old_password'), $user->password)) {
            Session::flash('error', Lang::get('messages.old_password_not_match'));
            return Redirect::back();
        }
        $user->fill(Input::all());
        if ($user->save(AdminUser::$passwordRules)) {
            Session::flash('success', Lang::get('messages.password_updated'));
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($user->errors());
        }
    }

}
