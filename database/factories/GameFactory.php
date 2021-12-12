<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'cards' => "1,2,3,4,5,6,7,8,9,10",
        'players' => "1,2",
    ];
});
