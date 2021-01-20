<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    /**
     * @Route("/quote/{id}", name="quote_quote")
     */
    public function quote(string $id, EventRepository $eventRepository): Response
    {
        // pour faire un devis, il nous faut:
        // la date (et l'heure) de l'événement
        // nombre d'invités
        // les services
        // pour chaques service, les options
        // le contact
        $eventSelected = $eventRepository->findOneBy(['id' => $id]);
        return $this->render('quote/quote.html.twig', [
            'event' => $eventSelected
        ]);
    }
}
