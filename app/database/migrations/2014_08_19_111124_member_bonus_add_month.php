<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberBonusAddMonth extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('member_bonus', function($t) {
            $t->string('month', 20);
            $t->dropColumn('created_at');
            $t->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('member_bonus', function($t) {
            $t->dropColumn('month');
        });
    }

}
