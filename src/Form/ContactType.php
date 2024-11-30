<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use App\Entity\User;



class ContactType extends AbstractType
{
    public function __construct(private Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();



        if (!$this->security->isGranted("IS_AUTHENTICATED_FULLY")) {

            $builder
                ->add('Nom', TextType::class, [
                    'label' => 'Nom'
                ])
                ->add('email', EmailType::class);
        } else {
        }
        $builder

            ->add('demande', TextType::class)
            ->add('description', TextareaType::class)
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here

        ]);
    }
}
