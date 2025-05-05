<?php

namespace App\Game21;

use App\Game21\Hand;
use App\Game21\Deck;

class Game21
{
    private $player;
    private $bankir;
    private $deck;

    public function __construct()
    {
        $this->player = new Hand();
        $this->bankir = new Hand();
        $this->deck = new Deck();

        $this->deck->shuffleDeck();

        $this->player->add($this->deck->drawCard());
    }

    public function getPlayerHand(): array
    {
        return $this->player->getString();
    }

    public function getBankirHand(): array
    {
        return $this->bankir->getString();
    }

    public function playerHit(): void
    {
        $this->player->add($this->deck->drawCard());
    }

    public function bankirHit(): void
    {
        $this->player->add($this->deck->drawCard());
    }

    public function checkBustPlayer(): bool
    {
        return $this->player->getValue() > 21;
    }

    public function checkBustBankir(): bool
    {
        return $this->bankir->getValue() > 21;
    }
}
