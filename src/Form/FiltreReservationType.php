<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Coach;
use App\Entity\Adherent;
use App\Model\FiltreReservation;
use App\Repository\ClubRepository;
use App\Repository\CoachRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FiltreReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => "Saisir une partie du nom de l'adherent recherché"
                ],
                'required' =>false,
                'label' =>"Recherche sur le nom de l'adherent"
            ])
            ->add('club',EntityType::class,[
                'class' => Club::class,
                'query_builder'=>function(ClubRepository $repo){
                    return $repo->listeClubsSimple();
                },
                'choice_label' => 'ville',
                'label' => "club(s)",
                'required' =>false,
                // 'multiple'=>true,
                // 'by_reference'=>false,
                // 'attr' =>[
                //     "placeholder" => "Saisir le nom du coach"
                // ]
            ])
            ->add('coachs',EntityType::class,[
                'class' => Coach::class,
                'query_builder'=>function(CoachRepository $repo){
                    return $repo->listeCoachsSimple();
                },
                'required' =>false,
                // 'multiple'=>true,
                'choice_label' => 'nom',
                'label' => "Coach",
                // 'attr' =>[
                //     "placeholder" => "Saisir le nom du coach"
                // ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'method' =>'get',
            'csrf_protection'=>false,
            'data_class'=> FiltreReservation::class
        ]);
    }
}
