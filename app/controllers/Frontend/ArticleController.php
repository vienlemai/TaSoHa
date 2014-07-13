<?php

namespace Frontend;

use \Request;
use \Route;
use \Auth;
use \View;
use \Redirect;
use \Session;
use \Input;
use \ArticleCategory;
use \Article;

class ArticleController extends FrontendBaseController {

    /**
     * GET /category/
     */
    public function category($categoryId) {
        $category = ArticleCategory::findOrFail($categoryId);
        $articles = Article::where('category_id', $category->id)->paginate(10);
        $this->layout->content = View::make('frontend.article.index')
                ->with(compact('category', 'articles'));
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        $category = ArticleCategory::find($article->category_id);
        $otherArticles = Article::where('category_id', $category->id)
                ->where('id', '<>', $article->id)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $this->layout->content = View::make('frontend.article.show')
                ->with(compact('article', 'category', 'otherArticles'));
    }

}