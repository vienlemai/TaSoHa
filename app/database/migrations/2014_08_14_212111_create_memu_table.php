<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemuTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('menus', function($t) {
            $t->increments('id');
            $t->integer('parent_id')->nullabl();
            $t->integer('lft');
            $t->integer('rgt');
            $t->integer('depth');
            $t->string('name');
            $t->string('slug');
            $t->integer('type');
            $t->string('route_name');
            $t->string('params');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('menus');
    }

}
