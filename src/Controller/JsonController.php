<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JsonController
{
    #[Route("/api/quote")]
    public function jsonQuote(): Response
    {
        $number = random_int(0, 4);

        $quotes = [
            'It is only possible to live happily ever after on a day-to-day basis.',
            'Live forever or die in the attempt.',
            'I am convinced that life in a physical body is meant to be an ecstatic experience.',
            'It is best to do things systematically, since we are only human, and disorder is our worst enemy.',
            'The hardest thing in the world to understand is the income tax.'
        ];

        $quote = $quotes[$number];
        $today = date("F j, Y, g:i a");

        $data = [
            'quote' => $quote,
            'date' => $today,
        ];

        return new JsonResponse($data);
    }
}
