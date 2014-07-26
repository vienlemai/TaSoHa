<?php

namespace Admin;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Session;
use \Input;
use \ProductCategory;

class ProductCategoryController extends AdminBaseController {

    public function index() {
        $categories = ProductCategory::all();
        $this->layout->content = View::make('admin.product_category.index')
            ->with('categories', $categories);
    }

    public function create() {
        $this->layout->content = View::make('admin.product_category.create');
    }

    public function store() {
        $category = new ProductCategory(Input::all());
        if ($category->save()) {
            Session::flash('success', trans('messages.category_save_success', array('name' => $category->name)));
            return Redirect::route('admin.product_category.index');
        } else {
            return Redirect::back()->withInput()->withErrors($category->errors());
        }
    }

    public function edit($id) {
        $category = ProductCategory::findOrFail($id);
        $this->layout->content = View::make('admin.product_category.edit')
            ->with('category', $category);
    }

    public function update($id) {
        $category = ProductCategory::findOrFail($id);
        if ($category->update(Input::all())) {
            Session::flash('success', trans('messages.category_save_success', array('name' => $category->name)));
            return Redirect::route('admin.product_category.index');
        } else {
            return Redirect::back()->withInput()->withErrors($category->errors());
        }
    }

    public function destroy($id) {
        $category = ProductCategory::findOrFail($id);
        if ($category->products->count() > 0) {
            Session::flash('error', trans('messages.product_category_delete_failed_cause_inused'));
        } else {
            $category->delete();
            Session::flash('success', trans('messages.product_category_delete_success', array('name' => $category->name)));
        }
        return Redirect::route('admin.article_categories.index');
    }

}

?>
