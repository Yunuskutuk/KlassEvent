<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    /**
     * @Route("/quote/{id}", name="quote_quote")
     */
    public function quote(string $id, Request $request): Response
    {
        // pour faire un devis, il nous faut:
        // 1 la date (et l'heure) de l'événement
        // 2 nombre d'invités
        // 3 le type d'évenement
        // 4 les services
        // 5 pour chaques service, les options
        // 6 le contact
        dd($id);

        return $this->render('quote/index.html.twig');
    }
}
