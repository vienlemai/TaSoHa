<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admin_users', function($t) {
            $t->increments('id');
            $t->string('first_name');
            $t->string('last_name');
            $t->string('email');
            $t->string('password', 64);
            $t->boolean('sex')->default(0);
            $t->timestamp('date_of_birth')->nullable();
            $t->boolean('is_active')->default(1);
            $t->string('remember_token')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('admin_users');
    }

}
