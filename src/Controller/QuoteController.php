<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuoteController extends AbstractController
{


    /**
     * @Route("/quote/send/email", name="quote_send", methods={"GET", "POST"})
     */
    public function send(): Response
    {
        $request = Request::createFromGlobals();

        dd($request);
        return $this->render('quote/send.html.twig');
    }

    /**
     * @Route("/quote/{id}", name="quote_quote")
     */
    public function quote(string $id, EventRepository $eventRepository): Response
    {
        $eventSelected = $eventRepository->findOneBy(['id' => $id]);
        return $this->render('quote/quote.html.twig', [
            'event' => $eventSelected
        ]);
    }
}
