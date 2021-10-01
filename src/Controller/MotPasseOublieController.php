<?php

namespace App\Controller;

use App\Entity\MotPasseOublie;
use App\Entity\User;
use App\Form\PasseOublieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MotPasseOublieController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }

    /**
     * @Route("/mot-passe-oublie", name="passe_oublie")
     */
    public function index(Request $request,MailerInterface $mailer): Response
    {

        if($this->getUser()){
            return $this->redirectToRoute('home');
        }
        if($request->get('email')){

            $user=$this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
           if($user){

            // Enregistrer en base la demande de passeoublie user,token et createdAt
               $passe_oublie = new MotPasseOublie();
               $passe_oublie->setUser($user);
               $passe_oublie->setToken(uniqid());
               $passe_oublie->setCreatedAt(new \DateTime());
               $this->entityManager->persist($passe_oublie);
               $this->entityManager->flush();

            $url=$this->generateUrl('modifier_passe',[
                'token'=>$passe_oublie->getToken()
            ]);

            

            $content = "bonjour ".$user->getFirstName()."\n";
            $content .= "Merci de bien vouloir cliquer sur le lien suivant pour ";
            $lien= "mettre a jour voutre mot de passe";
            $href="https://localhost:8000".$url;
            

            // $content .= `<a href='#'> {$url} lien </a>`;

                  $email = (new TemplatedEmail())
                ->from($user->getEmail())
                ->to($user->getEmail())
                ->subject('Nouveau message a été envoyé')
                ->htmlTemplate('mot_passe_oublie/messageLien.html.twig')
                ->context([
                    'message'=> $content,
                    'lien' =>$href,
                    'text' =>$lien
                ]);
            $mailer->send($email);
            $this->addFlash('notice','Vous allez recevoir dans quelque seconde un mail pour renitialiser votre mot de passe');
            //$mailer->send($this->getUser()->getEmail(),$this->getUser()->getFirstName(),'Renitaliser votre mot de passe',$content);

        }
        else{
            $this->addFlash('notice','cette adresse email est inconnue');
        }

        }
        return $this->render('mot_passe_oublie/index.html.twig');
    }


    /**
     * @Route("/modifer-mon-mot-de-passe/{token}", name="modifier_passe")
     */

     public function updatePassword(Request $request, $token, UserPasswordEncoderInterface $encoder )
     {
         $passe_oublie = $this->entityManager->getRepository(MotPasseOublie::class)->findOneByToken($token);

         if(!$passe_oublie){
             return $this->redirectToRoute('passe_oublie');
         } 
        //verifer si le created at= new-3h

         $now = new \DateTime();
         if($now > $passe_oublie->getCreatedAt()->modify('+ 3 hour')){
            //  die('on est bon');
            $this->addFlash('notice','Votre demande de mot de passe a expiré.Merci de la renouvller');
            return $this->redirectToRoute('passe_oublie');
         }
          //Rendre une vue avec mot de passe et confirmez votre mot de passe
             $form = $this->createForm(PasseOublieType::class);
             $form->handleRequest($request);
             if($form->isSubmitted() && $form->isValid()){
                    $nvx_passe=$form->get('new_password')->getData() ;
                    //encodage de mot de passe
                    $password = $encoder->encodePassword($passe_oublie->getUser(),$nvx_passe);
                    $passe_oublie->getUser()->setPassword($password);
                    //flush en base de donnee
                    $this->entityManager->flush();
                    $this->addFlash('notice','Votre mot de passe a bien ete mis a jour ');
                    //redirection de lutilisateur vers la page de connexion
                    return $this->redirectToRoute('app_login');
            }

            return $this->render('mot_passe_oublie/update_password.html.twig',['form'=>$form->createView()]); 
    }
}
