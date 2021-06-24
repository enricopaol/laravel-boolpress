<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_post', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags');

            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts');         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_post', function (Blueprint $table) {
            $table->dropForeign('tag_post_tag_id_foreign');   
            $table->dropForeign('tag_post_post_id_foreign'); 
            Schema::dropIfExists('tag_post'); 
        });              
    }
}
