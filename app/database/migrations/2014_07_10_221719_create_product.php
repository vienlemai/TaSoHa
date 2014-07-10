<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration {

    public function up() {
        Schema::create('products', function(Blueprint $t) {
                    $t->increments('id');
                    $t->integer('product_category_id');
                    $t->string('name', 255);
                    $t->string('slug', 255);
                    $t->string('code', 255)->nullable();
                    $t->string('thumbnail', 255);
                    $t->string('primary_photo', 255);
                    $t->text('description')->nullable();
                    $t->boolean('visible')->default(true);
                    $t->timestamps();
                });
        Schema::create('product_categories', function(Blueprint $t) {
                    $t->increments('id');
                    $t->string('name', 255);
                    $t->string('slug', 255);
                    $t->text('description')->nullable();
                    $t->boolean('show_on_menu')->default(false);
                    $t->timestamps();
                });
//        Schema::create('product_photos', function(Blueprint $t) {
//                    $t->increments('id');
//                    $t->integer('product_id');
//                    $t->string('url', 255);
//                    $t->boolean('is_primary')->default(false);
//                });
    }

    public function down() {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
    }

}
