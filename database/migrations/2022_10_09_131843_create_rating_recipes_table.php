<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('rating_recipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recipe_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('number');

            $table->unique(['recipe_id', 'user_id']);
            $table->foreign('recipe_id')->references('id')->on('recipes')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');;
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER `addRating` AFTER INSERT ON `rating_recipes`
                FOR EACH ROW Update `recipes` SET recipes.rating = CASE
                WHEN new.number = 1
                    THEN recipes.rating + 1
                WHEN new.number = 0
                    THEN recipes.rating - 1
                END
            WHERE recipes.id = NEW.recipe_id
        ');

        DB::unprepared('
            CREATE TRIGGER `updateRating` AFTER UPDATE ON `rating_recipes`
            FOR EACH ROW Update `recipes` SET recipes.rating = CASE
                WHEN new.number = 1
                    THEN recipes.rating + 1
                WHEN new.number = 0
                    THEN recipes.rating - 1
            END
            WHERE recipes.id = NEW.recipe_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_recipes');
    }
};
