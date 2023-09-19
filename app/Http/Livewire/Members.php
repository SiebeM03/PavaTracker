<?php

namespace App\Http\Livewire;

use App\Exceptions\ApiException;
use App\Helpers\ClanAPI;
use App\Helpers\PlayerAPI;
use App\Models\Clan;
use App\Models\Player;
use App\Models\SelectedPlayerClanService;
use Livewire\Component;

class Members extends Component
{
    /* Set to false by default (when on /clan page)
       Set to true when used as @livewire('clans', ['hideElement' => true])
       See mount() and views/livewire/overview.blade.php for more info */
    public $visibleOnOverview;
    public $clan;
    public $error = [
        'reason' => null,
        'message' => null,
        'type' => null,
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function updateMembersData()
    {
        try {
            PlayerAPI::saveClanMembersInfo(SelectedPlayerClanService::first()->clan);
            return true;
        } catch (ApiException $exception) {
            $this->error = [
                'reason' => $exception->getReason(),
                'message' => $exception->getErrorMessage(),
                'type' => ($exception->getType() ?? null),
            ];
            return false;
        }
    }

    public function mount($visibleOnOverview = true)
    {
        $this->clan = SelectedPlayerClanService::first()->clan;
        if (!$this->clan) {
            $this->updateMembersData();
        }
        $this->visibleOnOverview = $visibleOnOverview;
    }

    public function render()
    {
        $this->clan = SelectedPlayerClanService::first()->clan
            ->with('players')
            ->whereHas('players', function ($query) {
                $query->where('clan_id', '=', SelectedPlayerClanService::first()->clan_id);
            })
            ->first();

        // TODO add pagination

        return view('livewire.members')
            ->layout('layouts.pava-tracker');
    }
}
