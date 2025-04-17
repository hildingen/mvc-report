<?php

namespace App\Card;

class DeckOfCards
{
    private $deck = [];

    public function __construct()
    {
        for ($i = 0; $i < 52; $i++) {
            $this->deck[] = new CardGraphic($i);
        }
    }

    public function add(Card $card): void
    {
        $this->deck[] = $card;
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function drawCard(): Card
    {
        return array_pop($this->deck);
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
