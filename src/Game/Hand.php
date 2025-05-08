<?php

namespace App\Game;

use App\Game\Card;

class Hand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }

    public function getValue(): int
    {
        $val = 0;
        $nrOfAces = 0;

        foreach ($this->hand as $card) {
            $valOfCard = $card->getValue();

            if (is_numeric($valOfCard)) {
                $val += (int)$valOfCard;
            } elseif ($valOfCard == 'J') {
                $val += 11;
            } elseif ($valOfCard == 'Q') {
                $val += 12;
            } elseif ($valOfCard == 'K') {
                $val += 13;
            } elseif ($valOfCard == 'A') {
                $nrOfAces += 1;
            }
        }

        if ($nrOfAces > 0) {
            $val += $this->calcAces($nrOfAces);
        }

        return $val;
    }

    private function calcAces($aces): int
    {
        $val = 0;

        for ($i = 0; $i < $aces; $i += 1) {

            $val += ($val + 14 > 21 ? 1 : 14);
        }

        return $val;
    }
}
