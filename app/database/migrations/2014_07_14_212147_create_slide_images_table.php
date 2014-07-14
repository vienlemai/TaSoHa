<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideImagesTable extends Migration {

    public function up() {
        Schema::create('slide_images', function (Blueprint $t) {
                    $t->increments('id');
                    $t->string('url', 255);
                    $t->string('description', 255);
                    $t->boolean('is_active')->default(true);
                    $t->integer('created_by');
                    $t->integer('position')->default(0);
                    $t->datetime('created_at');
                });
    }

    public function down() {
        Schema::dropIfExists('slide_images');
    }

}
