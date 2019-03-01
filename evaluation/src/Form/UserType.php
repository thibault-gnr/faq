<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                'constraints' => [
                    new NotBlank()
                ],
                'attr' => [
                    'placeholder' => 'Votre nom d\'utilisateur'
                ],
                'label' => false 
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank()
                ],
                'attr' => [
                    'placeholder' => 'Votre adresse mail'
                ],
                'label' => false 
            ])
                ->add('password', PasswordType::class,[
                    'attr' => [
                    'placeholder' => 'Votre mot de passe'
                    ],
                    'label' => false
                ])
            /*->add('password', RepeatedType::class, array(
                'constraints' => [
                    new NotBlank()
                ],
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => [ //propriété du premier input
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Mot de passe'
                    ]
                ],
                'second_options' => [ //propriété du deuxieme input
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Vérification du mot de passe'
                    ]
                ]
            ))*/
            //->add('isActive')
            //->add('createdDate')
            //->add('role')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
