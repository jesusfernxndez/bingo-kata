<?php

    function generateBingoNumberRandom(string $column)
    {
        if (!in_array($column, array_keys(bingoColumns()))) {
            return [
                'error' => true,
                'message' => 'Column not found!!!'
            ];
        }
        $getColumn = bingoColumns()[$column];
        return random_int($getColumn['min'], $getColumn['max']);
    }

    function validatePlayerWin(array $numbersOfCard, array $numbersReveled, int $numberOfCoincidences): bool
    {
        $res = array_intersect($numbersOfCard, $numbersReveled);
        if (count($res) === $numberOfCoincidences) {
            return true;
        }
        return false;
    }

    function bingoColumns(): array
    {
        return [
            'B' => ['min' => 1, 'max' => 15, 'count' => 4],
            'I' => ['min' => 16, 'max' => 30, 'count' => 4],
            'N' => ['min' => 31, 'max' => 45, 'count' => 3],
            'G' => ['min' => 46, 'max' => 60, 'count' => 4],
            'O' => ['min' => 61, 'max' => 75, 'count' => 4]
        ];
    }

    function bingoLetters() : array {
        return ['B', 'I', 'N', 'G', 'O'];
    }
