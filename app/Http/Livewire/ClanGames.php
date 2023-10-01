<?php

namespace App\Http\Livewire;

use App\Models\ClanGame;
use App\Models\Player;
use App\Models\SelectedPlayerClanService;
use Livewire\Component;

class ClanGames extends Component
{
    public $showingOverview;
    public $totalPointsLastClanGame;

    public function getClanGamePerformance($player, $clanGameNumber)
    {
        $clanGamePerformance = ClanGame::where([
            ['player_id', $player->id],
            ['clanGameNumber', $clanGameNumber]
        ])->first();
        $previousClanGamePerformance = ClanGame::where([
            ['player_id', $player->id],
            ['clanGameNumber', $clanGameNumber - 1]
        ])->first();

        if ($previousClanGamePerformance == null) {
            return null;
        } elseif ($clanGamePerformance == null) {
            return 0;
        } else {
            //return $clanGamePerformance->totalPoints;
            return $clanGamePerformance->totalPoints - $previousClanGamePerformance->totalPoints;
        }
    }

    public function mount($showingOverview = false)
    {
        $this->showingOverview = $showingOverview;
    }

    public function render()
    {
        $selectedClanId = SelectedPlayerClanService::first()->clan->id;

        $players = Player::where('clan_id', $selectedClanId)
            ->with('clanGames')
            ->get();

        $firstClanGame = ClanGame::where('clan_id', $selectedClanId)
            ->orderBy('date')
            ->first();

        $playerWithMostClanGames = $firstClanGame->player;

        $latestClanGames = ClanGame::where([
            ['clanGameNumber', $playerWithMostClanGames->clanGames()->orderByDesc('date')->first()->clanGameNumber],
            ['clan_id', $selectedClanId]
        ])->get();

        $this->totalPointsLastClanGame = 0;
        foreach ($latestClanGames as $clanGame) {
            $this->totalPointsLastClanGame += $this->getClanGamePerformance($clanGame->player, $clanGame->clanGameNumber);
        }

        return view('livewire.clan-game', compact('players', 'playerWithMostClanGames'))
            ->layout('layouts.pava-tracker');
    }
}
