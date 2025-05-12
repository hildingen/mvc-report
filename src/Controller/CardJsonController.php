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

        $deckStr = $deck->sortDeck();

        $data = [
            'deck' => $deckStr
        ];

        return new JsonResponse($data);
    }

    #[Route("/api/deck/shuffle", methods: ['GET'])]
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

    #[Route("/api/deck/draw", methods: ['GET'])]
    public function drawCard(SessionInterface $session): Response
    {
        $deck = $session->get("deck");

        if (!$deck) {
            $deck = new DeckOfCards();
        }

        $drawnCard = $deck->drawCard();

        $session->set("deck", $deck);

        $data = [
            "deckSize" => count($deck->getString()),
            "drawnCard" => $drawnCard->getAsString()
        ];

        return new JsonResponse($data);
    }

    #[Route("/api/deck/draw/{num<\d+>}", methods: ['GET'])]
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
            "drawnCards" => $hand->getString(),
            "deckSize" => count($deck->getString()),
        ];

        return new JsonResponse($data);
    }
}
