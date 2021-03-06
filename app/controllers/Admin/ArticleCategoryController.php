<?php

namespace Admin;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Auth;
use \Input;
use \Session;
use \Article;
use \ArticleCategory;

class ArticleCategoryController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $categories = ArticleCategory::all();
        $this->layout->content = View::make('admin.article_categories.index', array(
                'categories' => $categories
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $this->layout->content = View::make('admin.article_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $category = new ArticleCategory(Input::all());
        $category->photo = Input::get('thumbnail');
        if ($category->save()) {
            Session::flash('success', trans('messages.category_save_success', array('name' => $category->name)));
            return Redirect::route('admin.article_categories.index');
        } else {
            return Redirect::back()->withInput()->withErrors($category->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $category = ArticleCategory::findOrFail($id);
        $this->layout->content = View::make('admin.article_categories.edit', array(
                'category' => $category
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //dd(Input::all());
        $category = ArticleCategory::findOrFail($id);
        $category->photo = Input::get('thumbnail');
        if ($category->update(Input::all())) {
            Session::flash('success', trans('messages.category_save_success', array('name' => $category->name)));
            return Redirect::route('admin.article_categories.index');
        } else {
            return Redirect::back()->withInput()->withErrors($category->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $category = ArticleCategory::findOrFail($id);
        if ($category->articles->count() > 0) {
            Session::flash('error', trans('messages.article_category_delete_failed_cause_inused'));
        } elseif (!$category->removalable) {
            Session::flash('error', trans('messages.article_category_delete_failed_cause_not_removalable'));
        } else {
            $category->delete();
            Session::flash('success', trans('messages.article_category_delete_success', array('name' => $category->name)));
        }
        return Redirect::route('admin.article_categories.index');
    }

}
