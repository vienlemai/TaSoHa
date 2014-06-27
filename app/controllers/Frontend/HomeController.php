<?php

namespace Frontend;

class HomeController extends FrontendBaseController {

    /**
     * GET /
     */
    public function index() {
        $this->layout->content = \View::make('frontend.home.index');
    }

}
