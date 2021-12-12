<?php

    /** @var \Illuminate\Database\Eloquent\Factory $factory */

    use App\Card;
    use Faker\Generator as Faker;

    $factory->define(Card::class, function (Faker $faker) {

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


        return [
            'game_id' => 1,
            'numbers' => json_encode($numbersOfCard)
        ];
    });
