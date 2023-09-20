<?php

namespace App\Http\Livewire\Layout;

use App\Exceptions\ApiException;
use App\Helpers\PlayerAPI;
use App\Http\Livewire\Overview;
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
                PlayerAPI::updateUserId($this->newPlayer['playerTag'], auth()->user()->id);
                $this->showNewPlayerModal = false;
            } else {
                $this->addError('invalid', "Invalid combination, try again!");
            }
        } catch (ApiException $exception) {

        }
    }

    public function setActivePlayer($player)
    {
        $selectedPlayer = SelectedPlayerClanService::first();
        $selectedPlayer->update(['player_id' => $player, 'clan_id' => Player::whereId($player)->first()->clan_id]);

        $this->activePlayer = $selectedPlayer->player;
        return redirect()->route('overview');
    }

    public function render()
    {
        $clans = [];
        $currentPlayers = [];

        if (auth()->user()) {
            foreach (auth()->user()->players as $currentPlayer) {
                $currentPlayers[] = $currentPlayer->id;
                $clans[] = $currentPlayer->clan_id;
            }
            // Get clans corresponding to currentPlayers
            if (count($currentPlayers) !== 0) {
                $clans = Clan::with(
                    ['players' => function ($query) use ($currentPlayers) {
                        $query->whereIn('id', $currentPlayers);
                    }]
                )->whereIn('id', $clans)->get();
                if (SelectedPlayerClanService::first() == null) {
                    $this->setActivePlayer($currentPlayers[0]);
                }
            }
            if (SelectedPlayerClanService::first()->player == null) {
                $firstPlayer = Player::where('user_id', '=', auth()->user()->id)->first();
                if ($firstPlayer !== null) {
                    SelectedPlayerClanService::first()->update(['player_id' => $firstPlayer->id]);
                } else {
                    SelectedPlayerClanService::first()->update(['player_id' => null]);
                }
            }
        } else {
            SelectedPlayerClanService::first()->update(['player_id' => null]);
        }
        $this->activePlayer = SelectedPlayerClanService::first()->player;
        return view('livewire.layout.header', compact('clans'));
    }
}
