<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'user_id', 'cards', 'players',
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
    public function cards() {
        return $this->hasMany(Card::class);
    }
}
