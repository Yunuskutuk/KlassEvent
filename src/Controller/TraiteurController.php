<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TraiteurController extends AbstractController
{
    /* ---- Traiteur Routes ---- */

    /**
     * @Route("/traiteur", name="traiteur_index")
     */
    public function indexTraiteur(): Response
    {
        return $this->render('traiteur/index.html.twig');
    }
    /**
     * @Route("/traiteur/menus", name="traiteur_menus")
     */
    public function menusTraiteur(): Response
    {
        return $this->render('traiteur/menus.html.twig');
    }
    /**
     * @Route("/traiteur/livraison", name="traiteur_livraison")
     */
    public function livraisonTraiteur(): Response
    {
        return $this->render('traiteur/livraison.html.twig');
    }
}
