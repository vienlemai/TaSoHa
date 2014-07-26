<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProduct extends Migration {

    public function up() {
        Schema::table('products', function(Blueprint $t) {
            $t->dropColumn('primary_photo');
        });
        Schema::table('product_categories', function(Blueprint $t) {
            $t->string('thumbnail', 255)->after('show_on_menu');
        });
    }

    public function down() {
        Schema::table('product_categories', function(Blueprint $t) {
            $t->dropColumn('thumbnail');
        });
    }

}
