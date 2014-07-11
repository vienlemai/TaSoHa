<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembersAddInfo extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('members', function($t) {
            $t->integer('introduced_by')->nullable();
            $t->string('identify_number', 20)->default('');
            $t->string('identify_location')->default('');
            $t->string('identify_date', 20)->default('');
            $t->string('location')->default('');
            $t->string('phone', 20)->default('');
            $t->string('regency', 20)->default('');
            $t->string('uid', 10)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('members', function($t) {
            $t->dropColumn('identify_number');
            $t->dropColumn('identify_location');
            $t->dropColumn('identify_date');
            $t->dropColumn('location');
            $t->dropColumn('phone');
            $t->dropColumn('regency');
            $t->dropColumn('uid');
        });
    }

}
