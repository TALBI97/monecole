<?php

namespace App\Controller\Admin\Email;

use App\Form\EmailMessageType;
use Hamcrest\Core\HasToString;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EnvoyeMessageController extends AbstractController{
     /**
     * @Route("admin/form/message", name="form_email")
     */
    public function envoyeMessage(MailerInterface $mailer,Request $request)
    {
        $form = $this->createForm(EmailMessageType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            //Recuperer l'adresse mail de lutilisateur connecter
            $adressEmailAdmin = $this->getUser()->getEmail();
            //Recuperer l'adresse mail de professeur
            $adressEmailProf = $form->get('instituteur')->getData()->getEmail();
            $message =  $form->get('message')->getData();
            $email = (new TemplatedEmail())
                ->from($adressEmailAdmin)
                ->to($adressEmailProf)
                ->subject('Nouveau message a été envoyé')
                ->htmlTemplate('admin/email/message.html.twig')
                ->context([
                    'message'=> $message,
                    'instituteur'=>($form->get('instituteur')->getData()->getFirstName()
                     .' '.$form->get('instituteur')->getData()->getLastName())
                ]);
            //Envoyer le mail
            $mailer->send($email);
            $this->addFlash('success','Votre message a bien ete envoye  .');
            return $this->redirectToRoute('form_email');
        }
        return $this->render('admin/email/envoye_email.html.twig',[
            'form' => $form->createView()
        ]);

    }


}