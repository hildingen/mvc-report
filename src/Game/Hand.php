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

        // Fix A == 14 or 1

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
            for ($i = 0; $i < $nrOfAces; $i++) {
                if ($val + 14 > 21) {
                    $val += 1;
                } else {
                    $val += 14;
                }
            }
        }

        return $val;
    }
}
