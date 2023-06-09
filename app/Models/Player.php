<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Player extends Model
    {
        use HasFactory;

        protected $fillable = [
            'tag',
            'name',
            'clan_id',
            'user_id',
        ];

        public function clan()
        {
            return $this->belongsTo(Clan::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }


    }
