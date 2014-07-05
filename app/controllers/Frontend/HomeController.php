<?php

namespace Frontend;

use \Auth;

class HomeController extends FrontendBaseController {

    /**
     * GET /
     */
    public function index() {
        $this->layout->content = \View::make('frontend.home.index');
    }

}
