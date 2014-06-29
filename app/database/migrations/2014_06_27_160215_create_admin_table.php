<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration {

    public function up() {
        Schema::create('admins', function($t) {
            $t->increments('id');
            $t->string('full_name');
            $t->string('email', 100);
            $t->string('password');
            $t->string('remember_token')->nullable();
            $t->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('admins');
    }

}
