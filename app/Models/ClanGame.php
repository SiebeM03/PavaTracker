<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClanGame extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class)->withDefault();
    }
    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class)->withDefault();
    }

    protected $appends = [];

    protected $hidden = [];
}
