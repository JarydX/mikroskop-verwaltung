<?php

namespace App\Form;

use App\Entity\Lagerort;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LagerortType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Kurzbeschreibung')
            ->add('Etage')
            ->add('Raum')
            ->add('Schranknummer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lagerort::class,
        ]);
    }
}
