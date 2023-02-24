<?php

namespace App\Services;

use App\Contracts\GameContract;

class LuckyNumberService implements GameContract
{
    public function play(): array
    {
        $randomNumber = rand(1, 1000);
        $randomNumber % 2 == 0 ? $result = 1 : $result = 0;
        $winResult = 0;

        if ($result) {
            if ($randomNumber > 900) {
                $winResult = round($randomNumber * 0.7);
            } else if ($randomNumber > 600) {
                $winResult = round($randomNumber * 0.5);
            } else if ($randomNumber > 300) {
                $winResult = round($randomNumber * 0.3);
            } else {
                $winResult = round($randomNumber * 0.1);
            }
            $result = 'Win';
        } else {
            $result = 'Lose';
        }

        return [
            'random_number' => $randomNumber,
            'win_result' => $winResult,
            'result' => $result,
        ];
    }
}
