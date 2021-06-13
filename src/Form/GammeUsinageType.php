<?php

namespace App\Form;

use App\Entity\GammeUsinage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GammeUsinageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Operation')
            ->add('Machine')
           
            ->add('PuissanceMachine')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GammeUsinage::class,
        ]);
    }
}
