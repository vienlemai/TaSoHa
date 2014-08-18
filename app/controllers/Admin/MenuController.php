<?php

namespace Admin;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Auth;
use \Input;
use \Session;
use \Article;
use \Menu;
class MenuController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $menus = \Menu::with('parent')
            ->get();
        $this->layout->content = View::make('admin.menus.index', array(
                'menus' => $menus
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $menus = Menu::lists('name', 'id');
        $this->layout->content = View::make('admin.menus.create', array(
                'menus' => $menus,
        ));
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
