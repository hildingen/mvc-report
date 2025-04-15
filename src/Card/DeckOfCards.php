<?php

namespace App\Card;

class DeckOfCards
{
    private $deck = [];

    public function add(Card $card): void
    {
        $this->deck[] = $card;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
