<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function home(SessionInterface $session): Response
    {
        $data = [
            "session" => $session->all()
        ];

        return $this->render('session/home.html.twig', $data);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function session_delete(SessionInterface $session)
    {
        $session->clear();

        $this->redirectToRoute('session');
    }
}
