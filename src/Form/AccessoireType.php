<?php

namespace App\Form;

use App\Entity\Accessoire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccessoireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ReferenceTMG',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'T.M.G Reference')

            ))
            ->add('ReferenceBU',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'B.U Reference')

            ))
            ->add('ReferenceMag',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Store Reference')

            ))
            ->add('EmplacementMag',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Place')

            ))
            ->add('PrixA',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Price')

            ))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accessoire::class,
        ]);
    }
}
