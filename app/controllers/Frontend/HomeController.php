<?php

namespace Frontend;

use \Auth;
use \View;

class HomeController extends FrontendBaseController {

    /**
     * GET /
     */
    public function index() {
        $this->layout->content = View::make('frontend.home.index');
    }

    public function search() {
        
    }

}
