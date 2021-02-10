<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuoteController extends AbstractController
{


    /**
     * @Route("/quote/send/email", name="quote_send", methods={"GET", "POST"})
     */
    public function send(MailerInterface $mailer): Response
    {
        // find info from POST and put in $infos
        $request = Request::createFromGlobals();
        $infos = $request->request->all();
        if ($infos) {
            $email = new Email();
            $subject = "Demande de devis : " . $infos['event'];

            $email
                ->from('ab2714d368-ae00ad@inbox.mailtrap.io')
                ->to('klassevent@ymail.com')
                ->subject($subject)
                ->html($this->renderView('event/newQuoteEmail.html.twig', ['infos' => $infos]));

            $mailer->send($email);
            $this->addFlash('success', 'Devis envoyé !');

            return $this->redirectToRoute('event_index');
        }
        return $this->redirectToRoute('quote_quote');
    }

    /**
     * @Route("/quote/{id}", name="quote_quote")
     */
    public function quote(string $id, EventRepository $eventRepository): Response
    {
        $eventSelected = $eventRepository->findOneBy(['id' => $id]);
        return $this->render('quote/quote.html.twig', [
            'event' => $eventSelected
        ]);
    }

    /**
     * @Route("/quote", name="quote_start")
     */
    public function start(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
        return $this->render('quote/start.html.twig', [
            'events' => $events
        ]);
    }
}
