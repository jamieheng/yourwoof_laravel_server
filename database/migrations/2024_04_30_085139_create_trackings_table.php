<?php

use Illuminate\Cache\NullStore;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('pet_id');
            $table->string('pet_img_week1')->nullable();
            $table->string('pet_img_week2')->nullable();
            $table->string('pet_img_week3')->nullable();
            $table->string('pet_img_week4')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_bad_user')->default(true);
            $table->boolean('is_removed')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('trackings');
    }
};
