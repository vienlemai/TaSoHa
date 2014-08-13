<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactoryMembers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('members',  function($t) {
            $t->dropColumn('lft');
            $t->dropColumn('rgt');
            $t->dropColumn('parent_id');
            $t->dropColumn('introduced_by');
            $t->dropColumn('depth');
            $t->dropColumn('sun_depth');
            $t->dropColumn('is_left');
            $t->dropColumn('is_right');
            $t->dropColumn('managed_by');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
