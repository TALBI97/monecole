<?php

namespace App\Form;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EmailMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('instituteur',EntityType::class,[
                'label'=>'instituteur',
                'attr'=>['placeholder'=>'Taper l\'instituteur ici..'],
                'class' => User::class,
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('JSON_CONTAINS(u.roles, :role) = 1')
                        ->setParameter('role', '"ROLE_PROFESSEUR"');
                },

                'choice_label' => function(User $user){
                    if ($user->getRoles()[0] === User::ROLE_PROFESSEUR) {
                        return strtoupper($user->getFirstName() .' '. $user->getLastName());
                    }
            
                }
               
            ])
            ->add('message',TextareaType::class,[
                'label'=>'votre message'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
