<?php

    namespace App\Http\Controllers;

    use App\Card;
    use App\Game;
    use Illuminate\Http\Request;

    class CardController extends Controller
    {
        public function get()
        {
            $cards = Card::all();
            return response([
                'success' => true,
                'cards' => $cards
            ], 200);
        }

        public function getPerGame($game_id)
        {
            $cards = Card::all()->where('game_id', '=', $game_id);
            return response([
                'success' => true,
                'cards' => $cards
            ], 200);
        }

        public function save(Request $request, $id_game)
        {
            $game = Game::all()->find($id_game);

            if (!$game || $game->active === 0) {
                return response([
                    'success' => false,
                    'error' => 'Game not available!!!'
                ], 401);
            }

            $cards_in_game = $game->cards ? explode(',', $game->cards) : [];

            $lettres = bingoLetters();
            $columns = bingoColumns();

            $numbersOfCard = [
                'B' => [],
                'I' => [],
                'N' => [],
                'G' => [],
                'O' => []
            ];

            for ($i = 1; $i <= count($lettres); $i++) {
                $numbers = [];
                for ($j = 1; count($numbers) <= $columns[$lettres[$i - 1]]['count']; $j++) {
                    $number = generateBingoNumberRandom($lettres[$i - 1]);
                    if (!in_array($number, $numbers)) {
                        array_push($numbers, $number);
                    }
                }
                $numbersOfCard[$lettres[$i - 1]] = $numbers;
                $numbers = [];
            }

            $card = new Card([
                'game_id' => $id_game,
                'numbers' => json_encode($numbersOfCard)
            ]);

            $card->save();

            array_push($cards_in_game, $card->id);

            $game->cards = implode(',',$cards_in_game);

            $game->save();

            return response([
                'success' => true,
                'message' => 'card created!',
                'numbers' => $card->id
            ], 201);
        }
    }
