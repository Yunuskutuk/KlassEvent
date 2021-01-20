<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Contact;
use App\Form\ContactType;

class TraiteurController extends AbstractController
{
    /**
     * @Route("/traiteur", name="traiteur")
     */
    public function index(): Response
    {
        return $this->render('traiteur/index.html.twig');
    }

    /**
     * @Route("/traiteur/contact", name="traiteur_contact")
     * @Param $body ressource|string|null
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

            return $this->redirectToRoute("traiteur");
        }
        // Render the form
        return $this->render('traiteur/contact.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
