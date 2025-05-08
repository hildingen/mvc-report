<?php

namespace App\Game;

use App\Game\Hand;
use App\Game\Deck;

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

    public function getPlayerScore(): int
    {
        return $this->player->getValue();
    }

    public function getBankirScore(): int
    {
        return $this->bankir->getValue();
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
        $this->bankir->add($this->deck->drawCard());
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
