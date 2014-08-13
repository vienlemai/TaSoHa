<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDirectConfigs extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('direct_configs', function($t) {
            $t->increments('id');
            $t->string('regency', 20);
            $t->integer('depth');
            $t->integer('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('direct_configs');
    }

}
