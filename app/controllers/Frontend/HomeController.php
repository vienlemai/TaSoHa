<?php

namespace Frontend;

use \Request;
use \Route;
use \Auth;
use \View;
use \Redirect;
use \Session;
use \Input;
use \Article;
use \ArticleCategory;

class HomeController extends FrontendBaseController {

    /**
     * GET /
     */
    public function index() {
        $articleCategories = ArticleCategory::take(3)->get();
        $this->layout->content = View::make('frontend.home.index')
                ->with(compact('articleCategories'));
    }

    public function search() {
        
    }

}
