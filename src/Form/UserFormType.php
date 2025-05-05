<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo',TextType::class,[
                'label'=>'Votre Pseudo',
                'attr'=>[
                    'placeholder'=>'votre pseudo',

                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>'Votre Email',
                'attr' =>[
                    'placeholder'=> 'Votre adresse email'
                ]

            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => 
                                ['label' => 'Votre mot de passe', 
                                'hash_property_path' => 'password'
                                ],
                'second_options' => 
                                ['label' => 'Repeter votre mot de passe'
                                ],
                'mapped' => false,
            ])
            ->add('photo', TextType::class,[
                'label'=>'Votre photo',
                'attr' =>[
                    'placeholder'=>'Envoyer votre photo'
                ]
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
            ]);
   
            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
