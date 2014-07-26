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
        $categories = ProductCategory::all();
        $this->layout->content = View::make('admin.product.create')
            ->with(compact('categories'));
    }

    public function store() {
        $product = new Product(Input::all());
        if ($product->save()) {
            Session::flash('success', trans('messages.product_save_success', array('name' => $product->name)));
            return Redirect::route('admin.product.index');
        } else {
            return Redirect::route('admin.product.create')->withInput()->withErrors($product->errors());
        }
    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }

}

?>
