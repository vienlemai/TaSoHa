<?php

namespace Admin;

use \Input;
use \Redirect;
use \Session;
use \View;
use \AdminUser;
use \Lang;
class AdminUserController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $users = \AdminUser::paging(\Input::all());
        $this->layout->content = \View::make('admin.users.index', array(
                'users' => $users,
                'input' => \Input::all(),
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $this->layout->content = \View::make('admin.users.create', array(
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user = new \AdminUser(\Input::all());
        if ($user->save()) {
            
        } else {
            return Redirect::back()->withErrors($user->errors());
        }
        \Session::flash('success', \Lang::get('messages.user_saved_successfully', array('name' => $user->full_name)));
        return \Redirect::route('admin.users.index');
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
        $user = \AdminUser::findOrFail($id);
        return \View::make('admin.users.edit', array(
                'user' => $user,
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
        $user->fill(\Input::all());
        if ($user->updateUniques()) {
            \Session::flash('success', \Lang::get('messages.user_saved_successfully', array('name' => $user->full_name)));
            return \Redirect::route('admin.users.index');
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
        $user = AdminUser::findOrFail($id);
        $user->delete();
        Session::flash('success', Lang::get('messages.user_deleted_successfully', array('name' => $user->full_name)));
        return Redirect::route('admin.users.index');
    }

}
