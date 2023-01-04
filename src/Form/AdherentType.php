<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => "Nom de l'adherent",
                    'attr' =>[
                        "placeholder" => "Saisir le nom de l'adherent"
                    ]
            ])

            ->add('prenom',TextType::class,[
                'label' => "Prénom",
                'attr' =>[
                    "placeholder" => "Saisir le prénom de l'adherent"
                ]
            ])

            ->add('dateNaiss',DateType::class,[
                'label' => "Date de naissance",
                'widget' => 'choice',
                'years' => range(date('Y')-100, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31)
            ])
            
            ->add('telephone',TelType::class,[
                'label' => "Téléphone",
                'attr' =>[
                    "placeholder" => "Saisir le numéro de téléphone de l'adherent"
                ]
            ])
            
            
            ->add('email',EmailType::class,[
                'label' => "Email",
                'attr' =>[
                    "placeholder" => "Saisir le l'email de l'adherent"
                ]
            ])
            
            
            ->add('NumRue',NumberType::class,[
                'label' => "N°rue",
                'attr' =>[
                    "placeholder" => "Saisir le numéro de la rue"
                ]
            ])
                
            ->add('Rue',TextType::class,[
                'label' => "Rue",
                'attr' =>[
                    "placeholder" => "Saisir le nom de la rue"
                ]
            ])
                
            ->add('CP',NumberType::class,[
                'label' => "Code postale",
                'attr' =>[
                    "placeholder" => "Saisir le code postale de l'adherent"
                ]
            ])
                
            ->add('ville',TextType::class,[
                'label' => "Ville",
                'attr' =>[
                    "placeholder" => "Saisir la ville de l'adherent"
                ]
        ]
                )
            ->add('image',TextType::class)
            //->add('valider',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
