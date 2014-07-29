<?php

class UpdateController extends BaseController {

    public static function up() {
        ProductCategory::seed();
        return Redirect::route('fe.root');
    }

}

?>