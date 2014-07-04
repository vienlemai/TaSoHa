<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberBonus extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('member_bonus', function($t) {
            $t->increments('id');
            $t->integer('member_id');
            $t->integer('bonus_id');
            $t->float('amount');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('member_bonus');
    }

}
