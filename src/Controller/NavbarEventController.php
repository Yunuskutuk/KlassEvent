<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarEventController extends AbstractController
{
    /**
     * @var mixed
     */
    private $eventRepository;

    public function __construct(EventRepository $enventRepository)
    {
        $this->eventRepository = $enventRepository;
    }

    public function quoteNavbar(): Response
    {
        $events = $this->eventRepository->findAll();
        return $this->render('event/_navbarEventQuote.html.twig', [
            'events' => $events
        ]);
    }
}
