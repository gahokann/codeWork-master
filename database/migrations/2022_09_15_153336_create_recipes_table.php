<?php

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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable(false);
            $table->string('description', 255)->nullable(false);
            $table->text('code')->nullable(false);
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('rating')->default(0);
            $table->bigInteger("category_id")->unsigned();
            $table->bigInteger("language_id")->unsigned();
            $table->timestamps();
            //========================
            $table->index('author_id');
            $table->index('category_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
