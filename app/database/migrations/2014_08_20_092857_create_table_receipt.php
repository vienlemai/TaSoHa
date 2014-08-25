<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReceipt extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('receipts', function($t) {
            $t->increments('id');
            $t->integer('member_id');
            $t->string('month', 20);
            $t->string('content');
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
