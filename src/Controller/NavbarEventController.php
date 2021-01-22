<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarEventController extends AbstractController
{
    /**
     * @var mixed
     */
    private $eventRepository;

    /**
     * @var mixed
     */
    private $pictureRepository;

    public function __construct(
        EventRepository $enventRepository,
        PictureRepository $pictureRepository
    ) {
        $this->eventRepository = $enventRepository;
        $this->pictureRepository = $pictureRepository;
    }

    public function quoteNavbar(): Response
    {
        $events = $this->eventRepository->findAll();
        return $this->render('event/_navbarEventQuote.html.twig', [
            'events' => $events
        ]);
    }

    public function gallery(): Response
    {
        $pictures = $this->pictureRepository->findAll();
        return $this->render('event/_navbarEventGallery.html.twig', [
            'pictures' => $pictures
        ]);
    }
}
