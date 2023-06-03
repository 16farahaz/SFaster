<?php

namespace App\Form;

use App\Entity\Plan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ReferenceTmg' ,TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'T.M.G Reference')

            ))
            ->add('Statut',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'State')

            ))
            ->add('Priorite',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Priority')

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plan::class,
        ]);
    }
}
