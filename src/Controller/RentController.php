<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    /**
     * @Route("/rent/decoration", name="rent_decoration")
     */
    public function decoration(): Response
    {
        return $this->render('rent/decoration.html.twig');
    }

        /**
     * @Route("/rent/dishes", name="rent_dishes")
     */
    public function dishes(): Response
    {
        return $this->render('rent/dishes.html.twig');
    }

        /**
     * @Route("/rent/chair", name="rent_chair")
     */
    public function chair(): Response
    {
        return $this->render('rent/chair.html.twig');
    }
}
