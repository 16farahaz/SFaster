<?php

namespace App\Form;

use App\Entity\Accessoire;
use App\Entity\Energie;
use App\Entity\GammeUsinage;
use App\Entity\Modele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Matiere;
use App\Entity\Outils;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ModeleType extends AbstractType
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
            ->add('NombreDePiece',TextType::class,array(
              
                'attr'=> array(  'placeholder' => 'pieces ')

            ))
            

        
            ->add('matieres', EntityType::class, [
            
            'class' => Matiere::class,
            'choice_label' => 'Nom',
            'placeholder' => "(Please select an option.)",
              
            'multiple' => true,
            'expanded' => true ])
            ->add('relation2', EntityType::class, [
            
                 'class' => GammeUsinage::class,
                 'choice_label' => 'operation',
                 'placeholder' => "(Please select an option.)",
                 'multiple' => true,
                 'expanded' => true])
                 ->add('energies', EntityType::class, [
            
                    'class' => Energie::class,
                    'choice_label' => 'Nom',
                    'placeholder' => "(Please select an option.)",
                    'multiple' => true,
                    'expanded' => true])
                    ->add('accessoires', EntityType::class, [
            
                        'class' =>Accessoire::class,
                        'choice_label' => 'ReferenceTMG',
                        'placeholder' => "(Please select an option.)",
                        'multiple' => true,
                        'expanded' => true])
                        ->add('outils', EntityType::class, [
            
                            'class' => Outils::class,
                            'choice_label' => 'Outil',
                            
                            'placeholder' => "(Please select an option.)",
                              
                            'multiple' => true,
                            'expanded' => true ])
                           

           
;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
