<?php

namespace Frontend;

use \View;
use \Redirect;
use \Session;
use \ArticleCategory;
use \News;
use \Page;

class HomeController extends FrontendBaseController {

    public function landing() {
        return View::make('frontend.home.landing');
    }

    /**
     * GET /
     */
    public function index() {
        $articleCategories = ArticleCategory::take(3)->get();
        $recentNews = News::recent();
        $slides = \SlideImage::orderBy('created_at')->get();
        $this->layout->content = View::make('frontend.home.index')
            ->with(compact('articleCategories', 'recentNews', 'slides'));
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
