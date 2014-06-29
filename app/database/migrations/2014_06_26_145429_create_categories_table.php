<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

    public function up() {
        Schema::create('article_categories', function($t){
            $t->increments('id');
            $t->string('name',255);
            $t->string('slug',255);
            $t->integer('parent_id')->nullable();
            $t->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('categories');
    }

}
