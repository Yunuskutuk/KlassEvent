<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
    /**
     * @Route("/event/contact", name="event_contact")
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
                $message = $contact->getSenderEmail() . "-" . $contact->getNumber() . "-" . $contact->getMessage();
                $email
                    ->from('ab2714d368-ae00ad@inbox.mailtrap.io')
                    ->to('david67230@gmail.com')
                    ->subject($subject)
                    ->html($message);
            }

            $mailer->send($email);
            $this->addFlash('success', 'Email envoyé !');

            return $this->redirectToRoute("event_index");
        }
        // Render the form
        return $this->render('event/contact.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
