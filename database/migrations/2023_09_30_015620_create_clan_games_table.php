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
        Schema::create('clan_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('clan_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->integer('totalPoints');
            $table->integer('clanGameNumber');
            $table->dateTime('date');
            $table->timestamps();

            $table->unique(['player_id', 'clanGameNumber']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clan_games');
    }
};
