<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;

class TraiteurController extends AbstractController
{
    /**
     * @Route("/traiteur", name="traiteur_index")
     */
    public function indexTraiteur(MenuRepository $menuRepository): Response
    {
        $menus = $menuRepository->findBy(
            ['menuOfWeek' => true]
        );
        return $this->render(
            'traiteur/index.html.twig',
            [
                'menus' => $menus
            ]
        );
    }

    /**
     * @Route("/traiteur/menus", name="traiteur_menus")
     */
    public function menusTraiteur(MenuRepository $menuRepository): Response
    {
        $menus = $menuRepository->findBy(
            ['menuOfWeek' => true]
        );
        return $this->render(
            'traiteur/menus.html.twig',
            [
                'menus' => $menus
            ]
        );
    }
    /**
     * @Route("/traiteur/livraison", name="traiteur_livraison")
     */
    public function livraisonTraiteur(): Response
    {
        return $this->render('traiteur/livraison.html.twig');
    }
    /**
     * @Route("/traiteur/contact", name="traiteur_contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {

        // Create a new Contact Object
        $contact = new Contact();
        // Create the associated Form
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = new Email();
            if ($contact->getSubject() !== null) {
                $subject = $contact->getSubject();
                $message = $contact->getMessage();
                $email
                    ->from('ab2714d368-ae00ad@inbox.mailtrap.io')
                    ->to('david67230@gmail.com')
                    ->subject($subject)
                    ->html($message);

                $mailer->send($email);
                $this->addFlash('success', 'Email envoyé !');
            }

            return $this->redirectToRoute("traiteur_index");
        }
        // Render the form
        return $this->render('traiteur/contact.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
