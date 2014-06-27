<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCategoriesToArticleCategories extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::dropIfExists('categories');
        Schema::create('article_categories', function($t) {
            $t->increments('id');
            $t->string('name', 255);
            $t->string('slug', 255);
            $t->integer('parent_id')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('article_categories');
    }

}
