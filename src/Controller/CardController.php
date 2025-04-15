<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function home(): Response
    {
        $deck = new DeckOfCards();
        for ($i = 0; $i < 52; $i++) {
            $deck->add(new CardGraphic($i));
        }

        $data = [
            "deck" => $deck->getString(),
        ];
        return $this->render('card/card.html.twig', $data);
    }
}
