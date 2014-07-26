<?php

namespace Frontend;

use \Request;
use \Route;
use \View;
use \Redirect;
use \Session;
use \Input;
use \Product;
use \ProductCategory;

class ProductController extends FrontendBaseController {

    public function category($categoryID) {
        $category = ProductCategory::with('products')->findOrFail($categoryID);
        $this->layout->content = View::make('frontend.product.index')
            ->with(compact('category'))
                ->with('products', $category->products);
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        $other_products = Product::where('id', '<>', $id)
            ->where('product_category_id', $product->product_category_id)
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();
        $this->layout->content = View::make('frontend.product.show')
            ->with(compact('product', 'other_products'));
    }

}

?>