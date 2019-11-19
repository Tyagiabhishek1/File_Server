<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->bigIncrements('video_id');
            $table->string('video_title');
            $table->string('video_size');
            $table->string('video_url');
            $table->string('thumbnail_url')->nullable();
            $table->string('video_length');
            $table->string('download_ind',1)->nullable();
            $table->integer('user_id')->references('user_id')->on('users');
            $table->string('m3u8_url')->nullable();
            $table->string('job_success_ind',1)->nullable();
            $table->timestamp('job_success_time')->nullable();
            $table->string('thumbnail_file')->nullable();
            $table->string('video_name')->nullable();
            $table->string('upload_ind',1)->nullable();
            $table->string('video_type')->nullable();
            $table->integer('video_expiry')->nullable();
            $table->string('is_rental',1)->nullable();
            $table->integer('rental_period')->nullable();
            $table->integer('number_time')->nullable();
            $table->integer('video_provider_expiry')->nullable();
            $table->integer('actual_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('rental_price')->nullable();
            $table->text('video_description')->nullable();
            $table->timestamp('create_dt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('create_user_id')->nullable()->default('system');
            $table->timestamp('update_dt')->nullable();
            $table->string('update_user_id')->nullable()->default('system');
            $table->string('del_ind',1)->nullable()->default('N');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
