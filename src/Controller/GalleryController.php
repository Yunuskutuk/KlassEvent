<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GalleryController extends AbstractController
{
    /**
     * @Route("/gallery/{id}", name="gallery_gallery")
     */
    public function gallery(Service $service): Response
    {
        return $this->render('gallery/index.html.twig', [
            'services' => $service
        ]);
    }
}
