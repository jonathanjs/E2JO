<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         
        ->add('password_actuel', PasswordType::class, [
  
            'mapped' => false,
        ])

        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options'  => [
                'label' => 'Modifier mot de passe ', 
 
            ],
            'second_options' => [
                'label' => 
                'Repeter le mot de passe'],
            'mapped' => false,
        ])

        ->add('Envoyer', SubmitType::class, [
            'attr' => ['class' => 'btn btn-success'],
        ]);

        
     
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
