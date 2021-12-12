<?php

use App\User;
use App\Game;
use App\Card;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jesus Fernandez',
            'email' => 'jesus@email.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Usuario Prueba',
            'email' => 'prueba@email.com',
            'password' => bcrypt('123456')
        ]);

        factory(Game::class, 1)->create();
        factory(Card::class, 10)->create();
    }
}
