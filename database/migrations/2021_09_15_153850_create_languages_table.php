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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('abbreviated')->nullable();
            $table->string('abbreviatedEdit')->nullable();
            $table->timestamps();
        });

        DB::table('languages')->insert([
            ["full_name" => "PHP", 'abbreviated' => 'php', 'abbreviatedEdit' => 'php'],
            ["full_name" => "JavaScript", 'abbreviated' => 'javascript', 'abbreviatedEdit' => 'js'],
            ["full_name" => "HTML", 'abbreviated' => 'html', 'abbreviatedEdit' => 'html'],
            ["full_name" => "CSS", 'abbreviated' => 'css', 'abbreviatedEdit' => 'css'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
