<?php

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


        $this->savePlayer(PlayerAPI::getPlayerByTag("#PC0L99RJ"), [2550, 0, 4150, 4000, 1000, 4050, 4050, 150, 150, 150, 150, 4050]);       // julien
        $this->savePlayer(PlayerAPI::getPlayerByTag("#2Q99PP0P"), [400, 0, 4250, 4100, 2300, 2800, 4000, 4050, 5050, 5050, 4250, 4050]);    // Ben10
        $this->savePlayer(PlayerAPI::getPlayerByTag("#P9CPPJP0Q"), [2600, 0, 650, 4000, 550, 550, 550, 1050, 750, 1350, 4050, 4300]);       // kobe
        $this->savePlayer(PlayerAPI::getPlayerByTag("#Y80YQ0VY0"), [4000, 0, 0, 4150, 4000, 4050, 4200, 4350, 5100, 5100, 4000, 4000]);     // overlord
        $this->savePlayer(PlayerAPI::getPlayerByTag("#9JPRV8QCQ"), [1450, 0, 0, 4000, 2350, 700, 4050, 1300, 1200, 2400, 2200, 300]);       // TheHiddenOne
        $this->savePlayer(PlayerAPI::getPlayerByTag("#YVYC8Q0V2"), [4000, 0, 0, 2500, 4050, 4050, 1700, 4000, 5050, 5400, 4000, 4550]);       // ferre
        $this->savePlayer(PlayerAPI::getPlayerByTag("#9U9CL08L"), [4300, 0, 0, 4000, 4000, 4050, 4000, 4000, 5000, 5050]);       // Stan
        $this->savePlayer(PlayerAPI::getPlayerByTag("#8QP8URQPV"), [4100, 0, 0, 0, 0, 0, 0, 300, 650, 1200, 150, 1800]);       // °Sh4dow°
        $this->savePlayer(PlayerAPI::getPlayerByTag("#PUUPRR20P"), [0, 0, 0, 0, 0, 2050, 1150, 1200, 1200]);    // Organic Yams
        $this->savePlayer(PlayerAPI::getPlayerByTag("#QG2Q9CVU8"), [0, 0, 4750, 4000]); // OIX09
        $this->savePlayer(PlayerAPI::getPlayerByTag("#QYRCL0GPR"), [300]);  // Mini Jonas
        $this->savePlayer(PlayerAPI::getPlayerByTag("#P088VJ8L"), [150]);  // TBAS-iTamot G
        $this->savePlayer(PlayerAPI::getPlayerByTag("#Q0RQY2PU0"), [300]);  // Maze
        $this->savePlayer(PlayerAPI::getPlayerByTag("#2QJ8L20QU"), [200]);  // .Pascal.
        $this->savePlayer(PlayerAPI::getPlayerByTag("#U8GCC8QJ"), [150]);  // King Dieter I
        $this->savePlayer(PlayerAPI::getPlayerByTag("#PUV2VRURJ"), [4050]);  // Floris
        $this->savePlayer(PlayerAPI::getPlayerByTag("#9YUV80C2"), [4000]);  // N_Lena
        $this->savePlayer(PlayerAPI::getPlayerByTag("#2U8GCLULR"), [4050]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#QQPRCU0QU"), [250]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#YQPLYUPL"), [4150]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#LCGUR2CLJ"), [250]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#Y0JQP98G"), [1900]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#2R0QL0VLQ"), [600]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#YYUV8PP8R"), [150]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#Y2QJ9Q0G"), [150]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#QV2PPCLY9"), [4000]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#Q2Q2V89LJ"), [1750]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#L9VL28Q90"), [4000]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#QY8CGVJ8G"), [1350]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#J0LQP98U"), [4050]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#QJRU9CQ2L"), [1750]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#PYCQ80LJ"), [150]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#VCPQGJGJ"), [4050]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#LGPPVJUJL"), [100]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#LUUCLV28Q"), [250]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#LP0P90VCU"), [4050]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#802JU2C9U"), [4050]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#9JPC9QYRG"), [4050]);
        $this->savePlayer(PlayerAPI::getPlayerByTag("#L00RP2YRC"), [4000]);
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

    private function savePlayer($player, $points)
    {
        $total = PlayerAPI::getClanGamePoints($player->tag);
        foreach ($points as $index => $point) {
            $year = 2023;
            $month = 9 - $index;
            // Adjust year and month if necessary
            while ($month < 1) {
                $month += 12;
                $year--;
            }
            $date = new DateTime("$year-$month-28");
            DB::table('clan_games')->insert([
                'player_id' => $player->id,
                'clan_id' => 1,
                'totalPoints' => $total,
                'clanGameNumber' => 69 - $index,
                'date' => $date->format('Y-m-d'),
            ]);
            $total -= $point;
        }
    }
};
