<?php

use App\Helpers\ClanAPI;
use App\Helpers\PlayerAPI;
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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->unique();
            $table->string('role')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('clan_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('town_hall')->nullable();
            $table->unsignedInteger('trophies');
            $table->unsignedInteger('versus_trophies');
            $table->unsignedInteger('donations');
            $table->unsignedInteger('donations_received');
            $table->timestamps();
        });

        PlayerAPI::saveClanMembersInfo(ClanAPI::getClanByTag("#2PJJL82YR"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
