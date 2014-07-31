<?php

namespace Member;

use \View;
use \ProductCategory;

class MemberBaseController extends \BaseController {

    protected $layout = 'layouts.member';

    public function __construct() {
        $this->beforeFilter(function() {
            View::share(
                'product_categories', ProductCategory::showOnMenu()->get()
            );
            View::share(
                'other_product_categories', ProductCategory::hideOnMenu()->get()
            );
        });
    }

}
