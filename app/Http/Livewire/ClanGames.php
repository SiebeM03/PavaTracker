<?php

namespace App\Http\Livewire;

use App\Models\ClanGame;
use App\Models\Player;
use App\Models\SelectedPlayerClanService;
use Livewire\Component;

class ClanGames extends Component
{
    public $firstClanGame;
    public $lastClanGame;

    public function getClanGamePerformance($player, $clanGameNumber) {
        $clanGamePerformance = ClanGame::where([
            ['player_id', $player->id],
            ['clanGameNumber', $clanGameNumber]
        ])->first();
        $previousClanGamePerformance = ClanGame::where([
            ['player_id', $player->id],
            ['clanGameNumber', $clanGameNumber-1]
        ])->first();

        if ($previousClanGamePerformance == null) {
            return 0;
        } elseif ($clanGamePerformance == null) {
            return 0;
        } else {
            return $clanGamePerformance->totalPoints - $previousClanGamePerformance->totalPoints;
        }

        return $clanGamePerformance->totalPoints ?? '';
    }

    public function render()
    {
        $selectedClanId = SelectedPlayerClanService::first()->clan->id;

        $players = Player::where('clan_id', $selectedClanId)
            ->with('clanGames')
            ->get();

        $this->firstClanGame = ClanGame::where('clan_id', $selectedClanId)
            ->orderBy('clanGameNumber')
            ->first();

        $this->lastClanGame = ClanGame::where('clan_id', $selectedClanId)
            ->orderByDesc('clanGameNumber')
            ->first();

        return view('livewire.clan-game', compact('players'))
            ->layout('layouts.pava-tracker');
    }
}
