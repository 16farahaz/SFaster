<?php

namespace App\Form;

use App\Entity\GammeUsinage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GammeUsinageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Operation' ,TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Operation')

            ))
            ->add('Machine' ,TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Machin')

            ))
           
            ->add('PuissanceMachine' ,IntegerType::class,array(
              
                'attr'=> array(  'placeholder' => ' Power ')

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GammeUsinage::class,
        ]);
    }
}
