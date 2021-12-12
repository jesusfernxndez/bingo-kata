<?php

    namespace Tests\Feature;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use phpDocumentor\Reflection\Types\String_;
    use Tests\TestCase;

    class GamesTest extends TestCase
    {
        /**
         * A basic feature test example.
         *
         * @return void
         */
        public function testGetAllGame()
        {
            // Test All games in the table `games` and return one json
            $response = $this->get('/games');

            $response->assertStatus(200)->assertJson([
                'success' => true,
            ], true);
        }

        public function testFilterGamesActive()
        {
            $response = $this->get('/games_active');
            $response->assertStatus(200)->assertJson([
                'success' => true,
            ], true);
        }

        public function testNewGame()
        {
            $response = $this->post('/new_game',[
                'user_id' => 1,
                'players' => '1,2,3,4'
            ],[
                'X-CSRF-TOKEN' => csrf_token()
            ]);
            $response->assertStatus(201)->assertJson([
                'success' => true,
            ]);
        }
        public function testPublishNumberBingo() {
            $response = $this->post('/new_number/1',[
                'number' => 1
            ],[
                'X-CSRF-TOKEN' => csrf_token()
            ]);
            $response->assertStatus(201)->assertJson([
                'success' => true
            ]);
        }
    }
