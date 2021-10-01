<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Classe;
use App\Entity\LineClassEleve;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LineClasseEleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idEleve',EntityType::class,[
                'label'=>'nom d\'eleve',
                'attr'=>['placeholder'=>'Taper le nom de la classe ici..'],
                'class' => User::class,

                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('JSON_CONTAINS(u.roles, :role) = 1')
                        ->setParameter('role', '"ROLE_ELEVE"');
                },
                'choice_label' => function(User $user){
                    if ($user->getRoles()[0] === User::ROLE_ELEVE) {
                        return strtoupper($user->getFirstName() .' '. $user->getLastName());
                    }
                } 

            ])
            ->add('idClasse',EntityType::class,[
                'label'=>'nom de la classe',
                'attr'=>['placeholder'=>'Taper le nom de la classe ici..'],
                'class' => Classe::class,
                'choice_label' => function(Classe $classe){
                        return strtoupper($classe->getNom());
                }   
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LineClassEleve::class,
        ]);
    }
}
