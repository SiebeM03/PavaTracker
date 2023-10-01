<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class)->withDefault();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function selectedPlayerClanServices(): HasMany
    {
        return $this->hasMany(SelectedPlayerClanService::class);
    }

    public function clanGames(): HasMany
    {
        return $this->hasMany(ClanGame::class);
    }


    public function getTownHallLevel(): array
    {
        return explode('_', $this->town_hall);
    }

    protected $appends = [];

    protected $hidden = [];
}
