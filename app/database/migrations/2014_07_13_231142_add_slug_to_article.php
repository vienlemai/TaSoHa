<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToArticle extends Migration {

    public function up() {
        Schema::table('articles', function(Blueprint $t) {
                    $t->string('slug', 255)->after('title');
                });
    }

    public function down() {
        Schema::table('articles', function(Blueprint$t) {
                    $t->dropColumn('slug');
                });
    }

}
