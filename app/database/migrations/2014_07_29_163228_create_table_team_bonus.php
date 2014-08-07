<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTeamBonus extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('team_bonus', function($t) {
            $t->increments('id');
            $t->integer('member_id');
            $t->float('left_left')->default(0);
            $t->float('right_left')->default(0);
            $t->boolean('need_to_up')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('team_bonus');
    }

}
