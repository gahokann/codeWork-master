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
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id');
            $table->string('role_name', 100)->nullable();
            $table->string('role_info', 255)->nullable();
            $table->timestamps();
        });

        DB::table('roles')->insert(
            array(
                'id' => 1,
                'role_name' => 'Пользователь',
                'role_info' => 'Lorem ipsum dolor sit amet.',
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
