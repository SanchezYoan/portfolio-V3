<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {   
        $data= new ContactDTO();

        $data->name = 'John Doe';
        $data->email = 'yoan.sanchez@example.com';
        $data->message = 'Bonjour, je voudrais vous contacter.';


        $contactForm = $this->createForm(ContactType::class, $data);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $data = $contactForm->getData();

            $mail = (new TemplatedEmail())
                ->from($data->email)
                ->to(new Address('yoan30470@hotmail.fr'))
                ->subject('Contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                'data' => $data,
            ]);

            try {
                $mailer->send($mail);
                $this->addFlash(
                    'success',
                    'Votre message a été envoyé avec succès !',
                );
            } catch (TransportExceptionInterface $e) {
                $this->addFlash(
                    'error',
                    $e->getMessage(),
                );
            }
            return $this->redirectToRoute('contact');
        }



        return $this->render('contact/contact.html.twig', [
            'form' => $contactForm,
        ]);
    }
}
