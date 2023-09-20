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
        $this->clan = SelectedPlayerClanService::first()->clan;
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

    public function mount()
    {
        $this->updateClanData();
        //app(Members::class)->updateMembersData();
    }

    public function render()
    {
        $this->clan = SelectedPlayerClanService::first()->clan;

        return view('livewire.overview')
            ->layout('layouts.pava-tracker');
    }
}
