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
            $subject = "demande de devis \[" . $infos['event'] . "\]";
            $message = "<h1> demande de devis pour:" . $infos['event'] . "</h1>";
            foreach ($infos as $info => $value) {
                $message .= "<p>$info: $value <p>";
            }
            $email
                ->from('ab2714d368-ae00ad@inbox.mailtrap.io')
                ->to('jeff.nys@fafache.net')
                ->subject($subject)
                ->html($message);

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
}
