<?php 

namespace App\Controller\Eleve;

use App\Entity\LineClassEleve;
use App\Entity\User;
use App\Form\BulteinType;
use App\Form\ClasseType;
use App\Form\LineClasseEleveType;
use App\Repository\BulteinRepository;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;

class MaClasseController extends AbstractController
{
    /**
     * @Route("eleve/maClasse/{id}", name="ma_classe")
     */
 public function show(LineClassEleveRepository $lineClassEleveRepository,ClasseRepository $classeRepository):Response
    {  
    
        $eleve = $this->getUser();
        $classe = $classeRepository->findAll();
        $allLineClasse = $lineClassEleveRepository->findAll();
        $Idclasse=[];
        $classe = $lineClassEleveRepository->findby(['idEleve'=>$eleve]);
        $Idclasse=0;
        $idclasseeleve=[];
        $Idclasse = $classe[0]->getIdClasse()->getId();
        for ($i=0;$i<count($allLineClasse);$i++){

            if ($allLineClasse[$i]->getIdClasse()->getId() == $Idclasse){
                $idclasseeleve = $lineClassEleveRepository->findby(['idClasse'=>$Idclasse]);
            }
        }
        if(!$eleve)
        {
            $this->addFlash('warning','Le eleve n\'existe pas');
   
             return $this->redirectToRoute('public_home');
        }
        if($eleve->getRoles()[0] !== User::ROLE_ELEVE){
            
            $this->addFlash('warning','seul les eleves peuvent acceder a cette page');
            return $this->redirectToRoute('public_home');
        }
        if(!$classe)
        {
            $this->addFlash('warning','La classe n\'existe pas');

            return $this->redirectToRoute('public_home');
        }

        return $this->render('eleve/maClasse.html.twig',[
            'idclasseeleve'=>$idclasseeleve
        ]);

       
    }
}