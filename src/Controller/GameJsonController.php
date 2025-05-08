<?php

namespace App\Controller;

use App\Game\Game21;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameJsonController
{
    #[Route("/api/game", methods: ['GET'])]
    public function game(SessionInterface $session): Response
    {
        $game = $session->get("game");

        if (!$game) {
            $data = [
                'error' => 'No game object in session!'
            ];

            return new JsonResponse($data);
        }

        $data = [
            'player_score' => $game->getPlayerScore()
        ];

        return new JsonResponse($data);
    }
}
