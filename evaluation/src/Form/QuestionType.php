<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[ 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre titre ne peut pas être vide',
                    ]),
                    new Length([
                        'max'        => 100,
                        'maxMessage' => 'Votre titre ne peut pas contenir plus de {{ limit }} characters',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'L\'intitulé de votre question'
                ],
                'label' => false
            ])
        
            ->add('body', TextType::class,[ 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre commentaire ne peut pas être vide',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Votre question'
                ],
                'label' => false
            ])
            ->add('tags');
            //->add('createdAt')
            //->add('modifiedAt')
            //->add('isActive')
            //->add('slug')

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
