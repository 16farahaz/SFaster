<?php

namespace App\Form;

use App\Entity\Energie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnergieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom' ,TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Energie')

            ))
            ->add('PrixH',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Price')

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Energie::class,
        ]);
    }
}
