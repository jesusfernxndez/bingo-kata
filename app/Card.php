<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'id', 'game_id', 'numbers'
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }
}
