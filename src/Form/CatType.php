<?php

namespace App\Form;

use App\Entity\Cat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Don\'t forget the name']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'Name too short',
                        'maxMessage' => 'Name too long',
                    ]),
                ],
            ])
            ->add('age', TextType::class, [
                'label' => 'Age',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Don\'t forget the age']),
                    new Assert\Range(
                        min: 1,
                        max: 30,
                        notInRangeMessage: 'Age must be between {{ min }} and {{ max }}',
                    )
                ],
            ])
            ->add('breed', ChoiceType::class, [
                'label' => 'Breed',
                'choices' => [
                    'Bengal' => 'Bengal',
                    'Chartreux' => 'Chartreux',
                    'Maine Coon' => 'Maine Coon',
                    'Korat' => 'Korat',
                    'Munchkin' => 'Munchkin',
                    'Domestic short-hair' => 'Domestic short-hair',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Don\'t forget the breed']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'Breed too short',
                        'maxMessage' => 'Breed too long',
                    ]),
                ],
            ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Sex',
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Don\'t forget the sex']),
                    new Assert\Length([
                        'min' => 4,
                        'max' => 10,
                        'minMessage' => 'Wrong choice of sex',
                        'maxMessage' => 'Wrong choice of sex',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'constraints' => [
                new Assert\NotBlank(['message' => 'Don\'t forget the description']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cat::class,
        ]);
    }
}
