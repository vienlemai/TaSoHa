<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BillsChangeAmountToString extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('alter table bills modify price varchar(20)');
        DB::statement('alter table bills modify score varchar(20)');
        DB::statement('alter table members modify score varchar(20)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
