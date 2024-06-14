<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('adopter_id')->nullable();
            $table->string('pet_name');
            $table->integer('pet_gender_id');
            $table->integer('pet_age');
            $table->integer('pet_breed');
            $table->string('pet_img');
            $table->text('pet_description');
            $table->string('pet_status');
            $table->integer('pet_cate_id');
            $table->boolean('is_removed')->default(false);
            $table->boolean('is_adopted')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_invalid')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
