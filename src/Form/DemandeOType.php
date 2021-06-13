<?php

namespace App\Form;

use App\Entity\DemandeO;
use App\Entity\Facture;
use App\Entity\FormData;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class DemandeOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Responsable',TextType::class, array(


             'attr'=> array(  'placeholder' => 'Sender'))
            )
            ->add('Service',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Service')))
            ->add('ResponsableMag',TextType::class, array(
                'empty_data' => ' Mejed Chaabi',

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
            ->add('Type',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Type')))
            ->add('ResponsableADMI',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Adminitration manger')))
            ->add('Confirmation',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Confirmation')))
         
            ->add('Statut',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Request state')))




            ->add('Priorite', NumberType::class, array(
                'empty_data' => '1',
                'attr'=> array(  'placeholder' => 'priority'))    )






            ->add('ResponsableTechnique',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Director')))
            ->add('confirmationDemande',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Agree')))
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
           




            
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeO::class,
        ]);
    }
}
