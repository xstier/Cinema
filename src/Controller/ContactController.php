<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer, Security $security): Response
    {
        $user = $security->getUser();


        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $subject = $data['demande'] ?? 'Contact Form Submission'; // Remplacez selon votre structure de formulaire
            $text = $data['description'] ?? 'No message provided';

            $email = (new Email())
                ->from('contact@cinephoria.com')
                ->to('contact@cineforia.com')
                ->subject($subject)
                ->text($text);

            try {
                $mailer->send($email);
                return new Response('Email envoyé');
            } catch (\Exception $e) {
                return new Response('Failed to send email: ' . $e->getMessage());
            }
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'user' => $user,
            'form' => $form,
        ]);
    }
}
