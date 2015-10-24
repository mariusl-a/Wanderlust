<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_instagram', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->unique();
            $table->string('access_token');
            $table->string('username');
            $table->longtext('bio');
            $table->string('profile_picture');
            $table->string('full_name');
            $table->bigInteger('insta_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_instagram');
    }
}
