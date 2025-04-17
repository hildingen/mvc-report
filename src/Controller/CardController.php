<?php

namespace App\Controller;

use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function home(): Response
    {
        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function card_deck(SessionInterface $session): Response
    {
        $deck = $session->get("deck");

        if (!$deck) {
            $deck = new DeckOfCards();
            $session->set("deck", $deck);
        }

        $deck_str = $deck->getString();

        asort($deck_str);

        $data = [
            "deck" => $deck_str
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/shuffle", name: "card_shuffle")]
    public function card_shuffle(SessionInterface $session): Response
    {

        $deck = new DeckOfCards();

        $deck->shuffleDeck();

        $session->set("deck", $deck);

        $data = [
            "deck" => $deck->getString(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/draw", name: "card_draw")]
    public function card_draw(SessionInterface $session): Response
    {
        $deck = $session->get("deck");

        if (!$deck) {
            $deck = new DeckOfCards();
        }
        $drawn_card = $deck->drawCard();

        $data = [
            "deck" => $deck->getString(),
            "drawn_card" => $drawn_card->getAsString()
        ];

        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_nr_cards")]
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
            "hand" => $hand->getString(),
            "deck" => $deck->getString(),
        ];

        return $this->render('card/draw_nr.html.twig', $data);
    }
}
