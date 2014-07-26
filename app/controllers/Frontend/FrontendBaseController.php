<?php

namespace Frontend;

use \View;
use \ProductCategory;

class FrontendBaseController extends \BaseController {
    protected $layout = 'layouts.frontend';

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

?>
