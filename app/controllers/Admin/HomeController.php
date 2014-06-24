<?php

namespace Admin;

class HomeController extends AdminBaseController {

    /**
     * GET /
     */
    public function index() {
        if (false) { // Not logged in
            return \View::make('shared/login');
        } else {
            \Session::flash('success', 'Look! I\'m a flash message :)');
            $this->layout->content = \View::make('admin/home/index');
        }
    }

}