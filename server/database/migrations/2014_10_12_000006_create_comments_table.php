<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('post_id')->unsigned()->index();
            $table->text('body', 255);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('email')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
