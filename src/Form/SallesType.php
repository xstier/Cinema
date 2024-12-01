<?php

namespace App\Form;

use App\Entity\Cinemas;
use App\Entity\Salles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SallesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('qualite_projection', ChoiceType::class, [
                'choices' => [
                    '4K' => '4K',
                    'HD' => 'HD'
                ]

            ])
            ->add('id_cinema', EntityType::class, [
                'class' => Cinemas::class,
                'choice_label' => 'nom_cinema',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salles::class,
        ]);
    }
}
