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

        $clanGameEndDate = new DateTime($currentDate->format('Y') . '-' . $currentDate->format('m') - ($currentDate->format('d') < 28 ? 1 : 0) . '-28');

        $clanGameEndDate->modify('-2 months');
        foreach (Clan::get() as $clan) {
            foreach ($clan->players as $player) {
                $foundEntry = ClanGame::where([
                    ['player_id', '=', $player->id],
                    ['clanGameNumber', '=', $amountOfClanGames - 2]
                ])->first();


                // Avoid duplicate entries for 1 player on 1 clan game
                if ($foundEntry == null && in_array($player->id, range(0, 10))) {
                    $clanGame = ClanGame::create([
                        'player_id' => $player->id,
                        'clan_id' => $player->clan_id,
                        'totalPoints' => PlayerAPI::getClanGamePoints($player->tag) - 2234,
                        'clanGameNumber' => $amountOfClanGames - 2,
                        'date' => $clanGameEndDate,
                    ]);
                    dump($clanGame->date);
                    dump($clanGame->clanGameNumber);
                }
            }
        }

        $clanGameEndDate->modify('+1 months');
        foreach (Clan::get() as $clan) {
            foreach ($clan->players as $player) {
                $foundEntry = ClanGame::where([
                    ['player_id', '=', $player->id],
                    ['clanGameNumber', '=', $amountOfClanGames - 1]
                ])->first();


                // Avoid duplicate entries for 1 player on 1 clan game
                if ($foundEntry == null && in_array($player->id, range(0, 10))) {
                    $clanGame = ClanGame::create([
                        'player_id' => $player->id,
                        'clan_id' => $player->clan_id,
                        'totalPoints' => PlayerAPI::getClanGamePoints($player->tag) - 1234,
                        'clanGameNumber' => $amountOfClanGames - 1,
                        'date' => $clanGameEndDate,
                    ]);
                    dump($clanGame->date);
                    dump($clanGame->clanGameNumber);
                }
            }
        }

        $clanGameEndDate->modify('+2 months');
        foreach (Clan::get() as $clan) {
            foreach ($clan->players as $player) {
                $foundEntry = ClanGame::where([
                    ['player_id', '=', $player->id],
                    ['clanGameNumber', '=', $amountOfClanGames]
                ])->first();


                // Avoid duplicate entries for 1 player on 1 clan game
                if ($foundEntry == null && in_array($player->id, range(0, 10))) {
                    $clanGame = ClanGame::create([
                        'player_id' => $player->id,
                        'clan_id' => $player->clan_id,
                        'totalPoints' => PlayerAPI::getClanGamePoints($player->tag),
                        'clanGameNumber' => $amountOfClanGames,
                        'date' => $clanGameEndDate,
                    ]);
                    dump($clanGame->date);
                    dump($clanGame->clanGameNumber);
                }
            }
        }
    }
}
