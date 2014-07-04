<?php

namespace Frontend;

class HomeController extends FrontendBaseController {
    
    /**
     * GET /
     */
    public function index() {
        $this->layout->content = \View::make('frontend.home.index');
    }

    public function index2() {
        $this->layout =  \View::make('layouts.test');
        $this->layout->content = \View::make('frontend.home.index');
    }

}
