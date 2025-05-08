<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Game\Game21;

class GameController extends AbstractController
{
    #[Route("/game", name: "game")]
    public function home(): Response
    {
        return $this->render('game/game.html.twig');
    }

    #[Route("/game/start-game-21", name: "start-game-21")]
    public function start(SessionInterface $session): Response
    {
        $game = new Game21();

        $session->set("game", $game);

        $data = [
            "player" => $game->getPlayerHand(),
            "player_score" => $game->getPlayerScore(),
            "player_bust" => $game->checkBustPlayer(),
            "bankir_bust" => $game->checkBustBankir(),
            "bankir_score" => $game->getBankirScore(),
            "bankir" => $game->getBankirHand()
        ];

        return $this->render('game/start.html.twig', $data);
    }

    #[Route("/game/draw_card", name: "draw_card")]
    public function draw_card(SessionInterface $session): Response
    {
        $game = $session->get("game");

        $game->playerHit();

        $data = [
            "player" => $game->getPlayerHand(),
            "player_score" => $game->getPlayerScore(),
            "player_bust" => $game->checkBustPlayer(),
            "bankir_bust" => $game->checkBustBankir(),
            "bankir_score" => $game->getBankirScore(),
            "bankir" => $game->getBankirHand()
        ];

        return $this->render('game/start.html.twig', $data);
    }

    #[Route("/game/stay", name: "stay")]
    public function stay(SessionInterface $session): Response
    {
        $game = $session->get("game");

        while (!$game->checkBustBankir() && $game->getBankirScore() < $game->getPlayerScore()) {
            $game->bankirHit();
        }

        $data = [
            "player" => $game->getPlayerHand(),
            "player_score" => $game->getPlayerScore(),
            "player_bust" => $game->checkBustPlayer(),
            "bankir_bust" => $game->checkBustBankir(),
            "bankir_score" => $game->getBankirScore(),
            "bankir" => $game->getBankirHand()
        ];

        return $this->render('game/start.html.twig', $data);
    }

    #[Route("/game/doc", name: "doc")]
    public function doc(): Response
    {
        return $this->render('game/doc.html.twig');
    }
}
