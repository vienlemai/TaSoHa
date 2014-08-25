<?php

namespace Member;

use \View;
use \ProductCategory;

class MemberBaseController extends \BaseController {
    protected $layout = 'layouts.member';

    public function __construct() {
        $this->beforeFilter(function() {
            $catIntro = \ArticleCategory::where('id', \ArticleCategory::$CAT_INTRO)->remember(60)->first(array('id', 'name', 'slug'));
            $articleIntro = \Article::where('category_id', $catIntro->id)
                ->where('is_active', true)
                ->get(array('id', 'category_id', 'title', 'slug'));
            $catNews = \ArticleCategory::whereIn('id', \ArticleCategory::$CAT_NEWS)->remember(60)->get(array('id', 'name', 'slug'));
            $catRecruitments = \ArticleCategory::whereIn('id', \ArticleCategory::$CAT_RECRUITMENTS)->remember(60)->get(array('id', 'name', 'slug'));
            $bottomCategories = \ArticleCategory::where('is_bottom', true)->remember(60)->get();
            View::share('cat_intro', $catIntro);
            View::share('article_intro', $articleIntro);
            View::share('cat_news', $catNews);
            View::share('cat_recruitments', $catRecruitments);
            View::share('bottom_categories', $bottomCategories);
        });
    }

}
