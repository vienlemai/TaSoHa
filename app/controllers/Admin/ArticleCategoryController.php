<?php

namespace Admin;

class ArticleCategoryController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $categories = \ArticleCategory::paging(\Input::all());
        return \View::make('admin.article_categories.index', array(
                'categories' => $categories,
                'keyword' => \Input::has('keyword') ? \Input::get('keyword') : '',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $categories = \ArticleCategory::parentCategoryList();
        return \View::make('admin.article_categories.create', array('categories' => $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $category = new \ArticleCategory(\Input::all());
        $category->save();
        \Session::flash('success', trans('messages.category_save_success', array('name' => $category->name)));
        return \Redirect::route('admin.article_categories.index');
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
        $categories = \ArticleCategory::parentCategoryList($id);
        $category = \ArticleCategory::findOrFail($id);
        return \View::make('admin.article_categories.edit', array(
                'category' => $category,
                'categories' => $categories,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $category = \ArticleCategory::findOrFail($id);
        $category->update(\Input::all());
        \Session::flash('success', \Lang::get('messages.category_save_success', array('name' => $category->name)));
        return \Redirect::route('admin.article_categories.index');
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
