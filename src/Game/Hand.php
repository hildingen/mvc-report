<?php

namespace App\Game21;

use App\Game21\Card;

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
                $val += 13;
            }
        }

        return $val;
    }
}
