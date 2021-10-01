<?php

namespace App\Form;

use App\Entity\Bultein;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BulteinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('matiere',TextType::class,[
                'label'=>'Le nom de la matiere : ',
                'attr'=>['placeholder'=>'Taper le nom de la matiere ici..']
            ])
              ->add('note',TextType::class,[
                'label'=>'ajouter la note d\'eleve : ',
                'attr'=>['placeholder'=>'Taper le note de l\'eleve ici..']
            ])
            ->add('Eleve',EntityType::class,[
                'label'=>'eleve : ',
                'attr'=>['placeholder'=>'Taper l\'eleve ici..'],
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bultein::class,
        ]);
    }
}
