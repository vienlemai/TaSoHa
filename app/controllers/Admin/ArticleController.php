<?php

namespace Admin;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Session;
use \Input;
use \Article;
use \ArticleCategory;

class ArticleController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $articles = Article::paging(Input::all());
        return View::make('admin.article.index', array(
                    'articles' => $articles
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $categories = ArticleCategory::listCategories();
        return View::make('admin.article.create', array(
                    'categories' => $categories,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $article = new Article(Input::all());
        if ($article->save()) {
            Session::flash('success', trans('messages.article_save_success', array('name' => $article->title)));
            return Redirect::route('admin.articles.index');
        } else {
            return Redirect::back()->withInput()->withErrors($article->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $categories = ArticleCategory::listCategories();
        $article = Article::find($id);
        return View::make('admin.article.edit', array(
                    'article' => $article,
                    'categories' => $categories
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $article = Article::findOrFail($id);
        $article->update(Input::all());
        Session::flash('success', trans('messages.article_save_success', array('name' => $article->title)));
        return Redirect::route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
