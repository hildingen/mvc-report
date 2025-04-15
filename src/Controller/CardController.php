<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function home(): Response
    {
        $hand = new CardHand();
        for ($i = 0; $i < 52; $i++) {
            $hand->add(new CardGraphic($i));
        }

        $data = [
            "card_hand" => $hand->getString(),
        ];
        return $this->render('card/card.html.twig', $data);
    }
}
