<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasseOublieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('new_password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'le mot de passe .....',
                'label'=>'mon nouveau mot de passe',
                'required'=>true,
                'first_options'=>[
                    'label'=>'Mon nouveau mot de passe',
                    'attr'=>['placeholder'=>'merci de saisir votre nouveau mot de passe']
                ],
                'second_options'=>[
                    'label'=>'Confirmez votre nouveau mot de passe',
                    'attr'=>['placeholder'=>'merci de confirmer votre nouveau mot de passe']
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label'=>"Valider",
                'attr'=>['style'=>'border:1px solid #aacc00'],              
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
