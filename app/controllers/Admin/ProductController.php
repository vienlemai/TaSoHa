<?php

namespace Admin;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Session;
use \Input;
use \Product;
use \ProductCategory;

class ProductController extends AdminBaseController {

    public function index() {
        $products = Product::paging(Input::all());
        $this->layout->content = View::make('admin.product.index', array(
                'products' => $products
        ));
    }

    public function create() {
        $categories = ProductCategory::lists('name', 'id');
        $this->layout->content = View::make('admin.product.create')
            ->with(compact('categories'));
    }

    public function store() {
        $product = new Product(Input::all());
        if ($product->save()) {
            Session::flash('success', trans('messages.product_save_success', array('name' => $product->name)));
            return Redirect::route('admin.product.index');
        } else {
            dd($product->errors());
            return Redirect::route('admin.product.create')->withInput()->withErrors($product->errors());
        }
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::lists('name', 'id');
        $this->layout->content = View::make('admin.product.edit')
            ->with(compact('categories', 'product'));
    }

    public function update($id) {
        $product = Product::findOrFail($id);
        $product->fill(Input::all());
        if ($product->save()) {
            Session::flash('success', trans('messages.product_save_success', array('name' => $product->name)));
            return Redirect::route('admin.product.index');
        } else {
            dd($product->errors());
            return Redirect::route('admin.product.create')->withInput()->withErrors($product->errors());
        }
    }

    public function destroy() {
        
    }

}

?>
