<?php

namespace Frontend;

use \Request;
use \Route;
use \Auth;
use \View;
use \Redirect;
use \Article;
use \ArticleCategory;
use \News;

class HomeController extends FrontendBaseController {

    /**
     * GET /
     */
    public function index() {
        $articleCategories = ArticleCategory::take(3)->get();
        $recentNews = News::recent();
        $this->layout->content = View::make('frontend.home.index')
                ->with(compact('articleCategories', 'recentNews'));
    }

    public function search() {
        
    }

}
