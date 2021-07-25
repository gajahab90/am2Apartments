<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_relations', function (Blueprint $table) {
            $table->unsignedInteger('child_category_id');
            $table->unsignedInteger('parent_category_id');
            $table->timestamps();
        });

        Schema::table('category_relations', function (Blueprint $table) {
            $table->foreign("child_category_id")->references('id')->on("categories");
            $table->foreign("parent_category_id")->references('id')->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_relations', function (Blueprint $table) {
            $table->dropForeign(['parent_category_id']);
            $table->dropForeign(['child_category_id']);
        });
        Schema::dropIfExists('category_relations');
    }
}
