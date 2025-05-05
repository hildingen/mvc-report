<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route("/game", name: "game")]
    public function home(): Response
    {
        return $this->render('game/game.html.twig');
    }

    #[Route("/start-game-21", name: "start-game-21")]
    public function start(): Response
    {
        return $this->render('game/start.html.twig');
    }
}
