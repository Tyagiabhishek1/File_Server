<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->bigIncrements('user_role_id');
            $table->integer('user_id')->references('user_id')->on('users');
            $table->integer('role_id')->references('role_id')->on('roles');
            $table->string('role_name');
            $table->string('update_user_id')->nullable()->default('system');
            $table->string('create_user_id')->nullable()->default('system');
            $table->string('delete_ind')->nullable()->default('N');
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
        Schema::dropIfExists('user_role');
    }
}
