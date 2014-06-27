<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('articles', function($t) {
            $t->increments('id');
            $t->integer('categor_id');
            $t->string('title', 255);
            $t->text('content');
            $t->string('thumbnail', 255)->nullable();
            $t->integer('created_by');
            $t->boolean('is_active');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('articles');
    }

}
