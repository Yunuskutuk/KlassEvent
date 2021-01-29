<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Services\InstagramServices;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    public function lastInstagram(InstagramServices $instagramServices, int $number): Response
    {
        return $this->render('home/instagram.html.twig', ['instagram' => $instagramServices-> getImages($number)]);
    }

    /**
     * @Route("/admin/", name="admin_index")
     */
    public function indexAdmin(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
