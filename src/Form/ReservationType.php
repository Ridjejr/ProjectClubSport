<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Coach;
use App\Entity\Adherent;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateR',DateType::class,[
                'label' => "Date de reservation",
                'widget' => 'choice',
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31)
            ])

            ->add('HeureR',TimeType::class, [
                'label' => "Heure de reservation",
                'input'  => 'datetime',
                'widget' => 'choice',
            ])

            ->add('adherent',EntityType::class,[
                'label' => "Adherent",
                'class' => Adherent::class,
                'choice_label' => 'nom',
                'attr' =>[
                    "placeholder" => "Saisir le nom de l'adherent"
                ],
                'required' =>false,
            ])

            // ->add('adherent',TextType::class,[
            //     'label' => "Nom du coach",
            //     'attr' =>[
            //         "placeholder" => "Saisir le nom de l'adherent"
            //     ]
            // ])

            ->add('club',EntityType::class,[
                'label' => "Club",
                'class' => Club::class,
                'choice_label' => 'ville',
                'attr' =>[
                    "placeholder" => "Saisir la ville du club"
                ],
                'required' =>false,
            ])

            ->add('coach',EntityType::class,[
                'label' => "Coach",
                'class' => Coach::class,
                'choice_label' => 'CoatchAvecClub',
                'attr' =>[
                    "placeholder" => "Saisir le nom du coach"
                ],
                'required' =>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
