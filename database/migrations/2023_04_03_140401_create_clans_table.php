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
        Schema::create('clans', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->unique();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('clans')->insert(
            [
                [
                    'id' => 1,
                    'tag' => '2PJJL82YR',
                    'name' => 'Pava X'
                ],
                [
                    'id' => 2,
                    'tag' => '2GLYVQC02',
                    'name' => 'Pava Y'
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clans');
    }
};
