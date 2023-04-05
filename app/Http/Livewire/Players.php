<?php

    namespace App\Http\Livewire;

    use App\Helper\ClashAPI;
    use App\Models\Clan;
    use App\Models\Player;
    use Livewire\Component;

    class Players extends Component
    {
        public $activePlayer;
        public $newPlayerModal = false;
        public $newPlayer = [
            'tag' => null,
            'user_id' => null,
        ];

        public function setActivePlayer(Player $player)
        {
            $this->activePlayer = $player;
        }

        public function addPlayer()
        {
            //$this->validate();
            $this->newPlayer['tag'] = ClashAPI::formatTag($this->newPlayer['tag']);

            $data = $this->getPlayerData($this->newPlayer['tag']);

            if (isset($data["reason"])) {
                /* TODO add error message, an invalid playertag has been entered */
            } else {
                if (isset($data['clan'])) {
                    $clan = Clan::where('tag', 'like', substr($data['clan']['tag'], 1))->first();
                } else {
                    $clan = null;
                }
            }

            $player = Player::create([
                'tag' => $this->newPlayer['tag'],
                'name' => $data['name'],
                'user_id' => auth()->user()->id,
                'clan_id' => (isset($clan) ? $clan->id : null),
            ]);
            $this->newPlayerModal = false;
        }

        public function getPlayerData($tag)
        {
            return ClashAPI::getData("https://api.clashofclans.com/v1/players/" . urlencode('#' . $tag));
        }

        public function mount()
        {
            $this->activePlayer = Player::where('user_id', 'like', auth()->user()->id)->first();
        }

        public function render()
        {
            $players = Player::where('user_id', 'like', auth()->user()->id)->get();

            return view('livewire.players', compact('players'))
                ->layout('layouts.pava-tracker', [
                    'description' => 'Player stats',
                    'title' => 'Player'
                ]);
        }
    }
