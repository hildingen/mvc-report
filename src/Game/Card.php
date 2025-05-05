<?php

namespace App\Game21;

class Card
{
    protected $value;
    protected $suit;

    public function __construct(string $value, string $suit)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getAsString(): string
    {
        return "{$this->value} {$this->suit}";
    }
}
