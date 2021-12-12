<?php

    namespace App\Http\Controllers;

    use App\Card;
    use App\Game;
    use Exception;
    use Illuminate\Http\Request;

    class GameController extends Controller
    {
        public function get()
        {
            $games = Game::all();
            return response([
                'success' => true,
                'games' => $games
            ], 200);
        }

        public function getActiveGames()
        {
            $games = Game::all()->where('active', '=', 1);
            return response([
                'success' => true,
                'games' => $games
            ], 200);
        }

        public function save(Request $request)
        {

            $game = new Game([
                'user_id' => $request->input('user_id'),
                'players' => $request->input('players')
            ]);
            $game->save();
            return response([
                'success' => true,
                'message' => 'Game saved successfully!!!'
            ], 201);

        }

        public function number(Request $request, $game_id)
        {
            $game = Game::all()->find($game_id);

            if ($request->input('number') > 75 || $request->input('number') < 1) {
                return response([
                    'success' => false,
                    'error' => 'Number incorrect!'
                ], 500);
            }

            $numbers = [];

            // Exist numbers in column ``numbers`` ?
            if ($game->numbers) {
                $numbers = json_decode($game->numbers);
            }

            // Exist number in value column ``numbers`` ?
            if (!in_array($request->input('number'), $numbers)) {
                array_push($numbers, $request->input('number'));
            }

            $game->numbers = json_encode($numbers);
            $game->save();
            return response([
                'success' => true,
                'message' => 'New Number!!!'
            ], 201);
        }

        public function bingo(Request $request, $id_game)
        {
            $game = Game::all()->find($id_game);

            if (!$game || $game->active === 0) {
                return response([
                    'success' => false,
                    'error' => 'Game not available!!!'
                ], 401);
            }

            $cards_in_game = explode(',', $game->cards);
            $players_in_game = explode(',', $game->players);

            if (!in_array($request->input('card_id'), $cards_in_game)) {
                return response([
                    'success' => false,
                    'error' => 'Card not belong to the game!!!'
                ], 401);
            }

            if (!in_array($request->input('user_id'), $players_in_game)) {
                return response([
                    'success' => false,
                    'error' => 'User not belong to the game!!!'
                ], 401);
            }

            $cardUser = Card::all()->find($request->input('card_id'));

            $numbersOfCardWithIndex = json_decode($cardUser->numbers);
            $columnOrLine = $request->input('line');

            if (!in_array($columnOrLine, array_keys(bingoColumns()))) {
                return response([
                    'error' => 'Column not found!!!',
                    'success' => false,
                    'message' => 'Available columns: `B`,`I`,`N`,`G`,`O`'
                ], 404);
            }

            $numbersOfCardToCompare = $numbersOfCardWithIndex->$columnOrLine;
            $numbersOfReveledToCompare = $game->numbers ? json_decode($game->numbers) : [];
            $countNumbersInColumnBingo = bingoColumns()[$request->input('line')]['count'] + 1;

            if (!validatePlayerWin($numbersOfCardToCompare, $numbersOfReveledToCompare, $countNumbersInColumnBingo)) {
                return response([
                    'success' => false,
                    'error' => 'numbers do not match!!!'
                ], 401);
            }

            $game->winner_user_id = $request->input('user_id');
            $game->active = 0;

            $game->save();

            return response([
                'success' => true,
                'message' => 'Congratulations!!!'
            ]);
        }

        public function bingo_complete(Request $request, $id_game)
        {
            $game = Game::all()->find($id_game);

            if (!$game || $game->active === 0) {
                return response([
                    'success' => false,
                    'error' => 'Game not available!!!'
                ], 401);
            }

            $cards_in_game = explode(',', $game->cards);
            $players_in_game = explode(',', $game->players);

            if (!in_array($request->input('card_id'), $cards_in_game)) {
                return response([
                    'success' => false,
                    'error' => 'Card not belong to the game!!!'
                ], 401);
            }

            if (!in_array($request->input('user_id'), $players_in_game)) {
                return response([
                    'success' => false,
                    'error' => 'User not belong to the game!!!'
                ], 401);
            }

            $cardUser = Card::all()->find($request->input('card_id'));
            $card_user_numbers = json_decode($cardUser->numbers);
            $numbersOfReveledToCompare = $game->numbers ? json_decode($game->numbers) : [];
            $numbersOfCardToCompare = [];

            foreach ($card_user_numbers as $cardColumn) {
                for ($i = 0; $i < count($cardColumn); $i++) {
                    array_push($numbersOfCardToCompare, $cardColumn[$i]);
                }
            }

            if (!validatePlayerWin($numbersOfCardToCompare,$numbersOfReveledToCompare,24)) {
                return response([
                    'success' => false,
                    'error' => 'numbers do not match!!!'
                ], 401);
            }

            $game->winner_user_id = $request->input('user_id');
            $game->active = 0;

            $game->save();

            return response([
                'success' => true,
                'message' => 'Congratulations!!!'
            ]);
        }
    }
