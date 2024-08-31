<?php

namespace App\Form;

use App\Entity\Lagerort;
use App\Entity\Mikroskop;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MikroskopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('inventarnummer')
            ->add('hersteller')
            ->add('modell')
            ->add('ausgeliehen')
            ->add('letztePruefung', null, [
                'widget' => 'single_text',
            ])
            ->add('Lagerort', EntityType::class, [
                'class' => Lagerort::class,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mikroskop::class,
        ]);
    }
}
