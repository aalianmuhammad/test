<?php

namespace App\Form;

use App\Entity\Rijles;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RijlesType extends AbstractType
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datum')
            ->add('tijd')
            ->add('ophaal_locatie')
            ->add('lesdoel')
            ->add('annuleren')
            ->add('annuleer_reden')
            ->add('opmerkingen_instructeur')
            ->add('opmerkingen_leerling')
            ->add('klant', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'choices' => $this->userRepository->findUser()
            ])
            ->add('opslaan', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rijles::class,
        ]);
    }
}
