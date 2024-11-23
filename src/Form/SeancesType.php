<?php

namespace App\Form;

use App\Entity\Films;
use App\Entity\Salles;
use App\Entity\Seances;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeancesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_seance', null, [
                'widget' => 'single_text',
            ])
            ->add('heure_debut', null, [
                'widget' => 'single_text',
            ])
            ->add('heure_fin', null, [
                'widget' => 'single_text',
            ])
            ->add('id_salle', EntityType::class, [
                'class' => Salles::class,
                'choice_label' => 'id',
            ])
            ->add('id_film', EntityType::class, [
                'class' => Films::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seances::class,
        ]);
    }
}
