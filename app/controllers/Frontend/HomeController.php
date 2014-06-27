<?php

namespace Frontend;

class HomeController extends \BaseController {

    protected $layout = 'layouts.frontend';

    /**
     * GET /
     */
    public function index() {
        $this->layout->content = \View::make('frontend.home.index');
    }

}
