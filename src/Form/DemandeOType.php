<?php

namespace App\Form;

use App\Entity\DemandeO;
use App\Entity\Facture;
use App\Entity\FormData;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class DemandeOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Responsable',TextType::class, array(


             'attr'=> array(  'placeholder' => 'Sender',
                             
             ))
            )
            ->add('Service',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Service')))
            ->add('ResponsableMag',TextType::class, array(
                'empty_data' => ' Mejed Chaabi',
                'required' => false,
                'attr'=> array(  'placeholder' => 'store manager')))
            ->add('RefTMG',TextType::class, array(

                'attr'=> array(  'placeholder' => 'T.M.G reference')))
            ->add('RefBU',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Business unit reference')))
            ->add('Modele',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Model')))
            ->add('BU',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Business unit')))
            ->add('Description',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Description')))
            
                
            ->add('Doc',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Documentation')))
            ->add('Type',ChoiceType::class, array(
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'New' => 'New request',
                  'Optimizing' => 'Optimizing',
                  'Duplication' => 'Duplication',
                ],
                
                'placeholder' => 'Type'
              ))
            ->add('ResponsableADMI',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Adminitration manger'),
                'empty_data'=>' Waiting'
                ))
            ->add('Confirmation',ChoiceType::class, array(
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'Not confirmed' => 'Not confirmed',
                  'In progress' => 'In progress',
                  'Confirmed' => 'Confirmed',
                ],
                
                'placeholder' => 'Confirmation',
                'empty_data'=>' Waiting'
              ))
         


            ->add('ResponsableTechnique',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Director')))
            ->add('confirmationDemande',ChoiceType::class, array(
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'Not confirmed' => 'Not confirmed',
                  'In progress' => 'In progress',
                  'Confirmed' => 'Confirmed',
                ],
                
                'placeholder' => ' final Confirmation',
                'empty_data'=>' Waiting'
              ))
            ->add('ReferenceMag',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Store ID')))





            ->add('Facture',EntityType::class,
            [
             'class'=> Facture::class,
             'choice_label'=>'idfacture',
             'label'=>'Facture'

            ])






            ->add('formData',EntityType::class,
            [

            'class'=> FormData:: class,
            'choice_label'=> 'FileNames',
            
            'multiple' => true,
            'expanded' => false,
            'required' => true

            ])
           

            ->add('date', DateType::class, array(
                'attr'=> array('format'=>"dd/MM/yyyy hh:mm:ss")
                
            ))
            ->add('datefin', DateType::class, array(
                'attr'=> array('format'=>"dd/MM/yyyy hh:mm:ss")
                
            ));


            
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeO::class,
        ]);
    }
}
