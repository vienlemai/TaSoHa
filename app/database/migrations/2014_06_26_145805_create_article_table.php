<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

    public function up() {
        Schema::create('articles', function($t) {
            $t->increments('id');
            $t->integer('category_id');
            $t->string('title', 255);
            $t->text('content');
            $t->string('thumbnail', 255)->nullable();
            $t->integer('created_by');
            $t->boolean('is_active');
            $t->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('articles');
    }

}
