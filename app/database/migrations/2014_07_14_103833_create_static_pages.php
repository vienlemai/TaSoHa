<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPages extends Migration {

    public function up() {
        Schema::create('pages', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 255);
            $t->string('title', 255);
            $t->text('content', 255);
        });
    }

    public function down() {
        Schema::dropIfExists('pages');
    }

}
