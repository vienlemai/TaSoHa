<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

    public function up() {
        Schema::create('news', function(Blueprint $t) {
                    $t->increments('id');
                    $t->string('title', 255);
                    $t->string('slug', 255);
                    $t->text('content');
                    $t->integer('created_by');
                    $t->timestamps();
                });
    }

    public function down() {
        Schema::dropIfExists('news');
    }

}
