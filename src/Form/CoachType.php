<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Coach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => "Nom du coach",
                    'attr' =>[
                        "placeholder" => "Saisir le nom du coach"
                    ]
            ])
            ->add('prenom',TextType::class,[
                'label' => "Prénom du coach",
                'attr' =>[
                    "placeholder" => "Saisir le prénom du coach"
                ]
            ])
            ->add('image',TextType::class)

            ->add('club',EntityType::class,[
                'label' => "club",
                'class' => Club::class,
                'choice_label' => 'ville',
                'attr' =>[
                    "placeholder" => "Saisir la ville du club"
                ],
                'required' =>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coach::class,
        ]);
    }
}
