<?php

namespace Frontend;

use \View;
use \Redirect;
use \Session;
use \ArticleCategory;
use \News;
use \Page;

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

    public function page($name) {
        if (Page::checkNameValid($name)) {
            $page = Page::findOrCreateByName($name);
            $this->layout->content = View::make('frontend.home.page')
                ->with(compact('page'));
        } else {
            Session::flash('error', trans('not_found'));
            return Redirect::route('fe.root');
        }
    }

}
