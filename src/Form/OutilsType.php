<?php

namespace App\Form;

use App\Entity\Outils;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class OutilsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Outil' ,TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Tool')

            ))
            ->add('DureeDeVie',IntegerType::class,array(
              
                'attr'=> array(  'placeholder' => 'Life Time(minute)')

            ))
            ->add('PrixO',NumberType::class,array(
              
                'attr'=> array(  'placeholder' => 'Price')

            ))
            ->add('caracteristique',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'Features')

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Outils::class,
        ]);
    }
}
