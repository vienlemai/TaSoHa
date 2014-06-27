<?php

namespace Frontend;

class HomeController extends \BaseController {

    /**
     * GET /
     */
    public function index() {
        echo \App::environment();
    }

}
