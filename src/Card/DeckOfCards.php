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

    public function sortDeck(): array
    {
        $sortedDeck = [];
        $hearts = [];
        $spades = [];
        $diamonds = [];
        $clubs = [];

        foreach ($this->deck as $card) {
            if ($card->getSuit() == '♥') {
                $hearts[] = $card;
            } elseif ($card->getSuit() == '♠') {
                $spades[] = $card;
            } elseif ($card->getSuit() == '♦') {
                $diamonds[] = $card;
            } elseif ($card->getSuit() == '♣') {
                $clubs[] = $card;
            }
        }

        asort($hearts);
        asort($spades);
        asort($diamonds);
        asort($clubs);

        $sortedDeck = array_merge($hearts, $spades, $diamonds, $clubs);

        return $this->deckToString($sortedDeck);
    }

    public function deckToString($deck): array
    {
        $values = [];
        foreach ($deck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
