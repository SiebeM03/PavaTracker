<?php

namespace App\Http\Livewire;

use App\Exceptions\ApiException;
use App\Helpers\ClanAPI;
use App\Models\SelectedPlayerClanService;
use Livewire\Component;

class Overview extends Component
{
    public $activePlayer;
    public $updatingData;
    public $clan;

    public function updateClanData()
    {
        try {
            if (!$this->clan) {
                $this->clan = ClanAPI::saveClanInfo("#2PJJL82YR");
                SelectedPlayerClanService::first()->update(['clan_id' => $this->clan->id]);
            } else {
                $this->clan = ClanAPI::saveClanInfo(SelectedPlayerClanService::first()->clan->tag);
            }
        } catch (ApiException $exception) {
            dd('error: ' . $exception->getReason());
        }
    }

    public function showNewClan()
    {
        $this->clan = SelectedPlayerClanService::first()->clan;
    }

    public function mount()
    {
        $this->clan = SelectedPlayerClanService::first()->clan;
        if (!$this->clan) {
            //dd($this->clan);
            $this->clan = ClanAPI::saveClanInfo('#2PJJL82YR');
            SelectedPlayerClanService::first()->update(['clan_id' => $this->clan->id]);
            $this->updateClanData();
            app(Members::class)->updateMembersData();
        }
    }

    public function render()
    {
        // TODO filter on clan
        //$this->clan = SelectedPlayerClanService::first()->clan;
        $this->clan = SelectedPlayerClanService::first()->clan;

        return view('livewire.overview')
            ->layout('layouts.pava-tracker');
    }
}
