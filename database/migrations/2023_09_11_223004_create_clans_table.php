<?php

use App\Helpers\ClanAPI;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->string('description');
            $table->string('badge_url_m');
            $table->string('type');
            $table->boolean('public_war_log');
            $table->integer('war_wins');
            $table->integer('war_ties')->nullable();
            $table->integer('war_losses')->nullable();
            $table->integer('war_win_streak');
            $table->timestamps();
        });

        ClanAPI::saveClanInfo("#2PJJL82YR");
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
