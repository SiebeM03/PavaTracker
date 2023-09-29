<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ClanGame extends Component
{
    public function render()
    {
        return view('livewire.clan-game')
            ->layout('layouts.pava-tracker');
    }
}
