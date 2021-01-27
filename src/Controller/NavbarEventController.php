<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\ServiceRepository;
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
    private $serviceRepository;

    public function __construct(
        EventRepository $enventRepository,
        ServiceRepository $serviceRepository
    ) {
        $this->eventRepository = $enventRepository;
        $this->serviceRepository = $serviceRepository;
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
        $services = $this->serviceRepository->findAll();
        return $this->render('event/_navbarEventGallery.html.twig', [
            'services' => $services
        ]);
    }
}
