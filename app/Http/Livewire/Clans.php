<?php

    namespace App\Http\Livewire;

    use App\Helper\ClashAPI;
    use App\Models\Clan;
    use App\Models\Player;
    use Livewire\Component;
    use function PHPUnit\Framework\isNull;

    class Clans extends Component
    {
        public $activeClan;
        public $players;

        public function setActiveClan(Clan $clan)
        {
            $this->activeClan = $clan;
        }

        public function getClanData($tag)
        {
            return ClashAPI::getData("https://api.clashofclans.com/v1/clans/" . urlencode('#' . $tag));
        }

        public function mount()
        {
            $this->players = Player::where('user_id', 'like', auth()->user()->id)->get();
        }

        public function render()
        {
            $query = Clan::get();
            foreach ($this->players as $player) {
                $query->where('id', 'like', $player->clan_id);
            }
            $clans = $query;

            $this->activeClan = $clans->first();

            return view('livewire.clans', compact('clans'))
                ->layout('layouts.pava-tracker', [
                    'description' => 'Manage your clan',
                    'title' => 'Clan'
                ]);
        }
    }