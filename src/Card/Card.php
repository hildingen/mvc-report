<?php

namespace App\Card;

class Card
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getAsString(): string
    {
        return "{$this->value}";
    }
}
