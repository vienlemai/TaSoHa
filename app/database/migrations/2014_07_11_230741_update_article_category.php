<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArticleCategory extends Migration {

    public function up() {
        Schema::table('article_categories', function(Blueprint $t) {
                    $t->dropColumn('parent_id');
                    $t->text('description')->after('slug');
                    $t->string('photo')->nullable()->after('slug');
                    $t->boolean('removalable')->default(true)->after('slug');
        });
    }

    public function down() {
        //
    }

}

