<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->integer('type')->nullable();
            $table->string('addressdetail')->nullable();
            $table->string('road')->nullable();
            $table->string('province')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('imageFileName')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
