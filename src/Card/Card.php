<?php

namespace App\card;

class Card
{
    protected $value;
    protected $suit;

    public function __construct(string $value, string $suit)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    public function getAsString(): string
    {
        return "{$this->value} of {$this->suit}";
    }
}
