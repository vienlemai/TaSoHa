<?php

namespace Admin;

class AdminBaseController extends \BaseController {
    protected $layout = 'layouts.admin';

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => array('store', 'update', 'delete', 'put')));
    }

}
