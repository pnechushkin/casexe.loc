<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPrisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_prizes', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('user_id')->unsigned();
	        $table->foreign('user_id')->references('id')->on('users');
            $table->string('prize');
            $table->string('action');
            $table->string('status');
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
        Schema::dropIfExists('users_prizes');
    }
}
