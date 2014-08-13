<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('receipts', function($t) {
            $t->increments('id');
            $t->integer('member_id');
            $t->string('month');
            $t->string('content', 255);
            $t->string('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('receipts');
    }

}
