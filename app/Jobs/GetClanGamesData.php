<?php

namespace App\Jobs;

use App\Helpers\PlayerAPI;
use App\Models\Clan;
use App\Models\ClanGame;
use DateTime;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetClanGamesData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $clanGamesLaunchDate = new DateTime('2017-12-01');

        $currentDate = new DateTime();
        $interval = $currentDate->diff($clanGamesLaunchDate);
        $amountOfClanGames = ($interval->y * 12) + $interval->m - ($currentDate->format('d') < 28 ? 1 : 0);

        $clanGameEndDate = new DateTime($currentDate->format('y') . '-' . $currentDate->format('m') - ($currentDate->format('d') < 28 ? 1 : 0) . '-28');


        for ($n = 10; $n >= 0; $n--) {
            foreach (Clan::get() as $clan) {
                foreach ($clan->players as $player) {
                    $foundEntry = ClanGame::where([
                        ['player_id', '=', $player->id],
                        ['clanGameNumber', '=', $amountOfClanGames - $n]
                    ])->first();

                    // Avoid duplicate entries for 1 player on 1 clan game
                    if ($foundEntry == null && in_array($player->id, range(0, 10))) {
                        $clanGame = ClanGame::create([
                            'player_id' => $player->id,
                            'clan_id' => $player->clan_id,
                            'totalPoints' => PlayerAPI::getClanGamePoints($player->tag) - random_int(100, 5000)*$n,
                            'clanGameNumber' => $amountOfClanGames - $n,
                            'date' => $clanGameEndDate->modify('-'.$n.' month'),
                        ]);
                        dump("(" . $player->id . ") " . $player->name . " entry created for ClanGame: " . $amountOfClanGames - $n);
                    }
                }
            }
        }


    }
}
