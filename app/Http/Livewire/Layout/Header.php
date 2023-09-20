<?php

namespace App\Http\Livewire\Layout;

use App\Exceptions\ApiException;
use App\Helpers\PlayerAPI;
use App\Models\Clan;
use App\Models\Player;
use App\Models\SelectedPlayerClanService;
use Livewire\Component;

class Header extends Component
{
    public $activePlayer = null;
    public $showNewPlayerModal = false;
    public $newPlayer = [
        'playerTag' => '',
        'apiToken' => '',
    ];
    public $rules = [
        'newPlayer.playerTag' => 'required|string|regex:/^#.*$/',
        'newPlayer.apiToken' => 'required',
    ];
    protected $validationAttributes = [
        'newPlayer.playerTag' => 'Player tag',
        'newPlayer.apiToken' => 'API Token',
    ];
    protected $messages = [
        'newPlayer.playerTag.regex' => "The Player tag has to start with a '#'.",
    ];

    public function setNewPlayer()
    {
        $this->resetErrorBag();
        $this->reset('newPlayer');
        $this->showNewPlayerModal = true;
    }

    public function linkNewPlayer()
    {
        $status = null;
        try {
            $this->validate();
            // FIXME remove testing apiToken
            if ($this->newPlayer['apiToken'] !== 'test') {
                $status = PlayerAPI::validateApiToken($this->newPlayer['playerTag'], $this->newPlayer['apiToken']);
            } else {
                $status = 'ok';
            }
            /* TODO add more custom errors*/
            if ($status == 'ok') {
                $player = PlayerAPI::updateUserId($this->newPlayer['playerTag'], auth()->user()->id);
                $this->setActivePlayer($player->id);
                $this->showNewPlayerModal = false;
            } else {
                $this->addError('invalid', "Invalid combination, try again!");
            }
        } catch (ApiException $exception) {
            dd($exception);
        }
    }

    public function setActivePlayer($player, $clan = null)
    {
        // Don't reload when selecting currently selected user
        if ($this->activePlayer !== null && $this->activePlayer->id !== $player) {
            $selectedPlayer = SelectedPlayerClanService::first();
            $selectedPlayer->update(['player_id' => $player, 'clan_id' => Player::whereId($player)->first()->clan_id]);

            $this->activePlayer = $selectedPlayer->player;
            return redirect()->route('overview');
        }
        return $this->activePlayer;
    }

    public function render()
    {
        $clans = [];
        $currentPlayers = [];

        if (auth()->user()) {
            foreach (auth()->user()->players as $linkedPlayer) {
                $currentPlayers[] = $linkedPlayer->id;
                $clans[] = $linkedPlayer->clan_id;
            }

            // Get clans corresponding to currentPlayers[]
            if (count($currentPlayers) !== 0) {
                $clans = Clan::with(
                    ['players' => function ($query) use ($currentPlayers) {
                        $query->whereIn('id', $currentPlayers);
                    }]
                )->whereIn('id', $clans)->get();

                if (SelectedPlayerClanService::first() == null) {
                    $this->setActivePlayer($currentPlayers[0]);
                }
            } else {
                $this->setActivePlayer(null, Clan::where('tag', '=', '#2PJJL82YR')->first()->id);
            }
        } else {
            $this->setActivePlayer(null, Clan::where('tag', '=', '#2PJJL82YR')->first()->id);
        }

        $this->activePlayer = SelectedPlayerClanService::first()->player;
        return view('livewire.layout.header', compact('clans'));
    }
}
