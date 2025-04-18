<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardJsonController
{
    #[Route("/api/deck", methods: ['GET'])]
    public function deck(SessionInterface $session): Response
    {
        $deck = $session->get("deck");

        if (!$deck) {
            $deck = new DeckOfCards();
            $session->set("deck", $deck);
        }

        // Sort on value and suit

        $data = [
            'deck' => $deck->getString()
        ];

        return new JsonResponse($data);
    }

    #[Route("/api/deck/shuffle", methods: ['POST'])]
    public function shuffleDeck(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();

        $deck->shuffleDeck();

        $session->set("deck", $deck);

        $data = [
            "deck" => $deck->getString(),
        ];

        return new JsonResponse($data);
    }

    #[Route("/api/deck/draw", methods: ['POST'])]
    public function drawCard(SessionInterface $session): Response
    {
        $deck = $session->get("deck");

        if (!$deck) {
            $deck = new DeckOfCards();
        }

        $drawn_card = $deck->drawCard();

        $session->set("deck", $deck);

        $data = [
            "deck_size" => count($deck->getString()),
            "drawn_card" => $drawn_card->getAsString()
        ];

        return new JsonResponse($data);
    }

    #[Route("/api/deck/draw/{num<\d+>}", methods: ['POST'])]
    public function drawNrCards(int $num, SessionInterface $session): Response
    {
        $deck = $session->get('deck');

        if (!$deck) {
            $deck = new DeckOfCards();
        }

        $hand = new CardHand();

        for ($i = 0; $i < $num; $i++) {
            $hand->add($deck->drawCard());
        }

        $session->set("deck", $deck);

        $data = [
            "drawn_cards" => $hand->getString(),
            "deck_size" => count($deck->getString()),
        ];

        return new JsonResponse($data);
    }
}
