<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
/* ---- Event Routes ---- */

    /**
     * @Route("/event", name="event_index")
     */
    public function indexEvent(): Response
    {
        return $this->render('event/index.html.twig');
    }

    /**
     * @Route("/event/gallery/decoration", name="event_gallery_decoration")
     */
    public function galleryDecoration(): Response
    {
        return $this->render('event/galleryDecoration.html.twig');
    }
    /**
     * @Route("/event/gallery/mariage", name="event_gallery_mariage")
     */
    public function galleryMariage(): Response
    {
        return $this->render('event/galleryMariage.html.twig');
    }

    /**
     * @Route("/event/gallery/henne", name="event_gallery_henne")
     */
    public function galleryHenne(): Response
    {
        return $this->render('event/galleryHenne.html.twig');
    }

    /**
     * @Route("/event/gallery/reception", name="event_gallery_reception")
     */
    public function galleryReception(): Response
    {
        return $this->render('event/galleryReception.html.twig');
    }
}
